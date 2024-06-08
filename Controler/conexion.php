<?php
// Crear conexión
$conn = new mysqli("157.173.193.5", "anonymus", "CRek*Gx!C7ePaf]A" , "casino");

// Verificar la conexión
if ($conn->connect_error) {
    $mensaje = "Error de conexión: " . $conn->connect_error;
} else {
    $mensaje = "Conexión exitosa";
}
?>


