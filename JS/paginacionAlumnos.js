document.addEventListener("DOMContentLoaded", function () {
    const alumnosContainer = document.getElementById("alumnos");
    const paginationContainer = document.getElementById("pagination");
    const formFiltrarEstado = document.getElementById("formFiltrarEstado");
    const formBusqueda = document.getElementById("formBusqueda");
    const inputBusqueda = document.getElementById("inputBusqueda");
    const elementosPorPagina = 6;
    let paginaActual = 1;

    function mostrarAlumnos(alumnos, pagina) 
    {
        const inicio = (pagina - 1) * elementosPorPagina;
        const fin = inicio + elementosPorPagina;
        const alumnosPagina = alumnos.slice(inicio, fin);

        alumnosContainer.innerHTML = "";
        alumnosPagina.forEach(alumno => {
            const fotoPerfil = alumno.Foto ? alumno.Foto : '/proyecto/fotos_perfil/generica.png';
            const alumnoHtml = `
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <img class="perfil-img" src="${fotoPerfil}" class="card-img-top" alt="Foto de perfil">
                            <h5 class="card-title">${alumno.Nombre} ${alumno.Apellido_1} ${alumno.Apellido_2}</h5>
                            <p class="card-text"><strong>Teléfono:</strong> ${alumno.Tel}</p>
                            <p class="card-text"><strong>Estado:</strong> ${alumno.Estado}</p>
                        </div>
                    </div>
                </div>
            `;
            alumnosContainer.innerHTML += alumnoHtml;
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
        a.addEventListener("click", function () {
            paginaActual = numero;
            mostrarAlumnos(alumnos, paginaActual);
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

    function inicializarPaginacion(alumnos) 
    {
        paginationContainer.innerHTML = "";
        const totalPaginas = Math.ceil(alumnos.length / elementosPorPagina);
        for (let i = 1; i <= totalPaginas; i++) {
            crearBotonPaginacion(i);
        }
        actualizarEstadoBotones();
    }

    formFiltrarEstado.addEventListener("submit", function (event) 
    {
        event.preventDefault();
        const estadoSeleccionado = formFiltrarEstado.filtroEstado.value;
        const alumnosFiltrados = filtrarAlumnosPorEstado(alumnos, estadoSeleccionado);
        mostrarAlumnos(alumnosFiltrados, 1);
        inicializarPaginacion(alumnosFiltrados);
    });

    function filtrarAlumnosPorEstado(alumnos, estado) 
    {
        if (estado === "") {
            return alumnos; 
        }
        return alumnos.filter(alumno => alumno.Estado === estado);
    }

    formBusqueda.addEventListener("submit", function (event) {
        event.preventDefault();
        const busqueda = inputBusqueda.value.trim().toLowerCase();
        if (busqueda === "") {
            mostrarAlumnos(alumnos, 1); 
            inicializarPaginacion(alumnos);
            return;
        }
        const alumnosFiltrados = filtrarAlumnosPorNombre(alumnos, busqueda);
        mostrarAlumnos(alumnosFiltrados, 1);
        inicializarPaginacion(alumnosFiltrados);
    });

    function filtrarAlumnosPorNombre(alumnos, busqueda) {
        return alumnos.filter(alumno => {
            const nombreCompleto = `${alumno.Nombre} ${alumno.Apellido_1} ${alumno.Apellido_2}`.toLowerCase();
            return nombreCompleto.includes(busqueda);
        });
    }

    mostrarAlumnos(alumnos, paginaActual);
    inicializarPaginacion(alumnos);
});
