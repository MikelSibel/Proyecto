<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();

$sql = mysqli_query($conexion, "SELECT * FROM PRODUCTO ORDER BY ID_Producto ASC");
$resultado = mysqli_num_rows($sql);
?>

<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php"; ?>
<?php include "nav2.php"; ?>

<div class="container mt-5">
    <h2>Lista de Productos</h2>
        <?php
            if ($resultado) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Promoción</th>
                    <th>Categoría</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado > 0) {
                    while ($producto = mysqli_fetch_assoc($sql)) {
                        echo "<tr>";
                        echo "<td class='d-inline-block text-truncate' style='max-width: 250px;''>" . $producto['Nombre'] . "</td>";
                        echo "<td>" . $producto['Precio'] . "€" . "</td>";
                        echo "<td>" . ($producto['Es_Promocionado'] == 1 ? 'Sí' : 'No') . "</td>";
                        echo "<td>" . $producto['Categorias'] . "</td>";
                        echo "<td><a href='editarProducto.php?id=" . $producto['ID_Producto'] . "' class='btn btn-outline-primary'>Editar</a></td>";
                        echo "<td><a href='stock.php?id=" . $producto['ID_Producto'] . "' class='btn btn-outline-primary'>Stock</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    <?php }?>
</div>
<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
