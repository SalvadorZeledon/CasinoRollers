<?php
// Iniciar sesión
session_start();

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resultado"])) {
    // Obtener el ID del usuario de la sesión
    if (isset($_SESSION["userId"])) {
        $userId = $_SESSION["userId"];
        $resultado = $_POST["resultado"];

        // Preparar y ejecutar la llamada al procedimiento almacenado para actualizar el progreso del usuario
        require_once "conexion.php";
        $stmt = $conn->prepare("CALL ActualizarProgreso(?, ?)");
        $stmt->bind_param("is", $userId, $resultado);
        $stmt->execute();

        // Consultar el nuevo valor de fichas desde la base de datos
        $stmt = $conn->prepare("SELECT fichas FROM user WHERE ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($fichas);
        $stmt->fetch();
        $stmt->close();

        // Enviar el nuevo valor de fichas al cliente
        echo json_encode(array("fichas" => $fichas));

        $conn->close();
    } else {
        echo "Error: El ID de usuario no está definido en la sesión";
    }
} else {
    echo "Error: No se recibieron datos válidos";
}
?>
