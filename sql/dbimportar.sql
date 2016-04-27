-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2016 a las 07:51:36
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `admininmobiliario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbimportar`
--

CREATE TABLE IF NOT EXISTS `dbimportar` (
  `idimportar` int(11) NOT NULL AUTO_INCREMENT,
  `dormitorios` int(11) DEFAULT NULL,
  `banios` smallint(6) DEFAULT NULL,
  `mtsencontruc` decimal(18,2) DEFAULT NULL,
  `mts2` decimal(18,2) DEFAULT NULL,
  `anioconstruc` smallint(6) DEFAULT NULL,
  `precioventapropietario` decimal(18,2) DEFAULT NULL,
  `nombrepropietario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidopropietario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `feccarga` date DEFAULT NULL,
  `calcedadconstruc` decimal(18,2) DEFAULT NULL,
  `calcporcdeprec` decimal(18,2) DEFAULT NULL,
  `calcavaluoconstruc` decimal(18,2) DEFAULT NULL,
  `calcdepreciacion` decimal(18,2) DEFAULT NULL,
  `preciorealdeconstruccion` decimal(18,2) DEFAULT NULL,
  `calcavaluoterreno` decimal(18,2) DEFAULT NULL,
  `calcpreciorealmercado` decimal(18,2) DEFAULT NULL,
  `calcrestacliente` decimal(18,2) DEFAULT NULL,
  `calcporc` decimal(18,2) DEFAULT NULL,
  `valoracion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `urbanizacion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sector` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipovivienda` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usos` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `situacioninmueble` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comision` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idimportar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `dbimportar`
--

INSERT INTO `dbimportar` (`idimportar`, `dormitorios`, `banios`, `mtsencontruc`, `mts2`, `anioconstruc`, `precioventapropietario`, `nombrepropietario`, `apellidopropietario`, `feccarga`, `calcedadconstruc`, `calcporcdeprec`, `calcavaluoconstruc`, `calcdepreciacion`, `preciorealdeconstruccion`, `calcavaluoterreno`, `calcpreciorealmercado`, `calcrestacliente`, `calcporc`, `valoracion`, `urbanizacion`, `sector`, `ciudad`, `provincia`, `pais`, `tipovivienda`, `usos`, `situacioninmueble`, `usuario`, `comision`) VALUES
(19, 4, 4, '350.00', '1000.00', 2013, '1000000.00', 'Enrique', 'Rodriguez', '0000-00-00', '3.00', '5.00', '227500.00', '11375.00', '216125.00', '440000.00', '440020.00', '-559980.00', '-127.26', 'OPORTUNIDAD', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '4'),
(20, 4, 4, '350.00', '500.00', 2010, '550000.00', 'elizabeth', 'montesdeoca', '2003-11-16', '6.00', '10.00', '227500.00', '10.00', '0.00', '220000.00', '220010.00', '-329990.00', '-149.99', 'OPORTUNIDAD', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '1'),
(21, 5, 5, '1000.00', '3000.00', 2005, '1450000.00', 'federico', 'terranova', '2003-11-16', '11.00', '18.33', '650000.00', '5.45', '0.00', '1320000.00', '1320005.45', '-129994.55', '-9.85', 'NORMAL', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '5'),
(22, 4, 4, '1000.00', '1000.00', 2000, '1500000.00', 'Javier', 'Alesandri', '2003-11-16', '16.00', '26.67', '650000.00', '3.75', '0.00', '440000.00', '440003.75', '-1059996.25', '-240.91', 'OPORTUNIDAD', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '4'),
(23, 4, 4, '500.00', '1000.00', 1990, '500000.00', 'Enrique', 'Rodriguez', '2003-11-16', '26.00', '43.33', '325000.00', '2.31', '0.00', '440000.00', '440002.31', '-59997.69', '-13.64', 'NORMAL', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
