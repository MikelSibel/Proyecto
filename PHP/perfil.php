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

$nombre = '';
$apellido1 = '';
$apellido2 = '';
$telefono = '';
$correo = '';
$estado = '';
$rol = '';

$alumnoBd = "SELECT Nombre, Apellido_1, Apellido_2, Tel, Correo_elec, Estado 
              FROM ALUMNOS 
              WHERE Nombre_User = ?";
$consultaAlumno = $conexion->prepare($alumnoBd);
$consultaAlumno->bind_param("s", $username);
$consultaAlumno->execute();
$resultadoAlumno = $consultaAlumno->get_result();

if ($resultadoAlumno->num_rows > 0) 
{
    $row = $resultadoAlumno->fetch_assoc();
    $nombre = htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8');
    $apellido1 = htmlspecialchars($row['Apellido_1'], ENT_QUOTES, 'UTF-8');
    $apellido2 = htmlspecialchars($row['Apellido_2'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($row['Correo_elec'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($row['Estado'], ENT_QUOTES, 'UTF-8');
    $rol = 'alumno';
    $consultaAlumno->close();
} 
else 
{
    $profesorBd = "SELECT Nombre, Apellido_1, Apellido_2, Tel, Correo_elec 
                    FROM PROFESORES 
                    WHERE Nombre_User = ?";
    $consultaProfesor = $conexion->prepare($profesorBd);
    if (!$consultaProfesor) 
    {
        die('Error en la consulta: ' . $conexion->error);
    }
    $consultaProfesor->bind_param("s", $username);
    $consultaProfesor->execute();
    $resultadoProfesor = $consultaProfesor->get_result();

    if ($resultadoProfesor->num_rows > 0) 
    {
        $row = $resultadoProfesor->fetch_assoc();
        $nombre = htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8');
        $apellido1 = htmlspecialchars($row['Apellido_1'], ENT_QUOTES, 'UTF-8');
        $apellido2 = htmlspecialchars($row['Apellido_2'], ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($row['Correo_elec'], ENT_QUOTES, 'UTF-8');
        $rol = 'profesor';
        $consultaProfesor->close();
    } 
    else 
    {
        error_log("No se encontraron datos para el usuario $username");
    }
}

$rutaFotoGenerica = '../fotos_perfil/generica.png';
$rutaFotoUsuario = '';
$extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

foreach ($extensionesPermitidas as $extension) 
{
    $rutaFotoUsuario = "../fotos_perfil/Foto_Perfil_" . $username . ".$extension";
    if (file_exists($rutaFotoUsuario)) 
    {
        break;
    }
}

if (!file_exists($rutaFotoUsuario)) 
{
    error_log("Foto de perfil no encontrada para $username");
    $rutaFotoUsuario = $rutaFotoGenerica;
} 
else 
{
    error_log("Foto de perfil encontrada: $rutaFotoUsuario");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiOfertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Proyecto/CSS/perfil.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Proyecto/index.php">WikiOfertas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/perfil.php"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/ofertas.php">Ofertas</a>
                </li>
                <?php if ($rol == 'profesor'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/altaOferta.php">Crear Oferta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/listaAlumnos.php">Lista Alumnos</a>
                </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (!empty($username)): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/Proyecto/PHP/cierraSesion.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    <form id="logout-form" action="/Proyecto/PHP/cierraSesion.php" method="POST" style="display: none;">
                        <input type="hidden" name="cerrar_sesion">
                    </form>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?php echo $rutaFotoUsuario; ?>" alt="Foto de perfil" class="perfil-img">
                    <h5 class="card-title"><?php echo $nombre ? "$nombre $apellido1 $apellido2" : 'Nombre no disponible'; ?></h5>
                    <p class="card-text"><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                    <p class="card-text"><strong>Correo Electrónico:</strong> <?php echo $correo; ?></p>
                    <?php if ($rol == 'alumno' && !empty($estado)): ?>
                        <p class="card-text"><strong>Estado:</strong> <?php echo $estado; ?></p>
                    <?php endif; ?>
                    <a href="modificaPerfil.php" class="btn btn-primary">Modificar Perfil</a>
                    <?php if ($rol == 'alumno'): ?>
                    <a href="ofertaFavorita.php" class="btn btn-primary">Ofertas Favoritas</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
