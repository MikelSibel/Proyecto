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
<?php include "nav2.php";?>
<div class="container mt-5">
    <h2>Lista de la compra</h2>
    <div id="lista-carrito"></div>
    <div class="row my-4">
        <div class="col-md-8 offset-md-4">
            <h3>Total a pagar:</h3>
            <p><strong>Total productos:</strong> <span id="total-productos"></span></p>
            <p><strong>Total envío:</strong> <span id="total-envio"></span></p>
            <h3><strong>Total final:</strong> <span id="total-final"></span></h3>
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
            <form method="post" action="guardarPedido.php" id="form-pedido">
                <input type="hidden" name="carrito_json" id="carrito_json" value="">
                <button type="submit" class="btn btn-success w-100 mt-3">Pagar ahora</button>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php";?>

<script src="../JS/listarCarrito.js"></script>

<script>
document.getElementById('form-pedido').addEventListener('submit', function(event){
    const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
    if(Object.keys(carrito).length === 0){
        event.preventDefault();
        return false;
    }
    document.getElementById('carrito_json').value = JSON.stringify(carrito);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
