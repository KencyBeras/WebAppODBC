-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bdsistemaclub
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bdsistemaclub
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdsistemaclub` DEFAULT CHARACTER SET utf8 ;
USE `bdsistemaclub` ;

-- -----------------------------------------------------
-- Table `bdsistemaclub`.`socio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistemaclub`.`socio` (
  `idsocio` INT NOT NULL AUTO_INCREMENT,
  `num_afiliado` INT NOT NULL,
  `user` VARCHAR(25) NOT NULL,
  `pass` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `direccion` VARCHAR(70) NULL,
  `telefono` VARCHAR(15) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`idsocio`),
  UNIQUE INDEX `user_UNIQUE` (`user` ASC) VISIBLE,
  UNIQUE INDEX `num_afiliado_UNIQUE` (`num_afiliado` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistemaclub`.`filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistemaclub`.`filial` (
  `idfilial` INT NOT NULL AUTO_INCREMENT,
  `localidad` VARCHAR(60) NOT NULL,
  `horario_apertura` TIME NULL,
  `horario_cierre` TIME NULL,
  `diames_mantenimiento` SMALLINT NULL,
  PRIMARY KEY (`idfilial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistemaclub`.`cancha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistemaclub`.`cancha` (
  `idcancha` INT NOT NULL AUTO_INCREMENT,
  `idfilial` INT NOT NULL,
  `deporte` VARCHAR(45) NOT NULL,
  `categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcancha`, `idfilial`),
  INDEX `fk_cancha_filial1_idx` (`idfilial` ASC) VISIBLE,
  CONSTRAINT `fk_cancha_filial1`
    FOREIGN KEY (`idfilial`)
    REFERENCES `bdsistemaclub`.`filial` (`idfilial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistemaclub`.`turno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistemaclub`.`turno` (
  `idturno` INT NOT NULL AUTO_INCREMENT,
  `idfilial` INT NOT NULL,
  `idcancha` INT NOT NULL,
  `idsocio` INT NOT NULL,
  `fechahora` DATETIME NOT NULL,
  PRIMARY KEY (`idturno`, `idfilial`, `idcancha`),
  INDEX `fk_turno_socio_idx` (`idsocio` ASC) VISIBLE,
  INDEX `fk_turno_cancha1_idx` (`idcancha` ASC, `idfilial` ASC) VISIBLE,
  CONSTRAINT `fk_turno_socio`
    FOREIGN KEY (`idsocio`)
    REFERENCES `bdsistemaclub`.`socio` (`idsocio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turno_cancha1`
    FOREIGN KEY (`idcancha` , `idfilial`)
    REFERENCES `bdsistemaclub`.`cancha` (`idcancha` , `idfilial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
