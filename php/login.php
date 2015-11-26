<!DOCTYPE html>
<html>
<head>
  <meta  charset="UTF-8">
  <title>Login </title>
  <!--<link href=<link rel="stylesheet" type="text/css" href=".//css//estilos.css">--> 
</head>

<body>
<?php 
    
    include 'funcion_login.php';
    $existen_cookies = false;
    $intentado = false;
    if (isset($_COOKIE['login']) && isset($_COOKIE['pass']))
    {
        print "<br>Hay cookies";
        $usuario = $_COOKIE['login'];
        $password = $_COOKIE['pass'];
        
        if (isset($_COOKIE['intentado']))
        {
            $intentado = $_COOKIE['intentado'];
        }

        if (!$intentado) // probamos con las credenciales guardadas.
        {
            //Accedio con exito la ultima vez
            print "<br>Es la 1º vez que accede con este navegador";
           if(autentica($usuario,$password))
           {
               print "<br>Es un usuario con credenciales en buen estado";
               graba_session($usuario, $password);               
               header("Location: ./noticias.php");                    
           }                           
           else 
           {
                print "<br>Fallo de autenticación con cookies";
                setcookie("intentado","true",60, "/"); //grabo el intento
                usa_formulario($existen_cookies);
           }
        }
    }
    else //no tiene credenciales guardadas en cookies. 
    {
       usa_formulario($existen_cookies);
    }
?>


</body>
</html>