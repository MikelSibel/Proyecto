<?php
include 'conexion.php';
include 'sesion.php';
comprobar_sesion();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_oferta'])) 
{
    $idOferta = intval($_POST['id_oferta']);

    $consulta = "DELETE FROM OFERTAS WHERE CodOf = ?";
    if ($eliminar = $conexion->prepare($consulta)) 
    {
        $eliminar->bind_param("i", $idOferta);
        if ($eliminar->execute()) 
        {
            header("Location: /Proyecto/PHP/ofertas.php");
            exit();
        } 
        else 
        {
            die("Error al eliminar la oferta: " . $eliminar->error);
        }
        $eliminar->close();
    } 
    else 
    {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
} 
else 
{
    header("Location: /Proyecto/index.php");
    exit();
}
?>
