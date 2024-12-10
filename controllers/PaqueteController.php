<?php
require_once '../models/Paquete.php';
require_once '../config/config.php';

class PaqueteController {
    private $paqueteModel;

    public function __construct() {
        // Inicializa la instancia de Paquete en el constructor
        $this->paqueteModel = new Paquete();
    }

    public function listar() {

        $paquetes = $this->paqueteModel->obtenerTodos();
        // Incluye la vista para mostrar los paquetes
        require_once '../views/paquete/paquetes.php';
    }

    public function listarPorServicio($servicio) {
        $paquetes = $this->paqueteModel->obtenerPorServicio($servicio);
        require_once '../views/servicios/' . $servicio . '.php';
    }

    public function listarPorServicioPaquetes($servicio) {
        $paquetes = $this->paqueteModel->obtenerPorServicio($servicio);
        require_once '../views/paquete/paquetes.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $destino = $_POST['destino'];
            $precio = $_POST['precio'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_final = $_POST['fecha_final'];
            $servicio = $_POST['servicio'];
            $itinerario = $_POST['itinerario'];

            // Leer la imagen como binario (blob)
            $foto = null;
            if (isset($_FILES['foto']['tmp_name']) && is_uploaded_file($_FILES['foto']['tmp_name'])) {
                $foto = file_get_contents($_FILES['foto']['tmp_name']);
            }

            if (strtotime($fecha_inicio) >= strtotime($fecha_final)) {
                setcookie('fecha_incorrecta_paquetes', 'Fechas incorrectas. La fecha de inicio debe ser antes que la de final.', time() + 3600, '/');
                header('Location: ' . BASE_URL . "insertar-paquete");
                exit();
            }

            $datos = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'destino' => $destino,
                'precio' => $precio,
                'foto' => $foto,
                'fecha_inicio' => $fecha_inicio,
                'fecha_final' => $fecha_final,
                'servicio' => $servicio,
                'itinerario' => $itinerario
            ];

            if ($this->paqueteModel->insertar($datos)) {
                header('Location: ../views/admin/dashboard.php');
            } else {
                header('Location: ../views/admin/dashboard.php');
            }
        }
    }

    public function verPaquete() {
        if (isset($_GET['id_paquete'])) {
            $id_paquete = $_GET['id_paquete'];
        } else {
            echo "ID de paquete no proporcionado.";
            exit();
        }

        $paquete = $this->paqueteModel->getPaqueteById($id_paquete);

        if ($paquete) {
            include '../views/paquete/paquete-desc.php';
        } else {
            echo "Paquete no encontrado.";
        }
    }

    public function actualizarPaquete($id_paquete) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $destino = $_POST['destino'];
            $precio = $_POST['precio'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_final = $_POST['fecha_final'];
            $servicio = $_POST['servicio'];
            $itinerario = $_POST['itinerario'];
    

            // Validar fechas
            if (strtotime($fecha_inicio) >= strtotime($fecha_final)) {
                setcookie('fecha_incorrecta_paquetes', 'Fechas incorrectas. La fecha de inicio debe ser antes que la de final.', time() + 3600, '/');
                header('Location: ' . BASE_URL . "paquetes/mostrarFormularioActualizar/" . $id_paquete);
                exit();
            }

            // Inicializar la variable foto
            $foto = null;
    
            // Verificar si se ha enviado una nueva imagen
            if (isset($_FILES['foto']['tmp_name']) && is_uploaded_file($_FILES['foto']['tmp_name'])) {
                // Si se sube una nueva imagen, leerla como binario (blob)
                $foto = file_get_contents($_FILES['foto']['tmp_name']);
            } else {
                // Si no se sube una imagen, obtener la imagen actual de la base de datos
                $foto = $this->paqueteModel->getFotoPaqueteById($id_paquete);
            }
    
            // Crear el array con los datos para actualizar
            $datos = [
                'id_paquete' => $id_paquete,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'destino' => $destino,
                'precio' => $precio,
                'fecha_inicio' => $fecha_inicio,
                'fecha_final' => $fecha_final,
                'servicio' => $servicio,
                'itinerario' => $itinerario,
                'foto' => $foto // Pasamos la foto (ya sea nueva o la actual)
            ];
    
            // Llamar al modelo para actualizar el paquete
            if ($this->paqueteModel->actualizarPaquete($datos)) {
                header('Location: ' . BASE_URL . "dashboard");
            } else {
                header('Location: ' . BASE_URL . "dashboard");
            }
        }
    }
    
    
    public function mostrarFormularioActualizar($id_paquete) {
        session_start();
        verificarSesionAdmin();

        $paquete = $this->paqueteModel->getPaqueteById($id_paquete);

        require_once '../views/admin/actualizar-paquete.php';
    }

    public function eliminarPaquete($id_paquete) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que el ID del paquete exista
            if (empty($id_paquete) || !is_numeric($id_paquete)) {
                header('Location: ' . BASE_URL . 'paquetes/lista?mensaje=error_id');
                exit();
            }
    
            // Llamar al modelo para eliminar el paquete de la base de datos
            if ($this->paqueteModel->eliminarPaquete($id_paquete)) {
                // Redirigir al usuario a la lista de paquetes con un mensaje de éxito
                header('Location: ' . BASE_URL . 'admin/listarAdmin');
            } else {
                // Redirigir con un mensaje de error si no se pudo eliminar el paquete
                header('Location: ' . BASE_URL . 'admin/listarAdmin');
            }
        } else {
            // Redirigir si no es una solicitud POST
            header('Location: ' . BASE_URL . 'paquetes/listarAdmin');
        }
    }
   
}
?>
