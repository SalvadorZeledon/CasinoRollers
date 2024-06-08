<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include "conexion.php";

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Preparar la llamada al procedimiento almacenado para obtener los datos del usuario
    $stmt = $conn->prepare("CALL autenticar_usuario(?, ?, @userId, @fichas, @userName, @error_message)");
    $stmt->bind_param("ss", $email, $password);

    // Ejecutar la llamada al procedimiento almacenado
    $stmt->execute();

    // Obtener los resultados del procedimiento almacenado
    $result = $conn->query("SELECT @userId AS userId, @fichas AS fichas, @userName AS userName, @error_message AS error_message");
    $row = $result->fetch_assoc();

    // Verificar si se produjo algún error durante la llamada al procedimiento almacenado
    if (!empty($row['error_message'])) {
        // Error al obtener los datos del usuario, enviar respuesta JSON con mensaje de error
        echo json_encode(array(
            'success' => false,
            'error' => $row['error_message']
        ));
    } else {
        // No hubo error, verificar si se encontró un usuario con las credenciales proporcionadas
        if (!empty($row['userId'])) {
            // Usuario autenticado correctamente, guardar la información del usuario en la sesión
            $_SESSION['userId'] = $row['userId'];
            $_SESSION['fichas'] = $row['fichas'];
            $_SESSION['user'] = $row['userName'];
            
            // Enviar respuesta JSON con información del usuario
            echo json_encode(array(
                'success' => true,
                'userId' => $row['userId'],
                'fichas' => $row['fichas'],
                'userName' => $row['userName']
            ));
        } else {
            // Credenciales incorrectas, enviar respuesta JSON con mensaje de error
            echo json_encode(array(
                'success' => false,
                'error' => 'El usuario o la contraseña son incorrectos.'
            ));
        }
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>



