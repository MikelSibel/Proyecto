<?php
// Borra la sesion del usuario.
require_once 'sesion.php';
comprobar_sesion();
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time() - 3600); //elimina las cookie de hace una hora

// Redirige al usuario a iniciaSesion.php
header("Location: PHP/iniciaSesion.php");
exit;
?>
