<?php
namespace App\Modulos;

require_once __DIR__ . "/modelo.php";

use App\Modelos\Promocion;

class PromocionesController {
    private $promocion;

    public function __construct() {
        $this->promocion = new Promocion();
    }

    // Mostrar lista
    public function index(): void {
        $stmt = $this->promocion->leerTodos();
        $action = "crear"; //la pasamos a la vista
        require __DIR__ . "/vista/promociones.php";
    }

    // Crear Promocion
    public function crear(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'  => $_POST['nombre'] ?? '',
                'descripcion'  => $_POST['descripcion'] ?? '',
                'tipo' => $_POST['tipo'] ?? ''              
            ];

            if ($this->promocion->crear($data)) {
                header("Location: " . BASE_PATH . "panel/promociones");
                exit;
            } else {
                $error = "Error al crear.";
            }
        }else{
            echo "Error al enviar el formulario";
        }
    }

    // Editar Promocion
    public function editar(int $id): void {
        $promocionData = $this->promocion->leerUno($id);

        if (!$promocionData) {
            echo "Promocion no encontrada.";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'       => $_POST['nombre'] ?? '',
                'descripcion'       => $_POST['descripcion'] ?? '',
                'tipo' => $_POST['tipo'] ?? '' 
            ];

            if ($this->promocion->actualizar($id, $data)) {
                header("Location: " . BASE_PATH . "panel/promociones");
                exit;
            } else {
                $error = "Error al actualizar.";
            }
        }
        $stmt = $this->promocion->leerTodos();
        $action = "editar"; //la pasamos a la vista
        $idPromocion = $id; //la pasamos a la vista
        require __DIR__ . "/vista/promociones.php";
    }

    // Eliminar servicio
    public function eliminar(int $id): void {
        if ($this->promocion->eliminar($id)) {
            header("Location: " . BASE_PATH . "panel/promociones");
            exit;
        } else {
            echo "Error al eliminar.";
        }
    }
}
