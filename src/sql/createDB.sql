# Usage: 

# 1) Create a database using the "CREATE DATABASE" mysql command.

# 2) Then, execute this script from command prompt with a command like this:

# mysql -h host -u user -p -D db_name < mysql.sql



# create database timetracker character set = 'utf8';



# use timetracker;


-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 10:08 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `a_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `a_manager_id` int(11) NOT NULL DEFAULT '0',
  `a_status` smallint(6) NOT NULL DEFAULT '1',
  `a_project_id` int(11) NOT NULL DEFAULT '0',
  `a_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_id`),
  KEY `a_manager_idx` (`a_manager_id`,`a_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_bind`
--

CREATE TABLE IF NOT EXISTS `activity_bind` (
  `ab_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ab_id_a` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ab_id_p` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`ab_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_status_list`
--

CREATE TABLE IF NOT EXISTS `activity_status_list` (
  `asl_id` smallint(6) NOT NULL DEFAULT '0',
  `asl_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `asl_name` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`asl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `att_log`
--

CREATE TABLE IF NOT EXISTS `att_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `att_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `in_out` tinyint(1) UNSIGNED DEFAULT '0',
  `archived` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Working location';

-- --------------------------------------------------------

--
-- Table structure for table `tt_clients`
--

CREATE TABLE IF NOT EXISTS `tt_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tax` float(6,2) DEFAULT '0.00',
  `projects` text,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_name_idx` (`team_id`,`name`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_client_project_binds`
--

CREATE TABLE IF NOT EXISTS `tt_client_project_binds` (
  `client_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  KEY `client_idx` (`client_id`),
  KEY `project_idx` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_config`
--

CREATE TABLE IF NOT EXISTS `tt_config` (
  `user_id` int(11) NOT NULL,
  `param_name` varchar(32) NOT NULL,
  `param_value` varchar(80) DEFAULT NULL,
  UNIQUE KEY `param_idx` (`user_id`,`param_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_cron`
--

CREATE TABLE IF NOT EXISTS `tt_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `cron_spec` varchar(255) NOT NULL,
  `last` int(11) DEFAULT NULL,
  `next` int(11) DEFAULT NULL,
  `report_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_custom_fields`
--

CREATE TABLE IF NOT EXISTS `tt_custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `label` varchar(32) NOT NULL DEFAULT '',
  `required` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_custom_field_log`
--

CREATE TABLE IF NOT EXISTS `tt_custom_field_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_id` bigint(20) NOT NULL,
  `field_id` int(11) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_custom_field_options`
--

CREATE TABLE IF NOT EXISTS `tt_custom_field_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_expense_items`
--

CREATE TABLE IF NOT EXISTS `tt_expense_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `cost` decimal(10,2) DEFAULT '0.00',
  `invoice_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `date_idx` (`date`),
  KEY `user_idx` (`user_id`),
  KEY `client_idx` (`client_id`),
  KEY `project_idx` (`project_id`),
  KEY `invoice_idx` (`invoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_fav_reports`
--

CREATE TABLE IF NOT EXISTS `tt_fav_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `cf_1_option_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `billable` tinyint(4) DEFAULT NULL,
  `invoice` tinyint(4) DEFAULT NULL,
  `users` text,
  `period` tinyint(4) DEFAULT NULL,
  `period_start` date DEFAULT NULL,
  `period_end` date DEFAULT NULL,
  `show_client` tinyint(4) NOT NULL DEFAULT '0',
  `show_invoice` tinyint(4) NOT NULL DEFAULT '0',
  `show_project` tinyint(4) NOT NULL DEFAULT '0',
  `show_start` tinyint(4) NOT NULL DEFAULT '0',
  `show_duration` tinyint(4) NOT NULL DEFAULT '0',
  `show_cost` tinyint(4) NOT NULL DEFAULT '0',
  `show_task` tinyint(4) NOT NULL DEFAULT '0',
  `show_end` tinyint(4) NOT NULL DEFAULT '0',
  `show_note` tinyint(4) NOT NULL DEFAULT '0',
  `show_custom_field_1` tinyint(4) NOT NULL DEFAULT '0',
  `show_totals_only` tinyint(4) NOT NULL DEFAULT '0',
  `group_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_general`
--

CREATE TABLE IF NOT EXISTS `tt_general` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `last_att_sync` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_invoices`
--

CREATE TABLE IF NOT EXISTS `tt_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`team_id`,`name`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_log`
--

CREATE TABLE IF NOT EXISTS `tt_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start` time DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `comment` blob,
  `billable` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `al_activity_id` int(11) DEFAULT NULL,
  `al_location_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) UNSIGNED DEFAULT '0',
  `start_dirty` tinyint(1) DEFAULT NULL,
  `duration_dirty` tinyint(1) DEFAULT NULL,
  `comment_attendance` blob,
  PRIMARY KEY (`id`),
  KEY `date_idx` (`date`),
  KEY `user_idx` (`user_id`),
  KEY `client_idx` (`client_id`),
  KEY `invoice_idx` (`invoice_id`),
  KEY `project_idx` (`project_id`),
  KEY `task_idx` (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_projects`
--

CREATE TABLE IF NOT EXISTS `tt_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tasks` text,
  `status` smallint(6) DEFAULT '1',
  `p_manager_id` int(11) DEFAULT NULL,
  `p_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_idx` (`team_id`,`name`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_project_task_binds`
--

CREATE TABLE IF NOT EXISTS `tt_project_task_binds` (
  `project_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  KEY `project_idx` (`project_id`),
  KEY `task_idx` (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_tasks`
--

CREATE TABLE IF NOT EXISTS `tt_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_idx` (`team_id`,`name`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_teams`
--

CREATE TABLE IF NOT EXISTS `tt_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(80) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `currency` varchar(7) DEFAULT NULL,
  `decimal_mark` char(1) NOT NULL DEFAULT '.',
  `locktime` int(4) DEFAULT '0',
  `lang` varchar(10) NOT NULL DEFAULT 'en',
  `date_format` varchar(20) NOT NULL DEFAULT '%Y-%m-%d',
  `time_format` varchar(20) NOT NULL DEFAULT '%H:%M',
  `week_start` smallint(2) NOT NULL DEFAULT '0',
  `tracking_mode` smallint(2) NOT NULL DEFAULT '1',
  `record_type` smallint(2) NOT NULL DEFAULT '0',
  `plugins` varchar(255) DEFAULT NULL,
  `custom_logo` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_tmp_refs`
--

CREATE TABLE IF NOT EXISTS `tt_tmp_refs` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ref` char(32) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_users`
--

CREATE TABLE IF NOT EXISTS `tt_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT '4',
  `client_id` int(11) DEFAULT NULL,
  `att_id` int(10) UNSIGNED DEFAULT NULL,
  `rate` float(6,2) NOT NULL DEFAULT '0.00',
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_idx` (`login`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tt_user_project_binds`
--

CREATE TABLE IF NOT EXISTS `tt_user_project_binds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `rate` float(6,2) DEFAULT '0.00',
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bind_idx` (`user_id`,`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
