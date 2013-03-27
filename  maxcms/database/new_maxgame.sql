-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 13, 2013 at 10:53 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `new_maxgame`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin_nqt_settings`
-- 

DROP TABLE IF EXISTS `admin_nqt_settings`;
CREATE TABLE IF NOT EXISTS `admin_nqt_settings` (
  `id` int(11) NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `admin_nqt_settings`
-- 

INSERT INTO `admin_nqt_settings` VALUES (1, 'title-admincp', 'maxgame news', '2013-03-07 14:54:45');

-- --------------------------------------------------------

-- 
-- Table structure for table `admin_nqt_users`
-- 

DROP TABLE IF EXISTS `admin_nqt_users`;
CREATE TABLE IF NOT EXISTS `admin_nqt_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `custom_permission` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `created` datetime NOT NULL,
  `autobay` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `admin_nqt_users`
-- 

INSERT INTO `admin_nqt_users` VALUES (1, 'root', '2813ba16cd7d0b1e73f201f91393c5a1', 1, '2|rwd,1|rwd,3|rwd,4|rwd,5|rwd,17|rwd,40|rwd,49|rwd,50|rwd,18|rwd,19|rwd,20|rwd,23|rwd,24|rwd,25|rwd,27|rwd,28|rwd,29|rwd,15|rwd,30|rwd,35|rwd,36|rwd,53|rwd,54|rwd,55|rwd,59|rwd,60|rwd,7|rwd', 0, 1, '2012-08-28 14:52:42', 1);
INSERT INTO `admin_nqt_users` VALUES (2, 'admin', '2813ba16cd7d0b1e73f201f91393c5a1', 1, '2|rwd,1|rwd,3|rwd,4|rwd,5|rwd,17|rwd,40|rwd,49|rwd,50|rwd,18|rwd,19|rwd,20|rwd,23|rwd,24|rwd,25|rwd,27|rwd,28|rwd,29|rwd,15|rwd,30|rwd,35|rwd,36|rwd,53|rwd,54|rwd,55|rwd,59|rwd,60|rwd,7|rwd', 0, 1, '2012-08-28 14:52:59', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `cli_banner_position`
-- 

DROP TABLE IF EXISTS `cli_banner_position`;
CREATE TABLE IF NOT EXISTS `cli_banner_position` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `cli_banner_position`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `cli_category_news`
-- 

DROP TABLE IF EXISTS `cli_category_news`;
CREATE TABLE IF NOT EXISTS `cli_category_news` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `type` int(11) default '1' COMMENT '1-Tin tuc | 2 Kinh nghiem',
  `name` varchar(255) default NULL,
  `slug` varchar(255) default NULL,
  `order` int(11) default '0',
  `created` datetime default NULL,
  `changed` datetime default NULL,
  `status` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `cli_category_news`
-- 

INSERT INTO `cli_category_news` VALUES (1, 34, 1, 'Game Online', 'game-online', 1, '2013-03-06 10:42:26', '2013-03-06 10:42:26', 1);
INSERT INTO `cli_category_news` VALUES (2, 34, 1, 'eSport', 'esport', 2, '2013-03-06 10:43:10', '2013-03-06 10:43:10', 1);
INSERT INTO `cli_category_news` VALUES (3, 34, 1, 'PC & Console', 'pc-&-console', 3, '2013-03-06 10:44:50', '2013-03-06 10:44:50', 1);
INSERT INTO `cli_category_news` VALUES (4, 34, 1, 'Bạn đọc viết', 'ban-doc-viet', 4, '2013-03-06 10:45:05', '2013-03-06 10:45:05', 1);
INSERT INTO `cli_category_news` VALUES (5, 34, 1, 'Vui Đọc', 'vui-doc', 5, '2013-03-06 10:45:15', '2013-03-06 10:45:15', 1);
INSERT INTO `cli_category_news` VALUES (6, 34, 2, 'Gái đẹp', 'gai-dep', 6, '2013-03-06 10:45:23', '2013-03-06 11:27:59', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `cli_comment`
-- 

DROP TABLE IF EXISTS `cli_comment`;
CREATE TABLE IF NOT EXISTS `cli_comment` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `new_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(10) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `cli_comment`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `cli_join_tags`
-- 

DROP TABLE IF EXISTS `cli_join_tags`;
CREATE TABLE IF NOT EXISTS `cli_join_tags` (
  `id` int(11) NOT NULL auto_increment,
  `item_id` int(11) default '0',
  `tags_id` int(11) default '0',
  `created` datetime default NULL,
  `status` tinyint(4) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `cli_join_tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `cli_tags`
-- 

DROP TABLE IF EXISTS `cli_tags`;
CREATE TABLE IF NOT EXISTS `cli_tags` (
  `id` int(11) NOT NULL auto_increment,
  `tags` varchar(255) default NULL,
  `slug` varchar(255) default NULL,
  `created` datetime default NULL,
  `status` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `cli_tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `cli_user`
-- 

DROP TABLE IF EXISTS `cli_user`;
CREATE TABLE IF NOT EXISTS `cli_user` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) default '4',
  `type` varchar(64) default NULL COMMENT '1:LOCAL-2:FB',
  `fb_id` varchar(64) default '0',
  `permission` text,
  `custom_permission` tinyint(1) default NULL,
  `district_id` int(11) default NULL,
  `province_id` int(11) default NULL,
  `email` varchar(64) default NULL,
  `password` varchar(32) default NULL,
  `fullname` varchar(100) default NULL,
  `phone` varchar(16) default NULL COMMENT 'Điện thoại di động',
  `number` varchar(16) default NULL COMMENT 'Điện thoại bàn',
  `fax` varchar(16) default NULL,
  `address` text,
  `avatar` varchar(100) default NULL,
  `birthday` date default NULL,
  `sex` tinyint(1) default NULL,
  `intro` text,
  `autobay` tinyint(1) default NULL,
  `longitude` double default NULL,
  `latitude` double default NULL,
  `cookie` varchar(100) default NULL,
  `randomkey` varchar(100) default NULL,
  `history_ip` text,
  `status` tinyint(1) default '1',
  `created` datetime default NULL,
  `changed` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11310 ;

-- 
-- Dumping data for table `cli_user`
-- 

INSERT INTO `cli_user` VALUES (1, 1, '1', '0', '59|rwd,51|rwd,39|rwd,53|rwd,41|rwd,42|rwd,9|rwd,56|rwd,57|rwd,58|rwd,18|rwd,65|rwd,19|rwd,20|rwd,35|rwd,36|rwd,21|rwd,22|rwd,23|rwd,24|rwd,64|rwd,25|rwd,43|rwd,26|rwd,55|rwd,69|rwd,27|rwd,28|rwd,29|rwd,30|rwd,44|rwd,45|rwd,31|rwd,46|rwd,13|rwd,37|rwd,66|rwd,61|rwd,14|rwd,15|rwd,32|rwd,8|rwd,12|rwd,16|rwd,40|rwd,33|rwd,5|rwd,6|rwd,34|rwd,47|rwd,17|rwd,2|rwd,1|rwd,4|rwd,3|rwd,54|rwd,67|rwd,50|rwd,7|rwd,52|rwd,48|rwd,68|rwd,10|rwd,62|rwd,60|rwd,38|rwd,63|rwd,49|rwd', 0, 1, 8, 'admin', '2813ba16cd7d0b1e73f201f91393c5a1', 'Auto', '0938 234 333', '0838 234 333', '(08) 38 234 986 ', 'Lầu 4, Tòa nhà Yoco 41 Nguyễn Thị Minh Khai, P.Bến Nghé, Q.1, TP.HCM', '6262c0ce4af9c82f0a1395cad8670926.jpg', '1969-01-24', 1, '<br />\n\n\n\n\n\n\n\n', 1, 0, 0, '419e0d08d46fad9a40c18516a960571cdd2bc5e929ab56371a0b3f413f862b93', '91815d7cc972c9426e97b94389b386148b7b8ed7fd2763c42af6dc9468b1d5ec', '{"127.0.0.1":7,"14.161.37.54":7}', 1, '2009-11-27 14:33:14', '2009-11-27 14:33:14');
INSERT INTO `cli_user` VALUES (2, NULL, '1', '0', NULL, NULL, 1, 1, 'root@yahoo.com', '2813ba16cd7d0b1e73f201f91393c5a1', '', '', '', '', '', '', '1970-01-01', 1, NULL, 0, 0, 0, '4f6ff0e835302cb84194f172c212c0162a804b6448dd5e491c7cd7fcf757a758', '521c4a3bab08a703e21ab882fc0422daf9a6acc0a6bf0bfc61ca9d1623ec1762', NULL, 1, '2011-04-21 10:10:31', '2011-04-21 10:10:31');

-- --------------------------------------------------------

-- 
-- Table structure for table `news_2013_03`
-- 

DROP TABLE IF EXISTS `news_2013_03`;
CREATE TABLE IF NOT EXISTS `news_2013_03` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default '0' COMMENT 'category_news',
  `user_id` int(11) default '0',
  `image` varchar(255) default NULL,
  `video` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `slug` varchar(255) default NULL,
  `tinnoibat` tinyint(10) NOT NULL,
  `description` text,
  `content` text,
  `datepost` datetime default NULL,
  `created` datetime default NULL,
  `changed` datetime default NULL,
  `status` tinyint(1) default '1',
  `order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Dumping data for table `news_2013_03`
-- 

INSERT INTO `news_2013_03` VALUES (1, 3, 1, '2013/03/b002a49b4132582570443e3b494e73e1_1362541757.jpg', '0', 'xcvxcvcxvcx', 'xcvxcvcxvcx', 0, 'xcvxcv', 'xcvxcvcx', '2013-03-06 00:00:00', '2013-03-06 10:49:17', '2013-03-06 10:49:17', 1, 0);
INSERT INTO `news_2013_03` VALUES (2, 1, 1, '2013/03/5bfa830971d9a506a02b0fcaf42a9d6e_1362542464.jpg', '0', 'CSGT bụng phệ, thô lỗ không được ra đường', 'csgt-bung-phe,-tho-lo-khong-duoc-ra-duong', 0, 'CSGT bụng phệ, thô lỗ không được ra đường', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/xa-hoi/csgt-bung-phe-tho-lo-khong-duoc-ra-duong/a306116.html#home_tintop" title="CSGT bụng phệ, thô lỗ không được ra đường" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">CSGT bụng phệ, thô lỗ không được ra đường</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:01:04', '2013-03-06 11:01:04', 1, 0);
INSERT INTO `news_2013_03` VALUES (3, 1, 1, '2013/03/7aab58dfa5ec9f5c807945b2f53ea254_1362542496.jpg', '0', 'Người dân nghẹn ngào tiếc thương nhà lãnh đạo Chavez', 'nguoi-dan-nghen-ngao-tiec-thuong-nha-lanh-dao-chavez', 0, 'Người dân nghẹn ngào tiếc thương nhà lãnh đạo Chavez', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/the-gioi/nguoi-dan-nghen-ngao-tiec-thuong-nha-lanh-dao-chavez/a306104.html#home_tintop" title="Người dân nghẹn ngào tiếc thương nhà lãnh đạo Chavez" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: underline; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Người dân nghẹn ngào tiếc thương nhà lãnh đạo Chavez</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:01:36', '2013-03-06 11:01:36', 1, 0);
INSERT INTO `news_2013_03` VALUES (4, 2, 1, '2013/03/2b7da3dcdc081fca207593a8a395d327_1362542523.jpg', '0', 'Mua giấy bạc 10.000 đồng với giá 50.000 đồng', 'mua-giay-bac-10000-dong-voi-gia-50000-dong', 0, 'Mua giấy bạc 10.000 đồng với giá 50.000 đồng', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/kinh-doanh/mua-giay-bac-10000-dong-voi-gia-50000-dong/a306110.html#home_tintop" title="Mua giấy bạc 10.000 đồng với giá 50.000 đồng" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Mua giấy bạc 10.000 đồng với giá 50.000 đồng</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:02:03', '2013-03-06 11:02:03', 1, 0);
INSERT INTO `news_2013_03` VALUES (5, 2, 1, '', '0', 'Clip Dortmund &#039;hủy diệt&#039; Shakhtar Donetsk', 'clip-dortmund-&#039;huy-diet&#039;-shakhtar-donetsk', 0, 'Clip Dortmund ''hủy diệt'' Shakhtar Donetsk', '<h2 style="margin: 0px 0px 0px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: nowrap; text-overflow: ellipsis; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/the-thao-quoc-te/clip-dortmund-huy-diet-shakhtar-donetsk/a306125.html#home_tinchinh" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: normal; background-position: initial initial; background-repeat: initial initial;">Clip Dortmund ''hủy diệt'' Shakhtar Donetsk</a><span class="icn_camcorder icn" style="margin: 0px 0px 0px 5px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-image: url(http://static2.news.zing.vn/v3/images/icon_sprt_1.01.png); background-color: transparent; display: inline-block; line-height: normal; text-indent: -9999em; position: relative; top: 2px; width: 20px; height: 14px; background-position: 0px -112px; background-repeat: no-repeat no-repeat;"><br></span></h2>', '2013-03-06 00:00:00', '2013-03-06 11:02:35', '2013-03-06 11:02:35', 1, 0);
INSERT INTO `news_2013_03` VALUES (6, 4, 1, '', '0', 'Dùng thử Samsung Galaxy Grand 5 inch mới bán tại VN', 'dung-thu-samsung-galaxy-grand-5-inch-moi-ban-tai-vn', 0, 'Dùng thử Samsung Galaxy Grand 5 inch mới bán tại VN', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/thiet-bi-so/dung-thu-samsung-galaxy-grand-5-inch-moi-ban-tai-vn/a305971.html#home_tintop" title="Dùng thử Samsung Galaxy Grand 5 inch mới bán tại VN" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Dùng thử Samsung Galaxy Grand 5 inch mới bán tại VN</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:04:01', '2013-03-06 11:04:01', 1, 0);
INSERT INTO `news_2013_03` VALUES (7, 5, 1, '', 'Siêu xe mạnh nhất lịch sử Ferrari trình làng', 'Siêu xe mạnh nhất lịch sử Ferrari trình làng', 'sieu-xe-manh-nhat-lich-su-ferrari-trinh-lang', 0, 'Siêu xe mạnh nhất lịch sử Ferrari trình làng', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/the-gioi-xe/sieu-xe-manh-nhat-lich-su-ferrari-trinh-lang/a306082.html#home_tintop" title="Siêu xe mạnh nhất lịch sử Ferrari trình làng" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Siêu xe mạnh nhất lịch sử Ferrari trình làng</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:04:21', '2013-03-06 11:04:21', 1, 0);
INSERT INTO `news_2013_03` VALUES (8, 6, 1, '', '0', 'Midu rạng rỡ bên &#039;bản sao Angela Phương Trinh&#039;', 'midu-rang-ro-ben-&#039;ban-sao-angela-phuong-trinh&#039;', 0, 'Midu rạng rỡ bên ''bản sao Angela Phương Trinh''', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/chieu-rap/midu-rang-ro-ben-ban-sao-angela-phuong-trinh/a306128.html#home_tintop" title="Midu rạng rỡ bên ''bản sao Angela Phương Trinh''" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Midu rạng rỡ bên ''bản sao Angela Phương Trinh''</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:04:45', '2013-03-06 11:04:45', 1, 0);
INSERT INTO `news_2013_03` VALUES (9, 1, 1, '', '0', 'Những chàng trai &#039;đòi&#039; đi nghĩa vụ quân sự', 'nhung-chang-trai-&#039;doi&#039;-di-nghia-vu-quan-su', 0, 'Những chàng trai ''đòi'' đi nghĩa vụ quân sự', '<h2 style="margin: 0px 0px 5px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: hidden; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/nhip-song-tre/nhung-chang-trai-doi-di-nghia-vu-quan-su/a306121.html#home_tintop" title="Những chàng trai ''đòi'' đi nghĩa vụ quân sự" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: underline; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Những chàng trai ''đòi'' đi nghĩa vụ quân sự</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:05:56', '2013-03-06 11:05:56', 1, 0);
INSERT INTO `news_2013_03` VALUES (10, 1, 1, '', '0', 'Ngày 8/3: Xem clip đánh thức những người con vô tâm', 'ngay-8/3:-xem-clip-danh-thuc-nhung-nguoi-con-vo-tam', 1, 'Ngày 8/3: Xem clip đánh thức những người con vô tâm', '<h2 style="margin: 0px 0px 0px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: visible; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/nhip-song-tre/ngay-83-xem-clip-danh-thuc-nhung-nguoi-con-vo-tam/a306150.html#home_tinchinh" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Ngày 8/3: Xem clip đánh thức những người con vô tâm</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:06:11', '2013-03-06 18:17:45', 1, 0);
INSERT INTO `news_2013_03` VALUES (11, 1, 1, '', '0', 'Đội tàu chiến hiện đại Việt Nam tại Cam Ranh', 'doi-tau-chien-hien-dai-viet-nam-tai-cam-ranh', 1, 'Đội tàu chiến hiện đại Việt Nam tại Cam Ranh', '<h2 style="margin: 0px 0px 0px 14px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; background-color: rgb(255, 255, 255); overflow: visible; white-space: normal; color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;"><a href="http://news.zing.vn/quan-su/doi-tau-chien-hien-dai-viet-nam-tai-cam-ranh/a306151.html#home_tinchinh" class="news_title" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 9pt; background-color: transparent; color: rgb(0, 0, 0); text-decoration: none; font-weight: bold; background-position: initial initial; background-repeat: initial initial;">Đội tàu chiến hiện đại Việt Nam tại Cam Ranh</a><br></h2>', '2013-03-06 00:00:00', '2013-03-06 11:07:06', '2013-03-06 18:17:40', 1, 0);
INSERT INTO `news_2013_03` VALUES (12, 1, 1, '', NULL, 'Tàu sân bay Liêu Ninh được đưa vào sử dụng trong một khu vực mà ở đó đang có cả ', 'tau-san-bay-lieu-ninh-duoc-dua-vao-su-dung-trong-mot-khu-vuc-ma-o-do-dang-co-ca', 1, 'Tàu sân bay Liêu Ninh được đưa vào sử dụng trong một khu vực mà ở đó đang có cả ', '<span style="color: rgb(85, 85, 85); font-family: Arial, Tahoma; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 16px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;">Tàu sân bay Liêu Ninh được đưa vào sử dụng trong một khu vực mà ở đó đang có cả<span class="Apple-converted-space"> <br><br></span></span>', '2013-03-06 00:00:00', '2013-03-06 16:30:25', '2013-03-06 18:17:30', 1, 0);
INSERT INTO `news_2013_03` VALUES (13, 6, 1, '2013/03/8ac5cb0cd1532d5769808f8221fe5476_1362583680.jpg', NULL, 'Chung Thục Quyên tự tin chụp ảnh khỏa thân', 'chung-thuc-quyen-tu-tin-chup-anh-khoa-than', 1, 'Tin vào vẻ đẹp hình thể của một người mẫu cùng khả năng tự stylist, chân dài sinh năm 1987 quyết định tung ra bộ ảnh nude vô cùng gợi cảm.', '<p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;" align="center">Chung Thục Quyên<span class="Apple-converted-space">&nbsp;</span>cho biết cô chụp nude đơn giản vì thích và nghĩ, một người mẫu cần phải đa dạng hình ảnh. Cô nói: "Trên thế giới có rất nhiều người mẫu chụp nude. Việc chụp nude đối với người mẫu như một cách làm đa dạng thêm hình ảnh của mình. Tôi là người mẫu, tự tin vào vẻ đẹp hình thể, vả lại, tôi cùng ê-kíp thực hiện hình ảnh cũng kh&eacute;o l&eacute;o xử lý để tránh trường hợp dung tục nên không cảm thấy lo lắng hay băn khoăn gì khi tung ra bộ<span class="Apple-converted-space">&nbsp;</span>ảnh nude<span class="Apple-converted-space">&nbsp;</span>lần này".</p><p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;" align="center">Chung Thục Quyên<span class="Apple-converted-space">&nbsp;</span>cũng cho biết cô không thích tránh n&eacute; hay mượn lý do bảo vệ môi trường hoặc bảo vệ muông thú để bao biện cho nội dung bộ ảnh. "Tôi thấy bộảnh nude<span class="Apple-converted-space">&nbsp;</span>của mình đẹp, không dung tục nên tôi chia sẻ", cô nói.</p><p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;" align="center">Hiện tại,<span class="Apple-converted-space">&nbsp;</span>Chung Thục Quyên<span class="Apple-converted-space">&nbsp;</span>hoạt động trên nhiều lĩnh vực như đi hát, kinh doanh khách sạn, stylist hình ảnh và người mẫu trình diễn.<span class="Apple-converted-space">&nbsp;</span>Chung Thục Quyên<span class="Apple-converted-space">&nbsp;</span>còn dự kiến sẽ mở thêm quán trà sữa kinh doanh trong năm 2013.</p><p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;" align="center">Cùng ngắm bộ<span class="Apple-converted-space">&nbsp;</span><a href="http://news.zing.vn/search.html?q=%E1%BA%A3nh-nude#taggify" target="_blank" class="zinglive_highlight" style="margin: 0px; padding: 0px; border-width: 0px 0px 1px; border-bottom-style: dotted; border-bottom-color: rgb(168, 168, 168); list-style: none; outline: 0px; font-size: 12.2pt; background-color: transparent; color: rgb(51, 51, 51); text-decoration: none; background-position: initial initial; background-repeat: initial initial;">ảnh nude</a><span class="Apple-converted-space">&nbsp;</span>của<span class="Apple-converted-space">&nbsp;</span><a href="http://news.zing.vn/search.html?q=chung-th%E1%BB%A5c-quy%C3%AAn#taggify" target="_blank" class="zinglive_highlight" style="margin: 0px; padding: 0px; border-width: 0px 0px 1px; border-bottom-style: dotted; border-bottom-color: rgb(168, 168, 168); list-style: none; outline: 0px; font-size: 12.2pt; background-color: transparent; color: rgb(51, 51, 51); text-decoration: none; background-position: initial initial; background-repeat: initial initial;">Chung Thục Quyên</a>:</p><table style="margin: 0px 20px 10px 0px; padding: 0px; border: 0px !important; list-style: none; max-width: 496px; background-color: rgb(241, 241, 241) !important; color: rgb(51, 51, 51); font-family: ''Times New Roman'', Times, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial !important; background-repeat: initial initial !important;" align="center" border="0" cellpadding="1" cellspacing="1" width="200"><tbody style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; background-position: initial initial; background-repeat: initial initial;"><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/a98q2664-copy-copy.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="625" width="500"></td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/a98q2670-copy-copy.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="758" width="500"></td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/a98q2709-copy-copy.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="754" width="500"></td></tr></tbody></table><div align="center"><br></div>', '2013-03-06 00:00:00', '2013-03-06 22:28:00', '2013-03-06 22:29:23', 1, 0);
INSERT INTO `news_2013_03` VALUES (14, 6, 1, '2013/03/819c1e27052aaf29eec6f82c01927e76_1362585210.jpg', NULL, 'Những phi vụ giảm cân khốc liệt của sao Việt', 'nhung-phi-vu-giam-can-khoc-liet-cua-sao-viet', 1, 'Hồng Quế từng khá "vạm vỡ" còn Andrea thì bị chê là có vòng eo "siêu mỡ" nhưng thời gian gần đây, họ đều xuất hiện với vóc dáng rất thon thả.', '<p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;">Với nghệ sĩ, nếu không chăm chút ngoại hình, mọi hào quang có thể vụt tắt. Đó là lý do khiến nhiều người đẹp showbiz Việt đã bước vào một "cuộc đua"<span class="Apple-converted-space">&nbsp;</span>giảm cân<span class="Apple-converted-space">&nbsp;</span>đầy gian nan để có được vóc dáng gợi cảm. Từ những người mẫu trẻ như<span class="Apple-converted-space">&nbsp;</span>Hồng Quế,Andrea, Đỗ<span class="Apple-converted-space">&nbsp;</span>Hoàng Anh<span class="Apple-converted-space">&nbsp;</span>hay những người đẹp mới thành danh như<span class="Apple-converted-space">&nbsp;</span>Linh Nga, Hoa khôi thể thao Trần Thị Quỳnh đều đã từng nỗ lực giảm được số cân ít ai ngờ tới.</p><p class="pSubTitle" style="margin: 0px; padding: 0px 2px 8px 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); font-family: ''Times New Roman''; font-weight: bold; line-height: 18px; color: rgb(51, 51, 51); font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;">Người mẫu<span class="Apple-converted-space">&nbsp;</span>Hồng Quế: Giảm 8kg</p><p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;">Mặc dù đang tuổi ăn tuổi lớn nhưng khán giả khá bất ngờ khi thấy<span class="Apple-converted-space">&nbsp;</span>Hồng Quế<span class="Apple-converted-space">&nbsp;</span>giảm 8kg chỉ trong một thời gian ngắn. Cô không ăn tinh bột mà chủ yếu ăn hoa quả chuối, bưởi, chanh. Khi đói,<span class="Apple-converted-space">&nbsp;</span><a href="http://news.zing.vn/search.html?q=h%E1%BB%93ng-qu%E1%BA%BF#taggify" target="_blank" class="zinglive_highlight" style="margin: 0px; padding: 0px; border-width: 0px 0px 1px; border-bottom-style: dotted; border-bottom-color: rgb(168, 168, 168); list-style: none; outline: 0px; font-size: 12.2pt; background-color: transparent; color: rgb(51, 51, 51); text-decoration: none; background-position: initial initial; background-repeat: initial initial;">Hồng Quế</a><span class="Apple-converted-space">&nbsp;</span>chỉ uống nước lọc.</p><table style="margin: 0px 20px 10px 0px; padding: 0px; border: 0px !important; list-style: none; max-width: 496px; background-color: rgb(241, 241, 241) !important; color: rgb(51, 51, 51); font-family: ''Times New Roman'', Times, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial !important; background-repeat: initial initial !important;" align="center" border="0" cellpadding="1" cellspacing="1" width="200"><tbody style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; background-position: initial initial; background-repeat: initial initial;"><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none; text-align: center;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/05/1-21.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="400" width="500"></td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td class="pCaption" style="margin: 0px 0px 5px; padding: 5px; border: 0px none; list-style: none; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: rgb(102, 102, 102); text-align: left; background-color: rgb(246, 246, 246); background-position: initial initial; background-repeat: initial initial;">Hồng&nbsp;Quế từng rất mập mạp, sau khi giảm cân cô không ngại khoe dáng trong bộ đầm sexy.</td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/05/2-19.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="742" width="494"></td></tr></tbody></table><br>', '2013-03-06 00:00:00', '2013-03-06 22:53:30', '2013-03-07 09:41:35', 1, 0);
INSERT INTO `news_2013_03` VALUES (15, 6, 1, '2013/03/8f798c97a7f95cbde0b0469eb84468a7_1362585525.jpg', NULL, 'Ngọc Trinh đọ dáng cùng dàn chân dài', 'ngoc-trinh-do-dang-cung-dan-chan-dai', 1, '"Nữ hoàng đồ lót" Ngọc Trinh xuất hiện tươi tắn cùng các chân dài trong buổi tiệc đầu năm.', '<p class="pBody" style="margin: 0px 0px 10px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); line-height: 20px; font-family: ''Times New Roman'', Times, serif; text-align: justify; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;">Giám đốc công ty Venus Vũ Khắc Tiệp cho biết các người đẹp cùng tham gia buổi tiệc đầu năm nhằm chuẩn bị cho kế hoạch<span class="Apple-converted-space">&nbsp;</span><span style="font-style: italic;">Đêm hội chân dài<span class="Apple-converted-space">&nbsp;</span></span>lần 7 dự kiến diễn ra vào mùa hè năm nay. Trong buổi tiệc này có rất nhiều chân dài từng gắn bó với Venus như<span class="Apple-converted-space">&nbsp;</span>Ngọc Trinh, Thái Hà, Á hậu Minh Thư, Diệu Huyền, Thanh Vân, Kiều Ngân, Võ Cảnh, Trương Mỹ Nhân, Huỳnh Tiên và Kỳ Hân. Đặc biệt, trong bộ đầm đỏ cùng màu môi cùng tông, á hậu Linh Chi không ngần ngại đọ dáng cùng với<a href="http://news.zing.vn/search.html?q=ng%E1%BB%8Dc-trinh#taggify" target="_blank" class="zinglive_highlight" style="margin: 0px; padding: 0px; border-width: 0px 0px 1px; border-bottom-style: dotted; border-bottom-color: rgb(168, 168, 168); list-style: none; outline: 0px; font-size: 12.2pt; background-color: transparent; color: rgb(51, 51, 51); text-decoration: none; background-position: initial initial; background-repeat: initial initial;">Ngọc Trinh</a><span class="Apple-converted-space">&nbsp;</span>trong nhiều shoot ảnh. Theo kế hoạch, cuối tháng 3, các người đẹp này sẽ sang New York ghi hình cho<span class="Apple-converted-space">&nbsp;</span><span style="font-style: italic;"><a href="http://news.zing.vn/search.html?q=%C4%91%C3%AAm-h%E1%BB%99i-ch%C3%A2n-d%C3%A0i#taggify" target="_blank" class="zinglive_highlight" style="margin: 0px; padding: 0px; border-width: 0px 0px 1px; border-bottom-style: dotted; border-bottom-color: rgb(168, 168, 168); list-style: none; outline: 0px; font-size: 12.2pt; background-color: transparent; color: rgb(51, 51, 51); text-decoration: none; background-position: initial initial; background-repeat: initial initial;">Đêm hội chân dài</a><span class="Apple-converted-space">&nbsp;</span>7.</span></p><table style="margin: 0px 20px 10px 0px; padding: 0px; border: 0px !important; list-style: none; max-width: 496px; background-color: rgb(241, 241, 241) !important; color: rgb(51, 51, 51); font-family: ''Times New Roman'', Times, serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 20px; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial !important; background-repeat: initial initial !important;" align="center" border="0" cellpadding="1" cellspacing="1" width="200"><tbody style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; background-position: initial initial; background-repeat: initial initial;"><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/ngc-trinh-va-linh-chi.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="731" width="500"></td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td class="pCaption" style="margin: 0px 0px 5px; padding: 5px; border: 0px none; list-style: none; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: rgb(102, 102, 102); text-align: left; background-color: rgb(246, 246, 246); background-position: initial initial; background-repeat: initial initial;">Ngọc Trinh "đọ dáng" cùng á hậu Linh Chi.</td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/mu-tr-thy-anh-va-diu-linh-cung-linh-chi.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="345" width="500"></td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/hu-linh-chi-s-la-c-ong-trum-xay-dng-la-ngi-mu-qung-cao.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="760" width="500"></td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td class="pCaption" style="margin: 0px 0px 5px; padding: 5px; border: 0px none; list-style: none; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: rgb(102, 102, 102); text-align: left; background-color: rgb(246, 246, 246); background-position: initial initial; background-repeat: initial initial;">Trong bộ đầm đỏ, Linh Chi vô cùng nổi bật.</td></tr><tr style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><td style="margin: 0px; padding: 0px; border: 0px none; list-style: none;"><img class="oImage" alt="" src="http://img2.news.zing.vn/2013/03/06/v-khc-tip-ben-2-ngi-mu-cng-ngc-trinh-linh-chi.jpg" style="margin: 0px; padding: 0px; border: 0px; list-style: none; outline: 0px; font-size: 16px; background-color: transparent; max-width: 500px; height: auto; background-position: initial initial; background-repeat: initial initial;" align="Middle" border="0" height="343" width="500"></td></tr></tbody></table><img alt="" title="" src="../../../static/uploads/editor/ngc-trinh-va-linh-chi.jpg">', '2013-03-06 00:00:00', '2013-03-06 22:58:45', '2013-03-06 22:58:45', 1, 0);
INSERT INTO `news_2013_03` VALUES (16, 4, 1, '', NULL, 'Yamaha ra mắt 2 mẫu xe tay ga mới', 'yamaha-ra-mat-2-mau-xe-tay-ga-moi', 0, 'Yamaha ra mắt 2 mẫu xe tay ga mới', '<h1 class="pTitle" style="margin: 10px 0px 5px; padding: 5px 0px 0px; border: 0px; list-style: none; outline: 0px; font-size: 22pt; background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-weight: normal; text-align: left; line-height: 23pt; font-family: ''Times New Roman'', Times, serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-position: initial initial; background-repeat: initial initial;">Yamaha ra mắt 2 mẫu xe tay ga mới<br></h1>', '2013-03-07 00:00:00', '2013-03-07 10:29:30', '2013-03-08 10:45:21', 1, 0);
INSERT INTO `news_2013_03` VALUES (17, 2, NULL, '2013/03/a29b74fcd711b6144c6ef6d5f15ad9e7_1363146614.jpg', NULL, 'rtyrty56565', 'rtyrty56565', 0, 'rtytr', 'trytryt', '2013-03-13 00:00:00', '2013-03-13 10:48:50', '2013-03-13 10:51:31', 1, 0);
INSERT INTO `news_2013_03` VALUES (18, 1, 0, '2013/03/70f8a85228519556a440b4431786d6d3_1363146705.png', NULL, 'dfdfddfd', 'dfdfddfd', 0, 'dfgfdg', 'dfgdfgdf', '2013-03-13 10:51:45', '2013-03-13 10:51:45', '2013-03-13 10:51:45', 1, 0);
