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
$nombreArchivo = basename($_FILES['fotoPerfil']['name']);
$rutaArchivo = $directorioSubida . $nombreArchivo;
$extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
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
if (!in_array(strtolower($extension), $extensionesPermitidas)) 
{
    echo "La extensión del archivo no está permitida. Por favor, sube una imagen en formato JPG, JPEG, PNG o GIF.";
    exit;
}

if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $rutaArchivo)) 
{
    $sqlUpdateFoto = "UPDATE ALUMNOS SET Foto = ? WHERE Nombre_User = ?";
    $stmtUpdateFoto = $conexion->prepare($sqlUpdateFoto);
    $stmtUpdateFoto->bind_param("ss", $rutaArchivo, $username);
    
    if ($stmtUpdateFoto->execute()) 
    {
        header("Location: perfil.php");
        exit;
    } else {
        echo "Error al actualizar la foto de perfil en la base de datos.";
    }
    $stmtUpdateFoto->close();
} else {
    echo "Error al subir el archivo. Por favor, intenta de nuevo más tarde.";
}
?>
