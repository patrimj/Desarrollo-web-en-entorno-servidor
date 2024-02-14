-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-12-2023 a las 21:35:07
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
-- Base de datos: `hobbyte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casillas`
--

CREATE TABLE `casillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_prueba` bigint(20) UNSIGNED NOT NULL,
  `id_heroe` bigint(20) UNSIGNED DEFAULT NULL,
  `id_partida` bigint(20) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `casillas`
--

INSERT INTO `casillas` (`id`, `id_prueba`, `id_heroe`, `id_partida`, `estado`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, 2, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(2, 9, NULL, 3, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(3, 2, NULL, 2, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(4, 12, NULL, 4, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(5, 17, NULL, 2, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(6, 12, NULL, 1, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(7, 7, NULL, 3, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(8, 5, NULL, 1, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(9, 2, NULL, 5, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(10, 5, NULL, 3, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(11, 14, NULL, 5, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(12, 19, NULL, 1, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(13, 16, NULL, 5, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(14, 16, NULL, 3, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(15, 13, NULL, 3, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(16, 19, NULL, 5, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(17, 15, NULL, 1, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(18, 12, NULL, 5, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(19, 13, NULL, 4, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54'),
(20, 4, NULL, 1, 0, '2023-12-14 17:18:54', '2023-12-14 17:18:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `max_capacidad` int(11) NOT NULL,
  `capacidad_actual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `heroes`
--

INSERT INTO `heroes` (`id`, `nombre`, `tipo`, `max_capacidad`, `capacidad_actual`, `created_at`, `updated_at`) VALUES
(1, 'Gandalf', 'magia', 50, 50, '2023-12-14 17:10:21', '2023-12-14 17:10:21'),
(2, 'Thorin', 'fuerza', 50, 50, '2023-12-14 17:10:21', '2023-12-14 17:10:21'),
(3, 'Bilbo', 'habilidad', 50, 50, '2023-12-14 17:10:21', '2023-12-14 17:10:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_14_065217_create_partidas_table', 1),
(6, '2023_12_14_165216_create_pruebas_table', 1),
(7, '2023_12_14_165228_create_heroes_table', 1),
(8, '2023_12_14_171059_create_casillas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `casillas_destapadas` int(11) NOT NULL DEFAULT 0,
  `heroes_vivos` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `id_usuario`, `estado`, `casillas_destapadas`, `heroes_vivos`, `created_at`, `updated_at`) VALUES
(1, 5, 0, 11, 3, '2023-12-14 17:15:46', '2023-12-14 17:15:46'),
(2, 3, 0, 4, 3, '2023-12-14 17:15:46', '2023-12-14 17:15:46'),
(3, 4, 0, 1, 2, '2023-12-14 17:15:46', '2023-12-14 17:15:46'),
(4, 3, 0, 13, 1, '2023-12-14 17:15:46', '2023-12-14 17:15:46'),
(5, 5, 0, 4, 2, '2023-12-14 17:15:46', '2023-12-14 17:15:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `esfuerzo` int(11) NOT NULL,
  `completada` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id`, `tipo`, `esfuerzo`, `completada`, `created_at`, `updated_at`) VALUES
(1, 'fuerza', 20, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(2, 'fuerza', 45, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(3, 'magia', 20, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(4, 'habilidad', 30, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(5, 'magia', 45, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(6, 'fuerza', 50, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(7, 'habilidad', 10, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(8, 'magia', 45, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(9, 'habilidad', 40, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(10, 'magia', 35, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(11, 'magia', 45, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(12, 'magia', 45, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(13, 'magia', 35, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(14, 'habilidad', 50, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(15, 'magia', 50, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(16, 'fuerza', 35, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(17, 'magia', 25, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(18, 'magia', 20, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(19, 'magia', 10, 1, '2023-12-14 17:16:24', '2023-12-14 17:16:24'),
(20, 'magia', 45, 0, '2023-12-14 17:16:24', '2023-12-14 17:16:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellidos`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lora Crist', 'West', 'jakubowski.colten@example.net', '2023-12-14 17:07:16', '$2y$12$GmQABNjmtGIxyNvE1KLp1OLeA.Rgam9Ifi57VH4LFCLOk2h1Ul9pq', 'mkYAO', '2023-12-14 17:07:17', '2023-12-14 17:07:17'),
(2, 'Osborne Prosacco III', 'Walsh', 'lubowitz.adolfo@example.net', '2023-12-14 17:07:17', '$2y$12$GmQABNjmtGIxyNvE1KLp1OLeA.Rgam9Ifi57VH4LFCLOk2h1Ul9pq', 'oeaWx', '2023-12-14 17:07:17', '2023-12-14 17:07:17'),
(3, 'Jamel McClure IV', 'Volkman', 'lance70@example.com', '2023-12-14 17:07:17', '$2y$12$GmQABNjmtGIxyNvE1KLp1OLeA.Rgam9Ifi57VH4LFCLOk2h1Ul9pq', 'pzqNl', '2023-12-14 17:07:17', '2023-12-14 17:07:17'),
(4, 'Miss Dominique Mosciski DDS', 'Dicki', 'jaquelin.breitenberg@example.com', '2023-12-14 17:07:17', '$2y$12$GmQABNjmtGIxyNvE1KLp1OLeA.Rgam9Ifi57VH4LFCLOk2h1Ul9pq', 'dXPB1', '2023-12-14 17:07:17', '2023-12-14 17:07:17'),
(5, 'Mr. Marty Cummings IV', 'Rohan', 'celine79@example.com', '2023-12-14 17:07:17', '$2y$12$GmQABNjmtGIxyNvE1KLp1OLeA.Rgam9Ifi57VH4LFCLOk2h1Ul9pq', 'evcfM', '2023-12-14 17:07:17', '2023-12-14 17:07:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casillas`
--
ALTER TABLE `casillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `casillas_id_prueba_foreign` (`id_prueba`),
  ADD KEY `casillas_id_heroe_foreign` (`id_heroe`),
  ADD KEY `casillas_id_partida_foreign` (`id_partida`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partidas_id_usuario_foreign` (`id_usuario`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casillas`
--
ALTER TABLE `casillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `casillas`
--
ALTER TABLE `casillas`
  ADD CONSTRAINT `casillas_id_heroe_foreign` FOREIGN KEY (`id_heroe`) REFERENCES `heroes` (`id`),
  ADD CONSTRAINT `casillas_id_partida_foreign` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id`),
  ADD CONSTRAINT `casillas_id_prueba_foreign` FOREIGN KEY (`id_prueba`) REFERENCES `pruebas` (`id`);

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `partidas_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
