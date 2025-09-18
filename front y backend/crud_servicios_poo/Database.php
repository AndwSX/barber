<?php
class Database {
    private $host = "localhost";
    private $db_name = "style_barber";   // Cambia si tu BD tiene otro nombre
    private $username = "root";          // Cambia si no usas root
    private $password = "";              // Cambia si tienes contraseña

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
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conn;
    }
}