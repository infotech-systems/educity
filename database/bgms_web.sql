-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2021 at 03:29 PM
-- Server version: 5.7.36
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bgms_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `blog_id` int(5) NOT NULL,
  `comment_time` timestamp NULL DEFAULT NULL,
  `comment_parent` int(5) DEFAULT '0',
  `comments` text NOT NULL,
  `commenter_nm` varchar(40) NOT NULL,
  `commenter_photo` text NOT NULL,
  `commenter_contact` varchar(12) NOT NULL,
  `commenter_email` text NOT NULL,
  `approval_status` varchar(1) DEFAULT 'N',
  `approved_id` int(5) DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `comment_time`, `comment_parent`, `comments`, `commenter_nm`, `commenter_photo`, `commenter_contact`, `commenter_email`, `approval_status`, `approved_id`, `approval_date`) VALUES
(1, 1, '2019-10-18 07:52:21', 0, 'tesvcbxzb   cxcb x xcv x xc', 'Surajit Mondal', '', '', '', 'Y', NULL, NULL),
(2, 1, '2019-10-19 06:11:56', 1, 'test', 'zz', '', '', '', 'Y', 1, '2021-12-03'),
(3, 1, '2021-12-02 10:30:06', 0, 'cc', 'vxzv', '', '905530165', 'sur@gmail.com', 'Y', 1, '2021-12-03'),
(4, 1, '2021-12-02 10:31:10', 0, 'cc', 'vxzv', '', '905530165', 'sur@gmail.com', 'Y', 1, '2021-12-03'),
(5, 1, '2021-12-02 10:31:36', 0, 'fff', 'dssd', '', '9051530165', 'a@g.com', 'Y', 1, '2021-12-03'),
(6, 1, '2021-12-02 10:55:27', 1, 'reply', 'reply', '', '9802145754', 'a@gmail.com', 'Y', 1, '2021-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `blog_mas`
--

DROP TABLE IF EXISTS `blog_mas`;
CREATE TABLE IF NOT EXISTS `blog_mas` (
  `blog_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) NOT NULL,
  `tag_ids` varchar(50) DEFAULT NULL,
  `cat_id` int(5) DEFAULT '0',
  `blog_date` date NOT NULL,
  `blog_title` varchar(100) NOT NULL,
  `blog_slug` varchar(100) NOT NULL,
  `blogo_photo` text NOT NULL,
  `small_photo` text,
  `blog_content` text NOT NULL,
  `user_id` int(5) NOT NULL,
  `approval_id` int(5) DEFAULT NULL,
  `approval_status` varchar(1) DEFAULT 'N',
  `approval_date` date DEFAULT NULL,
  `meta_keywords` text,
  `meta_desc` text,
  PRIMARY KEY (`blog_id`),
  KEY `blog_slug` (`blog_slug`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag_dtls`
--

DROP TABLE IF EXISTS `blog_tag_dtls`;
CREATE TABLE IF NOT EXISTS `blog_tag_dtls` (
  `bt_id` int(5) NOT NULL AUTO_INCREMENT,
  `blog_id` int(5) DEFAULT NULL,
  `tag_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`bt_id`),
  KEY `blog_id` (`blog_id`,`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_tag_dtls`
--

INSERT INTO `blog_tag_dtls` (`bt_id`, `blog_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 4),
(5, 3, 1),
(6, 4, 1),
(7, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch_mas`
--

DROP TABLE IF EXISTS `branch_mas`;
CREATE TABLE IF NOT EXISTS `branch_mas` (
  `branch_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_nm` varchar(50) NOT NULL,
  `branch_path` varchar(50) NOT NULL,
  `branch_addr` text,
  `cont_no` varchar(15) DEFAULT NULL,
  `map` text,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch_mas`
--

INSERT INTO `branch_mas` (`branch_id`, `branch_nm`, `branch_path`, `branch_addr`, `cont_no`, `map`) VALUES
(1, 'Kolkata', 'kolkata', 'P-139A, C I T Road, Scheme-IV, Beliaghata, Kolkata - 700 010', '9330067899', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.279680829388!2d88.39289381427365!3d22.568640638805114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02767d041d2595%3A0x6ec03e69140d12c4!2sBishop%20George%20Mission%20School!5e0!3m2!1sen!2sin!4v1638420104950!5m2!1sen!2sin'),
(2, 'Ghatakpukur', 'ghatakpukur', 'Dakshin Kalikapur ,Ghatakpukur, South 24 Prgns. Kolkata, WB - 743502', '9330067899', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.3157846216545!2d88.60083371394475!3d22.49233224158282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a020fbc436d2243%3A0xfe440e197a62eddb!2sBishop%20George%20Mission%20School%20Ghatakpukur!5e0!3m2!1sen!2sin!4v1639935113082!5m2!1sen!2sin\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  `image_name` text,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=2883 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`, `image_name`) VALUES
(2826, 1640591912, '122.176.24.111', '947018', '1640591912.2681.jpg'),
(2827, 1640591951, '122.176.24.111', '817142', '1640591951.2616.jpg'),
(2828, 1640591990, '122.176.24.111', '467306', '1640591990.0843.jpg'),
(2829, 1640591996, '122.176.24.111', '371935', '1640591996.3032.jpg'),
(2830, 1640592067, '122.176.24.111', '999990', '1640592066.7948.jpg'),
(2831, 1640592075, '122.176.24.111', '978710', '1640592075.443.jpg'),
(2832, 1640592255, '122.176.24.111', '704921', '1640592255.3286.jpg'),
(2833, 1640592297, '122.176.24.111', '523238', '1640592296.5183.jpg'),
(2834, 1640592328, '122.176.24.111', '801350', '1640592327.7018.jpg'),
(2835, 1640592353, '122.176.24.111', '497596', '1640592353.1144.jpg'),
(2836, 1640592361, '122.176.24.111', '668431', '1640592360.9131.jpg'),
(2837, 1640592380, '122.176.24.111', '538061', '1640592379.602.jpg'),
(2838, 1640592433, '122.176.24.111', '479638', '1640592433.3597.jpg'),
(2839, 1640592437, '49.44.83.106', '797982', '1640592436.5328.jpg'),
(2840, 1640592481, '122.176.24.111', '432845', '1640592480.928.jpg'),
(2841, 1640592701, '122.176.24.111', '862498', '1640592701.3617.jpg'),
(2842, 1640592743, '122.176.24.111', '75938', '1640592743.1306.jpg'),
(2843, 1640592881, '122.176.24.111', '618717', '1640592880.984.jpg'),
(2844, 1640593141, '122.176.24.111', '88301', '1640593140.6549.jpg'),
(2845, 1640593158, '122.176.24.111', '515786', '1640593157.7561.jpg'),
(2846, 1640593165, '122.176.24.111', '549620', '1640593164.7325.jpg'),
(2847, 1640593335, '122.176.24.111', '968475', '1640593335.4907.jpg'),
(2848, 1640593457, '122.176.24.111', '700671', '1640593457.2431.jpg'),
(2849, 1640593474, '122.176.24.111', '184127', '1640593474.2138.jpg'),
(2850, 1640593518, '122.176.24.111', '913759', '1640593518.1309.jpg'),
(2851, 1640593694, '122.176.24.111', '618240', '1640593693.8493.jpg'),
(2852, 1640593696, '122.176.24.111', '324795', '1640593696.3812.jpg'),
(2853, 1640593876, '122.176.24.111', '802973', '1640593875.6476.jpg'),
(2854, 1640593951, '122.176.24.111', '793578', '1640593951.4185.jpg'),
(2855, 1640593961, '122.176.24.111', '807009', '1640593961.0864.jpg'),
(2856, 1640594008, '122.176.24.111', '964084', '1640594008.3714.jpg'),
(2857, 1640594136, '122.176.24.111', '764601', '1640594135.5919.jpg'),
(2858, 1640594368, '122.176.24.111', '19555', '1640594368.4869.jpg'),
(2859, 1640594475, '122.176.24.111', '464831', '1640594474.9597.jpg'),
(2860, 1640594524, '122.176.24.111', '399356', '1640594523.68.jpg'),
(2861, 1640594531, '122.176.24.111', '384104', '1640594530.8491.jpg'),
(2862, 1640594672, '122.176.24.111', '535548', '1640594671.9952.jpg'),
(2863, 1640594744, '122.176.24.111', '930631', '1640594744.1621.jpg'),
(2864, 1640594750, '122.176.24.111', '57854', '1640594750.1892.jpg'),
(2865, 1640595131, '122.176.24.111', '426401', '1640595130.709.jpg'),
(2866, 1640595134, '122.176.24.111', '738109', '1640595134.4275.jpg'),
(2867, 1640595412, '122.176.24.111', '26168', '1640595411.9101.jpg'),
(2868, 1640595492, '122.176.24.111', '789772', '1640595491.8368.jpg'),
(2869, 1640595655, '122.176.24.111', '40241', '1640595654.756.jpg'),
(2870, 1640595753, '122.176.24.111', '73503', '1640595753.0762.jpg'),
(2871, 1640595756, '122.176.24.111', '62480', '1640595755.5621.jpg'),
(2872, 1640595767, '202.142.80.78', '263436', '1640595766.5834.jpg'),
(2873, 1640595791, '202.142.80.78', '795118', '1640595790.5933.jpg'),
(2874, 1640595797, '122.176.24.111', '373311', '1640595796.9261.jpg'),
(2875, 1640595892, '122.176.24.111', '344290', '1640595891.7806.jpg'),
(2876, 1640595921, '122.176.24.111', '433371', '1640595920.6365.jpg'),
(2877, 1640595934, '122.176.24.111', '70088', '1640595934.1964.jpg'),
(2878, 1640595961, '122.176.24.111', '621611', '1640595960.5218.jpg'),
(2879, 1640595968, '122.176.24.111', '424674', '1640595967.6387.jpg'),
(2880, 1640598780, '202.142.80.78', '994944', '1640598779.6039.jpg'),
(2881, 1640598819, '202.142.80.78', '334522', '1640598819.4013.jpg'),
(2882, 1640599050, '42.110.151.76', '124173', '1640599050.1618.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

DROP TABLE IF EXISTS `category_master`;
CREATE TABLE IF NOT EXISTS `category_master` (
  `cat_id` int(5) NOT NULL AUTO_INCREMENT,
  `cat_nm` varchar(200) DEFAULT NULL,
  `photo` text,
  `cat_content` text,
  `cat_slug` varchar(200) DEFAULT NULL,
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`cat_id`, `cat_nm`, `photo`, `cat_content`, `cat_slug`) VALUES
(1, 'Sports', '/uploads/category/sports.jpeg', '', 'sports'),
(2, 'Cultural Program', '/uploads/category/cultural-programe.jpg', '', 'cultural-program'),
(3, 'TTIS', '/uploads/category/ttis.jpg', '', 'ttis'),
(4, 'Picnic', '/uploads/category/picnic.jpg', '', 'picnic'),
(5, 'Concert', '/uploads/category/concert.jpg', '', 'concert'),
(6, 'Karate', '/uploads/category/karate.jpeg', '<span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><b><span style=\"font-size:18.0pt\"><span style=\"color:black\">Karate<br />\r\nBISHOP GEORGE MISSION SCHOOL</span></span></b><span style=\"font-size:18.0pt\"><span style=\"color:black\"> is well known for implementing innovative programmes to ensure the safety of its students as well as ensure that they have a holistic development. Among the plethora of innovative initiatives, the one that stands out is the compulsory karate classes being given to girls from classes four to seven.</span></span></span></span><br />\r\n<br />\r\n&nbsp;', 'karate'),
(7, 'Students Corner', '/uploads/category/students-corner.jpeg', '', 'students-corner'),
(8, 'Our Album', '/uploads/category/paper-cutting.jpeg', '', 'our-album'),
(9, 'Our Achievements', NULL, '', 'our-achievements'),
(10, 'Play Ground', NULL, '<span style=\"color:#27ae60;\"><em><strong>an outside area designed for children to play in&nbsp;</strong></em></span>', 'play-ground'),
(11, 'Art', NULL, '', 'art'),
(15, 'Alumni', NULL, '', 'alumni'),
(16, 'Class Room', NULL, '', 'class-room');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_menu`
--

DROP TABLE IF EXISTS `dyn_menu`;
CREATE TABLE IF NOT EXISTS `dyn_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uri',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `module_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uri` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dyn_group_id` int(11) NOT NULL DEFAULT '0',
  `position` int(5) NOT NULL DEFAULT '0',
  `target` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `show_menu` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `p_type` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dyn_group_id - normal` (`dyn_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dyn_menu`
--

INSERT INTO `dyn_menu` (`id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `is_parent`, `show_menu`, `p_type`) VALUES
(1, 'Dashboard', 'uri', 0, '', 'admin/dashboard', 'fa fa-dashboard', 2, 1, '', 0, 0, '1', 'W'),
(2, 'Home', 'uri', 0, '', 'admin/home', 'fa fa-home', 2, 2, NULL, 0, 0, '1', 'W'),
(3, 'Add', 'uri', 0, '', 'admin/home-add', 'fa fa-plus', 2, 1, NULL, 2, 0, '0', 'W'),
(4, 'Edit', 'uri', 0, '', 'admin/home-edit', 'fa fa-pencil', 2, 2, NULL, 2, 0, '0', 'W'),
(5, 'Master', 'uri', 0, '', '#', 'fa fa-object-group', 2, 5, NULL, 0, 1, '1', 'W'),
(6, 'User', 'uri', 0, '', 'admin/user', 'fa fa-user', 2, 1, NULL, 5, 0, '1', 'W'),
(7, 'Add', 'uri', 0, '', 'admin/user-add', 'fa fa-plus', 2, 1, NULL, 6, 0, '0', 'W'),
(8, 'Edit', 'uri', 0, '', 'admin/user-edit', 'fa fa-pencil', 2, 2, NULL, 6, 0, '0', 'W'),
(9, 'Permission', 'uri', 0, '', 'admin/user-permission', 'fa fa-key', 2, 3, NULL, 6, 0, '0', 'W'),
(10, 'Page', 'uri', 0, '', 'admin/page', 'fa fa-file', 2, 2, NULL, 5, 0, '1', 'W'),
(11, 'Add', 'uri', 0, '', 'admin/page-add', 'fa fa-plus', 2, 1, NULL, 10, 0, '0', 'W'),
(12, 'Edit', 'uri', 0, '', 'admin/page-edit', 'fa fa-pencil', 2, 2, NULL, 10, 0, '0', 'W'),
(13, 'Slider', 'uri', 0, '', 'admin/slider', 'fa fa-sliders', 2, 3, NULL, 5, 0, '1', 'W'),
(14, 'Add', 'uri', 0, '', 'admin/slider-add', 'fa fa-plus', 2, 1, NULL, 13, 0, '0', 'W'),
(15, 'Edit', 'uri', 0, '', 'admin/slider-edit', 'fa fa-pencil', 2, 2, NULL, 13, 0, '0', 'W'),
(105, 'Edit', 'uri', 0, '', 'admin/facility/edit', 'fa fa-pencil', 2, 2, NULL, 103, 0, '0', 'W'),
(104, 'Add', 'uri', 0, '', 'admin/facility/add', 'fa fa-plus', 2, 1, NULL, 103, 0, '0', 'W'),
(70, 'Event', 'uri', 0, '', 'admin/event', 'fa fa-cubes', 2, 4, '', 5, 0, '1', 'W'),
(71, 'Add', 'uri', 0, '', 'admin/event/add', 'fa fa-plus', 2, 1, '', 70, 0, '0', 'W'),
(22, 'Testimonial', 'uri', 0, '', 'admin/testimonial', 'fa  fa-microphone', 2, 5, '', 5, 0, '1', 'W'),
(67, 'Teacher', 'uri', 0, '', 'admin/expert', 'fa fa-user', 2, 6, '', 5, 0, '1', 'W'),
(72, 'Edit', 'uri', 0, '', 'admin/event/edit', 'fa fa-pencil', 2, 2, '', 70, 0, '0', 'W'),
(26, 'Category', 'uri', 0, '', 'admin/category', 'fa fa-list', 2, 7, NULL, 5, 0, '1', 'W'),
(27, 'Add', 'uri', 0, '', 'admin/category/add', 'fa fa-plus', 2, 1, NULL, 26, 0, '0', 'W'),
(28, 'Edit', 'uri', 0, '', 'admin/category/edit', 'fa fa-pencil', 2, 2, NULL, 26, 0, '0', 'W'),
(29, 'Photo', 'uri', 0, '', 'admin/photo', 'fa fa-photo', 2, 8, '', 5, 0, '0', 'W'),
(30, 'Add', 'uri', 0, '', 'admin/photo/add', 'fa fa-plus', 2, 1, NULL, 29, 0, '0', 'W'),
(31, 'Edit', 'uri', 0, '', 'admin/photo/edit', 'fa fa-pencil', 2, 2, NULL, 29, 0, '0', 'W'),
(109, 'Branch', 'uri', 0, '', 'admin/setting/branch', 'fa fa-university', 2, 1, NULL, 35, 0, '1', 'W'),
(108, 'Edit', 'uri', 0, '', 'admin/tag/edit', 'fa fa-pencil', 2, 2, NULL, 106, 0, '0', 'W'),
(107, 'Add', 'uri', 0, '', 'admin/tag/add', 'fa fa-plus', 2, 1, NULL, 106, 0, '0', 'W'),
(35, 'Setting', 'uri', 0, '', '#', 'fa fa-cog fa-spin', 2, 11, '', 0, 1, '1', 'W'),
(36, 'Organization', 'uri', 0, '', 'admin/setting/organization', 'fa fa-university', 2, 1, NULL, 35, 0, '1', 'W'),
(37, 'My Profile', 'uri', 0, '', 'admin/user/profile', 'fa fa-news', 1, 1, NULL, 1, 0, '0', 'W'),
(38, 'Database Backup', 'uri', 0, '', 'admin/setting/database', 'fa fa-database', 2, 2, NULL, 35, 0, '1', 'W'),
(39, 'Media Backup', 'uri', 0, '', 'admin/setting/media', 'fa fa-photo', 2, 3, NULL, 35, 0, '1', 'W'),
(40, 'Social', 'uri', 0, '', 'admin/social', 'fa fa-link', 2, 9, NULL, 5, 0, '1', 'W'),
(41, 'Add', 'uri', 0, '', 'admin/social-add', 'fa fa-plus', 2, 1, NULL, 40, 0, '0', 'W'),
(42, 'Edit', 'uri', 0, '', 'admin/social-edit', 'fa fa-pencil', 2, 2, NULL, 40, 0, '0', 'W'),
(43, 'Media', 'uri', 0, '', 'admin/media', 'fa fa-gg', 2, 10, '', 5, 0, '1', 'W'),
(44, 'Add', 'uri', 0, '', 'admin/media-add', 'fa  fa-plus', 2, 1, NULL, 43, 0, '0', 'W'),
(46, 'News', 'uri', 0, '', 'admin/news', 'fa fa-newspaper-o', 2, 6, '', 5, 0, '1', 'W'),
(47, 'Add', 'uri', 0, '', 'admin/fact/add', 'fa fa-plus', 2, 1, NULL, 45, 0, '0', 'W'),
(48, 'Edit', 'uri', 0, '', 'admin/fact/edit', 'fa fa-pencil', 2, 2, NULL, 45, 0, '0', 'W'),
(49, 'Add', 'uri', 0, '', 'admin/news/add', 'fa fa-plus', 2, 1, NULL, 46, 0, '0', 'W'),
(50, 'Edit', 'uri', 0, '', 'admin/news/edit', 'fa fa-pencil', 2, 2, NULL, 46, 0, '0', 'W'),
(77, 'Edit', 'uri', 0, '', 'admin/testimonial/edit', 'fa fa-pencil', 2, 2, '', 22, 0, '0', 'W'),
(76, 'Add', 'uri', 0, '', 'admin/testimonial/add', 'fa fa-plus', 2, 1, '', 22, 0, '0', 'W'),
(58, 'Menu', 'uri', 0, '', 'admin/menu', 'fa fa-list', 2, 0, NULL, 0, 0, '0', 'W'),
(59, 'Add', 'uri', 0, '', 'admin/menu/add', 'fa fa-plus', 2, 0, NULL, 58, 0, '0', 'W'),
(60, 'Edit', 'uri', 0, '', 'admin/menu/edit', 'fa fa-pncil', 2, 0, NULL, 58, 0, '0', 'W'),
(99, 'Contact Page', 'uri', 0, '', 'admin/contact', 'fa fa-envelope', 2, 9, NULL, 0, 0, '1', 'W'),
(100, 'Blog Approval', 'uri', 0, '', 'admin/blog/approve', 'fa fa-check-square-o', 2, 2, NULL, 85, 0, '1', 'W'),
(101, 'Approved', 'uri', 0, '', 'admin/blog/approved', 'fa fa-pencil', 2, 1, NULL, 100, 0, '0', 'W'),
(102, 'Important Fact', 'uri', 0, '', 'admin/fact', 'fa fa-hand-o-right', 2, 11, NULL, 5, 0, '1', 'W'),
(96, 'Edit', 'uri', 0, '', 'admin/blog/edit', 'fa fa-pencil', 2, 2, NULL, 86, 0, '0', 'W'),
(97, 'Approval', 'uri', 0, '', 'admin/comment/bedit', 'fa fa-check', 2, 1, NULL, 88, 0, '0', 'W'),
(98, 'Inquiry', 'uri', 0, '', 'admin/inquiry', 'fa fa-search', 2, 8, NULL, 0, 0, '1', 'W'),
(81, 'Add Photo', 'uri', 0, '', 'admin/photo', 'fa fa-file-photo-o', 2, 8, '', 84, 0, '1', 'W'),
(106, 'Tag', 'uri', 0, '', 'admin/tag', 'fa fa-tags', 2, 13, NULL, 5, 0, '1', 'W'),
(84, 'Photo', 'uri', 0, '', '#', 'fa fa-photo', 2, 6, '', 0, 1, '1', 'W'),
(85, 'Blog', 'uri', 0, '', '#', 'fab fa-blogger', 2, 7, '', 0, 1, '1', 'W'),
(86, 'Blog', 'uri', 0, '', 'admin/blog', 'fas fa-blog', 2, 1, '', 85, 0, '1', 'W'),
(95, 'Add', 'uri', 0, '', 'admin/blog/add', 'fa fa-plus', 2, 1, NULL, 86, 0, '0', 'W'),
(88, 'Blog Comment', 'uri', 0, '', 'admin/comment/blog', 'fa  fa-comments', 2, 3, '', 85, 0, '1', 'W'),
(103, 'Facility', 'uri', 0, '', 'admin/facility', 'fa fa-graduation-cap', 2, 12, NULL, 5, 0, '1', 'W'),
(90, 'Mission & Vission', 'uri', 0, '', 'admin/mission', 'fa fa-microphone', 2, 3, NULL, 0, 0, '1', 'W'),
(91, 'Add', 'uri', 0, '', 'admin/expert/add', 'fa fa-plus', 2, 1, NULL, 67, 0, '0', 'W'),
(92, 'Edit', 'uri', 0, '', 'admin/expert/edit', 'fa fa-pencil', 2, 2, NULL, 67, 0, '0', 'W'),
(93, 'Principal Desk', 'uri', 0, '', 'admin/principal', 'fa fa-user', 2, 4, NULL, 0, 0, '1', 'W'),
(110, 'Popups News', 'uri', 0, '', 'admin/popup', 'fa  fa-bullhorn', 2, 3, NULL, 0, 0, '1', 'W'),
(111, 'Youtube Video', 'uri', 0, '', 'admin/youtube', 'fa fa-youtube', 2, 14, NULL, 5, 0, '1', 'W'),
(112, 'Add', 'uri', 0, '', 'admin/youtube/add', 'fa fa-plus', 2, 1, NULL, 111, 0, '0', 'W'),
(113, 'Edit', 'uri', 0, '', 'admin/youtube/edit', 'fa fa-pencil', 2, 2, NULL, 111, 0, '0', 'W');

-- --------------------------------------------------------

--
-- Table structure for table `event_mas`
--

DROP TABLE IF EXISTS `event_mas`;
CREATE TABLE IF NOT EXISTS `event_mas` (
  `event_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT NULL,
  `event_date` date NOT NULL,
  `event_title` varchar(40) DEFAULT NULL,
  `event_time` varchar(20) DEFAULT NULL,
  `event_place` varchar(40) DEFAULT NULL,
  `event_content` text,
  `event_photo` text,
  `event_slug` text,
  `uid` int(5) DEFAULT NULL,
  `event_thumb` text,
  PRIMARY KEY (`event_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_mas`
--

INSERT INTO `event_mas` (`event_id`, `branch_id`, `event_date`, `event_title`, `event_time`, `event_place`, `event_content`, `event_photo`, `event_slug`, `uid`, `event_thumb`) VALUES
(5, 1, '2021-12-19', 'X-Mas Party', '10:00', 'School Building', 'cjhdk gkje gurkegi eriogger<br />\r\nhjekgher herjjerlher<br />\r\n<br />\r\nd,mb,kdfbj.dld', 'uploads/events/santa.jpg', '1639852200-kolkata-x-mas-party', 1, 'uploads/events/thumb/santa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `facilities_mas`
--

DROP TABLE IF EXISTS `facilities_mas`;
CREATE TABLE IF NOT EXISTS `facilities_mas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT '1',
  `facilities_name` varchar(100) NOT NULL,
  `description` text,
  `facilities_path` text,
  `small_path` text,
  `facilities_slug` varchar(100) NOT NULL,
  `trainer_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilities_mas`
--

INSERT INTO `facilities_mas` (`id`, `branch_id`, `facilities_name`, `description`, `facilities_path`, `small_path`, `facilities_slug`, `trainer_name`) VALUES
(1, 1, 'Computer Lab', '<div style=\"text-align: justify;\">Computer science is the study of computers and computing as well as their theoretical and practical applications. Computer science applies the principles of mathematics, engineering, and logic to a plethora of functions, including algorithm formulation, software and hardware development, and artificial intelligence</div>\r\n', 'uploads/facilities/big/comp-lab.jpg', 'uploads/facilities/comp-lab.jpg', 'kolkata-computer-lab', ''),
(16, 1, 'Physics Lab', '<div style=\"text-align: justify;\">Physics is the natural science that studies matter, its fundamental constituents, its motion and behaviour through space and time, and the related entities of energy and force.Physics is one of the most fundamental scientific disciplines, and its main goal is to understand how the universe behaves.Physics is one of the oldest academic disciplines and, through its inclusion of astronomy, perhaps the oldest.Over much of the past two millennia, physics, chemistry, biology, and certain branches of mathematics were a part of natural philosophy, but during the Scientific Revolution in the 17th century these natural sciences emerged as unique research endeavours in their own right. Physics intersects with many interdisciplinary areas of research, such as biophysics and quantum chemistry, and the boundaries of physics are not rigidly defined.&nbsp;</div>\r\n', 'uploads/facilities/big/contentpage_95_55_1.jpg', 'uploads/facilities/contentpage_95_55_1.jpg', 'kolkata-physics-lab', ''),
(17, 1, 'Chemistry Lab', '<div style=\"text-align: justify;\">Chemistry is the scientific study of the properties and behavior of matter. It is a natural science that covers the elements that make up matter to the compounds composed of atoms, molecules and ions: ... In the scope of its subject, chemistry occupies an intermediate position between physics and biology.[6] It is sometimes called the central science because it provides a foundation for understanding both basic and applied scientific disciplines at a fundamental level. For example, chemistry explains aspects of plant chemistry (botany), the formation of igneous rocks (geology), how atmospheric ozone is formed and how environmental pollutants are degraded (ecology), the properties of the soil on the moon (cosmochemistry), how medications work (pharmacology), and how to collect DNA evidence at a crime scene (forensics).</div>\r\n', 'uploads/facilities/big/chemistry-lab.jpg', 'uploads/facilities/chemistry-lab.jpg', 'kolkata-chemistry-lab', ''),
(18, 1, 'Karate', '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><b><span style=\"color:black\">BISHOP GEORGE MISSION SCHOOL</span></b><span style=\"color:black\"> is well known for implementing innovative programmes to ensure the safety of its students as well as ensure that they have a holistic development. Among the plethora of innovative initiatives, the one that stands out is the compulsory karate classes being given to girls and boys.</span></span></span></div>\r\n', 'uploads/facilities/big/WhatsApp_Image_2021-12-03_at_13_50_00.jpeg', 'uploads/facilities/WhatsApp_Image_2021-12-03_at_13_50_00.jpeg', 'kolkata-karate', ''),
(19, 1, 'Library', '<div style=\"text-align: justify;\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Offer quality programs that support the curriculum.</span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Help teachers integrate information literacy skills into &nbsp;&nbsp;</span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; learning activities.</span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Promote information literacy by helping students develop </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; skills to find, evaluate, use, create and share information and </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; knowledge. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Enrich student reading experiences and develop independent </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; Reading skills. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Support teaching and learning strategies. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Provide teachers with professional support.</span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Source and deliver suitable and current resources in multiple</span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; formats. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Maintain collections that meet the needs of the school </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; community. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Use current technologies to provide easy access to &nbsp;</span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\">&nbsp;&nbsp; information. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Adopt flexible design principles. </span></span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\"><span style=\"color:black\"># Offer stimulating teaching and learning environments.</span></span></span></span><br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n&nbsp;</div>\r\n', 'uploads/facilities/big/library.jpg', 'uploads/facilities/library.jpg', 'kolkata-library', ''),
(20, 2, 'Computer Lab', '<span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Computer science is the study of computers and computing as well as their theoretical and practical applications. Computer science applies the principles of mathematics, engineering, and logic to a plethora of functions, including algorithm formulation, software and hardware development, and artificial intelligence.</span></span></span>', 'uploads/facilities/big/computer-lab.jpg', 'uploads/facilities/computer-lab.jpg', 'ghatakpukur-computer-lab', ''),
(22, 2, 'Physics Lab', '<span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Physics is the natural science that studies matter, its fundamental constituents, its motion and behaviour through space and time, and the related entities of energy and force. Physics is one of the most fundamental scientific disciplines, and its main goal is to understand how the universe behaves. Physics is one of the oldest academic disciplines and, through its inclusion of astronomy, perhaps the oldest .Over much of the past two millennia, physics, chemistry, biology, and certain branches of mathematics were a part of natural philosophy, but during the Scientific Revolution in the 17th century these natural sciences emerged as unique research endeavours in their own right. Physics intersects with many interdisciplinary areas of research, such as biophysics and quantum chemistry, and the boundaries of physics are not rigidly defined.&nbsp;</span></span></span><br />\r\n&nbsp;', 'uploads/facilities/big/CustomPage_d8e4fb14-3770-4695-bcf9-ec31ec851d80.jpg', 'uploads/facilities/CustomPage_d8e4fb14-3770-4695-bcf9-ec31ec851d80.jpg', 'ghatakpukur-physics-lab', ''),
(23, 2, 'Chemistry Lab', '<span style=\"font-size:11.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\">Chemistry is the scientific study of the properties and behaviour of matter. It is a natural science that covers the elements that make up matter to the compounds composed of atoms, molecules and ions: ... In the scope of its subject, chemistry occupies an intermediate position between physics and biology.[6] It is sometimes called the central science because it provides a foundation for understanding both basic and applied scientific disciplines at a fundamental level. For example, chemistry explains aspects of plant chemistry (botany), the formation of igneous rocks (geology), how atmospheric ozone is formed and how environmental pollutants are degraded (ecology), the properties of the soil on the moon (cosmochemistry), how medications work (pharmacology), and </span></span></span>&nbsp;<span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">how to collect DNA evidence at a crime scene (forensics).</span></span></span><br />\r\n&nbsp;', 'uploads/facilities/big/unnamed.jpg', 'uploads/facilities/unnamed.jpg', 'ghatakpukur-chemistry-lab', ''),
(27, 2, 'Library', 'A&nbsp;<b>school library</b>&nbsp;(or a school library media center) is a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Library\" title=\"Library\">library</a>&nbsp;within a&nbsp;<a href=\"https://en.wikipedia.org/wiki/School\" title=\"School\">school</a>&nbsp;where students, staff, and often, parents of a&nbsp;<a href=\"https://en.wikipedia.org/wiki/Public_school_(government_funded)\" title=\"Public school (government funded)\">public</a>&nbsp;or&nbsp;<a href=\"https://en.wikipedia.org/wiki/Private_school\" title=\"Private school\">private school</a>&nbsp;have access to a variety of resources. The goal of the school library media center is to ensure that all members of the school community have equitable access &quot;to books and reading, to information, and to information technology.&nbsp;A school library media center &quot;uses all types of media... is automated, and utilizes the Internet [as well as books] for information gathering.&nbsp;School libraries are distinct from public libraries because they serve as &quot;learner-oriented laboratories which support, extend, and individualize the school&#39;s curriculum... A school library serves as the center and coordinating agency for all material used in the school.', 'uploads/facilities/big/ghatak_lib.jpg', 'uploads/facilities/ghatak_lib.jpg', 'ghatakpukur-library', ''),
(28, 2, 'Karate', 'BISHOP GEORGE MISSION SCHOOL is well known for<br />\r\nimplementing innovative programmes to ensure the safety of<br />\r\nits students as well as ensure that they have a holistic<br />\r\ndevelopment. Among the plethora of innovative initiatives,<br />\r\nthe one that stands out is the compulsory karate classes being<br />\r\ngiven to girls from classes four to seven.', 'uploads/facilities/big/DSC_0381.JPG', 'uploads/facilities/DSC_0381.JPG', 'ghatakpukur-karate', ''),
(29, 2, 'BIOLOGY LAB', 'Biolab&nbsp;<b>support biological research on small plants, small invertebrates, microorganisms, animal cells, and tissue cultures</b>. It includes an incubator equipped with centrifuges in which the preceding experimental subjects can be subjected to controlled levels of accelerations.', 'uploads/facilities/big/biology_lab.jpg', 'uploads/facilities/biology_lab.jpg', 'ghatakpukur-biology-lab', ''),
(30, 2, 'YOGA', 'Yoga helps them&nbsp;<b>to deal with their stress and bring back some peace of mind</b>. Those who regularly practice yoga not only report lower levels of stress and anxiety and subsequently improved academic performance.<br />\r\n<br />\r\n<img alt=\"\" height=\"289\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-26_at_18_30_22.jpeg\" style=\"float:left\" width=\"200\" />', 'uploads/facilities/big/WhatsApp_Image_2021-12-26_at_18_30_23.jpeg', 'uploads/facilities/WhatsApp_Image_2021-12-26_at_18_30_23.jpeg', 'ghatakpukur-yoga', ''),
(31, 1, 'YOGA', 'Yoga helps them&nbsp;<b>to deal with their stress and bring back some peace of mind</b>. Those who regularly practice yoga not only report lower levels of stress and anxiety and subsequently improved academic performance.<br />\r\n<br />\r\n<img alt=\"\" height=\"289\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-26_at_18_30_221.jpeg\" style=\"float:left\" width=\"200\" />', 'uploads/facilities/big/WhatsApp_Image_2021-12-26_at_18_30_231.jpeg', 'uploads/facilities/WhatsApp_Image_2021-12-26_at_18_30_231.jpeg', 'kolkata-yoga', ''),
(32, 1, 'BIOLOGY LAB', 'Biolab&nbsp;<b>support biological research on small plants, small invertebrates, microorganisms, animal cells, and tissue cultures</b>. It includes an incubator equipped with centrifuges in which the preceding experimental subjects can be subjected to controlled levels of accelerations.<br />\r\n<br />\r\n&nbsp;', 'uploads/facilities/big/biologylab-800x4001.jpg', 'uploads/facilities/biologylab-800x4001.jpg', 'kolkata-biology-lab', ''),
(33, 2, 'Swimming Pool', '<b>Swimming builds endurance, muscle strength and cardiovascular fitness</b>. helps you maintain a healthy weight, healthy heart and lungs. tones muscles and builds strength. provides an all-over body workout, as nearly all of your muscles are used.', 'uploads/facilities/big/WhatsApp_Image_2021-12-26_at_18_35_27.jpeg', 'uploads/facilities/WhatsApp_Image_2021-12-26_at_18_35_27.jpeg', 'ghatakpukur-swimming-pool', '');

-- --------------------------------------------------------

--
-- Table structure for table `fact_mas`
--

DROP TABLE IF EXISTS `fact_mas`;
CREATE TABLE IF NOT EXISTS `fact_mas` (
  `fact_id` int(5) NOT NULL AUTO_INCREMENT,
  `fact_nm` varchar(35) DEFAULT NULL,
  `fact_desc` varchar(32) DEFAULT NULL,
  `fact_photo` text,
  `branch_id` int(5) DEFAULT '1',
  PRIMARY KEY (`fact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fact_mas`
--

INSERT INTO `fact_mas` (`fact_id`, `fact_nm`, `fact_desc`, `fact_photo`, `branch_id`) VALUES
(2, 'Students', '2158', 'fa fa-code', 1),
(3, 'Teachers', '58', 'fa fa-database', 1),
(4, 'Staffs', '17', 'fa fa-tv', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_content_mas`
--

DROP TABLE IF EXISTS `home_content_mas`;
CREATE TABLE IF NOT EXISTS `home_content_mas` (
  `home_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT NULL,
  `home_title` varchar(250) NOT NULL,
  `home_content` text,
  PRIMARY KEY (`home_id`,`home_title`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_content_mas`
--

INSERT INTO `home_content_mas` (`home_id`, `branch_id`, `home_title`, `home_content`) VALUES
(26, 1, '<span>Why</span> Choose Us ?', '<p style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">&ldquo;<b>Bishop George Mission School&rdquo; </b>is an English Medium Co-Educational school, following CBSE Curriculum. Our Founder Mr. Niraj Jaiswal began the journey of opening educational institutions from 2005 and finally laid the foundation stone of <b>&lsquo;Bishop George Mission School&rsquo;</b> in March 2005. The school is in the stage of conception with a vision to become one of the leading educational institutions in Kolkata, West Bengal, located in the sylan surrounding of Beliaghata C. I. T Road. Though there are a number of schools in the area, what makes of <b>&lsquo;Bishop George Mission School&rsquo;</b> stand apart, is its impact on quality education at an </span></span></span><span style=\"color:null;\"><em><strong><span style=\"font-size:18px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">affordable price.&nbsp;</span></span></span></strong></em></span></p>\r\n'),
(28, 2, '<span>Why</span> Choose Us ?', '<p style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">&ldquo;<b>Bishop George Mission School&rdquo; </b>is an English Medium Co-Educational school, following CBSE Curriculum. Our Founder Mr. Niraj Jaiswal began the journey of opening educational institutions from 2005 and finally laid the foundation stone of <b>&lsquo;Bishop George Mission School&rsquo;</b> in March 2005. The school is in the stage of conception with a vision to become one of the leading educational institutions in Kolkata, West Bengal, located at&nbsp;Beliaghata C. I. T Road and our new&nbsp;branch&nbsp; which started its academic session for 2021 -2022&nbsp;at Ghatakpukur is&nbsp;</span></span></span><span style=\"color:#c0392b;\"><span style=\"font-size:20px;\"><em><strong><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">proposed for&nbsp;CBSE&nbsp;</span></span></strong></em></span></span><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;New Delhi.&nbsp;Though there are a number of schools in the area, what makes of <b>&lsquo;Bishop George Mission School&rsquo;</b> stand apart, is its impact on quality education at an </span></span></span><em><strong><span style=\"font-size:18px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">affordable price.&nbsp;</span></span></span></strong></em></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mailbox`
--

DROP TABLE IF EXISTS `mailbox`;
CREATE TABLE IF NOT EXISTS `mailbox` (
  `mail_id` int(5) NOT NULL AUTO_INCREMENT,
  `mail_from` text NOT NULL,
  `sender_name` varchar(40) DEFAULT NULL,
  `mail_to` int(5) NOT NULL,
  `mail_subject` text NOT NULL,
  `mail_content` text NOT NULL,
  `mail_type` varchar(1) NOT NULL,
  `mail_time` datetime DEFAULT NULL,
  `mobile_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mailbox`
--

INSERT INTO `mailbox` (`mail_id`, `mail_from`, `sender_name`, `mail_to`, `mail_subject`, `mail_content`, `mail_type`, `mail_time`, `mobile_no`) VALUES
(2, 'surajit@infotechsystems.in', 'surajit mondal', 1, 'test', 'test', 'C', '2021-12-02 12:12:20', '9051530165'),
(3, 'surajit@infotechsystems.in', 'surajit mondal', 1, 'test', 'test', 'C', '2021-12-02 12:12:57', '9051530165'),
(13, 'surajit@infotechsystems.in', 'surajit', 1, 'Admission Inquiry', 'td', 'I', '2021-12-03 14:03:32', '9733857675'),
(14, 'ss@gmail.com', 'ss', 1, 'Admission Inquiry', 'test', 'I', '2021-12-03 14:04:32', '9051530165'),
(15, 's@h.com', 'dgn xd', 1, 'Admission Inquiry', 'test', 'I', '2021-12-03 14:07:46', '97242'),
(16, 'd@gmail.com', 'dd', 1, 'Admission Inquiry', 're', 'I', '2021-12-03 14:11:49', '9451234567'),
(17, 's@g.com', '90', 1, 'Admission Inquiry', 'ssd', 'I', '2021-12-03 14:13:29', '9051530165'),
(18, 's@g.com', '90', 1, 'Admission Inquiry', 'ssd', 'I', '2021-12-03 14:14:16', '9051530165'),
(19, 'surajit@infote.com', 'sri', 1, 'Admission Inquiry', 'test', 'I', '2021-12-03 14:16:09', '9051530165'),
(20, 's@f.c0', 'ds', 1, 'Admission Inquiry', 'vv', 'I', '2021-12-03 14:17:06', '982'),
(21, 'a@g.com', 'dd', 1, 'Admission Inquiry', 'ff', 'I', '2021-12-03 14:20:32', '9051530165'),
(22, 's@f.in', 'ss', 1, 'Admission Inquiry', 'sss', 'I', '2021-12-03 14:23:41', '9702421414'),
(23, 'amitabha@infotechsystems.in', 'Amutabba', 1, 'Admission Inquiry', 'Admission inquery form submit', 'I', '2021-12-08 09:19:40', '9830076207'),
(24, 'safahh@gmail.com', 'Tanushree Saha', 1, 'Admission Inquiry', 'i want to enqire qbout your school', 'I', '2021-12-09 14:26:18', '9830090000'),
(25, 'surajit@infotechsystems.in', 'surajit', 1, 'developer test', 'test by developer', 'C', '2021-12-14 11:39:09', '9051530165'),
(26, 'amit@gmail.com', 'Amit', 1, 'Admission', 'Admission form', 'C', '2021-12-14 19:22:33', '9433765700'),
(27, 'amitabha@infotechsystems.in', 'Amit', 1, 'admission', 'admission procedure', 'C', '2021-12-14 19:25:50', '9433765700'),
(28, 'amitabha@infotechsystems.in', 'Amitabha', 1, 'Admission Inquiry', 'Admission inquery', 'I', '2021-12-27 13:44:38', '9830076207');

-- --------------------------------------------------------

--
-- Table structure for table `media_mas`
--

DROP TABLE IF EXISTS `media_mas`;
CREATE TABLE IF NOT EXISTS `media_mas` (
  `media_id` int(5) NOT NULL AUTO_INCREMENT,
  `media_path` blob NOT NULL,
  `med_extn` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media_mas`
--

INSERT INTO `media_mas` (`media_id`, `media_path`, `med_extn`) VALUES
(47, 0x2f75706c6f6164732f6d656469612f66617669636f6e2e706e67, '.png'),
(48, 0x2f75706c6f6164732f6d656469612f494d472d32303231313131312d5741303032342e6a7067, '.jpg'),
(49, 0x2f75706c6f6164732f6d656469612f32303231313230335f3131333930322e6a7067, '.jpg'),
(50, 0x2f75706c6f6164732f6d656469612f32303231313230335f3131353635365f2832292e6a7067, '.jpg'),
(51, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f32305f30325f34392e6a706567, '.jpeg'),
(52, 0x2f75706c6f6164732f6d656469612f494d475f303932372e4a5047, '.JPG'),
(53, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31345f35365f31355f2831292e6a706567, '.jpeg'),
(54, 0x2f75706c6f6164732f6d656469612f32303231313230335f3131353634372e6a7067, '.jpg'),
(55, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31345f35365f31362e6a706567, '.jpeg'),
(56, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31345f35365f31335f2832292e6a706567, '.jpeg'),
(57, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31345f35365f31352e6a706567, '.jpeg'),
(58, 0x2f75706c6f6164732f6d656469612f494d475f32303231303932385f3039343230335f5f30312e6a7067, '.jpg'),
(59, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31345f35365f3135312e6a706567, '.jpeg'),
(60, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31345f35365f3135322e6a706567, '.jpeg'),
(61, 0x2f75706c6f6164732f6d656469612f4453435f303033362e4a5047, '.JPG'),
(62, 0x2f75706c6f6164732f6d656469612f4453435f30303336312e4a5047, '.JPG'),
(63, 0x2f75706c6f6164732f6d656469612f494d472d32303230303132302d5741303031312e6a7067, '.jpg'),
(64, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31325f30335f2831292e6a706567, '.jpeg'),
(65, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31325f30315f2831292e6a706567, '.jpeg'),
(66, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31395f35385f33382e6a706567, '.jpeg'),
(67, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31395f35385f3338312e6a706567, '.jpeg'),
(68, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31395f35385f3338322e6a706567, '.jpeg'),
(69, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31325f30315f283129312e6a706567, '.jpeg'),
(70, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31325f30315f283129322e6a706567, '.jpeg'),
(71, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31315f33352e6a706567, '.jpeg'),
(72, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31315f3335312e6a706567, '.jpeg'),
(73, 0x2f75706c6f6164732f6d656469612f494d472d32303230303131392d5741303031312e6a7067, '.jpg'),
(74, 0x2f75706c6f6164732f6d656469612f494d472d32303230303131392d574130303131312e6a7067, '.jpg'),
(75, 0x2f75706c6f6164732f6d656469612f494d475f303932375f2831292e4a5047, '.JPG'),
(76, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31315f32385f2831292e6a706567, '.jpeg'),
(77, 0x2f75706c6f6164732f6d656469612f494d475f303236325f2831292e4a5047, '.JPG'),
(78, 0x2f75706c6f6164732f6d656469612f636c617373726f6f6d2d323039333734345f313932302d31353030783439302d632d63656e7465722e6a7067, '.jpg'),
(79, 0x2f75706c6f6164732f6d656469612f53637265656e73686f745f32303231313231372d3138303833385f2831292e6a7067, '.jpg'),
(80, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d30355f61745f31395f35385f3338332e6a706567, '.jpeg'),
(81, 0x2f75706c6f6164732f6d656469612f4453435f30303336322e4a5047, '.JPG'),
(82, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d31335f61745f31315f31315f35395f2832292e6a706567, '.jpeg'),
(83, 0x2f75706c6f6164732f6d656469612f62696f6c6f6779312e6a7067, '.jpg'),
(84, 0x2f75706c6f6164732f6d656469612f62696f6c6f677931312e6a7067, '.jpg'),
(85, 0x2f75706c6f6164732f6d656469612f62696f6c6f677931322e6a7067, '.jpg'),
(86, 0x2f75706c6f6164732f6d656469612f494d475f303236325f283129312e4a5047, '.JPG'),
(87, 0x2f75706c6f6164732f6d656469612f53637265656e73686f745f32303231313231372d3138303833385f283129312e6a7067, '.jpg'),
(88, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d32365f61745f31305f32335f30302e6a706567, '.jpeg'),
(89, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d32365f61745f31385f33305f32322e6a706567, '.jpeg'),
(90, 0x2f75706c6f6164732f6d656469612f57686174734170705f496d6167655f323032312d31322d32365f61745f31385f33305f3232312e6a706567, '.jpeg'),
(91, 0x2f75706c6f6164732f6d656469612f6f75702d6c6f676f2e6a706567, '.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mission_mas`
--

DROP TABLE IF EXISTS `mission_mas`;
CREATE TABLE IF NOT EXISTS `mission_mas` (
  `mission_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) NOT NULL,
  `mission_title` varchar(50) NOT NULL,
  `mission_content` text NOT NULL,
  PRIMARY KEY (`mission_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission_mas`
--

INSERT INTO `mission_mas` (`mission_id`, `branch_id`, `mission_title`, `mission_content`) VALUES
(2, 1, 'Our Mission & Vision', '<section>\r\n<p style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">The mission of the school is education of the young minds so that are prepared to make their mark in this ever evolving, competitive world. The New School prepares students to understand, contribute to, and succeed in a rapidly changing society, thus making the world a better and more just place. We will ensure that our students develop both the skills that a sound education provides and the competencies essential for success and leadership in the emerging creative economy. We will also lead in generating practical and theoretical knowledge that enables people to better understand our world and improve conditions for local and global communities.&nbsp;</span></span></span><br />\r\n<span style=\"font-size:9px;\">&nbsp;&nbsp;</span><br />\r\n<span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><b><span style=\"color:black\">OUR OBJECTIVES: AT BGMS&nbsp;KOLKATA, West Bengal</span></b></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">To provide facilities for all round development of the child be it mental, physical, spiritual, cultural or social.</span></span></span></li>\r\n	<li style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">To give the child academic training par excellence.</span></span></span></li>\r\n	<li style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">To enable the child to develop wholesome, healthy habits and inner discipline.</span></span></span></li>\r\n	<li style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">To develop in the child leadership qualities in caring and personalized growing environment.</span></span></span></li>\r\n	<li style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">To grow in social sensitivity and magnanimity.</span></span></span></li>\r\n	<li style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">To include in the child intrinsic human valves of fellowship, honesty, responsibility and patriotism.</span></span></span></li>\r\n</ul>\r\n</section>\r\n'),
(3, 2, 'Our Mission & Vision', '<p>The <span style=\"color:#2980b9;\">mission of the school </span>is education of the young minds so that are prepared to make their mark in this ever evolving, competitive world. <span style=\"color:#2980b9;\">The New School prepares students to understand, contribute to, and succeed in a rapidly changing society, thus making the world a better and more just place. </span>We will ensure that our students develop both the skills that a sound education provides and the competencies essential for success and leadership in the emerging creative economy. We will also lead in generating practical and theoretical knowledge that enables people to better understand our world and improve conditions for local and global communities.&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `news_mas`
--

DROP TABLE IF EXISTS `news_mas`;
CREATE TABLE IF NOT EXISTS `news_mas` (
  `news_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT NULL,
  `news_title` varchar(50) NOT NULL,
  `news_publisher` varchar(50) DEFAULT NULL,
  `news` text,
  `attach_file` text,
  `small_photo` text,
  `valid_upto` date DEFAULT NULL,
  PRIMARY KEY (`news_id`),
  KEY `news_publisher` (`news_publisher`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orgn_mas`
--

DROP TABLE IF EXISTS `orgn_mas`;
CREATE TABLE IF NOT EXISTS `orgn_mas` (
  `orgn_id` int(5) NOT NULL AUTO_INCREMENT,
  `orgn_nm` varchar(45) NOT NULL,
  `about_me` text,
  `orgn_tag` text,
  `orgn_abbr` varchar(6) DEFAULT NULL,
  `orgn_addr1` text,
  `orgn_addr2` text,
  `orgn_logo` text,
  `footer_logo` text,
  `cont_per_no` varchar(15) DEFAULT NULL,
  `cont_per_no2` varchar(15) DEFAULT NULL,
  `cont_per_email` text,
  `favicon` text,
  `email_id` text,
  `web_addr` text,
  `map_addr` text,
  `cont_per` varchar(35) DEFAULT NULL,
  `active_year` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`orgn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orgn_mas`
--

INSERT INTO `orgn_mas` (`orgn_id`, `orgn_nm`, `about_me`, `orgn_tag`, `orgn_abbr`, `orgn_addr1`, `orgn_addr2`, `orgn_logo`, `footer_logo`, `cont_per_no`, `cont_per_no2`, `cont_per_email`, `favicon`, `email_id`, `web_addr`, `map_addr`, `cont_per`, `active_year`) VALUES
(1, 'Bishop George Mission School', '<div style=\"text-align: justify;\">Bishop George Edward Lynch Cotton was the son of an Army Captain, who died leading his Regiment in battle. A Scholar of Westminster, and graduate of Cambridge, in 1836. He was appointed Assistant Master at Rugby by Doctor Thomas Arnold, One of the founders of the&nbsp;<b>British Public School System</b>. It was the young Mr. Cotton who is spoken of as &quot;The Model Young Master&quot; in Thomas Hughes famous books &quot;Tom Brown&#39;s School Days&#39; which gives an insight to school life at Rugby.<br />\r\nAfter having taught for 15 years, at 1852 he was appointed Master of Marlborogh, where he established organized games and the House and perfect systems. He believed that the prefects are and shall be, as long as I am the Head, the governours of the school. As soon as I see this impracticable I will resign.&quot; He was consecrated Bishop at Westminster Abbey by the Archbishop of the Canterbury.<br />\r\nQueen Victoria personally selected Bishop Cotton as Bishop of Calcutta and Metropolitan of India, Burma and the Island of Ceylon, keeping in view the critical period in India around 1857. As Bishop of Calcutta, on 28th July, 1859 he conducted a service for the foundation of public school, the Bishop&#39;s Cotton School. He was drowned in an accident on 6th October, 1866 while&nbsp;touring Assam. Cotton, George Edward Lynch: 1812-66, English clergyman and educator, Grand, Trinity College, Cambride 1863. From 1837 intil 1852 he was an assistant master of Rug and is the &quot;Young Master&rdquo; in Thomas Hughe&#39;s Tom Brown School Days. He later became (Headmaster of Marlborong College and after 1858 served as Bishop of Calcutta, where he did extensive missionary work and established numerous school for Eurasian children.<br />\r\nGeorge Edward Lynch, Bishop of Calcutta Autograph Letter signed G. E. L. Calcutta&#39;, to Mr. Clerk, a missionary, discussing at length the rules for evangelism in the Army, and defending the Government against the charge of interference, adding that he was forwarded extracts from Clark&#39;s letter of Lord Canning, Ravenswood, George Edward Lynch Cotton (1813-1866), Master in Marlborough Bishop of Calcutta from 1858, established a number of famous schools in India and worked closely with the MISSIONARY societies. His career was closed by the &#39;calamitous accident&#39;, when the Bishop&#39;s foot slipped on a platform above the Ganges at dusk on 6th October 1866. &quot;For instance, if in an old order, (plainly not one issued with reference to these occurrence in the 24th Regt.). A captain in forbidden to go down to the Sepoy lines for the purpose of holding religious discussion with the heathen, it is an extraordinary inference to say that a missionary may not go down for the purpose of holding services for Christians.<br />\r\nGeorge Edward Lynch, Bishop of Calcutta Autograph Lewe Signed &#39;G.E.L. Calcutta&#39;, to Beufotm thanking him for his subscription to the Hill Schools, Bishop Palace [Calcutta), July (1866 in another hand). George Edward Lynch Cotton 1866), Master of Marlborogh, Bishop of Calcutta from established a number of famous schools in India and closely with the missionary societies.</div>\r\n', 'School, Student, Student Management, School Management, IVRS, VOIP, Voice logger, Call Center, Asterisk, php, MySQL, PostgreSQL,Bulk SMS, Web hosting, Customized Software, Web Design', 'BGMS', 'P-139A, C.I.T Road, Scheme-IV, Beliaghata.\r\nKolkata - 700 010', '', 'uploads/orgnization/bgms-logo.png', '/uploads/orgnization/footer-logo3.png', '33 40647899', '+91 9330067899', 'bishopgeorgemission2005@gmail.com', 'uploads/orgnization/icon.ico', '', 'https://www.bgms.in', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3626.4788714867755!2d93.9985513149985!3d24.64163998415763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDM4JzI5LjkiTiA5NMKwMDAnMDIuNyJF!5e0!3m2!1sen!2sin!4v1540487105322', 'Niraj Jaiswal', '2022-23');

-- --------------------------------------------------------

--
-- Table structure for table `page_master`
--

DROP TABLE IF EXISTS `page_master`;
CREATE TABLE IF NOT EXISTS `page_master` (
  `page_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT '1',
  `page_name` varchar(50) NOT NULL,
  `page_link` varchar(50) DEFAULT NULL,
  `parent_id` int(5) DEFAULT NULL,
  `page_content` text,
  `srl` int(5) DEFAULT NULL,
  `show_tag` varchar(1) NOT NULL DEFAULT 'T',
  `dyn_group_id` int(5) DEFAULT NULL,
  `is_parent` varchar(1) NOT NULL DEFAULT '0',
  `page_slug` varchar(50) DEFAULT NULL,
  `meta_keywords` text,
  `meta_desc` text,
  `page_slider` text,
  PRIMARY KEY (`page_id`),
  KEY `is_parent` (`is_parent`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_master`
--

INSERT INTO `page_master` (`page_id`, `branch_id`, `page_name`, `page_link`, `parent_id`, `page_content`, `srl`, `show_tag`, `dyn_group_id`, `is_parent`, `page_slug`, `meta_keywords`, `meta_desc`, `page_slider`) VALUES
(1, 1, 'Home', 'home', 0, '', 1, 'T', 2, '0', 'kolkata-home', '', '', NULL),
(2, 1, 'About', '', 0, '', 2, 'T', 2, '1', 'kolkata-about', '', '', NULL),
(3, 1, 'About Us', '', 2, '<div style=\"text-align: justify;\"><br />\r\n<span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Bishop George Edward Lynch Cotton was the son of an Army Captain, whose sudden demise&nbsp;leading his Regiment in battle. A Scholar of Westminster, and graduate of Cambridge, in 1836. He was appointed Assistant Master at Rugby by Doctor Thomas Arnold, One of the founders of the <b>British Public School System</b>. It was the young Mr. Cotton who is spoken of as &quot;The Model Young Master&quot; in Thomas Hughes famous books &quot;Tom Brown&#39;s School Days&#39; which gives an insight to school life at Rugby.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">After having taught for <strong>15 years, at 1852 </strong>he was appointed Master of Marlborogh, where he established organized games and the House and perfect systems. He believed that the prefects are and shall be, as long as I am the Head, the governor&nbsp;of the school. As soon as I see this impracticable I will resign.&quot; He was consecrated Bishop at Westminster Abbey by the Archbishop of the Canterbury.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Queen Victoria personally selected Bishop Cotton as Bishop of Calcutta and Metropolitan of India, Burma and the Island of Ceylon, keeping in view the critical period in India around 1857. As <strong>Bishop of Calcutta, on 28th July, 1859</strong> he conducted a service for the foundation of public school, the Bishop&#39;s Cotton School. He was drowned in an accident on 6th October, 1866 while&nbsp;touring Assam. Cotton, George Edward Lynch: 1812-66, English clergyman and educator, Grand, Trinity College, Cambride 1863. From 1837 intil 1852 he was an assistant master of Rug and is the &quot;Young Master&rdquo; in Thomas Hughe&#39;s Tom Brown School Days. He later became (Headmaster of Marlborong College and after 1858 served as Bishop of Calcutta, where he did extensive missionary work and established numerous school for Eurasian children.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">George Edward Lynch, Bishop of Calcutta Autograph Letter signed G. E. L. Calcutta&#39;, to Mr. Clerk, a missionary, discussing at length the rules for evangelism in the Army, and defending the Government against the charge of interference, adding that he was forwarded extracts from Clark&#39;s letter of Lord Canning, Ravenswood, George Edward Lynch Cotton (1813-1866), Master in Marlborough Bishop of Calcutta from 1858, established a number of famous schools in India and worked closely with the MISSIONARY societies. His career was closed by the &#39;calamitous accident&#39;, when the Bishop&#39;s foot slipped on a platform above the Ganges at dusk on 6th October 1866. &quot;For instance, if in an old order, (plainly not one issued with reference to these occurrence in the 24th Regt.). A captain in forbidden to go down to the Sepoy lines for the purpose of holding religious discussion with the heathen, it is an extraordinary inference to say that a missionary may not go down for the purpose of holding services for Christians.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">George Edward Lynch, Bishop of Calcutta Autograph Letter&nbsp;Signed &#39;G.E.L. Calcutta&#39;, to Beufotm thanking him for his subscription to the Hill Schools, Bishop Palace [Calcutta), July (1866 in another hand). George Edward Lynch Cotton 1866), Master of Marlborogh, Bishop of Calcutta from established a number of famous schools in India and closely with the missionary societies.</span></span></span><br />\r\n&nbsp;</div>\r\n', 1, 'T', 2, '0', 'kolkata-about-us', 'English Medium School, Convent Schools, School in Kolkata, CBSE School in Kolkata.', 'Bishop George Mission School in Beliaghata, Kolkata is one of the leading businesses in the Schools. Also known for Convent Schools, English Medium Schools and much more. Visit www.bgms.in for Address, Contact Number, Reviews & Ratings, Photos, Maps of Bishop George Mission School, Beliaghata, Kolkata.', NULL),
(4, 1, 'Why BGMS', '', 2, '<span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b>Bishop George Mission School</b> realizes the need for excelling in academics as a foundation for building a successful career. We therefore partner with well educated, trained and motivated staff to look after our students and their academic needs. The infrastructure required to enable oneself to perform is also in place with following facilities available:</span></span></span>\r\n<ul>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Fully equipped computer laboratory with high-speed internet connection.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Fully equipped, functional and independent Physic, Chemistry and Biology Laboratory.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Audio Visual Equipment, Projector, Smart Class, Laptop &amp; Professional Sound System to enable Audio-Visual Learning &hellip;</span></span></span></li>\r\n</ul>\r\n<span style=\"font-size:16px;\"> <span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Co-Curricular Activities Offered by BGMS:</span></span></span>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Oratory skill through education, debate, extempore, declamation and group discussion.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Contemporary, classical and folk dance.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Painting and Craft-Work under able guidance, assisted by frequent exhibitions.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Sports and athletics, cricket, basketball, football, karate, yoga and other field events.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Provision of indoor games like table tennis, carrom and chess.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">A special class for students counselling and meditation is being introduced from the new session.</span></span></span></li>\r\n</ul>\r\n', 2, 'T', 2, '0', 'kolkata-why-bgms', 'English Medium School, Convent Schools, School in Kolkata, CBSE School in Kolkata.', 'Bishop George Mission School in Beliaghata, Kolkata is one of the leading businesses in the Schools. \r\nAlso known for Convent Schools, English Medium Schools and much more. Visit www.bgms.in for Address, \r\nContact Number, Reviews & Ratings, Photos, Maps of Bishop George Mission School, Beliaghata, Kolkata.', NULL),
(5, 1, 'Academics', '', 0, '', 3, 'T', NULL, '1', 'kolkata-academics', '', '', NULL),
(6, 1, 'Pre Primary', '', 5, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Augmented Learning is an on-demand learning technique where the environment adopts to the learner. For example &ndash; apps for google classes can provide video tutorials and interactive click through</span><br />\r\n<br />\r\n<span new=\"\" roman=\"\" times=\"\">Enhancement of the the psychomotor learning and skills&nbsp; - It is demonstrated by physical skills such as movement , co-ordination , manipulation , dexterity , grace , strength , speed , actions which demonstrate the five or gross motor skills , such as use of precision instruments or leads and walking.<br />\r\n<br />\r\n<img alt=\"\" height=\"267\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-13_at_11_11_28_(1).jpeg\" style=\"float:left\" width=\"200\" /></span></span></div>\r\n', 1, 'T', NULL, '0', 'kolkata-pre-primary', '', '', NULL),
(7, 1, 'Primary', '', 5, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Our school provides&nbsp;rich &amp; stimulating and caring environment in which child feels happy , safe , secure and confident . Learning at this young age should give birth to creative and enquiring minds.<br />\r\n<br />\r\n<img alt=\"\" height=\"150\" src=\"https://bgms.in/bgmsweb/uploads/media/IMG_0262_(1).JPG\" style=\"float:left\" width=\"200\" /></span></span></span></div>\r\n', 2, 'T', NULL, '0', 'kolkata-primary', '', '', NULL),
(8, 1, 'Secondary', '', 5, 'Secondary school is the next step up from primary school. Secondary schools are often called&nbsp;<b>high schools or middle school</b>&nbsp;.&nbsp; A person generally starts middle school at age 11 or 12 and starts high school at age 14 or 15 and finishes at age 18. Generally a student goes to the high school for four years.<br />\r\n<br />\r\nThe start of&nbsp;<b>lower secondary education</b>&nbsp;is characterised by the transition from the single-class-teacher, who delivers all content to a cohort of pupils, to one where content is delivered by a series of subject specialists. Its educational aim is to complete provision of basic education (thereby completing the delivery of basic skills) and to lay the foundations for lifelong learning.<br />\r\n<b>(Upper) secondary education</b>&nbsp;starts on the completion of basic education, which also is defined as completion of lower secondary education. The educational focus is varied according to the student&#39;s interests and future direction. Education at this level is usually voluntary.<br />\r\n<br />\r\n<img alt=\"\" height=\"90\" src=\"https://bgms.in/bgmsweb/uploads/media/Screenshot_20211217-180838_(1).jpg\" style=\"float:left\" width=\"200\" />', 3, 'T', NULL, '0', 'kolkata-secondary', '', '', NULL),
(9, 1, 'Digital Learning', '', 5, '<span style=\"color:#d35400;\"><span style=\"font-size:16px;\">We provide VAWSUM&#39;S Social Learning Network, uses the insights of social Network to make Education more effective.</span></span><br />\r\nhttps://play.google.com/store/apps/details?id=com.vawsum', 4, 'T', NULL, '0', 'kolkata-digital-learning', '', '', '/uploads/page/kolkata-digital-learning.jpeg'),
(10, 1, 'Robotics Curriculum', '', 5, '', 5, 'F', NULL, '0', 'kolkata-robotics-curriculum', '', '', NULL),
(11, 1, 'Activities', '', 0, '', 4, 'T', NULL, '1', 'kolkata-activities', '', '', NULL),
(12, 1, 'Art', '', 11, '<span style=\"color:#16a085;\"><span style=\"font-size:16px;\">Art education </span></span>also fosters collaboration and group learning. Often times, it brings people and children together, helping them learn from, and aid each other as they persevere towards creating something. It improves emotional balance and helps kids become team players. It also improves accountability, as kids claim responsibility for their mistakes and accept their faults when working together.<br />\r\n<br />\r\n<img alt=\"\" height=\"200\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-13_at_11_11_351.jpeg\" style=\"float:left\" width=\"200\" />', 1, 'T', NULL, '0', 'kolkata-art', '', '', NULL),
(13, 1, 'Music', '', 11, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Music education is highly beneficial to students. Music positively impacts a child&#39;s academic performance. Music helps in developing social skills and makes a child creative. Music classes break class monotony and help students to get a break from their classes. School music classes help improve language development because music is closely related to our everyday speech and conversation. Music also helps students to develop good reading skills.<br />\r\n<br />\r\nMUSIC TEACHER : Tamalika Chatterjee<br />\r\n<br />\r\n<img alt=\"\" height=\"133\" src=\"https://bgms.in/bgmsweb/uploads/media/IMG_0927_(1).JPG\" style=\"float:left\" width=\"200\" /></span></span></span></div>\r\n', 2, 'T', NULL, '0', 'kolkata-music', '', '', NULL),
(14, 1, 'Dance', '', 11, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Dance helps children to develop literacy , thus the learning art of dance helps young children to develop knowledge , skill &amp; also understanding about the world. Learning dance improves agility , flexibility , improves balance &amp; co-ordination which improves mood &amp; attitude of a child while he or she learn moves &amp; perform.<br />\r\n<br />\r\n<br />\r\nDANCE TEACHER : Swapna Chakraborty Saha</span></span><br />\r\n<br />\r\n<img alt=\"\" height=\"150\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-05_at_19_58_383.jpeg\" width=\"200\" /></div>\r\n', 3, 'T', NULL, '0', 'kolkata-dance', '', '', NULL),
(15, 1, 'Theatre', '', 11, '<br />\r\n<span style=\"font-size:16px;\"><span style=\"color:#c0392b;\">Theatre</span></span> helps to breakdown stereotypes, generate empathy, stimulate cooperation, reasoning and the ability to be critical. Focusing on teamwork in every class reinforces the skills in particular among others.<br />\r\n<br />\r\n<img alt=\"\" height=\"133\" src=\"https://bgms.in/bgmsweb/uploads/media/DSC_00362.JPG\" style=\"float:left\" width=\"200\" />', 3, 'T', NULL, '0', 'kolkata-theatre', '', '', NULL),
(16, 1, 'Sports', '', 11, '<ul>\r\n	<li>Stay Healthy. Sports help students to stay healthy. ...</li>\r\n	<li>Good Fitness Level. ...</li>\r\n	<li>Develop Leadership skills. ...</li>\r\n	<li>Positive Mentoring. ...</li>\r\n	<li>Boost Emotional Fitness. ...</li>\r\n	<li>Develop Social Life. ...</li>\r\n	<li>Develop Discipline. ...</li>\r\n	<li>Better Performance in Academics</li>\r\n</ul>\r\n<br />\r\n<br />\r\n<img alt=\"\" height=\"267\" src=\"https://bgms.in/bgmsweb/uploads/media/IMG-20200119-WA00111.jpg\" style=\"float:left\" width=\"200\" />', 5, 'T', NULL, '0', 'kolkata-sports', '', '', NULL),
(17, 1, 'No Bags Day', '', 11, '<ul>\r\n	<li><span style=\"color:#e67e22;\">Grandparents Day</span></li>\r\n	<li><span style=\"color:#e67e22;\">Fruits Salad Day</span></li>\r\n	<li><span style=\"color:#e67e22;\">Mango Day</span></li>\r\n	<li><span style=\"color:#e67e22;\">Rakhi Making Day</span></li>\r\n	<li><span style=\"color:#e67e22;\">Diya Making Day</span></li>\r\n</ul>\r\n<br />\r\n<br />\r\n<img alt=\"\" height=\"250\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-13_at_11_11_59_(2).jpeg\" style=\"float:left\" width=\"200\" />', 6, 'T', NULL, '0', 'kolkata-no-bags-day', '', '', NULL),
(18, 1, 'Admission', '', 0, '', 6, 'T', NULL, '1', 'kolkata-admission', '', '', NULL),
(19, 1, 'Admission Procedure', '', 18, '<div style=\"text-align: justify;\">A dmission forms are avilable in the school office for both the brunches from 10 :00 am - 4:00 pm along with different banks and its branches mentioned below.<br />\r\n<br />\r\n<br />\r\n<span style=\"font-family: Calibri, sans-serif; font-size: 16px;\">Step &ndash; 1 : Collect Prospectus and Admission forms from reception.</span></div>\r\n<span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Step &ndash; 2 : Schedule appointment for an interaction interview if required.</span></span><br />\r\n<span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Step &ndash; 3 : Wait for results on school notice board.</span></span><br />\r\n<span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Step &ndash; 4 : If admission is granted, collect Admission form. Fill in the Admission Form, and submit required documents to the school office.</span></span><br />\r\n<br />\r\n<span style=\"color:#2980b9;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><u>Following is a list of attested documents which will be required during admission procedures:</u></b></span></span></span></span>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Birth Certificate (Original to be produced and duplicate to be submitted).</span></span></span></li>\r\n	<li><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Progress Report of Previous School Attended.</span></span></span></li>\r\n	<li><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Transfer Certificate of Previous school attested (Original Copy).</span></span></span></li>\r\n	<li><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Migration Certificate where applicable.</span></span></span></li>\r\n	<li><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">3 copies passport size photographs of the student and parents.</span></span></span></li>\r\n</ul>\r\n<span style=\"font-size:16px;\"><span style=\"color:#2980b9;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b><u>Guidelines for parents:</u></b></span></span></span></span>\r\n\r\n<ul>\r\n	<li>Guardians are expected to check school diary regularly.</li>\r\n	<li>Guardians are requested to take part in seminars and other functions arranged by the School.</li>\r\n	<li>Guardians should attend parent teachers&#39; meeting for proper evaluation of their students.</li>\r\n	<li>On the day examination, if a child is unable to attend the school, because of illness or any unavoidable circumstances, the information must reach to the office on the same day with assisting documents.</li>\r\n	<li>If a student is absent for a long period of time, parents are requested to send an absent letter to school with supporting documents.</li>\r\n	<li>Guardians must ensure that their children com eto the school in proper, clean uniform.</li>\r\n	<li>Guardians are also requested tot check the exercise books of their children from time to time and keep at track of their classwork&#39;s and homework&#39;s.</li>\r\n</ul>\r\n', 1, 'T', NULL, '0', 'kolkata-admission-procedure', 'English Medium School, Convent Schools, School in Kolkata, CBSE School in Kolkata.', 'Bishop George Mission School in Beliaghata, Kolkata is one of the leading businesses in the Schools. \r\nAlso known for Convent Schools, English Medium Schools and much more. Visit www.bgms.in for Address, \r\nContact Number, Reviews & Ratings, Photos, Maps of Bishop George Mission School, Beliaghata, Kolkata.\r\n', NULL),
(20, 1, 'Application Form', '', 18, 'Admission forms are available in the school office for both the branches from 10:00 am to 4:00 pm along with different banks and its branches mentioned below.<br />\r\nIDFC&nbsp;FIRST&nbsp;Bank&nbsp; CIT More,&nbsp; Beleghata ,Sector 2&nbsp; and Sector 5 Salt Lake Kolkata Branch and ICICI Bank for our Ghatakpukur Branch.<br />\r\nAdmission Forms will be available from our Respective School campuses and also Online through Admission Tree Portal of TTIS , Furthermore one can also procure Admission Forms from the different Branches of IDFC First Bank located at CIT Road Crossing Beleghata, Sector 5 Salt Lake, Sector 2 Salt Lake for our Kolkata School and in ICICI Branch at Ghatakpukur Crossing in South 24 Parganas. for our New Branch at Ghatakpukur.<br />\r\nTo top it all its worth mentioning that we are Proud to be associated with <strong><span style=\"color:#d35400;\"><span style=\"font-size:16px;\">Oxford University Press</span>.</span></strong>.(OUP) as our Educational Partners.', 2, 'T', NULL, '0', 'kolkata-application-form', '', '', NULL),
(21, 1, 'Blog', 'blog', 0, '', 6, 'F', NULL, '0', 'kolkata-blog', '', '', NULL),
(22, 1, 'Contact Us', 'contact', 0, '', 7, 'T', NULL, '0', 'kolkata-contact-us', 'English Medium School, Convent Schools, School in Kolkata, CBSE School in Kolkata.', 'Bishop George Mission School in Beliaghata, Kolkata is one of the leading businesses in the Schools. \r\nAlso known for Convent Schools, English Medium Schools and much more. Visit www.bgms.in for Address, \r\nContact Number, Reviews & Ratings, Photos, Maps of Bishop George Mission School, Beliaghata, Kolkata.', NULL),
(23, 1, 'Gallery', 'gallery', 0, '', 6, 'T', NULL, '1', 'kolkata-gallery', '', '', NULL),
(26, 1, 'Photo Gallery', 'gallery', 23, '', 1, 'T', NULL, '0', 'kolkata-photo-gallery', '', '', NULL),
(27, 1, 'Events', 'event', 0, '', 5, 'F', NULL, '0', 'kolkata-events', '', '', NULL),
(28, 1, 'Facility', 'facility', 11, '', 10, 'T', NULL, '0', 'kolkata-facility', '', '', NULL),
(29, 1, 'Teacher', 'teacher', 5, '', 5, 'T', NULL, '0', 'kolkata-teacher', '', '', NULL),
(30, 1, 'Video Gallery', 'video', 23, '', 2, 'T', NULL, '0', 'kolkata-video-gallery', '', '', NULL),
(31, 1, 'Our AIMS', '', 2, '<div style=\"text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"text-align: justify;\"><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">a) Utmost attention of the psychology of each child.</span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">b) Proper training and development of sense faculties of sight</span><span style=\"font-size:18.0pt\"> hearing, smell, touch, taste and aesthetic sense. </span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">c) Training of mental faculties, e.g. Observation, attention ,</span><span style=\"font-size:18.0pt\"> memory, judgments, imagination etc. Growth of mental awareness in an atmosphere of joy and freedom. </span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">d) Moral training by the method of suggestion, not by command</span><span style=\"font-size:18.0pt\"> or imposition or merely by teaching the dogmas of religion. </span></span></span><br />\r\n<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Curriculum in the classes will be adopted and developed so as &nbsp;to achieve the above mentioned objectives.</span></span></span><br />\r\n<br />\r\n&nbsp;</div>\r\n', 3, 'T', NULL, '0', 'kolkata-our-aims', '', '', NULL),
(32, 1, 'Infrastructure', '', 2, '<ul>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">&nbsp;Personalised app online classes</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Security &amp; CCTV Survilance</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Science laboratory with modern equipments</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Library with over 6000 books</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Football &amp; Cricket field , Basketball Court , Volley Court &amp; Children Playground</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Computer Laboratory with&nbsp; computers and internet facility</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">A highly popular school canteen</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Smart class audio &ndash; visual arrangement for every single class</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">A well equipped Music &amp; Dance rooms for all in house training</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Power backup &amp; 24x7 water supply</span></span></span></li>\r\n	<li style=\"margin-top:0cm; margin-right:0cm; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18.0pt\">Medical Room</span></span></span></li>\r\n</ul>\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n&nbsp;', 4, 'T', NULL, '0', 'kolkata-infrastructure', '', '', NULL),
(33, 1, 'We Provide', '', 2, '<div style=\"text-align: center;\">\r\n<ul>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Trained , efficient &amp; dedicated staff following inclusive educational practices online as well as offline.</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Affordable fees structure</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Back to school with Covid Protocols in place &ndash; sanitised state of the art infrastructure &amp; vaccinated staff ensuring safety &amp; good health.</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Global Exposure:&nbsp;Participation of the students in International &amp; National level competition and workshops</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Competency based education improve student learning outcomes</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">&nbsp;Addition co-scholastic subjects like abacus, coding and olympiad</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Play way method in pre-primary &amp; primary sections</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Transport facility available</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Health care facility</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">24 hours power &amp; water supply</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Yoga, Karate &amp; Meditation</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Committed to provide hygienic &amp; safe environment</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Courses:&nbsp;Science , Commerce &amp; Arts</span></span></li>\r\n	<li style=\"margin-top: 0cm; margin-right: 0cm; margin-bottom: 5pt; text-align: left;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\">Alumni:&nbsp;Rank holders name, batch, profession along with pictures</span></span></li>\r\n</ul>\r\n</div>\r\n', 5, 'T', NULL, '0', 'kolkata-we-provide', '', '', NULL),
(34, 2, 'Home', 'home', 0, '', 1, 'T', NULL, '0', 'ghatakpukur-home', '', '', NULL),
(35, 2, 'About', '', 0, '', 2, 'T', NULL, '1', 'ghatakpukur-about', '', '', NULL),
(36, 2, 'About Us', '', 35, '<div style=\"text-align: justify;\"><br />\r\n<span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Bishop George Edward Lynch Cotton was the son of an Army Captain, whose sudden demise&nbsp;leading his Regiment in battle. A Scholar of Westminster, and graduate of Cambridge, in 1836. He was appointed Assistant Master at Rugby by Doctor Thomas Arnold, One of the founders of the <b>British Public School System</b>. It was the young Mr. Cotton who is spoken of as &quot;The Model Young Master&quot; in Thomas Hughes famous books &quot;Tom Brown&#39;s School Days&#39; which gives an insight to school life at Rugby.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">After having taught for <strong>15 years, at 1852 </strong>he was appointed Master of Marlborogh, where he established organized games and the House and perfect systems. He believed that the prefects are and shall be, as long as I am the Head, the governor&nbsp;of the school. As soon as I see this impracticable I will resign.&quot; He was consecrated Bishop at Westminster Abbey by the Archbishop of the Canterbury.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Queen Victoria personally selected Bishop Cotton as Bishop of Calcutta and Metropolitan of India, Burma and the Island of Ceylon, keeping in view the critical period in India around 1857. As <strong>Bishop of Calcutta, on 28th July, 1859</strong> he conducted a service for the foundation of public school, the Bishop&#39;s Cotton School. He was drowned in an accident on 6th October, 1866 while&nbsp;touring Assam. Cotton, George Edward Lynch: 1812-66, English clergyman and educator, Grand, Trinity College, Cambride 1863. From 1837 intil 1852 he was an assistant master of Rug and is the &quot;Young Master&rdquo; in Thomas Hughe&#39;s Tom Brown School Days. He later became (Headmaster of Marlborong College and after 1858 served as Bishop of Calcutta, where he did extensive missionary work and established numerous school for Eurasian children.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">George Edward Lynch, Bishop of Calcutta Autograph Letter signed G. E. L. Calcutta&#39;, to Mr. Clerk, a missionary, discussing at length the rules for evangelism in the Army, and defending the Government against the charge of interference, adding that he was forwarded extracts from Clark&#39;s letter of Lord Canning, Ravenswood, George Edward Lynch Cotton (1813-1866), Master in Marlborough Bishop of Calcutta from 1858, established a number of famous schools in India and worked closely with the MISSIONARY societies. His career was closed by the &#39;calamitous accident&#39;, when the Bishop&#39;s foot slipped on a platform above the Ganges at dusk on 6th October 1866. &quot;For instance, if in an old order, (plainly not one issued with reference to these occurrence in the 24th Regt.). A captain in forbidden to go down to the Sepoy lines for the purpose of holding religious discussion with the heathen, it is an extraordinary inference to say that a missionary may not go down for the purpose of holding services for Christians.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">George Edward Lynch, Bishop of Calcutta Autograph Letter&nbsp;Signed &#39;G.E.L. Calcutta&#39;, to Beufotm thanking him for his subscription to the Hill Schools, Bishop Palace [Calcutta), July (1866 in another hand). George Edward Lynch Cotton 1866), Master of Marlborogh, Bishop of Calcutta from established a number of famous schools in India and closely with the missionary societies.</span></span></span><br />\r\n&nbsp;</div>\r\n', 1, 'T', NULL, '0', 'ghatakpukur-about-us', '', '', NULL),
(37, 2, 'Why BGMS', '', 35, '<span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><b>Bishop George Mission School</b> realizes the need for excelling in academics as a foundation for building a successful career. We therefore partner with well educated, trained and motivated staff to look after our students and their academic needs. The infrastructure required to enable oneself to perform is also in place with following facilities available:</span></span></span>\r\n<ul>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Fully equipped computer laboratory with high-speed internet connection.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Fully equipped, functional and independent Physic, Chemistry and Biology Laboratory.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Audio Visual Equipment, Projector, Smart Class, Laptop &amp; Professional Sound System to enable Audio-Visual Learning &hellip;</span></span></span></li>\r\n</ul>\r\n<span style=\"font-size:16px;\"> <span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Co-Curricular Activities Offered by BGMS:</span></span></span>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Oratory skill through education, debate, extempore, declamation and group discussion.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Contemporary, classical and folk dance.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Painting and Craft-Work under able guidance, assisted by frequent exhibitions.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Sports and athletics, cricket, basketball, football, karate, yoga and other field events.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 0cm 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">Provision of indoor games like table tennis, carrom and chess.</span></span></span></li>\r\n	<li style=\"text-align:justify; margin:0cm 0cm 8pt 36pt\"><span style=\"font-size:16px;\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">A special class for students counselling and meditation is being introduced from the new session.</span></span></span></li>\r\n</ul>\r\n', 2, 'T', NULL, '0', 'ghatakpukur-why-bgms', '', '', NULL),
(38, 2, 'Our AIMS', '', 35, '<div style=\"text-align: justify;\"><span style=\"font-size:18px;\"><span new=\"\" roman=\"\" times=\"\">a) Utmost attention of the psychology of each child.</span><br />\r\n<span new=\"\" roman=\"\" times=\"\">b) Proper training and development of sense faculties of sight hearing, smell, touch, taste and aesthetic sense. </span><br />\r\n<span new=\"\" roman=\"\" times=\"\">c) Training of mental faculties, e.g. Observation, attention , memory, judgments, imagination etc. Growth of mental awareness in an atmosphere of joy and freedom. </span><br />\r\n<span new=\"\" roman=\"\" times=\"\">d) Moral training by the method of suggestion, not by command or imposition or merely by teaching the dogmas of religion. </span><br />\r\n<span new=\"\" roman=\"\" times=\"\">Curriculum in the classes will be adopted and developed so as &nbsp;to achieve the above mentioned objectives.</span></span><br />\r\n&nbsp;</div>\r\n', 3, 'T', NULL, '0', 'ghatakpukur-our-aims', '', '', NULL),
(39, 2, 'Infrastructure', '', 35, '<ul>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Personalised app online classes</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Security &amp; CCTV Surveillance</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Science laboratory with modern equipments</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Separate Labotary for physics ,Chemistry , Biology</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Library with over 6000&nbsp;books</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Smart Classes</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Football &amp; Cricket field , Basketball Court , Volley Court &amp; Children Playground</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Computer Laboratory with&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Computers and Internet facility</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Hygenic&nbsp; School Canteen</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Swimming Pool</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Filtered water&nbsp; supply with RO plant</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Smart class&nbsp;audio &ndash; Visual arrangement for every single class</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">A well equipped Music &amp; Dance rooms for all in house training</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Power backup &amp; 24x7 water supply</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Sound &amp; Air Pollution free environment</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Indoor activities &ndash; Table Tennis , Carrom &amp; Chess Board</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Medical Room</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Auditorium </span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Assembly Hall</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">All&nbsp; Class Room with Smoke&nbsp; Ditectors and&nbsp; Hooters</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">pollution free Campus</span></span></span></li>\r\n</ul>\r\n', 4, 'T', NULL, '0', 'ghatakpukur-infrastructure', '', '', NULL),
(40, 2, 'We Provide', '', 35, '<ul>\r\n	<li>Trained , efficient &amp; dedicated staff following inclusive educational practices online as well as offline.</li>\r\n	<li>Affordable fees structure</li>\r\n	<li>Back to school with Covid Protocols in place &ndash; sanitised state of the art infrastructure &amp; vaccinated staff ensuring safety &amp; good health.</li>\r\n	<li>Global Exposure:&nbsp;Participation of the students in International &amp; National level competition and workshops</li>\r\n	<li>Competency based education improve student learning outcomes</li>\r\n	<li>&nbsp;Addition co-scholastic subjects like abacus, coding and olympaid</li>\r\n	<li>Play way method in pre-primary &amp; primary sections</li>\r\n	<li>Transport facility available</li>\r\n	<li>Health care facility</li>\r\n	<li>24 hours power &amp; water supply</li>\r\n	<li>Yoga, Karate &amp; Meditation</li>\r\n	<li>Committed to provide hygienic &amp; safe environment</li>\r\n	<li>Courses:&nbsp;Science , Commerce &amp; Arts</li>\r\n	<li>Alumni:&nbsp;Rank holders name, batch, profession along with pictures</li>\r\n	<li>More successful Alumnis&#39; are still in the queue .We at BGMS pray for their success and prosperous future.</li>\r\n</ul>\r\n', 5, 'T', NULL, '0', 'ghatakpukur-we-provide', '', '', NULL),
(41, 2, 'Academics', '', 0, '', 3, 'T', NULL, '1', 'ghatakpukur-academics', '', '', NULL),
(42, 2, 'Pre Primary', '', 41, '<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" height=\"240\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-05_at_14_56_152.jpeg\" width=\"400\" /></td>\r\n			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\r\n			<td style=\"text-align: justify;\">Augmented Learning is an on-demand learning technique where the environment adopts to the learner.&nbsp;For example &ndash; apps for google classes can provide video tutorials and interactive click through Enhancement of the the sychomotor learning and skills&nbsp; - It is demonstrated by physical skills such as&nbsp; &nbsp; movement , co-ordination , manipulation , dexterity , grace , strength , speed , actions which demonstrate&nbsp; &nbsp;the five or gross motor skills , such as use of precision instruments or tools.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 1, 'T', NULL, '0', 'ghatakpukur-pre-primary', '', '', NULL),
(43, 2, 'Primary', '', 41, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\"><span style=\"color:black\">PRIMARY<br />\r\nOur school providing rich &amp; simulating and caring environment in which child feels happy , safe , secure and confident . Learning at this young age should give birth to creative and enquiring minds.</span></span></span></span><br />\r\n&nbsp;</div>\r\n\r\n<div style=\"text-align: justify;\"><img alt=\"\" height=\"150\" src=\"https://bgms.in/bgmsweb/uploads/media/IMG_0262_(1)1.JPG\" style=\"float:left\" width=\"200\" /><br />\r\n<br />\r\n&nbsp;</div>\r\n', 2, 'T', NULL, '0', 'ghatakpukur-primary', '', '', NULL),
(44, 2, 'Secondary', '', 41, '<br />\r\nSecondary school is the next step up from primary school. Secondary schools are often called&nbsp;<b>high schools or middle school</b>&nbsp;.&nbsp; A person generally starts middle school at age 11 or 12 and starts high school at age 14 or 15 and finishes at age 18. Generally a student goes to the high school for four years.<br />\r\n<br />\r\nThe start of&nbsp;<b>lower secondary education</b>&nbsp;is characterised by the transition from the single-class-teacher, who delivers all content to a cohort of pupils, to one where content is delivered by a series of subject specialists. Its educational aim is to complete provision of basic education (thereby completing the delivery of basic skills) and to lay the foundations for lifelong learning.<br />\r\n<b>(Upper) secondary education</b>&nbsp;starts on the completion of basic education, which also is defined as completion of lower secondary education. The educational focus is varied according to the student&#39;s interests and future direction. Education at this level is usually voluntary.<br />\r\n<br />\r\n<img alt=\"\" height=\"135\" src=\"https://bgms.in/bgmsweb/uploads/media/Screenshot_20211217-180838_(1)1.jpg\" style=\"float:left\" width=\"300\" />', 3, 'T', NULL, '0', 'ghatakpukur-secondary', '', '', NULL),
(45, 2, 'Digital Learning', '', 41, '<span style=\"font-size:16px;\">We provide VAWSUM&#39;S Social Learning Network, </span>uses the insights of social Network to make Education more effective.<br />\r\nhttps://play.google.com/store/apps/details?id=com.vawsum<br />\r\n<br />\r\n<img alt=\"\" height=\"353\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-26_at_10_23_00.jpeg\" style=\"float:left\" width=\"200\" />', 4, 'T', NULL, '0', 'ghatakpukur-digital-learning', '', '', '/uploads/page/ghatakpukur-digital-learning.jpeg'),
(46, 2, 'Robotics Curriculum', '', 41, '', 5, 'F', NULL, '0', 'ghatakpukur-robotics-curriculum', '', '', NULL),
(47, 2, 'Teacher', 'teacher', 41, '', 5, 'T', NULL, '0', 'ghatakpukur-teacher', '', '', NULL),
(48, 2, 'Activities', '', 0, '<strong>Activities</strong><br />\r\n<em>School based&nbsp; activity provides stuctural oppurrtunity for students to learn more about themselves, concider their options and thoughtfully begin to prepare for their next steps.</em>', 4, 'T', NULL, '1', 'ghatakpukur-activities', '', '', NULL),
(49, 2, 'Art', '', 48, '<span style=\"color:#d35400;\"><em><strong>Art and craft </strong></em></span>activities help instil a sense of achievement and pride in children boosting their self confidence.The opportunity to create whatever a child desires help foster creativity.<br />\r\n&nbsp;<br />\r\n<img alt=\"\" height=\"200\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-13_at_11_12_03_(1).jpeg\" style=\"float:left\" width=\"200\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', 1, 'T', NULL, '0', 'ghatakpukur-art', '', '', NULL);
INSERT INTO `page_master` (`page_id`, `branch_id`, `page_name`, `page_link`, `parent_id`, `page_content`, `srl`, `show_tag`, `dyn_group_id`, `is_parent`, `page_slug`, `meta_keywords`, `meta_desc`, `page_slider`) VALUES
(50, 2, 'Music', '', 48, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Music education is highly beneficial to students. Music positively impacts a child&#39;s academic performance. Music helps in developing social skills and makes a child creative. Music classes break class monotony and help students to get a break from their classes. School music classes help improve language development because music is closely related to our everyday speech and conversation. Music also helps students to develop good reading skills.</span></span></span></div>\r\n&nbsp;<br />\r\nMUSUC TEACHER&nbsp; :&nbsp; Tamalika&nbsp; Chatterjee&nbsp;<br />\r\n<br />\r\n<img alt=\"\" height=\"100\" src=\"https://bgms.in/bgmsweb/uploads/media/IMG_0927.JPG\" style=\"float:left\" width=\"150\" />', 2, 'T', NULL, '0', 'ghatakpukur-music', '', '', NULL),
(51, 2, 'Dance', '', 48, '<div style=\"text-align: justify;\"><span style=\"font-size:16px;\"><span new=\"\" roman=\"\" times=\"\"><span lang=\"EN-IN\">Dance helps children to develop literacy , thus the learning art of dance helps young children to develop knowledge , skill &amp; also understanding about the world. Learning dance improves agility , flexibility , improves balance &amp; co-ordination which improves mood &amp; attitude of a child while he or she learn moves &amp; perform.</span></span></span></div>\r\n<br />\r\nDANCE TEACHER :&nbsp; Swapna&nbsp; Chakraborty Saha<br />\r\n&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<br />\r\n<img alt=\"\" height=\"225\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-05_at_20_02_49.jpeg\" style=\"float:left\" width=\"150\" />', 3, 'T', NULL, '0', 'ghatakpukur-dance', '', '', NULL),
(52, 2, 'Theatre', '', 48, '<br />\r\n<em><strong><span style=\"color:#8e44ad;\">Theatre</span></strong></em> helps to breakdown stereotypes, generate empathy, stimulate cooperation, reasoning and the ability to be critical. Focusing on teamwork in every class reinforces the skills in particular among others.<br />\r\n<br />\r\n<img alt=\"\" height=\"133\" src=\"https://bgms.in/bgmsweb/uploads/media/DSC_00361.JPG\" style=\"float:left\" width=\"200\" />', 4, 'T', NULL, '0', 'ghatakpukur-theatre', '', '', NULL),
(53, 2, 'Sports', '', 48, '<br />\r\n<span style=\"font-size:16px;\"><strong><span style=\"color:#27ae60;\">Sports</span></strong></span> in school help prepare students to face the challenges of life.They enhance physical and mental abilities of students and help them achieve the goals of their life.<br />\r\n<br />\r\n&nbsp;\r\n<div><img alt=\"\" height=\"169\" src=\"https://bgms.in/bgmsweb/uploads/media/IMG-20200120-WA0011.jpg\" style=\"float:left\" width=\"300\" /></div>\r\n&nbsp;', 5, 'T', NULL, '0', 'ghatakpukur-sports', '', '', NULL),
(54, 2, 'No Bags Day', '', 48, '<ul>\r\n	<li>Grandparent&#39;s Day</li>\r\n	<li>Fruit Salad Day</li>\r\n	<li>Mango Day</li>\r\n	<li>Rakhi Making Day</li>\r\n	<li>Diya Making Day</li>\r\n</ul>\r\n<img alt=\"\" height=\"200\" src=\"https://bgms.in/bgmsweb/uploads/media/WhatsApp_Image_2021-12-13_at_11_12_01_(1)2.jpeg\" style=\"float:left\" width=\"200\" />', 6, 'T', NULL, '0', 'ghatakpukur-no-bags-day', '', '', NULL),
(55, 2, 'Facility', 'facility', 48, '<ul>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Trained , efficient &amp; dedicated staff following inclusive educational practices online as well as offline.</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Affordable fees structure</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Back to school with Covid Protocols in place &ndash; sanitised state of the art infrastructure &amp; vaccinated staff ensuring safety &amp; good health.</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Global Exposure :- Participation of the students in International &amp; National level competition and workshops</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Competency based education improve student learning outcomes</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">&nbsp;Addition co-scholastic subjects like abacus , coding etc</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Play way method in pre-primary &amp; primary sections</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Transport facility available</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Health care facility</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">24 hours power &amp; water supply</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Yoga , Karate &amp; Meditation</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Committed to provide hygienic &amp; safe environment</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Courses :- Science , Commerce &amp; Arts</span></span></span></li>\r\n	<li style=\"margin-top:0in; margin-right:0in; margin-bottom:5.0pt\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span lang=\"EN-IN\" style=\"font-size:18.0pt\">Alumni :- Rank holders name , batch , profession along with pictures</span></span></span></li>\r\n</ul>\r\n', 7, 'T', NULL, '0', 'ghatakpukur-facility', '', '', NULL),
(56, 2, 'Events', 'event', 0, '', 5, 'T', NULL, '0', 'ghatakpukur-events', '', '', NULL),
(57, 2, 'Admission', '', 0, '', 6, 'T', NULL, '1', 'ghatakpukur-admission', '', '', NULL),
(58, 2, 'Admission Procedure', '', 57, '<p>Step &ndash; 1 : Collect Prospectus and Admission forms from reception.<br />\r\nStep &ndash; 2 : Schedule appointment for an interaction interview if required.<br />\r\nStep &ndash; 3 : Wait for results on school notice board.<br />\r\nStep &ndash; 4 : If admission is granted, collect Admission form. Fill in the Admission Form, and submit required documents to the school office.<br />\r\n<br />\r\n<b><u>Following is a list of attested documents which will be required during admission procedures:</u></b></p>\r\n\r\n<ul>\r\n	<li>Birth Certificate (Original to be produced and duplicate to be submitted).</li>\r\n	<li>Progress Report of Previous School Attended.</li>\r\n	<li>Transfer Certificate of Previous school attested (Original Copy).</li>\r\n	<li>Migration Certificate where applicable.</li>\r\n	<li>3 copies passport size photographs of the student and parents.</li>\r\n</ul>\r\n<br />\r\n<b><u>Guidelines for parents:</u></b>\r\n\r\n<ul>\r\n	<li>Guardians are expected to check school diary regularly.</li>\r\n	<li>Guardians are requested to take part in seminars and other functions arranged by the School.</li>\r\n	<li>Guardians should attend parent teachers&#39; meeting for proper evaluation of their students.</li>\r\n	<li>On the day examination, if a child is unable to attend the school, because of illness or any unavoidable circumstances, the information must reach to the office on the same day with assisting documents.</li>\r\n	<li>If a student is absent for a long period of time, parents are requested to send an absent letter to school with supporting documents.</li>\r\n	<li>Guardians must ensure that their children com eto the school in proper, clean uniform.</li>\r\n	<li>Guardians are also requested tot check the exercise books of their children from time to time and keep at track of their classwork&#39;s and homework&#39;s.</li>\r\n</ul>\r\n', 1, 'T', NULL, '0', 'ghatakpukur-admission-procedure', '', '', NULL),
(59, 2, 'Application Form', '', 57, '<span style=\"font-size:16px;\">Admission forms are available in the school office for both the branches from 10:00 am to 4:00 pm along with different banks and its branches mentioned below.<br />\r\nIDFC&nbsp;FIRST&nbsp;Bank&nbsp; CIT More,&nbsp; Beleghata ,Sector 2&nbsp; and Sector 5 Salt Lake Kolkata Branch and ICICI Bank for our Ghatakpukur Branch.<br />\r\nAdmission Forms will be available from our Respective School campuses and also Online through Admission Tree Portal of TTIS , Furthermore one can also procure Admission Forms from the different Branches of IDFC First Bank located at CIT Road Crossing Beleghata, Sector 5 Salt Lake, Sector 2 Salt Lake for our Kolkata School and in ICICI Branch at Ghatakpukur Crossing in South 24 Parganas. for our New Branch at Ghatakpukur.<br />\r\nTo top it all its worth mentioning that we are Proud to be associated with Oxford University Press..(OUP) as our Educational Partners.</span>', 2, 'T', NULL, '0', 'ghatakpukur-application-form', '', '', NULL),
(60, 2, 'Blog', 'blog', 0, '', 7, 'F', NULL, '0', 'ghatakpukur-blog', '', '', NULL),
(61, 2, 'Gallery', '', 0, '', 8, 'T', NULL, '1', 'ghatakpukur-gallery', '', '', NULL),
(62, 2, 'Contact Us', 'contact', 0, '', 9, 'T', NULL, '0', 'ghatakpukur-contact-us', '', '', NULL),
(63, 2, 'Photo Gallery', 'gallery', 61, '', 1, 'T', NULL, '0', 'ghatakpukur-photo-gallery', '', '', NULL),
(64, 2, 'Video Gallery', 'video', 61, '', 2, 'T', NULL, '0', 'ghatakpukur-video-gallery', '', '', NULL),
(65, 1, 'Karate', '', 48, '', 6, 'T', NULL, '0', 'kolkata-karate', '', '', NULL),
(66, 1, 'Support Staff', '', 5, '', 6, 'F', NULL, '0', 'kolkata-support-staff', '', '', NULL),
(67, 2, 'Support Staff', '', 41, '', 6, 'F', NULL, '0', 'ghatakpukur-support-staff', '', '', NULL),
(68, 1, 'Reviews', '', 2, '<strong><span style=\"font-size:18px;\"><span style=\"background-color:#2ecc71;\">S</span></span>&nbsp;</strong> &nbsp; &nbsp; &nbsp;&quot; I am really satisfied by the way of teaching.<br />\r\n<br />\r\n<span style=\"font-size:16px;\"><strong><span style=\"background-color:#e67e22;\">V</span></strong></span>&nbsp; &nbsp; &nbsp; &nbsp;&quot; Very helpful teachers&nbsp; and staff.<br />\r\n<br />\r\n<strong><span style=\"font-size:16px;\"><span style=\"background-color:#2980b9;\">A</span></span></strong>&nbsp; &nbsp; &nbsp; &nbsp;&quot; Teaching&nbsp; quality&nbsp; and teachers are very good. Fees structure is also reasionable, moderate.<br />\r\n<br />\r\n<strong><span style=\"font-size:16px;\"><span style=\"background-color:#f1c40f;\">T&nbsp;</span><span style=\"background-color:#9b59b6;\"> </span></span></strong>&nbsp; &nbsp; &quot; A very good school which&nbsp; focuses on holistic development.', 6, 'T', NULL, '0', 'kolkata-reviews', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo_master`
--

DROP TABLE IF EXISTS `photo_master`;
CREATE TABLE IF NOT EXISTS `photo_master` (
  `photo_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `photo_nm` varchar(100) DEFAULT NULL,
  `photo_slug` varchar(120) DEFAULT NULL,
  `photo_content` text,
  `photo_path` text,
  UNIQUE KEY `photo_id` (`photo_id`),
  KEY `cat_id` (`cat_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo_master`
--

INSERT INTO `photo_master` (`photo_id`, `branch_id`, `cat_id`, `photo_nm`, `photo_slug`, `photo_content`, `photo_path`) VALUES
(59, 1, 1, 'BGMS-Sports-1', 'kolkata-bgms-sports-1', '', '/uploads/photo/bgms-sports-1.jpg'),
(60, 1, 1, 'BGMS-Sports-2', 'kolkata-bgms-sports-2', '', '/uploads/photo/bgms-sports-2.jpg'),
(61, 1, 1, 'BGMS-Sports-3', 'kolkata-bgms-sports-3', '', '/uploads/photo/bgms-sports-3.jpg'),
(62, 1, 1, 'BGMS-Sports-4', 'kolkata-bgms-sports-4', '', '/uploads/photo/bgms-sports-4.jpg'),
(63, 1, 1, 'BGMS-Sports-5', 'kolkata-bgms-sports-5', '', '/uploads/photo/bgms-sports-5.jpg'),
(64, 1, 1, 'BGMS-Sports-6', 'kolkata-bgms-sports-6', '', '/uploads/photo/bgms-sports-6.jpg'),
(65, 1, 1, 'BGMS-Sports-7', 'kolkata-bgms-sports-7', '', '/uploads/photo/bgms-sports-7.jpg'),
(66, 1, 1, 'BGMS-Sports-8', 'bgms-sports-8', '', '/uploads/photo/bgms-sports-8.jpg'),
(67, 1, 2, 'Annual Function 1', 'kolkata-annual-function-1', '', '/uploads/photo/annual-function-1.JPG'),
(68, 1, 2, 'Annual Function 2', 'annual-function-2', '', '/uploads/photo/annual-function-2.JPG'),
(72, 1, 2, 'Annual Function 6', 'kolkata-annual-function-6', '', '/uploads/photo/annual-function-6.JPG'),
(75, 1, 3, 'TTIS - 1', 'kolkata-ttis-1', '', '/uploads/photo/ttis-1.jpg'),
(76, 1, 3, 'TTIS - 2', 'kolkata-ttis-2', '', '/uploads/photo/ttis-2.jpg'),
(77, 1, 3, 'TTIS - 3', 'kolkata-ttis-3', '', '/uploads/photo/ttis-3.jpg'),
(78, 1, 3, 'TTIS - 4', 'kolkata-ttis-4', '', '/uploads/photo/ttis-4.jpg'),
(80, 1, 1, 'BGMS-Sports-9', 'kolkata-bgms-sports-9', '', '/uploads/photo/bgms-sports-9.jpg'),
(81, 1, 1, 'BGMS-Sports-10', 'kolkata-bgms-sports-10', '', '/uploads/photo/bgms-sports-10.jpg'),
(82, 1, 1, 'BGMS-Sports-11', 'kolkata-bgms-sports-11', '', '/uploads/photo/bgms-sports-11.jpg'),
(83, 1, 5, 'Concert-1', 'kolkata-concert-1', '', '/uploads/photo/concert-1.jpg'),
(84, 1, 5, 'concert -2', 'kolkata-concert-2', '', '/uploads/photo/concert-2.jpg'),
(85, 1, 5, 'concert -3', 'kolkata-concert-3', '', '/uploads/photo/concert-3.jpg'),
(86, 2, 1, 'Sports', 'ghatakpukur-sports', '', '/uploads/photo/sports.jpg'),
(87, 2, 2, 'Annual Day 1', 'annual-day-1', '', '/uploads/photo/annual-day-1.jpg'),
(88, 2, 2, 'Annual Day 2', 'ghatakpukur-annual-day-2', '', '/uploads/photo/annual-day-2.jpg'),
(89, 2, 2, 'Annual Day 3', 'ghatakpukur-annual-day-3', '', '/uploads/photo/annual-day-3.jpg'),
(90, 2, 2, 'Annual Day 4', 'ghatakpukur-annual-day-4', '', '/uploads/photo/annual-day-4.jpg'),
(91, 2, 1, 'Sports 1', 'ghatakpukur-sports-1', '', '/uploads/photo/sports-1.jpg'),
(92, 2, 1, 'Sports 2', 'ghatakpukur-sports-2', '', '/uploads/photo/sports-2.jpg'),
(93, 2, 1, 'Sports 3', 'ghatakpukur-sports-3', '', '/uploads/photo/sports-3.jpg'),
(94, 2, 5, 'Concert 1', 'ghatakpukur-concert-1', '', '/uploads/photo/concert-1.jpg'),
(95, 2, 5, 'Concert 5', 'ghatakpukur-concert-5', '', '/uploads/photo/concert-5.jpg'),
(96, 2, 1, 'Sports 5', 'ghatakpukur-sports-5', '', '/uploads/photo/sports-5.jpg'),
(97, 2, 1, 'sports 7', 'ghatakpukur-sports-7', '', '/uploads/photo/sports-7.jpeg'),
(98, 2, 1, 'sports 8', 'sports-8', '', '/uploads/photo/sports-8.jpg'),
(99, 2, 1, 'sports 9', 'ghatakpukur-sports-9', '', '/uploads/photo/sports-9.jpg'),
(100, 2, 5, 'Concert 4', 'concert-4', '', '/uploads/photo/concert-4.JPG'),
(101, 2, 2, 'Cultural 4', 'ghatakpukur-cultural-4', '', '/uploads/photo/cultural-4.JPG'),
(102, 2, 2, 'Culture 6', 'ghatakpukur-culture-6', '', '/uploads/photo/culture-6.JPG'),
(103, 2, 2, 'Culture 8', 'culture-8', '', '/uploads/photo/culture-8.JPG'),
(104, 2, 3, 'TTIS 1', 'ghatakpukur-ttis-1', '', '/uploads/photo/ttis-1.jpeg'),
(105, 2, 3, 'TTIS 2', 'ghatakpukur-ttis-2', '', '/uploads/photo/ttis-2.jpeg'),
(106, 1, 5, 'Concert 4', 'kolkata-concert-4', '', '/uploads/photo/concert-4.JPG'),
(107, 2, 5, 'Concert 2', 'ghatakpukur-concert-2', '', '/uploads/photo/concert-2.JPG'),
(108, 2, 5, 'Concert 3', 'ghatakpukur-concert-3', '', '/uploads/photo/concert-3.JPG'),
(109, 2, 5, 'Concert 6', 'concert-6', '', '/uploads/photo/concert-6.jpg'),
(110, 2, 5, 'Concert 7', 'ghatakpukur-concert-7', '', '/uploads/photo/concert-7.JPG'),
(111, 2, 5, 'Concert 8', 'concert-8', '', '/uploads/photo/concert-8.JPG'),
(112, 2, 3, 'TTIS 3', 'ghatakpukur-ttis-3', '', '/uploads/photo/ttis-3.jpeg'),
(113, 2, 3, 'TTIS 4', 'ghatakpukur-ttis-4', '', '/uploads/photo/ttis-4.jpeg'),
(114, 2, 3, 'TTIS 5', 'ghatakpukur-ttis-5', '', '/uploads/photo/ttis-5.jpeg'),
(115, 2, 3, 'TTIS 6', 'ghatakpukur-ttis-6', '', '/uploads/photo/ttis-6.jpeg'),
(116, 2, 6, 'Karate 1', 'ghatakpukur-karate-1', '', '/uploads/photo/karate-1.jpeg'),
(117, 2, 6, 'Karate 2', 'ghatakpukur-karate-2', '', '/uploads/photo/karate-2.JPG'),
(118, 2, 6, 'Karate 3', 'ghatakpukur-karate-3', '', '/uploads/photo/karate-3.JPG'),
(119, 2, 6, 'Karate 4', 'ghatakpukur-karate-4', '', '/uploads/photo/karate-4.JPG'),
(120, 2, 6, 'Karate 6', 'ghatakpukur-karate-6', '', '/uploads/photo/karate-6.JPG'),
(121, 2, 7, 'Students corner', 'ghatakpukur-students-corner', '', '/uploads/photo/students-corner.jpeg'),
(122, 2, 7, 'Students Corner 3', 'ghatakpukur-students-corner-3', '', '/uploads/photo/students-corner-3.jpeg'),
(123, 2, 7, 'ST corner', 'ghatakpukur-st-corner', '', '/uploads/photo/st-corner.jpeg'),
(124, 1, 6, 'Karate 9', 'kolkata-karate-9', '', '/uploads/photo/karate-9.JPG'),
(125, 1, 6, 'karate 10', 'kolkata-karate-10', '', '/uploads/photo/karate-10.JPG'),
(126, 1, 6, 'karate 11', 'kolkata-karate-11', '', '/uploads/photo/karate-11.JPG'),
(127, 1, 6, 'karate 12', 'kolkata-karate-12', '', '/uploads/photo/karate-12.JPG'),
(128, 1, 7, 'students corner 5', 'kolkata-students-corner-5', '', '/uploads/photo/students-corner-5.jpeg'),
(129, 1, 7, 'students corner 7', 'kolkata-students-corner-7', '', '/uploads/photo/students-corner-7.jpeg'),
(130, 1, 7, 'students corner 8', 'kolkata-students-corner-8', '', '/uploads/photo/students-corner-8.jpeg'),
(131, 1, 7, 'students corner 10', 'kolkata-students-corner-10', '', '/uploads/photo/students-corner-10.jpeg'),
(132, 2, 8, 'Paper cutting 1', 'ghatakpukur-paper-cutting-1', '', '/uploads/photo/paper-cutting-1.jpg'),
(133, 2, 9, 'Our achievements 1', 'our-achievements-1', '', '/uploads/photo/our-achievements-1.jpg'),
(134, 2, 9, 'Our Achievements 2', 'our-achievements-2', '', '/uploads/photo/our-achievements-2.jpg'),
(135, 2, 5, 'Concert 13', 'ghatakpukur-concert-13', '', '/uploads/photo/concert-13.jpg'),
(136, 2, 5, 'Concert 14', 'ghatakpukur-concert-14', '', '/uploads/photo/concert-14.jpg'),
(137, 2, 5, 'Concert 15', 'ghatakpukur-concert-15', '', '/uploads/photo/concert-15.jpg'),
(139, 2, 2, 'Cultural program 10', 'ghatakpukur-cultural-program-10', '', '/uploads/photo/cultural-program-10.jpg'),
(140, 2, 8, 'Our Album', 'ghatakpukur-our-album', '', '/uploads/photo/our-album.jpeg'),
(152, 1, 5, 'SwamiJi', 'kolkata-swamiji', '', '/uploads/photo/swamiji.jpg'),
(153, 1, 9, 'Achivement-1', 'kolkata-achivement-1', '', '/uploads/photo/achivement-1.jpg'),
(155, 1, 9, 'achivement-3', 'kolkata-achivement-3', '', '/uploads/photo/achivement-3.jpg'),
(156, 1, 9, 'achivement-4', 'kolkata-achivement-4', '', '/uploads/photo/achivement-4.jpg'),
(157, 2, 9, 'achivement-4', 'ghatakpukur-achivement-4', '', '/uploads/photo/achivement-4.jpg'),
(158, 1, 11, 'Art-1', 'kolkata-art-1', '', '/uploads/photo/art-1.jpg'),
(159, 1, 11, 'Art-2', 'kolkata-art-2', '', '/uploads/photo/art-2.jpg'),
(160, 1, 11, 'Art-3', 'kolkata-art-3', '', '/uploads/photo/art-3.jpg'),
(161, 2, 11, 'Art-1', 'ghatakpukur-art-1', '', '/uploads/photo/art-1.jpg'),
(162, 2, 11, 'Art-2', 'ghatakpukur-art-2', '', '/uploads/photo/art-2.jpg'),
(163, 2, 11, 'Art-3', 'ghatakpukur-art-3', '', '/uploads/photo/art-3.jpg'),
(164, 2, 10, 'Play Ground 7', 'ghatakpukur-play-ground-7', '', '/uploads/photo/play-ground-7.jpg'),
(165, 2, 10, 'Play Ground 8', 'ghatakpukur-play-ground-8', '', '/uploads/photo/play-ground-8.jpg'),
(166, 1, 15, 'Ravi Kumar Ram ((BSC,H.HA IHM Kolkata) Management Trainee at ITC Royal Bengal.)', 'ravi-kumar-ram-bschha-ihm-kolkata-management-trainee-at-itc-royal-bengal', '(BSC,H.HA IHM Kolkata) Management Trainne at ITC Royal Bengal.', '/uploads/photo/ravi-kumar-ram.jpeg'),
(167, 1, 15, 'Anuj Kumar Ojha; (2018 batch )Pursuing M.COM from C U ,working as Process Associate in Genpact (MNC)', 'anuj-kumar-ojha-2018-batch-pursuing-mcom-from-c-u-working-as-process-associate-in-genpact-mnc', 'Year of passing- 2018<br />\r\nPursuing- M.COM from C.U<br />\r\nJob - Working as Process Associate in Genpact (MNC).', '/uploads/photo/anuj-kumar-ojha-year-of-passing-2018-pursuing-m.jpeg'),
(169, 1, 15, 'Bikramjit Das ; pass out 2019, Data science Intern at EBIW info Analytics Private Limited', 'bikramjit-das-pass-out-2019-data-science-intern-at-ebiw-info-analytics-private-limited', 'Bikramjit Das pass out 2019 from Bishop George Mission School (Pure Science)&nbsp;', '/uploads/photo/bikramjit-das.jpeg'),
(172, 1, 2, 'Cultural Program 1', 'kolkata-cultural-program-1', '', '/uploads/photo/cultural-program-1.JPG'),
(173, 1, 2, 'Cultural program 2', 'kolkata-cultural-program-2', '', '/uploads/photo/cultural-program-2.JPG'),
(174, 1, 2, 'Cultural Program 3', 'kolkata-cultural-program-3', '', '/uploads/photo/cultural-program-3.JPG'),
(175, 1, 2, 'Cultural program', 'kolkata-cultural-program', '', '/uploads/photo/cultural-program.JPG'),
(176, 2, 15, 'Kaushal Tharad :( 2016 batch) Chartered Accountant', 'kaushal-tharad-2016-batch-chartered-accountant', '', '/uploads/photo/kaushal-tharad-2016-batch-chartered-accountant.jpeg'),
(177, 2, 15, 'Poly Chakraborty : ( 2016 batch) L1 Engineer at ABB Wipro Technologies ,Kochi', 'ghatakpukur-poly-chakraborty-2016-batch-l1-engineer-at-abb-wipro-technologies-kochi', '', '/uploads/photo/poly-chakraborty-2016-batch-l1-engineer-at-abb-wipro-technologies-kochi.jpeg'),
(178, 2, 15, 'Abhishek Kumar Jha (2020 batch) Assistant Accountant', 'ghatakpukur-abhishek-kumar-jha-2020-batch-assistant-accountant', '', '/uploads/photo/abhishek-kumar-jha-2020-batch-assistant-accountant.jpeg'),
(179, 2, 15, 'Rahul Kumar Singh 3rd year B.SC IT-Cloud Technology and Information and Security , trainee Core Java', 'ghatakpukur-rahul-kumar-singh-3rd-year-bsc-it-cloud-technology-and-information-and-security-trainee-core-java', '', '/uploads/photo/rahul-kumar-singh-3rd-year-bsc-it-cloud-technology-and-information-and-security-trainee-core-java.jpeg'),
(181, 2, 15, 'Rohit Singh (2016 batch) Accountant at Manyavar', 'ghatakpukur-rohit-singh-2016-batch-accountant-at-manyavar', '', '/uploads/photo/rohit-singh-2016-batch-accountant-at-manyavar.jpeg'),
(184, 2, 9, 'Raman Singh ,the youngest flautist', 'ghatakpukur-raman-singh-the-youngest-flautist', '', '/uploads/photo/raman-singh-the-youngest-flautist.jpeg'),
(185, 1, 15, 'Saurasis Mukhopadhyay, pursuing B.SC(Hons)in Electronics', 'saurasis-mukhopadhyay-pursuing-bschonsin-electronics', '', '/uploads/photo/saurasis-mukhopadhyay-persuing-bschonsin-electronics.jpeg'),
(186, 1, 15, 'Rihanshu Bishwakarma (2020 batch) B.A English Hons', 'kolkata-rihanshu-bishwakarma-2020-batch-ba-english-hons', '', '/uploads/photo/rihanshu-bishwakarma-2020-batch-ba-english-hons.jpg'),
(194, 1, 15, 'Kaushal Tharad (2016 batch) Chartered Accountant', 'kolkata-kaushal-tharad-2016-batch-chartered-accountant', '', '/uploads/photo/kaushal-tharad-2016-batch-chartered-accountant.jpeg'),
(197, 1, 9, 'Raman Singh ,the youngest flautist', 'kolkata-raman-singh-the-youngest-flautist', '', '/uploads/photo/raman-singh-the-youngest-flautist.jpeg'),
(198, 1, 11, 'Art 14', 'kolkata-art-14', '', '/uploads/photo/art-14.jpeg'),
(199, 1, 11, 'Art 15', 'kolkata-art-15', '', '/uploads/photo/art-15.jpeg'),
(200, 1, 15, 'Manisha Ray (2021 batch) pursuing M.COM under CU', 'kolkata-manisha-ray-2021-batch-pursuing-mcom-under-cu', '', '/uploads/photo/manisha-ray-2021-batch-pursuing-mcom-under-cu.jpeg'),
(201, 1, 15, 'Raman Singh, the youngest flautist', 'kolkata-raman-singh-the-youngest-flautist', '', '/uploads/photo/raman-singh-the-youngest-flautist.jpeg'),
(203, 2, 15, 'Raman Singh the youngest flautist', 'ghatakpukur-raman-singh-the-youngest-flautist', '', '/uploads/photo/raman-singh-the-youngest-flautist.jpeg'),
(204, 2, 8, 'Swimming 1', 'ghatakpukur-swimming-1', '', '/uploads/photo/swimming-1.jpeg'),
(205, 1, 9, 'Our Achievements 2', 'kolkata-our-achievements-2', '', '/uploads/photo/our-achievements-2.jpeg'),
(206, 2, 9, 'Our Achievements 4', 'ghatakpukur-our-achievements-4', '', '/uploads/photo/our-achievements-4.jpeg'),
(207, 1, 7, 'Student-Corner-1', 'kolkata-student-corner-1', '', '/uploads/photo/student-corner-1.JPG'),
(208, 1, 7, 'Student-Corner-2', 'kolkata-student-corner-2', '', '/uploads/photo/student-corner-2.JPG'),
(210, 1, 9, 'S Mukherjee', 's-mukherjee', '', '/uploads/photo/s-mukherjee.jpg'),
(211, 2, 7, 'student corner', 'ghatakpukur-student-corner', '', '/uploads/photo/student-corner.JPG'),
(212, 2, 7, 'inox-2', 'ghatakpukur-inox-2', '', '/uploads/photo/inox-2.JPG'),
(213, 2, 7, 'dancing', 'ghatakpukur-dancing', '', '/uploads/photo/dancing.JPG'),
(214, 1, 16, 'Class Room-1', 'kolkata-class-room-1', '', '/uploads/photo/class-room-1.jpg'),
(215, 1, 16, 'Class Room-2', 'kolkata-class-room-2', '', '/uploads/photo/class-room-2.jpg'),
(216, 1, 16, 'Class Room-3', 'kolkata-class-room-3', '', '/uploads/photo/class-room-3.jpg'),
(217, 2, 16, 'Class-Gtk-1', 'ghatakpukur-class-gtk-1', '', '/uploads/photo/class-gtk-1.jpg'),
(218, 2, 16, 'Class-Gtk-2', 'ghatakpukur-class-gtk-2', '', '/uploads/photo/class-gtk-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `popup_news`
--

DROP TABLE IF EXISTS `popup_news`;
CREATE TABLE IF NOT EXISTS `popup_news` (
  `pop_id` int(5) NOT NULL AUTO_INCREMENT,
  `pop_title` varchar(50) NOT NULL,
  `pop_content` text NOT NULL,
  `valid_date` date NOT NULL,
  PRIMARY KEY (`pop_id`),
  KEY `valid_date` (`valid_date`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `popup_news`
--

INSERT INTO `popup_news` (`pop_id`, `pop_title`, `pop_content`, `valid_date`) VALUES
(1, 'New Admission Notice', '<div style=\"text-align: justify;\">Admission Forms will be available from our Respective School campuses and also Online through Admission Tree Portal of TTIS , Furthermore one can also procure Admission Forms from the different Branches of <span style=\"color:#2980b9;\"><strong>IDFC First Bank</strong></span> located at CIT Road Crossing Beleghata, Sector 5 Salt Lake, Sector 2 Salt Lake for our Kolkata School and in <span style=\"color:#2980b9;\"><strong>ICICI </strong></span>Branch at Ghatakpukur Crossing in South 24 Prgns. for our New Branch at Ghatakpukur.&nbsp;To top it all its worth mentioning that we are Proud to be associated with <span style=\"color:#c0392b;\"><strong>Oxford University Press. (OUP)</strong></span> as our Educational Partners.</div>\r\n\r\n<div style=\"text-align: center;\">\r\n<div style=\"text-align:center\"><img alt=\"\" height=\"125\" src=\"https://bgms.in/uploads/media/oup-logo.jpeg\" width=\"716\" /></div>\r\n</div>\r\n', '2022-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `principal_desk`
--

DROP TABLE IF EXISTS `principal_desk`;
CREATE TABLE IF NOT EXISTS `principal_desk` (
  `princi_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT NULL,
  `princi_nm` varchar(50) DEFAULT NULL,
  `princi_photo` text,
  `princi_content` text,
  PRIMARY KEY (`princi_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `principal_desk`
--

INSERT INTO `principal_desk` (`princi_id`, `branch_id`, `princi_nm`, `princi_photo`, `princi_content`) VALUES
(1, 1, 'Ms. Joyita Dutta', '/uploads/principal/Principal1.jpeg', '<span style=\"font-size:12pt\"><span new=\"\" roman=\"\" style=\"font-family:\" times=\"\"><span style=\"font-size:18px;\"><b><span style=\"color:black\">&quot;IN PURSUIT OF EXCELLENCE&quot;.</span></b></span><span style=\"font-size:18.0pt\"><span style=\"color:black\"> <span style=\"font-size:18px;\">This being the School, Bishop George Mission, will stress of real knowledge acquisition, but at the same time be concerned with wholesome personality development. An all-round education to prepare students for the modern world is the main aim of the school.</span></span></span></span></span><br />\r\n<span style=\"font-size:18px;\"><span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">The dream has finally come true. The great responsibility of making future citizens of the country is now with us also.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Education is the backbone of any nation. Here we want to impart such education by which our character is formed, strength of mind increased and by which one can stand on one&#39;s feet. </span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">All round development of child is aspired. </span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Character Foundation is desired eagerly.</span></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">Build child&#39;s future to be useful citizen, who should endeavor to build better society.</span></span><br />\r\n<br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">With best wishes from,</span></span></span><br />\r\n<span style=\"font-size:18px;\"><span new=\"\" roman=\"\" times=\"\"><b><span style=\"color:black\">Ms. Joyita Dutta - Principal - BGMS</span></b></span><br />\r\n<span new=\"\" roman=\"\" times=\"\"><span style=\"color:black\">&nbsp;B.Tech , M.Tech , B.Ed, Ph.D.&nbsp; (Pursuing)</span></span></span>'),
(2, 2, 'Ms. Joyita Dutta', '/uploads/principal/Principal11.jpeg', '<b>&quot;IN PURSUIT OF EXCELLENCE&quot;.</b>&nbsp;This being the School, Bishop George Mission, will stress of real knowledge acquisition, but at the same time be concerned with wholesome personality development. An all-round education to prepare students for the modern world is the main aim of the school.<br />\r\nThe dream has finally come true. The great responsibility of making future citizens of the country is now with us also.<br />\r\nEducation is the backbone of any nation. Here we want to impart such education by which our character is formed, strength of mind increased and by which one can stand on one&#39;s feet.<br />\r\nAll round development of child is aspired.<br />\r\nCharacter Foundation is desired eagerly.<br />\r\nBuild child&#39;s future to be useful citizen, who should endeavor to build better society.<br />\r\n<br />\r\nWith best wishes from,<br />\r\n<b>Ms. Joyita Dutta - Principal - BGMS</b><br />\r\nB.Tech , M.Tech , B.Ed, Ph.D.&nbsp; (Pursuing)');

-- --------------------------------------------------------

--
-- Table structure for table `service_mas`
--

DROP TABLE IF EXISTS `service_mas`;
CREATE TABLE IF NOT EXISTS `service_mas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `service_icon` varchar(20) NOT NULL,
  `service_slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider_mas`
--

DROP TABLE IF EXISTS `slider_mas`;
CREATE TABLE IF NOT EXISTS `slider_mas` (
  `slider_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) NOT NULL DEFAULT '1',
  `image_path` text,
  `show_tag` varchar(1) DEFAULT NULL,
  `slider_nm` text,
  `slider_content` text,
  PRIMARY KEY (`slider_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_mas`
--

INSERT INTO `slider_mas` (`slider_id`, `branch_id`, `image_path`, `show_tag`, `slider_nm`, `slider_content`) VALUES
(20, 1, '/uploads/slider/kolkata-dance.jpg', 'T', 'dance', ''),
(24, 1, '/uploads/slider/kolkata-school-bldg1.JPG', NULL, 'school bldg1', ''),
(30, 2, '/uploads/slider/ghatakpukur-school-bldg.jpg', NULL, 'School bldg', ''),
(31, 2, '/uploads/slider/ghatakpukur-building2.jpg', NULL, 'Building2', ''),
(32, 1, '/uploads/slider/kolkata-slider-6.jpg', NULL, 'slider-6', ''),
(35, 1, '/uploads/slider/kolkata-slider-1.jpg', NULL, 'slider-1', ''),
(37, 2, '/uploads/slider/ghatakpukur-slider-3.JPG', NULL, 'Slider-3', ''),
(38, 2, '/uploads/slider/ghatakpukur-slider-4.JPG', NULL, 'slider-4', '');

-- --------------------------------------------------------

--
-- Table structure for table `social_mas`
--

DROP TABLE IF EXISTS `social_mas`;
CREATE TABLE IF NOT EXISTS `social_mas` (
  `social_id` int(5) NOT NULL AUTO_INCREMENT,
  `social_nm` varchar(25) NOT NULL,
  `social_path` varchar(25) NOT NULL,
  `social_url` text,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_mas`
--

INSERT INTO `social_mas` (`social_id`, `social_nm`, `social_path`, `social_url`) VALUES
(1, 'Facebook', 'fa fa-facebook', 'https://www.facebook.com/profile.php?id=100076169223051'),
(2, 'Twitter', 'fa fa-twitter ', 'https://twitter.com/BishopGeorge17?t=LpXZd-UgjOoCjZa3ykb1qA&s=08'),
(4, 'YouTube', 'fa fa-youtube', NULL),
(5, 'Instagram', 'fa fa-instagram ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soft_mas`
--

DROP TABLE IF EXISTS `soft_mas`;
CREATE TABLE IF NOT EXISTS `soft_mas` (
  `soft_id` int(5) NOT NULL AUTO_INCREMENT,
  `soft_nm` varchar(25) NOT NULL,
  `soft_logo` text,
  `soft_ver` varchar(10) DEFAULT NULL,
  `soft_abbr` varchar(3) DEFAULT NULL,
  `web_addr` text,
  `soft_email` text,
  `s_path` text,
  PRIMARY KEY (`soft_id`,`soft_nm`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soft_mas`
--

INSERT INTO `soft_mas` (`soft_id`, `soft_nm`, `soft_logo`, `soft_ver`, `soft_abbr`, `web_addr`, `soft_email`, `s_path`) VALUES
(1, 'Admin Panel', '/uploads/software/favicon.png', '4.2.3', 'AP', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tag_mas`
--

DROP TABLE IF EXISTS `tag_mas`;
CREATE TABLE IF NOT EXISTS `tag_mas` (
  `tag_id` int(5) NOT NULL AUTO_INCREMENT,
  `tag_desc` varchar(35) DEFAULT NULL,
  `tag_slug` varchar(35) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag_mas`
--

INSERT INTO `tag_mas` (`tag_id`, `tag_desc`, `tag_slug`) VALUES
(1, 'Codeigniter', 'codeigniter'),
(2, 'PHP', 'php'),
(3, 'Design', 'design'),
(4, 'CSS', 'css'),
(5, 'Sports', 'sports');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_mas`
--

DROP TABLE IF EXISTS `teacher_mas`;
CREATE TABLE IF NOT EXISTS `teacher_mas` (
  `tid` int(5) NOT NULL AUTO_INCREMENT,
  `teacher_nm` varchar(30) DEFAULT NULL,
  `faculty` varchar(60) DEFAULT NULL,
  `photo_path` text,
  `facebook` text,
  `twitter` text,
  `linkedin` text,
  `instagram` text,
  `branch_id` int(5) NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_mas`
--

INSERT INTO `teacher_mas` (`tid`, `teacher_nm`, `faculty`, `photo_path`, `facebook`, `twitter`, `linkedin`, `instagram`, `branch_id`) VALUES
(4, 'Sayanneta Dey', 'English Language, English Literature, Science, SSC', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_17_45_48.jpeg', '', '', '', '', 1),
(6, 'Radha Sah', 'Hindi', '/uploads/teacher/ei_1638970096820-removebg-preview.png', '', '', '', '', 1),
(7, 'Reshma Dutta', 'SSC ,History, Commercial Art', '/uploads/teacher/20211208_153622.jpg', '', '', '', '', 1),
(8, 'Samrat Ghosh', 'Accountancy and Business Studies', '/uploads/teacher/IMG_20211208_142826.jpg', '', '', '', '', 1),
(9, 'Basabdutta Das', 'SST, Science, GK, Dictation, Art & Craft', '/uploads/teacher/WhatsApp_Image_2021-12-09_at_20_17_36.jpeg', '', '', '', '', 1),
(10, 'Nivedita Ghosh', 'English Language, English Literature, Social Science', '/uploads/teacher/Nivedita_Ghosh.jpeg', '', '', '', '', 1),
(11, 'Anusuya Bose', 'Mathematics, Science, Computer, Bengali, Evs', '/uploads/teacher/IMG_20181124_115924020.jpg', '', '', '', '', 1),
(12, 'Suvadip Chatterjee', 'Chemistry', '/uploads/teacher/IMG_20211208_140224-01.jpeg', '', '', '', '', 1),
(13, 'Rimita Chatterjee Kar', 'Maths, Bengali, GK, Art & Craft', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_12_36_14_(2).jpeg', '', '', '', '', 1),
(14, 'Kakoli  Ganguly', 'English, GK', '/uploads/teacher/KAKOLI_GANGULY.png', '', '', '', '', 1),
(15, 'Rinki Singh', 'Hindi', '/uploads/teacher/FB_IMG_16387711410837403.jpg', '', '', '', '', 1),
(16, 'Gurmeen Kaur', 'English, Hindi, Computer, Art & Craft', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_21_07_59.jpeg', '', '', '', '', 1),
(17, 'Srijita Karmakar', 'English', '/uploads/teacher/Sujata_Karmakar.jpeg', '', '', '', '', 1),
(18, 'Archi Mukherjee', 'Geography, Polital Science', '/uploads/teacher/IMG-20211208-WA0002.jpg', '', '', '', '', 1),
(19, 'Reena Mishra', 'Social Study, M. SC, EVS', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_17_47_34.jpeg', '', '', '', '', 1),
(20, 'Mahua Chatterjee', 'Computer Science, Math', '/uploads/teacher/mahua.png', '', '', '', '', 1),
(21, 'Sanhita Dutta', 'Science, Mathematics, Physics', '/uploads/teacher/IMG20211208093805.jpg', '', '', '', '', 1),
(22, 'Somenath Chatterjee', 'Mathematics', '/uploads/teacher/IMG_20211208_142034.jpg', '', '', '', '', 1),
(23, 'Tanima Nandy', 'KG 1', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_18_25_17_(1).jpeg', '', '', '', '', 1),
(24, 'Rishina Das Sardar', 'English, SSC, M Sc, Spelling & Dictation', '/uploads/teacher/IMG_20211208_142317.jpg', '', '', '', '', 1),
(25, 'Payel Kar', 'English, Science, Computer, Spell Dict, Art /Craft', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_17_48_03.jpeg', '', '', '', '', 1),
(26, 'Tanushri Pal', 'Mathematics, Social Science, Moral Science, GK', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_13_43_13.jpeg', '', '', '', '', 1),
(27, 'Debangana Bakshi', 'English, Sociology', '/uploads/teacher/2021-12-08-16-18-32-347.jpg', '', '', '', '', 1),
(28, 'Shreya Giri', 'Mathematics', '/uploads/teacher/IMG_20211208_183224.jpg', '', '', '', '', 1),
(29, 'Tanushree Ghose Giri', 'Science, Moral Science, EVS, SSC', '/uploads/teacher/WhatsApp_Image_2021-12-08_at_16_18_25.jpeg', '', '', '', '', 1),
(30, 'Monalisha Bhattacherjee', 'English, Numbers, GK, Conversation, Art', '/uploads/teacher/WhatsApp_Image_2021-12-10_at_14_09_04.jpeg', '', '', '', '', 1),
(31, 'Anindita Mukherjee', 'Mathematics, Science, Computer, GK, Bengali', '/uploads/teacher/IMG-20211211-WA0037.jpg', '', '', '', '', 1),
(32, 'Oindrila Mukherjee', 'Bengali', '/uploads/teacher/IMG_20211209_113340.JPG', '', '', '', '', 1),
(33, 'Bappa Das', 'Economics ,Accountancy', '/uploads/teacher/IMG-20191215-WA0002.jpg', '', '', '', '', 1),
(34, 'Tanushree Saha', 'English, Mathematics, Computer, Moral Science', '/uploads/teacher/WhatsApp_Image_2021-12-09_at_14_07_40.jpeg', '', '', '', '', 1),
(35, 'Ankona Chandra', 'Mathematics, Science, Computer, G .K', '/uploads/teacher/20211214_094054.jpg', '', '', '', '', 1),
(36, 'Rishina Das Sardar', 'English , SSC , M. Sc', '/uploads/teacher/IMG_20211208_1423171.jpg', '', '', '', '', 2),
(37, 'Shreya Giri', 'Mathematics', '/uploads/teacher/IMG_20211208_1832241.jpg', '', '', '', '', 2),
(38, 'Bappa Das', 'Economics  and  Accountancy', '/uploads/teacher/IMG-20191215-WA00021.jpg', '', '', '', '', 2),
(39, 'Sonia Yadav', 'English , SSC ,M. SC , Spellings, Art and Craft', '/uploads/teacher/WhatsApp_Image_2021-12-12_at_22_11_26.jpeg', '', '', '', '', 1),
(40, 'Puja Dutta Saha', 'Pre Primary & SST for Middle Section.', '/uploads/teacher/WhatsApp_Image_2021-12-25_at_10_06_44_(1).jpeg', '', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_mas`
--

DROP TABLE IF EXISTS `testimonial_mas`;
CREATE TABLE IF NOT EXISTS `testimonial_mas` (
  `test_id` int(5) NOT NULL AUTO_INCREMENT,
  `branch_id` int(5) DEFAULT NULL,
  `test_name` varchar(50) NOT NULL,
  `company_nm` varchar(50) DEFAULT NULL,
  `photo_path` text,
  `test_comment` text NOT NULL,
  PRIMARY KEY (`test_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial_mas`
--

INSERT INTO `testimonial_mas` (`test_id`, `branch_id`, `test_name`, `company_nm`, `photo_path`, `test_comment`) VALUES
(1, 1, 'SEEMA ROY CHAUDHURY (PTT, BSC)', 'VICE PRINCIPAL', '/uploads/testimonial/vice-principal.jpeg', 'Dear Parents & Guardians,\r\nIt has been my great pleasure and privilege to be a part of “BISHOP GEORGE MISSION SCHOOL”. The hard work of our students and teachers  fill  me up with hope of a better and brighter tomorrow . Our students are the flag bearers of this great Institution. And shall be known for their kindness and skills wherever they go .\r\n\r\nWe, at “BISHOP GEORGE MISSION SCHOOL” are always \"IN PURSUIT OF EXCELLENCE\" and we hope to have your continued support in this journey.\r\n\r\nThanking you,\r\nYours’ truly ,\r\nSEEMA ROY CHAUDHURY\r\nVice Principal'),
(2, 1, 'NIRAJ JAISWAL  (MBA , LLB)', 'MANAGER', '/uploads/testimonial/Niraj-Jaiswal.jpeg', 'Dear Parents & Guardians, \r\nI have great pleasure and privilege in announcing the foundation of an ideal English Medium School under the name “BISHOP GEORGE MISSION SCHOOL”, \r\nwith effect from the Academic Session 2005-06 on the basis of curriculum as specified by the Council for CBSE Examination, New Delhi.\r\n\r\nWe are optimistic that our competent and sincere teachers and the students of the school will emerge as disciplined lot and prove their mettle in \r\ntheir academic as well as professional life.'),
(3, 1, 'MR. RAJENDRA PD. JAISWAL', 'CHAIRMAN', '/uploads/testimonial/IMG_20211216_1018311.jpg', 'My heartful congratulation to Bishop George Mission School on running successfully  the school. You have consistently presented yourself \r\nthrough years and I would like to commend you for your effort and perseverance. \r\nI appreciate you and all the teachers for the effort taken by them. This proof of how hands and minds that work together in union result achievements.'),
(4, 1, 'FROM THE ADMINISTRATIVE DESK', '', '/uploads/testimonial/20211203_130731.jpg', 'Dear Parents & Guardians, \r\nI have great pleasure and privilege in announcing the foundation of an ideal English Medium School under the name “BISHOP GEORGE MISSION SCHOOL”, with effect from the Academic Session 2005-06 on the basis of curriculum as specified by the Council for CBSE Examination, New Delhi.\r\n\r\nWe are optimistic that our competent and sincere teachers and the students of \"BISHOP GEORGE MISSION SCHOOL” will emerge as disciplined lot and prove their mettle in their academic as well as professional life. The school has got NOC from the State Govt., to apply for further recognition of a competent board.\r\n\r\n\"IN PURSUIT OF EXCELLENCE” which is our schools’ motto, let us pledge to give our children a firm and solid base. Hence, we solicit your unstinted moral co-operation to uphold the standard of absolute prominence and crown our endeavour unmatched success.\r\n\r\nWith best wishes from, \r\nAdministrators \r\nB.G.M.S. \r\n(Kolkata Management)'),
(5, 2, 'MR. RAJENDRA PD. JAISWAL', 'CHAIRMAN', '/uploads/testimonial/IMG_20211216_101831.jpg', 'My heartful congratulation to Bishop George Mission School on running successfully  the school. You have consistently presented yourself \r\nthrough years and I would like to commend you for your effort and perseverance. \r\nI appreciate you and all the teachers for the effort taken by them. This proof of how hands and minds that work together in union result achievements.'),
(6, 2, 'NIRAJ JAISWAL (MBA, LLB)', 'MANAGER', '/uploads/testimonial/Niraj-Jaiswal1.jpeg', 'Dear Parents & Guardians, \r\nI have great pleasure and privilege in announcing the foundation of an ideal English Medium School under the name “BISHOP GEORGE MISSION SCHOOL”, \r\nwith effect from the Academic Session 2005-06 on the basis of curriculum as specified by the Council for CBSE Examination, New Delhi.\r\n\r\nWe are optimistic that our competent and sincere teachers and the students of the school will emerge as disciplined lot and prove their mettle in \r\ntheir academic as well as professional life.'),
(7, 2, 'INDRANIL GHOSH (M.SC, B.ED, M.ED PURSUING)', 'HEAD MASTER', '/uploads/testimonial/WhatsApp_Image_2021-12-09_at_14_36_06.jpeg', 'While academic excellence is our major thrust, our school is also devoted to prepare the students for life, groom them to face the challenges of tomorrow and encourage them to be socially relevant. Our school is striving hard to make the best possible efforts to inculcate strong values combining with academics and extracurricular activities in children.\r\nThanking you,\r\nYours’ truly ,\r\nIndranil Ghosh\r\nHead master'),
(8, 2, 'FROM THE ADMINISTRATIVE DESK', '', '/uploads/testimonial/WhatsApp_Image_2021-12-23_at_09_54_42.jpeg', 'Dear Parents & Guardians, \r\nI have great pleasure and privilege in announcing the foundation of an ideal English Medium School under the name “BISHOP GEORGE MISSION SCHOOL”, with effect from the Academic Session 2005-06 on the basis of curriculum as specified by the Council for CBSE Examination, New Delhi.\r\n\r\nWe are optimistic that our competent and sincere teachers and the students of \"BISHOP GEORGE MISSION SCHOOL” will emerge as disciplined lot and prove their mettle in their academic as well as professional life. The school has got NOC from the State Govt., to apply for further recognition of a competent board.\r\n\r\n\"IN PURSUIT OF EXCELLENCE” which is our schools’ motto, let us pledge to give our children a firm and solid base. Hence, we solicit your unstinted moral co-operation to uphold the standard of absolute prominence and crown our endeavour unmatched success.\r\n\r\nWith best wishes from, \r\nAdministrators \r\nB.G.M.S. \r\n(Kolkata Management)'),
(9, 2, 'MS. JOYITA  DUTTA', 'SECRETARY  ( PRINCIPAL )        ', '/uploads/testimonial/WhatsApp_Image_2021-12-23_at_09_59_04.jpeg', '\"IN PURSUIT OF EXCELLENCE\". This being the School, Bishop George Mission, will stress of real knowledge acquisition, but at the same time be concerned with wholesome personality development. An all-round education to prepare students for the modern world is the main aim of the school.\r\nThe dream has finally come true. The great responsibility of making future citizens of the country is now with us also.\r\nEducation is the backbone of any nation. Here we want to impart such education by which our character is formed, strength of mind increased and by which one can stand on one\'s feet.\r\nAll round development of child is aspired.\r\nCharacter Foundation is desired eagerly.\r\nBuild child\'s future to be useful citizen, who should endeavor to build better society.\r\n\r\nWith best wishes from,\r\nMs. Joyita Dutta - Secretary (Principal ) - BGMS\r\nB.Tech , M.Tech , B.Ed, Ph.D.  (Pursuing)'),
(10, 1, 'INDRANIL  GHOSH  M.SC,B ED, M. ED (PURSUING)', 'COORDINATOR', '/uploads/testimonial/WhatsApp_Image_2021-12-23_at_21_02_28.jpeg', 'While academic excellence is our major thrust, our school is also devoted to prepare the students for life, groom them to face the challenges of tomorrow and encourage them to be socially relevant. Our school is striving hard to make the best possible efforts to inculcate strong values combining with academics and extracurricular activities in children.\r\nThanking  You\r\nyours  faithfully\r\nCoordinator of BGMS \r\nIndranil Ghosh');

-- --------------------------------------------------------

--
-- Table structure for table `useful_link_mas`
--

DROP TABLE IF EXISTS `useful_link_mas`;
CREATE TABLE IF NOT EXISTS `useful_link_mas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(50) NOT NULL,
  `link` text,
  `link_content` text,
  `srl` int(5) DEFAULT NULL,
  `show_tag` varchar(1) NOT NULL DEFAULT 'T',
  `new_blink` varchar(1) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useful_link_mas`
--

INSERT INTO `useful_link_mas` (`id`, `link_name`, `link`, `link_content`, `srl`, `show_tag`, `new_blink`, `target`) VALUES
(3, 'Home', 'home', '', 1, 'T', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_log_mas`
--

DROP TABLE IF EXISTS `user_log_mas`;
CREATE TABLE IF NOT EXISTS `user_log_mas` (
  `uid` int(5) DEFAULT NULL,
  `login_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `orgn_id` int(5) DEFAULT NULL,
  `ip_addr` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `login_on` (`login_on`)
) ENGINE=MyISAM AUTO_INCREMENT=394 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log_mas`
--

INSERT INTO `user_log_mas` (`uid`, `login_on`, `logout_on`, `id`, `orgn_id`, `ip_addr`) VALUES
(1, '2019-03-25 08:54:51', '0000-00-00 00:00:00', 219, 1, NULL),
(1, '2019-03-25 12:34:05', '0000-00-00 00:00:00', 220, 1, NULL),
(1, '2019-04-08 07:23:42', '0000-00-00 00:00:00', 221, 1, NULL),
(1, '2019-04-08 10:21:20', '0000-00-00 00:00:00', 222, 1, NULL),
(1, '2019-04-08 11:56:07', '0000-00-00 00:00:00', 223, 1, NULL),
(1, '2019-04-09 04:59:26', '0000-00-00 00:00:00', 224, 1, NULL),
(1, '2019-04-09 08:18:54', '0000-00-00 00:00:00', 225, 1, NULL),
(1, '2019-04-09 08:35:27', '0000-00-00 00:00:00', 226, 1, NULL),
(1, '2019-04-09 08:38:48', '0000-00-00 00:00:00', 227, 1, NULL),
(1, '2019-05-09 02:09:03', '0000-00-00 00:00:00', 228, 1, NULL),
(1, '2019-05-09 03:45:38', '0000-00-00 00:00:00', 229, 1, NULL),
(1, '2019-05-15 07:08:46', '0000-00-00 00:00:00', 230, 1, NULL),
(1, '2019-05-23 02:20:18', '0000-00-00 00:00:00', 231, 1, NULL),
(1, '2019-05-25 05:50:20', '0000-00-00 00:00:00', 232, 1, NULL),
(1, '2019-05-25 06:12:29', '0000-00-00 00:00:00', 233, 1, NULL),
(1, '2019-05-25 06:25:47', '0000-00-00 00:00:00', 234, 1, NULL),
(1, '2019-05-25 07:28:53', '0000-00-00 00:00:00', 235, 1, NULL),
(1, '2019-05-27 04:54:15', '0000-00-00 00:00:00', 236, 1, NULL),
(1, '2019-05-28 01:36:32', '0000-00-00 00:00:00', 237, 1, NULL),
(1, '2019-05-28 04:14:07', '0000-00-00 00:00:00', 238, 1, NULL),
(1, '2019-05-30 06:28:06', '0000-00-00 00:00:00', 239, 1, NULL),
(1, '2019-06-06 06:30:00', '0000-00-00 00:00:00', 240, 1, NULL),
(1, '2019-06-12 09:16:03', '0000-00-00 00:00:00', 241, 1, NULL),
(1, '2019-06-12 09:23:16', '0000-00-00 00:00:00', 242, 1, NULL),
(1, '2019-06-26 09:11:00', '0000-00-00 00:00:00', 243, 1, NULL),
(1, '2019-07-12 10:39:46', '0000-00-00 00:00:00', 244, 1, NULL),
(1, '2019-07-12 11:15:53', '0000-00-00 00:00:00', 245, 1, NULL),
(1, '2019-07-12 11:47:12', '0000-00-00 00:00:00', 246, 1, NULL),
(1, '2019-07-15 05:14:36', '0000-00-00 00:00:00', 247, 1, NULL),
(1, '2019-07-15 12:26:24', '0000-00-00 00:00:00', 248, 1, NULL),
(1, '2019-07-16 05:24:58', '0000-00-00 00:00:00', 249, 1, NULL),
(1, '2019-07-16 12:29:38', '0000-00-00 00:00:00', 250, 1, NULL),
(1, '2019-07-17 05:22:59', '0000-00-00 00:00:00', 251, 1, NULL),
(1, '2019-10-15 06:16:30', '0000-00-00 00:00:00', 252, 1, NULL),
(1, '2019-10-16 05:07:53', '0000-00-00 00:00:00', 253, 1, NULL),
(1, '2019-10-17 05:25:30', '0000-00-00 00:00:00', 254, 1, NULL),
(1, '2019-10-18 11:25:51', '0000-00-00 00:00:00', 255, 1, NULL),
(1, '2019-10-19 08:05:56', '0000-00-00 00:00:00', 256, 1, NULL),
(1, '2019-10-19 09:24:56', '0000-00-00 00:00:00', 257, 1, NULL),
(1, '2019-10-21 06:33:16', '0000-00-00 00:00:00', 258, 1, NULL),
(1, '2019-10-21 08:58:31', '0000-00-00 00:00:00', 259, 1, NULL),
(1, '2019-10-21 09:26:37', '0000-00-00 00:00:00', 260, 1, NULL),
(1, '2019-10-21 09:27:07', '0000-00-00 00:00:00', 261, 1, NULL),
(1, '2019-10-21 09:34:12', '0000-00-00 00:00:00', 262, 1, NULL),
(1, '2019-10-22 10:05:20', '0000-00-00 00:00:00', 263, 1, NULL),
(1, '2019-10-22 10:06:18', '0000-00-00 00:00:00', 264, 1, NULL),
(1, '2019-10-26 08:18:11', '0000-00-00 00:00:00', 265, 1, NULL),
(1, '2019-10-26 09:09:47', '0000-00-00 00:00:00', 266, 1, NULL),
(1, '2019-10-28 10:15:54', '0000-00-00 00:00:00', 267, 1, NULL),
(1, '2019-11-04 04:32:33', '0000-00-00 00:00:00', 268, 1, NULL),
(1, '2019-11-04 05:50:37', '0000-00-00 00:00:00', 269, 1, NULL),
(1, '2019-11-04 12:06:49', '0000-00-00 00:00:00', 270, 1, NULL),
(1, '2019-11-05 04:27:36', '0000-00-00 00:00:00', 271, 1, NULL),
(1, '2019-11-06 04:31:04', '0000-00-00 00:00:00', 272, 1, NULL),
(1, '2019-11-06 05:54:47', '0000-00-00 00:00:00', 273, 1, NULL),
(1, '2019-11-06 08:13:01', '0000-00-00 00:00:00', 274, 1, NULL),
(1, '2019-11-07 10:07:28', '0000-00-00 00:00:00', 275, 1, NULL),
(1, '2019-11-07 14:48:24', '0000-00-00 00:00:00', 276, 1, NULL),
(1, '2019-11-08 04:54:59', '0000-00-00 00:00:00', 277, 1, NULL),
(1, '2019-11-08 10:39:35', '0000-00-00 00:00:00', 278, 1, NULL),
(1, '2019-11-11 04:47:31', '0000-00-00 00:00:00', 279, 1, NULL),
(1, '2019-11-12 04:34:39', '0000-00-00 00:00:00', 280, 1, NULL),
(1, '2019-11-12 06:18:45', '0000-00-00 00:00:00', 281, 1, NULL),
(1, '2019-11-12 07:22:20', '0000-00-00 00:00:00', 282, 1, NULL),
(1, '2019-11-12 10:17:58', '0000-00-00 00:00:00', 283, 1, NULL),
(1, '2019-11-12 10:51:51', '0000-00-00 00:00:00', 284, 1, NULL),
(1, '2019-11-12 11:16:50', '0000-00-00 00:00:00', 285, 1, NULL),
(1, '2019-11-13 05:48:47', '0000-00-00 00:00:00', 286, 1, NULL),
(1, '2019-11-13 06:34:57', '0000-00-00 00:00:00', 287, 1, NULL),
(1, '2019-11-13 07:40:18', '0000-00-00 00:00:00', 288, 1, NULL),
(1, '2019-11-13 07:50:48', '0000-00-00 00:00:00', 289, 1, NULL),
(1, '2021-11-29 06:00:27', '0000-00-00 00:00:00', 290, 1, NULL),
(1, '2021-11-30 08:13:51', '0000-00-00 00:00:00', 291, 1, NULL),
(1, '2021-12-01 04:10:46', '0000-00-00 00:00:00', 292, 1, NULL),
(1, '2021-12-03 10:17:01', '0000-00-00 00:00:00', 293, 1, NULL),
(1, '2021-12-04 04:28:38', '0000-00-00 00:00:00', 294, 1, NULL),
(1, '2021-12-04 12:21:11', '0000-00-00 00:00:00', 295, 1, NULL),
(1, '2021-12-04 13:59:29', '0000-00-00 00:00:00', 296, 1, NULL),
(1, '2021-12-04 16:43:06', '0000-00-00 00:00:00', 297, 1, NULL),
(1, '2021-12-05 05:40:13', '0000-00-00 00:00:00', 298, 1, NULL),
(1, '2021-12-05 05:57:13', '0000-00-00 00:00:00', 299, 1, NULL),
(1, '2021-12-05 05:58:28', '0000-00-00 00:00:00', 300, 1, NULL),
(1, '2021-12-06 04:49:03', '0000-00-00 00:00:00', 301, 1, NULL),
(1, '2021-12-06 07:48:56', '0000-00-00 00:00:00', 302, 1, NULL),
(1, '2021-12-06 10:29:15', '0000-00-00 00:00:00', 303, 1, NULL),
(1, '2021-12-06 11:02:10', '0000-00-00 00:00:00', 304, 1, NULL),
(1, '2021-12-07 05:10:56', '0000-00-00 00:00:00', 305, 1, NULL),
(1, '2021-12-07 09:53:52', '0000-00-00 00:00:00', 306, 1, NULL),
(1, '2021-12-08 05:31:09', '0000-00-00 00:00:00', 307, 1, NULL),
(1, '2021-12-09 05:53:30', '0000-00-00 00:00:00', 308, 1, NULL),
(1, '2021-12-10 16:25:59', '0000-00-00 00:00:00', 309, 1, NULL),
(1, '2021-12-12 17:24:16', '0000-00-00 00:00:00', 310, 1, NULL),
(1, '2021-12-13 16:45:22', '0000-00-00 00:00:00', 311, 1, NULL),
(1, '2021-12-13 18:08:28', '0000-00-00 00:00:00', 312, 1, NULL),
(1, '2021-12-13 18:14:43', '0000-00-00 00:00:00', 313, 1, NULL),
(1, '2021-12-13 18:17:19', '0000-00-00 00:00:00', 314, 1, NULL),
(1, '2021-12-13 18:20:52', '0000-00-00 00:00:00', 315, 1, NULL),
(1, '2021-12-13 18:21:42', '0000-00-00 00:00:00', 316, 1, NULL),
(1, '2021-12-13 18:24:51', '0000-00-00 00:00:00', 317, 1, NULL),
(1, '2021-12-13 18:35:20', '0000-00-00 00:00:00', 318, 1, NULL),
(1, '2021-12-14 04:22:31', '0000-00-00 00:00:00', 319, 1, NULL),
(1, '2021-12-14 04:25:08', '0000-00-00 00:00:00', 320, 1, NULL),
(1, '2021-12-14 04:49:20', '0000-00-00 00:00:00', 321, 1, NULL),
(1, '2021-12-14 04:51:04', '0000-00-00 00:00:00', 322, 1, NULL),
(1, '2021-12-14 04:51:36', '0000-00-00 00:00:00', 323, 1, NULL),
(1, '2021-12-14 04:55:03', '0000-00-00 00:00:00', 324, 1, NULL),
(1, '2021-12-18 08:36:31', '0000-00-00 00:00:00', 325, 1, NULL),
(1, '2021-12-18 19:18:47', '0000-00-00 00:00:00', 326, 1, NULL),
(1, '2021-12-19 05:28:12', '0000-00-00 00:00:00', 327, 1, NULL),
(1, '2021-12-19 05:32:56', '0000-00-00 00:00:00', 328, 1, NULL),
(1, '2021-12-19 07:00:21', '0000-00-00 00:00:00', 329, 1, NULL),
(1, '2021-12-19 08:44:51', '0000-00-00 00:00:00', 330, 1, NULL),
(1, '2021-12-19 10:32:33', '0000-00-00 00:00:00', 331, 1, NULL),
(1, '2021-12-19 10:47:43', '0000-00-00 00:00:00', 332, 1, NULL),
(1, '2021-12-19 14:53:04', '0000-00-00 00:00:00', 333, 1, NULL),
(1, '2021-12-19 16:21:38', '0000-00-00 00:00:00', 334, 1, NULL),
(1, '2021-12-19 16:25:50', '0000-00-00 00:00:00', 335, 1, NULL),
(1, '2021-12-19 16:49:46', '0000-00-00 00:00:00', 336, 1, NULL),
(1, '2021-12-19 17:29:36', '0000-00-00 00:00:00', 337, 1, NULL),
(1, '2021-12-19 17:34:09', '0000-00-00 00:00:00', 338, 1, NULL),
(1, '2021-12-19 17:35:19', '0000-00-00 00:00:00', 339, 1, NULL),
(1, '2021-12-19 17:37:29', '0000-00-00 00:00:00', 340, 1, NULL),
(1, '2021-12-19 17:38:32', '0000-00-00 00:00:00', 341, 1, NULL),
(1, '2021-12-20 03:44:22', '0000-00-00 00:00:00', 342, 1, NULL),
(1, '2021-12-20 04:07:41', '0000-00-00 00:00:00', 343, 1, NULL),
(1, '2021-12-20 04:10:11', '0000-00-00 00:00:00', 344, 1, NULL),
(1, '2021-12-22 16:52:14', '0000-00-00 00:00:00', 345, 1, NULL),
(1, '2021-12-22 17:19:10', '0000-00-00 00:00:00', 346, 1, NULL),
(1, '2021-12-23 04:22:36', '0000-00-00 00:00:00', 347, 1, NULL),
(1, '2021-12-23 05:54:23', '0000-00-00 00:00:00', 348, 1, NULL),
(1, '2021-12-23 06:58:44', '0000-00-00 00:00:00', 349, 1, NULL),
(1, '2021-12-23 07:20:14', '0000-00-00 00:00:00', 350, 1, NULL),
(1, '2021-12-23 07:27:34', '0000-00-00 00:00:00', 351, 1, NULL),
(1, '2021-12-23 10:45:06', '0000-00-00 00:00:00', 352, 1, NULL),
(1, '2021-12-23 10:59:20', '0000-00-00 00:00:00', 353, 1, NULL),
(1, '2021-12-23 11:01:40', '0000-00-00 00:00:00', 354, 1, NULL),
(1, '2021-12-23 11:04:05', '0000-00-00 00:00:00', 355, 1, NULL),
(1, '2021-12-23 16:42:48', '0000-00-00 00:00:00', 356, 1, NULL),
(1, '2021-12-24 05:07:43', '0000-00-00 00:00:00', 357, 1, NULL),
(1, '2021-12-24 06:07:12', '0000-00-00 00:00:00', 358, 1, NULL),
(1, '2021-12-24 07:19:03', '0000-00-00 00:00:00', 359, 1, NULL),
(1, '2021-12-24 07:20:38', '0000-00-00 00:00:00', 360, 1, NULL),
(1, '2021-12-24 07:25:07', '0000-00-00 00:00:00', 361, 1, NULL),
(1, '2021-12-24 07:28:19', '0000-00-00 00:00:00', 362, 1, NULL),
(1, '2021-12-24 09:08:45', '0000-00-00 00:00:00', 363, 1, NULL),
(1, '2021-12-24 09:17:06', '0000-00-00 00:00:00', 364, 1, NULL),
(1, '2021-12-24 09:30:47', '0000-00-00 00:00:00', 365, 1, NULL),
(1, '2021-12-24 09:44:18', '0000-00-00 00:00:00', 366, 1, NULL),
(1, '2021-12-24 10:06:27', '0000-00-00 00:00:00', 367, 1, NULL),
(1, '2021-12-24 10:08:27', '0000-00-00 00:00:00', 368, 1, NULL),
(1, '2021-12-24 10:11:34', '0000-00-00 00:00:00', 369, 1, NULL),
(1, '2021-12-24 17:06:12', '0000-00-00 00:00:00', 370, 1, NULL),
(1, '2021-12-25 13:01:36', '0000-00-00 00:00:00', 371, 1, NULL),
(1, '2021-12-25 16:14:49', '0000-00-00 00:00:00', 372, 1, NULL),
(1, '2021-12-25 18:46:59', '0000-00-00 00:00:00', 373, 1, NULL),
(1, '2021-12-25 18:55:01', '0000-00-00 00:00:00', 374, 1, NULL),
(1, '2021-12-25 19:17:50', '0000-00-00 00:00:00', 375, 1, NULL),
(1, '2021-12-26 05:02:56', '0000-00-00 00:00:00', 376, 1, NULL),
(1, '2021-12-26 05:19:04', '0000-00-00 00:00:00', 377, 1, NULL),
(1, '2021-12-26 07:11:52', '0000-00-00 00:00:00', 378, 1, NULL),
(1, '2021-12-26 08:48:33', '0000-00-00 00:00:00', 379, 1, NULL),
(1, '2021-12-26 10:04:12', '0000-00-00 00:00:00', 380, 1, NULL),
(1, '2021-12-26 20:00:25', '0000-00-00 00:00:00', 381, 1, NULL),
(1, '2021-12-27 07:20:25', '0000-00-00 00:00:00', 382, 1, NULL),
(1, '2021-12-27 07:24:36', '0000-00-00 00:00:00', 383, 1, NULL),
(1, '2021-12-27 07:26:37', '0000-00-00 00:00:00', 384, 1, NULL),
(1, '2021-12-27 07:46:15', '0000-00-00 00:00:00', 385, 1, NULL),
(1, '2021-12-27 08:13:48', '0000-00-00 00:00:00', 386, 1, NULL),
(1, '2021-12-27 08:15:15', '0000-00-00 00:00:00', 387, 1, NULL),
(1, '2021-12-27 08:23:13', '0000-00-00 00:00:00', 388, 1, NULL),
(1, '2021-12-27 08:27:03', '0000-00-00 00:00:00', 389, 1, NULL),
(1, '2021-12-27 08:38:16', '0000-00-00 00:00:00', 390, 1, NULL),
(1, '2021-12-27 08:46:18', '0000-00-00 00:00:00', 391, 1, NULL),
(1, '2021-12-27 09:01:22', '0000-00-00 00:00:00', 392, 1, NULL),
(1, '2021-12-27 09:55:18', '0000-00-00 00:00:00', 393, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_mas`
--

DROP TABLE IF EXISTS `user_mas`;
CREATE TABLE IF NOT EXISTS `user_mas` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `user_nm` varchar(25) DEFAULT NULL,
  `user_id` varchar(10) NOT NULL,
  `pwd` blob,
  `current_status` varchar(1) DEFAULT 'I',
  `user_type` varchar(1) DEFAULT 'G',
  `photo_path` text,
  `page_per` text,
  `s_per` text,
  `orgn_id` int(5) NOT NULL DEFAULT '0',
  `status` varchar(1) DEFAULT 'A',
  `user_cont_no` varchar(10) DEFAULT NULL,
  `mail_id` text,
  PRIMARY KEY (`user_id`,`orgn_id`),
  KEY `uid` (`uid`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_mas`
--

INSERT INTO `user_mas` (`uid`, `user_nm`, `user_id`, `pwd`, `current_status`, `user_type`, `photo_path`, `page_per`, `s_per`, `orgn_id`, `status`, `user_cont_no`, `mail_id`) VALUES
(1, 'Administrator', 'admin', 0x243279243130247a6842464e4930652f38727277445564723455543875346d4d356a4836304f774f532e316173454674473355794134696c79684c71, 'I', 'A', NULL, NULL, NULL, 1, 'A', '', ''),
(2, 'surajit', 'surajit', 0x243279243130247a6842464e4930652f38727277445564723455543875346d4d356a4836304f774f532e316173454674473355794134696c79684c71, 'I', 'S', '/uploads/user/12.png', '8, 10,24, 25, 31', '66, 67, 82, 84', 1, 'A', '9051530165', 'surajit@infotechsystems.in');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_mas`
--

DROP TABLE IF EXISTS `youtube_mas`;
CREATE TABLE IF NOT EXISTS `youtube_mas` (
  `yt_id` int(5) NOT NULL AUTO_INCREMENT,
  `yt_title` varchar(50) NOT NULL,
  `yt_link` text NOT NULL,
  `branch_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`yt_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `youtube_mas`
--

INSERT INTO `youtube_mas` (`yt_id`, `yt_title`, `yt_link`, `branch_id`) VALUES
(4, 'Diya Competition', 'https://www.youtube.com/embed/HwTVBT0BxMg', 1),
(5, 'Janmastami', 'https://www.youtube.com/embed/LoRRDoP0gw8', 1),
(6, 'Merry Christmas 2021 KG-I', 'https://www.youtube.com/embed/xx9NUh00AEE', 1),
(7, 'Merry Christmas-21', 'https://www.youtube.com/embed/6IFWFR0g22c', 1),
(8, 'Merry Christmas 2021 KG-I', 'https://www.youtube.com/embed/xx9NUh00AEE', 2),
(9, 'Merry Christmas-21', 'https://www.youtube.com/embed/6IFWFR0g22c', 2),
(10, 'X-mas 2021', 'https://www.youtube.com/embed/jEGV7_RBvcU', 1),
(11, 'x-mas', 'https://www.youtube.com/embed/jEGV7_RBvcU', 2),
(12, 'Sports', 'https://www.youtube.com/embed/oD5cHBCtQ5s', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
