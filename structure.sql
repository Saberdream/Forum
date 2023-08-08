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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_alerts_reasons`;
CREATE TABLE IF NOT EXISTS `forum_alerts_reasons` (
  `reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_name` varchar(1000) NOT NULL,
  `reason_desc` text NOT NULL,
  `reason_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_categories`;
CREATE TABLE IF NOT EXISTS `forum_categories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
('cookies_expiration_time', '366', 'd', '', 1, 14),
('cookies_name', 'forum_key', 's', 'input', 1, 18),
('default_lang', 'fr', 's', 'select', 1, 2),
('default_style', 'base', 's', 'select', 1, 5),
('default_timezone', 'UTC', 's', 'select', 1, 3),
('desc_max_size', '15002', 'd', '', 2, 4),
('domain_name', 'forum.prog', 's', 'input', 6, 1),
('form_expiration_time', '900', 'd', '', 1, 8),
('load_limit', '0', 'd', '', 6, 4),
('max_autologin_time', '259202', 'd', '', 1, 10),
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
('post_flood_time', '10', 'd', '', 3, 4),
('post_max_size', '16000', 'd', '', 3, 8),
('post_max_smilies', '50', 'd', '', 3, 10),
('post_redirection_time', '5', 'd', '', 3, 11),
('sendmail_from', 'webmaster@domain.com', 's', '', 6, 7),
('server_protocol', 'http://', 's', 'input', 6, 2),
('sessions_per_ip', '14', 'd', '', 1, 11),
('session_expiration_time', '3601', 'd', '', 1, 9),
('session_gc_probability', '1', 'd', '', 1, 17),
('sign_max_size', '5000', 'd', '', 2, 6),
('site_closed_reason', 'Maintenance', 's', 'textarea', 1, 7),
('site_description', '', 's', '', 1, 19),
('site_mail', 'webmaster@domain.com', 's', 'input', 1, 4),
('site_name', 'Forom', 's', 'input', 1, 1),
('site_open', '1', 'b', '', 1, 6),
('smtp_port', '25', 'd', '', 6, 6),
('smtp_server', 'smtp.domain.com', 's', '', 6, 5),
('table_prefix', 'forum_', 's', 'input', 6, 3),
('topics_per_page', '25', 'd', '', 3, 1),
('topic_flood_time', '11', 'd', '', 3, 3),
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
(7, 'pm_configuration', 7),
(8, 'articles_configuration', 8);

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
  `forum_auth_edit` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `forum_auth_alert` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `forum_auth_lock_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_stick_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_delete_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_delete_post` tinyint(1) UNSIGNED NOT NULL DEFAULT '3',
  `forum_auth_restore_topic` tinyint(1) UNSIGNED NOT NULL DEFAULT '4',
  `forum_auth_restore_post` tinyint(1) UNSIGNED NOT NULL DEFAULT '4',
  `forum_auth_ban` tinyint(1) UNSIGNED NOT NULL DEFAULT '4',
  `forum_moderators` varchar(1000) NOT NULL DEFAULT '',
  `forum_closed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_options`;
