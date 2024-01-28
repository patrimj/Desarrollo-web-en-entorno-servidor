-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2023 a las 21:33:13
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
-- Base de datos: `bbdd_laravel_ejerCoches`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `DNI` varchar(10) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `dias` int(11) NOT NULL,
  `entregado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`DNI`, `Matricula`, `id`, `dias`, `entregado`) VALUES
('1A', '100A', 1, 2, 1),
('1A', '200B', 2, 3, 0),
('2B', '300C', 3, 4, 1),
('3C', '400D', 4, 5, 0),
('4D', '500E', 5, 6, 1),
('2B', '300C', 6, 6, 1),
('3C', '400D', 7, 6, 1),
('4D', '500E', 8, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `Matricula` varchar(10) NOT NULL,
  `Marca` varchar(20) NOT NULL,
  `Modelo` varchar(20) NOT NULL,
  `PrecioDia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`Matricula`, `Marca`, `Modelo`, `PrecioDia`) VALUES
('1000J', 'Seat', 'Cordoba', 50),
('100A', 'Citroen', 'C3', 30),
('200B', 'Citroen', 'C5', 40),
('300C', 'Peugeot', '205', 20),
('400D', 'Peugeot', '405', 30),
('500E', 'Renault', 'Megane', 40),
('600F', 'Renault', 'Laguna', 50),
('700G', 'Seat', 'Ibiza', 20),
('800H', 'Seat', 'Leon', 30),
('900I', 'Seat', 'Toledo', 40);

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
