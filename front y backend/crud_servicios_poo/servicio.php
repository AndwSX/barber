<?php
require_once 'Database.php';

class Servicio {
    private $conn;
    private $table = 'servicios';

    // Propiedades
    public $id_servicio;
    public $nombre;
    public $descripcion;
    public $precio;
    public $duracion_min;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // CREATE
    public function crear() {
        $query = "INSERT INTO " . $this->table . " SET nombre=:nombre, descripcion=:descripcion, precio=:precio, duracion_min=:duracion_min";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = floatval($this->precio);
        $this->duracion_min = intval($this->duracion_min);

        // Vincular parámetros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":duracion_min", $this->duracion_min);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ (todos)
    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ (uno por ID)
    public function leerUno() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_servicio = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_servicio);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->precio = $row['precio'];
            $this->duracion_min = $row['duracion_min'];
            return true;
        }
        return false;
    }

    // UPDATE
    public function actualizar() {
        $query = "UPDATE " . $this->table . " SET nombre=:nombre, descripcion=:descripcion, precio=:precio, duracion_min=:duracion_min WHERE id_servicio=:id_servicio";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = floatval($this->precio);
        $this->duracion_min = intval($this->duracion_min);
        $this->id_servicio = intval($this->id_servicio);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":duracion_min", $this->duracion_min);
        $stmt->bindParam(":id_servicio", $this->id_servicio);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_servicio = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_servicio);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>