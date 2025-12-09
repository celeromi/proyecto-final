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

CREATE TABLE `cliente` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `dni` INT(8) NOT NULL UNIQUE,
  `cuit` BIGINT UNIQUE NULL,
  `razon_social` VARCHAR(150) NOT NULL,
  `correo` VARCHAR(255) NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `contacto` BIGINT(20) NOT NULL,
  `direccion` VARCHAR(255) NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cliente` (`dni`, `cuit`, `razon_social`, `correo`, `nombre`, `apellido`, `contacto`, `direccion`, `archivado`) VALUES
(35123456, 20351234567, 'Peluquería Estilo Urbano SRL', 'estilo.urbano@mail.com', 'Martina', 'Gómez', 1168765432, 'Av. Corrientes 1500, CABA', 0),
(28765432, NULL, 'Salón Glamour y Belleza', 'salon.glamour@mail.com', 'Andrés', 'Rodríguez', 3415551234, 'Calle Falsa 123, Rosario', 0),
(40987654, 30409876543, 'Distribuidora Capilar SA', 'distribuidora.capilar@mail.com', 'Julieta', 'Pérez', 3514449876, 'Bv. San Juan 500, Córdoba', 0),
(32543210, NULL, 'Barbería El Bigote', 'barberia.bigote@mail.com', 'Pablo', 'López', 2216789012, 'Diagonal 74 n° 800, La Plata', 0),
(38010203, 27380102034, 'Spa Hair & Body', 'spa.hairbody@mail.com', 'Sofía', 'Fernández', 2617770001, 'Sarmiento 2030, Mendoza', 0);

CREATE TABLE `productos` (
  `id_producto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `categoria` VARCHAR(255) NOT NULL,
  `descripcion` TEXT NULL,
  `precio_unitario` DECIMAL(10, 2) NOT NULL,
  `precio_mayorista` DECIMAL(10, 2) NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` (`nombre`, `categoria`, `descripcion`, `precio_unitario`, `precio_mayorista`, `archivado`) VALUES
('Shampoo Reparador con Keratina 1000ml', 'Cuidado Capilar', 'Fórmula avanzada para cabello dañado, con alta concentración de keratina.', 25.50, 20.00, 0),
('Acondicionador Hidratante Diario 1000ml', 'Cuidado Capilar', 'Desenreda y aporta brillo sin apelmazar. Ideal para uso frecuente.', 22.00, 17.50, 0),
('Máscara Nutritiva Profunda 500g', 'Tratamiento', 'Tratamiento intensivo para cabellos secos y maltratados. Contiene aceites naturales.', 38.99, 32.00, 0),
('Tinte Profesional Rubio Ceniza 8.1', 'Coloración', 'Tubo de tinte de 60g. Cobertura total de canas y color duradero.', 15.75, 12.50, 0),
('Polvo Decolorante Azul 500g', 'Coloración', 'Decolorante de alto rendimiento. Aclara hasta 7 tonos. Sin amoníaco.', 65.00, 55.00, 0),
('Cera Modeladora Efecto Mate 100g', 'Styling', 'Fijación fuerte con acabado natural mate. Para peinados masculinos y cortos.', 18.20, 14.90, 0),
('Spray Protector Térmico 250ml', 'Styling', 'Protege el cabello del calor de planchas y secadores hasta 230°C.', 29.90, 24.50, 0),
('Kit de Tijeras de Corte Profesional', 'Herramientas', 'Incluye tijera de corte y tijera de pulir, acero inoxidable de alta calidad.', 150.00, 125.00, 0),
('Capa de Corte Impermeable', 'Accesorios', 'Capa de nylon con cierre ajustable, resistente al agua y a los químicos.', 12.50, 9.80, 0),
('Cepillo Redondo para Brushing (Grande)', 'Herramientas', 'Cerdas mixtas y cuerpo cerámico para un secado rápido y brillante.', 20.10, 16.50, 0);

CREATE TABLE `presupuesto` (
  `id_presupuesto` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` INT(11) NOT NULL,
  `id_cliente_fk` INT(11) NOT NULL,
  `fecha_creacion` DATE NOT NULL,
  `fecha_validez` DATE NULL,
  `estado` ENUM('PENDIENTE', 'ACEPTADO', 'RECHAZADO', 'ANULADO') NOT NULL,
  `importe_final` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_presupuesto`),
  FOREIGN KEY (`id_cliente_fk`) REFERENCES `cliente`(`id_cliente`),
  FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario`(`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalle_presupuesto` (
  `id_detalle_presupuesto` INT(11) NOT NULL AUTO_INCREMENT,
  `id_presupuesto_fk` INT(11) NOT NULL,
  `id_producto_fk` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  `precio_cotizado` DECIMAL(10, 2) NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_detalle_presupuesto`),
  FOREIGN KEY (`id_presupuesto_fk`) REFERENCES `presupuesto`(`id_presupuesto`),
  FOREIGN KEY (`id_producto_fk`) REFERENCES `productos`(`id_producto`),
  UNIQUE KEY `uk_detalle_presupuesto` (`id_presupuesto_fk`, `id_producto_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `metodo_pago` (
    `id_metodo_pago` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL UNIQUE,
    `tipo` ENUM('CONTADO', 'CREDITO', 'DEBITO', 'TRANSFERENCIA') NOT NULL,
    `archivado` BOOLEAN NOT NULL DEFAULT 1,
    PRIMARY KEY (`id_metodo_pago`)
);

CREATE TABLE `venta` (
    `id_venta` INT NOT NULL AUTO_INCREMENT,
    `id_metodo_pago_fk` INT NOT NULL,
    `id_presupuesto_fk` INT NULL,
    `id_cliente_fk` INT NOT NULL,
    `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `tipo_factura` ENUM('A', 'B', 'C', 'TICKET') NOT NULL,
    `importe_total` DECIMAL(10, 2) NOT NULL,
    `archivado` BOOLEAN NOT NULL DEFAULT 1,
    PRIMARY KEY (`id_venta`),
    FOREIGN KEY (`id_metodo_pago_fk`) REFERENCES `metodo_pago`(`id_metodo_pago`),
    FOREIGN KEY (`id_presupuesto_fk`) REFERENCES `presupuesto`(`id_presupuesto`),
    FOREIGN KEY (`id_cliente_fk`) REFERENCES `cliente`(`id_cliente`)
);
/*  */

USE `_baer_db`;
DELETE FROM usuarios;
ALTER TABLE usuarios AUTO_INCREMENT = 1;

