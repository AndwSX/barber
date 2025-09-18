<?php
namespace App\Auth;

require_once __DIR__ . "/../config/Database.php"; // ✅ subir un nivel hasta /config/

use App\Config\Database;

class AuthModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); // ahora sí la clase existe
    }

    public function verificarUsuario(string $correo, string $password): ?array {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo AND password = :password";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }
}
