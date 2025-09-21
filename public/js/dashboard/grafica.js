// --- Servicios detallados ---
let serviciosLabels = [], serviciosValores = [];
serviciosData.forEach(item => {
    serviciosLabels.push(item.servicio);
    serviciosValores.push(item.cantidad);
});

// Funciones para colores
function generarColorAleatorio() {
   // Valores de 0 a 150 (para que quede oscuro, no se acerca al blanco 255)
    const r = Math.floor(Math.random() * 150);
    const g = Math.floor(Math.random() * 150);
    const b = Math.floor(Math.random() * 150);

    // Convertir a HEX
    return "#" + [r, g, b]
        .map(x => x.toString(16).padStart(2, "0"))
        .join("");
}

function generarColoresUnicos(cantidad) {
    const colores = new Set();
    while (colores.size < cantidad) {
        colores.add(generarColorAleatorio());
    }
    return Array.from(colores);
}

// 👉 Generamos colores aquí ANTES de usarlos
const colores = generarColoresUnicos(serviciosValores.length);

// --- Renderizar lista de servicios con cantidad ---
const listaServicios = document.getElementById("listaServicios");
listaServicios.innerHTML = "";

serviciosData.forEach((item, index) => {
    const color = colores[index];
    listaServicios.innerHTML += `
        <li class="d-flex justify-content-between align-items-center servicio-item">
            <span class="badge" style="background-color:${color};">${item.servicio}</span>
            <span class="text-light fw-bold">${item.cantidad} servicios</span>
        </li>
    `;
});

// --- Renderizar porcentajes ---
const totalServicios = serviciosValores.reduce((acc, val) => acc + val, 0);
const porcentajesDiv = document.getElementById("porcentajesServicios");
porcentajesDiv.innerHTML = "";

serviciosData.forEach((item, index) => {
    const color = colores[index];
    const porcentaje = totalServicios > 0 ? ((item.cantidad / totalServicios) * 100).toFixed(1) : 0;
    porcentajesDiv.innerHTML += `
        <span class="badge me-1" style="background-color:${color};">
            ${item.servicio}: ${porcentaje}%
        </span>
    `;
});

// --- Clientes semanales ---
document.getElementById("conteoClientes").textContent = `*Clientes semanales: ${clientesData}`;

// --- Gráfica Progreso de Ventas ---
const progressCtx = document.getElementById('progressChart').getContext('2d');
new Chart(progressCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Ingresos ($)',
            data: ingresos,
            borderColor: '#FFD700',
            backgroundColor: 'rgba(255, 215, 0, 0.1)',
            tension: 0.4,
            fill: true,
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { labels: { color: 'white' } } },
        scales: {
            y: { ticks: { color: 'white' }, grid: { color: 'rgba(255,255,255,0.1)' } },
            x: { ticks: { color: 'white' }, grid: { color: 'rgba(255,255,255,0.1)' } }
        }
    }
});

// --- Gráfica Distribución de Servicios ---
const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
        labels: serviciosLabels,
        datasets: [{
            data: serviciosValores,
            backgroundColor: colores,
            borderColor: '#343a40',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: 'white' }, position: 'bottom' }
        }
    }
});
