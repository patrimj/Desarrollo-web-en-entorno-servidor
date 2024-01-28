-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-10-2023 a las 17:43:36
-- Versión del servidor: 8.0.34-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemploQB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `Matricula` varchar(10) NOT NULL,
  `Marca` varchar(20) NOT NULL,
  `Modelo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`Matricula`, `Marca`, `Modelo`) VALUES
('100A', 'Citroen', 'C3'),
('200B', 'Citroen', 'C5'),
('300C', 'Peugeot', '205'),
('400D', 'Peugeot', '405'),
('500E', 'Renault', 'Megane'),
('600F', 'Renault', 'Laguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `DNI` varchar(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Tfno` varchar(20) NOT NULL,
  `edad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`DNI`, `Nombre`, `Tfno`, `edad`) VALUES
('10J', 'Manuel', '435', 10),
('11A', 'Patricia', '12432', 234),
('12B', 'Jaime O', '2354345', 21),
('13C', 'Alejandro', '5432534', 23),
('14D', 'Javi V', '234', 34),
('15E', 'Sergio', '324', 435),
('16F', 'Óscar', '45643', 22),
('17G', 'Badre', '436', 43),
('18H', 'Francisco', '4832564', 37),
('19I', 'Inés', '435', 345),
('1A', 'Javi M', '16', 32),
('20J', 'Jaime R', '54879', 326),
('2B', 'Juan', '435', 33),
('3C', 'Laura', '3', 36),
('4D', 'Raúl', '4', 45),
('5E', 'David', '5', 25),
('6F', 'Elena', '6', 30),
('7G', 'Marina', '435', 34),
('8H', 'Ismael', '1234', 31),
('9I', 'Carlos', '1234', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `DNI` varchar(10) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`DNI`, `Matricula`, `id`) VALUES
('1A', '100A', 1),
('1A', '200B', 2),
('2B', '300C', 3),
('3C', '400D', 4),
('4D', '500E', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`Matricula`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
