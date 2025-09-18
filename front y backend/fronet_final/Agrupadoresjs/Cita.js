// Configurar min date para fecha y hora - no permitir fechas pasadas
const fechaInput = document.getElementById('fecha');
function actualizarMinFecha() {
  const ahora = new Date();
  // Ajustar para formato datetime-local yyyy-MM-ddThh:mm
  const yyyy = ahora.getFullYear();
  const mm = String(ahora.getMonth() + 1).padStart(2, '0');
  const dd = String(ahora.getDate()).padStart(2, '0');
  const hh = String(ahora.getHours()).padStart(2, '0');
  const min = String(ahora.getMinutes()).padStart(2, '0');
  fechaInput.min = `${yyyy}-${mm}-${dd}T${hh}:${min}`;
}
actualizarMinFecha();

// Validación Bootstrap + envío simulado
(() => {
  'use strict';

  const form = document.getElementById('formReserva');

  form.addEventListener(
    'submit',
    (event) => {
      event.preventDefault();
      event.stopPropagation();

      // Actualizar min fecha en cada submit para evitar fechas pasadas
      actualizarMinFecha();

      if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
      }

      // Extraer datos
      const nombre = document.getElementById('nombre').value.trim();
      const telefono = document.getElementById('telefono').value.trim();
      const servicio = document.getElementById('servicio').value;
      const fecha = document.getElementById('fecha').value;

      // Mostrar confirmación
      alert(
        `Gracias ${nombre}.\n\nTu cita para "${servicio}" está reservada para el ${new Date(
          fecha
        ).toLocaleString()}.\n\nTe contactaremos al ${telefono}.`
      );

      // Reiniciar formulario y quitar validación
      form.reset();
      form.classList.remove('was-validated');
    },
    false
  );
})();
