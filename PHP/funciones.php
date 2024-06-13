<?php
require_once "conexion.php"; 

function comprobarUsuario($nombre_usuario, $clave) 
{
    global $conexion;
    $nombre_usuario = mysqli_real_escape_string($conexion, $nombre_usuario);
    $clave = mysqli_real_escape_string($conexion, $clave);

    $sql_alumnos = "SELECT Nombre, Nombre_User, 'alumno' AS rol FROM ALUMNOS WHERE Nombre_User = '$nombre_usuario' AND Clave = '$clave'";
    $sql_profesores = "SELECT Nombre, Nombre_User, 'profesor' AS rol FROM PROFESORES WHERE Nombre_User = '$nombre_usuario' AND Clave = '$clave'";
    
    $sql = "($sql_alumnos) UNION ($sql_profesores)";
    
    $resul = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($resul) === 1) {
        return mysqli_fetch_assoc($resul);
    } else {
        return false;
    }
}
?>
