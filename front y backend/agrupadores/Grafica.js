// Progreso de Ventas
const progressCtx = document.getElementById('progressChart').getContext('2d');
const progressChart = new Chart(progressCtx, {
    type: 'line',
    data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
        datasets: [
            {
                label: 'Total Revenue ($)',
                data: [8000, 12000, 15000, 18000, 21000, 24000],
                borderColor: '#FFD700',
                backgroundColor: 'rgba(255, 215, 0, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Profit So Far ($)',
                data: [4000, 6000, 8000, 10000, 11000, 12000],
                borderColor: '#198754',
                backgroundColor: 'rgba(25, 135, 84, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: 'white', font: { size: 12 } } },
            tooltip: { mode: 'index', intersect: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 30000,
                ticks: { color: 'white', callback: value => '$' + value.toLocaleString() },
                grid: { color: 'rgba(255, 255, 255, 0.1)' }
            },
            x: {
                ticks: { color: 'white' },
                grid: { color: 'rgba(255, 255, 255, 0.1)' }
            }
        }
    }
});

// Distribución de Servicios
const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
const doughnutChart = new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
        labels: ['Corte', 'Barba', 'Cejas', 'Otros'],
        datasets: [{
            data: [40, 25, 15, 20],
            backgroundColor: ['#FFD700', '#0d6efd', '#198754', '#dc3545'],
            borderWidth: 1,
            borderColor: '#343a40'
        }]
    },
    options: {
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: { color: 'white', padding: 20 }
            },
            tooltip: {
                callbacks: {
                    label: context => `${context.label}: ${context.raw}%`
                }
            }
        }
    }
});
