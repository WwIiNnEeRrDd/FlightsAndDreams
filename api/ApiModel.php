<?php
require_once '../config/db.php';

class Api {
    private $conexion;

    public function __construct() {
        $this->conexion = new DB(); // Instancia de la conexión
    }

    public function obtenerTodos() {
        // Excluye la columna `Foto` de la selección
        $sql = "SELECT id_paquete, Nombre, Descripcion, Destino, Precio, Fecha_inicio, Fecha_final, servicio, itinerario FROM paquete";
        
        // Prepara y ejecuta la consulta
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        
        // Devuelve los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
