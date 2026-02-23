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
-- Table structure for table `bebida`
--

DROP TABLE IF EXISTS `bebida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bebida` (
  `id_bebida` int NOT NULL AUTO_INCREMENT,
  `nom_bebida` varchar(45) NOT NULL,
  `desc_bebida` varchar(100) NOT NULL,
  `precio_bebida` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_bebida`),
  UNIQUE KEY `id_bebida_UNIQUE` (`id_bebida`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebida`
--

LOCK TABLES `bebida` WRITE;
/*!40000 ALTER TABLE `bebida` DISABLE KEYS */;
INSERT INTO `bebida` VALUES (1,'Gaseosa 500 ml','Coca Cola, Fanta o Sprite',2800.00),(2,'Gaseosa 1 litro','Coca Cola, Fanta o Sprite',4000.00),(3,'Gaseosa 1,5 litro','Coca Cola, Fanta o Sprite',4500.00),(4,'Agua saborizada 500 ml','Pomelo, pera, manzana',2500.00),(5,'Agua saborizada 1,5 litro','Pomelo, pera, manzana',3800.00),(6,'Agua 500 ml','Agua sin gas',2500.00),(7,'Agua 2 litros','Agua sin gas',3800.00),(8,'Agua 500 ml con gas','Agua con gas',2500.00),(9,'Agua 2 litros con gas','Agua con gas',3800.00),(10,'Cerveza 800 ml','Rubia Salta',4500.00);
/*!40000 ALTER TABLE `bebida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cajero`
--

DROP TABLE IF EXISTS `cajero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cajero` (
  `id_cajero` int NOT NULL AUTO_INCREMENT,
  `nom_cajero` varchar(45) NOT NULL,
  `ape_cajero` varchar(45) NOT NULL,
  `usu_cajero` varchar(45) NOT NULL,
  `pass_cajero` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cajero`),
  UNIQUE KEY `id_cajero_UNIQUE` (`id_cajero`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cajero`
--

LOCK TABLES `cajero` WRITE;
/*!40000 ALTER TABLE `cajero` DISABLE KEYS */;
INSERT INTO `cajero` VALUES (1,'Lourdes','Jaime','Lourdes','1234'),(2,'Vanesa','Alcala','Vanesa','1234'),(3,'Marisel','Martinez','mari','1234');
/*!40000 ALTER TABLE `cajero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_bebida`
--

DROP TABLE IF EXISTS `detalle_bebida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_bebida` (
  `id_detalle_bebida` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_bebida` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` int NOT NULL,
  `subtotal` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_bebida`),
  KEY `fk_detalle_bebida_pedido` (`id_pedido`),
  KEY `fk_detalle_bebida_bebida` (`id_bebida`),
  CONSTRAINT `fk_detalle_bebida_bebida` FOREIGN KEY (`id_bebida`) REFERENCES `bebida` (`id_bebida`),
  CONSTRAINT `fk_detalle_bebida_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_bebida`
--

LOCK TABLES `detalle_bebida` WRITE;
/*!40000 ALTER TABLE `detalle_bebida` DISABLE KEYS */;
INSERT INTO `detalle_bebida` VALUES (1,1,1,1,2800,2800,NULL),(2,2,2,1,4000,4000,NULL),(3,24,3,1,4500,4500,NULL),(4,24,1,1,2800,2800,NULL),(5,25,4,1,2500,2500,NULL),(6,26,10,1,4500,4500,NULL),(7,41,6,1,2500,2500,NULL),(8,42,5,1,3800,3800,NULL),(9,55,6,1,2500,2500,NULL),(10,57,1,1,2800,2800,NULL),(11,59,7,1,3800,3800,NULL),(12,63,3,1,4500,4500,'bien fria'),(13,70,1,1,2800,2800,''),(14,72,9,1,3800,3800,''),(15,74,10,1,4500,4500,''),(16,80,7,1,3800,3800,''),(17,80,10,2,4500,9000,''),(18,81,10,1,4500,4500,''),(19,82,2,1,4000,4000,'');
/*!40000 ALTER TABLE `detalle_bebida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_plato`
--

DROP TABLE IF EXISTS `detalle_plato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_plato` (
  `id_detalle_plato` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_plato` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` int NOT NULL,
  `subtotal` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_plato`),
  KEY `fk_detalle_plato_pedido` (`id_pedido`),
  KEY `fk_detalle_plato_plato` (`id_plato`),
  CONSTRAINT `fk_detalle_plato_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE,
  CONSTRAINT `fk_detalle_plato_plato` FOREIGN KEY (`id_plato`) REFERENCES `plato` (`id_plato`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_plato`
--

LOCK TABLES `detalle_plato` WRITE;
/*!40000 ALTER TABLE `detalle_plato` DISABLE KEYS */;
INSERT INTO `detalle_plato` VALUES (1,1,4,1,11000,11000,NULL),(2,2,6,1,9300,9300,NULL),(3,2,15,1,8000,8000,NULL),(4,17,2,2,2700,5400,NULL),(5,19,2,1,2700,2700,NULL),(6,20,2,1,2700,2700,NULL),(7,21,2,1,2700,2700,NULL),(8,22,2,1,2700,2700,NULL),(9,23,2,1,2700,2700,NULL),(10,24,6,1,9300,9300,NULL),(11,25,2,1,2700,2700,NULL),(12,25,6,1,9300,9300,NULL),(13,37,2,1,2700,2700,NULL),(14,38,2,1,2700,2700,NULL),(15,38,4,1,11000,11000,NULL),(16,39,2,1,2700,2700,NULL),(17,39,4,1,11000,11000,NULL),(18,40,2,1,2700,2700,NULL),(19,40,4,1,11000,11000,NULL),(20,41,14,1,6000,6000,NULL),(21,42,5,1,10000,10000,NULL),(22,42,14,1,6000,6000,NULL),(23,43,4,1,11000,11000,NULL),(24,43,7,1,8500,8500,NULL),(25,43,10,1,9000,9000,NULL),(26,44,4,1,11000,11000,NULL),(27,45,2,1,2700,2700,NULL),(28,46,2,1,2700,2700,NULL),(29,47,2,1,2700,2700,NULL),(30,48,2,1,2700,2700,NULL),(31,49,4,1,11000,11000,NULL),(32,49,7,1,8500,8500,NULL),(33,49,10,1,9000,9000,NULL),(34,50,2,3,2700,8100,NULL),(35,51,2,2,2700,5400,NULL),(36,52,2,1,2700,2700,NULL),(37,53,2,1,2700,2700,NULL),(38,54,2,1,2700,2700,NULL),(39,55,1,5,750,3750,NULL),(40,55,11,1,8000,8000,NULL),(41,56,2,1,2700,2700,NULL),(42,57,4,1,11000,11000,NULL),(43,58,4,1,11000,11000,NULL),(44,59,7,1,8500,8500,NULL),(45,60,4,1,11000,11000,NULL),(46,61,2,2,2700,5400,NULL),(47,62,2,1,2700,2700,NULL),(48,63,17,1,10000,10000,'poca cebolla'),(49,64,2,1,2700,2700,''),(50,64,4,1,11000,11000,''),(51,65,4,2,11000,22000,''),(52,66,2,1,2700,2700,''),(53,67,10,2,9000,18000,''),(54,68,4,1,11000,11000,''),(55,69,4,1,11000,11000,'cocido'),(56,70,4,1,11000,11000,''),(57,71,18,1,14000,14000,'bien caliente'),(58,72,2,1,2700,2700,''),(59,73,15,1,8000,8000,''),(60,74,6,1,9300,9300,''),(61,75,2,1,2700,2700,''),(62,76,4,3,11000,33000,''),(63,76,7,3,8500,25500,''),(64,77,2,1,2700,2700,''),(65,77,1,1,750,750,''),(66,77,10,2,9000,18000,''),(67,78,14,3,6000,18000,''),(68,79,10,4,9000,36000,''),(69,80,2,1,2700,2700,''),(70,80,14,1,6000,6000,''),(71,80,3,1,2300,2300,'que sea de cabra'),(72,80,8,1,11000,11000,'bien cocido'),(73,81,2,1,2700,2700,''),(74,82,4,1,11000,11000,'');
/*!40000 ALTER TABLE `detalle_plato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_postre`
--

DROP TABLE IF EXISTS `detalle_postre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_postre` (
  `id_detalle_postre` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_postre` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` int NOT NULL,
  `subtotal` int NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_postre`),
  KEY `fk_detalle_postre_pedido` (`id_pedido`),
  KEY `fk_detalle_postre_postre` (`id_postre`),
  CONSTRAINT `fk_detalle_postre_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE,
  CONSTRAINT `fk_detalle_postre_postre` FOREIGN KEY (`id_postre`) REFERENCES `postre` (`id_postre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_postre`
--

LOCK TABLES `detalle_postre` WRITE;
/*!40000 ALTER TABLE `detalle_postre` DISABLE KEYS */;
INSERT INTO `detalle_postre` VALUES (1,2,1,1,3500,3500,NULL),(2,58,1,1,3500,3500,NULL),(3,59,3,1,4000,4000,NULL),(4,80,3,1,4000,4000,''),(5,81,3,1,4000,4000,'');
/*!40000 ALTER TABLE `detalle_postre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesa`
--

DROP TABLE IF EXISTS `mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesa` (
  `id_mesa` int NOT NULL AUTO_INCREMENT,
  `dispo_mesa` varchar(45) NOT NULL DEFAULT 'Disponible',
  PRIMARY KEY (`id_mesa`),
  UNIQUE KEY `id_mesa_UNIQUE` (`id_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesa`
--

LOCK TABLES `mesa` WRITE;
/*!40000 ALTER TABLE `mesa` DISABLE KEYS */;
INSERT INTO `mesa` VALUES (1,'Disponible'),(2,'Ocupada'),(3,'Ocupada'),(4,'Disponible'),(5,'Disponible'),(6,'Disponible'),(7,'Disponible'),(8,'Disponible'),(9,'Disponible'),(10,'Disponible'),(11,'Disponible'),(12,'Disponible'),(13,'Disponible'),(14,'Disponible'),(15,'Disponible'),(16,'Disponible');
/*!40000 ALTER TABLE `mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mozo`
--

DROP TABLE IF EXISTS `mozo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mozo` (
  `id_mozo` int NOT NULL AUTO_INCREMENT,
  `nom_mozo` varchar(45) NOT NULL,
  `ape_mozo` varchar(45) NOT NULL,
  `usu_mozo` varchar(45) NOT NULL,
  `pass_mozo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_mozo`),
  UNIQUE KEY `id_mozo_UNIQUE` (`id_mozo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mozo`
--

LOCK TABLES `mozo` WRITE;
/*!40000 ALTER TABLE `mozo` DISABLE KEYS */;
INSERT INTO `mozo` VALUES (1,'Luis','Aramayo','Lucho','Lucho'),(2,'Zulema','Cruz','Zule','Zule'),(3,'Edgar','Fabian','edgar','1234');
/*!40000 ALTER TABLE `mozo` ENABLE KEYS */;
UNLOCK TABLES;

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
  `id_mozo` int DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,'Sin Lechuga','Completado',1,10,1,12800,'2025-06-12 14:30:00'),(2,'Bien Cocido','Completado',2,5,2,15300,'2025-06-12 13:15:00'),(17,'','Completado',2,9,2,5400,'2025-11-20 19:55:31'),(19,'','Completado',2,9,2,2700,'2025-11-20 20:02:42'),(20,'','Completado',2,11,2,2700,'2025-11-20 20:03:27'),(21,'','Completado',2,9,2,2700,'2025-11-20 20:08:42'),(22,'','Completado',2,1,2,2700,'2025-11-20 20:09:20'),(23,'','Completado',2,9,2,2700,'2025-11-20 20:29:07'),(24,'','Completado',2,2,2,16600,'2025-11-20 20:39:57'),(25,'','Completado',2,3,2,14500,'2025-12-24 13:04:44'),(26,'','Completado',2,4,1,4500,'2025-12-24 13:07:32'),(37,'','Completado',2,1,2,2700,'2026-02-22 23:16:50'),(38,'','Completado',2,1,2,13700,'2026-02-22 23:18:15'),(39,'','Completado',2,9,2,13700,'2026-02-22 23:27:07'),(40,'','Completado',2,1,2,13700,'2026-02-22 23:28:40'),(41,'','Completado',2,9,2,8500,'2026-02-22 23:51:33'),(42,'','Listo',2,9,2,19800,'2026-02-22 23:53:04'),(43,'','Completado',2,9,2,28500,'2026-02-23 00:22:51'),(44,'','Completado',2,10,2,11000,'2026-02-23 00:23:12'),(45,'','Completado',2,9,2,2700,'2026-02-23 00:27:01'),(46,'','Completado',2,9,2,2700,'2026-02-23 01:36:06'),(47,'','Completado',NULL,11,2,2700,'2026-02-23 01:38:20'),(48,'','Completado',NULL,12,2,2700,'2026-02-23 01:39:25'),(49,'','Completado',NULL,2,1,28500,'2026-02-23 01:51:49'),(50,'','Completado',1,9,2,8100,'2026-02-23 01:53:59'),(51,'','Completado',NULL,9,2,5400,'2026-02-23 01:58:44'),(52,'','Completado',NULL,13,2,2700,'2026-02-23 02:01:00'),(53,'','Completado',NULL,14,2,2700,'2026-02-23 02:05:11'),(54,'','Completado',1,15,1,2700,'2026-02-23 02:05:56'),(55,'','Completado',2,1,2,14250,'2026-02-23 16:26:00'),(56,'','Completado',2,2,2,2700,'2026-02-23 16:33:52'),(57,'','Completado',2,1,2,13800,'2026-02-23 16:38:18'),(58,'','Completado',NULL,3,2,14500,'2026-02-23 17:10:18'),(59,'','Listo',NULL,3,2,16300,'2026-02-23 17:11:43'),(60,'','Listo',NULL,3,2,11000,'2026-02-23 17:13:25'),(61,'','Completado',NULL,3,2,5400,'2026-02-23 17:14:03'),(62,'','Completado',2,4,2,2700,'2026-02-23 17:33:39'),(63,'','Completado',2,1,2,14500,'2026-02-23 17:44:09'),(64,'','Completado',2,2,2,13700,'2026-02-23 17:53:42'),(65,'','Completado',2,3,1,22000,'2026-02-23 17:54:02'),(66,'','Completado',2,4,2,2700,'2026-02-23 18:02:42'),(67,'','Completado',2,9,2,18000,'2026-02-23 18:02:58'),(68,'','Completado',2,10,2,11000,'2026-02-23 18:06:17'),(69,'','Completado',2,1,1,11000,'2026-02-23 18:19:30'),(70,'','Completado',NULL,2,2,13800,'2026-02-23 18:25:27'),(71,'','Completado',2,1,3,14000,'2026-02-23 18:49:41'),(72,'','Listo',NULL,3,2,6500,'2026-02-23 18:51:07'),(73,'','Completado',NULL,3,2,8000,'2026-02-23 18:53:56'),(74,'','Completado',NULL,4,2,13800,'2026-02-23 18:57:16'),(75,'','Completado',2,9,2,2700,'2026-02-23 19:04:24'),(76,'','Listo',2,10,2,58500,'2026-02-23 19:05:19'),(77,'','Listo',2,10,3,21450,'2026-02-23 19:06:36'),(78,'','Listo',2,10,2,18000,'2026-02-23 19:06:54'),(79,'','Completado',2,10,2,36000,'2026-02-23 19:07:09'),(80,'','Completado',2,11,2,38800,'2026-02-23 19:17:04'),(81,'','En Proceso',NULL,2,2,11200,'2026-02-23 19:22:22'),(82,'','En Proceso',NULL,3,2,15000,'2026-02-23 19:23:35');
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plato`
--

DROP TABLE IF EXISTS `plato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plato` (
  `id_plato` int NOT NULL AUTO_INCREMENT,
  `nom_plato` varchar(45) NOT NULL,
  `descr_plato` varchar(100) NOT NULL,
  `precio_plato` int NOT NULL,
  PRIMARY KEY (`id_plato`),
  UNIQUE KEY `id_plato_UNIQUE` (`id_plato`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plato`
