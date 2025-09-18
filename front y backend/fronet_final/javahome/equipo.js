 //nav botones
        // Volver a la página anterior
document.querySelector('.btn-back')?.addEventListener('click', () => {
  window.history.back();
});

// Cancelar todo y volver al inicio
document.querySelector('.btn-cancel')?.addEventListener('click', () => {
  localStorage.removeItem('serviciosSeleccionados');
  window.location.href = 'index2.0.html';
});

      //saber en que seccion estoy
       document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;

    const secciones = [
      { archivo: 'servicios.html', texto: 'Servicios' },
      { archivo: 'equipo.html', texto: 'Equipo' },
      { archivo: 'horario.html', texto: 'Horario' },
      { archivo: 'confirmar.html', texto: 'Confirmar' },
    ];

    const breadcrumbSpans = document.querySelectorAll('.breadcrumb span');

    secciones.forEach(seccion => {
      if (path.includes(seccion.archivo)) {
        breadcrumbSpans.forEach(span => {
          if (span.textContent.trim() === seccion.texto) {
            span.classList.add('active');
          }
        });
      }
    });
  });

  //barbero seleccionado
function actualizarBotonContinuarBarbero() {
  console.log('verificando barbero seleccionado...')
  const btnContinuar = document.querySelector('.btn-continue');
  const hayBarberoSeleccionado = !!document.querySelector('.barber-card.selected-barber');
  btnContinuar.disabled = !hayBarberoSeleccionado;
}

//seleccionar o quitar servicios
function toggleService(button) {
  const service = button.closest('.service'); // Obtiene el contenedor del servicio
  const isSelected = service.classList.contains('selected'); // ¿Ya está seleccionado?
  const name = button.getAttribute('data-name');
  const priceStr = button.getAttribute('data-price'); // Precio como texto (ej. "20000")
  const price = parseFloat(priceStr.replace('.', '')); // Convierte a número
  const duration = service.querySelector('.duration')?.textContent || '';
  const summaryList = document.getElementById('sumary-list');
  const totalAmount = document.getElementById('total-amount');
}

//guardar servicios seleccionados y redirigir


//funcion para seleccionar un barbero
function seleccionarBarbero(card) {
  // Deselecciona todos
  document.querySelectorAll('.barber-card').forEach(c => c.classList.remove('selected-barber'));

  // Selecciona el clicado
  card.classList.add('selected-barber');

  // Obtiene la info
  const nombre = card.getAttribute('data-nombre');
  const rating = card.getAttribute('data-rating') || '';
  const foto = card.getAttribute('data-foto');

  // Muestra la miniatura del barbero en el resumen
  const resumen = document.getElementById('barbero-resumen');
  resumen.innerHTML = `
    <div class="barber-summary-card">
      <img src="${foto}" alt="${nombre}" class="barber-summary-photo">
      <div class="barber-summary-info">
        <strong>${nombre}</strong>
        <p>⭐ ${rating}</p>
      </div>
    </div>
  `;

  // Guarda en localStorage
  const barberoSeleccionado = { nombre, rating, foto };
  localStorage.setItem('barberoSeleccionado', JSON.stringify(barberoSeleccionado));

  actualizarBotonContinuarBarbero();

}
 


//recupera los servicios desdeel local al cargar la pagina
document.addEventListener('DOMContentLoaded', () => {
  const serviciosSeleccionados = JSON.parse(localStorage.getItem('serviciosSeleccionados')) || [];
  const resumenServiciosContainer = document.getElementById('sumary-list');

  if (serviciosSeleccionados.length > 0) {
    if (!resumenServiciosContainer) {
      const resumen = document.createElement('div');
      resumen.id = 'sumary-list';
      resumen.classList.add('sumary-services-list');
      document.querySelector('.sumary-services').appendChild(resumen);
    }

    const contenedor = document.getElementById('sumary-list');
    contenedor.innerHTML = '';

    serviciosSeleccionados.forEach(servicio => {
      const item = document.createElement('div');
      item.classList.add('item');
      item.innerHTML = `
        <span style="display:flex; justify-content:space-between;">
          <span>${servicio.nombre}</span>
          <span>$ ${servicio.precio}</span>
        </span>
        <p class="duration" style="color:gray; font-size: 0.8em;">${servicio.duracion}</p>
      `;
      contenedor.appendChild(item);
    });

    // Calcula el total
    const total = serviciosSeleccionados.reduce((acc, cur) => {
      const precioNum = parseFloat(cur.precio.replace('.', ''));
      return acc + precioNum;
    }, 0);

    // Muestra el total
    const totalAmount = document.getElementById('total-amount');
    totalAmount.textContent = `$ ${total.toLocaleString('es-CO')}`;

    // Activa el botón continuar
    document.querySelector('.btn-continu').disabled = false;
  }
});

function actualizarBotonContinuarBarbero() {
  const btn = document.querySelector('.btn-continue');
  const barberoSeleccionado = localStorage.getItem('barberoSeleccionado');
  btn.disabled = !barberoSeleccionado;
}

document.addEventListener('DOMContentLoaded', () => {
  actualizarBotonContinuarBarbero();

  const btn = document.querySelector('.btn-continue');
  btn.addEventListener('click', () => {
    window.location.href = 'horarios.html';
  });
});

