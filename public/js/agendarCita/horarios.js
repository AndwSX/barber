// horarios.js (corregido y funcional)

(function () {
  // --- Helper para parsear precios ---
  function parsePriceValue(val) {
    if (val == null) return 0;
    if (typeof val === "number") return val;
    let s = String(val).trim();
    s = s.replace(/\s/g, "").replace(/\$/g, "");
    if (s.indexOf(".") !== -1 && s.indexOf(",") !== -1) {
      s = s.replace(/\./g, "").replace(",", ".");
    } else {
      s = s.replace(/\./g, "").replace(",", ".");
    }
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : 0;
  }

  // --- Botones navegación ---
  document.querySelector(".btn-back")?.addEventListener("click", () => {
    window.history.back();
  });

  document.querySelector(".btn-cancel")?.addEventListener("click", () => {
    localStorage.removeItem("serviciosSeleccionados");
    localStorage.removeItem("barberoSeleccionado");
    localStorage.removeItem("fechaSeleccionada");
    localStorage.removeItem("horaSeleccionada");
    window.location.href = "/barber/";
  });

  // --- Carrusel de fechas ---
  const carrusel = document.getElementById("carrusel-fechas");
  const diasSemana = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];
  const meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

  const hoy = new Date();
  const diasAMostrar = 365; // 1 año

  for (let i = 0; i < diasAMostrar; i++) {
    const fecha = new Date(hoy);
    fecha.setDate(hoy.getDate() + i);

    const diaTexto = diasSemana[fecha.getDay()];
    const dia = fecha.getDate().toString().padStart(2, "0");
    const mes = meses[fecha.getMonth()];
    const año = fecha.getFullYear();

    const fechaLabel = `${diaTexto}<br><span>${dia} ${mes} ${año}</span>`;

    const div = document.createElement("div");
    div.className = "fecha";
    div.innerHTML = fechaLabel;
    div.dataset.fecha = `${año}-${(fecha.getMonth() + 1).toString().padStart(2, "0")}-${dia}`;
    div.onclick = () => seleccionarFecha(div);

    carrusel.appendChild(div);
  }

  function moverCarrusel(direccion) {
    const scrollContainer = document.getElementById("scrollArea");
    scrollContainer.scrollLeft += direccion * 300; // píxeles por click
  }

  // --- Selección de fecha ---
  function seleccionarFecha(div) {
    document.querySelectorAll(".fecha").forEach((f) => f.classList.remove("seleccionada"));
    div.classList.add("seleccionada");

    localStorage.setItem("fechaSeleccionada", div.dataset.fecha);
    mostrarHorarios(div.dataset.fecha);
    mostrarResumen();
  }

  // --- Mostrar horarios filtrando horas pasadas si es hoy ---
  function mostrarHorarios(fechaSeleccionada) {
    const horasContenedor = document.getElementById("horas-disponibles");
    horasContenedor.innerHTML = "";

    const titulo = document.createElement("h3");
    titulo.textContent = "Horas disponibles:";
    horasContenedor.appendChild(titulo);

    const bloques = {
      mañana: ["08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM"],
      tarde: ["12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM", "06:00 PM"],
      noche: ["07:00 PM", "08:00 PM"],
    };

    const hoyISO = new Date().toISOString().split("T")[0]; // yyyy-mm-dd
    const fechaHoy = new Date();
    const fechaEsHoy = fechaSeleccionada === hoyISO;

    const bloqueHoras = document.createElement("div");
    bloqueHoras.className = "bloque-horas";

    for (const periodo in bloques) {
      const columna = document.createElement("div");
      columna.className = "columna-horas";

      const tituloPeriodo = document.createElement("h4");
      tituloPeriodo.textContent = periodo.toUpperCase();
      columna.appendChild(tituloPeriodo);

      bloques[periodo].forEach((horaTexto) => {
        const match = horaTexto.match(/(\d+):(\d+) (\wM)/);
        if (!match) return;
        const [_, hora, minutos, meridiano] = match;
        let hora24 = parseInt(hora, 10);
        if (meridiano === "PM" && hora24 !== 12) hora24 += 12;
        if (meridiano === "AM" && hora24 === 12) hora24 = 0;

        const horaDate = new Date(fechaHoy);
        horaDate.setHours(hora24, parseInt(minutos), 0, 0);

        if (fechaEsHoy && horaDate < fechaHoy) return; // no mostrar horas pasadas

        const h = document.createElement("div");
        h.className = "hora";
        h.textContent = horaTexto;
        h.onclick = () => seleccionarHora(h);
        columna.appendChild(h);
      });

      bloqueHoras.appendChild(columna);
    }

    horasContenedor.appendChild(bloqueHoras);
  }

  // --- Seleccionar hora ---
  function seleccionarHora(div) {
    document.querySelectorAll(".hora").forEach((h) => h.classList.remove("seleccionada"));
    div.classList.add("seleccionada");

    localStorage.setItem("horaSeleccionada", div.textContent);
    mostrarResumen();
  }

  // --- Mostrar resumen final ---
  function mostrarResumen() {
    const barbero = JSON.parse(localStorage.getItem("barberoSeleccionado") || "{}");
    const servicios = JSON.parse(localStorage.getItem("serviciosSeleccionados") || "[]");
    const fecha = localStorage.getItem("fechaSeleccionada");
    const hora = localStorage.getItem("horaSeleccionada");

    // --- Barbero ---
    const resumenBarbero = document.getElementById("barbero-resumen");
    if (resumenBarbero) {
      resumenBarbero.innerHTML = "<h4>Barbero</h4>";
      if (barbero.nombre) {
        resumenBarbero.innerHTML += `
          <div class="barber-summary-card">
            <img src="${barbero.foto}" alt="${barbero.nombre}" class="barber-summary-photo">
            <div>
              <strong>${barbero.nombre}</strong><br>
              <span>⭐ ${barbero.rating || "Sin calificación"}</span>
            </div>
          </div>
        `;
      }
    }

    // --- Servicios ---
    const resumenServicios = document.getElementById("sumary-list");
    let total = 0;
    if (resumenServicios) {
      resumenServicios.innerHTML = "";
      servicios.forEach((servicio) => {
        const precioNum = parsePriceValue(servicio.precio ?? servicio.precioStr);
        total += precioNum;

        const item = document.createElement("div");
        item.classList.add("item");
        item.innerHTML = `
          <span style="display:flex; justify-content:space-between;">
            <span>${servicio.nombre}</span>
            <span>$ ${precioNum.toLocaleString("es-CO")}</span>
          </span>
          <p class="duration" style="color:gray; font-size:0.8em;">${servicio.duracion || ""}</p>
        `;
        resumenServicios.appendChild(item);
      });
      document.getElementById("total-amount").textContent = `$ ${total.toLocaleString("es-CO")}`;
    }

    // --- Fecha y hora ---
    if (fecha) {
      const fechaLocal = new Date(fecha + "T00:00:00");
      const fechaFormateada = fechaLocal.toLocaleDateString("es-CO", {
        weekday: "long",
        day: "numeric",
        month: "long",
      });
      document.getElementById("fecha-mostrada").textContent = `Fecha: ${fechaFormateada}`;
    }
    if (hora) {
      document.getElementById("hora-mostrada").textContent = `Hora: ${hora}`;
    }

    // --- Habilitar continuar ---
    const btn = document.querySelector(".btn-continue");
    if (btn) {
      btn.disabled = !(barbero.nombre && servicios.length > 0 && fecha && hora);
      btn.onclick = () => {
        if (!btn.disabled) window.location.href = "confirmar";
      };
    }
  }

  // --- Inicializar ---
  document.addEventListener("DOMContentLoaded", () => {
    // Marcar fecha y hora guardadas si existen
    const fechaSel = localStorage.getItem("fechaSeleccionada");
    if (fechaSel) {
      const div = document.querySelector(`.fecha[data-fecha="${fechaSel}"]`);
      if (div) div.classList.add("seleccionada");
      mostrarHorarios(fechaSel);
    }
    const horaSel = localStorage.getItem("horaSeleccionada");
    if (horaSel) {
      const div = Array.from(document.querySelectorAll(".hora")).find((h) => h.textContent === horaSel);
      if (div) div.classList.add("seleccionada");
    }

    mostrarResumen();
  });
})();
