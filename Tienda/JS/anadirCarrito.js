document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("anadirCarrito");
  
    let carrito = JSON.parse(localStorage.getItem("carrito")) || {};
  
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      const nombre = btn.dataset.nombre;
      const descripcion = btn.dataset.descripcion;
      const precio = btn.dataset.precio;
      const imagen1 = btn.dataset.imagen;
  
      if (carrito.hasOwnProperty(id)) {
        carrito[id].cantidad += 1;
      } else {
        carrito[id] = {
          nombre: nombre,
          descripcion: descripcion,
          precio: precio,
          imagen1: imagen1,
          cantidad: 1
        };
      }
  
      localStorage.setItem("carrito", JSON.stringify(carrito));
      console.log("Carrito actualizado:", carrito);
    });
  });
  