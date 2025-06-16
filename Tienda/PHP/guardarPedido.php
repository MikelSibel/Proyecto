<?php
session_start();
include 'conexionBD.php';

if (!isset($_SESSION['activa']) || $_SESSION['activa'] !== true) {
    header("Location: inicioSesion.php");
    exit();
}

if (!isset($_POST['carrito_json']) || empty($_POST['carrito_json'])) {
    header("Location: carrito.php?error=Carrito vacío");
    exit();
}

$carrito = json_decode($_POST['carrito_json'], true);
if (!$carrito || count($carrito) == 0) {
    header("Location: carrito.php?error=Carrito vacío");
    exit();
}

$nombreUsuario = $_SESSION['Nombre'] ?? '';
$dniUsuario = $_SESSION['DNI'] ?? '';
$direccionUsuario = $_SESSION['Direccion'] ?? '';

if (empty($dniUsuario) || empty($direccionUsuario)) {
    header("Location: carrito.php?error=Faltan datos del usuario");
    exit();
}

$fechaPedido = date('Y-m-d');
$estado = "Almacen";
$descripcion = "Pedido realizado desde la web";

mysqli_begin_transaction($conexion);

$sqlPedido = "INSERT INTO PEDIDOS (Nombre, Estado, Fecha, Descripcion, DNI, Direccion) 
              VALUES ('$nombreUsuario', '$estado', '$fechaPedido', '$descripcion', '$dniUsuario', '$direccionUsuario')";
$queryPedido = mysqli_query($conexion, $sqlPedido);

if (!$queryPedido) {
    mysqli_rollback($conexion);
    die("Error al guardar pedido: " . mysqli_error($conexion));
}

$idPedido = mysqli_insert_id($conexion);
if (!$idPedido) {
    mysqli_rollback($conexion);
    die("Error obteniendo id del pedido");
}

$numLinea = 1;
foreach ($carrito as $producto) {
    if (!isset($producto['ID_Producto'], $producto['cantidad'], $producto['precio'], $producto['descuento'], $producto['IVA'])) {
        mysqli_rollback($conexion);
        die("Datos incompletos en el carrito");
    }

    $idProducto = intval($producto['ID_Producto']);
    $unidades = intval($producto['cantidad']);
    $precio = floatval($producto['precio']);
    $descuento = intval($producto['descuento']);
    $iva = intval($producto['IVA']);

    $sqlLinea = "INSERT INTO LINEAS_PEDIDO (numPedido, numLinea, ID_Producto, unidades, IVA, Precio, descuento) 
                 VALUES ($idPedido, $numLinea, $idProducto, $unidades, $iva, $precio, $descuento)";
    $queryLinea = mysqli_query($conexion, $sqlLinea);

    if (!$queryLinea) {
        mysqli_rollback($conexion);
        die("Error al guardar línea de pedido: " . mysqli_error($conexion));
    }

    $numLinea++;
}

mysqli_commit($conexion);

header("Location: carrito.php?success=Pedido guardado correctamente");
exit();
?>
