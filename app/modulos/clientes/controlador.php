<?php
namespace App\Modulos;

class ClientesController {
    public function index(): void {
        require_once __DIR__ . "/vista/clientes.php";
    }
}
