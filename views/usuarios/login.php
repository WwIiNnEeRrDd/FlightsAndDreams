<?php
  require_once '../../config/config.php';
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar sesión</title>
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
            <img class="img-fluid" src="<?php echo BASE_URL; ?>public/images/Flight-&-Dreams-LOGO-Traz.png" alt="" />
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <!-- Formulario -->
            <?php
              if (isset($_COOKIE['error_login'])) {
                  echo '<div class="alert alert-danger">' . $_COOKIE['error_login'] . '</div>';

                  // Borra la cookie después de mostrar el mensaje
                  setcookie('error_login', '', time() - 3600, '/'); // Establece el tiempo de expiración en el pasado
              }
            ?>

            <form id="loginForm" method="POST" action="<?php echo BASE_URL; ?>usuario/loginUsuario">
              <div>
                <i class="fa-solid fa-user fa-2x row d-flex justify-content-center align-items-center"></i>
                <h1 class="row d-flex justify-content-center align-items-center p-3">Inicia sesión</h1>
                <hr class="p-3" />
              </div>

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-2 position-relative">
                <input type="email" id="email" name="correo" class="form-control form-control-lg" placeholder="Ingresa un correo electrónico válido" />
                <label class="form-label pt-1" for="email">Correo electrónico</label>
                <small id="emailError" class="text-danger d-none error-message">Por favor, ingresa un correo válido.</small>
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-2 position-relative">
                <input type="password" id="password" name="contrasena" class="form-control form-control-lg" placeholder="Introduce la contraseña" />
                <label class="form-label pt-1" for="password">Contraseña</label>
                <small id="passwordError" class="text-danger d-none error-message">Por favor, completa este campo.</small>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0"></div>
                <a href="<?php echo BASE_URL; ?>login-admin" class="text-body">Iniciar sesión como admin</a>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" id="loginButton" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem">
                  Iniciar sesión
                </button>
                <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes una cuenta? <a href="<?php echo BASE_URL; ?>registrar" class="link-danger">Registrate</a></p>
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