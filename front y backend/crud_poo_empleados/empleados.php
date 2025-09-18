<?php
require_once 'Database.php';

class Empleado {
    private $conn;
    private $table = 'empleados';

    public $id_empleado;
    public $nombre;
    public $correo;
    public $contrasena;
    public $especialidad;
    public $telefono;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // 🔹 Crear empleado
    public function crear() {
        $query = "INSERT INTO " . $this->table . " 
                  SET nombre=:nombre, correo=:correo, contrasena=:contrasena, 
                      especialidad=:especialidad, telefono=:telefono, estado=:estado";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->correo = filter_var($this->correo, FILTER_VALIDATE_EMAIL);
        $this->contrasena = password_hash($this->contrasena, PASSWORD_DEFAULT);
        $this->especialidad = htmlspecialchars(strip_tags($this->especialidad));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->estado = in_array($this->estado, ['activo', 'inactivo']) ? $this->estado : 'activo';

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":especialidad", $this->especialidad);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":estado", $this->estado);

        return $stmt->execute();
    }

    // 🔹 Leer todos los empleados
    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 🔹 Leer un solo empleado por ID
    public function leerUno() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_empleado = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_empleado);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nombre = $row['nombre'];
            $this->correo = $row['correo'];
            $this->especialidad = $row['especialidad'];
            $this->telefono = $row['telefono'];
            $this->estado = $row['estado'];
            return true;
        }
        return false;
    }

    // 🔹 Actualizar empleado
    public function actualizar() {
        $query = "UPDATE " . $this->table . " 
                  SET nombre=:nombre, correo=:correo, especialidad=:especialidad, 
                      telefono=:telefono, estado=:estado 
                  WHERE id_empleado=:id_empleado";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->correo = filter_var($this->correo, FILTER_VALIDATE_EMAIL);
        $this->especialidad = htmlspecialchars(strip_tags($this->especialidad));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->estado = in_array($this->estado, ['activo', 'inactivo']) ? $this->estado : 'activo';
        $this->id_empleado = intval($this->id_empleado);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":especialidad", $this->especialidad);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_empleado", $this->id_empleado);

        return $stmt->execute();
    }

    // 🔹 Eliminar empleado
    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_empleado = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_empleado);

        return $stmt->execute();
    }
}
?>
