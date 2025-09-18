<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Style Barber</title>
    <link rel="icon"  type="image/png" href="/barber/public/imagenes/logo.jpg">
      <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="icon" type="imagen/jpg" href="logo.jpg">

  <!-- Leaflet CSS -->
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script
  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>
  <!-- Estilos personalizados -->
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      background-color:#000;
      color: #fff;
      padding-top: 70px;
    }

    .navbar {
      background-color: #000;
      transition: background-color 0.3s ease,box-shadow 0.3s ease;
      box-shadow: none;
    }
    
    .navbar .nav-link {
  color: white;
  font-size: 1rem;
  transition: all 0.3s ease;
}

/* Cuando se hace scroll o se hace clic, se aplica esta clase */
.navbar.scrolled .nav-link,
.navbar .nav-link.active {
  color: #ffc107 !important; /* text-warning */
  font-size: 1.2rem;
  font-weight: bold;
}

   .nav-link {
  position: relative;
  color: white;
  transition: color 0.3s ease;
}

.nav-link::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: -5px;
  width: 0;
  height: 2px;
  background-color: #ffc107;
  transition: width 0.3s ease;
}

.nav-link:hover {
  color: #ffc107;
}

.nav-link:hover::after {
  width: 100%;
}

.nav-link.active {
  color: #ffc107;
}

.nav-link.active::after {
  width: 100%;
}

.hero {
      position: relative;
      background: url('tu-imagen.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      color: white;
    }

    .hero-overlay {
      background-color: rgba(0, 0, 0, 0.6);
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      padding: 60px;
    }

    .hero-content h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .hero-content p {
      letter-spacing: 2px;
      font-size: 0.9rem;
      font-weight: 600;
      text-transform: uppercase;
      margin-bottom: 15px;
    }

    .cta {
      position: absolute;
      bottom: 30px;
      left: 60px;
      display: flex;
      align-items: center;
      gap: 15px;
      z-index: 1;
    }

    .btn-reservar {
      background-color: #f9a825;
      border: none;
      color: #000;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 5px;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2rem;
      }
    }
      

      .cta {
         position: fixed;
         bottom: 0;
        left: 0;
         width: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        padding: 15px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        z-index: 1050;
       box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.5);
      }

      .cta span {
    font-size: 1rem;
    font-weight: 500;
    color: #fff;
    margin: 0;
}

.btn-reservar {
  background-color: #f9a825;
  border: none;
  color: #000;
  font-weight: bold;
  padding: 8px 18px;
  border-radius: 5px;
  transition: background 0.3s ease;
}

@media (max-width: 768px) {
  .cta {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }
}

.btn-reservar:hover {
  background-color: #ffc107;
}
   

    .navbar-toggler {
  background-color: #fff;
  border: none;
}



.nosotros-section {
  background-color: #111;
  color: #fff;
}

.nosotros-section h2 {
  font-size: 2.5rem;
  color: #f9a825;
}

.nosotros-section img {
  width: 100%;
  max-height: 250px;
  height: 250px;
  object-fit: cover;
  border-radius: 10px;
  transition: transform 0.3s ease;
  display: block;
}

.nosotros-section img:hover {
  transform: scale(1.05);
}

.accordion-button:not(.collapsed) {
  background-color: #f9a825;
  color: white;
}

.accordion-item {
  margin-bottom: 10px;
  border: 1px solid #f9a825;
  border-radius: 5px;
}

.accordion-button::after {
  background-image: none !important;
  content: none !important;
}

.custom-arrow {
  color: #f9a825;
  transition: transform 0.3s ease;
}

.accordion-button.collapsed .custom-arrow {
  transform: rotate(0deg);
}

.accordion-button:not(.collapsed) .custom-arrow {
  transform: rotate(180deg);
  color: #fff176;
}


.carousel-inner img {
  height: 500px;
  object-fit: cover;
  filter: brightness(0.8);
}


.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: #000;
  border-radius: 50%;
  padding: 10px;
}

.carousel-img {
  height: 500px;
  object-fit: cover;
  border-radius: 20px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.5);
  filter: brightness(0.85);
}

