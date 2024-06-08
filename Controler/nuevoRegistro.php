<?php
include 'conexion.php'; // Incluye el archivo de conexión

// Crear un array para almacenar la respuesta
$response = array();

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["userName"];
    $edad = $_POST["edad"];
    $email = $_POST["email2"];
    $password = $_POST["password2"];

    // Verificar que ningún campo esté vacío
    if (empty($nombre) || empty($edad) || empty($email) || empty($password)) {
        $response['success'] = false;
        $response['message'] = "Por favor, completa todos los campos.";
    } else {
        // Preparar la llamada al procedimiento almacenado para verificar si el correo electrónico ya existe
        $stmt_check_email = $conn->prepare("CALL ObtenerIDPorEmail(?, @userId)");
        $stmt_check_email->bind_param("s", $email);

        // Ejecutar la llamada al procedimiento almacenado
        $stmt_check_email->execute();

        // Obtener el resultado del procedimiento almacenado
        $result = $conn->query("SELECT @userId AS id");
        $row = $result->fetch_assoc();

        if ($row['id'] !== NULL && $row['id'] > 0) {
            // Ya existe una cuenta con este correo, establecer un mensaje de error en la respuesta
            $response['success'] = false;
            $response['message'] = "Ya existe una cuenta con este correo, debes utilizar otro.";
        } else {
            // Preparar la llamada al procedimiento almacenado para insertar un nuevo usuario
            $stmt_insert_user = $conn->prepare("CALL insertar_usuario(?, ?, ?, ?, @newUserID, @p_error_message)");
            $stmt_insert_user->bind_param("siss", $nombre, $edad, $email, $password);

            // Ejecutar la llamada al procedimiento almacenado
            if ($stmt_insert_user->execute()) {
                // Obtener el ID del usuario recién creado
                $result = $conn->query("SELECT @newUserID AS id, @p_error_message AS error_message");
                $row = $result->fetch_assoc();
                $id_usuario = $row['id'];
                $error_message = $row['error_message'];

                // Verificar si hubo algún error al insertar el usuario
                if (!empty($error_message)) {
                    // Hubo un error al insertar el usuario, establecer un mensaje de error en la respuesta
                    $response['success'] = false;
                    $response['message'] = $error_message;
                } else {
                    // Preparar la llamada al procedimiento almacenado para insertar el progreso del usuario
                    $stmt_insert_progress = $conn->prepare("CALL InsertarProgreso(?)");
                    $stmt_insert_progress->bind_param("i", $id_usuario);

                    // Ejecutar la llamada al procedimiento almacenado
                    if ($stmt_insert_progress->execute()) {
                        // Registro exitoso, establecer un mensaje de éxito en la respuesta
                        $response['success'] = true;
                        $response['message'] = "Registro exitoso";
                    } else {
                        // Error al registrar el progreso del usuario
                        $response['success'] = false;
                        $response['message'] = "Error al registrar el progreso del usuario";
                    }
                }
            } else {
                // Error al registrar el usuario
                $response['success'] = false;
                $response['message'] = "Error al registrar el usuario";
            }

            // Cerrar la declaración
            $stmt_insert_user->close();
            $stmt_insert_progress->close();
        }

        // Cerrar la declaración
        $stmt_check_email->close();
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver la respuesta como JSON
echo json_encode($response);

?>
