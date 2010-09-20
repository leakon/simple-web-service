-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2010 at 01:46 ����
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
