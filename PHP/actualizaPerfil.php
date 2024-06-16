<?php
include 'conexion.php';
include 'sesion.php';
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) 
{
    header("Location: iniciaSesion.php");
    exit;
}

$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$esAlumno = false;

$consultaAlumno = $conexion->prepare("SELECT Estado FROM ALUMNOS WHERE Nombre_User = ?");
$consultaAlumno->bind_param("s", $username);
$consultaAlumno->execute();
$resultadoAlumno = $consultaAlumno->get_result();

if ($resultadoAlumno->num_rows > 0) 
{
    $esAlumno = true;
}
$consultaAlumno->close();

if ($esAlumno) 
{
    $actualizarAlumno = $conexion->prepare("UPDATE ALUMNOS SET Tel = ?, Estado = ? WHERE Nombre_User = ?");
    $actualizarAlumno->bind_param("sss", $telefono, $estado, $username);
    $actualizarAlumno->execute();
    $actualizarAlumno->close();
} 
else 
{
    $actualizarProfesor = $conexion->prepare("UPDATE PROFESORES SET Tel = ? WHERE Nombre_User = ?");
    $actualizarProfesor->bind_param("ss", $telefono, $username);
    $actualizarProfesor->execute();
    $actualizarProfesor->close();
}

if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == 0) 
{
    $foto = $_FILES['fotoPerfil'];
    $nombreFoto = "Foto_Perfil_" . $username;
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

    if (in_array($extension, $extensionesPermitidas)) 
    {
        $rutaDestino = $_SERVER['DOCUMENT_ROOT'] . "/Proyecto/fotos_perfil/" . $nombreFoto . "." . $extension;

        if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) 
        {
            foreach ($extensionesPermitidas as $ext) 
            {
                $rutaAnterior = $_SERVER['DOCUMENT_ROOT'] . "/Proyecto/fotos_perfil/" . $nombreFoto . "." . $ext;
                if (file_exists($rutaAnterior) && $rutaAnterior != $rutaDestino) 
                {
                    unlink($rutaAnterior);
                }
            }
            error_log("Foto de perfil actualizada: $rutaDestino");
        } 
        else 
        {
            error_log("Error al mover la foto de perfil a la ruta de destino.");
        }
    } 
    else 
    {
        error_log("Extensión de archivo no permitida: $extension");
    }
}
header("Location: perfil.php");
exit;
?>
