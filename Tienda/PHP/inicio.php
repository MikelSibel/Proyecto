<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php";?>
<?php  
include "nav2.php";
?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../imagenes/carrusel1.webp">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../imagenes/carrusel2.webp">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../imagenes/carrusel3.webp">
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

<?php
$sql = "SELECT * FROM PRODUCTO WHERE Es_Promocionado = 1";
$resultado = mysqli_query($conexion, $sql);
?>
<div class="container mt-5">
    <h2 class="mb-4">Productos Promocionados</h2>
    <div class="row">
        <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
            <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="<?= $producto['Imagen1'] ?>" class="card-img-top" alt="<?= $producto['Nombre'] ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $producto['Nombre'] ?></h5>
                            <p class="card-text text-truncate"><?= $producto['Descripcion'] ?></p>
                            <p class="fw-bold"><?= $producto['Precio'], 2 ?> €</p>
                            <a href="producto.php?id=<?= $producto['ID_Producto'] ?>" class="btn btn-primary mt-auto">Ver detalle</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay productos promocionados en este momento.</p>
        <?php endif; ?>
    </div>
</div>

<?php include "footer.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
