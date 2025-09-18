 // Volver a la página anterior
        document.querySelector('.btn-back')?.addEventListener('click', () => {
  window.history.back();
});
// Cancelar todo y volver al inicio
document.querySelector('.btn-cancel')?.addEventListener('click', () => {
  localStorage.removeItem('serviciosSeleccionados');
  window.location.href = '/barber/';
});

//saber en que seccion estoy
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

//2.0

document.addEventListener('DOMContentLoaded', () => {
  mostrarServiciosYBarbero();
  mostrarResumenFinal();
  manejarFormulario();
});

function mostrarServiciosYBarbero() {
  const barbero = JSON.parse(localStorage.getItem('barberoSeleccionado')) || {};
  const servicios = JSON.parse(localStorage.getItem('serviciosSeleccionados')) || [];

  const resumenBarbero = document.getElementById('barbero-resumen');
  const resumenServicios = document.getElementById('sumary-list');
  const totalAmount = document.getElementById('total-amount');
  const btnContinuar = document.querySelector('.btn-continue');

  if (barbero.nombre && resumenBarbero) {
    resumenBarbero.innerHTML = `
      <div class="barber-summary-card" style="display:flex; gap:10px; align-items:center;">
        <img src="${barbero.foto}" alt="${barbero.nombre}" class="barber-summary-photo" style="width:50px; border-radius:50%;">
        <div>
          <strong>${barbero.nombre}</strong><br>
          <span>⭐ ${barbero.rating || 'Sin calificación'}</span>
        </div>
      </div>
    `;
  }

  if (servicios.length > 0 && resumenServicios) {
    resumenServicios.innerHTML = '';
    let total = 0;

    servicios.forEach(servicio => {
      const precio = parseFloat(servicio.precio.replace('.', ''));
      total += precio;

      const item = document.createElement('div');
      item.classList.add('item');
      item.innerHTML = `
        <span style="display:flex; justify-content:space-between;">
          <span>${servicio.nombre}</span>
          <span>$ ${servicio.precio}</span>
        </span>
        <p class="duration" style="color:gray; font-size: 0.8em;">${servicio.duracion}</p>
      `;
      resumenServicios.appendChild(item);
    });

    totalAmount.textContent = `$ ${total.toLocaleString('es-CO')}`;
    if (btnContinuar) btnContinuar.disabled = false;
  }
}

function mostrarResumenFinal() {
  const fecha = localStorage.getItem('fechaSeleccionada');
  const hora = localStorage.getItem('horaSeleccionada');

  if (fecha && hora) {
    const partes = fecha.split('-');
    const fechaLocal = new Date(partes[0], partes[1] - 1, partes[2]);

    const fechaFormateada = fechaLocal.toLocaleDateString('es-CO', {
      weekday: 'long',
      day: 'numeric',
      month: 'long'
    });

    const fechaMostrada = document.getElementById('fecha-mostrada');
    const horaMostrada = document.getElementById('hora-mostrada');

    if (fechaMostrada) fechaMostrada.textContent = `Fecha: ${fechaFormateada}`;
    if (horaMostrada) horaMostrada.textContent = `Hora: ${hora}`;
  }
}

function manejarFormulario() {
  const formulario = document.getElementById('form-confirmacion');
  const mensajeExito = document.getElementById('mensaje-exito');

  if (!formulario || !mensajeExito) return;

  formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    mensajeExito.style.display = 'block';
    formulario.reset();

    // ✅ Limpiar localStorage
    localStorage.removeItem('barberoSeleccionado');
    localStorage.removeItem('serviciosSeleccionados');
    localStorage.removeItem('fechaSeleccionada');
    localStorage.removeItem('horaSeleccionada');

    // ✅ Redirigir al home después de 4 segundos
    setTimeout(() => {
      mensajeExito.style.display = 'none';
      window.location.href = '/barber/';
    }, 4000);
  });
}

document.getElementById("form-confirmacion").addEventListener("submit", async function(e) {
  e.preventDefault();

  // Datos del formulario
  const nombre = document.getElementById("nombre").value.trim();
  const correo = document.getElementById("email").value.trim();
  const pais = document.getElementById("pais").value;
  const telefono = document.getElementById("telefono").value.trim();

  // Datos del resumen lateral
  const fecha = document.querySelector("#resumen-horario #fecha-mostrada").textContent.replace("Fecha: ", "").trim();
  const hora = document.querySelector("#resumen-horario #hora-mostrada").textContent.replace("Hora: ", "").trim();
  const servicio = document.querySelector("#sumary-list").textContent.trim(); // todo el texto de servicios seleccionados

  // Validar que no haya campos vacíos
  if (!nombre || !correo || !fecha || !hora || !servicio) {
    alert("Por favor completa todos los datos de la reserva.");
    return;
  }

  const data = { nombre, correo, pais, telefono, fecha, hora, servicio };

  try {
    const res = await fetch("/barber/agendar-cita/guardar", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });

    const resultado = await res.json();

    if (resultado.success) {
      document.getElementById("mensaje-exito").style.display = "block";
      document.getElementById("mensaje-exito").textContent = "✅ Reserva exitosa. Se ha enviado el correo de confirmación.";
      document.getElementById("form-confirmacion").reset();
    } else {
      alert("Error: " + resultado.message);
    }
  } catch (error) {
    console.error("Error al enviar reserva:", error);
    alert("Ocurrió un error al enviar la reserva. Intenta nuevamente.");
  }
});
