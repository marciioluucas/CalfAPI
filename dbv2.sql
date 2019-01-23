-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 14, 2018 at 12:51 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `controleanimal`
--

-- --------------------------------------------------------

--
-- Table structure for table `animais`
--

CREATE TABLE `animais` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `data_nascimento` date NOT NULL,
  `primogenito` tinyint(4) NOT NULL DEFAULT '0',
  `codigo_brinco` varchar(20) DEFAULT 'Não informado',
  `codigo_raca` varchar(20) DEFAULT 'Não informado',
  `status` tinyint(4) DEFAULT '1',
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL COMMENT ' ',
  `usuario_alteracao` int(11) DEFAULT NULL,
  `lotes_id` int(11) NOT NULL,
  `is_vivo` tinyint(4) NOT NULL DEFAULT '1',
  `fase_vida` varchar(20) DEFAULT 'RECEM_NASCIDO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animais`
--


-- --------------------------------------------------------

--
-- Table structure for table `animais_has_doencas`
--

CREATE TABLE `animais_has_doencas` (
  `animais_id` int(11) UNSIGNED NOT NULL,
  `doencas_id` int(11) NOT NULL,
  `situacao` varchar(45) NOT NULL DEFAULT 'NAO INFORMADA',
  `data_adoecimento` date NOT NULL,
  `data_cura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animais_has_doencas`
--


-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cargos`
--


-- --------------------------------------------------------

--
-- Table structure for table `doencas`
--

CREATE TABLE `doencas` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `descricao` text,
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doencas`
--


--
-- Table structure for table `doses`
--

CREATE TABLE `doses` (
  `id` int(11) NOT NULL,
  `medicamento_id` int(11) NOT NULL,
  `animal_id` int(10) UNSIGNED NOT NULL,
  `quantidade_mg` decimal(10,2) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `logradouro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enderecos`
--


-- --------------------------------------------------------

--
-- Table structure for table `familias`
--

CREATE TABLE `familias` (
  `id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `mae_id` int(11) UNSIGNED NOT NULL,
  `pai_id` int(11) UNSIGNED NOT NULL,
  `filho_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familias`
--

INSERT INTO `familias` (`id`, `status`, `mae_id`, `pai_id`, `filho_id`) VALUES
(15, 1, 16, 15, 17),
(16, 1, 16, 15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `fazendas`
--

CREATE TABLE `fazendas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `limite` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fazendas`
--


-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `fazenda_id` int(11) NOT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `funcionarios`
--


-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sem descrição',
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grupos`
--


-- --------------------------------------------------------

--
-- Table structure for table `hemogramas`
--

CREATE TABLE `hemogramas` (
  `id` int(11) NOT NULL,
  `animal_id` int(10) UNSIGNED NOT NULL,
  `ppt` decimal(10,2) NOT NULL,
  `hematocrito` decimal(10,2) NOT NULL,
  `data` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hemogramas`
--


-- --------------------------------------------------------

--
-- Table structure for table `lotes`
--

CREATE TABLE `lotes` (
  `id` int(11) NOT NULL,
  `fazenda_id` int(11) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lotes`
--


-- --------------------------------------------------------

--
-- Table structure for table `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prescricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medicamentos`
--


-- --------------------------------------------------------

--
-- Table structure for table `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `nome_modulo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `create` tinyint(4) NOT NULL DEFAULT '1',
  `read` tinyint(4) NOT NULL DEFAULT '1',
  `update` tinyint(4) NOT NULL DEFAULT '1',
  `delete` tinyint(4) NOT NULL DEFAULT '1',
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissoes`
--


--
-- Table structure for table `pesagens`
--

CREATE TABLE `pesagens` (
  `id` int(11) NOT NULL,
  `data_pesagem` date NOT NULL,
  `peso` float(4,2) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL COMMENT ' ',
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(45) DEFAULT '1',
  `animais_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesagens`
--


-- --------------------------------------------------------

--
-- Table structure for table `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `numero_telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pessoas`
--



--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--



--
-- Indexes for table `animais`
--
ALTER TABLE `animais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animais_lotes1_idx` (`lotes_id`);

--
-- Indexes for table `animais_has_doencas`
--
ALTER TABLE `animais_has_doencas`
  ADD PRIMARY KEY (`animais_id`,`doencas_id`),
  ADD KEY `fk_animais_has_doencas_doencas1_idx` (`doencas_id`),
  ADD KEY `fk_animais_has_doencas_animais1_idx` (`animais_id`);

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doencas`
--
ALTER TABLE `doencas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`);

--
-- Indexes for table `doses`
--
ALTER TABLE `doses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doses_animais_idx` (`animal_id`),
  ADD KEY `doses_medicamentos_idx` (`medicamento_id`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_familias_animais1_idx` (`pai_id`),
  ADD KEY `fk_familias_animais2_idx` (`filho_id`),
  ADD KEY `fk_familias_animais3_idx` (`mae_id`);

--
-- Indexes for table `fazendas`
--
ALTER TABLE `fazendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_fazenda` (`fazenda_id`),
  ADD KEY `funcionarios_cargos` (`cargo_id`),
  ADD KEY `funcionarios_pessoas` (`pessoa_id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_permissao` (`permissao_id`);

--
-- Indexes for table `hemogramas`
--
ALTER TABLE `hemogramas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hemogramas_animais_idx` (`animal_id`);

--
-- Indexes for table `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lotes_fazendas_idx` (`fazenda_id`);

--
-- Indexes for table `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesagens`
--
ALTER TABLE `pesagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesagens_animais1_idx` (`animais_id`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pessoas_enderecos` (`endereco_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_grupos_idx` (`grupo_id`),
  ADD KEY `usuarios_funcionarios` (`funcionario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animais`
--
ALTER TABLE `animais`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `doencas`
--
ALTER TABLE `doencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `doses`
--
ALTER TABLE `doses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `fazendas`
--
ALTER TABLE `fazendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `hemogramas`
--
ALTER TABLE `hemogramas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pesagens`
--
ALTER TABLE `pesagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `animais`
--
ALTER TABLE `animais`
  ADD CONSTRAINT `fk_animais_lotes1` FOREIGN KEY (`lotes_id`) REFERENCES `lotes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `animais_has_doencas`
--
ALTER TABLE `animais_has_doencas`
  ADD CONSTRAINT `fk_animais_has_doencas_animais1` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_animais_has_doencas_doencas1` FOREIGN KEY (`doencas_id`) REFERENCES `doencas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doses`
--
ALTER TABLE `doses`
  ADD CONSTRAINT `doses_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doses_medicamentos` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `familias`
--
ALTER TABLE `familias`
  ADD CONSTRAINT `fk_familias_animais1` FOREIGN KEY (`pai_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_familias_animais2` FOREIGN KEY (`filho_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_familias_animais3` FOREIGN KEY (`mae_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionario_fazenda` FOREIGN KEY (`fazenda_id`) REFERENCES `fazendas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionarios_cargos` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionarios_pessoas` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupo_permissao` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `hemogramas`
--
ALTER TABLE `hemogramas`
  ADD CONSTRAINT `hemogramas_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_fazendas` FOREIGN KEY (`fazenda_id`) REFERENCES `fazendas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pesagens`
--
ALTER TABLE `pesagens`
  ADD CONSTRAINT `fk_pesagens_animais1` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD CONSTRAINT `pessoas_enderecos` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON UPDATE CASCADE;
  
  
  INSERT INTO `pessoas` (`id`, `endereco_id`, `nome`, `rg`, `cpf`, `sexo`, `numero_telefone`, `data_nascimento`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 1, 'Brunno Henrique Campos Inácio', '123123', '12312312312', 'm', '64999999999', '1994-07-01', '2018-10-03 20:02:18', '2018-10-03 20:02:18', 1, NULL, 1),
(2, 1, 'Brunno Henrique ', '123456', '12312312456', 'm', '64999999456', '1994-07-02', '2018-10-03 20:11:51', '2018-10-03 20:05:15', 1, 1, 0),
(3, 5, 'Pablo', '66676', '76767676767', 'm', '76767676767', '2012-12-19', '2018-10-26 22:22:19', '2018-10-26 22:22:19', 1, NULL, 1),
(4, 6, 'Milton', '2342342', '23423423423', 'm', '64888888888', '1994-12-12', '2018-11-14 16:59:16', '2018-10-28 10:17:42', 1, NULL, 0),
(5, 6, 'Pablo Marcelo Siqueira', '567567', '75567567567', 'm', '64987655678', '1994-12-01', '2018-10-28 13:43:00', '2018-10-28 13:42:59', 1, NULL, 1),
(6, 5, 'Divina Roda Campos', '123123', '12312312312', 'f', '64987655678', '1988-12-30', '2018-10-28 13:52:08', '2018-10-28 13:52:07', 1, NULL, 1),
(7, 7, 'Joslaine Guimaraes', '4343434', '54354354343', 'f', '64987688999', '1994-07-01', '2018-11-05 19:07:55', '2018-11-05 19:07:54', 1, NULL, 1),
(8, 3, 'CharlesXavier', '1234321', '11122233311', 'm', '64992428686', '1994-01-01', '2018-11-14 14:36:49', '2018-11-14 14:36:49', 1, NULL, 1),
(9, 3, 'Carlos Castanha Xavier', '3213212', '33322211121', 'm', '64992426767', '1994-01-01', '2018-11-14 15:20:41', '2018-11-14 15:20:41', 1, NULL, 1),
(10, 6, 'Carlos Henrique', '4564564', '20020020020', 'm', '64992540654', '1986-01-01', '2018-11-14 15:28:34', '2018-11-14 15:28:33', 1, NULL, 1),
(11, 6, 'Barbara Vieira', '8908900', '10010010011', 'f', '64981222211', '1989-01-01', '2018-11-14 15:30:33', '2018-11-14 15:30:33', 1, NULL, 1),
(12, 9, 'Milton Vieira Inácio', '4545567', '78998778998', 'm', '64992740674', '1959-05-11', '2018-11-14 17:02:10', '2018-11-14 17:02:10', 1, NULL, 1);

INSERT INTO `enderecos` (`id`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'Rua Goias', 'Qd 17 Lt 17', 'Morro da Saudade 01', 'Morrinhos', 'go', 'Brasil', '75650000', '2018-09-27 06:51:23', '2018-09-27 06:45:39', 1, 1, 1),
(2, 'Rua Amazonas', '53-A', 'Centro', 'Morrinhos', 'go', 'Brasil', '75650000', '2018-09-27 06:55:37', '2018-09-27 06:46:05', 1, NULL, 0),
(3, 'Rua CP-01', 'Qd 05 Lt 01', 'Cristina park', 'Morrinhos', 'go', 'Brasil', '75650000', '2018-09-27 06:46:55', '2018-09-27 06:46:55', 1, NULL, 1),
(4, 'Rua dos Carajas', '05', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2018-10-26 20:01:12', '2018-10-26 20:01:12', 1, NULL, 1),
(5, 'Rua 14', '05', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2018-10-26 20:46:16', '2018-10-26 20:46:16', 1, NULL, 1),
(6, 'Rua 2', '345', 'Morro da Saudade 2', 'Morrinhos', 'GO', 'Brasil', '75650000', '2018-10-28 09:50:06', '2018-10-28 09:50:05', 1, NULL, 1),
(7, 'Rua Dr Pedro Nunes', '1503', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2018-11-05 19:07:27', '2018-11-05 19:07:27', 1, NULL, 1),
(8, 'Rua CR3', '50', 'Cristo', 'Morrinhos', 'GO', 'Brasil', '75650000', '2018-11-14 16:27:48', '2018-11-14 16:27:48', 1, NULL, 1),
(9, 'Rua CP-02', 'QD 03 Lt 18', 'Cristinapark', 'Morrinhos', 'GO', 'Brasil', '75650000', '2018-11-14 17:00:44', '2018-11-14 17:00:44', 1, NULL, 1);

INSERT INTO `fazendas` (`id`, `nome`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`, `limite`) VALUES
(1, 'Fazenda Nossa Senhora aparecida', '2018-02-13 00:00:00', '2018-02-13 00:00:00', 1, 1, 1, 1),
(2, 'Fazenda Sao Caetano', '2018-10-14 11:03:23', '2018-08-14 21:45:13', 1, NULL, 0, 1),
(3, 'fazenda sao caetano', '2018-10-14 11:02:33', '2018-08-14 21:47:54', 1, NULL, 0, 1),
(4, 'fazenda sao caetano', '2018-10-14 11:04:39', '2018-08-14 21:53:50', 1, NULL, 0, 1),
(5, 'fazenda sao caetano', '2018-08-14 21:55:57', '2018-08-14 21:55:57', 1, NULL, 1, 1),
(6, 'fazenda', '2018-10-14 10:58:44', '2018-08-14 22:11:52', 1, NULL, 0, 1),
(7, 'fazenda', '2018-10-14 11:00:00', '2018-08-14 22:13:09', 1, NULL, 0, 1),
(8, 'fazenda', '2018-10-14 11:00:55', '2018-08-14 22:14:26', 1, NULL, 0, 1),
(9, 'fazenda', '2018-08-14 22:14:38', '2018-08-14 22:14:38', 1, NULL, 1, 1),
(10, 'fazenda', '2018-10-14 11:01:19', '2018-08-14 22:17:44', 1, NULL, 0, 1),
(11, 'Fazenda São José', '2018-08-14 22:44:15', '2018-08-14 22:44:15', 1, NULL, 1, 1),
(12, 'Fazenda Mata da arara', '2018-08-15 06:58:09', '2018-08-15 06:58:09', 1, NULL, 1, 1),
(13, 'Fazenda Ourinhos', '2018-10-14 11:05:24', '2018-08-15 06:58:33', 1, NULL, 0, 1),
(14, 'fazenda chapadão', '2018-10-28 13:40:20', '2018-10-28 13:40:20', 1, NULL, 1, 1),
(15, 'Fazenda Arara Vermelha', '2018-10-28 13:41:11', '2018-10-28 13:41:11', 1, NULL, 1, 1),
(16, 'Fazenda', '2018-11-15 11:12:34', '2018-11-02 14:50:05', 1, NULL, 0, 1),
(17, 'Fazenda', '2018-11-15 11:13:26', '2018-11-02 14:50:11', 1, NULL, 0, 1),
(18, 'fazenda', '2018-11-02 14:50:15', '2018-11-02 14:50:15', 1, NULL, 1, 1),
(19, 'fazenda', '2018-11-02 14:50:26', '2018-11-02 14:50:26', 1, NULL, 1, 1),
(20, 'fazenda', '2018-11-02 14:50:30', '2018-11-02 14:50:30', 1, NULL, 1, 1),
(21, 'Fazenda Chapadão', '2018-11-02 15:59:19', '2018-11-02 15:59:19', 1, NULL, 1, 1),
(22, 'fazenda serra', '2018-11-02 16:24:54', '2018-11-02 16:24:54', 1, NULL, 1, 1),
(23, 'Fazenda Serradão', '2018-11-02 16:31:25', '2018-11-02 16:31:25', 1, NULL, 1, 1),
(24, 'Fazenda Nova Gama', '2018-11-02 16:32:40', '2018-11-02 16:32:40', 1, NULL, 1, 1),
(25, 'Fazenda Nova', '2018-11-02 16:34:06', '2018-11-02 16:34:06', 1, NULL, 1, 1),
(26, 'Fazenda Gama', '2018-11-02 16:36:08', '2018-11-02 16:36:08', 1, NULL, 1, 1),
(27, 'Fazenda Aparecida', '2018-11-02 20:42:32', '2018-11-02 20:42:32', 1, NULL, 1, 1),
(28, 'Fazenda Farias', '2018-11-02 23:04:07', '2018-11-02 23:04:07', 1, NULL, 1, 1),
(29, 'Fazenda Colmeias', '2018-11-02 23:06:12', '2018-11-02 23:06:12', 1, NULL, 1, 1),
(30, 'Fazenda das Fazendas', '2018-11-02 23:29:01', '2018-11-02 23:29:01', 1, NULL, 1, 1),
(31, 'Fazenda Serra Azul', '2018-11-15 11:12:00', '2018-11-15 11:12:00', 1, NULL, 1, 1),
(32, 'Fazenda Santa barbara', '2018-11-15 15:29:05', '2018-11-15 15:29:05', 1, NULL, 1, 1);

-- --------------------------------------------------------
INSERT INTO `grupos` (`id`, `permissao_id`, `nome`, `descricao`, `data_cadastro`, `data_alteracao`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(2, 1, 'Administradores Setor 01', 'Administração setor principal', '2018-09-27 15:38:24', '2018-09-27 15:38:25', 1, NULL, 0),
(3, 1, 'Peões Setor 01', 'Peões campo 01', '2018-09-27 15:39:46', '2018-09-28 10:15:21', 1, NULL, 0),
(4, 2, 'Peões Setor 07', 'Peões campo secreto 07', '2018-09-27 15:41:46', '2018-09-27 15:46:28', 1, 1, 0),
(6, 2, 'Peões Setor 11', 'Peões campo 11', '2018-09-27 15:42:34', '2018-11-15 22:21:26', 1, NULL, 0),
(7, 3, 'Peão 01', 'Peão pivo 01', '2018-10-07 21:42:52', '2018-11-15 22:22:05', 1, NULL, 0),
(8, 4, 'Grupo PIVO 02', 'Grupo de Tecnicos do PIVO 02', '2018-10-07 22:18:50', '2018-10-07 22:18:50', 1, NULL, 1),
(9, 5, 'Gerente animais', 'Gerencia o departamento dos animais', '2018-11-15 21:42:09', '2018-11-15 21:42:10', 1, NULL, 1),
(10, 8, 'Gerente Laboratório', 'Gerencia laboratorios', '2018-11-15 21:55:53', '2018-11-15 21:55:53', 1, NULL, 1),
(11, 1, 'gerente', 'gerente', '2018-11-15 22:25:23', '2018-11-15 22:25:58', 1, NULL, 0),
(12, 1, 'gerente 2', 'gerente2', '2018-11-15 22:25:37', '2018-11-15 22:26:05', 1, NULL, 0),
(13, 1, 'gerente03', 'gerente03', '2018-11-15 22:25:51', '2018-11-15 22:26:55', 1, NULL, 0),
(14, 1, 'gerenteJR', 'gerenteJR', '2018-11-15 22:27:46', '2018-11-15 22:27:57', 1, NULL, 0);

INSERT INTO `permissoes` (`id`, `nome_modulo`, `create`, `read`, `update`, `delete`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, ' Administrador', 1, 1, 1, 1, '2018-09-27 08:54:12', '2018-09-27 08:54:12', 1, NULL, 1),
(2, ' Peões', 1, 1, 1, 1, '2018-11-16 13:58:16', '2018-09-27 15:40:58', 1, NULL, 0),
(3, 'PIVO 01', 1, 1, 0, 0, '2018-11-16 14:31:38', '2018-10-07 21:31:07', 1, NULL, 0),
(4, 'PIVO 02', 1, 1, 1, 0, '2018-10-07 21:32:28', '2018-10-07 21:32:27', 1, NULL, 1),
(5, 'Animais', 1, 1, 0, 0, '2018-10-28 16:30:22', '2018-10-28 16:30:22', 1, NULL, 1),
(6, 'Exames', 1, 1, 1, 0, '2018-10-28 16:33:19', '2018-10-28 16:33:19', 1, NULL, 1),
(7, 'Pesagens', 0, 0, 0, 0, '2018-10-28 16:34:42', '2018-10-28 16:34:42', 1, NULL, 1),
(8, 'laboratório', 1, 1, 1, 1, '2018-11-15 21:54:10', '2018-11-15 21:54:09', 1, NULL, 1),
(9, 'campo01', 1, 1, 1, 1, '2018-11-16 14:33:54', '2018-11-16 14:32:38', 1, NULL, 0),
(10, 'campo02', 1, 1, 1, 1, '2018-11-16 14:37:30', '2018-11-16 14:32:48', 1, NULL, 0),
(11, 'campo03', 1, 1, 1, 1, '2018-11-16 14:40:11', '2018-11-16 14:32:58', 1, NULL, 0);


INSERT INTO `pesagens` (`id`, `data_pesagem`, `peso`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`, `animais_id`) VALUES
(1, '2018-03-04', 50.00, NULL, '2018-03-09 15:59:11', 1, NULL, 1, 1),
(2, '2018-03-06', 59.00, NULL, '2018-03-09 15:59:43', 1, NULL, 1, 1),
(3, '2018-03-07', 61.20, NULL, '2018-03-09 16:00:17', 1, NULL, 1, 1),
(4, '2018-02-01', 45.00, NULL, '2018-03-09 16:00:58', 1, NULL, 1, 1),
(5, '2018-01-15', 55.00, NULL, '2018-03-18 16:11:27', 1, NULL, 1, 6),
(6, '2018-02-16', 68.00, NULL, '2018-03-18 16:11:28', 1, NULL, 1, 6),
(7, '2018-03-18', 79.00, NULL, '2018-03-18 16:11:29', 1, NULL, 1, 6),
(8, '2018-10-30', 34.00, '2018-10-31 22:32:59', '2018-10-31 22:32:59', 1, NULL, 1, 20),
(9, '1969-12-31', 60.00, '2018-11-05 16:14:43', '2018-11-05 16:14:42', 1, NULL, 1, 1),
(10, '1969-12-31', 57.00, '2018-11-05 16:16:15', '2018-11-05 16:16:15', 1, NULL, 1, 1),
(11, '2018-10-18', 65.00, '2018-11-05 16:18:59', '2018-11-05 16:18:59', 1, NULL, 1, 1),
(12, '2018-10-19', 30.00, '2018-11-05 16:39:39', '2018-11-05 16:39:39', 1, NULL, 1, 1),
(13, '2018-11-15', 42.00, '2018-11-15 16:07:46', '2018-11-15 16:07:46', 1, NULL, 1, 23),
(14, '2018-11-15', 43.00, '2018-11-15 16:08:00', '2018-11-15 16:08:00', 1, NULL, 1, 23),
(15, '2018-11-15', 45.00, '2018-11-15 16:08:03', '2018-11-15 16:08:03', 1, NULL, 1, 23),
(16, '2018-11-15', 47.00, '2018-11-15 16:08:06', '2018-11-15 16:08:06', 1, NULL, 1, 23),
(17, '2018-11-15', 49.00, '2018-11-15 16:08:09', '2018-11-15 16:08:09', 1, NULL, 1, 23);


-- --------------------------------------------------------
INSERT INTO `medicamentos` (`id`, `nome`, `prescricao`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'Nariclonasal', 'Nariz entupido, 1 dose a cada 10 hrs', '2018-09-26 22:19:58', '2018-09-17 21:40:41', 1, 1, 0),
(2, 'lacrimaril', 'excesso de lacrimejação, 1 dose a cada 12 hrs', '2018-09-26 21:59:39', '2018-09-26 21:54:23', 1, 1, 0),
(3, 'Gripeol', 'contra gripe bovina, 1 dose a cada 8 hrs', '2018-09-26 21:55:19', '2018-09-26 21:55:19', 1, NULL, 0),
(4, 'Gripeol V2', 'contra gripe bovina, 1 dose a cada 8 hrs', '2018-09-26 21:55:44', '2018-09-26 21:55:44', 1, NULL, 1),
(5, 'Ocitocina', 'liberação de leite, 1 dose a cada 8 hrs', '2018-09-27 21:13:27', '2018-09-27 21:13:27', 1, NULL, 1),
(6, 'Ocitocina V2', 'liberação leiteira, 1 dose a cada 8 hrs', '2018-10-09 22:15:48', '2018-10-09 22:15:48', 1, NULL, 1),
(7, 'Gripeol V2', 'contra gripe bovina, 1 dose a cada 8 hrs', '2018-10-13 14:44:09', '2018-10-13 14:44:09', 1, NULL, 1),
(8, 'metrodina', 'metrodina lins, de 8 em 8 horas', '2018-10-14 12:33:53', '2018-10-14 12:33:53', 1, NULL, 1),
(9, 'remedio bovino', 'remedio bovino', '2018-10-14 16:25:40', '2018-10-14 14:43:23', 1, NULL, 0),
(10, 'remedio 02', 'remedio 02', '2018-10-14 16:22:46', '2018-10-14 14:49:03', 1, 1, 1);

INSERT INTO `animais` (`id`, `nome`, `sexo`, `data_nascimento`, `primogenito`, `codigo_brinco`, `codigo_raca`, `status`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `lotes_id`, `is_vivo`, `fase_vida`) VALUES
(1, 'Mimosa', '', '2017-04-11', 0, 'Não informado', 'Não informado', 1, '2018-11-15 11:14:58', '2018-02-13 00:00:00', 1, NULL, 1, 1, 'BEZERRO'),
(2, 'Teste datetime', '', '2017-11-15', 0, 'AA1253', 'Não informado', 0, '2018-11-02 11:17:14', '2018-02-13 00:00:00', 1, NULL, 1, 1, 'BEZERRO'),
(3, 'Marcio Lucas', '', '1998-02-11', 0, '003', '512', 0, '2018-11-15 11:14:54', '2018-02-13 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(4, 'Maconha', '', '1998-02-11', 0, '004', '512', 0, '2018-02-14 00:00:00', '2018-02-13 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(5, 'Maconha', '', '1998-02-11', 0, '004', '512', 0, '2018-02-14 00:00:00', '2018-02-13 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(6, 'Maconha', '', '1998-02-11', 0, '004', '512', 0, '2018-11-15 11:31:11', '2018-02-16 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(7, 'Xurubiba', '', '1998-02-11', 0, '004', '512', 0, '2018-11-15 11:32:31', '2018-02-16 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(8, 'Pururuca', '', '1998-02-11', 0, '006', '512', 0, '2018-11-15 12:34:20', '2018-02-16 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(9, 'Pamonha', '', '1998-02-11', 0, '007', '512', 0, '2018-11-02 11:18:02', '2018-02-16 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(10, 'Pamonha', '', '1998-02-11', 0, '006', '512', 0, '2018-11-02 11:18:11', '2018-02-16 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(11, 'Pamonha', '', '1998-02-11', 0, '006', '512', 0, '2018-11-02 11:18:28', '2018-02-16 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(12, 'Pamonha', '', '1998-02-11', 0, '1515', '512', 0, '2018-11-02 11:18:29', '2018-02-19 00:00:00', 0, NULL, 1, 1, 'BEZERRO'),
(13, 'Teste OO', '', '1998-02-11', 0, '1515', '512', 0, '2018-11-15 12:29:13', '2018-02-22 15:48:34', 1, NULL, 1, 1, 'BEZERRO'),
(14, 'Teste OO2', '', '1998-02-11', 0, '1515', '512', 0, '2018-11-15 12:30:57', '2018-02-26 13:16:50', 1, NULL, 1, 1, 'BEZERRO'),
(15, 'Comonder', 'm', '2018-10-30', 0, '97', '0', 1, '2018-10-30 21:36:47', '2018-10-30 21:36:47', 1, 1, 2, 1, 'ADULTO'),
(16, 'Graca', 'f', '2018-10-30', 0, '99', '0', 1, '2018-10-30 22:23:47', '2018-10-30 22:23:47', 1, 1, 2, 1, 'ADULTO'),
(17, '94', 'm', '2018-10-30', 0, '94', '0', 0, '2018-11-15 12:32:55', '2018-10-31 21:14:04', 1, NULL, 11, 1, 'BEZERRO'),
(18, '94', 'm', '2018-10-30', 0, '94', '0', 0, '2018-10-31 22:08:33', '2018-10-31 21:54:50', 1, NULL, 11, 1, 'BEZERRO'),
(19, '94', 'm', '2018-10-30', 0, '94', '0', 0, '2018-10-31 22:08:27', '2018-10-31 21:58:25', 1, NULL, 11, 1, 'BEZERRO'),
(20, '110', 'f', '2018-10-30', 0, '110', '0', 0, '2018-11-15 12:33:22', '2018-10-31 22:25:34', 1, NULL, 11, 1, 'BEZERRO'),
(21, '123123', 'm', '1969-12-31', 0, '123123', 'Q123', 0, '2018-11-15 11:14:32', '2018-11-08 14:49:10', 1, NULL, 2, 1, 'BEZERRO'),
(23, 'heny', 'f', '2018-08-11', 0, '321321', 'q333', 1, '2018-11-08 22:59:07', '2018-11-08 22:59:07', 1, NULL, 2, 1, 'BEZERRO'),
(24, 'heny', 'f', '2018-08-11', 0, '321321', 'q333', 0, '2018-11-08 23:02:39', '2018-11-08 23:01:14', 1, NULL, 2, 1, 'BEZERRO'),
(25, 'Nativa', 'f', '2018-11-09', 0, '223333', 'Q2233', 1, '2018-11-09 08:45:08', '2018-11-09 08:45:08', 1, NULL, 2, 1, 'BEZERRO'),
(26, 'Betina', 'f', '2018-11-09', 0, '444444', 'Q444', 1, '2018-11-09 09:17:22', '2018-11-09 09:17:22', 1, NULL, 2, 1, 'BEZERRO'),
(27, 'Jaqui', 'f', '2018-11-09', 0, '44555', 'Q455', 1, '2018-11-09 09:32:30', '2018-11-09 09:32:30', 1, NULL, 2, 1, 'BEZERRO'),
(28, 'Boi', 'm', '2018-11-09', 0, '5554', 'Q554', 1, '2018-11-09 09:41:00', '2018-11-09 09:41:00', 1, NULL, 2, 1, 'BEZERRO'),
(29, 'Monterey', 'm', '2018-11-09', 0, '5566', 'Q556', 1, '2018-11-09 09:46:47', '2018-11-09 09:46:47', 1, NULL, 2, 1, 'BEZERRO'),
(30, 'bryant', 'm', '2018-11-09', 0, '1', 'q1', 1, '2018-11-09 14:25:21', '2018-11-09 14:15:23', 1, 1, 2, 1, 'RECEM_NASCIDO'),
(31, 'Vernada', 'm', '2018-11-09', 0, '2', 'q2', 1, '2018-11-09 14:34:03', '2018-11-09 14:34:03', 1, NULL, 2, 1, 'Adulto'),
(32, 'Animalaa', 'm', '2018-11-15', 0, '02', 'Q02', 0, '2018-11-15 14:19:24', '2018-11-15 12:57:27', 1, NULL, 2, 1, 'RECEM_NASCIDO'),
(33, 'AnimalII', 'm', '2018-11-15', 0, '03', 'Q03', 0, '2018-11-15 14:19:04', '2018-11-15 13:04:10', 1, NULL, 2, 1, 'RECEM_NASCIDO'),
(34, 'Animaliii', 'm', '2018-11-15', 0, '04', 'Q04', 0, '2018-11-15 14:19:14', '2018-11-15 13:08:38', 1, NULL, 2, 1, 'RECEM_NASCIDO'),
(35, 'Animaliiii', 'm', '2018-11-15', 0, '05', 'Q05', 0, '2018-11-15 14:19:17', '2018-11-15 13:13:59', 1, NULL, 2, 1, 'RECEM_NASCIDO'),
(36, 'Animaliiiii', 'm', '2018-11-15', 0, '06', 'Q06', 0, '2018-11-15 14:19:20', '2018-11-15 14:17:57', 1, NULL, 2, 1, 'RECEM_NASCIDO'),
(37, 'AnimalII', 'm', '2018-11-15', 0, '03', 'Q03', 1, '2018-12-04 21:23:01', '2018-12-04 21:23:01', 1, NULL, 2, 1, 'RECEM_NASCIDO'),
(38, 'AnimalII', 'm', '2018-11-15', 0, '03', 'Q03', 1, '2018-12-04 21:23:06', '2018-12-04 21:23:06', 1, NULL, 2, 1, 'RECEM_NASCIDO');

INSERT INTO `lotes` (`id`, `fazenda_id`, `codigo`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, NULL, 777777, '2018-10-21 18:23:51', '2018-02-13 00:00:00', 1, 1, 0),
(2, 1, 8080, '2018-10-21 18:47:05', '2018-10-21 18:04:29', 1, 1, 1),
(3, 1, 9999, '2018-10-21 18:11:15', '2018-10-21 18:11:15', 1, 1, 1),
(4, 1, 15158, '2018-10-21 18:47:18', '2018-10-21 18:11:33', 1, 1, 1),
(5, 1, 2000, '2018-10-21 18:11:50', '2018-10-21 18:11:50', 1, 1, 1),
(6, 1, 3000, '2018-10-21 18:11:55', '2018-10-21 18:11:55', 1, 1, 1),
(7, 1, 4000, '2018-10-21 18:12:02', '2018-10-21 18:12:02', 1, 1, 1),
(8, 1, 4000, '2018-10-21 18:12:09', '2018-10-21 18:12:09', 1, 1, 1),
(9, 1, 5000, '2018-10-21 18:12:17', '2018-10-21 18:12:17', 1, 1, 1),
(10, 5, 30301, '2018-10-31 14:18:42', '2018-10-31 14:18:42', 1, NULL, 1),
(11, 5, 50501, '2018-10-31 14:19:31', '2018-10-31 14:19:31', 1, NULL, 1),
(12, 5, 50501, '2018-10-31 15:06:17', '2018-10-31 15:06:16', 1, NULL, 1),
(13, NULL, 1, '2018-11-16 15:02:17', '2018-11-16 15:02:17', 1, NULL, 1),
(14, NULL, 2, '2018-11-16 15:02:45', '2018-11-16 15:02:45', 1, NULL, 1),
(15, NULL, 3, '2018-11-16 15:02:51', '2018-11-16 15:02:51', 1, NULL, 1),
(16, NULL, 1, '2018-11-16 15:02:58', '2018-11-16 15:02:58', 1, NULL, 1),
(17, NULL, 2, '2018-11-16 15:03:05', '2018-11-16 15:03:05', 1, NULL, 1),
(18, NULL, 3, '2018-11-16 15:03:12', '2018-11-16 15:03:12', 1, NULL, 1),
(19, NULL, 1, '2018-11-16 15:03:26', '2018-11-16 15:03:26', 1, NULL, 1),
(20, NULL, 3, '2018-11-16 15:03:52', '2018-11-16 15:03:52', 1, NULL, 1),
(21, NULL, 4, '2018-11-16 15:04:01', '2018-11-16 15:04:01', 1, NULL, 1);

INSERT INTO `animais_has_doencas` (`animais_id`, `doencas_id`, `situacao`, `data_adoecimento`, `data_cura`) VALUES
(1, 1, 'NAO INFORMADA', '0000-00-00', NULL),
(3, 3, 'DOENTE', '2018-10-23', NULL),
(7, 3, 'DOENTE', '2018-10-23', NULL),
(8, 3, 'DOENTE', '2018-10-23', NULL);

INSERT INTO `cargos` (`id`, `nome`, `descricao`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'Tec de campo', 'responsavel pelo manejo em campo aberto', '2018-10-13 14:12:39', '2018-09-17 21:33:52', 1, 1, 0),
(2, NULL, NULL, '2018-09-24 22:37:19', '2018-09-24 22:37:19', 1, NULL, 0),
(3, NULL, NULL, '2018-09-24 22:43:35', '2018-09-24 22:43:35', 1, NULL, 0),
(4, NULL, NULL, '2018-09-25 21:45:35', '2018-09-25 21:45:34', 1, NULL, 0),
(5, NULL, NULL, '2018-09-25 21:51:31', '2018-09-25 21:51:31', 1, NULL, 0),
(6, 'Gerente', 'Gerente', '2018-09-25 21:55:03', '2018-09-25 21:55:03', 1, NULL, 0),
(7, 'Peao', 'Peao setor 01', '2018-09-25 21:59:11', '2018-09-25 21:59:11', 1, NULL, 0),
(8, 'Peao SR', 'Peao SR Setor 01', '2018-09-25 22:14:10', '2018-09-25 22:05:09', 1, 1, 0),
(9, 'Peao PL Setor 09', 'Peao PL setor 09', '2018-10-13 14:12:43', '2018-09-25 22:06:55', 1, 1, 0),
(10, 'Tec de campo PIVO 01', 'Responsável pelo PIVO 01', '2018-10-06 23:11:36', '2018-10-06 23:11:35', 1, NULL, 1),
(11, 'Tec de Campo PIVO 02', 'Tec responsável pelo PIVO 02', '2018-10-07 10:37:01', '2018-10-07 10:37:01', 1, NULL, 1),
(12, 'Peao Junior', 'peao Junior badeco', '2018-10-13 14:01:55', '2018-10-13 13:43:06', 1, 1, 0),
(13, 'Gerente Nivel 01', 'Gerente Nivel 01', '2018-10-13 13:45:18', '2018-10-13 13:45:18', 1, NULL, 1),
(14, 'Gerente nível 02', 'Gerente Nivel 02', '2018-10-13 13:49:21', '2018-10-13 13:49:21', 1, NULL, 1),
(15, 'Peao Senior', 'Peao senior senior', '2018-10-13 22:28:03', '2018-10-13 22:23:33', 1, 1, 0);

INSERT INTO `hemogramas` (`id`, `animal_id`, `ppt`, `hematocrito`, `data`, `data_alteracao`, `data_cadastro`, `usuario_alteracao`, `usuario_cadastro`, `status`) VALUES
(1, 1, '40.00', '40.00', '2018-10-28 15:53:48', '2018-10-28 15:53:48', '2018-10-28 15:53:48', 1, 1, 1),
(2, 1, '41.00', '41.00', '2018-10-28 15:54:14', '2018-10-28 15:54:14', '2018-10-28 15:54:14', 1, 1, 1),
(3, 1, '40.00', '40.00', '2018-10-28 15:54:38', '2018-10-28 15:54:38', '2018-10-28 15:54:38', 1, 1, 1),
(4, 1, '45.00', '45.00', '2018-10-28 15:54:47', '2018-10-28 15:54:47', '2018-10-28 15:54:47', 1, 1, 1),
(6, 1, '6.00', '47.00', '2018-10-20 00:00:00', '2018-11-05 18:48:53', '2018-11-05 18:48:53', NULL, 1, 1);

INSERT INTO `funcionarios` (`id`, `cargo_id`, `pessoa_id`, `fazenda_id`, `salario`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(5, 6, 2, 1, '2000.00', '2018-12-11 20:51:58', '2018-12-11 20:51:58', 1, 1, 1);


INSERT INTO `doencas` (`id`, `nome`, `descricao`, `data_cadastro`, `data_alteracao`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'pneumonia', 'Sem descrição', '2018-02-26 07:00:00', '2018-08-20 22:02:43', 1, 1, 1),
(3, 'Diarreia', 'Bosta Rala', '2018-02-26 13:23:32', '2018-08-20 22:41:08', 1, 1, 1),
(4, 'gripe', 'SEM DESCRIÇÃO', '2018-02-26 13:24:07', '2018-02-26 13:24:07', 1, NULL, 1),
(5, 'Gripe Bovina', 'Vaca gripada com nariz ruim', '2018-08-15 06:26:45', '2018-08-15 06:26:45', 1, NULL, 1),
(6, 'Chagas', 'Chagas em bezerros de 1 ano', '2018-08-15 07:22:50', '2018-08-15 07:22:50', 1, NULL, 1),
(7, 'Babezia', 'Doença do carapato', '2018-08-20 22:12:56', '2018-08-20 22:12:56', 1, NULL, 1),
(8, 'Anaplasma', 'Doença do carapato safado', '2018-08-20 22:16:32', '2018-08-20 22:16:32', 1, NULL, 1),
(9, 'Bicheira', 'Bicheira de mosca feia', '2018-08-20 22:40:40', '2018-08-20 22:40:40', 1, NULL, 1),
(10, 'Diareia Nivel 1', 'Diareia nivel 1', '2018-10-13 14:27:20', '2018-10-13 14:27:20', 1, NULL, 1);

-- --------------------------------------------------------
insert into familias (status, mae_id, pai_id, filho_id) values (1, 16, 15, 1);
