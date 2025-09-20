<?php
namespace App\Modulos;

require_once __DIR__ . "/modelo.php";

use App\Modelos\Empleado;

class BarberosController {
    private $empleado;

    public function __construct() {
        $this->empleado = new Empleado();
    }

    // Mostrar lista
    public function index(): void {
        $stmt = $this->empleado->leerTodos();
        $action = "crear"; //la pasamos a la vista
        require __DIR__ . "/vista/barberos.php";
    }

    // Crear empleado
    public function crear(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'       => $_POST['nombre'] ?? '',
                'correo'       => $_POST['correo'] ?? '',
                'especialidad' => $_POST['especialidad'] ?? '',
                'telefono'     => $_POST['telefono'] ?? '',
                'estado'       => $_POST['estado'] ?? 'activo'
            ];

            if ($this->empleado->crear($data)) {
                header("Location: /barber/panel/empleados");
                exit;
            } else {
                $error = "Error al crear.";
            }
        }else{
            echo "Error al enviar el formulario";
        }
    }

    // Editar empleado
    public function editar(int $id): void {
        $empleadoData = $this->empleado->leerUno($id);

        if (!$empleadoData) {
            echo "Empleado no encontrado.";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'       => $_POST['nombre'] ?? '',
                'correo'       => $_POST['correo'] ?? '',
                'especialidad' => $_POST['especialidad'] ?? '',
                'telefono'     => $_POST['telefono'] ?? '',
                'estado'       => $_POST['estado'] ?? 'activo'
            ];

            if ($this->empleado->actualizar($id, $data)) {
                header("Location: /barber/panel/empleados");
                exit;
            } else {
                $error = "Error al actualizar.";
            }
        }
        $stmt = $this->empleado->leerTodos();
        $action = "editar"; //la pasamos a la vista
        $idEmpleado = $id; //la pasamos a la vista
        require __DIR__ . "/vista/barberos.php";
    }

    // Eliminar empleado
    public function eliminar(int $id): void {
        if ($this->empleado->eliminar($id)) {
            header("Location: /barber/panel/empleados");
            exit;
        } else {
            echo "Error al eliminar.";
        }
    }
}
