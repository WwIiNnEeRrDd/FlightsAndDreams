<?php
  require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sobre nosotros</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Iconos: Font-Awesome -->
    <script src="https://kit.fontawesome.com/5ddbd215bf.js" crossorigin="anonymous"></script>
    <!-- Favicon -->
  <link rel="icon" href="<?php echo BASE_URL; ?>public/images/flightdreams-logo-clean.png" type="image/x-icon">
  </head>
  <body>
    <?php include '../header.php'; ?>

    <!-- Sección principal -->
    <section class="hero-section">
      <h1 class="hero-section--text">Sobre Nosotros</h1>
      <p class="hero-section--text">Conoce nuestra historia, misión y valores. Estamos aquí para hacer tus sueños realidad.</p>
    </section>

    <!-- Sección de contenido -->
    <section class="about-content container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo BASE_URL; ?>public/images/sobre-nosotros.jpeg" alt="Nuestra Historia" class="img-fluid rounded" />
        </div>
        <div class="col-md-6">
          <h2 class="mb-4">Nuestra Historia</h2>
          <p>Desde nuestros inicios, hemos trabajado incansablemente para ofrecer experiencias únicas e inolvidables. Nuestro compromiso con la calidad y la satisfacción de nuestros clientes nos ha permitido crecer y convertirnos en una agencia de confianza.</p>
          <p>Con una visión centrada en la innovación y la excelencia, seguimos explorando nuevas formas de ayudarte a descubrir el mundo.</p>
          <p>Buscamos siempre proveer servicios de calidad, rápida atención al cliente y sobretodo la comodidad de los mismos.</p>
        </div>
      </div>
    </section>

    <!-- Sección de equipo -->
    <section class="team-section">
      <h2>Conoce a nuestro equipo</h2>
      <div class="container">
        <div class="row g-4 mb-3">
          <div class="col-md-4">
            <div class="card team-card text-center p-3">
              <img src="<?php echo BASE_URL; ?>public/images/richard.jpg" alt="Integrante" class="mx-auto" />
              <h5>Richard Herranz</h5>
              <p class="text-muted">Desarrollador Full Stack</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card team-card text-center p-3">
              <img src="<?php echo BASE_URL; ?>public/images/jose.png" alt="Integrante" class="mx-auto" />
              <h5>José Encalada</h5>
              <p class="text-muted">Desarrollador Full Stack</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card team-card text-center p-3">
              <img src="<?php echo BASE_URL; ?>public/images/miguel.jpg" alt="Integrante" class="mx-auto" />
              <h5>Miguel Ortega</h5>
              <p class="text-muted">Gerente DevOps</p>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-md-4">
            <div class="card team-card text-center p-3">
              <img src="<?php echo BASE_URL; ?>public/images/jahir.jpg" alt="Integrante" class="mx-auto" />
              <h5>Jonathan Nuñez</h5>
              <p class="text-muted">Analista de Negocios</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card team-card text-center p-3">
              <img src="<?php echo BASE_URL; ?>public/images/cineyris.jpg" alt="Integrante" class="mx-auto" />
              <h5>Cineyris Chavarria</h5>
              <p class="text-muted">Desarrolladora y Diseñadora</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card team-card text-center p-3">
              <img src="<?php echo BASE_URL; ?>public/images/stefany.jpg" alt="Integrante" class="mx-auto" />
              <h5>Stefany Gonzalez</h5>
              <p class="text-muted">Desarrolladora y Diseñadora</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include '../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
