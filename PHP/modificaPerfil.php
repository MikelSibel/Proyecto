<?php
include 'sesion.php';
include 'conexion.php';
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) {
    header("Location: iniciaSesion.php");
    exit;
}

$telefono = '';
$estado = '';
$foto = '';
$esAlumno = false; // Variable para determinar si es alumno

// Verificar si es alumno
$sqlAlumno = "SELECT Tel, Estado, Foto FROM ALUMNOS WHERE Nombre_User = ?";
$stmtAlumno = $conexion->prepare($sqlAlumno);
$stmtAlumno->bind_param("s", $username);
$stmtAlumno->execute();
$resultAlumno = $stmtAlumno->get_result();

if ($resultAlumno->num_rows > 0) {
    $row = $resultAlumno->fetch_assoc();
    $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($row['Estado'], ENT_QUOTES, 'UTF-8');
    $foto = htmlspecialchars($row['Foto'], ENT_QUOTES, 'UTF-8');
    $esAlumno = true; // Marcar como alumno encontrado
    $stmtAlumno->close();
}

// Si no es alumno, verificar si es profesor
if (!$esAlumno) {
    $sqlProfesor = "SELECT Tel, Foto FROM PROFESORES WHERE Nombre_User = ?";
    $stmtProfesor = $conexion->prepare($sqlProfesor);
    $stmtProfesor->bind_param("s", $username);
    $stmtProfesor->execute();
    $resultProfesor = $stmtProfesor->get_result();

    if ($resultProfesor->num_rows > 0) {
        $row = $resultProfesor->fetch_assoc();
        $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
        $foto = htmlspecialchars($row['Foto'], ENT_QUOTES, 'UTF-8');
    }
    $stmtProfesor->close();
}

// Procesar la actualización de datos si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se envió un archivo de foto
    if (!empty($_FILES['fotoPerfil']['name'])) {
        include 'cambiarFoto.php'; // Incluir el código de cambiarFoto.php para procesar la subida de la foto
    }

    $nuevoTelefono = $_POST['telefono'] ?? '';
    $nuevoEstado = $_POST['estado'] ?? '';

    // Actualizar los datos en la base de datos
    if ($esAlumno) {
        $sqlActualizar = "UPDATE ALUMNOS SET Tel = ?, Estado = ? WHERE Nombre_User = ?";
        $stmtActualizar = $conexion->prepare($sqlActualizar);
        $stmtActualizar->bind_param("sss", $nuevoTelefono, $nuevoEstado, $username);
        $stmtActualizar->execute();
    } else {
        $sqlActualizar = "UPDATE PROFESORES SET Tel = ? WHERE Nombre_User = ?";
        $stmtActualizar = $conexion->prepare($sqlActualizar);
        $stmtActualizar->bind_param("ss", $nuevoTelefono, $username);
        $stmtActualizar->execute();
    }

    // Redireccionar de nuevo al perfil después de la actualización
    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Perfil</title>
    <link href="../CSS/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: cyan;
        }
    </style>
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
    <h1>Modificar Perfil</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <?php if ($esAlumno): ?>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="Estudiando" <?php if ($estado === "Estudiando") echo "selected"; ?>>Estudiando</option>
                                <option value="Trabajando" <?php if ($estado === "Trabajando") echo "selected"; ?>>Trabajando</option>
                                <option value="Disponible" <?php if ($estado === "Disponible") echo "selected"; ?>>Disponible</option>
                                <option value="No Molestar" <?php if ($estado === "No Molestar") echo "selected"; ?>>No Molestar</option>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="fotoPerfil" class="form-label">Cambiar Foto de Perfil</label>
                            <input type="file" class="form-control" id="fotoPerfil" name="fotoPerfil">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+UJ0ZXaVgIKUR3M6ZPj0OdyaIlTg1" crossorigin="anonymous"></script>
<script src="../JS/script.js"></script>
</body>
</html>
