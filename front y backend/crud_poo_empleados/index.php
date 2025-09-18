<?php
require_once 'empleados.php';

$empleado = new Empleado();
$error = "";

// ---- CREAR O ACTUALIZAR ----
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empleado->nombre = $_POST['nombre'];
    $empleado->correo = $_POST['correo'];
    $empleado->especialidad = $_POST['especialidad'];
    $empleado->telefono = $_POST['telefono'];
    $empleado->estado = $_POST['estado'];

    if (isset($_POST['id_empleado']) && !empty($_POST['id_empleado'])) {
        $empleado->id_empleado = $_POST['id_empleado'];
        if ($empleado->actualizar()) {
            header("Location: index.php?mensaje=Empleado actualizado correctamente");
            exit;
        } else {
            $error = "Error al actualizar.";
        }
    } else {
        if ($empleado->crear()) {
            header("Location: index.php?mensaje=Empleado creado correctamente");
            exit;
        } else {
            $error = "Error al crear el empleado.";
        }
    }
}

// ---- ELIMINAR ----
if (isset($_GET['eliminar'])) {
    $empleado->id_empleado = $_GET['eliminar'];
    if ($empleado->eliminar()) {
        header("Location: index.php?mensaje=Empleado eliminado correctamente");
    } else {
        $error = "Error al eliminar.";
    }
    exit;
}

// ---- EDITAR (cargar datos de un empleado) ----
if (isset($_GET['editar'])) {
    $empleado->id_empleado = $_GET['editar'];
    if (!$empleado->leerUno()) {
        die("<div class='alert alert-danger'>Empleado no encontrado.</div>");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Empleados - Style Barber</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .container { margin-top: 30px; }
    h2 { color: #f9a825; }
    .btn-primary { background-color: #f9a825; border-color: #f9a825; }
    .form-control:focus { border-color: #f9a825; box-shadow: 0 0 0 0.2rem rgba(249, 168, 37, 0.25); }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">📋 Gestión de Empleados - Style Barber</h2>

  <?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-info"><?= htmlspecialchars($_GET['mensaje']) ?></div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <!-- FORMULARIO -->
  <div class="card mb-4">
    <div class="card-header bg-warning text-dark">
      <?= isset($_GET['editar']) ? '✏️ Editar Empleado' : '➕ Nuevo Empleado' ?>
    </div>
    <div class="card-body">
      <form method="POST" action="">
        <input type="hidden" name="id_empleado" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required 
                   value="<?= isset($empleado->nombre) ? htmlspecialchars($empleado->nombre) : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" required 
                   value="<?= isset($empleado->correo) ? htmlspecialchars($empleado->correo) : '' ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Especialidad</label>
            <select name="especialidad" class="form-select" required>
              <option value="">Selecciona...</option>
              <option value="Barbero" <?= isset($empleado->especialidad) && $empleado->especialidad == 'Barbero' ? 'selected' : '' ?>>Barbero</option>
              <option value="Corte de Cabello" <?= isset($empleado->especialidad) && $empleado->especialidad == 'Corte de Cabello' ? 'selected' : '' ?>>Corte de Cabello</option>
              <option value="Afeitado Clásico" <?= isset($empleado->especialidad) && $empleado->especialidad == 'Afeitado Clásico' ? 'selected' : '' ?>>Afeitado Clásico</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Teléfono</label>
            <input type="tel" name="telefono" class="form-control" required 
                   value="<?= isset($empleado->telefono) ? $empleado->telefono : '' ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Estado</label>
          <select name="estado" class="form-select" required>
            <option value="activo" <?= isset($empleado->estado) && $empleado->estado == 'activo' ? 'selected' : '' ?>>Activo</option>
            <option value="inactivo" <?= isset($empleado->estado) && $empleado->estado == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">
          <?= isset($_GET['editar']) ? 'Actualizar' : 'Crear Empleado' ?>
        </button>
        <?php if (isset($_GET['editar'])): ?>
          <a href="index.php" class="btn btn-secondary">Cancelar</a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- LISTA -->
  <div class="card">
    <div class="card-header bg-dark text-white">📋 Lista de Empleados</div>
    <div class="card-body">
      <table class="table table-striped table-hover">
        <thead>
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
          <?php
          $stmt = $empleado->leerTodos();
          while ($row = $stmt->fetch()) :
          ?>
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
              <a href="index.php?editar=<?= $row['id_empleado'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="index.php?eliminar=<?= $row['id_empleado'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
