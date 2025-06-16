const filtroTalla = document.getElementById('filtroTalla');
const filtroCategoria = document.getElementById('filtroCategoria');
const filtroColor = document.getElementById('filtroColor');
const btnAplicarFiltros = document.getElementById('btnAplicarFiltros');
const inputBuscar = document.getElementById('inputBuscar');
const btnBuscar = document.getElementById('btnBuscar');
const productosContainer = document.getElementById('productosContainer');
const paginacion = document.getElementById('paginacion');

const porPagina = 8;
let paginaActual = 1;
let productosFiltrados = [...productos];

function renderProductos() {
    productosContainer.innerHTML = '';
    const start = (paginaActual - 1) * porPagina;
    const end = start + porPagina;
    const mostrar = productosFiltrados.slice(start, end);
    if (mostrar.length === 0) {
        productosContainer.innerHTML = '<p>No se encontraron productos.</p>';
        paginacion.innerHTML = '';
        return;
    }
    for (const prod of mostrar) {
        const div = document.createElement('div');
        div.className = 'col-6 col-md-4 col-lg-3 mb-4';
        div.innerHTML = `
            <div class="card text-decoration-none">
                <img src="${prod.Imagen1}" class="card-img-top" alt="${prod.Nombre}">
                <div class="card-body">
                    <h5 class="card-title text-dark text-truncate">${prod.Nombre}</h5>
                    <p class="card-text fw-bold">${prod.Precio}€</p>
                    <a href="./producto.php?id=${prod.ID_Producto}" class="btn btn-outline-primary btn-sm w-100">Ver Más</a>
                </div>
            </div>`;
        productosContainer.appendChild(div);
    }

    renderPaginacion();
}
function renderPaginacion() {
    paginacion.innerHTML = '';
    const totalPaginas = Math.ceil(productosFiltrados.length / porPagina);
    if (totalPaginas <= 1) return;

    for (let i = 1; i <= totalPaginas; i++) {
        const li = document.createElement('li');
        li.className = 'page-item' + (i === paginaActual ? ' active' : '');
        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.textContent = i;
        a.addEventListener('click', e => {
            e.preventDefault();
            paginaActual = i;
            renderProductos();
            window.scrollTo(0, 0);
        });
        li.appendChild(a);
        paginacion.appendChild(li);
    }
}

function aplicarFiltros() {
    const talla = filtroTalla.value.trim().toLowerCase();
    const categoria = filtroCategoria.value.trim().toLowerCase();
    const color = filtroColor.value.trim().toLowerCase();
    const buscar = inputBuscar.value.trim().toLowerCase();

    productosFiltrados = productos.filter(p => {
        const prodCategoria = (p.Categorias || '').toLowerCase();
        const prodTallas = (p.Tallas || []).map(t => t.toLowerCase());
        const prodColores = (p.Colores || []).map(c => c.toLowerCase());
        const prodNombre = (p.Nombre || '').toLowerCase();

        if (categoria && prodCategoria !== categoria) return false;
        if (talla && !prodTallas.includes(talla)) return false;
        if (color && !prodColores.includes(color)) return false;
        if (buscar && !prodNombre.includes(buscar)) return false;

        return true;
    });
    paginaActual = 1;
    renderProductos();
}

btnAplicarFiltros.addEventListener('click', aplicarFiltros);
btnBuscar.addEventListener('click', aplicarFiltros);
inputBuscar.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
        e.preventDefault();
        aplicarFiltros();
    }
});

renderProductos();
