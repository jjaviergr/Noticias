<?php
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
?>