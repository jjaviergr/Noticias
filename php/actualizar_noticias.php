<?php

include 'libreria.php';


if ($_POST['info']) {
    $id = $_POST['info'];
    $con = conectar();
    $result = $con->query("SELECT titulo, descripcion, fecha_inicio, fecha_fin from noticias where id=" . $id);
//    $row = mysqli_fetch_assoc($result);
//    header('Content-Type: application/json');
//    echo json_encode($row);
//    console.log($row);
    while ($value = $result->fetch()) {
        $titulo = $value[0];
        $descripcion = "|" . $value[1];
        $fecha_inicio ="|" . $value[2];
        $fecha_fin ="|" . $value[3];
    };
//    echo '<div id="a" style:"display:none">';
    echo $titulo;
//    echo "</div>";
//    echo '<div id=2 style:"display:none">';
    echo $descripcion;
//    echo "</div>";
//    echo '<div class="3" style:"display:none">';
    echo $fecha_inicio;
//    echo "</div>";
//    echo '<div class=4 style:"display:none">';
    echo $fecha_fin;
//    echo "</div>";
};
