<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $dni = $_SESSION['DNI']; 
    $idProducto = $_POST['id_producto'];

    $sql = mysqli_query($conexion, "DELETE FROM PRODUCTOS_FAVORITOS WHERE DNI = '$dni' AND ID_Producto = $idProducto");
}

header("Location: favoritos.php");
exit();
?>
