<?php
require_once(__DIR__ . '/../config/db.php');

class Admin {
    private $conexion;

    public function __construct() {
        $this->conexion = new DB();
    }
    
    public function verReservasAdmin($estado = '') {
        // Empieza con la consulta base
        $sql = "
            SELECT 
                v.*, 
                u.Nombre AS nombre_usuario, 
                u.Correo, 
                u.Telefono,
                p.Nombre AS nombre_paquete
            FROM Viajes v
            LEFT JOIN Usuario u ON v.id_usuario = u.id_usuario
            LEFT JOIN Paquete p ON v.id_paquete = p.id_paquete
        ";
        
        // Añadir la cláusula WHERE si se pasa el estado
        if ($estado) {
            $sql .= " WHERE v.estado = :estado";
        }
        
        // Ordenar la consulta
        $sql .= " ORDER BY v.fecha_registro DESC";
        
        // Preparar la consulta
        $query = $this->conexion->prepare($sql);
        
        // Si se pasa un estado, se debe vincular el parámetro
        if ($estado) {
            $query->bindParam(':estado', $estado, PDO::PARAM_STR);
        }
        
        // Ejecutar la consulta
        $query->execute();
        
        // Retornar los resultados
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($idViajes, $estado) {
        // Verifica si el estado es válido
        $estadosPermitidos = ['cancelado', 'confirmado', 'pendiente'];
        if (!in_array($estado, $estadosPermitidos)) {
            throw new Exception("Estado no válido");
        }

        // Prepara la consulta SQL
        $stmt = $this->conexion->prepare("UPDATE Viajes SET estado = ? WHERE id_viajes = ?");
        
        // Ejecuta la consulta
        return $stmt->execute([$estado, $idViajes]);
    }

    public function getNacionalidadMasRepetida() {
        $sql = "SELECT Nacionalidad, COUNT(*) AS cantidad
                FROM Usuario
                GROUP BY Nacionalidad
                ORDER BY cantidad DESC
                LIMIT 1";
    
        // Preparar la consulta
        $stmt = $this->conexion->prepare($sql);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retornar la nacionalidad más repetida
        if ($row && isset($row['Nacionalidad'], $row['cantidad'])) {
            return $row; // Contiene Nacionalidad y cantidad
        } else {
            return ['Nacionalidad' => null, 'cantidad' => 0]; // Valores por defecto si no hay resultados
        }
    }
    
    public function destinoFinalMasReservado() { 
        $query = "SELECT destino_final, COUNT(*) AS reservas 
                  FROM Viajes 
                  WHERE destino_final IS NOT NULL 
                  GROUP BY destino_final 
                  ORDER BY reservas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si el resultado no es null
        if ($resultado && isset($resultado['destino_origen'], $resultado['reservas'])) {
            return $resultado;
        } else {
            return ['destino_origen' => null, 'reservas' => 0]; // Valores por defecto si no hay resultados
        }
    }
    
    public function tipoAutobusMasReservado() { 
        $query = "SELECT tipo_autobus, COUNT(*) AS reservas 
                  FROM Viajes 
                  WHERE tipo_autobus IS NOT NULL 
                  GROUP BY tipo_autobus 
                  ORDER BY reservas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado || !isset($resultado['tipo_autobus'], $resultado['reservas'])) {
            return ['tipo_autobus' => null, 'reservas' => 0]; // Valores por defecto si no hay resultados
        }
    
        return $resultado;
    }
    
    public function tipoHabitacionMasReservado() {
        $query = "SELECT tipo_habitacion, COUNT(*) AS reservas 
                  FROM Viajes 
                  WHERE tipo_habitacion IS NOT NULL 
                  GROUP BY tipo_habitacion 
                  ORDER BY reservas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado || !isset($resultado['tipo_habitacion'], $resultado['reservas'])) {
            return ['tipo_habitacion' => null, 'reservas' => 0]; // Valores por defecto si no hay resultados
        }
    
        return $resultado;
    }
    
    public function claseVueloMasReservado() {
        $query = "SELECT clase_vuelo, COUNT(*) AS reservas 
                  FROM Viajes 
                  WHERE clase_vuelo IS NOT NULL 
                  GROUP BY clase_vuelo 
                  ORDER BY reservas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado || !isset($resultado['clase_vuelo'], $resultado['reservas'])) {
            return ['clase_vuelo' => null, 'reservas' => 0]; // Valores por defecto si no hay resultados
        }
    
        return $resultado;
    }
    
    public function claseTrenMasReservado() {
        $query = "SELECT clase_tren, COUNT(*) AS reservas 
                  FROM Viajes 
                  WHERE clase_tren IS NOT NULL 
                  GROUP BY clase_tren 
                  ORDER BY reservas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado || !isset($resultado['clase_tren'], $resultado['reservas'])) {
            return ['clase_tren' => null, 'reservas' => 0]; // Valores por defecto si no hay resultados
        }
    
        return $resultado;
    }
    
    public function fechaRegistroMasVentas() { 
        $query = "SELECT DATE(fecha_registro) AS fecha_registro, COUNT(*) AS ventas 
                  FROM Viajes 
                  GROUP BY DATE(fecha_registro) 
                  ORDER BY ventas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado || !isset($resultado['fecha_registro'], $resultado['ventas'])) {
            return ['fecha_registro' => null, 'ventas' => 0]; // Valores por defecto si no hay resultados
        }
    
        return $resultado;
    }
    
    public function fechaSalidaMasReservada() {
        $query = "SELECT fecha_inicio, COUNT(*) AS reservas 
                  FROM Viajes 
                  GROUP BY fecha_inicio 
                  ORDER BY reservas DESC 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado || !isset($resultado['fecha_inicio'], $resultado['reservas'])) {
            return ['fecha_inicio' => null, 'reservas' => 0]; // Valores por defecto si no hay resultados
        }
    
        return $resultado;
    }
    
    public function getServicioMasReservado() {
        $sql = "SELECT servicio, COUNT(*) AS cantidad
                FROM Viajes
                GROUP BY servicio
                ORDER BY cantidad DESC
                LIMIT 1";
    
        // Preparar la consulta
        $stmt = $this->conexion->prepare($sql);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retornar el resultado
        if ($row && isset($row['servicio'], $row['cantidad'])) {
            return $row; // Contiene el servicio y la cantidad de reservas
        } else {
            return ['servicio' => null, 'cantidad' => 0]; // Valores por defecto si no se encontró ningún servicio
        }
    }
    
    public function getPersonasPorVisa() {
        // Consulta SQL para obtener la cantidad de personas con y sin visa
        $sql = "SELECT visa, SUM(personas) AS total_personas
                FROM Viajes
                GROUP BY visa";
    
        // Preparar la consulta
        $stmt = $this->conexion->prepare($sql);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!$result) {
            return []; // Retornar un array vacío si no hay resultados
        }
    
        return $result;
    }
    
}
?>
