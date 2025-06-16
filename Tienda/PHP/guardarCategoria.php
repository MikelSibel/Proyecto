<?php
session_start();
include 'conexionBD.php';

if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO CATEGORIAS(categorias) VALUES('$categoria')";
    $query = mysqli_query($conexion, $sql);

    if ($query) {
        header("Location: nuevaCategoria.php?success=Categoria guardada");
        exit();
    } else {
        header("Location: nuevaCategoria.php?error=Categoria Existente");
        exit();
    }
} else {
    header("Location: nuevaCategoria.php?error=Categoria vacia");
    exit();
}
?>
