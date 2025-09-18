<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $db_name = "style_barber";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die(json_encode([
                "success" => false,
                "message" => "Error de conexión: " . $e->getMessage()
            ]));
        }
    }

    public function getConnection(): PDO {
        return $this->conn;
    }
}

?>