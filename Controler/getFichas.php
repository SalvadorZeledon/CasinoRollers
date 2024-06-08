<?php
session_start();
$response = array(
    'fichas' => isset($_SESSION['fichas']) ? $_SESSION['fichas'] : 0,
    'nombre' => isset($_SESSION['user']) ? $_SESSION['user'] : 'Invitado'
);
echo json_encode($response);
?>
