-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cyberdim
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cyberdim
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cyberdim` DEFAULT CHARACTER SET utf8 ;
USE `cyberdim` ;

-- -----------------------------------------------------
-- Table `cyberdim`.`material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cyberdim`.`material` (
  `material_id` INT NOT NULL AUTO_INCREMENT,
  `material_nome` VARCHAR(255) NULL,
  `material_altura` FLOAT NULL,
  `material_largura` FLOAT NULL,
  `material_valor` FLOAT NULL
)

-- -----------------------------------------------------
-- Table `cyberdim`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cyberdim`.`produto` (
  `produto_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `produto_nome` VARCHAR(45) NULL,
  `material_id` INT NULL,
  `produto_valor` FLOAT NULL,
  CONSTRAINT `fk_produto_material` FOREIGN KEY (`material_id`) REFERENCES `cyberdim`.`material` (`material_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cyberdim`.`venda_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cyberdim`.`venda_produto` (
  `venda_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `produto_id` INT NULL,
  `material_id` INT NULL,
  `venda_valor` FLOAT NULL
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cyberdim`.`venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cyberdim`.`venda` (
  `venda_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `venda_valor` FLOAT NULL,
  `material_id` INT NOT NULL,
  `produto_id` INT NOT NULL
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cyberdim`.`recibo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cyberdim`.`recibo` (
  `recibo_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `venda_id` INT NOT NULL
)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;