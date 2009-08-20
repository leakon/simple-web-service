-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2009 at 02:22 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ns_cnro`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL default '0',
  `type_id` int(11) NOT NULL default '0',
  `style_id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  `range_id` int(11) NOT NULL default '0',
  `view_cnt` int(11) NOT NULL default '0',
  `order_num` int(11) NOT NULL default '0',
  `published` int(11) NOT NULL default '0',
  `is_private` int(11) NOT NULL default '0',
  `index_show` int(11) NOT NULL default '0',
  `created_at` datetime NOT NULL default '1980-01-01 00:00:00',
  `published_at` datetime NOT NULL default '1980-01-01 00:00:00',
  `title` char(255) NOT NULL,
  `pic` char(255) NOT NULL,
  `pic_desc` char(255) NOT NULL,
  `large_pic` char(255) NOT NULL,
  `large_pic_desc` char(255) NOT NULL,
  `keyword` char(255) NOT NULL,
  `vol_num` char(255) NOT NULL,
  `vol_num_all` char(255) NOT NULL,
  `pdf` char(255) NOT NULL,
  `detail` mediumtext NOT NULL,
  `params` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `category` (`category_id`,`published`,`published_at`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=828 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `type`, `type_id`, `style_id`, `category_id`, `range_id`, `view_cnt`, `order_num`, `published`, `is_private`, `index_show`, `created_at`, `published_at`, `title`, `pic`, `pic_desc`, `large_pic`, `large_pic_desc`, `keyword`, `vol_num`, `vol_num_all`, `pdf`, `detail`, `params`) VALUES
