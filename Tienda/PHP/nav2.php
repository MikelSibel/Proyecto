<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['Es_Admin']) && $_SESSION['Es_Admin'] == 1) { 
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-4 d-none d-md-none d-lg-block">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/nuevaCategoria.php">Nueva Categoria</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/crearProducto.php">Nuevo Producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/listaProducto.php">Lista de Productos</a>
            </li>
        </ul>
    </div>
</nav>
<?php } ?>
