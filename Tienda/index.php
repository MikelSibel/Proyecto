<!DOCTYPE html>
<html lang="es">
<?php include "./PHP/header.php";?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Tienda/PHP/inicio.php">Golden Cotton</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/Tienda/PHP/perfil.php"><?php echo empty($_SESSION['Nombre']) ? 'Perfil' : $_SESSION['Nombre']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/categoria.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/carrito.php">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/inicioSesion.php">Inicio de Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="imagenes/carrusel1.webp">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imagenes/carrusel2.webp">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imagenes/carrusel3.webp">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container mt-5">
    
</div>
<?php include "./PHP/footer.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
