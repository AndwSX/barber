<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/barber/public/css/agendarCita.css">
     <link rel="icon"  type="image/png" href="/barber/public/imagenes/logo.jpg">
    <title>Confirmar Reserva</title>
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
<div class="card-reserva">
  <details class="reserva-header" open>
    <summary>TU RESERVA</summary>

    <div class="formulario-datos">
      <h3>Necesitamos algunos datos</h3>

      <form id="form-confirmacion" onsubmit="return false;">
        <div class="input-group">
          <label for="nombre">Nombre completo *</label>
          <input type="text" id="nombre" name="nombre" required />
        </div>

        <div class="input-group">
          <label for="email">Correo electrónico *</label>
          <input type="email" id="email" name="email" required />
        </div>

        <div class="input-row">
  <div class="input-group">
    <label for="pais">País</label>
    <select id="pais" name="pais">
      <option value="57" selected>+57</option>
      <option value="1">+1</option>
      <option value="55">+55</option>
      <!-- puedes añadir más -->
    </select>
  </div>

  <div class="input-group">
    <label for="telefono">Teléfono celular *</label>
    <input
      type="tel"
      id="telefono"
      name="telefono"
      required
      maxlength="15"
      pattern="[0-9]+"
      inputmode="numeric"
      oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    />
  </div>
</div>

<button type="submit" class="btn-reservar">RESERVAR</button>
 <div id="mensaje-exito" style="display: none; color: green; margin-top: 1em; font-weight: bold;">
            ✅ Reserva exitosa
        </div>
      </form>
    </div>
  </details>
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
  <div id="debug-servicios"></div>
</div>

 <hr>

 <div class="total">
       <strong>Total a pagar</strong>
       <strong id="total-amount">$ 0</strong>
      </div>

    </aside>
    <script src="/barber/public/js/agendarCita/confirmar.js"> </script>
</body>
</html>