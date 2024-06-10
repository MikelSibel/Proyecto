<?php
function comprobar_sesion()
{
	session_start();
	if(!isset($_SESSION['usuario']))
	{
		header("Location: iniciaSesion.php?redirigido=true");
		exit;
	}
}
?>