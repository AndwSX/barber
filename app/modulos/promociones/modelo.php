<?php
namespace App\Modelos;

require_once __DIR__ . "/../../config/Database.php"; //subir un nivel hasta /config/

use PDO;
use App\config\Database;

class Promocion {
    private $conn;
    private $table = "promociones";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Leer todos
    public function leerTodos() {
        $query = "SELECT * FROM {$this->table} ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Leer uno
    public function leerUno(int $id) {
        $query = "SELECT * FROM {$this->table} WHERE id_promocion = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Crear promocion
    public function crear(array $data) {
        $query = "INSERT INTO {$this->table} (nombre, descripcion, tipo) 
                  VALUES (:nombre, :descripcion, :tipo)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ":nombre" => $data['nombre'],
            ":descripcion" => $data['descripcion'],
            ":tipo" => $data['tipo']
        ]);
    }

    //actualizar promocion
    public function actualizar(int $id, array $data) {
        $query = "UPDATE {$this->table} 
                  SET nombre=:nombre, descripcion=:descripcion, tipo=:tipo 
                  WHERE id_promocion =:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ":nombre" => $data['nombre'],
            ":descripcion" => $data['descripcion'],
            ":tipo" => $data['tipo'],
            ":id" => $id
        ]);
    }

    //Eliminar Promocion
    public function eliminar(int $id) {
        $query = "DELETE FROM {$this->table} WHERE id_promocion =:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([":id" => $id]);
    }
}
