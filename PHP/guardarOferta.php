<?php
include 'conexion.php'; // Ajusta la ruta según la ubicación real de conexion.php

// Verificar que se haya enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
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

    // Verificar si el usuario actual es un profesor
    session_start();
    $username = $_SESSION['usuario']['nombre_usuario'];

    $sql = "SELECT Nombre_User FROM PROFESORES WHERE Nombre_User = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Si el usuario es un profesor, proceder con la inserción
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Estado de la oferta (activo)
        $estado = 1;

        // Preparar la consulta SQL con Estado
        $sql_insert = "INSERT INTO OFERTAS (Nombre, Modalidad, Horario, Ubicacion, Niv_Educ, Salario, Moneda, Empresa, Idioma_Of, Ex_Re, Descripcion, Prof_Crea_Of, Prof_Mod_Of, Estado)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparar la declaración
        $stmt_insert = mysqli_prepare($conexion, $sql_insert);
        
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt_insert, "sssssssssssssi", $nombre, $modalidad, $horario, $ubicacion, $niv_educ, $salario, $moneda, $empresa, $idioma_of, $ex_re, $descripcion, $username, $username, $estado);
        
        // Ejecutar la declaración
        if (mysqli_stmt_execute($stmt_insert)) {
            echo "Oferta creada correctamente.";
        } else {
            echo "Error al crear la oferta: " . mysqli_error($conexion);
        }
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt_insert);
    } else {
        echo "El usuario actual no es un profesor.";
    }

    // Cerrar la consulta de verificación
    mysqli_stmt_close($stmt);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
