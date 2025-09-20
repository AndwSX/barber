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
        $sql = "INSERT INTO {$this->table} 
                (nombre, correo, telefono)
                VALUES (:nombre, :correo, :telefono)";

        $stmt = $this->conn->prepare($sql);

        // Validar correo
        $data['correo'] = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);

        if ($stmt->execute([
            ':nombre'   => $data['nombre'],
            ':correo'   => $data['correo'],
            ':telefono' => $data['telefono']
        ])) {
            // Retorna el id autoincremental generado
            return (int) $this->conn->lastInsertId();
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
        $sql = "DELETE FROM {$this->table} WHERE id_cliente = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
