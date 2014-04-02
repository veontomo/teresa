-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2014 alle 20:18
-- Versione del server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teresadesign`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_admin`
--

CREATE TABLE IF NOT EXISTS `teresa_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `avatar` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `loginName` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hash` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` tinyint(3) unsigned DEFAULT NULL,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginName` (`loginName`),
  KEY `adminAddedBy` (`addedBy`),
  KEY `adminUpdatedBy` (`updatedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `teresa_admin`
--

INSERT INTO `teresa_admin` (`id`, `name`, `surname`, `avatar`, `loginName`, `hash`, `role`, `addedBy`, `creationTime`, `updatedBy`, `updateTime`, `lastLogin`) VALUES
(11, 'Mario', NULL, NULL, 'admin', '$2y$10$BomzUNXWzeON8RFZq2BXcu5Vxk.ssrNojbdlauYhec5FuCPdRbrj2', 0, NULL, '2014-04-02 20:16:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_category`
--

CREATE TABLE IF NOT EXISTS `teresa_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` smallint(5) unsigned DEFAULT NULL,
  `description` text,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryAddedBy` (`addedBy`),
  KEY `categoryUpdatedBy` (`updatedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_category_product`
--

CREATE TABLE IF NOT EXISTS `teresa_category_product` (
  `category_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `product_id` int(11) unsigned NOT NULL DEFAULT '0',
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`,`product_id`),
  KEY `productIdOfCategory` (`product_id`),
  KEY `categoryProductAddedBy` (`addedBy`),
  KEY `categoryProductUpdatedBy` (`updatedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_manufacturer`
--

CREATE TABLE IF NOT EXISTS `teresa_manufacturer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `fullName` varchar(150) DEFAULT NULL,
  `shortName` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturerAddedBy` (`addedBy`),
  KEY `manufacturerUpdatedBy` (`updatedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_product`
--

CREATE TABLE IF NOT EXISTS `teresa_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `manufacturer` int(6) unsigned DEFAULT NULL,
  `description` text,
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
  KEY `productUpdatedBy` (`updatedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `teresa_admin`
--
ALTER TABLE `teresa_admin`
  ADD CONSTRAINT `adminUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `adminAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_category`
--
ALTER TABLE `teresa_category`
  ADD CONSTRAINT `categoryUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_category_product`
--
ALTER TABLE `teresa_category_product`
  ADD CONSTRAINT `categoryProductUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryIdOfProduct` FOREIGN KEY (`category_id`) REFERENCES `teresa_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryProductAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productIdOfCategory` FOREIGN KEY (`product_id`) REFERENCES `teresa_product` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_manufacturer`
--
ALTER TABLE `teresa_manufacturer`
  ADD CONSTRAINT `manufacturerUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturerAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_product`
--
ALTER TABLE `teresa_product`
  ADD CONSTRAINT `productUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
