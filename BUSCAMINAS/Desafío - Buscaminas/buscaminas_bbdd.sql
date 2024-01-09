-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-10-2023 a las 18:30:36
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
-- Base de datos: `buscaminas_bbdd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--


CREATE TABLE `jugador` (
  `id_jugador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `pssw` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `partidas_jugadas` int(11) NOT NULL,
  `partidas_ganadas` int(11) NOT NULL,
  `administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`id_jugador`, `nombre`, `pssw`, `email`, `partidas_jugadas`, `partidas_ganadas`, `administrador`) VALUES
(1, 'Jugador1', 'contraseña1', 'jugador1@example.com', 5, 3, 0),
(2, 'Jugador2', 'contraseña2', 'jugador2@example.com', 7, 4, 0),
(3, 'Jugador3', 'contraseña3', 'jugador3@example.com', 10, 6, 1),
(4, 'Jugador4', 'contraseña4', 'jugador4@example.com', 2, 2, 0),
(5, 'Jugador5', 'contraseña5', 'jugador5@example.com', 8, 5, 1),
(6, 'Jugador6', 'contraseña6', 'jugador6@example.com', 12, 9, 1),
(7, 'Jugador7', 'contraseña7', 'jugador7@example.com', 3, 1, 0),
(8, 'Jugador8', 'contraseña8', 'jugador8@example.com', 4, 2, 0),
(9, 'Jugador9', 'contraseña9', 'jugador9@example.com', 6, 4, 0),
(10, 'Jugador10', 'contraseña10', 'jugador10@example.com', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `tablero_oculto` varchar(50) NOT NULL,
  `tablero_visible` varchar(50) NOT NULL,
  `estado_partida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id_partida`, `id_jugador`, `tablero_oculto`, `tablero_visible`, `estado_partida`) VALUES
(1, 1, '*****-*--*', '------*---', 'Acabada Ganada'),
(2, 1, '*****-*--*', '------*---', 'Acabada Perdida'),
(3, 2, '---*--****', '-----*----*', 'Jugando'),
(4, 2, '---*--****', '-----*----*', 'Acabada Ganada'),
(5, 3, '*******---', '----------', 'Jugando'),
(6, 3, '*******---', '----------', 'Acabada Perdida'),
(7, 4, '----*-----', '---------*', 'Acabada Ganada'),
(8, 4, '----*-----', '---------*', 'Acabada Perdida'),
(9, 5, '***--***--', '--------*--', 'Jugando'),
(10, 5, '***--***--', '--------*--', 'Acabada Ganada');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`id_jugador`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id_partida`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`id_jugador`) REFERENCES `jugador` (`id_jugador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
