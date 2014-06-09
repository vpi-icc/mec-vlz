
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2014 at 03:18 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a8987760_mec`
--

-- --------------------------------------------------------

--
-- Table structure for table `indications`
--

DROP TABLE IF EXISTS `indications`;
CREATE TABLE IF NOT EXISTS `indications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp',
  `TRV` float NOT NULL COMMENT 'turbine rotating velocity',
  `TOP` float NOT NULL COMMENT 'turbine output power',
  `SBOP` float NOT NULL COMMENT 'solar battery output power',
  `BCL` float NOT NULL COMMENT 'battery charge level',
  `lat` float unsigned DEFAULT NULL COMMENT 'широта',
  `lon` float unsigned DEFAULT NULL COMMENT 'долгота',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pointName` char(40) DEFAULT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `description` char(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `img` char(30) DEFAULT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date DEFAULT NULL,
  `filename` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;
