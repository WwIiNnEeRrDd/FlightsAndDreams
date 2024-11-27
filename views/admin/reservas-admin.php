<?php 
  require_once __DIR__ . '/../../config/config.php';
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  verificarSesionAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Reservas</title>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Iconos: Font-Awesome -->
  <script src="https://kit.fontawesome.com/5ddbd215bf.js" crossorigin="anonymous"></script>
  <!-- Favicon -->
  <link rel="icon" href="<?php echo BASE_URL; ?>public/images/flightdreams-logo-clean.png" type="image/x-icon">
</head>

<body class="gridContainer">
  <?php include '../views/aside-admin.php'?>

  <main class="mainContent">
    <div class="container-fluid">
      <section class="mainContainerAdmin">
        <div class="paddingContentAdmin">
          <div class="bg-primary text-white p-3 mb-3">
            <h5 class="m-0">Historial de Reservas</h5>
          </div>
            <div class="row gx-0 justify-content-center align-items-center">
              <div class="col-12">

                <!-- Filtro de estado -->
                <div class="d-flex justify-content-start mb-3">
                    <a href="<?php echo BASE_URL; ?>admin/verReservasAdmin" class="btn btn-primary me-2">Ver Todas</a>
                    <a href="<?php echo BASE_URL; ?>admin/verReservasAdmin/pendiente" class="btn btn-warning me-2">Pendientes</a>
                    <a href="<?php echo BASE_URL; ?>admin/verReservasAdmin/confirmado" class="btn btn-success me-2">Confirmadas</a>
                    <a href="<?php echo BASE_URL; ?>admin/verReservasAdmin/cancelado" class="btn btn-secondary">Canceladas</a>
                </div>
                <div class="card mt-5">
                  <div class="card-body">
                    <?php if (!empty($reservas)): ?>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Nombre de Usuario</th>
                              <th class="text-center">Correo</th>
                              <th class="text-center">Teléfono</th>
                              <th class="text-center">Paquete</th>
                              <th class="text-center">Servicio</th>
                              <th class="text-center">Destino</th>
                              <th class="text-center">Personas</th>
                              <th class="text-center">Fecha Inicio</th>
                              <th class="text-center">Estado</th>
                              <th class="text-center">Visa</th>
                              <th class="text-center">Estados</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($reservas as $index => $reserva): ?>
                              <tr>
                                <td class="text-center"><?php echo $index + 1; ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['nombre_usuario']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['Correo']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['Telefono']); ?></td>
                                <td class="text-center"><?php echo !empty($reserva['nombre_paquete']) ? htmlspecialchars($reserva['nombre_paquete']) : 'Formulario'; ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['servicio']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['destino_final']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['personas'] ?? 'Paquete'); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reserva['fecha_inicio']); ?></td>
                                <td class="text-center">
                                  <span class="badge bg-<?php echo $reserva['estado'] == 'confirmado' ? 'success' : ($reserva['estado'] == 'pendiente' ? 'warning' : 'secondary'); ?>">
                                    <?php echo htmlspecialchars($reserva['estado']); ?>
                                  </span>
                                </td>
                                <td class="text-center"><?php echo $reserva['visa'] === 0 ? 'no' : ($reserva['visa'] === 1 ? 'sí' : 'no'); ?></td>
                                <td class="text-center">
                                    <form action="<?php echo BASE_URL; ?>admin/actualizarEstado" method="POST" class="d-inline">
                                        <select name="estado" id="estado" class="form-select form-select-sm d-inline w-auto">
                                            <option value="cancelado" <?= $reserva['estado'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                            <option value="confirmado" <?= $reserva['estado'] == 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                                            <option value="pendiente" <?= $reserva['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        </select>
                                        <input type="hidden" name="id_viajes" value="<?= $reserva['id_viajes'] ?>">
                                        <button type="submit" class="btn btn-primary btn-sm mt-1">Actualizar</button>
                                    </form>
                                </td>

                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <p class="text-center">No tienes reservas registradas.</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>
    </div>
  </main>

</body>

</html>