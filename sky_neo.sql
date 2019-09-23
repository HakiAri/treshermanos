-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para bdsky
CREATE DATABASE IF NOT EXISTS `bdsky` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bdsky`;

-- Volcando estructura para tabla bdsky.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `paterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `materno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celular` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `domicilio` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 's/dir',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_user` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdsky.empleado: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` (`id_empleado`, `nombres`, `paterno`, `materno`, `celular`, `telefono`, `domicilio`, `estado`, `id_user`) VALUES
	(1, 'Administrador', 'admin', 'admin', '123456', '654321', 's/dir', 1, 1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando estructura para tabla bdsky.precios
CREATE TABLE IF NOT EXISTS `precios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` double NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdsky.precios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `precios` DISABLE KEYS */;
INSERT INTO `precios` (`id`, `precio`, `descripcion`, `estado`) VALUES
	(1, 35, 'MAPIRI', 1),
	(2, 42, 'ACHIQUIRI', 1),
	(3, 38, 'CHAROPAMPA', 1),
	(4, 45, 'YUYO', 1);
/*!40000 ALTER TABLE `precios` ENABLE KEYS */;

-- Volcando estructura para tabla bdsky.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdsky.roles: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id_rol`, `nombre`, `estado`) VALUES
	(1, 'Administrador', 1),
	(2, 'Asistente', 1),
	(3, 'Vendedor', 1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla bdsky.stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `vendido` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `FK_stocks_usuario` (`usuario_id`),
  CONSTRAINT `FK_stocks_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdsky.stocks: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`id_stock`, `descripcion`, `cantidad`, `vendido`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `usuario_id`, `estado`) VALUES
	(1, 'Garrafas Nuevas', 700, 700, '2019-05-18', '2019-06-18', '12:32:55', '16:52:57', 2, 0),
	(2, 'Garrafas Antiguas', 900, 0, '2019-07-18', '0000-00-00', '12:34:48', '00:00:00', 2, 1),
	(3, 'Garrafas Viejitas', 500, 0, '2019-07-18', '0000-00-00', '12:36:02', '00:00:00', 2, 1),
	(4, 'Garrafitas', 1200, 0, '2019-07-18', '0000-00-00', '12:36:34', '00:00:00', 2, 1);
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- Volcando estructura para tabla bdsky.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(200) NOT NULL DEFAULT '1',
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_rol`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdsky.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `password`, `estado`, `token`, `id_rol`) VALUES
	(1, 'hakiari', '$2y$10$v2Z0Ucacc97lbvo9VF1xoOIplPK5ehjXAWHhbAz9YTaXpHcDownoq', 1, '1', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla bdsky.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `lugar_venta` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_total` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observacion` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_venta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `precio_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `FK_ventas_precios` (`precio_id`),
  KEY `FK_ventas_stocks` (`stock_id`),
  KEY `FK_ventas_usuario` (`usuario_id`),
  CONSTRAINT `FK_ventas_precios` FOREIGN KEY (`precio_id`) REFERENCES `precios` (`id`),
  CONSTRAINT `FK_ventas_stocks` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id_stock`),
  CONSTRAINT `FK_ventas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdsky.ventas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
