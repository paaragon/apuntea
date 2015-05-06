-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2015 a las 14:10:48
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `apuntea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apunte`
--

CREATE TABLE IF NOT EXISTS `apunte` (
`id` int(11) NOT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `contenido` text COLLATE utf8_spanish2_ci,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `visualizaciones` int(11) DEFAULT NULL,
  `permisovisualizacion` int(11) DEFAULT NULL,
  `permisoedicion` int(11) DEFAULT NULL,
  `permisoedicionpermiso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE IF NOT EXISTS `asignatura` (
`id` int(11) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `curso` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
`id` int(11) NOT NULL,
  `universidad_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rama` set('Artes y humanidades','Ciencias','Ciencias de la salud','Ingeniería y arquitectura','Ciencias sociales y jurídicas') COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `universidad_id`, `nombre`, `rama`) VALUES
(8, 1, 'Enfermería', 'Ciencias de la salud'),
(9, 1, 'Filología Hispánica', 'Artes y humanidades'),
(10, 1, 'Matemáticas', 'Ciencias'),
(11, 1, 'Ingeniería del Software', 'Ingeniería y arquitectura'),
(12, 1, 'Ingeniería de computadores', 'Ingeniería y arquitectura'),
(13, 1, 'Ingeniería forestal', 'Ingeniería y arquitectura'),
(14, 1, 'Biología', 'Ciencias'),
(15, 1, 'Geología', 'Ciencias'),
(16, 1, 'Filología clásica', 'Artes y humanidades'),
(17, 1, 'Ciencias políticas', 'Ciencias sociales y jurídicas'),
(18, 1, 'Trabajo social', 'Ciencias sociales y jurídicas'),
(20, 2, 'Ingeniería Informática', 'Ingeniería y arquitectura'),
(21, 2, 'Derecho', 'Ciencias sociales y jurídicas'),
(22, 2, 'Historia', 'Artes y humanidades'),
(23, 2, 'Historia del arte', 'Artes y humanidades'),
(24, 2, 'Física', 'Ciencias'),
(25, 2, 'Medicina', 'Ciencias de la salud'),
(26, 2, 'Odontología', 'Ciencias de la salud'),
(27, 2, 'Enfermería', 'Ciencias de la salud'),
(28, 2, 'Filología Hispánica', 'Artes y humanidades'),
(29, 2, 'Matemáticas', 'Ciencias'),
(30, 2, 'Ingeniería del Software', 'Ingeniería y arquitectura'),
(31, 2, 'Ingeniería de computadores', 'Ingeniería y arquitectura'),
(32, 2, 'Ingeniería forestal', 'Ingeniería y arquitectura'),
(33, 2, 'Biología', 'Ciencias'),
(34, 2, 'Geología', 'Ciencias'),
(35, 2, 'Filología clásica', 'Artes y humanidades'),
(36, 2, 'Ciencias políticas', 'Ciencias sociales y jurídicas'),
(37, 2, 'Trabajo social', 'Ciencias sociales y jurídicas'),
(51, 3, 'Ingeniería Informática', 'Ingeniería y arquitectura'),
(52, 3, 'Derecho', 'Ciencias sociales y jurídicas'),
(53, 3, 'Historia', 'Artes y humanidades'),
(54, 3, 'Historia del arte', 'Artes y humanidades'),
(55, 3, 'Física', 'Ciencias'),
(56, 3, 'Medicina', 'Ciencias de la salud'),
(57, 3, 'Odontología', 'Ciencias de la salud'),
(58, 3, 'Enfermería', 'Ciencias de la salud'),
(59, 3, 'Filología Hispánica', 'Artes y humanidades'),
(60, 3, 'Matemáticas', 'Ciencias'),
(61, 3, 'Ingeniería del Software', 'Ingeniería y arquitectura'),
(62, 3, 'Ingeniería de computadores', 'Ingeniería y arquitectura'),
(63, 3, 'Ingeniería forestal', 'Ingeniería y arquitectura'),
(64, 3, 'Biología', 'Ciencias'),
(65, 3, 'Geología', 'Ciencias'),
(66, 3, 'Filología clásica', 'Artes y humanidades'),
(67, 3, 'Ciencias políticas', 'Ciencias sociales y jurídicas'),
(68, 3, 'Trabajo social', 'Ciencias sociales y jurídicas'),
(69, 4, 'Ingeniería Informática', 'Ingeniería y arquitectura'),
(70, 4, 'Derecho', 'Ciencias sociales y jurídicas'),
(71, 4, 'Historia', 'Artes y humanidades'),
(72, 4, 'Historia del arte', 'Artes y humanidades'),
(73, 4, 'Física', 'Ciencias'),
(74, 4, 'Medicina', 'Ciencias de la salud'),
(75, 4, 'Odontología', 'Ciencias de la salud'),
(76, 4, 'Enfermería', 'Ciencias de la salud'),
(77, 4, 'Filología Hispánica', 'Artes y humanidades'),
(78, 4, 'Matemáticas', 'Ciencias'),
(79, 4, 'Ingeniería del Software', 'Ingeniería y arquitectura'),
(80, 4, 'Ingeniería de computadores', 'Ingeniería y arquitectura'),
(81, 4, 'Ingeniería forestal', 'Ingeniería y arquitectura'),
(82, 4, 'Biología', 'Ciencias'),
(83, 4, 'Geología', 'Ciencias'),
(84, 4, 'Filología clásica', 'Artes y humanidades'),
(85, 4, 'Ciencias políticas', 'Ciencias sociales y jurídicas'),
(86, 4, 'Trabajo social', 'Ciencias sociales y jurídicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarioapunte`
--

CREATE TABLE IF NOT EXISTS `comentarioapunte` (
`id` int(11) NOT NULL,
  `apunte_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `texto` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariogrupo`
--

CREATE TABLE IF NOT EXISTS `comentariogrupo` (
`id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `texto` text COLLATE utf8_spanish2_ci,
  `fecha` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
`id` int(11) NOT NULL,
  `alice_id` int(11) NOT NULL,
  `bob_id` int(11) NOT NULL,
  `admitido` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `alice_id`, `bob_id`, `admitido`) VALUES
(1, 1, 2, 1),
(2, 1, 3, 1),
(3, 1, 4, 1),
(4, 1, 5, 1),
(5, 4, 3, 1),
(6, 6, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
`id` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetaapunte`
--

CREATE TABLE IF NOT EXISTS `etiquetaapunte` (
  `etiqueta_id` int(11) NOT NULL,
  `apunte_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `privacidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
`id` int(11) NOT NULL,
  `receptor_id` int(11) DEFAULT NULL,
  `emisor_id` int(11) DEFAULT NULL,
  `texto` text COLLATE utf8_spanish2_ci,
  `fecha` datetime DEFAULT NULL,
  `visto` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE IF NOT EXISTS `universidad` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` mediumtext COLLATE utf8_spanish2_ci,
  `imagenperfil` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagenPortada` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `siglas` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`id`, `nombre`, `descripcion`, `imagenperfil`, `imagenPortada`, `siglas`) VALUES
(1, 'Universidad Complutense de Madrid', 'La Universidad Complutense de Madrid (UCM), tradicionalmente denominada Universidad de Madrid y conocida de forma oficiosa como «la Complutense», por su relación histórica con la Universidad de Alcalá, o «la Docta», por haber sido la única universidad española autorizada a otorgar el título de doctor durante finales del siglo XIX y principios del siglo XX, es la universidad pública más antigua de Madrid, considerada una de las universidades más prestigiosas de España y del mundo hispanohablante.', 'LogoUCM.jpg', NULL, 'U.C.M.'),
(2, 'Universidad Autónoma de Madrid', 'La Universidad Autónoma de Madrid (UAM) es una universidad pública española, ubicada en Madrid y fundada en 1968,2 momento en que sus facultades estaban dispersas por diversos edificios de la capital española. No obstante, la localización actual de esta universidad es el campus de Cantoblanco, al norte de la ciudad de Madrid, junto a Alcobendas y San Sebastián de los Reyes. Dicho campus, con 2 252 000 m² de superficie total, se inauguró el 25 de octubre de 1971, y es considerado uno de los 24 campus medioambientalmente sostenibles del mundo.', 'logo_uam.gif', NULL, 'U.A.M.'),
(3, 'Universidad de Alcalá de Henares', 'La Universidad de Alcalá es una universidad pública ubicada en Alcalá de Henares (España), y con campus en Alcalá y Guadalajara. Imparte 36 titulaciones oficiales, 51 programas oficiales de postgrado, 37 doctorados y una importante variedad de maestrías y estudios de especialización. Actualmente tiene 28 336 alumnos y 2608 profesores', NULL, NULL, 'U.A.H.'),
(4, 'Universidad Politécnica de Madrid', 'La Universidad Politécnica de Madrid (UPM), es una universidad pública con sede en la Ciudad Universitaria de Madrid (España) y con instalaciones en varias ubicaciones de Madrid (Ciudad Universitaria, Campus Sur en Vallecas, entre otras) y Boadilla del Monte.', 'upm-T.gif', 'UPM-FI--06--Bloque_1.jpg', 'U.P.M.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `ultimaconexion` datetime DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nick` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagenportada` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `privacidadperfil` int(11) DEFAULT NULL,
  `privacidadactividad` int(11) DEFAULT NULL,
  `privacidadbuscador` int(11) DEFAULT NULL,
  `estado` varchar(75) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `carrera_id`, `ultimaconexion`, `nombre`, `apellidos`, `nick`, `password`, `tipo`, `avatar`, `imagenportada`, `email`, `privacidadperfil`, `privacidadactividad`, `privacidadbuscador`, `estado`) VALUES
(1, NULL, '2015-05-05 15:36:26', 'Pablo', 'Aragón', 'usu1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220 ', 1, 'no-user.jpg', 'fondo-user.jpg', 'pablo.aragon22@gmail.com', 1, 1, 1, 'Soy 1'),
(2, NULL, '2015-05-05 15:36:26', 'Juan Miguel', 'Lacruz Camblor', 'usu2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220 ', 1, 'no-user.jpg', 'fondo-user.jpg', 'prueba@gmail.com', 1, 1, 1, 'Soy 2'),
(3, NULL, '2015-05-05 15:43:57', 'usu3', 'usu3', 'usu3', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220 ', 1, 'no-user.jpg', 'fondo-user.jpg', 'usu3@gmail.com', 1, 1, 1, 'Soy 3'),
(4, NULL, '2015-05-05 15:43:57', 'usu4', 'usu4', 'usu4', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220 ', 1, 'no-user.jpg', 'fondo-user.jpg', 'prueba@gmail.com', 1, 1, 1, 'Soy 4'),
(5, NULL, '2015-05-05 15:46:34', 'usu5', 'usu5', 'usu5', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220 ', 1, 'no-user.jpg', 'no-user.jpg', 'user5@gmail.com', 1, 1, 1, 'Soy 5'),
(6, 21, '2015-05-05 16:53:44', 'usu6', 'usu6', 'usu6', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220 ', 1, 'no-user.jpg', 'fondo-user.jpg', 'usu6@gmail.com', 1, 1, 1, 'Soy 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariogrupo`
--

CREATE TABLE IF NOT EXISTS `usuariogrupo` (
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `isadmin` int(11) DEFAULT '0',
  `admitido` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariointeractuaapunte`
--

CREATE TABLE IF NOT EXISTS `usuariointeractuaapunte` (
  `apunte_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `like` int(11) DEFAULT NULL,
  `visto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apunte`
--
ALTER TABLE `apunte`
 ADD PRIMARY KEY (`id`), ADD KEY `ap_as_fk_idx` (`asignatura_id`), ADD KEY `ap_usu_fk_idx` (`usuario_id`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
 ADD PRIMARY KEY (`id`), ADD KEY `asig_carr_fk_idx` (`carrera_id`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
 ADD PRIMARY KEY (`id`), ADD KEY `universidad_fk_idx` (`universidad_id`);

--
-- Indices de la tabla `comentarioapunte`
--
ALTER TABLE `comentarioapunte`
 ADD PRIMARY KEY (`id`), ADD KEY `com_ap_ap_fk_idx` (`apunte_id`), ADD KEY `com_ap_usu_fk_idx` (`usuario_id`);

--
-- Indices de la tabla `comentariogrupo`
--
ALTER TABLE `comentariogrupo`
 ADD PRIMARY KEY (`id`), ADD KEY `com_grupo_fk_idx` (`grupo_id`), ADD KEY `com_grupo_usu_fk_idx` (`usuario_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
 ADD PRIMARY KEY (`id`), ADD KEY `alice_fk_idx` (`alice_id`), ADD KEY `bob_fk_idx` (`bob_id`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `etiquetaapunte`
--
ALTER TABLE `etiquetaapunte`
 ADD KEY `etiqueta_fk_idx` (`etiqueta_id`), ADD KEY `eti_apunte_id_idx` (`apunte_id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
 ADD PRIMARY KEY (`id`), ADD KEY `receptor_fk_idx` (`receptor_id`), ADD KEY `emisor_fk_idx` (`emisor_id`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`), ADD KEY `usu_carrera_fk_idx` (`carrera_id`);

--
-- Indices de la tabla `usuariogrupo`
--
ALTER TABLE `usuariogrupo`
 ADD PRIMARY KEY (`usuario_id`), ADD KEY `grupo_usu_fk_idx` (`grupo_id`);

--
-- Indices de la tabla `usuariointeractuaapunte`
--
ALTER TABLE `usuariointeractuaapunte`
 ADD KEY `apunte_int_fk_idx` (`apunte_id`), ADD KEY `usu_int_fk_idx` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apunte`
--
ALTER TABLE `apunte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `comentarioapunte`
--
ALTER TABLE `comentarioapunte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comentariogrupo`
--
ALTER TABLE `comentariogrupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `universidad`
--
ALTER TABLE `universidad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apunte`
--
ALTER TABLE `apunte`
ADD CONSTRAINT `ap_as_fk` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ap_usu_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
ADD CONSTRAINT `asig_carr_fk` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
ADD CONSTRAINT `universidad_fk` FOREIGN KEY (`universidad_id`) REFERENCES `universidad` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarioapunte`
--
ALTER TABLE `comentarioapunte`
ADD CONSTRAINT `com_ap_ap_fk` FOREIGN KEY (`apunte_id`) REFERENCES `apunte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `com_ap_usu_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentariogrupo`
--
ALTER TABLE `comentariogrupo`
ADD CONSTRAINT `com_grupo_fk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `com_grupo_usu_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`alice_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `contacto_ibfk_2` FOREIGN KEY (`bob_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `etiquetaapunte`
--
ALTER TABLE `etiquetaapunte`
ADD CONSTRAINT `eti_apunte_id` FOREIGN KEY (`apunte_id`) REFERENCES `apunte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `etiqueta_fk` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiqueta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
ADD CONSTRAINT `emisor_fk` FOREIGN KEY (`emisor_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `receptor_fk` FOREIGN KEY (`receptor_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usu_carrera_fk` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariogrupo`
--
ALTER TABLE `usuariogrupo`
ADD CONSTRAINT `grupo_usu_fk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usu_grupo_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariointeractuaapunte`
--
ALTER TABLE `usuariointeractuaapunte`
ADD CONSTRAINT `apunte_int_fk` FOREIGN KEY (`apunte_id`) REFERENCES `apunte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usu_int_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
