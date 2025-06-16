<?php
session_start();
include_once('conexionBD.php');

if (isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['fecha']) && isset($_POST['direccion'])) {
    function validar($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    $dni = validar($_POST['dni']);
    $email = validar($_POST['email']);
    $nombre = validar($_POST['nombre']);
    $apellido = validar($_POST['apellido']);
    $clave = validar($_POST['clave']);
    $fecha = validar($_POST['fecha']);
    $direccion = validar($_POST['direccion']);

    $datosUsuario = 'dni=' . $dni . '&email=' .$email;

    if (empty($dni)) {
        header("Location: ./registrarUsuario.php?error=El DNI es Requerido&$datosUsuario");
        exit();
    }elseif (empty($email)) {
        header("Location: ./registrarUsuario.php?error=El Correo Electronico es Requerido&$datosUsuario");
        exit();
    }elseif (empty($nombre)) {
        header("Location: ./registrarUsuario.php?error=El Nombre es Requerido&$datosUsuario");
        exit();
    }elseif (empty($apellido)) {
        header("Location: ./registrarUsuario.php?error=El Apellido es Requerido&$datosUsuario");
        exit();
    }elseif (empty($clave)) {
        header("Location: ./registrarUsuario.php?error=La Clave es Requerida&$datosUsuario");
        exit();
    }elseif (empty($fecha)) {
        header("Location: ./registrarUsuario.php?error=La Fecha es Requerida&$datosUsuario");
        exit();
    }elseif (empty($direccion)) {
        header("Location: ./registrarUsuario.php?error=La Dirección es Requerida&$datosUsuario");
        exit();
    }else {
        $sql = "SELECT * FROM USUARIO WHERE DNI = '$dni'";
        $query = $conexion->query($sql);

        if (mysqli_num_rows($query) > 0) {
            header("Location: ./registrarUsuario.php?error=DNI ya registrado");
            exit();
        }else {
            $sql2 = "INSERT INTO USUARIO(DNI, Email, Nombre, Apellido, Clave, Fecha_naci, Direccion) VALUES('$dni','$email','$nombre','$apellido','$clave','$fecha','$direccion')";
            $query2 = $conexion->query($sql2);

            if ($query2) {
                header("Location: ./registrarUsuario.php?success=Usuario creado");
                exit();
            }else {
                header("Location: ./registrarUsuario.php?error=Ocurrio un error");
                exit();
            }
        }
    }

}else {
    header('Location: ./registrarUsuario.php');
    exit();
}