<?php
session_start();
include_once('conexionBD.php');

if (
    isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['categoria']) && isset($_POST['precio']) && isset($_POST['iva']) && isset($_POST['promocionado'])
) {
    function validar($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    $id = validar($_POST['id']);
    $nombre = validar($_POST['nombre']);
    $categoria = validar($_POST['categoria']);
    $precio = validar($_POST['precio']);
    $iva = validar($_POST['iva']);
    $promocionado = $_POST['promocionado'];
    $descripcion = isset($_POST['descripcion']) ? validar($_POST['descripcion']) : '';

    if (empty($nombre)) {
        header("Location: ./editarProducto.php?id=$id&error=El nombre es requerido");
        exit();
    } elseif (empty($categoria)) {
        header("Location: ./editarProducto.php?id=$id&error=La categoría del Producto es requerida");
        exit();
    } elseif (empty($precio)) {
        header("Location: ./editarProducto.php?id=$id&error=El precio del Producto es requerido");
        exit();
    } elseif (empty($iva)) {
        header("Location: ./editarProducto.php?id=$id&error=El IVA del Producto es requerido");
        exit();
    } else {
        $sql = "SELECT * FROM PRODUCTO WHERE Nombre = '$nombre' AND ID_Producto != $id";
        $query = $conexion->query($sql);
        if (mysqli_num_rows($query) > 0) {
            header("Location: ./editarProducto.php?id=$id&error=Nombre del Producto ya registrado");
            exit();
        } else {
            $destino = '../imagenes/';

            $sqlImg = "SELECT Imagen1, Imagen2, Imagen3 FROM PRODUCTO WHERE ID_Producto = $id";
            $resImg = $conexion->query($sqlImg);
            $imagenes = $resImg->fetch_assoc();

            $imagen1 = $imagenes['Imagen1'];
            if (isset($_FILES['imagen1']) && $_FILES['imagen1']['error'] === 0) {
                if ($imagen1 != '') unlink($imagen1);
                $img1 = $_FILES['imagen1'];
                $tmp1 = $img1['tmp_name'];
                $imagenNombre1 = 'img1_' . md5(date('d-m-Y H:i:s'));
                $imagen1 = $destino . $imagenNombre1 . '.jpg';
                move_uploaded_file($tmp1, $imagen1);
            }

            $imagen2 = $imagenes['Imagen2'];
            if (isset($_FILES['imagen2']) && $_FILES['imagen2']['error'] === 0) {
                if ($imagen2 != '') unlink($imagen2);
                $img2 = $_FILES['imagen2'];
                $tmp2 = $img2['tmp_name'];
                $imagenNombre2 = 'img2_' . md5(date('d-m-Y H:i:s'));
                $imagen2 = $destino . $imagenNombre2 . '.jpg';
                move_uploaded_file($tmp2, $imagen2);
            }

            $imagen3 = $imagenes['Imagen3'];
            if (isset($_FILES['imagen3']) && $_FILES['imagen3']['error'] === 0) {
                if ($imagen3 != '') unlink($imagen3);
                $img3 = $_FILES['imagen3'];
                $tmp3 = $img3['tmp_name'];
                $imagenNombre3 = 'img3_' . md5(date('d-m-Y H:i:s'));
                $imagen3 = $destino . $imagenNombre3 . '.jpg';
                move_uploaded_file($tmp3, $imagen3);
            }

            $sql = "UPDATE PRODUCTO SET Nombre = '$nombre', Categorias = '$categoria', Precio = $precio, IVA = $iva, Es_Promocionado = $promocionado, Imagen1 = '$imagen1', Imagen2 = '$imagen2', Imagen3 = '$imagen3', Descripcion = '$descripcion' WHERE ID_Producto = $id";

            $resultado = $conexion->query($sql);

            if ($resultado) {
                header("Location: ./editarProducto.php?id=$id&success=Producto actualizado");
                exit();
            } else {
                header("Location: ./editarProducto.php?id=$id&error=Error al actualizar el producto");
                exit();
            }
        }
    }
} else {
    header("Location: ./editarProducto.php?error=Faltan Datos");
    exit();
}
?>
