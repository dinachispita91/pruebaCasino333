-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2024 a las 15:35:48
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
  `Saldo_Inicial` decimal(10,2) DEFAULT NULL,
  `Apuesta` decimal(10,2) NOT NULL,
  `Resultado` enum('ganado','perdido') NOT NULL,
  `Saldo_Final` decimal(10,2) NOT NULL
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
  `password` varchar(255) NOT NULL,
  `initial_balance` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `fullname`, `nickname`, `sexo`, `birthdate`, `id_number`, `created_at`, `password`, `initial_balance`) VALUES
(23, 'ADOLFO', 'DOLFO', 'masculino', '1965-02-12', 'FTD585', '2024-09-28 12:09:39', '$2y$10$Ur1Vm9ASYQ05I/Yvu.qnWuWr1Ei.Cv/bDYyV3MXAhNzqPa4LZm7TK', 40.00);

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
