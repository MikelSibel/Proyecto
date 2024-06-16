<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $nombre = $_POST['nombre'];
    $modalidad = $_POST['modalidad'];
    $horario = $_POST['horario'];
    $ubicacion = $_POST['ubicacion'];
    $niv_educ = $_POST['niv_educ'];
    $salario = isset($_POST['salario']) ? $_POST['salario'] : null;
    $moneda = isset($_POST['moneda']) ? $_POST['moneda'] : null;
    $empresa = $_POST['empresa'];
    $idioma_of = $_POST['idioma_of'];
    $ex_re = $_POST['ex_re'];
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;

    session_start();
    $username = $_SESSION['usuario']['nombre_usuario'];

    $consultaProfesor = "SELECT Nombre_User FROM PROFESORES WHERE Nombre_User = ?";
    $consulta = mysqli_prepare($conexion, $consultaProfesor);
    mysqli_stmt_bind_param($consulta, "s", $username);
    mysqli_stmt_execute($consulta);
    mysqli_stmt_store_result($consulta);

    if (mysqli_stmt_num_rows($consulta) > 0) 
    {
        $estado = 1;
        $consulta = "INSERT INTO OFERTAS (Nombre, Modalidad, Horario, Ubicacion, Niv_Educ, Salario, Moneda, Empresa, Idioma_Of, Ex_Re, Descripcion, Prof_Crea_Of, Prof_Mod_Of, Estado)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertarOferta = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($insertarOferta, "sssssssssssssi", $nombre, $modalidad, $horario, $ubicacion, $niv_educ, $salario, $moneda, $empresa, $idioma_of, $ex_re, $descripcion, $username, $username, $estado);
        if (mysqli_stmt_execute($insertarOferta)) 
        {
            header("Location: /Proyecto/PHP/ofertas.php");
        }
        else 
        {
            echo "Error al crear la oferta: " . mysqli_error($conexion);
        }
        mysqli_stmt_close($insertarOferta);
    } 
    else 
    {
        echo "El usuario actual no es un profesor.";
    }
    mysqli_stmt_close($consulta);
}
mysqli_close($conexion);
?>
