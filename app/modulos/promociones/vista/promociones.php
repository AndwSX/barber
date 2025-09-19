<h2 class="text-center text-warning mb-4">Promociones Exclusivas</h2>
<div class="row g-4">
  <!-- Listado -->
  <div class="col-md-8">
    <div class="row g-4">
      <?php foreach ($stmt as $row): ?>
      <div class="col-md-6">
        <div class="card bg-black text-white border border-warning">
          <div class="card-body text-center">
            <div class="display-4 mb-3 text-warning">⭐</div>
            <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($row['descripcion']) ?></p>
            <small class="text-secondary">Creado: <?= date("d-m-Y H:i", strtotime($row['fecha_creacion'])) ?></small><br>
            <a href="/barber/panel/promociones/<?= $row['id_promocion'] ?>/editar" class="btn btn-sm btn-info mt-2"><i class="fa fa-pen"></i> Editar</a>
            <a href="/barber/panel/promociones/<?= $row['id_promocion'] ?>/eliminar" class="btn btn-sm btn-danger mt-2" onclick="return confirm('¿Seguro que deseas eliminar esta promoción?');"><i class="fa fa-trash"></i> Eliminar</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Formulario -->
  <div class="col-md-4">
    <div class="card bg-black text-white border border-warning">
      <div class="card-body">
          <h5 class="text-warning text-center"><?= ($action ?? 'crear') === 'editar' ? '✏️ Editar Promoción' : '➕ Agregar Promoción' ?></h5>
          <form method="POST" action="<?= ($action ?? 'crear') === 'editar' 
                        ? "/barber/panel/promociones/".($idPromocion ?? '')."/editar" 
                        : "/barber/panel/promociones/crear" ?>">
            <div class="mb-2">
              <label class="form-label">Nombre:</label>
              <input type="text" name="nombre" value="<?= htmlspecialchars($promocionData['nombre'] ?? '') ?>" class="form-control bg-dark text-white border-warning" required />
            </div>
            <div class="mb-2">
              <label class="form-label">Descripción:</label>
              <textarea name="descripcion" class="form-control bg-dark text-white border-warning" rows="2" required><?= htmlspecialchars($promocionData['descripcion'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Tipo:</label>
              <select name="tipo" class="form-select bg-dark text-white border-warning" required>
                <option value="descuento" <?= ($promocionData['tipo'] ?? '') == "descuento" ? "selected": '' ?>>Descuento</option>
                <option value="2x1" <?= ($promocionData['tipo'] ?? '') == "2x1" ? "selected": '' ?>>2x1</option>
                <option value="envio_gratis" <?= ($promocionData['tipo'] ?? '') == "envio_gratis" ? "selected": '' ?>>Envío gratis</option>
                <option value="regalo" <?= ($promocionData['tipo'] ?? '') == "regalo" ? "selected": '' ?>>Regalo</option>
                <option value="otro" <?= ($promocionData['tipo'] ?? '') == "otro" ? "selected": '' ?>>Otro</option>
              </select>
            </div>

            <button type="submit" class="btn btn-warning w-100">
                <?= ($action ?? 'crear') === 'editar' ? 'Actualizar' : 'Crear Promoción' ?>
            </button>

            <?php if ($action === "editar"): ?>
              <a href="/barber/panel/promociones" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            <?php endif; ?>
          </form>
    
      </div>
    </div>
  </div>
</div>

