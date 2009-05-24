-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2009 at 12:48 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ns_matcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_model`
--

CREATE TABLE IF NOT EXISTS `data_model` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0',
  `price_id` int(11) NOT NULL default '0',
  `caliber_id` int(11) NOT NULL default '0',
  `style_id` int(11) NOT NULL default '0',
  `type` int(11) NOT NULL default '0',
  `weight` int(11) NOT NULL default '0',
  `min` int(11) NOT NULL default '0',
  `max` int(11) NOT NULL default '0',
  `ext_vol_type` int(11) NOT NULL default '0',
  `ext_vol_long` int(11) NOT NULL default '0',
  `ext_vol_wide` int(11) NOT NULL default '0',
  `ext_vol_flash` int(11) NOT NULL default '0',
  `ext_vol_notebook` int(11) NOT NULL default '0',
  `ext_vol_accessory` int(11) NOT NULL default '0',
  `created_at` datetime NOT NULL default '2000-01-01 00:00:00',
  `name` char(255) NOT NULL,
  `style` char(255) NOT NULL,
  `link` char(255) NOT NULL,
  `pic` char(255) NOT NULL,
  `caliber` char(255) NOT NULL,
  `detail` char(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `data_model`
--

INSERT INTO `data_model` (`id`, `product_id`, `price_id`, `caliber_id`, `style_id`, `type`, `weight`, `min`, `max`, `ext_vol_type`, `ext_vol_long`, `ext_vol_wide`, `ext_vol_flash`, `ext_vol_notebook`, `ext_vol_accessory`, `created_at`, `name`, `style`, `link`, `pic`, `caliber`, `detail`) VALUES
(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 11:15:51', '2', '', '', '', '', ''),
(2, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 11:34:10', 'fewe', '', '', '', '', ''),
(3, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 11:34:15', 'qwe32', '', '', '', '', ''),
(6, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 11:46:45', '美能达', '', '', '', '', ''),
(5, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 11:44:42', '大土鳖', '', '', '', '', ''),
(15, 100, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:17:24', '问我企鹅', '', '', '', '', ''),
(8, 0, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 11:47:21', '任天狗', '', '', '', '', ''),
(16, 100, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:17:40', '文风无法', '', '', '', '', ''),
(22, 0, 0, 0, 0, 800, 0, 101, 200, 0, 0, 0, 0, 0, 0, '2009-05-21 12:27:46', '', '', '', '', '', ''),
(23, 0, 0, 0, 0, 800, 0, 51, 100, 0, 0, 0, 0, 0, 0, '2009-05-21 12:29:36', '', '', '', '', '', ''),
(13, 200, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:11:57', '阿斯蒂芬', '', '', '', '', ''),
(14, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:16:19', '额外', '', '', '', '', ''),
(18, 100, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:17:53', '请问访问', '', '', '', '', ''),
(19, 100, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:18:27', '企鹅文法气温', '', '', '', '', ''),
(20, 100, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:19:33', '我企鹅发', '', '', '', '', ''),
(21, 100, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:19:50', '143432发送的', '', '', '', '', ''),
(24, 0, 0, 0, 0, 800, 0, 11, 50, 0, 0, 0, 0, 0, 0, '2009-05-21 12:30:32', '', '', '', '', '', ''),
(26, 0, 0, 0, 0, 800, 0, 0, 10, 0, 0, 0, 0, 0, 0, '2009-05-21 12:31:18', '', '', '', '', '', ''),
(27, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:32:27', '20', '', '', '', '', ''),
(28, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:32:33', '10', '', '', '', '', ''),
(29, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 12:33:10', '佳能', '', '', '', '', ''),
(115, 6, 0, 0, 38, 130, 23, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:30:58', '', '美能达 BB', '', '', '', ''),
(116, 6, 0, 0, 37, 130, 42, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:31:11', '', '美能达 CC', '', '', '', ''),
(117, 109, 0, 0, 36, 130, 41, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:31:22', '', '尼康 DD', '', '', '', ''),
(118, 110, 0, 0, 35, 130, 21, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:32:11', '', '卡西欧 521', '', '', '', ''),
(119, 112, 0, 0, 37, 130, 14, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:32:24', '', '松下 CC 133', '', '', '', ''),
(35, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 16:21:24', 'E', '', '', '', '', 'EEE'),
(36, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 16:21:30', 'D', '', '', '', '', 'DD'),
(37, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 16:21:39', 'C', '', '', '', '', 'CCC'),
(38, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 16:37:12', 'B', '', '', '', '', 'BBB'),
(39, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 16:37:24', 'A', '', '', '', '', 'AAAA'),
(42, 29, 0, 0, 37, 130, 34, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:18:16', '', '佳能 CC 52', '', '', '', ''),
(43, 6, 0, 0, 36, 130, 12, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:19:14', '', '美能达 D 12', '', '', '', ''),
(44, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:40:04', '50', '', '', '', '', ''),
(45, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:40:09', '100', '', '', '', '', ''),
(46, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:40:12', '200', '', '', '', '', ''),
(47, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:40:17', '500', '', '', '', '', ''),
(48, 0, 0, 0, 0, 700, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 17:40:21', '1000', '', '', '', '', ''),
(49, 0, 0, 0, 0, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:39:58', '佳能', '', '', '', '', ''),
(50, 0, 0, 0, 0, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:40:08', '尼康', '', '', '', '', ''),
(51, 0, 0, 0, 0, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:40:14', '宾得', '', '', '', '', ''),
(52, 0, 0, 0, 0, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:40:24', '美能达', '', '', '', '', ''),
(53, 0, 0, 0, 0, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:40:28', '富士', '', '', '', '', ''),
(54, 51, 0, 27, 0, 230, 423, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:40:53', '', 'AFE23', '', '', '', ''),
(55, 51, 0, 47, 0, 230, 85, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:41:18', '', 'FF44FF', '', '', '', ''),
(56, 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:44:31', '脚架1', '', '', '', '', ''),
(57, 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:44:35', '脚架2', '', '', '', '', ''),
(58, 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:44:39', '脚架3', '', '', '', '', ''),
(59, 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:44:42', '脚架4', '', '', '', '', ''),
(60, 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:44:45', '脚架5', '', '', '', '', ''),
(61, 0, 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 18:44:49', '脚架6', '', '', '', '', ''),
(62, 0, 0, 0, 0, 800, 0, 201, 500, 0, 0, 0, 0, 0, 0, '2009-05-21 21:29:20', '', '', '', '', '', ''),
(63, 300, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 21:45:33', 'UC', '', '', '', '', ''),
(64, 300, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 21:47:55', 'DD', '', '', '', '', ''),
(65, 300, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 21:48:14', '漫步者', '', '', '', '', ''),
(67, 56, 26, 22, 0, 330, 1122, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:23:44', '', 'aa', 'bb', '20090521/20090521-222344-7723.gif', '', ''),
(68, 56, 23, 24, 0, 330, 5544, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:29:48', '', 'AASSS', 'http://matcher.kk.com/matcher/admin/admin_dev.php/stand/model', '20090521/20090521-222948-5226.gif', '', ''),
(69, 300, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:39:45', '联想', '', '', '', '', ''),
(70, 300, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:39:53', '方正', '', '', '', '', ''),
(71, 300, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:40:00', '土鳖', '', '', '', '', ''),
(72, 56, 23, 22, 0, 330, 42, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:40:19', '', '111', 'http://leakon.com', '20090521/20090521-224019-9280.gif', '', ''),
(73, 56, 26, 22, 0, 330, 44, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 22:54:49', '', '113344', '44333', '20090521/20090521-230639-3149.gif', '', ''),
(74, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:15:58', '云台1', '', '', '', '', ''),
(75, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:16:02', '云台2', '', '', '', '', ''),
(76, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:16:05', '云台3', '', '', '', '', ''),
(77, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:16:09', '云台4', '', '', '', '', ''),
(78, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:16:12', '云台5', '', '', '', '', ''),
(79, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:16:16', '云台6', '', '', '', '', ''),
(80, 0, 0, 0, 0, 600, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:16:20', '云台7', '', '', '', '', ''),
(81, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:15', 'holder1', '', '', '', '', ''),
(82, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:19', 'holder2', '', '', '', '', ''),
(83, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:23', 'holder3', '', '', '', '', ''),
(84, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:29', 'holder4', '', '', '', '', ''),
(85, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:34', 'holder5', '', '', '', '', ''),
(86, 600, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:39', 'holder6', '', '', '', '', ''),
(87, 74, 23, 22, 0, 630, 123, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:17:52', '', '22', '333222', '20090521/20090521-231752-7573.gif', '', ''),
(88, 500, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:24:07', 'filter1', '', '', '', '', ''),
(89, 500, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:24:11', 'filter2', '', '', '', '', ''),
(90, 500, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:24:14', 'filter3', '', '', '', '', ''),
(91, 500, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:24:18', 'filter4', '', '', '', '', ''),
(92, 500, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:24:21', 'filter5', '', '', '', '', ''),
(93, 0, 0, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:30:23', '滤镜1', '', '', '', '', ''),
(94, 0, 0, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:30:26', '滤镜2', '', '', '', '', ''),
(95, 0, 0, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:30:29', '滤镜3', '', '', '', '', ''),
(96, 0, 0, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:30:33', '滤镜4', '', '', '', '', ''),
(97, 0, 0, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:30:36', '滤镜5', '', '', '', '', ''),
(98, 93, 26, 0, 0, 530, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:30:51', '', '22', '333', '20090521/20090521-233051-6035.gif', '44', ''),
(99, 0, 0, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:39:42', '摄影包1', '', '', '', '', ''),
(100, 0, 0, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:39:45', '摄影包2', '', '', '', '', ''),
(101, 0, 0, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:39:48', '摄影包3', '', '', '', '', ''),
(102, 0, 0, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:39:52', '摄影包4', '', '', '', '', ''),
(103, 0, 0, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:39:56', '摄影包5', '', '', '', '', ''),
(104, 400, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:40:38', 'bag1', '', '', '', '', ''),
(105, 400, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:40:43', 'bag2', '', '', '', '', ''),
(106, 400, 0, 0, 0, 900, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-21 23:40:48', 'bag3', '', '', '', '', ''),
(107, 101, 23, 0, 0, 430, 0, 0, 0, 36, 43, 44, 45, 46, 1, '2009-05-22 00:22:37', '', '1111方法', 'http://www.google.com', '20090522/20090522-002237-6800.gif', '77', ''),
(108, 99, 62, 0, 0, 430, 0, 0, 0, 35, 55, 66, 77, 88, 1, '2009-05-22 00:52:28', '', '高级货', 'http://www.baidu.com', '20090522/20090522-005228-7951.gif', '', ''),
(109, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-22 11:31:24', '尼康', '', '', '', '', ''),
(110, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-22 11:31:33', '卡西欧', '', '', '', '', ''),
(111, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-22 11:31:44', 'SONY', '', '', '', '', ''),
(112, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-22 11:31:52', '松下', '', '', '', '', ''),
(113, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-22 11:32:19', '柯达', '', '', '', '', ''),
(114, 29, 0, 0, 39, 130, 20, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-22 16:46:31', '', '佳能型号2', '', '', '', ''),
(120, 111, 0, 0, 35, 130, 26, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:32:57', '', 'SONY 84 EE', '', '', '', ''),
(121, 111, 0, 0, 36, 130, 9813, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:33:09', '', 'SONY DDD', '', '', '', ''),
(122, 112, 0, 0, 35, 130, 46, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:33:33', '', 'PANASONIC', '', '', '', ''),
(123, 113, 0, 0, 38, 130, 421, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:34:03', '', '柯达哒 EEE', '', '', '', ''),
(124, 113, 0, 0, 39, 130, 1333, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:34:25', '', '5824EECC', '', '', '', ''),
(125, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-24 16:40:23', 'F', '', '', '', '', 'FFFFFF'),
(126, 93, 24, 0, 0, 530, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-25 00:45:54', '', '滤镜 500 Kg', 'http://www.xuebaobao.com', '20090525/20090525-004634-8417.gif', '500', ''),
(127, 94, 23, 0, 0, 530, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2009-05-25 00:47:56', '', '滤镜2 200Kg', 'http://www.sina.com.cn', '20090525/20090525-004756-6434.gif', '200', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_session`
--

