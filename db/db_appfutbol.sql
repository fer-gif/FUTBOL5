-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2023 a las 20:47:32
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
  `ID_Equipo` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Partidos-Jugados` int(11) NOT NULL,
  `Ganados` int(11) NOT NULL,
  `Perdidos` int(11) NOT NULL,
  `Empatados` int(11) NOT NULL,
  `Goles` int(11) NOT NULL,
  `Puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticapartido`
--

CREATE TABLE `estadisticapartido` (
  `ID_Estadistica` int(11) NOT NULL,
  `ID_Jugador` int(11) NOT NULL,
  `ID_Partido` int(11) NOT NULL,
  `Goles` int(11) NOT NULL,
  `Tarjeta Amarilla` int(11) NOT NULL,
  `Tarjeta Roja` int(11) NOT NULL,
  `Asistencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fixture`
--

CREATE TABLE `fixture` (
  `ID_Partido` int(11) NOT NULL,
  `ID_Equipo1` int(11) NOT NULL,
  `ID_Equipo2` int(11) NOT NULL,
  `Resultado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `ID_Jugador` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Apellido` varchar(150) NOT NULL,
  `DNI` int(15) NOT NULL,
  `Posicion` varchar(30) NOT NULL,
  `Numero_tel` int(11) NOT NULL,
  `ID_Equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Permisos` int(11) NOT NULL,
  `ID_Equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`ID_Equipo`);

--
-- Indices de la tabla `estadisticapartido`
--
ALTER TABLE `estadisticapartido`
  ADD PRIMARY KEY (`ID_Estadistica`),
  ADD KEY `ID_Jugador` (`ID_Jugador`),
  ADD KEY `ID_Partido` (`ID_Partido`);

--
-- Indices de la tabla `fixture`
--
ALTER TABLE `fixture`
  ADD PRIMARY KEY (`ID_Partido`),
  ADD KEY `ID_Equipo1` (`ID_Equipo1`),
  ADD KEY `ID_Equipo2` (`ID_Equipo2`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`ID_Jugador`),
  ADD KEY `ID_Equipo` (`ID_Equipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `ID_Equipo` (`ID_Equipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `ID_Equipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticapartido`
--
ALTER TABLE `estadisticapartido`
  MODIFY `ID_Estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fixture`
--
ALTER TABLE `fixture`
  MODIFY `ID_Partido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `ID_Jugador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT;

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
