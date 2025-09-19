<div class="container mt-4">
  <h2 class="text-center text-warning mb-4">Gestión de Servicios</h2>

  <!-- Formulario -->
  <div class="card bg-dark border-warning mb-4">
    <div class="card-header bg-warning text-dark">
      <?= ($action ?? 'crear') === 'editar' ? '✏️ Editar Servicio' : '➕ Nuevo Servicio' ?>
    </div>
    <div class="card-body">
      <form method="POST" action="<?= ($action ?? 'crear') === 'editar' 
                          ? "/barber/panel/servicios/".($idServicio ?? '')."/editar" 
                          : "/barber/panel/servicios/crear" ?>">
        <input type="hidden" name="id_servicio" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label text-warning">Nombre</label>
            <input type="text" name="nombre" class="form-control bg-dark text-white border-warning" required value="<?= htmlspecialchars($servicioData["nombre"] ?? '') ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label text-warning">Duración (minutos)</label>
            <input type="number" name="duracion_min" class="form-control bg-dark text-white border-warning" required min="1" value="<?= htmlspecialchars($servicioData["duracion_min"] ?? '') ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label text-warning">Descripción</label>
          <textarea name="descripcion" class="form-control bg-dark text-white border-warning" rows="3" required><?= htmlspecialchars($servicioData["descripcion"] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label text-warning">Precio (COP)</label>
          <input type="number" name="precio" class="form-control bg-dark text-white border-warning" step="0.01" required value="<?= htmlspecialchars($servicioData["precio"] ?? '') ?>">
        </div>

        <div class="col-12 text-end">
          <button type="submit" class="btn btn-warning me-2">
            <?= ($action ?? 'crear') === 'editar' ? 'Actualizar' : 'Crear Servicio' ?>
          </button>

          <?php if ($action === "editar"): ?>
            <a href="/barber/panel/servicios" class="btn btn-outline-warning">Cancelar</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>

  <!-- Lista de servicios -->
  <div class="card bg-dark border-warning">
    <div class="card-header border-warning text-white">Lista de Servicios</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-dark table-bordered border-warning">
          <thead class="table-warning text-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Duración</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($stmt as $row): ?>
            <tr>
              <td><?= $row['id_servicio'] ?></td>
              <td><?= htmlspecialchars($row['nombre']) ?></td>
              <td><?= $row['duracion_min'] ?> min</td>
              <td><span class="badge bg-warning">$<?= number_format($row['precio'], 0, ',', '.') ?></span></td>
              <td>
                <a href="/barber/panel/servicios/<?= $row['id_servicio'] ?>/editar" class="btn btn-sm btn-warning">Editar</a>
                <a href="/barber/panel/servicios/<?= $row['id_servicio'] ?>/eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este servicio?')">Eliminar</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
