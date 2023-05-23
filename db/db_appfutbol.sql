-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2023 a las 04:03:07
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_appfutbol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `partidos_jugados` int(11) NOT NULL,
  `ganados` int(11) NOT NULL,
  `perdidos` int(11) NOT NULL,
  `empatados` int(11) NOT NULL,
  `goles` int(11) NOT NULL,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre`, `partidos_jugados`, `ganados`, `perdidos`, `empatados`, `goles`, `puntos`) VALUES
(1, 'birra fc', 5, 1, 4, 0, 3, 3),
(2, 'fernet', 5, 4, 1, 0, 7, 12),
(3, 'gin fc', 5, 2, 2, 1, 6, 7),
(4, 'viejas fc', 5, 3, 1, 1, 4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticapartido`
--

CREATE TABLE `estadisticapartido` (
  `id_estadistica` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `id_partido` int(11) NOT NULL,
  `goles` int(11) NOT NULL,
  `tarjeta_amarilla` int(11) NOT NULL,
  `tarjeta_roja` int(11) NOT NULL,
  `asistencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fixture`
--

CREATE TABLE `fixture` (
  `id_partido` int(11) NOT NULL,
  `id_equipo1` int(11) NOT NULL,
  `id_equipo2` int(11) NOT NULL,
  `resultado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dni` int(15) NOT NULL,
  `posicion` varchar(30) NOT NULL,
  `numero_tel` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `permisos` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `estadisticapartido`
--
ALTER TABLE `estadisticapartido`
  ADD PRIMARY KEY (`id_estadistica`),
  ADD KEY `ID_Jugador` (`id_jugador`),
  ADD KEY `ID_Partido` (`id_partido`);

--
-- Indices de la tabla `fixture`
--
ALTER TABLE `fixture`
  ADD PRIMARY KEY (`id_partido`),
  ADD KEY `ID_Equipo1` (`id_equipo1`),
  ADD KEY `ID_Equipo2` (`id_equipo2`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD KEY `ID_Equipo` (`id_equipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `ID_Equipo` (`id_equipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estadisticapartido`
--
ALTER TABLE `estadisticapartido`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fixture`
--
ALTER TABLE `fixture`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estadisticapartido`
--
ALTER TABLE `estadisticapartido`
  ADD CONSTRAINT `estadisticapartido_ibfk_1` FOREIGN KEY (`ID_Jugador`) REFERENCES `jugadores` (`ID_Jugador`),
  ADD CONSTRAINT `estadisticapartido_ibfk_2` FOREIGN KEY (`ID_Partido`) REFERENCES `fixture` (`ID_Partido`);

--
-- Filtros para la tabla `fixture`
--
ALTER TABLE `fixture`
  ADD CONSTRAINT `fixture_ibfk_1` FOREIGN KEY (`ID_Equipo1`) REFERENCES `equipos` (`ID_Equipo`),
  ADD CONSTRAINT `fixture_ibfk_2` FOREIGN KEY (`ID_Equipo2`) REFERENCES `equipos` (`ID_Equipo`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`ID_Equipo`) REFERENCES `equipos` (`ID_Equipo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_Equipo`) REFERENCES `equipos` (`ID_Equipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
