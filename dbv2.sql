USE `controleanimal`;
DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE `pessoas` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`endereco_id` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `rg` VARCHAR(20) NOT NULL,
    `cpf` VARCHAR(20)NOT NULL,
    `sexo` VARCHAR(1) NOT NULL,
    `numero_telefone` VARCHAR(20) NOT NULL,
    `data_nascimento` DATE NOT NULL,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL,
    
    
    CONSTRAINT `pessoas_enderecos` FOREIGN KEY (`endereco_id`) 
    REFERENCES `enderecos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);

DROP TABLE IF EXISTS `enderecos`;

CREATE TABLE `enderecos` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `logradouro` VARCHAR(100) NOT NULL,
	`numero` VARCHAR(20),
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `estado` VARCHAR(2) NOT NULL,
    `pais` VARCHAR (50) NOT NULL,
	`cep` VARCHAR(20),
	`data_alteracao` DATETIME,
	`data_cadastro` DATETIME NOT NULL,
	`usuario_cadastro` INT(11) NOT NULL,
	`usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL
);

DROP TABLE IF EXISTS `cargos`;

 CREATE TABLE `cargos`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100),
    `descricao` VARCHAR(100),
	`data_alteracao` DATETIME,
	`data_cadastro` DATETIME NOT NULL,
	`usuario_cadastro` INT(11) NOT NULL,
	`usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL
 );
 
 DROP TABLE IF EXISTS `funcionarios`;

CREATE TABLE `funcionarios` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `cargo_id` INT,
    `pessoa_id` INT,
    `usuario_id` INT,
    `salario` DECIMAL(10,2),
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL,
    
    CONSTRAINT `funcionarios_cargos` FOREIGN KEY (`cargo_id`)
    REFERENCES `cargos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    
    CONSTRAINT `funcionarios_pessoas` FOREIGN KEY (`pessoa_id`) 
    REFERENCES `pessoas` (`id`)
	ON DELETE RESTRICT
    ON UPDATE CASCADE,
    
    CONSTRAINT `funcionarios_usuarios` FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);

DROP TABLE IF EXISTS `laboratorios`;

CREATE TABLE `laboratorios` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `animal_id` INT UNSIGNED, 
    `dose_aplicada_id` INT,
    `hemograma_id` INT,
    `data_entrada` DATETIME NOT NULL,
    `data_saida` DATETIME,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL, 
    
    CONSTRAINT `laboratorios_doses_aplicadas` FOREIGN KEY (`dose_aplicada_id`)
    REFERENCES `doses_aplicadas` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    
    CONSTRAINT `laboratorios_animais` FOREIGN KEY (`animal_id`)
    REFERENCES `animais` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    
	CONSTRAINT `laboratorios_hemogramas` FOREIGN KEY (`hemograma_id`)
    REFERENCES `hemogramas` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);

DROP TABLE IF EXISTS `hemogramas`;

CREATE TABLE `hemogramas` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_exame` DATETIME NOT NULL,
    `ppt` DECIMAL(11,2) NOT NULL,
    `hematocrito` DECIMAL (11,2) NOT NULL,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL
);
DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE `medicamentos` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100),
    `prescricao` VARCHAR(100),
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL
);
DROP TABLE IF EXISTS `doses_aplicadas`;
CREATE TABLE `doses_aplicadas` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `medicamento_id` INT NOT NULL,
    `dose` INT NOT NULL,
    `data_aplicacao` DATE NOT NULL,
     `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL,
    
    CONSTRAINT `doses_aplicadas_medicamentos` FOREIGN KEY (`medicamento_id`)
    REFERENCES `medicamentos` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`grupo_id` INT,
    `login`VARCHAR(30) NOT NULL,
    `senha` VARCHAR(30) NOT NULL,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL,

	CONSTRAINT `usuarios_grupos` FOREIGN KEY (`grupo_id`)
    REFERENCES `grupos` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
);
    
DROP TABLE IF EXISTS `permissoes`;

