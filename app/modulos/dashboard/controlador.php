<?php
namespace App\Modulos;

class DashboardController {
    public function index(): void {
        require_once __DIR__ . "/vista/grafica.php";
    }
}
