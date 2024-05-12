<?php
$servername = "127.0.0.1:3306"; // Cambia localhost por la dirección IP o nombre de host de tu servidor MySQL si es diferente
$username = "root"; // Cambia usuario por el nombre de usuario de tu base de datos
$password = "root"; // Cambia contraseña por la contraseña de tu base de datos
$database = "RollersCasino"; // Cambia basededatos por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
} else {
  echo "Conexión exitosa";
}
?>