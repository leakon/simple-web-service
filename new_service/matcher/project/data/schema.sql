-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2010 at 11:46 ????
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ns_matcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_model`
--

CREATE TABLE IF NOT EXISTS `data_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `price_id` int(11) NOT NULL DEFAULT '0',
  `caliber_id` int(11) NOT NULL DEFAULT '0',
  `style_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `weight` decimal(8,3) NOT NULL DEFAULT '0.000',
  `min` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `ext_vol_type` int(11) NOT NULL DEFAULT '0',
  `ext_vol_long` int(11) NOT NULL DEFAULT '0',
  `ext_vol_wide` int(11) NOT NULL DEFAULT '0',
  `ext_vol_flash` int(11) NOT NULL DEFAULT '0',
  `ext_vol_notebook` int(11) NOT NULL DEFAULT '0',
  `ext_vol_accessory` int(11) NOT NULL DEFAULT '0',
  `ext_vol_slr` int(11) NOT NULL DEFAULT '0',
  `ext_vol_small` int(11) NOT NULL DEFAULT '0',
  `ext_vol_card` int(11) NOT NULL DEFAULT '0',
  `ext_vol_standard` int(11) NOT NULL DEFAULT '0',
  `ext_vol_pro` int(11) NOT NULL DEFAULT '0',
  `ext_vol_stand` int(11) NOT NULL DEFAULT '0',
  `ext_vol_danfan` int(11) NOT NULL DEFAULT '0',
  `ext_vol_wybj` int(11) NOT NULL DEFAULT '0',
  `ext_vol_types` char(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `name` char(255) NOT NULL,
  `style` char(255) NOT NULL,
  `link` char(255) NOT NULL,
  `pic` char(255) NOT NULL,
  `caliber` char(255) NOT NULL,
  `detail` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_session`
--

CREATE TABLE IF NOT EXISTS `data_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sess_time` int(11) NOT NULL DEFAULT '0',
  `sess_id` char(32) NOT NULL,
  `sess_data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sess_id` (`sess_id`),
  KEY `sess_time` (`sess_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `department` char(255) NOT NULL,
  `position` char(255) NOT NULL,
  `telephone` char(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_bag_style`
--

CREATE TABLE IF NOT EXISTS `map_bag_style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bag_id` int(11) NOT NULL DEFAULT '0',
  `style_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_tag`
--

CREATE TABLE IF NOT EXISTS `map_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
