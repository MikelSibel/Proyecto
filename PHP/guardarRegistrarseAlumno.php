<?php
include 'conexion.php';

if (isset($_POST['enviar'])) 
{
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido1 = mysqli_real_escape_string($conexion, $_POST['apellido1']);
    $apellido2 = mysqli_real_escape_string($conexion, $_POST['apellido2']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $nombreUser = mysqli_real_escape_string($conexion, $_POST['nombreUser']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
    $estado = mysqli_real_escape_string($conexion, $_POST['estado']);

    $consulta = "INSERT INTO ALUMNOS (Correo_elec, Nombre, Apellido_1, Apellido_2, Tel, Nombre_User, Clave, Estado) 
            VALUES ('$correo', '$nombre', '$apellido1', '$apellido2', '$telefono', '$nombreUser', '$clave', '$estado')";

    if (mysqli_query($conexion, $consulta)) 
    {
        header("Location: iniciaSesion.php");
    } 
    else 
    {
        echo "Error al insertar el registro: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
}
?>
