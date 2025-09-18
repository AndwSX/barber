<?php
// === PROCESAMIENTO DE DATOS (antes de cualquier HTML) ===

// Procesar creación/edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'Servicio.php';
    $servicio = new Servicio();

    $servicio->nombre = $_POST['nombre'];
    $servicio->descripcion = $_POST['descripcion'];
    $servicio->precio = $_POST['precio'];
    $servicio->duracion_min = $_POST['duracion_min'];

    if (isset($_POST['id_servicio']) && !empty($_POST['id_servicio'])) {
        $servicio->id_servicio = $_POST['id_servicio'];
        if ($servicio->actualizar()) {
            header("Location: index.php?mensaje=Servicio actualizado correctamente");
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar.</div>";
        }
    } else {
        if ($servicio->crear()) {
            header("Location: index.php?mensaje=Servicio creado correctamente");
        } else {
            echo "<div class='alert alert-danger'>Error al crear el servicio.</div>";
        }
    }
    exit; // ¡IMPORTANTE: detiene la ejecución aquí!
}

// Eliminar
if (isset($_GET['eliminar'])) {
    require_once 'Servicio.php';
    $servicio = new Servicio();
    $servicio->id_servicio = $_GET['eliminar'];
    if ($servicio->eliminar()) {
        header("Location: index.php?mensaje=Servicio eliminado correctamente");
    }
    exit;
}

// Cargar datos para editar
if (isset($_GET['editar'])) {
    require_once 'Servicio.php';
    $servicio = new Servicio();
    $servicio->id_servicio = $_GET['editar'];
    if (!$servicio->leerUno()) {
        die("<div class='alert alert-danger'>Servicio no encontrado.</div>");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Servicios - Style Barber</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .container { margin-top: 30px; }
    h2 { color: #f9a825; }
    .btn-primary { background-color: #f9a825; border-color: #f9a825; }
    .form-control:focus { border-color: #f9a825; box-shadow: 0 0 0 0.2rem rgba(249, 168, 37, 0.25); }
    .badge-warning { background-color: #f9a825 !important; }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">📋 Gestión de Servicios - Style Barber</h2>

  <!-- Mensaje -->
  <?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-info"><?= htmlspecialchars($_GET['mensaje']) ?></div>
  <?php endif; ?>

  <!-- Formulario -->
  <div class="card mb-4">
    <div class="card-header bg-warning text-dark">
      <?= isset($_GET['editar']) ? '✏️ Editar Servicio' : '➕ Nuevo Servicio' ?>
    </div>
    <div class="card-body">
      <form method="POST" action="">
        <input type="hidden" name="id_servicio" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required 
                value="<?= isset($_GET['editar']) ? $servicio->nombre : '' ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Duración (minutos)</label>
            <input type="number" name="duracion_min" class="form-control" required min="1" 
                value="<?= isset($_GET['editar']) ? $servicio->duracion_min : '' ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Descripción</label>
          <textarea name="descripcion" class="form-control" rows="3" required><?= isset($_GET['editar']) ? $servicio->descripcion : '' ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Precio (COP)</label>
          <input type="number" name="precio" class="form-control" step="0.01" required 
                value="<?= isset($_GET['editar']) ? $servicio->precio : '' ?>">
        </div>

        <button type="submit" class="btn btn-primary">
          <?= isset($_GET['editar']) ? 'Actualizar' : 'Crear Servicio' ?>
        </button>
        <?php if (isset($_GET['editar'])): ?>
          <a href="index.php" class="btn btn-secondary">Cancelar</a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- Lista de servicios -->
  <div class="card">
    <div class="card-header bg-dark text-white">📋 Lista de Servicios</div>
    <div class="card-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Duración</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once 'Servicio.php';
          $servicio = new Servicio();
          $stmt = $servicio->leerTodos();
          while ($row = $stmt->fetch()) :
          ?>
          <tr>
            <td><?= $row['id_servicio'] ?></td>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= $row['duracion_min'] ?> min</td>
            <td><span class="badge bg-warning">$<?= number_format($row['precio'], 0, ',', '.') ?></span></td>
            <td>
              <a href="index.php?editar=<?= $row['id_servicio'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="index.php?eliminar=<?= $row['id_servicio'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este servicio?')">Eliminar</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Procesar form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'Servicio.php';
    $servicio = new Servicio();

    $servicio->nombre = $_POST['nombre'];
    $servicio->descripcion = $_POST['descripcion'];
    $servicio->precio = $_POST['precio'];
    $servicio->duracion_min = $_POST['duracion_min'];

    if (isset($_POST['id_servicio']) && !empty($_POST['id_servicio'])) {
        $servicio->id_servicio = $_POST['id_servicio'];
        if ($servicio->actualizar()) {
            header("Location: index.php?mensaje=Servicio actualizado correctamente");
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar.</div>";
        }
    } else {
        if ($servicio->crear()) {
            header("Location: index.php?mensaje=Servicio creado correctamente");
        } else {
            echo "<div class='alert alert-danger'>Error al crear el servicio.</div>";
        }
    }
    exit;
}

// Eliminar
if (isset($_GET['eliminar'])) {
    require_once 'Servicio.php';
    $servicio = new Servicio();
    $servicio->id_servicio = $_GET['eliminar'];
    if ($servicio->eliminar()) {
        header("Location: index.php?mensaje=Servicio eliminado correctamente");
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar.</div>";
    }
    exit;
}

// Cargar datos para editar
// Cargar datos para editar
if (isset($_GET['editar'])) {
    echo "Intentando cargar Servicio.php...<br>";
    if (file_exists('Servicio.php')) {
        echo "✅ Archivo encontrado.<br>";
        require_once 'Servicio.php';
        echo "✅ Archivo incluido correctamente.<br>";
    } else {
        die("❌ ERROR: No se encontró el archivo Servicio.php");
    }

    echo "Creando instancia de Servicio...<br>";
    $servicio = new Servicio();
    echo "✅ Instancia creada.<br>";

    $servicio->id_servicio = $_GET['editar'];
    echo "ID asignado: " . $_GET['editar'] . "<br>";

    if (!$servicio->leerUno()) {
        die("<div class='alert alert-danger'>Servicio no encontrado.</div>");
    }
    echo "✅ Datos cargados desde la base de datos.<br>";
}
?>

</body>
</html>