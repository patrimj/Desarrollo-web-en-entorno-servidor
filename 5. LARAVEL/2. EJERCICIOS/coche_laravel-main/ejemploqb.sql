-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2023 a las 15:50:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemploqb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `Matricula` varchar(10) NOT NULL,
  `Marca` varchar(20) NOT NULL,
  `Modelo` varchar(20) NOT NULL,
  `precio_dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`Matricula`, `Marca`, `Modelo`, `precio_dia`) VALUES
('100A', 'Mercedes', 'CLA 220d AMG', 1),
('200B', 'Citroen', 'C5', 12),
('300C', 'Peugeot', '205', 7),
('400D', 'Peugeot', '405', 12),
('500E', 'Renault', 'Megane', 80),
('600F', 'Renault', 'Laguna', 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `DNI` varchar(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Tfno` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`DNI`, `Nombre`, `Tfno`, `edad`) VALUES
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
('9I', 'Carlos', '1234', 39),
('prueba', 'prueba', '333', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `DNI` varchar(10) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `dias_alquilado` int(11) NOT NULL,
  `entregado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`DNI`, `Matricula`, `id`, `dias_alquilado`, `entregado`) VALUES
('1A', '100A', 1, 30, 1),
('1A', '200B', 2, 12, 0),
('2B', '300C', 3, 3, 0),
('3C', '400D', 4, 6, 0),
('4D', '500E', 5, 8, 0),
('1A', '200B', 6, 10, 1),
('2B', '500E', 7, 10, 1),
('3C', '300C', 10, 10, 1),
('3C', '400D', 11, 10, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
