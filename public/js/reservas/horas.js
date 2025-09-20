document.addEventListener("DOMContentLoaded", function () {
    const fechaInput = document.querySelector("input[name='fecha']");
    const horaInput = document.querySelector("input[name='hora']");

    function ajustarHoraMin() {
      const hoy = new Date();
      const fechaSeleccionada = new Date(fechaInput.value);

      if (fechaSeleccionada.toDateString() === hoy.toDateString()) {
        // Si es hoy, limitar la hora mínima a la hora actual
        const horaActual = hoy.toISOString().substring(11, 16); // formato HH:MM
        horaInput.min = horaActual;
      } else {
        // Si no es hoy, la hora mínima puede ser desde las 00:00
        horaInput.min = "00:00";
      }
    }

    // Inicializar
    fechaInput.addEventListener("change", ajustarHoraMin);
    ajustarHoraMin(); // correr una vez al cargar
  });