-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-10-2019 a las 15:12:26
-- Versión del servidor: 10.0.38-MariaDB-cll-lve
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `treshermanos_sky`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombres` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `paterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `materno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celular` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `domicilio` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 's/dir',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_user` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombres`, `paterno`, `materno`, `celular`, `telefono`, `domicilio`, `estado`, `id_user`) VALUES
(1, 'administrador', 'admin', 'admin', '1234', '4321', 's/dir', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id` int(11) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `precio`, `descripcion`, `estado`) VALUES
(1, 35, 'MAPIRI', 1),
(2, 42, 'ACHIQUIRI', 1),
(3, 38, 'CHAROPAMPA', 1),
(4, 45, 'YUYO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `id_stock` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `vendido` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `sinc_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`id_stock`, `descripcion`, `cantidad`, `vendido`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `usuario_id`, `estado`, `sinc_estado`) VALUES
(1, 'Garrafas Nuevas', 500, 0, '2019-09-16', '0000-00-00', '12:34:48', '00:00:00', 2, 1, 0),
(2, 'Mas Garrafas', 400, 0, '2019-10-17', '0000-00-00', '12:34:48', '00:00:00', 2, 1, 0),
(3, '10 seminuevas', 900, 0, '2019-10-17', '0000-00-00', '17:10:09', '00:00:00', 2, 0, 0),
(4, 'No hay', 900, 0, '2019-10-17', '0000-00-00', '17:10:47', '00:00:00', 2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(200) NOT NULL DEFAULT '1',
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `password`, `estado`, `token`, `id_rol`) VALUES
(1, 'admin', 'admin', 1, '1', 1),
(2, 'usuario', 'usuario', 1, '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_venta_sync` int(11) NOT NULL,
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
  `usuario_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_venta_sync`, `lugar_venta`, `precio`, `cantidad`, `cantidad_total`, `fecha`, `observacion`, `tipo_venta`, `estado`, `precio_id`, `stock_id`, `usuario_id`) VALUES
(1, 0, 'MAPIR', 3, 0, 35, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(2, 0, 'MAPIR', 3, 0, 140, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(3, 0, 'MAPIR', 3, 0, 35, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(4, 0, 'MAPIR', 3, 0, 140, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(5, 0, 'MAPIR', 3, 0, 35, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(6, 0, 'CHAROPAMP', 3, 0, 308, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(7, 0, 'YUY', 4, 0, 630, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(8, 0, 'MAPIR', 3, 1, 560, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(9, 0, 'ACHIQUIR', 4, 1, 714, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(10, 0, 'CHAROPAMP', 3, 1, 380, '2019-10-01', 'ningun', 0, 0, 0, 0, 2),
(11, 0, 'YUY', 4, 1, 3465, '2019-10-01', 'ningun', 0, 0, 0, 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
