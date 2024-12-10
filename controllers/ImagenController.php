<?php
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $db = new DB();
    $stmt = $db->prepare("SELECT Foto FROM Paquete WHERE id_paquete = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && !empty($result['Foto'])) {
        header("Content-Type: image/jpeg");
        echo $result['Foto'];
    } else {
        // Imagen predeterminada en caso de que no haya imagen guardada
        header("Content-Type: image/jpeg");
        readfile("../public/images/default-image.jpg");
    }
} else {
    echo "ID no proporcionado.";
}
?>
