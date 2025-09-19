
  <h3 class="text-warning mb-4">Gestión de Citas</h3>

  <!-- Formulario de Citas -->
  <div class="border border-warning bg-black p-3 rounded">
    <h5 class="text-warning mb-3">Formulario de Cita</h5>
    <div class="row">
      <div class="col-md-6">
        <label class="text-warning">Nombre del Cliente</label>
        <input type="text" id="cliente" class="form-control bg-dark text-white">
      </div>
      <div class="col-md-6">
        <label class="text-warning">Teléfono</label>
        <input type="text" id="telefono" class="form-control bg-dark text-white">
      </div>
      <div class="col-md-6">
        <label class="text-warning">Correo Electrónico</label>
        <input type="email" id="correo" class="form-control bg-dark text-white">
      </div>
      <div class="col-md-3">
        <label class="text-warning">Fecha</label>
        <input type="date" id="fecha" class="form-control bg-dark text-white">
      </div>
      <div class="col-md-3">
        <label class="text-warning">Hora</label>
        <input type="time" id="hora" class="form-control bg-dark text-white">
      </div>
      <div class="col-md-6">
        <label class="text-warning">Barbero</label>
        <select id="barbero" class="form-select bg-dark text-white">
          <option>Juan Andres</option>
          <option>Pedro Ramirez</option>
          <option>Carlos Gómez</option>
          <option>Andres Castillo</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="text-warning">Servicio</label>
        <select id="servicio" class="form-select bg-dark text-white" onchange="actualizarDuracion()">
          <option value="" disabled selected>Seleccione</option>
          <option value="Corte">Corte</option>
          <option value="Barba">Barba</option>
          <option value="Corte + Barba">Corte + Barba</option>
          <option value="Bigote">Bigote</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="text-warning">Duración</label>
        <input type="text" id="duracion" class="form-control bg-dark text-white" readonly>
      </div>
      <div class="col-md-3">
        <label class="text-warning">Estado</label>
        <select id="estado" class="form-select bg-dark text-white">
          <option>Disponible</option>
          <option>Ocupado</option>
          <option>No disponible</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="text-warning">Tipo de Servicio</label>
        <select id="tipoServicio" class="form-select bg-dark text-white">
          <option>En la Barbería</option>
          <option>Domicilio</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="text-warning">Reservó por</label>
        <select id="reservaPor" class="form-select bg-dark text-white">
          <option>WhatsApp</option>
          <option>Llamada</option>
        </select>
      </div>
    </div>

    <div class="mt-2 text-light">
      <strong>Política de Cancelación:</strong> 24 horas de anticipación
    </div>

    <div class="mt-4">
      <button class="btn btn-warning" onclick="guardarCita()">Guardar Cambios</button>
      <button class="btn btn-secondary" onclick="limpiarFormulario()">Cancelar</button>
    </div>
  </div>

  <!-- Tabla de Citas -->
  <div class="border border-warning bg-black mt-4 p-3 rounded">
    <table class="table table-bordered text-center">
      <thead class="table-warning">
        <tr>
          <th>Cliente</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Barbero</th>
          <th>Servicio</th>
          <th>Duración</th>
          <th>Estado</th>
          <th>Tipo</th>
          <th>Reservó por</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tablaCitas" class="table-dark text-white">
      </tbody>
    </table>
  </div>

  <script src="/Agrupadoresjs/Hora.js"></script>
</body>
</html>
