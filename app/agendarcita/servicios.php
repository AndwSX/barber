<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar servicios - Barberia</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="/imagenes/logo.jpg">
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="top-action">
                <img src="/imagenes/logo.jpg" alt="logo" width="30" height="30" class="me-2">
                <span class="warning-title">Style Barber</span> 
                <button class="btn-icon btn-back" title="Volver">←</button>
                <button class="btn-icon btn-cancel" title="Cancelar y volver al inicio">✕</button>
            </div>
            <div class="breadcrumb">
                <span>Servicios</span> > 
                <span>Equipo</span> > 
                <span>Horario</span> > 
                <span>Confirmar</span> >
            </div>
        </nav>

        <h1>Seleccionar servicios</h1>

        <h2 class="warning-title">Todos los servicios</h2>

        <?php
        // --- CONEXIÓN A LA BASE DE DATOS ---
        require_once 'Database.php';
        $database = new Database();
        $conn = $database->getConnection();

        // --- CONSULTA LOS SERVICIOS DESDE LA BD ---
        $stmt = $conn->query("SELECT nombre, descripcion, precio, duracion_min FROM servicios ORDER BY nombre ASC");
        while ($servicio = $stmt->fetch(PDO::FETCH_ASSOC)) :
        ?>
            <div class="service">
                <h3><?= htmlspecialchars($servicio['nombre']) ?></h3>
                <p class="duration"><?= $servicio['duracion_min'] ?> min</p>
                <p class="description"><?= htmlspecialchars($servicio['descripcion']) ?></p>
                <p class="price">$<?= number_format($servicio['precio'], 0, ',', '.') ?></p>
                <button class="toggle-btn"
                        data-name="<?= htmlspecialchars($servicio['nombre']) ?>"
                        data-price="<?= $servicio['precio'] ?>"
                        onclick="toggleService(this)">+
                </button>
            </div>
            <br>
        <?php endwhile; ?>
    </div>

    <aside class="sumary">
        <div class="shop-info">
            <img src="/imagenes/logo.jpg" alt="Logo Barberia" class="shop-logo">
        </div>
        <strong class="warning-title">Style Barber</strong>
        <p>carrera 59#129b-32</p>
    </aside>

    <div class="sumary-services" id="sumary-list" style="margin-bottom: 1em;">
        <h4>Resumen</h4>
    </div>
    <hr>

    <div class="total">
        <strong>Total a pagar</strong>
        <strong id="total-amount">$ 0</strong>
    </div>

    <button class="btn-continue" disabled>Continuar</button>
</body>

<!-- MANTENEMOS TU JS ORIGINAL SIN MODIFICAR -->
<script src="/javahome/servicios.js"></script>

<script>
// Aseguramos que el botón se actualice al cargar
document.addEventListener('DOMContentLoaded', () => {
    actualizarBotonContinuar();
});
</script>

</html>