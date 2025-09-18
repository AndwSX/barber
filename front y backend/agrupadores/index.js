document.addEventListener("DOMContentLoaded", () => {
    // Coordenadas del lugar (puedes cambiar estas)
    const lat = 4.7327;
    const lng = -74.06649;

    // Crear mapa
    const map = L.map('map').setView([lat, lng], 13);

    // Capas base (estilos de mapa)
    const baseMaps = {
        "Claro (OSM)": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }),
        "Oscuro (CartoDB Dark)": L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '© CartoDB'
        }),
        "Satélite (Esri)": L.tileLayer('https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri, Maxar, Earthstar Geographics',
            maxZoom: 19
        })
    };

    // Agregar capa predeterminada
    baseMaps["Oscuro (CartoDB Dark)"].addTo(map);

    // Control de capas
    L.control.layers(baseMaps).addTo(map);

    // Agregar marcador
    L.marker([lat, lng]).addTo(map)
        .bindPopup("Mi ubicación")
        .openPopup();

    // Navbar activo
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

   document.getElementById('loginForm').addEventListener('submit', function (e) {
  e.preventDefault(); 

  // Usuario y contraseña permitidos
  const ADMIN_EMAIL = "nominasena793@gmail.com";
  const ADMIN_PASSWORD = "Lascanelitas2025";

  // Tomamos los valores del formulario
  const email = document.getElementById('emailLogin').value;
  const password = document.getElementById('passwordLogin').value;

  if(email === ADMIN_EMAIL && password === ADMIN_PASSWORD) {
    // Acceso correcto
    window.location.href = '/dashboard/Administrador.html'; 
  } else {
    // Acceso incorrecto
    // Abrir el modal de login si no está abierto
    const loginModalEl = document.getElementById('loginModal');
    const bsModal = new bootstrap.Modal(loginModalEl);
    bsModal.show();

    // Crear alerta solo si no existe ya
    const body = document.querySelector('#loginModal .modal-body');
    if(!document.querySelector('#loginModal .alert')) {
      const alert = document.createElement('div');
      alert.className = 'alert alert-danger';
      alert.textContent = 'Correo o contraseña incorrectos';
      body.prepend(alert);
    }
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  if (params.get('login') === 'fail') {
    const loginModalEl = document.getElementById('loginModal');
    const bsModal = new bootstrap.Modal(loginModalEl);
    bsModal.show();

    const body = document.querySelector('#loginModal .modal-body');
    if(!document.querySelector('#loginModal .alert')) {
      const alert = document.createElement('div');
      alert.className = 'alert alert-danger';
      alert.textContent = 'Correo o contraseña incorrectos';
      body.prepend(alert);
    }
  }
});

  

    // AOS
    AOS.init({
        duration: 1000,
        once: true,
    });
});

