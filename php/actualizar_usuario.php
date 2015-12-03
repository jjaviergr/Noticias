<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Actualiza usuario</title>
<!--        <link rel="stylesheet" href="../jquery/jquery-ui-themes-1.11.4/themes/smoothness/jquery-ui.css">
      
        <script src="../jquery/jquery-1.11.3.min.js"></script>
        <script src="../jquery/jquery-ui-1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="../jquery/jquery-ui-themes-1.11.4/themes/black-tie/theme.css">-->

        <style>
/*          #feedback { font-size: 1.4em; }
          #selectable .ui-selecting { background: #FECA40; }
          #selectable .ui-selected { background: #F39814; color: white; }
          #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
          #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }*/
        .blanco { color: white; }
        .destacado { font-size: 2em;margin-left: 35%; margin-bottom: 2%;margin-top: 5%; }
        .especial  { font-weight: bold; }
        .contenedor {width: 30%;margin-left: 35%; margin-bottom: 2%;}
        /*.contenedorS {width: 700px;height: 800px;margin-left:5%;margin-bottom: 5%;margin-top: 5%;}*/
        .mititulo {font-weight: bold;padding: 0px;margin-left: 0px;}
        .mititulo2 {font-weight: bold;font-size: 14px;padding: 5px;margin: 0px;}
        .subcontenedorL {width: 10%;float: left;   }
        .subcontenedorR {width: 10%;float: right;}
        input{margin-bottom: 5px;}
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
        include_once 'libreria.php';

        $db_noticias = conectar();

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
                    <!--<div class="contenedor">-->
                <!--<fieldset class="contenedor">-->    
                    <fieldset class="subcontenedorL">


                            <div class="mititulo2"><p>Login</p></div>
                            <input type="text" id="login" name="login">            
                            <div class="mititulo2">Nombre</div>
                            <input type="text" id="nombre" name="nombre">
                            <div class="mititulo2">Apellidos</div>
                            <input type="text" id="apellidos" name="apellidos">

<!--                    </fieldset>  
                    <fieldset class="subcontenedorR">-->

                            <div class="mititulo2">E-Mail</div>
                            <input type="text" id="email" name="email">
                            <div class="mititulo2">Rol</div>
                            <input type="text" id="rol" name="rol">
                            <input type="submit"  >
                        
                    </fieldset>
                    
                <!--</fieldset>-->
                   
                
                </form>
                 </div>
          <!--</div>-->
          
    <?php
   
    if (isset($_POST['login']))
    { 
         $db_noticias = conectar();
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
            
            
<!--<ol id="selectable">
  <li class="ui-widget-content">Item 1</li>
  <li class="ui-widget-content">Item 2</li>
  <li class="ui-widget-content">Item 3</li>
  <li class="ui-widget-content">Item 4</li>
  <li class="ui-widget-content">Item 5</li>
  <li class="ui-widget-content">Item 6</li>
</ol>-->
 
    </body>


</html>
