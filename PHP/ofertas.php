<?php
include 'conexion.php';
include 'sesion.php';
comprobar_sesion();

$username = $_SESSION['usuario']['nombre_usuario'] ?? '';
$rol = '';
$profesor_id = '';

if (empty($username)) 
{
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}

$consultaAlumno = "SELECT * FROM ALUMNOS WHERE Nombre_User = '$username'";
$resultadoAlumno = mysqli_query($conexion, $consultaAlumno);

if (mysqli_num_rows($resultadoAlumno) > 0) 
{
    $rol = 'alumno';
} 
else 
{
    $consultaProfesor = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
    $resultadoProfesor = mysqli_query($conexion, $consultaProfesor);
    if (mysqli_num_rows($resultadoProfesor) > 0) 
    {
        $rol = 'profesor';
        $profesor_row = mysqli_fetch_assoc($resultadoProfesor);
        $profesor_id = $profesor_row['Nombre_User'];
    }
}

$consultaOfertas = "SELECT * FROM OFERTAS";
$resultadoOfertas = mysqli_query($conexion, $consultaOfertas);
$ofertas = [];

if (mysqli_num_rows($resultadoOfertas) > 0) 
{
    while ($row = mysqli_fetch_assoc($resultadoOfertas)) 
    {
        $ofertas[] = $row;
    }
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
    <h1 class="titulo">Ofertas</h1>
    <div id="ofertas" class="row"></div>
    <nav>
        <ul id="pagination" class="pagination justify-content-center mt-4"></ul>
    </nav>
</div>
<script>
    const username = <?php echo json_encode($username); ?>;
    const rol = <?php echo json_encode($rol); ?>;
    const profesor_id = <?php echo json_encode($profesor_id); ?>;
    const ofertas = <?php echo json_encode($ofertas); ?>;
</script>
<script src="../JS/paginacionOfertas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_close($conexion);
?>
