<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Tienda/PHP/inicio.php">Golden Cotton</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/Tienda/PHP/perfil.php"><?php echo empty($_SESSION['Nombre']) ? 'Perfil' : $_SESSION['Nombre']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/favoritos.php">Favoritos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/categoria.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/carrito.php">Carrito</a>
                </li>
                <?php 
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (isset($_SESSION['activa']) && $_SESSION['activa'] == true) { 
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/pedidos.php?id=<?php echo $_SESSION['Email']; ?>">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/cerrarSesion.php">Cerrar de Sesión</a>
                </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/inicioSesion.php">Inicio de Sesión</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>