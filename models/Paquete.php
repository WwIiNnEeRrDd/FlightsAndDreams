<?php
    require_once(__DIR__ . '/../config/db.php');

    class Paquete {
        private $conexion;

        public function __construct() {
            $this->conexion = new DB(); // Instancia la conexión a la base de datos
        }

        public function obtenerTodos() {
            $query = "SELECT * FROM paquete"; 
            $stmt = $this->conexion->prepare($query); // Prepara la consulta
            $stmt->execute(); // Ejecuta la consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como array asociativo
        }

        public function obtenerPorServicio($servicio) {
            $query = "SELECT * FROM paquete WHERE servicio = ?"; // Ajusta según tu tabla
            $stmt = $this->conexion->prepare($query); // Prepara la consulta
            $stmt->bindValue(1, $servicio, PDO::PARAM_STR);
            $stmt->execute(); // Ejecuta la consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como array asociativo
        }

        public function obtenerTresServiciosDiferentes() {
            $query = "
                SELECT * 
                FROM paquete 
                GROUP BY servicio 
                LIMIT 3
            "; // Agrupamos por servicio y limitamos a 3
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertar($datos) {
            // Prepara la consulta SQL para insertar el paquete
            $query = "INSERT INTO paquete (nombre, descripcion, destino, precio, foto, fecha_inicio, fecha_final, servicio, itinerario) 
                      VALUES (:nombre, :descripcion, :destino, :precio, :foto, :fecha_inicio, :fecha_final, :servicio, :itinerario)";
            $stmt = $this->conexion->prepare($query);
        
            // Vincula los parámetros
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':descripcion', $datos['descripcion']);
            $stmt->bindParam(':destino', $datos['destino']);
            $stmt->bindParam(':precio', $datos['precio']);
            
            // Verificar si 'foto' está en los datos y no es null
            if (isset($datos['foto']) && $datos['foto'] !== null) {
                $stmt->bindParam(':foto', $datos['foto'], PDO::PARAM_LOB);
            } else {
                // Asignar null a 'foto' si no está presente o es null
                $stmt->bindValue(':foto', null, PDO::PARAM_NULL);
            }
        
            $stmt->bindParam(':fecha_inicio', $datos['fecha_inicio']);
            $stmt->bindParam(':fecha_final', $datos['fecha_final']);
            $stmt->bindParam(':servicio', $datos['servicio']);
            $stmt->bindParam(':itinerario', $datos['itinerario']);
            
            // Ejecuta la consulta
            return $stmt->execute();
        } 

        public function getPaqueteMasVendido() {
            // Consulta SQL para obtener el paquete más vendido
            $sql = "SELECT p.id_paquete, p.Nombre, COUNT(v.id_viajes) AS total_vendidos
                    FROM Paquete p
                    LEFT JOIN Viajes v ON p.id_paquete = v.id_paquete
                    GROUP BY p.id_paquete
                    ORDER BY total_vendidos DESC
                    LIMIT 1";
        
            // Preparar y ejecutar la consulta
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
        
            // Obtener el resultado
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Verificar si se encontró algún resultado
            if ($row !== false && !empty($row)) {
                return $row; // Retornar el paquete más vendido
            } else {
                return [];
            }
        }
        

        public function getPaqueteById($id_paquete) {
            $sql = "SELECT * FROM paquete WHERE id_paquete = :id_paquete";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function actualizarPaquete($datos) {
            $sql = "UPDATE paquete SET 
                        nombre = :nombre,
                        descripcion = :descripcion,
                        destino = :destino,
                        precio = :precio,
                        foto = :foto,
                        fecha_inicio = :fecha_inicio,
                        fecha_final = :fecha_final,
                        servicio = :servicio,
                        itinerario = :itinerario
                    WHERE id_paquete = :id_paquete";
        
            $stmt = $this->conexion->prepare($sql);
        
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':descripcion', $datos['descripcion']);
            $stmt->bindParam(':destino', $datos['destino']);
            $stmt->bindParam(':precio', $datos['precio']);
            $stmt->bindParam(':foto', $datos['foto'], PDO::PARAM_LOB);
            $stmt->bindParam(':fecha_inicio', $datos['fecha_inicio']);
            $stmt->bindParam(':fecha_final', $datos['fecha_final']);
            $stmt->bindParam(':servicio', $datos['servicio']);
            $stmt->bindParam(':itinerario', $datos['itinerario']);
            $stmt->bindParam(':id_paquete', $datos['id_paquete'], PDO::PARAM_INT);
        
            return $stmt->execute();
        }

        public function getFotoPaqueteById($id_paquete) {
            // Consulta SQL para obtener la imagen del paquete
            $sql = "SELECT foto FROM paquete WHERE id_paquete = :id_paquete";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
            $stmt->execute();
            
            // Verificamos si se encontró el paquete
            if ($stmt->rowCount() > 0) {
                // Devolver la imagen (como un blob)
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['foto'];
            } else {
                return null; // Si no se encuentra la foto, devolver null
            }
        }

        public function eliminarPaquete($id_paquete) {
            // Preparar la consulta SQL para eliminar el paquete
            $sql = "DELETE FROM paquete WHERE id_paquete = :id_paquete";
            
            // Preparar la declaración SQL
            $stmt = $this->conexion->prepare($sql);
            
            // Vincular el parámetro del ID del paquete
            $stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
            
            // Ejecutar la consulta y devolver el resultado (verdadero si se eliminó correctamente)
            return $stmt->execute();
        }
        
        
    }
    
?>
