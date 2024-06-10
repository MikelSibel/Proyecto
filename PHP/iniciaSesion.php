<?php
require_once "funciones.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
    if($usu === false)
    {
        $err = true;
        $usuario = $_POST['usuario'];
    }
    else
    {
        session_start();
        $_SESSION['usuario'] = $usu;
        if($_SESSION['usuario']['profesor'])
        {
            headre("Location: index.php");
            exit;
        }
        else 
		{
			$_SESSION[''] = [];
			header("Location: index.php");
            exit;
		}
		return;
    }
}

?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Formulario de Acceso </title>    
        <link rel="stylesheet" href="../css/sesion.css"> 
    </head>
    <body>
        
        <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Bienvenido
                    </div>
                    <form id="loginform">
                        <input type="text" name="usuario" placeholder="Usuario" required>
                        <input type="clave" placeholder="Contraseña" name="password" required>
                        <button type="submit" title="Ingresar" name="Ingresar">Inicia Sesión</button>
                    </form>
                    <div class="pie-form">
                        <a href="#">¿Perdiste tu contraseña?</a>
                        <a href="registrarse.php">¿No tienes Cuenta? Registrate</a>
                    </div>
                </div>
                <div class="inferior">
                    <a href="index.php">Volver</a>
                </div>
            </div>
        </div>
            
    </body>
</html>