.carousel-caption-custom {
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(0,0,0,0.6);
  padding: 15px 25px;
  border-radius: 10px;
  color: #fff;
  font-size: 1.8rem;
  font-weight: 600;
  text-shadow: 2px 2px 4px #000;
  font-family: 'Oswald', sans-serif;
}

 #map {
      height: 500px;
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
      margin: 2rem 0;
    }

    .btn-llegar{
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
    }
    .btn-llegar:hover{
      background-color: #0056b3;
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(0,123,255,0.6);
    }

    .leaflet-popup-content {
      font-family: 'Arial', sans-serif;
      text-align: center;
    }

   .custom-button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 8px 12px;
  background-color: #f9a825;
  color: #000;
  font-weight: bold;
  border-radius: 8px;
  text-decoration: none;
  font-size: 14px;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.custom-button:hover {
  background-color: #fff176;
  transform: scale(1.05);
  color: #000;
}


    /* Animación marcador */
    .leaflet-marker-icon {
      animation: bounce 1s infinite alternate;
    }

    @keyframes bounce {
      0% { transform: translateY(0); }
      100% { transform: translateY(-10px); }
    }

    .social-icon img {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 50%;
}

.social-icon:hover img {
  transform: scale(1.3);
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
}

.whatsapp-float {
  position: fixed;
  bottom: 120px;
  right: 20px;
  z-index: 1000;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.whatsapp-float img {
  border-radius: 50%;
}

.whatsapp-float:hover {
  transform: scale(1.2);
  box-shadow: 0 0 15px rgba(37, 211, 102, 0.6);
}

html {
  scroll-behavior: smooth;
}
</style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-4">
      <a class="navbar-brand d-flex align-items text-white fw-bold" href="#">
        <img src="/barber/public/imagenes/logo.jpg" alt="logo" width="30" height="30" class="me-2">
       <span class="text-warning">Style Barber</span> 
      </a>
      <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
          <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="#equipo">Equipo</a></li>
          <li class="nav-item"><a class="nav-link" href="#Mapa">Mapa-Ubicacion</a></li>
          <li class="nav-item"><a class="nav-link" href="agendar-cita/servicios">Agenda tu cita</a></li>

           <li class="nav-item">
    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">
      <i class="bi bi-person-circle"></i>
   </a>
    </li>
      </ul>
       </div>
        </div>
         </nav>

<!-- Modal de Inicio de Sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="loginForm">
          <div class="mb-3">
            <label for="emailLogin" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" required>
          </div>
          <div class="mb-3">
            <label for="passwordLogin" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" required>
          </div>
            <div class="mb-3 text-end">
            <a href="#" class="text-warning" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">¿Olvidaste tu contraseña?</a>
          </div>
          <button type="submit" class="btn btn-warning w-100">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Recuperación de Contraseña -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="emailRecovery" class="form-label">Ingresa tu correo electrónico</label>
            <input type="email" class="form-control" id="emailRecovery" required>
          </div>
          <button type="submit" class="btn btn-warning w-100">Enviar instrucciones</button>
        </form>
      </div>
    </div>
  </div>
</div>

 <section class="hero position-relative " id="inicio" >
  <div class="container-fluid">
    <div class="row g-0">
      <div class="col-4">
        <div class="bg-img" style="background-image: url('/barber/public/imagenes/barbero\ 3.jpg'); height: 100vh; background-size: cover; background-position: center;" data-aos="fade-left"></div>
      </div>
      <div class="col-4">
        <div class="bg-img" style="background-image: url('/barber/public/imagenes/barbero\ 2.jpg'); height: 100vh; background-size: cover; background-position: center;" data-aos="fade-right"></div>
      </div>
      <div class="col-4">
        <div class="bg-img" style="background-image: url('/barber/public/imagenes/barbero1.jpg'); height: 100vh; background-size: cover; background-position: center;" data-aos="fade-up"></div>
      </div>
    </div>

    <!-- Overlay y contenido -->
    <div class="hero-overlay"></div>
    <div class="hero-content position-absolute top-50 start-0 translate-middle-y ps-5">
      <p data-aos="fade-up">BIENVENIDO A STYLE BARBER</p>
      <h1 data-aos="fade-up">La barbería<br>más TOP de Bogotá</h1>
    </div>

    <!-- CTA -->
    <div class="cta">
      <span class="fw-medium">Vive esta experiencia</span>
      <button class="btn-reservar" >
        <a class="text-black" href="agendar-cita/servicios">Reservar</a></button>
    </div>
  </div>
</section>

<!-- Sección Nosotros -->
<section id="nosotros" class="nosotros-section py-5" data-aos="fade-up">
  <div class="container text-center text-white">
    <h2 class="mb-4 fw-bold" data-aos="fade-up">Sobre Nosotros</h2>
    <p class="lead mb-5">
      En <strong>Style Barber</strong>, no solo cortamos cabello, creamos experiencias.  
      Con un equipo de barberos expertos, una vibra urbana auténtica y pasión por el detalle,  
      te ofrecemos mucho más que un cambio de look.
    </p>
    
    <div class="row">
      <div class="col-md-4 mb-4" data-aos="">
        <img src="/barber/public/imagenes/antigua  barber.avif" alt="Experiencia" class="img-fluid rounded shadow" data-aos="fade-left">
        <h5 class="mt-3 fw-bold">+10 Años de Experiencia</h5>
        <p>Formamos estilos que reflejan personalidad, autenticidad y actitud.</p>
      </div>
      <div class="col-md-4 mb-4">
        <img src="/barber/public/imagenes/equipo barberos.jpg" alt="Nuestro Equipo" class="img-fluid rounded shadow" data-aos="fade-right">
        <h5 class="mt-3 fw-bold">Equipo Profesional</h5>
        <p>Barberos dedicados a brindar atención personalizada y un trato top.</p>
      </div>
      <div class="col-md-4 mb-4">
        <img src="/barber/public/imagenes/barberi sitio.jpg" alt="Ambiente" class="img-fluid rounded shadow" data-aos="fade-left">
        <h5 class="mt-3 fw-bold">Ambiente Exclusivo</h5>
        <p>Un lugar donde cada visita es una experiencia única y relajante.</p>
      </div>
    </div>
  </div>
</section>

<!-- Sección Servicios -->
<section id="servicios" class="py-5" style="background-color:#111;">
  <div class="container text-center text-white" data-aos="">
    <h2 class="mb-5 fw-bold" style="color: #f9a825;" data-aos="fade-up">Nuestros Servicios</h2>
    <div class="row g-4">
      
      <div class="col-md-4">
        <div class="card bg-dark border-0 h-100 shadow-sm">
          <img src="/barber/public/imagenes/corte de cabello.jpg" class="card-img-top" alt="Corte de Cabello" data-aos="fade-right">
          <div class="card-body" data-aos="fade-left">
            <h5 class="card-title fw-bold" style="color: #f9a825;">Corte de Cabello</h5>
            <p class="card-text text-white-50">Diseños personalizados para un estilo único y moderno.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card bg-dark border-0 h-100 shadow-sm">
          <img src="/barber/public/imagenes/afeitado.jpg" class="card-img-top" alt="Afeitado Clásico" data-aos="fade-right">
          <div class="card-body" data-aos="fade-left">
            <h5 class="card-title fw-bold" style="color: #f9a825;">Afeitado Clásico</h5>
            <p class="card-text text-white-50">Afeitado tradicional con navaja para una piel suave y perfecta.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card bg-dark border-0 h-100 shadow-sm">
          <img src="/barber/public/imagenes/barba.jpg" class="card-img-top" alt="Diseño de Barba" data-aos="fade-right">
          <div class="card-body" data-aos="fade-left">
            <h5 class="card-title fw-bold" style="color: #f9a825;">Diseño de Barba</h5>
            <p class="card-text text-white-50">Perfilados y arreglos que resaltan tu personalidad.</p>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>

<!-- Sección Servicios -->
<section id="servicios" class="py-5 bg-dark text-white">
  <div class="container">
    <h2 class="text-center mb-4 text-warning fw-bold" data-aos="fade-up"> Carta de Nuestros Servicios</h2>
    <p class="text-center mb-5">Explora nuestros servicios y descubre lo que tenemos preparado para ti.</p>

    <div class="accordion" id="accordionServicios">

      <!-- Servicio 1 -->
      <div class="accordion-item bg-black border-warning" data-aos="fade-left">
        <h2 class="accordion-header" id="headingCorte">
          <button class="accordion-button bg-black text-warning fw-bold collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCorte" aria-expanded="false" aria-controls="collapseCorte">
            Cortes de Cabello
            <span class="custom-arrow ms-auto">&#9662</span>
          </button>
        </h2>
        <div id="collapseCorte" class="accordion-collapse collapse" aria-labelledby="headingCorte" data-bs-parent="#accordionServicios">
          <div class="accordion-body text-white">
            <p> <strong class="text-warning">Corte Gold:</strong> $38.000 <strong class="text-warning">Duración:</strong>70min</p>
            <p>Lleva tu corte con mascarilla de carbon, lavado de cabello, peinado, fragancia y masaje en hombros.</p>
            <p><strong class="text-warning">Corte Platinum:</strong> $28.000  <strong class="text-warning">Duración:</strong>60min</p>
            <p>Lleva un corte con peinado y fragancia después de tu servicio.</p>
            <p><strong class="text-warning">Corte Black Label:</strong> $49.000 <strong class="text-warning">Duración</strong>80min</p>
            <p>Lleva tu corte, lavado,limpieza, exfoliante, mascarilla de carbón , mascarilla de colageno, hidratante, masaje en hombros, perfume y peinado.</p>
          </div>
        </div>
      </div>

      <!-- Servicio 2 -->
      <div class="accordion-item bg-black border-warning" data-aos="fade-right">
        <h2 class="accordion-header" id="headingBarba">
          <button class="accordion-button bg-black text-warning fw-bold collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBarba" aria-expanded="false" aria-controls="collapseBarba">
            Afeitado Clasico
             <span class="custom-arrow ms-auto">&#9662</span>
          </button>
        </h2>
        <div id="collapseBarba" class="accordion-collapse collapse" aria-labelledby="headingBarba" data-bs-parent="#accordionServicios">
          <div class="accordion-body text-white">
            <p><strong class="text-warning">Cejas:</strong> $10.000 <strong class="text-warning">Duración</strong>7min</p>
            <p>Si las agregas con tu servicio te quedan la perfilacion de cejas en 5.000</p>
            <p><strong class="text-warning">Barba Sola:</strong> $30.000 <strong class="text-warning">Duración</strong>35min</p>
            <p>Recorte de barba, marcación con navaja, aceite hidratante, mascarilla en zona nariz, fragancia después de tu servicio.</p>
            <p><strong class="text-warning">Shampoo:</strong>$6.000 <strong class="text-warning">Duración</strong>10min</p>
            <p>lavado sencillo y buen aroma</p>
          </div>
        </div>
      </div>

      <!-- Servicio 3 -->
      <div class="accordion-item bg-black border-warning" data-aos="fade-left">
        <h2 class="accordion-header" id="headingCombo">
          <button class="accordion-button bg-black text-warning fw-bold collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCombo" aria-expanded="false" aria-controls="collapseCombo">
            Diseño de Barba
             <span class="custom-arrow ms-auto">&#9662</span>
          </button>
        </h2>
        <div id="collapseCombo" class="accordion-collapse collapse" aria-labelledby="headingCombo" data-bs-parent="#accordionServicios">
          <div class="accordion-body text-white">
            <p><strong class="text-warning">Corte y Barba Platinum:</strong> $59.000 <strong class="text-warning">Duración</strong>80min</p>
            <p>Lleva tu corte sencillo, marcación de barba con navaja, aceite hidratante, peinado y fragancia después de tu servicio.</p>
            <p><strong class="text-warning">Corte y Barba Black Label:</strong> $69.000 <strong class="text-warning">Duración</strong>80min</p>
            <p>Corte,marcación de barba con navaja, aceite hidratante,lavado de cabello ,limpieza, exfoliante, mascarilla de carbón , mascarilla de colageno, hidratante, masaje en hombros, perfume y peinado.</p>
            <p><strong class="text-warning">Barba Sola:</strong>$30.000 <strong class="text-warning">Duración</strong>35min</p>
            <p>Recorte de barba, marcación con navaja, aceite hidratante, mascarilla en zona nariz, fragancia después de tu servicio</p>
          </div>
        </div>
      </div>
      <br>
          <h2 class="text-center mb-4 text-warning fw-bold" data-aos="fade-up" > Nuestras Promociones</h2>

  <div class="container">
  <div class="row justify-content-center g-4" id="contenedor-promociones">
    
    <div class="col-md-6 col-lg-5">
      <div class="card bg-black text-white border border-warning h-100">
        <div class="card-body text-center">
          <div class="display-4 mb-3 text-warning">💈</div>
          <h5 class="card-title">Corte + Barba</h5>
          <p class="card-text">20% de descuento los miércoles.</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-5">
      <div class="card bg-black text-white border border-warning h-100">
        <div class="card-body text-center">
          <div class="display-4 mb-3 text-warning">🎉</div>
          <h5 class="card-title">Cumpleañeros</h5>
          <p class="card-text">Corte gratis el día de tu cumpleaños.</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-5">
      <div class="card bg-black text-white border border-warning h-100">
        <div class="card-body text-center">
          <div class="display-4 mb-3 text-warning">👥</div>
          <h5 class="card-title">Referidos</h5>
          <p class="card-text">15% de descuento por cada amigo referido.</p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-5">
      <div class="card bg-black text-white border border-warning h-100">
        <div class="card-body text-center">
          <div class="display-4 mb-3 text-warning">💳</div>
          <h5 class="card-title">Tarjeta Fidelidad</h5>
          <p class="card-text">Cada 5 cortes, 1 gratis.</p>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Carrusel de Bootstrap -->
  <section id="equipo" class="py-5 bg-dark text-white"> 
    <div class="container"> 
      <h2 class="text-center mb-4 text-warning fw-bold" data-aos="fade-up">Nuestro Equipo</h2> 
<div id="styleCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner" data-aos="">

    <div class="carousel-item active position-relative">
      <img src="/barber/public/imagenes/barbero new.png" class="d-block w-100 carousel-img" alt="barbero 1">
      <div class="carousel-caption-custom">
        <h3>Carlos Perez</h3>
      </div>
    </div>

    <div class="carousel-item position-relative">
      <img src="/barber/public/imagenes/barbero new2.jpg" class="d-block w-100 carousel-img" alt="barbero 2">
      <div class="carousel-caption-custom">
        <h3>Andres Diaz</h3>
      </div>
    </div>

    <div class="carousel-item">
      <img src="/barber/public/imagenes/barbero new3.jpg" class="d-block w-100 carousel-img" alt="barbero 3">
      <div class="carousel-caption-custom">
        <h3>Jose Penagos</h3>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#styleCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#styleCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>
</div> 
</section>
<!--mapa-->
<section>
  <div class="container" id="Mapa">
      <h2 class="text-center mb-4 text-warning fw-bold" data-aos="fade-up">Nuestra Ubicacion</h2> 
<div id="map" style="height: 500px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.3); margin: 2rem 0;" data-aos="fade-up"></div>
  <div class="text-center" data-aos="fade-up">
      <a class="btn btn-warning btn-llegar" target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=4.7326,-74.0660">
        Cómo llegar
      </a>
    </div>
</div>
</section>
    </div>
  </div>
</section>

<footer style="
  background-image: url('/barber/public/imagenes/foter.jpg');
  background-size: cover;
  background-position: center;
  color: white;
  padding: 60px 20px;
  font-family: 'Segoe UI', sans-serif;
  position: relative;
  z-index: 1;
">
  <!-- Capa oscura encima de la imagen -->
  <div style="
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: -1;
  "></div>

  <div style="
    max-width: 1200px;
    margin: auto;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  ">
    <h2 style="margin: 0; font-size: 28px;" data-aos="fade-up">Style Barber</h2>
    <p style="margin: 0; font-size: 16px;" data-aos="fade-up">
     📍 Cra. 58d #146-51, Suba, Bogotá, Colombia <br>
     Tel: +57 314 284 37 36
    </p>

<!-- Redes sociales -->
<div style="margin-top: 10px; display: flex; gap: 20px;" data-aos="">
  <a href="#" title="Facebook" class="social-icon" data-aos="fade-left">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" width="26" alt="Facebook">
  </a>
  <a href="#" title="Instagram" class="social-icon" data-aos="fade-left">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" width="26" alt="Instagram">
  </a>
   <a href="#" title="Twitter" class="social-icon" data-aos="fade-left">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" width="26" alt="Twitter">
  </a>
  <a href="https://wa.me/573142843736" class="whatsapp-float" target="_blank" title="Escríbenos por WhatsApp" data-aos="fade-up">
  <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" width="40">
</a>
</div>
 <p style="margin-top: 20px; font-size: 14px; color: #ccc;">
      © 2025 Style Barber · Todos los derechos reservados
    </p>
  </div>
</footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
     <script src="/barber/public/js/homepage/index.js"></script>
</body>
</html>
