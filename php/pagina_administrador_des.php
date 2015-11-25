<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>pagina de administrador en desarrollo</title>
    </head>
    <body>
        <?php
        print "pagina de administrador en desarrollo ";
       session_start();
       
        if (isset($_SESSION['usuario']) && isset($_SESSION['rol']))
        {
        print "<br>Existe una sesion abierta<br>";
        }
        ?>
       <button onclick=" <?php session_unset(); ?>">Pulsa para cerrar sesion</button>
       <a href=borra_cookies.php>Pulsa para borrar cookies</a>
       <a href=../index.php>Pulsa para volver a la pagina principal</a>
       
        
    </body>
</html>
