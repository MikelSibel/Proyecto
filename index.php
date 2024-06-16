<?php
include 'PHP/conexion.php'; 
include 'PHP/sesion.php'; 
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';
$rol = '';

if (empty($username)) 
{
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}

$profesor_id = '';
$alumnoConsulta = "SELECT * FROM ALUMNOS WHERE Nombre_User = '$username'";
$resultAlumno = mysqli_query($conexion, $alumnoConsulta);

if (mysqli_num_rows($resultAlumno) > 0) 
{
    $rol = 'alumno';
} 
else 
{
    $profesorConsulta = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
    $resultProfesor = mysqli_query($conexion, $profesorConsulta);

    if (mysqli_num_rows($resultProfesor) > 0) 
    {
        $rol = 'profesor';
        $profesor_row = mysqli_fetch_assoc($resultProfesor);
        $profesor_id = $profesor_row['Nombre_User'];
    }
}

$consulta = "SELECT * FROM OFERTAS WHERE Estado = true ORDER BY Popularidad DESC LIMIT 3";
$result = mysqli_query($conexion, $consulta);
$ofertas = [];

if (mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $ofertas[] = $row;
    }
}
$ofertas_json = json_encode($ofertas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiOfertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Proyecto/CSS/sesion.css">
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
    <h1 class="titulo">Ofertas Populares</h1>
    <div id="ofertas_populares" class="row"></div>
</div>
<script>
    let ofertas = <?php echo $ofertas_json; ?>;
    let rol = '<?php echo $rol; ?>';
    let profesor_id = '<?php echo $profesor_id; ?>';
</script>
<script src="JS/ofertasPopulares.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
