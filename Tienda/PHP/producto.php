<?php
include 'conexionBD.php';

if (empty($_GET['id'])) {
    header('Location: categoria.php');
    exit();
}

$id = $_GET['id'];
$sql = mysqli_query($conexion, "SELECT * FROM PRODUCTO WHERE ID_Producto = '$id'");
$resultado = mysqli_num_rows($sql);
$producto = [];

if ($resultado == 0) {
    header('Location: categoria.php');
    exit();
} else {
    $producto = mysqli_fetch_assoc($sql);
}

$sqlValoraciones = mysqli_query($conexion, "SELECT V.*, U.Nombre, U.Apellido FROM VALORACIONES V JOIN USUARIO U ON V.DNI = U.DNI WHERE V.ID_Producto = '$id' ORDER BY V.Fecha DESC");
$valoraciones = [];
if ($sqlValoraciones) {
    while ($fila = mysqli_fetch_assoc($sqlValoraciones)) {
        $valoraciones[] = $fila;
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
    <div class="row">
        <div class="container mt-5">
    <div class="row">
        <div class="col-md-1 mb-1 d-flex flex-column" id="thumbs">
            <?php if (!empty($producto['Imagen1'])) { ?>
                <a href="<?php echo $producto['Imagen1']; ?>">
                    <img src="<?php echo $producto['Imagen1']; ?>" class="img-thumbnail mb-2">
                </a>
            <?php } ?>
            <?php if (!empty($producto['Imagen2'])) { ?>
                <a href="<?php echo $producto['Imagen2']; ?>">
                    <img src="<?php echo $producto['Imagen2']; ?>" class="img-thumbnail mb-2">
                </a>
            <?php } ?>
            <?php if (!empty($producto['Imagen3'])) { ?>
                <a href="<?php echo $producto['Imagen3']; ?>">
                    <img src="<?php echo $producto['Imagen3']; ?>" class="img-thumbnail mb-2">
                </a>
            <?php } ?>
        </div>

        <div class="col-md-3 mb-3">
            <img id="largeImg" src="<?php echo $producto['Imagen1']; ?>" class="img-fluid" alt="Imagen principal">
        </div>
        <div class="col-md-8 mb-4">
            <h3 class="text-dark"><?php echo $producto['Nombre'];?></h3>
            <p class="text-muted"><?php echo $producto['Descripcion'];?></p>
            <p class="fw-bold"><?php echo $producto['Precio'];?>€</p>
            <button id="anadirCarrito" class="btn btn-outline-primary btn-sm w-100" data-id="<?php echo $producto['ID_Producto']; ?>" data-nombre="<?php echo $producto['Nombre']; ?>" data-descripcion="<?php echo $producto['Descripcion']; ?>" data-precio="<?php echo $producto['Precio']; ?>" data-imagen="<?php echo $producto['Imagen1']; ?>">Añadir a Carrito</button>
            <?php 
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                if (isset($_SESSION['activa']) && $_SESSION['activa'] == true) { 
            ?>
            <a href="./guardarFavorito.php?id=<?php echo $producto['ID_Producto']; ?>" class="btn btn-outline-primary btn-sm w-100">
                Añadir a Favoritos
            </a>
            <br>
            <br>
            <?php } ?>
            <?php
                if (isset($_GET['error'])) {
                    ?>
                    <p class="error">
                        <?php
                        echo $_GET['error'];
                        ?>
                    </p>
            <?php      
                }
            ?>
            <?php
                if (isset($_GET['success'])) {
                    ?>
                    <p class="success">
                        <?php
                        echo $_GET['success'];
                        ?>
                    </p>
            <?php      
                }
            ?>
        </div>
    </div>
    <h3>Valoraciones</h3>
    <?php foreach ($valoraciones as $val) { 
    $estrellas = (int)$val['Estrellas'];
    ?>
    <div class="card mb-3">
        <div class="col-md-3 mb-4">
            <div class="mb-3 text-warning">
                <?php
                    for ($i = 0; $i < $estrellas; $i++) {
                        echo '★';
                    }
                    for ($i = $estrellas; $i < 5; $i++) {
                        echo '☆';
                    }
                ?>
            </div>
            <p><?php echo htmlspecialchars($val['Comentario']); ?></p>
            <small class="text-muted">Usuario: <?php echo htmlspecialchars($val['Nombre'] . ' ' . $val['Apellido']); ?></small><br>
            <small class="text-muted">Fecha: <?php echo htmlspecialchars($val['Fecha']); ?></small>
        </div>
    </div>
    <?php } ?>

</div>

<?php include "footer.php";?>
<script src="../JS/cambiarImagen.js"></script>
<script src="../JS/anadirCarrito.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