CREATE TABLE `permissoes` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`nome_modulo` varchar(45) NOT NULL,
	`create` tinyint(4) NOT NULL DEFAULT '1',
	`read` tinyint(4) NOT NULL DEFAULT '1',
	`update` tinyint(4) NOT NULL DEFAULT '1',
	`delete` tinyint(4) NOT NULL DEFAULT '1',
	`data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11) NOT NULL
    );

DROP TABLE IF EXISTS `familias`;
CREATE TABLE `familias`(
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`mae_id` int(11) unsigned NOT NULL,
	`pai_id` int(11) unsigned NOT NULL,
	`filho_id` int(11) unsigned NOT NULL,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` tinyint(4) NOT NULL DEFAULT '1',
  
  CONSTRAINT `familias_animais_pai` FOREIGN KEY (`pai_id`) 
  REFERENCES `animais` (`id`) 
  ON DELETE NO ACTION ON UPDATE NO ACTION,
  
  CONSTRAINT `familias_animais_filho` FOREIGN KEY (`filho_id`) 
  REFERENCES `animais` (`id`) 
  ON DELETE NO ACTION ON UPDATE NO ACTION,
  
  CONSTRAINT `amilias_animais_mae` FOREIGN KEY (`mae_id`) 
  REFERENCES `animais` (`id`) 
  ON DELETE NO ACTION ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `permissao_id` INT NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(150) NOT NULL DEFAULT 'Sem descrição',
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  
  CONSTRAINT `grupo_permissao` FOREIGN KEY (`permissao_id`)
  REFERENCES `permissoes` (`id`)
  ON UPDATE CASCADE ON DELETE RESTRICT
  );

INSERT INTO cargos (nome,descricao,data_alteracao,data_cadastro,usuario_cadastro,usuario_alteracao,status)
 VALUE ('Tec de campo', 'responsavel pelo manejo em campo aberto', now(), now(), 1,1,1);

INSERT INTO doses_aplicadas (medicamento_id, dose, data_aplicacao, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status) 
VALUE (1, 1, now(), now(), now(), 1, 1, 1);

INSERT INTO medicamentos (nome, prescricao, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
VALUES 	('Nariclonasal', 'Nariz entupido, 1 dose a cada 10 hrs', now(), now(), 1, 1, 1);

INSERT INTO familias (mae_id, pai_id, filho_id, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status) 
VALUE (1, 3, 4, now(), now(), 1,1,1);

INSERT INTO familias (mae_id, pai_id, filho_id, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status) 
VALUE (1, 3, 6, now(), now(), 1,1,1);

INSERT INTO familias (mae_id, pai_id, filho_id, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status) 
VALUE (1, 3, 9, now(), now(), 1,1,1);

INSERT INTO pessoas (endereco_id, nome, rg, cpf, sexo, numero_telefone, data_nascimento, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
VALUES (1, 'Brunno Henrique Campos Inacio', '123123', '12312312312', 'm', '64992427676', 1994-07-01, now(), now(), 1,1,1);

INSERT INTO pessoas (endereco_id, nome, rg, cpf, sexo, numero_telefone, data_nascimento, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
VALUES (2, 'Thalles Joaquim Silveira', '321321', '12312312332', 'm', '64992423232', 1994-07-01, now(), now(), 1,1,1);

INSERT INTO usuarios(grupo_id, login, senha, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
VALUES (1, 'brunnousername', 'useruser', now(), now(), 1,1,1);

INSERT INTO hemogramas(data_exame, ppt, hematocrito, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
 VALUES (now(), 50, 60,now() ,now(), 1,1,1);
 
 INSERT INTO laboratorios (animal_id, dose_aplicada_id, hemograma_id, data_saida, data_entrada, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
 VALUES ( 3, 2, 1, now(), now(), now(), now(), 1, 1,1);
 
 INSERT INTO permissoes (grupo_id, nome_modulo, `create`, `read`, `update`, `delete`, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
 VALUES(1, 'ADMINS', 1,1,1,1, now(), now(), 1,1,1);
 
 INSERT INTO funcionarios(cargo_id, pessoa_id, usuario_id, salario, data_alteracao, data_cadastro, usuario_cadastro, usuario_alteracao, status)
 values (1, 1, 1, 1500, now(), now(), 1,1,1);