USE `_baer_db`;

CREATE TABLE `producto` (
  `id_producto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `categoria` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `precio_unitario` FLOAT NOT NULL,
  `precio_mayorista` FLOAT NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO producto (nombre, categoria, descripcion, precio_unitario, precio_mayorista, archivado)
VALUES
('Yerba Mate Tradicional', 'Bebidas', 'Paquete de 1kg de yerba mate clásica.', 1200.00, 1000.00, 0),
('Arroz Largo Fino', 'Alimentos', 'Bolsa de 1kg de arroz blanco largo fino.', 800.00, 700.00, 0),
('Lavandina 1L', 'Limpieza', 'Lavandina concentrada de 1 litro.', 500.00, 450.00, 0),
('Aceite de Girasol 900ml', 'Alimentos', 'Botella de aceite de girasol comestible.', 1500.00, 1350.00, 0),
('Jabón Líquido 500ml', 'Higiene', 'Jabón líquido antibacterial.', 900.00, 800.00, 0);
