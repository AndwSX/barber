<?php
namespace App\Panel;

class PanelController {
    public function index(string $subRoute = ""): void {
        $sub = $subRoute; //variable para deifinir que mostrar
        require __DIR__ . "/vista/layout.php";
    }
}
