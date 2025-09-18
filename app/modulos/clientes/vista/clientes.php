<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Clientes - Barbería Elite</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-black text-warning p-4">

  <div class="text-center mb-4">
    <h2><i class="fas fa-users fa-lg me-2" style="color: #f39c12;"></i>Gestión de Clientes</h2>
  </div>

  <div class="container">
    <!-- Formulario -->
    <div class="border border-warning rounded p-4 mb-4">
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
    <div class="border border-warning rounded p-3">
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

  <!-- JavaScript -->
  <script src="/Agrupadoresjs/Gestion-clientes.js"></script> <!-- Esto no sirve de nada -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
