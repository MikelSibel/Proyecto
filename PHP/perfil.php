<?php
include 'sesion.php';
include 'conexion.php';
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) {
    header("Location: iniciaSesion.php");
    exit;
}

$nombre = '';
$apellido1 = '';
$apellido2 = '';
$telefono = '';
$correo = '';
$estado = '';

// Consulta para obtener datos del alumno
$sqlAlumno = "SELECT Nombre, Apellido_1, Apellido_2, Tel, Correo_elec, Estado 
              FROM ALUMNOS 
              WHERE Nombre_User = ?";
$stmtAlumno = $conexion->prepare($sqlAlumno);
$stmtAlumno->bind_param("s", $username);
$stmtAlumno->execute();
$resultAlumno = $stmtAlumno->get_result();

if ($resultAlumno->num_rows > 0) {
    $row = $resultAlumno->fetch_assoc();
    $nombre = htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8');
    $apellido1 = htmlspecialchars($row['Apellido_1'], ENT_QUOTES, 'UTF-8');
    $apellido2 = htmlspecialchars($row['Apellido_2'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($row['Correo_elec'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($row['Estado'], ENT_QUOTES, 'UTF-8');
    $stmtAlumno->close();
} else {
    // Si no es alumno, verificar si es profesor u otro tipo de usuario
    $sqlProfesor = "SELECT Nombre, Apellido_1, Apellido_2, Tel, Correo_elec 
                    FROM PROFESORES 
                    WHERE Nombre_User = ?";
    $stmtProfesor = $conexion->prepare($sqlProfesor);
    if (!$stmtProfesor) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }
    $stmtProfesor->bind_param("s", $username);
    $stmtProfesor->execute();
    $resultProfesor = $stmtProfesor->get_result();

    if ($resultProfesor->num_rows > 0) {
        $row = $resultProfesor->fetch_assoc();
        $nombre = htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8');
        $apellido1 = htmlspecialchars($row['Apellido_1'], ENT_QUOTES, 'UTF-8');
        $apellido2 = htmlspecialchars($row['Apellido_2'], ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($row['Correo_elec'], ENT_QUOTES, 'UTF-8');
        // No hay columna 'Estado' en la tabla PROFESORES
        // $estado se deja vacío o se maneja de otra manera según sea necesario
        $estado = ''; // O puedes manejarlo según tu lógica de negocio
        $stmtProfesor->close();
    } else {
        error_log("No se encontraron datos de alumno ni profesor para el usuario $username");
        // Aquí puedes manejar qué hacer si no se encuentra al alumno ni al profesor, por ejemplo, redirigir o mostrar un mensaje de error.
    }
}

$rutaFotoGenerica = '../fotos_perfil/generica.png';
$rutaFotoUsuario = '';
$extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

foreach ($extensionesPermitidas as $extension) {
    $rutaFotoUsuario = "../fotos_perfil/Foto_Perfil_" . $username . ".$extension";
    if (file_exists($rutaFotoUsuario)) {
        break;
    }
}

// Verificación de la existencia de la foto del usuario
if (!file_exists($rutaFotoUsuario)) {
    error_log("Foto de perfil no encontrada para $username en ninguna de las extensiones permitidas.");
    $rutaFotoUsuario = $rutaFotoGenerica;
} else {
    error_log("Foto de perfil encontrada: $rutaFotoUsuario");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombre ? "$nombre $apellido1 $apellido2" : 'Perfil'; ?></title>
    <link href="../CSS/perfil.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Proyecto/index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/Proyecto/index.php">Menu</a>
                </li>
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
                <?php endif; ?>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/Proyecto/PHP/iniciaSesion.php">Inicio</a>
                </li>
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
                    <?php if (!empty($estado)): ?>
                        <p class="card-text"><strong>Estado:</strong> <?php echo $estado; ?></p>
                    <?php endif; ?>
                    <a href="modificaPerfil.php" class="btn btn-primary">Modificar Perfil</a>
                    <a href="ofertaFavorita.php" class="btn btn-primary">Oferta Favorita</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+UJ0ZXaVgIKUR3M6ZPj0OdyaIlTg1" crossorigin="anonymous"></script>
<script src="../JS/script.js"></script>
</body>
</html>