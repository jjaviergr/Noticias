<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 setcookie("login","",time()-1, "/");
 setcookie("pass","",time()-1, "/");    
 print "<br>cookies de usuario borradas";
 ?>
 <a href=../index.php>Pulsa para volver a la pagina principal</a>