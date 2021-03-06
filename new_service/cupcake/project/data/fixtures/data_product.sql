-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2010 at 03:42 ΟΒΞη
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
(11, 100, 'ch', 'θ‘θε & θ₯Ώθ«θ¦', '', '<p>θ‘θεγζε€§ε©ιηγθ‘θεΉ²γηιΊ¦γζ©ε­γιΈ‘θγε₯ΆεΆεγθζ‘</p>', '', '/images_ch/Ordering_img01.jpg', '23.00', 0),
(12, 100, 'ch', 'ζ©ε‘', '', '<p>ε·§εει±γεε‘γε―ε―η²γιΈ‘θγε₯ΆεΆε</p>', '', '/images_ch/Ordering_img02.jpg', '23.00', 0),
(13, 100, 'ch', 'ζ ζͺ¬ι± & ζεΌθζΈ', '', '<p>ζ ζͺ¬γιΈ‘θγε₯ΆεΆεγι£η¨εθΆ</p>', '', '/images_ch/Ordering_img03.jpg', '23.00', 0),
(14, 100, 'ch', 'εδ»½ε·§εε', '', '<p>ε·§εεγιΈ‘θγε₯ΆεΆεγε―ε―η²</p>', '', '/images_ch/Ordering_img04.jpg', '23.00', 0),
(15, 100, 'ch', 'η»ΏθΆ & ε·§εε', '', '<p>η»ΏθΆγε·§εεγζδ»γιΈ‘θγε₯ΆεΆε</p>', '', '/images_ch/Ordering_img05.jpg', '23.00', 0),
(16, 100, 'ch', 'ηζ© & η½η²ε­', '', '<p>ζ©ε­γη½η²ε­γιΈ‘θγε₯ΆεΆε</p>', '', '/images_ch/Ordering_img06.jpg', '23.00', 0),
(17, 200, 'ch', 'ε·§εε & ι¦θ', '', '<p>ε·§εεγι¦θγζε§ιγη­ζζγιΈ‘θγε₯ΆεΆεγε―ε―η²</p>', 'ε¨δΈε¨δΊ', '/images_ch/Ordering_img07.jpg', '23.00', 0),
(18, 200, 'ch', 'ζδ» & ζ¨±ζ‘', '', '<p>ζδ»γεΉ²ζ΅ζγιΈ‘θγε₯ΆεΆε</p><h3>οΏ₯23/RMB</h3>', 'ε¨δΈε¨ε', '/images_ch/Ordering_img08.jpg', '23.00', 0),
(19, 200, 'ch', 'θζ & ηΎι¦ζ', '', '<p>ζ°ι²ηθζγηΎι¦ζγιΈ‘θγε₯ΆεΆε</p>', 'ε¨δΊε¨ε­', '/images_ch/Ordering_img09.jpg', '23.00', 0),
(20, 200, 'ch', 'ζ θ & ζ ζͺ¬', '', '<p>ζ θγιΈ‘θγε₯ΆεΆεγι£η¨εθΆ</p>', 'ε¨ζ₯', '/images_ch/Ordering_img10.jpg', '23.00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
