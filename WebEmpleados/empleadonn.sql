-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2020 a las 19:32:25
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `empleadonn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `cod_dpto` varchar(4) NOT NULL DEFAULT '',
  `nombre_dpto` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`cod_dpto`, `nombre_dpto`) VALUES
('D001', 'Informatica'),
('D002', 'I+D+I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `dni` varchar(9) NOT NULL DEFAULT '',
  `nombre` varchar(40) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `salario` double DEFAULT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`dni`, `nombre`, `apellidos`, `fecha_nac`, `salario`) VALUES
('dni 11', 'asdasd', 'asdasdas', '1995-03-15', 82500),
('DNI12', 'asdas', 'asadsa', '2001-10-03', 20000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple_depart`
--

CREATE TABLE IF NOT EXISTS `emple_depart` (
  `dni` varchar(9) NOT NULL DEFAULT '',
  `cod_dpto` varchar(4) NOT NULL DEFAULT '',
  `fecha_ini` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`dni`,`cod_dpto`,`fecha_ini`),
  KEY `cod_dpto` (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emple_depart`
--

INSERT INTO `emple_depart` (`dni`, `cod_dpto`, `fecha_ini`, `fecha_fin`) VALUES
('dni 11', 'D001', '2020-05-21 12:05:06', '2020-05-21 12:05:44'),
('dni 11', 'D001', '2020-05-21 12:05:44', '2020-05-21 12:05:44'),
('dni 11', 'D001', '2020-05-21 12:05:49', '2020-05-21 12:05:44'),
('dni 11', 'D002', '2020-05-21 00:00:00', '0000-00-00 00:00:00'),
('DNI12', 'D001', '2020-05-20 00:00:00', '0000-00-00 00:00:00');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `emple_depart`
--
ALTER TABLE `emple_depart`
  ADD CONSTRAINT `emple_depart_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`),
  ADD CONSTRAINT `emple_depart_ibfk_2` FOREIGN KEY (`cod_dpto`) REFERENCES `departamento` (`cod_dpto`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
