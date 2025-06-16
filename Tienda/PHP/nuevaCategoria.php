<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();
$categorias = [];
$sql = "SELECT categorias FROM CATEGORIAS";
$result = $conexion->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row['categorias'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php";?>
<?php include "nav2.php";?>
<div class="contenedor">

        <h2>Categorías existentes:</h2>
        <ul style="list-style: none;">
        <?php
            foreach ($categorias as $cat) {
                echo "<li>$cat</li>";
            }
        ?>
        </ul>

        <h2>Añadir Producto</h2>
        <form action="guardarCategoria.php" method="POST">

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

            <label for="nombre">Nueva Categoria:</label>
            <input type="text" name="categoria">
            <br>
            <button type="submit" class="button">Nueva Categoria</button>
        </form>
</div>
<?php include "footer.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
