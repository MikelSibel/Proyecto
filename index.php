<?php
include 'PHP/conexion.php'; 
include 'PHP/sesion.php'; 

comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';
$rol = '';

if (empty($username)) {
    header("Location: /Proyecto/PHP/iniciaSesion.php");
    exit;
}

$profesor_id = ''; // Variable para guardar el ID del profesor

// Verificar si el usuario es un alumno
$sqlAlumno = "SELECT * FROM ALUMNOS WHERE Nombre_User = '$username'";
$resultAlumno = mysqli_query($conexion, $sqlAlumno);

if (mysqli_num_rows($resultAlumno) > 0) {
    $rol = 'alumno';
} else {
    // Verificar si el usuario es un profesor
    $sqlProfesor = "SELECT * FROM PROFESORES WHERE Nombre_User = '$username'";
    $resultProfesor = mysqli_query($conexion, $sqlProfesor);

    if (mysqli_num_rows($resultProfesor) > 0) {
        $rol = 'profesor';
        $profesor_row = mysqli_fetch_assoc($resultProfesor);
        $profesor_id = $profesor_row['Nombre_User']; // Guardar el ID del profesor
    }
}

// Procesar la solicitud de eliminación de la oferta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_oferta'])) {
    $id_oferta = $_POST['id_oferta'];

    // Eliminar la oferta de la base de datos
    $delete_query = "DELETE FROM OFERTAS WHERE CodOf = $id_oferta";

    if (mysqli_query($conexion, $delete_query)) {
        // Redirigir a esta misma página para actualizar la lista de ofertas
        header("Location: /Proyecto/PHP/ofertas.php");
        exit;
    } else {
        echo "Error al eliminar la oferta: " . mysqli_error($conexion);
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : 'Ofertas'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <?php if ($rol == 'profesor'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto/PHP/altaOferta.php">Crear Oferta</a>
                </li>
                <?php endif; ?>
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

        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                echo "<div class='col-md-4'>";
                echo "<div class='card mb-4'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($row["Descripcion"], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='card-text'><strong>Precio:</strong> ";
                
                // Mostrar "No Especificado" si el salario es "0.00"
                if ($row["Salario"] == "0.00") {
                    echo "No Especificado";
                } else {
                    echo htmlspecialchars($row["Salario"], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($row["Moneda"], ENT_QUOTES, 'UTF-8');
                }
                
                echo "</p>";
                echo "<div class='d-flex justify-content-between'>"; // Utilizamos flexbox para alinear los botones a la derecha
                echo "<a href='/Proyecto/PHP/oferta.php?id=" . $row["CodOf"] . "' class='btn btn-primary'>Ver oferta</a>";

                // Mostrar enlace de modificación solo si el usuario es el profesor creador de la oferta
                if ($rol == 'profesor' && $row["Prof_Crea_Of"] == $profesor_id) {
                    echo "<a href='/Proyecto/PHP/modificarOferta.php?id=" . $row["CodOf"] . "' class='btn btn-warning'>Modificar oferta</a>";
                }

                // Mostrar botón de eliminar solo si el usuario es el profesor creador de la oferta
                if ($rol == 'profesor' && $row["Prof_Crea_Of"] == $profesor_id) {
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id_oferta' value='" . $row["CodOf"] . "'>";
                    echo "<button type='submit' name='eliminar_oferta' class='btn btn-danger ms-2'>Eliminar</button>";
                    echo "</form>";
                }
                echo "</div>"; // Cierre de div d-flex
                echo "</div>"; // Cierre de card-body
                echo "</div>"; // Cierre de card
                echo "</div>"; // Cierre de col-md-4
            }
        } else {
            echo "<p>No hay ofertas disponibles.</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
