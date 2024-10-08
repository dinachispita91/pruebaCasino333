-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-09-2024 a las 19:37:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casino_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_juego`
--

CREATE TABLE `historial_juego` (
  `id_jugadas` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidad_apostada` decimal(10,2) NOT NULL,
  `resultado` enum('ganado','perdido') NOT NULL,
  `saldo_evolucion` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `sexo` enum('masculino','femenino') NOT NULL,
  `birthdate` date NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `fullname`, `nickname`, `sexo`, `birthdate`, `id_number`, `created_at`, `password`) VALUES
(3, 'Pedro Picapiedra', 'peter', 'masculino', '1985-08-08', '123456', '2024-09-26 18:48:52', '$2y$10$fjbCg091Jjj/XPGa0fEupO4CWc2C195cg809HvJcXHM.d8PVbX/Ci'),
(4, 'Miguel Calvo', 'miguelin', 'masculino', '1996-05-04', '987654', '2024-09-26 18:50:30', '$2y$10$h8YaMKo0FQLIwL6BwVuNbe5FznQBNDgA7Qo4eHhneLF635lioCBHi'),
(5, 'Rodolfo ', 'Dolfo', 'masculino', '1991-09-14', '3546546541T', '2024-09-27 14:23:49', '$2y$10$8fhOe.9WTuFeDb2589yjCuFrUMkTkSMz07Jaiquarcrz6S8s0OIuG'),
(9, 'Inma', 'in', 'femenino', '1991-09-14', '123654', '2024-09-27 15:50:47', '$2y$10$mqamaUFpo6Xd5uIgf.lNz.jsOdvKt4v91wcWdfGX60z/rfSTmiwWG'),
(10, 'Dina', 'chispita ', 'femenino', '1991-09-14', '2325445544', '2024-09-27 15:51:52', '$2y$10$lChQ8uQmlN4L5hghRq5OWOCELjjClKE.5a02WqRY5KA/aYGoZnRY2'),
(11, 'David', 'David01', 'masculino', '1991-09-14', '12854', '2024-09-27 15:53:18', '$2y$10$vAgu4z2EsRh7LZ.1KNC/yO80GlN5jtO42gNHoQcnmtPbj4.SXZ44C'),
(12, 'covadonga', 'covi', 'femenino', '1993-09-14', 'dkjdfjsksol7', '2024-09-27 16:10:37', '$2y$10$1TZ6d.BUCYkHkHWG1F4y9eoAyBTNSwXsd17VkcUKb0AZZgtN8Vofm'),
(13, 'miguel Calvo', 'miguelin1', 'femenino', '1991-09-14', '45555', '2024-09-27 16:11:23', '$2y$10$ouETzjJVdHL0bImdLs2LdOK9ErJfU5/exBmIjvm586pSHbyBpLwvm'),
(14, 'vera', 'vera', 'femenino', '1990-09-14', '665999547e', '2024-09-27 16:12:26', '$2y$10$jVu3hKM8YU5oioN9dyII4OhhNZJntl0k7rA26rEG.5mmpt0yAqBA6'),
(15, 'VIVIAN', 'VIVI', 'femenino', '1990-07-14', '1266464', '2024-09-27 17:30:41', '$2y$10$YUuAQglUwwlmyoTq8LcH.OOleKOQrUHq7qvNXP69VxLAvXJ4IKPa2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historial_juego`
--
ALTER TABLE `historial_juego`
  ADD PRIMARY KEY (`id_jugadas`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_juego`
--
ALTER TABLE `historial_juego`
  MODIFY `id_jugadas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_juego`
--
ALTER TABLE `historial_juego`
  ADD CONSTRAINT `historial_juego_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
