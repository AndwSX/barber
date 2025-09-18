function agregarPromocion() {
  const nombre = document.getElementById("nombrePromo").value.trim();
  const descripcion = document.getElementById("descripcionPromo").value.trim();
  const tipo = document.getElementById("tipoPromo").value;

  if (nombre === "" || descripcion === "") {
    alert("Por favor completa todos los campos.");
    return;
  }

  const nueva = document.createElement("div");
  nueva.className = "col-md-6";
  nueva.innerHTML = `
    <div class="card bg-black text-white border border-warning">
      <div class="card-body text-center">
        <div class="display-4 mb-3 text-warning">${tipo}</div>
        <h5 class="card-title text-white">${nombre}</h5>
        <p class="card-text text-light">${descripcion}</p>
        <button class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  `;
  
  // Agregar el div con la promoción al contenedor
  document.getElementById("contenedor-promociones").appendChild(nueva);

  // Agregar evento de eliminación al botón
  const botonEliminar = nueva.querySelector("button");
  botonEliminar.addEventListener("click", function() {
    // Eliminar el contenedor completo de la promoción
    nueva.remove();
  });

  // Limpiar formulario
  document.getElementById("nombrePromo").value = "";
  document.getElementById("descripcionPromo").value = "";
  document.getElementById("tipoPromo").value = "💥";
}
