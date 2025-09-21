<?php
namespace App\Modelos;

require_once __DIR__ . "/../../config/Database.php"; //subir un nivel hasta /config/

use PDO;
use App\config\Database; // tu clase de conexión que ya tienes

class Cliente {
    private $conn;
    private $table = "clientes";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Crear cliente
    public function crear(array $data): int|false {
        // Validar correo
        $correo = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);
        if (!$correo) {
            return false; // Correo inválido
        }

        // Verificar si ya existe el correo
        $checkSql = "SELECT COUNT(*) FROM {$this->table} WHERE correo = :correo";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([':correo' => $correo]);

        if ($checkStmt->fetchColumn() > 0) {
            return false; // Correo ya registrado
        }

        // Insertar nuevo cliente
        $sql = "INSERT INTO {$this->table} (nombre, correo, telefono)
                VALUES (:nombre, :correo, :telefono)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([
            ':nombre'   => $data['nombre'],
            ':correo'   => $correo,
            ':telefono' => $data['telefono']
        ])) {
            return (int) $this->conn->lastInsertId(); // Retorna el id autoincremental generado
        }

        return false;
    }

    //Leer todos
    public function leerTodos(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY id_cliente DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Leer uno
    public function leerUno(int $id): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE id_cliente = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cliente ?: null;
    }

    //Leer por correo
    public function obtenerPorCorreo(string $correo): ?array {
        $sql = "SELECT id_cliente, nombre, correo, telefono 
                FROM {$this->table} 
                WHERE correo = :correo 
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        $cliente = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $cliente ?: null;
    }

    //Actualizar
    public function actualizar(int $id, array $data): bool {
        $sql = "UPDATE {$this->table} 
                SET nombre = :nombre, correo = :correo, telefono = :telefono
                WHERE id_cliente = :id";

        $stmt = $this->conn->prepare($sql);

        $data['correo'] = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);

        return $stmt->execute([
            ':nombre'       => $data['nombre'],
            ':correo'       => $data['correo'],
            ':telefono'     => $data['telefono'],
            ':id'           => $id
        ]);
    }

    // Eliminar
    public function eliminar(int $id): bool {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id_cliente = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (\PDOException $e) {
            if ($e->getCode() == "23000") {
                return false; // no se pudo eliminar por relación con reservas
            }
            throw $e; // si es otro error, lo relanzas
        }
    }
}
