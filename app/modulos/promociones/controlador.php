<?php
namespace App\Modulos;

class PromocionesController {
    public function index(): void {
        require_once __DIR__ . "/vista/promociones.php";
    }
}