(806, 100, 0, 0, 1000044, 0, 0, 0, 0, 1, 0, '2009-06-01 22:54:23', '2009-06-10 00:00:00', '1111', '/uploads/article_images/00000806.GIF', '', '', '', '5555', '33', '44', '', '<p>666</p>', ''),
(807, 100, 0, 0, 1000044, 0, 0, 0, 0, 1, 0, '2009-06-01 22:56:24', '2009-06-10 00:00:00', '1111', '/uploads/images/00000807.gif', '', '', '', '5555', '33', '44', '', '<p>666</p>', ''),
(808, 100, 0, 0, 1000052, 0, 0, 0, 0, 1, 0, '2009-06-01 23:02:22', '2009-06-10 00:00:00', '1111', '/uploads/images/00000807.gif', '', '', '', '5555', '33', '44', '', '<p>666</p>', ''),
(809, 100, 0, 0, 1000052, 0, 0, 0, 0, 1, 1, '2009-06-01 23:13:37', '2009-06-10 00:00:00', '1111', '/uploads/images/00000807.gif', 'f3f3f34', '', '', '5555', '', '', '', '<p>666</p>', ''),
(810, 100, 0, 0, 1000052, 0, 0, 0, 0, 1, 1, '2009-06-01 23:15:32', '2009-06-10 00:00:00', '1111', '/uploads/images/00000807.gif', 'f3f3f34', '', '', '5555', '', '', '', '<p>666fqqefqewfq</p>', ''),
(811, 100, 0, 0, 1000052, 0, 0, 0, 0, 1, 1, '2009-06-01 23:15:44', '2009-06-10 00:00:00', '1111', '/uploads/images/00000807.gif', 'f3f3f34', '', '', '5555', '', '', '', '<p>666fqqefqewfq</p>', ''),
(812, 100, 0, 0, 1000052, 0, 0, 0, 0, 1, 1, '2009-06-01 23:16:07', '2009-06-10 00:00:00', '1111', '/uploads/images/00000807.gif', 'f3f3f34', '', '', '5555', '', '', '', '<p>666fqqefqewfq</p>', ''),
(813, 200, 1000092, 1000095, 1000048, 1000090, 0, 0, 1, 1, 1, '2009-06-01 23:32:59', '2009-06-17 00:00:00', '31131332', '/uploads/images/00000813.GIF', '人人人人人人人人人人', '', '', '王企鹅企鹅王', '', '', '', '<p>的发奋无法气温发起</p>', ''),
(814, 200, 1000094, 1000096, 1000048, 1000085, 0, 0, 1, 1, 0, '2009-06-01 23:36:01', '2009-06-01 00:00:00', '2343134', '34f3434', '', '', '', 'f3', '', '', '', '<p>34f违法企鹅文法气温</p>', '<p>去污粉我企鹅发我企鹅发其</p>'),
(815, 100, 0, 0, 1000052, 0, 0, 0, 0, 1, 1, '2009-06-02 10:51:13', '2009-06-19 00:00:00', '232323232', '/uploads/images/00000815.GIF', '', '', '', 'f3f3f', '', '', '', '<p>asdf33q43g343q4gegqegqw</p>', ''),
(816, 100, 0, 0, 1000069, 0, 0, 0, 0, 0, 1, '2009-06-07 13:07:09', '2009-06-16 00:00:00', '1234', '/uploads/images/00000816.gif', 'rrrrr', '', '', '234', '', '', '', '<p>ffa;j;alskjd;fakjd;lakjd;sakjfa;sddsa</p>\r\n<p>&nbsp;</p>\r\n<p><span style="border-collapse: separate; color: rgb(102, 102, 102); font-family: Arial; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;" class="Apple-style-span">\r\n<h3 style="margin: 0px 0px 10px 20px; padding: 0px; font-family: Arial,Helvetica,sans-serif; font-size: 14px; font-weight: bold; color: rgb(28, 116, 187);">产品规格和型号</h3>\r\n<table width="0" cellspacing="0" cellpadding="0" border="0" style="margin: 0px 0px 0px 20px; overflow: hidden; font-family: Arial,Helvetica,sans-serif; font-size: 12px; width: 640px; height: auto; border-collapse: collapse;" class="guige">\r\n    <tbody style="font-family: Arial,Helvetica,sans-serif;">\r\n        <tr style="font-family: Arial,Helvetica,sans-serif;">\r\n            <th style="border: 1px solid rgb(102, 102, 102); font-family: Arial,Helvetica,sans-serif; height: 39px; line-height: 39px; background-color: rgb(156, 156, 156); color: rgb(255, 255, 255); font-weight: bold; text-align: center;">型 号</th>\r\n            <th style="border: 1px solid rgb(102, 102, 102); font-family: Arial,Helvetica,sans-serif; height: 39px; line-height: 39px; background-color: rgb(156, 156, 156); color: rgb(255, 255, 255); font-weight: bold; text-align: center;">产氮量(95%时)</th>\r\n            <th style="border: 1px solid rgb(102, 102, 102); font-family: Arial,Helvetica,sans-serif; height: 39px; line-height: 39px; background-color: rgb(156, 156, 156); color: rgb(255, 255, 255); font-weight: bold; text-align: center;">供 电 要 求</th>\r\n            <th style="border: 1px solid rgb(102, 102, 102); font-family: Arial,Helvetica,sans-serif; height: 39px; line-height: 39px; background-color: rgb(156, 156, 156); color: rgb(255, 255, 255); font-weight: bold; text-align: center;">外 型 尺 寸( mm )</th>\r\n            <th style="border: 1px solid rgb(102, 102, 102); font-family: Arial,Helvetica,sans-serif; height: 39px; line-height: 39px; background-color: rgb(156, 156, 156); color: rgb(255, 255, 255); font-weight: bold; text-align: center;">重 量( kg )</th>\r\n        </tr>\r\n        <tr style="font-family: Arial,Helvetica,sans-serif;">\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">CA-06CP</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">6 Nm3/h</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">220v&plusmn;10%、1kW、50Hz</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">500&times;360&times;1500</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">60</td>\r\n        </tr>\r\n        <tr style="font-family: Arial,Helvetica,sans-serif;">\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">CA-12CP</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">12Nm3/h</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">220v&plusmn;10%、1kW、50Hz</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">700&times;600&times;1960</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">160</td>\r\n        </tr>\r\n        <tr style="font-family: Arial,Helvetica,sans-serif;">\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">CA-18CP</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">18Nm3/h</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">220v&plusmn;10%、1kW、50Hz</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">700&times;600&times;1960</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">170</td>\r\n        </tr>\r\n        <tr style="font-family: Arial,Helvetica,sans-serif;">\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">CA-24CP</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">24Nm3/h</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">220v&plusmn;10%、2kW、50Hz</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">700&times;600&times;1960</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">180</td>\r\n        </tr>\r\n        <tr style="font-family: Arial,Helvetica,sans-serif;">\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">CA-30CP</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">30Nm3/h</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">220v&plusmn;10%、2kW、50Hz</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">700&times;600&times;1960</td>\r\n            <td style="border: 1px solid rgb(178, 178, 178); padding: 10px 0px; font-family: Arial,Helvetica,sans-serif; font-size: 12px; text-align: center;">190</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</span></p>', ''),
(817, 220, 0, 0, 0, 1000090, 0, 0, 0, 1, 0, '2009-06-11 11:36:43', '2009-06-11 00:00:00', '222ee', '', '', '', '', '', '', '', '', '<p>飒飒的发</p>', ''),
(818, 220, 0, 0, 0, 1000083, 0, 0, 0, 0, 0, '2009-06-11 11:40:18', '2009-06-11 00:00:00', '111w', '222', '333', '', '', '4444', '', '', '', '<p>5555</p>', ''),
(819, 220, 0, 0, 0, 1000086, 0, 0, 0, 0, 0, '2009-06-11 13:02:11', '2009-06-11 00:00:00', 'feeee', '/uploads/images/00000819.upload_pic.gif', '4f44f4f4f4f4f4', '/uploads/images/00000819.upload_large_pic.GIF', '', '333333333334', '', '', '/uploads/images/00000819.upload_pdf.GIF', '<p>4444444444444444444444444444</p>', ''),
(820, 220, 1000093, 1000097, 0, 1000090, 0, 0, 0, 0, 0, '2009-06-11 13:56:13', '2009-06-11 00:00:00', '444444', 'fffff', '', '', '', '', '', '', '', '<p>f34f3f34f</p>', ''),
(821, 200, 1000093, 1000097, 0, 1000086, 17, 0, 1, 1, 0, '2009-06-11 13:58:15', '2009-06-11 00:00:00', '22223333', '/uploads/images/00000821.upload_pic.gif', '', '/uploads/images/00000821.upload_large_pic.GIF', '', '232323232', '', '', '/uploads/images/00000821.upload_pdf.doc', '<p>1231fr13123r13212312341234123412342134123</p>', '<p>1=2=3=4=5=6</p>'),
(822, 100, 0, 0, 1000065, 0, 0, 0, 0, 0, 0, '2009-06-11 14:50:08', '2009-06-11 00:00:00', '111', '222', '', '', '', '', '', '', '', '', ''),
(823, 220, 0, 0, 0, 1000054, 0, 0, 0, 0, 0, '2009-06-11 15:36:40', '2009-06-19 00:00:00', 'ttttttt', '/uploads/images/00000000.upload_pic.gif', '', '', '', '34343', '', '', '', '<p>fffff</p>', ''),
(824, 100, 0, 0, 1000066, 0, 0, 0, 0, 0, 0, '2009-06-11 15:43:20', '2009-06-11 00:00:00', '123412342134', '', '', '', '', '', '', '', '', '<p>sdfasdfsadfasdfsadfasdfadfsddssdsdfsdfdsfsd</p>', ''),
(825, 200, 1000092, 1000095, 0, 1000053, 0, 0, 1, 0, 0, '2009-06-11 21:47:03', '2009-06-11 00:00:00', '工业氮气', '', '', '/uploads/images/00000825.upload_large_pic.gif', '', '', '', '', '', '<p>工业氮气</p>\r\n<p>&nbsp;</p>\r\n<p>12341234</p>', ''),
(826, 200, 1000092, 1000095, 0, 1000054, 0, 0, 1, 0, 0, '2009-06-11 22:01:48', '2009-06-11 00:00:00', '果蔬与催熟', '', '', '/uploads/images/00000000.upload_large_pic.gif', '', '', '', '', '', '<p><a class="selected_category" id="id_cate_link_1000054" href="javascript:;">果蔬与催熟</a></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>asdf</p>', ''),
(827, 200, 1000092, 1000095, 0, 1000049, 0, 0, 1, 0, 0, '2009-06-11 22:02:27', '2009-06-11 00:00:00', '低氧健身', '', '', '/uploads/images/00000000.upload_large_pic.gif', '', '', '', '', '', '<p><a href="javascript:;" id="id_cate_link_1000049" class="selected_category">低氧健身</a></p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `order_num` int(11) NOT NULL default '0',
  `name` char(80) NOT NULL,
  `pic` char(255) NOT NULL,
  `banner_pic` char(255) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000137 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `type`, `parent_id`, `order_num`, `name`, `pic`, `banner_pic`, `description`) VALUES
