<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Horarios - Barberia</title>
    <base href="<?= BASE_PATH ?>">
    <script>const BASE_PATH = "<?= BASE_PATH ?>";</script>
    <link rel="stylesheet" href="public/css/agendarCita.css">
     <link rel="icon"  type="image/png" href="public/imagenes/logo.jpg">
</head>
<body>
    <div class="container">
        <nav class="navbar">
  <div class="top-action">
    <img src="public/imagenes/logo.jpg" alt="logo" width="30" height="30" class="me-2">
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

      <!--fechas-->
<div class="horarios-container">
  <h2 style="text-align: center;">Selecciona una fecha</h2>

  <div class="carrusel-wrapper">
    <button class="btn-carrusel" onclick="moverCarrusel(-1)">❮</button>

    <div class="carrusel-scroll-area" id="scrollArea">
    <div class="carrusel-fechas" id="carrusel-fechas">
    </div>
    </div>
    <button class="btn-carrusel" onclick="moverCarrusel(1)">❯</button>
  </div>
   
  <h3 style="margin-top: 1em;">Horarios disponibles</h3>
  <div class="horas-disponibles" id="horas-disponibles"></div>

</div>

<!--horas-->
<div class="bloque-horas">
  <div class="columna-horas">
    <h4></h4>
    <!-- horas de la mañana -->
  </div>
  <div class="columna-horas">
    <h4></h4>
    <!-- horas de la tarde -->
  </div>
  <div class="columna-horas">
    <h4></h4>
    <!-- horas de la noche -->
  </div>
</div>


    </div>
    <br>
    
    <aside class="sumary">
        <div class="shop-info">
            <img src="public/imagenes/logo.jpg" alt="Logo Barberia" class="shop-logo">
        </div>
        <strong class="warning-title">Style Barber</strong>
        <p>carrera 59#129b-32</p>
      </div>
    </div>

    <div class="sumary-services" id="barbero-resumen" style="margin-bottom: 1em;">
        <h4>Barbero</h4>
    </div>

        <div class="sumary-services" id="resumen-horario" style="margin-bottom: 1em;">
  <h4>Fecha y hora seleccionadas</h4>
  <p id="fecha-mostrada">Fecha: —</p>
  <p id="hora-mostrada">Hora: —</p>
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
 <script src="public/js/agendarCita/horarios.js"></script>
</body>
</html>
