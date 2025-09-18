<?php
// ================== CONEXIÓN ==================
class Database {
    private $host = "localhost";
    private $db_name = "style_barber";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                                  $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// ================== MODELO ==================
class Promocion {
    private $conn;
    private $table = "promociones";

    public $clientes_barberia;
    public $nombre;
    public $descripcion;
    public $tipo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leer() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY fecha_creacion DESC";
        return $this->conn->query($query);
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE clientes_barberia = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table . " (nombre, descripcion, tipo) 
                  VALUES (:nombre, :descripcion, :tipo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":tipo", $this->tipo);
        return $stmt->execute();
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table . " 
                  SET nombre=:nombre, descripcion=:descripcion, tipo=:tipo 
                  WHERE clientes_barberia=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":id", $this->clientes_barberia);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE clientes_barberia=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}

// ================== CONTROLADOR ==================
$database = new Database();
$db = $database->getConnection();
$promo = new Promocion($db);

$idEditar = $_GET['editar'] ?? null;
$promoEditar = null;

// Crear promoción
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
    $promo->nombre = $_POST['nombre'];
    $promo->descripcion = $_POST['descripcion'];
    $promo->tipo = $_POST['tipo'];
    $promo->crear();
    header("Location: promociones.php");
    exit;
}

// Editar promoción (guardar cambios)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $promo->clientes_barberia = $_POST['clientes_barberia'];
    $promo->nombre = $_POST['nombre'];
    $promo->descripcion = $_POST['descripcion'];
    $promo->tipo = $_POST['tipo'];
    $promo->actualizar();
    header("Location: promociones.php");
    exit;
}

// Cargar datos para edición
if ($idEditar) {
    $promoEditar = $promo->obtenerPorId($idEditar);
}

// Eliminar promoción
if (isset($_GET['eliminar'])) {
    $promo->eliminar($_GET['eliminar']);
    header("Location: promociones.php");
    exit;
}

// Obtener promociones
$promociones = $promo->leer();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Promociones Exclusivas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-light p-4">
  <h2 class="text-center text-warning mb-4">Promociones Exclusivas</h2>

  <div class="row g-4">
    <!-- Listado de promociones -->
    <div class="col-md-8">
      <div class="row g-4" id="contenedor-promociones">
        <?php foreach($promociones as $row): ?>
        <div class="col-md-6">
          <div class="card bg-black text-white border border-warning">
            <div class="card-body text-center">
              <div class="display-4 mb-3 text-warning">⭐</div>
              <h5 class="card-title text-white"><?= htmlspecialchars($row['nombre']) ?></h5>
              <p class="card-text text-light"><?= htmlspecialchars($row['descripcion']) ?></p>
              <small class="text-secondary">Creado: <?= date("d-m-Y H:i", strtotime($row['fecha_creacion'])) ?></small><br>
              <a href="promociones.php?editar=<?= $row['clientes_barberia'] ?>" class="btn btn-sm btn-info mt-2"><i class="fa fa-pen"></i> Editar</a>
              <a href="promociones.php?eliminar=<?= $row['clientes_barberia'] ?>" class="btn btn-sm btn-danger mt-2" onclick="return confirm('¿Seguro que deseas eliminar esta promoción?');"><i class="fa fa-trash"></i> Eliminar</a>
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
          <?php if ($promoEditar): ?>
            <h5 class="card-title text-warning text-center">Editar Promoción</h5>
            <form method="POST" action="">
              <input type="hidden" name="clientes_barberia" value="<?= $promoEditar['clientes_barberia'] ?>">
              <div class="mb-2">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($promoEditar['nombre']) ?>" class="form-control bg-dark text-white border-warning" required />
              </div>
              <div class="mb-2">
                <label class="form-label">Descripción:</label>
                <textarea name="descripcion" class="form-control bg-dark text-white border-warning" rows="2" required><?= htmlspecialchars($promoEditar['descripcion']) ?></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Tipo:</label>
                <select name="tipo" class="form-select bg-dark text-white border-warning" required>
                  <option value="descuento" <?= $promoEditar['tipo']=="descuento" ? "selected":"" ?>>Descuento</option>
                  <option value="2x1" <?= $promoEditar['tipo']=="2x1" ? "selected":"" ?>>2x1</option>
                  <option value="envio_gratis" <?= $promoEditar['tipo']=="envio_gratis" ? "selected":"" ?>>Envío gratis</option>
                  <option value="regalo" <?= $promoEditar['tipo']=="regalo" ? "selected":"" ?>>Regalo</option>
                  <option value="otro" <?= $promoEditar['tipo']=="otro" ? "selected":"" ?>>Otro</option>
                </select>
              </div>
              <button type="submit" name="actualizar" class="btn btn-warning w-100">Actualizar</button>
              <a href="promociones.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
            </form>
          <?php else: ?>
            <h5 class="card-title text-warning text-center">Agregar Promoción</h5>
            <form method="POST" action="">
              <div class="mb-2">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control bg-dark text-white border-warning" placeholder="Ej: Corte 2x1" required />
              </div>
              <div class="mb-2">
                <label class="form-label">Descripción:</label>
                <textarea name="descripcion" class="form-control bg-dark text-white border-warning" placeholder="Ej: Solo los viernes..." rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Tipo:</label>
                <select name="tipo" class="form-select bg-dark text-white border-warning" required>
                  <option value="descuento">Descuento</option>
                  <option value="2x1">2x1</option>
                  <option value="envio_gratis">Envío gratis</option>
                  <option value="regalo">Regalo</option>
                  <option value="otro">Otro</option>
                </select>
              </div>
              <button type="submit" name="crear" class="btn btn-warning w-100">Agregar</button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
