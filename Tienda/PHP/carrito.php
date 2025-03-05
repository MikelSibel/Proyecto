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
<div class="container mt-5">
    <h2>Lista de la compra</h2>
    <div class="row my-4">
        <div class="col-md-4">
            <img src="/Tienda/imagenes/imagen1.png" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h4>Producto 1</h4>
            <p>Descripción breve</p>

            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-2" type="button">-</button>
                <input type="number" class="form-control w-25" value="1" min="1">
                <button class="btn btn-outline-secondary ms-2" type="button">+</button>
            </div>
        </div>
        <div class="col-md-2">
            <h5>Resumen</h5>
            <p><strong>Precio unitario:</strong> 20.00€</p>
            <p><strong>Descuento:</strong> 2.00€</p>
            <p><strong>Envío:</strong> 5.00€</p>
            <p><strong>Total:</strong> 23.00€</p>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-4">
            <img src="/Tienda/imagenes/imagen2.png" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h4>Producto 2</h4>
            <p>Descripción breve</p>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-2" type="button">-</button>
                <input type="number" class="form-control w-25" value="1" min="1">
                <button class="btn btn-outline-secondary ms-2" type="button">+</button>
            </div>
        </div>
        <div class="col-md-2">
            <h5>Resumen</h5>
            <p><strong>Precio unitario:</strong> 30.00€</p>
            <p><strong>Descuento:</strong> 3.00€</p>
            <p><strong>Envío:</strong> 5.00€</p>
            <p><strong>Total:</strong> 32.00€</p>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-8 offset-md-4">
            <h4>Total a pagar:</h4>
            <p><strong>Total productos:</strong> 55.00€</p>
            <p><strong>Total descuento:</strong> 5.00€</p>
            <p><strong>Total envío:</strong> 10.00€</p>
            <h5><strong>Total final:</strong> 60.00€</h5>
            <button class="btn btn-success w-100 mt-3">Pagar ahora</button>
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
