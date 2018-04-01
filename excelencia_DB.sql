CREATE DATABASE  IF NOT EXISTS `excelencia` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `excelencia`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: excelencia
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
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `curp` varchar(18) NOT NULL,
  `ingreso` varchar(9) NOT NULL,
  `carrera` varchar(60) NOT NULL,
  `plan` int(11) NOT NULL,
  `especialidad` varchar(60) NOT NULL,
  `semestre` int(11) NOT NULL,
  `creditos` float NOT NULL,
  `creditosinscritos` float DEFAULT NULL,
  `promedio` float NOT NULL,
  `turno` varchar(10) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `edad` int(11) NOT NULL,
  `fechanac` date NOT NULL,
  `telefono` varchar(16) DEFAULT NULL,
  `movil` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `valida1` varchar(1) DEFAULT NULL,
  `valida2` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`curp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES ('EDFG111111III22','2011_2','Ing. Mecanica',2002,'Mecanica',5,60,12,8.7,'V','M',22,'1999-09-09','55115511','+5215511449955','mmm@mmu.com',NULL,NULL,NULL),('IJKKL333333MMM33','2014_1','Ing. en Sistemas',2009,'Circuitos',9,90,10,8,'V','F',22,'1995-02-03',NULL,NULL,'ccc@gmail.com',NULL,NULL,NULL),('MNOP444444QQQ44','2014_1','Ing. en Sistemas',2009,'Algoritmia',9,90,10,8.2,'A','M',22,'1995-04-03',NULL,NULL,'hazelmsr@gmail.com',NULL,NULL,NULL),('NEWW999999NEW99','2009_2','ING',2002,'BD',9,91,9,5.9,'V','F',25,'1990-09-09','','','',NULL,NULL,NULL),('OOOO000000OOO00','0000_0','OOO',0,'OOOO',0,0,0,0,'A','O',0,'1900-01-01','',NULL,NULL,NULL,NULL,NULL),('QRST555555UUU55','2017_2','Ing. en Sistemas',2009,'BD',4,40,8,9,'M','M',19,'1998-08-09',NULL,NULL,'ddd@mail.com',NULL,NULL,NULL),('UVWX666666YYY66','2009_2','Ing. en Telematica',2009,'Fisica',1,12,8,6.7,'V','O',89,'1999-10-10','559990001','+5215511221122','hhh@hhh.com',NULL,NULL,NULL);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno/evento`
--

