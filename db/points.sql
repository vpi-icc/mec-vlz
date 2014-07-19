
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2014 at 07:14 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a8987760_mec`
--

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE `points` (
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

--
-- Dumping data for table `points`
--

INSERT INTO `points` VALUES(103, 'тестовое испытание', 48.8, 45.2, 'Ветер  хороший', 1, NULL, '2013-12-13', NULL, '103.JPG');
INSERT INTO `points` VALUES(92, 'Кировский район', 48.47, 44.46, 'Полный штиль', 0, NULL, '2013-07-01', '0000-00-00', '92.JPG');
INSERT INTO `points` VALUES(104, 'За Краснослободском', 48.6800807702929, 44.5499038696289, 'Ветер мачту гнул\r\nP=60Вт', 0, NULL, '2014-05-02', '2014-05-07', '104.JPG');
