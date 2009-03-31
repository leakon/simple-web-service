-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2009 at 01:56 AM
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
  `published` int(11) NOT NULL default '1',
  `created_at` datetime NOT NULL,
  `title` char(255) NOT NULL,
  `pic` char(255) NOT NULL,
  `keyword` char(255) NOT NULL,
  `view_group` char(255) NOT NULL,
  `detail` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `order_num` int(11) NOT NULL default '0',
  `name` char(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;




