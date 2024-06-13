<?php
include 'conexion.php';
include 'sesion.php';

comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : null;

if (isset($_GET['id'])) 
{
    $id_oferta = $_GET['id'];

    $sql = "SELECT * FROM OFERTAS WHERE CodOf = $id_oferta";
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) > 0) 
    {
        $oferta = mysqli_fetch_assoc($result);
    } 
    else 
    {
        echo "La oferta no existe.";
        exit;
    }
} else {
    echo "ID de oferta no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $oferta['Nombre']; ?></title>
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
  <div class="card">
    <div class="card-header">
      Detalles de la oferta
    </div>
    <div class="card-body">
      <h5 class="card-title"><?php echo $oferta['Nombre']; ?></h5>
      <p class="card-text"><strong>Modalidad:</strong> <?php echo $oferta['Modalidad']; ?></p>
      <p class="card-text"><strong>Horario:</strong> <?php echo $oferta['Horario']; ?></p>
      <p class="card-text"><strong>Ubicación:</strong> <?php echo $oferta['Ubicacion']; ?></p>
      <p class="card-text"><strong>Nivel educativo requerido:</strong> <?php echo $oferta['Niv_Educ']; ?></p>
      <p class="card-text"><strong>Salario:</strong> <?php echo '$' . number_format($oferta['Salario'], 2) . ' ' . $oferta['Moneda']; ?></p>
      <p class="card-text"><strong>Empresa:</strong> <?php echo $oferta['Empresa']; ?></p>
      <p class="card-text"><strong>Idioma:</strong> <?php echo $oferta['Idioma_Of']; ?></p>
      <p class="card-text"><strong>Experiencia requerida:</strong> <?php echo $oferta['Ex_Re']; ?></p>
      <p class="card-text"><strong>Descripción:</strong> <?php echo $oferta['Descripcion']; ?></p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+UJ0ZXaVgIKUR3M6ZPj0OdyaIlTg1" crossorigin="anonymous"></script>
</body>
</html>
