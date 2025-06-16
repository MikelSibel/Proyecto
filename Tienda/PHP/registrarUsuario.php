<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
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
            <label for="DNI">DNI: </label>
            <input type="text" placeholder="DNI" name="dni">

            <label for="correo">Correo Electrónico: </label>
            <input type="email" placeholder="Correo Electronico" name="email" >

            <label for="nombre">Nombre: </label>
            <input type="text" placeholder="Nombre" name="nombre">

            <label for="apellido">Apellido: </label>
            <input type="text" placeholder="Apellido" name="apellido">

            <label for="clave">Contraseña: </label>
            <input type="password" placeholder="Contraseña" name="clave" >

            <label for="Fecha_naci">Fecha de Nacimiento: </label>
            <input type="date" name="fecha">

            <label for="direccion">Dirección: </label>
            <input type="text" placeholder="Dirección" name="direccion">


            <button type="submit" class="button">Registrarse</button>
            <a class="a" href="inicioSesion.php">Atras</a>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>