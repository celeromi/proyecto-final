DROP DATABASE _baer_db;

/*  */

CREATE DATABASE IF NOT EXISTS `_baer_db`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

/*  */

USE `_baer_db`;

CREATE TABLE `usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `dni` INT(11) NOT NULL,
  `cuil` BIGINT(20) NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `contacto` BIGINT(20) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `usuario` VARCHAR(50) NOT NULL,
  `contrasena` VARCHAR(255) NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios (dni, cuil, correo, nombre, apellido, contacto, direccion, usuario, contrasena, archivado)
VALUES
(12345678, 20123456789, 'gfarias@gmail.com', 'Gastón', 'Farias', 3454234567, 'Avenida Siempreviva 742', 'gfarias', 'securepass742', 0),
(12345679, 20123456780, 'mlopez@gmail.com', 'María', 'López', 3454234568, 'Calle 1 100', 'mlopez', 'pass123', 0),
(12345680, 20123456781, 'jmartinez@gmail.com', 'José', 'Martínez', 3454234569, 'Calle 2 101', 'jmartinez', 'pass123', 0),
(12345681, 20123456782, 'acarballo@gmail.com', 'Ana', 'Carballo', 3454234570, 'Calle 3 102', 'acarballo', 'pass123', 0),
(12345682, 20123456783, 'fgarcia@gmail.com', 'Federico', 'García', 3454234571, 'Calle 4 103', 'fgarcia', 'pass123', 0),
(12345683, 20123456784, 'lcastro@gmail.com', 'Lucía', 'Castro', 3454234572, 'Calle 5 104', 'lcastro', 'pass123', 0),
(12345684, 20123456785, 'nrodriguez@gmail.com', 'Nicolás', 'Rodríguez', 3454234573, 'Calle 6 105', 'nrodriguez', 'pass123', 0),
(12345685, 20123456786, 'eperez@gmail.com', 'Elena', 'Pérez', 3454234574, 'Calle 7 106', 'eperez', 'pass123', 0),
(12345686, 20123456787, 'dfernandez@gmail.com', 'Diego', 'Fernández', 3454234575, 'Calle 8 107', 'dfernandez', 'pass123', 0),
(12345687, 20123456788, 'rsanchez@gmail.com', 'Rocío', 'Sánchez', 3454234576, 'Calle 9 108', 'rsanchez', 'pass123', 0),
(12345688, 20123456789, 'pdominguez@gmail.com', 'Pablo', 'Domínguez', 3454234577, 'Calle 10 109', 'pdominguez', 'pass123', 0),
(12345689, 20123456790, 'jcorrea@gmail.com', 'Julieta', 'Correa', 3454234578, 'Calle 11 110', 'jcorrea', 'pass123', 0),
(12345690, 20123456791, 'hsilva@gmail.com', 'Hernán', 'Silva', 3454234579, 'Calle 12 111', 'hsilva', 'pass123', 0),
(12345691, 20123456792, 'mrios@gmail.com', 'Milagros', 'Ríos', 3454234580, 'Calle 13 112', 'mrios', 'pass123', 0),
(12345692, 20123456793, 'qgomez@gmail.com', 'Quimey', 'Gómez', 3454234581, 'Calle 14 113', 'qgomez', 'pass123', 0),
(12345693, 20123456794, 'agarcia@gmail.com', 'Agustina', 'García', 3454234582, 'Calle 15 114', 'agarcia', 'pass123', 0),
(12345694, 20123456795, 'tmedina@gmail.com', 'Tomás', 'Medina', 3454234583, 'Calle 16 115', 'tmedina', 'pass123', 0),
(12345695, 20123456796, 'rfernandez@gmail.com', 'Romina', 'Fernández', 3454234584, 'Calle 17 116', 'rfernandez', 'pass123', 0),
(12345696, 20123456797, 'cbenitez@gmail.com', 'Carlos', 'Benítez', 3454234585, 'Calle 18 117', 'cbenitez', 'pass123', 0),
(12345697, 20123456798, 'fsolis@gmail.com', 'Florencia', 'Solis', 3454234586, 'Calle 19 118', 'fsolis', 'pass123', 0);

/*  */

USE `_baer_db`;
DELETE FROM usuarios;
ALTER TABLE usuarios AUTO_INCREMENT = 1;

