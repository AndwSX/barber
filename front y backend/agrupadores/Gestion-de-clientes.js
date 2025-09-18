function agregarCliente() {
  const nombre = document.getElementById('nombreCliente').value;
  const telefono = document.getElementById('telefonoCliente').value;
  const ultima = document.getElementById('ultimaVisita').value;
  const proxima = document.getElementById('proximaCita').value;
  const servicio = document.getElementById('servicioFavorito').value;

  if (!nombre || !telefono) return;

  const fila = `
    <tr>
      <td>${nombre}</td>
      <td>${telefono}</td>
      <td>${ultima}</td>
      <td>${proxima}</td>
      <td>${servicio}</td>
      <td>
        <button class="btn btn-primary btn-sm me-1"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
      </td>
    </tr>
  `;

  document.getElementById('tablaClientes').insertAdjacentHTML('beforeend', fila);

  // Limpiar campos
  document.getElementById('nombreCliente').value = '';
  document.getElementById('telefonoCliente').value = '';
  document.getElementById('ultimaVisita').value = '';
  document.getElementById('proximaCita').value = '';
  document.getElementById('servicioFavorito').value = '';
}

