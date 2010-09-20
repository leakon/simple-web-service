-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2010 at 02:25 ����
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ns_cupcake`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_cart`
--

CREATE TABLE IF NOT EXISTS `data_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` char(16) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_cart`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_cart_detail`
--

CREATE TABLE IF NOT EXISTS `data_cart_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` char(16) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_pid` (`cart_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_cart_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_customer`
--

CREATE TABLE IF NOT EXISTS `data_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `address` char(255) NOT NULL DEFAULT '',
  `receive_time` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `order_id` char(16) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '标记是否成功关联到订单',
  PRIMARY KEY (`id`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_customer`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_id_generator`
--

CREATE TABLE IF NOT EXISTS `data_id_generator` (
  `name` char(64) NOT NULL DEFAULT '',
  `uniq_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_id_generator`
--

INSERT INTO `data_id_generator` (`name`, `uniq_id`) VALUES
('order_id', 10001),
('cart_id', 80002);

-- --------------------------------------------------------

--
-- Table structure for table `data_order`
--

CREATE TABLE IF NOT EXISTS `data_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` char(16) NOT NULL,
  `total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '0',
  `pay_method` int(11) NOT NULL DEFAULT '0' COMMENT '付款类型：货到付款、支付宝等',
  `created_at` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_order_detail`
--

CREATE TABLE IF NOT EXISTS `data_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` char(16) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_order_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_product`
--

CREATE TABLE IF NOT EXISTS `data_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `name` char(255) NOT NULL DEFAULT '',
  `abstract` char(255) NOT NULL DEFAULT '',
  `detail` mediumtext NOT NULL,
  `special` char(255) NOT NULL DEFAULT '',
  `pic` char(255) NOT NULL DEFAULT '',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `data_product`
--

INSERT INTO `data_product` (`id`, `category`, `name`, `abstract`, `detail`, `special`, `pic`, `price`, `quantity`) VALUES
(1, 100, 'Carrot & Zucchini', '', '<p>carro/zucchini/raisins/oats/\r\norange/eggs/dairy product/\r\ncinnamon</p>', '', '/images/Ordering_img01.jpg', '23.00', 0),
(2, 100, 'Mocha', '', ' <p>chocolate/coffee/cocoa\r\n powder/eggs/dairy product</p>', '', '/images/Ordering_img02.jpg', '23.00', 0),
(3, 100, 'Lemon Curd & Italian Meringue', '', '<p>lemon/eggs/dairy produc/\r\ngelatine</p>', '', '/images/Ordering_img03.jpg', '23.00', 0),
(4, 100, 'Double Chocolate', '', ' <p>chocolate/eggs/dairy product/\r\ncocoa powder</p>', '', '/images/Ordering_img04.jpg', '23.00', 0),
(5, 100, 'Green Tea & Chocolate Granache', '', '<p>green tea/chocolate/almond/\r\neggs/dairy product</p>', '', '/images/Ordering_img05.jpg', '23.00', 0),
(6, 100, 'Orange Poppy seed', '', '<p>orange/poppy seed/eggs/\r\ndairy product</p>', '', '/images/Ordering_img06.jpg', '23.00', 0),
(7, 200, 'Chocolate & Banana', '', '<p>chocolate/banana/rum/passion\r\nfruit/eggs/dairy product/cocoa\r\npowder</p>', 'MON.,TUE.', '/images/Ordering_img07.jpg', '23.00', 0),
(8, 200, 'Almond & Cherry', '', '<p>almond/cherry/dried berries/\r\neggs/dairy product</p>', 'Wed.,Thur.', '/images/Ordering_img08.jpg', '23.00', 0),
(9, 200, 'Mango & Passion', '', '<p>fresh mango/passion fruit/\r\neggs/dairy product</p>', 'Fri.,Sat.', '/images/Ordering_img09.jpg', '23.00', 0),
(10, 200, 'Raspberry & Lemon', '', '<p>raspberry/eggs/dairy product/\r\ngelatine</p>', 'Sun.', '/images/Ordering_img10.jpg', '23.00', 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_session`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` char(255) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `username` char(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `debug_log`
--

CREATE TABLE IF NOT EXISTS `debug_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` char(255) NOT NULL DEFAULT '',
  `object_id` char(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `debug_log`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
