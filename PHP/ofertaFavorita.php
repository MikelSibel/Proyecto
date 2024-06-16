<?php
include 'conexion.php';
include 'sesion.php';
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : null;

if (empty($username)) 
{
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}

$consulta = "SELECT o.CodOf, o.Nombre, o.Empresa, o.Ubicacion, o.Salario
        FROM OFERTAS_FAVORITAS ofav
        INNER JOIN OFERTAS o ON ofav.CodOf = o.CodOf
        WHERE ofav.Nombre_User_Alumno = '$username'";

$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) 
{
    die("Error en la consulta: " . mysqli_error($conexion));
}

$favoritas = [];
while ($fila = mysqli_fetch_assoc($resultado)) 
{
    $favoritas[] = $fila;
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiOfertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Proyecto/CSS/sesion.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Proyecto/index.php">WikiOfertas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/perfil.php"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/ofertas.php">Ofertas</a>
                </li>
                <?php if ($rol == 'profesor'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/altaOferta.php">Crear Oferta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/listaAlumnos.php">Lista Alumnos</a>
                </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
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
    <div class="row">
        <div class="col-md-12">
            <h1 class="titulo">Ofertas Favoritas</h1>
            <?php foreach ($favoritas as $oferta): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($oferta['Nombre'], ENT_QUOTES, 'UTF-8'); ?></h5>
                        <p class="card-text"><strong>Empresa:</strong> <?php echo htmlspecialchars($oferta['Empresa'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text"><strong>Ubicación:</strong> <?php echo htmlspecialchars($oferta['Ubicacion'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text"><strong>Salario:</strong> <?php echo $oferta['Salario'] ? "$" . number_format($oferta['Salario'], 2) : 'No especificado'; ?></p>
                        <a href="/Proyecto/PHP/oferta.php?id=<?php echo $oferta['CodOf']; ?>" class="btn btn-primary">Ver Detalles</a>
                        <form action="/Proyecto/PHP/eliminarFavorita.php" method="POST" style="display: inline;">
                            <input type="hidden" name="cod_oferta" value="<?php echo $oferta['CodOf']; ?>">
                            <button type="submit" class="btn btn-danger">Eliminar de Favoritos</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($favoritas)): ?>
                <p>No tienes ofertas favoritas.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
