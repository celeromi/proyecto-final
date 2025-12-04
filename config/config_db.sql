-- 1. Eliminar la base de datos completa
DROP DATABASE IF EXISTS _baer_db;

-- 2. Crear nuevamente la base
CREATE DATABASE IF NOT EXISTS `_baer_db`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- 3. Seleccionar la base
USE `_baer_db`;

-- 4. Crear tablas correctamente

CREATE TABLE `usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `dni` INT NOT NULL,
  `cuil` BIGINT NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `contacto` BIGINT NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `usuario` VARCHAR(50) NOT NULL,
  `contrasena` VARCHAR(255) NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `clientes` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `dni` INT NOT NULL,
  `cuit` BIGINT NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `contacto` BIGINT NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `razon_social` VARCHAR(255) NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `productos` (
  `id_producto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `categoria` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `precio_unitario` FLOAT NOT NULL,
  `precio_mayorista` FLOAT NOT NULL,
  `archivado` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 5. Resetear auto incrementales

DELETE FROM usuarios;
ALTER TABLE usuarios AUTO_INCREMENT = 1;

DELETE FROM clientes;
ALTER TABLE clientes AUTO_INCREMENT = 1;

DELETE FROM productos;
ALTER TABLE productos AUTO_INCREMENT = 1;

--------------------------------------------------

CREATE TABLE `presupuesto` (
  `id_presupuesto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_consulta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `importe_final` float NOT NULL,
  `archivado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `presupuesto`
  MODIFY `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT;

