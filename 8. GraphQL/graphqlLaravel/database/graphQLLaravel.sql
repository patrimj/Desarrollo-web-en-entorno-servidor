-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-02-2024 a las 12:45:46
-- Versión del servidor: 8.0.36-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `graphQLLaravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `reply` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `reply`, `created_at`, `updated_at`) VALUES
(1, 1, 'A ver qué tal', '2024-01-31 16:44:13', '2024-01-31 16:44:13'),
(2, 1, 'A la expectativa', '2024-01-31 16:44:13', '2024-01-31 16:44:13'),
(3, 2, 'Ok', '2024-01-31 16:44:50', '2024-01-31 16:44:50'),
(4, 3, 'A mí también.', '2024-01-31 16:44:50', '2024-01-31 16:44:50'),
(5, 4, 'A mí no', '2024-01-31 16:45:16', '2024-01-31 16:45:16'),
(6, 3, 'Es que no hay color.', '2024-01-31 16:45:16', '2024-01-31 16:45:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_31_163655_create_posts_table', 2),
(6, '2024_01_31_163756_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Probando en Laravel', 'Probando a hacer todo lo aprendido en Node GraphQL en Laravel.', '2024-01-31 16:42:39', '2024-01-31 16:42:39'),
(2, 1, 'Más tests', 'Seguimos con los tests...', '2024-01-31 16:45:52', '2024-01-30 23:00:00'),
(3, 2, 'Me gusta Laravel', 'Porque sí, porque me gusta más, qué pasa...', '2024-01-31 16:45:52', '2024-01-30 23:00:00'),
(4, 3, 'Me gusta Node.', 'Por las mismas razones que a 2 le gusta Laravel.', '2024-01-31 16:45:52', '2024-01-31 16:45:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Viola Gaylord', 'carmen.franecki@example.com', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'AAFWQLp0a4', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(2, 'Garrick Douglas III', 'walton53@example.org', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'sgVxX2Hw8V', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(3, 'Ronaldo Purdy', 'stoltenberg.brionna@example.net', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', '9xy3lfkayI', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(4, 'Dario Volkman PhD', 'jonathon.gusikowski@example.com', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'HKgcnIRCvx', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(5, 'Conrad Miller', 'ecummerata@example.org', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'SvC3edNQV7', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(6, 'Meredith Conroy', 'lnikolaus@example.net', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', '8cWHaxX795', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(7, 'Mr. Makenna Douglas', 'gemard@example.com', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'HGzFWBSwx6', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(8, 'Cyrus Runolfsson', 'vlebsack@example.com', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'LRPhcEHdPk', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(9, 'Isaac Predovic', 'allan.larson@example.com', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', '929ldY6vOp', '2024-01-31 15:34:10', '2024-01-31 15:34:10'),
(10, 'Ms. Abigale Shanahan', 'candace79@example.com', '2024-01-31 15:34:10', '$2y$12$6OH76RrEkzsJWnvF5rm2I.krJq9DUC8h73TQy04AxdTBvsWfFOoim', 'd41Brm9C1P', '2024-01-31 15:34:10', '2024-01-31 15:34:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
