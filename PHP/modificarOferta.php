<?php
include 'conexion.php'; 
include 'sesion.php'; 
comprobar_sesion();

$username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

if (empty($username)) 
{
    header("Location: iniciaSesion.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) 
{
    header("Location: /Proyecto/PHP/ofertas.php");
    exit;
}
$id_oferta = $_GET['id'];

$consulta = "SELECT * FROM OFERTAS WHERE CodOf = $id_oferta";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado || mysqli_num_rows($resultado) === 0) 
{
    header("Location: /Proyecto/PHP/ofertas.php"); 
    exit;
}
$row = mysqli_fetch_assoc($resultado);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $modalidad = mysqli_real_escape_string($conexion, $_POST['modalidad']);
    $horario = mysqli_real_escape_string($conexion, $_POST['horario']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $niv_educ = mysqli_real_escape_string($conexion, $_POST['niv_educ']);
    $salario = isset($_POST['salario']) ? $_POST['salario'] : 0;
    $moneda = mysqli_real_escape_string($conexion, $_POST['moneda']);
    $empresa = mysqli_real_escape_string($conexion, $_POST['empresa']);
    $idioma_of = mysqli_real_escape_string($conexion, $_POST['idioma_of']);
    $ex_re = mysqli_real_escape_string($conexion, $_POST['ex_re']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $estado = isset($_POST['estado']) ? 1 : 0;
    $update_query = "UPDATE OFERTAS SET
                    Nombre = '$nombre',
                    Modalidad = '$modalidad',
                    Horario = '$horario',
                    Ubicacion = '$ubicacion',
                    Niv_Educ = '$niv_educ',
                    Salario = $salario,
                    Moneda = '$moneda',
                    Empresa = '$empresa',
                    Idioma_Of = '$idioma_of',
                    Ex_Re = '$ex_re',
                    Descripcion = '$descripcion',
                    Estado = $estado,
                    Fecha_Mod = CURRENT_TIMESTAMP,
                    Prof_Mod_Of = '{$_SESSION['usuario']['nombre_usuario']}'
                    WHERE CodOf = $id_oferta";

    if (mysqli_query($conexion, $update_query)) 
    {
        header("Location: /Proyecto/PHP/ofertas.php");
        exit;
    } 
    else 
    {
        echo "Error al actualizar la oferta: " . mysqli_error($conexion);
    }
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
<div class="container mt-5">
    <h1>Modificar Oferta</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="modalidad" class="form-label">Modalidad</label>
            <select class="form-select" id="modalidad" name="modalidad" required>
                <option value="Remoto" <?php if ($row['Modalidad'] == 'Remoto') echo 'selected'; ?>>Remoto</option>
                <option value="Presencial" <?php if ($row['Modalidad'] == 'Presencial') echo 'selected'; ?>>Presencial</option>
                <option value="Mixto" <?php if ($row['Modalidad'] == 'Mixto') echo 'selected'; ?>>Mixto</option>
                <option value="No Especificado" <?php if ($row['Modalidad'] == 'No Especificado') echo 'selected'; ?>>No Especificado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" class="form-control" id="horario" name="horario" value="<?php echo htmlspecialchars($row['Horario'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($row['Ubicacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="niv_educ" class="form-label">Nivel Educativo</label>
            <input type="text" class="form-control" id="niv_educ" name="niv_educ" value="<?php echo htmlspecialchars($row['Niv_Educ'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="<?php echo htmlspecialchars($row['Salario'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="mb-3">
            <label for="moneda" class="form-label">Moneda</label>
            <input type="text" class="form-control" id="moneda" name="moneda" value="<?php echo htmlspecialchars($row['Moneda'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="empresa" class="form-label">Empresa</label>
            <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo htmlspecialchars($row['Empresa'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="idioma_of" class="form-label">Idioma Ofrecido</label>
            <input type="text" class="form-control" id="idioma_of" name="idioma_of" value="<?php echo htmlspecialchars($row['Idioma_Of'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="ex_re" class="form-label">Experiencia Requerida</label>
            <input type="text" class="form-control" id="ex_re" name="ex_re" value="<?php echo htmlspecialchars($row['Ex_Re'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($row['Descripcion'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="estado" name="estado" <?php if ($row['Estado'] == 1) echo 'checked'; ?>>
            <label class="form-check-label" for="estado">Activo</label>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
