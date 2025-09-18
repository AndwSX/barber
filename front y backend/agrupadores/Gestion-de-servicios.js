// Lista de servicios iniciales (ejemplos por defecto)
let servicios = [
  { nombre: "Corte de Cabello", descripcion: "Corte clásico y moderno", duracion: "30 min", precio: "15000" },
  { nombre: "Afeitado", descripcion: "Afeitado con toalla caliente", duracion: "20 min", precio: "10000" }
];

let editIndex = -1;

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("servicioForm");
  const container = document.getElementById("serviciosContainer");

  // Mostrar los servicios iniciales
  renderServicios();

  // Guardar servicio
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const nombre = document.getElementById("nombre").value.trim();
    const descripcion = document.getElementById("descripcion").value.trim();
    const duracion = document.getElementById("duracion").value.trim();
    const precio = document.getElementById("precio").value.trim();

    if (editIndex === -1) {
      // Agregar
      servicios.push({ nombre, descripcion, duracion, precio });
    } else {
      // Editar
      servicios[editIndex] = { nombre, descripcion, duracion, precio };
      editIndex = -1;
    }

    form.reset();
    renderServicios();
  });

  // Renderizar servicios
  function renderServicios() {
    container.innerHTML = "";
    servicios.forEach((servicio, index) => {
      const col = document.createElement("div");
      col.className = "col-md-4 mb-3";
      col.innerHTML = `
        <div class="card bg-black border border-warning h-100">
          <div class="card-body">
            <h5 class="card-title text-warning">${servicio.nombre}</h5>
            <p class="card-text text-white">${servicio.descripcion}</p>
            <p class="card-text text-white">Duración: ${servicio.duracion}</p>
            <p class="card-text fw-bold text-warning">Precio: $${servicio.precio}</p>
            <button class="btn btn-sm btn-warning text-black me-2" onclick="editarServicio(${index})">Editar</button>
            <button class="btn btn-sm btn-light text-black" onclick="eliminarServicio(${index})">Eliminar</button>
          </div>
        </div>
      `;
      container.appendChild(col);
    });
  }

  // Hacer accesibles las funciones globalmente
  window.editarServicio = (index) => {
    const servicio = servicios[index];
    document.getElementById("nombre").value = servicio.nombre;
    document.getElementById("descripcion").value = servicio.descripcion;
    document.getElementById("duracion").value = servicio.duracion;
    document.getElementById("precio").value = servicio.precio;
    editIndex = index;
  };

  window.eliminarServicio = (index) => {
    servicios.splice(index, 1);
    renderServicios();
  };
});
