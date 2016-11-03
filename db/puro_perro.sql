-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-11-2016 a las 15:49:04
-- Versión del servidor: 10.0.26-MariaDB-0+deb8u1
-- Versión de PHP: 5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `puro_perro`
--
CREATE DATABASE IF NOT EXISTS `puro_perro` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `puro_perro`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--

DROP TABLE IF EXISTS `aviso`;
CREATE TABLE IF NOT EXISTS `aviso` (
`id` bigint(19) NOT NULL,
  `tipo_aviso_id` smallint(5) NOT NULL,
  `estado_aviso_id` smallint(5) NOT NULL,
  `created_by` bigint(19) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `perro_id` bigint(19) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` bigint(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
`id` int(10) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color`(`nombre`) VALUES
('Nácar'),
('Oliva'),
('Blanco'),
('Verde'),
('Gris'),
('Merengue tostado'),
('Caramelo'),
('Rosa'),
('Beis'),
('Aguamarina'),
('Azul'),
('Almendra'),
('Marrón'),
('Negro'),
('Chocolate'),
('Café con leche'),
('Coral'),
('Cian'),
('Magenta'),
('Rojo'),
('Salmón'),
('Amarillo'),
('Oro'),
('Verde Marino'),
('Azul Marino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_aviso`
--

DROP TABLE IF EXISTS `estado_aviso`;
CREATE TABLE IF NOT EXISTS `estado_aviso` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_aviso`
--

INSERT INTO `estado_aviso` (`id`, `nombre`, `valor`) VALUES
(1, 'Abierto', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_clinico`
--

DROP TABLE IF EXISTS `estado_clinico`;
CREATE TABLE IF NOT EXISTS `estado_clinico` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_imagen`
--

DROP TABLE IF EXISTS `estado_imagen`;
CREATE TABLE IF NOT EXISTS `estado_imagen` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_perro`
--

DROP TABLE IF EXISTS `estado_perro`;
CREATE TABLE IF NOT EXISTS `estado_perro` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_tratamiento`
--

DROP TABLE IF EXISTS `estado_tratamiento`;
CREATE TABLE IF NOT EXISTS `estado_tratamiento` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuario`
--

DROP TABLE IF EXISTS `estado_usuario`;
CREATE TABLE IF NOT EXISTS `estado_usuario` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_usuario`
--

INSERT INTO `estado_usuario` (`id`, `nombre`, `valor`) VALUES
(1, 'Habilitado', 10),
(2, 'Deshabilitada', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
`id` bigint(19) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_imagen_id` smallint(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` bigint(19) NOT NULL,
  `updated_by` bigint(19) NOT NULL,
  `perro_id` bigint(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
`id` int(10) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `provincia_id` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `nombre`, `provincia_id`) VALUES
(1, 'Neuquén Capital', 1),
(2, 'Plottier', 1),
(3, 'Centenario', 1),
(4, 'Cutral Có', 1),
(5, 'Cipolletti', 3),
(6, 'Viedma', 3),
(7, 'Chos Malal', 1),
(8, 'El Chocón', 1),
(9, 'General Rodriguez', 2),
(10, 'General Roca', 3),
(11, 'Senillosa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
`id` int(10) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perro`
--

DROP TABLE IF EXISTS `perro`;
CREATE TABLE IF NOT EXISTS `perro` (
`id` bigint(19) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `estado_perro_id` smallint(5) NOT NULL,
  `estado_clinico_id` smallint(5) NOT NULL,
  `color_primario` int(10) NOT NULL,
  `color_secundario` int(10) NOT NULL,
  `raza_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pais_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`, `pais_id`) VALUES
(1, 'Neuquén', 1),
(2, 'Buenos Aires', 1),
(3, 'Río Negro', 1),
(4, 'Mendoza', 1),
(5, 'San Juan', 1),
(6, 'La Rioja', 1),
(7, 'Catamarca', 1),
(8, 'Santa Fe', 1),
(9, 'Chubut', 1),
(10, 'Santa Cruz', 1),
(11, 'La Pampa', 1),
(12, 'Fomosa', 1),
(13, 'Chaco', 1),
(14, 'Misiones', 1),
(15, 'Corrientes', 1),
(16, 'Tierra del Fuego', 1),
(17, 'Salta', 1),
(18, 'Jujuy', 1),
(19, 'Córdoba', 1),
(20, 'Ciudad Autónoma de Buenos Aires', 1),
(21, 'Santiago del Estero', 1),
(22, 'San Luis', 1),
(23, 'Entre Ríos', 1),
(24, 'Tucumán', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

DROP TABLE IF EXISTS `raza`;
CREATE TABLE IF NOT EXISTS `raza` (
`id` int(10) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
`id` smallint(5) NOT NULL,
  `rol_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rol_valor` smallint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol_nombre`, `rol_valor`) VALUES
(1, 'usuario', 10),
(2, 'admin', 20),
(3, 'root', 30),
(4, 'auditor', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_aviso`
--

DROP TABLE IF EXISTS `tipo_aviso`;
CREATE TABLE IF NOT EXISTS `tipo_aviso` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_aviso`
--

INSERT INTO `tipo_aviso` (`id`, `nombre`) VALUES
(1, 'Perro Perdido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_user`
--

DROP TABLE IF EXISTS `tipo_user`;
CREATE TABLE IF NOT EXISTS `tipo_user` (
  `id` smallint(4) NOT NULL,
  `tipo_user_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_user_valor` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_user`
--

INSERT INTO `tipo_user` (`id`, `tipo_user_nombre`, `tipo_user_valor`) VALUES
(1, 'Gratuito', 10),
(2, 'Pago', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

DROP TABLE IF EXISTS `tratamiento`;
CREATE TABLE IF NOT EXISTS `tratamiento` (
`id` bigint(19) NOT NULL,
  `perro_id` bigint(19) NOT NULL,
  `veterinaria_id` int(10) NOT NULL,
  `estado_clinico_id` smallint(5) NOT NULL,
  `usuario_id` bigint(19) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` float NOT NULL,
  `pagado` float NOT NULL DEFAULT '0',
  `estado_tratamiento_id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` bigint(19) NOT NULL,
  `apodo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_fijo` int(10) DEFAULT NULL,
  `telefono_celular` int(10) DEFAULT NULL,
  `localidad_id` int(10) NOT NULL,
  `estado_usuario_id` smallint(5) NOT NULL DEFAULT '1',
  `tipo_usuario_id` smallint(4) NOT NULL DEFAULT '1',
  `rol_id` smallint(5) NOT NULL DEFAULT '1',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `desea_adoptar` tinyint(4) NOT NULL DEFAULT '0',
  `ofrece_transito` tinyint(4) NOT NULL DEFAULT '0',
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `apodo`, `nombre`, `apellido`, `domicilio`, `telefono_fijo`, `telefono_celular`, `localidad_id`, `estado_usuario_id`, `tipo_usuario_id`, `rol_id`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `created_at`, `updated_at`, `desea_adoptar`, `ofrece_transito`, `latitud`, `longitud`) VALUES
(1, 'prueba', 'Prueba', 'Prueba', 'Prueba 2816, Neuquén', NULL, 15555555, 8, 1, 1, 1, 'prueba@gmail.com', 'H3dG8ndDoN5QfyDiRHjHdtwfMzcax-Q2', '$2y$10$FOoSlFznO6pU/JWK5k3baOPH23.1XZ5LCRK7kJq/8/2dh0r6tyQla', 'null', '2016-11-03 13:23:11', '2016-11-03 13:23:11', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinaria`
--

DROP TABLE IF EXISTS `veterinaria`;
CREATE TABLE IF NOT EXISTS `veterinaria` (
`id` int(10) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `domicilio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `veterinario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `localidad_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviso`
--
ALTER TABLE `aviso`
 ADD PRIMARY KEY (`id`), ADD KEY `FKaviso48388` (`tipo_aviso_id`), ADD KEY `FKaviso500203` (`estado_aviso_id`), ADD KEY `FKaviso41529` (`created_by`), ADD KEY `FKaviso988422` (`perro_id`), ADD KEY `FKaviso104635` (`updated_by`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_aviso`
--
ALTER TABLE `estado_aviso`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`), ADD UNIQUE KEY `valor` (`valor`);

--
-- Indices de la tabla `estado_clinico`
--
ALTER TABLE `estado_clinico`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_imagen`
--
ALTER TABLE `estado_imagen`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_perro`
--
ALTER TABLE `estado_perro`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_tratamiento`
--
ALTER TABLE `estado_tratamiento`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`), ADD UNIQUE KEY `valor` (`valor`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
 ADD PRIMARY KEY (`id`), ADD KEY `FKimagen465012` (`perro_id`), ADD KEY `FKimagen588093` (`created_by`), ADD KEY `FKimagen558070` (`updated_by`), ADD KEY `FKimagen823804` (`estado_imagen_id`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
 ADD PRIMARY KEY (`id`), ADD KEY `FKlocalidad28097` (`provincia_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `perro`
--
ALTER TABLE `perro`
 ADD PRIMARY KEY (`id`), ADD KEY `FKperro638026` (`estado_perro_id`), ADD KEY `FKperro823844` (`estado_clinico_id`), ADD KEY `FKperro646449` (`color_primario`), ADD KEY `FKperro875864` (`color_secundario`), ADD KEY `FKperro940281` (`raza_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`), ADD KEY `FKprovincia125535` (`pais_id`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`rol_nombre`), ADD UNIQUE KEY `valor` (`rol_valor`);

--
-- Indices de la tabla `tipo_aviso`
--
ALTER TABLE `tipo_aviso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
 ADD PRIMARY KEY (`id`), ADD KEY `FKtratamient543329` (`estado_tratamiento_id`), ADD KEY `FKtratamient385568` (`veterinaria_id`), ADD KEY `FKtratamient276070` (`usuario_id`), ADD KEY `FKtratamient446396` (`perro_id`), ADD KEY `FKtratamient279129` (`estado_clinico_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD KEY `user_tiene_rol` (`rol_id`), ADD KEY `user_tiene_estado` (`estado_usuario_id`), ADD KEY `user_vive_en` (`localidad_id`), ADD KEY `user_tiene_tipo` (`tipo_usuario_id`);

--
-- Indices de la tabla `veterinaria`
--
ALTER TABLE `veterinaria`
 ADD PRIMARY KEY (`id`), ADD KEY `FKveterinari89844` (`localidad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviso`
--
ALTER TABLE `aviso`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_aviso`
--
ALTER TABLE `estado_aviso`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estado_clinico`
--
ALTER TABLE `estado_clinico`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_imagen`
--
ALTER TABLE `estado_imagen`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_perro`
--
ALTER TABLE `estado_perro`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_tratamiento`
--
ALTER TABLE `estado_tratamiento`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `perro`
--
ALTER TABLE `perro`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_aviso`
--
ALTER TABLE `tipo_aviso`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `veterinaria`
--
ALTER TABLE `veterinaria`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aviso`
--
ALTER TABLE `aviso`
ADD CONSTRAINT `FKaviso104635` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKaviso41529` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKaviso48388` FOREIGN KEY (`tipo_aviso_id`) REFERENCES `tipo_aviso` (`id`),
ADD CONSTRAINT `FKaviso500203` FOREIGN KEY (`estado_aviso_id`) REFERENCES `estado_aviso` (`id`),
ADD CONSTRAINT `FKaviso988422` FOREIGN KEY (`perro_id`) REFERENCES `perro` (`id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
ADD CONSTRAINT `FKimagen465012` FOREIGN KEY (`perro_id`) REFERENCES `perro` (`id`),
ADD CONSTRAINT `FKimagen558070` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKimagen588093` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKimagen823804` FOREIGN KEY (`estado_imagen_id`) REFERENCES `estado_imagen` (`id`);

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
ADD CONSTRAINT `FKlocalidad28097` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);

--
-- Filtros para la tabla `perro`
--
ALTER TABLE `perro`
ADD CONSTRAINT `FKperro638026` FOREIGN KEY (`estado_perro_id`) REFERENCES `estado_perro` (`id`),
ADD CONSTRAINT `FKperro646449` FOREIGN KEY (`color_primario`) REFERENCES `color` (`id`),
ADD CONSTRAINT `FKperro823844` FOREIGN KEY (`estado_clinico_id`) REFERENCES `estado_clinico` (`id`),
ADD CONSTRAINT `FKperro875864` FOREIGN KEY (`color_secundario`) REFERENCES `color` (`id`),
ADD CONSTRAINT `FKperro940281` FOREIGN KEY (`raza_id`) REFERENCES `raza` (`id`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
ADD CONSTRAINT `FKprovincia125535` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
ADD CONSTRAINT `FKtratamient276070` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKtratamient279129` FOREIGN KEY (`estado_clinico_id`) REFERENCES `estado_clinico` (`id`),
ADD CONSTRAINT `FKtratamient385568` FOREIGN KEY (`veterinaria_id`) REFERENCES `veterinaria` (`id`),
ADD CONSTRAINT `FKtratamient446396` FOREIGN KEY (`perro_id`) REFERENCES `perro` (`id`),
ADD CONSTRAINT `FKtratamient543329` FOREIGN KEY (`estado_tratamiento_id`) REFERENCES `estado_tratamiento` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_tiene_estado` FOREIGN KEY (`estado_usuario_id`) REFERENCES `estado_usuario` (`id`),
ADD CONSTRAINT `user_tiene_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
ADD CONSTRAINT `user_tiene_tipo` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_user` (`id`),
ADD CONSTRAINT `user_vive_en` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`);

--
-- Filtros para la tabla `veterinaria`
--
ALTER TABLE `veterinaria`
ADD CONSTRAINT `FKveterinari89844` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
