<?php
include 'conexionBD.php';
session_start();
if (!empty($_SESSION['activa'])) {
    header("Location: ./inicioSesion.php");
}else {
    if(isset($_POST['Email']) && isset($_POST['Clave'])){
        function validar($dato){
            $dato = trim($dato);
            $dato = stripcslashes($dato);
            $dato = htmlspecialchars($dato);
            return $dato;
        }

        $Email = validar($_POST['Email']);
        $Clave = validar($_POST['Clave']);

        if (empty($Email)) {
            header("Location: ./inicioSesion.php?error=El Correo Electronico es Requerido");
            exit();
        }elseif(empty($Clave)){
            header("Location: ./inicioSesion.php?error=La Contraseña es Requerida");
            exit();
        }else {

            $sql = mysqli_query($conexion,"SELECT * FROM USUARIO WHERE Email = '$Email' AND Clave = '$Clave'");
            $resultado = mysqli_num_rows($sql);

            if ($resultado === 1) {
                $datos = mysqli_fetch_array($sql);
                
                $_SESSION['activa'] = true;
                $_SESSION['DNI'] = $datos['DNI'];
                $_SESSION['Email'] = $datos['Email'];
                $_SESSION['Nombre'] = $datos['Nombre'];
                $_SESSION['Apellido'] = $datos['Apellido'];
                $_SESSION['Clave'] = $datos['Clave'];
                $_SESSION['Fecha_naci'] = $datos['Fecha_naci'];
                $_SESSION['Es_Admin'] = $datos['Es_Admin'];
                $_SESSION['Direccion'] = $datos['Direccion'];
                header("Location: inicio.php");
                
            }else {
                header("Location: ./inicioSesion.php?error=El Correo electronico o La Contraseña son incorrectos 2");
                session_destroy();
            }
        }

    }else {
        header("Location: ./inicioSesion.php");
        exit();
    }
}
?>