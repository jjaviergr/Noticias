<?php

include 'libreria.php';

function usa_formulario($exiten_cookies)
{
    // No hay cookies guardadas
    if (isset($_POST['login']) && isset($_POST['pass']))
    {
        $usuario = $_POST['login'];
        $password = $_POST['pass'];
        if (autentica($usuario, $password) === true)
        {
            //guardo cookies
            graba_session($usuario, $password);
            if($existen_cookies === false)
            {
                $longevidad = 60*60*24*365*50;
                graba_cookies_credenciales($usuario, $password, $longevidad);
            }
            header("Location: ./noticias.php");
        }
        else
        {
            print "<br>No autentica por motivos desconocidos. Contacte con su adm.";
        }
    }
    else
    {
        print "Error de credenciales. Prueba otra vez.";
    }
}

function autentica($login, $password)
{
    $encontrado=FALSE;    
    $dwes=conectar();
    $resultado = $dwes->prepare('select login, password from usuarios where Login like :login AND Password like :passwd');
    $resultado->execute(Array(':login' => $login,':passwd'=>$password));
    $numero_filas = $resultado->rowCount();
    if ($numero_filas == 1)
    {
        $encontrado=TRUE;        
    }
    
    unset($resultado);
    cierra_db($dwes);
    return($encontrado);
}

function graba_cookies_credenciales($usuario,$password,$longevidad)
{      
    setcookie("login",$usuario,time()+$longevidad, "/");
    setcookie("pass",$password,time()+$longevidad, "/");
}

function determina_rol($login, $password)
{
    $dwes=conectar();
    $resultado = $dwes->prepare('select Rol_id from usuarios where Login like :login AND Password like :passwd');       
    $resultado->execute(Array(':login' => $login,':passwd'=>$password));
    $numfilas=$resultado->rowCount();
                
    if($numfilas>0) 
    {
        $fila = $resultado->fetch();
        return($fila['Rol_id']);
        print "<br>Usuario autenticado";
    }
    else
    {
        // Si las credenciales no son válidas, se vuelven a pedir
        $error = "<br>Fallo al recuperar el Rol";
        print "$error";
        return(false);
    }   
    unset($resultado);
    cierra_db($dwes);
}

function graba_session($usuario, $password)
{
    $rol_recuperado = determina_rol($usuario, $password);
    //inicio sesión y grabo
    session_start();
    $_SESSION['usuario']=$usuario;
    $_SESSION['usuario']=$rol_recuperado;
    print "<br>Sesión grabada";
}
?>