<?php

require_once(__DIR__ . '/../config/db.php');
require_once './ApiModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $apiModel = new Api();
    $api = $apiModel->obtenerTodos();

    // Devuelve la respuesta en JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'data' => $api,
    ]);
    exit();
} else {
    // Si el método no es GET, devuelve un error
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido',
    ]);
    exit();
}
?>
