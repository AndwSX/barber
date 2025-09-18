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
        <button class="btn btn-warning">Editar</button>
      </div>
    </div>
  `;

  document.getElementById("contenedor-promociones").appendChild(nueva);

  // Limpiar el formulario
  document.getElementById("nombrePromo").value = "";
  document.getElementById("descripcionPromo").value = "";
  document.getElementById("tipoPromo").value = "💥";
}
