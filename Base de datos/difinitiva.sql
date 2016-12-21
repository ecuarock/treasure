-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2013 a las 03:35:17
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `treasure`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE IF NOT EXISTS `bodega` (
  `ID_BODEGA` int(11) NOT NULL AUTO_INCREMENT,
  `UBICACION` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_BODEGA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`ID_BODEGA`, `UBICACION`) VALUES
(1, 'Bodega Barco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `ID_DEPARTAMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_DEPARTAMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`ID_DEPARTAMENTO`, `NOMBRE`, `DESCRIPCION`) VALUES
(1, 'Cocina', 'Productos Cocina Viveres'),
(2, 'Maquinas', 'Productos Para Maquinas'),
(3, 'AMA DE LLAVES', 'Productos de Limpieza'),
(4, 'SECCIÓN BAR', 'Seccion de Bar'),
(5, 'RECEPCION ', 'Productos para Huespedes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

CREATE TABLE IF NOT EXISTS `despacho` (
  `ID_DESPACHO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int(11) NOT NULL,
  `DIA` int(11) NOT NULL,
  `MES` int(11) NOT NULL,
  `ANIO` int(11) NOT NULL,
  `HORA` int(11) NOT NULL,
  `MINUTO` int(11) NOT NULL,
  PRIMARY KEY (`ID_DESPACHO`),
  KEY `ID_USUARIO` (`ID_USUARIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `ID_PEDIDO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int(11) NOT NULL,
  `DIA` int(11) NOT NULL,
  `MES` int(11) NOT NULL,
  `ANIO` int(11) NOT NULL,
  `HORA` int(11) NOT NULL,
  `MINUTO` int(11) NOT NULL,
  PRIMARY KEY (`ID_PEDIDO`),
  KEY `FK_REALIZA` (`ID_USUARIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_despacho_x_producto`
--

CREATE TABLE IF NOT EXISTS `pedido_despacho_x_producto` (
  `ID_PDXP` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `ID_DESPACHO` int(11) DEFAULT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `ESTADO` enum('PEDIDO','CANCELADO','APROBADO','EN PROCESO','COMPRADO','ENVIADO','ENTREGADO') COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_PDXP`),
  KEY `FK_GENERA` (`ID_PEDIDO`),
  KEY `FK_PROBOCA` (`ID_DESPACHO`),
  KEY `FK_REFERENCIA` (`ID_PRODUCTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `ID_PERFIL` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_PERFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`ID_PERFIL`, `NOMBRE`, `DESCRIPCION`) VALUES
(1, 'administrador', 'El encargado de administración del sitio.'),
(2, 'solicitante', 'La persona que genera los pedidos para ser procesados.'),
(3, 'aprovador', 'La persona que administra los pedidos y puede cambiarlos en 3 estados: solicitado, aprobado, cancelado.'),
(4, 'controlador', 'La persona que revisa los estados de los despachos.'),
(5, 'proveedor', 'La persona que genera y cambia el estado a los despachos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DEPARTAMENTO` int(11) NOT NULL,
  `DESCRIPCION` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_PRODUCTO`),
  KEY `FK_TIENE` (`ID_DEPARTAMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=141 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `ID_DEPARTAMENTO`, `DESCRIPCION`) VALUES
(1, 1, 'CEBOLLA BLANCA (Atados)'),
(2, 1, 'APIO (Atados)'),
(3, 1, 'NABO CHINO (Atados)'),
(4, 1, 'HABAS PELADAS 500 gr'),
(5, 1, 'CHOCLO DESGRANADO 500 gr'),
(6, 1, 'FREJOL 500 gr'),
(7, 1, 'ARVERJA 500 gr'),
(8, 1, 'VAINITAS (Fundas)'),
(9, 1, 'RABANOS (Fundas)'),
(10, 1, 'MELLOCOS (Fundas)'),
(11, 1, 'AJO (Fundas)'),
(12, 1, 'ZAPALLO 1 kg'),
(13, 1, 'OREGANO (Fundas)'),
(14, 1, 'COLIFLOR'),
(15, 1, 'BROCOLI'),
(16, 1, 'ESPINACA 1 Kg'),
(17, 1, 'PEREJIL (Atados)'),
(18, 1, 'CULANTRO (Atados)'),
(19, 1, 'ALBACA (Atados)'),
(20, 1, 'MOTE 1 Kg'),
(21, 1, 'SUKINI VERDE'),
(22, 1, 'SUKINI AMARILLO'),
(23, 1, 'LECHUGAS'),
(24, 1, 'COL VERDE '),
(25, 1, 'COL MORADA'),
(26, 1, 'PLATANO VERDE'),
(27, 1, 'YUCAS '),
(28, 1, 'MELONES'),
(29, 1, 'COL DE BRUCELAS 1Kg'),
(30, 1, 'PAN INTEGRAL'),
(31, 1, 'PAN VARIOS'),
(32, 1, 'PAN CEREALES'),
(33, 1, 'DULCE DE HIGOS'),
(34, 1, 'HUMITAS DE SAL'),
(35, 1, 'LIMONES '),
(36, 1, 'ZUMO LIMON'),
(37, 1, 'PEPINOS'),
(38, 1, 'AGUACATES'),
(39, 1, 'BABACOS'),
(40, 1, 'FRUTILLAS 1 Kg'),
(41, 1, 'PI?AS'),
(42, 1, 'UVAS ROSADAS 1 Libra'),
(43, 1, 'UVAS VERDES 1 Libra'),
(44, 1, 'CEBOLLA PERLA 1 Kg'),
(45, 1, 'PAPANAVO 1 Kg'),
(46, 1, 'CEBOLLA PAITE?A 1 Kg'),
(47, 1, 'ESPARRAGOS'),
(48, 1, 'ZANAHORIA 1 Kg'),
(49, 1, 'TOMATE DE ARBOL'),
(50, 1, 'GARBANZO '),
(51, 1, 'KIWI'),
(52, 1, 'NARANJILLA'),
(53, 1, 'SALAMI'),
(54, 1, 'TOMATE RI?ON 1 Kg'),
(55, 1, 'PIMIENTO VERDE '),
(56, 1, 'CHOCHOS'),
(57, 1, 'GENGIBRE'),
(58, 1, 'PIMIENTO ROJO'),
(59, 1, 'PIMIENTO AMARILLO'),
(60, 1, 'REMOLACHA 1 Kg'),
(61, 1, 'BERENGENA'),
(62, 1, 'ACELGA'),
(63, 1, 'PECHUGAS DE PAVO '),
(64, 1, 'QUESO PARMESANO'),
(65, 1, 'SALMON'),
(66, 1, 'TILAPIA'),
(67, 1, 'CAMARON GRANDE 1 Libra'),
(68, 1, 'LANGOSTINO 1 Kg'),
(69, 1, 'CORVINA 1 Kg'),
(70, 1, 'PIZZA'),
(71, 1, 'CHULETAS AHUMADAS'),
(72, 1, 'QUESO MOZARELLA'),
(73, 1, 'PICUDO 1 Kg'),
(74, 1, 'FIEMBRE DE CERDO'),
(75, 1, 'ALITAS BBQ'),
(76, 1, 'JAMON ESPALDA 1 gr'),
(77, 1, 'MUCHINES DE YUCA (Fundas)'),
(78, 1, 'PAN DE YUCA (Fundas)'),
(79, 1, 'PULPAS BLOQUE '),
(80, 1, 'JAMON ESPECIAL 1 gr'),
(81, 1, 'QUESO HIERBAS (bloque)'),
(82, 1, 'YOGURT NATURAL 1 ltr'),
(83, 1, 'HELADOS'),
(84, 1, 'QUESO CREMA'),
(85, 1, 'MANTEQUILLA'),
(86, 1, 'EMPANADAS DE VERDE (bandejas)'),
(87, 1, 'MANZANA VERDE'),
(88, 1, 'TOMATE DE ARBOL'),
(89, 1, 'MANZANA ROJA'),
(90, 1, 'MANDARINAS'),
(91, 1, 'PERAS'),
(92, 2, 'bombas de agua '),
(93, 2, 'fltro 2020 '),
(94, 2, 'filtro 2010'),
(95, 2, 'filtro 35746'),
(96, 2, 'filtros 8335'),
(97, 2, 'filtros 3335'),
(98, 2, 'filtro desalinizadora'),
(99, 2, 'filtro 2821'),
(100, 2, 'filtro 8427'),
(101, 3, 'caja de jabon'),
(102, 3, 'sabana bajera'),
(103, 3, 'toalla de mano '),
(104, 3, 'cortinas de baño'),
(105, 3, 'Almohadas'),
(106, 3, 'salidas de baño'),
(107, 3, 'toalla de cara'),
(108, 3, 'toalla de playa'),
(109, 3, 'toalla de baño'),
(110, 3, 'sabana encimera'),
(111, 3, 'forro almohadas'),
(112, 3, 'caja de shampoo'),
(113, 3, 'caja de rinse'),
(114, 4, 'ron 750 ml'),
(115, 4, 'Vodka 750 ml'),
(116, 4, 'wisky jack daniel 750 ml'),
(117, 4, 'wisky jhonny negro 750 ml'),
(118, 4, 'vino tinto reservado 750 ml'),
(119, 4, 'vino tinto de la casa 750 ml'),
(120, 4, 'vino blanco reservado 750 ml'),
(121, 4, 'vino blanco de la casa 750 ml'),
(122, 4, 'Ginebra 750 ml'),
(123, 4, 'wisky jhonny rojo 750 ml'),
(124, 4, 'ron blanco 750 ml'),
(125, 4, 'ron dorado 750 ml'),
(126, 4, 'tequila reposado 750 ml'),
(127, 4, 'Amaretto 750 ml'),
(128, 4, 'licor de café 750 ml'),
(129, 4, 'licor de menta 750 ml'),
(130, 4, 'curacao azul 750 ml'),
(131, 5, 'aletas '),
(132, 5, 'Visores'),
(133, 5, 'chapas cabinas'),
(134, 5, 'trajes buceo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_x_bodega`
--

CREATE TABLE IF NOT EXISTS `producto_x_bodega` (
  `ID_PXB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PRODUCTO` int(11) NOT NULL,
  `ID_BODEGA` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  PRIMARY KEY (`ID_PXB`),
  UNIQUE KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  KEY `FK_ALMACENA` (`ID_BODEGA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=135 ;

--
-- Volcado de datos para la tabla `producto_x_bodega`
--

INSERT INTO `producto_x_bodega` (`ID_PXB`, `ID_PRODUCTO`, `ID_BODEGA`, `CANTIDAD`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 2),
(3, 3, 1, 2),
(4, 4, 1, 3),
(5, 5, 1, 3),
(6, 6, 1, 3),
(7, 7, 1, 2),
(8, 8, 1, 6),
(9, 9, 1, 4),
(10, 10, 1, 4),
(11, 11, 1, 6),
(12, 12, 1, 2),
(13, 13, 1, 1),
(14, 14, 1, 10),
(15, 15, 1, 10),
(16, 16, 1, 1),
(17, 17, 1, 2),
(18, 18, 1, 4),
(19, 19, 1, 4),
(20, 20, 1, 2),
(21, 21, 1, 7),
(22, 22, 1, 8),
(23, 23, 1, 14),
(24, 24, 1, 3),
(25, 25, 1, 2),
(26, 26, 1, 40),
(27, 27, 1, 6),
(28, 28, 1, 7),
(29, 29, 1, 2),
(30, 30, 1, 6),
(31, 31, 1, 50),
(32, 32, 1, 2),
(33, 33, 1, 5),
(34, 34, 1, 24),
(35, 35, 1, 100),
(36, 36, 1, 2),
(37, 37, 1, 20),
(38, 38, 1, 15),
(39, 39, 1, 4),
(40, 40, 1, 2),
(41, 41, 1, 1),
(42, 42, 1, 6),
(43, 43, 1, 6),
(44, 44, 1, 3),
(45, 45, 1, 3),
(46, 46, 1, 5),
(47, 47, 1, 4),
(48, 48, 1, 5),
(49, 49, 1, 25),
(50, 50, 1, 3),
(51, 51, 1, 30),
(52, 52, 1, 20),
(53, 53, 1, 1),
(54, 54, 1, 9),
(55, 55, 1, 15),
(56, 56, 1, 2),
(57, 57, 1, 1),
(58, 58, 1, 15),
(59, 59, 1, 10),
(60, 60, 1, 6),
(61, 61, 1, 7),
(62, 62, 1, 1),
(63, 63, 1, 1),
(64, 64, 1, 2),
(65, 65, 1, 2),
(66, 66, 1, 25),
(67, 67, 1, 9),
(68, 68, 1, 5),
(69, 69, 1, 3),
(70, 70, 1, 2),
(71, 71, 1, 3),
(72, 72, 1, 5),
(73, 73, 1, 2),
(74, 74, 1, 3),
(75, 75, 1, 2),
(76, 76, 1, 500),
(77, 77, 1, 3),
(78, 78, 1, 2),
(79, 79, 1, 24),
(80, 80, 1, 900),
(81, 81, 1, 1),
(82, 82, 1, 2),
(83, 83, 1, 4),
(84, 84, 1, 4),
(85, 85, 1, 6),
(86, 86, 1, 2),
(87, 87, 1, 30),
(88, 88, 1, 30),
(89, 89, 1, 30),
(90, 90, 1, 30),
(91, 91, 1, 30),
(92, 92, 1, 1),
(93, 93, 1, 10),
(94, 94, 1, 9),
(95, 95, 1, 9),
(96, 96, 1, 1),
(97, 97, 1, 5),
(98, 98, 1, 4),
(99, 99, 1, 7),
(100, 100, 1, 8),
(101, 101, 1, 0),
(102, 102, 1, 9),
(103, 103, 1, 8),
(104, 104, 1, 8),
(105, 105, 1, 0),
(106, 106, 1, 7),
(107, 107, 1, 3),
(108, 108, 1, 5),
(109, 109, 1, 5),
(110, 110, 1, 4),
(111, 111, 1, 0),
(112, 112, 1, 9),
(113, 113, 1, 1),
(114, 114, 1, 4),
(115, 115, 1, 9),
(116, 116, 1, 9),
(117, 117, 1, 9),
(118, 118, 1, 9),
(119, 119, 1, 1),
(120, 120, 1, 8),
(121, 121, 1, 10),
(122, 122, 1, 1),
(123, 123, 1, 2),
(124, 124, 1, 7),
(125, 125, 1, 1),
(126, 126, 1, 4),
(127, 127, 1, 5),
(128, 128, 1, 4),
(129, 129, 1, 5),
(130, 130, 1, 6),
(131, 131, 1, 10),
(132, 132, 1, 3),
(133, 133, 1, 9),
(134, 134, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERFIL` int(11) NOT NULL,
  `ID_DEPARTAMENTO` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `APELLIDO` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `USUARIO` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `CONTRASENIA` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `ESTADO` enum('Activo','Inactivo') COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  KEY `FK_POSEE` (`ID_PERFIL`),
  KEY `ID_DEPARTAMENTO` (`ID_DEPARTAMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `ID_PERFIL`, `ID_DEPARTAMENTO`, `NOMBRE`, `APELLIDO`, `USUARIO`, `CONTRASENIA`, `ESTADO`) VALUES
(1, 1, NULL, 'administrador', 'administrador', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(2, 2, 1, 'OSWALDO', 'CASTILLO', 'ocastillo', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(3, 2, 2, 'JOSE', 'HIDALGO', 'jhidalgo', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(4, 2, 3, 'LIGIA', 'GOMEZ', 'lgomez', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(5, 2, 4, 'JULIO', 'HERRERA', 'jherrera', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(6, 2, 5, 'JULIO', 'PACHAY', 'jpachay', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(7, 4, NULL, 'HECTOR', 'QUINTERO', 'hquintero', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(8, 3, NULL, 'JULIO', 'PACHAY', 'jpachayaprovador', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(9, 5, NULL, 'JUAN', 'NIETO', 'jnieto', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(47, 1, NULL, 'Juan', 'Nieto', 'jnietoadmin', 'e10adc3949ba59abbe56e057f20f883e', 'Activo');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `despacho_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_REALIZA` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `pedido_despacho_x_producto`
--
ALTER TABLE `pedido_despacho_x_producto`
  ADD CONSTRAINT `FK_GENERA` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedido` (`ID_PEDIDO`),
  ADD CONSTRAINT `FK_PROBOCA` FOREIGN KEY (`ID_DESPACHO`) REFERENCES `despacho` (`ID_DESPACHO`),
  ADD CONSTRAINT `FK_REFERENCIA` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_TIENE` FOREIGN KEY (`ID_DEPARTAMENTO`) REFERENCES `departamento` (`ID_DEPARTAMENTO`);

--
-- Filtros para la tabla `producto_x_bodega`
--
ALTER TABLE `producto_x_bodega`
  ADD CONSTRAINT `FK_ALMACENA` FOREIGN KEY (`ID_BODEGA`) REFERENCES `bodega` (`ID_BODEGA`),
  ADD CONSTRAINT `FK_CONTIENE` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_PERTENECE` FOREIGN KEY (`ID_DEPARTAMENTO`) REFERENCES `departamento` (`ID_DEPARTAMENTO`),
  ADD CONSTRAINT `FK_POSEE` FOREIGN KEY (`ID_PERFIL`) REFERENCES `perfil` (`ID_PERFIL`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
