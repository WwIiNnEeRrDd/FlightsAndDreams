<?php
  require_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Paquetes</title>
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

  <main class="mainContainer">
    <h2 class="mainContainer--title">Lista de Paquetes</h2>

    <div class="container p-5">

    <!-- Filtro de estado -->
    <div class="d-flex justify-content-start mb-3">
        <a href="<?php echo BASE_URL; ?>paquetes/listar" class="btn btn-primary me-2">Ver Todas</a>
        <a href="<?php echo BASE_URL; ?>paquetes/listarPorServicioPaquetes/autobuses" class="btn btn-warning me-2">Autobuses</a>
        <a href="<?php echo BASE_URL; ?>paquetes/listarPorServicioPaquetes/hoteles" class="btn btn-success me-2">Hoteles</a>
        <a href="<?php echo BASE_URL; ?>paquetes/listarPorServicioPaquetes/cruceros" class="btn btn-primary me-2">Cruceros</a>
        <a href="<?php echo BASE_URL; ?>paquetes/listarPorServicioPaquetes/trenes" class="btn btn-warning me-2">Trenes</a>
        <a href="<?php echo BASE_URL; ?>paquetes/listarPorServicioPaquetes/vuelos" class="btn btn-success me-2">Vuelos</a>

    </div>
    
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
                                <strong>Servicio: <?php echo $paquete['servicio']; ?></strong>
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
  </div>

  </main>

  <?php include '../views/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
