-- MySQL Workbench Synchronization
-- Generated: 2015-11-26 12:01
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Usuario

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `noticias`.`noticias` 
CHANGE COLUMN `etapas_id` `etapas_id` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `noticias`.`usuarios` 
ADD INDEX `fk_usuarios_rol1_idx` (`rol_nombre` ASC),
DROP INDEX `fk_usuarios_rol1_idx` ;

ALTER TABLE `noticias`.`noticias` 
DROP FOREIGN KEY `noticias_ibfk_2`;

ALTER TABLE `noticias`.`noticias` ADD CONSTRAINT `noticias_ibfk_2`
  FOREIGN KEY (`etapas_id`)
  REFERENCES `noticias`.`etapas` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
