<?php
session_start();
include 'conexionBD.php';


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
        header("Location: ./PHP/inicioSesion.php?error=El Correo Electronico es Requerido");
        exit();
    }elseif(empty($Clave)){
        header("Location: ./PHP/inicioSesion.php?error=La Contraseña es Requerida");
        exit();
    }else {
        //$Clave = md5($Clave);

        $sql = "SELECT * FROM USUARIO WHERE Email = '$Email' AND Clave = '$Clave'";
        $resultado = mysqli_query($conexion,$sql);

        if (mysqli_num_rows($resultado) === 1) {
            $row = mysqli_fetch_assoc($resultado);
            if ($row['Email'] === $Email && $row['Clave'] === $Clave) {
                $_SESSION['Email'] = $row['Email'];
                header("Location: ../index.php");
                exit();
            }else {
                header("Location: ./PHP/inicioSesion.php?error=El Correo electronico o La Contraseña son incorrectos 1");
                exit();
            }
        }else {
            header("Location: ./PHP/inicioSesion.php?error=El Correo electronico o La Contraseña son incorrectos 2");
            exit();
        }
    }

}else {
    header("Location: ./PHP/inicioSesion.php");
    exit();
}
?>