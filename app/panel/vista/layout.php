<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Administrativo - Barbería</title>
  <base href="<?= BASE_PATH ?>">
  <script>const BASE_PATH = "<?= BASE_PATH ?>";</script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
  <link rel="icon"  type="image/png" href="public/imagenes/logo.jpg">
  <link rel="stylesheet" href="public/css/modulos.css">
</head>

<body class="bg-dark text-light">

<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-black text-warning p-3 d-flex flex-column" style="width: 250px; min-height: 100vh;">
    <h4><i class="fas fa-user-shield me-2"></i>Admin Panel</h4>
    <hr class="border-warning">
    <a href="panel/dashboard" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-chart-pie me-2"></i>Dashboard</a>
    <a href="panel/clientes" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-users me-2"></i>Clientes</a>
    <a href="panel/empleados" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-cut me-2"></i>Barberos</a>
    <a href="panel/promociones" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-tags me-2"></i>Promociones</a>
    <a href="panel/reservas" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-calendar me-2"></i>Gestión de Citas</a>
    <a href="panel/servicios" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-handshake me-2"></i>Gestión de Servicios</a>

    
    <button id="btnLogout"class="d-block my-2 text-dark text-decoration-none mt-auto border border-warning bg-warning p-2 rounded-3 d-flex align-items-center">Cerrar sesión</button>
  </div>

  <!-- Contenido dinámico -->
  <div class="p-4 flex-fill" id="main-content">
      <?php

      switch ($modulo) {
          case "dashboard":
              require_once __DIR__ . "/../../modulos/dashboard/controlador.php";
              $controller = new \App\Modulos\DashboardController();
              $controller->index();
              break;

          case "clientes":
              require_once __DIR__ . "/../../modulos/clientes/controlador.php";
              $controller = new \App\Modulos\ClientesController();
              
              if ($id && $action === "editar") {
                  $controller->editar((int)$id);
              } elseif ($id && $action === "eliminar") {
                  $controller->eliminar((int)$id);
              } elseif ($id === "crear") {
                  $controller->crear();
              } else {
                  $controller->index();
              }
              break;
            
          case "empleados":
              require_once __DIR__ . "/../../modulos/barberos/controlador.php";
              $controller = new \App\Modulos\BarberosController();

              if ($id && $action === "editar") {
                  $controller->editar((int)$id);
              } elseif ($id && $action === "eliminar") {
                  $controller->eliminar((int)$id);
              } elseif ($id === "crear") {
                  $controller->crear();
              } else {
                  $controller->index();
              }
              break;
            
          case "promociones":
              require_once __DIR__ . "/../../modulos/promociones/controlador.php";
              $controller = new \App\Modulos\PromocionesController();
              
              if ($id && $action === "editar") {
                  $controller->editar((int)$id);
              } elseif ($id && $action === "eliminar") {
                  $controller->eliminar((int)$id);
              } elseif ($id === "crear") {
                  $controller->crear();
              } else {
                  $controller->index();
              }
              break; 

          case "reservas":
              require_once __DIR__ . "/../../modulos/reservas/controlador.php";
              $controller = new \App\Modulos\ReservasController();
              
              if ($id && $action === "editar") {
                  $controller->editar((int)$id);
              } elseif ($id && $action === "eliminar") {
                  $controller->eliminar((int)$id);
              } elseif ($id === "crear") {
                  $controller->crear();
              } else {
                  $controller->index();
              }
              break; 

          case "servicios":
              require_once __DIR__ . "/../../modulos/servicios/controlador.php";
              $controller = new \App\Modulos\ServiciosController();

              if ($id && $action === "editar") {
                  $controller->editar((int)$id);
              } elseif ($id && $action === "eliminar") {
                  $controller->eliminar((int)$id);
              } elseif ($id === "crear") {
                  $controller->crear();
              } else {
                  $controller->index();
              }
              break; 

          default:
              echo $modulo;
              break;
      }
      ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/panel/logout.js"></script>
</body>
</html>
