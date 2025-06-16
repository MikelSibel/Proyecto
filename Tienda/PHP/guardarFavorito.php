<?php
include 'conexionBD.php';
session_start();

if (empty($_GET['id'])) {
    header("Location: ./categoria.php");
    exit();
}

$idProducto = $_GET['id'];
$dniUsuario = $_SESSION['DNI'];

$sql = mysqli_query($conexion, "SELECT * FROM PRODUCTOS_FAVORITOS WHERE ID_Producto = '$idProducto' AND DNI = '$dniUsuario'");
$result = mysqli_num_rows($sql);

if ($result > 0) {
    header("Location: ./producto.php?id=$idProducto&error=El producto ya está añadido a favoritos");
    exit();
}

$sqlInsert = mysqli_query($conexion, "INSERT INTO PRODUCTOS_FAVORITOS (ID_Producto, DNI) VALUES ('$idProducto', '$dniUsuario')");

if ($sqlInsert) {
    header("Location: ./producto.php?id=$idProducto&success=Producto añadido a favoritos");
} else {
    header("Location: ./producto.php?id=$idProducto&error=Error al añadir a favoritos");
}
?>