DROP TABLE IF EXISTS `alumno/evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno/evento` (
  `idaleve` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(100) NOT NULL,
  `alumno` varchar(19) NOT NULL,
  PRIMARY KEY (`idaleve`),
  KEY `ideae_idx` (`evento`),
  KEY `idaae_idx` (`alumno`),
  CONSTRAINT `idaae` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`curp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ideae` FOREIGN KEY (`evento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno/evento`
--

LOCK TABLES `alumno/evento` WRITE;
/*!40000 ALTER TABLE `alumno/evento` DISABLE KEYS */;
INSERT INTO `alumno/evento` VALUES (1,'Graduacion2016_1','IJKKL333333MMM33'),(2,'Graduacion2016_1','MNOP444444QQQ44'),(3,'Excelencia2017_2','IJKKL333333MMM33'),(4,'Excelencia2017_2','MNOP444444QQQ44'),(5,'Excelencia2017_2','EDFG111111III22'),(6,'Excelencia2017_2','QRST555555UUU55');
/*!40000 ALTER TABLE `alumno/evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `idEvento` varchar(100) NOT NULL,
  `Fecha` date NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Hora` varchar(8) NOT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES ('Excelencia2017_2','2017-08-14','Queso','10:00:00'),('Graduacion2016_1','2018-12-15','Revillagigedo','12:00:00');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES ('ADOO'),('Algoritmia'),('Analisis'),('Analogica'),('Aplicado'),('Arquitectura'),('Avanzadas'),('BD'),('Calculo'),('Circuitos'),('COE'),('Compiladores'),('Diferenciales'),('Discretas'),('Distribuidos'),('DSD'),('Economicos'),('Electiva'),('Estructuras'),('FDD'),('Financiera'),('Fisica'),('Gestion'),('IES'),('Ingenieria'),('Instrumentacion'),('Liderazgo'),('Lineal'),('Metodos'),('Microcontroladores'),('Operativos'),('OptativaA'),('OptativaB'),('OptativaC'),('OptativaD'),('POO'),('Probabilidad'),('Proyectos'),('Redes'),('Redes2'),('Redes3'),('Señales'),('Servicio'),('Teoria'),('TT1'),('TT2'),('Vectorial'),('Web');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias aprobadas`
--

DROP TABLE IF EXISTS `materias aprobadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias aprobadas` (
  `idmatap` int(11) NOT NULL AUTO_INCREMENT,
  `materia` varchar(45) NOT NULL,
  `alumno` varchar(45) NOT NULL,
  PRIMARY KEY (`idmatap`),
  KEY `idma_idx` (`materia`),
  KEY `idaa_idx` (`alumno`),
  CONSTRAINT `idaa` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`curp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idma` FOREIGN KEY (`materia`) REFERENCES `materia` (`nombre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias aprobadas`
--

LOCK TABLES `materias aprobadas` WRITE;
/*!40000 ALTER TABLE `materias aprobadas` DISABLE KEYS */;
INSERT INTO `materias aprobadas` VALUES (1,'Algoritmia','UVWX666666YYY66'),(2,'IES','UVWX666666YYY66'),(3,'Discretas','UVWX666666YYY66'),(4,'ADOO','IJKKL333333MMM33'),(5,'Algoritmia','IJKKL333333MMM33'),(6,'Analisis','IJKKL333333MMM33'),(7,'Analogica','IJKKL333333MMM33'),(8,'Aplicado','IJKKL333333MMM33'),(9,'Arquitectura','IJKKL333333MMM33'),(10,'Avanzadas','IJKKL333333MMM33'),(11,'BD','IJKKL333333MMM33'),(12,'Calculo','IJKKL333333MMM33'),(13,'Circuitos','IJKKL333333MMM33'),(14,'COE','IJKKL333333MMM33'),(15,'Compiladores','IJKKL333333MMM33'),(16,'Diferenciales','IJKKL333333MMM33'),(17,'Discretas','IJKKL333333MMM33'),(18,'Distribuidos','IJKKL333333MMM33'),(19,'DSD','IJKKL333333MMM33'),(20,'Economicos','IJKKL333333MMM33'),(21,'Electiva','IJKKL333333MMM33'),(22,'Estructuras','IJKKL333333MMM33'),(23,'FDD','IJKKL333333MMM33'),(24,'Financiera','IJKKL333333MMM33'),(25,'Fisica','IJKKL333333MMM33'),(26,'Gestion','IJKKL333333MMM33'),(27,'IES','IJKKL333333MMM33'),(28,'Ingenieria','IJKKL333333MMM33'),(29,'Instrumentacion','IJKKL333333MMM33'),(30,'Liderazgo','IJKKL333333MMM33'),(31,'Lineal','IJKKL333333MMM33'),(32,'Metodos','IJKKL333333MMM33'),(33,'Microcontroladores','IJKKL333333MMM33'),(34,'Operativos','IJKKL333333MMM33'),(35,'OptativaA','IJKKL333333MMM33'),(36,'OptativaB','IJKKL333333MMM33'),(37,'OptativaC','IJKKL333333MMM33'),(38,'OptativaD','IJKKL333333MMM33'),(39,'POO','IJKKL333333MMM33'),(40,'Probabilidad','IJKKL333333MMM33'),(41,'Proyectos','IJKKL333333MMM33'),(42,'Redes','IJKKL333333MMM33'),(43,'Redes2','IJKKL333333MMM33'),(44,'Redes3','IJKKL333333MMM33'),(45,'Señales','IJKKL333333MMM33'),(46,'Servicio','IJKKL333333MMM33'),(47,'Teoria','IJKKL333333MMM33'),(48,'TT1','IJKKL333333MMM33'),(49,'Web','IJKKL333333MMM33'),(50,'Vectorial','IJKKL333333MMM33'),(51,'ADOO','MNOP444444QQQ44'),(52,'Algoritmia','MNOP444444QQQ44'),(53,'Analisis','MNOP444444QQQ44'),(54,'Analogica','MNOP444444QQQ44'),(55,'Aplicado','MNOP444444QQQ44'),(56,'Arquitectura','MNOP444444QQQ44'),(57,'Avanzadas','MNOP444444QQQ44'),(58,'BD','MNOP444444QQQ44'),(59,'Calculo','MNOP444444QQQ44'),(60,'Circuitos','MNOP444444QQQ44'),(61,'COE','MNOP444444QQQ44'),(62,'Compiladores','MNOP444444QQQ44'),(63,'Diferenciales','MNOP444444QQQ44'),(64,'Discretas','MNOP444444QQQ44'),(65,'Distribuidos','MNOP444444QQQ44'),(66,'DSD','MNOP444444QQQ44'),(67,'Economicos','MNOP444444QQQ44'),(68,'Electiva','MNOP444444QQQ44'),(69,'Estructuras','MNOP444444QQQ44'),(70,'FDD','MNOP444444QQQ44'),(71,'Financiera','MNOP444444QQQ44'),(72,'Fisica','MNOP444444QQQ44'),(73,'Gestion','MNOP444444QQQ44'),(74,'IES','MNOP444444QQQ44'),(75,'Ingenieria','MNOP444444QQQ44'),(76,'Instrumentacion','MNOP444444QQQ44'),(77,'Liderazgo','MNOP444444QQQ44'),(78,'Lineal','MNOP444444QQQ44'),(79,'Metodos','MNOP444444QQQ44'),(80,'Microcontroladores','MNOP444444QQQ44'),(81,'Operativos','MNOP444444QQQ44'),(82,'OptativaA','MNOP444444QQQ44'),(83,'OptativaB','MNOP444444QQQ44'),(84,'OptativaC','MNOP444444QQQ44'),(85,'OptativaD','MNOP444444QQQ44'),(86,'POO','MNOP444444QQQ44'),(87,'Probabilidad','MNOP444444QQQ44'),(88,'Proyectos','MNOP444444QQQ44'),(89,'Redes','MNOP444444QQQ44'),(90,'Redes2','MNOP444444QQQ44'),(91,'Redes3','MNOP444444QQQ44'),(92,'Señales','MNOP444444QQQ44'),(93,'Servicio','MNOP444444QQQ44'),(94,'Teoria','MNOP444444QQQ44'),(95,'TT1','MNOP444444QQQ44'),(96,'Web','MNOP444444QQQ44'),(97,'Vectorial','MNOP444444QQQ44');
/*!40000 ALTER TABLE `materias aprobadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias inscritas`
--

DROP TABLE IF EXISTS `materias inscritas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias inscritas` (
  `idmatins` int(11) NOT NULL AUTO_INCREMENT,
  `materia` varchar(45) NOT NULL,
  `alumno` varchar(19) NOT NULL,
  PRIMARY KEY (`idmatins`),
  KEY `idmi_idx` (`materia`),
  KEY `idai_idx` (`alumno`),
  CONSTRAINT `idai` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`curp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idmi` FOREIGN KEY (`materia`) REFERENCES `materia` (`nombre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias inscritas`
--

LOCK TABLES `materias inscritas` WRITE;
/*!40000 ALTER TABLE `materias inscritas` DISABLE KEYS */;
INSERT INTO `materias inscritas` VALUES (1,'Vectorial','UVWX666666YYY66'),(2,'Calculo','UVWX666666YYY66'),(3,'Fisica','UVWX666666YYY66'),(4,'Estructuras','UVWX666666YYY66'),(5,'TT2','QRST555555UUU55'),(6,'TT2','MNOP444444QQQ44'),(7,'POO','MNOP444444QQQ44'),(8,'ADOO','MNOP444444QQQ44'),(9,'Teoria','MNOP444444QQQ44');
/*!40000 ALTER TABLE `materias inscritas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias reprobadas`
--

DROP TABLE IF EXISTS `materias reprobadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias reprobadas` (
  `idmatrep` int(11) NOT NULL AUTO_INCREMENT,
  `materia` varchar(45) NOT NULL,
  `alumno` varchar(18) NOT NULL,
  PRIMARY KEY (`idmatrep`),
  KEY `idm_idx` (`materia`),
  KEY `idar_idx` (`alumno`),
  CONSTRAINT `idar` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`curp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idmr` FOREIGN KEY (`materia`) REFERENCES `materia` (`nombre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias reprobadas`
--

LOCK TABLES `materias reprobadas` WRITE;
/*!40000 ALTER TABLE `materias reprobadas` DISABLE KEYS */;
INSERT INTO `materias reprobadas` VALUES (1,'Vectorial','UVWX666666YYY66'),(2,'Calculo','UVWX666666YYY66'),(3,'Fisica','UVWX666666YYY66');
/*!40000 ALTER TABLE `materias reprobadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('EDFG111111III22','0',0),('hola1','1',1),('IJKKL333333MMM33','0',0),('MNOP444444QQQ44','0',0),('QRST555555UUU55','0',0),('UVWX666666YYY66','0',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'excelencia'
--

--
-- Dumping routines for database 'excelencia'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-17  2:29:16
