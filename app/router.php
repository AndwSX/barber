<?php
namespace App;

class Router {
    public function handle(string $route): void {
        switch ($route) {
            case "":
            case "home":
                require_once __DIR__ . "/home/vista/controlador.php";
                $controller = new \App\Home\HomeController();
                $controller->index();
                break;

            default:
                http_response_code(404);
                echo "Página no encontrada";
                break;
        }
    }
}


?>