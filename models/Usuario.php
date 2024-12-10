<?php
    require_once '../config/db.php';

    class Usuario {
        private $conexion;

        public function __construct() {
            $this->conexion = new DB(); // Instancia la conexión a la base de datos
        }

        // Función para registrar un nuevo usuario
        public function registrar($nombre, $apellido, $correo, $contrasena, $nacionalidad, $residencia, $telefono) {
            
            // Encriptamos la contraseña
            $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

            // Preparamos la consulta SQL para insertar el nuevo usuario
            $query = "INSERT INTO Usuario (Nombre, Apellido, Correo, Contrasena, Nacionalidad, Residencia, Telefono) 
                    VALUES (:nombre, :apellido, :correo, :contrasena, :nacionalidad, :residencia, :telefono)";

            // Preparamos la declaración SQL
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $contrasena_encriptada);
            $stmt->bindParam(':nacionalidad', $nacionalidad);
            $stmt->bindParam(':residencia', $residencia);
            $stmt->bindParam(':telefono', $telefono);

            // Ejecutamos la consulta
            if ($stmt->execute()) {
                return true; // Usuario registrado exitosamente
            } else {
                return false; // Hubo un error al registrar el usuario
            }
        }

        public function obtenerPorCorreo($correo) {
            $query = $this->conexion->prepare("SELECT * FROM Usuario WHERE Correo = :correo");
            $query->bindParam(':correo', $correo);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function obtenerPorNombreUsuario($nombreUsuario) {
            $query = $this->conexion->prepare("SELECT * FROM Administrador WHERE nombre_usuario = :nombre_usuario");
            $query->bindParam(':nombre_usuario', $nombreUsuario);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function obtenerUsuarioPorId($id) {
            $sql = "SELECT * FROM Usuario WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        public function actualizarUsuario($id, $nombre, $apellido, $correo, $contrasena, $nacionalidad, $residencia, $telefono) {
            $sql = "UPDATE Usuario SET 
                    Nombre = :nombre, 
                    Apellido = :apellido, 
                    Correo = :correo, 
                    Contrasena = :contrasena, 
                    Nacionalidad = :nacionalidad, 
                    Residencia = :residencia, 
                    Telefono = :telefono 
                    WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($sql);

            // Bind de los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':nacionalidad', $nacionalidad);
            $stmt->bindParam(':residencia', $residencia);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':id', $id);

            // Ejecutar la consulta
            return $stmt->execute();
        }
            
    }
?>
