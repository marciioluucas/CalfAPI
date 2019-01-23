-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 18, 2019 at 02:10 AM
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
  `fase_vida` varchar(20) DEFAULT 'RECEM_NASCIDO',
  `fazendas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animais`
--


--
-- Table structure for table `animais_has_doencas`
--

CREATE TABLE `animais_has_doencas` (
  `id` int(11) NOT NULL,
  `animais_id` int(11) UNSIGNED NOT NULL,
  `doencas_id` int(11) NOT NULL,
  `situacao` varchar(45) NOT NULL DEFAULT 'NAO INFORMADA',
  `data_adoecimento` date NOT NULL,
  `data_cura` date DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `data_alteracao` date DEFAULT NULL
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



-- --------------------------------------------------------

--
-- Table structure for table `doses`
--

CREATE TABLE `doses` (
  `id` int(11) NOT NULL,
  `medicamento_id` int(11) NOT NULL,
  `animal_id` int(10) UNSIGNED NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `quantidade_mg` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doses`
--

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
  `filho_id` int(11) UNSIGNED NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) DEFAULT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familias`
--



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
  `grupo_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

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

-- --------------------------------------------------------

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
-- Indexes for dumped tables
--

--
-- Indexes for table `animais`
--
ALTER TABLE `animais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animais_lotes1_idx` (`lotes_id`),
  ADD KEY `animais_fazendas_idx` (`fazendas_id`);

--
-- Indexes for table `animais_has_doencas`
--
ALTER TABLE `animais_has_doencas`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `doses_medicamentos_idx` (`medicamento_id`),
  ADD KEY `doses_funcionarios_idx` (`funcionario_id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissoes_grupos_idx` (`grupo_id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `animais_has_doencas`
--
ALTER TABLE `animais_has_doencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `doencas`
--
ALTER TABLE `doencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `doses`
--
ALTER TABLE `doses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `fazendas`
--
ALTER TABLE `fazendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `hemogramas`
--
ALTER TABLE `hemogramas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pesagens`
--
ALTER TABLE `pesagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `animais`
--
ALTER TABLE `animais`
  ADD CONSTRAINT `animais_fazendas` FOREIGN KEY (`fazendas_id`) REFERENCES `fazendas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_animais_lotes1` FOREIGN KEY (`lotes_id`) REFERENCES `lotes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `animais_has_doencas`
--
ALTER TABLE `animais_has_doencas`
  ADD CONSTRAINT `fk_animais_has_doencas_animais` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_animais_has_doencas_doencas1` FOREIGN KEY (`doencas_id`) REFERENCES `doencas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doses`
--
ALTER TABLE `doses`
  ADD CONSTRAINT `doses_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doses_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON UPDATE CASCADE,
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
-- Constraints for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD CONSTRAINT `permissoes_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON UPDATE CASCADE;

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
  
  
  
INSERT INTO `animais` (`id`, `nome`, `sexo`, `data_nascimento`, `primogenito`, `codigo_brinco`, `codigo_raca`, `status`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `lotes_id`, `is_vivo`, `fase_vida`, `fazendas_id`) VALUES
(1, 'Mimosa', '', '2017-04-11', 0, 'Não informado', 'Não informado', 1, '2018-11-15 11:14:58', '2018-02-13 00:00:00', 1, NULL, 1, 1, 'BEZERRO', 2),
(2, 'Marcio', 'm', '1999-11-15', 0, 'AA1253', 'Não informado', 1, '2018-11-02 11:17:14', '2018-02-13 00:00:00', 1, NULL, 2, 1, 'BEZERRO', 1),
(9, 'Geovana', 'f', '1998-02-11', 0, '007', '512', 1, '2018-11-02 11:18:02', '2018-02-16 00:00:00', 1, NULL, 2, 1, 'BEZERRO', 1),
(15, 'Comonder', 'm', '2018-10-30', 0, '97', '0', 1, '2018-10-30 21:36:47', '2018-10-30 21:36:47', 1, 1, 2, 1, 'ADULTO', 2),
(16, 'Graca', 'f', '2018-10-30', 0, '99', '0', 1, '2018-10-30 22:23:47', '2018-10-30 22:23:47', 1, 1, 2, 1, 'ADULTO', 2),
(17, 'Xurubiba', 'f', '1998-02-11', 0, '004', '512', 0, '2018-12-26 19:48:51', '2018-12-26 19:48:51', 0, NULL, 1, 1, 'BEZERRO', 1),
(18, 'Xurubiba02', 'f', '1998-02-11', 0, '004', '512', 0, '2019-01-16 22:01:54', '2018-12-26 19:51:16', 0, NULL, 1, 1, 'BEZERRO', 1),
(19, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:50', '2019-01-16 20:47:07', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(20, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:02:07', '2019-01-16 21:26:45', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(21, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:46', '2019-01-16 21:27:12', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(22, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:38', '2019-01-16 21:27:12', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(23, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:37', '2019-01-16 21:27:41', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(24, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:35', '2019-01-16 21:27:41', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(25, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:34', '2019-01-16 21:27:55', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(26, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:32', '2019-01-16 21:34:56', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(27, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:31', '2019-01-16 21:34:56', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(28, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:29', '2019-01-16 21:34:56', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(29, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:28', '2019-01-16 21:34:56', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(30, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:02:11', '2019-01-16 21:36:49', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(31, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:23', '2019-01-16 21:36:49', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(32, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:21', '2019-01-16 21:40:18', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(33, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:19', '2019-01-16 21:40:18', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(34, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 21:58:19', '2019-01-16 21:41:47', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(35, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 21:58:59', '2019-01-16 21:41:47', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(36, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:04', '2019-01-16 21:45:38', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(37, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:01:12', '2019-01-16 21:52:32', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(38, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:56', '2019-01-16 21:53:47', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(39, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:51', '2019-01-16 21:54:46', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(40, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:00:45', '2019-01-16 21:57:22', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(41, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:35:21', '2019-01-16 22:06:32', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(42, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:34:41', '2019-01-16 22:11:21', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(43, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:35:14', '2019-01-16 22:13:08', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(44, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-16 22:35:10', '2019-01-16 22:14:55', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(45, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:10', '2019-01-16 23:06:55', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(46, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:20', '2019-01-16 23:10:05', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(47, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:24', '2019-01-16 23:11:55', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(48, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:56', '2019-01-16 23:15:12', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(49, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:48', '2019-01-16 23:18:53', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(50, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:46', '2019-01-16 23:23:08', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(51, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:39:44', '2019-01-17 19:31:49', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(52, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:43', '2019-01-17 19:33:42', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(53, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:41', '2019-01-17 19:35:13', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(54, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:38', '2019-01-17 19:35:24', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(55, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:40', '2019-01-17 19:37:08', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(56, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:52', '2019-01-17 19:37:50', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(57, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:51', '2019-01-17 19:38:38', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(58, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:44:54', '2019-01-17 19:39:53', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(59, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:37', '2019-01-17 19:46:31', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(60, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:13', '2019-01-17 19:48:04', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(61, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:14', '2019-01-17 19:50:48', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(62, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:16', '2019-01-17 19:57:47', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(63, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:17', '2019-01-17 19:59:10', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(64, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:18', '2019-01-17 20:00:32', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(65, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:18', '2019-01-17 20:02:03', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(66, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:19', '2019-01-17 20:04:22', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(67, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:20', '2019-01-17 20:10:28', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(68, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:21', '2019-01-17 20:13:00', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(69, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:22', '2019-01-17 20:16:08', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(70, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:39', '2019-01-17 20:17:23', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(71, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:45:41', '2019-01-17 20:18:58', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(72, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:46:14', '2019-01-17 20:21:40', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(73, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:46:05', '2019-01-17 20:23:09', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(74, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:46:02', '2019-01-17 20:23:20', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(75, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 1, '2019-01-17 20:24:07', '2019-01-17 20:24:07', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(76, 'Reny', 'f', '2019-01-15', 0, '01', 'Q01', 0, '2019-01-17 22:46:10', '2019-01-17 21:02:50', 1, NULL, 2, 1, 'RECEM_NASCIDO', 1),
(77, 'Pablo', 'm', '1999-11-15', 0, 'AA1253', 'Não informado', 1, '2018-11-02 11:17:14', '2018-02-13 00:00:00', 1, NULL, 2, 1, 'ADULTO', 1),
(78, 'liliam', 'f', '1998-02-11', 0, '007', '512', 1, '2018-11-02 11:18:02', '2018-02-16 00:00:00', 1, NULL, 2, 1, 'ADULTO', 1),
(79, 'milton', 'm', '1999-11-15', 0, 'AA1253', 'Não informado', 1, '2018-11-02 11:17:14', '2018-02-13 00:00:00', 1, NULL, 2, 1, 'ADULTO', 1),
(80, 'divina', 'f', '1998-02-11', 0, '007', '512', 1, '2018-11-02 11:18:02', '2018-02-16 00:00:00', 1, NULL, 2, 1, 'ADULTO', 1);



INSERT INTO `animais_has_doencas` (`id`, `animais_id`, `doencas_id`, `situacao`, `data_adoecimento`, `data_cura`, `data_cadastro`, `data_alteracao`) VALUES
(1, 18, 1, 'DOENTE', '2019-01-15', NULL, '2019-01-15', '2019-01-15'),
(2, 1, 1, 'DOENTE', '2019-01-15', NULL, '2019-01-15', '2019-01-15');


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
(10, 'Tec de campo PIVO 01', 'Responsável pelo PIVO 01', '2019-01-08 22:28:06', '2018-10-06 23:11:35', 1, NULL, 0),
(11, 'Tec de Campo PIVO 02', 'Tec responsável pelo PIVO 02', '2019-01-08 22:28:09', '2018-10-07 10:37:01', 1, NULL, 0),
(12, 'Peao Junior', 'peao Junior badeco', '2018-10-13 14:01:55', '2018-10-13 13:43:06', 1, 1, 0),
(13, 'Gerente Nivel 01', 'Gerente Nivel 01', '2019-01-08 22:28:11', '2018-10-13 13:45:18', 1, NULL, 0),
(14, 'Gerente nível 02', 'Gerente Nivel 02', '2019-01-08 22:28:15', '2018-10-13 13:49:21', 1, NULL, 0),
(15, 'Peao Senior', 'Peao senior senior', '2018-10-13 22:28:03', '2018-10-13 22:23:33', 1, 1, 0),
(16, 'Técnico de campo', 'Técnico de campo', '2019-01-08 22:27:36', '2019-01-08 22:27:36', 1, NULL, 1),
(17, 'RH', 'Recursos Humanos', '2019-01-15 21:17:48', '2019-01-15 21:17:48', 1, NULL, 1),
(18, 'Recursos Humanos', 'Recursos Humanos', '2019-01-15 21:18:29', '2019-01-15 21:18:07', 1, NULL, 0);

INSERT INTO `doencas` (`id`, `nome`, `descricao`, `data_cadastro`, `data_alteracao`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'Chagas tipo12', 'Chagas pouco fudido', '2019-01-15 19:35:26', '2019-01-15 19:37:57', 1, 1, 1),
(2, 'Doença do carapato', 'doença do carapato', '2019-01-15 21:04:32', '2019-01-15 21:04:32', 1, NULL, 1),
(3, 'Babesia', 'babesia tipo 1', '2019-01-15 21:09:28', '2019-01-15 21:11:56', 1, 1, 1),
(4, 'Anaplasma', 'anaplasma tipo 1', '2019-01-15 21:10:20', '2019-01-15 21:10:21', 1, NULL, 1);



INSERT INTO `doses` (`id`, `medicamento_id`, `animal_id`, `funcionario_id`, `quantidade_mg`, `data`, `data_alteracao`, `data_cadastro`, `usuario_alteracao`, `usuario_cadastro`, `status`) VALUES
(1, 1, 1, 5, '2.40', '2019-01-15', '2019-01-15 20:48:52', '2019-01-15 20:48:52', NULL, 1, 1),
(2, 2, 18, 5, '2.70', '2019-01-15', '2019-01-15 20:57:39', '2019-01-15 20:57:39', NULL, 1, 1);

INSERT INTO `enderecos` (`id`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'Rua Goias', 'Qd 17 Lt 17', 'Morro da Saudade 01', 'Morrinhos', 'go', 'Brasil', '75650000', '2019-01-08 22:16:54', '2018-09-27 06:45:39', 1, 1, 0),
(2, 'Rua Amazonas', '53-A', 'Centro', 'Morrinhos', 'go', 'Brasil', '75650000', '2018-09-27 06:55:37', '2018-09-27 06:46:05', 1, NULL, 0),
(3, 'Rua CP-01', 'Qd 05 Lt 01', 'Cristina park', 'Morrinhos', 'go', 'Brasil', '75650000', '2019-01-08 22:17:01', '2018-09-27 06:46:55', 1, NULL, 0),
(4, 'Rua dos Carajas', '05', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:17:04', '2018-10-26 20:01:12', 1, NULL, 0),
(5, 'Rua 14', '05', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:17:22', '2018-10-26 20:46:16', 1, NULL, 0),
(6, 'Rua 2', '345', 'Morro da Saudade 2', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:17:24', '2018-10-28 09:50:05', 1, NULL, 0),
(7, 'Rua Dr Pedro Nunes', '1503', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:17:41', '2018-11-05 19:07:27', 1, NULL, 0),
(8, 'Rua CR3', '50', 'Cristo', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:17:43', '2018-11-14 16:27:48', 1, NULL, 0),
(9, 'Rua CP-02', 'QD 03 Lt 18', 'Cristinapark', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:17:46', '2018-11-14 17:00:44', 1, NULL, 0),
(10, 'Rua Goias 02', 'Qd 17 Lt 17', 'Morro da Saudade 01', 'Morrinhos', 'go', 'Brasil', '75650000', '2019-01-08 22:17:49', '2019-01-07 20:39:34', 1, NULL, 0),
(11, 'Rua Goias 02', 'Qd 17 Lt 17', 'Morro da Saudade 01', 'Morrinhos', 'go', 'Brasil', '75650000', '2019-01-08 22:16:24', '2019-01-07 20:40:00', 1, NULL, 0),
(12, 'Rua Goias 02', 'Qd 17 Lt 17', 'Morro da Saudade 01', 'Morrinhos', 'go', 'Brasil', '75650000', '2019-01-08 22:16:21', '2019-01-07 21:33:46', 1, NULL, 0),
(13, 'rua 01', '01', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:16:17', '2019-01-07 21:48:50', 1, NULL, 0),
(14, 'rua 01', '01', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:16:12', '2019-01-07 21:59:53', 1, NULL, 0),
(15, 'rua 01', '01', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:16:08', '2019-01-07 22:06:06', 1, NULL, 0),
(16, 'rua 02', '02', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:16:03', '2019-01-07 22:09:50', 1, NULL, 0),
(17, 'rua 01', '01', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:15:59', '2019-01-07 22:12:45', 1, NULL, 0),
(18, 'rua 10', '10', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:15:56', '2019-01-07 22:14:31', 1, NULL, 0),
(19, 'rua 01', '01 ', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:15:53', '2019-01-08 21:26:04', 1, NULL, 0),
(20, 'rua 01', '1', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:15:49', '2019-01-08 21:34:46', 1, NULL, 0),
(21, 'rua cp02', 'Qd 03 Lt 18', 'Cristinapark', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:30:19', '2019-01-08 22:30:19', 1, NULL, 1),
(22, 'Rua 02 ', '02', 'Oeste', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-08 22:52:22', '2019-01-08 22:52:22', 1, NULL, 1),
(23, 'Rua cp 02 ', 'QD 03 LT 18', 'Cristinapark', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-11 22:28:37', '2019-01-11 20:07:48', 1, 1, 1),
(24, 'rua 03', '03', 'Centro', 'Morrinhos', 'GO', 'Brasil', '75650000', '2019-01-14 21:51:45', '2019-01-14 21:51:44', 1, NULL, 1);

INSERT INTO `familias` (`id`, `status`, `mae_id`, `pai_id`, `filho_id`, `data_cadastro`, `data_alteracao`, `usuario_cadastro`, `usuario_alteracao`) VALUES
(1, 1, 16, 15, 69, '2019-01-17 20:16:09', '2019-01-17 20:16:09', NULL, NULL),
(2, 1, 16, 15, 74, '2019-01-17 20:23:20', '2019-01-17 20:23:20', NULL, NULL),
(3, 1, 16, 15, 75, '2019-01-17 20:24:07', '2019-01-17 20:24:07', NULL, NULL),
(4, 1, 9, 2, 15, '2019-01-17 20:35:39', '2019-01-17 20:35:39', NULL, NULL),
(5, 1, 9, 2, 1, '2019-01-17 20:39:51', '2019-01-17 20:39:51', NULL, NULL),
(6, 1, 16, 15, 76, '2019-01-17 21:02:50', '2019-01-17 21:02:50', NULL, NULL),
(7, 1, 78, 77, 1, '2019-01-17 22:08:14', '2019-01-17 22:08:14', NULL, NULL),
(8, 1, 78, 77, 16, '2019-01-17 22:08:56', '2019-01-17 22:08:56', NULL, NULL),
(9, 1, 80, 79, 77, '2019-01-17 22:19:26', '2019-01-17 22:19:26', NULL, NULL);


INSERT INTO `fazendas` (`id`, `nome`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`, `limite`) VALUES
(1, 'Fazenda Nossa Senhora aparecida', '2018-02-13 00:00:00', '2018-02-13 00:00:00', 1, 1, 1, 1),
(2, 'Fazenda Sao Caetano', '2018-10-14 11:03:23', '2018-08-14 21:45:13', 1, NULL, 0, 1),
(5, 'fazenda sao caetano', '2018-08-14 21:55:57', '2018-08-14 21:55:57', 1, NULL, 1, 1),
(6, 'fazenda', '2018-10-14 10:58:44', '2018-08-14 22:11:52', 1, NULL, 0, 1),
(7, 'fazenda', '2018-10-14 11:00:00', '2018-08-14 22:13:09', 1, NULL, 0, 1),
(8, 'fazenda', '2018-10-14 11:00:55', '2018-08-14 22:14:26', 1, NULL, 0, 1),
(9, 'fazenda', '2019-01-08 22:23:53', '2018-08-14 22:14:38', 1, NULL, 0, 1),
(10, 'fazenda', '2018-10-14 11:01:19', '2018-08-14 22:17:44', 1, NULL, 0, 1),
(11, 'Fazenda São José', '2019-01-08 22:23:49', '2018-08-14 22:44:15', 1, NULL, 0, 1),
(12, 'Fazenda Mata da arara', '2019-01-08 22:22:27', '2018-08-15 06:58:09', 1, NULL, 0, 1),
(13, 'Fazenda Ourinhos', '2018-10-14 11:05:24', '2018-08-15 06:58:33', 1, NULL, 0, 1),
(14, 'fazenda chapadão', '2019-01-08 22:22:30', '2018-10-28 13:40:20', 1, NULL, 0, 1),
(15, 'Fazenda Arara Vermelha', '2019-01-08 22:22:35', '2018-10-28 13:41:11', 1, NULL, 0, 1),
(16, 'Fazenda', '2018-11-15 11:12:34', '2018-11-02 14:50:05', 1, NULL, 0, 1),
(17, 'Fazenda', '2018-11-15 11:13:26', '2018-11-02 14:50:11', 1, NULL, 0, 1),
(18, 'fazenda', '2019-01-08 22:22:37', '2018-11-02 14:50:15', 1, NULL, 0, 1),
(19, 'fazenda', '2019-01-08 22:22:41', '2018-11-02 14:50:26', 1, NULL, 0, 1),
(20, 'fazenda', '2019-01-08 22:22:44', '2018-11-02 14:50:30', 1, NULL, 0, 1),
(21, 'Fazenda Chapadão', '2019-01-08 22:22:48', '2018-11-02 15:59:19', 1, NULL, 0, 1),
(22, 'fazenda serra', '2019-01-08 22:22:51', '2018-11-02 16:24:54', 1, NULL, 0, 1),
(23, 'Fazenda Serradão', '2019-01-08 22:22:53', '2018-11-02 16:31:25', 1, NULL, 0, 1),
(24, 'Fazenda Nova Gama', '2019-01-08 22:22:56', '2018-11-02 16:32:40', 1, NULL, 0, 1),
(25, 'Fazenda Nova', '2019-01-08 22:23:36', '2018-11-02 16:34:06', 1, NULL, 0, 1),
(26, 'Fazenda Gama', '2019-01-08 22:22:58', '2018-11-02 16:36:08', 1, NULL, 0, 1),
(27, 'Fazenda Aparecida', '2019-01-08 22:23:04', '2018-11-02 20:42:32', 1, NULL, 0, 1),
(28, 'Fazenda Farias', '2019-01-08 22:23:06', '2018-11-02 23:04:07', 1, NULL, 0, 1),
(29, 'Fazenda Colmeias', '2019-01-08 22:23:09', '2018-11-02 23:06:12', 1, NULL, 0, 1),
(30, 'Fazenda das Fazendas', '2019-01-08 22:23:15', '2018-11-02 23:29:01', 1, NULL, 0, 1),
(31, 'Fazenda Serra Azul', '2019-01-08 22:23:32', '2018-11-15 11:12:00', 1, NULL, 0, 1),
(32, 'Fazenda Santa barbara', '2019-01-08 22:23:20', '2018-11-15 15:29:05', 1, NULL, 0, 1);

INSERT INTO `funcionarios` (`id`, `cargo_id`, `pessoa_id`, `fazenda_id`, `salario`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(5, 6, 2, 1, '2000.00', '2018-12-11 20:51:58', '2018-12-11 20:51:58', 1, 1, 1),
(6, 13, 27, 1, '100000.00', '2019-01-08 22:20:53', '2019-01-08 21:34:47', 1, NULL, 0),
(7, 16, 28, 5, '1500.00', '2019-01-08 22:30:19', '2019-01-08 22:30:19', 1, NULL, 1),
(8, 16, 29, 5, '2000.00', '2019-01-08 22:52:22', '2019-01-08 22:52:22', 1, NULL, 1),
(9, 16, 30, 5, '1500.00', '2019-01-11 22:28:37', '2019-01-11 20:07:49', 1, 1, 1),
(10, 16, 31, 1, '1200.00', '2019-01-14 21:51:45', '2019-01-14 21:51:45', 1, NULL, 1);



INSERT INTO `grupos` (`id`, `nome`, `descricao`, `data_cadastro`, `data_alteracao`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(16, 'administrador', 'administrador', '2019-01-14 20:51:31', '2019-01-14 21:47:56', 1, 1, 1),
(17, 'Gerente', 'Gerente', '2019-01-14 21:48:21', '2019-01-14 21:48:21', 1, NULL, 1),
(18, 'Tecnicos', 'Tecnicos', '2019-01-14 21:48:34', '2019-01-14 21:48:34', 1, NULL, 1);



INSERT INTO `hemogramas` (`id`, `animal_id`, `ppt`, `hematocrito`, `data`, `data_alteracao`, `data_cadastro`, `usuario_alteracao`, `usuario_cadastro`, `status`) VALUES
(1, 1, '3.90', '19.00', '2019-01-15 00:00:00', '2019-01-15 19:42:25', '2019-01-15 19:42:25', NULL, 1, 1),
(2, 18, '3.90', '19.00', '2019-01-15 00:00:00', '2019-01-15 19:46:57', '2019-01-15 19:46:57', NULL, 1, 1),
(3, 18, '3.70', '18.00', '2019-01-15 00:00:00', '2019-01-15 19:52:29', '2019-01-15 19:52:29', NULL, 1, 1),
(4, 1, '3.50', '16.00', '2018-01-15 00:00:00', '2019-01-15 19:56:25', '2019-01-15 19:56:25', NULL, 1, 1),
(5, 39, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 21:54:47', '2019-01-16 21:54:47', NULL, 1, 1),
(6, 39, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 21:54:47', '2019-01-16 21:54:47', NULL, 1, 1),
(7, 40, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 21:57:22', '2019-01-16 21:57:22', NULL, 1, 1),
(8, 40, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 21:57:22', '2019-01-16 21:57:22', NULL, 1, 1),
(9, 41, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:06:33', '2019-01-16 22:06:33', NULL, 1, 1),
(10, 41, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:06:33', '2019-01-16 22:06:33', NULL, 1, 1),
(11, 42, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:11:22', '2019-01-16 22:11:22', NULL, 1, 1),
(12, 43, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:13:09', '2019-01-16 22:13:09', NULL, 1, 1),
(13, 43, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:13:09', '2019-01-16 22:13:09', NULL, 1, 1),
(14, 44, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:14:56', '2019-01-16 22:14:56', NULL, 1, 1),
(15, 44, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 22:14:56', '2019-01-16 22:14:56', NULL, 1, 1),
(16, 45, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 23:06:55', '2019-01-16 23:06:55', NULL, 1, 1),
(17, 45, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 23:06:55', '2019-01-16 23:06:55', NULL, 1, 1),
(18, 50, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 23:23:08', '2019-01-16 23:23:08', NULL, 1, 1),
(19, 50, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-16 23:23:08', '2019-01-16 23:23:08', NULL, 1, 1),
(20, 51, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:31:50', '2019-01-17 19:31:50', NULL, 1, 1),
(21, 51, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:31:50', '2019-01-17 19:31:50', NULL, 1, 1),
(22, 52, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:33:43', '2019-01-17 19:33:43', NULL, 1, 1),
(23, 52, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:33:43', '2019-01-17 19:33:43', NULL, 1, 1),
(24, 53, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:35:14', '2019-01-17 19:35:14', NULL, 1, 1),
(25, 53, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:35:14', '2019-01-17 19:35:14', NULL, 1, 1),
(26, 54, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:35:24', '2019-01-17 19:35:24', NULL, 1, 1),
(27, 54, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:35:24', '2019-01-17 19:35:24', NULL, 1, 1),
(28, 55, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:37:08', '2019-01-17 19:37:08', NULL, 1, 1),
(29, 56, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:37:50', '2019-01-17 19:37:50', NULL, 1, 1),
(30, 57, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:38:38', '2019-01-17 19:38:38', NULL, 1, 1),
(31, 58, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:39:54', '2019-01-17 19:39:54', NULL, 1, 1),
(32, 59, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:46:32', '2019-01-17 19:46:31', NULL, 1, 1),
(33, 60, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:48:05', '2019-01-17 19:48:04', NULL, 1, 1),
(34, 61, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:50:48', '2019-01-17 19:50:48', NULL, 1, 1),
(35, 62, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:57:48', '2019-01-17 19:57:48', NULL, 1, 1),
(36, 63, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 19:59:10', '2019-01-17 19:59:10', NULL, 1, 1),
(37, 64, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:00:32', '2019-01-17 20:00:32', NULL, 1, 1),
(38, 65, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:02:03', '2019-01-17 20:02:03', NULL, 1, 1),
(39, 66, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:04:22', '2019-01-17 20:04:22', NULL, 1, 1),
(40, 67, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:10:28', '2019-01-17 20:10:28', NULL, 1, 1),
(41, 68, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:13:01', '2019-01-17 20:13:01', NULL, 1, 1),
(42, 69, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:16:09', '2019-01-17 20:16:09', NULL, 1, 1),
(43, 70, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:17:23', '2019-01-17 20:17:23', NULL, 1, 1),
(44, 71, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:18:58', '2019-01-17 20:18:58', NULL, 1, 1),
(45, 72, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:21:40', '2019-01-17 20:21:40', NULL, 1, 1),
(46, 73, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:23:09', '2019-01-17 20:23:09', NULL, 1, 1),
(47, 74, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:23:20', '2019-01-17 20:23:20', NULL, 1, 1),
(48, 75, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 20:24:07', '2019-01-17 20:24:07', NULL, 1, 1),
(49, 76, '6.00', '18.00', '2019-01-15 00:00:00', '2019-01-17 21:02:50', '2019-01-17 21:02:50', NULL, 1, 1);


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



INSERT INTO `medicamentos` (`id`, `nome`, `prescricao`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(1, 'Remedio da coluna', 'Remédio da coluna', '2019-01-15 20:32:48', '2019-01-15 20:32:48', 1, NULL, 1),
(2, 'Ocitocina', 'Ocitosina 12 em 12 hrs', '2019-01-15 20:56:33', '2019-01-15 20:56:33', 1, NULL, 1),
(3, 'vetecor 5000', 'importado 500ml 1 frasco', '2019-01-15 21:16:21', '2019-01-15 21:16:04', 1, 1, 1);


INSERT INTO `permissoes` (`id`, `grupo_id`, `nome_modulo`, `create`, `read`, `update`, `delete`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(12, 16, 'animais', 1, 1, 1, 1, '2019-01-15 21:20:37', '2019-01-14 20:57:24', 1, 1, 1),
(13, 16, 'pesagens', 1, 1, 1, 1, '2019-01-14 20:57:36', '2019-01-14 20:57:36', 1, NULL, 1),
(14, 16, 'hemogramas', 1, 1, 1, 1, '2019-01-14 20:57:56', '2019-01-14 20:57:55', 1, NULL, 1),
(15, 16, 'usuarios', 1, 1, 1, 1, '2019-01-14 20:58:41', '2019-01-14 20:58:41', 1, NULL, 1);


INSERT INTO `usuarios` (`id`, `grupo_id`, `funcionario_id`, `login`, `senha`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(35, 16, 5, 'pablo.vieira02', '12345678', '2019-01-15 06:01:22', '2019-01-14 21:01:46', 1, 1, 1),
(36, 16, 9, 'brunno.henrique', '12345678', '2019-01-15 06:05:45', '2019-01-14 21:26:44', 1, NULL, 0),
(37, 16, 5, 'pablo.vieira', '123456789', '2019-01-15 06:02:54', '2019-01-14 21:28:06', 1, NULL, 0),
(38, 16, 9, 'brunno.henrique', '12345678', '2019-01-14 21:29:15', '2019-01-14 21:29:15', 1, NULL, 1),
(39, 16, 5, 'henrique.brunno', '12345678', '2019-01-15 06:05:43', '2019-01-14 21:30:18', 1, NULL, 0),
(40, 16, 5, 'henrique.brunno', '12345678', '2019-01-15 06:05:37', '2019-01-14 21:31:12', 1, NULL, 0),
(41, 18, 10, 'divina.rosa', '12345678', '2019-01-14 21:52:20', '2019-01-14 21:52:20', 1, NULL, 1);


INSERT INTO `pesagens` (`id`, `data_pesagem`, `peso`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`, `animais_id`) VALUES
(1, '2019-01-15', 32.00, '2019-01-15 20:23:48', '2019-01-15 20:23:48', 1, NULL, 1, 1),
(2, '2019-01-15', 34.00, '2019-01-15 20:26:12', '2019-01-15 20:26:11', 1, NULL, 1, 1),
(3, '2019-01-15', 36.00, '2019-01-15 20:27:19', '2019-01-15 20:27:18', 1, NULL, 1, 1),
(4, '2019-01-15', 29.00, '2019-01-15 20:27:34', '2019-01-15 20:27:34', 1, NULL, 1, 1),
(5, '2019-01-15', 32.00, '2019-01-16 21:53:47', '2019-01-16 21:53:47', 1, NULL, 1, 38),
(6, '2019-01-15', 32.00, '2019-01-16 21:54:47', '2019-01-16 21:54:47', 1, NULL, 1, 39),
(7, '2019-01-15', 32.00, '2019-01-16 21:54:47', '2019-01-16 21:54:47', 1, NULL, 1, 39),
(8, '2019-01-15', 32.00, '2019-01-16 21:57:22', '2019-01-16 21:57:22', 1, NULL, 1, 40),
(9, '2019-01-15', 32.00, '2019-01-16 21:57:22', '2019-01-16 21:57:22', 1, NULL, 1, 40),
(10, '2019-01-15', 32.00, '2019-01-16 22:06:32', '2019-01-16 22:06:32', 1, NULL, 1, 41),
(11, '2019-01-15', 32.00, '2019-01-16 22:06:33', '2019-01-16 22:06:33', 1, NULL, 1, 41),
(12, '2019-01-15', 32.00, '2019-01-16 22:11:22', '2019-01-16 22:11:22', 1, NULL, 1, 42),
(13, '2019-01-15', 32.00, '2019-01-16 22:13:09', '2019-01-16 22:13:09', 1, NULL, 1, 43),
(14, '2019-01-15', 32.00, '2019-01-16 22:13:09', '2019-01-16 22:13:09', 1, NULL, 1, 43),
(15, '2019-01-15', 32.00, '2019-01-16 22:14:56', '2019-01-16 22:14:56', 1, NULL, 1, 44),
(16, '2019-01-15', 32.00, '2019-01-16 22:14:56', '2019-01-16 22:14:56', 1, NULL, 1, 44),
(17, '2019-01-15', 32.00, '2019-01-16 23:06:55', '2019-01-16 23:06:55', 1, NULL, 1, 45),
(18, '2019-01-15', 32.00, '2019-01-16 23:06:55', '2019-01-16 23:06:55', 1, NULL, 1, 45),
(19, '2019-01-15', 32.00, '2019-01-16 23:23:08', '2019-01-16 23:23:08', 1, NULL, 1, 50),
(20, '2019-01-15', 32.00, '2019-01-16 23:23:08', '2019-01-16 23:23:08', 1, NULL, 1, 50),
(21, '2019-01-15', 32.00, '2019-01-17 19:31:50', '2019-01-17 19:31:50', 1, NULL, 1, 51),
(22, '2019-01-15', 32.00, '2019-01-17 19:31:50', '2019-01-17 19:31:50', 1, NULL, 1, 51),
(23, '2019-01-15', 32.00, '2019-01-17 19:33:43', '2019-01-17 19:33:43', 1, NULL, 1, 52),
(24, '2019-01-15', 32.00, '2019-01-17 19:33:43', '2019-01-17 19:33:43', 1, NULL, 1, 52),
(25, '2019-01-15', 32.00, '2019-01-17 19:35:14', '2019-01-17 19:35:14', 1, NULL, 1, 53),
(26, '2019-01-15', 32.00, '2019-01-17 19:35:14', '2019-01-17 19:35:14', 1, NULL, 1, 53),
(27, '2019-01-15', 32.00, '2019-01-17 19:35:24', '2019-01-17 19:35:24', 1, NULL, 1, 54),
(28, '2019-01-15', 32.00, '2019-01-17 19:35:24', '2019-01-17 19:35:24', 1, NULL, 1, 54),
(29, '2019-01-15', 32.00, '2019-01-17 19:37:08', '2019-01-17 19:37:08', 1, NULL, 1, 55),
(30, '2019-01-15', 32.00, '2019-01-17 19:37:50', '2019-01-17 19:37:50', 1, NULL, 1, 56),
(31, '2019-01-15', 32.00, '2019-01-17 19:38:38', '2019-01-17 19:38:38', 1, NULL, 1, 57),
(32, '2019-01-15', 32.00, '2019-01-17 19:39:54', '2019-01-17 19:39:54', 1, NULL, 1, 58),
(33, '2019-01-15', 32.00, '2019-01-17 19:46:31', '2019-01-17 19:46:31', 1, NULL, 1, 59),
(34, '2019-01-15', 32.00, '2019-01-17 19:48:04', '2019-01-17 19:48:04', 1, NULL, 1, 60),
(35, '2019-01-15', 32.00, '2019-01-17 19:50:48', '2019-01-17 19:50:48', 1, NULL, 1, 61),
(36, '2019-01-15', 32.00, '2019-01-17 19:57:48', '2019-01-17 19:57:48', 1, NULL, 1, 62),
(37, '2019-01-15', 32.00, '2019-01-17 19:59:10', '2019-01-17 19:59:10', 1, NULL, 1, 63),
(38, '2019-01-15', 32.00, '2019-01-17 20:00:32', '2019-01-17 20:00:32', 1, NULL, 1, 64),
(39, '2019-01-15', 32.00, '2019-01-17 20:02:03', '2019-01-17 20:02:03', 1, NULL, 1, 65),
(40, '2019-01-15', 32.00, '2019-01-17 20:04:22', '2019-01-17 20:04:22', 1, NULL, 1, 66),
(41, '2019-01-15', 32.00, '2019-01-17 20:10:28', '2019-01-17 20:10:28', 1, NULL, 1, 67),
(42, '2019-01-15', 32.00, '2019-01-17 20:13:01', '2019-01-17 20:13:01', 1, NULL, 1, 68),
(43, '2019-01-15', 32.00, '2019-01-17 20:16:09', '2019-01-17 20:16:09', 1, NULL, 1, 69),
(44, '2019-01-15', 32.00, '2019-01-17 20:17:23', '2019-01-17 20:17:23', 1, NULL, 1, 70),
(45, '2019-01-15', 32.00, '2019-01-17 20:18:58', '2019-01-17 20:18:58', 1, NULL, 1, 71),
(46, '2019-01-15', 32.00, '2019-01-17 20:21:40', '2019-01-17 20:21:40', 1, NULL, 1, 72),
(47, '2019-01-15', 32.00, '2019-01-17 20:23:09', '2019-01-17 20:23:09', 1, NULL, 1, 73),
(48, '2019-01-15', 32.00, '2019-01-17 20:23:20', '2019-01-17 20:23:20', 1, NULL, 1, 74),
(49, '2019-01-15', 32.00, '2019-01-17 20:24:07', '2019-01-17 20:24:07', 1, NULL, 1, 75),
(50, '2019-01-15', 32.00, '2019-01-17 21:02:50', '2019-01-17 21:02:50', 1, NULL, 1, 76);


INSERT INTO `pessoas` (`id`, `endereco_id`, `nome`, `rg`, `cpf`, `sexo`, `numero_telefone`, `data_nascimento`, `data_alteracao`, `data_cadastro`, `usuario_cadastro`, `usuario_alteracao`, `status`) VALUES
(2, 1, 'Brunno Henrique ', '123456', '12312312456', 'm', '64999999456', '1994-07-02', '2018-10-03 20:11:51', '2018-10-03 20:05:15', 1, 1, 0),
(22, 13, 'Brunno', '1111111', '11111111111', 'm', '11111111111', '1991-01-01', '2019-01-08 22:18:53', '2019-01-07 21:54:31', 1, NULL, 0),
(23, 5, 'brunno', '11111111', '11111111111', 'm', '11111111111', '1991-11-11', '2019-01-08 22:18:48', '2019-01-07 22:09:50', 1, NULL, 0),
(24, 5, 'brunno', '11111111', '11111111111', 'm', '11111111111', '1991-01-01', '2019-01-08 22:18:36', '2019-01-07 22:14:31', 1, NULL, 0),
(25, 5, 'CARLOS HENRIQUE ROMANO', '11111111', '11111111111', 'm', '11111111111', '1992-01-01', '2019-01-08 21:14:37', '2019-01-08 21:14:37', 1, NULL, 1),
(26, 19, 'Brunno', '11111111', '11111111111', 'm', '11111111111', '1991-01-01', '2019-01-08 22:19:49', '2019-01-08 21:26:05', 1, NULL, 0),
(27, 20, 'Brunno Henrique ', '11111111', '11111111111', 'm', '11111111111', '1991-01-01', '2019-01-08 22:20:13', '2019-01-08 21:34:47', 1, NULL, 0),
(28, 21, 'Pablo Vieira Inácio', '1231234', '12312312312', 'm', '64992427676', '1991-01-01', '2019-01-08 22:30:19', '2019-01-08 22:30:19', 1, NULL, 1),
(29, 22, 'Carlos Henrique', '1231234', '12312312312', 'm', '64992000000', '1999-01-01', '2019-01-08 22:52:22', '2019-01-08 22:52:22', 1, NULL, 1),
(30, 23, 'Brunno Henrique Campos', '5945190', '70069108110', 'm', '64992427676', '1994-07-01', '2019-01-11 22:28:37', '2019-01-11 20:07:49', 1, 1, 1),
(31, 24, 'Divina Rosa Campos', '1234567', '12312312312', 'f', '64555555555', '1992-01-01', '2019-01-14 21:51:45', '2019-01-14 21:51:45', 1, NULL, 1);

-- --------------------------------------------------------