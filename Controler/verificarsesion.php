<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    echo 
    '
        <script>
            alert("Error: Sesin no iniciada. Redireccionando al inicio de sesión...");
        <script/>
    ';
    header("Location: ../index.php");

    exit;
}
?>