CREATE TABLE IF NOT EXISTS `forum_options` (
  `opt_id` int(11) NOT NULL AUTO_INCREMENT,
  `opt_userid` int(11) NOT NULL DEFAULT '0',
  `opt_name` varchar(100) NOT NULL DEFAULT '',
  `opt_value` text NOT NULL,
  PRIMARY KEY (`opt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pm_blacklist`;
CREATE TABLE IF NOT EXISTS `forum_pm_blacklist` (
  `bl_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bl_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bl_blacklisted_userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bl_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`bl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `forum_pm_participants`;
CREATE TABLE IF NOT EXISTS `forum_pm_participants` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_userid` int(11) DEFAULT '0',
  `participant_pmid` int(11) NOT NULL DEFAULT '0',
  `participant_last` int(11) NOT NULL DEFAULT '0',
  `participant_read` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `forum_smilies` (`smiley_code`, `smiley_filename`, `smiley_order`) VALUES
(':)', '1.gif', 1),
(':question:', '2.gif', 2),
(':g)', '3.gif', 3),
(':d))', '4.gif', 4),
(':cd:', '5.gif', 5),
(':globe:', '6.gif', 6),
(':p)', '7.gif', 7),
(':malade:', '8.gif', 8),
(':pacg:', '9.gif', 9),
(':pacd:', '10.gif', 10),
(':noel:', '11.gif', 11),
(':o))', '12.gif', 12),
(':snif2:', '13.gif', 13),
(':-(', '14.gif', 14),
(':angry:', '15.gif', 15),
(':mac:', '16.gif', 16),
(':gba:', '17.gif', 17),
(':hap:', '18.gif', 18),
(':nah:', '19.gif', 19),
(':snif2:', '20.gif', 20),
(':mort:', '21.gif', 21),
(':ouch:', '22.gif', 22),
(':-)))', '23.gif', 23),
(':content:', '24.gif', 24),
(':honte:', '25.gif', 25),
(':cool:', '26.gif', 26),
(':sleep:', '27.gif', 27),
(':doute:', '28.gif', 28),
(':hello:', '29.gif', 29),
(':honte:', '30.gif', 30),
(':-p', '31.gif', 31),
(':lol:', '32.gif', 32),
(':non:', '33.gif', 33),
(':monoeil:', '34.gif', 34),
(':non2:', '35.gif', 35),
(':ok:', '36.gif', 36),
(':oui:', '37.gif', 37),
(':rechercher:', '38.gif', 38),
(':rire:', '39.gif', 39),
(':-D', '40.gif', 40),
(':rire2:', '41.gif', 41),
(':salut:', '42.gif', 42),
(':sarcastic:', '43.gif', 43),
(':up:', '44.gif', 44),
(':(', '45.gif', 45),
(':-)', '46.gif', 46),
(':peur:', '47.gif', 47),
(':bye:', '48.gif', 48),
(':dpdr:', '49.gif', 49),
(':fou:', '50.gif', 50),
(':gne:', '51.gif', 51),
(':dehors:', '52.gif', 52),
(':fier:', '53.gif', 53),
(':coeur:', '54.gif', 54),
(':-D', '55.gif', 55),
(':sors:', '56.gif', 56),
(':ouch2:', '57.gif', 57),
(':merci:', '58.gif', 58),
(':svp:', '59.gif', 59),
(':ange:', '60.gif', 60),
(':diable:', '61.gif', 61),
(':gni:', '62.gif', 62),
(':spoiler:', '63.gif', 63),
(':hs:', '64.gif', 64),
(':desole:', '65.gif', 65),
(':fete:', '66.gif', 66),
(':sournois:', '67.gif', 67),
(':hum:', '68.gif', 68),
(':bravo:', '69.gif', 69),
(':banzai:', '70.gif', 70),
(':bave:', '71.gif', 71),
(':fish:', '72.gif', 72),
(':noelok:', '73.gif', 73),
(':noelok2:', '74.gif', 74),
(':bide:', '75.gif', 75),
(':nobounce:', '76.gif', 76),
(':wesh:', '77.gif', 77),
(':fake:', '78.gif', 78),
(':owned:', '79.gif', 79),
(':-D', '80.gif', 80),
(':osef:', '81.gif', 81),
(':ahok:', '82.gif', 82),
(':ahok2:', '83.gif', 83),
(':jerry:', '84.gif', 84),
(':approved:', '85.gif', 85),
(':chuck2:', '86.gif', 86),
(':troll:', '87.gif', 87),
(':trolling:', '88.gif', 88),
(':fu4:', '89.gif', 89),
(':mario:', '90.gif', 90),
(':pigeon:', '91.gif', 91),
(':x1:', '92.gif', 92),
(':x2:', '93.gif', 93),
(':x3:', '94.gif', 94),
(':x4:', '95.gif', 95),
(':noelak:', '96.gif', 96),
(':autiste:', '97.gif', 97),
(':bave3:', '98.gif', 98),
(':coeur2:', '99.gif', 99),
(':coolgun:', '100.gif', 100),
(':cafe:', '101.gif', 101),
(':play:', '102.gif', 102),
(':noelange:', '103.gif', 103),
(':hapange:', '104.gif', 104),
(':hap:', '105.gif', 105),
(':hapmagie:', '106.gif', 106),
(':haprire:', '107.gif', 107),
(':hapok:', '108.gif', 108),
(':hapok2:', '109.gif', 109),
(':hapravo:', '110.gif', 110),
(':hapleure:', '111.gif', 111),
(':weshap:', '112.gif', 112),
(':jap:', '113.gif', 113),
(':juif:', '114.gif', 114),
(':noelgun:', '115.gif', 115),
(':noelfuck:', '116.gif', 116),
(':nowesh:', '117.gif', 117),
(':nowel:', '118.gif', 118),
(':hawp:', '119.gif', 119),
(':wiwe:', '120.gif', 120),
(':nocoeur:', '121.gif', 121),
(':noelbbr:', '122.gif', 122),
(':supergni:', '123.gif', 123),
(':dead:', '124.gif', 124),
(':morsay:', '125.gif', 125),
(':bave2:', '126.gif', 126),
(':fu:', '127.gif', 127),
(':lazor:', '128.gif', 128),
(':hapananas:', '129.gif', 129),
(':hapboire:', '130.gif', 130),
(':panachay:', '131.gif', 131),
(':nowelak:', '132.gif', 132),
(':hapak:', '133.gif', 133),
(':+1:', '134.gif', 134),
(':nowelok:', '135.gif', 135),
(':nowelok2:', '136.gif', 136),
(':ouwch:', '137.gif', 137),
(':peuw:', '138.gif', 138),
(':monosouwcil:', '139.gif', 139),
(':8O:', '140.gif', 140),
(':nodark:', '141.gif', 141),
(':fuautiste:', '142.gif', 142),
(':fu2:', '143.gif', 143),
(':why:', '144.gif', 144),
(':ahh:', '145.gif', 145),
(':fuhappy:', '146.gif', 146),
(':palm:', '147.gif', 147),
(':cereal:', '148.gif', 148),
(':scared:', '149.gif', 149),
(':scared2:', '150.gif', 150),
(':popcorn:', '151.gif', 151),
(':pf:', '152.gif', 152),
(':stp:', '153.gif', 153),
(':play:', '154.gif', 154),
(':hapoelparty:', '155.gif', 155),
(':pokhap:', '156.gif', 156),
(':btv:', '157.gif', 157),
(':zik:', '158.gif', 158),
(':mmh:', '159.gif', 159),
(':geek:', '160.gif', 160),
(':kiss:', '161.gif', 161),
(':dark:', '162.gif', 162),
(':x5:', '163.gif', 163),
(':alone:', '164.gif', 164),
(':nowelgun:', '165.gif', 165),
(':damned:', '166.gif', 166),
(':haha:', '167.gif', 167),
(':hah:', '168.gif', 168),
(':xo:', '169.gif', 169),
(':hehe:', '170.gif', 170),
(':haplaudit:', '171.gif', 171),
(':wi:', '172.gif', 172),
(':wiok:', '173.gif', 173),
(':wicoeur:', '174.gif', 174),
(':god:', '175.gif', 175),
(':bescherelle:', '176.gif', 176),
(':wtf:', '177.gif', 177),
(':fff:', '178.gif', 178),
(':fuhitler:', '179.gif', 179),
(':trollw:', '180.gif', 180),
(':challenge:', '181.gif', 181),
(':hahlone:', '182.gif', 182),
(':gusta:', '183.gif', 183),
(':chuck:', '184.gif', 184),
(':bourre:', '185.gif', 185),
(':yea:', '186.gif', 186),
(':link:', '187.gif', 187),
(':miyamoto:', '188.gif', 188),
(':beauf:', '189.gif', 189),
(':wsh:', '190.gif', 190),
(':lamasticot:', '191.gif', 191),
(':psycho:', '192.gif', 192),
(':rage:', '193.gif', 193),
(':toh:', '194.gif', 194),
(':pervers:', '195.gif', 195),
(':cat:', '196.gif', 196),
(':music:', '197.gif', 197),
(':nerd:', '198.gif', 198),
(':pfete:', '199.gif', 199),
(':awyeah:', '200.gif', 200),
(':nolife:', '201.gif', 201),
(':nodiable:', '202.gif', 202),
(':nolol:', '203.gif', 203),
(':ntroll:', '204.gif', 204),
(':siffle:', '205.gif', 205),
(':accepted:', '206.gif', 206),
(':denied:', '207.gif', 207),
(':kidding:', '208.gif', 208),
(':yuno:', '209.gif', 209),
(':fap:', '210.gif', 210),
(':facepalm:', '211.gif', 211),
(':ordi:', '212.gif', 212),
(':hapoel:', '213.gif', 213),
(':okay:', '214.gif', 214),
(':fu3:', '215.gif', 215),
(':cute:', '216.gif', 216),
(':feel:', '217.gif', 217),
(':feelbro:', '218.gif', 218),
(':feelcry:', '219.gif', 219),
(':notbad:', '220.gif', 220),
(':pff:', '221.gif', 221),
(':noo:', '222.gif', 222),
(':wait:', '223.gif', 223),
(':ponche:', '224.gif', 224),
(':poker:', '225.gif', 225),
(':sfp:', '226.gif', 226),
(':obvious:', '227.gif', 227),
(':fap2:', '228.gif', 228),
(':lock:', '229.gif', 229),
('loveyou:', 'loveyou.gif', 230),
(':trolol:', 'trolol.gif', 231),
(':hapcoeur:', 'hapcoeur.gif', 232),
(':cool2:', 'cool2.gif', 233),
(':awesome:', 'awesome.png', 234),
(':badass:', 'badass.png', 235),
(':banana:', 'banana.gif', 236),
(':blit:', 'blit.png', 237),
(':hapdiable:', 'hapdiable.gif', 238),
(':redeyes:', 'redeyes.gif', 239);

DROP TABLE IF EXISTS `forum_subscriptions`;
CREATE TABLE IF NOT EXISTS `forum_subscriptions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_userid` int(11) NOT NULL,
  `sub_topicid` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `forum_users` (`user_name`, `user_password`, `user_email`, `user_ip`, `user_time`, `user_last`, `user_rank`, `user_posts`, `user_avatar`, `user_avatarid`, `user_sex`, `user_birthday`, `user_sign`, `user_desc`, `user_country`, `user_style`, `user_lang`, `user_timezone`) VALUES
('Admin', 'admin', 'webmaster@domain.com', '::1', 111111111, 1690299193, 5, 10249, '', 0, '', '', '', '', 'France', 'base', 'fr', 'Europe/Paris'),
('anonymous', '', '', '', 0, 1578861085, 1, 0, '', 0, '', '', '', '', '', '', '', ''),
('robot', '', '', '', 0, 0, 1, 0, '', 0, '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
