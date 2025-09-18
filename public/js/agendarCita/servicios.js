  function toggleService(button) {
  const service = button.closest('.service');
  const isSelected = service.classList.contains('selected');
  const name = button.getAttribute('data-name');
  const priceStr = button.getAttribute('data-price');
  const price = parseFloat(priceStr.replace('.', ''));
  const duration = service.querySelector('.duration')?.textContent || '';
  const summaryList = document.getElementById('sumary-list');
  const totalAmount = document.getElementById('total-amount');

  // Leer o inicializar
  let serviciosSeleccionados = JSON.parse(localStorage.getItem('serviciosSeleccionados')) || [];

  if (!isSelected) {
    service.classList.add('selected');
    button.textContent = '−';

    // Agregar al resumen
    if (!document.getElementById(`resumen-${name}`)) {
      const item = document.createElement('div');
      item.classList.add('item');
      item.id = `resumen-${name}`;
      item.innerHTML = `
        <span style="display:flex; justify-content:space-between;">
          <span>${name}</span>
          <span>$ ${priceStr}</span>
        </span>
        <p class="duration" style="color:gray; font-size: 0.8em;">${duration}</p>
      `;
      summaryList.appendChild(item);
    }

    // Agregar al localStorage
    serviciosSeleccionados.push({ nombre: name, precio: priceStr, duracion: duration });

  } else {
    service.classList.remove('selected');
    button.textContent = '+';

    // Quitar del resumen
    const itemToRemove = document.getElementById(`resumen-${name}`);
    if (itemToRemove) itemToRemove.remove();

    // Quitar del localStorage
    serviciosSeleccionados = serviciosSeleccionados.filter(s => s.nombre !== name);
  }

  // Guardar actualizado
localStorage.setItem('serviciosSeleccionados', JSON.stringify(serviciosSeleccionados));


  // Guardar actualizado
  localStorage.setItem('serviciosSeleccionados', JSON.stringify(serviciosSeleccionados));

  // Recalcular total
  let total = 0;
  serviciosSeleccionados.forEach(servicio => {
    const p = parseFloat(servicio.precio.replace('.', ''));
    total += p;
  });
  totalAmount.textContent = `$ ${total.toLocaleString('es-CO')}`;

  actualizarBotonContinuar();
}

  function actualizarBotonContinuar() {
  const btnContinuar = document.querySelector('.btn-continue');
  const haySeleccionados = document.querySelectorAll('.service.selected').length > 0;
  btnContinuar.disabled = !haySeleccionados;
}

 document.addEventListener('DOMContentLoaded', () => {
    const btnContinuar = document.querySelector('.btn-continue');
   btnContinuar.addEventListener('click', () => {
  const serviciosSeleccionados = Array.from(
    document.querySelectorAll('.service.selected')
  ).map(service => {
    const btn = service.querySelector('.toggle-btn');
    return {
      nombre: btn.getAttribute('data-name'),
      precio: btn.getAttribute('data-price'),
      duracion: service.querySelector('.duration')?.textContent || ''
    };
  });

  // Guardar en localStorage
  

  // Redirigir a la página del barbero
  window.location.href = `equipo`;
});

  });

document.addEventListener('DOMContentLoaded', () => {

  const secciones = [
    { ruta: '/barber/agendar-cita/servicios', texto: 'Servicios' },
    { ruta: '/barber/agendar-cita/equipo', texto: 'Equipo' },
    { ruta: '/barber/agendar-cita/horario', texto: 'Horario' },
    { ruta: '/barber/agendar-cita/confirmar', texto: 'Confirmar' },
  ];

  const path = window.location.pathname;
  const breadcrumbSpans = document.querySelectorAll('.breadcrumb span');

  secciones.forEach(seccion => {
    if (path === seccion.ruta) {
      breadcrumbSpans.forEach(span => {
        if (span.textContent.trim() === seccion.texto) {
          span.classList.add('active');
        }
      });
    }
  });
});

  // Volver a la página anterior
document.querySelector('.btn-back')?.addEventListener('click', () => {
  window.history.back();
});

// Cancelar todo y volver al inicio
document.querySelector('.btn-cancel')?.addEventListener('click', () => {
  localStorage.removeItem('serviciosSeleccionados');
  window.location.href = '/barber/';
});


