<?php
require_once "conexion.php";
require_once "sesion.php";

function comprobarUsuario($nombre_usuario, $clave) 
{
    global $conexion;

    $nombre_usuario = mysqli_real_escape_string($conexion, $nombre_usuario);
    $clave = mysqli_real_escape_string($conexion, $clave);

    $consultaAlumnos = "SELECT Nombre_User, 'alumno' AS rol FROM ALUMNOS WHERE Nombre_User = '$nombre_usuario' AND Clave = '$clave'";
    $resultadoAlumnos = mysqli_query($conexion, $consultaAlumnos);

    $consultaProfesores = "SELECT Nombre_User, 'profesor' AS rol FROM PROFESORES WHERE Nombre_User = '$nombre_usuario' AND Clave = '$clave'";
    $resultadoProfesores = mysqli_query($conexion, $consultaProfesores);

    if (mysqli_num_rows($resultadoAlumnos) === 1) 
    {
        return mysqli_fetch_assoc($resultadoAlumnos);
    }
    if (mysqli_num_rows($resultadoProfesores) === 1) 
    {
        return mysqli_fetch_assoc($resultadoProfesores);
    }
    return false;
}
?>
