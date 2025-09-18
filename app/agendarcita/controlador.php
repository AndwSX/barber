<?php
namespace App\AgendarCita;

class AgendarCitaController {
    public function servicios(): void {
        require __DIR__ . "/vista/servicios.php";
    }

    public function equipo(): void {
        require __DIR__ . "/vista/equipo.php";
    }

    public function horario(): void {
        require __DIR__ . "/vista/horarios.php";
    }

    public function confirmar(): void {
        require __DIR__ . "/vista/confirmar.php";
    }

    // Aquí manejamos el fetch del frontend
    public function guardar(): void {
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
    }
}



?>