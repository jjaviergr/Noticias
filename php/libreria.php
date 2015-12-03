<?php 
/**
 *  Biblioteca de funciones Php.
 */

function conectar()
{
    $db = "mysql:host=localhost;dbname=noticias"; // Nombre de la base de datos
    $user = "root"; // Nombre del usuario
    $pass = ""; // Contraseña del usuario
    try
    {
        $connection = new PDO($db, $user, $pass); // Guardamos la conexión en una variable
        return $connection;
    }
    catch(Exception $e)
    {
        print "Falló la conexión: " . $e->getMessage();
    }
}

function cierra_db($bd)
{
    try
    {
        unset($bd);
    }
    catch (Exception $e)
    {
        die("Error cerrando: " . $e->getMessage());
    }
}

function imprime_usuarios()
{
    $db_noticias = conectar();

    $consulta_usuarios="SELECT `usuarios`.`login`,
    `usuarios`.`login`,
    `usuarios`.`nombre`,
    `usuarios`.`apellidos`,
    `usuarios`.`email`,
    `usuarios`.`Rol`
    FROM `noticias`.`usuarios`;";
    
    $resultado =$db_noticias->query($consulta_usuarios);
    
    if($resultado) 
    {
        $row = $resultado->fetch();
        while ($row != null) 
        {
            print  "${row['login']},${row['nombre']},${row['apellidos']},${row['email']},${row['Rol']}<br>";       
            $row = $resultado->fetch();
        }
    }    
    cierra_db($db_noticias);
}

function averigua_campos_tabla($db,$tabla)
{       
    try
    {
                    
        $consulta="describe ".$tabla.";";
        $result = $db->query($consulta);
        $cad="";
        foreach($result as $i)
        {
//                        print $i['Field'];
            $cad=$cad.$i['Field'].'|';
        }                
        return($cad); 
        $db=null;
    }
    catch (Exception $e) 
    {
        echo 'Excepción capturada: ', $e->getMessage(), "\n";
        $db = null;
        return($e->getMessage());
    }
}
    
function borra_cookies()
{
    setcookie("login","",time()-1, "/");
    setcookie("pass","",time()-1, "/");
}
    
function hay_cookies()
{
    
    if (isset($_COOKIE['login']))
    {
        return "si";
    }
    else
    {
        return "no";
    }
}
    
function hay_sesion()
{
    session_start();
    if (isset($_SESSION['login']))
    {
        return "si";
    }
    else    
    {
        return "no";
    }
}


