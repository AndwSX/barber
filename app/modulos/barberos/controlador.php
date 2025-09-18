<?php
namespace App\Modulos;

require_once __DIR__ . "/modelo.php";

use App\Modelos\Empleado;

class BarberosController
{
    private $empleado;

    public function __construct()
    {
        $this->empleado = new Empleado();
    }

    public function index(): void
    {
        $error = "";

        // ---- CREAR O ACTUALIZAR ----
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->empleado->nombre = $_POST['nombre'];
            $this->empleado->correo = $_POST['correo'];
            $this->empleado->especialidad = $_POST['especialidad'];
            $this->empleado->telefono = $_POST['telefono'];
            $this->empleado->estado = $_POST['estado'];

            if (!empty($_POST['id_empleado'])) {
                $this->empleado->id_empleado = $_POST['id_empleado'];
                if ($this->empleado->actualizar()) {
                    header("Location: ?mod=empleados&mensaje=Empleado actualizado correctamente");
                    exit;
                } else {
                    $error = "Error al actualizar.";
                }
            } else {
                if ($this->empleado->crear()) {
                    header("Location: ?mod=empleados&mensaje=Empleado creado correctamente");
                    exit;
                } else {
                    $error = "Error al crear el empleado.";
                }
            }
        }

        // ---- ELIMINAR ----
        if (isset($_GET['eliminar'])) {
            $this->empleado->id_empleado = $_GET['eliminar'];
            if ($this->empleado->eliminar()) {
                header("Location: ?mod=empleados&mensaje=Empleado eliminado correctamente");
            } else {
                $error = "Error al eliminar.";
            }
            exit;
        }

        // ---- EDITAR (cargar datos de un empleado) ----
        if (isset($_GET['editar'])) {
            $this->empleado->id_empleado = $_GET['editar'];
            if (!$this->empleado->leerUno()) {
                die("<div class='alert alert-danger'>Empleado no encontrado.</div>");
            }
        }

        // ---- DATOS PARA LA VISTA ----
        $empleado = $this->empleado;
        $stmt = $this->empleado->leerTodos();

        require __DIR__ . "/vista/barberos.php";
    }
}
