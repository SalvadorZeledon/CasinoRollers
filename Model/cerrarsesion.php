<?php 

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
    session_destroy();
   
}
?>