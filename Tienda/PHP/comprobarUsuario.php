<?php
require_once "conexion.php";
require_once "sesion.php";

function comprobarUsuario($nombre_usuario, $clave){
    global $conexion;

    $nombre_usuario = mysqli_real_escape_string($conexion, $nombre_usuario);
    $clave = mysqli_real_escape_string($conexion, $clave);

    $consultaUsuarios = "SELECT Email, Es_Admin FROM USUARIO WHERE Email = '$nombre_usuario' AND Clave = '$clave'";
    $resultado = mysqli_query($conexion, $consultaUsuarios);

    if (mysqli_num_rows($resultado) === 1) {
        return mysqli_fetch_assoc($resultado);
    }
    return false;
}
?>