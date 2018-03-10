-- MySQL Workbench Forward Engineering


SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ajudevovo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ajudevovo
-- -----------------------------------------------------

DROP  DATABASE ajudevovo;

CREATE SCHEMA IF NOT EXISTS `ajudevovo` DEFAULT CHARACTER SET latin1 ;
USE `ajudevovo` ;

-- -----------------------------------------------------
-- Table `ajudevovo`.`avaliacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`avaliacao` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`avaliacao` (
  `id_avaliacao` INT(11) NOT NULL AUTO_INCREMENT,
  `nota` INT(11) NULL DEFAULT NULL,
  `comentario` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_avaliacao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`banco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`banco` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`banco` (
  `id_banco` INT(11) NOT NULL AUTO_INCREMENT,
  `numero_banco` INT(11) NULL DEFAULT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_banco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`pais` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`pais` (
  `id_pais` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `sigla` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`estado` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`estado` (
  `id_estado` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pais` INT(11) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `uf` CHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_estado`),
  INDEX `id_pais` (`id_pais` ASC),
  CONSTRAINT `estado_ibfk_1`
    FOREIGN KEY (`id_pais`)
    REFERENCES `ajudevovo`.`pais` (`id_pais`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`cidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`cidade` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`cidade` (
  `id_cidade` INT(11) NOT NULL AUTO_INCREMENT,
  `id_estado` INT(11) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cidade`),
  INDEX `id_estado` (`id_estado` ASC),
  CONSTRAINT `cidade_ibfk_1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `ajudevovo`.`estado` (`id_estado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`perfil` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`perfil` (
  `id_perfil` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_perfil`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`pessoa_fisica`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`pessoa_fisica` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`pessoa_fisica` (
  `id_pessoa_fisica` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `dt_nascimento` DATE NULL DEFAULT NULL,
  `cpf` VARCHAR(12) NULL DEFAULT NULL,
  `sexo` CHAR(2) NULL DEFAULT NULL,
  `login` VARCHAR(255) NULL DEFAULT NULL,
  `senha` VARCHAR(255) NULL DEFAULT NULL,
  `imagem_pessoa` VARCHAR(255) NULL DEFAULT NULL,
  `id_perfil` INT(11) NULL,
  `ativo` TINYINT(1) NULL DEFAULT '1',
  `id_cidade` INT(11) NULL,
  `id_estado` INT(11) NULL,
  `nome_pai` VARCHAR(100) NULL DEFAULT NULL,
  `nome_mae` VARCHAR(100) NULL DEFAULT NULL,
  `imagem_frente_documento` VARCHAR(255) NULL DEFAULT NULL,
  `imagem_verso_documento` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pessoa_fisica`),
  INDEX `fk_pessoa_fisica_perfil1_idx` (`id_perfil` ASC),
  INDEX `fk_pessoa_fisica_cidade1_idx` (`id_cidade` ASC),
  INDEX `fk_pessoa_fisica_estado1_idx` (`id_estado` ASC),
  CONSTRAINT `fk_pessoa_fisica_cidade1`
    FOREIGN KEY (`id_cidade`)
    REFERENCES `ajudevovo`.`cidade` (`id_cidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa_fisica_estado1`
    FOREIGN KEY (`id_estado`)
    REFERENCES `ajudevovo`.`estado` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa_fisica_perfil1`
    FOREIGN KEY (`id_perfil`)
    REFERENCES `ajudevovo`.`perfil` (`id_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`cartao_credito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`cartao_credito` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`cartao_credito` (
  `id_cartao` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` INT(11) NOT NULL,
  `numero_cartao` BIGINT(20) NULL DEFAULT NULL,
  `nome_titular` VARCHAR(255) NULL DEFAULT NULL,
  `dt_validade` DATETIME NULL DEFAULT NULL,
  `codigo_seguranca` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cartao`),
  INDEX `id_pessoa` (`id_pessoa` ASC),
  CONSTRAINT `cartao_credito_ibfk_1`
    FOREIGN KEY (`id_pessoa`)
    REFERENCES `ajudevovo`.`pessoa_fisica` (`id_pessoa_fisica`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`categoria` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`categoria` (
  `id_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `taxa` FLOAT NOT NULL,
  `imagem_categoria` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`conta_bancaria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`conta_bancaria` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`conta_bancaria` (
  `id_conta_bancaria` INT(11) NOT NULL AUTO_INCREMENT,
  `id_banco` INT(11) NOT NULL,
  `numero_agencia` INT(11) NULL DEFAULT NULL,
  `numero_conta` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_conta_bancaria`),
  INDEX `id_banco` (`id_banco` ASC),
  CONSTRAINT `conta_bancaria_ibfk_1`
    FOREIGN KEY (`id_banco`)
    REFERENCES `ajudevovo`.`banco` (`id_banco`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`tipo_contato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`tipo_contato` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`tipo_contato` (
  `id_tipo_contato` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_contato`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`contato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`contato` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`contato` (
  `id_contato` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` INT(11) NOT NULL,
  `id_tipo_contato` INT(11) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_contato`),
  INDEX `id_tipo_contato` (`id_tipo_contato` ASC),
  CONSTRAINT `contato_ibfk_1`
    FOREIGN KEY (`id_tipo_contato`)
    REFERENCES `ajudevovo`.`tipo_contato` (`id_tipo_contato`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`contratante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`contratante` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`contratante` (
  `id_contratante` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`id_contratante`),
  INDEX `id_pessoa` (`id_pessoa` ASC),
  CONSTRAINT `contratante_ibfk_1`
    FOREIGN KEY (`id_pessoa`)
    REFERENCES `ajudevovo`.`pessoa_fisica` (`id_pessoa_fisica`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`contratante_avaliacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`contratante_avaliacao` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`contratante_avaliacao` (
  `id_contratante_avaliacao` INT(11) NOT NULL AUTO_INCREMENT,
  `id_contratante` INT(11) NOT NULL,
  `id_avaliacao` INT(11) NOT NULL,
  PRIMARY KEY (`id_contratante_avaliacao`),
  INDEX `id_contratante` (`id_contratante` ASC),
  INDEX `id_avaliacao` (`id_avaliacao` ASC),
  CONSTRAINT `contratante_avaliacao_ibfk_1`
    FOREIGN KEY (`id_contratante`)
    REFERENCES `ajudevovo`.`contratante` (`id_contratante`),
  CONSTRAINT `contratante_avaliacao_ibfk_2`
    FOREIGN KEY (`id_avaliacao`)
    REFERENCES `ajudevovo`.`avaliacao` (`id_avaliacao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`necessidade_especial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`necessidade_especial` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`necessidade_especial` (
  `id_necessidade_especial` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_necessidade_especial`),
  UNIQUE INDEX `id_necessidade_especial_UNIQUE` (`id_necessidade_especial` ASC),
  UNIQUE INDEX `descricao_UNIQUE` (`descricao` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`contratante_necessidade_especial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`contratante_necessidade_especial` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`contratante_necessidade_especial` (
  `id_contratante_necessidade_especial` INT(11) NOT NULL,
  `necessidade_especial_id_necessidade_especial` INT(11) NOT NULL,
  `contratante_id_contratante` INT(11) NOT NULL,
  PRIMARY KEY (`id_contratante_necessidade_especial`),
  INDEX `fk_contratante_necessidade_especial_necessidade_especial1_idx` (`necessidade_especial_id_necessidade_especial` ASC),
  INDEX `fk_contratante_necessidade_especial_contratante1_idx` (`contratante_id_contratante` ASC),
  CONSTRAINT `fk_contratante_necessidade_especial_contratante1`
    FOREIGN KEY (`contratante_id_contratante`)
    REFERENCES `ajudevovo`.`contratante` (`id_contratante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratante_necessidade_especial_necessidade_especial1`
    FOREIGN KEY (`necessidade_especial_id_necessidade_especial`)
    REFERENCES `ajudevovo`.`necessidade_especial` (`id_necessidade_especial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`prestador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`prestador` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`prestador` (
  `id_prestador` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` INT(11) NOT NULL,
  `id_conta_bancaria` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_prestador`),
  INDEX `id_pessoa` (`id_pessoa` ASC),
  INDEX `id_conta_bancaria` (`id_conta_bancaria` ASC),
  CONSTRAINT `prestador_ibfk_1`
    FOREIGN KEY (`id_pessoa`)
    REFERENCES `ajudevovo`.`pessoa_fisica` (`id_pessoa_fisica`),
  CONSTRAINT `prestador_ibfk_2`
    FOREIGN KEY (`id_conta_bancaria`)
    REFERENCES `ajudevovo`.`conta_bancaria` (`id_conta_bancaria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`servico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`servico` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`servico` (
  `id_servico` INT(11) NOT NULL AUTO_INCREMENT,
  `id_prestador` INT(11) NOT NULL,
  `id_categoria` INT(11) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `valor` FLOAT NOT NULL,
  `detalhe` VARCHAR(100) NULL DEFAULT NULL,
  `ativo` TINYINT(1) NULL DEFAULT '1',
  PRIMARY KEY (`id_servico`),
  INDEX `id_prestador` (`id_prestador` ASC),
  INDEX `id_categoria` (`id_categoria` ASC),
  CONSTRAINT `servico_ibfk_1`
    FOREIGN KEY (`id_prestador`)
    REFERENCES `ajudevovo`.`prestador` (`id_prestador`),
  CONSTRAINT `servico_ibfk_2`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `ajudevovo`.`categoria` (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`dia_disponivel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`dia_disponivel` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`dia_disponivel` (
  `id_dia_disponivel` INT(11) NOT NULL AUTO_INCREMENT,
  `id_servico` INT(11) NOT NULL,
  `nr_dia` INT(11) NULL DEFAULT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_dia_disponivel`),
  INDEX `id_servico` (`id_servico` ASC),
  CONSTRAINT `dia_disponivel_ibfk_1`
    FOREIGN KEY (`id_servico`)
    REFERENCES `ajudevovo`.`servico` (`id_servico`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`endereco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`endereco` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`endereco` (
  `id_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cidade` INT(11) NOT NULL,
  `id_pessoa` INT(11) NOT NULL,
  `bairro` VARCHAR(255) NULL DEFAULT NULL,
  `rua` VARCHAR(12) NULL DEFAULT NULL,
  `numero` INT(11) NULL DEFAULT NULL,
  `complemento` VARCHAR(255) NULL DEFAULT NULL,
  `cep` BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  INDEX `id_cidade` (`id_cidade` ASC),
  INDEX `id_pessoa` (`id_pessoa` ASC),
  CONSTRAINT `endereco_ibfk_1`
    FOREIGN KEY (`id_cidade`)
    REFERENCES `ajudevovo`.`cidade` (`id_cidade`),
  CONSTRAINT `endereco_ibfk_2`
    FOREIGN KEY (`id_pessoa`)
    REFERENCES `ajudevovo`.`pessoa_fisica` (`id_pessoa_fisica`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`estado_operacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`estado_operacao` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`estado_operacao` (
  `id_estado_operacao` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_estado_operacao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`forma_pagamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`forma_pagamento` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`forma_pagamento` (
  `id_forma_pagamento` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_forma_pagamento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`horario_disponivel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`horario_disponivel` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`horario_disponivel` (
  `id_horario_disponivel` INT(11) NOT NULL AUTO_INCREMENT,
  `id_dia_disponivel` INT(11) NOT NULL,
  `horario_inicio` TIME NOT NULL,
  `horario_fim` TIME NOT NULL,
  PRIMARY KEY (`id_horario_disponivel`),
  INDEX `id_dia_disponivel` (`id_dia_disponivel` ASC),
  CONSTRAINT `horario_disponivel_ibfk_1`
    FOREIGN KEY (`id_dia_disponivel`)
    REFERENCES `ajudevovo`.`dia_disponivel` (`id_dia_disponivel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`servico_avaliacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`servico_avaliacao` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`servico_avaliacao` (
  `id_servico_avaliacao` INT(11) NOT NULL AUTO_INCREMENT,
  `id_servico` INT(11) NOT NULL,
  `id_avaliacao` INT(11) NOT NULL,
  PRIMARY KEY (`id_servico_avaliacao`),
  INDEX `id_servico` (`id_servico` ASC),
  INDEX `id_avaliacao` (`id_avaliacao` ASC),
  CONSTRAINT `servico_avaliacao_ibfk_1`
    FOREIGN KEY (`id_servico`)
    REFERENCES `ajudevovo`.`servico` (`id_servico`),
  CONSTRAINT `servico_avaliacao_ibfk_2`
    FOREIGN KEY (`id_avaliacao`)
    REFERENCES `ajudevovo`.`avaliacao` (`id_avaliacao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ajudevovo`.`servico_solicitado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajudevovo`.`servico_solicitado` ;

CREATE TABLE IF NOT EXISTS `ajudevovo`.`servico_solicitado` (
  `id_servico_solicitacao` INT(11) NOT NULL AUTO_INCREMENT,
  `id_servico` INT(11) NOT NULL,
  `id_contratante` INT(11) NOT NULL,
  `id_forma_pagamento` INT(11) NOT NULL,
  `id_estado_operacao` INT(11) NOT NULL,
  `horario_inicio` TIME NULL DEFAULT NULL,
  `horario_fim` TIME NULL DEFAULT NULL,
  `dia_solicitacao` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id_servico_solicitacao`),
  INDEX `id_servico` (`id_servico` ASC),
  INDEX `id_contratante` (`id_contratante` ASC),
  INDEX `id_forma_pagamento` (`id_forma_pagamento` ASC),
  INDEX `id_estado_operacao` (`id_estado_operacao` ASC),
  CONSTRAINT `servico_solicitado_ibfk_1`
    FOREIGN KEY (`id_servico`)
    REFERENCES `ajudevovo`.`servico` (`id_servico`),
  CONSTRAINT `servico_solicitado_ibfk_2`
    FOREIGN KEY (`id_contratante`)
    REFERENCES `ajudevovo`.`contratante` (`id_contratante`),
  CONSTRAINT `servico_solicitado_ibfk_3`
    FOREIGN KEY (`id_forma_pagamento`)
    REFERENCES `ajudevovo`.`forma_pagamento` (`id_forma_pagamento`),
  CONSTRAINT `servico_solicitado_ibfk_4`
    FOREIGN KEY (`id_estado_operacao`)
    REFERENCES `ajudevovo`.`estado_operacao` (`id_estado_operacao`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

USE `ajudevovo` ;

-- -----------------------------------------------------
-- function get_telefone
-- -----------------------------------------------------

USE `ajudevovo`;
DROP function IF EXISTS `ajudevovo`.`get_telefone`;

DELIMITER $$
USE `ajudevovo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `get_telefone`( id_pessoa_fisica int) RETURNS varchar(255) CHARSET latin1
BEGIN
	
	DECLARE fone1 varchar(255);
	DECLARE fone2 varchar(255);
	DECLARE fone3 varchar(255);		

	SELECT
		ct.descricao
	INTO
		fone1
	FROM
		contato ct
	WHERE
		ct.id_pessoa = id_pessoa_fisica
		AND ct.id_tipo_contato = 1;

	SELECT
		ct.descricao
	INTO
		fone2
	FROM
		contato ct
	WHERE
		ct.id_pessoa = id_pessoa_fisica
		AND ct.id_tipo_contato = 2;

	SELECT
		ct.descricao
	INTO
		fone3
	FROM
		contato ct
	WHERE
		ct.id_pessoa = id_pessoa_fisica
		AND ct.id_tipo_contato = 3;
	
	if (fone1 is not null OR fone1 <> '') then
		return fone1;
	end if;

	if (fone2 is not null OR fone2 <> '') then
		return fone2;
	end if;	
	
	if (fone3 is not null OR fone3 <> '') then
		return fone3;
	end if;	
	
	return 'Erro - nenhum telefone cadastrado';
END$$

DELIMITER ;

-- -----------------------------------------------------
-- function obter_avaliacao
-- -----------------------------------------------------

USE `ajudevovo`;
DROP function IF EXISTS `ajudevovo`.`obter_avaliacao`;

DELIMITER $$
USE `ajudevovo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `obter_avaliacao`(`id_servico_p` INT) RETURNS float
BEGIN
	DECLARE retorno float;
	
	select
		avg(a.nota)
	into
		retorno
	from
		avaliacao a,
		servico_avaliacao sa
	where a.id_avaliacao = sa.id_avaliacao
	and sa.id_servico = id_servico_p;
	
	if (retorno is null) then
		set retorno = 0;
	end if;
	
	return retorno;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- function obter_quantidade_servicos
-- -----------------------------------------------------

USE `ajudevovo`;
DROP function IF EXISTS `ajudevovo`.`obter_quantidade_servicos`;

DELIMITER $$
USE `ajudevovo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `obter_quantidade_servicos`(`id_servico_p` INT) RETURNS int(11)
BEGIN
	DECLARE retorno INT;
	
	select
		count(*)
	into
		retorno
	from
		servico_solicitado ss
	where ss.id_servico = id_servico_p;
	
	return retorno;
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
