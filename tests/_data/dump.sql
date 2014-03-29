-- MySQL dump 10.13  Distrib 5.5.14, for Win64 (x86)
--
-- Host: localhost    Database: teresadesign
-- ------------------------------------------------------
-- Server version 5.5.14

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
-- Current Database: `teresadesign`
--

CREATE DATABASE  IF NOT EXISTS `teresadesign_test`  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

USE `teresadesign_test`;

--
-- Table structure for table `tbl_migration`
--


--
-- Dumping data for table `tbl_migration`
--


--
-- Table structure for table `teresa_admin`
--

DROP TABLE IF EXISTS `teresa_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teresa_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `surname` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `avatar` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `loginName` varchar(20) COLLATE utf8_bin NOT NULL,
  `pswd` varchar(128) COLLATE utf8_bin NOT NULL,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginName` (`loginName`),
  KEY `adminAddedBy` (`addedBy`),
  KEY `adminUpdatedBy` (`updatedBy`),
  CONSTRAINT `adminAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `adminUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teresa_admin`
--

/*!40000 ALTER TABLE `teresa_admin` DISABLE KEYS */;
INSERT INTO `teresa_admin` VALUES (1,'Mario',NULL,NULL,'admin','admin',NULL,'2014-03-25 18:37:08',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `teresa_admin` ENABLE KEYS */;

--
-- Table structure for table `teresa_category`
--

DROP TABLE IF EXISTS `teresa_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teresa_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `parent` smallint(5) unsigned DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryAddedBy` (`addedBy`),
  KEY `categoryUpdatedBy` (`updatedBy`),
  CONSTRAINT `categoryUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `categoryAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teresa_category`
--

/*!40000 ALTER TABLE `teresa_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `teresa_category` ENABLE KEYS */;

--
-- Table structure for table `teresa_category_product`
--

DROP TABLE IF EXISTS `teresa_category_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teresa_category_product` (
  `category_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `product_id` int(11) unsigned NOT NULL DEFAULT '0',
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`,`product_id`),
  KEY `productIdOfCategory` (`product_id`),
  KEY `categoryProductAddedBy` (`addedBy`),
  KEY `categoryProductUpdatedBy` (`updatedBy`),
  CONSTRAINT `categoryProductUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `categoryIdOfProduct` FOREIGN KEY (`category_id`) REFERENCES `teresa_category` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `categoryProductAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `productIdOfCategory` FOREIGN KEY (`product_id`) REFERENCES `teresa_product` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teresa_category_product`
--


/*!40000 ALTER TABLE `teresa_category_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `teresa_category_product` ENABLE KEYS */;


--
-- Table structure for table `teresa_manufacturer`
--

DROP TABLE IF EXISTS `teresa_manufacturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teresa_manufacturer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `fullName` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `shortName` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturerAddedBy` (`addedBy`),
  KEY `manufacturerUpdatedBy` (`updatedBy`),
  CONSTRAINT `manufacturerUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `manufacturerAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teresa_manufacturer`
--


/*!40000 ALTER TABLE `teresa_manufacturer` DISABLE KEYS */;
/*!40000 ALTER TABLE `teresa_manufacturer` ENABLE KEYS */;


--
-- Table structure for table `teresa_product`
--

DROP TABLE IF EXISTS `teresa_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teresa_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `manufacturer` int(6) unsigned DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `mass` decimal(6,3) DEFAULT NULL,
  `lenght` int(5) DEFAULT NULL,
  `width` int(5) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productAddedBy` (`addedBy`),
  KEY `productUpdatedBy` (`updatedBy`),
  CONSTRAINT `productUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `productAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teresa_product`
--


/*!40000 ALTER TABLE `teresa_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `teresa_product` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-26 21:10:19
