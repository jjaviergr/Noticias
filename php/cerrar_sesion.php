<?php  
session_start();


//session_unset(); 
print "<br>sesion de usuario destruida";

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();
header("Location: borrar_cookies.php");
?>
 <a href=../index.php>Pulsa para volver a la pagina principal</a>

