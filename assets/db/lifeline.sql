-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2024 a las 07:13:35
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
-- Estructura de tabla para la tabla `clickuser`
--

DROP TABLE IF EXISTS `clickuser`;
CREATE TABLE `clickuser` (
  `id` int(10) NOT NULL,
  `UserIdSession` varchar(50) DEFAULT NULL,
  `clickUser` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clickuser`
--

INSERT INTO `clickuser` (`id`, `UserIdSession`, `clickUser`) VALUES
(8, '9', '12'),
(9, '12', '9'),
(10, '13', '14'),
(11, '14', '13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `msjs`
--

DROP TABLE IF EXISTS `msjs`;
CREATE TABLE `msjs` (
  `id` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `user_id` int(250) DEFAULT NULL,
  `to_user` varchar(250) DEFAULT NULL,
  `to_id` int(250) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `fecha` varchar(250) DEFAULT NULL,
  `nombre_equipo_user` varchar(250) DEFAULT NULL,
  `leido` varchar(100) DEFAULT NULL,
  `sonido` varchar(10) DEFAULT NULL,
  `archivos` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `msjs`
--

INSERT INTO `msjs` (`id`, `user`, `user_id`, `to_user`, `to_id`, `message`, `fecha`, `nombre_equipo_user`, `leido`, `sonido`, `archivos`) VALUES
(54, 'gustavomcastillo120@gmail.com', 13, 'yohalmo cruz ', 14, 'tttttt', '05/04/2024 03:46 pm', 'C-31', 'SI', NULL, NULL),
(55, 'yohalmodaniel@gmail.com', 14, 'Gustavo Castillo ', 13, 'motherfucker', '05/04/2024 03:53 pm', 'C-31', 'SI', NULL, NULL),
(56, 'yohalmodaniel@gmail.com', 14, 'Gustavo Castillo ', 13, 'hola', '05/04/2024 03:55 pm', 'C-31', 'SI', NULL, NULL),
(57, 'gustavomcastillo120@gmail.com', 13, 'yohalmo cruz ', 14, 'puto', '05/04/2024 03:56 pm', 'C-31', 'SI', NULL, NULL),
(58, 'yohalmodaniel@gmail.com', 14, 'Gustavo Castillo ', 13, 'cabron', '05/04/2024 03:56 pm', 'C-31', 'SI', NULL, NULL),
(59, 'gustavomcastillo120@gmail.com', 13, 'yohalmo cruz ', 14, 'ay', '05/04/2024 03:57 pm', 'C-31', 'SI', NULL, NULL),
(60, 'gustavomcastillo120@gmail.com', 13, 'yohalmo cruz ', 14, 'chi', '05/04/2024 03:57 pm', 'C-31', 'SI', NULL, NULL),
(61, 'yohalmodaniel@gmail.com', 14, 'Gustavo Castillo ', 13, 'ti', '05/04/2024 03:57 pm', 'C-31', 'SI', NULL, NULL);

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
(2, 'Usuario');

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
  `id_tipo` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `estatus` varchar(100) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `fecha_session` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `nombre`, `correo`, `last_session`, `token`, `token_password`, `password_request`, `id_tipo`, `codigo`, `image`, `estatus`, `fecha_registro`, `fecha_session`) VALUES
(1, 'yoha', '$2y$10$y3hdlf.eG8Y8xNnT69OCu.qMKUyx28ERBZ82sziwqJZ5qTnJheYym', 'yohalmo daniel', 'yohalmodaniel16@gmail.com', '2024-04-22 21:42:41', 'ef1935278d82f9ef9def2067121a7465', '', 1, 1, '14 17 16 11 ', '', 'Activo', '22/04/2024 10:13 pm', ''),
(13, 'alti123', '$2y$10$hsm3z7fEYFpr1bhJ/ZZuluEmGSWQuOnxr1CTkIz2KRyA1lHGeTfgi', 'Lissette altagracia', 'figueroaaltagraciab@gmail.com', '2024-04-22 22:15:00', '6cc3872bbfe9f7308ad25ed78dee21a1', '', 1, 2, '21 26 45 25 ', 'Captura de pantalla 2024-04-07 122600.png', 'Activo', '22/04/2024 11:14 pm', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clickuser`
--
ALTER TABLE `clickuser`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `msjs`
--
ALTER TABLE `msjs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `clickuser`
--
ALTER TABLE `clickuser`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `msjs`
--
ALTER TABLE `msjs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
