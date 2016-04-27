-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2016 a las 22:45:40
-- Versión del servidor: 5.1.36-community-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `admininmobiliario2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE IF NOT EXISTS `ciudades` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `refprovincia` smallint(6) NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idciudad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idciudad`, `refprovincia`, `ciudad`) VALUES
(1, 1, 'La Plata'),
(2, 1, 'Pilar'),
(3, 1, 'Lujan'),
(4, 2, 'Caluma'),
(5, 3, 'Guayaquil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE IF NOT EXISTS `comision` (
  `idcomision` smallint(6) NOT NULL AUTO_INCREMENT,
  `comision` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcomision`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `comision`
--

INSERT INTO `comision` (`idcomision`, `comision`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, 'm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costomts`
--

CREATE TABLE IF NOT EXISTS `costomts` (
  `idcostomts` int(11) NOT NULL AUTO_INCREMENT,
  `refprovincia` int(11) DEFAULT NULL,
  `refciudad` int(11) DEFAULT NULL,
  `refsector` int(11) DEFAULT NULL,
  `refurbanizacion` int(11) DEFAULT NULL,
  `refuso` smallint(6) NOT NULL,
  `valormts` decimal(18,2) NOT NULL,
  `fechamodi` date DEFAULT NULL,
  `refusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcostomts`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `costomts`
--

INSERT INTO `costomts` (`idcostomts`, `refprovincia`, `refciudad`, `refsector`, `refurbanizacion`, `refuso`, `valormts`, `fechamodi`, `refusuario`) VALUES
(1, 1, 1, NULL, NULL, 1, '2600.00', '2016-02-11', 1),
(2, 1, 1, NULL, NULL, 1, '95.00', '2016-02-10', 1),
(3, 3, 1, NULL, NULL, 2, '102.00', '2016-02-10', 1),
(4, 1, 1, NULL, NULL, 4, '99.00', '2016-02-10', 1),
(5, 2, 1, NULL, NULL, 2, '780.00', '2016-02-16', 3),
(6, 2, 1, NULL, NULL, 1, '450.00', '2016-02-16', 3),
(8, 3, NULL, NULL, NULL, 3, '482.00', '2016-02-25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costonacional`
--

CREATE TABLE IF NOT EXISTS `costonacional` (
  `idcostonacional` int(11) NOT NULL AUTO_INCREMENT,
  `refpais` smallint(6) NOT NULL,
  `valormts` decimal(18,2) NOT NULL,
  `fechamodi` date DEFAULT NULL,
  `refusuario` smallint(6) NOT NULL,
  PRIMARY KEY (`idcostonacional`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `costonacional`
--

INSERT INTO `costonacional` (`idcostonacional`, `refpais`, `valormts`, `fechamodi`, `refusuario`) VALUES
(1, 1, '2060.00', '2016-02-11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE IF NOT EXISTS `inmuebles` (
  `idinmueble` bigint(20) NOT NULL AUTO_INCREMENT,
  `refurbanizacion` int(11) NOT NULL,
  `reftipovivienda` smallint(6) NOT NULL,
  `refuso` smallint(6) NOT NULL,
  `refsituacioninmueble` smallint(6) NOT NULL,
  `dormitorios` tinyint(4) DEFAULT NULL,
  `banios` tinyint(4) DEFAULT NULL,
  `encontruccion` smallint(6) DEFAULT NULL,
  `mts2` decimal(18,2) DEFAULT NULL,
  `anioconstruccion` tinyint(4) DEFAULT NULL,
  `precioventapropietario` decimal(18,2) DEFAULT NULL,
  `nombrepropietario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidopropietario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacarga` date DEFAULT NULL,
  `refusuario` int(11) NOT NULL,
  `refcomision` tinyint(4) NOT NULL,
  `calc_edadconstruccion` decimal(18,2) DEFAULT NULL,
  `calc_porcentajedepreciacion` decimal(10,2) DEFAULT NULL,
  `calc_avaluoconstruccion` decimal(18,2) DEFAULT NULL,
  `calc_depreciacion` decimal(18,2) DEFAULT NULL,
  `calc_avaluoterreno` decimal(18,2) DEFAULT NULL,
  `calc_preciorealmercado` decimal(18,2) DEFAULT NULL,
  `calc_restacliente` decimal(18,2) DEFAULT NULL,
  `calc_porcentaje` decimal(18,2) DEFAULT NULL,
  `refvaloracion` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idinmueble`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`idinmueble`, `refurbanizacion`, `reftipovivienda`, `refuso`, `refsituacioninmueble`, `dormitorios`, `banios`, `encontruccion`, `mts2`, `anioconstruccion`, `precioventapropietario`, `nombrepropietario`, `apellidopropietario`, `fechacarga`, `refusuario`, `refcomision`, `calc_edadconstruccion`, `calc_porcentajedepreciacion`, `calc_avaluoconstruccion`, `calc_depreciacion`, `calc_avaluoterreno`, `calc_preciorealmercado`, `calc_restacliente`, `calc_porcentaje`, `refvaloracion`) VALUES
(1, 1, 1, 1, 2, 2, 1, 100, '250.00', 127, '550450.00', 'Pato', 'Toranzo', '2016-02-11', 1, 4, '5.00', '8.33', '206000.00', '12.00', '650000.00', '650012.00', '99562.00', '15.32', 2),
(2, 2, 1, 1, 2, 2, 1, 80, '120.00', 127, '400500.00', 'kok', 'pop', '2016-02-16', 1, 3, '26.00', '43.33', '164800.00', '2.31', '312000.00', '312002.31', '-88497.69', '-28.36', 1),
(3, 3, 9, 2, 2, 1, 1, 70, '70.00', 127, '10653.00', 'Gaston', 'Braque', '2016-02-16', 2, 1, '1889.00', '3148.33', '144200.00', '0.03', '54600.00', '54600.03', '43947.03', '80.49', 4),
(4, 3, 1, 1, 2, 5, 2, 220, '400.00', 127, '3488210.00', 'lol', 'qew', '2016-02-16', 1, 1, '41.00', '68.33', '453200.00', '1.46', '180000.00', '180001.46', '-3308208.54', '-1837.88', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueblesituacioninmueble`
--

CREATE TABLE IF NOT EXISTS `inmueblesituacioninmueble` (
  `idinmueblesituacioninmueble` int(11) NOT NULL AUTO_INCREMENT,
  `refinmueble` int(11) NOT NULL,
  `refsituacioninmueble` int(11) NOT NULL,
  PRIMARY KEY (`idinmueblesituacioninmueble`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(12, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador'),
(13, '../index.php', 'icodashboard', 'Dashboard', 0, NULL, 'Administrador'),
(16, '../paises/', 'icoclientes', 'Paises', 15, NULL, 'Administrador'),
(17, '../provincias/', 'icoinmubles', 'Provincias', 16, NULL, 'Administrador'),
(18, '../ciudades/', 'icoalquileres', 'Ciudades', 17, NULL, 'Administrador'),
(19, '../urbanizacion/', 'icopagos', 'Urbanización', 19, NULL, 'Administrador'),
(20, '../usuarios/', 'icousuarios', 'Usuarios', 28, NULL, 'Administrador'),
(21, '../reportes/', 'icoreportes', 'Reportes', 29, NULL, 'Administrador'),
(22, '../comision/', 'icosalir', 'Comisión', 14, NULL, 'Administrador'),
(23, '../costomts/', 'icodashboard', 'Costo Mtrs', 1, NULL, 'Administrador'),
(24, '../costonacional/', 'icoclientes', 'Costo Nacional', 2, NULL, 'Administrador'),
(25, '../inmuebles/', 'icoinmubles', 'Inmuebles', 9, NULL, 'Administrador'),
(26, '../pedidos/', 'icoalquileres', 'Pedidos', 10, NULL, 'Administrador'),
(27, '../perfiles/', 'icopagos', 'Perfiles', 11, NULL, 'Administrador'),
(28, '../situaciones/', 'icousuarios', 'Situaciones', 7, NULL, 'Administrador'),
(29, '../situacioninmueble/', 'icoreportes', 'Situación Inmueble', 8, NULL, 'Administrador'),
(30, '../tipoinformacion/', 'icopagos', 'Tipo Información', 3, NULL, 'Administrador'),
(31, '../tipousuarios/', 'icopagos', 'Tipo Usuarios', 12, NULL, 'Administrador'),
(32, '../tipovivienda/', 'icopagos', 'Tipo Vivienda', 4, NULL, 'Administrador'),
(33, '../usos/', 'icopagos', 'Usos', 5, NULL, 'Administrador'),
(34, '../usuariosregistrados/', 'icousuarios', 'Usuarios Registrados', 13, NULL, 'Administrador'),
(35, '../valoracion/', 'icopagos', 'Valoración', 6, NULL, 'Administrador'),
(36, '../sector/', 'icoalquileres', 'Sector', 18, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `idpais` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idpais`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Ecuador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `reftipoinformacion` smallint(6) NOT NULL,
  `refinmueble` bigint(20) NOT NULL,
  `refusuario` int(11) NOT NULL,
  `fechapedido` date DEFAULT NULL,
  `comentariousuario` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `idperfil` smallint(6) NOT NULL AUTO_INCREMENT,
  `reftipousuario` smallint(6) NOT NULL,
  `nombreperfil` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idperfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idperfil`, `reftipousuario`, `nombreperfil`) VALUES
(1, 1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `idprovincia` smallint(6) NOT NULL AUTO_INCREMENT,
  `refpais` smallint(6) NOT NULL,
  `provincia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idprovincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idprovincia`, `refpais`, `provincia`) VALUES
(1, 1, 'Buenos Aires'),
(2, 2, 'Bolívar'),
(3, 2, 'Guayas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE IF NOT EXISTS `regiones` (
  `idregion` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idregion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`idregion`, `region`) VALUES
(1, 'paises'),
(2, 'provincias'),
(3, 'ciudades'),
(4, 'sector'),
(5, 'urbanizacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `idsector` int(11) NOT NULL AUTO_INCREMENT,
  `refciudad` int(11) NOT NULL,
  `sector` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idsector`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`idsector`, `refciudad`, `sector`) VALUES
(1, 1, 'La Plata'),
(2, 5, 'Samborombon'),
(4, 5, 'Cruz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situaciones`
--

CREATE TABLE IF NOT EXISTS `situaciones` (
  `idsituacion` smallint(6) NOT NULL AUTO_INCREMENT,
  `situacion` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idsituacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `situaciones`
--

INSERT INTO `situaciones` (`idsituacion`, `situacion`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'pendiente'),
(4, 'dar de baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacioninmueble`
--

CREATE TABLE IF NOT EXISTS `situacioninmueble` (
  `idsituacioninmueble` smallint(6) NOT NULL AUTO_INCREMENT,
  `situacioninmueble` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idsituacioninmueble`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `situacioninmueble`
--

INSERT INTO `situacioninmueble` (`idsituacioninmueble`, `situacioninmueble`) VALUES
(1, 'renta'),
(2, 'venta'),
(3, 'trueque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeinformacion`
--

CREATE TABLE IF NOT EXISTS `tipodeinformacion` (
  `idtipodeinformacion` smallint(6) NOT NULL AUTO_INCREMENT,
  `tipodeinformacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipodeinformacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipodeinformacion`
--

INSERT INTO `tipodeinformacion` (`idtipodeinformacion`, `tipodeinformacion`) VALUES
(1, 'propiedad'),
(2, 'proyecto inmoviliario'),
(3, 'requerimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE IF NOT EXISTS `tipousuarios` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tipousuarios`
--

INSERT INTO `tipousuarios` (`idtipousuario`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Propietario'),
(3, 'Corredor Inmoviliario'),
(4, 'Agencia'),
(5, 'Constructora'),
(6, 'Outsorcing de Ventas'),
(7, 'Avaluador'),
(8, 'Referidor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipovivienda`
--

CREATE TABLE IF NOT EXISTS `tipovivienda` (
  `idtipovivienda` smallint(6) NOT NULL AUTO_INCREMENT,
  `tipovivienda` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipovivienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tipovivienda`
--

INSERT INTO `tipovivienda` (`idtipovivienda`, `tipovivienda`) VALUES
(1, 'casa'),
(2, 'departamento'),
(3, 'suite'),
(4, 'oficina'),
(5, 'bodega'),
(6, 'terreno'),
(7, 'edificio'),
(8, 'finca '),
(9, 'local comercial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urbanizacion`
--

CREATE TABLE IF NOT EXISTS `urbanizacion` (
  `idurbanizacion` int(11) NOT NULL AUTO_INCREMENT,
  `refsector` int(11) NOT NULL,
  `urbanizacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idurbanizacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `urbanizacion`
--

INSERT INTO `urbanizacion` (`idurbanizacion`, `refsector`, `urbanizacion`) VALUES
(1, 1, 'Ensenada'),
(2, 1, 'La Plata'),
(3, 4, 'Caluma'),
(4, 2, 'El Rio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usos`
--

CREATE TABLE IF NOT EXISTS `usos` (
  `iduso` smallint(6) NOT NULL AUTO_INCREMENT,
  `usos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`iduso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usos`
--

INSERT INTO `usos` (`iduso`, `usos`) VALUES
(1, 'residencial'),
(2, 'comercial'),
(3, 'agricola'),
(4, 'industrial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosregistrados`
--

CREATE TABLE IF NOT EXISTS `usuariosregistrados` (
  `idusuarioregistrado` int(11) NOT NULL AUTO_INCREMENT,
  `fechadeingreso` date DEFAULT NULL,
  `reftipousuario` int(11) NOT NULL,
  `apellidoynombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nombreentidad` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular1` varchar(14) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular2` varchar(14) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular3` varchar(14) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refsituacion` smallint(6) DEFAULT NULL,
  `refurbanizacion` int(11) DEFAULT NULL,
  `calle` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nro` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codpostal` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `documento` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idusuarioregistrado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuariosregistrados`
--

INSERT INTO `usuariosregistrados` (`idusuarioregistrado`, `fechadeingreso`, `reftipousuario`, `apellidoynombre`, `nombreentidad`, `celular1`, `celular2`, `celular3`, `email1`, `email2`, `refsituacion`, `refurbanizacion`, `calle`, `nro`, `codpostal`, `documento`, `password`) VALUES
(1, '2016-01-01', 1, 'Saupurein Marcos', 'Caracol', NULL, NULL, NULL, 'msredhotero@msn.com', NULL, 1, 1, '76', '123', '1900', '31552466', 'm'),
(2, '2016-02-09', 3, 'Martinoli Alexandra', 'Alex', '1564983215', '', '', 'alex@msn.com', '', 1, 2, '16', '846', '1900', '25444666', 'alex'),
(3, '2016-02-11', 7, 'Kike', 'Caracol', '1651894', '', '', 'kike@msn.com', '', 1, 2, '45', '849', '1900', '17849561', 'kike');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE IF NOT EXISTS `valoracion` (
  `idvaloracion` smallint(6) NOT NULL AUTO_INCREMENT,
  `valoracion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desde` int(11) DEFAULT NULL,
  `hasta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idvaloracion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`idvaloracion`, `valoracion`, `observacion`, `desde`, `hasta`) VALUES
(1, '< -20%', 'OPORTUNIDAD', -9999999, -20),
(2, '> -20% Y < 20%', 'NORMAL', -21, 20),
(3, '> 21% Y <30%', 'CARO', 21, 30),
(4, '>31%', 'FUERA DEL MERCADO', 31, 9999999);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
