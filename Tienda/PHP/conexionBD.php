<?php
$conexion = mysqli_connect("localhost", "root", "", "tienda") or die("No se ha conectado a la base de datos, comprueba conexionBD.php");
mysqli_set_charset($conexion, "utf8");
?>