--

LOCK TABLES `plato` WRITE;
/*!40000 ALTER TABLE `plato` DISABLE KEYS */;
INSERT INTO `plato` VALUES (1,'Empanadas','Carne o Queso',750),(2,'Berenjena','Gratinada con queso de cabra',2700),(3,'Queso de cabra a la plancha','Con oliva y especias',2300),(4,'Bife de lomo','A caballo',11000),(5,'Matambre','Napolitana a caballo',10000),(6,'Milanesa','A caballo, Napolitana, Fugazzeta',9300),(7,'Bife de Pollo','Al limón con huevo frito',8500),(8,'Salteado de Cordero','Con verduras y arroz',11000),(9,'Milanesa al cardón','Incluye verduras salteadas, queso de cabra, quinoa y huevo frito',9800),(10,'Cazuela de cabrito','Cabrito más verduras varias',9000),(11,'Locro','Comida regional',8000),(12,'Omelette verdura y queso','Vegetariano',8300),(13,'Salteado de tallarines','Con verduras y salsa de soja',8000),(14,'Sandwich','Milanesa, Lomo o Hamburguesa',7500),(15,'Pizza Común','Muzzarella, salsa y aceitunas',8000),(16,'Pizza Especial','Muzzarella, jamón, salsa y aceitunas',9300),(17,'Pizza Fugazzeta','Muzzarella, cebolla gratinada y salsa',10000),(18,'Frangollo','charqui de cabra',14000);
/*!40000 ALTER TABLE `plato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postre`
--

DROP TABLE IF EXISTS `postre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postre` (
  `id_postre` int NOT NULL AUTO_INCREMENT,
  `nom_postre` varchar(45) NOT NULL,
  `desc_postre` varchar(100) NOT NULL,
  `precio_postre` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_postre`),
  UNIQUE KEY `id_postre_UNIQUE` (`id_postre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postre`
--

LOCK TABLES `postre` WRITE;
/*!40000 ALTER TABLE `postre` DISABLE KEYS */;
INSERT INTO `postre` VALUES (1,'Cayote con nueces','Nueces regionales',3500.00),(2,'Queso con Batata','Queso Tybo',3800.00),(3,'Anchi con pelones','Pelones Regioneales',4000.00);
/*!40000 ALTER TABLE `postre` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-23 20:21:28
