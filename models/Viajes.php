<?php
require_once(__DIR__ . '/../config/db.php');

class Viajes {
    private $conexion;

    public function __construct() {
        $this->conexion = new DB();
    }

    // Función para insertar un nuevo viaje en la base de datos
    public function crearViaje($id_usuario, $id_paquete, $destino_final, $destino_origen, $estado, $personas, $fecha_inicio, $fecha_final, $visa, $servicio, $tipo_autobus, $tipo_habitacion, $clase_vuelo, $clase_tren) {
        // Comprobar si algunos valores son nulos y asignar null en la base de datos si es necesario
        $id_paquete = $id_paquete ?: NULL;
        $destino_origen = $destino_origen ?: NULL;
        $fecha_final = $fecha_final ?: NULL;
        $tipo_autobus = $tipo_autobus ?: NULL;
        $tipo_habitacion = $tipo_habitacion ?: NULL;
        $clase_vuelo = $clase_vuelo ?: NULL;
        $clase_tren = $clase_tren ?: NULL;
    
        // Crear la consulta SQL
        $query = "INSERT INTO Viajes (id_usuario, id_paquete, destino_final, destino_origen, estado, personas, fecha_inicio, fecha_final, visa, servicio, tipo_autobus, tipo_habitacion, clase_vuelo, clase_tren) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Preparar la consulta
        $stmt = $this->conexion->prepare($query);
    
        // Usar bindValue para enlazar los valores a la consulta (PDO no necesita tipos explícitos como mysqli)
        $stmt->bindValue(1, $id_usuario, PDO::PARAM_INT);
        $stmt->bindValue(2, $id_paquete, PDO::PARAM_INT);
        $stmt->bindValue(3, $destino_final, PDO::PARAM_STR);
        $stmt->bindValue(4, $destino_origen, PDO::PARAM_STR);
        $stmt->bindValue(5, $estado, PDO::PARAM_STR);
        $stmt->bindValue(6, $personas, PDO::PARAM_INT);
        $stmt->bindValue(7, $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindValue(8, $fecha_final, PDO::PARAM_STR);
        $stmt->bindValue(9, $visa, PDO::PARAM_STR);
        $stmt->bindValue(10, $servicio, PDO::PARAM_STR);
        $stmt->bindValue(11, $tipo_autobus, PDO::PARAM_STR);
        $stmt->bindValue(12, $tipo_habitacion, PDO::PARAM_STR);
        $stmt->bindValue(13, $clase_vuelo, PDO::PARAM_STR);
        $stmt->bindValue(14, $clase_tren, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Retorna true si se inserta correctamente
        }
        
        // Retorna false si ocurre algún error
        return false;
    }

    public function verReservas($userId, $estado = '') {
        // Empieza con la consulta base
        $sql = "
            SELECT * 
            FROM Viajes 
            WHERE id_usuario = :id_usuario
        ";
        
        // Añadir la cláusula WHERE si se pasa el estado
        if ($estado) {
            $sql .= " AND estado = :estado";
        }
    
        // Ordenar la consulta por estado y fecha de registro
        $sql .= " ORDER BY 
                    CASE estado
                        WHEN 'confirmado' THEN 1
                        WHEN 'pendiente' THEN 2
                        WHEN 'cancelado' THEN 3
                        ELSE 4
                    END,
                    fecha_registro DESC";
    
        // Preparar la consulta
        $query = $this->conexion->prepare($sql);
        
        // Vincular el parámetro de ID del usuario
        $query->bindParam(':id_usuario', $userId, PDO::PARAM_INT);
        
        // Si se pasa un estado, se debe vincular el parámetro
        if ($estado) {
            $query->bindParam(':estado', $estado, PDO::PARAM_STR);
        }
        
        // Ejecutar la consulta
        $query->execute();
        
        // Retornar los resultados
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($idViajes)
    {
        $stmt = $this->conexion->prepare("UPDATE Viajes SET estado = 'cancelado' WHERE id_viajes = ?");
        return $stmt->execute([$idViajes]);
    }

    public function contarViajes() {
        $query = "SELECT COUNT(*) AS total_viajes FROM Viajes";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_viajes'];
    }

    public function contarViajesPorEstado() {
        $query = "SELECT estado, COUNT(*) AS total_estado FROM Viajes GROUP BY estado";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
