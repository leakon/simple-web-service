-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2010 at 12:43 ����
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `data_cart_detail`
--

INSERT INTO `data_cart_detail` (`id`, `cart_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, '20100929080014', 11, 1, '23.00', '23.00'),
(2, '20100929080014', 12, 1, '23.00', '23.00'),
(3, '20100929080014', 15, 1, '23.00', '23.00'),
(4, '20100929080015', 11, 1, '23.00', '23.00'),
(5, '20100929080015', 13, 1, '23.00', '23.00'),
(6, '20100929080015', 14, 12, '23.00', '276.00'),
(7, '20100929080015', 16, 1, '23.00', '23.00'),
(8, '20100929080016', 11, 1, '23.00', '23.00'),
(9, '20100929080016', 12, 11, '23.00', '253.00'),
(10, '20100929080016', 13, 1, '23.00', '23.00'),
(11, '20100929080016', 14, 1, '23.00', '23.00'),
(12, '20100929080016', 15, 1, '23.00', '23.00'),
(13, '20100929080016', 18, 1, '23.00', '23.00'),
(14, '20100929080017', 12, 1, '23.00', '23.00'),
(15, '20100929080017', 15, 1, '23.00', '23.00'),
(16, '20100930080018', 2, 1, '23.00', '23.00'),
(17, '20100930080018', 5, 1, '23.00', '23.00'),
(18, '20101020080019', 7, 1, '23.00', '23.00'),
(19, '20101020080019', 10, 1, '23.00', '23.00'),
(20, '20101020080020', 1, 3, '23.00', '69.00'),
(21, '20101020080020', 4, 4, '23.00', '92.00'),
(22, '20101020080021', 11, 3, '23.00', '69.00'),
(23, '20101020080022', 11, 3, '23.00', '69.00'),
(24, '20101020080022', 17, 10, '23.00', '230.00'),
(25, '20101020080023', 11, 3, '23.00', '69.00'),
(26, '20101020080023', 17, 10, '23.00', '230.00'),
(27, '20101020080024', 11, 3, '23.00', '69.00'),
(28, '20101020080024', 17, 10, '23.00', '230.00'),
(29, '20101020080024', 20, 1, '23.00', '23.00'),
(30, '20101020080025', 11, 3, '23.00', '69.00'),
(31, '20101020080025', 17, 10, '23.00', '230.00'),
(32, '20101020080025', 20, 2, '23.00', '46.00'),
(33, '20101020080026', 11, 2, '23.00', '46.00'),
(34, '20101020080026', 14, 1, '23.00', '23.00'),
(35, '20101020080026', 18, 9, '23.00', '207.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id`, `name`, `mobile`, `address`, `receive_time`, `order_id`, `status`) VALUES
(1, '12312f433', '34344343243', 'gr2e4g45g45g45g45', '2010-09-29 10:00:00', '20100929080014', 1000),
(2, '213r213r123123r123r', '12341234123', '213412341231423', '2010-09-29 10:00:00', '20100929080015', 1000),
(3, '1234123412341234', '12341234123', '123412r312rf123f3f43f45f', '2010-09-29 10:00:00', '20100929080016', 1000),
(4, '12312341234', '12341234213', '2134213412341234123', '2010-09-29 10:00:00', '20100929080017', 1000),
(5, '1313', '12312312341', '123412341234123', '2010-09-30 10:00:00', '20100930080018', 1000);

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
('cart_id', 80026);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `data_order`
--

