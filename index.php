<?php
require_once __DIR__ . "/app/Router.php";

use App\Router;

$requestUri = $_SERVER['REQUEST_URI'];

// Si el proyecto está en carpeta ej: /mi-proyecto, limpia el path
$basePath = "/mi-proyecto";
$route = str_replace($basePath, "", $requestUri);
$route = trim($route, "/");

// Crear Router y manejar la ruta
$router = new Router();
$router->handle($route);

?>