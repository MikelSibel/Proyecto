<?php
include 'conexionBD.php';
include 'comprobarSesion.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>
<?php include "nav1.php";?>
<?php include "nav2.php";?>
<div class="main-container container">
    <div class="">
        <div class="">¡Hola, <?php echo $_SESSION['Nombre']." ". $_SESSION['Apellido']; ?></div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="./favoritos.php">Favoritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./carrito.php">Carrito</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/cerrarSesion.php">Cerrar sesión</a>
            </li>
        </ul>
    </div>
    <div class="profile-container">
        <div class="profile-card">
            <h3>Datos del usuario</h3>
            <p><strong>Correo Electrónico:</strong> <?php echo $_SESSION['Email']; ?></p>
            <p><strong>Nombre:</strong>  <?php echo $_SESSION['Nombre']; ?></p>            
            <p><strong>Apellido:</strong>  <?php echo $_SESSION['Apellido']; ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?php echo $_SESSION['Fecha_naci']; ?></p>
            <a href="/Tienda/PHP/editarPerfil.php?id=<?php echo $_SESSION['Email']; ?>" class="btn btn-outline-primary btn-edit-profile">Editar Perfil</a>
        </div>
    </div>
</div>
<?php include "footer.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
