<?php
class Database {
    private $host = "localhost";
    private $db_name = "style_barber";   // <-- TU BD aquí
    private $username = "root";          // <-- usuario (cambia si no es root)
    private $password = "";              // <-- contraseña (si usas una, ponla)
    public $conn = null;

    public function getConnection() {
        if ($this->conn) return $this->conn;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // En desarrollo mostramos el mensaje (luego quitar)
            echo "Error de conexión: " . $e->getMessage();
            $this->conn = null;
        }

        return $this->conn;
    }
}
