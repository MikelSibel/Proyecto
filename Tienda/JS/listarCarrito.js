document.addEventListener("DOMContentLoaded", () => {
    const carrito = JSON.parse(localStorage.getItem("carrito")) || {};
    const listaCarrito = document.getElementById("lista-carrito");
    let totalProductos = 0;
    let totalDescuento = 0;
    const totalEnvio = 5.00; 

    function crearProductoHTML(id, producto) {
        const descuento = producto.descuento ? parseFloat(producto.descuento) : 0;
        const precioUnitario = parseFloat(producto.precio);
        const cantidad = producto.cantidad;
        const totalProducto = (precioUnitario - descuento) * cantidad;

        totalProductos += precioUnitario * cantidad;
        totalDescuento += descuento * cantidad;

        return `
        <div class="row my-4" data-id="${id}">
            <div class="col-md-4">
                <img src="${producto.imagen1}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h4>${producto.nombre}</h4>
                <p>${producto.descripcion}</p>
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary me-2 btn-restar" type="button">-</button>
                    <input type="number" class="form-control w-25 cantidad-input" value="${cantidad}" min="1">
                    <button class="btn btn-outline-secondary ms-2 btn-sumar" type="button">+</button>
                </div>
            </div>
            <div class="col-md-2">
                <h3>Resumen</h3>
                <p><strong>Precio unitario:</strong> ${precioUnitario.toFixed(2)}€</p>
                <p><strong>Total:</strong> ${totalProducto.toFixed(2)}€</p>
            </div>
        </div>
        `;
    }

    listaCarrito.innerHTML = "";
    for (const id in carrito) {
        const producto = carrito[id];
        listaCarrito.innerHTML += crearProductoHTML(id, producto);
    }

    document.getElementById("total-productos").textContent = totalProductos.toFixed(2) + "€";

if (Object.keys(carrito).length === 0) {
    document.getElementById("total-envio").textContent = "";
    document.getElementById("total-final").textContent = "";
} else {
    document.getElementById("total-envio").textContent = totalEnvio.toFixed(2) + "€";
    document.getElementById("total-final").textContent = (totalProductos - totalDescuento + totalEnvio).toFixed(2) + "€";
}

    function actualizarCarrito(id, nuevaCantidad) {
        if (nuevaCantidad < 1) nuevaCantidad = 1;
        carrito[id].cantidad = nuevaCantidad;
        localStorage.setItem("carrito", JSON.stringify(carrito));
        location.reload();
    }

    listaCarrito.querySelectorAll(".row").forEach(row => {
        const id = row.getAttribute("data-id");
        const btnRestar = row.querySelector(".btn-restar");
        const btnSumar = row.querySelector(".btn-sumar");
        const inputCantidad = row.querySelector(".cantidad-input");

        btnRestar.addEventListener("click", () => {
            let val = parseInt(inputCantidad.value);
            val = isNaN(val) ? 1 : val - 1;
            if (val < 1) val = 1;
            inputCantidad.value = val;
            actualizarCarrito(id, val);
        });

        btnSumar.addEventListener("click", () => {
            let val = parseInt(inputCantidad.value);
            val = isNaN(val) ? 1 : val + 1;
            inputCantidad.value = val;
            actualizarCarrito(id, val);
        });

        inputCantidad.addEventListener("change", () => {
            let val = parseInt(inputCantidad.value);
            if (isNaN(val) || val < 1) val = 1;
            inputCantidad.value = val;
            actualizarCarrito(id, val);
        });
    });

    const formPedido = document.getElementById('form-pedido');
    if(formPedido){
        formPedido.addEventListener('submit', () => {
            localStorage.removeItem('carrito');
        });
    }
});
