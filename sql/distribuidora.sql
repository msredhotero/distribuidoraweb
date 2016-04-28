-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Apr 2016 um 22:12
-- Server Version: 5.5.24-log
-- PHP-Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `distribuidora`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `refroll` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombrecompleto` varchar(70) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroll`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'm', 1, 'msredhotero@msn.com', 'Saupurein Marcos'),
(2, '', 'luis', 2, 'luis@msn.com', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(12, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador, Capturista, Supervisor'),
(13, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador, Capturista, Supervisor'),
(16, '../clientes/', 'icoclientes', 'Clientes', 2, NULL, 'Administrador, Capturista, Supervisor'),
(17, '../empresas/', 'icoinmubles', 'Empresas', 3, NULL, 'Administrador, Capturista, Supervisor'),
(18, '../facturas/', 'icoalquileres', 'Facturas', 4, NULL, 'Administrador, Capturista, Supervisor'),
(19, '../pagos/', 'icopagos', 'Pagos', 5, NULL, 'Administrador, Capturista, Supervisor'),
(20, '../usuarios/', 'icousuarios', 'Usuarios', 6, NULL, 'Administrador, Capturista');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbestatus`
--

CREATE TABLE IF NOT EXISTS `tbestatus` (
  `idestatu` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idestatu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tbestatus`
--

INSERT INTO `tbestatus` (`idestatu`, `estatus`) VALUES
(1, 'No Pagado'),
(2, 'Parcial'),
(3, 'Pagado');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Capturista', b'1'),
(3, 'Supervisor', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
