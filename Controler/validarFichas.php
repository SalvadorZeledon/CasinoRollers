<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include "conexion.php";

// Obtener el ID del usuario de la sesión
$userId = $_SESSION['userId'];

// Consultar el número de fichas del usuario
$stmt = $conn->prepare("SELECT fichas FROM user WHERE ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($fichas);
$stmt->fetch();
$stmt->close();

// Devolver el número de fichas en formato JSON
echo json_encode(['fichas' => $fichas]);
?>
