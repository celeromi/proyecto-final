USE `_baer_db`;

CREATE TABLE `cliente` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `dni` INT(11) NOT NULL,
  `cuit` BIGINT(11) NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `contacto` BIGINT(11) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `razon_social` VARCHAR(255) NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cliente` (dni, cuit, correo, nombre, apellido, contacto, direccion, razon_social, archivado)
VALUES
(20123456, 20301234561, 'juan.perez@gmail.com', 'Juan', 'Pérez', 3514567890, 'Calle Falsa 123', 'Distribuidora Pérez SRL', 0),
(30234567, 27345678901, 'maria.lopez@yahoo.com', 'María', 'López', 3415678901, 'Av. Belgrano 456', 'Supermercado López', 0),
(40345678, 23234567890, 'carlos.gomez@empresa.com', 'Carlos', 'Gómez', 3816789012, 'Ruta 9 Km 10', 'Servicios Gómez SA', 0),
(50456789, 20987654321, 'laura.diaz@hotmail.com', 'Laura', 'Díaz', 2617890123, 'Mitre 789', 'Farmacia Díaz', 0),
(60567890, 27765432109, 'lucas.martinez@negocio.ar', 'Lucas', 'Martínez', 2998901234, 'San Martín 321', 'Comercial Martínez SRL', 0);
