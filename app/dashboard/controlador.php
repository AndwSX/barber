<?php
namespace App\Dashboard;

class DashboardController {
    public function index(): void {
        require __DIR__ . "/vista/administrador.php";
    }
}
