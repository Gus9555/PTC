-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2024 a las 07:59:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lifeline`
--
CREATE DATABASE IF NOT EXISTS `lifeline` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `lifeline`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(29, 414125766, 674448409, 'hola'),
(30, 414125766, 674448409, 'hola'),
(31, 414125766, 674448409, 'asa'),
(32, 414125766, 674448409, 'ada'),
(33, 414125766, 147109824, 'as'),
(34, 414125766, 147109824, 'asa'),
(35, 674448409, 147109824, 'a\\'),
(36, 674448409, 147109824, 'a\\'),
(37, 414125766, 674448409, 'asa'),
(38, 674448409, 414125766, 'gsd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Support');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `last_session` datetime NOT NULL,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) NOT NULL,
  `password_request` int(11) NOT NULL,
  `activacion` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `estatus` varchar(100) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `unique_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `nombre`, `correo`, `last_session`, `token`, `token_password`, `password_request`, `activacion`, `id_tipo`, `codigo`, `imagen`, `estatus`, `fecha_registro`, `unique_id`) VALUES
(42, 'yoha', '$2y$10$Tc1vMguBQqut2jUz/xdO9OofnNwWp2Fv8NGsr/WCqgkLajKCMXvMa', 'yohalmo daniel', 'yohalmodaniel16@gmail.com', '0000-00-00 00:00:00', '4c389bf11ad79d9d9bffc7ff403c241f', '', 0, 1, 2, '19 78 33 52 94 ', NULL, 'Offline now', '14/05/2024 10:42 pm', 674448409),
(43, 'support', '$2y$10$vW2L5I4yWwxcebFklaYPae15V/gASthamN6kclLdwB.DhzMp6axmG', 'Support Lifeline', 'lifeline.ptc.2024@gmail.com', '0000-00-00 00:00:00', '32080d54c360ced12b4fbf3a47ec9920', '', 0, 1, 2, '85 68 99 89 23 ', NULL, 'Offline now', '14/05/2024 11:10 pm', 414125766);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
