CREATE TABLE `pessoas` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`endereco_id` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `rg` INT (11) NOT NULL,
    `cpf` INT (11) NOT NULL,
    `sexo` VARCHAR(1) NOT NULL,
    `numero_telefone` INT (11) NOT NULL,
    `data_nascimento` DATETIME NOT NULL,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11),
    
    
    CONSTRAINT `pessoa_endereco` FOREIGN KEY (`endereco_id`) 
    REFERENCES `enderecos` (`id`)
    ON DELETE NO ACTION 
    ON UPDATE NO ACTION
);

CREATE TABLE `enderecos` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `logradouro` VARCHAR(100) NOT NULL,
   `numero` INT(11),
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `estado` VARCHAR(2) NOT NULL,
    `pais` VARCHAR (50) NOT NULL,
	`cep` INT(11),
	`data_alteracao` DATETIME,
	`data_cadastro` DATETIME NOT NULL,
	`usuario_cadastro` INT(11) NOT NULL,
	`usuario_alteracao` INT(11),
    `status` INT(11)
);

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
    `status` INT(11),
    
    CONSTRAINT `funcionarios_cargos` FOREIGN KEY (`cargo_id`)
    REFERENCES `cargos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    
    CONSTRAINT `funcionarios_pessoas` FOREIGN KEY (`pessoa_id`) 
    REFERENCES `pessoas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    
    CONSTRAINT `funcionarios_usuarios` FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE `grupos` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `descricao` VARCHAR(100),
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11)
);

CREATE TABLE `laboratorios` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `doenca_id` INT,
    `animal_id` INT NOT NULL, 
    `medicamento_id` INT,
    `dose_aplicada` INT(11),
    `hemograma_id` INT,
    `data_entrada` DATETIME NOT NULL,
    `data_saida` DATETIME,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11), 
    
    CONSTRAINT `laboratorios_doenca` FOREIGN KEY (`doenca_id`) REFERENCES `doencas` (`id`)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
    
    CONSTRAINT `laboratorios_medicamentos` FOREIGN KEY (`medicamentos_id`) REFERENCES `medicamentos` (`id`)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
    
    CONSTRAINT `laboratorios_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`)
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE `hemogramas` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_exame` DATETIME NOT NULL,
    `teste_ppt` DECIMAL(11,2) NOT NULL,
    `teste_hematocrito` DECIMAL (11,2) NOT NULL,
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11)
);

CREATE TABLE `medicamentos` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100),
    `prescricao` VARCHAR(100),
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11)
);

CREATE TABLE `permissoes` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `grupo_id` INT,
    `nome` VARCHAR(100),
    `data_alteracao` DATETIME,
    `data_cadastro` DATETIME NOT NULL,
    `usuario_cadastro` INT(11) NOT NULL,
    `usuario_alteracao` INT(11),
    `status` INT(11), 
    
    CONSTRAINT `permissoes_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
    ON DELETE NO ACTION ON UPDATE NO ACTION
    
);





