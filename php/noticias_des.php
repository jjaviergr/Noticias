<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>pagina noticias en desarrollo</title>
    </head>
    <body>
        <?php
         include_once 'util.php';
         
        print "pagina de noticias en desarrollo <br>";
        
       

        
        print "Sesion :" . hay_sesion();?>
        
        <a href='cierra_sesion.php'>Pulsa para cerrar sesion</a>

      
   
       <?php print "cookies :" . hay_cookies(); ?>

        <a href='borra_cookies.php'> Pulsa para borrar cookies</a>
        
        <a href=../index.php>Pulsa para volver a la pagina principal</a>
       
        
    </body>
</html>