(1, 100, 0, 9105, '资讯动态', '', '', ''),
(1000044, 100, 1000003, 0, '乐扣乐扣', '', '', ''),
(1000045, 100, 1000003, 0, '1234', '', '', ''),
(1000048, 200, 0, 0, '家电', '', '', ''),
(1000049, 220, 0, 3, '低氧健身', '/images/pic146x197.jpg', '', '<p><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;"><span class="Apple-style-span" style="color: rgb(102, 102, 102); font-size: 12px; text-align: left;">\r\n<h1>低氧健身</h1>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">天津市森罗科技发展有限责任公司是专业进行气调贮藏设备研制、生产的企业，是国内首家通过ISO9001：2000国际质量体系认证的气调设备生产厂家。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">主要产品有：CA系列中空纤维膜制氮机、CT系列二氧化碳脱除机、CY系列乙烯脱除机、乙烯发生器、便携式氧和二氧化碳气体检测仪、便携式乙烯检测仪、库气检测控制系统、气调参数试验产品、全套气调库配套产品及乙烯吸附袋、乙烯过滤网、集装箱用一体化气调机，共一百多种型号。产品适用于50吨～10000吨气调库使用，目前已应用于全国16个省市，用户130余家。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">2002年以来获&ldquo;中空纤维膜制氮机&rdquo;、&ldquo;O2和CO2测试仪&rdquo;等产品专利11项。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">2002年编制发布执行&ldquo;中空纤维膜制氮机&rdquo;和&ldquo;O2和CO2测试仪&rdquo;等产品系列标准，标准已通过天津市技术监督局评审及备案。</p>\r\n</span></span></p>'),
(1000051, 200, 1000048, 0, '1122', '', '', ''),
(1000052, 100, 1000003, 0, '燕山石化', '', '', ''),
(1000053, 220, 0, 1, '工业氮气', '/images/pic123x184.jpg', '', '<p><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;"><span class="Apple-style-span" style="color: rgb(102, 102, 102); font-size: 12px; text-align: left;">\r\n<h1>工业氮气</h1>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">天津市森罗科技发展有限责任公司是专业进行气调贮藏设备研制、生产的企业，是国内首家通过ISO9001：2000国际质量体系认证的气调设备生产厂家。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">主要产品有：CA系列中空纤维膜制氮机、CT系列二氧化碳脱除机、CY系列乙烯脱除机、乙烯发生器、便携式氧和二氧化碳气体检测仪、便携式乙烯检测仪、库气检测控制系统、气调参数试验产品、全套气调库配套产品及乙烯吸附袋、乙烯过滤网、集装箱用一体化气调机，共一百多种型号。产品适用于50吨～10000吨气调库使用，目前已应用于全国16个省市，用户130余家。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">2002年以来获&ldquo;中空纤维膜制氮机&rdquo;、&ldquo;O2和CO2测试仪&rdquo;等产品专利11项。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">2002年编制发布执行&ldquo;中空纤维膜制氮机&rdquo;和&ldquo;O2和CO2测试仪&rdquo;等产品系列标准，标准已通过天津市技术监督局评审及备案。</p>\r\n</span></span></p>'),
(1000054, 220, 0, 2, '果蔬与催熟', '/images/pic152x180.jpg', '', '<p><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;"><span class="Apple-style-span" style="color: rgb(102, 102, 102); font-size: 12px; text-align: left;">\r\n<h1>果蔬与催熟</h1>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">天津市森罗科技发展有限责任公司是专业进行气调贮藏设备研制、生产的企业，是国内首家通过ISO9001：2000国际质量体系认证的气调设备生产厂家。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">主要产品有：CA系列中空纤维膜制氮机、CT系列二氧化碳脱除机、CY系列乙烯脱除机、乙烯发生器、便携式氧和二氧化碳气体检测仪、便携式乙烯检测仪、库气检测控制系统、气调参数试验产品、全套气调库配套产品及乙烯吸附袋、乙烯过滤网、集装箱用一体化气调机，共一百多种型号。产品适用于50吨～10000吨气调库使用，目前已应用于全国16个省市，用户130余家。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">2002年以来获&ldquo;中空纤维膜制氮机&rdquo;、&ldquo;O2和CO2测试仪&rdquo;等产品专利11项。</p>\r\n<p style="border-width: 0px; margin: 0px 0px 15px; padding: 0px 10px; font-family: Arial,Helvetica,sans-serif; line-height: 22px; font-size: 14px;">2002年编制发布执行&ldquo;中空纤维膜制氮机&rdquo;和&ldquo;O2和CO2测试仪&rdquo;等产品系列标准，标准已通过天津市技术监督局评审及备案。</p>\r\n</span></span></p>'),
(1000079, 220, 1000053, 11, '船用氮气', '', '', ''),
(1000080, 220, 1000053, 12, '石油天然气', '', '', ''),
(1000058, 100, 0, 106, '关于我们', '', '', ''),
(1000059, 100, 0, 102, '资讯中心', '', '', ''),
(1000061, 100, 0, 104, '业务范围', '', '', ''),
(1000062, 100, 1000058, 0, '行业资质', '', '', ''),
(1000063, 100, 1000058, 0, '企业优势', '', '', ''),
(1000064, 100, 1000058, 0, '企业荣誉', '', '', ''),
(1000065, 100, 1000058, 0, '企业文化', '', '', ''),
(1000066, 100, 1000058, 0, '组织结构', '', '', ''),
(1000067, 100, 1000059, 0, '公司新闻', '', '', ''),
(1000068, 100, 1000059, 0, '技术资讯', '', '', ''),
(1000069, 100, 1000059, 0, '媒体报道', '', '', ''),
(1000073, 100, 1000061, 0, '应用领域', '', '', ''),
(1000074, 100, 1000061, 0, '服务流程', '', '', ''),
(1000075, 100, 1000061, 0, '工程实例', '', '', ''),
(1000076, 100, 1000061, 0, '国内业务', '', '', ''),
(1000077, 100, 1000061, 0, '质量认证', '', '', ''),
(1000081, 220, 1000053, 13, '航空航天', '', '', ''),
(1000082, 220, 1000053, 14, '消防用氮气', '', '', ''),
(1000083, 220, 1000054, 0, '气调保鲜系统', '', '', ''),
(1000084, 220, 1000054, 0, '气调试验设备', '', '', ''),
(1000085, 220, 1000054, 0, '船用气调保鲜设备', '', '', ''),
(1000086, 220, 1000054, 0, '粮食贮藏系统', '', '', ''),
(1000087, 220, 1000054, 0, '催熟设备', '', '', ''),
(1000088, 220, 1000049, 0, '低氧减肥、健身', '', '', ''),
(1000089, 220, 1000049, 0, '高原适应训练', '', '', ''),
(1000090, 220, 1000049, 0, '生理机能调节', '', '', ''),
(1000091, 220, 1000049, 0, '专业运动训练', '', '', ''),
(1000092, 400, 0, 1, '类别1', '', '', ''),
(1000093, 400, 0, 2, '类别2', '', '', ''),
(1000094, 400, 0, 3, '类别3', '', '', ''),
(1000095, 500, 0, 1, '型号1', '', '', ''),
(1000096, 500, 0, 2, '型号2', '', '', ''),
(1000097, 500, 0, 3, '型号3', '', '', ''),
(1000098, 100, 0, 107, '加入我们', '', '', ''),
(1000099, 100, 1000098, 1, '招聘信息', '', '', ''),
(1000100, 100, 1000098, 2, '人才理念', '', '', ''),
(1000101, 100, 1000098, 3, '酬薪福利', '', '', ''),
(1000103, 220, 1000084, 0, '气调试验1', '', '', ''),
(1000104, 220, 1000079, 1, '货油舱的惰化', '', '', ''),
(1000105, 220, 1000079, 2, '船用保鲜', '', '', ''),
(1000106, 220, 1000080, 1, '油气管道吹扫', '', '', ''),
(1000107, 220, 1000080, 2, '油气管道的打压检漏', '', '', ''),
(1000108, 220, 1000080, 3, '氮气封舱', '', '', ''),
(1000110, 220, 1000080, 4, '油气田的三次开采', '', '', ''),
(1000111, 220, 1000081, 1, '红外节流制冷用气', '', '', ''),
(1000112, 220, 1000081, 2, '机场用气（氮气和氧气）', '', '', ''),
(1000113, 220, 1000081, 3, '露点测量', '', '', ''),
(1000114, 220, 1000082, 1, '船用制氮系统', '', '', ''),
(1000115, 220, 1000082, 2, '车载制氮系统', '', '', ''),
(1000116, 220, 1000082, 3, '箱式制氮系统', '', '', ''),
(1000117, 220, 1000082, 4, '船用保鲜系统', '', '', ''),
(1000118, 220, 1000082, 6, '露点测试仪', '', '', ''),
(1000119, 220, 1000082, 5, '氧气测试仪', '', '', ''),
(1000120, 220, 1000087, 0, '催熟1', '', '', ''),
(1000121, 220, 1000087, 0, '催熟2', '', '', ''),
(1000122, 220, 1000086, 0, '粮食1', '', '', ''),
(1000123, 220, 1000086, 0, '粮食2', '', '', ''),
(1000124, 220, 1000085, 0, '船用气调1', '', '', ''),
(1000125, 220, 1000085, 0, '船用气调2', '', '', ''),
(1000126, 220, 1000084, 0, '气调试验2', '', '', ''),
(1000127, 220, 1000083, 0, '气调保鲜1', '', '', ''),
(1000128, 220, 1000083, 0, '气调保鲜2', '', '', ''),
(1000129, 220, 1000091, 0, '专业运动1', '', '', ''),
(1000130, 220, 1000091, 0, '专业运动2', '', '', ''),
(1000131, 220, 1000090, 0, '生理机能1', '', '', ''),
(1000132, 220, 1000090, 0, '生理机能2', '', '', ''),
(1000133, 220, 1000089, 0, '高原适应1', '', '', ''),
(1000134, 220, 1000089, 0, '高原适应2', '', '', ''),
(1000135, 220, 1000088, 0, '低氧减肥1', '', '', ''),
(1000136, 220, 1000088, 0, '低氧减肥2', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `is_published` int(11) NOT NULL default '0',
  `gender` int(11) NOT NULL default '0',
  `created_at` datetime NOT NULL default '2000-01-01 00:00:00',
  `remote_addr` char(255) NOT NULL,
  `name` char(255) NOT NULL,
  `location` char(255) NOT NULL,
  `mail` char(255) NOT NULL,
  `phone` char(255) NOT NULL,
  `title` char(255) NOT NULL,
  `message` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `is_published`, `gender`, `created_at`, `remote_addr`, `name`, `location`, `mail`, `phone`, `title`, `message`) VALUES
