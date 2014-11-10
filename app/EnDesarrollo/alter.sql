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
