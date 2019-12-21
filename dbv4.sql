-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: controleanimal
-- ------------------------------------------------------
-- Server version	5.7.27-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `animais`
--

DROP TABLE IF EXISTS `animais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animais` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `fazendas_id` int(11) NOT NULL,
  `data_morte` datetime DEFAULT NULL,
  `nascido_morto` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_animais_lotes1_idx` (`lotes_id`),
  KEY `animais_fazendas_idx` (`fazendas_id`),
  CONSTRAINT `animais_fazendas` FOREIGN KEY (`fazendas_id`) REFERENCES `fazendas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_animais_lotes1` FOREIGN KEY (`lotes_id`) REFERENCES `lotes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `animais_has_doencas`
--

DROP TABLE IF EXISTS `animais_has_doencas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animais_has_doencas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `animais_id` int(11) unsigned NOT NULL,
  `doencas_id` int(11) NOT NULL,
  `situacao` varchar(45) NOT NULL DEFAULT 'NAO INFORMADA',
  `data_adoecimento` date NOT NULL,
  `data_cura` date DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `data_alteracao` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_animais_has_doencas_doencas1_idx` (`doencas_id`),
  KEY `fk_animais_has_doencas_animais1_idx` (`animais_id`),
  CONSTRAINT `fk_animais_has_doencas_animais` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_animais_has_doencas_doencas1` FOREIGN KEY (`doencas_id`) REFERENCES `doencas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `doencas`
--

DROP TABLE IF EXISTS `doencas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doencas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `descricao` text,
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `doses`
--

DROP TABLE IF EXISTS `doses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicamento_id` int(11) NOT NULL,
  `animal_id` int(10) unsigned DEFAULT NULL,
  `funcionario_id` int(11) NOT NULL,
  `quantidade_mg` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `quantidade_unidade` decimal(10,2) DEFAULT NULL,
  `tipo_movimentacao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doses_animais_idx` (`animal_id`),
  KEY `doses_medicamentos_idx` (`medicamento_id`),
  KEY `doses_funcionarios_idx` (`funcionario_id`),
  CONSTRAINT `doses_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `doses_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `doses_medicamentos` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `mae_id` int(11) unsigned NOT NULL,
  `pai_id` int(11) unsigned NOT NULL,
  `filho_id` int(11) unsigned NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) DEFAULT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_familias_animais1_idx` (`pai_id`),
  KEY `fk_familias_animais2_idx` (`filho_id`),
  KEY `fk_familias_animais3_idx` (`mae_id`),
  CONSTRAINT `fk_familias_animais1` FOREIGN KEY (`pai_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_familias_animais2` FOREIGN KEY (`filho_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_familias_animais3` FOREIGN KEY (`mae_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fazendas`
--

DROP TABLE IF EXISTS `fazendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fazendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `limite` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `fazenda_id` int(11) NOT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario_fazenda` (`fazenda_id`),
  KEY `funcionarios_cargos` (`cargo_id`),
  KEY `funcionarios_pessoas` (`pessoa_id`),
  CONSTRAINT `funcionario_fazenda` FOREIGN KEY (`fazenda_id`) REFERENCES `fazendas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `funcionarios_cargos` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `funcionarios_pessoas` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sem descrição',
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hemogramas`
--

DROP TABLE IF EXISTS `hemogramas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hemogramas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `animal_id` int(10) unsigned NOT NULL,
  `ppt` decimal(10,2) NOT NULL,
  `hematocrito` decimal(10,2) NOT NULL,
  `data` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `funcionario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hemogramas_animais_idx` (`animal_id`),
  KEY `hemogramas_funcionarios_idx` (`funcionario_id`),
  CONSTRAINT `hemogramas_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `hemogramas_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fazenda_id` int(11) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `lotes_fazendas_idx` (`fazenda_id`),
  CONSTRAINT `lotes_fazendas` FOREIGN KEY (`fazenda_id`) REFERENCES `fazendas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prescricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permissoes_grupos_idx` (`grupo_id`),
  CONSTRAINT `permissoes_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pesagens`
--

DROP TABLE IF EXISTS `pesagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_pesagem` date NOT NULL,
  `peso` float(4,2) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL COMMENT ' ',
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(45) DEFAULT '1',
  `animais_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pesagens_animais1_idx` (`animais_id`),
  CONSTRAINT `fk_pesagens_animais1` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pessoas_enderecos` (`endereco_id`),
  CONSTRAINT `pessoas_enderecos` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_grupos_idx` (`grupo_id`),
  KEY `usuarios_funcionarios` (`funcionario_id`),
  CONSTRAINT `usuarios_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `usuarios_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-21 11:39:15
