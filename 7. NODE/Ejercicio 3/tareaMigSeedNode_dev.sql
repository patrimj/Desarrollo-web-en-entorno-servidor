-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-01-2024 a las 21:36:42
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
-- Base de datos: `tareaMigSeedNode_dev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`id`, `nombre`, `createdAt`, `updatedAt`) VALUES
(1, 'Admin', '2024-01-22 10:03:32', '2024-01-22 10:03:32'),
(2, 'Programador', '2024-01-22 10:03:32', '2024-01-22 10:03:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol_Asignados`
--

CREATE TABLE `Rol_Asignados` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Rol_Asignados`
--

INSERT INTO `Rol_Asignados` (`id`, `id_rol`, `id_usuario`, `createdAt`, `updatedAt`) VALUES
(37, 2, 1, '2024-01-22 10:19:31', '2024-01-22 10:19:31'),
(38, 2, 2, '2024-01-22 10:19:31', '2024-01-22 10:19:31'),
(39, 1, 2, '2024-01-22 10:19:31', '2024-01-22 10:19:31'),
(40, 2, 3, '2024-01-22 10:19:31', '2024-01-22 10:19:31'),
(41, 1, 3, '2024-01-22 10:19:31', '2024-01-22 10:19:31'),
(42, 1, 6, '2024-01-22 10:19:31', '2024-01-22 10:19:31'),
(43, 1, 6, '2024-01-22 10:19:31', '2024-01-22 10:19:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SequelizeMeta`
--

CREATE TABLE `SequelizeMeta` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `SequelizeMeta`
--

INSERT INTO `SequelizeMeta` (`name`) VALUES
('20240116185326-create-user.js'),
('20240121203206-create-roles.js'),
('20240121203217-create-rol-asignado.js'),
('20240121203253-create-tarea.js'),
('20240121203310-create-tarea-asignada.js');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tareas`
--

CREATE TABLE `Tareas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `dificultad` varchar(255) DEFAULT NULL,
  `horas_previstas` int(11) DEFAULT NULL,
  `horas_realizadas` int(11) DEFAULT NULL,
  `porcentaje_realizacion` int(11) DEFAULT NULL,
  `completada` tinyint(1) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Tareas`
--

INSERT INTO `Tareas` (`id`, `descripcion`, `dificultad`, `horas_previstas`, `horas_realizadas`, `porcentaje_realizacion`, `completada`, `createdAt`, `updatedAt`) VALUES
(1, 'Animadverto versus asperiores quae veniam deduco stipes socius.', 'XL', 4, 9, 10, 1, '2024-01-22 10:23:03', '2024-01-22 10:23:03'),
(2, 'Cruciamentum sto triduana cotidie coma.', 'L', 10, 2, 4, 0, '2024-01-22 10:23:03', '2024-01-22 10:23:03'),
(3, 'Porro tyrannus curis deludo cognomen doloremque utique undique.', 'M', 4, 8, 34, 0, '2024-01-22 10:23:03', '2024-01-22 10:23:03'),
(4, 'Varietas currus stipes.', 'L', 6, 2, 20, 0, '2024-01-22 10:23:03', '2024-01-22 10:23:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tarea_Asignadas`
--

