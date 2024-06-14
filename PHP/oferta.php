<?php
include 'conexion.php';
include 'sesion.php';

// Verificar sesión y obtener rol del usuario
comprobar_sesion();
$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : null;
$rol = isset($_SESSION['usuario']['rol']) ? $_SESSION['usuario']['rol'] : null;

// Redirigir si el usuario no está autenticado
if (empty($username)) {
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}

// Obtener el ID de la oferta desde la URL
if (isset($_GET['id'])) {
    $id_oferta = $_GET['id'];
    
    // Consulta para obtener los detalles de la oferta
    $sql = "SELECT * FROM OFERTAS WHERE CodOf = $id_oferta";
    $result = mysqli_query($conexion, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $oferta = mysqli_fetch_assoc($result);
        
        // Consulta para obtener el nombre completo del profesor que creó la oferta
        $sqlCrea = "SELECT Nombre, Apellido_1, Apellido_2 FROM PROFESORES WHERE Nombre_User = '{$oferta['Prof_Crea_Of']}'";
        $resultCrea = mysqli_query($conexion, $sqlCrea);
        
        if ($resultCrea && mysqli_num_rows($resultCrea) > 0) {
            $profesorCrea = mysqli_fetch_assoc($resultCrea);
            $nombreCompletoCrea = $profesorCrea['Nombre'] . ' ' . $profesorCrea['Apellido_1'] . ' ' . $profesorCrea['Apellido_2'];
        } else {
            $nombreCompletoCrea = "No disponible";
        }
        
        // Consulta para obtener el nombre completo del profesor que modificó la oferta
        $sqlMod = "SELECT Nombre, Apellido_1, Apellido_2 FROM PROFESORES WHERE Nombre_User = '{$oferta['Prof_Mod_Of']}'";
        $resultMod = mysqli_query($conexion, $sqlMod);
        
        if ($resultMod && mysqli_num_rows($resultMod) > 0) {
            $profesorMod = mysqli_fetch_assoc($resultMod);
            $nombreCompletoMod = $profesorMod['Nombre'] . ' ' . $profesorMod['Apellido_1'] . ' ' . $profesorMod['Apellido_2'];
        } else {
            $nombreCompletoMod = "No disponible";
        }
    } else {
        echo "La oferta no existe.";
        exit;
    }
} else {
    echo "ID de oferta no especificado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($oferta['Nombre'], ENT_QUOTES, 'UTF-8'); ?></title>
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
                    <?php if (!empty($username) && $rol === 'profesor'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/Proyecto/PHP/cierraSesion.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                            <form id="logout-form" action="/Proyecto/PHP/cierraSesion.php" method="POST" style="display: none;">
                                <input type="hidden" name="cerrar_sesion">
                            </form>
                        </li>
                    <?php elseif (!empty($username) && $rol === 'alumno'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Proyecto/PHP/anadir_favorito.php?id=<?php echo $id_oferta; ?>">Añadir a favoritos</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Detalles de la oferta
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($oferta['Nombre'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <p class="card-text"><strong>Modalidad:</strong> <?php echo htmlspecialchars($oferta['Modalidad'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Horario:</strong> <?php echo htmlspecialchars($oferta['Horario'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Ubicación:</strong> <?php echo htmlspecialchars($oferta['Ubicacion'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Nivel educativo requerido:</strong> <?php echo htmlspecialchars($oferta['Niv_Educ'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Salario:</strong> <?php echo $oferta['Salario'] == "0.00" ? "No especificado" : '$' . number_format($oferta['Salario'], 2) . ' ' . htmlspecialchars($oferta['Moneda'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Empresa:</strong> <?php echo htmlspecialchars($oferta['Empresa'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Idioma:</strong> <?php echo htmlspecialchars($oferta['Idioma_Of'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Experiencia requerida:</strong> <?php echo htmlspecialchars($oferta['Ex_Re'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Estado:</strong> <?php echo $oferta['Estado'] ? 'Activo' : 'Inactivo'; ?></p>
                <p class="card-text"><strong>Profesor que creó la oferta:</strong> <?php echo htmlspecialchars($nombreCompletoCrea, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Profesor que modificó la oferta:</strong> <?php echo htmlspecialchars($nombreCompletoMod, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Fecha de publicación:</strong> <?php echo htmlspecialchars($oferta['Fecha_Publ'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Fecha de modificación:</strong> <?php echo htmlspecialchars($oferta['Fecha_Mod'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Descripción:</strong> <?php echo htmlspecialchars($oferta['Descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>

        <!-- Botón de Modificar oferta solo visible para profesores -->
        <?php if (!empty($username) && $rol === 'profesor'): ?>
            <div class="mt-3">
                <a href="/Proyecto/PHP/modificar_oferta.php?id=<?php echo $id_oferta; ?>" class="btn btn-primary">Modificar oferta</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-1B5SNAwC2U1W3+BfJ5xa7C5B9NhweYr0Q1FGIveX8o56kG+dyVWLV6fu3xGpgD9C" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-RDk/QQjBE4j9gS+Ue1Z2oFuJz4Nd31d+ZZ9zTwqE5s0UnswSPPQmQyfRw+aHlSrB" crossorigin="anonymous"></script>
</body>
</html>
