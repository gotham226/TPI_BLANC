-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: db_caps
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.34-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `caps`
--

DROP TABLE IF EXISTS `caps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caps` (
  `id_cap` int(11) NOT NULL AUTO_INCREMENT,
  `id_model` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(5) NOT NULL DEFAULT 20,
  `brand` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cap`),
  KEY `id_model` (`id_model`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caps`
--

LOCK TABLES `caps` WRITE;
/*!40000 ALTER TABLE `caps` DISABLE KEYS */;
INSERT INTO `caps` VALUES (1,NULL,60.00,'The new \"Elementary\" cap from Gucci.',20,NULL,NULL),(2,NULL,75.00,'The new \"Flight session\" cap from Versace.',0,NULL,NULL),(3,NULL,55.50,'The famous \"America\" edition of Versace !',4,NULL,NULL),(5,NULL,43.99,'The new Falling Flowers cap!',1,NULL,NULL),(6,NULL,75.00,'Don\'t fall with this new cap.',20,NULL,NULL),(7,NULL,40.00,'Burning on the road with this famous cap.',71,NULL,NULL),(8,NULL,2.00,'Used by the famous formula 1 driver, thomas smith.',3,NULL,NULL),(9,NULL,35.00,'Nope.',18,NULL,NULL),(10,NULL,80.00,'The famous boyband \"BTS\" released their brand new product in reference to their music \"Butterfly\".',15,NULL,NULL),(11,NULL,50.00,'Underground and Techwear.',4,NULL,NULL),(12,NULL,45.50,'M I N I M A L I S T E',11,NULL,NULL);
/*!40000 ALTER TABLE `caps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite` (
  `id_favorite` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_cap` int(11) NOT NULL,
  PRIMARY KEY (`id_favorite`),
  KEY `id_user` (`id_user`),
  KEY `id_cap` (`id_cap`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`id_cap`) REFERENCES `caps` (`id_cap`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES (8,1,9),(10,1,2),(12,1,11),(13,1,12),(14,1,10),(16,1,7);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_caps`
--

DROP TABLE IF EXISTS `order_caps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_caps` (
  `id_order_caps` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_cap` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_order_caps`),
  KEY `id_cap` (`id_cap`),
  KEY `id_order` (`id_order`),
  CONSTRAINT `order_caps_ibfk_2` FOREIGN KEY (`id_cap`) REFERENCES `caps` (`id_cap`),
  CONSTRAINT `order_caps_ibfk_3` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_caps`
--

LOCK TABLES `order_caps` WRITE;
/*!40000 ALTER TABLE `order_caps` DISABLE KEYS */;
INSERT INTO `order_caps` VALUES (2,1,7,3,40.00),(3,1,9,2,35.00),(5,1,11,1,50.00),(6,2,5,1,43.99),(7,2,12,1,45.50),(9,4,11,3,50.00),(10,5,11,1,50.00),(11,6,10,2,80.00),(12,6,11,5,50.00),(13,7,11,3,50.00),(14,8,11,1,50.00),(15,9,7,1,40.00),(16,9,8,1,2.00),(17,9,9,1,35.00),(18,9,10,1,80.00),(19,9,11,1,50.00),(20,9,12,1,45.50),(29,12,11,1,50.00),(31,14,12,1,45.50),(32,15,9,1,35.00),(33,15,11,1,50.00),(34,16,8,1,2.00),(35,16,12,1,45.50);
/*!40000 ALTER TABLE `order_caps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `is_confirmed` tinyint(4) DEFAULT 0,
  `order_date` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,0,'2021-05-10',1),(2,1,'2021-05-11',1),(4,0,'2021-05-11',2),(5,0,'2021-05-12',2),(6,1,'2021-05-12',1),(7,1,'2021-05-12',2),(8,0,'2021-05-12',2),(9,1,'2021-05-12',1),(12,0,'2021-05-12',2),(14,0,'2021-05-19',3),(15,0,'2021-05-19',3),(16,0,'2021-05-19',2);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `actif` int(1) NOT NULL DEFAULT 1,
  `admin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `idx_email` (`email`),
  KEY `idx_password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Seebii','Pannatier.Sebastien@gmail.com','cf5b13dc39ead4eb3fa85f73ea9551bd2f38f75f33063817f69da38823fd06c7',1,0),(2,'admin','Sebastien.pnntr@eduge.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1,1),(3,'test','test@test.test','9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',1,0),(4,'rrr','rrr@rrr.rrr','12b0f0dcaefb10c02a83aa9adb025978ddb5512dc04eb39df6811c6a6bf9770c',0,0),(5,'Administrateur','administrateur@capshop.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1,1),(6,'Utilisateur','user@capshop.ch','8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_caps'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-31 16:22:42
