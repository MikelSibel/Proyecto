<?php
include 'sesion.php';
include 'conexion.php';

comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) 
{
    header("Location: iniciaSesion.php");
    exit;
}

$directorioSubida = '../fotos_perfil/';
$nombreArchivo = "Foto_Perfil_" . $username . "." . pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
$rutaArchivo = $directorioSubida . $nombreArchivo;
$tamanoMaximo = 5 * 1024 * 1024;

if ($_FILES['fotoPerfil']['error'] == UPLOAD_ERR_NO_FILE)
{
    echo "No se ha seleccionado ningún archivo.";
    exit;
}
if ($_FILES['fotoPerfil']['size'] > $tamanoMaximo)
{
    echo "El archivo es demasiado grande. Tamaño máximo permitido: 5MB.";
    exit;
}

$extensionesPermitidas = array('jpg', 'jpeg', 'png', 'gif');
$extension = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);

if (!in_array(strtolower($extension), $extensionesPermitidas)) 
{
    echo "La extensión del archivo no está permitida. Por favor, sube una imagen en formato JPG, JPEG, PNG o GIF.";
    exit;
}

$buscarAlumnoBD = "SELECT * FROM ALUMNOS WHERE Nombre_User = ?";
$buscarAlumno = $conexion->prepare($buscarAlumnoBD);
$buscarAlumno->bind_param("s", $username);
$buscarAlumno->execute();
$resultadoBuscarAlumno = $buscarAlumno->get_result();

if ($resultadoBuscarAlumno->num_rows > 0) 
{
    $ActualizarFoto = "UPDATE ALUMNOS SET Foto = ? WHERE Nombre_User = ?";
    $ObtenerFotoAnterior = "SELECT Foto FROM ALUMNOS WHERE Nombre_User = ?";
} 
else 
{
    $BuscarProfesorBD = "SELECT * FROM PROFESORES WHERE Nombre_User = ?";
    $buscarProfesor = $conexion->prepare($BuscarProfesorBD);
    $buscarProfesor->bind_param("s", $username);
    $buscarProfesor->execute();
    $resultadoBuscarProfesor = $buscarProfesor->get_result();

    if ($resultadoBuscarProfesor->num_rows > 0) 
    {
        $ActualizarFoto = "UPDATE PROFESORES SET Foto = ? WHERE Nombre_User = ?";
        $ObtenerFotoAnterior = "SELECT Foto FROM PROFESORES WHERE Nombre_User = ?";
    } 
    else 
    {
        echo "Usuario no encontrado como alumno ni profesor.";
        exit;
    }
    $buscarProfesor->close();
}
$obtenerFotoAnterior = $conexion->prepare($ObtenerFotoAnterior);
$obtenerFotoAnterior->bind_param("s", $username);
$obtenerFotoAnterior->execute();
$resultadoFotoAnterior = $obtenerFotoAnterior->get_result();

if ($resultadoFotoAnterior->num_rows > 0) 
{
    $filaFotoAnterior = $resultadoFotoAnterior->fetch_assoc();
    $fotoAnterior = $filaFotoAnterior['Foto'];

    if (file_exists($fotoAnterior)) 
    {
        unlink($fotoAnterior);
    }
}

$obtenerFotoAnterior->close();

if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $rutaArchivo)) 
{
    $ActualizarFoto = $conexion->prepare($ActualizarFoto);
    $ActualizarFoto->bind_param("ss", $rutaArchivo, $username);

    if ($ActualizarFoto->execute()) 
    {
        header("Location: perfil.php");
        exit;
    } 
    else 
    {
        echo "Error al actualizar la foto de perfil en la base de datos.";
    }
    $ActualizarFoto->close();
} 

{
    echo "Error al subir el archivo. Por favor, intenta de nuevo más tarde.";
}
$buscarAlumno->close();
?>
