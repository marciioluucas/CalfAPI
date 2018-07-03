-- CREATE DATABASE  IF NOT EXISTS `controleanimal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `controleanimal`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: controleanimal
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='-03:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


--
-- Table structure for table `animais`
--
-- CREATE DATABASE IF NOT EXISTS `controleanimal`;
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
  `fazendas_id` int(11) NOT NULL,
  `lotes_id` int(11) NOT NULL,
  `is_vivo` tinyint(4) NOT NULL DEFAULT '1',
  `fase_vida` varchar(20) DEFAULT 'BEZERRO',
  PRIMARY KEY (`id`),
  KEY `fk_animais_fazendas1_idx` (`fazendas_id`),
  KEY `fk_animais_lotes1_idx` (`lotes_id`),
  CONSTRAINT `fk_animais_fazendas1` FOREIGN KEY (`fazendas_id`) REFERENCES `fazendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_animais_lotes1` FOREIGN KEY (`lotes_id`) REFERENCES `lotes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animais`
--

LOCK TABLES `animais` WRITE;
/*!40000 ALTER TABLE `animais` DISABLE KEYS */;
INSERT INTO `animais` VALUES (1,'Mimosa','','2017-04-11',0,'Não informado','Não informado',1,'2018-02-14 00:00:00','2018-02-13 00:00:00',1,NULL,1,1,1,'BEZERRO'),(2,'Teste datetime','','2017-11-15',0,'AA1253','Não informado',1,'2018-02-19 11:14:33','2018-02-13 00:00:00',1,NULL,1,1,1,'BEZERRO'),(3,'Marcio Lucas','','1998-02-11',0,'003','512',1,'2018-02-13 00:00:00','2018-02-13 00:00:00',0,NULL,1,1,1,'BEZERRO'),(4,'Maconha','','1998-02-11',0,'004','512',0,'2018-02-14 00:00:00','2018-02-13 00:00:00',0,NULL,1,1,1,'BEZERRO'),(5,'Maconha','','1998-02-11',0,'004','512',0,'2018-02-14 00:00:00','2018-02-13 00:00:00',0,NULL,1,1,1,'BEZERRO'),(6,'Maconha','','1998-02-11',0,'004','512',1,'2018-02-16 00:00:00','2018-02-16 00:00:00',0,NULL,1,1,1,'BEZERRO'),(7,'Xurubiba','','1998-02-11',0,'004','512',1,'2018-02-16 00:00:00','2018-02-16 00:00:00',0,NULL,1,1,1,'BEZERRO'),(8,'Pururuca','','1998-02-11',0,'006','512',1,'2018-02-16 00:00:00','2018-02-16 00:00:00',0,NULL,1,1,1,'BEZERRO'),(9,'Pamonha','','1998-02-11',0,'007','512',1,'2018-02-16 00:00:00','2018-02-16 00:00:00',0,NULL,1,1,1,'BEZERRO'),(10,'Pamonha','','1998-02-11',0,'006','512',1,'2018-02-16 00:00:00','2018-02-16 00:00:00',0,NULL,1,1,1,'BEZERRO'),(11,'Pamonha','','1998-02-11',0,'006','512',1,'2018-02-16 00:00:00','2018-02-16 00:00:00',0,NULL,1,1,1,'BEZERRO'),(12,'Pamonha','','1998-02-11',0,'1515','512',1,'2018-02-19 00:00:00','2018-02-19 00:00:00',0,NULL,1,1,1,'BEZERRO'),(13,'Teste OO','','1998-02-11',0,'1515','512',1,'2018-02-22 15:48:34','2018-02-22 15:48:34',1,NULL,1,1,1,'BEZERRO'),(14,'Teste OO2','','1998-02-11',0,'1515','512',1,'2018-02-26 13:16:50','2018-02-26 13:16:50',1,NULL,1,1,1,'BEZERRO');
/*!40000 ALTER TABLE `animais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animais_has_doencas`
--

DROP TABLE IF EXISTS `animais_has_doencas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animais_has_doencas` (
  `animais_id` int(11) unsigned NOT NULL,
  `doencas_id` int(11) NOT NULL,
  `situacao` varchar(45) NOT NULL DEFAULT 'NAO INFORMADA',
  PRIMARY KEY (`animais_id`,`doencas_id`),
  KEY `fk_animais_has_doencas_doencas1_idx` (`doencas_id`),
  KEY `fk_animais_has_doencas_animais1_idx` (`animais_id`),
  CONSTRAINT `fk_animais_has_doencas_animais1` FOREIGN KEY (`animais_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_animais_has_doencas_doencas1` FOREIGN KEY (`doencas_id`) REFERENCES `doencas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animais_has_doencas`
--

LOCK TABLES `animais_has_doencas` WRITE;
/*!40000 ALTER TABLE `animais_has_doencas` DISABLE KEYS */;
INSERT INTO `animais_has_doencas` VALUES (1,1,'NAO INFORMADA');
/*!40000 ALTER TABLE `animais_has_doencas` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doencas`
--

