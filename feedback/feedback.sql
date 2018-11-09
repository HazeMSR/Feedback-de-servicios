CREATE DATABASE  IF NOT EXISTS `feedback` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `feedback`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: feedback
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `idconfig` int(11) NOT NULL AUTO_INCREMENT,
  `mostrar` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idconfig`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,1);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fragmentos`
--

DROP TABLE IF EXISTS `fragmentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fragmentos` (
  `servidor` varchar(255) NOT NULL,
  `fragmentosH` int(11) NOT NULL DEFAULT '0',
  `fragmentosV` int(11) NOT NULL DEFAULT '0',
  `fragmentosM` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`servidor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fragmentos`
--

LOCK TABLES `fragmentos` WRITE;
/*!40000 ALTER TABLE `fragmentos` DISABLE KEYS */;
INSERT INTO `fragmentos` VALUES ('bejar',0,0,0),('hazel',0,0,0),('juel',0,0,0);
/*!40000 ALTER TABLE `fragmentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinion`
--

DROP TABLE IF EXISTS `opinion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinion` (
  `idopinion` int(11) NOT NULL AUTO_INCREMENT,
  `calificacion` int(11) NOT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  `idT` int(11) NOT NULL,
  `idU` varchar(50) NOT NULL,
  `idS` int(11) NOT NULL,
  PRIMARY KEY (`idopinion`),
  KEY `idU_idx` (`idU`),
  KEY `tema_idx` (`idT`),
  KEY `servicio_idx` (`idS`),
  CONSTRAINT `Oservicio` FOREIGN KEY (`idS`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Otema` FOREIGN KEY (`idT`) REFERENCES `tema` (`idtema`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Ousuario` FOREIGN KEY (`idU`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinion`
--

LOCK TABLES `opinion` WRITE;
/*!40000 ALTER TABLE `opinion` DISABLE KEYS */;
INSERT INTO `opinion` VALUES (2,3,'ok',1,'user',1),(3,3,'ok',4,'user',2),(4,3,'bueno',11,'user',2),(5,3,'Ok',12,'user',1),(6,4,'Bueno',13,'user',3),(7,1,'malo',1,'user2',1);
/*!40000 ALTER TABLE `opinion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` VALUES (1,'Cafeteria'),(2,'Barra de cafe'),(3,'Papelería'),(5,'nuevo servicio2');
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tema`
--

DROP TABLE IF EXISTS `tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tema` (
  `idtema` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `idS` int(11) NOT NULL,
  PRIMARY KEY (`idtema`),
  KEY `idS` (`idS`),
  CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema`
--

LOCK TABLES `tema` WRITE;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
INSERT INTO `tema` VALUES (1,'Precio de los productos',1),(2,'Actitud del personal',1),(3,'Calidad de las bebidas',2),(4,'Limpieza',2),(5,'Tiempo de Espera',3),(6,'Variedad de productos',3),(7,'Stock',2),(8,'Stock',3),(9,'Limpieza',1),(10,'Calidad de la comida',1),(11,'Calidad de la comida',2),(12,'Stock',1),(13,'Precio de los productos',3),(14,'Espacio de mesa',1),(15,'Precio de los productos',2),(16,'Nuevo Tema',1),(17,'Precio de plumones',3);
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` varchar(50) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('2016630200','hola',0),('admi','admi',1),('Euler','euler',1),('nuevo','nuevo',0),('user','user',0),('user2','user2',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-09 11:51:29
