let barberos = [];
const form = document.getElementById("barberoForm");
const tabla = document.getElementById("tablaBarberos");

form.addEventListener("submit", function (e) {
  e.preventDefault();
  const nuevo = {
    nombre: document.getElementById("nombre").value,
    especialidad: document.getElementById("especialidad").value,
    telefono: document.getElementById("telefono").value,
    turno: document.getElementById("turno").value,
    direccion: document.getElementById("direccion").value,
    trabajados: document.getElementById("trabajados").value,
    noTrabajados: document.getElementById("noTrabajados").value,
    paga: document.getElementById("paga").value,
  };

  const editIndex = document.getElementById("editIndex").value;
  if (editIndex === "") {
    barberos.push(nuevo);
  } else {
    barberos[editIndex] = nuevo;
    document.getElementById("editIndex").value = "";
  }

  form.reset();
  renderTabla();
});

function renderTabla() {
  tabla.innerHTML = "";
  barberos.forEach((b, i) => {
    tabla.innerHTML += `
      <tr>
        <td>${b.nombre}</td>
        <td>${b.especialidad}</td>
        <td>${b.telefono}</td>
        <td>${b.turno}</td>
        <td>${b.trabajados}</td>
        <td>${b.noTrabajados}</td>
        <td>${b.paga}</td>
        <td>
          <button class="btn btn-sm btn-primary me-1" onclick="editar(${i})">Editar</button>
          <button class="btn btn-sm btn-danger" onclick="eliminar(${i})">Eliminar</button>
        </td>
      </tr>
    `;
  });
}

function editar(i) {
  const b = barberos[i];
  document.getElementById("nombre").value = b.nombre;
  document.getElementById("especialidad").value = b.especialidad;
  document.getElementById("telefono").value = b.telefono;
  document.getElementById("turno").value = b.turno;
  document.getElementById("direccion").value = b.direccion;
  document.getElementById("trabajados").value = b.trabajados;
  document.getElementById("noTrabajados").value = b.noTrabajados;
  document.getElementById("paga").value = b.paga;
  document.getElementById("editIndex").value = i;
}

function eliminar(i) {
  if (confirm("¿Eliminar este barbero?")) {
    barberos.splice(i, 1);
    renderTabla();
  }
}

function cancelarEdicion() {
  form.reset();
  document.getElementById("editIndex").value = "";
}
