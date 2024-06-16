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

$consultaProfesor = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
$resultadoProfesor = mysqli_query($conexion, $consultaProfesor);

if (mysqli_num_rows($resultadoProfesor) > 0) 
{
    $rol = 'profesor';
    $profesor_row = mysqli_fetch_assoc($resultadoProfesor);
    $profesor_id = $profesor_row['Nombre_User'];
}

$alumnos = [];
$consultaAlumno = "SELECT Nombre, Apellido_1, Apellido_2, Tel, Foto, Estado FROM ALUMNOS";
$resultadoAlumno = mysqli_query($conexion, $consultaAlumno);

if ($resultadoAlumno) 
{
    while ($row = mysqli_fetch_assoc($resultadoAlumno)) 
    {
        $alumnos[] = $row;
    }
} 
else 
{
    $alumnos = ['error' => 'Error al obtener la lista de alumnos'];
}
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiOfertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <form class="d-flex" id="formBusqueda">
                <input id="inputBusqueda" class="form-control me-2" type="search" placeholder="Buscar por nombre" aria-label="Buscar">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
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
    <h1 class="titulo">Lista de Alumnos</h1>
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="formFiltrarEstado">
                <div class="input-group">
                    <label for="filtroEstado" class="input-group-text">Filtrar por Estado:</label>
                    <select class="form-select" id="filtroEstado" name="filtroEstado">
                        <option value="">Todos los estados</option>
                        <option value="Estudiando">Estudiando</option>
                        <option value="Trabajando">Trabajando</option>
                        <option value="Disponible">Disponible</option>
                        <option value="No Molestar">No Molestar</option>
                    </select>
                    <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
    <div id="alumnos" class="row"></div>
    <nav>
        <ul id="pagination" class="pagination justify-content-center mt-4"></ul>
    </nav>
</div>
<script>    const alumnos = <?php echo json_encode($alumnos); ?>; </script>
<script src="../JS/paginacionAlumnos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
