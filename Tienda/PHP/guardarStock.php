<?php
session_start();
include 'conexionBD.php';

if (
    isset($_POST['unidades']) && isset($_POST['color']) && isset($_POST['talla']) && isset($_POST['id_producto'])
) {
    function validar($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    $unidades = validar($_POST['unidades']);
    $color = validar($_POST['color']);
    $talla = validar($_POST['talla']);
    $id_producto = validar($_POST['id_producto']);

    if (!isset($_POST['unidades']) || $_POST['unidades'] === '') {
        header("Location: ./stock.php?id=$id_producto&error=Unidades requeridas");
        exit();
    } elseif (empty($color)) {
        header("Location: ./stock.php?id=$id_producto&error=Color requerido");
        exit();
    } elseif (empty($talla)) {
        header("Location: ./stock.php?id=$id_producto&error=Talla requerida");
        exit();
    } elseif (empty($id_producto)) {
        header("Location: ./stock.php?error=Producto inválido");
        exit();
    }else {
        $sql_check = "SELECT * FROM STOCK WHERE ID_Producto = $id_producto AND Color = '$color' AND Talla = '$talla'";
        $result_check = $conexion->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            $sql_update = "UPDATE STOCK SET Unidades = $unidades WHERE ID_Producto = $id_producto AND Color = '$color' AND Talla = '$talla'";
            if ($conexion->query($sql_update)) {
                header("Location: ./stock.php?id=$id_producto&success=Stock actualizado");
                exit();
            } else {
                header("Location: ./stock.php?id=$id_producto&error=Error al actualizar stock");
                exit();
            }
        } else {
            $sql_insert = "INSERT INTO STOCK (Unidades, Color, Talla, ID_Producto) VALUES ($unidades, '$color', '$talla', $id_producto)";
            if ($conexion->query($sql_insert)) {
                header("Location: ./stock.php?id=$id_producto&success=Stock agregado");
                exit();
            } else {
                header("Location: ./stock.php?id=$id_producto&error=Error al agregar stock");
                exit();
            }
        }
    }

} else {
    header("Location: ./stock.php?error=Datos incompletos");
    exit();
}
?>
