CREATE DATABASE flightsanddreams;

-- Crear tabla Usuario
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Nacionalidad VARCHAR(50),
    Contrasena VARCHAR(255) NOT NULL,
    Correo VARCHAR(100) NOT NULL UNIQUE,
    Residencia VARCHAR(100),
    Telefono VARCHAR(20)
);

-- Crear tabla Paquete
CREATE TABLE Paquete (
    id_paquete INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Descripcion TEXT,
    Destino VARCHAR(100),
    Precio DECIMAL(10, 2),
    Foto LONGBLOB,
    Fecha_inicio DATE,
    Fecha_final DATE,
    servicio ENUM('autobuses', 'hoteles', 'cruceros', 'trenes', 'vuelos') NOT NULL,
    itinerario TEXT
);

-- Crear tabla Viajes
CREATE TABLE Viajes (
    id_viajes INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único del viaje
    id_usuario INT NOT NULL, -- Relación con la tabla usuario (obligatorio)
    id_paquete INT, -- Relación con la tabla paquete (puede ser NULL)
    destino_final VARCHAR(255) NOT NULL, -- Lugar de salida (obligatorio)
    destino_origen VARCHAR(255), -- Lugar de destino (puede ser NULL)
    estado ENUM('pendiente', 'confirmado', 'cancelado') NOT NULL, -- Estado del viaje (obligatorio)
    personas INT, -- Número de personas (obligatorio)
    fecha_inicio DATE NOT NULL, -- Fecha de inicio del viaje (obligatorio)
    fecha_final DATE, -- Fecha final del viaje (puede ser NULL)
    visa BOOLEAN, -- Si se requiere visa (TRUE/FALSE)
    servicio VARCHAR(255) NOT NULL, -- Tipo de servicio (obligatorio)
    tipo_autobus VARCHAR(50), -- Tipo de autobús (puede ser NULL)
    tipo_habitacion VARCHAR(50), -- Tipo de habitación (puede ser NULL)
    clase_vuelo VARCHAR(50), -- Clase del vuelo (puede ser NULL)
    clase_tren VARCHAR(50), -- Clase del tren (puede ser NULL),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_paquete FOREIGN KEY (id_paquete) REFERENCES Paquete(id_paquete) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Administrador (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);


-- INSERT INTO Administrador (nombre_usuario, contrasena)
-- VALUES ('admin', SHA2('admin', 256));