<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Administrativo - Barbería</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
  <link rel="icon"  type="image/png" href="/barber/public/imagenes/logo.jpg">
  <link rel="stylesheet" href="/public/css/modulos.css">
</head>

<body class="bg-dark text-light">

<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-black text-warning p-3 d-flex flex-column" style="width: 250px; min-height: 100vh;">
    <h4><i class="fas fa-user-shield me-2"></i>Admin Panel</h4>
    <hr class="border-warning">
    <a href="/barber/panel/dashboard" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-chart-pie me-2"></i>Dashboard</a>
    <a href="/barber/panel/clientes" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-users me-2"></i>Clientes</a>
    <a href="/barber/panel/empleados" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-cut me-2"></i>Barberos</a>
    <a href="/barber/panel/promociones" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-tags me-2"></i>Promociones</a>
    <a href="/barber/panel/citas" class="d-block my-2 text-warning text-decoration-none"><i class="fas fa-calendar me-2"></i>Gestión de Citas</a>

    <a href="/homepage/index2.0.html" class="d-block my-2 text-dark text-decoration-none mt-auto border border-warning bg-warning p-2 rounded-3 d-flex align-items-center">Cerrar sesión</a>
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
              $controller->index();
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
              $controller->index();
              break;

          case "citas":
              require_once __DIR__ . "/../../modulos/citas/controlador.php";
              $controller = new \App\Modulos\CitasController();
              $controller->index();
              break;

          default:
              echo $sub;
              break;
      }
      ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
