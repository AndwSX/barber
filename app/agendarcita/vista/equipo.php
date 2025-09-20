<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar servicios - Barberia</title>
    <link rel="stylesheet" href="/barber/public/css/agendarCita.css">
     <link rel="icon"  type="image/png" href="/barber/public/imagenes/logo.jpg">
</head>
<body>
    <div class="container">
        <nav class="navbar">
  <div class="top-action">
    <img src="/barber/public/imagenes/logo.jpg" alt="logo" width="30" height="30" class="me-2">
    <span class="warning-title">Style Barber</span> 
    <button class="btn-icon btn-back" title="Volver">←</button>
    <button class="btn-icon btn-cancel" title="Cancelar y volver al inicio">✕</button>
  </div>
  <div class="breadcrumb">
    <span>Servicios</span> &gt; 
    <span>Equipo</span> &gt; 
    <span>Horario</span> &gt; 
    <span>Confirmar</span> &gt;
  </div>
</nav>

        <h1>Seleccionar a un Profesional del Equipo</h1>
        <div class="barbers-container">
          <div class="barber-card" onclick="seleccionarBarbero(this)" data-nombre="mayor disponibilidad" data-rating="5.0" data-foto="/barber/public/imagenes/aleatorio.jpg">
            <img src="/barber/public/imagenes/aleatorio.jpg" alt="Cualquier profesional" class="baber-photo shuffle-icon">
            <h3>Cualquier Profesional</h3>
            <p class="barber-role">Maxima disponibilidad</p>
          </div>
        <?php 
          $imagenes = [
              "/barber/public/imagenes/barbero new.png",
              "/barber/public/imagenes/barbero new2.jpg",
              "/barber/public/imagenes/barbero new3.jpg"
          ];

          foreach ($stmt as $row): 
              // Imagen aleatoria
              $foto = $imagenes[array_rand($imagenes)];
              // Rating aleatorio entre 4.0 y 5.0 (con un decimal)
              $rating = number_format(mt_rand(40, 50) / 10, 1);
          ?>
              <div class="barber-card" onclick="seleccionarBarbero(this)" 
                  data-nombre="<?= htmlspecialchars($row['nombre']) ?>" 
                  data-rating="<?= $rating ?>" 
                  data-foto="<?= $foto ?>">

                  <img src="<?= $foto ?>" alt="<?= htmlspecialchars($row['nombre']) ?>" class="barber-photo">
                  <div class="barber-rating">⭐ <?= $rating ?></div>
                  <h3><?= htmlspecialchars($row['nombre']) ?></h3>
                  <input type="hidden" name="id_empleado" id="id_empleado" value="<?= $row['id_empleado'] ?>">
                  <p class="barber-role">Especialidad: <?= htmlspecialchars($row['especialidad']) ?></p>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
    <br>
    
    <aside class="sumary">
        <div class="shop-info">
            <img src="/barber/public/imagenes/logo.jpg" alt="Logo Barberia" class="shop-logo">
        </div>
        <strong class="warning-title">Style Barber</strong>
        <p>carrera 59#129b-32</p>
      </div>
    </div>

    <div class="sumary-services" id="barbero-resumen" style="margin-bottom: 1em;">
        <h4>Resumen</h4>

      </div>
      <div class="sumary-services" id="sumary-services">
  <h4>Servicios seleccionados</h4>
  <div id="sumary-list"></div> <!-- Aquí se listan los servicios -->
</div>
 <hr>

      <div class="total">
       <strong>Total a pagar</strong>
       <strong id="total-amount">$ 0</strong>
      </div>

      <button class="btn-continue"disabled>Continuar</button>
    </aside>
 <script src="/barber/public/js/agendarCita/equipo.js"></script>
</body>
</html>