<?php
namespace App\Modelos;

require_once __DIR__ . "/../../config/Database.php"; //subir un nivel hasta /config/

use PDO;
use App\config\Database;

class Servicio{
    private $conn;
    private $table = 'servicios';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Crear Servicio
    public function crear(array $data): bool {
        $query = "INSERT INTO {$this->table} 
                  (nombre, descripcion, precio, duracion_min) 
                  VALUES (:nombre, :descripcion, :precio, :duracion_min)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $nombre       = htmlspecialchars(strip_tags($data['nombre']));
        $descripcion  = htmlspecialchars(strip_tags($data['descripcion']));
        $precio       = floatval($data['precio']);
        $duracion_min = intval($data['duracion_min']);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":duracion_min", $duracion_min);

        return $stmt->execute();
    }

    // Leer Todos
    public function leerTodos(): array {
        $query = "SELECT * FROM {$this->table} ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer uno
    public function leerUno(int $id): ?array {
        $query = "SELECT * FROM {$this->table} WHERE id_servicio = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Actualizar
    public function actualizar(int $id, array $data): bool {
        $query = "UPDATE {$this->table} 
                  SET nombre=:nombre, descripcion=:descripcion, precio=:precio, duracion_min=:duracion_min 
                  WHERE id_servicio=:id";

        $stmt = $this->conn->prepare($query);

        $nombre       = htmlspecialchars(strip_tags($data['nombre']));
        $descripcion  = htmlspecialchars(strip_tags($data['descripcion']));
        $precio       = floatval($data['precio']);
        $duracion_min = intval($data['duracion_min']);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":duracion_min", $duracion_min);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Eliminar
    public function eliminar(int $id): bool {
        $query = "DELETE FROM {$this->table} WHERE id_servicio = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
