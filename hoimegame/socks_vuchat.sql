-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2012 at 10:55 AM
-- Server version: 5.1.65
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socks_vuchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `blab6_lines`
--

CREATE TABLE IF NOT EXISTS `blab6_lines` (
  `line_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `line_txt` text NOT NULL,
  PRIMARY KEY (`line_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `blab6_lines`
--

INSERT INTO `blab6_lines` (`line_id`, `from_id`, `from_name`, `timestamp`, `line_txt`) VALUES
(1, 1, 'minhthanh', 1352575716, 'ChÃ³ ThÃ nh'),
(2, 2, 'tienvu', 1352575886, 'Oh yeah!'),
(3, 2, 'tienvu', 1352576007, '<img src="skin_default/smilies/grin.png"  alt=":grin:" />  OMG kÃ  kÃ  kÃ '),
(4, 2, 'tienvu', 1352576085, 'ss'),
(5, 2, 'tienvu', 1352576087, 'ss'),
(6, 2, 'tienvu', 1352576109, 'hello bong zua'),
(7, 2, 'tienvu', 1352576187, 'vÅ© Ä‘áº¡i ka is here'),
(8, 2, 'tienvu', 1352576200, 's'),
(9, 2, 'tienvu', 1352576232, 'hel'),
(10, 2, 'tienvu', 1352576266, 'he'),
(11, 2, 'tienvu', 1352576277, 'g'),
(12, 2, 'tienvu', 1352576300, 'gssssssssssssssssssssssssssssssssss'),
(13, 2, 'tienvu', 1352576390, 's'),
(14, 2, 'tienvu', 1352576391, 's'),
(15, 2, 'tienvu', 1352576395, 'scs'),
(16, 2, 'tienvu', 1352576398, '<img src="skin_default/smilies/unsure.png"  alt=":unsure:" />'),
(17, 4, 'ssssssssss', 1352578467, 'Crack IMindmap V6.1 Windows 8'),
(18, 4, 'ssssssssss', 1352578486, 'Link down imindmap v6.1'),
(19, 4, 'ssssssssss', 1352578543, '<span class="lu" onclick="window.open(''http://c719360.r60.cf3.rackcdn.com/imindmap6_windows_6.1.exe'');return false">c719360.r60.cf3.rackcdn.c...</span>'),
(20, 4, 'ssssssssss', 1352578575, '<span class="lu" onclick="window.open(''https://www.box.com/s/2ka3h7lk24s96uqd5emj'');return false">www.box.com/s/2ka3h7lk24s...</span>'),
(21, 4, 'ssssssssss', 1352578589, 'win7'),
(22, 4, 'ssssssssss', 1352578590, '<span class="lu" onclick="window.open(''http://www.mediafire.com/?3ly9oj84yutwk7j'');return false">www.mediafire.com/?3ly9oj...</span>'),
(23, 4, 'ssssssssss', 1352578811, 's'),
(24, 4, 'ssssssssss', 1352578811, 's'),
(25, 4, 'ssssssssss', 1352578813, 's'),
(26, 4, 'ssssssssss', 1352578813, 's'),
(27, 4, 'ssssssssss', 1352578818, 'oh yeaghh'),
(28, 4, 'ssssssssss', 1352578824, 'Ã¡'),
(29, 4, 'ssssssssss', 1352578824, 'Ã¡'),
(30, 4, 'ssssssssss', 1352578825, 'Ã¡'),
(31, 4, 'ssssssssss', 1352578825, 'sa'),
(32, 4, 'ssssssssss', 1352578940, 's'),
(33, 4, 'ssssssssss', 1352578941, 's'),
(34, 4, 'ssssssssss', 1352578941, 's'),
(35, 4, 'ssssssssss', 1352578942, 's'),
(36, 4, 'ssssssssss', 1352578943, 's'),
(37, 4, 'ssssssssss', 1352578945, 's'),
(38, 4, 'ssssssssss', 1352578986, 'Bá»§m Äƒn cá»©t heo'),
(39, 3, 'tienvu', 1352579960, 'j'),
(40, 3, 'tienvu', 1352579971, 's'),
(41, 4, 'ssssssssss', 1352579976, 's'),
(42, 3, 'tienvu', 1352580004, '1'),
(43, 3, 'tienvu', 1352580005, '1'),
(44, 3, 'tienvu', 1352580006, '1'),
(45, 4, 'ssssssssss', 1352580020, 's'),
(46, 4, 'ssssssssss', 1352580021, 's'),
(47, 4, 'ssssssssss', 1352580022, 's'),
(48, 4, 'ssssssssss', 1352580023, 's'),
(49, 4, 'ssssssssss', 1352580024, 's'),
(50, 4, 'ssssssssss', 1352580024, 's'),
(51, 4, 'ssssssssss', 1352580024, 's'),
(52, 4, 'ssssssssss', 1352580025, 's'),
(53, 4, 'ssssssssss', 1352580025, 's'),
(54, 4, 'ssssssssss', 1352580026, 's'),
(55, 4, 'ssssssssss', 1352580026, 's'),
(56, 4, 'ssssssssss', 1352580027, 's'),
(57, 4, 'ssssssssss', 1352580027, 's'),
(58, 4, 'ssssssssss', 1352580027, 's'),
(59, 4, 'ssssssssss', 1352580027, 's'),
(60, 4, 'ssssssssss', 1352580029, 's'),
(61, 4, 'ssssssssss', 1352580030, 'f'),
(62, 4, 'ssssssssss', 1352580030, 'g'),
(63, 4, 'ssssssssss', 1352580030, 'x'),
(64, 4, 'ssssssssss', 1352580031, 'zv'),
(65, 4, 'ssssssssss', 1352580032, 'v'),
(66, 4, 'ssssssssss', 1352580032, 's'),
(67, 4, 'ssssssssss', 1352580032, 'b'),
(68, 4, 'ssssssssss', 1352580033, 'b'),
(69, 4, 'ssssssssss', 1352580033, 'e'),
(70, 4, 'ssssssssss', 1352580034, 'egÆ°'),
(71, 4, 'ssssssssss', 1352580034, 'hÆ°'),
(72, 4, 'ssssssssss', 1352580034, 'eweh'),
(73, 4, 'ssssssssss', 1352580035, 'Æ°eh'),
(74, 4, 'ssssssssss', 1352580051, 'â€¹<i>@ssssssssss</i>â€º ?'),
(75, 3, 'tienvu', 1352580601, 's'),
(76, 3, 'tienvu', 1352580601, 's'),
(77, 3, 'tienvu', 1352580602, 's'),
(78, 3, 'tienvu', 1352580602, 's'),
(79, 3, 'tienvu', 1352580602, 's'),
(80, 3, 'tienvu', 1352580603, 's'),
(81, 3, 'tienvu', 1352580610, 'kaka kakÃ¡4'),
(82, 3, 'tienvu', 1352580612, 'okÃ '),
(83, 3, 'tienvu', 1352580614, 'okÃ¡o'),
(84, 3, '', 1352580651, '<span style="font-size:150%;font-weight:bold">Xong chat room khÃ´ng cáº§n Ä‘Äƒng kÃ½, host upload khÃ´ng cáº§n Ä‘Äƒng nháº­p  (tienvu)</span>'),
(85, 4, 'ssssssssss', 1352582613, '<span class="lu" onclick="window.open(''http://www.vn-zoom.com/f88/mediafire-imindmap-6-0-full-crack-portable-full-2149700.html'');return false">www.vn-zoom.com/f88/media...</span>'),
(86, 3, 'tienvu', 1352582767, 'Uar'),
(87, 3, 'tienvu', 1352582773, 'laf sao'),
(88, 3, 'tienvu', 1352582777, 'a'),
(89, 3, 'tienvu', 1352582777, 'a'),
(90, 3, 'tienvu', 1352582777, 'a'),
(91, 3, 'tienvu', 1352582778, 'a'),
(92, 4, 'ssssssssss', 1352583212, '0'),
(93, 3, 'tienvu', 1352627749, 'sdv'),
(94, 3, 'tienvu', 1352627749, 'sa'),
(95, 3, 'tienvu', 1352627749, 'sva'),
(96, 3, 'tienvu', 1352627750, 'sva'),
(97, 3, '', 1352627785, '<span style="font-size:150%;font-weight:bold">Xong chat room khÃ´ng cáº§n Ä‘Äƒng kÃ½, host upload khÃ´ng cáº§n Ä‘Äƒng nháº­p  (tienvu)</span>'),
(98, 3, 'tienvu', 1352627831, '<img src="skin_default/smilies/heart.png"  alt=":heart:" />'),
(99, 3, 'tienvu', 1352627876, '<img src="skin_default/smilies/wub.png"  alt=":wub:" />'),
(100, 4, 'ssssssssss', 1352646161, '<img src="skin_default/smilies/ga-thap-nhang.gif"  alt=":gathapnhang:" /> ChÃ³ thÃ nh'),
(101, 3, 'tienvu', 1352647131, '<img src="skin_default/smilies/ga-die.gif"  alt=":gadie:" />'),
(102, 5, 'kubum', 1352647894, '<img src="skin_default/smilies/ga-to-tinh.gif"  alt=":gatotinh:" />'),
(103, 5, 'kubum', 1352647903, '<img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />'),
(104, 5, 'kubum', 1352647910, '<img src="skin_default/smilies/ga-sac-mau.gif"  alt=":gasacmau:" />'),
(105, 5, 'kubum', 1352647916, '<img src="skin_default/smilies/ga-sang-kien.gif"  alt=":gasangkien:" />'),
(106, 5, 'kubum', 1352647919, '<img src="skin_default/smilies/ga-say-xin.gif"  alt=":gasayxin:" />'),
(107, 5, 'kubum', 1352647926, '<img src="skin_default/smilies/ga-ngap.gif"  alt=":gangap:" />'),
(108, 5, 'kubum', 1352647931, '<img src="skin_default/smilies/ga-kenh-kieu.gif"  alt=":gakenhkieu:" />'),
(109, 5, 'kubum', 1352647937, '<img src="skin_default/smilies/ga-le-luoi.gif"  alt=":galeluoi:" />'),
(110, 3, 'tienvu', 1352671806, '<img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />'),
(111, 3, 'tienvu', 1352677453, '<img src="skin_default/smilies/ga-ngu.gif"  alt=":gangu:" />'),
(112, 5, 'kubum', 1352698358, '<img src="skin_default/smilies/ga-ngu.gif"  alt=":gangu:" />'),
(113, 6, 'dat', 1352713022, '<img src="skin_default/smilies/ga-kenh-kieu.gif"  alt=":gakenhkieu:" />'),
(114, 3, 'tienvu', 1352724293, 'Bá»§m lÃªu lÃªu  <img src="skin_default/smilies/ga-le-luoi.gif"  alt=":galeluoi:" />'),
(115, 7, 'lapdong', 1352735364, 'way cho vu co day ko  <img src="skin_default/smilies/ga-to-tinh.gif"  alt=":gatotinh:" />    <img src="skin_default/smilies/ga-thap-nhang.gif"  alt=":gathapnhang:" />  <img src="skin_default/smilies/ga-say-xin.gif"  alt=":gasayxin:" />  <img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />'),
(116, 5, 'kubum', 1352735423, 'CHIM SE GOI DAI BANG'),
(117, 5, 'kubum', 1352735473, '<img src="skin_default/smilies/ga-karaoke.gif"  alt=":gakaraoke:" />'),
(118, 7, 'lapdong', 1352735684, 'dai bang dang di nhau'),
(119, 5, 'kubum', 1352735687, 'ÄÃ”NG LÃŠN Rá»’I Háº¢'),
(120, 7, 'lapdong', 1352735695, 'chim xe qua nho ko du nham ruou'),
(121, 7, 'lapdong', 1352735699, 'uh'),
(122, 7, 'lapdong', 1352735705, 'kekeke ta da tro laij'),
(123, 5, 'kubum', 1352735707, 'KA KA'),
(124, 7, 'lapdong', 1352735711, 'loi hai nhan doi'),
(125, 7, 'lapdong', 1352735735, 'cho vu di dau roi'),
(126, 7, 'lapdong', 1352735741, 've canh nha gap'),
(127, 7, 'lapdong', 1352735750, 'can tim cho lac'),
(128, 7, 'lapdong', 1352735754, 'ah lo ahlo'),
(129, 8, 'vudaika', 1352735792, 'anh Ä‘Ã¢y'),
(130, 8, 'vudaika', 1352735815, 'mÃ y thá»­ upload báº±ng cÃ¡i cÃ´ng cá»¥ phÃ­a trÃªn kia Ä‘i'),
(131, 8, 'vudaika', 1352735840, 'ai online lÃ  nÃ³ hiá»‡n bÃªn pháº£i Ä‘Ã³'),
(132, 7, 'lapdong', 1352735864, 'ok cho ngoan ko can duong'),
(133, 7, 'lapdong', 1352735868, 'anh dang thu kkekekekeke'),
(134, 8, 'vudaika', 1352735884, 'muá»‘n upload thÃ¬ má»Ÿ trang upload ra'),
(135, 8, 'vudaika', 1352735889, 'kÃ©o vÃ  tháº£ vÃ o Ä‘Ã³'),
(136, 8, 'vudaika', 1352735893, 'nÃ³ sáº» upload ngay'),
(137, 8, 'vudaika', 1352735904, 'nÃ³ cÃ³ chá»©c nÄƒng khi upload xong gá»­i vá» mail'),
(138, 8, 'vudaika', 1352735924, 'mÃ y nhÃ¬n kÄ© thÃ¬ tháº¥y'),
(139, 7, 'lapdong', 1352735952, 'ok thay roi'),
(140, 7, 'lapdong', 1352735994, '<span class="lu" onclick="window.open(''http://ge.tt/4xcM1TR/v/0?c'');return false">ge.tt/4xcM1TR/v/0?c</span>'),
(141, 8, 'vudaika', 1352736150, 'cÃ¡i nÃ y Ä‘Æ°á»£c chá»© Ä‘Ã´ng nhá»‰'),
(142, 8, 'vudaika', 1352736159, 'Ä‘Ãºng nhá»¯ng yÃªu cáº§u cá»§a tá»¥i mÃ¬nh rá»“i mÃ '),
(143, 7, 'lapdong', 1352736162, '<span style="color:#99FFCC"><i>ok tuyet</i></span>'),
(144, 8, 'vudaika', 1352736166, 'á»§a'),
(145, 8, 'vudaika', 1352736167, 'k'),
(146, 8, 'vudaika', 1352736167, 'k'),
(147, 8, 'vudaika', 1352736167, 'k'),
(148, 8, 'vudaika', 1352736168, 'k'),
(149, 7, 'lapdong', 1352736170, '<span style="color:#99FFCC"><i>vua di nhau ve</i></span>'),
(150, 7, 'lapdong', 1352736173, '<span style="color:#99FFCC"><i>met qua</i></span>'),
(151, 7, 'lapdong', 1352736183, '<span style="color:#99FFCC"><i>di ngu day</i></span>'),
(152, 7, 'lapdong', 1352736191, '<span style="color:#99FFCC"><i>chua lam pt tkhdt nua</i></span>'),
(153, 7, 'lapdong', 1352736193, '<span style="color:#99FFCC"><i>met</i></span>'),
(154, 7, 'lapdong', 1352736200, '<span style="color:#99FFCC"><i>ngu ngon nha cho</i></span>'),
(155, 7, 'lapdong', 1352736204, '<span style="color:#99FFCC"><i>ah quyen</i></span>'),
(156, 7, 'lapdong', 1352736208, '<span style="color:#99FFCC"><i>cho ko dc ngu</i></span>'),
(157, 7, 'lapdong', 1352736213, '<span style="color:#99FFCC"><i>di canh nha di may''</i></span>'),
(158, 7, 'lapdong', 1352736637, '<span style="color:#99FFCC"><i><img src="skin_default/smilies/ga-karaoke.gif"  alt=":gakaraoke:" /></i></span>'),
(159, 9, 'dong', 1352766638, '<img src="skin_default/smilies/ga-ngu.gif"  alt=":gangu:" />'),
(160, 9, 'dong', 1352769174, '<img src="skin_default/smilies/ga-sac-mau.gif"  alt=":gasacmau:" />  <img src="skin_default/smilies/ga-sac-mau.gif"  alt=":gasacmau:" />  <img src="skin_default/smilies/ga-sac-mau.gif"  alt=":gasacmau:" />  <img src="skin_default/smilies/ga-sac-mau.gif"  alt=":gasacmau:" />'),
(161, 10, 'chothanh', 1352771157, '<img src="skin_default/smilies/ga-bo-tay.gif"  alt=":gabotay:" />'),
(162, 10, 'chothanh', 1352771171, '<img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />  <img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />  <img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />  <img src="skin_default/smilies/ga-sat-thu.gif"  alt=":gasatthu:" />'),
(163, 11, 'ducop', 1352782946, 'duc cop  <img src="skin_default/smilies/ga-sac-mau.gif"  alt=":gasacmau:" />'),
(164, 12, 'Mr. Dragon', 1352792723, '<img src="skin_default/smilies/ga-dance.gif"  alt=":gadance:" />  vÅ© á»Ÿi Game Ä‘Ã¢u?'),
(165, 3, 'tienvu', 1352803785, 'chÆ°a , nÃ³ bá»‹ bá»ƒ trÃªn chrome vá»›i ie'),
(166, 3, 'tienvu', 1352803793, 'chá»‰ chÆ¡i Ä‘c trÃªn firefox Ã '),
(167, 3, 'tienvu', 1352803811, '<img src="skin_default/smilies/ga-cham-hoi.gif"  alt=":gachamhoi:" /> tui Ä‘ang ngÃ¢m kiÃº');

-- --------------------------------------------------------

--
-- Table structure for table `blab6_online`
--

CREATE TABLE IF NOT EXISTS `blab6_online` (
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(64) NOT NULL,
  `usr_ip` varchar(15) NOT NULL,
  `rtime` int(11) NOT NULL
) ENGINE=MEMORY DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blab6_online`
--

INSERT INTO `blab6_online` (`usr_id`, `usr_name`, `usr_ip`, `rtime`) VALUES
(3, 'tienvu', '118.68.58.10', 1352845899);

-- --------------------------------------------------------

--
-- Table structure for table `blab6_paintings`
--

CREATE TABLE IF NOT EXISTS `blab6_paintings` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_srx` text NOT NULL,
  `p_sry` text NOT NULL,
  `p_src` text NOT NULL,
  `p_bgc` char(6) NOT NULL,
  `p_views` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(255) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blab6_settings`
--

CREATE TABLE IF NOT EXISTS `blab6_settings` (
  `set_id` varchar(16) NOT NULL,
  `set_value` text NOT NULL,
  `set_fast` smallint(6) NOT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blab6_settings`
--

INSERT INTO `blab6_settings` (`set_id`, `set_value`, `set_fast`) VALUES
('acp_timezone', '420', 0),
('default_timeform', '0', 0),
('default_language', '5', 0),
('default_effects', '1', 0),
('default_sound1', '0', 0),
('default_sound2', '0', 0),
('default_sound3', '0', 0),
('default_sound4', '7', 0),
('title', 'Há»™i nhá»¯ng ngÆ°á»i vÃ  Ch* phÃ¡t cuá»“ng vÃ¬ game', 0),
('guests', '1', 0),
('register', '1', 0),
('activation', '0', 0),
('url', 'http://tienvu.net/chat/', 0),
('default_mail', 'noreply@tienvu.net', 0),
('ajax_delay', '10', 0),
('ajax_update', '5', 0),
('post_length', '2048', 0),
('post_interv', '1', 0),
('admin_lang', '0', 0),
('wrong_acp', '0', 0),
('acp_key', 'd8dc2968ba1f3da1d6b16a406c3bed3d', 0),
('admin_css', '1', 0),
('notebook', 'DÃ¹ng ge.tt Ä‘á»ƒ upload', 1),
('meta_desc', '', 0),
('meta_keyw', '', 0),
('del_gbuddies', '0', 0),
('mssg_history', '17520', 0),
('optimize_tbl', '1', 0),
('acp_attempts', '30', 0),
('acp_lhours', '2', 0),
('show_topic', '0', 0),
('logo', '<div class="blab_logo"></div>', 0),
('cookie_salt', '7fbad5b029480839', 0),
('faq_page', '<div style="margin:10px">\r\n\r\n<div style="font-weight:bold">\r\n<span style="font-weight:normal">01.</span> \r\n<span class="ln" onclick="help_all(0);return show_help(''s0'')">Quick start</span></div>\r\n<div id="s0" style="display:block;margin:8px;text-align:justify">Welcome to our chat! Here you can find some information that will help you become familiar with the features that our chat offers. \r\nPlease keep in mind that depending on the settings set by the administrator of this chat the information below might not be 100% accurate.</div>\r\n\r\n<div style="font-weight:bold">\r\n<span style="font-weight:normal">02.</span> \r\n<span class="ln" onclick="help_all(0);return show_help(''s1'')">Settings</span></div>\r\n<div id="s1" style="display:none;margin:8px;text-align:justify">You can easily alter the settings of the chat - click on SETTINGS at the top of the chat window.\r\nSelect your preferred language, timezone, time format, sound alerts etc.</div>\r\n\r\n<div style="font-weight:bold">\r\n<span style="font-weight:normal">03.</span> \r\n<span class="ln" onclick="help_all(0);return show_help(''s2'')">Profile</span></div>\r\n<div id="s2" style="display:none;margin:8px;text-align:justify">\r\nWhen you need to set a new password, retype it carefully and also make sure that you enter a correct old password. \r\nIf you are a guest user the old password is automatically set for you.\r\nIf you are a guest user and you want to save your profile, you have to enter a valid email address.</div>\r\n\r\n<br />\r\n<span class="ln" onclick="help_all(1);return false">Show all</span>\r\n<b>&middot;</b>\r\n<span class="ln" onclick="help_all(0);return false">Hide all</span>\r\n</div>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blab6_users`
--

CREATE TABLE IF NOT EXISTS `blab6_users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(64) NOT NULL,
  `usr_pass` char(32) NOT NULL,
  `usr_mail` varchar(64) NOT NULL,
  `usr_join_date` int(11) NOT NULL,
  `usr_status` varchar(8) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `blab6_users`
--

INSERT INTO `blab6_users` (`usr_id`, `usr_name`, `usr_pass`, `usr_mail`, `usr_join_date`, `usr_status`) VALUES
(3, 'tienvu', 'acf88da63538219a03447373d95e9a63', 'tienvuitdlu@gmail.com', 1352576586, '0'),
(4, 'ssssssssss', '0fc3caeff55a61251ec1fa4499d38cd5', '', 1352576834, '0'),
(5, 'kubum', '0fc3caeff55a61251ec1fa4499d38cd5', '', 1352624885, '0'),
(6, 'dat', 'acf88da63538219a03447373d95e9a63', 'chuvandatitdlu@gmail.com', 1352712952, '0'),
(7, 'lapdong', '5c76a6696bf0e6f0d0e1ca01916ea65d', '', 1352735317, '0'),
(8, 'vudaika', 'f9d428f7c67a56d587f7f974f9a824d7', '', 1352735762, '0'),
(9, 'dong', 'aa5b4fd613719ad0951e93a25a7bb53d', '', 1352766564, '0'),
(10, 'chothanh', 'aa5b4fd613719ad0951e93a25a7bb53d', '', 1352771123, '0'),
(11, 'ducop', '00d38c903e623a627227a33c5ee49753', '', 1352782915, '0'),
(12, 'Mr. Dragon', 'f8cd7c2426011301c34566d7a8dc5a83', '', 1352792683, '0'),
(13, 'trum', 'f9d428f7c67a56d587f7f974f9a824d7', '', 1352811099, '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
