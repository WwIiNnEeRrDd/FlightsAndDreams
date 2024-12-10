<?php
require_once __DIR__ . '/../config/config.php';
if (session_status() === PHP_SESSION_NONE) {

  session_start();
}


?>

<section class="infoBar">
  <div class="infoBar--box">
    <a href="https://www.instagram.com/fligthdreams" target="_blank">
      <i class="fa-brands fa-instagram fa-lg"></i>
      <p class="infoBar--text">@fligthdreams</p>
    </a>
  </div>
  <div class="infoBar--box">
    <a href="tel:+34688776577">
      <i class="fa-solid fa-phone"></i>
      <p class="infoBar--text">+(34) 688-77-65-77</p>
    </a>
  </div>
  <div class="infoBar--box">
    <a href="https://wa.link/roec0j" target="_blank">
      <i class="fa-brands fa-whatsapp"></i>
      <p class="infoBar--text">+(34) 688-77-65-77</p>
    </a>
  </div>
  <div class="infoBar--box">
    <a href="https://www.google.com/maps/search/?api=1&query=Calle+Garibay+4,+Donostia+Guipúzcoa+20004" target="_blank">
      <i class="fa-solid fa-location-dot"></i>
      <p class="infoBar--text">Calle Garibay,4,1ra Dr- Dr, Donostia, Guipúzcoa,20004</p>
    </a>
  </div>
</section>


<header class="header">
  <div>
    <div class="header--logo">
      <a href="<?php echo BASE_URL; ?>inicio">
        <img src="<?php echo BASE_URL; ?>public/images/flight-dreams-logo-traz-cut.png" alt="flightDreams" />
      </a>
    </div>
  </div>

  <div class="header">
    <a href="<?php echo BASE_URL; ?>inicio" class="header--link d-flex column gap-2">
      <i class="fa-solid fa-house"></i>
      <p>Inicio</p>
    </a>

    <div class="dropdown p-4 header--link">
      <i class="fa-solid fa-bus"></i>
      <a class="dropdown-toggle text-decoration-none text-body-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>paquetes/listarPorServicio/autobuses">Autobuses</a></li>
        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>paquetes/listarPorServicio/cruceros">Crucero</a></li>
        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>paquetes/listarPorServicio/trenes">Trenes</a></li>
        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>paquetes/listarPorServicio/vuelos">Vuelos</a></li>
        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>paquetes/listarPorServicio/hoteles">Hoteles</a></li>
      </ul>
    </div>

    <a href="<?php echo BASE_URL; ?>paquetes/listar" class="header--link">
      <i class="fa-solid fa-box"></i>  
      <p>Paquetes</p>
    </a>
    <?php if (isset($_SESSION['usuario'])): ?>
      <a href="<?php echo BASE_URL; ?>viajes/verReservas" class="header--link">
        <i class="fa-solid fa-eye"></i>
        <p>Reservas</p>
      </a>
    <?php endif; ?>
    <a href="<?php echo BASE_URL; ?>sobrenosotros" class="header--link">
      <i class="fa-solid fa-user-secret"></i>
      <p>Sobre Nosotros</p>
    </a>
  </div>

  <div class="d-flex justify-content-end align-items-center gap-3">
    <?php if (isset($_SESSION['usuario'])): ?>
        <!-- Mostrar icono de usuario si el usuario está logueado -->
        <a href="<?php echo BASE_URL; ?>usuario/mostrarFormularioActualizar" class="header--link text-decoration-none">
            <i class="fa-solid fa-user fa-lg"></i> Perfil
        </a>
        <a href="<?php echo BASE_URL; ?>usuario/logout" class="header--link text-danger text-decoration-none">
            <i class="fa-solid fa-right-from-bracket fa-lg"></i> Cerrar sesión
        </a>
      <?php else: ?>
          <!-- Mostrar botón de Login si el usuario no está logueado -->
          <a href="<?php echo BASE_URL; ?>login">
              <button type="button" class="btn btn-success">Login</button>
          </a>
      <?php endif; ?>
  </div>
</header>
