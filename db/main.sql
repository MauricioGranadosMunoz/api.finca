-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-12-2022 a las 03:19:38
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ADMINISTRADOR`
--

CREATE TABLE `ADMINISTRADOR` (
  `ADMINISTRADOR_ID` int(11) NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CONTRASENA` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `USUARIO_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ADMINISTRADOR`
--

INSERT INTO `ADMINISTRADOR` (`ADMINISTRADOR_ID`, `EMAIL`, `CONTRASENA`, `USUARIO_ID`) VALUES
(2, 'MGRANADOSMUNOZ@GMAIL.COM', '$2y$10$/nCPpwyhhhRjl2vjTlOndeJtYgLRW53otdTFZcambM2hJQfA5V1Si', 1),
(4, 'D', 'D', 3),
(5, 'mgranadosmunozee1@gmail.com', '12345678', 12),
(6, 'mgranadosmunozeere1@gmail.com', '12345678', 13),
(7, 'mgranadosmunozeere1d@gmail.com', '$2y$10$0pu.F94N30ie2ctC/KKcduR1O0ijTEfwwlxbkYT/PZMHxEE7JRKNe', 14),
(8, 'mgranadosmunozeerasde1d@gmail.com', '$2y$10$OoQh38PPimIlWRK5Iz3dReJp1nnD0A2ewbDGz.OHETl6dUcOSaUtC', 15),
(9, 'testemail@gmail.com', '$2y$10$esHbPVyzsPN2UcCvkBbwu..7BdMK3TRhCKm.KXE3bqU.Q.W6XS8VW', 16),
(10, 'hello@gmail.com', '$2y$10$hn6piYs8y..VZrWJ6k.h7OmY/sIjgylKcfMCqAW/UOyjTfNbyPdCi', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CAJUELAS_TRABAJADOR`
--

CREATE TABLE `CAJUELAS_TRABAJADOR` (
  `CAJUELAS_TRABAJADOR_ID` int(11) NOT NULL,
  `CANTIDAD_SEMANA` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `NUM_SENAMA` int(11) NOT NULL,
  `ULTIMO_UPDATE` datetime NOT NULL DEFAULT current_timestamp(),
  `TRABAJADOR_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `CAJUELAS_TRABAJADOR`
--

INSERT INTO `CAJUELAS_TRABAJADOR` (`CAJUELAS_TRABAJADOR_ID`, `CANTIDAD_SEMANA`, `NUM_SENAMA`, `ULTIMO_UPDATE`, `TRABAJADOR_ID`) VALUES
(1, 'Q', 13, '2022-12-14 19:07:23', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `obtener_usuario_logged`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `obtener_usuario_logged` (
`USUARIO_ID` int(11)
,`NOMBRE` varchar(100)
,`APELLIDOS` varchar(150)
,`FECHA_CREACION` datetime
,`EMAIL` varchar(100)
,`DESCRIPCION` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `obtener_usuario_login`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `obtener_usuario_login` (
`USUARIO_ID` int(11)
,`EMAIL` varchar(100)
,`CONTRASENA` varchar(250)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRECIO_CAJUELA`
--

CREATE TABLE `PRECIO_CAJUELA` (
  `PRECIO_CAJUELA_ID` int(11) NOT NULL,
  `PRECIO_ACTUAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `PRECIO_CAJUELA`
--

INSERT INTO `PRECIO_CAJUELA` (`PRECIO_CAJUELA_ID`, `PRECIO_ACTUAL`) VALUES
(1, 1200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_USUARIO`
--

CREATE TABLE `TIPO_USUARIO` (
  `TIPO_USUARIO_ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TIPO_USUARIO`
--

INSERT INTO `TIPO_USUARIO` (`TIPO_USUARIO_ID`, `DESCRIPCION`) VALUES
(1, 'Administrador'),
(2, 'Trabajador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TRABAJADOR`
--

CREATE TABLE `TRABAJADOR` (
  `TRABAJADOR_ID` int(11) NOT NULL,
  `TRABAJADOR_ACTUAL` tinyint(1) NOT NULL,
  `USUARIO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `TRABAJADOR`
--

INSERT INTO `TRABAJADOR` (`TRABAJADOR_ID`, `TRABAJADOR_ACTUAL`, `USUARIO_ID`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UPDATE_PRECIO_CAJUELA`
--

CREATE TABLE `UPDATE_PRECIO_CAJUELA` (
  `UPDATE_PRECIO_CAJUELA_ID` int(11) NOT NULL,
  `FECHA_UPDATE` datetime NOT NULL DEFAULT current_timestamp(),
  `NUEVO_PRECIO` int(11) NOT NULL,
  `ADMINISTRADOR_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `UPDATE_PRECIO_CAJUELA`
--

INSERT INTO `UPDATE_PRECIO_CAJUELA` (`UPDATE_PRECIO_CAJUELA_ID`, `FECHA_UPDATE`, `NUEVO_PRECIO`, `ADMINISTRADOR_ID`) VALUES
(2, '2022-12-14 19:05:18', 1200, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `USUARIO_ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOS` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp(),
  `TIPO_USUARIO_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`USUARIO_ID`, `NOMBRE`, `APELLIDOS`, `FECHA_CREACION`, `TIPO_USUARIO_ID`) VALUES
(1, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 16:48:26', 1),
(2, 'NOMBRE TRABAJADOR', 'APELLIDO TRABAJADOR', '2022-12-14 18:10:59', 2),
(3, 'D', 'D', '2022-12-14 19:19:57', 1),
(4, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:37:58', 1),
(5, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:38:01', 1),
(6, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:38:02', 1),
(7, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:38:03', 1),
(8, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:38:17', 1),
(9, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:38:45', 1),
(10, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:41:32', 1),
(11, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:42:04', 1),
(12, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:42:32', 1),
(13, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:42:51', 1),
(14, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:45:50', 1),
(15, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:46:33', 1),
(16, 'Jose Mauricio', 'Granados Muñoz', '2022-12-14 19:47:20', 1),
(17, 'TEST', 'TEST', '2022-12-14 20:18:28', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `obtener_usuario_logged`
--
DROP TABLE IF EXISTS `obtener_usuario_logged`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `obtener_usuario_logged`  AS SELECT `US`.`USUARIO_ID` AS `USUARIO_ID`, `US`.`NOMBRE` AS `NOMBRE`, `US`.`APELLIDOS` AS `APELLIDOS`, `US`.`FECHA_CREACION` AS `FECHA_CREACION`, `AD`.`EMAIL` AS `EMAIL`, `TP`.`DESCRIPCION` AS `DESCRIPCION` FROM ((`usuario` `US` left join `administrador` `AD` on(`AD`.`USUARIO_ID` = `US`.`USUARIO_ID`)) left join `tipo_usuario` `TP` on(`TP`.`TIPO_USUARIO_ID` = `US`.`TIPO_USUARIO_ID`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `obtener_usuario_login`
--
DROP TABLE IF EXISTS `obtener_usuario_login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `obtener_usuario_login`  AS SELECT `US`.`USUARIO_ID` AS `USUARIO_ID`, `AD`.`EMAIL` AS `EMAIL`, `AD`.`CONTRASENA` AS `CONTRASENA` FROM (`usuario` `US` left join `administrador` `AD` on(`AD`.`USUARIO_ID` = `US`.`USUARIO_ID`)) WHERE `US`.`TIPO_USUARIO_ID` = 11  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  ADD PRIMARY KEY (`ADMINISTRADOR_ID`),
  ADD KEY `FK_ADMIN_USUARIO_ID` (`USUARIO_ID`);

--
-- Indices de la tabla `CAJUELAS_TRABAJADOR`
--
ALTER TABLE `CAJUELAS_TRABAJADOR`
  ADD PRIMARY KEY (`CAJUELAS_TRABAJADOR_ID`),
  ADD KEY `PK_TRABAJADOR_ID` (`TRABAJADOR_ID`);

--
-- Indices de la tabla `PRECIO_CAJUELA`
--
ALTER TABLE `PRECIO_CAJUELA`
  ADD PRIMARY KEY (`PRECIO_CAJUELA_ID`);

--
-- Indices de la tabla `TIPO_USUARIO`
--
ALTER TABLE `TIPO_USUARIO`
  ADD PRIMARY KEY (`TIPO_USUARIO_ID`);

--
-- Indices de la tabla `TRABAJADOR`
--
ALTER TABLE `TRABAJADOR`
  ADD PRIMARY KEY (`TRABAJADOR_ID`),
  ADD KEY `FK_USUARIO_ID` (`USUARIO_ID`);

--
-- Indices de la tabla `UPDATE_PRECIO_CAJUELA`
--
ALTER TABLE `UPDATE_PRECIO_CAJUELA`
  ADD PRIMARY KEY (`UPDATE_PRECIO_CAJUELA_ID`),
  ADD KEY `PK_ADMINISTRADOR_ID` (`ADMINISTRADOR_ID`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`USUARIO_ID`),
  ADD KEY `FK_TIPO_USUARIO_ID` (`TIPO_USUARIO_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  MODIFY `ADMINISTRADOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `CAJUELAS_TRABAJADOR`
--
ALTER TABLE `CAJUELAS_TRABAJADOR`
  MODIFY `CAJUELAS_TRABAJADOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `PRECIO_CAJUELA`
--
ALTER TABLE `PRECIO_CAJUELA`
  MODIFY `PRECIO_CAJUELA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `TIPO_USUARIO`
--
ALTER TABLE `TIPO_USUARIO`
  MODIFY `TIPO_USUARIO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `TRABAJADOR`
--
ALTER TABLE `TRABAJADOR`
  MODIFY `TRABAJADOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `UPDATE_PRECIO_CAJUELA`
--
ALTER TABLE `UPDATE_PRECIO_CAJUELA`
  MODIFY `UPDATE_PRECIO_CAJUELA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `USUARIO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  ADD CONSTRAINT `FK_ADMIN_USUARIO_ID` FOREIGN KEY (`USUARIO_ID`) REFERENCES `USUARIO` (`USUARIO_ID`);

--
-- Filtros para la tabla `CAJUELAS_TRABAJADOR`
--
ALTER TABLE `CAJUELAS_TRABAJADOR`
  ADD CONSTRAINT `PK_TRABAJADOR_ID` FOREIGN KEY (`TRABAJADOR_ID`) REFERENCES `TRABAJADOR` (`TRABAJADOR_ID`);

--
-- Filtros para la tabla `TRABAJADOR`
--
ALTER TABLE `TRABAJADOR`
  ADD CONSTRAINT `FK_USUARIO_ID` FOREIGN KEY (`USUARIO_ID`) REFERENCES `USUARIO` (`USUARIO_ID`);

--
-- Filtros para la tabla `UPDATE_PRECIO_CAJUELA`
--
ALTER TABLE `UPDATE_PRECIO_CAJUELA`
  ADD CONSTRAINT `PK_ADMINISTRADOR_ID` FOREIGN KEY (`ADMINISTRADOR_ID`) REFERENCES `ADMINISTRADOR` (`ADMINISTRADOR_ID`);

--
-- Filtros para la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `FK_TIPO_USUARIO_ID` FOREIGN KEY (`TIPO_USUARIO_ID`) REFERENCES `TIPO_USUARIO` (`TIPO_USUARIO_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
