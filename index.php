<?php 
include 'PHP/conexion.php'; 
include 'PHP/sesion.php'; 

comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) {
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : 'Ofertas'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Proyecto/CSS/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Proyecto/index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/Proyecto/index.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/perfil.php"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/ofertas.php">Ofertas</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/Proyecto/PHP/iniciaSesion.php">Inicio</a>
                </li>
                <?php if (!empty($username)): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/Proyecto/PHP/cierraSesion.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    <form id="logout-form" action="/Proyecto/PHP/cierraSesion.php" method="POST" style="display: none;">
                        <input type="hidden" name="cerrar_sesion">
                    </form>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
  <h1>Ofertas</h1>
  <div id="ofertas" class="row">
    <?php
    $sql = "SELECT * FROM OFERTAS";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . "</h5>";
            echo "<p class='card-text'>" . htmlspecialchars($row["Descripcion"], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p class='card-text'><strong>Precio:</strong> $" . htmlspecialchars($row["Salario"], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($row["Moneda"], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<a href='/Proyecto/PHP/oferta.php?id=" . $row["CodOf"] . "' class='btn btn-primary'>Ver oferta</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 resultados";
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+UJ0ZXaVgIKUR3M6ZPj0OdyaIlTg1" crossorigin="anonymous"></script>
</body>
</html>
