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
<h1>Seleccionar servicios</h1>

        <h2 class="warning-title">Todos los servicios</h2>
        <?php foreach ($stmt as $row): ?>
        <div class="service">
                <h3><?= htmlspecialchars($row['nombre']) ?></h3>
                <p class="duration"><?= $row['duracion_min'] ?> min</p>
                <p class="description">
                   <?= htmlspecialchars($row['descripcion']) ?>
                </p>
                <p class="price">$<?= number_format($row['precio'], 0, ',', '.') ?></p>
                <button class="toggle-btn " data-name="<?= htmlspecialchars($row['nombre']) ?>" data-price="<?= number_format($row['precio'], 0, ',', '.') ?>" onclick="toggleService(this)">+</button>
            </div>
            <br>
        <?php endforeach; ?>
        </div>
    </div>
    
    <aside class="sumary">
        <div class="shop-info">
            <img src="/barber/public/imagenes/logo.jpg" alt="Logo Barberia" class="shop-logo">
        </div>
        <strong class="warning-title">Style Barber</strong>
        <p>carrera 59#129b-32</p>
      </div>
    </div>

    <div class="sumary-services" id="sumary-list" style="margin-bottom: 1em;">
        <h4>Resumen</h4>
    </div>
      <hr>

      <div class="total">
       <strong>Total a pagar</strong>
       <strong id="total-amount">$ 0</strong>
      </div>

      <button class="btn-continue"  disabled>Continuar</button>
    </aside>
<script src="/barber/public/js/agendarCita/servicios.js"></script>
</body>
</html>