ALTER TABLE `laravel-tricks`.`tricks`
ADD COLUMN `emb_direccion` TEXT NULL AFTER `updated_at`;
ALTER TABLE `laravel-tricks`.`tricks`
ADD COLUMN `emb_direccion` TEXT NULL AFTER `updated_at`;
ALTER TABLE `laravel-tricks`.`tricks`
ADD COLUMN `emb_tlf` VARCHAR(255) NULL AFTER `emb_direccion`,
ADD COLUMN `emb_web` VARCHAR(255) NULL AFTER `emb_tlf`;
ALTER TABLE `laravel-tricks`.`tricks`
ADD COLUMN `emb_email` VARCHAR(255) NULL AFTER `updated_at`;
ALTER TABLE `laravel-tricks`.`tricks`
CHANGE COLUMN `emb_email` `emb_email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL AFTER `emb_web`;
ALTER TABLE `laravel-tricks`.`tricks`
ADD COLUMN `emb_hora` VARCHAR(255) NULL AFTER `emb_email`;

CREATE TABLE IF NOT EXISTS `personales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `personales_slug_unique` (`slug`),
  KEY `personales_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `personales`
--

INSERT INTO `personales` (`id`, `name`, `slug`, `titulo`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Claudio scheuermann', 'claudio-scheuermann', 'Embajador', NULL, '0000-00-00 00:00:00', '2014-11-10 05:33:14'),
(2, 'Luis Moncada', 'luis-moncada', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Alfredo Jimenez', 'alfredo-jimenez', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_trick`
--

CREATE TABLE IF NOT EXISTS `personal_trick` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personal_id` int(10) unsigned NOT NULL,
  `trick_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `personal_trick_personal_id_foreign` (`personal_id`),
  KEY `personal_trick_trick_id_foreign` (`trick_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `personal_trick`
--

INSERT INTO `personal_trick` (`id`, `personal_id`, `trick_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
--
-- Filtros para la tabla `personales`
--
ALTER TABLE `personales`
  ADD CONSTRAINT `personales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal_trick`
--
ALTER TABLE `personal_trick`
  ADD CONSTRAINT `personal_trick_trick_id_foreign` FOREIGN KEY (`trick_id`) REFERENCES `tricks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_trick_personal_id_foreign` FOREIGN KEY (`personal_id`) REFERENCES `personales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `laravel-tricks`.`personales` 
ADD COLUMN `cedula` VARCHAR(45) NULL AFTER `titulo`,
ADD COLUMN `email` VARCHAR(255) NULL AFTER `cedula`;