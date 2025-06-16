<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();

$dni = $_SESSION['DNI']; 

$sql = mysqli_query($conexion, "SELECT P.* FROM PRODUCTO P INNER JOIN PRODUCTOS_FAVORITOS PF ON P.ID_Producto = PF.ID_Producto WHERE PF.DNI = '$dni'");

$favoritos = [];
if ($sql) {
    while ($fila = mysqli_fetch_assoc($sql)) {
        $favoritos[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php";?>
<?php include "nav2.php";?>

<div class="container mt-5">
    <h3 class="mb-4">Mis Productos Favoritos</h3>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
            <?php foreach ($favoritos as $producto): ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card text-decoration-none h-100">
                        <img src="<?php echo $producto['Imagen1']; ?>" class="card-img-top" alt="Imagen producto">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark"><?php echo $producto['Nombre']; ?></h5>
                            <p class="card-text fw-bold"><?php echo $producto['Precio']; ?>€</p>
                            <a href="./producto.php?id=<?php echo $producto['ID_Producto']; ?>" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                Ver Producto
                            </a>
                            <form action="eliminarFavorito.php" method="POST">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['ID_Producto']; ?>">
                                <button type="submit"class='btn btn-outline-primary'>Eliminar Favorito</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
