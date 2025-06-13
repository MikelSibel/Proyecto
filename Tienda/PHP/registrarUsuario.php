<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Tienda/CSS/inicioSesion.css">
    <title>Golden Cotton</title>
</head>
<body>
    <div class="contenedor">
        <form action="guardarRegistrarUsuario.php" method="POST">
            <h2>Registrarse</h2>
            <?php
                if (isset($_GET['error'])) {
                    ?>
                    <p class="error">
                        <?php
                        echo $_GET['error'];
                        ?>
                    </p>
            <?php      
                }
            ?>
            <?php
                if (isset($_GET['success'])) {
                    ?>
                    <p class="success">
                        <?php
                        echo $_GET['success'];
                        ?>
                    </p>
            <?php      
                }
            ?>
            <label for="correo">DNI: </label>
            <input type="text" placeholder="DNI" name="dni" require>

            <label for="correo">Correo Electrónico: </label>
            <input type="email" placeholder="Correo Electronico" name="email" require>

            <label for="nombre">Nombre: </label>
            <input type="text" placeholder="Nombre" name="nombre" require>

            <label for="apellido">Apellido: </label>
            <input type="text" placeholder="Apellido" name="apellido" require>

            <label for="clave">Contraseña: </label>
            <input type="password" placeholder="Contraseña" name="clave" require>

            <label for="Fecha_naci">Fecha de Nacimiento: </label>
            <input type="date" name="fecha" require>

            <label for="direccion">Dirección: </label>
            <input type="text" placeholder="Dirección" name="direccion" require>


            <button type="submit" class="button">Registrarse</button>
            <a href="inicioSesion.php">Atras</a>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>