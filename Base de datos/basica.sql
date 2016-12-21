-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2013 a las 05:05:26
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

DROP TABLE IF EXISTS `bodega`;
CREATE TABLE IF NOT EXISTS `bodega` (
  `ID_BODEGA` int(11) NOT NULL AUTO_INCREMENT,
  `UBICACION` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_BODEGA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `ID_DEPARTAMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_DEPARTAMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

DROP TABLE IF EXISTS `despacho`;
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

DROP TABLE IF EXISTS `pedido`;
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

DROP TABLE IF EXISTS `pedido_despacho_x_producto`;
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

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `ID_PERFIL` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_PERFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DEPARTAMENTO` int(11) NOT NULL,
  `DESCRIPCION` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID_PRODUCTO`),
  KEY `FK_TIENE` (`ID_DEPARTAMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_x_bodega`
--

DROP TABLE IF EXISTS `producto_x_bodega`;
CREATE TABLE IF NOT EXISTS `producto_x_bodega` (
  `ID_PXB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PRODUCTO` int(11) NOT NULL,
  `ID_BODEGA` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  PRIMARY KEY (`ID_PXB`),
  UNIQUE KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  KEY `FK_ALMACENA` (`ID_BODEGA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=35 ;

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


--
-- Base de datos: `treasure`
--

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`ID_PERFIL`, `NOMBRE`, `DESCRIPCION`) VALUES
(1, 'administrador', 'El encargado de administración del sitio.'),
(2, 'solicitante', 'La persona que genera los pedidos para ser procesados.'),
(3, 'aprovador', 'La persona que administra los pedidos y puede cambiarlos en 3 estados: solicitado, aprobado, cancelado.'),
(4, 'controlador', 'La persona que revisa los estados de los despachos.'),
(5, 'proveedor', 'La persona que genera y cambia el estado a los despachos.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Base de datos: `treasure`
--

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `ID_PERFIL`, `ID_DEPARTAMENTO`, `NOMBRE`, `APELLIDO`, `USUARIO`, `CONTRASENIA`, `ESTADO`) VALUES
(1, 1, NULL, 'administradoruno', 'administradoruno', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Activo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
