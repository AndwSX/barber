<?php
namespace App;

class Router {
    public function handle(string $route): void {
        // Dividir la ruta en partes
        $segments = explode("/", trim($route, "/"));
        $mainRoute = $segments[0] ?? "";   // ejemplo: "panel"
        $subRoute  = $segments[1] ?? "dashboard";   // ejemplo: "dashboard"
        $id = $segments[2] ?? "";
        $accion = $segments[3] ?? "";

        switch ($mainRoute) {
            //Por defecto "" trae la vista del homepage
            case "":
                require_once __DIR__ . "/home/controlador.php";
                $controller = new \App\Home\HomeController();
                $controller->index();
                break;
            
            // Flujo de agendar cita
            case "agendar-cita":
                require_once __DIR__ . "/agendarcita/controlador.php";
                $controller = new \App\AgendarCita\AgendarCitaController();
                $controller->index($subRoute);
                break;

            //Login
            case "auth-login":
                require_once __DIR__ . "/auth/controlador.php";
                $controller = new \App\Auth\AuthController();
                $controller->login();
                break;

            //Panel administrativo
            case "panel":
                require_once __DIR__ . "/auth/auth.php";

                if (!\App\Auth\Auth::check()) {
                    // No está logueado
                    header("Location: /barber");
                    exit;
                }
                require_once __DIR__ . "/panel/controlador.php";
                $controller = new \App\Panel\PanelController();
                $controller->index($subRoute, $id, $accion);
                break;

            //Cerrar Sesion
            case "auth-logout":
                require_once __DIR__ . "/auth/controlador.php";
                $controller = new \App\Auth\AuthController();
                $controller->logout();
                break;



            //Si no coincide con ninguno de los demas mostrara eso de no encontrada
            default:
                http_response_code(404);
                echo "Página no encontrada router";
                echo $mainRoute;
                echo $subRoute;
                break;
        }
    }
}


?>