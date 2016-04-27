-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Apr 2016 um 23:04
-- Server Version: 5.5.24-log
-- PHP-Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `admininmobiliario`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dbimportar`
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
  `refvaloracion` int(11) DEFAULT NULL,
  `refurbanizacion` int(11) DEFAULT NULL,
  `refsector` int(11) DEFAULT NULL,
  `refciudad` int(11) DEFAULT NULL,
  `refprovincia` int(11) DEFAULT NULL,
  `refpais` int(11) DEFAULT NULL,
  `reftipovivienda` int(11) DEFAULT NULL,
  `refusos` smallint(6) DEFAULT NULL,
  `refsituacioninmueble` smallint(6) DEFAULT NULL,
  `refcomision` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idimportar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=99 ;

--
-- Daten für Tabelle `dbimportar`
--

INSERT INTO `dbimportar` (`idimportar`, `dormitorios`, `banios`, `mtsencontruc`, `mts2`, `anioconstruc`, `precioventapropietario`, `nombrepropietario`, `apellidopropietario`, `feccarga`, `calcedadconstruc`, `calcporcdeprec`, `calcavaluoconstruc`, `calcdepreciacion`, `preciorealdeconstruccion`, `calcavaluoterreno`, `calcpreciorealmercado`, `calcrestacliente`, `calcporc`, `valoracion`, `urbanizacion`, `sector`, `ciudad`, `provincia`, `pais`, `tipovivienda`, `usos`, `situacioninmueble`, `usuario`, `comision`, `refvaloracion`, `refurbanizacion`, `refsector`, `refciudad`, `refprovincia`, `refpais`, `reftipovivienda`, `refusos`, `refsituacioninmueble`, `refcomision`) VALUES
(94, 4, 4, '350.00', '1000.00', 2013, '1000000.00', 'Enrique', 'Rodriguez', '2016-02-23', '3.00', '5.00', '227500.00', '11375.00', '216125.00', '440000.00', '440020.00', '-559980.00', '-127.26', 'OPORTUNIDAD', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '4', 1, 4, 0, 5, 3, 2, 1, 1, 2, 4),
(95, 4, 4, '350.00', '500.00', 2010, '550000.00', 'elizabeth', 'montesdeoca', '2016-03-11', '6.00', '10.00', '227500.00', '10.00', '0.00', '220000.00', '220010.00', '-329990.00', '-149.99', 'OPORTUNIDAD', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '1', 1, 4, 0, 5, 3, 2, 1, 1, 2, 1),
(96, 5, 5, '1000.00', '3000.00', 2005, '1450000.00', 'federico', 'terranova', '2016-03-11', '11.00', '18.33', '650000.00', '5.45', '0.00', '1320000.00', '1320005.45', '-129994.55', '-9.85', 'NORMAL', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '5', 2, 4, 0, 5, 3, 2, 1, 1, 2, 5),
(97, 4, 4, '1000.00', '1000.00', 2000, '1500000.00', 'Javier', 'Alesandri', '2016-03-11', '16.00', '26.67', '650000.00', '3.75', '0.00', '440000.00', '440003.75', '-1059996.25', '-240.91', 'OPORTUNIDAD', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '4', 1, 4, 0, 5, 3, 2, 1, 1, 2, 4),
(98, 4, 4, '500.00', '1000.00', 1990, '500000.00', 'Enrique', 'Rodriguez', '2016-03-11', '26.00', '43.33', '325000.00', '2.31', '0.00', '440000.00', '440002.31', '-59997.69', '-13.64', 'NORMAL', 'El Rio', 'Guayaquil', 'Guayaquil', 'Guayas', 'Ecuador', 'casa', 'residencial', 'venta', 'Saupurein Marcos', '4', 2, 4, 0, 5, 3, 2, 1, 1, 2, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
