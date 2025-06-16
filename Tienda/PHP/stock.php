<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listaProducto.php");
    exit();
}

$id_producto = $_GET['id'];

$sql = mysqli_query($conexion, "SELECT * FROM STOCK WHERE ID_Producto = $id_producto");
$resultado = mysqli_num_rows($sql);
?>
<!DOCTYPE html>
<html lang="es">
<?php include "header.php"; ?>
<body>
<?php include "nav1.php"; ?>
<?php include "nav2.php"; ?>

<div class="contenedor">

    <h2>Stock del producto</h2>
    <?php if ($resultado > 0): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Unidades</th>
                <th>Color</th>
                <th>Talla</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($item = mysqli_fetch_assoc($sql)) {
                echo "<tr>";
                echo "<td>" . $item['Unidades'] . "</td>";
                echo "<td>" . $item['Color'] . "</td>";
                echo "<td>" . $item['Talla'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No hay stock para este producto.</p>
    <?php endif; ?>

    <h2>Añadir Stock</h2>

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

    <form action="guardarStock.php" method="POST">
        <input type="hidden" name="id_producto" value="<?= $id_producto ?>">

        <label for="unidades">Unidades:</label><br>
        <input type="number" name="unidades" min="0"><br>

        <label for="color">Color:</label><br>
        <select name="color" required>
            <option value="Negro">Negro</option>
            <option value="Blanco">Blanco</option>
            <option value="Azul">Azul</option>
            <option value="Rojo">Rojo</option>
            <option value="Verde">Verde</option>
        </select><br>

        <label for="talla">Talla:</label><br>
        <select name="talla" required>
            <option value="XXS">XXS</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
            <option value="XXXL">XXXL</option>
        </select><br><br>

        <button type="submit" class="button">Añadir Stock</button>
        <a href="listaProducto.php">Atrás</a>
    </form>

</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
