<?php
namespace App\AgendarCita;

require_once __DIR__ . "/../modulos/servicios/modelo.php";
require_once __DIR__ . "/../modulos/barberos/modelo.php";
require_once __DIR__ . "/../modulos/clientes/modelo.php";
require_once __DIR__ . "/../modulos/reservas/modelo.php";

use App\Modelos\Servicio;
use App\Modelos\Empleado;
use App\Modelos\Cliente;
use App\Modelos\Reserva;

class AgendarCitaController {
    private $servicio;
    private $empleado;
    private $cliente;
    private $reserva;

    public function __construct() {
        $this->servicio = new Servicio();
        $this->empleado = new Empleado();
        $this->cliente  = new Cliente();
        $this->reserva  = new Reserva();
    }

    public function index(string $subRoute = ""): void {
        $sub = $subRoute;
        switch($sub){
            case "servicios":
                $stmt = $this->servicio->leerTodos();
                require __DIR__ . "/vista/servicios.php";
                break;
            
            case "equipo":
                $stmt = $this->empleado->leerTodos();
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

                // 1. Crear cliente
                $clienteId = $this->cliente->crear([
                    "nombre"   => $data["cliente"]["nombre"] ?? null,
                    "correo"   => $data["cliente"]["email"] ?? null,
                    "telefono" => $data["cliente"]["telefono"] ?? null,
                ]);

                if (!$clienteId) {
                    echo json_encode([
                        "success" => false,
                        "message" => "No se pudo crear el cliente"
                    ]);
                    return;
                }

                // 2. Crear reserva
                $reservaId = $this->reserva->crear([
                    "id_cliente"    => $clienteId,
                    "id_empleado"   => $data["barbero"],
                    "fecha_reserva" => $data["fecha"],
                    "hora_reserva"  => $data["hora"]
                ]);

                if (!$reservaId) {
                    echo json_encode([
                        "success" => false,
                        "message" => "No se pudo crear la reserva"
                    ]);
                    return;
                }

                // 3. Agregar servicios a la reserva
                $servicios = $data["servicios"] ?? [];
                if (!empty($servicios)) {
                    $this->reserva->agregarServicios($reservaId, $servicios);
                }

                echo json_encode([
                    "success"    => true,
                    "message"    => "Reserva creada correctamente",
                    "reserva_id" => $reservaId,
                    "cliente_id" => $clienteId,
                    "servicios"  => $servicios
                ]);
                break;
        }
    }
}
