<?php
namespace App\Modulos;

class CitasController {
    public function index(): void {
        require_once __DIR__ . "/vista/citas.php";
    }
}
