-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2023 a las 17:29:00
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_appfutbol5`
--
CREATE DATABASE IF NOT EXISTS `db_appfutbol5` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_appfutbol5`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `escudo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre`, `escudo`) VALUES
(5, 'Platense', 'platense.png'),
(11, 'River', NULL),
(12, 'Boca', NULL),
(13, 'Racing', 'racing.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `posicion` varchar(5) NOT NULL,
  `foto` text DEFAULT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `dni`, `nombre`, `apellido`, `telefono`, `posicion`, `foto`, `id_equipo`) VALUES
(15, 30548888, 'Pipa', 'Garcia', 0, 'DEF', 'sin-foto.png', 5),
(19, 25145666, 'Mario', 'Diaz', 0, 'POR', 'sin-foto.png', 11),
(20, 30548999, 'Pity', 'Martinez', 0, 'DEL', 'sin-foto.png', 11),
(21, 35641222, 'Cristian', 'Zapata', 456999, 'DEF', 'sin-foto.png', 11),
(22, 34215666, 'Matias', 'Dindart', 0, 'MED', 'sin-foto.png', 11),
(23, 29065448, 'Franco', 'Figal', 15887888, 'POR', 'sin-foto.png', 12),
(24, 38156354, 'Javier', 'Villanueba', 0, 'MED', 'sin-foto.png', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id_partido` int(11) NOT NULL,
  `id_equipo1` int(11) NOT NULL,
  `id_equipo2` int(11) NOT NULL,
  `goles_equipo1` int(11) NOT NULL,
  `goles_equipo2` int(11) NOT NULL,
  `fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` text DEFAULT NULL,
  `permisos` int(11) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `email`, `permisos`, `id_equipo`) VALUES
(1, 'Admin', '$2y$10$g9jCUa3Pu9NxQKIYwNy.gerhYqlOQNtjPx7W0X6jiNXrO/op/iIfq', '', 5, NULL),
(10, 'capiPlatense', '$2y$10$27gA43ID6O/3NgH77S8dsOV4k3cYautXQXOQxlCEN910l19dfZYSu', '', 3, 5),
(14, 'capiRacing', '$2y$10$dQ2QI0tiG/UvmAsLm7xprONFQEhKXU5j876JEj/pR8aDbs5L1pj/S', 'racing@gmail.com', 3, 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD UNIQUE KEY `nombreEquipo` (`nombre`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD UNIQUE KEY `dniJugador` (`dni`),
  ADD KEY `jugadorId_equipo` (`id_equipo`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id_partido`),
  ADD KEY `partidoEquipo1` (`id_equipo1`),
  ADD KEY `partidoEquipo2` (`id_equipo2`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuarioUsuarios` (`usuario`),
  ADD UNIQUE KEY `usuarioEquipo` (`id_equipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadorId_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `partidoEquipo1` FOREIGN KEY (`id_equipo1`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `partidoEquipo2` FOREIGN KEY (`id_equipo2`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarioEquipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
