SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `controleanimal` DEFAULT CHARACTER SET utf8 ;
USE `controleanimal` ;

-- -----------------------------------------------------
-- Table `controleanimal`.`pais`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`pais` (
  `idPai` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NOT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL ,
  `usuarioAlteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idPai`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`maes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`maes` (
  `idMae` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NOT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `usuarioAlteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idMae`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`pesagens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`pesagens` (
  `idPesagem` INT(11) NOT NULL AUTO_INCREMENT ,
  `data` DATETIME NOT NULL ,
  `peso` VARCHAR(45) NOT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL COMMENT ' ' ,
  `usuarioAlteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idPesagem`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`lotes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`lotes` (
  `idLote` INT(11) NOT NULL AUTO_INCREMENT ,
  `codigo` INT(11) NOT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL ,
  `usuarioAlteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idLote`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`fazendas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`fazendas` (
  `idFazenda` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NULL DEFAULT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL ,
  `usuarioalteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idFazenda`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`animais`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`animais` (
  `idAnimal` INT(11) NOT NULL AUTO_INCREMENT ,
  `fkFazenda` INT(11) NOT NULL ,
  `fkLote` INT(11) NULL DEFAULT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL COMMENT ' ' ,
  `usuarioAlteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `codigoBrinco` VARCHAR(20) NULL DEFAULT NULL ,
  `codigoRaca` VARCHAR(20) NULL DEFAULT NULL ,
  `fkPai` INT(11) NOT NULL ,
  `fkMae` INT(11) NOT NULL ,
  `dataNascimento` DATETIME NOT NULL ,
  `fkPesagem` INT(11) NOT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idAnimal`) ,
  INDEX `Animais_Pais_idx` (`fkPai` ASC) ,
  INDEX `Animais_Mae_fkMae_idx` (`fkMae` ASC) ,
  INDEX `Animais_Fazenda_fkFazenda_idx` (`fkFazenda` ASC) ,
  INDEX `Animais_Lote_fkLote_idx` (`fkLote` ASC) ,
  INDEX `Animais_Pesagem_fkPesagem_idx` (`fkPesagem` ASC) ,
  CONSTRAINT `Animais_Pais_fkPai`
    FOREIGN KEY (`fkPai` )
    REFERENCES `controleanimal`.`pais` (`idPai` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `Animais_Mae_fkMae`
    FOREIGN KEY (`fkMae` )
    REFERENCES `controleanimal`.`maes` (`idMae` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `Animais_Fazenda_fkFazenda`
    FOREIGN KEY (`fkFazenda` )
    REFERENCES `controleanimal`.`fazendas` (`idFazenda` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `Animais_Lote_fkLote`
    FOREIGN KEY (`fkLote` )
    REFERENCES `controleanimal`.`lotes` (`idLote` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `Animais_Pesagem_fkPesagem`
    FOREIGN KEY (`fkPesagem` )
    REFERENCES `controleanimal`.`pesagens` (`idPesagem` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`ciclosVida`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`ciclosVida` (
  `idCiclosVida` INT(11) NOT NULL AUTO_INCREMENT ,
  `enumFaseVida` VARCHAR(45) NULL DEFAULT NULL ,
  `enumLocalizacao` VARCHAR(45) NULL DEFAULT NULL ,
  `fkAnimal` INT(11) NOT NULL ,
  `dataAlteracao` DATETIME NULL DEFAULT NULL ,
  `dataCriacao` DATETIME NOT NULL ,
  `usuarioCadastro` VARCHAR(45) NOT NULL ,
  `usuarioAlteracao` VARCHAR(45) NULL DEFAULT NULL ,
  `status` VARCHAR(45) NULL DEFAULT 'ATIVO' ,
  PRIMARY KEY (`idCiclosVida`) ,
  INDEX `CiclosVida_Animais__idx` (`fkAnimal` ASC) ,
  CONSTRAINT `CiclosVida_Animais_`
    FOREIGN KEY (`fkAnimal` )
    REFERENCES `controleanimal`.`animais` (`idAnimal` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controleanimal`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NOT NULL ,
  `senha` VARCHAR(255) NOT NULL ,
  `nome` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idUsuario`) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleanimal`.`permissoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controleanimal`.`permissoes` (
  `idPermissao` INT NOT NULL AUTO_INCREMENT ,
  `fkUsuario` INT NOT NULL ,
  `usuarios` TINYINT(1) NULL DEFAULT 0 ,
  `animais` TINYINT(1) NULL DEFAULT 0 ,
  `pais` TINYINT(1) NULL DEFAULT 0 ,
  `maes` TINYINT(1) NULL DEFAULT 0 ,
  `lotes` TINYINT(1) NULL DEFAULT 0 ,
  `fazendas` TINYINT(1) NULL DEFAULT 0 ,
  `pesagens` TINYINT(1) NULL DEFAULT 0 ,
  `clicosVida` TINYINT(1) NULL DEFAULT 0 ,
  `permissoes` TINYINT(1) NULL DEFAULT 0 ,
  PRIMARY KEY (`idPermissao`) ,
  INDEX `fkUsuario_idx` (`fkUsuario` ASC) ,
  CONSTRAINT `fkUsuario`
    FOREIGN KEY (`fkUsuario` )
    REFERENCES `controleanimal`.`usuarios` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `controleanimal` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
