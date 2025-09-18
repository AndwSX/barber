let citas = [];

function actualizarDuracion() {
  const servicio = document.getElementById('servicio').value;
  let duracion = '';
  if (servicio === 'Corte') duracion = '30 minutos';
  if (servicio === 'Barba') duracion = '15 minutos';
  if (servicio === 'Corte + Barba') duracion = '45 minutos';
  if (servicio === 'Bigote') duracion = '10 minutos';
  document.getElementById('duracion').value = duracion;
}

function guardarCita() {
  const cliente = document.getElementById('cliente').value;
  const telefono = document.getElementById('telefono').value;
  const correo = document.getElementById('correo').value;
  const fecha = document.getElementById('fecha').value;
  const hora = document.getElementById('hora').value;
  const barbero = document.getElementById('barbero').value;
  const servicio = document.getElementById('servicio').value;
  const duracion = document.getElementById('duracion').value;
  const estado = document.getElementById('estado').value;
  const tipoServicio = document.getElementById('tipoServicio').value;
  const reservaPor = document.getElementById('reservaPor').value;

  if (cliente && telefono && fecha && hora && servicio && duracion) {
    citas.push({ cliente, telefono, correo, fecha, hora, barbero, servicio, duracion, estado, tipoServicio, reservaPor });
    renderizarTabla();
    limpiarFormulario();
  } else {
    alert('Complete todos los campos requeridos');
  }
}

function renderizarTabla() {
  const tbody = document.getElementById('tablaCitas');
  tbody.innerHTML = '';
  citas.forEach((cita, index) => {
    tbody.innerHTML += `
      <tr>
        <td>${cita.cliente}</td>
        <td>${cita.telefono}</td>
        <td>${cita.correo}</td>
        <td>${cita.fecha}</td>
        <td>${cita.hora}</td>
        <td>${cita.barbero}</td>
        <td>${cita.servicio}</td>
        <td>${cita.duracion}</td>
        <td>${cita.estado}</td>
        <td>${cita.tipoServicio}</td>
        <td>${cita.reservaPor}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick="editarCita(${index})">Editar</button>
          <button class="btn btn-danger btn-sm" onclick="eliminarCita(${index})">Eliminar</button>
        </td>
      </tr>
    `;
  });
}

function editarCita(index) {
  const cita = citas[index];
  document.getElementById('cliente').value = cita.cliente;
  document.getElementById('telefono').value = cita.telefono;
  document.getElementById('correo').value = cita.correo;
  document.getElementById('fecha').value = cita.fecha;
  document.getElementById('hora').value = cita.hora;
  document.getElementById('barbero').value = cita.barbero;
  document.getElementById('servicio').value = cita.servicio;
  document.getElementById('duracion').value = cita.duracion;
  document.getElementById('estado').value = cita.estado;
  document.getElementById('tipoServicio').value = cita.tipoServicio;
  document.getElementById('reservaPor').value = cita.reservaPor;

  citas.splice(index, 1);
  renderizarTabla();
}

function eliminarCita(index) {
  if (confirm('¿Está seguro de eliminar esta cita?')) {
    citas.splice(index, 1);
    renderizarTabla();
  }
}

function limpiarFormulario() {
  document.getElementById('cliente').value = '';
  document.getElementById('telefono').value = '';
  document.getElementById('correo').value = '';
  document.getElementById('fecha').value = '';
  document.getElementById('hora').value = '';
  document.getElementById('barbero').value = 'Juan Andres';
  document.getElementById('servicio').value = '';
  document.getElementById('duracion').value = '';
  document.getElementById('estado').value = 'Disponible';
  document.getElementById('tipoServicio').value = 'En la Barbería';
  document.getElementById('reservaPor').value = 'WhatsApp';
}
