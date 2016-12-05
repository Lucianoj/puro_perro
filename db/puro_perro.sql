-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2016 a las 01:19:01
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
-- Estructura de tabla para la tabla `adoptante`
--

DROP TABLE IF EXISTS `adoptante`;
CREATE TABLE IF NOT EXISTS `adoptante` (
`id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `estado_adoptante_id` smallint(6) DEFAULT '1',
  `tiene_otros_perros` tinyint(1) NOT NULL DEFAULT '0',
  `tiene_ninios` tinyint(1) NOT NULL DEFAULT '0',
  `tiene_patio_cerrado` tinyint(1) NOT NULL DEFAULT '0',
  `tiene_gatos` tinyint(1) NOT NULL DEFAULT '0',
  `deja_casa_sola_muchas_horas` tinyint(1) NOT NULL DEFAULT '0',
  `puede_atender_mascota_enferma` tinyint(1) NOT NULL DEFAULT '0',
  `acepta_visitas_de_control` tinyint(1) NOT NULL DEFAULT '0',
  `comentarios` text COLLATE utf8_unicode_ci,
  `nota_admin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `adoptante`
--

INSERT INTO `adoptante` (`id`, `user_id`, `estado_adoptante_id`, `tiene_otros_perros`, `tiene_ninios`, `tiene_patio_cerrado`, `tiene_gatos`, `deja_casa_sola_muchas_horas`, `puede_atender_mascota_enferma`, `acepta_visitas_de_control`, `comentarios`, `nota_admin`) VALUES
(1, 1, 2, 0, 1, 1, 0, 1, 0, 1, 'Me gustaría adoptar un perro que sea cariñoso con los niños. En lo posible que no sea muy grande de tamaño. Puedo hacerme cargo de castrarlo. ', 'Nos comunicamos, visitamos el lugar y cumple con nuestras espectativas. Está dispuesto a adoptar hasta 3 perros. '),
(2, 3, 2, 1, 1, 1, 1, 1, 1, 1, 'Laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum', 'Puede adoptar un perro pequeño o mediano que no sea malo con los gatos'),
(3, 5, 3, 1, 1, 0, 1, 1, 0, 1, 'Me gustaría adoptar un perro que se porte bien y le haga compañía a mi otro perro. ', 'No tiene patio cerrado y no está en condiciones de hacerse cargo de otra mascota. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--

DROP TABLE IF EXISTS `aviso`;
CREATE TABLE IF NOT EXISTS `aviso` (
`id` bigint(19) NOT NULL,
  `tipo_aviso_id` smallint(5) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `informacion` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_evento` date NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `perro_id` bigint(19) DEFAULT NULL,
  `estado_aviso_id` smallint(5) NOT NULL,
  `created_by` bigint(19) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` bigint(19) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `aviso`
--

INSERT INTO `aviso` (`id`, `tipo_aviso_id`, `titulo`, `informacion`, `fecha_evento`, `direccion`, `latitud`, `longitud`, `perro_id`, `estado_aviso_id`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(3, 1, 'Se perdió Tita', 'Tita es buena y está castrada', '2016-11-02', 'Santiago del Estero 250, Neuquén, Neuquén', -38.9524, -68.0648, NULL, 1, 1, '2016-12-04 00:48:19', '2016-11-06 23:36:32', 1),
(4, 1, 'Buscamos a Firulais', 'Firulais es pequeñito, tiene 2 meses y nunca durmió fuera de casa.', '2016-11-01', 'Manuel Belgrano 115, Neuquén', -38.9506, -68.0609, NULL, 1, 1, '2016-12-04 00:48:19', '2016-11-06 23:39:40', 1),
(5, 1, 'Buscamos a Firulais', 'Firulais es pequeñito, tiene 2 meses y nunca durmió fuera de casa.', '2016-11-06', 'Manuel Belgrano 115, Neuquén', -38.9506, -68.0609, NULL, 1, 1, '2016-12-04 00:48:19', '2016-11-06 23:42:06', 1),
(6, 1, 'Buscamos a Firulais', 'Firulais es un pitbull  joven, tiene 1 año y 2 meses y nunca durmió fuera de casa.', '2016-11-29', 'Manuel Belgrano 115, Neuquén', -38.9506, -68.0609, 2, 2, 1, '2016-12-04 02:28:16', '2016-12-04 02:28:16', 1),
(7, 1, 'Busco a Tom', 'Tom es pequeñito, tiene 2 meses y nunca durmió fuera de casa.', '2016-11-24', 'Manuel Belgrano 115, Neuquén', -38.9506, -68.0609, 3, 1, 1, '2016-12-04 23:49:01', '2016-12-02 20:43:16', 1),
(8, 1, 'Se perdió Tita', 'Tita es re buena y nunca durmió afuera. Tiene collar rosa. Está vacunada. ', '2016-11-22', 'Galarza 1700, Neuquén, Neuquén', -38.9488, -68.0898, 4, 2, 3, '2016-12-04 08:25:57', '2016-12-04 08:25:57', 1),
(9, 2, 'Encontré un Perro con 3 patas', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', '2016-11-24', 'Santa Fé 350, Neuquén, Neuquén', -38.9513, -68.0564, 5, 1, 1, '2016-12-04 00:48:19', '2016-11-24 03:17:45', 1),
(10, 3, 'Hermoso perro en adopción responsable', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', '2016-11-12', 'San Martín 3700, Neuquén', -38.9548, -68.1108, 6, 2, 1, '2016-12-04 00:48:19', '2016-11-24 02:48:30', 1),
(11, 3, 'Doy Salchicha en Adopción', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', '2016-11-20', 'Perito Moreno 900, Neuquén', -38.9584, -68.0466, 7, 2, 1, '2016-12-04 00:48:19', '2016-11-24 02:48:05', 1),
(12, 2, 'Perra asustada en Wall Mart', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', '2016-12-02', 'Eugenio Perticone 1203, 8300 Neuquén', -38.9599, -68.0423, 8, 1, 3, '2016-12-04 00:48:19', '2016-12-03 23:19:17', 1),
(13, 1, 'Perdi a mi perro ovejero', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat', '2016-12-01', 'Cipolletti 200, Neuquén, Neuquén', -38.9511, -68.0993, 9, 1, 4, '2016-12-04 00:48:19', '2016-12-01 14:10:51', 1),
(14, 1, 'Perdí a Tom', 'it quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis au', '2016-11-23', 'Lastra 782, Neuquén, Neuquén', -38.9596, -68.0702, 10, 1, 4, '2016-12-04 00:48:19', '2016-11-24 02:47:29', 1),
(15, 1, 'Perdi mi perro', '"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"', '2016-11-09', 'Perito Moreno 900, Neuquén', -38.9584, -68.0466, 11, 1, 4, '2016-12-04 00:48:19', '2016-11-24 02:47:06', 1),
(16, 1, 'Perdí a mi perra', 'Sábete, Sancho, que no es un hombre más que otro si no hace más que otro. Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca. Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no te cabe parte dellas.Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro. Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca. Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no ', '2016-11-15', 'Santa Fé 690, Neuquén, Neuquén', -38.9477, -68.0562, NULL, 1, 1, '2016-12-04 00:48:19', '2016-11-23 23:02:35', 1),
(17, 1, 'Perdí a mi perra', 'Sábete, Sancho, que no es un hombre más que otro si no hace más que otro. Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca. Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no te cabe parte dellas.Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro. Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca. Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no ', '2015-07-23', 'Santa Fé 690, Neuquén, Neuquén', -38.9477, -68.0562, NULL, 1, 1, '2016-12-04 00:48:19', '2016-11-23 23:07:34', 1),
(18, 1, 'Busco a Gregorio Samsa', 'Una mañana, tras un sueño intranquilo, Gregorio Samsa se despertó convertido en un monstruoso insecto. Estaba echado de espaldas sobre un duro caparazón y, al alzar la cabeza, vio su vientre convexo y oscuro, surcado por curvadas callosidades, sobre el que casi no se aguantaba la colcha, que estaba a punto de escurrirse hasta el suelo. Numerosas patas, penosamente delgadas en comparación con el grosor normal de sus piernas, se agitaban sin concierto. - ¿Qué me ha ocurrido?', '2016-10-28', 'Santa Fé 690, Neuquén, Neuquén', -38.9477, -68.0562, NULL, 1, 1, '2016-12-04 00:48:19', '2016-11-24 02:05:07', 1),
(19, 1, 'Busco a Gregorio Samsa', 'Una mañana, tras un sueño intranquilo, Gregorio Samsa se despertó convertido en un monstruoso insecto. Estaba echado de espaldas sobre un duro caparazón y, al alzar la cabeza, vio su vientre convexo y oscuro, surcado por curvadas callosidades, sobre el que casi no se aguantaba la colcha, que estaba a punto de escurrirse hasta el suelo. Numerosas patas, penosamente delgadas en comparación con el grosor normal de sus piernas, se agitaban sin concierto. - ¿Qué me ha ocurrido?', '2016-11-16', 'Santa Fé 690, Neuquén, Neuquén', -38.9477, -68.0562, 12, 1, 1, '2016-12-04 00:48:19', '2016-11-24 02:29:14', 1),
(20, 2, 'Encontré una perra ', 'cuando el sol de mediodía centellea sobre la impenetrable sombra de mi bosque sin conseguir otra cosa que filtrar entre las hojas algunos rayos que penetran hasta el fondo del santuario, cuando recostado sobre la crecida hierba, cerca de la cascada, mi vista, más próxima a la tierra, descubre multitud de menudas y diversas plantas; cuando siento más cerca de mi corazón los rumores de vida de ese pequeño mundo que palpita en los tallos de las hojas, y veo las formas innumerables e infinitas de los gusanillos y de los insectos; cuando siento, en fin, la presencia del Todopoderoso, que nos ha creado ', '2016-12-02', 'Galarza 1700, Neuquén, Neuquén', -38.9488, -68.0898, 13, 1, 3, '2016-12-04 00:48:19', '2016-12-03 23:19:55', 1),
(21, 2, 'Encontré un perro desorientado', 'En la zona del Aeropuerto, estaba perdido, lo tengo en casa which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur.', '2016-08-28', 'Huanquero 5219, Neuquén', -38.9532, -68.132, 14, 2, 5, '2016-12-02 03:03:14', '2016-12-02 03:03:14', 5),
(22, 1, 'Busco a Pancha', ' On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact, it va esser Occidental.', '2016-12-01', 'Santa Fé 150, Neuquén, Neuquén', -38.9535, -68.0562, 17, 1, 1, '2016-12-04 09:06:43', '2016-12-04 09:06:43', 1),
(23, 3, 'Doy perro en adopción responsable', ' On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact, it va esser Occidental.', '0002-04-06', 'Calle Ejemplo 123, Neuquén, Neuquén', NULL, NULL, 18, 1, 1, '2016-12-04 09:13:23', '2016-12-04 09:13:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos_exito`
--

DROP TABLE IF EXISTS `casos_exito`;
CREATE TABLE IF NOT EXISTS `casos_exito` (
`id` int(11) NOT NULL,
  `aviso_id` bigint(20) NOT NULL,
  `perro_id` bigint(20) NOT NULL,
  `mensaje` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` bigint(19) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` bigint(19) NOT NULL,
  `foto_reencuentro` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `casos_exito`
--

INSERT INTO `casos_exito` (`id`, `aviso_id`, `perro_id`, `mensaje`, `created_by`, `created_at`, `updated_at`, `updated_by`, `foto_reencuentro`) VALUES
(1, 6, 2, 'No lo puedo creer!! Gracias Puro Perro!! Me llamó una señora que vió el aviso que publiqué. A Firulais lo tenía su hijo, lo encontró en un baldío. Ya está con nosotros!', 1, '2016-12-01 04:02:31', '2016-12-01 04:02:31', 1, 'uploads/Firulais_reencuentro.jpg'),
(2, 10, 6, 'Weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish', 1, '2016-12-01 12:19:45', '2016-12-01 12:19:45', 1, 'uploads/Pancho_reencuentro.jpg'),
(3, 11, 7, 'Pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 1, '2016-12-01 12:20:54', '2016-12-01 12:20:54', 1, 'uploads/Juanita_reencuentro.jpg'),
(4, 21, 14, 'Se contactó conmigo la dueña a través del sistema de mail interno de Puro Perro. Estoy super contenta que ustedes brinden este servicio. Publicaré siempre porque veo que funciona!! ', 5, '2016-12-02 03:03:14', '2016-12-02 03:03:14', 5, 'uploads/Perrito Gris_reencuentro.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
`id` int(10) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id`, `nombre`) VALUES
(1, 'Blanco'),
(2, 'Negro'),
(3, 'Gris'),
(4, 'Marrón'),
(5, 'Marrón Claro'),
(6, 'Beige'),
(7, 'Dorado'),
(8, 'Amarillo'),
(9, 'Crema'),
(10, 'Atigrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_adoptante`
--

DROP TABLE IF EXISTS `estado_adoptante`;
CREATE TABLE IF NOT EXISTS `estado_adoptante` (
`id` smallint(6) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_adoptante`
--

INSERT INTO `estado_adoptante` (`id`, `nombre`, `valor`) VALUES
(1, 'Nuevo', 10),
(2, 'Aceptado', 20),
(3, 'Rechazado', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_aviso`
--

DROP TABLE IF EXISTS `estado_aviso`;
CREATE TABLE IF NOT EXISTS `estado_aviso` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_aviso`
--

INSERT INTO `estado_aviso` (`id`, `nombre`, `valor`) VALUES
(1, 'Abierto', 10),
(2, 'Cerrado', 20),
(3, 'Reportado', 30),
(4, 'Eliminado', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_clinico`
--

DROP TABLE IF EXISTS `estado_clinico`;
CREATE TABLE IF NOT EXISTS `estado_clinico` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_clinico`
--

INSERT INTO `estado_clinico` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Sano', 'El perro no presenta síntomas visibles de estar lastimado o tener algún tipo de enfermedad. '),
(2, 'Sarna', 'El perro tiene muestras visibles de poseer sarna'),
(3, 'Lastimado (piel)', 'El perro presenta una herida visible en la piel. '),
(4, 'Lastimado (hueso)', 'El perro presenta un claro síntoma de fractura o dislocamiento'),
(5, 'Preñada', 'La perra se encuentra preñada'),
(6, 'Ausencia de miembro', 'El perro presenta amputación total o parcial de al menos un miembro');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_perro`
--

INSERT INTO `estado_perro` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Perdido', 'El perro se encuentra perdido'),
(2, 'Encontrado', 'El perro fue encontrado y busca a sus dueños'),
(3, 'Reencontrado', 'El perro encontró a sus dueños'),
(4, 'Tránsito', 'El perro se encuentra en tránsito momentáneo'),
(5, 'Adopción', 'El perro busca adoptantes'),
(6, 'Adoptado', 'El perro encontró una familia!!');

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
(2, 'Deshabilitado', 20);

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
  `raza_id` int(10) NOT NULL,
  `tamanio_id` smallint(6) NOT NULL,
  `tiene_collar` tinyint(1) NOT NULL DEFAULT '0',
  `esta_enfermo` tinyint(1) NOT NULL DEFAULT '0',
  `tiene_marca_visible` tinyint(1) NOT NULL DEFAULT '0',
  `marca_visible_detalle` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_faltan_miembros` tinyint(1) NOT NULL DEFAULT '0',
  `sexo_id` tinyint(1) NOT NULL DEFAULT '1',
  `preniada` tinyint(1) NOT NULL DEFAULT '0',
  `edad_estimada` tinyint(2) NOT NULL,
  `cola_cortada` tinyint(1) NOT NULL DEFAULT '0',
  `orejas_cortadas` tinyint(1) NOT NULL DEFAULT '0',
  `castrada` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_pelo_id` smallint(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perro`
--

INSERT INTO `perro` (`id`, `nombre`, `estado_perro_id`, `estado_clinico_id`, `color_primario`, `color_secundario`, `raza_id`, `tamanio_id`, `tiene_collar`, `esta_enfermo`, `tiene_marca_visible`, `marca_visible_detalle`, `le_faltan_miembros`, `sexo_id`, `preniada`, `edad_estimada`, `cola_cortada`, `orejas_cortadas`, `castrada`, `foto`, `tipo_pelo_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'Firulais', 3, 1, 4, 4, 48, 1, 0, 0, 0, '', 0, 1, 0, 4, 1, 1, 0, 'uploads/Firulais.jpg', 5, '2016-11-06 20:46:31', 1, '2016-12-03 23:28:16', 1),
(3, 'Tom', 1, 1, 1, 4, 48, 1, 1, 0, 0, '', 0, 1, 0, 2, 0, 0, 0, 'uploads/Tom.jpg', 1, '2016-11-06 20:46:33', 1, '2016-12-02 17:43:19', 1),
(4, 'Tita', 3, 1, 3, 2, 222, 1, 0, 0, 0, '', 0, 2, 0, 0, 0, 0, 0, 'uploads/Tita.jpg', 1, '2016-11-07 19:00:36', 3, '2016-12-04 05:25:57', 1),
(5, 'Pichico', 2, 1, 6, 5, 241, 1, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, 0, 'uploads/Pichico.jpg', 1, '2016-11-07 19:31:11', 1, '2016-11-24 00:17:45', 1),
(6, 'Pancho', 3, 1, 2, 2, 241, 1, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, 0, 'uploads/Pancho.jpg', 1, '2016-11-07 19:32:35', 1, '2016-11-23 23:48:30', 1),
(7, 'Juanita', 3, 1, 5, 4, 74, 1, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, 0, 'uploads/Juanita.jpg', 1, '2016-11-07 19:34:01', 1, '2016-11-23 23:48:05', 1),
(8, 'No tiene', 2, 1, 7, 9, 22, 1, 0, 0, 0, '', 0, 2, 0, 0, 0, 0, 0, 'uploads/dog_without_name.png', 1, '2016-11-07 19:36:24', 3, '2016-12-03 20:19:17', 1),
(9, 'Sultán', 1, 1, 4, 2, 139, 4, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, 0, 'uploads/Sultán.jpg', 1, '2016-11-07 19:47:43', 4, '2016-12-01 11:10:51', 1),
(10, 'Tóm', 1, 3, 5, 2, 79, 1, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, 0, 'uploads/Tóm.jpg', 1, '2016-11-07 19:52:21', 4, '2016-11-23 23:47:29', 1),
(11, 'Poncho', 1, 3, 4, 2, 241, 1, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, 0, 'uploads/Poncho.jpg', 1, '2016-11-07 20:31:06', 4, '2016-11-23 23:47:06', 1),
(12, 'Gregorio Samsa', 1, 1, 2, 4, 2, 3, 1, 0, 0, '', 0, 1, 0, 4, 0, 0, 0, 'uploads/Gregorio Samsa.jpg', 2, '2016-11-23 23:29:14', 1, '2016-11-23 23:29:14', 1),
(13, 'NN', 2, 2, 9, 4, 241, 3, 0, 1, 1, 'escoriaciones en la piel', 0, 2, 0, 8, 1, 1, 0, 'uploads/NN.jpg', 3, '2016-11-24 01:01:11', 3, '2016-12-03 20:19:55', 1),
(14, 'Perrito Gris', 3, 1, 3, 1, 241, 2, 0, 0, 0, '', 0, 1, 0, 5, 0, 0, 2, 'uploads/No lo sé.jpg', 3, '2016-12-01 21:51:02', 5, '2016-12-02 00:03:14', 5),
(17, 'Pancha', 1, 1, 4, 1, 241, 2, 0, 0, 0, '', 0, 2, 0, 3, 0, 0, 1, 'uploads/Pancha.jpg', 4, '2016-12-04 06:06:43', 1, '2016-12-04 06:06:43', 1),
(18, 'Loba', 5, 1, 2, 4, 241, 3, 0, 0, 0, '', 0, 2, 0, 4, 0, 0, 1, 'uploads/Loba.jpg', 1, '2016-12-04 06:13:23', 1, '2016-12-04 06:22:02', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `nombre`) VALUES
(1, 'Affenpinscher'),
(2, 'Airedale terrier'),
(3, 'Aïdi'),
(4, 'Akita Inu'),
(5, 'Akita Americano'),
(6, 'Alano español'),
(7, 'Alaskan malamute'),
(8, 'Alaskan Klee Kai'),
(9, 'American Hairless terrier'),
(10, 'American Staffordshire Terrier'),
(11, 'Antiguo Perro Pastor Inglés'),
(12, 'Appenzeller'),
(13, 'Australian Cattle Dog'),
(14, 'Australian terrier'),
(15, 'Australian Silky Terrier'),
(16, 'Azawakh'),
(17, 'Bardino (Perro majorero)'),
(18, 'Basenji'),
(19, 'Basset azul de Gascuña'),
(20, 'Basset hound'),
(21, 'Beagle'),
(22, 'Beauceron'),
(23, 'Bedlington terrier'),
(24, 'Bergamasco'),
(25, 'Bichon frisé'),
(26, 'Bichón maltés'),
(27, 'Bichón habanero'),
(28, 'Bobtail'),
(29, 'Bloodhound'),
(30, 'Border collie'),
(31, 'Borzoi'),
(32, 'Boston terrier'),
(33, 'Bóxer'),
(34, 'Boyero de Berna'),
(35, 'Boyero de Flandes'),
(36, 'Braco alemán de pelo corto'),
(37, 'Braco alemán de pelo duro'),
(38, 'Braco de Auvernia'),
(39, 'Braco francés'),
(40, 'Braco húngaro'),
(41, 'Braco italiano'),
(42, 'Braco tirolés'),
(43, 'Braco de Saint Germain'),
(44, 'Braco de Weimar'),
(45, 'Bull Terrier'),
(46, 'Bulldog americano'),
(47, 'Bulldog francés'),
(48, 'Bulldog inglés'),
(49, 'Bullmastiff'),
(50, 'Buhund noruego'),
(51, 'Can de palleiro'),
(52, 'Caniche'),
(53, 'Cão da Serra da Estrela'),
(54, 'Cão da Serra de Aires'),
(55, 'Cão de Agua Português'),
(56, 'Cão de Castro Laboreiro'),
(57, 'Cão de Fila de São Miguel'),
(58, 'Cavalier King Charles Spaniel'),
(59, 'Cazador de alces noruego'),
(60, 'Chesapeake Bay Retriever'),
(61, 'Chihuahueño'),
(62, 'Crestado Chino'),
(63, 'Cimarrón Uruguayo'),
(64, 'Cirneco del Etna'),
(65, 'Chow chow'),
(66, 'Clumber spaniel'),
(67, 'Cobrador de pelo liso'),
(68, 'Cocker spaniel americano'),
(69, 'Cocker spaniel inglés'),
(70, 'Collie de pelo corto'),
(71, 'Collie de pelo largo'),
(72, 'Bearded collie'),
(73, 'Corgi galés de Cardigan'),
(74, 'Dachshund'),
(75, 'Dálmata'),
(76, 'Dandie Dinmont Terrier'),
(77, 'Deerhound'),
(78, 'Dobermann'),
(79, 'Dogo alemán'),
(80, 'Dogo argentino'),
(81, 'Dogo de burdeos'),
(82, 'Dogo del Tíbet'),
(83, 'Dogo guatemalteco'),
(84, 'English springer spaniel'),
(85, 'Entlebucher'),
(86, 'Épagneul bretón'),
(87, 'Épagneul français'),
(88, 'Epagneul papillón'),
(89, 'Eurasier'),
(90, 'Fila Brasileiro'),
(91, 'Flat-Coated Retriever'),
(92, 'Fox Terrier'),
(93, 'Foxhound americano'),
(94, 'Galgo español'),
(95, 'Galgo húngaro'),
(96, 'Galgo inglés'),
(97, 'Galgo italiano'),
(98, 'Golden retriever'),
(99, 'Glen of Imaal Terrier'),
(100, 'Gran danés'),
(101, 'Gegar colombiano'),
(102, 'Greyhound'),
(103, 'Grifón belga'),
(104, 'Hovawart'),
(105, 'Husky siberiano'),
(106, 'Jack Russell Terrier'),
(107, 'Keeshond'),
(108, 'Kerry blue terrier'),
(109, 'Komondor'),
(110, 'Kuvasz'),
(111, 'Labrador'),
(112, 'Lakeland Terrier'),
(113, 'Laekenois'),
(114, 'Landseer'),
(115, 'Lebrel afgano'),
(116, 'Lebrel polaco'),
(117, 'Leonberger'),
(118, 'Lobero irlandés'),
(119, 'Lundehund'),
(120, 'Perro lobo de Saarloos'),
(121, 'Lhasa apso'),
(122, 'Löwchen'),
(123, 'Maltés'),
(124, 'Malinois'),
(125, 'Manchester terrier'),
(126, 'Mastín afgano'),
(127, 'Mastín del Pirineo'),
(128, 'Mastín español'),
(129, 'Mastín inglés'),
(130, 'Mastín italiano'),
(131, 'Mastín napolitano'),
(132, 'Mastín tibetano'),
(133, 'Mucuchies'),
(134, 'Mudi'),
(135, 'Münsterländer grande'),
(136, 'Münsterländer pequeño'),
(137, 'Nova Scotia Duck Tolling Retriever'),
(138, 'Ovejero magallánico'),
(139, 'Pastor alemán'),
(140, 'Pastor belga'),
(141, 'Pastor blanco suizo'),
(142, 'Pastor catalán'),
(143, 'Pastor croata'),
(144, 'Pastor garafiano'),
(145, 'Pastor holandés'),
(146, 'Pastor peruano Chiribaya'),
(147, 'Pastor de Brie'),
(148, 'Pastor de los Pirineos'),
(149, 'Pastor leonés'),
(150, 'Pastor mallorquín'),
(151, 'Pastor maremmano-abrucés'),
(152, 'Pastor de Valée'),
(153, 'Pastor vasco'),
(154, 'Pekinés'),
(155, 'Pembroke Welsh Corgi'),
(156, 'Pequeño Lebrel Italiano'),
(157, 'Perdiguero francés'),
(158, 'Perdiguero portugués'),
(159, 'Perro cimarrón uruguayo'),
(160, 'Perro de agua americano'),
(161, 'Perro de agua español'),
(162, 'Perro de agua irlandés'),
(163, 'Perro de agua portugués'),
(164, 'Perro de Groenlandia'),
(165, 'Perro de osos de Carelia'),
(166, 'Perro dogo mallorquín'),
(167, 'Perro esquimal canadiense'),
(168, 'Perro de Montaña de los Pirineos'),
(169, 'Perro fino colombiano'),
(170, 'Perro pastor de las islas Shetland'),
(171, 'Perro peruano sin pelo'),
(172, 'Phalène'),
(173, 'Pinscher alemán'),
(174, 'Pinscher miniatura'),
(175, 'Pitbull'),
(176, 'Podenco canario'),
(177, 'Podenco ibicenco'),
(178, 'Podenco portugués'),
(179, 'Pointer'),
(180, 'Pomerania'),
(181, 'Presa canario'),
(182, 'Pudelpointer'),
(183, 'Pug'),
(184, 'Puli'),
(185, 'Pumi'),
(186, 'Rafeiro do Alentejo'),
(187, 'Ratonero bodeguero andaluz'),
(188, 'Ratonero mallorquín'),
(189, 'Ratonero valenciano'),
(190, 'Rhodesian Ridgeback'),
(191, 'Rottweiler'),
(192, 'Saluki'),
(193, 'Samoyedo'),
(194, 'San Bernardo'),
(195, 'Schapendoes'),
(196, 'Schnauzer estándar'),
(197, 'Schnauzer gigante'),
(198, 'Schnauzer miniatura'),
(199, 'Staffordshire Bull Terrier'),
(200, 'Sabueso bosnio'),
(201, 'Schipperke'),
(202, 'Sealyham terrier'),
(203, 'Setter inglés'),
(204, 'Setter irlandés'),
(205, 'Shar Pei'),
(206, 'Shiba Inu'),
(207, 'Shih Tzu'),
(208, 'Shikoku Inu'),
(209, 'Siberian husky'),
(210, 'Skye terrier'),
(211, 'Spaniel japonés'),
(212, 'Spaniel tibetano'),
(213, 'Spitz enano'),
(214, 'Spitz grande'),
(215, 'Spitz mediano'),
(216, 'Spitz japonés'),
(217, 'Sussex spaniel'),
(218, 'Teckel'),
(219, 'Terranova'),
(220, 'Terrier alemán'),
(221, 'Terrier brasileño'),
(222, 'Terrier checo'),
(223, 'Terrier chileno'),
(224, 'Terrier de Norfolk'),
(225, 'Terrier de Norwich'),
(226, 'Terrier escocés'),
(227, 'Terrier galés'),
(228, 'Terrier irlandés'),
(229, 'Terrier ruso negro'),
(230, 'Terrier tibetano'),
(231, 'Toy spaniel inglés'),
(232, 'Tervueren'),
(233, 'Vallhund sueco'),
(234, 'Volpino italiano'),
(235, 'Weimaraner'),
(236, 'West Highland White Terrier'),
(237, 'Whippet'),
(238, 'Wolfsspitz'),
(239, 'Xoloitzcuintle'),
(240, 'Yorkshire terrier'),
(241, 'Puro Perro (Callejero)');

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
-- Estructura de tabla para la tabla `sexo`
--

DROP TABLE IF EXISTS `sexo`;
CREATE TABLE IF NOT EXISTS `sexo` (
`id` tinyint(1) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id`, `nombre`) VALUES
(1, 'Macho'),
(2, 'Hembra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanio`
--

DROP TABLE IF EXISTS `tamanio`;
CREATE TABLE IF NOT EXISTS `tamanio` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tamanio`
--

INSERT INTO `tamanio` (`id`, `nombre`) VALUES
(1, 'Mini (menos de 5 kg o 20cm)'),
(2, 'Pequeño (menos de 14 kg o 35cm)'),
(3, 'Mediano (menos de 24 kg o 50cm)'),
(4, 'Grande (menos de 40 kg o 74cm)'),
(5, 'Gigante (más de 40 kg o 74cm)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_aviso`
--

DROP TABLE IF EXISTS `tipo_aviso`;
CREATE TABLE IF NOT EXISTS `tipo_aviso` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_aviso`
--

INSERT INTO `tipo_aviso` (`id`, `nombre`) VALUES
(1, 'Perros Perdidos'),
(2, 'Perros Encontrados'),
(3, 'Perros en Adopción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pelo`
--

DROP TABLE IF EXISTS `tipo_pelo`;
CREATE TABLE IF NOT EXISTS `tipo_pelo` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_pelo`
--

INSERT INTO `tipo_pelo` (`id`, `nombre`) VALUES
(1, 'Lasio'),
(2, 'Rulos'),
(3, 'Duro'),
(4, 'Sin Pelo'),
(5, 'Corto');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `apodo`, `nombre`, `apellido`, `domicilio`, `telefono_fijo`, `telefono_celular`, `localidad_id`, `estado_usuario_id`, `tipo_usuario_id`, `rol_id`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `created_at`, `updated_at`, `desea_adoptar`, `ofrece_transito`, `latitud`, `longitud`) VALUES
(1, 'controlz', 'Cosme', 'Fulanito', 'Una Calle 2816, Neuquén', 2147483647, 2147483647, 1, 1, 1, 3, 'coso@gmail.com', '7jYyjburJnCCCBuZA4kcnejwCdUvQXGk', '$2y$10$hOY6GZqUnc8Ua3Db3Q.WzuVQj0LracZHRlqukUsaIt5tuxN4.ukDS', NULL, '2016-11-07 23:10:54', '2016-11-07 23:10:54', 1, 0, NULL, NULL),
(2, 'sagripantim', 'Mauro', 'Sagripanti', 'xx', NULL, 154682, 5, 1, 1, 1, 'pepe@sagripanti.com', 'lOXCHC5KQSwZquW-w7c_Ht0TMH4pIqv6', '$2y$13$fy5uytqkVnfD264DwIvv0OfLudtlqwBs5KTfTTjc5puyuzkJ4Uhci', 'null', '2016-12-02 20:13:58', '2016-12-02 20:13:58', 0, 0, NULL, NULL),
(3, 'prueba', 'Prueba', 'Prueba', 'General Belgrano 280, Neuquén, Argentina', NULL, 15555555, 8, 1, 1, 1, 'prueba@gmail.com', 'H3dG8ndDoN5QfyDiRHjHdtwfMzcax-Q2', '$2y$10$FOoSlFznO6pU/JWK5k3baOPH23.1XZ5LCRK7kJq/8/2dh0r6tyQla', 'null', '2016-11-21 18:36:11', '2016-11-21 18:36:11', 1, 0, -38.9508, -68.0631),
(4, 'cacho', 'Cacho ', 'Bochas', 'Alderete 1739, Neuquén, Neuquén', 4425162, 1558444754, 1, 1, 1, 1, 'cacho@gmail.com', 'vT17b1guCFKPxrVSUZYZIwmlPuuo6EtI', '$2y$10$x8FZDcWT.KzedhRQ8H9pguotEGAbt8sRvsCWASGarVrw/uK5cWjZe', 'null', '2016-11-07 22:43:15', '2016-11-07 22:43:15', 0, 0, NULL, NULL),
(5, 'prueba2', 'prueba2', 'prueba2', 'Eugenio Perticone 1203, 8300 Neuquén', 4444421, 154444444, 1, 1, 1, 1, 'prueba2@gmail.com', '0tkhz3oZDSkLBFZ11LDYS5fuTdlrsnw6', '$2y$10$E6BaVoXvwEsV6OtUaMQ4FOD3NHbK.qlw/giQDDw4oUsoc.Yy86Fiy', 'null', '2016-12-02 19:28:43', '2016-12-02 19:28:43', 1, 0, NULL, NULL);

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
-- Indices de la tabla `adoptante`
--
ALTER TABLE `adoptante`
 ADD PRIMARY KEY (`id`), ADD KEY `FKadop_user` (`user_id`), ADD KEY `FKadop_estado_adoptante` (`estado_adoptante_id`);

--
-- Indices de la tabla `aviso`
--
ALTER TABLE `aviso`
 ADD PRIMARY KEY (`id`), ADD KEY `FKaviso48388` (`tipo_aviso_id`), ADD KEY `FKaviso500203` (`estado_aviso_id`), ADD KEY `FKaviso41529` (`created_by`), ADD KEY `FKaviso988422` (`perro_id`), ADD KEY `FKaviso104635` (`updated_by`);

--
-- Indices de la tabla `casos_exito`
--
ALTER TABLE `casos_exito`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_adoptante`
--
ALTER TABLE `estado_adoptante`
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
 ADD PRIMARY KEY (`id`), ADD KEY `FKperro638026` (`estado_perro_id`), ADD KEY `FKperro823844` (`estado_clinico_id`), ADD KEY `FKperro646449` (`color_primario`), ADD KEY `FKperro875864` (`color_secundario`), ADD KEY `FKperro940281` (`raza_id`), ADD KEY `FKperro_tipo_pelo` (`tipo_pelo_id`), ADD KEY `FKperro_tamanio` (`tamanio_id`);

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
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_aviso`
--
ALTER TABLE `tipo_aviso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pelo`
--
ALTER TABLE `tipo_pelo`
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
-- AUTO_INCREMENT de la tabla `adoptante`
--
ALTER TABLE `adoptante`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `aviso`
--
ALTER TABLE `aviso`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `casos_exito`
--
ALTER TABLE `casos_exito`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `estado_adoptante`
--
ALTER TABLE `estado_adoptante`
MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estado_aviso`
--
ALTER TABLE `estado_aviso`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estado_clinico`
--
ALTER TABLE `estado_clinico`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `estado_imagen`
--
ALTER TABLE `estado_imagen`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_perro`
--
ALTER TABLE `estado_perro`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_aviso`
--
ALTER TABLE `tipo_aviso`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `veterinaria`
--
ALTER TABLE `veterinaria`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adoptante`
--
ALTER TABLE `adoptante`
ADD CONSTRAINT `FKadop_estado_adoptante` FOREIGN KEY (`estado_adoptante_id`) REFERENCES `estado_adoptante` (`id`),
ADD CONSTRAINT `FKadop_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
ADD CONSTRAINT `FKperro940281` FOREIGN KEY (`raza_id`) REFERENCES `raza` (`id`),
ADD CONSTRAINT `FKperro_tipo_pelo` FOREIGN KEY (`tipo_pelo_id`) REFERENCES `tipo_pelo` (`id`);

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
