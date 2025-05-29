<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Tienda/CSS/style.css">
    <title>Golden Cotton</title>
</head>
<body>
    <div class="contenedor">
        <form action="guardarRegistrarUsuario" method="POST">
            <h2>Registrarse</h2>
            <label for="correo">DNI: </label>
            <input type="text" require>

            <label for="correo">Correo Electrónico: </label>
            <input type="email" require>

            <label for="nombre">Nombre: </label>
            <input type="text" require>

            <label for="apellido">Apellido: </label>
            <input type="text" require>

            <label for="clave">Contraseña: </label>
            <input type="password" require>

            <label for="Fecha_naci">Fecha de Nacimiento: </label>
            <input type="date" require>

            <label for="direccion">Dirección: </label>
            <input type="text" require>


            <button type="submit">Registrarse</button>
            <button type="reset">Borrar</button>
        </form>
    </div>
</body>
</html>