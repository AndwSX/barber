// equipo.js (corregido navegación y continuar)
(function () {
  // Helper: parsear precios robustamente
  function parsePriceValue(val) {
    if (val == null) return 0;
    if (typeof val === 'number') return val;
    let s = String(val).trim();
    s = s.replace(/\s/g, '').replace(/\$/g, '');
    if (s.indexOf('.') !== -1 && s.indexOf(',') !== -1) {
      s = s.replace(/\./g, '').replace(',', '.');
    } else {
      s = s.replace(/\./g, '').replace(',', '.');
    }
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : 0;
  }

  // Guardar/leer barbero en localStorage
  function saveBarbero(obj) {
    localStorage.setItem('barberoSeleccionado', JSON.stringify(obj));
  }
  function getBarbero() {
    try {
      return JSON.parse(localStorage.getItem('barberoSeleccionado'));
    } catch (e) { return null; }
  }

  // Habilitar/deshabilitar continuar según barbero seleccionado
  function actualizarBotonContinuarBarbero() {
    const btn = document.querySelector('.btn-continue');
    if (!btn) return;
    btn.disabled = !getBarbero();
  }

  // Seleccionar barbero (se llama desde onclick inline en la card)
  window.seleccionarBarbero = function (card) {
    if (!card) return;

    // Deselecciona todos
    document.querySelectorAll('.barber-card').forEach(c => c.classList.remove('selected-barber'));
    card.classList.add('selected-barber');

    // Leer datos: preferir dataset
    const id_empleado = card.dataset.id || card.querySelector('input[name="id_empleado"]')?.value || null;
    const nombre = card.dataset.nombre || card.getAttribute('data-nombre') || card.querySelector('h3')?.textContent || 'Barbero';
    const rating = card.dataset.rating || card.getAttribute('data-rating') || '';
    const foto = card.dataset.foto || card.getAttribute('data-foto') || '';

    // Mostrar mini resumen
    const resumen = document.getElementById('barbero-resumen');
    if (resumen) {
      resumen.innerHTML = `
        <div class="barber-summary-card">
          <img src="${foto}" alt="${nombre}" class="barber-summary-photo">
          <div class="barber-summary-info">
            <strong>${nombre}</strong>
            <p>⭐ ${rating}</p>
          </div>
        </div>
      `;
    }

    // Guardar en localStorage
    saveBarbero({ id_empleado, nombre, rating, foto });

    actualizarBotonContinuarBarbero();
  };

  // Reconstruir servicios + total
  function reconstruirServiciosYTotal() {
    const servicios = JSON.parse(localStorage.getItem('serviciosSeleccionados') || '[]');
    const contenedor = document.getElementById('sumary-list');
    if (!contenedor) return;

    contenedor.innerHTML = '';
    let total = 0;

    servicios.forEach(servicio => {
      const precioVal = parsePriceValue(servicio.precio);
      total += precioVal;

      const item = document.createElement('div');
      item.className = 'item';
      item.innerHTML = `
        <span style="display:flex; justify-content:space-between;">
          <span>${servicio.nombre}</span>
          <span>$ ${precioVal.toLocaleString('es-CO')}</span>
        </span>
        <p class="duration" style="color:gray; font-size: 0.8em;">${servicio.duracion || ''}</p>
      `;
      contenedor.appendChild(item);
    });

    const totalAmount = document.getElementById('total-amount');
    if (totalAmount) totalAmount.textContent = `$ ${total.toLocaleString('es-CO')}`;

    // Habilitar botón si hay servicios y barbero
    const btn = document.querySelector('.btn-continue');
    if (btn) btn.disabled = !(servicios.length > 0 && getBarbero());
  }

  // --- INIT ---
  document.addEventListener('DOMContentLoaded', () => {
    // Reconstruir resumen
    reconstruirServiciosYTotal();

    // Si había barbero guardado, mostrarlo
    const existing = getBarbero();
    if (existing) {
      const resumen = document.getElementById('barbero-resumen');
      if (resumen) {
        resumen.innerHTML = `
          <div class="barber-summary-card">
            <img src="${existing.foto}" alt="${existing.nombre}" class="barber-summary-photo">
            <div class="barber-summary-info">
              <strong>${existing.nombre}</strong>
              <p>⭐ ${existing.rating}</p>
            </div>
          </div>
        `;
      }
    }

    // Botones navegación
    document.querySelector('.btn-back')?.addEventListener('click', () => {
      window.history.back();
    });

    document.querySelector('.btn-cancel')?.addEventListener('click', () => {
      localStorage.removeItem('serviciosSeleccionados');
      localStorage.removeItem('barberoSeleccionado');
      window.location.href = BASE_PATH; // ruta home
    });

    // Botón continuar
    const btn = document.querySelector('.btn-continue');
    if (btn) {
      btn.addEventListener('click', () => {
        const servicios = JSON.parse(localStorage.getItem('serviciosSeleccionados') || '[]');
        const barbero = getBarbero();

        if (!servicios.length) {
          alert('Selecciona al menos un servicio.');
          return;
        }
        if (!barbero) {
          alert('Selecciona un profesional.');
          return;
        }

        window.location.href = BASE_PATH + '/agendar-cita/horario';
      });
    }
  });
})();
