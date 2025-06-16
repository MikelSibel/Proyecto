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

$id = $_GET['id'];
$sqlProducto = "SELECT * FROM PRODUCTO WHERE ID_Producto = $id";
$resultProducto = $conexion->query($sqlProducto);
$producto = $resultProducto->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php";?>
<?php include "nav2.php";?>
    <div class="contenedor">
        <form action="guardarEditarProducto.php" method="POST" enctype="multipart/form-data">
            <h2>Editar Producto</h2>

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

            <input type="hidden" name="id" value="<?= $producto['ID_Producto'] ?>">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" value="<?= $producto['Nombre'] ?>" placeholder="Nombre">

            <label for="nombre">Categoria del Producto:</label><br>
            <select name="categoria">
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria ?>" <?= ($producto['Categorias'] == $categoria) ? 'selected' : '' ?>>
                        <?= $categoria ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="nombre">Precio del Producto:</label>
            <input type="number" name="precio" value="<?= $producto['Precio'] ?>" placeholder="Precio" min="0" step=".01">

            <label for="iva">IVA:</label>
            <input type="number" name="iva" value="<?= $producto['IVA'] ?>" placeholder="IVA">

            <label for="promocionado">Promocionado</label><br>
            <select name="promocionado">
                <option value="0" <?= ($producto['Es_Promocionado'] == 0) ? 'selected' : '' ?>>No</option>
                <option value="1" <?= ($producto['Es_Promocionado'] == 1) ? 'selected' : '' ?>>Sí</option>
            </select><br>

            <label for="nombre">Primera imagen del Producto:</label>
            <input type="file" name="imagen1">

            <label for="nombre">Segunda imagen del Producto:</label>
            <input type="file" name="imagen2">

            <label for="nombre">Tercera imagen del Producto:</label>
            <input type="file" name="imagen3">

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" value="<?= $producto['Descripcion'] ?>" placeholder="Descripción del producto">
            <br>
            <button type="submit" class="button">Guardar Cambios</button>
            <a class="a" href="listaProducto.php">Atras</a>
        </form>
    </div>
<?php include "footer.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
