<?php

$is_mobile = false;
if( isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$_SERVER['HTTP_USER_AGENT']) ) {
    $is_mobile = true;
}
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Definir la consulta SQL base
$sql = "SELECT u.nombre, p.puntos";
if (!$is_mobile) {
    $sql .= ", p.ganados, p.perdidos, p.empate, u.fichas";
}
$sql .= " FROM user u
          INNER JOIN progreso p ON u.ID = p.idUser
          ORDER BY p.puntos DESC
          LIMIT 20";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Imprimir los datos en la tabla HTML
    $num = 1; 
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $num.  "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        // Mostrar las columnas adicionales solo si no es un dispositivo móvil
        if (!$is_mobile) {
            echo "<td>" . $row["ganados"] . "</td>";
            echo "<td>" . $row["perdidos"] . "</td>";
            echo "<td>" . $row["empate"] . "</td>";
            echo "<td>" . $row["fichas"] . "</td>";
        }
        echo "<td>" . $row["puntos"] . "</td>";
        echo "</tr>";

        $num = $num + 1;
    }
} else {
    echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

