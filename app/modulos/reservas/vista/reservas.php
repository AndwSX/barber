
  <h3 class="text-warning mb-4">Gestión de Citas</h3>

  <!-- Formulario de Citas -->
  <form method="POST" 
      action="<?= ($action ?? 'crear') === 'editar' 
                  ? "/barber/panel/reservas/".($idReserva ?? '')."/editar" 
                  : "/barber/panel/reservas/crear" ?>">
    <!-- Enviar el id del cliente a actualizar -->
    <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($reservaData['id_cliente']) ?>">

    <div class="border border-warning bg-black p-3 rounded">
      <h5 class="text-warning mb-3">Formulario de Cita</h5>
      <div class="row">
        <div class="col-md-6">
          <label class="text-warning">Nombre del Cliente</label>
          <input type="text" name="cliente" class="form-control bg-dark text-white"
                value="<?= htmlspecialchars($reservaData['nombre_cliente'] ?? '') ?>">
        </div>

        <div class="col-md-6">
          <label class="text-warning">Teléfono</label>
          <input type="text" name="telefono" class="form-control bg-dark text-white"
                value="<?= htmlspecialchars($reservaData['telefono_cliente'] ?? '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
        </div>

        <div class="col-md-3">
          <label class="text-warning">Correo Electrónico</label>
          <input type="email" name="correo" class="form-control bg-dark text-white"
                value="<?= htmlspecialchars($reservaData['correo_cliente'] ?? '') ?>">
        </div>

        <div class="col-md-3">
          <label class="text-warning">Fecha</label>
          <input type="date" name="fecha" class="form-control bg-dark text-white"
                value="<?= htmlspecialchars($reservaData['fecha'] ?? '') ?>"
                min="<?= date('Y-m-d') ?>">
        </div>

        <div class="col-md-3">
          <label class="text-warning">Hora</label>
          <input type="time" id="hora" name="hora" class="form-control bg-dark text-white"
                value="<?= htmlspecialchars($reservaData['hora'] ?? '') ?>">
        </div>

        <div class="col-md-3">
          <label class="text-warning">Barbero</label>
          <select name="barbero" class="form-select bg-dark text-white">
            <option value="" disabled>Seleccione un barbero</option>
            <?php foreach ($barberos as $b): ?>
              <option value="<?= $b['id_empleado'] ?>"
                <?= ($reservaData['id_empleado'] ?? null) == $b['id_empleado'] ? 'selected' : '' ?>>
                <?= $b['nombre'] ?> | <?= $b['especialidad'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col">
          <label class="text-warning">Servicios</label>
          <select name="servicios[]" class="form-select bg-dark text-white" multiple>
            <option value="" disabled>Mantén presionada CTRL (o CMD en Mac) para seleccionar varios</option>
            <?php foreach ($servicios as $s): ?>
              <option value="<?= $s['id_servicio'] ?>"
                <?= in_array($s['id_servicio'], $reservaData['servicios'] ?? []) ? 'selected' : '' ?>>
                <?= $s['nombre'] ?> => <?= $s['descripcion'] ?> => <?= $s['duracion_min'] ?> min
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="mt-3 text-light">
        <strong>Política de Cancelación:</strong> 24 horas de anticipación
      </div>
      <div class="mt-4 text-end">
        <button class="btn btn-warning me-2">
            <?= ($action ?? 'crear') === 'editar' ? 'Actualizar' : 'Generar Reserva' ?>
        </button>

        <?php if ($action === "editar"): ?>
           <a href="/barber/panel/reservas" class="btn btn-outline-warning"><i class="fas fa-times me-1"></i>Cancelar</a>
        <?php endif; ?>
      </div>
    </div>
  </form>


  <!-- Tabla de Citas -->
  <div class="border border-warning bg-black mt-4 p-3 rounded">
    <table class="table table-dark table-bordered border-warning align-middle text-center">
      <thead class="table-warning">
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Teléfono</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Barbero</th>
          <th>Servicios</th>
          <th>Duracion</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($stmt as $row): ?>
            <tr>
                <td><?= $row['id_reserva'] ?></td>
                <td><?= $row['nombre_cliente'] ?></td>
                <td><?= $row['telefono_cliente'] ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['hora'] ?></td>
                <td><?= $row['nombre_empleado'] ?></td>
                <td><?= $row['servicios'] ?></td>
                <td><?= $row['duracion_total'] ?> min</td>
                <td>
                    <a href="/barber/panel/reservas/<?= $row['id_reserva'] ?>/editar" class="btn btn-sm btn-primary">Editar</a>
                    <a href="/barber/panel/reservas/<?= $row['id_reserva'] ?>/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="/barber/public/js/reservas/horas.js"></script>
</body>
</html>
