<?php
class Cita {
    private $conn;
    private $table_name = "citas";

    public $id_cita;
    public $id_clientes_barberia;
    public $id_empleado;
    public $fecha_hora;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
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
