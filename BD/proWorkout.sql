-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: proWorkout
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `Clientes`
--

DROP TABLE IF EXISTS `Clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Clientes` (
  `clieUsuaCpf` varchar(11) NOT NULL,
  `clieFone1` varchar(15) DEFAULT NULL,
  `clieFone2` varchar(15) DEFAULT NULL,
  `clieEndereco` varchar(100) NOT NULL,
  `clieComplementoEndereco` varchar(45) DEFAULT NULL,
  `clieCidade` varchar(45) NOT NULL,
  `clieUf` varchar(2) DEFAULT NULL,
  `clieMatriId` int NOT NULL,
  PRIMARY KEY (`clieUsuaCpf`),
  KEY `fk_Clientes_Usuarios1_idx` (`clieUsuaCpf`),
  KEY `fk_Clientes_Matricula1_idx` (`clieMatriId`),
  CONSTRAINT `fk_Clientes_Matricula1` FOREIGN KEY (`clieMatriId`) REFERENCES `Matriculas` (`matriId`),
  CONSTRAINT `fk_Clientes_Usuarios1` FOREIGN KEY (`clieUsuaCpf`) REFERENCES `Usuarios` (`usuaCpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Exercicios`
--

DROP TABLE IF EXISTS `Exercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Exercicios` (
  `exerId` int NOT NULL AUTO_INCREMENT,
  `exerNome` varchar(45) NOT NULL,
  `exerDescricao` varchar(400) NOT NULL,
  PRIMARY KEY (`exerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Ficha`
--

DROP TABLE IF EXISTS `Ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Ficha` (
  `clieUsuaCpf` varchar(11) NOT NULL,
  `exerId` int NOT NULL,
  PRIMARY KEY (`clieUsuaCpf`,`exerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Matriculas`
--

DROP TABLE IF EXISTS `Matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Matriculas` (
  `matriId` int NOT NULL AUTO_INCREMENT,
  `matriDataInicial` date NOT NULL,
  `matriDataUltimoPgto` date NOT NULL,
  `matriTppld` int NOT NULL,
  PRIMARY KEY (`matriId`),
  UNIQUE KEY `uq_reserva` (`matriId`,`matriDataInicial`),
  KEY `fk_Clientes_has_Quartos_Quartos1_idx` (`matriId`),
  KEY `fk_Matricula_TiposDePlanos1_idx` (`matriTppld`),
  CONSTRAINT `fk_Matricula_TiposDePlanos1` FOREIGN KEY (`matriTppld`) REFERENCES `Planos` (`tppld`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Planos`
--

DROP TABLE IF EXISTS `Planos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Planos` (
  `tppld` int NOT NULL AUTO_INCREMENT,
  `tpplNome` varchar(45) NOT NULL,
  `tpplDescricao` varchar(45) NOT NULL,
  `tpplValor` float NOT NULL,
  PRIMARY KEY (`tppld`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuarios` (
  `usuaCpf` varchar(11) NOT NULL,
  `usuaNome` varchar(45) NOT NULL,
  `usuaEmail` varchar(55) NOT NULL,
  `usuaSenha` varchar(45) NOT NULL,
  `usuaTipo` enum('0','1') NOT NULL COMMENT '0 - Usuario\n1 - Administrador',
  PRIMARY KEY (`usuaCpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-04 16:50:39
