<!doctype html>
<!--<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Actualiza usuario</title>
        <link rel="stylesheet" href="../jquery/jquery-ui-themes-1.11.4/themes/smoothness/jquery-ui.css">
      
        <script src="../jquery/jquery-1.11.3.min.js"></script>
        <script src="../jquery/jquery-ui-1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="../jquery/jquery-ui-themes-1.11.4/themes/black-tie/theme.css">

        <style>
/*          #feedback { font-size: 1.4em; }
          #selectable .ui-selecting { background: #FECA40; }
          #selectable .ui-selected { background: #F39814; color: white; }
          #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
          #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }*/
/*        .blanco { color: white; }
        .destacado { font-size: 2em;margin-left: 35%; margin-bottom: 2%;margin-top: 5%; }
        .especial  { font-weight: bold; }
        .contenedor {width: 30%;margin-left: 35%; margin-bottom: 2%;}
        .contenedorS {width: 700px;height: 800px;margin-left:5%;margin-bottom: 5%;margin-top: 5%;}
        .mititulo {font-weight: bold;padding: 0px;margin-left: 0px;}
        .mititulo2 {font-weight: bold;font-size: 14px;padding: 5px;margin: 0px;}
        .subcontenedorL {width: 10%;float: left;   }
        .subcontenedorR {width: 10%;float: right;}
        input{margin-bottom: 5px;}*/
        </style>
        <script>        
//          $(function() {
//            $( "#selectable" ).selectable({
//              stop: function() {
//                var result = $( "#select-result" ).empty();
//                $( ".ui-selected", this ).each(function() {
//                  var index = $( "#selectable li" ).index( this );
//                  result.append( " #" + ( index + 1 ) );
//                });
//              }
//            });
//          });
 

            window.edReg = function (sobj)
            {
                str = sobj.innerHTML || sobj
                tobj = document.getElementById('login')
                tobj.value = str.split(",")[0]
                tobj = document.getElementById('nombre')
                tobj.value = str.split(",")[1]
                tobj = document.getElementById('apellidos')
                tobj.value = str.split(",")[2]
                tobj = document.getElementById('email')
                tobj.value = str.split(",")[3]
                tobj = document.getElementById('rol')
                tobj.value = str.split(",")[4]

            }
        </script>

    </head>
    <body>
        <?php
        //imprime_usuarios();
        include_once 'util.php';

        $db_noticias = conecta_bd("localhost", "noticias", "root", "");

        $consulta_usuarios = "SELECT login,
                                nombre,
                                apellidos,
                                'e-mail',
                                rol_nombre
                            FROM noticias.usuarios;";



        $resultado = $db_noticias->query($consulta_usuarios);

        if ($resultado) {
            $row = $resultado->fetch();
            ?>
       
            <div class="destacado">Escoge un usuario para actualizar</div>
            <div class="contenedor">  
                
                
                    
                <select multiple onchange="edReg(this.options[this.selectedIndex].text)" id="selectable" >
                 
                    <?php
                    while ($row != null) {
                        ?>
                        <option class="ui-widget-content">
                        <?php
                        print "${row['login']},${row['nombre']},${row['apellidos']},${row['e-mail']},${row['rol_nombre']}<br>";
                        ?>
                        </option>
                            <?php
                            $row = $resultado->fetch();
                        }
                        cierra_db($db_noticias);
                        ?>
                </select>
                </div>
           
            <div class="contenedor">  
                <form id="fusuario_alterado" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">  
                    <div class="contenedor">
                <fieldset class="contenedor">    
                    <fieldset class="subcontenedorL">


                            <div class="mititulo2"><p>Login</p></div>
                            <input type="text" id="login" name="login">            
                            <div class="mititulo2">Nombre</div>
                            <input type="text" id="nombre" name="nombre">
                            <div class="mititulo2">Apellidos</div>
                            <input type="text" id="apellidos" name="apellidos">

                    </fieldset>  
                    <fieldset class="subcontenedorR">

                            <div class="mititulo2">E-Mail</div>
                            <input type="text" id="email" name="email">
                            <div class="mititulo2">Rol</div>
                            <input type="text" id="rol" name="rol">
                            <input type="submit"  >
                        
                    </fieldset>
                    
                </fieldset>
                   
                
                </form>
                 </div>
          </div>
          
    <?php
   
    if (isset($_POST['login']))
    { 
         $db_noticias = conecta_bd("localhost", "noticias", "root", "");
//        print_r($_POST);
//        $consulta_act = "UPDATE usuarios
//                   SET
//                    login = ?,       
//                    nombre = ?,
//                    apellidos = ?,
//                    email = ?,
//                    Rol = ?
//                    WHERE login like ?";
         $consulta_act="UPDATE `noticias`.`usuarios`
                    SET
                    `login` = ?,                    
                    `nombre` = ?,
                    `apellidos` = ?,
                    `e-mail` = ?,
                    `rol_nombre` = ?
                    WHERE `login` = ? ;";

        $sentencia = $db_noticias->prepare($consulta_act);
        
        $login=$_POST['login'];
//        $password=$_POST['password'];
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $email=$_POST['email'];
        $rol=$_POST['rol'];
    
        
        
        $sentencia->bindParam(1, $login);
    //        $sentencia->bindParam(2, $password);
        $sentencia->bindParam(2, $nombre);
        $sentencia->bindParam(3, $apellidos);
        $sentencia->bindParam(4, $email);
        $sentencia->bindParam(5, $rol);
        $sentencia->bindParam(6, $login);

        try
        {
            
         $sentencia->execute();
         echo $sentencia->rowCount() . " records UPDATED successfully";
         cierra_db($db_noticias);
        } 
        catch (Exception $e)
        {
            print "<p>No se han podido realizar los cambios. $e</p>";
            cierra_db($db_noticias);
        }
    
    }   
}
?>
            
            
<ol id="selectable">
  <li class="ui-widget-content">Item 1</li>
  <li class="ui-widget-content">Item 2</li>
  <li class="ui-widget-content">Item 3</li>
  <li class="ui-widget-content">Item 4</li>
  <li class="ui-widget-content">Item 5</li>
  <li class="ui-widget-content">Item 6</li>
</ol>
 
    </body>


</html>-->


<!DOCTYPE html>
<!-- saved from url=(0043)http://getbootstrap.com/examples/jumbotron/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./Jumbotron Template for Bootstrap_files/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./Jumbotron Template for Bootstrap_files/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./Jumbotron Template for Bootstrap_files/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./Jumbotron Template for Bootstrap_files/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body cz-shortcut-listen="true">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://getbootstrap.com/examples/jumbotron/#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="http://getbootstrap.com/examples/jumbotron/#" role="button">Learn more »</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="http://getbootstrap.com/examples/jumbotron/#" role="button">View details »</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="http://getbootstrap.com/examples/jumbotron/#" role="button">View details »</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="http://getbootstrap.com/examples/jumbotron/#" role="button">View details »</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>© 2015 Company, Inc.</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Jumbotron Template for Bootstrap_files/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./Jumbotron Template for Bootstrap_files/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Jumbotron Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
  

</body></html>