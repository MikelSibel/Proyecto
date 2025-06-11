<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="/Tienda/CSS/inicioSesion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Golden Cotton</title>
</head>
<body>
    <div class="contenedor">
        <form action="comprobarUsuario.php" method="POST">
            <h1>Inicio de Sesión</h1>
            <hr>
            <i class="fa-solid fa-user-graduate"> </i>
            <label>Correo electronico:</label>
            <input type="text" name="Email" placeholder="Correo Electronico">
            
            <i class="fa-solid fa-unlock-keyhole"> </i>
            <label>contraseña:</label>
            <input type="password" name="Clave" placeholder="Contraseña">
            <hr>
            <button type="submit">inicar sesion</button>
            <a href="registrarUsuario.php">Registrarse</a>
        </form>
    </div>
</body>
</html>