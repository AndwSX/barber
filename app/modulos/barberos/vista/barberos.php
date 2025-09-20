<div class="container mt-4">
  <h2 class="mb-4 text-warning text-center">
    <i class="fas fa-scissors me-2"></i> Gestión de Barberos
  </h2>

  <div class="card bg-black border-warning mb-4">
    <div class="card-body">
      <form method="POST" 
      action="<?= ($action ?? 'crear') === 'editar' 
                  ? "/barber/panel/empleados/".($idEmpleado ?? '')."/editar" 
                  : "/barber/panel/empleados/crear" ?>">
         <input type="hidden" name="id_empleado" value="<?= $idEmpleado ?? '' ?>">

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label text-warning">Nombre completo</label>
            <input type="text" class="form-control bg-dark text-white border-warning" name="nombre" required value="<?= htmlspecialchars($empleadoData["nombre"] ?? '') ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label text-warning">Correo</label>
            <input type="email" class="form-control bg-dark text-white border-warning" name="correo" required value="<?= htmlspecialchars($empleadoData["correo"] ?? '') ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label text-warning">Especialidad</label>
            <select name="especialidad" class="form-select bg-dark text-white border-warning" required>
              <option value="">Selecciona...</option>
              <option value="Barbero" <?= ($empleadoData["especialidad"] ?? '') == 'Barbero' ? 'selected' : '' ?>>Barbero</option>
              <option value="Corte de Cabello" <?= ($empleadoData["especialidad"] ?? '') == 'Corte de Cabello' ? 'selected' : '' ?>>Corte de Cabello</option>
              <option value="Afeitado Clásico" <?= ($empleadoData["especialidad"] ?? '') == 'Afeitado Clásico' ? 'selected' : '' ?>>Afeitado Clásico</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label text-warning">Teléfono</label>
            <input type="tel" class="form-control bg-dark text-white border-warning" name="telefono" required value="<?= htmlspecialchars($empleadoData["telefono"] ?? '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
          </div>

          <div class="col-md-6">
            <label class="form-label text-warning">Estado</label>
            <select name="estado" class="form-select bg-dark text-white border-warning" required>
              <option value="activo" <?= ($empleadoData["estado"] ?? '') == 'activo' ? 'selected' : '' ?>>Activo</option>
              <option value="inactivo" <?= ($empleadoData["estado"] ?? '') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-warning me-2">
             <?= ($action ?? 'crear') === 'editar' ? 'Actualizar' : '<i class="fas fa-user-plus me-1"></i>Agregar Empleado' ?>
            </button>
            
            <?php if ($action === "editar"): ?>
              <a href="/barber/panel/empleados" class="btn btn-outline-warning"><i class="fas fa-times me-1"></i>Cancelar</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </div>


<!-- Lista de empleados -->
  <div class="card bg-black border-warning">
    <div class="card-header border-warning text-white">Lista de Barberos</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-dark table-bordered border-warning align-middle text-center">
            <thead class="table-warning text-dark">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Especialidad</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
             <tbody>
              <?php foreach ($stmt as $row): ?>
                <tr>
                  <td><?= $row['id_empleado'] ?></td>
                  <td><?= htmlspecialchars($row['nombre']) ?></td>
                  <td><?= htmlspecialchars($row['correo']) ?></td>
                  <td><?= htmlspecialchars($row['especialidad']) ?></td>
                  <td><?= htmlspecialchars($row['telefono']) ?></td>
                  <td>
                    <span class="badge <?= $row['estado'] == 'activo' ? 'bg-success' : 'bg-danger' ?>">
                      <?= ucfirst($row['estado']) ?>
                    </span>
                  </td>
                  <td>
                    <a href="/barber/panel/empleados/<?= $row['id_empleado'] ?>/editar" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/barber/panel/empleados/<?= $row['id_empleado'] ?>/eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
