<?php
include 'conexion.php'; // Ajusta la ruta según la ubicación real de conexion.php
include 'sesion.php';   // Ajusta la ruta según la ubicación real de sesion.php

// Función para verificar sesión
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';
$rol = '';

if (empty($username)) {
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}

// Verificar el rol del usuario
$sqlAlumno = "SELECT * FROM ALUMNOS WHERE Nombre_User = '$username'";
$resultAlumno = mysqli_query($conexion, $sqlAlumno);

if (mysqli_num_rows($resultAlumno) > 0) {
    $rol = 'alumno';
} else {
    // Verificar si el usuario es un profesor
    $sqlProfesor = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
    $resultProfesor = mysqli_query($conexion, $sqlProfesor);

    if (mysqli_num_rows($resultProfesor) > 0) {
        $rol = 'profesor';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : 'Crear Oferta'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Proyecto/CSS/style.css">
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
  <h1>Crear Oferta</h1>
  <div class="row">
    <div class="col-md-6">
      <form action="/Proyecto/PHP/guardarOferta.php" method="POST">
        <div class="mb-3">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
          <label for="modalidad">Modalidad:</label>
          <select class="form-control" id="modalidad" name="modalidad" required>
            <option value="Remoto">Remoto</option>
            <option value="Presencial">Presencial</option>
            <option value="Mixto">Mixto</option>
            <option value="No Especificado">No Especificado</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="horario">Horario:</label>
          <input type="text" class="form-control" id="horario" name="horario" required>
        </div>
        <div class="mb-3">
          <label for="ubicacion">Ubicación:</label>
          <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
        </div>
        <div class="mb-3">
          <label for="niv_educ">Nivel Educativo:</label>
          <input type="text" class="form-control" id="niv_educ" name="niv_educ" required>
        </div>
        <div class="mb-3">
          <label for="salario">Salario:</label>
          <input type="number" step="0.01" class="form-control" id="salario" name="salario">
        </div>
        <div class="mb-3">
          <label for="moneda">Moneda:</label>
          <input type="text" class="form-control" id="moneda" name="moneda">
        </div>
        <div class="mb-3">
          <label for="empresa">Empresa:</label>
          <input type="text" class="form-control" id="empresa" name="empresa" required>
        </div>
        <div class="mb-3">
          <label for="idioma_of">Idioma Ofrecido:</label>
          <input type="text" class="form-control" id="idioma_of" name="idioma_of" required>
        </div>
        <div class="mb-3">
          <label for="ex_re">Experiencia Requerida:</label>
          <input type="text" class="form-control" id="ex_re" name="ex_re" required>
        </div>
        <div class="mb-3">
          <label for="descripcion">Descripción:</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear Oferta</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+UJ0ZXaVgIKUR3M6ZPj0OdyaIlTg1" crossorigin="anonymous"></script>
</body>
</html>
