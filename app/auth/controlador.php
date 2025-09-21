<?php
namespace App\Auth;

require_once __DIR__ . "/modelo.php"; // aseguramos que el modelo exista

class AuthController {
    public function login(): void {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);
        $correo = $data['correo'] ?? '';
        $password = $data['password'] ?? '';

        $model = new \App\Auth\AuthModel(); // ahora sí existe
        $usuario = $model->verificarUsuario($correo, $password);

        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario; // Guardar usuario en la sesión

            echo json_encode([
                "success" => true,
                "message" => "Login exitoso",
                "usuario" => $usuario
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Correo o contraseña incorrectos"
            ]);
        }
    }

    public function logout(): void {
        session_start();
        session_destroy();

        header('Content-Type: application/json');
        echo json_encode([
            "success" => true,
            "message" => "Sesión cerrada"
        ]);
    }
}
