<?php
namespace App;

class Router {
    public function handle(string $route): void {
        // Dividir la ruta en partes
        $segments = explode("/", trim($route, "/"));
        $mainRoute = $segments[0] ?? "";   // ejemplo: "panel"
        $subRoute  = $segments[1] ?? "dashboard";   // ejemplo: "dashboard"

        switch ($mainRoute) {
            //Por defecto "" trae la vista del homepage
            case "":
                require_once __DIR__ . "/home/controlador.php";
                $controller = new \App\Home\HomeController();
                $controller->index();
                break;
            //Llama las vistas de generar citas
            // Flujo de agendar cita
            case "agendar-cita/servicios":
                require_once __DIR__ . "/agendarcita/controlador.php";
                $controller = new \App\AgendarCita\AgendarCitaController();
                $controller->servicios();
                break;

            case "agendar-cita/equipo":
                require_once __DIR__ . "/agendarcita/controlador.php";
                $controller = new \App\AgendarCita\AgendarCitaController();
                $controller->equipo();
                break;

            case "agendar-cita/horario":
                require_once __DIR__ . "/agendarcita/controlador.php";
                $controller = new \App\AgendarCita\AgendarCitaController();
                $controller->horario();
                break;

            case "agendar-cita/confirmar":
                require_once __DIR__ . "/agendarcita/controlador.php";
                $controller = new \App\AgendarCita\AgendarCitaController();
                $controller->confirmar();
                break;
            //Completa el flujo de recibir la cita
            case "agendar-cita/guardar":
                require_once __DIR__ . "/agendarcita/controlador.php";
                $controller = new \App\AgendarCita\AgendarCitaController();
                $controller->guardar();
                break;

            //Login
            case "auth/login":
                require_once __DIR__ . "/auth/controlador.php";
                $controller = new \App\Auth\AuthController();
                $controller->login();
                break;

            //Panel administrativo
            case "panel":
                require_once __DIR__ . "/panel/controlador.php";
                $controller = new \App\Panel\PanelController();
                $controller->index($subRoute);
                break;



            //Si no coincide con ninguno de los demas mostrara eso de no encontrada
            default:
                http_response_code(404);
                echo "Página no encontrada";
                break;
        }
    }
}


?>