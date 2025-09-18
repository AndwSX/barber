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

//Login de inicio de sesion
document.getElementById("loginForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const correo = document.getElementById("correo").value.trim();
  const password = document.getElementById("password").value.trim();

  try {
    const res = await fetch("/barber/auth-login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ correo, password }),
    });

    // Leer respuesta cruda
    const rawText = await res.text();
    console.log("🔎 Respuesta cruda del servidor:", rawText);

    let data;
    try {
      data = JSON.parse(rawText);
    } catch (err) {
      console.error("⚠️ Error al parsear JSON:", err);
      alert("El servidor no devolvió un JSON válido");
      return;
    }

    if (data.success) {
      alert("Bienvenido " + data.usuario.nombre);
      localStorage.setItem("usuario", JSON.stringify(data.usuario));
      window.location.href = "panel";
    } else {
      alert("❌ " + data.message);
    }
  } catch (err) {
    console.error("Error en login:", err);
    alert("Error al conectar con el servidor");
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
