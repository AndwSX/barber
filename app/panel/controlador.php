<?php
namespace App\Panel;

class PanelController {
    public function index(string $subRoute = "", string $id = "", string $accion = ""): void {
        $modulo = $subRoute; //variable para deifinir que mostrar
        $id = $id;
        $action = $accion;
        require __DIR__ . "/vista/layout.php";
    }
}
