<!DOCTYPE html>
<html>
<head>
  <meta  charset="UTF-8">
  <title>Inserta Usuarios </title>
  <!--<link href=<link rel="stylesheet" type="text/css" href=".//css//estilos.css">--> 
</head>

<body>
<?php
include_once 'util.php';
$db_noticias=  conecta_bd("localhost", "noticias", "root", "");

$consulta_usuarios="SELECT login,
    nombre,
    apellidos,
    'e-mail',
    rol_nombre
FROM noticias.usuarios;";



$resultado =$db_noticias->query($consulta_usuarios);

if($resultado) 
{
    $row = $resultado->fetch();
    while ($row != null) 
    {
        print  "${row['login']},${row['nombre']},${row['apellidos']},${row['e-mail']},${row['rol_nombre']}<br>";       
       
       $row = $resultado->fetch();
    }
}

 cierra_db($db_noticias);

?>
</body>
</html>