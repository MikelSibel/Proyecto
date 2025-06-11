<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Cotton</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="/Tienda/CSS/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Tienda/index.php">Golden Cotton</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex mx-auto w-50">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/Tienda/PHP/perfil.php">Perfil </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/favoritos.php">Favoritos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Tienda/PHP/carrito.php">Carrito</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light mt-4 d-none d-md-none d-lg-block">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/categoria.php">MUJER</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/categoria.php">NIÑOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/categoria.php">HOMBRE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/categoria.php">BEBE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Tienda/PHP/categoria.php">BELLEZA</a>
            </li>
        </ul>
    </div>
</nav>
<div class="contenedor">
        <h1>Añadir Producto</h1>
        <form action="guardarCategoria.php" method="POST">
            <label for="nombre">Nueva Categoria:</label>
            <input type="text" require>

            <button type="submit">Registrarse</button>
            <button type="reset">Borrar</button>
        </form>
</div>

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
