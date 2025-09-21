<?php
namespace App\Modulos;

require_once __DIR__ . "/modelo.php";

use App\Modelos\Cliente;

class ClientesController {
    private $cliente;

    public function __construct() {
        $this->cliente = new Cliente();
    }

    // Mostrar lista
    public function index(): void {
        $stmt = $this->cliente->leerTodos();
        $action = "crear"; //la pasamos a la vista
        require __DIR__ . "/vista/clientes.php";
    }

    // Crear cliente
    public function crear(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'   => $_POST['nombreCliente'] ?? '',
                'correo'   => $_POST['correoCliente'] ?? '',
                'telefono' => $_POST['telefonoCliente'] ?? ''
            ];

            $idCliente = $this->cliente->crear($data);

            if ($idCliente !== false) {
                header("Location: " . BASE_PATH . "panel/clientes");
                exit;
            } else {
                $error = "Error al crear.";
                echo $error;
            }
        } else {
            echo "Error al enviar el formulario";
        }
    }

    // Editar cliente
    public function editar(int $id): void {
        $clienteData = $this->cliente->leerUno($id);

        if (!$clienteData) {
            echo "cliente no encontrado.";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'nombre'   => $_POST['nombreCliente'] ?? '',
                'correo'   => $_POST['correoCliente'] ?? '',
                'telefono' => $_POST['telefonoCliente'] ?? ''
            ];

            if ($this->cliente->actualizar($id, $data)) {
                header("Location: " . BASE_PATH . "panel/clientes");
                exit;
            } else {
                $error = "Error al actualizar.";
            }
        }
        $stmt = $this->cliente->leerTodos();
        $action = "editar"; //la pasamos a la vista
        $idCliente = $id; //la pasamos a la vista
        require __DIR__ . "/vista/clientes.php";
    }

    // Eliminar cliente
    public function eliminar(int $id): void {
        if ($this->cliente->eliminar($id)) {
            header("Location: " . BASE_PATH . "panel/clientes");
            exit;
        } else {
            echo "Error: no se puede eliminar el cliente porque tiene reservas asociadas.";
            exit;
        }
    }
}
