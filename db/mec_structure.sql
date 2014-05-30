-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 31 2014 г., 01:08
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mec`
--

-- --------------------------------------------------------

--
-- Структура таблицы `indications`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
