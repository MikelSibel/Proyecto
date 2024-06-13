<?php
include 'sesion.php';
include 'conexion.php'; 
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) {
    header("Location: iniciaSesion.php");
    exit;
}


$sql = "SELECT * FROM ALUMNOS WHERE Nombre_User = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8');
    $apellido1 = htmlspecialchars($row['Apellido_1'], ENT_QUOTES, 'UTF-8');
    $apellido2 = htmlspecialchars($row['Apellido_2'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($row['Tel'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($row['Estado'], ENT_QUOTES, 'UTF-8');
    $foto = htmlspecialchars($row['Foto'], ENT_QUOTES, 'UTF-8'); // Obtener la ruta de la foto de perfil
    
} else {
    
    $nombre = 'Nombre no encontrado';
    $apellido1 = '';
    $apellido2 = '';
    $telefono = '';
    $estado = '';
    $foto = ''; 
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombre ? $nombre : 'Perfil'; ?></title>
    <link href="../CSS/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .perfil-img {
            width: 150px; 
            height: 150px;
            object-fit: cover;
            border-radius: 50%; 
            margin-bottom: 20px;
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
    <h1><?php echo $nombre ? $nombre : 'Perfil'; ?></h1>
    <ul>
        <li><strong>Nombre:</strong> <?php echo $nombre; ?></li>
        <li><strong>Apellido 1:</strong> <?php echo $apellido1; ?></li>
        <li><strong>Apellido 2:</strong> <?php echo $apellido2; ?></li>
        <li><strong>Teléfono:</strong> <?php echo $telefono; ?></li>
        <li><strong>Estado:</strong> <?php echo $estado; ?></li>
    </ul>

    <?php if ($foto): ?>
    <img src="<?php echo $foto; ?>" alt="Foto de perfil" class="perfil-img">
    <?php else: ?>
    <p>No se ha cargado una foto de perfil.</p>
    <?php endif; ?>

    <form action="cambiarFoto.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fotoPerfil" class="form-label">Cambiar Foto de Perfil</label>
            <input class="form-control" type="file" id="fotoPerfil" name="fotoPerfil">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+UJ0ZXaVgIKUR3M6ZPj0OdyaIlTg1" crossorigin="anonymous"></script>
<script src="../JS/script.js"></script>
</body>
</html>
