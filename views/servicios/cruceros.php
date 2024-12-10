<?php
  ob_start(); // Inicia el buffer de salida
  require_once '../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cruceros - Cotiza</title>
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
    <?php include '../views/header.php'?>

    <section id="carouselExample" class="carousel slide">
      <div class="carousel-overlay">
        <h1>Cruceros</h1>
        <p>Cotiza ya tu próximo viaje.</p>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php echo BASE_URL; ?>public/images/cruceros.jpg" class="d-block w-100 h-30 imagenCotizar" alt="..." />
        </div>
      </div>
    </section>

    <section class="mainContainer formsContainer">
      <div class="container py-3">
        <div class="bg-primary text-white p-3 mb-3">
          <h5 class="m-0">Rellena los detalles del viaje</h5>
        </div>

        <?php
          // Verificar si la cookie existe y mostrar el mensaje
          if (isset($_COOKIE['fecha_incorrecta_servicios'])) {
              echo "<p class='alert alert-danger'>" . $_COOKIE['fecha_incorrecta_servicios'] . "</p>";

              // Eliminar la cookie después de mostrar el mensaje
              setcookie('fecha_incorrecta_servicios', '', time() - 3600, '/'); // Eliminar la cookie inmediatamente
          }
        ?>

        <form method="POST" action="<?php echo BASE_URL; ?>viajes/reservar">
          
          <div class="row g-3 mb-3">
            <!-- Destino de Llegada -->
            <div class="col-md-4">
              <label for="destino_origen" class="form-label">¿Desde donde ir?</label>
              <input 
                type="text" 
                name="destino_origen" 
                id="destino_origen" 
                class="form-control" 
                required 
                maxlength="65" 
                placeholder="Ej. Bahamas, Caribe">
            </div>

            <!-- Destino Salida -->
            <div class="col-md-4">
              <label for="destino_final" class="form-label">¿A donde ir?</label>
              <input 
                type="text" 
                name="destino_final" 
                id="destino_final" 
                class="form-control" 
                required 
                maxlength="65" 
                placeholder="Ej. Colón, Panamá">
            </div>
            
            <!-- Personas -->
            <div class="col-md-4">
              <label for="personas" class="form-label">Personas</label>
              <input name="personas" type="number" id="personas" class="form-control" min="1" max="100" placeholder="Cantidad de personas" required/>
            </div>
          </div>
          
          <div class="row g-3 mb-3">
            <!-- Fecha inicial -->
            <div class="col-md-4">
              <label for="fecha_inicio" class="form-label">Fecha Inicial</label>
              <input name="fecha_inicio" type="date" id="fecha_inicio" class="form-control" required/>
            </div>
            <!-- Fecha final -->
            <div class="col-md-4">
              <label for="fecha_final" class="form-label">Fecha Final</label>
              <input name="fecha_final" type="date" id="fecha_final" class="form-control" required/>
            </div>

            <!-- Visa -->
            <div class="col-md-4">
              <label class="form-label text-center d-block">Visa</label>
              <div class="d-flex align-items-center justify-content-center align-bottom">
                <div class="form-check me-3">
                  <input class="form-check-input" type="radio" id="visa-requerida" name="visa" value=1 required/>
                  <label class="form-check-label" for="visa-requerida">Requerida</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="visa-no-requerida" name="visa" value=0 required/>
                  <label class="form-check-label" for="visa-no-requerida">No Requerida</label>
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" name="servicio" value="cruceros" />
          
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-5 fw-bold text-primary"></span>
            <div>
              <button type="submit" class="btn btn-success me-2">Reservar</button>
              <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
            </div>
          </div>
        </form>
      </div>
    </section>

    <section class="mainContainer">
        <h2 class="mainContainer--title">¿Sin ideas a donde ir?</h2>
        <h3 class="mainContainer--subtitle pb-5">Te recomendamos viajes en Cruceros</h3>

        <?php if (!empty($paquetes)): ?>
        <div class="row">
            <?php 
            $count = 0; 
            foreach ($paquetes as $paquete): 
                // Calcular la duración entre las fechas
                $fechaInicio = new DateTime($paquete['Fecha_inicio']);
                $fechaFinal = new DateTime($paquete['Fecha_final']);
                $duracion = $fechaInicio->diff($fechaFinal)->days; // Diferencia en días
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                    <?php if (!empty($paquete['Foto'])): ?>
                        <img src="<?php echo BASE_URL; ?>controllers/ImagenController.php?id=<?= $paquete['id_paquete'] ?>" alt="Imagen del Paquete" class="card-img-top">
                    <?php else: ?>
                        <img src="<?php echo BASE_URL; ?>public/images/paquete-bro.jpg" alt="Imagen Predeterminada" class="card-img-top">
                    <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $paquete['Nombre']; ?></h5>
                            <p class="card-text"><?php echo $paquete['Descripcion']; ?></p>
                            <p class="card-text">
                                <strong>Destino:</strong> <?php echo $paquete['Destino']; ?><br>
                                <strong>Precio:</strong> $<?php echo number_format($paquete['Precio'], 2); ?><br>
                                <strong>Duración:</strong> <?php echo $duracion; ?> días<br>
                                <!-- <strong>Fechas:</strong> <?php echo $paquete['Fecha_inicio']; ?> - <?php echo $paquete['Fecha_final']; ?> -->
                                <strong>Servicio: <?php echo $paquete['servicio'];; ?></strong>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>paquetes/verPaquete/<?php echo $paquete['id_paquete']; ?>"><button type="button" class="btn btn-success">Ver itinerario</button></a>
                        </div>
                    </div>
                </div>

                <?php 
                $count++;
                // Cierra la fila actual y abre una nueva después de 3 tarjetas
                if ($count % 3 == 0): 
                ?>
              </div><div class="row">
                <?php endif; ?>
            <?php endforeach; ?>
          </div>
      <?php else: ?>
          <p>No hay paquetes registrados.</p>
      <?php endif; ?>

      </section>


    <?php include '../views/footer.php'?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<?php
  ob_end_flush(); // Envía la salida acumulada
?>