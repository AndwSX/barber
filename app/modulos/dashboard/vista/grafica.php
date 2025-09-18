<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Barbería</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .servicio-item {
            font-size: 1.1rem;
            padding: 0.3rem 0;
        }
    </style>
</head>
<body class="bg-dark text-light">
    <div class="container py-4">
        <h1 class="mb-4 text-warning text-center">Dashboard de Ventas - Barbería</h1>

        <div class="row g-4">
            <!-- Progreso de Ventas con Servicios Detallados -->
            <div class="col-lg-7">
                <div class="card bg-black border border-warning shadow-sm card-hover h-100">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <div>
                            <h5 class="card-title text-warning">Progreso de Ventas</h5>
                            <canvas id="progressChart"></canvas>
                            <div class="mt-3">
                                <span class="badge bg-warning text-dark me-2">Total Revenue: $24,000</span>
                                <span class="badge bg-success">Profit So Far: $12,000</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 class="text-warning">Servicios Detallados</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between align-items-center servicio-item">
                                    <span class="badge bg-warning text-dark">Corte</span>
                                    <span class="text-light fw-bold">120 servicios</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center servicio-item">
                                    <span class="badge bg-primary">Barba</span>
                                    <span class="text-light fw-bold">75 servicios</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center servicio-item">
                                    <span class="badge bg-success">Cejas</span>
                                    <span class="text-light fw-bold">45 servicios</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center servicio-item">
                                    <span class="badge bg-danger">Otros</span>
                                    <span class="text-light fw-bold">60 servicios</span>
                                </li>
                            </ul>
                            <div class="mt-2 text-center">
                                <small class="text-muted">*Clientes semanales: 60</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribución de Servicios -->
            <div class="col-lg-5">
                <div class="card bg-black border border-warning shadow-sm card-hover h-100">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <div>
                            <h5 class="card-title text-warning">Distribución de Servicios</h5>
                            <canvas id="doughnutChart"></canvas>
                        </div>
                        <div class="mt-3 text-center">
                            <span class="badge bg-warning text-dark me-1">Corte: 40%</span>
                            <span class="badge bg-primary me-1">Barba: 25%</span>
                            <span class="badge bg-success me-1">Cejas: 15%</span>
                            <span class="badge bg-danger">Otros: 20%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Archivo JS separado -->
    <script src="/barber/public/js/dashboard/grafica.js"></script>
</body>
</html>
