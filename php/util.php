<?php 
/**
 *  Biblioteca de funciones Php.
 *  Ire metiendo aqui todo lo que se pueda reutilizar.
 */

/**
 * Esta función imprime en pantalla un listado de los usuarios de la aplicación.
 */
function imprime_usuarios()
{
    $db_noticias=  conecta_bd("localhost", "noticias", "root", "");

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


/**
 * Función que conecta a una base de datos
 * @param type $bd_url 
 * @param type $bd_esquema
 * @param type $bd_user
 * @param type $bd_pass
 * @return \PDO
 */
function conecta_bd($bd_url,$bd_esquema,$bd_user,$bd_pass)
    {
//        print "<br>Conecta :$bd_url|$bd_esquema|$bd_user|$bd_pass";
        try 
        {
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $dsn = "mysql:host=$bd_url;dbname=$bd_esquema";
            $dwes = new PDO($dsn, $bd_user, $bd_pass, $opc);
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (!$dwes) {
            print "<br>Fallo.Revisa conexión con BD";
        }
    }
        catch (PDOException $e) {
            print "<br>Excepcion con la BD : $e";
        }
        return $dwes;
    }

    /**
     * Función que cierra una conexión a una BD.
     * @param type $bd Este parametro es el DataSet.
     */
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
    
   /**
    * Esta función devuelve los campos de una tabla separados por '|'
    * Se supone que ya estas conectado a la BD
    * @param type $db    |  conexión a una BD
    * @param type $tabla |  tabla a la que se desea consultar
    * @return type       |  cadena con la lista de campos
    */
    function averigua_campos_tabla($db,$tabla)
    {       
       try
       {
                
                $consulta="describe ".$tabla.";";
                $result = $db->query($consulta);
                $cad="";
                foreach($result as $i)
                {
//                    print $i['Field'];
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
    
//    class Utils
//{
//    
//    /**
//     * Esta función aporta la seguridad minima a la conexión con la BD para 
//     * evitar  ataques de inyección SQL
//     */
//     public static function recoge($var) 
//    {
//        $tmp = (isset($_REQUEST[$var])) 
//            ? strip_tags(trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "utf-8"))) 
//            : "";
//        if (get_magic_quotes_gpc()) {
//            $tmp = stripslashes($tmp);
//        }
//        //$tmp = recorta($var, $tmp);
//    return $tmp;
//    }
//
//// FUNCIÓN DE CONEXIÓN CON LA BASE DE DATOS MYSQL
//    /**
//     * Función que se conecta a una BD mysql. Es necesario poner manualmente
//     * el nombre de la BD.
//     */
//    public static function conectaDb()
//    {
//        
//        try 
//        {
//            $db = new PDO("mysql:host=localhost;dbname=noticias", "root", "");
//            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//            return($db);
//        } 
//        catch (PDOException $e) 
//        {
//            print "<p>Error: No puede conectarse con la base de datos.</p>\n";    
//            $db=null;
//            exit();
//         }    
//    }
//    
//    
//     /**
//     * Función que devuelve una cadena con los campos de una tabla
//     */
//    public static function averigua_campos_tabla($tabla)
//    {       
//       try
//       {
//                $db=self::conectaDb(); 
//                $consulta="describe ".$tabla.";";
//                $result = $db->query($consulta);
//                $cad="";
//                foreach($result as $i)
//                {
////                    print $i['Field'];
//                    $cad=$cad.$i['Field'].'|';
//                }                
//                return($cad); 
//                $db=null;
//       }
//       catch (Exception $e) 
//       {
//              echo 'Excepción capturada: ', $e->getMessage(), "\n";
//              $db = null;
//              return($e->getMessage());
//       }
//    }
//    
//    /**
//     * función que imprime en pantalla toda la información de una tabla 
//     */
//    public static function imprime($tabla)
//    {
//        $consulta="select * from ".$tabla;
//        try
//        {
//            $db=self::conectaDb();
//            
//            $campos=self::averigua_campos_tabla($tabla);
//            $lista_campos=explode("|",$campos);
//            $n_lista_campos=count($lista_campos);
//            $result = $db->query($consulta);
//            
//            print "<table border=1>";            
//            print "<tr>";
//            for($i=0;$i<$n_lista_campos-1;$i++)
//            {
//               $campo=$lista_campos[$i];
//               print "<th>".$campo."</th>"  ; 
//            }  
//            print "</tr>";
//            
//            foreach($result as $z)
//            {
//                print  "<tr>";
//                for($i=0;$i<$n_lista_campos-1;$i++)
//                {                          
//                    $campo=$lista_campos[$i];
//                    print "<td>".$z[$campo]."</td>"  ; 
//                }                           
//                print "</tr>";
//            }
//            print "</table>";
//            $db = null;
//         }
//         catch (Exception $e) 
//         {
//              echo 'Excepción capturada: ', $e->getMessage(), "\n";
//              $db = null;
//              return($e->getMessage());
//         }
//    }    
//}
