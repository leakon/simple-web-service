-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2010 at 01:25 ����
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `data_cart_detail`
--

INSERT INTO `data_cart_detail` (`id`, `cart_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, '20100919000002', 2, 2, '28.00', '56.00'),
(2, '20100919000002', 3, 12, '36.00', '432.00'),
(3, '20100919000003', 2, 2, '28.00', '56.00'),
(4, '20100919000003', 3, 12, '36.00', '432.00'),
(5, '20100919000004', 1, 0, '20.00', '0.00'),
(6, '20100919000004', 2, 0, '28.00', '0.00'),
(7, '20100919000004', 3, 0, '36.00', '0.00'),
(8, '20100919000004', 4, 0, '44.00', '0.00'),
(9, '20100919000004', 5, 0, '78.00', '0.00'),
(10, '20100919000005', 4, 31, '44.00', '1364.00'),
(11, '20100919000005', 5, 12, '78.00', '936.00'),
(12, '20100919000006', 4, 31, '44.00', '1364.00'),
(13, '20100919000006', 5, 12, '78.00', '936.00'),
(14, '20100919000007', 4, 31, '44.00', '1364.00'),
(15, '20100919000007', 5, 12, '78.00', '936.00'),
(16, '20100919000008', 4, 11, '44.00', '484.00'),
(17, '20100919000008', 5, 13, '78.00', '1014.00'),
(18, '20100919000009', 4, 2, '44.00', '88.00'),
(19, '20100919000010', 5, 1, '78.00', '78.00'),
(20, '20100919000011', 1, 2, '20.00', '40.00'),
(21, '20100919000011', 3, 3, '36.00', '108.00'),
(22, '20100919000011', 5, 10, '78.00', '780.00'),
(23, '20100920000012', 2, 4, '28.00', '112.00'),
(24, '20100920000012', 3, 2, '36.00', '72.00'),
(25, '20100920000013', 2, 2, '28.00', '56.00'),
(26, '20100920000013', 5, 3, '78.00', '234.00'),
(27, '20100920000014', 4, 1, '44.00', '44.00'),
(28, '20100920000015', 4, 2, '44.00', '88.00'),
(29, '20100920000016', 4, 2, '44.00', '88.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id`, `name`, `mobile`, `address`, `receive_time`, `order_id`, `status`) VALUES
(1, '刘丽慷', '21221323', '让飞微微分', '0000-00-00 00:00:00', '20100919000009', 0),
(2, '刘丽慷', '2323', '你好', '0000-00-00 00:00:00', '20100919000010', 0),
(3, 'Leakon', '13810525285', '132213', '0000-00-00 00:00:00', '20100919000011', 1000),
(4, 'Leakon2', '1313131', 'haidianqu', '2010-09-24 00:00:00', '20100920000012', 1000),
(5, 'nihao', '1232312', 'fff', '0000-00-00 00:00:00', '20100920000013', 1000),
(6, '11', '22', '33', '0000-00-00 00:00:00', '20100920000014', 1000),
(7, 'ff', 'fee', '232', '0000-00-00 00:00:00', '20100920000015', 1000),
(8, 'fw2', 'f434', '3444', '0000-00-00 00:00:00', '20100920000016', 1000);

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
('order_id', 215),
('cart_id', 16);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `data_order`
--

