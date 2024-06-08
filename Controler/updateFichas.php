<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fichas = intval($_POST['fichas']);
    $_SESSION['fichas'] = $fichas;
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Método no permitido"));
}
?>