CREATE TABLE `Tarea_Asignadas` (
  `id` int(11) NOT NULL,
  `id_tarea` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Tarea_Asignadas`
--

INSERT INTO `Tarea_Asignadas` (`id`, `id_tarea`, `id_usuario`, `createdAt`, `updatedAt`) VALUES
(14, 4, 6, '2024-01-22 10:36:14', '2024-01-22 20:27:53'),
(15, 1, 2, '2024-01-22 10:36:14', '2024-01-22 10:36:14'),
(16, 3, NULL, '2024-01-22 10:36:14', '2024-01-22 20:05:28'),
(17, 5, 1, '2024-01-22 10:36:33', '2024-01-22 10:36:33'),
(18, 1, 1, '2024-01-22 10:36:33', '2024-01-22 10:36:33'),
(19, 5, 2, '2024-01-22 10:36:33', '2024-01-22 10:36:33'),
(21, 4, 6, '2024-01-22 10:36:48', '2024-01-22 20:27:53'),
(22, 1, 1, '2024-01-22 10:36:48', '2024-01-22 10:36:48'),
(23, 1, 2, '2024-01-22 10:36:48', '2024-01-22 10:36:48'),
(24, 3, NULL, '2024-01-22 10:36:48', '2024-01-22 20:05:28'),
(25, 4, 6, '2024-01-22 10:37:10', '2024-01-22 20:27:53'),
(27, 3, NULL, '2024-01-22 10:37:10', '2024-01-22 20:05:28'),
(28, 3, NULL, '2024-01-22 10:37:10', '2024-01-22 20:05:28'),
(29, 1, 6, '2024-01-22 19:59:45', '2024-01-22 19:59:45'),
(30, 1, 6, '2024-01-22 20:00:10', '2024-01-22 20:00:10'),
(31, 1, 6, '2024-01-22 20:00:10', '2024-01-22 20:00:10'),
(32, 1, 6, '2024-01-22 20:00:11', '2024-01-22 20:00:11'),
(33, 1, 6, '2024-01-22 20:00:11', '2024-01-22 20:00:11'),
(34, 1, 6, '2024-01-22 20:00:11', '2024-01-22 20:00:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`id`, `nombre`, `email`, `password`, `createdAt`, `updatedAt`) VALUES
(1, 'Hailey', 'Homero_LongoriaPaez@yahoo.com', '$2b$10$btUQwbuIqF.KguigVLbGOeRI/sfdEpQPXUJEr/LTSbmTKz3hLvQa2', '2024-01-22 10:01:31', '2024-01-22 10:01:31'),
(2, 'Herbert', 'Dolores.YanezVazquez34@hotmail.com', '$2b$10$HeSf2.1I9m0f1jEtQMAUKOKJkysqpAEyx.pqpVQiAuAAe2.0BAV0C', '2024-01-22 10:01:31', '2024-01-22 10:01:31'),
(3, 'Vance', 'Magdalena.GuillenNieves@yahoo.com', '$2b$10$xrX0jjU0DJ62kcg5T7seUOFexszwu.5cBMDbhfx.2Y/3aRu.n2y8S', '2024-01-22 10:01:31', '2024-01-22 10:01:31'),
(4, 'Lonny', 'Benjamin26@yahoo.com', '$2b$10$wXAiq0g/DIMXJmCqXIZz8OYeOXycYIeLVuIJ1V/gzuqYkYlnm1ZAq', '2024-01-22 10:01:31', '2024-01-22 10:01:31'),
(6, 'Pat', 'pag@example.com', 'hola', '2024-01-22 18:11:01', '2024-01-22 19:45:16'),
(15, 'Patricia', 'patriciaa@correo.com', 'admin123', '2024-01-22 18:55:24', '2024-01-22 18:55:24'),
(16, 'Pat', 'pag@ejemplo.com', 'hola', '2024-01-22 19:07:39', '2024-01-22 19:07:39'),
(18, 'Pat', 'paag@ejemplo.com', 'hola', '2024-01-22 19:26:27', '2024-01-22 19:26:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Rol_Asignados`
--
ALTER TABLE `Rol_Asignados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `SequelizeMeta`
--
ALTER TABLE `SequelizeMeta`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `Tareas`
--
ALTER TABLE `Tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Tarea_Asignadas`
--
ALTER TABLE `Tarea_Asignadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Rol_Asignados`
--
ALTER TABLE `Rol_Asignados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `Tareas`
--
ALTER TABLE `Tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Tarea_Asignadas`
--
ALTER TABLE `Tarea_Asignadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
