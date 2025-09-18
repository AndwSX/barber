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
      { archivo: 'horarios.html', texto: 'Horario' },
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
   

    // Ir a horarios.html
    window.location.href = 'confirmar.html';
  });
});

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
    document.querySelector('.btn-continue').disabled = false;
  }
});

const carrusel = document.getElementById('carrusel-fechas');
const diasSemana = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

const hoy = new Date();
const diasAMostrar = 365; // Un año

for (let i = 0; i < diasAMostrar; i++) {
  const fecha = new Date(hoy);
  fecha.setDate(hoy.getDate() + i);

  const diaTexto = diasSemana[fecha.getDay()];
  const dia = fecha.getDate().toString().padStart(2, '0');
  const mes = meses[fecha.getMonth()];
  const año = fecha.getFullYear();

  const fechaLabel = `${diaTexto}<br><span>${dia} ${mes} ${año}</span>`;

  const div = document.createElement('div');
  div.className = 'fecha';
  div.innerHTML = fechaLabel;
 div.dataset.fecha = `${fecha.getFullYear()}-${(fecha.getMonth()+1).toString().padStart(2,'0')}-${fecha.getDate().toString().padStart(2,'0')}`;
  div.onclick = () => seleccionarFecha(div);
  carrusel.appendChild(div);
}

// Desplazamiento tipo carrusel con botones
function moverCarrusel(direccion) {
  const scrollContainer = document.getElementById('scrollArea');
  const cantidadDesplazar = 300; // píxeles por clic
  scrollContainer.scrollLeft += direccion * cantidadDesplazar;
}

// Selección de fecha
function seleccionarFecha(div) {
  document.querySelectorAll('.fecha').forEach(f => f.classList.remove('seleccionada'));
  div.classList.add('seleccionada');

  mostrarHorarios(div.dataset.fecha);
  localStorage.setItem('fechaSeleccionada', div.dataset.fecha);

  mostrarResumenFinal();

}

// Mostrar horarios disponibles para una fecha
function mostrarHorarios(fechaSeleccionada) {
  const horasContenedor = document.getElementById('horas-disponibles');
  horasContenedor.innerHTML = ''; // Limpiar

  // Agregar título principal
  const titulo = document.createElement('h3');
  titulo.textContent = 'Horas disponibles:';
  titulo.className = 'titulo-horas';
  horasContenedor.appendChild(titulo);

  const bloques = {
    mañana: ['08:00 AM', '09:00 AM', '10:00 AM', '11:00 AM'],
    tarde: ['12:00 PM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM', '06:00 PM'],
    noche: ['07:00 PM', '08:00 PM']
  };

  const bloqueHoras = document.createElement('div');
  bloqueHoras.className = 'bloque-horas';

  for (const periodo in bloques) {
    const columna = document.createElement('div');
    columna.className = 'columna-horas';

    const tituloPeriodo = document.createElement('h4');
    tituloPeriodo.textContent = periodo.toUpperCase();
    columna.appendChild(tituloPeriodo);

    bloques[periodo].forEach(hora => {
      const h = document.createElement('div');
      h.className = 'hora';
      h.textContent = hora;
      h.onclick = () => seleccionarHora(h);
      columna.appendChild(h);
    });

    bloqueHoras.appendChild(columna);
  }

  horasContenedor.appendChild(bloqueHoras);
}






// Seleccionar hora
function seleccionarHora(div) {
  document.querySelectorAll('.hora').forEach(h => h.classList.remove('seleccionada'));
  div.classList.add('seleccionada');

  const horaSeleccionada = div.textContent;
  localStorage.setItem('horaSeleccionada', horaSeleccionada);

  mostrarResumenFinal();
}

function seleccionarHorario(boton) {
  // Deseleccionar todos
  document.querySelectorAll('.horario').forEach(b => b.classList.remove('selected-horario'));

  // Seleccionar el actual
  boton.classList.add('selected-horario');

  // Guardar en localStorage
  const fecha = boton.getAttribute('data-fecha');
  const hora = boton.getAttribute('data-hora');
  const horarioSeleccionado = { fecha, hora };

  localStorage.setItem('horarioSeleccionado', JSON.stringify(horarioSeleccionado));


}

//mostrar los dos servicios
document.addEventListener('DOMContentLoaded', () => {
  const barbero = JSON.parse(localStorage.getItem('barberoSeleccionado')) || {};
  const servicios = JSON.parse(localStorage.getItem('serviciosSeleccionados')) || [];

  const resumenBarbero = document.getElementById('barbero-resumen');
  const resumenServicios = document.getElementById('sumary-list');
  const totalAmount = document.getElementById('total-amount');
  const btnContinuar = document.querySelector('.btn-continue');

  // Mostrar barbero si hay
  if (barbero.nombre) {
    resumenBarbero.innerHTML += `
      <div class="barber-summary-card" style="display:flex; gap:10px; align-items:center;">
        <img src="${barbero.foto}" alt="${barbero.nombre}" class="barber-summary-photo" style="width:50px; border-radius:50%;">
        <div>
          <strong>${barbero.nombre}</strong><br>
          <span>⭐ ${barbero.rating || 'Sin calificación'}</span>
        </div>
      </div>
    `;
  }

  // Mostrar servicios si hay
  if (servicios.length > 0 && resumenServicios ) {
    resumenServicios.innerHTML = ''; // Limpiar
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
    btnContinuar.disabled = false;
  }
});
//mostrar fecha y hora
function mostrarResumenFinal() {
  const fecha = localStorage.getItem('fechaSeleccionada');
  const hora = localStorage.getItem('horaSeleccionada');

  if (fecha && hora) {
   
    const partes = fecha.split('-'); // yyyy-mm-dd
const fechaLocal = new Date(partes[0], partes[1] - 1, partes[2]); // mes en base 0

const fechaFormateada = fechaLocal.toLocaleDateString('es-CO', {
  weekday: 'long',
  day: 'numeric',
  month: 'long'
});


    const fechaMostrada = document.getElementById('fecha-mostrada');
    const horaMostrada = document.getElementById('hora-mostrada');

    if (fechaMostrada) fechaMostrada.textContent = `Fecha: ${fechaFormateada}`;
    if (horaMostrada) horaMostrada.textContent = `Hora: ${hora}`;

    const btnContinuar = document.querySelector('.btn-continue');
    if (btnContinuar) btnContinuar.disabled = false;
  }
}



document.addEventListener('DOMContentLoaded', () => {

  mostrarResumenFinal();
});


