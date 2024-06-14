<?php
include 'sesion.php';
include 'conexion.php';

comprobar_sesion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['usuario']['nombre_usuario'];
    $cod_oferta = $_POST['cod_oferta'];

    $sql_delete = "DELETE FROM OFERTAS_FAVORITAS WHERE CodOf = '$cod_oferta' AND Nombre_User_Alumno = '$username'";
    $resultado = mysqli_query($conexion, $sql_delete);

    if ($resultado) {
        header("Location: /Proyecto/PHP/ofertaFavorita.php");
        exit;
    } else {
        die("Error al eliminar la oferta favorita: " . mysqli_error($conexion));
    }
}
?>