CREATE TABLE IF NOT EXISTS `data_session` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `sess_time` int(11) NOT NULL default '0',
  `sess_id` char(32) NOT NULL,
  `sess_data` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `sess_id` (`sess_id`),
  KEY `sess_time` (`sess_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `data_session`
--

INSERT INTO `data_session` (`id`, `user_id`, `sess_time`, `sess_id`, `sess_data`) VALUES
(20, 0, 1243181594, 'e05c56113be6252efa82eb57916f0933', 'symfony/user/sfUser/lastRequest|i:1243181594;symfony/user/sfUser/authenticated|b:0;symfony/user/sfUser/credentials|a:0:{}symfony/user/sfUser/attributes|a:3:{s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:5:"admin";s:4:"mail";s:0:"";}}symfony/user/sfUser/culture|s:2:"en";'),
(21, 1, 1243183677, '509ec5db5fd54e9776f4d6891b291744', 'symfony/user/sfUser/lastRequest|i:1243183677;symfony/user/sfUser/authenticated|b:1;symfony/user/sfUser/credentials|a:1:{i:0;s:6:"member";}symfony/user/sfUser/attributes|a:3:{s:25:"symfony/user/sfUser/flash";a:0:{}s:32:"symfony/user/sfUser/flash/remove";a:0:{}s:6:"member";a:3:{s:2:"id";s:1:"1";s:8:"username";s:5:"admin";s:4:"mail";s:0:"";}}symfony/user/sfUser/culture|s:2:"en";');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL default '0',
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `department` char(255) NOT NULL,
  `position` char(255) NOT NULL,
  `telephone` char(255) NOT NULL,
  `created_at` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `type`, `username`, `password`, `department`, `position`, `telephone`, `created_at`) VALUES
(1, 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '总裁办公室', 'CEO', '8888', '2009-05-24 15:26:11'),
(3, 0, 'user1', '81dc9bdb52d04dc20036dbd8313ed055', '市场部', '总监', '1234', '2009-05-24 14:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `map_tag`
--

CREATE TABLE IF NOT EXISTS `map_tag` (
  `id` int(11) NOT NULL auto_increment,
  `item_id` int(11) NOT NULL default '0',
  `tag_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `map_tag`
--

INSERT INTO `map_tag` (`id`, `item_id`, `tag_id`) VALUES
(1, 67, 63),
(2, 67, 64),
(3, 68, 63),
(4, 68, 64),
(5, 68, 65),
(6, 72, 65),
(7, 72, 69),
(8, 72, 70),
(9, 73, 69),
(10, 73, 70),
(11, 73, 71),
(12, 87, 81),
(13, 87, 82),
(14, 98, 89),
(15, 98, 90),
(16, 98, 91),
(17, 107, 104),
(18, 107, 106),
(19, 108, 105),
(20, 108, 106),
(21, 126, 89),
(22, 126, 91),
(23, 126, 92),
(24, 127, 88),
(25, 127, 89),
(26, 127, 91);
