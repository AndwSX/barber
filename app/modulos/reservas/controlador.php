<?php
namespace App\Modulos;

require_once __DIR__ . "/modelo.php";
require_once __DIR__ . "/../servicios/modelo.php";
require_once __DIR__ . "/../barberos/modelo.php";
require_once __DIR__ . "/../clientes/modelo.php";
require_once __DIR__ . "/../../helpers/mailer.php";

use App\Modelos\Reserva;
use App\Modelos\Servicio;
use App\Modelos\Empleado;
use App\Modelos\Cliente;
use App\Helpers\Mailer;

class ReservasController {
    private $reserva;
    private $servicio;
    private $empleado;
    private $cliente;

    public function __construct() {
        $this->reserva = new Reserva();
        $this->servicio = new Servicio();
        $this->empleado = new Empleado();
        $this->cliente = new Cliente();
    }

    // Mostrar lista
    public function index(): void {
        $stmt = $this->reserva->leerTodos();
        $servicios = $this->servicio->leerTodos();
        $barberos = $this->empleado->leerTodos();
        $action = "crear";
        require __DIR__ . "/vista/reservas.php";
    }

    // Crear reserva
    public function crear(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // 1. Verificar si ya existe cliente por correo
            $clienteExistente = $this->cliente->obtenerPorCorreo($_POST['correo']);


            if ($clienteExistente) {
                $idCliente = $clienteExistente["id_cliente"];
            } else {
                $clienteData = [
                    'nombre'   => $_POST['cliente'] ?? '',
                    'correo'   => $_POST['correo'] ?? '',
                    'telefono' => $_POST['telefono'] ?? ''
                ];

                $idCliente = $this->cliente->crear($clienteData);
                if (!$idCliente) {
                    echo "Error: No se pudo crear o buscar el cliente";
                    return;
                }
            }            

            // Crear reserva
            $reservaData = [
                'id_cliente'    => $idCliente,
                'id_empleado'   => $_POST['barbero'] ?? 0,
                'fecha_reserva' => $_POST['fecha'] ?? '',
                'hora_reserva'  => $_POST['hora'] ?? ''
            ];

            $idReserva = $this->reserva->crear($reservaData);

            if ($idReserva) {
                if (!empty($_POST['servicios'])) {
                    $this->reserva->agregarServicios($idReserva, $_POST['servicios']);
                }
                // Obtener nombre del barbero
                $barbero = $this->empleado->leerUno((int) $data["barbero"]);
                $nombreBarbero = $barbero ? $barbero["nombre"] : "Barbero asignado";

                // Enviar correo al cliente
                Mailer::enviarReservaExitosa(
                    $_POST['correo'],
                    $_POST['cliente'],
                    [
                        "fecha"   => $_POST['fecha'],
                        "hora"    => $_POST['hora'],
                        "barbero" => $nombreBarbero
                    ]
                );

                header("Location: " . BASE_PATH . "panel/reservas");
                exit;
            } else {
                echo "Error al crear la reserva.";
            }
        } else {
            echo "Error al enviar el formulario.";
        }
    }

    // Editar reserva
    public function editar(int $id): void {
        $reservaData = $this->reserva->leerUno($id);

        if (!$reservaData) {
            echo "Reserva no encontrada.";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // --- Datos del cliente ---
            $clienteData = [
                'nombre'   => $_POST['cliente'] ?? '',
                'correo'   => $_POST['correo'] ?? '',
                'telefono' => $_POST['telefono'] ?? ''
            ];

            $idCliente = (int)($_POST['id_cliente'] ?? 0);

            // 1. Actualizar cliente
            $this->cliente->actualizar($idCliente, $clienteData);

            // --- Datos de la reserva ---
            $reservaData = [
                'id_cliente'    => $idCliente,
                'id_empleado'   => $_POST['barbero'] ?? 0,
                'fecha_reserva' => $_POST['fecha'] ?? '',
                'hora_reserva'  => $_POST['hora'] ?? ''
            ];

            // 2. Actualizar reserva
            if ($this->reserva->actualizar($id, $reservaData)) {

                // 3. Actualizar servicios
                $servicios = $_POST['servicios'] ?? []; // array de servicios seleccionados
                $this->reserva->actualizarServicios($id, $servicios);

                header("Location: " . BASE_PATH . "panel/reservas");
                exit;
            } else {
                echo "Error al actualizar.";
            }
        }


        $stmt = $this->reserva->leerTodos();
        $servicios = $this->servicio->leerTodos();
        $barberos = $this->empleado->leerTodos();
        $action = "editar";
        $idReserva = $id;
        require __DIR__ . "/vista/reservas.php";
    }

    // Eliminar reserva
    public function eliminar(int $id): void {
        if ($this->reserva->eliminar($id)) {
            header("Location: " . BASE_PATH . "panel/reservas");
            exit;
        } else {
            echo "Error al eliminar.";
        }
    }
}
