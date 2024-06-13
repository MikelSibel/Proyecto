<?php
require_once 'sesion.php';
comprobar_sesion();
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time() - 3600);
header("Location: /Proyecto/PHP/iniciaSesion.php");
exit;
?>
