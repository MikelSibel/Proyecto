<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();

if (empty($_GET['id'])) {
    header('Location: perfil.php');
    exit();
}
$dni = $_SESSION['DNI'];
$sql = mysqli_query($conexion, "SELECT * FROM PEDIDOS WHERE DNI = '$dni' ORDER BY ID ASC");
$resultado = mysqli_num_rows($sql);
?>

<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php"; ?>
<?php include "nav2.php"; ?>

<div class="container mt-5">
    <h2>Lista de Pedidos</h2>
        <?php
            if ($resultado) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>DNI</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado > 0) {
                    while ($pedido = mysqli_fetch_assoc($sql)) {
                        echo "<tr>";
                        echo "<td>" . $pedido['Nombre'] . "</td>";
                        echo "<td>" . $pedido['Estado'] . "</td>";
                        echo "<td>" . $pedido['Fecha'] . "</td>";
                        echo "<td>" . $pedido['Descripcion'] . "</td>";
                        echo "<td>" . $pedido['DNI'] . "</td>";
                        echo "<td>" . $pedido['Direccion'] . "</td>";
                        echo "<td>" . "<a href='pedidos.php' class='btn btn-outline-primary btn-edit-profile'>Detalles</a>" . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    <?php }else { ?>
            <p>No tienes Pedidos Haz una compra YA!!</p>
    <?php } ?>
</div>
<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
