-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2014 alle 22:43
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `teresa_admin`
--

INSERT INTO `teresa_admin` (`id`, `name`, `surname`, `avatar`, `loginName`, `hash`, `role`, `addedBy`, `creationTime`, `updatedBy`, `updateTime`, `lastLogin`) VALUES
(1, 'Mario', NULL, NULL, 'admin', '$2y$10$f3k2VKSuOhm7oc623Dt3HOnG4lQdXhIHkYt93pJTD/XsANsYFB.li', 1, NULL, '2014-04-20 19:47:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_lang`
--

CREATE TABLE IF NOT EXISTS `teresa_lang` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(5) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `charset` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `lang` varchar(10) DEFAULT NULL,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `langAddedBy` (`addedBy`),
  KEY `langUpdatedBy` (`updatedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `teresa_lang`
--

INSERT INTO `teresa_lang` (`id`, `name`, `description`, `charset`, `status`, `lang`, `addedBy`, `creationTime`, `updatedBy`, `updateTime`) VALUES
(1, 'ru', 'русский', 'utf-8', 'default', 'ru', NULL, '2014-04-20 19:47:49', NULL, NULL),
(2, 'ua', 'українська', 'utf-8', NULL, 'ua', NULL, '2014-04-20 19:47:49', NULL, NULL),
(3, 'it', 'italiano', 'utf-8', NULL, 'it', NULL, '2014-04-20 19:47:49', NULL, NULL),
(4, 'en', 'english', 'utf-8', NULL, 'en', NULL, '2014-04-20 19:47:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_manufacturer`
--

CREATE TABLE IF NOT EXISTS `teresa_manufacturer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturer_addedBy` (`addedBy`),
  KEY `manufacturer_updatedBy` (`updatedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_manufacturer_attrs`
--

CREATE TABLE IF NOT EXISTS `teresa_manufacturer_attrs` (
  `attribute` varchar(20) NOT NULL,
  PRIMARY KEY (`attribute`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `teresa_manufacturer_attrs`
--

INSERT INTO `teresa_manufacturer_attrs` (`attribute`) VALUES
('description'),
('fullName'),
('shortName');

-- --------------------------------------------------------

--
-- Struttura della tabella `teresa_manufacturer_values`
--

CREATE TABLE IF NOT EXISTS `teresa_manufacturer_values` (
  `id` int(6) unsigned NOT NULL,
  `attribute` varchar(20) NOT NULL DEFAULT '',
  `lang` int(3) unsigned NOT NULL,
  `value` text,
  `addedBy` smallint(5) unsigned DEFAULT NULL,
  `creationTime` datetime NOT NULL,
  `updatedBy` smallint(5) unsigned DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`attribute`,`lang`),
  KEY `manufacturer_values_addedBy` (`addedBy`),
  KEY `manufacturer_values_updatedBy` (`updatedBy`),
  KEY `manufacturer_values_lang` (`lang`),
  KEY `manufacturer_values_attrs` (`attribute`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `teresa_admin`
--
ALTER TABLE `teresa_admin`
  ADD CONSTRAINT `adminAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `adminUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_lang`
--
ALTER TABLE `teresa_lang`
  ADD CONSTRAINT `langAddedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `langUpdatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_manufacturer`
--
ALTER TABLE `teresa_manufacturer`
  ADD CONSTRAINT `manufacturer_addedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturer_updatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `teresa_manufacturer_values`
--
ALTER TABLE `teresa_manufacturer_values`
  ADD CONSTRAINT `manufacturer_values_addedBy` FOREIGN KEY (`addedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturer_values_attrs` FOREIGN KEY (`attribute`) REFERENCES `teresa_manufacturer_attrs` (`attribute`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturer_values_lang` FOREIGN KEY (`lang`) REFERENCES `teresa_lang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturer_values_to_core` FOREIGN KEY (`id`) REFERENCES `teresa_manufacturer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturer_values_updatedBy` FOREIGN KEY (`updatedBy`) REFERENCES `teresa_admin` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
