<div class="container">
  <div class="text-center text-warning mb-4">
    <h2><i class="fas fa-users fa-lg me-2"></i>Gestión de Clientes</h2>
  </div>
  <!-- Formulario -->
  <div class="border bg-black border-warning rounded p-4 mb-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nombre completo</label>
        <input type="text" class="form-control bg-dark text-light border-warning" id="nombreCliente" placeholder="Ej: Juan Pérez">
      </div>
      <div class="col-md-6">
        <label class="form-label">Teléfono</label>
        <input type="text" class="form-control bg-dark text-light border-warning" id="telefonoCliente" placeholder="Ej: +573001234567">
      </div>
      <div class="col-md-6">
        <label class="form-label">Última visita</label>
        <input type="date" class="form-control bg-dark text-light border-warning" id="ultimaVisita">
      </div>
      <div class="col-md-6">
        <label class="form-label">Próxima cita</label>
        <input type="date" class="form-control bg-dark text-light border-warning" id="proximaCita">
      </div>
      <div class="col-md-12">
        <label class="form-label">Servicio favorito</label>
        <input type="text" class="form-control bg-dark text-light border-warning" id="servicioFavorito" placeholder="Ej: Corte, barba...">
      </div>
      <div class="col-md-12 text-end">
        <button class="btn btn-warning mt-3 me-2" onclick="agregarCliente()">
          <i class="fas fa-user-plus me-1"></i>Agregar Cliente
        </button>
        <button class="btn btn-outline-warning mt-3">
          <i class="fas fa-times me-1"></i>Cancelar
        </button>
      </div>
    </div>
  </div>

  <!-- Tabla -->
  <div class="border border-warning bg-black rounded p-3">
    <div class="table-responsive">
      <table class="table table-dark table-bordered border-warning align-middle text-center">
        <thead class="table-warning text-black">
          <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Última Visita</th>
            <th>Próxima Cita</th>
            <th>Servicio Favorito</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaClientes"></tbody>
      </table>
    </div>
  </div>
</div>