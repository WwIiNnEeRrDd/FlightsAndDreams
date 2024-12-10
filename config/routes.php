<?php
// Incluye los controladores
require_once '../controllers/UsuarioController.php';
require_once '../controllers/PaqueteController.php';
require_once '../controllers/ViajesController.php';
require_once '../controllers/AdminController.php';


// Obtén la URL amigable
$request_uri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

$index = 0;

// Define controlador, acción y parámetros adicionales
$controller = $request_uri[$index] ?? null;
$action = $request_uri[$index + 1] ?? null;

$estados = ['pendiente', 'confirmado', 'cancelado'];

// Verificar si el tercer parámetro es un servicio o un id_paquete
$third_param = $request_uri[$index + 2] ?? null;
$id_paquete = is_numeric($third_param) ? $third_param : null;
$servicio = !$id_paquete && !in_array($third_param, $estados) ? $third_param : null;
$estado = !$servicio && in_array($third_param, $estados) ? $third_param : null;





// Redirige a los métodos correspondientes en el controlador
if ($controller == 'usuario') {
    $usuarioController = new UsuarioController();

    if ($action == 'registrar') {
        $usuarioController->registrar();
    } elseif ($action == 'loginUsuario') {
        $usuarioController->loginUsuario();
    } elseif ($action == 'loginAdministrador') {
        $usuarioController->loginAdministrador();
    } elseif ($action == 'logout') {
        $usuarioController->logout();
    } elseif ($action == 'actualizarUsuario') {
        $usuarioController->actualizarUsuario();
    } elseif ($action == 'mostrarFormularioActualizar') {
        $usuarioController->mostrarFormularioActualizar();
    }
} elseif ($controller == 'paquetes') {
    $paqueteController = new PaqueteController();

    if ($action == 'listarPorServicioPaquetes') {
        $paqueteController->listarPorServicioPaquetes($servicio);
    } elseif ($action == 'registrar') {
        $paqueteController->registrar();
    } elseif ($id_paquete && $action == 'verPaquete') {
        $paqueteController->verPaquete();
    } elseif ($servicio && $action == 'listarPorServicio') {
        $paqueteController->listarPorServicio($servicio);
    } elseif ($action == 'listar') {
        $paqueteController->listar();
    } elseif ($id_paquete && $action == 'mostrarFormularioActualizar') {
        $paqueteController->mostrarFormularioActualizar($id_paquete);
    } elseif ($id_paquete && $action == 'actualizarPaquete') {
        $paqueteController->actualizarPaquete($id_paquete);
    } elseif ($id_paquete && $action == 'eliminarPaquete') {
        $paqueteController->eliminarPaquete($id_paquete);
    }
} elseif ($controller == 'viajes') {
    $viajesController = new ViajesController();

    if ($action == 'verReservas') {
        $viajesController->verReservas($estado);
    } elseif ($action == 'reservar') {
        $viajesController->reservar();
    } elseif ($action == 'actualizarEstado') {
        $viajesController->actualizarEstado();
    }
} elseif ($controller == 'admin') {
    $adminController = new AdminController();

    if ($action == 'verReservasAdmin') {
        $adminController->verReservasAdmin($estado);
    } elseif ($action == 'actualizarEstado') {
        $adminController->actualizarEstado();
    } elseif ($action == 'insertarPaquete') {
        $adminController->insertarPaquete();
    } elseif ($servicio && $action == 'listarPorServicioAdmin') {
        $adminController->listarPorServicioAdmin($servicio);
    } elseif ($action == 'listarAdmin') {
        $adminController->listarAdmin();
    }
} else {
    // Muestra un error si no se encuentra el controlador
    http_response_code(404);
    echo "Página no encontrada";
    exit;
}
?>
