<?php
namespace App\AgendarCita;

class AgendarCitaController {
    public function index(string $subRoute = ""): void {
        $sub = $subRoute; //variable para deifinir que mostrar
        switch($sub){
            case "servicios":
                require __DIR__ . "/vista/servicios.php";
                break;
            
            case "equipo":
                require __DIR__ . "/vista/equipo.php";
                break;

            case "horario":
                require __DIR__ . "/vista/horarios.php";
                break;

            case "confirmar":
                require __DIR__ . "/vista/confirmar.php";
                break;

            case "guardar":
                header("Content-Type: application/json");

                $data = json_decode(file_get_contents("php://input"), true);

                if (!$data) {
                    echo json_encode([
                        "success" => false,
                        "message" => "Datos inválidos"
                    ]);
                    return;
                }

                // TODO: aquí puedes conectar con el modelo y guardar en BD
                // Por ahora, lo simulamos con un log
                file_put_contents(__DIR__ . "/reservas.log", json_encode($data) . PHP_EOL, FILE_APPEND);

                echo json_encode([
                    "success" => true,
                    "message" => "Reserva guardada correctamente",
                    "data"    => $data
                ]);
                break;
        }
    }
}



?>