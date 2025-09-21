<?php
namespace App\Modulos;

require_once __DIR__ . "/modelo.php";

use App\Modelos\Servicio;

class ServiciosController {
    private $servicio;

    public function __construct() {
        $this->servicio = new Servicio();
    }

    // Mostrar lista
    public function index(): void {
        $stmt = $this->servicio->leerTodos();
        $action = "crear"; //la pasamos a la vista
        require __DIR__ . "/vista/servicios.php";
    }

    // Crear Servicio
    public function crear(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'       => $_POST['nombre'] ?? '',
                'descripcion'       => $_POST['descripcion'] ?? '',
                'precio'   => $_POST['precio'] ?? '',
                'duracion_min' => $_POST['duracion_min'] ?? ''                
            ];

            if ($this->servicio->crear($data)) {
                header("Location: " . BASE_PATH . "panel/servicios");
                exit;
            } else {
                $error = "Error al crear.";
            }
        }else{
            echo "Error al enviar el formulario";
        }
    }

    // Editar Servicio
    public function editar(int $id): void {
        $servicioData = $this->servicio->leerUno($id);

        if (!$servicioData) {
            echo "Servicio no encontrado.";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'       => $_POST['nombre'] ?? '',
                'descripcion'       => $_POST['descripcion'] ?? '',
                'precio'   => $_POST['precio'] ?? '',
                'duracion_min' => $_POST['duracion_min'] ?? '' 
            ];

            if ($this->servicio->actualizar($id, $data)) {
                header("Location: " . BASE_PATH . "panel/servicios");
                exit;
            } else {
                $error = "Error al actualizar.";
            }
        }
        $stmt = $this->servicio->leerTodos();
        $action = "editar"; //la pasamos a la vista
        $idServicio = $id; //la pasamos a la vista
        require __DIR__ . "/vista/servicios.php";
    }

    // Eliminar servicio
    public function eliminar(int $id): void {
        if ($this->servicio->eliminar($id)) {
            header("Location: " . BASE_PATH . "panel/servicios");
            exit;
        } else {
            echo "Error al eliminar.";
        }
    }
}
