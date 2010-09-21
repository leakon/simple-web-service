-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2010 at 03:42 ����
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
  `pic` char(255) NOT NULL DEFAULT '',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `data_product`
--

INSERT INTO `data_product` (`id`, `category`, `lang`, `name`, `abstract`, `detail`, `special`, `pic`, `price`, `quantity`) VALUES
(1, 100, 'en', 'Carrot & Zucchini', '', '<p>carro/zucchini/raisins/oats/\r\norange/eggs/butter and cream/\r\ncinnamon</p>', '', '/images/Ordering_img01.jpg', '23.00', 0),
(2, 100, 'en', 'Mocha', '', ' <p>chocolate/coffee/cocoa powder/eggs/butter and cream</p>', '', '/images/Ordering_img02.jpg', '23.00', 0),
(3, 100, 'en', 'Lemon Curd & Italian Meringue', '', '<p>lemon/eggs/butter and cream/\r\ngelatine</p>', '', '/images/Ordering_img03.jpg', '23.00', 0),
(4, 100, 'en', 'Double Chocolate', '', ' <p>chocolate/eggs/butter and cream/\r\ncocoa powder</p>', '', '/images/Ordering_img04.jpg', '23.00', 0),
(5, 100, 'en', 'Green Tea & Chocolate Granache', '', '<p>green tea/chocolate/almond/\r\neggs/butter and cream</p>', '', '/images/Ordering_img05.jpg', '23.00', 0),
(6, 100, 'en', 'Orange Poppy seed', '', '<p>orange/poppy seed/eggs/butter and cream</p>', '', '/images/Ordering_img06.jpg', '23.00', 0),
(7, 200, 'en', 'Chocolate & Banana', '', '<p>chocolate/banana/rum/passion\r\nfruit/eggs/butter and cream/cocoa\r\npowder</p>', 'MON.,TUE.', '/images/Ordering_img07.jpg', '23.00', 0),
(8, 200, 'en', 'Almond & Cherry', '', '<p>almond/cherry/dried berries/\r\neggs/butter and cream</p>', 'Wed.,Thur.', '/images/Ordering_img08.jpg', '23.00', 0),
(9, 200, 'en', 'Mango & Passion', '', '<p>fresh mango/passion fruit/eggs/butter and cream</p>', 'Fri.,Sat.', '/images/Ordering_img09.jpg', '23.00', 0),
(10, 200, 'en', 'Raspberry & Lemon', '', '<p>raspberry/eggs/butter and cream/gelatine</p>', 'Sun.', '/images/Ordering_img10.jpg', '23.00', 0),
(11, 100, 'ch', '胡萝卜 & 西葫芦', '', '<p>胡萝卜、意大利青瓜、葡萄干、燕麦、橙子、鸡蛋、奶制品、肉桂</p>', '', '/images_ch/Ordering_img01.jpg', '23.00', 0),
(12, 100, 'ch', '摩卡', '', '<p>巧克力酱、咖啡、可可粉、鸡蛋、奶制品</p>', '', '/images_ch/Ordering_img02.jpg', '23.00', 0),
(13, 100, 'ch', '柠檬酱 & 意式蛋清', '', '<p>柠檬、鸡蛋、奶制品、食用凝胶</p>', '', '/images_ch/Ordering_img03.jpg', '23.00', 0),
(14, 100, 'ch', '双份巧克力', '', '<p>巧克力、鸡蛋、奶制品、可可粉</p>', '', '/images_ch/Ordering_img04.jpg', '23.00', 0),
(15, 100, 'ch', '绿茶 & 巧克力', '', '<p>绿茶、巧克力、杏仁、鸡蛋、奶制品</p>', '', '/images_ch/Ordering_img05.jpg', '23.00', 0),
(16, 100, 'ch', '甜橙 & 罂粟子', '', '<p>橙子、罂粟子、鸡蛋、奶制品</p>', '', '/images_ch/Ordering_img06.jpg', '23.00', 0),
(17, 200, 'ch', '巧克力 & 香蕉', '', '<p>巧克力、香蕉、朗姆酒、热情果、鸡蛋、奶制品、可可粉</p>', '周一周二', '/images_ch/Ordering_img07.jpg', '23.00', 0),
(18, 200, 'ch', '杏仁 & 樱桃', '', '<p>杏仁、干浆果、鸡蛋、奶制品</p><h3>￥23/RMB</h3>', '周三周四', '/images_ch/Ordering_img08.jpg', '23.00', 0),
(19, 200, 'ch', '芒果 & 百香果', '', '<p>新鲜的芒果、百香果、鸡蛋、奶制品</p>', '周五周六', '/images_ch/Ordering_img09.jpg', '23.00', 0),
(20, 200, 'ch', '树莓 & 柠檬', '', '<p>树莓、鸡蛋、奶制品、食用凝胶</p>', '周日', '/images_ch/Ordering_img10.jpg', '23.00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
