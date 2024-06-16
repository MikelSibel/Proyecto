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
$rol = null;
$profesor_id = null;

$alumnoConsulta = "SELECT * FROM ALUMNOS WHERE Nombre_User = '$username'";
$resultadoAlumno = mysqli_query($conexion, $alumnoConsulta);

if (mysqli_num_rows($resultadoAlumno) > 0) 
{
    $rol = 'alumno';
} 
else 
{
    $profesorConsulta = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
    $resultProfesor = mysqli_query($conexion, $profesorConsulta);

    if (mysqli_num_rows($resultProfesor) > 0) 
    {
        $rol = 'profesor';
        $profesor_row = mysqli_fetch_assoc($resultProfesor);
        $profesor_id = $profesor_row['Nombre_User'];
    }
}

if (isset($_GET['id'])) 
{
    $id_oferta = $_GET['id'];
    $consulta = "SELECT * FROM OFERTAS WHERE CodOf = $id_oferta";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) 
    {
        $oferta = mysqli_fetch_assoc($resultado);

        $consultaOferta = "SELECT Nombre, Apellido_1, Apellido_2 FROM PROFESORES WHERE Nombre_User = '{$oferta['Prof_Crea_Of']}'";
        $resultadoOferta = mysqli_query($conexion, $consultaOferta);

        if ($resultadoOferta && mysqli_num_rows($resultadoOferta) > 0) 
        {
            $consultaProfesor = mysqli_fetch_assoc($resultadoOferta);
            $nombreCompleto = $consultaProfesor['Nombre'] . ' ' . $consultaProfesor['Apellido_1'] . ' ' . $consultaProfesor['Apellido_2'];
        } 
        else 
        {
            $nombreCompleto = "No disponible";
        }

        $consultaProfesorModifica = "SELECT Nombre, Apellido_1, Apellido_2 FROM PROFESORES WHERE Nombre_User = '{$oferta['Prof_Mod_Of']}'";
        $resultadoModifica = mysqli_query($conexion, $consultaProfesorModifica);

        if ($resultadoModifica && mysqli_num_rows($resultadoModifica) > 0) 
        {
            $profesorModifica = mysqli_fetch_assoc($resultadoModifica);
            $nombreCompletoModifica = $profesorModifica['Nombre'] . ' ' . $profesorModifica['Apellido_1'] . ' ' . $profesorModifica['Apellido_2'];
        } 
        else 
        {
            $nombreCompletoModifica = "No disponible";
        }
    } 
    else 
    {
        echo "La oferta no existe.";
        exit;
    }
} 
else 
{
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
    <title>WikiOferta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Proyecto/CSS/style.css">
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
                <p class="card-text"><strong>Salario:</strong> <?php echo $oferta['Salario'] == "0.00" ? "No especificado" : ' ' . number_format($oferta['Salario'], 2) . ' ' . htmlspecialchars($oferta['Moneda'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Empresa:</strong> <?php echo htmlspecialchars($oferta['Empresa'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Idioma:</strong> <?php echo htmlspecialchars($oferta['Idioma_Of'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Experiencia requerida:</strong> <?php echo htmlspecialchars($oferta['Ex_Re'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Estado:</strong> <?php echo $oferta['Estado'] ? 'Activo' : 'Inactivo'; ?></p>
                <p class="card-text"><strong>Profesor que creó la oferta:</strong> <?php echo htmlspecialchars($nombreCompleto, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Profesor que modificó la oferta:</strong> <?php echo htmlspecialchars($nombreCompletoModifica, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Fecha de publicación:</strong> <?php echo htmlspecialchars($oferta['Fecha_Publ'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Fecha de modificación:</strong> <?php echo htmlspecialchars($oferta['Fecha_Mod'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text"><strong>Descripción:</strong> <?php echo htmlspecialchars($oferta['Descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
        <?php if ($rol === 'profesor'): ?>
            <div class="mt-3">
                <a href="/Proyecto/PHP/modificaOferta.php?id=<?php echo $id_oferta; ?>" class="btn btn-primary">Modificar oferta</a>
            </div>
        <?php endif; ?>
        <?php if (!empty($username) && $rol === 'alumno'): ?>
    <div class="mt-3">
        <?php
            $comprobar = $conexion->prepare("SELECT * FROM OFERTAS_FAVORITAS WHERE CodOf = ? AND Nombre_User_Alumno = ?");
            $comprobar->bind_param("is", $id_oferta, $username);
            $comprobar->execute();
            $resultadoComprobar = $comprobar->get_result();

            if ($resultadoComprobar->num_rows > 0) 
            {
                echo '<button class="btn btn-primary" disabled>Añadir a Favoritos</button>';
            } else 
            {
                echo '<a href="/Proyecto/PHP/guardarOfertaFavorita.php?id=' . $id_oferta . '" class="btn btn-primary">Añadir a Favoritos</a>';
            }
        ?>
    </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
