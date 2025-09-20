// confirmar.js
(function () {
  // --- Helpers ---
  function parsePrice(priceStr) {
    if (priceStr == null) return 0;
    let s = String(priceStr).trim();
    s = s.replace(/\s/g, '').replace(/\$/g, '');
    if (s.indexOf('.') !== -1 && s.indexOf(',') !== -1) {
      s = s.replace(/\./g, '').replace(',', '.');
    } else {
      s = s.replace(/\./g, '').replace(',', '.');
    }
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : 0;
  }

  // --- Reconstrucción de datos ---
  function mostrarResumen() {
    const barbero = JSON.parse(localStorage.getItem('barberoSeleccionado') || '{}');
    const servicios = JSON.parse(localStorage.getItem('serviciosSeleccionados') || '[]');
    const fecha = localStorage.getItem('fechaSeleccionada');
    const hora = localStorage.getItem('horaSeleccionada');

    // Barbero
    const resumenBarbero = document.getElementById('barbero-resumen');
    if (resumenBarbero) {
      resumenBarbero.innerHTML = '<h4>Barbero</h4>';
      if (barbero.nombre) {
        resumenBarbero.innerHTML += `
          <div class="barber-summary-card">
            <img src="${barbero.foto}" alt="${barbero.nombre}" class="barber-summary-photo">
            <div>
              <strong>${barbero.nombre}</strong><br>
              <span>⭐ ${barbero.rating || 'Sin calificación'}</span>
            </div>
          </div>
        `;
      }
    }

    // Servicios
    const resumenServicios = document.getElementById('sumary-list');
    let total = 0;
    if (resumenServicios) {
      resumenServicios.innerHTML = '';
      servicios.forEach(servicio => {
        const precioNum = parsePrice(servicio.precioStr ?? servicio.precio);
        total += precioNum;

        const item = document.createElement('div');
        item.classList.add('item');
        item.innerHTML = `
          <span style="display:flex; justify-content:space-between;">
            <span>${servicio.nombre}</span>
            <span>$ ${precioNum.toLocaleString('es-CO')}</span>
          </span>
          <p class="duration" style="color:gray; font-size:0.8em;">${servicio.duracion ?? ''}</p>
        `;
        resumenServicios.appendChild(item);
      });
      document.getElementById('total-amount').textContent = `$ ${total.toLocaleString('es-CO')}`;
    }

    // Fecha y hora
    if (fecha) {
      const fechaLocal = new Date(fecha);
      const fechaFormateada = fechaLocal.toLocaleDateString('es-CO', {
        weekday: 'long', day: 'numeric', month: 'long'
      });
      document.getElementById('fecha-mostrada').textContent = `Fecha: ${fechaFormateada}`;
    }
    if (hora) {
      document.getElementById('hora-mostrada').textContent = `Hora: ${hora}`;
    }
  }

  // --- Enviar reserva ---
  async function enviarReserva(datosCliente) {
    const barbero = JSON.parse(localStorage.getItem('barberoSeleccionado') || '{}');
    const servicios = JSON.parse(localStorage.getItem('serviciosSeleccionados') || '[]');
    const fecha = localStorage.getItem('fechaSeleccionada');
    const hora = localStorage.getItem('horaSeleccionada');

    // Construir payload exactamente como lo pides
    const payload = {
      cliente: {
        nombre: datosCliente.nombre,
        email: datosCliente.email,
        telefono: `+${datosCliente.pais}${datosCliente.telefono}`
      },
      servicios: servicios.map(s => s.id),
      barbero: barbero.id_empleado,
      fecha: fecha,
      hora: hora
    };

    try {
      const res = await fetch('/barber/api/reservas', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });

      if (!res.ok) throw new Error('Error al guardar la reserva');
      return await res.json();
    } catch (err) {
      console.error(err);
      alert('No se pudo completar la reserva.');
      return null;
    }
  }

  // --- Inicializar ---
  document.addEventListener('DOMContentLoaded', () => {
    mostrarResumen();

    // Botones back / cancel
    document.querySelector('.btn-back')?.addEventListener('click', () => window.history.back());
    document.querySelector('.btn-cancel')?.addEventListener('click', () => {
      localStorage.clear();
      window.location.href = '/barber/';
    });

    // Formulario confirmación
    const form = document.getElementById('form-confirmacion');
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const datosCliente = {
          nombre: form.nombre.value.trim(),
          email: form.email.value.trim(),
          telefono: form.telefono.value.trim(),
          pais: form.pais.value
        };

        if (!datosCliente.nombre || !datosCliente.email || !datosCliente.telefono) {
          alert('Por favor completa todos los campos obligatorios.');
          return;
        }

        const resultado = await enviarReserva(datosCliente);
        if (resultado) {
          document.getElementById('mensaje-exito').style.display = 'block';
          setTimeout(() => {
            localStorage.clear();
            window.location.href = '/barber/';
          }, 2000);
        }
      });
    }
  });
})();
