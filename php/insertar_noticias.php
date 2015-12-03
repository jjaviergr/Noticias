<?php

include 'libreria.php';
if (isset($_POST['enviar'])) {
    if ($_POST['id'] == 0) {

        $titulo = $_POST['titulo'];
        $cuerpo = $_POST['cuerpo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $consulta = "INSERT INTO noticias(`id`, `titulo`, `descripcion`, `url_imagen`, `fecha_inicio`, `fecha_fin`, `usuarios_login`, `etapas_id`) VALUES 
        (NULL, '$titulo', '$cuerpo', NULL, '$fecha_inicio', '$fecha_fin', 'fulana', '1')";
        
        $con = conectar();
        $resultado = $con->exec($consulta);
        cierra_db($con);
    } else {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $cuerpo = $_POST['cuerpo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $consulta = "UPDATE noticias SET titulo=$titulo, descripcion=$cuerpo, fecha_inicio=$fecha_inicio, fecha_fin=$fecha_fin where id = $id";

        $con = conectar();
        $resultado = $con->exec($consulta);
        cierra_db($con);
    }

    //Redirecciona a una pagina
    header('Location: menu_configuracion.php');
}