INSERT INTO `data_order` (`id`, `order_id`, `total`, `status`, `pay_method`, `created_at`, `updated_at`) VALUES
(1, '20100919000011', '928.00', 0, 0, '2010-09-20 00:29:58', '2010-09-20 00:48:53'),
(7, '20100920000012', '184.00', 0, 0, '2010-09-20 01:40:17', '2010-09-20 05:58:59'),
(8, '20100920000013', '290.00', 0, 0, '2010-09-20 12:30:11', '2000-01-01 00:00:00'),
(9, '20100920000014', '44.00', 0, 0, '2010-09-20 12:33:45', '2000-01-01 00:00:00'),
(10, '20100920000015', '88.00', 0, 0, '2010-09-20 12:34:19', '2000-01-01 00:00:00'),
(11, '20100920000016', '88.00', 0, 1000, '2010-09-20 12:42:54', '2010-09-20 12:43:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `data_order_detail`
--

INSERT INTO `data_order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(40, '20100919000011', 1, 2, '20.00', '40.00'),
(41, '20100919000011', 3, 3, '36.00', '108.00'),
(42, '20100919000011', 5, 10, '78.00', '780.00'),
(51, '20100920000012', 2, 4, '28.00', '112.00'),
(52, '20100920000012', 3, 2, '36.00', '72.00'),
(53, '20100920000013', 2, 2, '28.00', '56.00'),
(54, '20100920000013', 5, 3, '78.00', '234.00'),
(55, '20100920000014', 4, 1, '44.00', '44.00'),
(56, '20100920000015', 4, 2, '44.00', '88.00'),
(58, '20100920000016', 4, 2, '44.00', '88.00');

-- --------------------------------------------------------

--
-- Table structure for table `data_product`
--

CREATE TABLE IF NOT EXISTS `data_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL DEFAULT '',
  `abstract` char(255) NOT NULL DEFAULT '',
  `detail` mediumtext NOT NULL,
  `pic` char(255) NOT NULL DEFAULT '',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `data_product`
--

INSERT INTO `data_product` (`id`, `name`, `abstract`, `detail`, `pic`, `price`, `quantity`) VALUES
(1, '蓝山', '蓝山咖啡是咖啡中的极品，产于牙买加的蓝山。受到加勒比海环抱的蓝山，每当太阳直射蔚蓝海水时，便反射到山上而发出璀璨的蓝色光芒，故而得名。此种咖啡拥有所有好咖啡的特点，不仅口味浓郁香醇，而且由于咖啡的甘、酸、苦三味搭配完美，所以完全不具苦味，仅有适度而完美的酸味。一般都单品饮用，但是因产量极少，价格昂贵无比，所以市面上一般都以味道近似的咖啡调制。', '', '', '20.00', 1000),
(2, '哥伦比亚', '产地为哥伦比亚，烘焙后的咖啡豆，会释放出甘甜的香味，具有酸中带甘、苦味中平的良质特性，因为浓度合宜的缘故，常被应用于高级的混合咖啡之中。', '', '', '28.00', 1000),
(3, '圣多斯', '主要产于巴西的圣保罗。此种咖啡酸、甘、苦三味属中性，浓度适中，带着适度的酸味，口味高雅而特殊，是最好的调配用豆。被誉为咖啡之中坚，单品饮用风味亦佳。', '', '', '36.00', 1000),
(4, '摩卡', '产于埃塞俄比亚。豆小而香浓，其酸醇味强，甘味适中，风味特殊。经水洗处理后的咖啡豆，是颇负盛名的优质咖啡，普通皆单品饮用，但若能调配混合咖啡，更是一种理想风味的综合咖啡。', '', '', '44.00', 1000),
(5, '卡普奇诺', '颜色好像意大利修道士戴的头巾，所以定名为卡普奇诺（加奶油块咖啡）。伴有肉桂棒，再淋上柠檬汁，显示出复杂的风味。', '', '', '78.00', 1000);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `data_session`
--

INSERT INTO `data_session` (`id`, `user_id`, `sess_time`, `sess_id`, `sess_data`) VALUES
(4, 0, 1284986588, '8k58qnkti1d29fnvqnh50d3tg1', 'symfony/user/sfUser/lastRequest|i:1284986588;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";'),
(5, 0, 1284989041, 'd971v66lr5vrngs18g2o53ega2', 'symfony/user/sfUser/lastRequest|i:1284989041;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:0:{}symfony/user/sfUser/culture|s:2:"en";');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `debug_log`
--

INSERT INTO `debug_log` (`id`, `category`, `object_id`, `content`, `created_at`) VALUES
(1, 'alipay_notify', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:13:02'),
(2, 'alipay_notify', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:14:09'),
(3, 'alipay_notify', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:15:05'),
(4, 'alipay_notify', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:16:08'),
(5, 'alipay_notify', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:16:30'),
(6, 'alipay_notify', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:16:44'),
(7, 'alipay_notify_failed', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:22:09'),
(8, 'alipay_notify_failed', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:23:54'),
(9, 'alipay_notify_failed', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:23:54'),
(10, 'alipay_notify_failed', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:23:58'),
(11, 'alipay_notify_failed', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:23:59'),
(12, 'alipay_notify_failed', '', 'a:3:{s:10:"error_code";i:1000;s:13:"error_message";s:27:"Alipay notify verify failed";s:14:"alipay_request";a:0:{}}', '2010-09-20 13:24:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
