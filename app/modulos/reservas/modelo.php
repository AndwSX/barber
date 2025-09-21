<?php
namespace App\Modelos;

require_once __DIR__ . "/../../config/Database.php";

use PDO;
use App\config\Database;

class Reserva {
    private $conn;
    private $table = "reservas";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Crear reserva
    public function crear(array $data): int|false {
        $sql = "INSERT INTO {$this->table} (id_cliente, id_empleado, fecha_reserva, hora_reserva) 
                VALUES (:id_cliente, :id_empleado, :fecha_reserva, :hora_reserva)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([
            ':id_cliente'     => $data['id_cliente'],
            ':id_empleado'    => $data['id_empleado'],
            ':fecha_reserva'  => $data['fecha_reserva'],
            ':hora_reserva'   => $data['hora_reserva']
        ])) {
            return (int) $this->conn->lastInsertId(); // Retorna id_reserva
        }
        return false;
    }


    // Guardar servicios de la reserva (múltiples)
    public function agregarServicios(int $id_reserva, array $ids_servicios): bool {
        $sql = "INSERT INTO detalle_reserva (id_reserva, id_servicio) 
                VALUES (:id_reserva, :id_servicio)";
        $stmt = $this->conn->prepare($sql);

        foreach ($ids_servicios as $id_servicio) {
            $stmt->execute([
                ':id_reserva' => $id_reserva,
                ':id_servicio' => $id_servicio
            ]);
        }

        return true;
    }


    // Leer todas las reservas con cliente, barbero y servicios
    public function leerTodos(): array {
        $sql = "SELECT r.id_reserva, 
                    r.fecha_reserva AS fecha, 
                    r.hora_reserva AS hora, 
                    c.nombre AS nombre_cliente, 
                    c.telefono AS telefono_cliente, 
                    e.nombre AS nombre_empleado, 
                    GROUP_CONCAT(s.nombre SEPARATOR ', ') AS servicios, 
                    SUM(s.duracion_min) AS duracion_total
                FROM {$this->table} r
                INNER JOIN clientes c ON r.id_cliente = c.id_cliente
                INNER JOIN empleados e ON r.id_empleado = e.id_empleado
                LEFT JOIN detalle_reserva dr ON r.id_reserva = dr.id_reserva
                LEFT JOIN servicios s ON dr.id_servicio = s.id_servicio
                GROUP BY r.id_reserva, r.fecha_reserva, r.hora_reserva, 
                        c.nombre, c.telefono, e.nombre
                ORDER BY r.id_reserva DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Leer una reserva completa con cliente, barbero y servicios
    public function leerUno(int $id): array|false {
        $sql = "SELECT r.id_reserva,
                    r.fecha_reserva AS fecha,
                    r.hora_reserva AS hora,
                    c.id_cliente,
                    c.nombre AS nombre_cliente,
                    c.correo AS correo_cliente,
                    c.telefono AS telefono_cliente,
                    e.id_empleado,
                    e.nombre AS nombre_empleado
                FROM {$this->table} r
                INNER JOIN clientes c ON r.id_cliente = c.id_cliente
                INNER JOIN empleados e ON r.id_empleado = e.id_empleado
                WHERE r.id_reserva = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reserva) {
            return false;
        }

        // Traer servicios asociados
        $sqlServicios = "SELECT id_servicio FROM detalle_reserva WHERE id_reserva = :id";
        $stmtServicios = $this->conn->prepare($sqlServicios);
        $stmtServicios->execute([':id' => $id]);
        $reserva['servicios'] = $stmtServicios->fetchAll(PDO::FETCH_COLUMN);

        return $reserva;
    }

    // Actualizar reserva
    public function actualizar(int $id, array $data): bool {
        $sql = "UPDATE {$this->table} 
                SET id_cliente = :id_cliente, id_empleado = :id_empleado, 
                    fecha_reserva = :fecha_reserva, hora_reserva = :hora_reserva
                WHERE id_reserva = :id_reserva";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_cliente'    => $data['id_cliente'],
            ':id_empleado'   => $data['id_empleado'],
            ':fecha_reserva' => $data['fecha_reserva'],
            ':hora_reserva'  => $data['hora_reserva'],
            ':id_reserva'    => $id
        ]);
    }

    // Actualizar servicios de una reserva
    public function actualizarServicios(int $id_reserva, array $servicios): bool {
        // Eliminar todos los servicios actuales
        $sqlDelete = "DELETE FROM detalle_reserva WHERE id_reserva = :id_reserva";
        $stmt = $this->conn->prepare($sqlDelete);
        $stmt->execute([':id_reserva' => $id_reserva]);

        // Insertar los nuevos (si hay)
        if (!empty($servicios)) {
            $sqlInsert = "INSERT INTO detalle_reserva (id_reserva, id_servicio) 
                        VALUES (:id_reserva, :id_servicio)";
            $stmtInsert = $this->conn->prepare($sqlInsert);

            foreach ($servicios as $id_servicio) {
                $stmtInsert->execute([
                    ':id_reserva'  => $id_reserva,
                    ':id_servicio' => $id_servicio
                ]);
            }
        }

        return true;
    }

    // Eliminar reserva
    public function eliminar(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id_reserva = :id_reserva";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id_reserva' => $id]);
    }

    // Clientes semanales
    public function clientesSemanales(): int {
        $sql = "SELECT COUNT(*) 
                FROM reservas 
                WHERE YEARWEEK(creada_en, 1) = YEARWEEK(CURDATE(), 1)";
        return (int)$this->conn->query($sql)->fetchColumn();
    }

    // Conteo de servicios
    public function conteoServicios(): array {
        $sql = "SELECT s.nombre AS servicio, COUNT(dr.id_servicio) AS cantidad
                FROM detalle_reserva dr
                INNER JOIN servicios s ON dr.id_servicio = s.id_servicio
                GROUP BY s.nombre";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Total de ingresos por mes
    public function ingresosPorMes(): array {
        $sql = "SELECT 
                    MONTH(r.creada_en) AS mes,
                    SUM(s.precio) AS total
                FROM reservas r
                INNER JOIN detalle_reserva dr ON r.id_reserva = dr.id_reserva
                INNER JOIN servicios s ON dr.id_servicio = s.id_servicio
                GROUP BY MONTH(r.creada_en)
                ORDER BY mes ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
