document.addEventListener("DOMContentLoaded", function () 
{
    const ofertasContainer = document.getElementById("ofertas");
    const paginationContainer = document.getElementById("pagination");
    const elementosPorPagina = 6;
    let paginaActual = 1;

    function mostrarOfertas(ofertas, pagina) 
    {
        const inicio = (pagina - 1) * elementosPorPagina;
        const fin = inicio + elementosPorPagina;
        const ofertasPagina = ofertas.slice(inicio, fin);

        ofertasContainer.innerHTML = "";
        ofertasPagina.forEach(oferta => 
            {
            const ofertaHtml = `
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">${oferta.Nombre}</h5>
                            <p class="card-text"><strong>Empresa:</strong> ${oferta.Empresa}</p>
                            <p class="card-text"><strong>Ubicación:</strong> ${oferta.Ubicacion}</p>
                            <p class="card-text"><strong>Salario:</strong> ${oferta.Salario ? parseFloat(oferta.Salario).toFixed(2) : 'No especificado'}</p>
                            <a href="/Proyecto/PHP/oferta.php?id=${oferta.CodOf}" class="btn btn-primary">Ver Detalles</a>
                            ${rol === 'profesor' && oferta.Prof_Crea_Of === profesor_id ? `
                                <a href='/Proyecto/PHP/modificarOferta.php?id=${oferta.CodOf}' class='btn btn-warning'>Modificar</a>
                                <form method='POST' class='d-inline' id='eliminarForm_${oferta.CodOf}' action='/Proyecto/PHP/eliminaOferta.php'>
                                    <input type='hidden' name='id_oferta' value='${oferta.CodOf}'>
                                    <button type='submit' class='btn btn-danger ms-2'>Eliminar</button>
                                </form>` : rol === 'alumno' ? `
                                <form id='form_${oferta.CodOf}' class='d-inline'>
                                    <input type='hidden' name='id_oferta' value='${oferta.CodOf}'>
                                    <button type='button' onclick='guardarFavorito(${oferta.CodOf})' class='btn btn-success' ${oferta.Favorito ? 'disabled' : ''}>${oferta.Favorito ? 'Añadido' : 'Añadir a favoritos'}</button>
                                </form>` : ``}
                        </div>
                    </div>
                </div>
            `;
            ofertasContainer.innerHTML += ofertaHtml;
        });
    }

    function crearBotonPaginacion(numero) 
    {
        const li = document.createElement("li");
        li.classList.add("page-item");
        const a = document.createElement("a");
        a.classList.add("page-link");
        a.href = "#";
        a.textContent = numero;
        a.addEventListener("click", function () 
        {
            paginaActual = numero;
            mostrarOfertas(ofertas, paginaActual);
            actualizarEstadoBotones();
        });
        li.appendChild(a);
        paginationContainer.appendChild(li);
    }

    function actualizarEstadoBotones() 
    {
        const botones = paginationContainer.querySelectorAll(".page-link");
        botones.forEach(boton => {
            if (parseInt(boton.textContent) === paginaActual) {
                boton.parentElement.classList.add("active");
            } else {
                boton.parentElement.classList.remove("active");
            }
        });
    }

    function inicializarPaginacion(ofertas) 
    {
        paginationContainer.innerHTML = "";
        const totalPaginas = Math.ceil(ofertas.length / elementosPorPagina);
        for (let i = 1; i <= totalPaginas; i++) 
        {
            crearBotonPaginacion(i);
        }
        actualizarEstadoBotones();
    }

    window.guardarFavorito = function(codOferta) 
    {
        const form = document.getElementById(`form_${codOferta}`);
        const button = form.querySelector('button');

        if (button.disabled) return;

        const formData = new FormData(form);

        fetch('/Proyecto/PHP/guardarOfertaFavorita.php', 
        {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            button.textContent = 'Añadido';
            button.disabled = true;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };
    mostrarOfertas(ofertas, paginaActual);
    inicializarPaginacion(ofertas);
});
