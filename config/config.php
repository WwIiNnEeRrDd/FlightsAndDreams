<?php
define('BASE_URL', 'http://flightdreams.agency/');

ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.save_handler', 'files');
ini_set('session.gc_maxlifetime', 3600);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.save_path', '/data/user14/2024/203/78478/wordpress/flightdreams.agency/tmp');

function verificarSesion() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: ' . BASE_URL . 'login'); 
        exit();
    }
}

function verificarSesionAdmin() {
    if (!isset($_SESSION['admin'])) {
        header('Location: ' . BASE_URL . 'login-admin'); 
        exit();
    }
}
?>

 