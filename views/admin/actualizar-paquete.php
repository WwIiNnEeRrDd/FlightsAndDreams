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
  <title>Actualizar Paquete</title>
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
          <div class="">

          <?php
            // Verificar si la cookie existe y mostrar el mensaje
            if (isset($_COOKIE['fecha_incorrecta_paquetes'])) {
                echo "<p class='alert alert-danger'>" . $_COOKIE['fecha_incorrecta_paquetes'] . "</p>";

                // Eliminar la cookie después de mostrar el mensaje
                setcookie('fecha_incorrecta_paquetes', '', time() - 3600, '/'); // Eliminar la cookie inmediatamente
            }
          ?>

            <form action="<?php echo BASE_URL . 'paquetes/actualizarPaquete/' . $paquete['id_paquete']; ?>" method="POST" class="d-inline"  enctype="multipart/form-data">


              <div>
                <i class="fa-solid fa-box fa-2x row d-flex justify-content-center align-items-center"></i>
                <h1 class="row d-flex justify-content-center align-items-center p-1">Actualizar Paquete</h1>
                <hr class="" />
              </div>

              <p class="row d-flex justify-content-center h5 pb-3 fw-light">Llena los campos</p>

              <!-- Nombre -->
                <div data-mdb-input-init class="form-outline mb-2">
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form-control form-control-lg" 
                    placeholder="Nombre del paquete" 
                    required 
                    value="<?php echo htmlspecialchars($paquete['Nombre']); ?>"
                />
                </div>

                <!-- Descripción -->
                <div data-mdb-input-init class="form-outline mb-2">
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    class="form-control form-control-lg" 
                    placeholder="Descripción del paquete" 
                    rows="3"
                    required
                ><?php echo htmlspecialchars($paquete['Descripcion']); ?></textarea>
                </div>

                <!-- Destino -->
                <div data-mdb-input-init class="form-outline mb-2">
                <input 
                    type="text" 
                    id="destino" 
                    name="destino" 
                    class="form-control form-control-lg" 
                    placeholder="Destino del paquete" 
                    required 
                    value="<?php echo htmlspecialchars($paquete['Destino']); ?>"
                />
                </div>

                <!-- Precio -->
                <div data-mdb-input-init class="form-outline mb-2">
                <input 
                    type="number" 
                    step="0.01" 
                    id="precio" 
                    name="precio" 
                    class="form-control form-control-lg" 
                    placeholder="Precio del paquete" 
                    required 
                    value="<?php echo htmlspecialchars($paquete['Precio']); ?>"
                />
                </div>

              <!-- Foto -->
              <div class="mb-2">
                <label for="foto" class="form-label">Sube una imagen del paquete (.jpg, .png, .webp)</label>
                <input 
                  type="file" 
                  id="foto" 
                  name="foto" 
                  class="form-control form-control-lg" 
                  accept=".jpg,.jpeg,.png,.webp" 
                />
              </div>

                <!-- Fechas -->
                <div class="row g-2 mb-2">
                <div class="col-md-6">
                    <label for="fecha_inicio" class="form-label">Fecha inicial</label>
                    <input 
                    type="date" 
                    id="fecha_inicio" 
                    name="fecha_inicio" 
                    class="form-control form-control-lg" 
                    required 
                    value="<?php echo htmlspecialchars($paquete['Fecha_inicio']); ?>"
                    />
                </div>
                <div class="col-md-6">
                    <label for="fecha_final" class="form-label">Fecha final</label>
                    <input 
                    type="date" 
                    id="fecha_final" 
                    name="fecha_final" 
                    class="form-control form-control-lg" 
                    required 
                    value="<?php echo htmlspecialchars($paquete['Fecha_final']); ?>"
                    />
                </div>
                </div>

                <!-- Servicio -->
                <div class="form-outline mb-2">
                <select 
                    id="servicio" 
                    name="servicio" 
                    class="form-select form-select-lg" 
                    required
                >
                    <option value="autobuses" <?php echo $paquete['servicio'] === 'autobuses' ? 'selected' : ''; ?>>Autobuses</option>
                    <option value="hoteles" <?php echo $paquete['servicio'] === 'hoteles' ? 'selected' : ''; ?>>Hoteles</option>
                    <option value="cruceros" <?php echo $paquete['servicio'] === 'cruceros' ? 'selected' : ''; ?>>Cruceros</option>
                    <option value="trenes" <?php echo $paquete['servicio'] === 'trenes' ? 'selected' : ''; ?>>Trenes</option>
                    <option value="vuelos" <?php echo $paquete['servicio'] === 'vuelos' ? 'selected' : ''; ?>>Vuelos</option>
                </select>
                </div>

                <!-- Itinerario -->
                <div data-mdb-input-init class="form-outline mb-2">
                <textarea 
                    id="itinerario" 
                    name="itinerario" 
                    class="form-control form-control-lg" 
                    placeholder="Itinerario del paquete" 
                    rows="3"
                    required
                ><?php echo htmlspecialchars($paquete['itinerario']); ?></textarea>
                </div>

              <!-- Botón -->
              <div class="text-center text-lg-start mt-4 pt-2">
                <button 
                  type="submit" 
                  data-mdb-button-init 
                  data-mdb-ripple-init 
                  class="btn btn-primary btn-lg" 
                  style="padding-left: 2.5rem; padding-right: 2.5rem"
                >
                  Actualizar Paquete
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>