(1, 0, 0, '2009-06-03 20:55:56', '127.0.0.1', '', '', '', '', '', '6666'),
(2, 0, 0, '2009-06-03 20:56:48', '127.0.0.1', '', '', '', '', '', '666'),
(3, 0, 0, '2009-06-03 20:58:36', '127.0.0.1', '111', '222', '333', '444', '555', '666'),
(4, 0, 1, '2009-06-03 20:58:50', '127.0.0.1', '', '', '', '', '', ''),
(5, 0, 1, '2009-06-03 21:09:00', '127.0.0.1', '11', '22', '33', '55', '66', '个任务二哥温热'),
(6, 0, 0, '2009-06-03 21:18:32', '127.0.0.1', '', '', '', '', '', ''),
(7, 0, 0, '2009-06-03 21:48:25', '127.0.0.1', '', '', '', '', '', 'eq'),
(10, 0, 0, '2009-06-03 22:04:52', '127.0.0.1', 'fasdfadsf', 'dsf', 'dsfa', 'asdfs', '**asdfasdf', '**1**dasfdasdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL default '0',
  `username` char(255) NOT NULL,
  `password` char(32) NOT NULL,
  `mail` char(255) NOT NULL,
  `question` char(255) NOT NULL,
  `answer` char(255) NOT NULL,
  `birthday` date NOT NULL default '2000-01-01',
  `created_at` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `username`, `password`, `mail`, `question`, `answer`, `birthday`, `created_at`) VALUES
(1, 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', '1111', '123456', '2009-06-04', '2000-01-01 00:00:00'),
(2, 0, 'assddd', 'e10adc3949ba59abbe56e057f20f883e', '', '23232', '2224fff', '2009-06-24', '2009-06-01 23:50:11'),
(3, 0, '1111111', 'ed2b1f468c5f915f3f1cf75d7068baae', '', '12341234', '12341234', '2009-06-14', '2009-06-02 08:41:10');
