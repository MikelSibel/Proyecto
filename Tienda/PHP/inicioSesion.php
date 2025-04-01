<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="/Tienda/CSS/style.css">
    <title>Golden Cotton</title>
</head>
<body>
    <div class="contenedor">
        <h1>Inicio de Sesión</h1>
        <form action="inicioSesion" method="POST">
            <input type="text" name="Email" placeholder="Correo Electronico">
            <input type="password" name="Clave" placeholder="Contraseña">
            <button type="sumbit">inicar sesion</button>
        </form>
        <a href="registrarUsuario.php">Registrarse</a>
    </div>
</body>
</html>