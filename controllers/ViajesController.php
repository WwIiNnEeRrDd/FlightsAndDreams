<?php
require_once '../models/Viajes.php';
require_once '../models/Admin.php';
require_once '../config/config.php';

class ViajesController {
    private $viajesModel;

    public function __construct() {
        $this->viajesModel = new Viajes();
    }

    public function reservar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            verificarSesion();

            $userId = $_SESSION['usuario'];
            $id_usuario = $userId;
            $id_paquete = $_POST['id_paquete'] ?? null;
            $destino_final = $_POST['destino_final'];
            $destino_origen = $_POST['destino_origen'] ?? null;
            $estado = $_POST['estado'] ?? 'pendiente';
            $personas = $_POST['personas'] ?? null;
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_final = $_POST['fecha_final'] ?? null;
            $visa = $_POST['visa'] ?? null;
            $servicio = $_POST['servicio'];
            $tipo_autobus = $_POST['tipo_autobus'] ?? null;
            $tipo_habitacion = $_POST['tipo_habitacion'] ?? null;
            $clase_vuelo = $_POST['clase_vuelo'] ?? null;
            $clase_tren = $_POST['clase_tren'] ?? null;

            // Verificar fechas
            if (strtotime($fecha_inicio) >= strtotime($fecha_final)) {
                setcookie('fecha_incorrecta_servicios', 'Fechas incorrectas. La fecha de inicio debe ser antes que la de final.', time() + 3600, '/');
                header('Location: ' . BASE_URL . "paquetes/listarPorServicio/" . $servicio);
                exit();
            }

            // Validar datos obligatorios
            if (!empty($destino_final) && !empty($estado) && !empty($fecha_inicio) && !empty($servicio)) {
                $resultado = $this->viajesModel->crearViaje(
                    $id_usuario, $id_paquete, $destino_final, $destino_origen, $estado, $personas,
                    $fecha_inicio, $fecha_final, $visa, $servicio, $tipo_autobus, $tipo_habitacion, $clase_vuelo, $clase_tren
                );

                if ($resultado) {
                    header('Location: ' . BASE_URL . 'viajes/verReservas');
                    exit();
                } else {
                    echo "Hubo un error al crear el viaje.";
                }
            } else {
                echo "Por favor complete todos los campos obligatorios.";
            }
        }
    }

    public function verReservas($estado) {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $userId = $_SESSION['usuario'];
            $reservas = $this->viajesModel->verReservas($userId, $estado);

            require_once "../views/viajes/reservas.php";
        } else {
            header("Location: " . BASE_URL . "views/usuarios/login.php");
            exit();
        }
    }

    public function actualizarEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_viajes'])) {
            $idViajes = $_POST['id_viajes'];

            $resultado = $this->viajesModel->actualizarEstado($idViajes, "cancelado");

            if ($resultado) {
                header('Location: ' . BASE_URL . 'viajes/verReservas');
            } else {
                echo "ERROR al actualizar el estado.";
            }
        }
    }
}
?>
