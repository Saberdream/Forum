SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `forum_alerts`;
CREATE TABLE IF NOT EXISTS `forum_alerts` (
  `alert_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alert_postid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `alert_topicid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `alert_forumid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `alert_userid` mediumint(8) UNSIGNED NOT NULL,
  `alert_reason` varchar(100) NOT NULL DEFAULT '',
  `alert_closed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `alert_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `alert_page` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `alert_ip` varchar(40) NOT NULL,
  `alert_rank` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `alert_text` text NOT NULL,
  PRIMARY KEY (`alert_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_alerts_reasons`;
CREATE TABLE IF NOT EXISTS `forum_alerts_reasons` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_name` varchar(1000) NOT NULL,
  `reason_desc` text NOT NULL,
  `reason_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_avatars`;
CREATE TABLE IF NOT EXISTS `forum_avatars` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_userid` int(11) NOT NULL DEFAULT '0',
  `file_name` varchar(250) NOT NULL DEFAULT '',
  `file_width` int(11) NOT NULL DEFAULT '0',
  `file_height` int(11) NOT NULL DEFAULT '0',
  `file_size` int(11) NOT NULL DEFAULT '0',
  `file_mime` text NOT NULL,
  `file_time` int(11) NOT NULL DEFAULT '0',
  `file_ip` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_banlist`;
CREATE TABLE IF NOT EXISTS `forum_banlist` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ban_userid` int(11) NOT NULL DEFAULT '0',
  `ban_ip` varchar(40) NOT NULL DEFAULT '',
  `ban_email` varchar(1000) NOT NULL DEFAULT '',
  `ban_start` int(11) NOT NULL DEFAULT '0',
  `ban_end` int(11) DEFAULT '0',
  `ban_reason` text NOT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_categories`;
CREATE TABLE IF NOT EXISTS `forum_categories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_config`;
CREATE TABLE IF NOT EXISTS `forum_config` (
  `config_name` varchar(100) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  `config_type` char(1) NOT NULL,
  `config_form_type` varchar(10) NOT NULL,
  `config_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `config_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  UNIQUE KEY `config_name` (`config_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `forum_config` (`config_name`, `config_value`, `config_type`, `config_form_type`, `config_catid`, `config_order`) VALUES
('activate_avatar', '1', 'b', '', 4, 1),
('activate_pm', '1', 'b', '', 7, 1),
('activate_sign', '1', 'b', '', 2, 5),
('activate_upload', '1', 'b', '', 5, 1),
('allow_register', '1', 'b', '', 2, 3),
('attempt_wait_time', '3600', 'd', '', 1, 13),
('avatar_allowed_types', 'gif;jpeg;jpg;png', 's', 'tag', 4, 7),
('avatar_max_files', '5', 'd', '', 4, 5),
('avatar_max_height', '5000', 'd', '', 4, 2),
('avatar_max_size', '1', 'd', '', 4, 4),
('avatar_max_width', '5000', 'd', '', 4, 3),
('avatar_wait_time', '0', 'd', '', 4, 6),
('captcha_newtopic', '0', 'b', '', 3, 5),
('captcha_reply', '0', 'b', '', 3, 6),
('cookies_expiration_time', '365', 'd', '', 1, 14),
('cookies_name', 'forum_key', 's', 'input', 1, 18),
('default_lang', 'en', 's', 'select', 1, 2),
('default_style', 'base', 's', 'select', 1, 5),
('default_timezone', 'UTC', 's', 'select', 1, 3),
('desc_max_size', '15002', 'd', '', 2, 4),
('domain_name', 'forum.prog', 's', 'input', 6, 1),
('form_expiration_time', '900', 'd', '', 1, 8),
('load_limit', '0', 'd', '', 6, 4),
('max_autologin_time', '259200', 'd', '', 1, 10),
('max_avatars_per_user', '0', 'd', '', 4, 8),
('max_login_attempts', '5', 'd', '', 1, 12),
('max_sticky_topics', '3', 'd', '', 3, 9),
('max_subscribes', '50', 'd', '', 1, 15),
('notifications_limit', '20', 'd', '', 1, 16),
('pm_captcha', '0', 'b', '', 7, 4),
('pm_flood_time', '30', 'd', '', 7, 2),
('pm_max_participants', '30', 'd', '', 7, 9),
('pm_max_size', '100', 'd', '', 7, 6),
('pm_max_smilies', '50', 'd', '', 7, 8),
('pm_reply_captcha', '0', 'b', '', 7, 5),
('pm_reply_flood_time', '10', 'd', '', 7, 3),
('pm_reply_max_size', '5000', 'd', '', 7, 7),
('posts_per_page', '20', 'd', '', 3, 2),
('post_edit_flood_time', '4', 'd', '', 3, 12),
('post_flood_time', '10', 'd', '', 3, 4),
('post_max_size', '16000', 'd', '', 3, 8),
('post_max_smilies', '50', 'd', '', 3, 10),
('post_redirection_time', '0', 'd', '', 3, 11),
('sendmail_from', 'webmaster@yourdomain.com', 's', '', 6, 7),
('server_protocol', 'http://', 's', 'input', 6, 2),
('sessions_per_ip', '10', 'd', '', 1, 11),
('session_expiration_time', '3600', 'd', '', 1, 9),
('session_gc_probability', '1', 'd', '', 1, 17),
('sign_max_size', '5000', 'd', '', 2, 6),
('site_closed_reason', '', 's', 'textarea', 1, 7),
('site_description', '', 's', '', 1, 19),
('site_mail', 'webmaster@yourdomain.com', 's', 'input', 1, 4),
('site_name', 'Your forum', 's', 'input', 1, 1),
('site_open', '1', 'b', '', 1, 6),
('smtp_port', '25', 'd', '', 6, 6),
('smtp_server', 'smtp.yourdomain.com', 's', '', 6, 5),
('table_prefix', 'forum_', 's', 'input', 6, 3),
('topics_per_page', '25', 'd', '', 3, 1),
('topic_flood_time', '10', 'd', '', 3, 3),
('topic_max_size', '100', 'd', '', 3, 7),
('upload_allowed_types', 'jpg;png;jpeg;gif;tif', 's', 'tag', 5, 7),
('upload_max_files', '1', 'd', '', 5, 5),
('upload_max_height', '5000', 'd', '', 5, 2),
('upload_max_size', '100', 'd', '', 5, 4),
('upload_max_width', '5000', 'd', '', 5, 3),
('upload_wait_time', '0', 'd', '', 5, 6),
('user_style', '1', 'b', '', 2, 2),
('welcome_message', '', 's', 'textarea', 2, 1);

DROP TABLE IF EXISTS `forum_config_categories`;
CREATE TABLE IF NOT EXISTS `forum_config_categories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `forum_config_categories` (`cat_id`, `cat_name`, `cat_order`) VALUES
(1, 'general_configuration', 1),
(2, 'users_configuration', 2),
(3, 'forums_configuration', 3),
(4, 'avatars_configuration', 4),
(5, 'files_upload_configuration', 5),
(6, 'server_configuration', 6),
(7, 'pm_configuration', 7);

DROP TABLE IF EXISTS `forum_connected`;
CREATE TABLE IF NOT EXISTS `forum_connected` (
  `connected_sessionid` char(128) NOT NULL,
  `connected_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `connected_ip` varchar(40) NOT NULL,
  `connected_browser` varchar(150) NOT NULL,
  `connected_robot` varchar(30) NOT NULL DEFAULT '',
  `connected_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `connected_last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `connected_autologin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `connected_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`connected_sessionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_forums`;
CREATE TABLE IF NOT EXISTS `forum_forums` (
  `forum_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forum_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_name` varchar(100) NOT NULL,
  `forum_slug` varchar(1000) NOT NULL,
  `forum_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_desc` text NOT NULL,
  `forum_icon` varchar(1000) NOT NULL DEFAULT '',
  `forum_topics` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_topics_visible` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_posts_visible` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `forum_last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `forum_rules` text NOT NULL,
  `forum_alerts` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `forum_auth_view` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `forum_auth_topic` int(1) UNSIGNED NOT NULL DEFAULT '2',
  `forum_auth_reply` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `forum_auth_edit` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_edit_own` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `forum_auth_alert` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `forum_auth_lock_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_stick_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_delete_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_delete_post` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_restore_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '4',
  `forum_auth_restore_post` tinyint(1) UNSIGNED NOT NULL DEFAULT '4',
  `forum_auth_remove_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_remove_post` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_ban` tinyint(1) UNSIGNED NOT NULL DEFAULT '4',
  `forum_moderators` varchar(1000) NOT NULL DEFAULT '',
  `forum_closed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_keys`;
CREATE TABLE IF NOT EXISTS `forum_keys` (
  `key_id` char(32) NOT NULL,
  `key_userid` mediumint(8) UNSIGNED NOT NULL,
  `key_ip` varchar(40) NOT NULL,
  `key_last` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_login_attempts`;
CREATE TABLE IF NOT EXISTS `forum_login_attempts` (
  `attempt_ip` varchar(40) NOT NULL DEFAULT '',
  `attempt_username` varchar(30) NOT NULL DEFAULT '',
  `attempt_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `attempt_browser` varchar(150) NOT NULL,
  `attempt_nb` int(11) UNSIGNED NOT NULL DEFAULT '0',
  UNIQUE KEY `attempt_ip` (`attempt_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_login_logs`;
CREATE TABLE IF NOT EXISTS `forum_login_logs` (
  `log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `log_username` varchar(30) NOT NULL,
  `log_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `log_ip` varchar(40) NOT NULL DEFAULT '',
  `log_browser` varchar(150) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=459 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_notifications`;
CREATE TABLE IF NOT EXISTS `forum_notifications` (
  `notif_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notif_userid` int(11) UNSIGNED NOT NULL,
  `notif_name` varchar(100) NOT NULL,
  `notif_desc` text NOT NULL,
  `notif_url` varchar(1000) NOT NULL,
  `notif_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `notif_viewed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pictures`;
CREATE TABLE IF NOT EXISTS `forum_pictures` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_userid` int(11) NOT NULL DEFAULT '0',
  `file_name` varchar(250) NOT NULL DEFAULT '',
  `file_width` int(11) NOT NULL DEFAULT '0',
  `file_height` int(11) NOT NULL DEFAULT '0',
  `file_size` int(11) NOT NULL DEFAULT '0',
  `file_mime` text NOT NULL,
  `file_time` int(11) NOT NULL DEFAULT '0',
  `file_ip` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pm`;
CREATE TABLE IF NOT EXISTS `forum_pm` (
  `pm_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pm_postid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `pm_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `pm_username` varchar(30) NOT NULL DEFAULT '',
  `pm_name` varchar(1000) NOT NULL,
  `pm_first` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `pm_last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `pm_closed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `pm_rank` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `pm_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `pm_nb_participants` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `pm_participants` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pm_blacklist`;
CREATE TABLE IF NOT EXISTS `forum_pm_blacklist` (
  `bl_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bl_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bl_blacklisted_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bl_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`bl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pm_participants`;
CREATE TABLE IF NOT EXISTS `forum_pm_participants` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_userid` int(11) DEFAULT '0',
  `participant_pmid` int(11) NOT NULL DEFAULT '0',
  `participant_last` int(11) NOT NULL DEFAULT '0',
  `participant_read` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pm_posts`;
CREATE TABLE IF NOT EXISTS `forum_pm_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_pmid` int(11) NOT NULL DEFAULT '0',
  `post_userid` int(11) NOT NULL DEFAULT '0',
  `post_username` varchar(30) NOT NULL DEFAULT '',
  `post_time` int(11) NOT NULL DEFAULT '0',
  `post_ip` varchar(40) NOT NULL DEFAULT '',
  `post_rank` int(1) NOT NULL DEFAULT '1',
  `post_text` text NOT NULL,
  `post_text_parsed` text NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `post_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_topicid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `post_forumid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `post_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `post_username` varchar(30) NOT NULL DEFAULT '',
  `post_ip` varchar(40) NOT NULL DEFAULT '',
  `post_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `post_time_edit` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `post_rank` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `post_invisible` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `post_text` text NOT NULL,
  `post_text_parsed` text NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=434 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_sessions`;
CREATE TABLE IF NOT EXISTS `forum_sessions` (
  `session_id` char(128) NOT NULL,
  `session_set_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `session_data` text NOT NULL,
  `session_key` char(128) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_smilies`;
CREATE TABLE IF NOT EXISTS `forum_smilies` (
  `smiley_id` int(11) NOT NULL AUTO_INCREMENT,
  `smiley_code` varchar(30) NOT NULL DEFAULT '',
  `smiley_filename` varchar(250) NOT NULL DEFAULT '',
  `smiley_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`smiley_id`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

INSERT INTO `forum_smilies` (`smiley_id`, `smiley_code`, `smiley_filename`, `smiley_order`) VALUES
(16, ':coolgun:', '100.gif', 100),
(18, ':play:', '102.gif', 102),
(19, ':noelange:', '103.gif', 103),
(20, ':hapange:', '104.gif', 104),
(21, ':hap:', '105.gif', 105),
(22, ':hapmagie:', '106.gif', 106),
(23, ':haprire:', '107.gif', 107),
(24, ':hapok:', '108.gif', 108),
(25, ':hapok2:', '109.gif', 109),
(26, ':noel:', '11.gif', 11),
(27, ':hapravo:', '110.gif', 110),
(28, ':hapleure:', '111.gif', 111),
(29, ':weshap:', '112.gif', 112),
(30, ':jap:', '113.gif', 113),
(31, ':juif:', '114.gif', 114),
(32, ':noelgun:', '115.gif', 115),
(33, ':noelfuck:', '116.gif', 116),
(34, ':nowesh:', '117.gif', 117),
(35, ':nowel:', '118.gif', 118),
(36, ':hawp:', '119.gif', 119),
(37, ':o))', '12.gif', 12),
(38, ':wiwe:', '120.gif', 120),
(39, ':nocoeur:', '121.gif', 121),
(40, ':noelbbr:', '122.gif', 122),
(41, ':supergni:', '123.gif', 123),
(42, ':dead:', '124.gif', 124),
(43, ':morsay:', '125.gif', 125),
(44, ':bave2:', '126.gif', 126),
(45, ':fu:', '127.gif', 127),
(46, ':lazor:', '128.gif', 128),
(47, ':hapananas:', '129.gif', 129),
(48, ':snif2:', '13.gif', 13),
(49, ':panachay:', '131.gif', 131),
(50, ':nowelak:', '132.gif', 132),
(51, ':hapak:', '133.gif', 133),
(52, ':+1:', '134.gif', 134),
(53, ':nowelok:', '135.gif', 135),
(54, ':nowelok2:', '136.gif', 136),
(55, ':ouwch:', '137.gif', 137),
(56, ':peuw:', '138.gif', 138),
(57, ':monosouwcil:', '139.gif', 139),
(58, ':-(', '14.gif', 14),
(64, ':fuautiste:', '142.gif', 142),
(65, ':fu2:', '143.gif', 143),
(66, ':why:', '144.gif', 144),
(67, ':ahh:', '145.gif', 145),
(68, ':fuhappy:', '146.gif', 146),
(69, ':palm:', '147.gif', 147),
(70, ':cereal:', '148.gif', 148),
(71, ':scared:', '149.gif', 149),
(72, ':angry:', '15.gif', 15),
(73, ':scared2:', '150.gif', 150),
(74, ':popcorn:', '151.gif', 151),
(75, ':pf:', '152.gif', 152),
(76, ':stp:', '153.gif', 153),
(77, ':play:', '154.gif', 154),
(78, ':hapoelparty:', '155.gif', 155),
(79, ':pokhap:', '156.gif', 156),
(80, ':btv:', '157.gif', 157),
(81, ':zik:', '158.gif', 158),
(82, ':mmh:', '159.gif', 159),
(83, ':mac:', '16.gif', 16),
(84, ':geek:', '160.gif', 160),
(85, ':kiss:', '161.gif', 161),
(86, ':dark:', '162.gif', 162),
(87, ':x5:', '163.gif', 163),
(88, ':alone:', '164.gif', 164),
(89, ':nowelgun:', '165.gif', 165),
(90, ':damned:', '166.gif', 166),
(91, ':haha:', '167.gif', 167),
(92, ':hah:', '168.gif', 168),
(93, ':xo:', '169.gif', 169),
(94, ':gba:', '17.gif', 17),
(95, ':hehe:', '170.gif', 170),
(96, ':haplaudit:', '171.gif', 171),
(97, ':wi:', '172.gif', 172),
(98, ':wiok:', '173.gif', 173),
(99, ':wicoeur:', '174.gif', 174),
(100, ':god:', '175.gif', 175),
(101, ':bescherelle:', '176.gif', 176),
(102, ':wtf:', '177.gif', 177),
(103, ':fff:', '178.gif', 178),
(104, ':fuhitler:', '179.gif', 179),
(105, ':hap:', '18.gif', 18),
(106, ':trollw:', '180.gif', 180),
(107, ':challenge:', '181.gif', 181),
(108, ':hahlone:', '182.gif', 182),
(109, ':gusta:', '183.gif', 183),
(110, ':chuck:', '184.gif', 184),
(111, ':bourre:', '185.gif', 185),
(112, ':yea:', '186.gif', 186),
(113, ':link:', '187.gif', 187),
(114, ':miyamoto:', '188.gif', 188),
(115, ':beauf:', '189.gif', 189),
(116, ':nah:', '19.gif', 19),
(117, ':wsh:', '190.gif', 190),
(118, ':lamasticot:', '191.gif', 191),
(119, ':psycho:', '192.gif', 192),
(120, ':rage:', '193.gif', 193),
(121, ':toh:', '194.gif', 194),
(122, ':pervers:', '195.gif', 195),
(123, ':cat:', '196.gif', 196),
(124, ':music:', '197.gif', 197),
(125, ':nerd:', '198.gif', 198),
(126, ':pfete:', '199.gif', 199),
(127, ':snif2:', '20.gif', 20),
(128, ':awyeah:', '200.gif', 200),
(129, ':nolife:', '201.gif', 201),
(130, ':nodiable:', '202.gif', 202),
(131, ':nolol:', '203.gif', 203),
(132, ':ntroll:', '204.gif', 204),
(133, ':siffle:', '205.gif', 205),
(134, ':accepted:', '206.gif', 206),
(135, ':denied:', '207.gif', 207),
(136, ':kidding:', '208.gif', 208),
(137, ':yuno:', '209.gif', 209),
(138, ':mort:', '21.gif', 21),
(139, ':fap:', '210.gif', 210),
(140, ':facepalm:', '211.gif', 211),
(141, ':ordi:', '212.gif', 212),
(142, ':hapoel:', '213.gif', 213),
(143, ':okay:', '214.gif', 214),
(144, ':fu3:', '215.gif', 215),
(145, ':cute:', '216.gif', 216),
(146, ':feel:', '217.gif', 217),
(147, ':feelbro:', '218.gif', 218),
(148, ':feelcry:', '219.gif', 219),
(150, ':notbad:', '220.gif', 220),
(151, ':pff:', '221.gif', 221),
(152, ':noo:', '222.gif', 222),
(153, ':wait:', '223.gif', 223),
(154, ':ponche:', '224.gif', 224),
(155, ':poker:', '225.gif', 225),
(156, ':sfp:', '226.gif', 226),
(157, ':obvious:', '227.gif', 227),
(158, ':fap2:', '228.gif', 228),
(159, ':lock:', '229.gif', 229),
(160, ':-)))', '23.gif', 23),
(161, ':content:', '24.gif', 24),
(162, ':honte:', '25.gif', 25),
(163, ':cool:', '26.gif', 26),
(164, ':sleep:', '27.gif', 27),
(165, ':doute:', '28.gif', 28),
(166, ':hello:', '29.gif', 29),
(167, ':g)', '3.gif', 3),
(168, ':honte:', '30.gif', 30),
(169, ':-p', '31.gif', 31),
(170, ':lol:', '32.gif', 32),
(171, ':non:', '33.gif', 33),
(172, ':monoeil:', '34.gif', 34),
(173, ':non2:', '35.gif', 35),
(174, ':ok:', '36.gif', 36),
(175, ':oui:', '37.gif', 37),
(176, ':rechercher:', '38.gif', 38),
(177, ':rire:', '39.gif', 39),
(178, ':d))', '4.gif', 4),
(179, ':-D', '40.gif', 40),
(180, ':rire2:', '41.gif', 41),
(181, ':salut:', '42.gif', 42),
(182, ':sarcastic:', '43.gif', 43),
(183, ':up:', '44.gif', 44),
(184, ':(', '45.gif', 45),
(185, ':-)', '46.gif', 46),
(186, ':peur:', '47.gif', 47),
(187, ':bye:', '48.gif', 48),
(188, ':dpdr:', '49.gif', 49),
(190, ':fou:', '50.gif', 50),
(191, ':gne:', '51.gif', 51),
(192, ':dehors:', '52.gif', 52),
(193, ':fier:', '53.gif', 53),
(194, ':coeur:', '54.gif', 54),
(195, ':-D', '55.gif', 55),
(196, ':sors:', '56.gif', 56),
(197, ':ouch2:', '57.gif', 57),
(198, ':merci:', '58.gif', 58),
(199, ':svp:', '59.gif', 59),
(201, ':ange:', '60.gif', 60),
(202, ':diable:', '61.gif', 61),
(203, ':gni:', '62.gif', 62),
(204, ':spoiler:', '63.gif', 63),
(205, ':hs:', '64.gif', 64),
(206, ':desole:', '65.gif', 65),
(207, ':fete:', '66.gif', 66),
(208, ':sournois:', '67.gif', 67),
(209, ':hum:', '68.gif', 68),
(210, ':bravo:', '69.gif', 69),
(211, ':p)', '7.gif', 7),
(212, ':banzai:', '70.gif', 70),
(213, ':bave:', '71.gif', 71),
(214, ':fish:', '72.gif', 72),
(215, ':noelok:', '73.gif', 73),
(216, ':noelok2:', '74.gif', 74),
(217, ':bide:', '75.gif', 75),
(218, ':nobounce:', '76.gif', 76),
(219, ':wesh:', '77.gif', 77),
(220, ':fake:', '78.gif', 78),
(221, ':owned:', '79.gif', 79),
(222, ':malade:', '8.gif', 8),
(223, ':-D', '80.gif', 80),
(224, ':osef:', '81.gif', 81),
(225, ':ahok:', '82.gif', 82),
(226, ':ahok2:', '83.gif', 83),
(227, ':jerry:', '84.gif', 84),
(228, ':approved:', '85.gif', 85),
(229, ':chuck2:', '86.gif', 86),
(230, ':troll:', '87.gif', 87),
(231, ':trolling:', '88.gif', 88),
(232, ':fu4:', '89.gif', 89),
(233, ':pacg:', '9.gif', 9),
(234, ':mario:', '90.gif', 90),
(235, ':pigeon:', '91.gif', 91),
(236, ':x1:', '92.gif', 92),
(237, ':x2:', '93.gif', 93),
(238, ':x3:', '94.gif', 94),
(239, ':x4:', '95.gif', 95),
(240, ':noelak:', '96.gif', 96),
(241, ':autiste:', '97.gif', 97),
(242, ':bave3:', '98.gif', 98),
(243, ':coeur2:', '99.gif', 99),
(244, ':awesome:', 'awesome.png', 234),
(245, ':badass:', 'badass.png', 235),
(246, ':banana:', 'banana.gif', 236),
(247, ':blit:', 'blit.png', 237),
(248, ':cool2:', 'cool2.gif', 233),
(249, ':hapcoeur:', 'hapcoeur.gif', 232),
(251, 'loveyou:', 'loveyou.gif', 230),
(253, ':trolol:', 'trolol.gif', 231),
(254, ':pacd:', '10.gif', 10),
(255, ':cafe:', '101.gif', 101),
(256, ':hapboire:', '130.gif', 130),
(257, ':8O:', '140.gif', 140),
(258, ':ouch:', '22.gif', 22),
(263, ':nodark:', '141.gif', 141),
(266, ':hapdiable:', 'hapdiable.gif', 238),
(267, ':redeyes:', 'redeyes.gif', 239),
(275, ':cd:', '5.gif', 5),
(278, ':globe:', '6.gif', 6),
(284, ':question:', '2.gif', 2),
(288, ':)', '1.gif', 1);

DROP TABLE IF EXISTS `forum_subscriptions`;
CREATE TABLE IF NOT EXISTS `forum_subscriptions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_userid` int(11) NOT NULL,
  `sub_topicid` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_topics`;
CREATE TABLE IF NOT EXISTS `forum_topics` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_forumid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_postid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_username` varchar(30) NOT NULL DEFAULT '',
  `topic_name` varchar(100) NOT NULL,
  `topic_slug` varchar(1000) NOT NULL,
  `topic_first` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `topic_last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `topic_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_posts_visible` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_lock` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `topic_sticky` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `topic_sticky_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `topic_rank` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `topic_invisible` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_users`;
CREATE TABLE IF NOT EXISTS `forum_users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_ip` varchar(40) NOT NULL DEFAULT '',
  `user_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_last` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_rank` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `user_posts` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_avatar` varchar(250) NOT NULL,
  `user_avatarid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_sex` char(1) NOT NULL DEFAULT '',
  `user_birthday` char(10) NOT NULL DEFAULT '',
  `user_sign` text NOT NULL,
  `user_desc` text NOT NULL,
  `user_country` varchar(50) NOT NULL DEFAULT '',
  `user_style` varchar(50) NOT NULL DEFAULT '',
  `user_lang` char(2) NOT NULL DEFAULT '',
  `user_timezone` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

INSERT INTO `forum_users` (`user_name`, `user_password`, `user_email`, `user_ip`, `user_time`, `user_last`, `user_rank`, `user_posts`, `user_avatar`, `user_avatarid`, `user_sex`, `user_birthday`, `user_sign`, `user_desc`, `user_country`, `user_style`, `user_lang`, `user_timezone`) VALUES
('Admin', 'admin', 'webmaster@domain.com', '::1', 111111111, 1690299193, 5, 10249, '', 0, '', '', '', '', 'France', 'base', 'fr', 'Europe/Paris'),
('anonymous', '', '', '', 0, 1578861085, 1, 0, '', 0, '', '', '', '', '', '', '', ''),
('robot', '', '', '', 0, 0, 1, 0, '', 0, '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
