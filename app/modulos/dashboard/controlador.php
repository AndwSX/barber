<?php
namespace App\Modulos;

require_once __DIR__ . "/../servicios/modelo.php";
require_once __DIR__ . "/../clientes/modelo.php";
require_once __DIR__ . "/../reservas/modelo.php";

use App\Modelos\Reserva;
use App\Modelos\Servicio;
use App\Modelos\Cliente;


class DashboardController {
    private $reserva;
    private $servicio;
    private $empleado;
    private $cliente;

    public function __construct() {
        $this->reserva = new Reserva();
        $this->servicio = new Servicio();
        $this->cliente = new Cliente();
    }

    public function index(): void {
        // --- Ingresos por mes (para gráfica) ---
        $ingresosDB = $this->reserva->ingresosPorMes();

        // Array de 12 meses en 0
        $ingresosPorMes = array_fill(1, 12, 0);

        // Llenar los meses que sí tienen datos
        foreach ($ingresosDB as $row) {
            $mes = (int)$row['mes'];
            $total = (float)$row['total'];
            $ingresosPorMes[$mes] = $total;
        }

        // Etiquetas (enero a diciembre)
        $labels = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];

        // --- Total mes actual (para el badge) ---
        $mesActual = date('n'); // número de mes actual (1-12)
        $totalMesActual = $ingresosPorMes[$mesActual] ?? 0;

        // --- Servicios ---
        $servicios = $this->reserva->conteoServicios(); 

        // --- Clientes semanales ---
        $clientes = $this->reserva->clientesSemanales();

        // Pasar a la vista
        require __DIR__ . "/vista/grafica.php";
    }

}
