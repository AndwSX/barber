<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/app/router.php";

use App\Router;

$requestUri = $_SERVER['REQUEST_URI'];

// base path (porque está en /barber/)
$basePath = "/barber";
$route = str_replace($basePath, "", $requestUri);
$route = trim($route, "/");

$router = new Router();
$router->handle($route);

?>