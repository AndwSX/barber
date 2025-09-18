<?php
namespace App\Modelos;

require_once __DIR__ . "/../../config/Database.php"; //subir un nivel hasta /config/

use PDO;
use App\config\Database; // tu clase de conexión que ya tienes

class Empleado {
    private $conn;
    private $table = "empleados";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Crear empleado
    public function crear(array $data): bool {
        $sql = "INSERT INTO {$this->table} 
                (nombre, correo, contrasena, especialidad, telefono, estado)
                VALUES (:nombre, :correo, :contrasena, :especialidad, :telefono, :estado)";

        $stmt = $this->conn->prepare($sql);

        $data['correo'] = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);
        $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);
        $data['estado'] = in_array($data['estado'], ['activo', 'inactivo']) ? $data['estado'] : 'activo';

        return $stmt->execute([
            ':nombre'       => $data['nombre'],
            ':correo'       => $data['correo'],
            ':contrasena'   => $data['contrasena'],
            ':especialidad' => $data['especialidad'],
            ':telefono'     => $data['telefono'],
            ':estado'       => $data['estado']
        ]);
    }

    //Leer todos
    public function leerTodos(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY nombre ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Leer uno
    public function leerUno(int $id): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE id_empleado = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $empleado ?: null;
    }

    //Actualizar
    public function actualizar(int $id, array $data): bool {
        $sql = "UPDATE {$this->table} 
                SET nombre = :nombre, correo = :correo, especialidad = :especialidad, 
                    telefono = :telefono, estado = :estado
                WHERE id_empleado = :id";

        $stmt = $this->conn->prepare($sql);

        $data['correo'] = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);
        $data['estado'] = in_array($data['estado'], ['activo', 'inactivo']) ? $data['estado'] : 'activo';

        return $stmt->execute([
            ':nombre'       => $data['nombre'],
            ':correo'       => $data['correo'],
            ':especialidad' => $data['especialidad'],
            ':telefono'     => $data['telefono'],
            ':estado'       => $data['estado'],
            ':id'           => $id
        ]);
    }

    // Eliminar
    public function eliminar(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id_empleado = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
