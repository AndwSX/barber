<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Administrativo - Barbería</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
   <link rel="icon"  type="image/png" href="/barber/public/imagenes/logo.jpg">
</head>

<body class="bg-dark text-light">

  <div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-black text-warning p-3 d-flex flex-column" style="width: 250px; min-height: 100vh;">
      <h4><i class="fas fa-user-shield me-2"></i>Admin Panel</h4>
      <hr class="border-warning">
      <a href="#" class="d-block my-2 text-warning text-decoration-none" onclick="event.preventDefault(); cargarEnFrame('../dashboard/Grafica.html')"><i class="fas fa-chart-pie me-2"></i>dashboard</a>
      <a href="#" class="d-block my-2 text-warning text-decoration-none" onclick="event.preventDefault(); cargarEnFrame('/dashboard/Gestion.-clientes.html')"><i class="fas fa-users me-2"></i>Clientes</a>
      <a href="#" class="d-block my-2 text-warning text-decoration-none" onclick="event.preventDefault(); cargarEnFrame('../dashboard/Gestion-barberos.html')"><i class="fas fa-cut me-2"></i>Barberos</a>
      <a href="#" class="d-block my-2 text-warning text-decoration-none" onclick="event.preventDefault(); cargarEnFrame('../dashboard/promociones.html')"><i class="fas fa-tags me-2"></i>Promociones</a>
      <a href="#" class="d-block my-2 text-warning text-decoration-none" onclick="event.preventDefault(); cargarEnFrame('../dashboard/Hora.html')"><i class="fas fa-calendar me-2"></i>Gestion de Citas</a>
      <!-- Cerrar sesion -->

      <a href="/homepage/index2.0.html" class="d-block my-2 text-dark text-decoration-none mt-auto border border-warning bg-warning p-2 rounded-3 d-flex align-items-center" >Cerrar sesion</a>


    </div>


    <!-- Main Content -->
    <div class="p-4 flex-fill" id="main-content" style="height: 100%;">
    </div>
  </div>

  <!-- Bootstrap y Google Charts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- Tu script aparte -->
  <script src="/barber/public/js/dashboard/administrdor.js"></script>
</body>
</html>
