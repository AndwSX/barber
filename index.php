<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim(str_replace('\\', '/', $scriptName), '/');

// Si estamos en la raíz "/", dejamos vacío
if ($basePath === '/' || $basePath === '\\') {
    $basePath = '';
}

// Siempre agregamos el slash final para <base>
define("BASE_PATH", $basePath . '/');

require_once __DIR__ . "/app/router.php";

use App\Router;

$route = trim(str_replace(BASE_PATH, '', $_SERVER['REQUEST_URI']), '/');

$router = new Router();
$router->handle($route);
