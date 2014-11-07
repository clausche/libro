-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-10-2014 a las 18:30:24
-- Versión del servidor: 5.5.40-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `laravel-tricks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `spanish_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso2` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`),
  KEY `tags_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=310 ;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `spanish_name`, `iso2`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Par&iacute;s', 'paris', 'paris', 'pa', NULL, '0000-00-00 00:00:00', '2014-10-26 02:19:54'),
(254, 'Frankfurt', 'frankfurt', 'frankfurt', 'GM', NULL, '2014-10-25 07:32:38', '2014-10-25 07:32:38'),
(255, 'Luanda', 'luanda', 'Luanda', 'lu', NULL, '2014-10-26 02:25:39', '2014-10-26 02:26:21'),
(256, 'Kabul', 'kabul', 'kabul', 'kl', NULL, '2014-10-26 02:44:13', '2014-10-26 02:45:41'),
(257, 'Berlin', 'berlin', 'berlin', 'bl', NULL, '2014-10-26 03:32:06', '2014-10-26 03:32:06'),
(259, 'Copenhague', 'copenhague', 'copenhague', 'co', NULL, '2014-10-26 07:41:15', '2014-10-26 07:41:15'),
(260, 'Buenos Aires', 'buenos-aires', 'Buenos Aires', 'BH', NULL, '2014-10-27 01:50:36', '2014-10-27 01:50:36'),
(261, 'Sin Consulado', 'sin-consulado', 'Sin Consulado', 'ss', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 'Estambul', 'estambul', 'estambul', 'ee', NULL, '2014-10-28 01:59:59', '2014-10-28 01:59:59'),
(263, 'Hamburgo', 'hamburgo', 'hamburgo', 'ha', NULL, '2014-10-28 02:00:54', '2014-10-28 02:00:54'),
(264, 'Belem do para', 'belem-do-para', 'belem do para', 'bb', NULL, '2014-10-28 02:02:02', '2014-10-28 02:02:02'),
(265, 'Boa vista', 'boa-vista', 'boa vista', 'bv', NULL, '2014-10-28 02:02:31', '2014-10-28 02:02:31'),
(266, 'Belo horizonte', 'belo-horizonte', 'bello horizonte', 'bh', NULL, '2014-10-28 02:03:32', '2014-10-28 02:03:32'),
(267, 'Pernambuco', 'pernambuco', 'pernambuco', 'pb', NULL, '2014-10-28 02:03:55', '2014-10-28 02:03:55'),
(268, 'Manaos', 'manaos', 'Manaos', 'ma', NULL, '2014-10-28 02:04:29', '2014-10-28 02:04:29'),
(269, 'Rio de janeiro', 'rio-de-janeiro', 'rio de janeiro', 'jr', NULL, '2014-10-28 02:04:55', '2014-10-28 02:04:55'),
(270, 'Sao paulo', 'sao-paulo', 'sao paulo', 'sp', NULL, '2014-10-28 02:05:38', '2014-10-28 02:05:38'),
(271, 'Cochabamba', 'cochabamba', 'cochabamba', 'cc', NULL, '2014-10-28 02:06:03', '2014-10-28 02:06:03'),
(272, 'Vancouver', 'vancouver', 'vancouver', 'vv', NULL, '2014-10-28 02:06:46', '2014-10-28 02:06:46'),
(273, 'Toronto', 'toronto', 'toronto', 'tt', NULL, '2014-10-28 02:07:01', '2014-10-28 02:07:01'),
(274, 'Montreal', 'montreal', 'montreal', 'mm', NULL, '2014-10-28 02:07:39', '2014-10-28 02:07:39'),
(275, 'Bogota', 'bogota', 'Bogota', 'bb', NULL, '2014-10-28 02:13:44', '2014-10-28 02:13:44'),
(276, 'Barranquilla', 'barranquilla', 'barranquilla', 'bb', NULL, '2014-10-28 02:14:05', '2014-10-28 02:14:05'),
(277, 'Arauca', 'arauca', 'arauca', 'aa', NULL, '2014-10-28 02:14:34', '2014-10-28 02:14:34'),
(278, 'Bucaramanga', 'bucaramanga', 'Bucaramanga', 'bb', NULL, '2014-10-28 02:15:04', '2014-10-28 02:15:04'),
(279, 'Cartagena', 'cartagena', 'Cartagena', 'cc', NULL, '2014-10-28 02:15:48', '2014-10-28 02:15:48'),
(280, 'Cúcuta', 'cucuta', 'cucuta', 'cu', NULL, '2014-10-28 02:16:17', '2014-10-28 02:16:17'),
(281, 'Medellin', 'medellin', 'Medellin', 'mm', NULL, '2014-10-28 02:16:40', '2014-10-28 02:16:40'),
(282, 'Puerto carreño', 'puerto-carreno', 'puerto carreño', 'pc', NULL, '2014-10-28 02:17:06', '2014-10-28 02:17:06'),
(283, 'Puerto Inírida', 'puerto-inirida', 'Puerto inírida', 'pi', NULL, '2014-10-28 02:17:54', '2014-10-28 02:17:54'),
(284, 'Guainia', 'guainia', 'Guainia', 'gg', NULL, '2014-10-28 02:18:12', '2014-10-28 02:18:12'),
(285, 'Rio Hacha', 'rio-hacha', 'Rio Hacha', 'RH', NULL, '2014-10-28 02:19:16', '2014-10-28 02:19:16'),
(286, 'Milan', 'milan', 'Milan', 'mm', NULL, '2014-10-28 02:19:57', '2014-10-28 02:19:57'),
(287, 'Napoles', 'napoles', 'Napoles', 'nn', NULL, '2014-10-28 02:20:13', '2014-10-28 02:20:13'),
(288, 'Funchal', 'funchal', 'funchal', 'ff', NULL, '2014-10-28 02:26:38', '2014-10-28 02:26:38'),
(289, 'Oporto', 'oporto', 'Oporto', 'op', NULL, '2014-10-28 02:26:51', '2014-10-28 02:26:51'),
(290, 'Lisboa', 'lisboa', 'Lisboa', 'li', NULL, '2014-10-28 02:27:08', '2014-10-28 02:27:08'),
(291, 'Amman', 'amman', 'amman', 'aa', NULL, '2014-10-28 02:47:53', '2014-10-28 02:47:53'),
(292, 'Barcelona', 'barcelona', 'barcelona', 'bb', NULL, '2014-10-28 02:48:31', '2014-10-28 02:48:31'),
(293, 'Bilbao', 'bilbao', 'bilbao', 'bi', NULL, '2014-10-28 02:48:55', '2014-10-28 02:48:55'),
(294, 'Bonaire', 'bonaire', 'Bonaire', 'bo', NULL, '2014-10-28 02:49:54', '2014-10-28 02:49:54'),
(295, 'Boston', 'boston', 'Boston', 'bo', NULL, '2014-10-28 02:50:10', '2014-10-28 02:50:10'),
(296, 'Chicago', 'chicago', 'Chicago', 'ch', NULL, '2014-10-28 02:50:33', '2014-10-28 02:50:33'),
(297, 'Curazao', 'curazao', 'Curazao', 'cz', NULL, '2014-10-28 02:50:55', '2014-10-28 02:50:55'),
(298, 'Fort de France', 'fort-de-france', 'Fort de France', 'ff', NULL, '2014-10-28 02:51:21', '2014-10-28 02:51:21'),
(299, 'Guayaquil', 'guayaquil', 'Guayaquil', 'gy', NULL, '2014-10-28 02:54:37', '2014-10-28 02:54:37'),
(300, 'Hong Kong', 'hong-kong', 'Hong Kong', 'hg', NULL, '2014-10-28 02:55:32', '2014-10-28 02:55:32'),
(301, 'Houston', 'houston', 'Houston', 'ht', NULL, '2014-10-28 02:55:58', '2014-10-28 02:55:58'),
(302, 'Madrid', 'madrid', 'Madrid', 'ma', NULL, '2014-10-28 02:56:20', '2014-10-28 02:56:20'),
(303, 'Miami', 'miami', 'Miami', 'mi', NULL, '2014-10-28 02:56:42', '2014-10-28 02:56:42'),
(304, 'Nueva York', 'nueva-york', 'Nueva York', 'ny', NULL, '2014-10-28 02:59:07', '2014-10-28 02:59:07'),
(305, 'San Francisco', 'san-francisco', 'San Francisco', 'SF', NULL, '2014-10-28 03:00:47', '2014-10-28 03:00:47'),
(306, 'San Juan', 'san-juan', 'San Juan', 'SJ', NULL, '2014-10-28 03:01:13', '2014-10-28 03:01:13'),
(307, 'Shanghai', 'shanghai', 'Shanghai', 'sg', NULL, '2014-10-28 03:21:46', '2014-10-28 03:21:46'),
(308, 'Tenerife', 'tenerife', 'Tenerife', 'te', NULL, '2014-10-28 03:22:12', '2014-10-28 03:22:12'),
(309, 'Vigo', 'vigo', 'Vigo', 'vg', NULL, '2014-10-28 03:22:28', '2014-10-28 03:22:28');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
