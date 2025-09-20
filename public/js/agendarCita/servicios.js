(function () {
  // Helper: parsear precio desde strings tipo "20.000" o "20.000,50" o "20000"
  function parsePrice(priceStr) {
    if (priceStr == null) return 0;
    let s = String(priceStr).trim();
    // quitar símbolos y espacios
    s = s.replace(/\s/g, '').replace(/\$/g, '');
    // si hay tanto '.' como ',', asumimos que '.' son miles y ',' decimales -> normalizar
    if (s.indexOf('.') !== -1 && s.indexOf(',') !== -1) {
      s = s.replace(/\./g, '').replace(',', '.');
    } else {
      // quitar puntos (miles) y convertir comas a punto (si existieran)
      s = s.replace(/\./g, '').replace(',', '.');
    }
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : 0;
  }

  // Obtener array desde localStorage
  function getSelected() {
    return JSON.parse(localStorage.getItem('serviciosSeleccionados') || '[]');
  }
  function setSelected(arr) {
    localStorage.setItem('serviciosSeleccionados', JSON.stringify(arr));
  }

  // Actualizar estado del botón continuar
  function actualizarBotonContinuar() {
    const btn = document.querySelector('.btn-continue');
    if (!btn) return;
    const hay = getSelected().length > 0;
    btn.disabled = !hay;
  }

  // Actualizar total visual
  function actualizarTotal() {
    const totalElement = document.getElementById('total-amount');
    if (!totalElement) return;
    const servicios = getSelected();
    const total = servicios.reduce((acc, s) => acc + Number(s.precio || 0), 0);
    // mostrar con formato local
    totalElement.textContent = `$ ${total.toLocaleString('es-CO')}`;
  }

  // Crear nodo resumen para item
  function crearNodoResumen(id, nombre, precioStr, duracion) {
    const item = document.createElement('div');
    item.className = 'item';
    item.id = `resumen-${id}`;
    item.innerHTML = `
      <span style="display:flex; justify-content:space-between;">
        <span>${nombre}</span>
        <span>$ ${precioStr}</span>
      </span>
      <p class="duration" style="color:gray; font-size: 0.8em;">${duracion}</p>
    `;
    return item;
  }

  // Marca item en UI (selected + cambiar texto del botón)
  function marcarServiceUI(serviceEl, selected) {
    const btn = serviceEl.querySelector('.toggle-btn');
    if (selected) {
      serviceEl.classList.add('selected');
      if (btn) btn.textContent = '−';
    } else {
      serviceEl.classList.remove('selected');
      if (btn) btn.textContent = '+';
    }
  }

  // toggleService (función expuesta globalmente porque la vista la llama inline)
  window.toggleService = function (button) {
    if (!button) return;
    const service = button.closest('.service');
    if (!service) return;

    // Buscar id (soportamos varios formatos de input hidden)
    const idInput = service.querySelector('input[name="id_servicio"]') ||
                    service.querySelector('input#id_servicio') ||
                    service.querySelector('input[type="hidden"]');
    const id = idInput ? String(idInput.value) : (button.getAttribute('data-id') || button.getAttribute('data-name'));

    const name = button.getAttribute('data-name') || service.querySelector('h3')?.textContent?.trim() || 'Servicio';
    const priceStr = button.getAttribute('data-price') || service.querySelector('.price')?.textContent?.replace(/\$/g,'').trim() || '0';
    const price = parsePrice(priceStr);
    const duration = service.querySelector('.duration')?.textContent?.trim() || '';

    const summaryList = document.getElementById('sumary-list');
    if (!summaryList) return;

    let servicios = getSelected();

    const alreadySelected = service.classList.contains('selected');

    if (!alreadySelected) {
      // Añadir
      marcarServiceUI(service, true);

      // añadir al DOM resumen si no existe
      if (!document.getElementById(`resumen-${id}`)) {
        const nodo = crearNodoResumen(id, name, priceStr, duration);
        summaryList.appendChild(nodo);
      }

      servicios.push({
        id: id,
        nombre: name,
        precio: price,      // valor numérico para cálculos
        precioStr: priceStr, // string formateado para mostrar
        duracion: duration
      });

    } else {
      // Quitar
      marcarServiceUI(service, false);

      const nodoRem = document.getElementById(`resumen-${id}`);
      if (nodoRem) nodoRem.remove();

      servicios = servicios.filter(s => String(s.id) !== String(id));
    }

    // Guardar y actualizar totales
    setSelected(servicios);
    actualizarTotal();
    actualizarBotonContinuar();
  };

  // Reconstruir UI desde localStorage al cargar la página
  document.addEventListener('DOMContentLoaded', () => {
    const summaryList = document.getElementById('sumary-list');
    const totalElement = document.getElementById('total-amount');

    // 1) Reconstruir resumen y marcar services en la lista
    const servicios = getSelected();

    // Poblar resumen
    if (summaryList) {
      summaryList.innerHTML = '<h4>Resumen</h4>'; // conservar encabezado
      servicios.forEach(s => {
        // evitar duplicados
        if (!document.getElementById(`resumen-${s.id}`)) {
          const nodo = crearNodoResumen(s.id, s.nombre, s.precioStr ?? s.precio, s.duracion ?? '');
          summaryList.appendChild(nodo);
        }
      });
    }

    // Marcar elementos .service como selected si están en localStorage
    document.querySelectorAll('.service').forEach(serviceEl => {
      const idInput = serviceEl.querySelector('input[name="id_servicio"]') ||
                      serviceEl.querySelector('input#id_servicio') ||
                      serviceEl.querySelector('input[type="hidden"]');
      const id = idInput ? String(idInput.value) : null;
      if (id && servicios.some(s => String(s.id) === String(id))) {
        marcarServiceUI(serviceEl, true);
      } else {
        marcarServiceUI(serviceEl, false);
      }
    });

    // 2) Actualizar total y botón
    actualizarTotal();
    actualizarBotonContinuar();

    // 3) Listener botón continuar (redirige a equipo)
    const btnContinuar = document.querySelector('.btn-continue');
    if (btnContinuar) {
      btnContinuar.addEventListener('click', () => {
        // ya está guardado en localStorage, solo redirigimos
        window.location.href = 'equipo';
      });
    }

    // 4) Breadcrumb (marca la sección activa según path)
    (function marcarBreadcrumb() {
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
    })();

    // 5) Botones back / cancel
    const btnBack = document.querySelector('.btn-back');
    if (btnBack) {
      btnBack.addEventListener('click', () => window.history.back());
    }

    const btnCancel = document.querySelector('.btn-cancel');
    if (btnCancel) {
      btnCancel.addEventListener('click', () => {
        localStorage.removeItem('serviciosSeleccionados');
        window.location.href = '/barber/';
      });
    }
  });
})();
