<?php
  require_once '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Descripción del Paquete</title>
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
    <?php include '../views/header.php'; ?>

    <main class="container d-flex align-items-center justify-content-center pt-5 pb-5">
      <div class="row w-100 align-items-center">
        <form class="d-flex w-100" method="POST" action="<?php echo BASE_URL; ?>viajes/reservar">
          <?php if (!empty($paquete['Foto'])): ?>
            <div class="col-md-5">
              <img class="img-fluid rounded" src="<?php echo BASE_URL; ?>controllers/ImagenController.php?id=<?= $paquete['id_paquete'] ?>" alt="Imagen del Paquete">
            </div>
          <?php else: ?>
            <div class="col-md-5">
              <img src="<?php echo BASE_URL; ?>public/images/paquete-bro.jpg" alt="Imagen Predeterminada" class="card-img-top">
            </div>
          <?php endif; ?>

          <div class="col-md-7 ps-md-5">
            <p class="h2"><?php echo $paquete['Nombre']; ?></p>
            <p class="h6"><?php echo $paquete['Descripcion']; ?></p>
            <p>Destino: <?php echo $paquete['Destino']; ?></p>
            <p>Precio: €<?php echo $paquete['Precio']; ?></p>
            <p>Fecha de Inicio: <?php echo $paquete['Fecha_inicio']; ?></p>
            <p>Fecha Final: <?php echo $paquete['Fecha_final']; ?></p>

            <p class="fw-bold">Itinerario:</p>
            <p><?php echo $paquete['itinerario']; ?></p>

            <div class="pt-3">
              <button type="submit" class="button">Reservar</button>
            </div>
          </div>

          <input type="hidden" name="id_paquete" value="<?= $paquete['id_paquete'] ?>">
          <input type="hidden" name="destino_final" value="<?= $paquete['Destino'] ?>">
          <input type="hidden" name="fecha_inicio" value="<?= $paquete['Fecha_inicio'] ?>">
          <input type="hidden" name="fecha_final" value="<?= $paquete['Fecha_final'] ?? '' ?>">
          <input type="hidden" name="servicio" value="<?= $paquete['servicio'] ?? '' ?>">
        </form>
      </div>
    </main>



    <?php include '../views/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
