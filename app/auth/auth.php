<?php
namespace App\Auth;

class Auth {
    public static function check(): bool {
        session_start();
        return isset($_SESSION['usuario']);
    }

    public static function user(): ?array {
        session_start();
        return $_SESSION['usuario'] ?? null;
    }

    public static function logout(): void {
        session_start();
        session_destroy();
    }
}