LOCK TABLES `doencas` WRITE;
/*!40000 ALTER TABLE `doencas` DISABLE KEYS */;
INSERT INTO `doencas` VALUES (1,'pneumonia','Sem descrição','2018-02-26 07:00:00','2018-02-26 07:00:00',1,NULL,1),(3,'Diarreia','Bosta rala','2018-02-26 13:23:32','2018-02-26 13:23:32',1,NULL,1),(4,'gripe','SEM DESCRIÇÃO','2018-02-26 13:24:07','2018-02-26 13:24:07',1,NULL,1);
/*!40000 ALTER TABLE `doencas` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`),
  KEY `fk_familias_animais1_idx` (`pai_id`),
  KEY `fk_familias_animais2_idx` (`filho_id`),
  KEY `fk_familias_animais3_idx` (`mae_id`),
  CONSTRAINT `fk_familias_animais1` FOREIGN KEY (`pai_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_familias_animais2` FOREIGN KEY (`filho_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_familias_animais3` FOREIGN KEY (`mae_id`) REFERENCES `animais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
INSERT INTO `familias` VALUES (11,1,1,3,6),(12,1,7,8,1),(13,1,8,9,3),(14,1,13,14,9);
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fazendas`
--

LOCK TABLES `fazendas` WRITE;
/*!40000 ALTER TABLE `fazendas` DISABLE KEYS */;
INSERT INTO `fazendas` VALUES (1,'Fazenda Nossa Senhora aparecida','2018-02-13 00:00:00','2018-02-13 00:00:00',1,1,1,1);
/*!40000 ALTER TABLE `fazendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(150) NOT NULL DEFAULT 'Sem descrição',
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,'Administradores','Sem descrição','2018-02-13 00:00:00',NULL,0,NULL);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` int(11) NOT NULL,
  `usuario_alteracao` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (1,65652,'2018-02-27 09:05:11','2018-02-13 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_modulo` varchar(45) NOT NULL,
  `create` tinyint(4) NOT NULL DEFAULT '1',
  `read` tinyint(4) NOT NULL DEFAULT '1',
  `update` tinyint(4) NOT NULL DEFAULT '1',
  `delete` tinyint(4) NOT NULL DEFAULT '1',
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_permissoes_grupo1_idx` (`grupo_id`),
  CONSTRAINT `fk_permissoes_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (1,'animais',1,1,1,1,1),(2,'fazendas',1,1,1,1,1);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesagens`
--

LOCK TABLES `pesagens` WRITE;
/*!40000 ALTER TABLE `pesagens` DISABLE KEYS */;
INSERT INTO `pesagens` VALUES (1,'2018-03-04',50.00,NULL,'2018-03-09 15:59:11',1,NULL,1,1),(2,'2018-03-06',59.00,NULL,'2018-03-09 15:59:43',1,NULL,1,1),(3,'2018-03-07',61.20,NULL,'2018-03-09 16:00:17',1,NULL,1,1),(4,'2018-02-01',45.00,NULL,'2018-03-09 16:00:58',1,NULL,1,1),(5,'2018-01-15',55.00,NULL,'2018-03-18 16:11:27',1,NULL,1,6),(6,'2018-02-16',68.00,NULL,'2018-03-18 16:11:28',1,NULL,1,6),(7,'2018-03-18',79.00,NULL,'2018-03-18 16:11:29',1,NULL,1,6);
/*!40000 ALTER TABLE `pesagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_usuarios_grupo1_idx` (`grupo_id`),
  CONSTRAINT `fk_usuarios_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','admin','Marcio Lucas',1);
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

-- Dump completed on 2018-04-28  9:34:09
