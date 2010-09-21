-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2010 at 09:48 ÉÏÎç
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
(1, 100, 'Carrot & Zucchini', '', '<p>carro/zucchini/raisins/oats/\r\norange/eggs/butter and cream/\r\ncinnamon</p>', '', '/images/Ordering_img01.jpg', '23.00', 0),
(2, 100, 'Mocha', '', ' <p>chocolate/coffee/cocoa powder/eggs/butter and cream</p>', '', '/images/Ordering_img02.jpg', '23.00', 0),
(3, 100, 'Lemon Curd & Italian Meringue', '', '<p>lemon/eggs/butter and cream/\r\ngelatine</p>', '', '/images/Ordering_img03.jpg', '23.00', 0),
(4, 100, 'Double Chocolate', '', ' <p>chocolate/eggs/butter and cream/\r\ncocoa powder</p>', '', '/images/Ordering_img04.jpg', '23.00', 0),
(5, 100, 'Green Tea & Chocolate Granache', '', '<p>green tea/chocolate/almond/\r\neggs/butter and cream</p>', '', '/images/Ordering_img05.jpg', '23.00', 0),
(6, 100, 'Orange Poppy seed', '', '<p>orange/poppy seed/eggs/butter and cream</p>', '', '/images/Ordering_img06.jpg', '23.00', 0),
(7, 200, 'Chocolate & Banana', '', '<p>chocolate/banana/rum/passion\r\nfruit/eggs/butter and cream/cocoa\r\npowder</p>', 'MON.,TUE.', '/images/Ordering_img07.jpg', '23.00', 0),
(8, 200, 'Almond & Cherry', '', '<p>almond/cherry/dried berries/\r\neggs/butter and cream</p>', 'Wed.,Thur.', '/images/Ordering_img08.jpg', '23.00', 0),
(9, 200, 'Mango & Passion', '', '<p>fresh mango/passion fruit/eggs/butter and cream</p>', 'Fri.,Sat.', '/images/Ordering_img09.jpg', '23.00', 0),
(10, 200, 'Raspberry & Lemon', '', '<p>raspberry/eggs/butter and cream/gelatine</p>', 'Sun.', '/images/Ordering_img10.jpg', '23.00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
