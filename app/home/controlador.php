<?php
namespace App\Home;

class HomeController {
    public function index(): void {
        require __DIR__ . "/vista/homepage.php";
    }
}


?>