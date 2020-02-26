-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: controleanimal
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
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
  CONSTRAINT `fk_animais_lotes1` FOREIGN KEY (`lotes_id`) REFERENCES `lotes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animais`
--

LOCK TABLES `animais` WRITE;
/*!40000 ALTER TABLE `animais` DISABLE KEYS */;
INSERT INTO `animais` VALUES (18,'MAE01','f','2019-01-01',0,'não informado','não informado',1,'2019-12-24 22:02:39','2019-12-24 21:21:13',1,NULL,2,1,'Adulto',1,NULL,0),(19,'PAI01','m','2019-01-01',0,'não informado','não informado',0,'2019-12-24 22:12:26','2019-12-24 22:03:21',1,NULL,2,1,'Adulto',1,NULL,0),(20,'PAI02','m','2019-05-01',0,'não informado','não informado',0,'2019-12-24 22:12:27','2019-12-24 22:08:27',1,NULL,2,1,'Adulto',1,NULL,0),(21,'PAI03','m','2019-12-24',0,'não informado','não informado',0,'2019-12-24 22:12:29','2019-12-24 22:10:08',1,NULL,2,1,'Adulto',1,NULL,0),(22,'PAI03','m','2019-12-24',0,'não informado','não informado',0,'2019-12-24 22:12:30','2019-12-24 22:10:10',1,NULL,2,1,'Adulto',1,NULL,0),(23,'pai01','m','2019-05-02',0,'não informado','não informado',0,'2019-12-24 22:16:43','2019-12-24 22:13:14',1,NULL,2,1,'Adulto',1,NULL,0),(24,'PAI01','m','2019-07-01',1,'não informado','não informado',1,'2019-12-24 22:18:22','2019-12-24 22:18:22',1,NULL,2,1,'Adulto',1,NULL,0),(25,'an01','m','2019-12-24',0,'não informado','não informado',1,'2019-12-24 23:17:47','2019-12-24 23:17:47',1,NULL,2,1,'RECEM_NASCIDO',1,NULL,0),(26,'vaca','m','2020-01-01',1,'1','1',1,'2020-01-28 23:05:16','2020-01-28 23:05:16',1,NULL,2,1,'Adulto',1,NULL,0);
/*!40000 ALTER TABLE `animais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animais_has_doencas`
--

DROP TABLE IF EXISTS `animais_has_doencas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  CONSTRAINT `fk_animais_has_doencas_animais` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`),
  CONSTRAINT `fk_animais_has_doencas_doencas1` FOREIGN KEY (`doencas_id`) REFERENCES `doencas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animais_has_doencas`
--

LOCK TABLES `animais_has_doencas` WRITE;
/*!40000 ALTER TABLE `animais_has_doencas` DISABLE KEYS */;
INSERT INTO `animais_has_doencas` VALUES (1,25,1,'DOENTE','2020-01-29',NULL,'2020-01-29','2020-01-29');
/*!40000 ALTER TABLE `animais_has_doencas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (6,'Gerente','Gerente','2018-09-25 21:55:03','2018-09-25 21:55:03',1,NULL,0),(7,'rar','rar','2020-01-29 22:54:56','2020-01-29 19:51:49',1,1,0),(8,'fasfasdsadfasdf','','2020-01-29 22:54:52','2020-01-29 22:50:18',1,1,0),(9,'asdfasdf','','2020-01-29 22:54:54','2020-01-29 22:54:22',1,NULL,0),(10,'Cargo','asdfasdf','2020-01-30 21:13:58','2020-01-29 22:55:04',1,1,1),(11,'cargo 1','car23','2020-01-30 21:19:13','2020-01-30 21:19:02',1,1,0),(12,'carg','','2020-01-30 21:19:42','2020-01-30 21:19:23',1,NULL,0),(13,'asdfasdf','','2020-01-30 21:19:40','2020-01-30 21:19:31',1,1,0);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doencas`
--

DROP TABLE IF EXISTS `doencas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doencas`
--

LOCK TABLES `doencas` WRITE;
/*!40000 ALTER TABLE `doencas` DISABLE KEYS */;
INSERT INTO `doencas` VALUES (1,'Doenca rara','rara','2020-01-29 20:05:52','2020-01-29 20:05:52',1,NULL,1);
/*!40000 ALTER TABLE `doencas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doses`
--

DROP TABLE IF EXISTS `doses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `tipo_movimentacao` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doses_animais_idx` (`animal_id`),
  KEY `doses_medicamentos_idx` (`medicamento_id`),
  KEY `doses_funcionarios_idx` (`funcionario_id`),
  CONSTRAINT `doses_animais` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `doses_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `doses_medicamentos` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doses`
--

LOCK TABLES `doses` WRITE;
/*!40000 ALTER TABLE `doses` DISABLE KEYS */;
INSERT INTO `doses` VALUES (10,11,NULL,1,2.00,'2020-01-29','2020-01-29 20:07:31','2020-01-29 20:07:31',NULL,1,1,NULL,'entrada'),(11,11,NULL,1,12.00,'2020-01-29','2020-01-29 20:09:34','2020-01-29 20:09:34',NULL,1,1,2.00,'entrada'),(12,11,24,1,12.00,'2020-01-29','2020-01-29 20:11:49','2020-01-29 20:11:49',NULL,1,1,NULL,'saida'),(13,11,18,1,12.00,'2020-01-29','2020-01-29 20:14:34','2020-01-29 20:14:34',NULL,1,1,NULL,'saida');
/*!40000 ALTER TABLE `doses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,'Rua Goias','Qd 17 Lt 17','Morro da Saudade 01','Morrinhos','go','Brasil','75650000','2019-01-08 22:16:54','2018-09-27 06:45:39',1,1,0),(2,'rua 3','csadfasdf','Centro','Morrais','GO','Bra','75098098','2020-01-30 21:56:36','2020-01-29 19:53:48',1,1,1);
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  CONSTRAINT `fk_familias_animais1` FOREIGN KEY (`pai_id`) REFERENCES `animais` (`id`),
  CONSTRAINT `fk_familias_animais2` FOREIGN KEY (`filho_id`) REFERENCES `animais` (`id`),
  CONSTRAINT `fk_familias_animais3` FOREIGN KEY (`mae_id`) REFERENCES `animais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
INSERT INTO `familias` VALUES (1,1,18,24,25,'2019-12-24 23:17:47','2019-12-24 23:17:47',NULL,NULL);
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fazendas`
--

DROP TABLE IF EXISTS `fazendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fazendas`
--

LOCK TABLES `fazendas` WRITE;
/*!40000 ALTER TABLE `fazendas` DISABLE KEYS */;
INSERT INTO `fazendas` VALUES (1,'Fazenda Chapadao','2018-02-13 00:00:00','2018-02-13 00:00:00',1,1,1,1),(3,'fazenda 2','2020-01-29 22:04:21','2020-01-28 23:07:07',1,1,0,1),(4,'cadastro fazenda','2020-01-29 22:30:05','2020-01-29 22:29:58',1,NULL,0,1);
/*!40000 ALTER TABLE `fazendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,10,1,1,2000.00,'2020-01-30 21:56:36','2018-12-11 20:51:58',1,1,1),(6,10,3,1,1555.00,'2020-01-30 21:54:37','2020-01-29 19:53:49',1,1,1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sem descrição',
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,'administrador','administrador','2019-01-14 20:51:31','2020-01-29 22:48:11',1,1,1),(20,'d','','2020-01-29 19:44:12','2020-01-29 19:45:12',1,1,0),(21,'1231231','asdfasdfasdfasdf','2020-01-29 22:42:55','2020-01-29 22:47:25',1,1,0),(22,'asdfasf','sadfasdfa','2020-01-29 22:47:20','2020-01-29 22:47:28',1,NULL,0),(23,'eaf','','2020-01-29 22:48:04','2020-01-29 22:48:04',1,NULL,1);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hemogramas`
--

DROP TABLE IF EXISTS `hemogramas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  CONSTRAINT `hemogramas_funcionarios` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hemogramas`
--

LOCK TABLES `hemogramas` WRITE;
/*!40000 ALTER TABLE `hemogramas` DISABLE KEYS */;
INSERT INTO `hemogramas` VALUES (9,18,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 21:21:14','2019-12-24 21:21:14',NULL,1,1,1),(10,19,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 22:03:22','2019-12-24 22:03:22',NULL,1,1,1),(11,20,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 22:08:27','2019-12-24 22:08:27',NULL,1,1,1),(12,21,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 22:10:10','2019-12-24 22:10:10',NULL,1,1,1),(13,22,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 22:10:11','2019-12-24 22:10:11',NULL,1,1,1),(14,23,2.00,2.00,'2019-12-03 00:00:00','2019-12-24 22:13:14','2019-12-24 22:13:14',NULL,1,1,1),(15,24,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 22:18:22','2019-12-24 22:18:22',NULL,1,1,1),(16,25,2.00,2.00,'2019-12-24 00:00:00','2019-12-24 23:17:47','2019-12-24 23:17:47',NULL,1,1,1),(17,26,2.00,2.00,'2020-01-08 00:00:00','2020-01-28 23:05:17','2020-01-28 23:05:16',NULL,1,1,1),(18,24,12.00,12.00,'2020-01-29 00:00:00','2020-01-29 20:11:00','2020-01-29 20:11:00',NULL,1,1,1);
/*!40000 ALTER TABLE `hemogramas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (2,1,1,'2019-12-24 21:20:17','2019-12-24 21:20:17',1,NULL,1);
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `prescricao` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
INSERT INTO `medicamentos` VALUES (10,'medicamento 1','medicamento','2020-01-29 20:07:03','2020-01-29 20:06:23',1,1,0),(11,'medicamento','medicamento','2020-01-29 22:58:13','2020-01-29 20:07:17',1,NULL,0),(12,'asdfasdf','asdfasdf','2020-01-29 23:01:56','2020-01-29 23:01:37',1,1,0),(13,'remedio','remedio 12/12','2020-01-29 23:02:22','2020-01-29 23:02:05',1,1,1);
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `nome_modulo` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (1,1,'animais',1,1,1,1,'2020-01-30 20:48:57','2019-01-14 20:57:24',1,1,1),(16,1,'nova permissao',1,1,1,0,'2020-01-29 19:49:50','2020-01-29 19:46:54',1,1,0),(17,1,'asdfasdf',1,1,1,1,'2020-01-30 20:50:40','2020-01-30 20:27:09',1,1,0),(18,23,'nova permissões',1,1,0,1,'2020-01-30 20:50:34','2020-01-30 20:50:12',1,1,0),(19,23,'permisao',1,1,1,1,'2020-01-30 20:51:45','2020-01-30 20:51:38',1,1,1);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesagens`
--

DROP TABLE IF EXISTS `pesagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  CONSTRAINT `fk_pesagens_animais1` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesagens`
--

LOCK TABLES `pesagens` WRITE;
/*!40000 ALTER TABLE `pesagens` DISABLE KEYS */;
INSERT INTO `pesagens` VALUES (10,'2019-12-24',2.00,'2019-12-24 21:21:13','2019-12-24 21:21:13',1,NULL,1,18),(11,'2019-12-24',2.00,'2019-12-24 22:03:22','2019-12-24 22:03:22',1,NULL,1,19),(12,'2019-12-24',1.00,'2019-12-24 22:08:27','2019-12-24 22:08:27',1,NULL,1,20),(13,'2019-12-24',2.00,'2019-12-24 22:10:09','2019-12-24 22:10:09',1,NULL,1,21),(14,'2019-12-24',2.00,'2019-12-24 22:10:11','2019-12-24 22:10:11',1,NULL,1,22),(15,'2019-12-02',2.00,'2019-12-24 22:13:14','2019-12-24 22:13:14',1,NULL,1,23),(16,'2019-12-24',2.00,'2019-12-24 22:18:22','2019-12-24 22:18:22',1,NULL,1,24),(17,'2019-12-24',2.00,'2019-12-24 23:17:47','2019-12-24 23:17:47',1,NULL,1,25),(18,'2020-01-08',2.00,'2020-01-28 23:05:16','2020-01-28 23:05:16',1,NULL,1,26),(19,'2020-01-28',12.00,'2020-01-29 20:02:28','2020-01-29 20:02:28',1,NULL,1,24),(20,'2020-01-29',5.00,'2020-01-29 20:03:03','2020-01-29 20:03:03',1,NULL,1,18),(21,'2020-01-23',2.00,'2020-01-29 20:03:22','2020-01-29 20:03:22',1,NULL,1,18);
/*!40000 ALTER TABLE `pesagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco_id` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numero_telefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pessoas_enderecos` (`endereco_id`),
  CONSTRAINT `pessoas_enderecos` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (1,2,'Brunno Henrique ','123456','12312312456','m','64999999456','1999-02-01','2020-01-30 21:56:36','2018-10-03 20:05:15',1,1,0),(3,2,'Pablo','1231231','12312312312','m','12312312312','2020-01-30','2020-01-30 21:54:38','2020-01-29 19:53:48',1,1,1);
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `login` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,1,'admin','MTIzNDU2Nzg=','2020-01-29 19:42:21','2019-01-14 21:01:46',1,1,1),(3,1,6,'pablo.vieira','VFZSSmVrNUVWVEpPZW1jOQ==','2020-01-30 22:06:49','2020-01-29 19:55:09',1,1,0),(4,1,6,'12312313','VFZSSmVrMVVTWHBOVkVsNk1USXo=','2020-01-30 21:58:20','2020-01-29 22:40:18',1,1,0),(5,1,1,'1232323','VFZSSmVrMVVTWHBOVkVsNg==','2020-01-30 22:06:45','2020-01-30 21:58:35',1,1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-30 22:19:10
