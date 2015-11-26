<?php
/* 
    *Guardamos los datos de la conexión en variables.
    *Conectamos a la base de datos mediante PDO.
    *Controlamos cualquier excepción que se pueda ser causada en try-catch.
    *En caso de fallo en cualquier momento se desconectará de la base de datos.
*/

include 'conectar.php';

try
{
    conectar();
    visualizar_noticias();
}
catch(Exception $e)
{
    exit();
}


function consulta()
{
    try
    {
        $conexion = conectar();
 //       $query = $conexion->prepare("select fecha_fin, titulo, descripcion from noticias, usuarios where fecha_fin like :fecha AND rol_nombre like :rol");
//    $resultado->execute(Array(':fecha' => datetime(),':comprobar'=>));
  //  $numero_filas = $resultado->rowCount();
        $text_query = "select fecha_fin, titulo, descripcion from noticias";
        $query = $conexion->query($text_query); // Realizamos la consulta y la guardamos en una variable.
        return $query;
    }
    catch(Exception $e)
    {
        exit();
    }
}

function visualizar_noticias()
{
    try
    {
        $consulta = consulta();
        while($x = $consulta->fetch())
        {
            if($x['fecha_fin'] <= time('Y-m-d'))
            {
                print "<header><h1>".$x['titulo']."</h1></header>";
            }
        }
        $consulta->closeCursor();
    }
    catch(Exception $e)
    {
        print "Error al mostrar datos.";
    }
}
?>