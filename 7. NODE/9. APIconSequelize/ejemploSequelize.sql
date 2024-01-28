-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-01-2024 a las 09:11:39
-- Versión del servidor: 8.0.35-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemploSequelize`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `DNI` varchar(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Clave` varchar(20) NOT NULL,
  `Tfno` varchar(20) NOT NULL,
  `edad` int NOT NULL
);

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`DNI`, `Nombre`, `Clave`, `Tfno`, `edad`) VALUES
('10A', 'Manuel', '123', '123', 20),
('1123142', 'Badr', '242', '124124152', 23),
('12345678P', 'ASDF', '32', '32', 21),
('135T', 'Laura', '123', '12894', 34),
('13H', 'Raúl', '', '2389392', 32),
('14F', 'David', '', '2387272', 45),
('18U', 'Elena', '', '23892', 44),
('19I', 'Marina', '', '35345', 56),
('1A', 'Ismael', '123', '12389', 31),
('1E', 'Carlos', '1234', '243', 57),
('200RE', 'Patricia', '1234', '555 425423', 75),
('20Z', 'Inés', '', '2723832', 98),
('2B', 'Juán', '123', '2', 101),
('3C', 'Alejandro', '3', '3', 18),
('5E', 'JaviV', '4', '5', 48),
('6F', 'Gonzalo', '4', '6', 15),
('7G', 'Óscar', '5', '7', 10),
('8H', 'Badr', '', '348738', 115),
('90TE', 'Francisco', '1234', '555 8592', 84),
('999', 'DAW2', '237', '661 0234234', 43),
('9999', 'Nadeie', '1234', '999 666 666', 117),
('9I', 'Jaime', '', '3289329', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesasignados`
--

CREATE TABLE `rolesasignados` (
  `idra` int NOT NULL,
  `DNIRol` varchar(10) NOT NULL,
  `idRol` int NOT NULL
) ;

--
-- Volcado de datos para la tabla `rolesasignados`
--

INSERT INTO `rolesasignados` (`idra`, `DNIRol`, `idRol`) VALUES
(1, '10A', 1),
(2, '10A', 2),
(3, '11B', 2),
(4, '2B', 1),
(5, '1A', 1),
(6, '1A', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rolesasignados`
--
ALTER TABLE `rolesasignados`
  ADD PRIMARY KEY (`idra`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rolesasignados`
--
ALTER TABLE `rolesasignados`
  MODIFY `idra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
