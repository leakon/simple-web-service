-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2009 at 11:12 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `forest`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `view_cnt` int(11) NOT NULL default '0',
  `order_num` int(11) NOT NULL default '0',
  `published` int(11) NOT NULL default '0',
  `is_private` int(11) NOT NULL default '0',
  `created_at` datetime NOT NULL default '1980-01-01 00:00:00',
  `published_at` datetime NOT NULL default '1980-01-01 00:00:00',
  `title` char(255) NOT NULL,
  `pic` char(255) NOT NULL,
  `keyword` char(255) NOT NULL,
  `vol_num` char(255) NOT NULL,
  `vol_num_all` char(255) NOT NULL,
  `detail` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `category` (`category_id`,`published`,`published_at`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `order_num` int(11) NOT NULL default '0',
  `name` char(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(255) NOT NULL,
  `password` char(32) NOT NULL,
  `mail` char(255) NOT NULL,
  `created_at` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
