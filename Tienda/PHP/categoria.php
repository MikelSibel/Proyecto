<<?php
include 'conexionBD.php';

$consulta = "SELECT p.ID_Producto, p.Nombre, p.Categorias, p.Precio, p.IVA, p.Es_Promocionado, p.Imagen1, p.Imagen2, p.Imagen3, p.Descripcion, GROUP_CONCAT(DISTINCT s.Color) AS Colores, GROUP_CONCAT(DISTINCT s.Talla) AS Tallas FROM PRODUCTO p LEFT JOIN STOCK s ON p.ID_Producto = s.ID_Producto GROUP BY p.ID_Producto";

$resultado = mysqli_query($conexion, $consulta);
$productos = [];

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $row['Colores'] = $row['Colores'] ? explode(',', $row['Colores']) : [];
        $row['Tallas'] = $row['Tallas'] ? explode(',', $row['Tallas']) : [];
        $productos[] = $row;
    }
}

$categorias = [];
$resCategorias = mysqli_query($conexion, "SELECT DISTINCT Categorias FROM PRODUCTO");
if ($resCategorias) {
    while ($row = mysqli_fetch_assoc($resCategorias)) {
        $categorias[] = $row['Categorias'];
    }
}

$colores = [];
$resColores = mysqli_query($conexion, "SELECT DISTINCT Color FROM STOCK");
if ($resColores) {
    while ($row = mysqli_fetch_assoc($resColores)) {
        $colores[] = $row['Color'];
    }
}

$tallas = [];
$resTallas = mysqli_query($conexion, "SELECT DISTINCT Talla FROM STOCK");
if ($resTallas) {
    while ($row = mysqli_fetch_assoc($resTallas)) {
        $tallas[] = $row['Talla'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include "header.php";?>
<body>

<?php include "nav1.php";?>
<?php include "nav2.php";?>
<div class="container mt-5">
    <div class="row">
<div class="col-md-3 mb-4">
    <div class="p-3 bg-black rounded text-white">
        <h5>Filtros</h5>

        <div class="mb-3">
            <label for="filtroTalla" class="form-label">Talla</label>
            <select class="form-select" id="filtroTalla">
                <option value="">Seleccionar</option>
                <?php foreach ($tallas as $talla): ?>
                    <option value="<?= strtolower($talla) ?>"><?= strtoupper($talla) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="filtroCategoria" class="form-label">Categoría</label>
            <select class="form-select" id="filtroCategoria">
                <option value="">Seleccionar</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria ?>"><?= ucfirst($categoria) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="filtroColor" class="form-label">Color</label>
            <select class="form-select" id="filtroColor">
                <option value="">Seleccionar</option>
                <?php foreach ($colores as $color): ?>
                    <option value="<?= $color ?>"><?= ucfirst($color) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button id="btnAplicarFiltros" class="btn btn-primary w-100">Aplicar Filtros</button>
    </div>
</div>
        <div class="col-md-9">
            <form id="formBuscar" class="d-flex mx-auto w-50 mb-3" onsubmit="return false;">
                <input id="inputBuscar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" />
                <button id="btnBuscar" class="btn btn-outline-success" type="submit">Buscar</button>
            </form>

            <div id="productosContainer" class="row"></div>

            <nav>
                <ul id="paginacion" class="pagination justify-content-center"></ul>
            </nav>
        </div>

    </div>
</div>
<?php include "footer.php";?>
<script>
    const productos = <?php echo json_encode($productos); ?>;
</script>
<script src="../JS/functions.js"></script>
</body>
</html>
