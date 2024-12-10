<?php
require_once '../models/Admin.php';
require_once '../models/Paquete.php';
require_once '../config/config.php';

class AdminController {
    private $adminModel; // Propiedad para la instancia de Admin
    private $paqueteModel; // Propiedad para la instancia de Paquete (opcional)

    public function __construct() {
        $this->adminModel = new Admin(); // Inicializa Admin en el constructor
        $this->paqueteModel = new Paquete(); // Inicializa Paquete en el constructor si es necesario
    }

    public function verReservasAdmin($estado) {
        session_start();
        if (isset($_SESSION['admin'])) {
            $reservas = $this->adminModel->verReservasAdmin($estado);
            // Incluye la vista y pasa las reservas como parámetro
            require_once "../views/admin/reservas-admin.php";
        } else {
            // Redirigir al login si no está logueado
            header("Location: " . BASE_URL . "login-admin");
            exit;
        }
    }

    public function actualizarEstado() {
        if (isset($_POST['id_viajes'])) {
            $idViajes = $_POST['id_viajes'];
            $estado = $_POST['estado'];

            $resultado = $this->adminModel->actualizarEstado($idViajes, $estado);

            if ($resultado) {
                // Redirige a la lista de viajes con un mensaje de éxito
                header('Location: ' . BASE_URL . 'admin/verReservasAdmin');
                exit;
            } else {
                // Redirige con un mensaje de error
                echo "ERROR";
            }
        }
    }

    public function listarAdmin() {
        $paquetes = $this->paqueteModel->obtenerTodos();

        // Incluye la vista para mostrar los paquetes
        require_once '../views/admin/paquetes-admin.php';
    }

    public function listarPorServicioAdmin($servicio) {
        $paquetes = $this->paqueteModel->obtenerPorServicio($servicio);

        require_once '../views/admin/paquetes-admin.php';
    }

}
?>
