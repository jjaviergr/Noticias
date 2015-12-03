<!DOCTYPE html>
<html>

<head lang="es">
    <title>Iniciar Sesion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href=".//css//login.css">
</head>

<body>
    <?php
    include_once 'php/libreria.php';
    
    session_start();
    if (isset($_SESSION['usuario']))
    {
        $usuario=$_SESSION['usuario'];
        switch($usuario){
            case "profesor":
                header("Location: php/noticias.php");
                break;
            case "usuario":
                header("Location: php/noticias.php");
                break;
            default:
                header("Location: php/menu_configuracion.php");
        }
    }
    else
    {
        //coger cookies
        //   si hay cookies autenticar
        //                   si autentica y no es administrador ir al header 
        //                   si autentica y es administrador ir a pag administrador 
        //   si no hay cookies ir a form y autenticar  
        //           si no autentica  mostrar form y mensaje error                       
        //           si autentica grabar cookies, grabar sesion y ir al header o a pagina de administrador
        session_destroy();
        if (isset($_COOKIE['login']) && isset($_COOKIE['pass']))
        {
            $login=$_COOKIE['login'];
            $pass=$_COOKIE['pass'];
            if( autentica($login,$pass))
            {    
                graba_session($login, $pass); 
                
                if (usuario_entra_configuracion($login, $pass)==1)
                {
                    header("Location: php/menu_configuracion.php");
                }
               else
               {
                  header("Location: php/noticias.php");
               }
            }
            else
            {
                    muestra_formulario();
            }
      }
      else
      {   
           logando_sin_cookies();
      }
  }

   function logando_sin_cookies()
   {
       muestra_formulario();
       if (isset($_POST['login']) && isset($_POST['pass']))
       {
           $login=$_POST['login'];
           $pass=md5($_POST['pass']);
           if (autentica($login,$pass))
           {
               graba_cookies_credenciales($login, $pass, 365*24*60*60);
               graba_session( $login, $pass);
               if (usuario_entra_configuracion($login, $pass))
               {
                   header("Location: php/menu_configuracion.php");
               }
               else
               {
                   header("Location: php/noticias.php");
               }
           }
       }
   }
   
   /**
    * Función que graba una sesión con el login y rol de un usuario.
    * @global string $bd_url
    * @global type $bd_esquema
    * @global string $bd_user
    * @global string $bd_pass
    * @param type $login
    * @param type $pass
    */
   function graba_session($login,$pass)
   {              
        $rol_recuperado= determina_rol($login,$pass);
        session_start();
        $_SESSION['usuario']=$login;
        $_SESSION['rol']=$rol_recuperado;
   }
    
   /**
     * Funcion que recupera el rol de la tabla de usuarios de la BD noticias
     * @param type $bd_url
     * @param type $bd_esquema
     * @param type $bd_user
     * @param type $bd_pass
     * @param type $login
     * @param type $pass
     * @return type
     */
    function determina_rol($login,$pass)
    {        
        $dwes=conectar(); 
        $consulta="SELECT * FROM noticias.usuarios WHERE login like ? 
                ";
        
        $resultado = $dwes->prepare($consulta);  
        
        print "<br>".$login." ".$pass."<br>";
        
        $resultado->bindParam(1, $login);
       
        
        $resultado->execute();
        
        $numfilas=$resultado->rowCount();              
        if($numfilas>0) 
        {
            $fila = $resultado->fetch();
            return($fila['rol_nombre']);            
        }
        else 
        {      
            $error = "<br>Fallo al recuperar el Rol";            
            return $error;
        }        
        unset($resultado);        
        cierra_db($dwes);
    }
    
    /**
     * Función que graba cookies con las credenciales de un usuario
     * OJO!! El pass no se encripta en esta función.
     * @param type $usuario
     * @param type $pass
     * @param type $longevidad - Tiempo que quieres que se mantenga la cookie
     */
    function graba_cookies_credenciales($login,$pass,$longevidad)
    {          
       setcookie("login",$login,time()+$longevidad, "/");
       setcookie("pass",$pass,time()+$longevidad, "/");     
    }
    
    /**
     * Función que devuelve si un usuario tiene el rol de administrador
     * @global string $bd_url
     * @global type $bd_esquema
     * @global string $bd_user
     * @global string $bd_pass
     * @param type $login
     * @param type $pass
     * @return boolean
     */
    function usuario_entra_configuracion($login,$pass)
    {
        $dwes=conectar();
        $rol = $_SESSION['rol'];
        $consulta="SELECT * FROM usuarios 
        where login like ? and login not like 'usuario' and login not like 'profesor'";
        $resultado = $dwes->prepare($consulta);
        $resultado->bindParam(1, $login);
        $resultado->execute();

        if ($resultado->rowCount()>0) {
            return 1;
        } else {
            return 0;
        }
        cierra_db($dwes);
    }
    
    /**
     * Funcion que autentica a un usuario de la BD noticias
     * @global type $url
     * @global string $esquema
     * @global string $bd_user
     * @global string $bd_pass
     * @param type $login
     * @param type $pass
     * @return type
     */
    function autentica($login,$pass)
    {
//        print "param autentia $login |  $pass";
        $encontrado=0;
             
        $dwes=conectar();
        $resultado = $dwes->prepare('select * from usuarios where Login like :login AND Password like :passwd');        
        $resultado->execute(Array(':login' => $login,':passwd'=>$pass));       
        
        $numero_filas = $resultado->rowCount() ; 
        
//        print "<br>numero filas :$numero_filas";
        if ( $numero_filas > 0 )
        {
           $encontrado=1;        
        }       
        
        unset($resultado);
        cierra_db($dwes);        
        
        return($encontrado);
    }
    
    /**
     * Función que invoca a un formulario HTML
     */
    function muestra_formulario()
    {
        ?>
    
    <div class="sesion effect2" id="color">
        <h2>I.E.S. Aguadulce</h2>
        <form class="formulario" role="form" action="" method='post' autocomplete="off">
            <input style="display:none">
            <input type="password" style="display:none">
            <div class="usuario">
                <input type="text" placeholder="E-mail / usuario"  name="login" autocomplete="off" value="">
            </div>
            <div class="contraseña">
                <input type="password" class="form-control" placeholder="Contraseña" name="pass" autocomplete="off" value="">
            </div>
            <div class="enviar">
                <button type="submit" class="enviar" name='enviar'>
                    <span>Enviar</span>
                </button>
            </div>
        </form>
    </div>
    <?php
    }
 ?>
    
</body>

</html>
