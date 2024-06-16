<?php
require_once "funciones.php";

$error_message = '';
if (isset($_GET['error'])) 
{
    if ($_GET['error'] === 'login_failed') 
    {
        $error_message = 'El usuario o la contraseña son incorrectos. Por favor, inténtalo de nuevo.';
    } 
    else 
    {
        $error_message = 'Hubo un error desconocido. Por favor, inténtalo de nuevo más tarde.';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $usu = comprobarUsuario($_POST['usuario'], $_POST['password']);
    if ($usu === false) 
    {
        header("Location: iniciaSesion.php?error=login_failed");
        exit;
    } 
    else 
    {
        if (session_status() == PHP_SESSION_NONE) 
        {
            session_start();
        }
        
        $_SESSION['usuario'] = [
            'nombre' => $usu['Nombre'],
            'nombre_usuario' => $usu['Nombre_User']
        ];
        header("Location: ../index.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiOfertas</title>
    <link rel="stylesheet" href="../CSS/sesion.css">
</head>
<body>
<div id="contenedor">
    <div id="central">
        <div id="login">
            <div class="titulo">
                Bienvenido
            </div>
            <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            <form id="loginform" method="post">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit" title="Ingresar" name="submit">Inicia Sesión</button>
            </form>
            <div class="pie-form">
                <a href="registrarse.php">¿No tienes Cuenta? Registrate</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
