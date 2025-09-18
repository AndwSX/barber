<?php
namespace App\Modulos;

class BarberosController {
    public function index(): void {
        require_once __DIR__ . "/vista/barberos.php";
    }
}
