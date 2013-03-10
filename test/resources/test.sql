-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Vert: 127.0.0.1
-- Generert den: 10. Mar, 2013 17:48 PM
-- Tjenerversjon: 5.5.27
-- PHP-Versjon: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Prosedyrer
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_series`
--

CREATE TABLE IF NOT EXISTS `wp_series` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `rankingleague_id` mediumint(9) NOT NULL,
  `details` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dataark for tabell `wp_series`
--

INSERT INTO `wp_series` (`id`, `name`, `rankingleague_id`, `details`) VALUES
(1, 'OSVB A (Herrer)', 2, NULL),
(2, 'OSVB B (Herrer)', 2, NULL),
(3, 'Nybegynner', 4, NULL),
(4, 'Mix', 1, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_teams`
--

CREATE TABLE IF NOT EXISTS `wp_teams` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dataark for tabell `wp_teams`
--

INSERT INTO `wp_teams` (`id`, `name`) VALUES
(1, 2),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 2),
(9, 2),
(10, 4),
(11, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_terms`
--

CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dataark for tabell `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'Blogroll', 'blogroll', 0),
(3, 'Tournament', 'tournament', 0),
(4, 'Main Menu', 'main-menu', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(1, 2, 0),
(2, 2, 0),
(3, 2, 0),
(4, 2, 0),
(5, 2, 0),
(6, 2, 0),
(7, 2, 0),
(12, 3, 0),
(15, 3, 0),
(16, 3, 0),
(17, 3, 0),
(18, 3, 0),
(19, 3, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dataark for tabell `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'link_category', '', 0, 7),
(3, 3, 'nav_menu', '', 0, 6),
(4, 4, 'nav_menu', '', 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_tournaments`
--

CREATE TABLE IF NOT EXISTS `wp_tournaments` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `serie_id` mediumint(9) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `location` tinytext NOT NULL,
  `details` text,
  `final_seeding` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dataark for tabell `wp_tournaments`
--

INSERT INTO `wp_tournaments` (`id`, `name`, `serie_id`, `date`, `location`, `details`, `final_seeding`) VALUES
(1, 'OSVB A #1', 1, '2012-03-13 00:00:00', 'Voldsløkka', 'Gratis øl', NULL),
(2, 'OSVB A #2', 1, '2013-03-13 09:00:00', 'Voldsløkka', 'Gratis Øl', NULL),
(3, 'Fiji Open #1', 3, '2013-03-13 09:00:00', 'Fiji', 'Labert oppmøte', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dataark for tabell `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', ''),
(2, 1, 'last_name', ''),
(3, 1, 'nickname', 'admin'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}'),
(11, 1, 'wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp330_toolbar,wp330_media_uploader,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media'),
(13, 1, 'show_welcome_panel', '1'),
(14, 1, 'wp_user-settings', 'm6=o&m7=o&editor=html'),
(15, 1, 'wp_user-settings-time', '1354477113'),
(16, 1, 'wp_dashboard_quick_press_last_post_id', '20'),
(17, 2, 'first_name', 'Sindre'),
(18, 2, 'last_name', 'Svendby'),
(19, 2, 'nickname', 'Sindre Svendby'),
(20, 2, 'description', ''),
(21, 2, 'rich_editing', 'true'),
(22, 2, 'comment_shortcuts', 'false'),
(23, 2, 'admin_color', 'fresh'),
(24, 2, 'use_ssl', '0'),
(25, 2, 'show_admin_bar_front', 'true'),
(26, 2, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(27, 2, 'wp_user_level', '0'),
(28, 2, 'dismissed_wp_pointers', 'wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media'),
(29, 3, 'first_name', 'Sindre Øye'),
(30, 3, 'last_name', 'Svendby'),
(31, 3, 'nickname', 'sindre.svendby@eniro.no'),
(32, 3, 'description', ''),
(33, 3, 'rich_editing', 'true'),
(34, 3, 'comment_shortcuts', 'false'),
(35, 3, 'admin_color', 'fresh'),
(36, 3, 'use_ssl', '0'),
(37, 3, 'show_admin_bar_front', 'true'),
(38, 3, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(39, 3, 'wp_user_level', '0'),
(40, 3, 'dismissed_wp_pointers', 'wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media'),
(41, 4, 'first_name', 'Test'),
(42, 4, 'last_name', 'User'),
(43, 4, 'nickname', 'sindreoye.svendby@eniro.com'),
(44, 4, 'description', ''),
(45, 4, 'rich_editing', 'true'),
(46, 4, 'comment_shortcuts', 'false'),
(47, 4, 'admin_color', 'fresh'),
(48, 4, 'use_ssl', '0'),
(49, 4, 'show_admin_bar_front', 'true'),
(50, 4, 'wp_capabilities', 'a:1:{s:10:"subscriber";b:1;}'),
(51, 4, 'wp_user_level', '0'),
(52, 4, 'dismissed_wp_pointers', 'wp330_toolbar,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media'),
(53, 1, 'managenav-menuscolumnshidden', 'a:4:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";}'),
(54, 1, 'metaboxhidden_nav-menus', 'a:3:{i:0;s:8:"add-post";i:1;s:12:"add-post_tag";i:2;s:15:"add-post_format";}'),
(55, 1, 'nav_menu_recently_edited', '3');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dataark for tabell `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '', 'admin', 'sinsvend@gmail.com', '', '2012-12-02 19:22:23', '', 0, 'admin'),
(2, 'Sindre Svendby', '', 'sindre-svendby', 'sinsvend@online.no', '', '2013-01-10 18:16:58', '', 0, 'Sindre Svendby'),
(3, 'sindre.svendby@eniro.no', '', 'sindre-svendbyeniro-no', 'sindre.svendby@eniro.no', '', '2013-01-26 13:25:59', '', 0, 'Sindre Øye Svendby'),
(4, 'sindreoye.svendby@eniro.com', '', 'sindreoye-svendbyeniro-com', 'sindreoye.svendby@eniro.com', '', '2013-01-26 13:27:41', '', 0, 'Test User');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `wp_venues`
--

CREATE TABLE IF NOT EXISTS `wp_venues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(5) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dataark for tabell `wp_venues`
--

INSERT INTO `wp_venues` (`id`, `name`, `url`, `description`, `address1`, `address2`, `city`, `state`, `zip`) VALUES
(1, 'Sind', 'ss', 'Some text', 'ss', 'ss', 'Oslo', 'Oslo', '1254');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
