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
                    <a class="nav-link" href="/Tienda/PHP/perfil.php">Perfil</a>
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
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="p-3 bg-light rounded">
                <h5>Filtros</h5>
                <div class="mb-3">
                    <label for="talla" class="form-label">Talla</label>
                    <select class="form-select" id="talla">
                        <option value="">Seleccionar</option>
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Producto</label>
                    <select class="form-select" id="tipo">
                        <option value="">Seleccionar</option>
                        <option value="camiseta">Camiseta</option>
                        <option value="pantalon">Pantalón</option>
                        <option value="zapatos">Zapatos</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <select class="form-select" id="color">
                        <option value="">Seleccionar</option>
                        <option value="rojo">Rojo</option>
                        <option value="azul">Azul</option>
                        <option value="negro">Negro</option>
                    </select>
                </div>
                <button class="btn btn-primary w-100">Aplicar Filtros</button>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <a href="./producto.php" class="card text-decoration-none">
                        <img src="/Tienda/imagenes/imagen1.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Producto 1</h5>
                            <p class="card-text text-muted">Descripción breve</p>
                            <p class="card-text fw-bold">20.00€</p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                 Añadir a Favoritos
                            </button>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Añadir a Carrito
                            </button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <a href="./producto.php" class="card text-decoration-none">
                        <img src="/Tienda/imagenes/imagen2.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Producto 2</h5>
                            <p class="card-text text-muted">Descripción breve</p>
                            <p class="card-text fw-bold">30.00€</p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                 Añadir a Favoritos
                            </button>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Añadir a Carrito
                            </button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <a href="./producto.php" class="card text-decoration-none">
                        <img src="/Tienda/imagenes/imagen3.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Producto 3</h5>
                            <p class="card-text text-muted">Descripción breve</p>
                            <p class="card-text fw-bold">25.00€</p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Añadir a Favoritos
                            </button>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Añadir a Carrito
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="bg-light text-center py-4">
    <div class="container">
        <h5>Síguenos en nuestras redes sociales</h5>
        <div class="social-icons">
            <a href="https://facebook.com" class="btn btn-primary btn-sm" target="_blank">
                Facebook
            </a>
            <a href="https://github.com" class="btn btn-dark btn-sm" target="_blank">
                GitHub
            </a>
            <a href="https://instagram.com" class="btn btn-danger btn-sm" target="_blank">
                Instagram
            </a>
            <a href="https://youtube.com" class="btn btn-danger btn-sm" target="_blank">
                 YouTube
            </a>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
