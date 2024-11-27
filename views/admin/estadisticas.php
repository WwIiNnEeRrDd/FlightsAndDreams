<?php 
  require_once __DIR__ . '/../../config/config.php';
  require_once(__DIR__ . '/../../models/Paquete.php');
  require_once(__DIR__ . '/../../models/Viajes.php');
  require_once(__DIR__ . '/../../models/Admin.php');

  // Comprobar si la sesión ya está iniciada
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  verificarSesionAdmin();

  $paqueteModel = new Paquete();
  $viajesModel = new Viajes();
  $adminModel = new Admin();

  $totalViajes = $viajesModel->contarViajes();
  $viajesPorEstado = $viajesModel->contarViajesPorEstado();
  $paqueteMasVendido = $paqueteModel->getPaqueteMasVendido();
  $nacionalidad = $adminModel->getNacionalidadMasRepetida();
  $servicio = $adminModel->getServicioMasReservado();
  $visa = $adminModel->getPersonasPorVisa();
  $destinoMasReservado = $adminModel->destinoFinalMasReservado();
  $autobusMasReservado = $adminModel->tipoAutobusMasReservado();
  $habitacionMasReservada = $adminModel->tipoHabitacionMasReservado();
  $vueloMasReservado = $adminModel->claseVueloMasReservado();
  $trenMasReservado = $adminModel->claseTrenMasReservado();
  $fechaRegistroMasVentas = $adminModel->fechaRegistroMasVentas();
  $fechaSalidaMasReservada = $adminModel->fechaSalidaMasReservada();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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
  <body class="gridContainer">
    <?php include '../../views/aside-admin.php'?>

    <main class="mainContent">
      <div class="container-fluid">
        <!-- Resumen de estadísticas -->
        <h1 class="m-5 text-center">Estadísticas actuales</h1>
        <div class="dashboardStats">
            <div class="col-2">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-1">Facebook</h6>
                        <h5 class="fw-bold m-0">+2</h5>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-1">Instagram</h6>
                        <h5 class="text-success fw-bold m-0">+11</h5>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-1">Pinterest</h6>
                        <h5 class="text-danger fw-bold m-0">+78</h5>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-1">Twitter</h6>
                        <h5 class="text-success fw-bold m-0">+1</h5>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-1">YouTube</h6>
                        <h5 class="text-danger fw-bold m-0">+7</h5>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted mb-1">Sitio Web</h6>
                        <h5 class="text-danger fw-bold m-0">+459</h5>
                    </div>
                </div>
            </div>
        </div>
        <section class="mainContainerAdmin paddingContentAdmin">
          <div class="container my-5">
            <div class="row g-4">
                <!-- Total de Reservas -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total de Reservas</h5>
                            <p class="card-text fs-5"><?php echo htmlspecialchars($totalViajes); ?> reservas</p>
                        </div>
                    </div>
                </div>

                <!-- Reservas por Estado -->
                <div class="col-md-4">
                    <div class="card text-white bg-secondary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Reservas por Estado</h5>
                            <?php foreach ($viajesPorEstado as $viaje): ?>
                                <div class="mb-3">
                                    <h6 class="fw-bold"><?php echo htmlspecialchars($viaje['estado']); ?></h6>
                                    <p class="fs-5"><?php echo htmlspecialchars($viaje['total_estado']); ?> reservas</p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>


                <!-- Paquete Más Vendido -->
                <div class="col-md-4">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body">
                            <h3 class="card-title">Paquete Más Vendido</h3>
                            <p class="card-text fs-5">
                            <?php 
                                echo !empty($paqueteMasVendido) 
                                    ? $paqueteMasVendido["Nombre"] . " con " . $paqueteMasVendido["total_vendidos"] . " ventas."
                                    : "No hay paquetes"; // En caso de que el array esté vacío
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Nacionalidad Más Repetida -->
                <div class="col-md-4">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body">
                            <h3 class="card-title">Nacionalidad Más Repetida</h3>
                            <p class="card-text fs-5"><?php echo $nacionalidad['Nacionalidad'];?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Servicio Más Reservado -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Servicio Más Reservado</h3>
                            <p class="card-text fs-5"><?php echo $servicio['servicio'] . " con " . $servicio['cantidad'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Visa -->
                <div class="col-md-4">
                    <div class="card text-white bg-secondary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Visas Requeridas</h3>
                            <?php if ($visa): ?>
                                <?php foreach ($visa as $row): ?>
                                    <p class="card-text fs-5">Visa <?php echo ($row['visa'] == 1) ? 'Sí' : 'No'; ?>: <strong><?php echo $row['total_personas']; ?></strong> personas</p>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No se encontraron resultados.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Destino mas reservado -->
                <div class="col-md-4">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body">
                            <h3 class="card-title">Destino Más Reservado</h3>
                            <p class="card-text fs-5"><?php echo $destinoMasReservado['destino_origen'] . " con " . $destinoMasReservado['reservas'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Autobus Más Reservado -->
                <div class="col-md-4">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body">
                            <h3 class="card-title">Autobus Más Reservado </h3>
                            <p class="card-text fs-5"><?php echo $autobusMasReservado['tipo_autobus'] . " con " . $autobusMasReservado['reservas'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Habitacion Más Reservada -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Habitacion Más Reservada</h3>
                            <p class="card-text fs-5"><?php echo $habitacionMasReservada['tipo_habitacion'] . " con " . $habitacionMasReservada['reservas'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Vuelo Más Reservado -->
                <div class="col-md-4">
                    <div class="card text-white bg-secondary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Tipo de Vuelo Más Reservado</h3>
                            <p class="card-text fs-5"><?php echo $vueloMasReservado['clase_vuelo'] . " con " . $vueloMasReservado['reservas'] . " reservas"; ?></p></p>
                        </div>
                    </div>
                </div>
                <!-- Tren Más Reservado -->
                <div class="col-md-4">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body">
                            <h3 class="card-title">Tipo de Tren Más Reservado</h3>
                            <p class="card-text fs-5"><?php echo $trenMasReservado['clase_tren'] . " con " . $trenMasReservado['reservas'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Fecha con mas ventas -->
                <div class="col-md-4">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body">
                            <h3 class="card-title">Fecha Con Más Ventas</h3>
                            <p class="card-text fs-5"><?php echo $fechaRegistroMasVentas['fecha_registro'] . " con " . $fechaRegistroMasVentas['ventas'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Fecha de salida -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body">
                            <h3 class="card-title">Mayor Fecha de salidas</h3>
                            <p class="card-text fs-5"><?php echo $fechaSalidaMasReservada['fecha_inicio'] . " con " . $fechaSalidaMasReservada['reservas'] . " reservas"; ?></p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
