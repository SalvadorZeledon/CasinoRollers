<?php
include 'conexion.php'; // Incluye el archivo de conexión

// Verifica si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $nombre = $_POST['nombre'];
    $fecha_nacimiento = $_POST['edad'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Inserta el nuevo usuario en la base de datos
    $sql = "INSERT INTO Usuario (Email, Nombre ,Fecha_nacimiento, Password) VALUES ($email, $nombre, $fecha_nacimiento, $password)";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}
?>

