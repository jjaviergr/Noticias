<?php
/* 
    *Guardamos los datos de la conexión en variables.
    *Conectamos a la base de datos mediante PDO.
    *Controlamos cualquier excepción que se pueda ser causada en try-catch.
    *En caso de fallo en cualquier momento se desconectará de la base de datos.
*/

include 'libreria.php';
session_start();
try
{
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
        $rol = $_SESSION['rol'];
        $conexion = conectar();
        $consulta = "select fecha_fin, titulo, descripcion from noticias join usuarios on usuarios_login = login where rol_nombre = '".$rol."' ";
        $query = $conexion->query($consulta);
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
        if($consulta->rowCount()!=0)
        {
            while($x = $consulta->fetch())
            {
                if($x['fecha_fin'] <= time('Y-m-d'))
                {
                    print "<header><h1>".$x['titulo']."</h1></header>";
                }
            }
            $consulta->closeCursor();
        }
        else
        {
            print "<header><h1>No hay noticias</h1></header>";
        }    
    }
    catch(Exception $e)
    {
        print "Error al mostrar datos.";
    }
}
?>