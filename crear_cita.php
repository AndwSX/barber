<?php
// Para depuración (quítalo en producción)
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Cita.php';

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'No se pudo conectar a la base de datos']);
    exit;
}

$cita = new Cita($db);

// leer JSON del body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'JSON inválido o body vacío']);
    exit;
}

// asignar campos (validando)
$cita->id_clientes_barberia = $input['id_clientes_barberia'] ?? null;
$cita->id_empleado = $input['id_empleado'] ?? null;
$cita->fecha_hora = $input['fecha_hora'] ?? null;
$cita->estado = $input['estado'] ?? 'Reservada';

if (!$cita->id_clientes_barberia || !$cita->id_empleado || !$cita->fecha_hora) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Faltan campos obligatorios: id_clientes_barberia, id_empleado, fecha_hora']);
    exit;
}

try {
    if ($cita->crear()) {
        http_response_code(201);
        echo json_encode(['success' => true, 'message' => 'Cita creada correctamente']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'No se pudo crear la cita']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error BD: ' . $e->getMessage()]);
}
