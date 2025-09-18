<div class="container">
  <h2 class="mb-4 text-warning text-center">
    <i class="fas fa-scissors me-2"></i> Gestión de Barberos
  </h2>

  <div class="card bg-dark border-warning mb-4">
    <div class="card-body">
      <form id="barberoForm">
        <input type="hidden" id="editIndex">

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label text-warning">Nombre completo</label>
            <input type="text" class="form-control bg-dark text-white border-warning" id="nombre" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-warning">Especialidad</label>
            <input type="text" class="form-control bg-dark text-white border-warning" id="especialidad" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-warning">Teléfono</label>
            <input type="text" class="form-control bg-dark text-white border-warning" id="telefono" required>
          </div>
          <div class="col-md-6">
            <label class="form-label text-warning">Turno</label>
            <select class="form-select bg-dark text-white border-warning" id="turno">
              <option>Mañana</option>
              <option>Tarde</option>
              <option>Noche</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-warning">Dirección</label>
            <input type="text" class="form-control bg-dark text-white border-warning" id="direccion">
          </div>
          <div class="col-md-3">
            <label class="form-label text-warning">Días trabajados</label>
            <input type="number" class="form-control bg-dark text-white border-warning" id="trabajados">
          </div>
          <div class="col-md-3">
            <label class="form-label text-warning">Días no trabajados</label>
            <input type="number" class="form-control bg-dark text-white border-warning" id="noTrabajados">
          </div>
          <div class="col-md-3">
            <label class="form-label text-warning">Paga por día ($)</label>
            <input type="number" class="form-control bg-dark text-white border-warning" id="paga">
          </div>
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-warning me-2">Guardar</button>
            <button type="button" onclick="cancelarEdicion()" class="btn btn-outline-warning">Cancelar</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <div class="card bg-dark border-warning">
    <div class="card-body">
      <h5 class="card-title">Lista de Barberos</h5>
      <div class="table-responsive">
        <table class="table table-dark table-bordered border-warning">
          <thead class="table-warning text-dark">
            <tr>
              <th>Nombre</th>
              <th>Especialidad</th>
              <th>Teléfono</th>
              <th>Turno</th>
              <th>Trabajados</th>
              <th>No trabajados</th>
              <th>Paga</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tablaBarberos"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
