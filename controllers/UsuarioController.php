<?php 
require_once '../models/Usuario.php';
require_once '../config/config.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $nacionalidad = $_POST['nacionalidad'];
            $residencia = $_POST['residencia'];
            $telefono = $_POST['telefono'];

            if (!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($contrasena) && !empty($nacionalidad) && !empty($residencia) && !empty($telefono)) {
                $resultado = $this->usuarioModel->registrar($nombre, $apellido, $correo, $contrasena, $nacionalidad, $residencia, $telefono);

                if ($resultado) {
                    $usuario = $this->usuarioModel->obtenerPorCorreo($correo);
                    session_start();
                    $_SESSION['usuario'] = $usuario['id_usuario'];
                    header("Location: " . BASE_URL . "inicio");
                    exit();
                } else {
                    echo "Error al registrar el usuario";
                }
            } else {
                echo "Todos los campos son obligatorios";
            }
        }
    }

    public function loginUsuario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            if (!empty($correo) && !empty($contrasena)) {
                $usuario = $this->usuarioModel->obtenerPorCorreo($correo);

                if ($usuario && password_verify($contrasena, $usuario['Contrasena'])) {
                    session_start();
                    $_SESSION['usuario'] = $usuario['id_usuario'];
                    header("Location: " . BASE_URL . "inicio");
                    exit();
                } else {
                    setcookie('error_login', 'Correo o contraseña incorrectos.', time() + 3600, '/', 'flightdreams.agency', false, true);

                    header("Location: " . BASE_URL . "views/usuarios/login.php");
                    exit();
                }
            } else {
                setcookie('error_login', 'Todos los campos son obligatorios.', time() + 3600, '/', 'flightdreams.agency', false, true);
                header("Location: " . BASE_URL . "views/usuarios/login.php");
                exit();
            }
        } else {
            require_once BASE_URL . 'login';
        }
    }

    public function loginAdministrador() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreUsuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];

            if (!empty($nombreUsuario) && !empty($contrasena)) {
                $administrador = $this->usuarioModel->obtenerPorNombreUsuario($nombreUsuario);

                if ($administrador && hash('sha256', $contrasena) === $administrador['contrasena']) {
                    session_start();
                    $_SESSION['admin'] = $administrador['id_admin'];
                    header("Location: " . BASE_URL . "dashboard");
                    exit();
                } else {
                    setcookie('error_login_admin', 'Usuario o contraseña incorrectos.', time() + 3600, '/', 'flightdreams.agency', false, true);
                    header("Location: " . BASE_URL . "views/usuarios/login-admin.php");
                    exit();
                }
            } else {
                setcookie('error_login_admin', 'Todos los campos son obligatorios.', time() + 3600, '/', 'flightdreams.agency', false, true);
                header("Location: " . BASE_URL . "views/usuarios/login-admin.php");
                exit();
            }
        } else {
            require_once BASE_URL . 'login-admin';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . BASE_URL . "inicio");
        exit();
    }

    public function mostrarFormularioActualizar() {
        session_start();
        verificarSesion();

        $id = $_SESSION['usuario'];
        $usuario = $this->usuarioModel->obtenerUsuarioPorId($id);

        require_once '../views/usuarios/actualizar-usuario.php';
    }

    public function actualizarUsuario() {
        session_start();
        verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['usuario'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $nacionalidad = $_POST['nacionalidad'];
            $residencia = $_POST['residencia'];
            $telefono = $_POST['telefono'];

            $usuario = $this->usuarioModel->obtenerUsuarioPorId($id);

            if (!empty($contrasena)) {
                $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
            } else {
                $contrasena = $usuario['Contrasena'];
            }

            $resultado = $this->usuarioModel->actualizarUsuario($id, $nombre, $apellido, $correo, $contrasena, $nacionalidad, $residencia, $telefono);

            if ($resultado) {
                header("Location: " . BASE_URL . "inicio");
                exit();
            } else {
                echo "Error al actualizar usuario.";
            }
        }
    }

}
?>
