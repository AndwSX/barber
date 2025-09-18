<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Promociones Exclusivas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-light p-4">
  <h2 class="text-center text-warning mb-4">Promociones Exclusivas</h2>

  <div class="row g-4">
    <!-- Cuadro de promociones existentes -->
    <div class="col-md-8">
      <div class="row g-4" id="contenedor-promociones">
        <!-- Ejemplo de promoción existente -->
        <div class="col-md-6">
          <div class="card bg-black text-white border border-warning">
            <div class="card-body text-center">
              <div class="display-4 mb-3 text-warning">💈</div>
              <h5 class="card-title text-white">Corte + Barba</h5>
              <p class="card-text text-light">20% de descuento los miércoles.</p>

            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card bg-black text-white border border-warning">
            <div class="card-body text-center">
              <div class="display-4 mb-3 text-warning">🎉</div>
              <h5 class="card-title text-white">Cumpleañeros</h5>
              <p class="card-text text-light">Corte gratis el día de tu cumpleaños.</p>

            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card bg-black text-white border border-warning">
            <div class="card-body text-center">
              <div class="display-4 mb-3 text-warning">👥</div>
              <h5 class="card-title text-white">Referidos</h5>
              <p class="card-text text-light">15% de descuento por cada amigo referido.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card bg-black text-white border border-warning">
            <div class="card-body text-center">
              <div class="display-4 mb-3 text-warning">💳</div>
              <h5 class="card-title text-white">Tarjeta Fidelidad</h5>
              <p class="card-text text-light">Cada 5 cortes, 1 gratis.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card bg-black text-white border border-warning">
            <div class="card-body text-center">
              <div class="display-4 mb-3 text-warning">🧴</div>
              <h5 class="card-title text-white">Tratamiento gratis</h5>
              <p class="card-text text-light">Por cortes mayores a $30.000.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Cuadro para agregar nueva promoción -->
    <div class="col-md-4">
      <div class="card bg-black text-white border border-warning">
        <div class="card-body">
          <h5 class="card-title text-warning text-center">Agregar Promoción</h5>
          <div class="mb-2">
            <label class="form-label">Nombre:</label>
            <input type="text" id="nombrePromo" class="form-control bg-dark text-white border-warning" placeholder="Ej: Corte 2x1" />
          </div>
          <div class="mb-2">
            <label class="form-label">Descripción:</label>
            <textarea id="descripcionPromo" class="form-control bg-dark text-white border-warning" placeholder="Ej: Solo los viernes..." rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipo:</label>
            <select id="tipoPromo" class="form-select bg-dark text-white border-warning">
              <option value="💥">Descuento</option>
              <option value="🎁">Regalo</option>
              <option value="⭐">Especial</option>
            </select>
          </div>
          <button onclick="agregarPromocion()" class="btn btn-warning w-100">Agregar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="/Agrupadoresjs/Promociones.js"></script>
</body>
</html>
