<?php
session_start();
include_once('conexionBD.php');

if (isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['fecha']) && isset($_POST['direccion']) && isset($_SESSION['Email'])
) {
    function validar($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    $dni = $_SESSION['DNI'];
    $emailSesion = $_SESSION['Email'];
    $emailNuevo = validar($_POST['email']);
    $nombre = validar($_POST['nombre']);
    $apellido = validar($_POST['apellido']);
    $clave = $_POST['clave'];
    $fecha = validar($_POST['fecha']);
    $direccion = validar($_POST['direccion']);

    if (empty($emailNuevo)) {
        header("Location: ./editarPerfil.php?id=$emailSesion&error=El Correo Electrónico es Requerido");
        exit();
    } elseif (empty($nombre)) {
        header("Location: ./editarPerfil.php?id=$emailSesion&error=El Nombre es Requerido");
        exit();
    } elseif (empty($apellido)) {
        header("Location: ./editarPerfil.php?id=$emailSesion&error=El Apellido es Requerido");
        exit();
    } elseif (empty($fecha)) {
        header("Location: ./editarPerfil.php?id=$emailSesion&error=La Fecha es Requerida");
        exit();
    } elseif (empty($direccion)) {
        header("Location: ./editarPerfil.php?id=$emailSesion&error=La Dirección es Requerida");
        exit();
    }

    if ($emailNuevo !== $emailSesion) {
        $comprobar = mysqli_query($conexion, "SELECT Email FROM USUARIO WHERE Email = '$emailNuevo' AND DNI != '$dni'");
        if ($comprobar && mysqli_num_rows($comprobar) > 0) {
            header("Location: ./editarPerfil.php?id=$emailSesion&error=El nuevo correo ya está registrado");
            exit();
        }
    }

    if (empty($_POST['clave'])) {
        $sql = mysqli_query($conexion, "UPDATE USUARIO SET Email = '$emailNuevo', Nombre = '$nombre', Apellido = '$apellido', Fecha_naci = '$fecha', Direccion = '$direccion' WHERE DNI = '$dni'");
    }else {
        $sql = mysqli_query($conexion, "UPDATE USUARIO SET Email = '$emailNuevo', Nombre = '$nombre', Apellido = '$apellido', Clave = '$clave', Fecha_naci = '$fecha', Direccion = '$direccion' WHERE DNI = '$dni'");

    }


    if ($sql) {
        $resultado = mysqli_query($conexion, "SELECT * FROM USUARIO WHERE DNI = '$dni'");
        if ($resultado && mysqli_num_rows($resultado) == 1) {
            $datos = mysqli_fetch_assoc($resultado);

            $_SESSION['activa'] = true;
            $_SESSION['DNI'] = $datos['DNI'];
            $_SESSION['Email'] = $datos['Email'];
            $_SESSION['Nombre'] = $datos['Nombre'];
            $_SESSION['Apellido'] = $datos['Apellido'];
            $_SESSION['Clave'] = $datos['Clave'];
            $_SESSION['Fecha_naci'] = $datos['Fecha_naci'];
            $_SESSION['Es_Admin'] = $datos['Es_Admin'];
            $_SESSION['Direccion'] = $datos['Direccion'];
        }
        header("Location: ./editarPerfil.php?id=$emailNuevo&success=Datos actualizados correctamente");
        exit();
    } else {
        header("Location: ./editarPerfil.php?id=$emailSesion&error=Ocurrió un error al actualizar");
        exit();
    }

} else {
    header('Location: ./registrarUsuario.php');
    exit();
}