INSERT INTO `data_order` (`id`, `order_id`, `total`, `status`, `pay_method`, `created_at`, `updated_at`) VALUES
(1, '20100929080014', '69.00', 0, 1000, '2010-09-29 04:02:25', '2000-01-01 00:00:00'),
(2, '20100929080015', '289.00', 0, 1000, '2010-09-29 05:44:29', '2000-01-01 00:00:00'),
(3, '20100929080016', '312.00', 0, 1000, '2010-09-29 06:58:00', '2000-01-01 00:00:00'),
(4, '20100929080017', '46.00', 0, 1000, '2010-09-29 08:36:40', '2000-01-01 00:00:00'),
(5, '20100930080018', '46.00', 0, 2000, '2010-09-30 06:39:35', '2010-09-30 06:39:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `data_order_detail`
--

INSERT INTO `data_order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, '20100929080014', 11, 1, '23.00', '23.00'),
(2, '20100929080014', 12, 1, '23.00', '23.00'),
(3, '20100929080014', 15, 1, '23.00', '23.00'),
(4, '20100929080015', 11, 1, '23.00', '23.00'),
(5, '20100929080015', 13, 1, '23.00', '23.00'),
(6, '20100929080015', 14, 12, '23.00', '276.00'),
(7, '20100929080015', 16, 1, '23.00', '23.00'),
(8, '20100929080016', 11, 1, '23.00', '23.00'),
(9, '20100929080016', 12, 11, '23.00', '253.00'),
(10, '20100929080016', 13, 1, '23.00', '23.00'),
(11, '20100929080016', 14, 1, '23.00', '23.00'),
(12, '20100929080016', 15, 1, '23.00', '23.00'),
(13, '20100929080016', 18, 1, '23.00', '23.00'),
(14, '20100929080017', 12, 1, '23.00', '23.00'),
(15, '20100929080017', 15, 1, '23.00', '23.00'),
(18, '20100930080018', 2, 1, '23.00', '23.00'),
(19, '20100930080018', 5, 1, '23.00', '23.00');

-- --------------------------------------------------------

--
-- Table structure for table `data_product`
--

CREATE TABLE IF NOT EXISTS `data_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `lang` char(32) NOT NULL COMMENT 'ch, en',
  `name` char(255) NOT NULL DEFAULT '',
  `abstract` char(255) NOT NULL DEFAULT '',
  `detail` mediumtext NOT NULL,
  `special` char(255) NOT NULL DEFAULT '',
  `spec_days` char(255) NOT NULL COMMENT 'Sun:0, Mon:1, ..., Sat:6',
  `pic` char(255) NOT NULL DEFAULT '',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `data_product`
--

INSERT INTO `data_product` (`id`, `category`, `lang`, `name`, `abstract`, `detail`, `special`, `spec_days`, `pic`, `price`, `quantity`) VALUES
(1, 100, 'en', 'Carrot & Zucchini', '', '<p>carro/zucchini/raisins/oats/\r\norange/eggs/butter and cream/\r\ncinnamon</p>', '', '', '/images/Ordering_img01.jpg', '23.00', 0),
(2, 100, 'en', 'Mocha', '', ' <p>chocolate/coffee/cocoa powder/eggs/butter and cream</p>', '', '', '/images/Ordering_img02.jpg', '23.00', 0),
(3, 100, 'en', 'Lemon Curd & Italian Meringue', '', '<p>lemon/eggs/butter and cream/\r\ngelatine</p>', '', '', '/images/Ordering_img03.jpg', '23.00', 0),
(4, 100, 'en', 'Double Chocolate', '', ' <p>chocolate/eggs/butter and cream/\r\ncocoa powder</p>', '', '', '/images/Ordering_img04.jpg', '23.00', 0),
(5, 100, 'en', 'Green Tea & Chocolate Granache', '', '<p>green tea/chocolate/almond/\r\neggs/butter and cream</p>', '', '', '/images/Ordering_img05.jpg', '23.00', 0),
(6, 100, 'en', 'Orange Poppy Seed', '', '<p>orange/poppy seed/eggs/butter and cream</p>', '', '', '/images/Ordering_img06.jpg', '23.00', 0),
(7, 200, 'en', 'Chocolate & Banana', '', '<p>chocolate/banana/rum/passion\r\nfruit/eggs/butter and cream/cocoa\r\npowder</p>', 'MON.,TUE.', '1,2', '/images/Ordering_img07.jpg', '23.00', 0),
(8, 200, 'en', 'Almond & Cherry', '', '<p>almond/cherry/eggs/butter and cream</p>', 'Wed.,Thur.', '3,4', '/images/Ordering_img08.jpg', '23.00', 0),
(9, 200, 'en', 'Mango & Passion Fruit', '', '<p>fresh mango/passion fruit/eggs/butter and cream</p>', 'Fri.,Sat.', '5,6', '/images/Ordering_img09.jpg', '23.00', 0),
(10, 200, 'en', 'Raspberry & Lemon', '', '<p>raspberry/eggs/butter and cream/gelatine</p>', 'Sun.', '0', '/images/Ordering_img10.jpg', '23.00', 0),
(11, 100, 'ch', '胡萝卜 & 西葫芦', '', '<p>胡萝卜、意大利青瓜、葡萄干、燕麦、橙子、鸡蛋、奶制品、肉桂</p>', '', '', '/images_ch/Ordering_img01.jpg', '23.00', 0),
(12, 100, 'ch', '摩卡', '', '<p>巧克力酱、咖啡、可可粉、鸡蛋、奶制品</p>', '', '', '/images_ch/Ordering_img02.jpg', '23.00', 0),
(13, 100, 'ch', '柠檬酱 & 意式蛋清', '', '<p>柠檬、鸡蛋、奶制品、食用凝胶</p>', '', '', '/images_ch/Ordering_img03.jpg', '23.00', 0),
(14, 100, 'ch', '双份巧克力', '', '<p>巧克力、鸡蛋、奶制品、可可粉</p>', '', '', '/images_ch/Ordering_img04.jpg', '23.00', 0),
(15, 100, 'ch', '绿茶 & 巧克力', '', '<p>绿茶、巧克力、杏仁、鸡蛋、奶制品</p>', '', '', '/images_ch/Ordering_img05.jpg', '23.00', 0),
(16, 100, 'ch', '甜橙 & 罂粟子', '', '<p>橙子、罂粟子、鸡蛋、奶制品</p>', '', '', '/images_ch/Ordering_img06.jpg', '23.00', 0),
(17, 200, 'ch', '巧克力 & 香蕉', '', '<p>巧克力、香蕉、朗姆酒、热情果、鸡蛋、奶制品、可可粉</p>', '周一周二', '1,2', '/images_ch/Ordering_img07.jpg', '23.00', 0),
(18, 200, 'ch', '杏仁 & 樱桃', '', '<p>杏仁、干浆果、鸡蛋、奶制品</p><h3>￥23/RMB</h3>', '周三周四', '3,4', '/images_ch/Ordering_img08.jpg', '23.00', 0),
(19, 200, 'ch', '芒果 & 百香果', '', '<p>新鲜的芒果、百香果、鸡蛋、奶制品</p>', '周五周六', '5,6', '/images_ch/Ordering_img09.jpg', '23.00', 0),
(20, 200, 'ch', '树莓 & 柠檬', '', '<p>树莓、鸡蛋、奶制品、食用凝胶</p>', '周日', '0', '/images_ch/Ordering_img10.jpg', '23.00', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `data_session`
--

INSERT INTO `data_session` (`id`, `user_id`, `sess_time`, `sess_id`, `sess_data`) VALUES
(2, 1, 1285825427, 'd971v66lr5vrngs18g2o53ega2', 'symfony/user/sfUser/lastRequest|i:1285825427;symfony/user/sfUser/authenticated|b:1;symfony/user/sfUser/credentials|a:1:{i:0;s:6:"member";}symfony/user/sfUser/attributes|a:3:{s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:6:"Leakon";s:4:"mail";s:18:"leakon@hotmail.com";}}symfony/user/sfUser/culture|s:2:"en";'),
(18, 1, 1285825478, 'hsusgnjtf88l2ag0afhokdg6u7', 'symfony/user/sfUser/lastRequest|i:1285825477;symfony/user/sfUser/authenticated|b:1;symfony/user/sfUser/credentials|a:1:{i:0;s:6:"member";}symfony/user/sfUser/attributes|a:3:{s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:6:"Leakon";s:4:"mail";s:18:"leakon@hotmail.com";}s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}}symfony/user/sfUser/culture|s:2:"en";'),
(19, 1, 1285825657, '1a1oid0hei6fb04uoqc78detf2', 'symfony/user/sfUser/lastRequest|i:1285825657;symfony/user/sfUser/authenticated|b:1;symfony/user/sfUser/credentials|a:1:{i:0;s:6:"member";}symfony/user/sfUser/attributes|a:3:{s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:6:"Leakon";s:4:"mail";s:18:"leakon@hotmail.com";}s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}}symfony/user/sfUser/culture|s:2:"en";'),
(20, 1, 1285825701, '3rilv2smvfre3prbr439cq4972', 'symfony/user/sfUser/lastRequest|i:1285825701;symfony/user/sfUser/authenticated|b:1;symfony/user/sfUser/credentials|a:1:{i:0;s:6:"member";}symfony/user/sfUser/attributes|a:3:{s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:6:"Leakon";s:4:"mail";s:18:"leakon@hotmail.com";}s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}}symfony/user/sfUser/culture|s:2:"en";'),
(21, 0, 1285826133, 'ibkp3oar214tparfedo2ltqrq4', 'symfony/user/sfUser/lastRequest|i:1285826133;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";'),
(22, 1, 1285826787, 'kq8vrrjqfl667fh12r931qeqv5', 'symfony/user/sfUser/lastRequest|i:1285826787;symfony/user/sfUser/authenticated|b:1;symfony/user/sfUser/credentials|a:1:{i:0;s:6:"member";}symfony/user/sfUser/attributes|a:3:{s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:6:"Leakon";s:4:"mail";s:18:"leakon@hotmail.com";}s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}}symfony/user/sfUser/culture|s:2:"en";'),
(23, 0, 1287578290, 'dhb9bv78ji93kqr4us7g5vbm67', 'symfony/user/sfUser/lastRequest|i:1287578290;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";'),
(24, 0, 1285828817, 'j0aoeeqcv9g55feccs3v3d80g0', 'symfony/user/sfUser/lastRequest|i:1285828817;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";'),
(25, 0, 1285828775, 'ojbc72nk8d7ma1k8veq0nrhfp1', 'symfony/user/sfUser/lastRequest|i:1285828775;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";'),
(26, 0, 1285828780, '36f22l00uk1il8rd40rhvq3l86', 'symfony/user/sfUser/lastRequest|i:1285828780;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `mail`, `password`, `username`, `created_at`) VALUES
(1, 'leakon@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Leakon', '2000-01-01 00:00:00');

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
