document.addEventListener("DOMContentLoaded", function () {
    const ofertasPopularesContainer = document.getElementById("ofertas_populares");

    function mostrarOfertasPopulares(ofertas) 
    {
        ofertas.forEach(oferta => {
            const ofertaHtml = `
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">${oferta.Nombre}</h5>
                            <p class="card-text"><strong>Empresa:</strong> ${oferta.Empresa}</p>
                            <p class="card-text"><strong>Ubicación:</strong> ${oferta.Ubicacion}</p>
                            <p class="card-text"><strong>Salario:</strong> ${oferta.Salario ? " " + parseFloat(oferta.Salario).toFixed(2) : 'No especificado'}</p>
                            <a href="/Proyecto/PHP/oferta.php?id=${oferta.CodOf}" class="btn btn-primary">Ver Detalles</a>
                            ${rol === 'profesor'? `
                                <a href='/Proyecto/PHP/modificarOferta.php?id=${oferta.CodOf}' class='btn btn-warning'>Modificar</a>
                                <form method='POST' class='d-inline' id='eliminarForm_${oferta.CodOf}' action='/Proyecto/PHP/eliminaOferta.php'>
                                    <input type='hidden' name='id_oferta' value='${oferta.CodOf}'>
                                    <button type='submit' class='btn btn-danger ms-2'>Eliminar</button>
                                </form>` : ''}
                        </div>
                    </div>
                </div>
            `;
            ofertasPopularesContainer.innerHTML += ofertaHtml;
        });
    }

    mostrarOfertasPopulares(ofertas);
});
