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
<?php  
include "nav2.php";
?>
    <div class="contenedor">
        <form action="guardarProducto.php" method="POST" enctype="multipart/form-data">
            <h2>Registrar Producto</h2>

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

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" placeholder="Nombre">

            <label for="nombre">Categoria del Producto:</label><br>
            <select name="categoria">
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria ?>" 
                        <?= (isset($_GET['categoria']) && $_GET['categoria'] == $categoria) ? 'selected' : '' ?>>
                        <?= $categoria ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="nombre">Precio del Producto:</label>
            <input type="number" name="precio" placeholder="Precio" min="0" step=".01">

            <label for="iva">IVA:</label>
            <input type="number" name="iva" placeholder="IVA">

            <label for="promocionado">Promocionado</label><br>
            <select name="promocionado">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select><br>

            <label for="nombre">Primera imagen del Producto:</label>
            <input type="file" name="imagen1">

            <label for="nombre">Segunda imagen del Producto:</label>
            <input type="file" name="imagen2">

            <label for="nombre">Tercera imagen del Producto:</label>
            <input type="file" name="imagen3">

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" placeholder="Descripción del producto">
            <br>
            <button type="submit" class="button">Nuevo Producto</button>
            <button type="reset" class="button">Borrar</button>
        </form>
    </div>
    <?php include "footer.php";?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
