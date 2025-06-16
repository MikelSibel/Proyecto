<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();

if (empty($_GET['id'])) {
    header('Location: perfil.php');
    exit();
}

$correo = $_GET['id'];
$sql = mysqli_query($conexion, "SELECT DNI, Email, Nombre, Apellido, Fecha_naci, Direccion FROM USUARIO WHERE Email = '$correo'");
$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
    header('Location: perfil.php');
    exit();
} else {
    $datos = mysqli_fetch_array($sql);
    $DNI = $datos['DNI'];
    $Email = $datos['Email'];
    $Nombre = $datos['Nombre'];
    $Apellido = $datos['Apellido'];
    $Fecha_naci = $datos['Fecha_naci'];
    $Direccion = $datos['Direccion'];
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php"; ?>
<?php include "nav2.php"; ?>
<div class="contenedor">
    <form action="guardarEditarUsuario.php" method="POST">
        <h2>Editar Perfil</h2>
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

        <label for="correo">Correo Electrónico: </label>
        <input type="email" placeholder="Correo Electronico" name="email" value="<?php echo $Email; ?>">

        <label for="nombre">Nombre: </label>
        <input type="text" placeholder="Nombre" name="nombre" value="<?php echo $Nombre; ?>">

        <label for="apellido">Apellido: </label>
        <input type="text" placeholder="Apellido" name="apellido" value="<?php echo $Apellido; ?>">

        <label for="apellido">Contraseña: </label>
        <input type="text" placeholder="Contraseña" name="clave">

        <label for="Fecha_naci">Fecha de Nacimiento: </label>
        <input type="date" name="fecha" value="<?php echo $Fecha_naci; ?>">

        <label for="direccion">Dirección: </label>
        <input type="text" placeholder="Dirección" name="direccion" value="<?php echo $Direccion; ?>">

        <button type="submit" class="button">Actualizar</button>
        <a class="a" href="perfil.php">Atras</a>
    </form>
</div>
<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
