<?php
session_start();
include_once('conexionBD.php');

if (
    isset($_POST['nombre']) && isset($_POST['categoria']) && isset($_POST['precio']) && isset($_POST['iva']) && isset($_POST['promocionado']) && isset($_FILES['imagen1'])
) {
    function validar($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    $nombre = validar($_POST['nombre']);
    $categoria = validar($_POST['categoria']);
    $precio = validar($_POST['precio']);
    $iva = validar($_POST['iva']);
    $promocionado = $_POST['promocionado'];
    $descripcion = $_POST['descripcion'];

    if (empty($nombre)) {
        header("Location: ./crearProducto.php?error=El nombre es requerido");
        exit();
    }elseif (empty($categoria)) {
        header("Location: ./crearProducto.php?error=La categoría del Producto es requerida");
        exit();
    }elseif (empty($precio)) {
        header("Location: ./crearProducto.php?error=El precio del Producto es requerido");
        exit();
    }elseif (empty($iva)) {
        header("Location: ./crearProducto.php?error=El IVA del Producto es requerido");
        exit();
    }elseif ($_FILES['imagen1']['error'] !== 0) {
        header("Location: ./crearProducto.php?error=La Primera imagen del Producto es requerida");
        exit();
    }else {
        $sql = "SELECT * FROM PRODUCTO WHERE Nombre = '$nombre'";
        $query = $conexion->query($sql);
        if (mysqli_num_rows($query) > 0) {
            header("Location: ./crearProducto.php?error=Nombre del Producto ya registrado");
            exit();
        }else {
            $destino = '../imagenes/';

            $img1 = $_FILES['imagen1'];
            $imagen1 = $img1['name'];
            $tmp1 = $img1['tmp_name'];
            $imagenNombre1 = 'img1_' . md5(date('d-m-Y H:i:s'));
            $imagen1 = $imagenNombre1 . '.jpg';
            $src1 = $destino . $imagen1;

            $imagen2 = '';
            $src2 = '';
            $tmp2 = '';
            if (isset($_FILES['imagen2']) && $_FILES['imagen2']['error'] === 0) {
                $img2 = $_FILES['imagen2'];
                $tmp2 = $img2['tmp_name'];
                $imagenNombre2 = 'img2_' . md5(date('d-m-Y H:i:s'));
                $imagen2 = $imagenNombre2 . '.jpg';
                $src2 = $destino . $imagen2;
            }

            $imagen3 = '';
            $src3 = '';
            $tmp3 = '';
            if (isset($_FILES['imagen3']) && $_FILES['imagen3']['error'] === 0) {
                $img3 = $_FILES['imagen3'];
                $tmp3 = $img3['tmp_name'];
                $imagenNombre3 = 'img3_' . md5(date('d-m-Y H:i:s'));
                $imagen3 = $imagenNombre3 . '.jpg';
                $src3 = $destino . $imagen3;
            }
            $sql2 = "INSERT INTO PRODUCTO(Nombre, Categorias, Precio, IVA, Es_Promocionado, Imagen1, Imagen2, Imagen3, Descripcion) 
            VALUES('$nombre','$categoria',$precio,$iva,$promocionado,'$src1','$src2','$src3','$descripcion')";
            $query2 = $conexion->query($sql2);

            if ($query2) {
                if ($imagen1 != '') {
                    move_uploaded_file($tmp1,$src1);
                }
                if ($imagen2 != '') {
                    move_uploaded_file($tmp2,$src2);                
                }
                if ($imagen3 != '') {
                    move_uploaded_file($tmp3,$src3);
                }
                header("Location: ./crearProducto.php?success=Producto creado");
                exit();
            }else {
                header("Location: ./crearProducto.php?error=Ocurrio un error");
                exit();
            }
        }
    }

} else {
    header("Location: ./crearProducto.php?error=Datos incompletos");
    exit();
}
?>
