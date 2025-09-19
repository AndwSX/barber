<?php
namespace App\AgendarCita;

require_once __DIR__ . "/../config/Database.php";

use PDO;
use App\config\Database; // tu clase de conexión que ya tienes


class AgendarCita {
    private $conn;
    private $table_name = "citas";


    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Crear cita
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_clientes_barberia, id_empleado, fecha_hora, estado)
                  VALUES (:id_cliente, :id_empleado, :fecha_hora, :estado)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_cliente", $this->id_clientes_barberia);
        $stmt->bindParam(":id_empleado", $this->id_empleado);
        $stmt->bindParam(":fecha_hora", $this->fecha_hora);
        $stmt->bindParam(":estado", $this->estado);

        return $stmt->execute();
    }

    // Leer citas
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_hora DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Actualizar cita
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_clientes_barberia = :id_cliente, id_empleado = :id_empleado, 
                      fecha_hora = :fecha_hora, estado = :estado
                  WHERE id_cita = :id_cita";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_cliente", $this->id_clientes_barberia);
        $stmt->bindParam(":id_empleado", $this->id_empleado);
        $stmt->bindParam(":fecha_hora", $this->fecha_hora);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_cita", $this->id_cita);

        return $stmt->execute();
    }

    // Eliminar cita
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_cita = :id_cita";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_cita", $this->id_cita);
        return $stmt->execute();
    }
}
