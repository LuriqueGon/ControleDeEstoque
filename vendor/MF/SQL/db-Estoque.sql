SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `estoque` DEFAULT CHARACTER SET utf8 ;
USE `estoque` ;


CREATE TABLE IF NOT EXISTS `estoque`.`usuarios` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `Username` VARCHAR(120) NOT NULL,
  `Email` VARCHAR(120) NOT NULL,
  `Senha` VARCHAR(45) NOT NULL,
  `DataRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Permissao` INT NOT NULL DEFAULT 1,
  `quantVendas` INT NOT NULL DEFAULT 0,
  `perfil` VARCHAR(200),
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `estoque`.`produtos` (
  `CodRefProduto` INT NOT NULL AUTO_INCREMENT,
  `NomeProduto` VARCHAR(120) NOT NULL,
  `usuarios_idUser` INT NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`CodRefProduto`),
  INDEX `fk_produtos_usuarios_idx` (`usuarios_idUser` ASC) VISIBLE,
  CONSTRAINT `fk_produtos_usuarios`
    FOREIGN KEY (`usuarios_idUser`)
    REFERENCES `estoque`.`usuarios` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `estoque`.`fabricantes` (
  `idFabricante` INT NOT NULL AUTO_INCREMENT,
  `nomeFabricante` VARCHAR(120) NOT NULL,
  `CNPJFabricante` VARCHAR(120) NOT NULL,
  `EmailFabricante` VARCHAR(120) NOT NULL,
  `enderecoFabricante` VARCHAR(120) NOT NULL,
  `TelefoneFabricante` VARCHAR(120) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `usuarios_idUser` INT NOT NULL,
  PRIMARY KEY (`idFabricante`),
  INDEX `fk_fabricantes_usuarios1_idx` (`usuarios_idUser` ASC) VISIBLE,
  CONSTRAINT `fk_fabricantes_usuarios1`
    FOREIGN KEY (`usuarios_idUser`)
    REFERENCES `estoque`.`usuarios` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `estoque`.`representantes` (
  `idRepresentante` INT NOT NULL AUTO_INCREMENT,
  `nomeRepresentante` VARCHAR(120) NOT NULL,
  `telefoneRepresentante` VARCHAR(45) NOT NULL,
  `emailRepresentante` VARCHAR(120) NOT NULL,
  `fabricantes_idFabricante` INT NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `usuarios_idUser` INT NOT NULL,
  PRIMARY KEY (`idRepresentante`),
  INDEX `fk_representantes_fabricantes1_idx` (`fabricantes_idFabricante` ASC) VISIBLE,
  INDEX `fk_representantes_usuarios1_idx` (`usuarios_idUser` ASC) VISIBLE,
  CONSTRAINT `fk_representantes_fabricantes1`
    FOREIGN KEY (`fabricantes_idFabricante`)
    REFERENCES `estoque`.`fabricantes` (`idFabricante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_representantes_usuarios1`
    FOREIGN KEY (`usuarios_idUser`)
    REFERENCES `estoque`.`usuarios` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `estoque`.`itens` (
  `idItens` INT NOT NULL AUTO_INCREMENT,
  `cdb` VARCHAR(20) NOT NULL,
  `descricao` VARCHAR(200) NOT NULL,
  `quantItens` INT NOT NULL,
  `quantItensVend` INT NOT NULL,
  `valCompItem` FLOAT(8,2) NOT NULL,
  `valVendItem` FLOAT(8,2) NOT NULL,
  `dataCompra` DATE NOT NULL,
  `dataVencItem` DATE NULL,
  `ativo` TINYINT NOT NULL DEFAULT 1,
  `produtos_CodRefProduto` INT NOT NULL,
  `fabricantes_idFabricante` INT NOT NULL,
  `usuarios_idUser` INT NOT NULL,
  PRIMARY KEY (`idItens`),
  INDEX `fk_itens_produtos1_idx` (`produtos_CodRefProduto` ASC) VISIBLE,
  INDEX `fk_itens_fabricantes1_idx` (`fabricantes_idFabricante` ASC) VISIBLE,
  INDEX `fk_itens_usuarios1_idx` (`usuarios_idUser` ASC) VISIBLE,
  CONSTRAINT `fk_itens_produtos1`
    FOREIGN KEY (`produtos_CodRefProduto`)
    REFERENCES `estoque`.`produtos` (`CodRefProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_fabricantes1`
    FOREIGN KEY (`fabricantes_idFabricante`)
    REFERENCES `estoque`.`fabricantes` (`idFabricante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_usuarios1`
    FOREIGN KEY (`usuarios_idUser`)
    REFERENCES `estoque`.`usuarios` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
