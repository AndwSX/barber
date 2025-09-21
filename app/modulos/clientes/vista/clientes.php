<div class="container">
  <div class="text-center text-warning mb-4">
    <h2><i class="fas fa-users fa-lg me-2"></i>Gestión de Clientes</h2>
  </div>
  <!-- Formulario -->
   <form method="POST" 
      action="<?= ($action ?? 'crear') === 'editar' 
                  ? BASE_PATH . "panel/clientes/".($idCliente ?? '')."/editar" 
                  : BASE_PATH . "panel/clientes/crear" ?>">
      <input type="hidden" name="id_cliente" value="<?= $idCliente ?? '' ?>">
     <div class="border bg-black border-warning rounded p-4 mb-4">
       <div class="row g-3">
         <div class="col-md-6">
           <label class="form-label">Nombre Completo</label>
           <input type="text" class="form-control bg-dark text-light border-warning" name="nombreCliente" placeholder="Ej: Juan Pérez" value="<?= htmlspecialchars($clienteData["nombre"] ?? '') ?>">
         </div>
         <div class="col-md-6">
           <label class="form-label">Correo Electrónico</label>
           <input type="text" class="form-control bg-dark text-light border-warning" name="correoCliente" placeholder="Ej: juan.perez@email.com" value="<?= htmlspecialchars($clienteData["correo"] ?? '') ?>">
         </div>
         <div class="col-md-6">
           <label class="form-label">Teléfono</label>
           <input type="text" class="form-control bg-dark text-light border-warning" name="telefonoCliente" placeholder="Ej: +573001234567" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" value="<?= htmlspecialchars($clienteData["telefono"] ?? '') ?>">
         </div>
         <div class="col-md-12 text-end">

           <button class="btn btn-warning mt-3 me-2">
             <?= ($action ?? 'crear') === 'editar' ? 'Actualizar' : '<i class="fas fa-user-plus me-1"></i>Agregar Cliente' ?>
           </button>

           <?php if ($action === "editar"): ?>
           <a href="<?= BASE_PATH ?>panel/clientes" class="btn btn-outline-warning mt-3"><i class="fas fa-times me-1"></i>Cancelar</a>
           <?php endif; ?>
         </div>
       </div>
     </div>
   </form>

  <!-- Tabla -->
  <div class="border border-warning bg-black rounded p-3">
    <div class="table-responsive">
      <table class="table table-dark table-bordered border-warning align-middle text-center">
        <thead class="table-warning text-black">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($stmt as $row): ?>
              <tr>
                <td><?= $row['id_cliente'] ?></td>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['correo']) ?></td>
                <td><?= htmlspecialchars($row['telefono']) ?></td>
                <td>
                  <a href="<?= BASE_PATH ?>panel/clientes/<?= $row['id_cliente'] ?>/editar" class="btn btn-sm btn-warning">Editar</a>
                  <a href="<?= BASE_PATH ?>panel/clientes/<?= $row['id_cliente'] ?>/eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
    </div>
  </div>
</div>
