<?php
include 'conexion.php';
include 'sesion.php';
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';
$rol = '';

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
    $sqlProfesor = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
    $resultProfesor = mysqli_query($conexion, $sqlProfesor);

    if (mysqli_num_rows($resultProfesor) > 0) 
    {
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
    <title>WikiOfertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Proyecto/CSS/oferta.css">
</head>
<body>
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
        <a href="/Proyecto/PHP/ofertas.php" class="btn btn-secondary">Volver a Ofertas</a>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
