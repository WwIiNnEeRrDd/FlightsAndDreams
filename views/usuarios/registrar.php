<?php
  require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrarse</title>
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
  <body class="login-body">
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <!-- <img src="https://t3.ftcdn.net/jpg/05/27/24/36/360_F_527243669_mhBh7M6Xb9hxg0y2Ug87XfQrlX20suMU.jpg" class="img-fluid" alt="Sample image" /> -->
            <img class="img-fluid" src="<?php echo BASE_URL; ?>public/images/Flight-&-Dreams-LOGO-Traz.png" alt="" />
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="POST" action="<?php echo BASE_URL; ?>usuario/registrar">
              <div>
                <i class="fa-solid fa-circle-user fa-2x row d-flex justify-content-center align-items-center"></i>
                <h1 class="row d-flex justify-content-center align-items-center p-1">Registrarse</h1>
                <hr class="" />
              </div>

              <p class="row d-flex justify-content-center h5 pb-3 fw-light">Llena los campos</p>

              <div name="nombre_apellido" class="d-flex justify-content-between gap-2">
                <!-- Nombre -->
                <div data-mdb-input-init class="form-outline mb-2">
                  <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" placeholder="Nombre" required />
                </div>

                <!-- Apellido -->
                <div data-mdb-input-init class="form-outline mb-2">
                  <input type="text" id="apellido" name="apellido" class="form-control form-control-lg" placeholder="Apellido" required />
                </div>
              </div>

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="email" id="correo" name="correo" class="form-control form-control-lg" placeholder="Correo electrónico" required />
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="password" id="contrasena" name="contrasena" class="form-control form-control-lg" placeholder="Contraseña" required />
              </div>

              <!-- Nacionalidad -->
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="text" id="nacionalidad" name="nacionalidad" class="form-control form-control-lg" placeholder="Nacionalidad" required />
              </div>

              <!-- Residencia -->
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="text" id="residencia" name="residencia" class="form-control form-control-lg" placeholder="Lugar de residencia" required />
              </div>

              <!-- Teléfono -->
              <div data-mdb-input-init class="form-outline mb-2">
                <input type="tel" id="telefono" name="telefono" class="form-control form-control-lg" placeholder="Número de teléfono" required />
              </div>

              <!-- Botón y enlace -->
              <div class="text-center text-lg-start mt-4 pt-2">
                
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem">Registrarme</button>

                <p class="small fw-bold mt-2 pt-1 mb-0">¿Ya tienes una cuenta? <a href="login" class="link-danger">Inicia sesión</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <a href="<?php echo BASE_URL; ?>inicio">
          <button type="submit" class="button"> <i class="fa-solid fa-arrow-left pe-3"></i> Volver atrás</button>
        </a>  
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
