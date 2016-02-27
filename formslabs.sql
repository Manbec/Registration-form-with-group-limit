-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-02-2016 a las 11:43:36
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `formslabs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `labspace`
--

CREATE TABLE IF NOT EXISTS `labspace` (
`SpaceID` int(11) NOT NULL,
  `Description` varchar(400) DEFAULT NULL,
  `availableSpaces` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `labspace`
--

INSERT INTO `labspace` (`SpaceID`, `Description`, `availableSpaces`) VALUES
(1, 'Laboratorio 1', 20),
(2, 'Laboratorio 2', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `Matricula` varchar(10) NOT NULL,
  `spaceID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registration`
--

INSERT INTO `registration` (`Matricula`, `spaceID`, `Name`, `LastName`) VALUES
('A01222366', 1, 'Manuel', 'Becerra'),
('aoijsioa', 1, 'jshiuga', 'uysgyu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `labspace`
--
ALTER TABLE `labspace`
 ADD PRIMARY KEY (`SpaceID`);

--
-- Indices de la tabla `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`Matricula`,`spaceID`,`Name`,`LastName`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `labspace`
--
ALTER TABLE `labspace`
MODIFY `SpaceID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
