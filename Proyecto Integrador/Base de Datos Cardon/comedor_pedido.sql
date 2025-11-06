CREATE DATABASE  IF NOT EXISTS `comedor` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `comedor`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: comedor
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `descr_pedido` varchar(100) NOT NULL,
  `estado_pedido` varchar(45) NOT NULL DEFAULT 'En Proceso',
  `id_mozo` int NOT NULL,
  `id_mesa` int NOT NULL,
  `id_cajero` int NOT NULL,
  `total_pedido` int NOT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  UNIQUE KEY `id_pedido_UNIQUE` (`id_pedido`),
  KEY `fk_pedido_mozo` (`id_mozo`),
  KEY `fk_pedido_mesa` (`id_mesa`),
  KEY `fk_pedido_cajero` (`id_cajero`),
  CONSTRAINT `fk_pedido_cajero` FOREIGN KEY (`id_cajero`) REFERENCES `cajero` (`id_cajero`),
  CONSTRAINT `fk_pedido_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`),
  CONSTRAINT `fk_pedido_mozo` FOREIGN KEY (`id_mozo`) REFERENCES `mozo` (`id_mozo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-05 20:48:39
