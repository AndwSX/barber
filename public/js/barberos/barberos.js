const form = document.getElementById("barberoForm");
const tabla = document.getElementById("tablaBarberos");
const editIndex = document.getElementById("editIndex");

let barberos = [];

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const nombre = document.getElementById("nombre").value;
  const especialidad = document.getElementById("especialidad").value;
  const telefono = document.getElementById("telefono").value;
  const turno = document.getElementById("turno").value;
  const direccion = document.getElementById("direccion").value;

  const barbero = { nombre, especialidad, telefono, turno, direccion };

  if (editIndex.value === "") {
    // Agregar nuevo
    barberos.push(barbero);
  } else {
    // Editar existente
    barberos[editIndex.value] = barbero;
    editIndex.value = "";
  }

  form.reset();
  renderTabla();
});

function renderTabla() {
  tabla.innerHTML = "";
  barberos.forEach((barbero, index) => {
    tabla.innerHTML += `
      <tr>
        <td>${barbero.nombre}</td>
        <td>${barbero.especialidad}</td>
        <td>${barbero.telefono}</td>
        <td>${barbero.turno}</td>
        <td>${barbero.direccion}</td>
        <td>
          <button class="btn btn-sm btn-warning me-2" onclick="editarBarbero(${index})">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-sm btn-outline-danger" onclick="eliminarBarbero(${index})">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `;
  });
}

function editarBarbero(index) {
  const barbero = barberos[index];
  document.getElementById("nombre").value = barbero.nombre;
  document.getElementById("especialidad").value = barbero.especialidad;
  document.getElementById("telefono").value = barbero.telefono;
  document.getElementById("turno").value = barbero.turno;
  document.getElementById("direccion").value = barbero.direccion;

  editIndex.value = index;
}

function eliminarBarbero(index) {
  if (confirm("¿Seguro que quieres eliminar este barbero?")) {
    barberos.splice(index, 1);
    renderTabla();
  }
}

function cancelarEdicion() {
  form.reset();
  editIndex.value = "";
}
