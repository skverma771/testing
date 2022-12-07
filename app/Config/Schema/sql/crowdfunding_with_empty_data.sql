-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2013 at 01:10 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `crowdfunding`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_links`
--

DROP TABLE IF EXISTS `acl_links`;
CREATE TABLE IF NOT EXISTS `acl_links` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `controller` varchar(255) collate utf8_unicode_ci NOT NULL,
  `action` varchar(255) collate utf8_unicode_ci NOT NULL,
  `named_key` varchar(255) collate utf8_unicode_ci NOT NULL,
  `named_value` varchar(255) collate utf8_unicode_ci NOT NULL,
  `pass_value` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `acl_links_roles`
--

DROP TABLE IF EXISTS `acl_links_roles`;
CREATE TABLE IF NOT EXISTS `acl_links_roles` (
  `id` bigint(20) NOT NULL auto_increment,
  `role_id` bigint(20) NOT NULL,
  `acl_link_id` bigint(20) NOT NULL,
  `acl_link_status_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `acl_link_id` (`acl_link_id`),
  KEY `acl_link_status_id` (`acl_link_status_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_links_roles`
--


-- --------------------------------------------------------

--
-- Table structure for table `acl_link_statuses`
--

DROP TABLE IF EXISTS `acl_link_statuses`;
CREATE TABLE IF NOT EXISTS `acl_link_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_link_statuses`
--

INSERT INTO `acl_link_statuses` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'None'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Owner'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Group'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'All');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

DROP TABLE IF EXISTS `affiliates`;
CREATE TABLE IF NOT EXISTS `affiliates` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `class` varchar(255) collate utf8_unicode_ci NOT NULL,
  `foreign_id` bigint(20) unsigned NOT NULL,
  `affiliate_type_id` bigint(20) unsigned NOT NULL,
  `affliate_user_id` bigint(20) NOT NULL,
  `affiliate_status_id` bigint(20) NOT NULL,
  `commission_amount` double(10,2) NOT NULL,
  `commission_holding_start_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `class` (`class`),
  KEY `foreign_id` (`foreign_id`),
  KEY `affiliate_type_id` (`affiliate_type_id`),
  KEY `affliate_user_id` (`affliate_user_id`),
  KEY `affiliate_status_id` (`affiliate_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='affiliate detailes';

--
-- Dumping data for table `affiliates`
--


-- --------------------------------------------------------

--
-- Table structure for table `affiliate_cash_withdrawals`
--

DROP TABLE IF EXISTS `affiliate_cash_withdrawals`;
CREATE TABLE IF NOT EXISTS `affiliate_cash_withdrawals` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `affiliate_cash_withdrawal_status_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `commission_amount` double(10,2) default '0.00',
  `payment_gateway_id` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `affiliate_cash_withdrawal_status_id` (`affiliate_cash_withdrawal_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `affiliate_cash_withdrawals`
--


-- --------------------------------------------------------

--
-- Table structure for table `affiliate_cash_withdrawal_statuses`
--

DROP TABLE IF EXISTS `affiliate_cash_withdrawal_statuses`;
CREATE TABLE IF NOT EXISTS `affiliate_cash_withdrawal_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `affiliate_cash_withdrawal_statuses`
--

INSERT INTO `affiliate_cash_withdrawal_statuses` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '2011-02-15 05:23:16', 'Pending'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Accepted'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rejected'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_commission_types`
--

DROP TABLE IF EXISTS `affiliate_commission_types`;
CREATE TABLE IF NOT EXISTS `affiliate_commission_types` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `affiliate_commission_types`
--

INSERT INTO `affiliate_commission_types` (`id`, `name`, `description`) VALUES
(1, '%', 'Percentage'),
(2, '$', 'Amount');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_requests`
--

DROP TABLE IF EXISTS `affiliate_requests`;
CREATE TABLE IF NOT EXISTS `affiliate_requests` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `site_name` varchar(255) collate utf8_unicode_ci default NULL,
  `site_description` text collate utf8_unicode_ci,
  `site_url` varchar(255) collate utf8_unicode_ci default NULL,
  `site_category_id` bigint(20) default NULL,
  `why_do_you_want_affiliate` text collate utf8_unicode_ci,
  `is_web_site_marketing` tinyint(1) default '0',
  `is_search_engine_marketing` tinyint(1) default '0',
  `is_email_marketing` tinyint(1) default '0',
  `special_promotional_method` varchar(255) collate utf8_unicode_ci default NULL,
  `special_promotional_description` text collate utf8_unicode_ci,
  `is_approved` smallint(4) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `site_category_id` (`site_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `affiliate_requests`
--


-- --------------------------------------------------------

--
-- Table structure for table `affiliate_statuses`
--

DROP TABLE IF EXISTS `affiliate_statuses`;
CREATE TABLE IF NOT EXISTS `affiliate_statuses` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='affliate status details';

--
-- Dumping data for table `affiliate_statuses`
--

INSERT INTO `affiliate_statuses` (`id`, `created`, `modified`, `name`) VALUES
(1, '2011-02-08', '2011-02-08', 'Pending'),
(2, '2011-02-08', '2011-02-08', 'Canceled '),
(3, '2011-02-08', '2011-02-08', 'Pipeline'),
(4, '0000-00-00', '0000-00-00', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_types`
--

DROP TABLE IF EXISTS `affiliate_types`;
CREATE TABLE IF NOT EXISTS `affiliate_types` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `model_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `commission` double(10,2) default '0.00',
  `affiliate_commission_type_id` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `plugin_name` varchar(220) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `affiliate_commission_type_id` (`affiliate_commission_type_id`),
  KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='affiliate types';

--
-- Dumping data for table `affiliate_types`
--

INSERT INTO `affiliate_types` (`id`, `created`, `modified`, `name`, `model_name`, `commission`, `affiliate_commission_type_id`, `is_active`, `plugin_name`) VALUES
(1, '2011-02-08 00:00:00', '2012-05-12 02:52:10', 'Sign Up', 'User', 2.00, 2, 1, ''),
(2, '2011-02-08 00:00:00', '2012-05-12 02:52:10', 'Pledge', 'Pledge', 2.00, 1, 1, 'Pledge'),
(3, '2011-02-08 00:00:00', '2012-05-12 02:52:10', 'Project Listing', 'Project', 5.00, 1, 1, ''),
(4, '2011-02-08 00:00:00', '2012-05-12 02:52:10', 'Donate', 'Donate', 1.00, 1, 1, 'Donate'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lend', 'Lend', 0.00, 1, 1, 'Lend'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Equity', 'Equity', 0.00, 1, 1, 'Equity');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `class` varchar(100) collate utf8_unicode_ci default NULL,
  `foreign_id` bigint(20) unsigned NOT NULL,
  `filename` varchar(255) collate utf8_unicode_ci default NULL,
  `dir` varchar(100) collate utf8_unicode_ci default NULL,
  `mimetype` varchar(100) collate utf8_unicode_ci default NULL,
  `filesize` bigint(20) default NULL,
  `height` bigint(20) default NULL,
  `width` bigint(20) default NULL,
  `thumb` tinyint(1) NOT NULL default '0',
  `description` text collate utf8_unicode_ci,
  `amazon_s3_thumb_url` text collate utf8_unicode_ci NOT NULL,
  `amazon_s3_original_url` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`foreign_id`),
  KEY `class` (`class`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Attachment Details';

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `created`, `modified`, `class`, `foreign_id`, `filename`, `dir`, `mimetype`, `filesize`, `height`, `width`, `thumb`, `description`, `amazon_s3_thumb_url`, `amazon_s3_original_url`) VALUES
(1, '2009-05-11 20:15:24', '2009-05-11 20:15:24', 'UserAvatar', 0, 'default-avatar.png', 'UserAvatar/0', 'image/png', 1087, 50, 50, 0, '', '', ''),
(2, '2010-04-03 08:02:05', '2010-04-03 08:02:05', 'Project', 0, 'project-no-image-icon.png', 'Project/0', 'image/jpeg', NULL, NULL, NULL, 0, 'Project File', '', ''),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anonymous', 0, 'default-anonymous.png', 'Anonymous/0', 'image/png', 1087, 50, 50, 0, NULL, '', ''),
(127, '2013-05-02 18:49:02', '2013-05-02 18:49:11', 'Processing', 0, 'default-processing.png', 'Processing/0', 'image/png', 1087, 50, 50, 0, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `banned_ips`
--

DROP TABLE IF EXISTS `banned_ips`;
CREATE TABLE IF NOT EXISTS `banned_ips` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `address` varchar(255) collate utf8_unicode_ci default NULL,
  `range` varchar(255) collate utf8_unicode_ci default NULL,
  `referer_url` varchar(255) collate utf8_unicode_ci default NULL,
  `reason` varchar(255) collate utf8_unicode_ci default NULL,
  `redirect` varchar(255) collate utf8_unicode_ci default NULL,
  `thetime` int(15) NOT NULL,
  `timespan` int(15) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `address` (`address`),
  KEY `range` (`range`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned IPs Details';

--
-- Dumping data for table `banned_ips`
--


-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(20) NOT NULL auto_increment,
  `region_id` int(20) default NULL,
  `title` varchar(100) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(100) collate utf8_unicode_ci default NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `show_title` tinyint(1) NOT NULL default '1',
  `class` varchar(255) collate utf8_unicode_ci default NULL,
  `status` tinyint(1) NOT NULL default '0',
  `weight` int(11) default NULL,
  `element` varchar(255) collate utf8_unicode_ci default NULL,
  `visibility_roles` text collate utf8_unicode_ci,
  `visibility_paths` text collate utf8_unicode_ci,
  `visibility_php` text collate utf8_unicode_ci,
  `params` text collate utf8_unicode_ci,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  `plugin_name` varchar(220) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `region_id` (`region_id`),
  KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `region_id`, `title`, `alias`, `body`, `show_title`, `class`, `status`, `weight`, `element`, `visibility_roles`, `visibility_paths`, `visibility_php`, `params`, `modified`, `created`, `plugin_name`) VALUES
(1, 2, 'Pledge - Projects Stats', 'pledge_project_stats', 'admin stats page', 0, NULL, 1, 10, 'Pledge.chart_project_stats', NULL, NULL, NULL, NULL, '2012-08-13 17:35:55', '2012-08-13 17:35:58', 'Pledge'),
(2, 2, 'Donate - Projects Stats', 'donate_project_stats', 'admin stats page', 0, NULL, 1, 20, 'Donate.chart_project_stats', NULL, NULL, NULL, NULL, '2012-08-13 17:35:55', '2012-08-13 17:35:58', 'Donate'),
(3, 2, 'Lend - Projects Stats', 'lend_project_stats', 'admin stats page', 0, NULL, 1, 30, 'Lend.chart_project_stats', NULL, NULL, NULL, NULL, '2013-03-19 14:01:44', '2013-03-19 14:01:47', 'Lend'),
(4, 2, 'Equity - Projects Stats', 'equity_project_stats', 'admin stats page', 0, NULL, 1, 40, 'Equity.chart_project_stats', NULL, NULL, NULL, NULL, '2013-03-19 14:01:44', '2013-03-19 14:01:47', 'Equity');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `title` varchar(250) collate utf8_unicode_ci default NULL,
  `content` text collate utf8_unicode_ci,
  `slug` varchar(260) collate utf8_unicode_ci default NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `detected_suspicious_words` varchar(255) collate utf8_unicode_ci default NULL,
  `blog_comment_count` bigint(20) NOT NULL,
  `blog_view_count` bigint(20) NOT NULL,
  `blog_tag_count` bigint(20) unsigned NOT NULL default '0',
  `is_admin_suspended` tinyint(1) NOT NULL default '0',
  `is_published` tinyint(1) NOT NULL default '0',
  `is_system_flagged` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Blogs details';

--
-- Dumping data for table `blogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `blogs_blog_tags`
--

DROP TABLE IF EXISTS `blogs_blog_tags`;
CREATE TABLE IF NOT EXISTS `blogs_blog_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `blog_tag_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `blog_tag_id` (`blog_tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mapping of blogs and related tags';

--
-- Dumping data for table `blogs_blog_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `comment` text collate utf8_unicode_ci,
  `ip_id` bigint(20) default NULL,
  `is_admin_suspended` tinyint(1) NOT NULL default '0',
  `is_system_flagged` tinyint(1) NOT NULL default '0',
  `detected_suspicious_words` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `is_admin_suspended` (`is_admin_suspended`),
  KEY `is_system_flagged` (`is_system_flagged`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Blog comments details';

--
-- Dumping data for table `blog_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
CREATE TABLE IF NOT EXISTS `blog_tags` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci default NULL,
  `slug` varchar(110) collate utf8_unicode_ci default NULL,
  `blog_count` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Blog tags details';

--
-- Dumping data for table `blog_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `blog_views`
--

DROP TABLE IF EXISTS `blog_views`;
CREATE TABLE IF NOT EXISTS `blog_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `user_id` bigint(20) default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Blog views details';

--
-- Dumping data for table `blog_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `cake_sessions`
--

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `user_id` bigint(20) NOT NULL default '0',
  `data` text collate utf8_unicode_ci,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Session Details';

--
-- Dumping data for table `cake_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `state_id` bigint(20) unsigned NOT NULL,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `slug` varchar(45) collate utf8_unicode_ci default NULL,
  `latitude` float default NULL,
  `longitude` float default NULL,
  `timezone` varchar(10) collate utf8_unicode_ci default NULL,
  `dma_id` int(11) default NULL,
  `county` varchar(25) collate utf8_unicode_ci default NULL,
  `code` varchar(4) collate utf8_unicode_ci default NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  `project_count` bigint(20) NOT NULL,
  `language_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `country_id` (`country_id`),
  KEY `state_id` (`state_id`),
  KEY `is_approved` (`is_approved`),
  KEY `slug` (`slug`),
  KEY `dma_id` (`dma_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(20) NOT NULL auto_increment,
  `parent_id` int(20) default NULL,
  `node_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL default '0',
  `name` varchar(50) collate utf8_unicode_ci default NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `website` varchar(200) collate utf8_unicode_ci default NULL,
  `ip` varchar(100) collate utf8_unicode_ci default NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `rating` int(11) default NULL,
  `status` tinyint(1) NOT NULL default '0',
  `notify` tinyint(1) NOT NULL default '0',
  `type` varchar(100) collate utf8_unicode_ci NOT NULL,
  `comment_type` varchar(100) collate utf8_unicode_ci NOT NULL default 'comment',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `node_id` (`node_id`),
  KEY `user_id` (`user_id`),
  KEY `lft` (`lft`),
  KEY `rght` (`rght`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned default NULL,
  `first_name` varchar(100) collate utf8_unicode_ci default NULL,
  `last_name` varchar(100) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  `message` text collate utf8_unicode_ci,
  `telephone` varchar(20) collate utf8_unicode_ci default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL auto_increment,
  `iso_alpha2` char(2) default NULL,
  `iso_alpha3` char(3) default NULL,
  `iso_numeric` int(11) default NULL,
  `fips_code` varchar(3) default NULL,
  `name` varchar(200) default NULL,
  `capital` varchar(200) default NULL,
  `areainsqkm` double default NULL,
  `population` int(11) default NULL,
  `continent` char(2) default NULL,
  `tld` char(3) default NULL,
  `currency` char(3) default NULL,
  `currencyName` char(20) default NULL,
  `Phone` char(10) default NULL,
  `postalCodeFormat` char(20) default NULL,
  `postalCodeRegex` char(20) default NULL,
  `languages` varchar(200) default NULL,
  `geonameId` int(11) default NULL,
  `neighbours` char(20) default NULL,
  `equivalentFipsCode` char(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `fips_code`, `name`, `capital`, `areainsqkm`, `population`, `continent`, `tld`, `currency`, `currencyName`, `Phone`, `postalCodeFormat`, `postalCodeRegex`, `languages`, `geonameId`, `neighbours`, `equivalentFipsCode`) VALUES
(1, 'AF', 'AFG', 4, 'AF', 'Afghanistan', 'Kabul', 647500, 29121286, 'AS', '.af', 'AFN', 'Afghani', '93', '', '', 'fa-AF,ps,uz-AF,tk', 1149361, 'TM,CN,IR,TJ,PK,UZ', '\r'),
(2, 'AX', 'ALA', 248, '', 'Aland Islands', 'Mariehamn', 0, 26711, 'EU', '.ax', 'EUR', 'Euro', '+358-18', '', '', 'sv-AX', 661882, '', 'FI\r'),
(3, 'AL', 'ALB', 8, 'AL', 'Albania', 'Tirana', 28748, 2986952, 'EU', '.al', 'ALL', 'Lek', '355', '', '', 'sq,el', 783754, 'MK,GR,CS,ME,RS,XK', '\r'),
(4, 'DZ', 'DZA', 12, 'AG', 'Algeria', 'Algiers', 2381740, 34586184, 'AF', '.dz', 'DZD', 'Dinar', '213', '#####', '^(d{5})$', 'ar-DZ', 2589581, 'NE,EH,LY,MR,TN,MA,ML', '\r'),
(5, 'AS', 'ASM', 16, 'AQ', 'American Samoa', 'Pago Pago', 199, 57881, 'OC', '.as', 'USD', 'Dollar', '+1-684', '', '', 'en-AS,sm,to', 5880801, '', '\r'),
(6, 'AD', 'AND', 20, 'AN', 'Andorra', 'Andorra la Vella', 468, 84000, 'EU', '.ad', 'EUR', 'Euro', '376', 'AD###', '^(?:AD)*(d{3})$', 'ca', 3041565, 'ES,FR', '\r'),
(7, 'AO', 'AGO', 24, 'AO', 'Angola', 'Luanda', 1246700, 13068161, 'AF', '.ao', 'AOA', 'Kwanza', '244', '', '', 'pt-AO', 3351879, 'CD,NA,ZM,CG', '\r'),
(8, 'AI', 'AIA', 660, 'AV', 'Anguilla', 'The Valley', 102, 13254, 'NA', '.ai', 'XCD', 'Dollar', '+1-264', '', '', 'en-AI', 3573511, '', '\r'),
(9, 'AQ', 'ATA', 10, 'AY', 'Antarctica', '', 14000000, 0, 'AN', '.aq', '', '', '', '', '', '', 6697173, '', '\r'),
(10, 'AG', 'ATG', 28, 'AC', 'Antigua and Barbuda', 'St. John''s', 443, 86754, 'NA', '.ag', 'XCD', 'Dollar', '+1-268', '', '', 'en-AG', 3576396, '', '\r'),
(11, 'AR', 'ARG', 32, 'AR', 'Argentina', 'Buenos Aires', 2766890, 41343201, 'SA', '.ar', 'ARS', 'Peso', '54', '@####@@@', '^([A-Z]d{4}[A-Z]{3})', 'es-AR,en,it,de,fr,gn', 3865483, 'CL,BO,UY,PY,BR', '\r'),
(12, 'AM', 'ARM', 51, 'AM', 'Armenia', 'Yerevan', 29800, 2968000, 'AS', '.am', 'AMD', 'Dram', '374', '######', '^(d{6})$', 'hy', 174982, 'GE,IR,AZ,TR', '\r'),
(13, 'AW', 'ABW', 533, 'AA', 'Aruba', 'Oranjestad', 193, 71566, 'NA', '.aw', 'AWG', 'Guilder', '297', '', '', 'nl-AW,es,en', 3577279, '', '\r'),
(14, 'AU', 'AUS', 36, 'AS', 'Australia', 'Canberra', 7686850, 21515754, 'OC', '.au', 'AUD', 'Dollar', '61', '####', '^(d{4})$', 'en-AU', 2077456, '', '\r'),
(15, 'AT', 'AUT', 40, 'AU', 'Austria', 'Vienna', 83858, 8205000, 'EU', '.at', 'EUR', 'Euro', '43', '####', '^(d{4})$', 'de-AT,hr,hu,sl', 2782113, 'CH,DE,HU,SK,CZ,IT,SI', '\r'),
(16, 'AZ', 'AZE', 31, 'AJ', 'Azerbaijan', 'Baku', 86600, 8303512, 'AS', '.az', 'AZN', 'Manat', '994', 'AZ ####', '^(?:AZ)*(d{4})$', 'az,ru,hy', 587116, 'GE,IR,AM,TR,RU', '\r'),
(17, 'BS', 'BHS', 44, 'BF', 'Bahamas', 'Nassau', 13940, 301790, 'NA', '.bs', 'BSD', 'Dollar', '+1-242', '', '', 'en-BS', 3572887, '', '\r'),
(18, 'BH', 'BHR', 48, 'BA', 'Bahrain', 'Manama', 665, 738004, 'AS', '.bh', 'BHD', 'Dinar', '973', '####|###', '^(d{3}d?)$', 'ar-BH,en,fa,ur', 290291, '', '\r'),
(19, 'BD', 'BGD', 50, 'BG', 'Bangladesh', 'Dhaka', 144000, 156118464, 'AS', '.bd', 'BDT', 'Taka', '880', '####', '^(d{4})$', 'bn-BD,en', 1210997, 'MM,IN', '\r'),
(20, 'BB', 'BRB', 52, 'BB', 'Barbados', 'Bridgetown', 431, 285653, 'NA', '.bb', 'BBD', 'Dollar', '+1-246', 'BB#####', '^(?:BB)*(d{5})$', 'en-BB', 3374084, '', '\r'),
(21, 'BY', 'BLR', 112, 'BO', 'Belarus', 'Minsk', 207600, 9685000, 'EU', '.by', 'BYR', 'Ruble', '375', '######', '^(d{6})$', 'be,ru', 630336, 'PL,LT,UA,RU,LV', '\r'),
(22, 'BE', 'BEL', 56, 'BE', 'Belgium', 'Brussels', 30510, 10403000, 'EU', '.be', 'EUR', 'Euro', '32', '####', '^(d{4})$', 'nl-BE,fr-BE,de-BE', 2802361, 'DE,NL,LU,FR', '\r'),
(23, 'BZ', 'BLZ', 84, 'BH', 'Belize', 'Belmopan', 22966, 314522, 'NA', '.bz', 'BZD', 'Dollar', '501', '', '', 'en-BZ,es', 3582678, 'GT,MX', '\r'),
(24, 'BJ', 'BEN', 204, 'BN', 'Benin', 'Porto-Novo', 112620, 9056010, 'AF', '.bj', 'XOF', 'Franc', '229', '', '', 'fr-BJ', 2395170, 'NE,TG,BF,NG', '\r'),
(25, 'BM', 'BMU', 60, 'BD', 'Bermuda', 'Hamilton', 53, 65365, 'NA', '.bm', 'BMD', 'Dollar', '+1-441', '@@ ##', '^([A-Z]{2}d{2})$', 'en-BM,pt', 3573345, '', '\r'),
(26, 'BT', 'BTN', 64, 'BT', 'Bhutan', 'Thimphu', 47000, 699847, 'AS', '.bt', 'BTN', 'Ngultrum', '975', '', '', 'dz', 1252634, 'CN,IN', '\r'),
(27, 'BO', 'BOL', 68, 'BL', 'Bolivia', 'Sucre', 1098580, 9947418, 'SA', '.bo', 'BOB', 'Boliviano', '591', '', '', 'es-BO,qu,ay', 3923057, 'PE,CL,PY,BR,AR', '\r'),
(28, 'BQ', 'BES', 535, '', 'Bonaire, Saint Eustatius and Saba ', '', 0, 18012, 'NA', '.bq', 'USD', 'Dollar', '599', '', '', 'nl,pap,en', 7626844, '', '\r'),
(29, 'BA', 'BIH', 70, 'BK', 'Bosnia and Herzegovina', 'Sarajevo', 51129, 4590000, 'EU', '.ba', 'BAM', 'Marka', '387', '#####', '^(d{5})$', 'bs,hr-BA,sr-BA', 3277605, 'CS,HR,ME,RS', '\r'),
(30, 'BW', 'BWA', 72, 'BC', 'Botswana', 'Gaborone', 600370, 2029307, 'AF', '.bw', 'BWP', 'Pula', '267', '', '', 'en-BW,tn-BW', 933860, 'ZW,ZA,NA', '\r'),
(31, 'BV', 'BVT', 74, 'BV', 'Bouvet Island', '', 0, 0, 'AN', '.bv', 'NOK', 'Krone', '', '', '', '', 3371123, '', '\r'),
(32, 'BR', 'BRA', 76, 'BR', 'Brazil', 'Brasilia', 8511965, 201103330, 'SA', '.br', 'BRL', 'Real', '55', '#####-###', '^(d{8})$', 'pt-BR,es,en,fr', 3469034, 'SR,PE,BO,UY,GY,PY,GF', '\r'),
(33, 'IO', 'IOT', 86, 'IO', 'British Indian Ocean Territory', 'Diego Garcia', 60, 4000, 'AS', '.io', 'USD', 'Dollar', '246', '', '', 'en-IO', 1282588, '', '\r'),
(34, 'VG', 'VGB', 92, 'VI', 'British Virgin Islands', 'Road Town', 153, 21730, 'NA', '.vg', 'USD', 'Dollar', '+1-284', '', '', 'en-VG', 3577718, '', '\r'),
(35, 'BN', 'BRN', 96, 'BX', 'Brunei', 'Bandar Seri Begawan', 5770, 395027, 'AS', '.bn', 'BND', 'Dollar', '673', '@@####', '^([A-Z]{2}d{4})$', 'ms-BN,en-BN', 1820814, 'MY', '\r'),
(36, 'BG', 'BGR', 100, 'BU', 'Bulgaria', 'Sofia', 110910, 7148785, 'EU', '.bg', 'BGN', 'Lev', '359', '####', '^(d{4})$', 'bg,tr-BG', 732800, 'MK,GR,RO,CS,TR,RS', '\r'),
(37, 'BF', 'BFA', 854, 'UV', 'Burkina Faso', 'Ouagadougou', 274200, 16241811, 'AF', '.bf', 'XOF', 'Franc', '226', '', '', 'fr-BF', 2361809, 'NE,BJ,GH,CI,TG,ML', '\r'),
(38, 'BI', 'BDI', 108, 'BY', 'Burundi', 'Bujumbura', 27830, 9863117, 'AF', '.bi', 'BIF', 'Franc', '257', '', '', 'fr-BI,rn', 433561, 'TZ,CD,RW', '\r'),
(39, 'KH', 'KHM', 116, 'CB', 'Cambodia', 'Phnom Penh', 181040, 14453680, 'AS', '.kh', 'KHR', 'Riels', '855', '#####', '^(d{5})$', 'km,fr,en', 1831722, 'LA,TH,VN', '\r'),
(40, 'CM', 'CMR', 120, 'CM', 'Cameroon', 'Yaounde', 475440, 19294149, 'AF', '.cm', 'XAF', 'Franc', '237', '', '', 'en-CM,fr-CM', 2233387, 'TD,CF,GA,GQ,CG,NG', '\r'),
(41, 'CA', 'CAN', 124, 'CA', 'Canada', 'Ottawa', 9984670, 33679000, 'NA', '.ca', 'CAD', 'Dollar', '1', '@#@ #@#', '^([a-zA-Z]d[a-zA-Z]d', 'en-CA,fr-CA,iu', 6251999, 'US', '\r'),
(42, 'CV', 'CPV', 132, 'CV', 'Cape Verde', 'Praia', 4033, 508659, 'AF', '.cv', 'CVE', 'Escudo', '238', '####', '^(d{4})$', 'pt-CV', 3374766, '', '\r'),
(43, 'KY', 'CYM', 136, 'CJ', 'Cayman Islands', 'George Town', 262, 44270, 'NA', '.ky', 'KYD', 'Dollar', '+1-345', '', '', 'en-KY', 3580718, '', '\r'),
(44, 'CF', 'CAF', 140, 'CT', 'Central African Republic', 'Bangui', 622984, 4844927, 'AF', '.cf', 'XAF', 'Franc', '236', '', '', 'fr-CF,sg,ln,kg', 239880, 'TD,SD,CD,SS,CM,CG', '\r'),
(45, 'TD', 'TCD', 148, 'CD', 'Chad', 'N''Djamena', 1284000, 10543464, 'AF', '.td', 'XAF', 'Franc', '235', '', '', 'fr-TD,ar-TD,sre', 2434508, 'NE,LY,CF,SD,CM,NG', '\r'),
(46, 'CL', 'CHL', 152, 'CI', 'Chile', 'Santiago', 756950, 16746491, 'SA', '.cl', 'CLP', 'Peso', '56', '#######', '^(d{7})$', 'es-CL', 3895114, 'PE,BO,AR', '\r'),
(47, 'CN', 'CHN', 156, 'CH', 'China', 'Beijing', 9596960, 1330044000, 'AS', '.cn', 'CNY', 'Yuan Renminbi', '86', '######', '^(d{6})$', 'zh-CN,yue,wuu,dta,ug,za', 1814991, 'LA,BT,TJ,KZ,MN,AF,NP', '\r'),
(48, 'CX', 'CXR', 162, 'KT', 'Christmas Island', 'Flying Fish Cove', 135, 1500, 'AS', '.cx', 'AUD', 'Dollar', '61', '####', '^(d{4})$', 'en,zh,ms-CC', 2078138, '', '\r'),
(49, 'CC', 'CCK', 166, 'CK', 'Cocos Islands', 'West Island', 14, 628, 'AS', '.cc', 'AUD', 'Dollar', '61', '', '', 'ms-CC,en', 1547376, '', '\r'),
(50, 'CO', 'COL', 170, 'CO', 'Colombia', 'Bogota', 1138910, 44205293, 'SA', '.co', 'COP', 'Peso', '57', '', '', 'es-CO', 3686110, 'EC,PE,PA,BR,VE', '\r'),
(51, 'KM', 'COM', 174, 'CN', 'Comoros', 'Moroni', 2170, 773407, 'AF', '.km', 'KMF', 'Franc', '269', '', '', 'ar,fr-KM', 921929, '', '\r'),
(52, 'CK', 'COK', 184, 'CW', 'Cook Islands', 'Avarua', 240, 21388, 'OC', '.ck', 'NZD', 'Dollar', '682', '', '', 'en-CK,mi', 1899402, '', '\r'),
(53, 'CR', 'CRI', 188, 'CS', 'Costa Rica', 'San Jose', 51100, 4516220, 'NA', '.cr', 'CRC', 'Colon', '506', '####', '^(d{4})$', 'es-CR,en', 3624060, 'PA,NI', '\r'),
(54, 'HR', 'HRV', 191, 'HR', 'Croatia', 'Zagreb', 56542, 4491000, 'EU', '.hr', 'HRK', 'Kuna', '385', 'HR-#####', '^(?:HR)*(d{5})$', 'hr-HR,sr', 3202326, 'HU,SI,CS,BA,ME,RS', '\r'),
(55, 'CU', 'CUB', 192, 'CU', 'Cuba', 'Havana', 110860, 11423000, 'NA', '.cu', 'CUP', 'Peso', '53', 'CP #####', '^(?:CP)*(d{5})$', 'es-CU', 3562981, 'US', '\r'),
(56, 'CW', 'CUW', 531, 'UC', 'Curacao', ' Willemstad', 0, 141766, 'NA', '.cw', 'ANG', 'Guilder', '599', '', '', 'nl,pap', 7626836, '', '\r'),
(57, 'CY', 'CYP', 196, 'CY', 'Cyprus', 'Nicosia', 9250, 1102677, 'EU', '.cy', 'EUR', 'Euro', '357', '####', '^(d{4})$', 'el-CY,tr-CY,en', 146669, '', '\r'),
(58, 'CZ', 'CZE', 203, 'EZ', 'Czech Republic', 'Prague', 78866, 10476000, 'EU', '.cz', 'CZK', 'Koruna', '420', '### ##', '^(d{5})$', 'cs,sk', 3077311, 'PL,DE,SK,AT', '\r'),
(59, 'CD', 'COD', 180, 'CG', 'Democratic Republic of the Congo', 'Kinshasa', 2345410, 70916439, 'AF', '.cd', 'CDF', 'Franc', '243', '', '', 'fr-CD,ln,kg', 203312, 'TZ,CF,SS,RW,ZM,BI,UG', '\r'),
(60, 'DK', 'DNK', 208, 'DA', 'Denmark', 'Copenhagen', 43094, 5484000, 'EU', '.dk', 'DKK', 'Krone', '45', '####', '^(d{4})$', 'da-DK,en,fo,de-DK', 2623032, 'DE', '\r'),
(61, 'DJ', 'DJI', 262, 'DJ', 'Djibouti', 'Djibouti', 23000, 740528, 'AF', '.dj', 'DJF', 'Franc', '253', '', '', 'fr-DJ,ar,so-DJ,aa', 223816, 'ER,ET,SO', '\r'),
(62, 'DM', 'DMA', 212, 'DO', 'Dominica', 'Roseau', 754, 72813, 'NA', '.dm', 'XCD', 'Dollar', '+1-767', '', '', 'en-DM', 3575830, '', '\r'),
(63, 'DO', 'DOM', 214, 'DR', 'Dominican Republic', 'Santo Domingo', 48730, 9823821, 'NA', '.do', 'DOP', 'Peso', '+1-809 and', '#####', '^(d{5})$', 'es-DO', 3508796, 'HT', '\r'),
(64, 'TL', 'TLS', 626, 'TT', 'East Timor', 'Dili', 15007, 1154625, 'OC', '.tl', 'USD', 'Dollar', '670', '', '', 'tet,pt-TL,id,en', 1966436, 'ID', '\r'),
(65, 'EC', 'ECU', 218, 'EC', 'Ecuador', 'Quito', 283560, 14790608, 'SA', '.ec', 'USD', 'Dollar', '593', '@####@', '^([a-zA-Z]d{4}[a-zA-', 'es-EC', 3658394, 'PE,CO', '\r'),
(66, 'EG', 'EGY', 818, 'EG', 'Egypt', 'Cairo', 1001450, 80471869, 'AF', '.eg', 'EGP', 'Pound', '20', '#####', '^(d{5})$', 'ar-EG,en,fr', 357994, 'LY,SD,IL', '\r'),
(67, 'SV', 'SLV', 222, 'ES', 'El Salvador', 'San Salvador', 21040, 6052064, 'NA', '.sv', 'USD', 'Dollar', '503', 'CP ####', '^(?:CP)*(d{4})$', 'es-SV', 3585968, 'GT,HN', '\r'),
(68, 'GQ', 'GNQ', 226, 'EK', 'Equatorial Guinea', 'Malabo', 28051, 1014999, 'AF', '.gq', 'XAF', 'Franc', '240', '', '', 'es-GQ,fr', 2309096, 'GA,CM', '\r'),
(69, 'ER', 'ERI', 232, 'ER', 'Eritrea', 'Asmara', 121320, 5792984, 'AF', '.er', 'ERN', 'Nakfa', '291', '', '', 'aa-ER,ar,tig,kun,ti-ER', 338010, 'ET,SD,DJ', '\r'),
(70, 'EE', 'EST', 233, 'EN', 'Estonia', 'Tallinn', 45226, 1291170, 'EU', '.ee', 'EUR', 'Euro', '372', '#####', '^(d{5})$', 'et,ru', 453733, 'RU,LV', '\r'),
(71, 'ET', 'ETH', 231, 'ET', 'Ethiopia', 'Addis Ababa', 1127127, 88013491, 'AF', '.et', 'ETB', 'Birr', '251', '####', '^(d{4})$', 'am,en-ET,om-ET,ti-ET,so-ET,sid', 337996, 'ER,KE,SD,SS,SO,DJ', '\r'),
(72, 'FK', 'FLK', 238, 'FK', 'Falkland Islands', 'Stanley', 12173, 2638, 'SA', '.fk', 'FKP', 'Pound', '500', '', '', 'en-FK', 3474414, '', '\r'),
(73, 'FO', 'FRO', 234, 'FO', 'Faroe Islands', 'Torshavn', 1399, 48228, 'EU', '.fo', 'DKK', 'Krone', '298', 'FO-###', '^(?:FO)*(d{3})$', 'fo,da-FO', 2622320, '', '\r'),
(74, 'FJ', 'FJI', 242, 'FJ', 'Fiji', 'Suva', 18270, 875983, 'OC', '.fj', 'FJD', 'Dollar', '679', '', '', 'en-FJ,fj', 2205218, '', '\r'),
(75, 'FI', 'FIN', 246, 'FI', 'Finland', 'Helsinki', 337030, 5244000, 'EU', '.fi', 'EUR', 'Euro', '358', '#####', '^(?:FI)*(d{5})$', 'fi-FI,sv-FI,smn', 660013, 'NO,RU,SE', '\r'),
(76, 'FR', 'FRA', 250, 'FR', 'France', 'Paris', 547030, 64768389, 'EU', '.fr', 'EUR', 'Euro', '33', '#####', '^(d{5})$', 'fr-FR,frp,br,co,ca,eu,oc', 3017382, 'CH,DE,BE,LU,IT,AD,MC', '\r'),
(77, 'GF', 'GUF', 254, 'FG', 'French Guiana', 'Cayenne', 91000, 195506, 'SA', '.gf', 'EUR', 'Euro', '594', '#####', '^((97)|(98)3d{2})$', 'fr-GF', 3381670, 'SR,BR', '\r'),
(78, 'PF', 'PYF', 258, 'FP', 'French Polynesia', 'Papeete', 4167, 270485, 'OC', '.pf', 'XPF', 'Franc', '689', '#####', '^((97)|(98)7d{2})$', 'fr-PF,ty', 4030656, '', '\r'),
(79, 'TF', 'ATF', 260, 'FS', 'French Southern Territories', 'Port-aux-Francais', 7829, 140, 'AN', '.tf', 'EUR', 'Euro', '', '', '', 'fr', 1546748, '', '\r'),
(80, 'GA', 'GAB', 266, 'GB', 'Gabon', 'Libreville', 267667, 1545255, 'AF', '.ga', 'XAF', 'Franc', '241', '', '', 'fr-GA', 2400553, 'CM,GQ,CG', '\r'),
(81, 'GM', 'GMB', 270, 'GA', 'Gambia', 'Banjul', 11300, 1593256, 'AF', '.gm', 'GMD', 'Dalasi', '220', '', '', 'en-GM,mnk,wof,wo,ff', 2413451, 'SN', '\r'),
(82, 'GE', 'GEO', 268, 'GG', 'Georgia', 'Tbilisi', 69700, 4630000, 'AS', '.ge', 'GEL', 'Lari', '995', '####', '^(d{4})$', 'ka,ru,hy,az', 614540, 'AM,AZ,TR,RU', '\r'),
(83, 'DE', 'DEU', 276, 'GM', 'Germany', 'Berlin', 357021, 81802257, 'EU', '.de', 'EUR', 'Euro', '49', '#####', '^(d{5})$', 'de', 2921044, 'CH,PL,NL,DK,BE,CZ,LU', '\r'),
(84, 'GH', 'GHA', 288, 'GH', 'Ghana', 'Accra', 239460, 24339838, 'AF', '.gh', 'GHS', 'Cedi', '233', '', '', 'en-GH,ak,ee,tw', 2300660, 'CI,TG,BF', '\r'),
(85, 'GI', 'GIB', 292, 'GI', 'Gibraltar', 'Gibraltar', 6.5, 27884, 'EU', '.gi', 'GIP', 'Pound', '350', '', '', 'en-GI,es,it,pt', 2411586, 'ES', '\r'),
(86, 'GR', 'GRC', 300, 'GR', 'Greece', 'Athens', 131940, 11000000, 'EU', '.gr', 'EUR', 'Euro', '30', '### ##', '^(d{5})$', 'el-GR,en,fr', 390903, 'AL,MK,TR,BG', '\r'),
(87, 'GL', 'GRL', 304, 'GL', 'Greenland', 'Nuuk', 2166086, 56375, 'NA', '.gl', 'DKK', 'Krone', '299', '####', '^(d{4})$', 'kl,da-GL,en', 3425505, '', '\r'),
(88, 'GD', 'GRD', 308, 'GJ', 'Grenada', 'St. George''s', 344, 107818, 'NA', '.gd', 'XCD', 'Dollar', '+1-473', '', '', 'en-GD', 3580239, '', '\r'),
(89, 'GP', 'GLP', 312, 'GP', 'Guadeloupe', 'Basse-Terre', 1780, 443000, 'NA', '.gp', 'EUR', 'Euro', '590', '#####', '^((97)|(98)d{3})$', 'fr-GP', 3579143, 'AN', '\r'),
(90, 'GU', 'GUM', 316, 'GQ', 'Guam', 'Hagatna', 549, 159358, 'OC', '.gu', 'USD', 'Dollar', '+1-671', '969##', '^(969d{2})$', 'en-GU,ch-GU', 4043988, '', '\r'),
(91, 'GT', 'GTM', 320, 'GT', 'Guatemala', 'Guatemala City', 108890, 13550440, 'NA', '.gt', 'GTQ', 'Quetzal', '502', '#####', '^(d{5})$', 'es-GT', 3595528, 'MX,HN,BZ,SV', '\r'),
(92, 'GG', 'GGY', 831, 'GK', 'Guernsey', 'St Peter Port', 78, 65228, 'EU', '.gg', 'GBP', 'Pound', '+44-1481', '@# #@@|@## #@@|@@# #', '^(([A-Z]d{2}[A-Z]{2}', 'en,fr', 3042362, '', '\r'),
(93, 'GN', 'GIN', 324, 'GV', 'Guinea', 'Conakry', 245857, 10324025, 'AF', '.gn', 'GNF', 'Franc', '224', '', '', 'fr-GN', 2420477, 'LR,SN,SL,CI,GW,ML', '\r'),
(94, 'GW', 'GNB', 624, 'PU', 'Guinea-Bissau', 'Bissau', 36120, 1565126, 'AF', '.gw', 'XOF', 'Franc', '245', '####', '^(d{4})$', 'pt-GW,pov', 2372248, 'SN,GN', '\r'),
(95, 'GY', 'GUY', 328, 'GY', 'Guyana', 'Georgetown', 214970, 748486, 'SA', '.gy', 'GYD', 'Dollar', '592', '', '', 'en-GY', 3378535, 'SR,BR,VE', '\r'),
(96, 'HT', 'HTI', 332, 'HA', 'Haiti', 'Port-au-Prince', 27750, 9648924, 'NA', '.ht', 'HTG', 'Gourde', '509', 'HT####', '^(?:HT)*(d{4})$', 'ht,fr-HT', 3723988, 'DO', '\r'),
(97, 'HM', 'HMD', 334, 'HM', 'Heard Island and McDonald Islands', '', 412, 0, 'AN', '.hm', 'AUD', 'Dollar', '', '', '', '', 1547314, '', '\r'),
(98, 'HN', 'HND', 340, 'HO', 'Honduras', 'Tegucigalpa', 112090, 7989415, 'NA', '.hn', 'HNL', 'Lempira', '504', '@@####', '^([A-Z]{2}d{4})$', 'es-HN', 3608932, 'GT,NI,SV', '\r'),
(99, 'HK', 'HKG', 344, 'HK', 'Hong Kong', 'Hong Kong', 1092, 6898686, 'AS', '.hk', 'HKD', 'Dollar', '852', '', '', 'zh-HK,yue,zh,en', 1819730, '', '\r'),
(100, 'HU', 'HUN', 348, 'HU', 'Hungary', 'Budapest', 93030, 9930000, 'EU', '.hu', 'HUF', 'Forint', '36', '####', '^(d{4})$', 'hu-HU', 719819, 'SK,SI,RO,UA,CS,HR,AT', '\r'),
(101, 'IS', 'ISL', 352, 'IC', 'Iceland', 'Reykjavik', 103000, 308910, 'EU', '.is', 'ISK', 'Krona', '354', '###', '^(d{3})$', 'is,en,de,da,sv,no', 2629691, '', '\r'),
(102, 'IN', 'IND', 356, 'IN', 'India', 'New Delhi', 3287590, 1173108018, 'AS', '.in', 'INR', 'Rupee', '91', '######', '^(d{6})$', 'en-IN,hi,bn,te,mr,ta,ur,gu,kn,ml,or,pa,as,bh,sat,ks,ne,sd,kok,doi,mni,sit,sa,fr,lus,inc', 1269750, 'CN,NP,MM,BT,PK,BD', '\r'),
(103, 'ID', 'IDN', 360, 'ID', 'Indonesia', 'Jakarta', 1919440, 242968342, 'AS', '.id', 'IDR', 'Rupiah', '62', '#####', '^(d{5})$', 'id,en,nl,jv', 1643084, 'PG,TL,MY', '\r'),
(104, 'IR', 'IRN', 364, 'IR', 'Iran', 'Tehran', 1648000, 76923300, 'AS', '.ir', 'IRR', 'Rial', '98', '##########', '^(d{10})$', 'fa-IR,ku', 130758, 'TM,AF,IQ,AM,PK,AZ,TR', '\r'),
(105, 'IQ', 'IRQ', 368, 'IZ', 'Iraq', 'Baghdad', 437072, 29671605, 'AS', '.iq', 'IQD', 'Dinar', '964', '#####', '^(d{5})$', 'ar-IQ,ku,hy', 99237, 'SY,SA,IR,JO,TR,KW', '\r'),
(106, 'IE', 'IRL', 372, 'EI', 'Ireland', 'Dublin', 70280, 4622917, 'EU', '.ie', 'EUR', 'Euro', '353', '', '', 'en-IE,ga-IE', 2963597, 'GB', '\r'),
(107, 'IM', 'IMN', 833, 'IM', 'Isle of Man', 'Douglas, Isle of Man', 572, 75049, 'EU', '.im', 'GBP', 'Pound', '+44-1624', '@# #@@|@## #@@|@@# #', '^(([A-Z]d{2}[A-Z]{2}', 'en,gv', 3042225, '', '\r'),
(108, 'IL', 'ISR', 376, 'IS', 'Israel', 'Jerusalem', 20770, 7353985, 'AS', '.il', 'ILS', 'Shekel', '972', '#####', '^(d{5})$', 'he,ar-IL,en-IL,', 294640, 'SY,JO,LB,EG,PS', '\r'),
(109, 'IT', 'ITA', 380, 'IT', 'Italy', 'Rome', 301230, 60340328, 'EU', '.it', 'EUR', 'Euro', '39', '#####', '^(d{5})$', 'it-IT,de-IT,fr-IT,sc,ca,co,sl', 3175395, 'CH,VA,SI,SM,FR,AT', '\r'),
(110, 'CI', 'CIV', 384, 'IV', 'Ivory Coast', 'Yamoussoukro', 322460, 21058798, 'AF', '.ci', 'XOF', 'Franc', '225', '', '', 'fr-CI', 2287781, 'LR,GH,GN,BF,ML', '\r'),
(111, 'JM', 'JAM', 388, 'JM', 'Jamaica', 'Kingston', 10991, 2847232, 'NA', '.jm', 'JMD', 'Dollar', '+1-876', '', '', 'en-JM', 3489940, '', '\r'),
(112, 'JP', 'JPN', 392, 'JA', 'Japan', 'Tokyo', 377835, 127288000, 'AS', '.jp', 'JPY', 'Yen', '81', '###-####', '^(d{7})$', 'ja', 1861060, '', '\r'),
(113, 'JE', 'JEY', 832, 'JE', 'Jersey', 'Saint Helier', 116, 90812, 'EU', '.je', 'GBP', 'Pound', '+44-1534', '@# #@@|@## #@@|@@# #', '^(([A-Z]d{2}[A-Z]{2}', 'en,pt', 3042142, '', '\r'),
(114, 'JO', 'JOR', 400, 'JO', 'Jordan', 'Amman', 92300, 6407085, 'AS', '.jo', 'JOD', 'Dinar', '962', '#####', '^(d{5})$', 'ar-JO,en', 248816, 'SY,SA,IQ,IL,PS', '\r'),
(115, 'KZ', 'KAZ', 398, 'KZ', 'Kazakhstan', 'Astana', 2717300, 15340000, 'AS', '.kz', 'KZT', 'Tenge', '7', '######', '^(d{6})$', 'kk,ru', 1522867, 'TM,CN,KG,UZ,RU', '\r'),
(116, 'KE', 'KEN', 404, 'KE', 'Kenya', 'Nairobi', 582650, 40046566, 'AF', '.ke', 'KES', 'Shilling', '254', '#####', '^(d{5})$', 'en-KE,sw-KE', 192950, 'ET,TZ,SS,SO,UG', '\r'),
(117, 'KI', 'KIR', 296, 'KR', 'Kiribati', 'Tarawa', 811, 92533, 'OC', '.ki', 'AUD', 'Dollar', '686', '', '', 'en-KI,gil', 4030945, '', '\r'),
(118, 'XK', 'XKX', 0, 'KV', 'Kosovo', 'Pristina', 0, 1800000, 'EU', '', 'EUR', 'Euro', '', '', '', 'sq,sr', 831053, 'RS,AL,MK,ME', '\r'),
(119, 'KW', 'KWT', 414, 'KU', 'Kuwait', 'Kuwait City', 17820, 2789132, 'AS', '.kw', 'KWD', 'Dinar', '965', '#####', '^(d{5})$', 'ar-KW,en', 285570, 'SA,IQ', '\r'),
(120, 'KG', 'KGZ', 417, 'KG', 'Kyrgyzstan', 'Bishkek', 198500, 5508626, 'AS', '.kg', 'KGS', 'Som', '996', '######', '^(d{6})$', 'ky,uz,ru', 1527747, 'CN,TJ,UZ,KZ', '\r'),
(121, 'LA', 'LAO', 418, 'LA', 'Laos', 'Vientiane', 236800, 6368162, 'AS', '.la', 'LAK', 'Kip', '856', '#####', '^(d{5})$', 'lo,fr,en', 1655842, 'CN,MM,KH,TH,VN', '\r'),
(122, 'LV', 'LVA', 428, 'LG', 'Latvia', 'Riga', 64589, 2217969, 'EU', '.lv', 'LVL', 'Lat', '371', 'LV-####', '^(?:LV)*(d{4})$', 'lv,ru,lt', 458258, 'LT,EE,BY,RU', '\r'),
(123, 'LB', 'LBN', 422, 'LE', 'Lebanon', 'Beirut', 10400, 4125247, 'AS', '.lb', 'LBP', 'Pound', '961', '#### ####|####', '^(d{4}(d{4})?)$', 'ar-LB,fr-LB,en,hy', 272103, 'SY,IL', '\r'),
(124, 'LS', 'LSO', 426, 'LT', 'Lesotho', 'Maseru', 30355, 1919552, 'AF', '.ls', 'LSL', 'Loti', '266', '###', '^(d{3})$', 'en-LS,st,zu,xh', 932692, 'ZA', '\r'),
(125, 'LR', 'LBR', 430, 'LI', 'Liberia', 'Monrovia', 111370, 3685076, 'AF', '.lr', 'LRD', 'Dollar', '231', '####', '^(d{4})$', 'en-LR', 2275384, 'SL,CI,GN', '\r'),
(126, 'LY', 'LBY', 434, 'LY', 'Libya', 'Tripolis', 1759540, 6461454, 'AF', '.ly', 'LYD', 'Dinar', '218', '', '', 'ar-LY,it,en', 2215636, 'TD,NE,DZ,SD,TN,EG', '\r'),
(127, 'LI', 'LIE', 438, 'LS', 'Liechtenstein', 'Vaduz', 160, 35000, 'EU', '.li', 'CHF', 'Franc', '423', '####', '^(d{4})$', 'de-LI', 3042058, 'CH,AT', '\r'),
(128, 'LT', 'LTU', 440, 'LH', 'Lithuania', 'Vilnius', 65200, 3565000, 'EU', '.lt', 'LTL', 'Litas', '370', 'LT-#####', '^(?:LT)*(d{5})$', 'lt,ru,pl', 597427, 'PL,BY,RU,LV', '\r'),
(129, 'LU', 'LUX', 442, 'LU', 'Luxembourg', 'Luxembourg', 2586, 497538, 'EU', '.lu', 'EUR', 'Euro', '352', '####', '^(d{4})$', 'lb,de-LU,fr-LU', 2960313, 'DE,BE,FR', '\r'),
(130, 'MO', 'MAC', 446, 'MC', 'Macao', 'Macao', 254, 449198, 'AS', '.mo', 'MOP', 'Pataca', '853', '', '', 'zh,zh-MO,pt', 1821275, '', '\r'),
(131, 'MK', 'MKD', 807, 'MK', 'Macedonia', 'Skopje', 25333, 2061000, 'EU', '.mk', 'MKD', 'Denar', '389', '####', '^(d{4})$', 'mk,sq,tr,rmm,sr', 718075, 'AL,GR,CS,BG,RS,XK', '\r'),
(132, 'MG', 'MDG', 450, 'MA', 'Madagascar', 'Antananarivo', 587040, 21281844, 'AF', '.mg', 'MGA', 'Ariary', '261', '###', '^(d{3})$', 'fr-MG,mg', 1062947, '', '\r'),
(133, 'MW', 'MWI', 454, 'MI', 'Malawi', 'Lilongwe', 118480, 15447500, 'AF', '.mw', 'MWK', 'Kwacha', '265', '', '', 'ny,yao,tum,swk', 927384, 'TZ,MZ,ZM', '\r'),
(134, 'MY', 'MYS', 458, 'MY', 'Malaysia', 'Kuala Lumpur', 329750, 28274729, 'AS', '.my', 'MYR', 'Ringgit', '60', '#####', '^(d{5})$', 'ms-MY,en,zh,ta,te,ml,pa,th', 1733045, 'BN,TH,ID', '\r'),
(135, 'MV', 'MDV', 462, 'MV', 'Maldives', 'Male', 300, 395650, 'AS', '.mv', 'MVR', 'Rufiyaa', '960', '#####', '^(d{5})$', 'dv,en', 1282028, '', '\r'),
(136, 'ML', 'MLI', 466, 'ML', 'Mali', 'Bamako', 1240000, 13796354, 'AF', '.ml', 'XOF', 'Franc', '223', '', '', 'fr-ML,bm', 2453866, 'SN,NE,DZ,CI,GN,MR,BF', '\r'),
(137, 'MT', 'MLT', 470, 'MT', 'Malta', 'Valletta', 316, 403000, 'EU', '.mt', 'EUR', 'Euro', '356', '@@@ ###|@@@ ##', '^([A-Z]{3}d{2}d?)$', 'mt,en-MT', 2562770, '', '\r'),
(138, 'MH', 'MHL', 584, 'RM', 'Marshall Islands', 'Majuro', 181.3, 65859, 'OC', '.mh', 'USD', 'Dollar', '692', '', '', 'mh,en-MH', 2080185, '', '\r'),
(139, 'MQ', 'MTQ', 474, 'MB', 'Martinique', 'Fort-de-France', 1100, 432900, 'NA', '.mq', 'EUR', 'Euro', '596', '#####', '^(d{5})$', 'fr-MQ', 3570311, '', '\r'),
(140, 'MR', 'MRT', 478, 'MR', 'Mauritania', 'Nouakchott', 1030700, 3205060, 'AF', '.mr', 'MRO', 'Ouguiya', '222', '', '', 'ar-MR,fuc,snk,fr,mey,wo', 2378080, 'SN,DZ,EH,ML', '\r'),
(141, 'MU', 'MUS', 480, 'MP', 'Mauritius', 'Port Louis', 2040, 1294104, 'AF', '.mu', 'MUR', 'Rupee', '230', '', '', 'en-MU,bho,fr', 934292, '', '\r'),
(142, 'YT', 'MYT', 175, 'MF', 'Mayotte', 'Mamoudzou', 374, 159042, 'AF', '.yt', 'EUR', 'Euro', '262', '#####', '^(d{5})$', 'fr-YT', 1024031, '', '\r'),
(143, 'MX', 'MEX', 484, 'MX', 'Mexico', 'Mexico City', 1972550, 112468855, 'NA', '.mx', 'MXN', 'Peso', '52', '#####', '^(d{5})$', 'es-MX', 3996063, 'GT,US,BZ', '\r'),
(144, 'FM', 'FSM', 583, 'FM', 'Micronesia', 'Palikir', 702, 107708, 'OC', '.fm', 'USD', 'Dollar', '691', '#####', '^(d{5})$', 'en-FM,chk,pon,yap,kos,uli,woe,nkr,kpg', 2081918, '', '\r'),
(145, 'MD', 'MDA', 498, 'MD', 'Moldova', 'Chisinau', 33843, 4324000, 'EU', '.md', 'MDL', 'Leu', '373', 'MD-####', '^(?:MD)*(d{4})$', 'ro,ru,gag,tr', 617790, 'RO,UA', '\r'),
(146, 'MC', 'MCO', 492, 'MN', 'Monaco', 'Monaco', 1.95, 32965, 'EU', '.mc', 'EUR', 'Euro', '377', '#####', '^(d{5})$', 'fr-MC,en,it', 2993457, 'FR', '\r'),
(147, 'MN', 'MNG', 496, 'MG', 'Mongolia', 'Ulan Bator', 1565000, 3086918, 'AS', '.mn', 'MNT', 'Tugrik', '976', '######', '^(d{6})$', 'mn,ru', 2029969, 'CN,RU', '\r'),
(148, 'ME', 'MNE', 499, 'MJ', 'Montenegro', 'Podgorica', 14026, 666730, 'EU', '.me', 'EUR', 'Euro', '382', '#####', '^(d{5})$', 'sr,hu,bs,sq,hr,rom', 3194884, 'AL,HR,BA,RS,XK', '\r'),
(149, 'MS', 'MSR', 500, 'MH', 'Montserrat', 'Plymouth', 102, 9341, 'NA', '.ms', 'XCD', 'Dollar', '+1-664', '', '', 'en-MS', 3578097, '', '\r'),
(150, 'MA', 'MAR', 504, 'MO', 'Morocco', 'Rabat', 446550, 31627428, 'AF', '.ma', 'MAD', 'Dirham', '212', '#####', '^(d{5})$', 'ar-MA,fr', 2542007, 'DZ,EH,ES', '\r'),
(151, 'MZ', 'MOZ', 508, 'MZ', 'Mozambique', 'Maputo', 801590, 22061451, 'AF', '.mz', 'MZN', 'Metical', '258', '####', '^(d{4})$', 'pt-MZ,vmw', 1036973, 'ZW,TZ,SZ,ZA,ZM,MW', '\r'),
(152, 'MM', 'MMR', 104, 'BM', 'Myanmar', 'Nay Pyi Taw', 678500, 53414374, 'AS', '.mm', 'MMK', 'Kyat', '95', '#####', '^(d{5})$', 'my', 1327865, 'CN,LA,TH,BD,IN', '\r'),
(153, 'NA', 'NAM', 516, 'WA', 'Namibia', 'Windhoek', 825418, 2128471, 'AF', '.na', 'NAD', 'Dollar', '264', '', '', 'en-NA,af,de,hz,naq', 3355338, 'ZA,BW,ZM,AO', '\r'),
(154, 'NR', 'NRU', 520, 'NR', 'Nauru', 'Yaren', 21, 10065, 'OC', '.nr', 'AUD', 'Dollar', '674', '', '', 'na,en-NR', 2110425, '', '\r'),
(155, 'NP', 'NPL', 524, 'NP', 'Nepal', 'Kathmandu', 140800, 28951852, 'AS', '.np', 'NPR', 'Rupee', '977', '#####', '^(d{5})$', 'ne,en', 1282988, 'CN,IN', '\r'),
(156, 'NL', 'NLD', 528, 'NL', 'Netherlands', 'Amsterdam', 41526, 16645000, 'EU', '.nl', 'EUR', 'Euro', '31', '#### @@', '^(d{4}[A-Z]{2})$', 'nl-NL,fy-NL', 2750405, 'DE,BE', '\r'),
(157, 'AN', 'ANT', 530, 'NT', 'Netherlands Antilles', 'Willemstad', 960, 136197, 'NA', '.an', 'ANG', 'Guilder', '599', '', '', 'nl-AN,en,es', 0, 'GP', '\r'),
(158, 'NC', 'NCL', 540, 'NC', 'New Caledonia', 'Noumea', 19060, 216494, 'OC', '.nc', 'XPF', 'Franc', '687', '#####', '^(d{5})$', 'fr-NC', 2139685, '', '\r'),
(159, 'NZ', 'NZL', 554, 'NZ', 'New Zealand', 'Wellington', 268680, 4252277, 'OC', '.nz', 'NZD', 'Dollar', '64', '####', '^(d{4})$', 'en-NZ,mi', 2186224, '', '\r'),
(160, 'NI', 'NIC', 558, 'NU', 'Nicaragua', 'Managua', 129494, 5995928, 'NA', '.ni', 'NIO', 'Cordoba', '505', '###-###-#', '^(d{7})$', 'es-NI,en', 3617476, 'CR,HN', '\r'),
(161, 'NE', 'NER', 562, 'NG', 'Niger', 'Niamey', 1267000, 15878271, 'AF', '.ne', 'XOF', 'Franc', '227', '####', '^(d{4})$', 'fr-NE,ha,kr,dje', 2440476, 'TD,BJ,DZ,LY,BF,NG,ML', '\r'),
(162, 'NG', 'NGA', 566, 'NI', 'Nigeria', 'Abuja', 923768, 154000000, 'AF', '.ng', 'NGN', 'Naira', '234', '######', '^(d{6})$', 'en-NG,ha,yo,ig,ff', 2328926, 'TD,NE,BJ,CM', '\r'),
(163, 'NU', 'NIU', 570, 'NE', 'Niue', 'Alofi', 260, 2166, 'OC', '.nu', 'NZD', 'Dollar', '683', '', '', 'niu,en-NU', 4036232, '', '\r'),
(164, 'NF', 'NFK', 574, 'NF', 'Norfolk Island', 'Kingston', 34.6, 1828, 'OC', '.nf', 'AUD', 'Dollar', '672', '', '', 'en-NF', 2155115, '', '\r'),
(165, 'KP', 'PRK', 408, 'KN', 'North Korea', 'Pyongyang', 120540, 22912177, 'AS', '.kp', 'KPW', 'Won', '850', '###-###', '^(d{6})$', 'ko-KP', 1873107, 'CN,KR,RU', '\r'),
(166, 'MP', 'MNP', 580, 'CQ', 'Northern Mariana Islands', 'Saipan', 477, 53883, 'OC', '.mp', 'USD', 'Dollar', '+1-670', '', '', 'fil,tl,zh,ch-MP,en-MP', 4041468, '', '\r'),
(167, 'NO', 'NOR', 578, 'NO', 'Norway', 'Oslo', 324220, 4985870, 'EU', '.no', 'NOK', 'Krone', '47', '####', '^(d{4})$', 'no,nb,nn,se,fi', 3144096, 'FI,RU,SE', '\r'),
(168, 'OM', 'OMN', 512, 'MU', 'Oman', 'Muscat', 212460, 2967717, 'AS', '.om', 'OMR', 'Rial', '968', '###', '^(d{3})$', 'ar-OM,en,bal,ur', 286963, 'SA,YE,AE', '\r'),
(169, 'PK', 'PAK', 586, 'PK', 'Pakistan', 'Islamabad', 803940, 184404791, 'AS', '.pk', 'PKR', 'Rupee', '92', '#####', '^(d{5})$', 'ur-PK,en-PK,pa,sd,ps,brh', 1168579, 'CN,AF,IR,IN', '\r'),
(170, 'PW', 'PLW', 585, 'PS', 'Palau', 'Melekeok', 458, 19907, 'OC', '.pw', 'USD', 'Dollar', '680', '96940', '^(96940)$', 'pau,sov,en-PW,tox,ja,fil,zh', 1559582, '', '\r'),
(171, 'PS', 'PSE', 275, 'WE', 'Palestinian Territory', 'East Jerusalem', 5970, 3800000, 'AS', '.ps', 'ILS', 'Shekel', '970', '', '', 'ar-PS', 6254930, 'JO,IL', '\r'),
(172, 'PA', 'PAN', 591, 'PM', 'Panama', 'Panama City', 78200, 3410676, 'NA', '.pa', 'PAB', 'Balboa', '507', '', '', 'es-PA,en', 3703430, 'CR,CO', '\r'),
(173, 'PG', 'PNG', 598, 'PP', 'Papua New Guinea', 'Port Moresby', 462840, 6064515, 'OC', '.pg', 'PGK', 'Kina', '675', '###', '^(d{3})$', 'en-PG,ho,meu,tpi', 2088628, 'ID', '\r'),
(174, 'PY', 'PRY', 600, 'PA', 'Paraguay', 'Asuncion', 406750, 6375830, 'SA', '.py', 'PYG', 'Guarani', '595', '####', '^(d{4})$', 'es-PY,gn', 3437598, 'BO,BR,AR', '\r'),
(175, 'PE', 'PER', 604, 'PE', 'Peru', 'Lima', 1285220, 29907003, 'SA', '.pe', 'PEN', 'Sol', '51', '', '', 'es-PE,qu,ay', 3932488, 'EC,CL,BO,BR,CO', '\r'),
(176, 'PH', 'PHL', 608, 'RP', 'Philippines', 'Manila', 300000, 99900177, 'AS', '.ph', 'PHP', 'Peso', '63', '####', '^(d{4})$', 'tl,en-PH,fil', 1694008, '', '\r'),
(177, 'PN', 'PCN', 612, 'PC', 'Pitcairn', 'Adamstown', 47, 46, 'OC', '.pn', 'NZD', 'Dollar', '870', '', '', 'en-PN', 4030699, '', '\r'),
(178, 'PL', 'POL', 616, 'PL', 'Poland', 'Warsaw', 312685, 38500000, 'EU', '.pl', 'PLN', 'Zloty', '48', '##-###', '^(d{5})$', 'pl', 798544, 'DE,LT,SK,CZ,BY,UA,RU', '\r'),
(179, 'PT', 'PRT', 620, 'PO', 'Portugal', 'Lisbon', 92391, 10676000, 'EU', '.pt', 'EUR', 'Euro', '351', '####-###', '^(d{7})$', 'pt-PT,mwl', 2264397, 'ES', '\r'),
(180, 'PR', 'PRI', 630, 'RQ', 'Puerto Rico', 'San Juan', 9104, 3916632, 'NA', '.pr', 'USD', 'Dollar', '+1-787 and', '#####-####', '^(d{9})$', 'en-PR,es-PR', 4566966, '', '\r'),
(181, 'QA', 'QAT', 634, 'QA', 'Qatar', 'Doha', 11437, 840926, 'AS', '.qa', 'QAR', 'Rial', '974', '', '', 'ar-QA,es', 289688, 'SA', '\r'),
(182, 'CG', 'COG', 178, 'CF', 'Republic of the Congo', 'Brazzaville', 342000, 3039126, 'AF', '.cg', 'XAF', 'Franc', '242', '', '', 'fr-CG,kg,ln-CG', 2260494, 'CF,GA,CD,CM,AO', '\r'),
(183, 'RE', 'REU', 638, 'RE', 'Reunion', 'Saint-Denis', 2517, 776948, 'AF', '.re', 'EUR', 'Euro', '262', '#####', '^((97)|(98)(4|7|8)d{', 'fr-RE', 935317, '', '\r'),
(184, 'RO', 'ROU', 642, 'RO', 'Romania', 'Bucharest', 237500, 21959278, 'EU', '.ro', 'RON', 'Leu', '40', '######', '^(d{6})$', 'ro,hu,rom', 798549, 'MD,HU,UA,CS,BG,RS', '\r'),
(185, 'RU', 'RUS', 643, 'RS', 'Russia', 'Moscow', 17100000, 140702000, 'EU', '.ru', 'RUB', 'Ruble', '7', '######', '^(d{6})$', 'ru,tt,xal,cau,ady,kv,ce,tyv,cv,udm,tut,mns,bua,myv,mdf,chm,ba,inh,tut,kbd,krc,ava,sah,nog', 2017370, 'GE,CN,BY,UA,KZ,LV,PL', '\r'),
(186, 'RW', 'RWA', 646, 'RW', 'Rwanda', 'Kigali', 26338, 11055976, 'AF', '.rw', 'RWF', 'Franc', '250', '', '', 'rw,en-RW,fr-RW,sw', 49518, 'TZ,CD,BI,UG', '\r'),
(187, 'BL', 'BLM', 652, 'TB', 'Saint Barthelemy', 'Gustavia', 21, 8450, 'NA', '.gp', 'EUR', 'Euro', '590', '### ###', '', 'fr', 3578476, '', '\r'),
(188, 'SH', 'SHN', 654, 'SH', 'Saint Helena', 'Jamestown', 410, 7460, 'AF', '.sh', 'SHP', 'Pound', '290', 'STHL 1ZZ', '^(STHL1ZZ)$', 'en-SH', 3370751, '', '\r'),
(189, 'KN', 'KNA', 659, 'SC', 'Saint Kitts and Nevis', 'Basseterre', 261, 49898, 'NA', '.kn', 'XCD', 'Dollar', '+1-869', '', '', 'en-KN', 3575174, '', '\r'),
(190, 'LC', 'LCA', 662, 'ST', 'Saint Lucia', 'Castries', 616, 160922, 'NA', '.lc', 'XCD', 'Dollar', '+1-758', '', '', 'en-LC', 3576468, '', '\r'),
(191, 'MF', 'MAF', 663, 'RN', 'Saint Martin', 'Marigot', 53, 35925, 'NA', '.gp', 'EUR', 'Euro', '590', '### ###', '', 'fr', 3578421, 'SX', '\r'),
(192, 'PM', 'SPM', 666, 'SB', 'Saint Pierre and Miquelon', 'Saint-Pierre', 242, 7012, 'NA', '.pm', 'EUR', 'Euro', '508', '#####', '^(97500)$', 'fr-PM', 3424932, '', '\r'),
(193, 'VC', 'VCT', 670, 'VC', 'Saint Vincent and the Grenadines', 'Kingstown', 389, 104217, 'NA', '.vc', 'XCD', 'Dollar', '+1-784', '', '', 'en-VC,fr', 3577815, '', '\r'),
(194, 'WS', 'WSM', 882, 'WS', 'Samoa', 'Apia', 2944, 192001, 'OC', '.ws', 'WST', 'Tala', '685', '', '', 'sm,en-WS', 4034894, '', '\r'),
(195, 'SM', 'SMR', 674, 'SM', 'San Marino', 'San Marino', 61.2, 31477, 'EU', '.sm', 'EUR', 'Euro', '378', '4789#', '^(4789d)$', 'it-SM', 3168068, 'IT', '\r'),
(196, 'ST', 'STP', 678, 'TP', 'Sao Tome and Principe', 'Sao Tome', 1001, 175808, 'AF', '.st', 'STD', 'Dobra', '239', '', '', 'pt-ST', 2410758, '', '\r'),
(197, 'SA', 'SAU', 682, 'SA', 'Saudi Arabia', 'Riyadh', 1960582, 25731776, 'AS', '.sa', 'SAR', 'Rial', '966', '#####', '^(d{5})$', 'ar-SA', 102358, 'QA,OM,IQ,YE,JO,AE,KW', '\r'),
(198, 'SN', 'SEN', 686, 'SG', 'Senegal', 'Dakar', 196190, 12323252, 'AF', '.sn', 'XOF', 'Franc', '221', '#####', '^(d{5})$', 'fr-SN,wo,fuc,mnk', 2245662, 'GN,MR,GW,GM,ML', '\r'),
(199, 'RS', 'SRB', 688, 'RI', 'Serbia', 'Belgrade', 88361, 7344847, 'EU', '.rs', 'RSD', 'Dinar', '381', '######', '^(d{6})$', 'sr,hu,bs,rom', 6290252, 'AL,HU,MK,RO,HR,BA,BG', '\r'),
(200, 'CS', 'SCG', 891, 'YI', 'Serbia and Montenegro', 'Belgrade', 102350, 10829175, 'EU', '.cs', 'RSD', 'Dinar', '381', '#####', '^(d{5})$', 'cu,hu,sq,sr', 0, 'AL,HU,MK,RO,HR,BA,BG', '\r'),
(201, 'SC', 'SYC', 690, 'SE', 'Seychelles', 'Victoria', 455, 88340, 'AF', '.sc', 'SCR', 'Rupee', '248', '', '', 'en-SC,fr-SC', 241170, '', '\r'),
(202, 'SL', 'SLE', 694, 'SL', 'Sierra Leone', 'Freetown', 71740, 5245695, 'AF', '.sl', 'SLL', 'Leone', '232', '', '', 'en-SL,men,tem', 2403846, 'LR,GN', '\r'),
(203, 'SG', 'SGP', 702, 'SN', 'Singapore', 'Singapur', 692.7, 4701069, 'AS', '.sg', 'SGD', 'Dollar', '65', '######', '^(d{6})$', 'cmn,en-SG,ms-SG,ta-SG,zh-SG', 1880251, '', '\r'),
(204, 'SX', 'SXM', 534, 'NN', 'Sint Maarten', 'Philipsburg', 0, 37429, 'NA', '.sx', 'ANG', 'Guilder', '599', '', '', 'nl,en', 7609695, 'MF', '\r'),
(205, 'SK', 'SVK', 703, 'LO', 'Slovakia', 'Bratislava', 48845, 5455000, 'EU', '.sk', 'EUR', 'Euro', '421', '###  ##', '^(d{5})$', 'sk,hu', 3057568, 'PL,HU,CZ,UA,AT', '\r'),
(206, 'SI', 'SVN', 705, 'SI', 'Slovenia', 'Ljubljana', 20273, 2007000, 'EU', '.si', 'EUR', 'Euro', '386', 'SI- ####', '^(?:SI)*(d{4})$', 'sl,sh', 3190538, 'HU,IT,HR,AT', '\r'),
(207, 'SB', 'SLB', 90, 'BP', 'Solomon Islands', 'Honiara', 28450, 559198, 'OC', '.sb', 'SBD', 'Dollar', '677', '', '', 'en-SB,tpi', 2103350, '', '\r'),
(208, 'SO', 'SOM', 706, 'SO', 'Somalia', 'Mogadishu', 637657, 10112453, 'AF', '.so', 'SOS', 'Shilling', '252', '@@  #####', '^([A-Z]{2}d{5})$', 'so-SO,ar-SO,it,en-SO', 51537, 'ET,KE,DJ', '\r'),
(209, 'ZA', 'ZAF', 710, 'SF', 'South Africa', 'Pretoria', 1219912, 49000000, 'AF', '.za', 'ZAR', 'Rand', '27', '####', '^(d{4})$', 'zu,xh,af,nso,en-ZA,tn,st,ts,ss,ve,nr', 953987, 'ZW,SZ,MZ,BW,NA,LS', '\r'),
(210, 'GS', 'SGS', 239, 'SX', 'South Georgia and the South Sandwich Islands', 'Grytviken', 3903, 30, 'AN', '.gs', 'GBP', 'Pound', '', '', '', 'en', 3474415, '', '\r'),
(211, 'KR', 'KOR', 410, 'KS', 'South Korea', 'Seoul', 98480, 48422644, 'AS', '.kr', 'KRW', 'Won', '82', 'SEOUL ###-###', '^(?:SEOUL)*(d{6})$', 'ko-KR,en', 1835841, 'KP', '\r'),
(212, 'SS', 'SSD', 728, 'OD', 'South Sudan', 'Juba', 644329, 8260490, 'AF', '', 'SSP', 'Pound', '211', '', '', 'en', 7909807, 'CD,CF,ET,KE,SD,UG,', '\r'),
(213, 'ES', 'ESP', 724, 'SP', 'Spain', 'Madrid', 504782, 46505963, 'EU', '.es', 'EUR', 'Euro', '34', '#####', '^(d{5})$', 'es-ES,ca,gl,eu,oc', 2510769, 'AD,PT,GI,FR,MA', '\r'),
(214, 'LK', 'LKA', 144, 'CE', 'Sri Lanka', 'Colombo', 65610, 21513990, 'AS', '.lk', 'LKR', 'Rupee', '94', '#####', '^(d{5})$', 'si,ta,en', 1227603, '', '\r'),
(215, 'SD', 'SDN', 729, 'SU', 'Sudan', 'Khartoum', 1861484, 35000000, 'AF', '.sd', 'SDG', 'Pound', '249', '#####', '^(d{5})$', 'ar-SD,en,fia', 366755, 'SS,TD,EG,ET,ER,LY,CF', '\r'),
(216, 'SR', 'SUR', 740, 'NS', 'Suriname', 'Paramaribo', 163270, 492829, 'SA', '.sr', 'SRD', 'Dollar', '597', '', '', 'nl-SR,en,srn,hns,jv', 3382998, 'GY,BR,GF', '\r'),
(217, 'SJ', 'SJM', 744, 'SV', 'Svalbard and Jan Mayen', 'Longyearbyen', 62049, 2550, 'EU', '.sj', 'NOK', 'Krone', '47', '', '', 'no,ru', 607072, '', '\r'),
(218, 'SZ', 'SWZ', 748, 'WZ', 'Swaziland', 'Mbabane', 17363, 1354051, 'AF', '.sz', 'SZL', 'Lilangeni', '268', '@###', '^([A-Z]d{3})$', 'en-SZ,ss-SZ', 934841, 'ZA,MZ', '\r'),
(219, 'SE', 'SWE', 752, 'SW', 'Sweden', 'Stockholm', 449964, 9045000, 'EU', '.se', 'SEK', 'Krona', '46', 'SE-### ##', '^(?:SE)*(d{5})$', 'sv-SE,se,sma,fi-SE', 2661886, 'NO,FI', '\r'),
(220, 'CH', 'CHE', 756, 'SZ', 'Switzerland', 'Berne', 41290, 7581000, 'EU', '.ch', 'CHF', 'Franc', '41', '####', '^(d{4})$', 'de-CH,fr-CH,it-CH,rm', 2658434, 'DE,IT,LI,FR,AT', '\r'),
(221, 'SY', 'SYR', 760, 'SY', 'Syria', 'Damascus', 185180, 22198110, 'AS', '.sy', 'SYP', 'Pound', '963', '', '', 'ar-SY,ku,hy,arc,fr,en', 163843, 'IQ,JO,IL,TR,LB', '\r'),
(222, 'TW', 'TWN', 158, 'TW', 'Taiwan', 'Taipei', 35980, 22894384, 'AS', '.tw', 'TWD', 'Dollar', '886', '#####', '^(d{5})$', 'zh-TW,zh,nan,hak', 1668284, '', '\r'),
(223, 'TJ', 'TJK', 762, 'TI', 'Tajikistan', 'Dushanbe', 143100, 7487489, 'AS', '.tj', 'TJS', 'Somoni', '992', '######', '^(d{6})$', 'tg,ru', 1220409, 'CN,AF,KG,UZ', '\r'),
(224, 'TZ', 'TZA', 834, 'TZ', 'Tanzania', 'Dodoma', 945087, 41892895, 'AF', '.tz', 'TZS', 'Shilling', '255', '', '', 'sw-TZ,en,ar', 149590, 'MZ,KE,CD,RW,ZM,BI,UG', '\r'),
(225, 'TH', 'THA', 764, 'TH', 'Thailand', 'Bangkok', 514000, 67089500, 'AS', '.th', 'THB', 'Baht', '66', '#####', '^(d{5})$', 'th,en', 1605651, 'LA,MM,KH,MY', '\r'),
(226, 'TG', 'TGO', 768, 'TO', 'Togo', 'Lome', 56785, 6587239, 'AF', '.tg', 'XOF', 'Franc', '228', '', '', 'fr-TG,ee,hna,kbp,dag,ha', 2363686, 'BJ,GH,BF', '\r'),
(227, 'TK', 'TKL', 772, 'TL', 'Tokelau', '', 10, 1466, 'OC', '.tk', 'NZD', 'Dollar', '690', '', '', 'tkl,en-TK', 4031074, '', '\r'),
(228, 'TO', 'TON', 776, 'TN', 'Tonga', 'Nuku''alofa', 748, 122580, 'OC', '.to', 'TOP', 'Pa''anga', '676', '', '', 'to,en-TO', 4032283, '', '\r'),
(229, 'TT', 'TTO', 780, 'TD', 'Trinidad and Tobago', 'Port of Spain', 5128, 1228691, 'NA', '.tt', 'TTD', 'Dollar', '+1-868', '', '', 'en-TT,hns,fr,es,zh', 3573591, '', '\r'),
(230, 'TN', 'TUN', 788, 'TS', 'Tunisia', 'Tunis', 163610, 10589025, 'AF', '.tn', 'TND', 'Dinar', '216', '####', '^(d{4})$', 'ar-TN,fr', 2464461, 'DZ,LY', '\r'),
(231, 'TR', 'TUR', 792, 'TU', 'Turkey', 'Ankara', 780580, 77804122, 'AS', '.tr', 'TRY', 'Lira', '90', '#####', '^(d{5})$', 'tr-TR,ku,diq,az,av', 298795, 'SY,GE,IQ,IR,GR,AM,AZ', '\r'),
(232, 'TM', 'TKM', 795, 'TX', 'Turkmenistan', 'Ashgabat', 488100, 4940916, 'AS', '.tm', 'TMT', 'Manat', '993', '######', '^(d{6})$', 'tk,ru,uz', 1218197, 'AF,IR,UZ,KZ', '\r'),
(233, 'TC', 'TCA', 796, 'TK', 'Turks and Caicos Islands', 'Cockburn Town', 430, 20556, 'NA', '.tc', 'USD', 'Dollar', '+1-649', 'TKCA 1ZZ', '^(TKCA 1ZZ)$', 'en-TC', 3576916, '', '\r'),
(234, 'TV', 'TUV', 798, 'TV', 'Tuvalu', 'Funafuti', 26, 10472, 'OC', '.tv', 'AUD', 'Dollar', '688', '', '', 'tvl,en,sm,gil', 2110297, '', '\r'),
(235, 'VI', 'VIR', 850, 'VQ', 'U.S. Virgin Islands', 'Charlotte Amalie', 352, 108708, 'NA', '.vi', 'USD', 'Dollar', '+1-340', '', '', 'en-VI', 4796775, '', '\r'),
(236, 'UG', 'UGA', 800, 'UG', 'Uganda', 'Kampala', 236040, 33398682, 'AF', '.ug', 'UGX', 'Shilling', '256', '', '', 'en-UG,lg,sw,ar', 226074, 'TZ,KE,SS,CD,RW', '\r'),
(237, 'UA', 'UKR', 804, 'UP', 'Ukraine', 'Kiev', 603700, 45415596, 'EU', '.ua', 'UAH', 'Hryvnia', '380', '#####', '^(d{5})$', 'uk,ru-UA,rom,pl,hu', 690791, 'PL,MD,HU,SK,BY,RO,RU', '\r'),
(238, 'AE', 'ARE', 784, 'AE', 'United Arab Emirates', 'Abu Dhabi', 82880, 4975593, 'AS', '.ae', 'AED', 'Dirham', '971', '', '', 'ar-AE,fa,en,hi,ur', 290557, 'SA,OM', '\r'),
(239, 'GB', 'GBR', 826, 'UK', 'United Kingdom', 'London', 244820, 62348447, 'EU', '.uk', 'GBP', 'Pound', '44', '@# #@@|@## #@@|@@# #', '^(([A-Z]d{2}[A-Z]{2}', 'en-GB,cy-GB,gd', 2635167, 'IE', '\r'),
(240, 'US', 'USA', 840, 'US', 'United States', 'Washington', 9629091, 310232863, 'NA', '.us', 'USD', 'Dollar', '1', '#####-####', '^(d{9})$', 'en-US,es-US,haw,fr', 6252001, 'CA,MX,CU', '\r'),
(241, 'UM', 'UMI', 581, '', 'United States Minor Outlying Islands', '', 0, 0, 'OC', '.um', 'USD', 'Dollar', '1', '', '', 'en-UM', 5854968, '', '\r'),
(242, 'UY', 'URY', 858, 'UY', 'Uruguay', 'Montevideo', 176220, 3477000, 'SA', '.uy', 'UYU', 'Peso', '598', '#####', '^(d{5})$', 'es-UY', 3439705, 'BR,AR', '\r'),
(243, 'UZ', 'UZB', 860, 'UZ', 'Uzbekistan', 'Tashkent', 447400, 27865738, 'AS', '.uz', 'UZS', 'Som', '998', '######', '^(d{6})$', 'uz,ru,tg', 1512440, 'TM,AF,KG,TJ,KZ', '\r'),
(244, 'VU', 'VUT', 548, 'NH', 'Vanuatu', 'Port Vila', 12200, 221552, 'OC', '.vu', 'VUV', 'Vatu', '678', '', '', 'bi,en-VU,fr-VU', 2134431, '', '\r'),
(245, 'VA', 'VAT', 336, 'VT', 'Vatican', 'Vatican City', 0.44, 921, 'EU', '.va', 'EUR', 'Euro', '379', '', '', 'la,it,fr', 3164670, 'IT', '\r'),
(246, 'VE', 'VEN', 862, 'VE', 'Venezuela', 'Caracas', 912050, 27223228, 'SA', '.ve', 'VEF', 'Bolivar', '58', '####', '^(d{4})$', 'es-VE', 3625428, 'GY,BR,CO', '\r'),
(247, 'VN', 'VNM', 704, 'VM', 'Vietnam', 'Hanoi', 329560, 89571130, 'AS', '.vn', 'VND', 'Dong', '84', '######', '^(d{6})$', 'vi,en,fr,zh,km', 1562822, 'CN,LA,KH', '\r'),
(248, 'WF', 'WLF', 876, 'WF', 'Wallis and Futuna', 'Mata Utu', 274, 16025, 'OC', '.wf', 'XPF', 'Franc', '681', '#####', '^(986d{2})$', 'wls,fud,fr-WF', 4034749, '', '\r'),
(249, 'EH', 'ESH', 732, 'WI', 'Western Sahara', 'El-Aaiun', 266000, 273008, 'AF', '.eh', 'MAD', 'Dirham', '212', '', '', 'ar,mey', 2461445, 'DZ,MR,MA', '\r'),
(250, 'YE', 'YEM', 887, 'YM', 'Yemen', 'Sanaa', 527970, 23495361, 'AS', '.ye', 'YER', 'Rial', '967', '', '', 'ar-YE', 69543, 'SA,OM', '\r'),
(251, 'ZM', 'ZMB', 894, 'ZA', 'Zambia', 'Lusaka', 752614, 13460305, 'AF', '.zm', 'ZMK', 'Kwacha', '260', '#####', '^(d{5})$', 'en-ZM,bem,loz,lun,lue,ny,toi', 895949, 'ZW,TZ,MZ,CD,NA,MW,AO', '\r'),
(252, 'ZW', 'ZWE', 716, 'ZI', 'Zimbabwe', 'Harare', 390580, 11651858, 'AF', '.zw', 'ZWL', 'Dollar', '263', '', '', 'en-ZW,sn,nr,nd', 878675, 'ZA,MZ,BW,ZM', '\r');

-- --------------------------------------------------------

--
-- Table structure for table `credit_scores`
--

DROP TABLE IF EXISTS `credit_scores`;
CREATE TABLE IF NOT EXISTS `credit_scores` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `interest_rate` double(10,2) NOT NULL,
  `suggested_interest_rate` double(10,2) NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_scores`
--

INSERT INTO `credit_scores` (`id`, `created`, `modified`, `name`, `interest_rate`, `suggested_interest_rate`, `is_approved`) VALUES
(1, '2013-03-27 17:41:44', '2013-03-27 17:41:44', 'A+', 6.00, 8.00, 1),
(2, '2013-03-27 17:41:44', '2013-03-27 17:41:44', 'A', 8.00, 10.00, 1),
(3, '2013-03-27 17:41:44', '2013-03-27 17:41:44', 'B', 10.00, 12.00, 1),
(4, '2013-03-27 17:41:44', '2013-03-27 17:41:44', 'C', 16.00, 18.00, 1),
(5, '2013-03-27 17:41:44', '2013-03-27 17:41:44', 'Y', 20.00, 22.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donate_project_categories`
--

DROP TABLE IF EXISTS `donate_project_categories`;
CREATE TABLE IF NOT EXISTS `donate_project_categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(265) collate utf8_unicode_ci default NULL,
  `donate_count` bigint(20) unsigned NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donate_project_categories`
--

INSERT INTO `donate_project_categories` (`id`, `created`, `modified`, `name`, `slug`, `donate_count`, `is_approved`) VALUES
(1, '2010-09-16 20:44:19', '2012-05-08 06:16:47', 'Educational Trust', 'educational_trust', 0, 1),
(2, '2010-09-16 20:53:02', '2011-10-05 11:53:32', 'Handicapped Rehabilitation', 'handicapped_rehabilitation', 0, 1),
(3, '2010-09-16 20:53:15', '2010-09-16 20:53:17', 'Health Care', 'health_care', 0, 1),
(4, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Rural Development', 'rural_development', 0, 1),
(5, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Agricultural Development', 'agricultural_development', 0, 1),
(6, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Worship Development', 'worship_development', 0, 1),
(7, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Sports Charity', 'sports_charity', 0, 1),
(10, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Food Corporation', 'food_corporation', 0, 1),
(14, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Music Academy', 'music_academy', 0, 1),
(19, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Other', 'other', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donate_project_statuses`
--

DROP TABLE IF EXISTS `donate_project_statuses`;
CREATE TABLE IF NOT EXISTS `donate_project_statuses` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `donate_count` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `message` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `is_active` (`is_active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `donate_project_statuses`
--

INSERT INTO `donate_project_statuses` (`id`, `created`, `modified`, `name`, `donate_count`, `is_active`, `message`) VALUES
(1, '2010-10-14 13:42:28', '2010-10-14 13:42:31', 'Pending', 0, 1, 'New ##PROJECT## posted by ##PROJECT_OWNER_NAME##'),
(2, '2010-10-14 13:42:43', '2011-03-21 02:47:54', 'Open for donating', 0, 1, 'Open for donating'),
(3, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Donation closed and paid to project owner', 0, 1, 'Donation closed'),
(4, '0000-00-00 00:00:00', '2011-06-22 05:23:45', 'Open for voting', 0, 1, '##PROJECT## open for voting'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Project Expired', 0, 1, 'Project Expired');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

DROP TABLE IF EXISTS `educations`;
CREATE TABLE IF NOT EXISTS `educations` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `education` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `created`, `modified`, `education`, `is_active`) VALUES
(1, '2010-11-23 19:46:37', '2011-09-30 11:44:36', 'Some high school', 1),
(2, '2010-11-23 19:46:57', '2010-11-23 19:47:00', 'High school graduate or equivalent', 1),
(3, '2010-11-23 19:47:27', '2010-11-23 19:47:30', 'Trade or vocational degree', 1),
(4, '2010-11-23 19:47:44', '2010-11-23 19:47:47', 'Some college', 1),
(5, '2010-11-23 19:47:59', '2010-11-23 19:48:01', 'Associate degree', 1),
(6, '2010-11-23 19:48:03', '2010-11-23 19:48:06', 'Bachelor''s degree', 1),
(7, '2010-11-23 19:48:34', '2010-11-23 19:48:36', 'Graduate or professional degree', 1),
(8, '2010-11-23 19:49:02', '2010-11-23 19:49:05', 'Prefer not to share', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `from` varchar(500) collate utf8_unicode_ci default NULL,
  `reply_to` varchar(500) collate utf8_unicode_ci default NULL,
  `name` varchar(150) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  `email_text_content` text collate utf8_unicode_ci,
  `email_html_content` text collate utf8_unicode_ci,
  `email_variables` varchar(1000) collate utf8_unicode_ci default NULL,
  `is_html` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Email Templates';

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_text_content`, `email_html_content`, `email_variables`, `is_html`) VALUES
(1, '2009-02-20 10:24:49', '2013-05-27 06:30:26', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Forgot Password', 'we will send this mail, when user submit the forgot password form.', 'Forgot password', 'Dear ##USERNAME##,  \n\nA password reset request has been made for your user account at ##SITE_NAME##.  If you made this request, please click on the following link:  ##RESET_URL##  \nIf you did not request this action and feel this is an error, please contact us ##SUPPORT_EMAIL##  \n\nThanks, \n##SITE_NAME## ##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n	<table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">A password reset request has been made for your user account at ##SITE_NAME##.  If you made this request, please click on the following link:  ##RESET_URL##  \r\n</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">If you did not request this action and feel this is an error, please contact us ##SUPPORT_EMAIL## \r\n</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'USERNAME, RESET_URL, SITE_NAME, SITE_URL', 0),
(2, '2009-02-20 10:15:57', '2013-05-27 06:39:46', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Activation Request', 'we will send this mail, when user registering an account he/she will get an activation request.', 'Please activate your ##SITE_NAME## account', 'Dear ##USERNAME##,\n\nYour account has been created. \nPlease visit the following URL to activate your account.\n##ACTIVATION_URL##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your account has been created.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td width="27%"><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please visit the following URL to activate your account.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> ##ACTIVATION_URL##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME, USERNAME, ACTIVATION_URL, SITE_URL', 0),
(3, '2009-02-20 10:15:19', '2013-05-27 06:43:42', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New User Join', 'we will send this mail to admin, when a new user registered in the site. For this you have to enable "admin mail after register" in the settings page.', '[##SITE_NAME##] New user joined', 'Hi,\n\nA new user named "##USERNAME##" has joined in ##SITE_NAME##.\n\nUsername: ##USERNAME##\nEmail: ##USEREMAIL##\nSignup IP: ##SIGNUPIP##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">A new user named "##USERNAME##" has joined in ##SITE_NAME##.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td width="27%"><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Username: ##USERNAME##</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> Email: ##USEREMAIL##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> Signup IP: ##SIGNUPIP##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_URL##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME,USERNAME, SITE_URL,USEREMAIL,SIGNUPIP', 0),
(22, '0000-00-00 00:00:00', '2013-05-27 06:49:09', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Change Status Alert', 'we will send this when a project status change.', '[##SITE_NAME##][##PROJECT##] Status: ##PREVIOUS_STATUS## -> ##CURRENT_STATUS##', 'Hi,\n\nStatus was changed for project "##PROJECT##".\n\nStatus: ##PREVIOUS_STATUS## -> ##CURRENT_STATUS##\n\nPlease click the following link to view the project,\n##PROJECT_URL##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Status was changed for project "##PROJECT##".</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td width="27%"><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Status: ##PREVIOUS_STATUS## -> ##CURRENT_STATUS##</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> Please click the following link to view the project,</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##PROJECT_URL##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'PREVIOUS_STATUS,CURRENT_STATUS,PROJECT,PROJECT_URL,SITE_NAME,SITE_URL', 0),
(4, '2009-03-02 00:00:00', '2013-05-27 06:51:57', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Add', 'we will send this mail to user, when a admin add a new user.', 'Welcome to ##SITE_NAME##', 'Dear ##USERNAME##,\n\n##SITE_NAME## team added you as a user in ##SITE_NAME##.\n\nYour account details.\n##LOGINLABEL##:##USEDTOLOGIN##\nPassword:##PASSWORD##\n\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##SITE_NAME## team added you as a user in ##SITE_NAME##.\r\n\r\n\r\n\r\n\r\n</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td width="27%"><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your account details.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> ##LOGINLABEL##:##USEDTOLOGIN##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Password:##PASSWORD##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME, USERNAME, PASSWORD, LOGINLABEL, USEDTOLOGIN, SITE_URL', 0),
(5, '2009-05-22 16:51:14', '2013-05-27 06:53:02', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Welcome Email', 'we will send this mail, when user register in this site and get activate.', 'Welcome to ##SITE_NAME##', 'Dear ##USERNAME##,\n\nWe wish to say a quick hello and thanks for registering at ##SITE_NAME##.\n\nIf you did not request this account and feel this is an error, please\ncontact us at ##CONTACT_MAIL##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">We wish to say a quick hello and thanks for registering at ##SITE_NAME##.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td width="27%"><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">If you did not request this account and feel this is an error, please\r\ncontact us at ##CONTACT_MAIL##.</p></td>\r\n                </tr>\r\n                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME, SITE_URL, USERNAME, SUPPORT_EMAIL', 0),
(7, '2009-05-22 16:45:38', '2010-12-27 13:18:47', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Active ', 'We will send this mail to user, when user active   \r\nby administator.', 'Your ##SITE_NAME## account has been activated', 'Dear ##USERNAME##,\n\nYour account has been activated.\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your account has been activated.</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME,USERNAME, SITE_URL', 0),
(8, '2009-05-22 16:48:38', '2010-12-27 13:19:06', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Deactivate', 'We will send this mail to user, when user deactive by administator.', 'Your ##SITE_NAME## account has been deactivated', 'Dear ##USERNAME##,\n\nYour ##SITE_NAME## account has been deactivated.\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your account has been deactivated.</p></td>\r\n                </tr>                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME,USERNAME, SITE_URL', 0),
(9, '2009-05-22 16:50:25', '2013-05-27 08:20:21', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Delete', 'We will send this mail to user, when user delete by administrator.', 'Your ##SITE_NAME## account has been removed', 'Dear ##USERNAME##,\n\nYour ##SITE_NAME## account has been removed.\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your ##SITE_NAME## account has been removed.</p></td>\r\n                </tr>                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'SITE_NAME,USERNAME, SITE_URL', 0);
INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_text_content`, `email_html_content`, `email_variables`, `is_html`) VALUES
(10, '2009-07-07 15:47:09', '2009-09-30 10:10:42', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin Change Password', 'we will send this mail to user, when admin change user''s password.', 'Password changed', 'Hi ##USERNAME##,\r\n\r\nAdmin reset your password for your  ##SITE_NAME## account.\r\n\r\nYour new password: ##PASSWORD##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>Admin Change Password</title>\r\n<style type="text/css">\r\n @import url(http://fonts.googleapis.com/css?family=Open+Sans);\r\n</style>\r\n<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n</head>\r\n\r\n<body>\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Admin reset your password for your  ##SITE_NAME## account.</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your new password: ##PASSWORD##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n\r\n</body>\r\n</html>\r\n', 'SITE_NAME,PASSWORD,USERNAME, SITE_URL', 0),
(11, '2009-10-14 18:31:14', '2013-05-25 14:45:48', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Contact Us', 'We will send this mail to admin, when user submit any contact form.', '[##SITE_NAME##] ##SUBJECT##', '##MESSAGE##\n\n----------------------------------------------------\nTelephone    : ##TELEPHONE##\nIP           : ##IP##, ##SITE_ADDR##\nWhois        : http://whois.sc/##IP##\nURL          : ##FROM_URL##\n----------------------------------------------------\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">##MESSAGE##</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Telephone    : ##TELEPHONE##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">IP           : ##IP##, ##SITE_ADDR##</p></td>\r\n                </tr><tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Whois        : http://whois.sc/##IP##</p></td>\r\n                </tr><tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">URL          : ##FROM_URL##</p></td>\r\n                </tr>                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'FROM_URL, IP, TELEPHONE, MESSAGE, SITE_NAME, SUBJECT, FROM_EMAIL, LAST_NAME, FIRST_NAME', 0),
(12, '2009-10-14 19:20:59', '2010-12-27 13:21:22', '##CONTACT_FROM_EMAIL##', '', 'Contact Us Auto Reply', 'we will send this mail ti user, when user submit the contact us form.', 'RE: ##SUBJECT##', 'Dear ##FIRST_NAME####LAST_NAME##,\r\n\r\nThanks for contacting us. We''ll get back to you shortly.\r\n\r\nPlease do not reply to this automated response. If you have not contacted us and if you feel this is an error, please contact us through our site ##CONTACT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##\r\n\r\n------ On ##POST_DATE## you wrote from ##IP## -----\r\n\r\n##MESSAGE##\r\n', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Thanks for contacting us. We''ll get back to you shortly.</p>\r\n           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please do not reply to this automated response. If you have not contacted us and if you feel this is an error, please contact us through our site ##CONTACT_URL##\r\n</p></td>\r\n                </tr>\r\n	\r\n                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'MESSAGE, POST_DATE, SITE_NAME, CONTACT_URL, FIRST_NAME, LAST_NAME, SUBJECT, SITE_URL', 0),
(18, '2010-10-08 14:21:30', '2010-12-28 06:20:16', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Update Alert', 'This is sent to followers when an update is added to a project.', '[##PROJECT##] Project updates posted', 'Dear ##USERNAME##,\r\n\r\nA new update "##BLOG_TITLE##" has been posted to the project ##PROJECT##.\r\n\r\nPlease click the following link to view the update,\r\n##BLOG_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">A new update "##BLOG_TITLE##" has been posted to the project ##PROJECT##.</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the update,</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##BLOG_URL##</p></td>\r\n                </tr>  \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'USERNAME, PROJECT, SITE_NAME, SITE_URL,BLOG_TITLE,BLOG_URL', 0),
(19, '2010-10-08 14:25:32', '2010-12-28 06:31:34', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Update Comment Alert', 'This is sent to follower when a comment is added to update on his project.', '[##PROJECT##] Comment added to project update', 'Dear ##USERNAME##,\r\n\r\n##COMMENTED_USER## has commented on update "##BLOG_TITLE##" in the project ##PROJECT##.\r\n\r\nPlease click the following link to view the comment,\r\n##BLOG_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##</p>,        \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##COMMENTED_USER## has commented on update "##BLOG_TITLE##" in the project ##PROJECT##.   </p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the comment,</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##BLOG_URL##</p></td>\r\n                </tr>\r\n	\r\n                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'USERNAME, USER, PROJECT, SITE_NAME, SITE_URL,BLOG_TITLE,BLOG_URL', 0),
(20, '2010-10-08 15:02:07', '2010-12-27 13:25:21', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Comment Alert', 'This is sent to followers when a new comment is added to a project.', '[##PROJECT##] Comment added to project', 'Dear ##USERNAME##,\r\n\r\n##COMMENTED_USER## has commented on the project ##PROJECT##.\r\n\r\nPlease click the following link to view the comment,\r\n##PROJECT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">##COMMENTED_USER## has commented on the project ##PROJECT##.</p>\r\n           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the comment,\r\n##PROJECT_URL##\r\n</p></td>\r\n                </tr>\r\n	\r\n                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'USERNAME, COMMENTED_USER,  PROJECT, SITE_NAME, SITE_URL', 0),
(21, '2010-11-12 19:54:29', '2010-12-28 04:48:43', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New Fund Alert', 'When new fund was made, an internal message will be sent to the followers of the project.', '[##SITE_NAME##][##PROJECT##] New fund has been received', 'Dear ##USERNAME##,\r\n\r\nNew fund has been received for project ##PROJECT##.\r\nBacker: ##BACKER##\r\nAmount: ##AMOUNT##\r\n\r\nPlease click the following link to view the project,\r\n##PROJECT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL## ', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">New fund has been received for project ##PROJECT##.</p></td>\r\n                </tr>	\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Backer: ##BACKER##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Amount: ##AMOUNT##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the project,##PROJECT_URL##</p></td>\r\n                </tr>\r\n	</tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'USERNAME,BACKER,PROJECT,PROJECT_URL:,AMOUNT', 0),
(28, '2010-12-06 18:20:07', '2010-12-27 13:26:38', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New Message', 'we will send this mail, when a user get new message', '##USERNAME## sent you a message on ##SITE_NAME##', 'Dear ##OTHERUSERNAME##,\n\n##USERNAME## sent you a message.\n\nTo reply to this message, follow the link below:\n##MESSAGE_LINK##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##OTHERUSERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##USERNAME## sent you a message.</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">To reply to this message, follow the link below:##MESSAGE_LINK##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'USERNAME,MESSAGE,MESSAGE_LINK,SITE_NAME,OTHERUSERNAME,SITE_URL', 0),
(26, '2010-12-06 18:20:07', '2010-12-27 11:28:51', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project refund notification', 'we will send this mail, when a refund to backer', '[##PROJECT_NAME##] Project amount  authorization  canceled', 'Dear ##USERNAME##,\r\n\r\nYour pledged amount ##AMOUNT## for the project "##PROJECT_NAME##" has been refunded and credited to your wallet.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your pledged amount ##AMOUNT## for the project "##PROJECT_NAME##" has been refunded and credited to your wallet.</p></td>\r\n                </tr>	                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'PROJECT_NAME,SITE_NAME,SITE_URL,USER_NAME', 0);
INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_text_content`, `email_html_content`, `email_variables`, `is_html`) VALUES
(24, '2010-12-06 18:20:07', '2010-12-27 13:09:43', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Fund Canceled Alert', 'we will send this mail, when canceled a project fund', '[##PROJECT##] Project fund canceled', 'Dear ##USERNAME##,\r\n\r\n##BACKER## fund for the "##PROJECT##" project was canceled.\r\n\r\nPlease click the following link to view the project,##PROJECT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>            \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##BACKER## fund for the "##PROJECT##" project was canceled.</p></td>\r\n                </tr>\r\n	<tr>\r\n	<td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the project,##PROJECT_URL##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'PROJECTE,SITE_NAME,SITE_URL,USERNAME', 0),
(29, '2010-12-14 17:50:54', '2010-12-27 13:28:01', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New Project', 'we will send this when a new projecct is added.', 'New project added - ##PROJECT_NAME##', 'Dear Admin,\n\nNew project added.\n\nProject Name: ##PROJECT_NAME##\nCategory: ##CATEGORY##\nCreated by: ##USERNAME##\nURL: ##PROJECT_URL##\nNeeded Amount: ##AMOUNT##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear Admin,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">New project added.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Project Name: ##PROJECT_NAME##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> Category: ##CATEGORY##</p></td>\r\n                </tr><tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Created by: ##USERNAME##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">URL: ##PROJECT_URL##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Needed Amount: ##AMOUNT##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'PROJECT_NAME,CATEGORY,USERNAME,PROJECT_URL,AMOUNT,SITE_NAME,SITE_URL', 0),
(25, '2010-10-08 15:02:07', '2010-12-27 13:25:21', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Follower Alert', 'This is sent to followers when a new follower for project.', '[##PROJECT##] New follower for project', 'Dear ##USERNAME##,\r\n\r\n##FOLLOWED_USER## has followed the project ##PROJECT##.\r\n\r\nPlease click the following link to view the project,\r\n##PROJECT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##FOLLOWED_USER## has followed the project ##PROJECT##.</p></td>\r\n                </tr>\r\n	<tr>\r\n	<td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the project,##PROJECT_URL##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'USERNAME, PROJECT, SITE_NAME, SITE_URL', 0),
(6, '2010-12-14 17:50:54', '2012-06-13 07:29:38', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Membership Fee', 'Pay Membership Fee', '[##SITE_NAME##] Pay Membership Fee', 'Dear ##USERNAME##, \r\n       You have successfully registered with our site ##SITE_NAME##. Please pay your membership fee for activate your account. \r\n\r\nURL: ##MEMBERSHIP_URL## \r\n\r\nNote: If you paid membership fee then please ignore this email.Thanks for sign up with us. \r\n\r\nThanks, \r\n##SITE_NAME## \r\n##SITE_URL## ', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">You have successfully registered with our site ##SITE_NAME##. Please pay your membership fee for activate your account. \r\n	  </p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">URL: ##MEMBERSHIP_URL## </p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Note: If you paid membership fee then please ignore this email.Thanks for sign up with us. </p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'USERNAME,MEMBERSHIP_URL,SITE_NAME,SITE_URL', 0),
(23, '2010-10-08 14:35:52', '2010-12-28 06:27:54', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Voting Alert', 'This is sent to followers when rating is added to a project.', '[##PROJECT##] Voting added to project', 'Dear ##USERNAME##,\r\n\r\n##VOTED_USER## has voted on the project ##PROJECT##.\r\n\r\nPlease click the following link to view the project,\r\n##PROJECT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##VOTED_USER## has voted on the project ##PROJECT##.</p></td>\r\n                </tr>\r\n	<tr>\r\n	<td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the project,##PROJECT_URL##</p></td>\r\n                </tr>                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'USERNAME, PROJECT, SITE_NAME, SITE_URL', 0),
(13, '2012-07-27 15:17:04', '2012-07-27 15:17:07', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Failed Forgot Password', 'we will send this mail, when user submit the forgot password form.', 'Forgot password request failed', 'Hi there,\r\n\r\nYou (or someone else) entered this email address when trying to change the password of an ##user_email## account.\r\n\r\nHowever, this email address is not in our registered users and therefore the attempted password request has failed. If you are our customer and were expecting this email, please try again using the email you gave when opening your account.\r\n\r\nIf you are not an ##SITE_NAME## customer, please ignore this email. If you did not request this action and feel this is an error, please contact us ##SUPPORT_EMAIL##.\r\n\r\nThanks, \r\n##SITE_NAME## \r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi there,</p>\r\n           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">You (or someone else) entered this email address when trying to change the password of an ##user_email## account.</p></td>\r\n                </tr>\r\n	 <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">\r\nHowever, this email address is not in our registered users and therefore the attempted password request has failed. If you are our customer and were expecting this email, please try again using the email you gave when opening your account.</p></td>\r\n	</tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">If you are not an ##SITE_NAME## customer, please ignore this email. If you did not request this action and feel this is an error, please contact us </p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'CONTENT,SITE_NAME, SITE_URL', 0),
(14, '2012-07-30 10:30:44', '2012-07-30 10:30:48', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Password changed', 'we will send this mail, when user changed his password.', 'Password changed', 'Dear ##USERNAME##, \r\n\r\nSuccessfully you have changed your password at ##SITE_NAME##. If you did not request this action, please contact us ##SUPPORT_EMAIL## \r\n\r\nThanks, \r\n##SITE_NAME## \r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Successfully you have changed your password at ##SITE_NAME##. If you did not request this action, please contact us ##SUPPORT_EMAIL## </p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'USERNAME, RESET_URL, SITE_NAME, SITE_URL', 0),
(15, '2012-07-30 10:30:44', '2012-07-30 10:30:44', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Failed Social User', 'we will send this mail, when user submit the forgot password form and the user users social network websites like twitter, facebook to register.', 'Forgot password request failed', 'Hi ##USERNAME##, \r\n\r\nYour forgot password request was failed because you have registered via ##OTHER_SITE## site.\r\n\r\nThanks, \r\n##SITE_NAME## \r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your forgot password request was failed because you have registered via ##OTHER_SITE## site.</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', 'CONTENT,SITE_NAME, SITE_URL,OTHER_SITE', 0),
(30, '2012-09-05 15:44:58', '2014-02-03 12:08:58', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Invite User', 'we will send this mail to invite user for private beta.', 'Welcome to ##SITE_NAME##', 'Dear Subscriber,\n\n##SITE_NAME## team want to add you as a user in ##SITE_NAME##.Click the below link to join us...\n##INVITE_LINK##\n\nInvite Code: ##INVITE_CODE##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\n-moz-border-radius: 10px;\nborder-radius: 10px;">\n  <table cellspacing="0" cellpadding="0" width="720px">\n    <tbody>\n      <tr>\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\n      </tr>\n    </tbody>\n  </table>\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \n\n min-height: 70px;">\n<table cellspacing="0" cellpadding="0" width="700">\n<tbody>\n<tr>\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\n</tr>\n</tbody>\n</table>\n</div>\n  \n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\n    <table style="background-color: #ffffff;" width="100%">\n      <tbody>\n        \n        <tr>\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear Subscriber,</p>            \n            <table border="0" width="100%">\n              <tbody>	  \n                <tr>\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##SITE_NAME## team want to add you as a user in ##SITE_NAME##.Click the below link to join us...##INVITE_LINK##</p></td>\n                </tr>				\n				<tr>\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Invite Code: ##INVITE_CODE##</p></td>\n                </tr>\n              </tbody>\n            </table>\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\n        </tr>\n        <tr>\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\n            </div></td>\n        </tr>\n      </tbody>\n    </table>\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\n      <tbody>\n        <tr>\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\n        </tr>\n      </tbody>\n    </table>\n  </div>\n  <table cellspacing="0" cellpadding="0" width="720px">\n    <tbody>\n      <tr>\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\n      </tr>\n    </tbody>\n  </table>\n</div>', 'SITE_NAME, SITE_URL,INVITE_LINK,', 0);
INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_text_content`, `email_html_content`, `email_variables`, `is_html`) VALUES
(16, '2012-09-05 15:44:58', '2014-03-15 11:26:09', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Launch mail', 'we will send this mail to inform user that the site launched.', ' ##SITE_NAME## Launched', 'Dear Subscriber,\r\n\r\n##SITE_NAME##  Launched.\r\n##SITE_NAME## team want to add you as a user in ##SITE_NAME##.Click the below link to join us...\r\n##INVITE_LINK##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear Subscriber,</p>     \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##SITE_NAME##  Launched.<br> ##SITE_NAME## team want to add you as a user in ##SITE_NAME##.Click the below link to join us...<br>##INVITE_LINK##</p></td>\r\n                </tr>                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'SITE_NAME, SITE_URL,INVITE_LINK,', 0),
(17, '2012-09-05 15:44:58', '2012-09-05 15:45:01', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Private Beta mail', 'we will send this mail to inform user that the site move to Private Beta.', '##SITE_NAME## moved to Private Beta', 'Dear Subscriber,\n\n##SITE_NAME##  moved to Private Beta, Click the below link to join us...\n##INVITE_LINK##\n\nInvite Code: ##INVITE_CODE##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear Subscriber,</p>  \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##SITE_NAME##  moved to Private Beta, Click the below link to join us...##INVITE_LINK##</p></td>\r\n                </tr>              \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'SITE_NAME, SITE_URL,INVITE_LINK,', 0),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Follow Email', 'we will send this mail to users, when a user followed by them add a project or funded for a project or followed a project', '##FOLLOWED_USER## ##ACTION## the project ##PROJECT_NAME##', 'Hi ##USER##,\r\n    \r\n##FOLLOWED_USER## has ##ACTION## the  project ##PROJECT_NAME##.\r\n\r\nPlease click the following link to view the project\r\n##PROJECT##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi ##USER##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##FOLLOWED_USER## has ##ACTION## the  project ##PROJECT_NAME##.</p></td>\r\n                </tr>\r\n	 <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please click the following link to view the project ##PROJECT##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'FOLLOWED_USER, ACTTION, PROJECT, USER', 0),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Invite New User', 'we will send this mail to invite user by other user', 'Welcome to ##SITE_NAME##', 'Dear ##USER_NAME##,\r\n\r\n##OTHER_USER_NAME## has invited you to the site ##SITE_NAME## (##INVITE_LINK##)\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>\r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">##OTHER_USER_NAME## has invited you to the site ##SITE_NAME## (##INVITE_LINK##)</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>\r\n', '##USER_NAME##,##OTHER_USER_NAME##, ##SITE_NAME##,##SITE_URL##', 0),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Invite Friend', 'we will send this mail to invite friend for private beta.', 'Welcome to ##SITE_NAME##', 'Dear Subscriber,\n\nYour friend ##USER_NAME## has invited you to join ##SITE_NAME##. Click the below link to join us...\n##INVITE_LINK##\n\nInvite Code: ##INVITE_CODE##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear Subscriber,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your friend ##USER_NAME## has invited you to join ##SITE_NAME##. Click the below link to join us...##INVITE_LINK##</p></td>\r\n                </tr>\r\n	 <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please Invite Code: ##INVITE_CODE##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'SITE_NAME, SITE_URL,INVITE_LINK,', 0),
(34, '2013-04-05 14:58:07', '2013-04-05 14:58:09', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Repayment Notification', 'we will send this mail to remind repayment date.', '[##SITE_NAME##] Repayment Notification', 'Hi ##USERNAME##,\r\n\r\n Your payment due date for ##PROJECT## is on ##DATE##.\r\n\r\nAmount: ##AMOUNT##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your payment due date for ##PROJECT## is on ##DATE##.</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Amount: ##AMOUNT##</p></td>\r\n                </tr>\r\n	\r\n                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'SITE_NAME,USERNAME, SITE_URL,AMOUNT,DATE', 0),
(35, '2013-04-05 14:58:07', '2013-04-05 14:58:09', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Late Repayment Notification', 'we will send this mail to remind late repayment date.', '[##SITE_NAME##] Late Repayment Notification', 'Hi ##USERNAME##,\r\n\r\n Your payment due date for ##PROJECT## is on ##DATE## is missed. Late payment fee will be charged. Please make payment.\r\n\r\nAmount: ##AMOUNT##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your payment due date for ##PROJECT## is on ##DATE## is missed. Late payment fee will be charged. </p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;"> Please make payment.Amount: ##AMOUNT##</p></td>\r\n                </tr>\r\n	\r\n                \r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div> ', 'SITE_NAME,USERNAME, SITE_URL,AMOUNT,DATE', 0),
(36, '2013-04-05 14:58:07', '2013-04-05 14:58:09', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Edit', 'we will send this mail\rinto user, when admin edit user''s profile.', '[##SITE_NAME##] Profile updated', 'Hi ##USERNAME##,\r\n\r\nAdmin updated your profile in ##SITE_NAME## account.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Admin updated your profile in ##SITE_NAME## account.</p></td>\r\n                </tr>	\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'SITE_NAME,EMAIL,USERNAME', 0),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Prelaunch subscription email confirmation', 'Email confirmation for pre lanuch mode subscription', 'Email Confirmation', 'Hi,\r\n\r\nYour subscription made successfully. You need to do one more step to confirm your email address. This confirmation is recommended to receive further valuable email from us.\r\nPlease visit the following URL to confirm your email\r\n##VERIFICATION_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Hi</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your subscription made successfully. You need to do one more step to confirm your email address. This confirmation is recommended to receive further valuable email from us.</p></td>\r\n                </tr>\r\n	 <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Please visit the following URL to confirm your email ##VERIFICATION_URL##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'SITE_NAME, VERIFICATION_URL, SITE_URL', 0);
INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_text_content`, `email_html_content`, `email_variables`, `is_html`) VALUES
(38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Project Rejected', 'We will send this mail to user, when admin reject user project.', 'Project Rejected', 'Dear ##USERNAME##,  \r\n\r\nYour ##PROJECT_NAME## rejected by admin. Please check and update your project and resubmit it to admin approve.\r\n\r\nProject Name: ##PROJECT_NAME##\r\nURL: ##PROJECT_URL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />\r\n<div style="margin: 5px 0pt; padding: 20px; width: 700px; font-family: Open Sans,sans-serif; background-color: #f2f2f2; background-repeat: no-repeat;-webkit-border-radius: 10px;\r\n-moz-border-radius: 10px;\r\nborder-radius: 10px;">\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="text-align: center; font-size: 11px; color: #929292; margin: 3px;">Be sure to add <a style="color: #30BCEF;" title="Add ##FROM_EMAIL## to your whitelist" href="mailto:##FROM_EMAIL##" target="_blank">##FROM_EMAIL##</a> to your address book or safe sender list so our emails get to your inbox.</p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n  <div style="border-bottom: 1px solid #ccc; margin: 0pt; background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);\r\nbackground: -webkit-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -o-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nbackground: -ms-linear-gradient(top, #ffffff 0%,#f2f2f2 100%);\r\nfilter: progid:DXImageTransform.Microsoft.gradient( startColorstr=''#ffffff'', endColorstr=''#f2f2f2'',GradientType=0 ); \r\n\r\n min-height: 70px;">\r\n<table cellspacing="0" cellpadding="0" width="700">\r\n<tbody>\r\n<tr>\r\n<td  valign="top" style="padding:14px 0 0 10px; width: 110px; min-height: 37px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"><img style="padding-right: 15px; border: 0px 1px 0px 0px none solid none none -moz-use-text-color #333333 -moz-use-text-color -moz-use-text-color;" src="##SITE_URL##/img/logo.png" alt="[Image: ##SITE_NAME##]" /></a></td>\r\n<td width="505" align="center" valign="top" style="padding-left: 15px; width: 250px; padding-top: 16px;"><a style="color: #0981be;" title="##SITE_NAME##" href="#" target="_blank"></a></td>\r\n<td width="21" align="right" valign="top" style="padding-right: 20px; padding-top: 21px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n  \r\n  <div style=" padding: 20px; background-repeat: no-repeat; background-color: #ffffff; box-shadow: 0 0 7px rgba(0, 0, 0, 0.067);">\r\n    <table style="background-color: #ffffff;" width="100%">\r\n      <tbody>\r\n        \r\n        <tr>\r\n          <td style="padding: 20px 30px 5px;"><p style="color: #545454; font-size: 18px;">Dear ##USERNAME##,</p>           \r\n            <table border="0" width="100%">\r\n              <tbody>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Your project rejected by admin. Please check and update your project and resubmit it to admin approve.</p></td>\r\n                </tr>\r\n                <tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">Project Name: ##PROJECT_NAME##</p></td>\r\n                </tr>\r\n	<tr>\r\n                  <td><p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: left; padding: 5px 0px;">URL: ##PROJECT_URL##</p></td>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n            <p style=" color: #545454; margin: 0pt 20px; font-size: 16px; text-align: center; padding: 15px 0px;">&nbsp;</p></td>\r\n        </tr>\r\n        <tr>\r\n          <td><div style="border-top: 1px solid #d6d6d6; padding: 15px 30px 25px; margin: 0pt 30px;">\r\n              <h4 style=" font-size: 22px; font-weight: bold; text-align: center; margin: 0pt 0pt 5px; line-height: 26px; color: #30BCEF;">Thanks,</h4>\r\n              <h5 style=" color: #545454; line-height: 20px; text-align: center; margin: 0pt; font-size: 16px;">##SITE_NAME## - <a style="color: #30BCEF;" title="##SITE_NAME## - Collective Buying Power" href="##SITE_LINK##" target="_blank">##SITE_URL##</a></h5>\r\n            </div></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n    <table style="margin-top: 2px; background-color: #f5f5f5;" width="100%">\r\n      <tbody>\r\n        <tr>\r\n          <td><p style=" color: #000; font-size: 12px; text-align: center; line-height: 16px; margin: 10px;">Need help? Have feedback? Feel free to <a style="color: #30BCEF;" title="Contact ##SITE_NAME##" href="##CONTACT_URL##" target="_blank">Contact Us</a></p></td>\r\n        </tr>\r\n      </tbody>\r\n    </table>\r\n  </div>\r\n  <table cellspacing="0" cellpadding="0" width="720px">\r\n    <tbody>\r\n      <tr>\r\n        <td align="center"><p style="font-size: 11px; color: #929292; margin: 3px; padding-top: 10px;">Delivered by <a style="color: #30BCEF;" title="##SITE_NAME##" href="##SITE_LINK##" target="_blank">##SITE_NAME##</a></p></td>\r\n      </tr>\r\n    </tbody>\r\n  </table>\r\n</div>', 'PROJECT_NAME,USERNAME,PROJECT_URL,SITE_NAME,SITE_URL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

DROP TABLE IF EXISTS `employments`;
CREATE TABLE IF NOT EXISTS `employments` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `employment` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employments`
--

INSERT INTO `employments` (`id`, `created`, `modified`, `employment`, `is_active`) VALUES
(1, '2010-11-23 19:50:45', '2010-11-23 19:50:48', 'Employed full time', 1),
(2, '2010-11-23 19:51:03', '2010-11-23 19:51:05', 'Not employed but looking for work', 1),
(3, '2010-11-23 19:51:23', '2010-11-23 19:51:25', 'Not employed and not looking for work', 1),
(4, '2010-11-23 19:51:29', '2010-11-23 19:51:31', 'Retired', 1),
(5, '2010-11-23 19:51:57', '2010-11-23 19:51:59', 'Student', 1),
(6, '2010-11-23 19:52:06', '2010-11-23 19:52:08', 'Homemaker', 1),
(7, '2010-11-23 19:52:21', '2010-11-23 19:52:24', 'Prefer not to share', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equity_project_categories`
--

DROP TABLE IF EXISTS `equity_project_categories`;
CREATE TABLE IF NOT EXISTS `equity_project_categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(265) collate utf8_unicode_ci default NULL,
  `equity_count` bigint(20) unsigned NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equity_project_categories`
--

INSERT INTO `equity_project_categories` (`id`, `created`, `modified`, `name`, `slug`, `equity_count`, `is_approved`) VALUES
(1, '2010-09-16 20:44:19', '2012-05-08 06:16:47', 'Art', 'art', 0, 1),
(2, '2010-09-16 20:53:02', '2011-10-05 11:53:32', 'Comedy', 'comedy', 0, 1),
(3, '2010-09-16 20:53:15', '2010-09-16 20:53:17', 'Comics', 'comics', 0, 1),
(4, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Community', 'community', 0, 1),
(5, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Crafts', 'crafts', 0, 1),
(6, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Dance', 'dance', 0, 1),
(7, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Design', 'design', 0, 1),
(8, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Events', 'events', 0, 1),
(9, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Fashion', 'fashion', 0, 1),
(10, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Food', 'food', 0, 1),
(11, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Film/Video', 'film-video', 0, 1),
(12, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Gaming', 'gaming', 0, 1),
(13, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Journalism', 'journalism', 0, 1),
(14, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Music', 'music', 0, 1),
(15, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Photography', 'photography', 0, 1),
(16, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Technology', 'technology', 0, 1),
(17, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Theater', 'Theater', 0, 1),
(18, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Writing/Publishing', 'writing-publishing', 0, 1),
(19, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Other', 'other', 0, 1),
(20, '2012-05-12 06:39:57', '2012-05-12 06:39:57', 'Plantation', 'plantation', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equity_project_statuses`
--

DROP TABLE IF EXISTS `equity_project_statuses`;
CREATE TABLE IF NOT EXISTS `equity_project_statuses` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `equity_count` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `message` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `is_active` (`is_active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equity_project_statuses`
--

INSERT INTO `equity_project_statuses` (`id`, `created`, `modified`, `name`, `equity_count`, `is_active`, `message`) VALUES
(1, '2010-10-14 13:42:28', '2010-10-14 13:42:31', 'Pending', 0, 1, 'New ##PROJECT## posted by ##PROJECT_OWNER_NAME##'),
(2, '2010-10-14 13:42:43', '2011-03-21 02:47:54', 'Open for investing', 0, 1, 'Open for investing'),
(3, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Project Closed and paid to project owner', 0, 1, 'Project closed'),
(4, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Refunded due to expired', 0, 1, 'Project expired'),
(5, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Refunded due to cancelled', 0, 1, 'Project canceled'),
(6, '2011-02-22 17:47:42', '2011-02-22 17:47:44', 'Goal Reached', 0, 1, 'Goal Reached'),
(8, '0000-00-00 00:00:00', '2011-06-22 05:23:45', 'Open for voting', 0, 1, 'Open for voting');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_comments`
--

DROP TABLE IF EXISTS `facebook_comments`;
CREATE TABLE IF NOT EXISTS `facebook_comments` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `facebook_user_id` varchar(50) collate utf8_unicode_ci NOT NULL,
  `facebook_comment_id` varchar(50) collate utf8_unicode_ci NOT NULL,
  `facebook_comment_creater_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `comment_content` text collate utf8_unicode_ci NOT NULL,
  `href` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `facebook_user_id` (`facebook_user_id`),
  KEY `facebook_comment_id` (`facebook_comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `facebook_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

DROP TABLE IF EXISTS `form_fields`;
CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `display_text` varchar(255) collate utf8_unicode_ci default NULL,
  `label` varchar(255) collate utf8_unicode_ci default NULL,
  `type` varchar(45) collate utf8_unicode_ci NOT NULL COMMENT 'text',
  `info` text collate utf8_unicode_ci NOT NULL,
  `project_type_id` int(10) unsigned NOT NULL,
  `required` tinyint(1) NOT NULL default '0',
  `depends_on` varchar(45) collate utf8_unicode_ci default NULL,
  `depends_value` varchar(45) collate utf8_unicode_ci default NULL,
  `order` int(10) unsigned NOT NULL,
  `options` text collate utf8_unicode_ci NOT NULL,
  `form_field_group_id` bigint(20) NOT NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  `is_dynamic_field` tinyint(1) NOT NULL default '1',
  `is_active` tinyint(1) NOT NULL default '0',
  `is_show_display_text_field` tinyint(1) NOT NULL default '1',
  `is_editable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `form_field_group_id` (`form_field_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `name`, `display_text`, `label`, `type`, `info`, `project_type_id`, `required`, `depends_on`, `depends_value`, `order`, `options`, `form_field_group_id`, `is_deletable`, `is_dynamic_field`, `is_active`, `is_show_display_text_field`, `is_editable`) VALUES
(10, 'Project.feed_url', 'Feed URL', 'Feed URL', 'text', 'Automatically fetch updates from the given feed URL', 1, 0, '', '', 15, '', 4, 1, 0, 1, 1, 1),
(44, 'Upload_Media_File_1', 'Upload Media File', 'Upload Media File', 'file', '', 1, 0, NULL, NULL, 17, '', 15, 1, 1, 1, 1, 1),
(24, 'Project.short_description', '', 'Short Description', 'textarea', 'This text will be used on share and RSS feeds.', 1, 1, NULL, NULL, 2, '', 2, 0, 0, 1, 0, 1),
(23, 'Project.name', '', 'Name', 'text', '', 1, 1, NULL, NULL, 0, '', 2, 0, 0, 1, 0, 1),
(26, 'Attachment.filename', '', 'Upload Image', 'file', '', 1, 1, NULL, NULL, 3, '', 2, 0, 0, 1, 0, 1),
(27, 'Project.payment_method_id', '', 'Payment Method', 'select', 'For Fixed Funding project, fund will be captured only if it reached the needed amount. For Flexible Funding project, fund will be captured even if it does not reached the needed amount. But we charge a ##REACHED_FEE_AMOUNT##% fee if you reach your goal.', 1, 1, NULL, NULL, 4, '', 6, 0, 0, 1, 0, 0),
(28, 'Project.address', '', 'Address', 'text', 'You must select address from autocomplete', 1, 1, NULL, NULL, 10, '', 3, 1, 0, 1, 0, 1),
(29, 'Project.address1', '', 'Address', 'text', '', 1, 1, NULL, NULL, 11, '', 3, 1, 0, 1, 0, 1),
(30, 'Project.country_id', '', 'Country', 'select', '', 1, 1, NULL, NULL, 14, '', 3, 1, 0, 1, 0, 1),
(31, 'State.name', '', 'State', 'text', '', 1, 1, NULL, NULL, 13, '', 3, 1, 0, 1, 0, 1),
(32, 'City.name', '', 'City', 'text', '', 1, 1, NULL, NULL, 12, '', 3, 1, 0, 1, 0, 1),
(33, 'Project.facebook_feed_url', 'Facebook feed URL', 'Facebook feed URL', 'text', 'You can enter facebook URL from which you want to show feeds.', 1, 0, NULL, NULL, 33, '', 5, 1, 0, 1, 1, 1),
(34, 'Project.twitter_feed_url', 'Twitter username', 'Twitter username', 'text', 'You can enter twitter username from which you want to show tweets. This widget is unavailable for private accounts.', 1, 0, NULL, NULL, 34, '', 5, 1, 0, 1, 1, 1),
(35, 'Project.needed_amount', '', 'Needed amount (##SITE_CURRENCY##)', 'text', '', 1, 1, NULL, NULL, 5, '', 6, 0, 0, 1, 0, 0),
(36, 'Project.project_end_date', '', 'Project funding end date', 'date', '', 1, 0, NULL, NULL, 9, '', 6, 0, 0, 1, 0, 0),
(37, 'Pledge.is_allow_over_funding', '', 'Allow overfunding', 'checkbox', '', 1, 0, NULL, NULL, 6, '', 6, 0, 0, 1, 0, 0),
(38, 'Pledge.pledge_type_id', '', 'Pledge type', 'select', 'You can set pledge type as any, minimum, fixed, suggested amount that you want each member to pledge when joining your campaign. You select "any" option to let members pledge any amount.', 1, 0, NULL, NULL, 7, '', 6, 0, 0, 1, 0, 0),
(39, 'ProjectReward.0.pledge_amount', '', 'Pledge amount ($)', 'text', 'Reward amount', 1, 1, NULL, NULL, 28, '', 7, 1, 0, 1, 0, 1),
(40, 'ProjectReward.0.pledge_max_user_limit', '', 'Pledge max user limit', 'text', 'Maximum user allowed for this reward. Leave blank for no limit.', 1, 1, NULL, NULL, 29, '', 7, 1, 0, 1, 0, 1),
(41, 'ProjectReward.0.reward', '', 'Reward', 'text', 'Reward description', 1, 1, NULL, NULL, 26, '', 7, 1, 0, 1, 0, 1),
(42, 'Project.description', '', 'Description', 'textarea', 'Entered description will display in view page', 1, 1, NULL, NULL, 25, '', 27, 1, 0, 1, 0, 1),
(45, 'Description_1', 'Description', 'Description', 'text', '', 1, 0, 'Upload_Media_File_1', NULL, 18, '', 15, 1, 1, 1, 1, 1),
(46, 'Upload_Media_File_2', 'Upload Media File', 'Upload Media File', 'file', '', 1, 0, NULL, NULL, 19, '', 15, 1, 1, 1, 1, 1),
(47, 'Description_2', 'Description', 'Description', 'text', '', 1, 0, 'Upload_Media_File_2', '', 20, '', 15, 1, 1, 1, 1, 1),
(48, 'Upload_Media_File_3', 'Upload Media File', 'Upload Media File', 'file', '', 1, 0, NULL, NULL, 21, '', 15, 1, 1, 1, 1, 1),
(49, 'Description_3', 'Description', 'Description', 'text', '', 1, 0, 'Upload_Media_File_3', '', 22, '', 15, 1, 1, 1, 1, 1),
(50, 'Upload_Media_File_4', 'Upload Media File', 'Upload Media File', 'file', '', 1, 0, NULL, NULL, 23, '', 15, 1, 1, 1, 1, 1),
(51, 'Description_4', 'Description', 'Description', 'text', '', 1, 0, 'Upload_Media_File_4', '', 24, '', 15, 1, 1, 1, 1, 1),
(52, 'Project.video_embed_url', 'Video URL', 'Video URL', 'video', '', 1, 0, NULL, NULL, 16, '', 17, 0, 0, 1, 1, 1),
(53, 'LinkedIn_URL', 'LinkedIn URL', 'LinkedIn URL', 'url', '', 1, 0, NULL, NULL, 35, '', 16, 1, 1, 1, 1, 1),
(54, 'Twitter_URL', 'Twitter URL', 'Twitter URL', 'url', '', 1, 0, NULL, NULL, 36, '', 16, 1, 1, 1, 1, 1),
(55, 'MySpace_URL', 'MySpace URL', 'MySpace URL', 'url', '', 1, 0, NULL, NULL, 37, '', 16, 1, 1, 1, 1, 1),
(56, 'Home_page_URL', 'Home page URL', 'Home page URL', 'url', '', 1, 0, NULL, NULL, 38, '', 16, 1, 1, 1, 1, 1),
(57, 'Facebook_URL', 'Facebook URL', 'Facebook URL', 'url', '', 1, 0, NULL, NULL, 39, '', 16, 1, 1, 1, 1, 1),
(59, 'IMDb_URL', 'IMDb URL', 'IMDb URL', 'url', '', 1, 0, NULL, NULL, 40, '', 16, 1, 1, 1, 1, 1),
(60, 'Pledge.min_amount_to_fund', '', 'Amount', 'text', 'amount', 1, 0, NULL, NULL, 8, '', 6, 1, 0, 1, 0, 0),
(61, 'Pledge.pledge_project_category_id', '', 'Project Category', 'select', '', 1, 0, NULL, NULL, 1, '', 2, 0, 0, 1, 0, 1),
(63, 'ProjectReward.0.estimated_delivery_date', '', 'Estimated delivery date', 'date', '', 1, 0, NULL, NULL, 27, '', 7, 1, 0, 1, 0, 1),
(64, 'ProjectReward.0.is_shipping', '', 'Shipping', 'checkbox', '', 1, 0, NULL, NULL, 30, '', 7, 1, 0, 1, 0, 1),
(65, 'ProjectReward.0.is_having_additional_info', '', 'Additional Info.', 'checkbox', '', 1, 0, NULL, NULL, 31, '', 7, 1, 0, 1, 0, 1),
(66, 'ProjectReward.0.additional_info_label', '', 'Additional info. label', 'text', '', 1, 0, NULL, NULL, 32, '', 7, 1, 0, 1, 0, 1),
(67, 'Project.feed_url', 'Feed URL', 'Feed URL', 'text', 'Automatically fetch updates from the given feed URL', 2, 0, '', '', 15, '', 21, 1, 0, 1, 1, 1),
(71, 'Upload_Media_File_1', 'Upload Media File', 'Upload Media File', 'file', '', 2, 0, NULL, NULL, 17, '', 24, 1, 1, 1, 1, 1),
(72, 'Donate.donate_project_category_id', 'Project category', 'Project category', 'select', '', 2, 1, NULL, NULL, 1, '', 19, 0, 0, 1, 1, 1),
(73, 'Project.short_description', 'Short description', 'Short description', 'textarea', 'This text will be used on share and RSS feeds.', 2, 1, NULL, NULL, 2, '', 19, 0, 0, 1, 1, 1),
(74, 'Project.name', 'Name', 'Name', 'text', '', 2, 1, NULL, NULL, 0, '', 19, 0, 0, 1, 1, 1),
(75, 'Attachment.filename', 'Upload image', 'Upload image', 'file', '', 2, 1, NULL, NULL, 3, '', 19, 0, 0, 1, 1, 1),
(77, 'Project.address', 'Address', 'Address', 'text', 'You must select address from autocomplete', 2, 1, NULL, NULL, 10, '', 20, 1, 0, 1, 1, 1),
(78, 'Project.address1', 'Address', 'Address', 'text', '', 2, 1, NULL, NULL, 11, '', 20, 1, 0, 1, 1, 1),
(79, 'Project.country_id', 'Country', 'Country', 'select', '', 2, 1, NULL, NULL, 14, '', 20, 1, 0, 1, 1, 1),
(80, 'State.name', 'State', 'State', 'text', '', 2, 1, NULL, NULL, 13, '', 20, 1, 0, 1, 1, 1),
(81, 'City.name', 'City', 'City', 'text', '', 2, 1, NULL, NULL, 12, '', 20, 1, 0, 1, 1, 1),
(82, 'Project.facebook_feed_url', 'Facebook feed URL', 'Facebook feed URL', 'text', 'You can enter facebook URL from which you want to show feeds.', 2, 0, NULL, NULL, 25, '', 22, 1, 0, 1, 1, 1),
(83, 'Project.twitter_feed_url', 'Twitter username', 'Twitter username', 'text', 'You can enter twitter username from which you want to show tweets. This widget is unavailable for private accounts.', 2, 0, NULL, NULL, 26, '', 22, 1, 0, 1, 1, 1),
(85, 'Project.project_end_date', 'Donation end date', 'Donation end date', 'date', '', 2, 0, NULL, NULL, 8, '', 23, 0, 0, 1, 1, 0),
(86, 'Donate.is_allow_over_donating', 'Allow over donating', 'Allow Over Donation', 'checkbox', '', 2, 0, NULL, NULL, 5, '', 23, 0, 0, 1, 1, 0),
(88, 'Description_1', 'Description', 'Description', 'text', '', 2, 0, 'Upload_Media_File_1', NULL, 18, '', 24, 1, 1, 1, 1, 1),
(89, 'Upload_Media_File_2', 'Upload Media File', 'Upload Media File', 'file', '', 2, 0, NULL, NULL, 19, '', 24, 1, 1, 1, 1, 1),
(90, 'Description_2', 'Description', 'Description', 'text', '', 2, 0, 'Upload_Media_File_2', NULL, 20, '', 24, 1, 1, 1, 1, 1),
(91, 'Upload_Media_File_3', 'Upload Media File', 'Upload Media File', 'file', '', 2, 0, NULL, NULL, 21, '', 24, 1, 1, 1, 1, 1),
(92, 'Description_3', 'Description', 'Description', 'text', '', 2, 0, 'Upload_Media_File_3', NULL, 22, '', 24, 1, 1, 1, 1, 1),
(93, 'Upload_Media_File_4', 'Upload Media File', 'Upload Media File', 'file', '', 2, 0, NULL, NULL, 23, '', 24, 1, 1, 1, 1, 1),
(94, 'Description_4', 'Description', 'Description', 'text', '', 2, 0, 'Upload_Media_File_4', NULL, 24, '', 24, 1, 1, 1, 1, 1),
(95, 'Project.video_embed_url', 'Video URL', 'Video URL', 'text', '', 2, 0, NULL, NULL, 16, '', 26, 0, 0, 1, 1, 1),
(96, 'LinkedIn_URL', 'LinkedIn URL', 'LinkedIn URL', 'url', '', 2, 0, NULL, NULL, 27, '', 25, 1, 1, 1, 1, 1),
(97, 'Twitter_URL', 'Twitter URL', 'Twitter URL', 'url', '', 2, 0, NULL, NULL, 28, '', 25, 1, 1, 1, 1, 1),
(98, 'MySpace_URL', 'MySpace URL', 'MySpace URL', 'url', '', 2, 0, NULL, NULL, 29, '', 25, 1, 1, 1, 1, 1),
(99, 'Home_page_URL', 'Home page URL', 'Home page URL', 'url', '', 2, 0, NULL, NULL, 30, '', 25, 1, 1, 1, 1, 1),
(100, 'Facebook_URL', 'Facebook URL', 'Facebook URL', 'url', '', 2, 0, NULL, NULL, 31, '', 25, 1, 1, 1, 1, 1),
(102, 'IMDb_URL', 'IMDb URL', 'IMDb URL', 'url', '', 2, 0, NULL, NULL, 32, '', 25, 1, 1, 1, 1, 1),
(105, 'Project.description', '', 'Description', 'textarea', 'Entered description will display in view page', 2, 1, NULL, NULL, 9, '', 29, 1, 0, 1, 0, 1),
(106, 'Project.needed_amount', NULL, 'Needed amount (##SITE_CURRENCY##)', 'text', '', 2, 1, NULL, NULL, 4, '', 23, 0, 0, 1, 0, 0),
(113, 'Project.name', 'Name', 'Name', 'text', '', 3, 1, NULL, NULL, 0, '', 30, 0, 0, 1, 1, 1),
(114, 'Attachment.filename', 'Upload image', 'Upload image', 'file', '', 3, 1, NULL, NULL, 3, '', 30, 0, 0, 1, 1, 1),
(115, 'Lend.lend_project_category_id', 'Project category', 'Purpose', 'select', '', 3, 1, NULL, NULL, 1, '', 30, 0, 0, 1, 1, 1),
(116, 'Project.short_description', 'Short description', 'Short description', 'textarea', 'This text will be used on share and RSS feeds.', 3, 1, NULL, NULL, 2, '', 30, 0, 0, 1, 1, 1),
(117, 'Project.address', 'Address', 'Address', 'text', 'You must select address from autocomplete', 3, 1, NULL, NULL, 10, '', 31, 1, 0, 1, 1, 1),
(118, 'Project.address1', 'Address', 'Address', 'text', '', 3, 1, NULL, NULL, 11, '', 31, 1, 0, 1, 1, 1),
(119, 'Project.country_id', 'Country', 'Country', 'select', '', 3, 1, NULL, NULL, 14, '', 31, 1, 0, 1, 1, 1),
(120, 'State.name', 'State', 'State', 'text', '', 3, 1, NULL, NULL, 13, '', 31, 1, 0, 1, 1, 1),
(121, 'City.name', 'City', 'City', 'text', '', 3, 1, NULL, NULL, 12, '', 31, 1, 0, 1, 1, 1),
(122, 'Project.feed_url', 'Feed URL', 'Feed URL', 'text', 'Automatically fetch updates from the given feed URL', 3, 0, '', '', 15, '', 32, 1, 0, 1, 1, 1),
(123, 'Project.facebook_feed_url', 'Facebook feed URL', 'Facebook feed URL', 'text', 'You can enter facebook URL from which you want to show feeds.', 3, 0, NULL, NULL, 25, '', 33, 1, 0, 1, 1, 1),
(124, 'Project.twitter_feed_url', 'Twitter username', 'Twitter username', 'text', 'You can enter twitter username from which you want to show tweets. This widget is unavailable for private accounts.', 3, 0, NULL, NULL, 26, '', 33, 1, 0, 1, 1, 1),
(125, 'Project.project_end_date', 'Project end date', 'Project end date', 'date', '', 3, 0, NULL, NULL, 8, '', 34, 0, 0, 1, 1, 0),
(126, 'Project.needed_amount', NULL, 'Loan amount (##SITE_CURRENCY##)', 'text', '', 3, 1, NULL, NULL, 4, '', 34, 0, 0, 1, 0, 0),
(127, 'Upload_Media_File_1', 'Upload Media File', 'Upload Media File', 'file', '', 3, 0, NULL, NULL, 17, '', 35, 1, 1, 1, 1, 1),
(128, 'Description_1', 'Description', 'Description', 'text', '', 3, 0, 'Upload_Media_File_1', NULL, 18, '', 35, 1, 1, 1, 1, 1),
(129, 'Upload_Media_File_2', 'Upload Media File', 'Upload Media File', 'file', '', 3, 0, NULL, NULL, 19, '', 35, 1, 1, 1, 1, 1),
(130, 'Description_2', 'Description', 'Description', 'text', '', 3, 0, 'Upload_Media_File_2', NULL, 20, '', 35, 1, 1, 1, 1, 1),
(131, 'Upload_Media_File_3', 'Upload Media File', 'Upload Media File', 'file', '', 3, 0, NULL, NULL, 21, '', 35, 1, 1, 1, 1, 1),
(132, 'Description_3', 'Description', 'Description', 'text', '', 3, 0, 'Upload_Media_File_3', NULL, 22, '', 35, 1, 1, 1, 1, 1),
(133, 'Upload_Media_File_4', 'Upload Media File', 'Upload Media File', 'file', '', 3, 0, NULL, NULL, 23, '', 35, 1, 1, 1, 1, 1),
(134, 'Description_4', 'Description', 'Description', 'text', '', 3, 0, 'Upload_Media_File_4', NULL, 24, '', 35, 1, 1, 1, 1, 1),
(135, 'LinkedIn_URL', 'LinkedIn URL', 'LinkedIn URL', 'url', '', 3, 0, NULL, NULL, 27, '', 36, 1, 1, 1, 1, 1),
(136, 'Twitter_URL', 'Twitter URL', 'Twitter URL', 'url', '', 3, 0, NULL, NULL, 28, '', 36, 1, 1, 1, 1, 1),
(137, 'MySpace_URL', 'MySpace URL', 'MySpace URL', 'url', '', 3, 0, NULL, NULL, 29, '', 36, 1, 1, 1, 1, 1),
(138, 'Home_page_URL', 'Home page URL', 'Home page URL', 'url', '', 3, 0, NULL, NULL, 30, '', 36, 1, 1, 1, 1, 1),
(139, 'Facebook_URL', 'Facebook URL', 'Facebook URL', 'url', '', 3, 0, NULL, NULL, 31, '', 36, 1, 1, 1, 1, 1),
(140, 'IMDb_URL', 'IMDb URL', 'IMDb URL', 'url', '', 3, 0, NULL, NULL, 32, '', 36, 1, 1, 1, 1, 1),
(141, 'Project.video_embed_url', 'Video URL', 'Video URL', 'text', '', 3, 0, NULL, NULL, 16, '', 37, 0, 0, 1, 1, 1),
(145, 'Project.description', '', 'Description', 'textarea', 'Entered description will display in view page', 3, 1, NULL, NULL, 9, '', 39, 1, 0, 1, 0, 1),
(146, 'Project.name', 'Name', 'Name', 'text', '', 4, 1, NULL, NULL, 0, '', 40, 0, 0, 1, 1, 1),
(147, 'Attachment.filename', 'Upload image', 'Upload image', 'file', '', 4, 1, NULL, NULL, 3, '', 40, 0, 0, 1, 1, 1),
(148, 'Equity.equity_project_category_id', 'Project category', 'Project category', 'select', '', 4, 1, NULL, NULL, 1, '', 40, 0, 0, 1, 1, 1),
(149, 'Project.short_description', 'Short description', 'Short description', 'textarea', 'This text will be used on share and RSS feeds.', 4, 1, NULL, NULL, 2, '', 40, 0, 0, 1, 1, 1),
(150, 'Project.address', 'Address', 'Address', 'text', 'You must select address from autocomplete', 4, 1, NULL, NULL, 10, '', 41, 1, 0, 1, 1, 1),
(151, 'Project.address1', 'Address', 'Address', 'text', '', 4, 1, NULL, NULL, 11, '', 41, 1, 0, 1, 1, 1),
(152, 'Project.country_id', 'Country', 'Country', 'select', '', 4, 1, NULL, NULL, 14, '', 41, 1, 0, 1, 1, 1),
(153, 'State.name', 'State', 'State', 'text', '', 4, 1, NULL, NULL, 13, '', 41, 1, 0, 1, 1, 1),
(154, 'City.name', 'City', 'City', 'text', '', 4, 1, NULL, NULL, 12, '', 41, 1, 0, 1, 1, 1),
(155, 'Project.feed_url', 'Feed URL', 'Feed URL', 'text', 'Automatically fetch updates from the given feed URL', 4, 0, '', '', 15, '', 42, 1, 0, 1, 1, 1),
(156, 'Project.facebook_feed_url', 'Facebook feed URL', 'Facebook feed URL', 'text', 'You can enter facebook URL from which you want to show feeds.', 4, 0, NULL, NULL, 25, '', 43, 1, 0, 1, 1, 1),
(157, 'Project.twitter_feed_url', 'Twitter username', 'Twitter username', 'text', 'You can enter twitter username from which you want to show tweets. This widget is unavailable for private accounts.', 4, 0, NULL, NULL, 26, '', 43, 1, 0, 1, 1, 1),
(158, 'Project.project_end_date', 'Project end date', 'Project end date', 'date', '', 4, 0, NULL, NULL, 8, '', 44, 0, 0, 1, 1, 0),
(159, 'Project.needed_amount', NULL, 'Needed amount (##SITE_CURRENCY##)', 'text', 'Amount should be multiples of ##SITE_CURRENCY####MULTIPLE_AMOUNT##', 4, 1, NULL, NULL, 4, '', 44, 0, 0, 1, 0, 0),
(160, 'Upload_Media_File_1', 'Upload Media File', 'Upload Media File', 'file', '', 4, 0, NULL, NULL, 17, '', 45, 1, 1, 1, 1, 1),
(161, 'Description_1', 'Description', 'Description', 'text', '', 4, 0, 'Upload_Media_File_1', NULL, 18, '', 45, 1, 1, 1, 1, 1),
(162, 'Upload_Media_File_2', 'Upload Media File', 'Upload Media File', 'file', '', 4, 0, NULL, NULL, 19, '', 45, 1, 1, 1, 1, 1),
(163, 'Description_2', 'Description', 'Description', 'text', '', 4, 0, 'Upload_Media_File_2', NULL, 20, '', 45, 1, 1, 1, 1, 1),
(164, 'Upload_Media_File_3', 'Upload Media File', 'Upload Media File', 'file', '', 4, 0, NULL, NULL, 21, '', 45, 1, 1, 1, 1, 1),
(165, 'Description_3', 'Description', 'Description', 'text', '', 4, 0, 'Upload_Media_File_3', NULL, 22, '', 45, 1, 1, 1, 1, 1),
(166, 'Upload_Media_File_4', 'Upload Media File', 'Upload Media File', 'file', '', 4, 0, NULL, NULL, 23, '', 45, 1, 1, 1, 1, 1),
(167, 'Description_4', 'Description', 'Description', 'text', '', 4, 0, 'Upload_Media_File_4', NULL, 24, '', 45, 1, 1, 1, 1, 1),
(168, 'LinkedIn_URL', 'LinkedIn URL', 'LinkedIn URL', 'url', '', 4, 0, NULL, NULL, 27, '', 46, 1, 1, 1, 1, 1),
(169, 'Twitter_URL', 'Twitter URL', 'Twitter URL', 'url', '', 4, 0, NULL, NULL, 28, '', 46, 1, 1, 1, 1, 1),
(170, 'MySpace_URL', 'MySpace URL', 'MySpace URL', 'url', '', 4, 0, NULL, NULL, 29, '', 46, 1, 1, 1, 1, 1),
(171, 'Home_page_URL', 'Home page URL', 'Home page URL', 'url', '', 4, 0, NULL, NULL, 30, '', 46, 1, 1, 1, 1, 1),
(172, 'Facebook_URL', 'Facebook URL', 'Facebook URL', 'url', '', 4, 0, NULL, NULL, 31, '', 46, 1, 1, 1, 1, 1),
(173, 'IMDb_URL', 'IMDb URL', 'IMDb URL', 'url', '', 4, 0, NULL, NULL, 32, '', 46, 1, 1, 1, 1, 1),
(174, 'Project.video_embed_url', 'Video URL', 'Video URL', 'text', '', 4, 0, NULL, NULL, 16, '', 47, 0, 0, 1, 1, 1),
(178, 'Project.description', '', 'Description', 'textarea', 'Entered description will display in view page', 4, 1, NULL, NULL, 9, '', 49, 1, 0, 1, 0, 1),
(179, 'Project.payment_method_id', '', 'Payment Method', 'select', 'For Fixed Funding project, fund will be captured only if it reached the needed amount. For Flexible Funding project, fund will be captured even if it does not reached the needed amount. But we charge a ##REACHED_FEE_AMOUNT##% fee if you reach your goal.', 4, 1, NULL, NULL, 4, '', 44, 0, 0, 1, 0, 0),
(180, 'Project.payment_method_id', '', 'Payment Method', 'select', 'For Fixed Lending project, lend will be captured only if it reached the needed amount. For Flexible Lending project, lend will be captured even if it does not reached the needed amount. But we charge a ##REACHED_FEE_AMOUNT##% fee if you reach your goal.', 3, 1, NULL, NULL, 4, '', 34, 0, 0, 1, 0, 0),
(181, 'Lend.credit_score_id', 'Credit Score', 'Credit Score', 'select', '', 3, 1, NULL, NULL, 1, '', 34, 0, 0, 1, 1, 0),
(182, 'Lend.loan_term_id', 'Loan Term', 'Loan Term', 'select', '', 3, 1, NULL, NULL, 2, '', 34, 0, 0, 1, 1, 0),
(183, 'Lend.repayment_schedule_id', 'Repayment Schedule', 'Repayment Schedule', 'select', '', 3, 1, NULL, NULL, 3, '', 34, 0, 0, 1, 1, 0),
(184, 'Lend.target_interest_rate', 'Interest Rate', 'Interest Rate', 'text', '', 3, 1, NULL, NULL, 4, '', 34, 0, 0, 1, 1, 0),
(185, 'Project.payment_method_id', '', 'Payment Method', 'select', 'For Fixed Funding project, fund will be captured only if it reached the needed amount. For Flexible Funding project, fund will be captured even if it does not reached the needed amount. But we charge a ##REACHED_FEE_AMOUNT##% fee if you reach your goal.', 1, 1, NULL, NULL, 4, '', 34, 0, 0, 0, 0, 0),
(186, 'Monthly_Income', 'Monthly Income (##SITE_CURRENCY##)', 'Monthly Income (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 1, '', 50, 1, 1, 1, 1, 1),
(187, 'Total_Expenses', 'Total Expenses (##SITE_CURRENCY##)', 'Total Expenses (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 2, '', 50, 1, 1, 1, 1, 1),
(188, 'Home_Ownership', 'Home Ownership', 'Home Ownership', 'radio', '', 3, 0, NULL, NULL, 3, 'Yes, No', 50, 1, 1, 1, 1, 1),
(189, 'Length_of_Employment', 'Length of Employment', 'Length of Employment', 'text', '', 3, 0, NULL, NULL, 4, '', 50, 1, 1, 1, 1, 1),
(190, 'Debt_to_Income', 'Debt to Income (##SITE_CURRENCY##)', 'Debt to Income (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 5, '', 50, 1, 1, 1, 1, 1),
(191, 'Employment_or_Selfemployment', 'Employment / Selfemployment', 'Employment / Selfemployment', 'text', '', 3, 0, NULL, NULL, 6, '', 50, 1, 1, 1, 1, 1),
(192, 'Investments', 'Investments (##SITE_CURRENCY##)', 'Investments (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 7, '', 50, 1, 1, 1, 1, 1),
(193, 'Monthly_Expenses', 'Monthly Expenses (##SITE_CURRENCY##)', 'Monthly Expenses (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 8, '', 50, 1, 1, 1, 1, 1),
(194, 'Other_Loan_Repayments', 'Other Loan Repayments (##SITE_CURRENCY##)', 'Other Loan Repayments (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 9, '', 50, 1, 1, 1, 1, 1),
(195, 'Transport_Charges', 'Transport Charges (##SITE_CURRENCY##)', 'Transport Charges (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 10, '', 50, 1, 1, 1, 1, 1),
(196, 'Insurance', 'Insurance (##SITE_CURRENCY##)', 'Insurance (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 11, '', 50, 1, 1, 1, 1, 1),
(197, 'Courses_or_Schoolfees', 'Courses/School Fees (##SITE_CURRENCY##)', 'Courses/School Fees (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 12, '', 50, 1, 1, 1, 1, 1),
(198, 'Tax_and_NI_Provisions', 'Tax/NI Provisions (##SITE_CURRENCY##)', 'Tax/NI Provisions (##SITE_CURRENCY##)', 'text', '', 3, 0, NULL, NULL, 13, '', 50, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_field_groups`
--

DROP TABLE IF EXISTS `form_field_groups`;
CREATE TABLE IF NOT EXISTS `form_field_groups` (
  `id` int(100) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `project_type_id` bigint(20) NOT NULL,
  `form_field_step_id` bigint(20) NOT NULL,
  `info` text NOT NULL,
  `order` bigint(20) default NULL,
  `class` varchar(255) NOT NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  `is_editable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`),
  KEY `project_type_id` (`project_type_id`),
  KEY `form_field_step_id` (`form_field_step_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_field_groups`
--

INSERT INTO `form_field_groups` (`id`, `created`, `modified`, `name`, `slug`, `project_type_id`, `form_field_step_id`, `info`, `order`, `class`, `is_deletable`, `is_editable`) VALUES
(2, '2012-08-10 05:42:52', '2012-12-11 01:54:39', 'Project Info', '', 1, 1, '', 0, '', 0, 1),
(3, '2012-08-10 05:43:59', '2012-12-11 01:54:39', 'Location', '', 1, 2, '', 3, '', 1, 1),
(4, '2012-08-10 05:44:20', '2012-12-11 01:54:39', 'Project Updates', '', 1, 2, '', 4, '', 1, 1),
(5, '2012-08-10 05:44:41', '2012-12-11 01:54:39', 'Social feeds', '', 1, 4, '', 8, '', 1, 1),
(6, '2012-08-10 05:44:59', '2012-12-11 01:54:39', 'Funding', '', 1, 1, '', 1, '', 0, 0),
(7, '2012-08-10 05:45:14', '2012-12-11 01:54:39', 'Reward', '', 1, 3, 'The better the rewards, the faster you can meet your goal, and the more you will raise. Rewards can be real objects, experiences, or other cool stuff. But please keep them achievable and realistic.', 7, '', 1, 1),
(15, '2012-08-13 09:41:34', '2012-12-11 01:54:39', 'Media Files', '', 1, 2, 'You can add files related to this project. The file type can be jpg, jpeg, png, gif, doc, xls, txt, wmv, flv or pdf.', 6, '', 1, 1),
(16, '2012-08-13 09:42:31', '2012-12-11 01:54:39', 'Websites', '', 1, 4, '', 9, '', 1, 1),
(17, '2012-09-17 13:06:51', '2012-12-11 01:54:39', 'Video URL', '', 1, 2, 'Enter external video URL from YouTube, Vimeo etc.', 5, '', 1, 1),
(19, '2012-08-10 05:42:52', '2012-12-11 02:17:29', 'Project Info', '', 2, 6, '', 0, '', 0, 1),
(20, '2012-08-10 05:43:59', '2012-12-11 02:17:29', 'Location', '', 2, 7, '', 3, '', 1, 1),
(21, '2012-08-10 05:44:20', '2012-12-11 02:17:29', 'Project Updates', '', 2, 7, '', 4, '', 1, 1),
(22, '2012-08-10 05:44:41', '2012-12-11 02:17:29', 'Social feeds', '', 2, 8, '', 7, '', 1, 1),
(23, '2012-08-10 05:44:59', '2012-12-11 02:17:29', 'Donating', '', 2, 6, '', 1, '', 0, 0),
(24, '2012-08-13 09:41:34', '2012-12-11 02:17:29', 'Media Files', '', 2, 7, 'You can add files related to this project. The file type can be jpg, jpeg, png, gif, doc, xls, txt, wmv, flv or pdf.', 6, '', 1, 1),
(25, '2012-08-13 09:42:31', '2012-12-11 02:17:29', 'Websites', '', 2, 8, '', 8, '', 1, 1),
(26, '2012-09-17 13:06:51', '2012-12-11 02:17:29', 'Video URL', '', 2, 7, 'Enter external video URL from YouTube, Vimeo etc.', 5, '', 1, 1),
(27, '2012-08-13 09:42:31', '2012-12-11 01:54:39', 'Description', '', 1, 2, '', 2, '', 1, 1),
(29, '2012-12-11 02:07:06', '2012-12-11 02:17:29', 'Description', '', 2, 7, '', 2, '', 1, 1),
(30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Project Info', '', 3, 10, '', 0, '', 0, 1),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Location', '', 3, 11, '', 3, '', 1, 1),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Project Updates', '', 3, 11, '', 4, '', 1, 1),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Social feeds', '', 3, 12, '', 7, '', 1, 1),
(34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lending', '', 3, 10, '', 1, '', 0, 0),
(35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Media Files', '', 3, 11, 'You can add files related to this project. The file type can be jpg, jpeg, png, gif, doc, xls, txt, wmv, flv or pdf.', 6, '', 1, 1),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Websites', '', 3, 12, '', 8, '', 1, 1),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Video URL', '', 3, 11, 'Enter external video URL from YouTube, Vimeo etc.', 5, '', 1, 1),
(39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Description', '', 3, 11, '', 2, '', 1, 1),
(40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Project Info', '', 4, 14, '', 0, '', 0, 1),
(41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Location', '', 4, 15, '', 3, '', 1, 1),
(42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Project Updates', '', 4, 15, '', 4, '', 1, 1),
(43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Social feeds', '', 4, 16, '', 7, '', 1, 1),
(44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Investing', '', 4, 14, '', 1, '', 0, 0),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Media Files', '', 4, 15, 'You can add files related to this project. The file type can be jpg, jpeg, png, gif, doc, xls, txt, wmv, flv or pdf.', 6, '', 1, 1),
(46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Websites', '', 4, 16, '', 8, '', 1, 1),
(47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Video URL', '', 4, 15, 'Enter external video URL from YouTube, Vimeo etc.', 5, '', 1, 1),
(49, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Description', '', 4, 15, '', 2, '', 1, 1),
(50, '2013-04-09 17:38:47', '2013-04-09 17:38:47', 'Personal Details', '', 3, 11, '', 13, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_field_steps`
--

DROP TABLE IF EXISTS `form_field_steps`;
CREATE TABLE IF NOT EXISTS `form_field_steps` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `project_type_id` bigint(20) NOT NULL,
  `info` text NOT NULL,
  `order` bigint(20) NOT NULL,
  `is_deletable` tinyint(1) NOT NULL default '0',
  `is_splash` tinyint(1) NOT NULL default '0',
  `additional_info` varchar(255) NOT NULL,
  `is_payment_step` tinyint(1) NOT NULL default '0',
  `is_editable` tinyint(1) NOT NULL default '0',
  `is_payout_step` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`),
  KEY `project_type_id` (`project_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_field_steps`
--

INSERT INTO `form_field_steps` (`id`, `created`, `modified`, `name`, `slug`, `project_type_id`, `info`, `order`, `is_deletable`, `is_splash`, `additional_info`, `is_payment_step`, `is_editable`, `is_payout_step`) VALUES
(1, '2012-12-03 05:45:32', '2012-12-11 01:54:39', 'Basics', '', 1, '', 1, 0, 0, '', 0, 1, 0),
(2, '2012-12-03 05:45:41', '2012-12-11 01:54:39', 'Details', '', 1, '', 2, 0, 0, '', 0, 1, 0),
(3, '2012-12-03 05:45:49', '2012-12-11 01:54:39', 'Rewards', '', 1, '', 3, 0, 0, '', 0, 1, 0),
(4, '2012-12-03 05:45:56', '2012-12-11 01:54:39', 'Social', '', 1, '', 4, 0, 0, '', 0, 1, 0),
(5, '2012-12-03 05:46:04', '2012-12-11 01:54:39', 'Payout', '', 1, '', 5, 0, 0, '', 0, 1, 1),
(6, '0000-00-00 00:00:00', '2012-12-11 02:17:29', 'Basics', '', 2, '', 1, 0, 0, '', 0, 1, 0),
(7, '0000-00-00 00:00:00', '2012-12-11 02:17:29', 'Details', '', 2, '', 2, 0, 0, '', 0, 1, 0),
(8, '0000-00-00 00:00:00', '2012-12-11 02:17:29', 'Social', '', 2, '', 3, 0, 0, '', 0, 1, 0),
(9, '0000-00-00 00:00:00', '2012-12-11 02:17:29', 'Payout', '', 2, '', 4, 0, 0, '', 0, 1, 1),
(10, '2013-03-16 12:47:04', '2013-03-16 12:47:02', 'Basics', '', 3, '', 1, 0, 0, '', 0, 1, 0),
(11, '2013-03-16 12:47:29', '2013-03-16 12:47:34', 'Details', '', 3, '', 2, 0, 0, '', 0, 1, 0),
(12, '2013-03-16 12:49:03', '2013-03-16 12:49:06', 'Social', '', 3, '', 3, 0, 0, '', 0, 1, 0),
(14, '2013-03-16 12:47:04', '2013-03-16 12:47:02', 'Basics', '', 4, '', 1, 0, 0, '', 0, 1, 0),
(15, '2013-03-16 12:47:29', '2013-03-16 12:47:34', 'Details', '', 4, '', 2, 0, 0, '', 0, 1, 0),
(16, '2013-03-16 12:49:03', '2013-03-16 12:49:06', 'Social', '', 4, '', 3, 0, 0, '', 0, 1, 0),
(20, '2013-04-09 13:13:56', '2013-04-09 13:13:56', 'Payment', '', 4, '', 4, 1, 0, '', 1, 0, 0),
(18, '2013-04-09 13:09:41', '2013-04-09 13:09:41', 'Payment', '', 1, '', 6, 1, 0, '', 1, 0, 0),
(19, '2013-04-09 13:11:17', '2013-04-09 13:11:17', 'Confirmation', '', 1, '', 7, 1, 1, 'Admin will approve,  after confirmed your filled data', 0, 0, 0),
(21, '2013-04-09 13:14:33', '2013-04-09 13:14:33', 'Payment', '', 3, '', 4, 1, 0, '', 1, 0, 0),
(22, '2013-04-09 13:15:46', '2013-04-09 13:15:46', 'Confirmation', '', 4, 'Admin will approve,  after confirmed your filled data', 5, 1, 1, 'Admin will approve,  after confirmed your filled data', 0, 0, 0),
(23, '2013-04-09 13:16:01', '2013-04-09 13:16:01', 'Confirmation', '', 3, 'Admin will approve,  after confirmed your filled data', 5, 1, 1, 'Admin will approve,  after confirmed your filled data', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Gender details';

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `created`, `modified`, `name`) VALUES
(1, '2009-02-12 09:41:37', '2009-02-12 09:41:37', 'Male'),
(2, '2009-02-12 09:41:37', '2011-09-30 11:47:42', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `income_ranges`
--

DROP TABLE IF EXISTS `income_ranges`;
CREATE TABLE IF NOT EXISTS `income_ranges` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `income` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `income_ranges`
--

INSERT INTO `income_ranges` (`id`, `created`, `modified`, `income`, `is_active`) VALUES
(1, '2010-11-23 19:54:35', '2011-09-30 11:49:38', 'Under 20,000', 1),
(2, '2010-11-23 19:54:55', '2010-11-23 19:54:58', '20,000 - 29,000', 1),
(3, '2010-11-23 19:55:18', '2010-11-23 19:55:24', '30,000 - 39,999', 1),
(4, '2010-11-23 19:55:38', '2010-11-23 19:55:40', '40,000 - 49,999', 1),
(5, '2010-11-23 19:55:57', '2010-11-23 19:56:00', '50,000 - 69,999', 1),
(6, '2010-11-23 19:56:11', '2010-11-23 19:56:14', '70,000 - 99,999', 1),
(7, '2010-11-23 19:56:28', '2010-11-23 19:56:30', '100,000 - 149,000', 1),
(8, '2010-11-23 19:56:45', '2010-11-23 19:56:47', '150,000 or more', 1),
(9, '2010-11-23 19:57:03', '2010-11-23 19:57:05', 'Prefer not to share', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

DROP TABLE IF EXISTS `ips`;
CREATE TABLE IF NOT EXISTS `ips` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `ip` varchar(255) collate utf8_unicode_ci default NULL,
  `host` varchar(255) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `timezone_id` bigint(20) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `user_agent` varchar(500) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `timezone_id` (`timezone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Ips Details';

--
-- Dumping data for table `ips`
--


-- --------------------------------------------------------

--
-- Table structure for table `jobs_act_entries`
--

DROP TABLE IF EXISTS `jobs_act_entries`;
CREATE TABLE IF NOT EXISTS `jobs_act_entries` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `net_worth` double(10,2) default NULL,
  `annual_income_individual` double(10,2) default NULL,
  `annual_income_with_spouse` double(10,2) default NULL,
  `total_asset` double(10,2) default NULL,
  `household_income` double(10,2) default NULL,
  `annual_expenses` double(10,2) default NULL,
  `liquid_net_worth` double(10,2) default NULL,
  `number_of_dependents` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_act_entries`
--


-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(80) collate utf8_unicode_ci NOT NULL,
  `iso2` varchar(5) collate utf8_unicode_ci NOT NULL,
  `iso3` varchar(5) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Language Details ';

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `created`, `modified`, `name`, `iso2`, `iso3`, `is_active`) VALUES
(1, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Abkhazian', 'ab', 'abk', 0),
(2, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Afar', 'aa', 'aar', 1),
(3, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Afrikaans', 'af', 'afr', 1),
(4, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Akan', 'ak', 'aka', 1),
(5, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Albanian', 'sq', 'sqi', 1),
(6, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Amharic', 'am', 'amh', 1),
(7, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Arabic', 'ar', 'ara', 1),
(8, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Aragonese', 'an', 'arg', 1),
(9, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Armenian', 'hy', 'hye', 1),
(10, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Assamese', 'as', 'asm', 1),
(11, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Avaric', 'av', 'ava', 1),
(12, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Avestan', 'ae', 'ave', 1),
(13, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Aymara', 'ay', 'aym', 1),
(14, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Azerbaijani', 'az', 'aze', 1),
(15, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bambara', 'bm', 'bam', 1),
(16, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bashkir', 'ba', 'bak', 1),
(17, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Basque', 'eu', 'eus', 1),
(18, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Belarusian', 'be', 'bel', 1),
(19, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bengali', 'bn', 'ben', 1),
(20, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bihari', 'bh', 'bih', 1),
(21, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bislama', 'bi', 'bis', 1),
(22, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bosnian', 'bs', 'bos', 1),
(23, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Breton', 'br', 'bre', 1),
(24, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bulgarian', 'bg', 'bul', 1),
(25, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Burmese', 'my', 'mya', 1),
(26, '2009-07-01 13:52:24', '2011-10-22 08:13:07', 'Catalan', 'ca', 'cat', 1),
(27, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chamorro', 'ch', 'cha', 1),
(28, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chechen', 'ce', 'che', 1),
(29, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chichewa', 'ny', 'nya', 1),
(30, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chinese', 'zh', 'zho', 1),
(31, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Church Slavic', 'cu', 'chu', 1),
(32, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chuvash', 'cv', 'chv', 1),
(33, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Cornish', 'kw', 'cor', 1),
(34, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Corsican', 'co', 'cos', 1),
(35, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Cree', 'cr', 'cre', 1),
(36, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Croatian', 'hr', 'hrv', 1),
(37, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Czech', 'cs', 'ces', 1),
(38, '2009-07-01 13:52:25', '2011-05-23 12:29:53', 'Danish', 'da', 'dan', 1),
(39, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Divehi', 'dv', 'div', 1),
(40, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Dutch', 'nl', 'nld', 1),
(41, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Dzongkha', 'dz', 'dzo', 1),
(42, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'English', 'en', 'eng', 1),
(43, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Esperanto', 'eo', 'epo', 1),
(44, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Estonian', 'et', 'est', 1),
(45, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ewe', 'ee', 'ewe', 1),
(46, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Faroese', 'fo', 'fao', 1),
(47, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Fijian', 'fj', 'fij', 1),
(48, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Finnish', 'fi', 'fin', 1),
(49, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'French', 'fr', 'fra', 1),
(50, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Fulah', 'ff', 'ful', 1),
(51, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Galician', 'gl', 'glg', 1),
(52, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ganda', 'lg', 'lug', 1),
(53, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Georgian', 'ka', 'kat', 1),
(54, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'German', 'de', 'deu', 1),
(55, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Greek', 'el', 'ell', 1),
(56, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'GuaranÃƒÆ’Ã†â€™Ãƒ', 'gn', 'grn', 1),
(57, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Gujarati', 'gu', 'guj', 1),
(58, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Haitian', 'ht', 'hat', 1),
(59, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hausa', 'ha', 'hau', 1),
(60, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hebrew', 'he', 'heb', 1),
(61, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Herero', 'hz', 'her', 1),
(62, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hindi', 'hi', 'hin', 1),
(63, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hiri Motu', 'ho', 'hmo', 1),
(64, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hungarian', 'hu', 'hun', 1),
(65, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Icelandic', 'is', 'isl', 1),
(66, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ido', 'io', 'ido', 1),
(67, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Igbo', 'ig', 'ibo', 1),
(68, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Indonesian', 'id', 'ind', 1),
(69, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Interlingua (International Auxiliary Language Association)', 'ia', 'ina', 1),
(70, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Interlingue', 'ie', 'ile', 1),
(71, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Inuktitut', 'iu', 'iku', 1),
(72, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Inupiaq', 'ik', 'ipk', 1),
(73, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Irish', 'ga', 'gle', 1),
(74, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Italian', 'it', 'ita', 1),
(75, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Japanese', 'ja', 'jpn', 1),
(76, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Javanese', 'jv', 'jav', 1),
(77, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kalaallisut', 'kl', 'kal', 1),
(78, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kannada', 'kn', 'kan', 1),
(79, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kanuri', 'kr', 'kau', 1),
(80, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kashmiri', 'ks', 'kas', 1),
(81, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kazakh', 'kk', 'kaz', 1),
(82, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Khmer', 'km', 'khm', 1),
(83, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kikuyu', 'ki', 'kik', 1),
(84, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kinyarwanda', 'rw', 'kin', 1),
(85, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kirghiz', 'ky', 'kir', 1),
(86, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kirundi', 'rn', 'run', 1),
(87, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Komi', 'kv', 'kom', 1),
(88, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kongo', 'kg', 'kon', 1),
(89, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Korean', 'ko', 'kor', 1),
(90, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kurdish', 'ku', 'kur', 1),
(91, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kwanyama', 'kj', 'kua', 1),
(92, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lao', 'lo', 'lao', 1),
(93, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Latin', 'la', 'lat', 1),
(94, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Latvian', 'lv', 'lav', 1),
(95, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Limburgish', 'li', 'lim', 1),
(96, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lingala', 'ln', 'lin', 1),
(97, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lithuanian', 'lt', 'lit', 1),
(98, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Luba-Katanga', 'lu', 'lub', 1),
(99, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Luxembourgish', 'lb', 'ltz', 1),
(100, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Macedonian', 'mk', 'mkd', 1),
(101, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malagasy', 'mg', 'mlg', 1),
(102, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malay', 'ms', 'msa', 1),
(103, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malayalam', 'ml', 'mal', 1),
(104, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Maltese', 'mt', 'mlt', 1),
(105, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Manx', 'gv', 'glv', 1),
(106, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'MÃƒÆ’Ã†â€™Ãƒ', 'mi', 'mri', 1),
(107, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Marathi', 'mr', 'mar', 1),
(108, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Marshallese', 'mh', 'mah', 1),
(109, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Mongolian', 'mn', 'mon', 1),
(110, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Nauru', 'na', 'nau', 1),
(111, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Navajo', 'nv', 'nav', 1),
(112, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ndonga', 'ng', 'ndo', 1),
(113, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Nepali', 'ne', 'nep', 1),
(114, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'North Ndebele', 'nd', 'nde', 1),
(115, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Northern Sami', 'se', 'sme', 1),
(116, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian', 'no', 'nor', 1),
(117, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian BokmÃƒÆ’Ã†â€™Ãƒ', 'nb', 'nob', 1),
(118, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian Nynorsk', 'nn', 'nno', 1),
(119, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Occitan', 'oc', 'oci', 1),
(120, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ojibwa', 'oj', 'oji', 1),
(121, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Oriya', 'or', 'ori', 1),
(122, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Oromo', 'om', 'orm', 1),
(123, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ossetian', 'os', 'oss', 1),
(124, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'PÃƒÆ’Ã†â€™Ãƒ', 'pi', 'pli', 1),
(125, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Panjabi', 'pa', 'pan', 1),
(126, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Pashto', 'ps', 'pus', 1),
(127, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Persian', 'fa', 'fas', 1),
(128, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Polish', 'pl', 'pol', 1),
(129, '2009-07-01 13:52:25', '2011-07-29 21:54:08', 'Portuguese', 'pt', 'por', 1),
(130, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Quechua', 'qu', 'que', 1),
(131, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Raeto-Romance', 'rm', 'roh', 1),
(132, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Romanian', 'ro', 'ron', 1),
(133, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Russian', 'ru', 'rus', 1),
(134, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Samoan', 'sm', 'smo', 1),
(135, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sango', 'sg', 'sag', 1),
(136, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sanskrit', 'sa', 'san', 1),
(137, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sardinian', 'sc', 'srd', 1),
(138, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Scottish Gaelic', 'gd', 'gla', 1),
(139, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Serbian', 'sr', 'srp', 1),
(140, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Shona', 'sn', 'sna', 1),
(141, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sichuan Yi', 'ii', 'iii', 1),
(142, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sindhi', 'sd', 'snd', 1),
(143, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sinhala', 'si', 'sin', 1),
(144, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Slovak', 'sk', 'slk', 1),
(145, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Slovenian', 'sl', 'slv', 1),
(146, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Somali', 'so', 'som', 1),
(147, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'South Ndebele', 'nr', 'nbl', 1),
(148, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Southern Sotho', 'st', 'sot', 1),
(149, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Spanish', 'es', 'spa', 1),
(150, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sundanese', 'su', 'sun', 1),
(151, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swahili', 'sw', 'swa', 1),
(152, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swati', 'ss', 'ssw', 1),
(153, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swedish', 'sv', 'swe', 1),
(154, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tagalog', 'tl', 'tgl', 1),
(155, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tahitian', 'ty', 'tah', 1),
(156, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tajik', 'tg', 'tgk', 1),
(157, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tamil', 'ta', 'tam', 1),
(158, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tatar', 'tt', 'tat', 1),
(159, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Telugu', 'te', 'tel', 1),
(160, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Thai', 'th', 'tha', 1),
(161, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Tibetan', 'bo', 'bod', 1),
(162, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tigrinya', 'ti', 'tir', 1),
(163, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tonga', 'to', 'ton', 1),
(164, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Traditional Chinese', 'zh-TW', 'zh-TW', 1),
(165, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tsonga', 'ts', 'tso', 1),
(166, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tswana', 'tn', 'tsn', 1),
(167, '2009-07-01 13:52:25', '2011-08-23 00:35:34', 'Turkish', 'tr', 'tur', 1),
(168, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Turkmen', 'tk', 'tuk', 1),
(169, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Twi', 'tw', 'twi', 1),
(170, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Uighur', 'ug', 'uig', 1),
(171, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ukrainian', 'uk', 'ukr', 1),
(172, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Urdu', 'ur', 'urd', 1),
(173, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Uzbek', 'uz', 'uzb', 1),
(174, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Venda', 've', 'ven', 1),
(175, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Vietnamese', 'vi', 'vie', 1),
(176, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'VolapÃƒÆ’Ã†â€™Ãƒ', 'vo', 'vol', 1),
(177, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Walloon', 'wa', 'wln', 1),
(178, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Welsh', 'cy', 'cym', 1),
(179, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Western Frisian', 'fy', 'fry', 1),
(180, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Wolof', 'wo', 'wol', 1),
(181, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Xhosa', 'xh', 'xho', 1),
(182, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Yiddish', 'yi', 'yid', 1),
(183, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Yoruba', 'yo', 'yor', 1),
(184, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Zhuang', 'za', 'zha', 1),
(185, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Zulu', 'zu', 'zul', 1),
(186, '2011-10-11 08:00:42', '2011-10-11 08:00:42', 'Chinese', 'ch', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lend_names`
--

DROP TABLE IF EXISTS `lend_names`;
CREATE TABLE IF NOT EXISTS `lend_names` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `average_rate` double(10,2) NOT NULL,
  `total_repayment_amount` double(10,2) NOT NULL,
  `total_repayment_percentage` double(10,2) NOT NULL,
  `total_repayment_interest_amount` double(10,2) NOT NULL,
  `project_fund_count` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lend_names`
--


-- --------------------------------------------------------

--
-- Table structure for table `lend_names_credit_scores`
--

DROP TABLE IF EXISTS `lend_names_credit_scores`;
CREATE TABLE IF NOT EXISTS `lend_names_credit_scores` (
  `id` bigint(20) NOT NULL auto_increment,
  `lend_name_id` bigint(20) NOT NULL,
  `credit_score_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lend_name_id` (`lend_name_id`),
  KEY `credit_score_id` (`credit_score_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lend_names_credit_scores`
--


-- --------------------------------------------------------

--
-- Table structure for table `lend_names_lend_project_categories`
--

DROP TABLE IF EXISTS `lend_names_lend_project_categories`;
CREATE TABLE IF NOT EXISTS `lend_names_lend_project_categories` (
  `id` bigint(20) NOT NULL auto_increment,
  `lend_name_id` bigint(20) NOT NULL,
  `lend_project_category_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lend_name_id` (`lend_name_id`),
  KEY `lend_project_category_id` (`lend_project_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lend_names_lend_project_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `lend_names_loan_terms`
--

DROP TABLE IF EXISTS `lend_names_loan_terms`;
CREATE TABLE IF NOT EXISTS `lend_names_loan_terms` (
  `id` bigint(20) NOT NULL auto_increment,
  `lend_name_id` bigint(20) NOT NULL,
  `loan_term_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lend_name_id` (`lend_name_id`),
  KEY `loan_term_id` (`loan_term_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lend_names_loan_terms`
--


-- --------------------------------------------------------

--
-- Table structure for table `lend_project_categories`
--

DROP TABLE IF EXISTS `lend_project_categories`;
CREATE TABLE IF NOT EXISTS `lend_project_categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(265) collate utf8_unicode_ci default NULL,
  `lend_count` bigint(20) unsigned NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lend_project_categories`
--

INSERT INTO `lend_project_categories` (`id`, `created`, `modified`, `name`, `slug`, `lend_count`, `is_approved`) VALUES
(1, '2013-03-27 17:07:39', '2013-03-27 17:07:39', 'Credit card refinancing', 'credit-card-refinancing', 0, 1),
(2, '2013-03-27 17:07:39', '2013-03-27 17:07:39', 'Debt consolidation', 'debt-consolidation', 0, 1),
(3, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Home improvement', 'home-improvement', 0, 1),
(4, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Major purchase', 'major-purchase', 0, 1),
(5, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Home buying', 'home-buying', 0, 1),
(6, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Car financing', 'car-financing', 0, 1),
(7, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Wedding expenses', 'wedding-expenses', 0, 1),
(8, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Moving and relocation', 'moving-and-relocation', 0, 1),
(9, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Medical expenses', 'medical-expenses', 0, 1),
(10, '2013-03-27 17:18:41', '2013-03-27 17:18:41', 'Other', 'other', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lend_project_statuses`
--

DROP TABLE IF EXISTS `lend_project_statuses`;
CREATE TABLE IF NOT EXISTS `lend_project_statuses` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `lend_count` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `message` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `is_active` (`is_active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lend_project_statuses`
--

INSERT INTO `lend_project_statuses` (`id`, `created`, `modified`, `name`, `lend_count`, `is_active`, `message`) VALUES
(1, '2010-10-14 13:42:28', '2010-10-14 13:42:31', 'Pending', 0, 1, 'New ##PROJECT## posted by ##PROJECT_OWNER_NAME##'),
(2, '2010-10-14 13:42:43', '2011-03-21 02:47:54', 'Open for lending', 0, 1, 'Open for lending'),
(3, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Project Closed and paid to project owner', 0, 1, 'Project closed'),
(4, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Refunded due to expired', 0, 1, 'Project expired'),
(5, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Refunded due to cancelled', 0, 1, 'Project canceled'),
(6, '2011-02-22 17:47:42', '2011-02-22 17:47:44', 'Project Amount Repayment', 0, 1, 'Project Amount Repayment'),
(8, '0000-00-00 00:00:00', '2011-06-22 05:23:45', 'Open for voting', 0, 1, 'Open for voting');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `id` int(20) NOT NULL auto_increment,
  `parent_id` int(20) default NULL,
  `menu_id` int(20) NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `class` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `link` varchar(255) collate utf8_unicode_ci NOT NULL,
  `target` varchar(255) collate utf8_unicode_ci default NULL,
  `rel` varchar(255) collate utf8_unicode_ci default NULL,
  `status` tinyint(1) NOT NULL default '1',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  `visibility_roles` text collate utf8_unicode_ci,
  `params` text collate utf8_unicode_ci,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `menu_id` (`menu_id`),
  KEY `lft` (`lft`),
  KEY `rght` (`rght`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `parent_id`, `menu_id`, `title`, `class`, `description`, `link`, `target`, `rel`, `status`, `lft`, `rght`, `visibility_roles`, `params`, `modified`, `created`) VALUES
(5, NULL, 4, 'Contact Us', '', '', '/contactus', '', '', 1, 9, 10, NULL, NULL, '2012-07-19 11:51:59', '2012-07-19 11:51:59'),
(1, NULL, 4, 'Term and Conditions', '', '', '/page/term-and-conditions', '', '', 1, 1, 2, NULL, NULL, '2012-07-19 11:59:24', '2012-07-19 11:59:24'),
(2, NULL, 4, 'Privacy Policy', '', '', '/page/privacy-policy', '', '', 1, 3, 4, NULL, NULL, '2012-07-19 11:50:48', '2012-07-19 11:50:48'),
(4, NULL, 4, 'How it Works', '', '', '/how-it-works', '', '', 1, 7, 8, NULL, NULL, '2012-07-19 12:01:44', '2012-07-19 12:01:44'),
(3, NULL, 4, 'Acceptable Use Policy', '', '', '/page/aup', '', '', 1, 5, 6, NULL, NULL, '2012-07-19 12:01:44', '2012-07-19 12:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `loan_terms`
--

DROP TABLE IF EXISTS `loan_terms`;
CREATE TABLE IF NOT EXISTS `loan_terms` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `months` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loan_terms`
--

INSERT INTO `loan_terms` (`id`, `created`, `modified`, `name`, `months`, `is_approved`) VALUES
(1, '2013-03-27 17:24:56', '2013-03-27 17:24:56', '1 Year', 12, 1),
(2, '2013-03-27 17:24:56', '2013-03-27 17:24:56', '2 Years', 24, 1),
(3, '2013-03-27 17:24:56', '2013-03-27 17:24:56', '3 Years', 36, 1),
(4, '2013-03-27 17:24:56', '2013-03-27 17:24:56', '4 Years', 48, 1),
(5, '2013-03-27 17:24:56', '2013-03-27 17:24:56', '5 Years', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(255) collate utf8_unicode_ci NOT NULL,
  `class` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `status` tinyint(1) NOT NULL default '1',
  `weight` int(11) default NULL,
  `link_count` int(11) NOT NULL,
  `params` text collate utf8_unicode_ci,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `alias`, `class`, `description`, `status`, `weight`, `link_count`, `params`, `modified`, `created`) VALUES
(4, 'Footer1', 'footer1', '', '', 1, NULL, 5, '', '2012-07-19 11:43:31', '2009-08-19 12:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `class` varchar(100) collate utf8_unicode_ci default NULL,
  `foreign_id` bigint(20) NOT NULL,
  `user_id` bigint(20) default NULL,
  `other_user_id` bigint(20) default NULL,
  `parent_message_id` bigint(20) default NULL,
  `message_content_id` bigint(20) NOT NULL,
  `message_folder_id` bigint(20) NOT NULL,
  `is_sender` tinyint(1) NOT NULL default '0',
  `is_starred` tinyint(1) default '0',
  `is_read` tinyint(1) default '0',
  `is_private` tinyint(1) NOT NULL default '0',
  `is_deleted` tinyint(1) default '0',
  `is_archived` tinyint(1) NOT NULL default '0',
  `is_communication` tinyint(1) NOT NULL default '0',
  `size` bigint(20) NOT NULL,
  `project_id` bigint(20) unsigned default NULL,
  `project_type_id` int(11) default '0',
  `project_status_id` int(11) default '0',
  `root` bigint(20) NOT NULL,
  `freshness_ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `depth` int(4) NOT NULL,
  `path` text collate utf8_unicode_ci NOT NULL,
  `materialized_path` varchar(256) collate utf8_unicode_ci NOT NULL,
  `activity_id` int(11) NOT NULL,
  `activity_user_id` bigint(20) default '0',
  `is_activity` tinyint(1) NOT NULL default '0',
  `is_anonymous_fund` tinyint(1) NOT NULL default '0',
  `is_hide_from_public` tinyint(1) default '0',
  `is_child_replied` tinyint(1) NOT NULL default '0',
  `is_hide_rejected_activity` tinyint(1) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `other_user_id` (`other_user_id`),
  KEY `parent_message_id` (`parent_message_id`),
  KEY `message_content_id` (`message_content_id`),
  KEY `message_folder_id` (`message_folder_id`),
  KEY `project_id` (`project_id`),
  KEY `root` (`root`),
  KEY `freshness_ts` (`freshness_ts`),
  KEY `depth` (`depth`),
  KEY `materialized_path` (`materialized_path`),
  KEY `activity_id` (`activity_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `activity_user_id` (`activity_user_id`),
  KEY `project_status_id` (`project_status_id`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User messages';

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_contents`
--

DROP TABLE IF EXISTS `message_contents`;
CREATE TABLE IF NOT EXISTS `message_contents` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `subject` text collate utf8_unicode_ci,
  `message` text collate utf8_unicode_ci,
  `is_admin_suspended` tinyint(1) NOT NULL default '0',
  `is_system_flagged` tinyint(1) NOT NULL default '0',
  `detected_suspicious_words` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User messages content';

--
-- Dumping data for table `message_contents`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_filters`
--

DROP TABLE IF EXISTS `message_filters`;
CREATE TABLE IF NOT EXISTS `message_filters` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` bigint(20) default NULL,
  `from_user_id` bigint(20) default '0',
  `to_user_id` bigint(20) default NULL,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  `has_words` varchar(255) collate utf8_unicode_ci default NULL,
  `does_not_has_words` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `subject` (`subject`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Message Filter Details';

--
-- Dumping data for table `message_filters`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_folders`
--

DROP TABLE IF EXISTS `message_folders`;
CREATE TABLE IF NOT EXISTS `message_folders` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Messages folder';

--
-- Dumping data for table `message_folders`
--


-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
CREATE TABLE IF NOT EXISTS `meta` (
  `id` int(20) NOT NULL auto_increment,
  `model` varchar(255) collate utf8_unicode_ci NOT NULL default 'Node',
  `foreign_key` int(20) default NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `value` text collate utf8_unicode_ci,
  `weight` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `money_transfer_accounts`
--

DROP TABLE IF EXISTS `money_transfer_accounts`;
CREATE TABLE IF NOT EXISTS `money_transfer_accounts` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `payment_gateway_id` int(11) NOT NULL,
  `account` varchar(100) collate utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `money_transfer_accounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(20) NOT NULL auto_increment,
  `parent_id` int(20) default NULL,
  `user_id` int(20) NOT NULL default '0',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `excerpt` text collate utf8_unicode_ci,
  `status` tinyint(1) NOT NULL default '0',
  `mime_type` varchar(100) collate utf8_unicode_ci default NULL,
  `comment_status` tinyint(1) NOT NULL default '1',
  `comment_count` int(11) default '0',
  `promote` tinyint(1) NOT NULL default '0',
  `path` varchar(255) collate utf8_unicode_ci NOT NULL,
  `terms` text collate utf8_unicode_ci,
  `sticky` tinyint(1) NOT NULL default '0',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  `visibility_roles` text collate utf8_unicode_ci,
  `type` varchar(100) collate utf8_unicode_ci NOT NULL default 'node',
  `type_id` int(11) NOT NULL default '0',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  `plugin_name` varchar(220) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `slug` (`slug`),
  KEY `lft` (`lft`),
  KEY `rght` (`rght`),
  KEY `type_id` (`type_id`),
  KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nodes`
--

INSERT INTO `nodes` (`id`, `parent_id`, `user_id`, `title`, `slug`, `body`, `excerpt`, `status`, `mime_type`, `comment_status`, `comment_count`, `promote`, `path`, `terms`, `sticky`, `lft`, `rght`, `visibility_roles`, `type`, `type_id`, `updated`, `created`, `plugin_name`) VALUES
(1, NULL, 0, 'Affiliate', 'affiliate', 'In posuere molestie augue, eget tincidunt libero pellentesque nec. Aliquam erat volutpat. Aliquam a ligula nulla, at suscipit odio. Nullam in nibh nibh, eu bibendum ligula. Morbi eu nibh dui. Vivamus scelerisque fermentum lacus et tristique. Sed vulputate euismod metus porta feugiat. Nulla varius venenatis mauris, nec ornare nisl bibendum id. Aenean id orci nisl, in scelerisque nibh. Sed quam sapien, tempus quis vestibulum eu, sagittis varius sapien. Aliquam erat volutpat. Nulla facilisi. In egestas faucibus nunc, et venenatis purus aliquet quis. Nulla eget arcu turpis. Nunc pellentesque eros quis neque sodales hendrerit. Donec eget nibh sit amet ipsum elementum vehicula. Pellentesque molestie diam vitae erat suscipit consequat. Pellentesque vel arcu sit amet metus mattis congue vitae eu quam.\r\n\r\n\r\nNam dapibus vestibulum est, id blandit erat scelerisque id. Morbi vestibulum dignissim sapien, vitae laoreet est vehicula et. Ut pulvinar quam vel est cursus mollis. Nullam imperdiet faucibus odio, sed imperdiet quam elementum id. Fusce varius, odio in porta rutrum, urna dolor porttitor sem, tempus lacinia mi tortor et libero. Suspendisse et ultricies urna. Nam luctus felis non turpis pretium aliquam. Mauris non felis sit amet nibh malesuada luctus ut sit amet risus. Praesent ante tellus, aliquet eget feugiat nec, viverra in elit. Nulla dictum eros et risus consequat mollis.\r\n\r\n\r\nDuis id lectus eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eleifend eros quis ligula porta rutrum mattis non risus. Donec eget neque a turpis elementum egestas nec a enim. Ut ut quam lorem, eget dapibus dolor. Vestibulum nec turpis erat, eget luctus magna. Phasellus ac tincidunt arcu. Etiam et augue massa. Donec eget justo enim. Quisque eget orci eu orci malesuada vestibulum non at magna. Fusce malesuada malesuada faucibus. Nulla ultrices nibh in tellus pellentesque mollis commodo velit placerat. Fusce eget velit velit, vitae adipiscing justo.', '', 1, NULL, 1, 0, 0, '/page/affiliate', NULL, 0, 1, 2, NULL, 'page', 1, '2012-07-19 11:20:51', '2012-07-19 11:20:51', ''),
(2, NULL, 0, 'Acceptable Use Policy', 'aup', '<p>You are independently responsible for complying with all applicable  laws in all of your actions related to your use of PayPal&rsquo;s services,  regardless of the purpose of the use. In addition, you must adhere to  the terms of this Acceptable Use Policy.</p>\r\n<p><strong>Prohibited Activities</strong></p>\r\n<p>You may not use the PayPal service for activities that:</p>\r\n<ol>\r\n<li> violate any law, statute, ordinance or regulation </li>\r\n<li> relate to sales of (a) narcotics, steroids, certain  controlled substances or other products that present a risk to consumer  safety, (b) drug paraphernalia, (c) items that encourage, promote,  facilitate or instruct others to engage in illegal activity, (d) items  that promote hate, violence, racial intolerance, or the financial  exploitation of a crime, (e) items that are considered obscene, (f)  items that infringe or violate any copyright, trademark, right of  publicity or privacy or any other proprietary right under the laws of  any jurisdiction, (g) certain sexually oriented materials or services,  (h) ammunition, firearms, or certain firearm parts or accessories, or  (i) certain weapons or knives regulated under applicable law </li>\r\n<li> relate to transactions that (a) show the personal information  of third parties in violation of applicable law, (b) support pyramid or  ponzi schemes, matrix programs, other &ldquo;get rich quick&rdquo; schemes or  certain multi-level marketing programs, (c) are associated with  purchases of real property, annuities or lottery contracts, lay-away  systems, off-shore banking or transactions to finance or refinance debts  funded by a credit card, (d) are for the sale of certain items before  the seller has control or possession of the item, (e) are by payment  processors to collect payments on behalf of merchants, (f) are  associated with the following Money Service Business Activities: the  sale of traveler&rsquo;s cheques or money orders, currency exchanges or cheque  cashing, or (g) provide certain credit repair or debt settlement  services </li>\r\n<li> involve the sales of products or services identified by government agencies to have a high likelihood of being fraudulent </li>\r\n<li>violate applicable laws or industry regulations regarding the  sale of (a) tobacco products, or (b) prescription drugs and devices</li>\r\n<li> involve gambling, gaming and/or any other activity with an  entry fee and a prize, including, but not limited to casino games,  sports betting, horse or greyhound racing, lottery tickets, other  ventures that facilitate gambling, games of skill (whether or not it is  legally defined as a lottery) and sweepstakes unless the operator has  obtained prior approval from PayPal and the operator and customers are  located exclusively in jurisdictions where such activities are permitted  by law. </li>\r\n</ol>', '', 1, NULL, 1, 0, 0, '/page/aup', NULL, 0, 3, 4, NULL, 'page', 1, '2012-07-19 11:27:45', '2012-07-19 11:27:45', ''),
(3, NULL, 0, 'Project Guidelines', 'project_guidelines', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', 1, NULL, 1, 0, 0, '/page/project_guidelines', NULL, 0, 5, 6, NULL, 'page', 1, '2012-07-19 11:30:50', '2012-07-19 11:30:50', ''),
(4, NULL, 0, 'Pledge FAQ', 'pledge_info', '<h5>How do I make a pledge?</h5> <p>Lorem ipsum lorem ipsum lorem  ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum .</p> <h5>When is amount  charged?</h5> <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem  ipsum</p>', '', 1, NULL, 1, 0, 0, '/page/pledge_info', NULL, 0, 7, 8, NULL, 'page', 1, '2012-07-19 11:31:43', '2012-07-19 11:31:43', 'Pledge'),
(5, NULL, 0, 'Learn more', 'learn_more', 'Coming soon', '', 1, NULL, 1, 0, 0, '/page/learn_more', NULL, 0, 9, 10, NULL, 'page', 1, '2012-07-19 11:32:52', '2012-07-19 11:32:52', ''),
(6, NULL, 0, 'Privacy Policy', 'privacy-policy', '<p>For each visitor to our Web page our Web server automatically recognizes no information regarding the domain or e-mail address.</p><p>We collect the e-mail addresses of those who post messages to our bulletin board the e-mail addresses of those who communicate with us via e-mail the e-mail addresses of those who make postings to our chat areas user-specific information on what pages consumers access or visit information volunteered by the consumer such as survey information and/or site registrations name and address telephone number.</p><p>The information we collect is disclosed when legally required to do so at the request of governmental authorities conducting an investigation to verify or enforce compliance with the policies governing our Website and applicable laws or to protect against misuse or unauthorized use of our Website to a successor entity in connection with a corporate merger consolidation sale of assets or other corporate change respecting the Website.</p><p>With respect to cookies. We use cookies to record session information such as items that consumers add to their shopping cart.</p><p>If you do not want to receive e-mail from us in the future please let us know by sending us e-mail at the above address.</p><p>Persons who supply us with their telephone numbers on-line will only receive telephone contact from us with information regarding orders they have placed on-line. Please provide us with your name and phone number. We will be sure your name is removed from the list we share with other organizations.</p><p>With respect to Ad Servers. We do not partner with or have special relationships with any ad server companies.</p><p>From time to time we may use customer information for new unanticipated uses not previously disclosed in our privacy notice. If our information practices change at some time in the future we will post the policy changes to our Web site to notify you of these changes and we will use for these new purposes only data collected from the time of the policy change forward. If you are concerned about how your information is used you should check back at our Web site periodically.</p><p>Upon request we provide site visitors with access to transaction information (e.g. dates on which customers made purchases amounts and types of purchases) that we maintain about them.</p><p>Upon request we offer visitors the ability to have inaccuracies corrected in contact information transaction information.</p><p>With respect to security. When we transfer and receive certain types of sensitive information such as financial or health information we redirect visitors to a secure server and will notify visitors through a pop-up screen on our site.</p><p>If you feel that this site is not following its stated information policy you may contact us at the above addresses or phone number.</p>\r\n', '<p>For each visitor to our Web page our Web server automatically recognizes no information regarding the domain or e-mail address.</p><p>We collect the e-mail addresses of those who post messages to our bulletin board the e-mail addresses of those who communicate with us via e-mail the e-mail addresses of those who make postings to our chat areas user-specific information on what pages consumers access or visit information volunteered by the consumer such as survey information and/or site registrations name and address telephone number.</p><p>The information we collect is disclosed when legally required to do so at the request of governmental authorities conducting an investigation to verify or enforce compliance with the policies governing our Website and applicable laws or to protect against misuse or unauthorized use of our Website to a successor entity in connection with a corporate merger consolidation sale of assets or other corporate change respecting the Website.</p><p>With respect to cookies. We use cookies to record session information such as items that consumers add to their shopping cart.</p><p>If you do not want to receive e-mail from us in the future please let us know by sending us e-mail at the above address.</p><p>Persons who supply us with their telephone numbers on-line will only receive telephone contact from us with information regarding orders they have placed on-line. Please provide us with your name and phone number. We will be sure your name is removed from the list we share with other organizations.</p><p>With respect to Ad Servers. We do not partner with or have special relationships with any ad server companies.</p><p>From time to time we may use customer information for new unanticipated uses not previously disclosed in our privacy notice. If our information practices change at some time in the future we will post the policy changes to our Web site to notify you of these changes and we will use for these new purposes only data collected from the time of the policy change forward. If you are concerned about how your information is used you should check back at our Web site periodically.</p><p>Upon request we provide site visitors with access to transaction information (e.g. dates on which customers made purchases amounts and types of purchases) that we maintain about them.</p><p>Upon request we offer visitors the ability to have inaccuracies corrected in contact information transaction information.</p><p>With respect to security. When we transfer and receive certain types of sensitive information such as financial or health information we redirect visitors to a secure server and will notify visitors through a pop-up screen on our site.</p><p>If you feel that this site is not following its stated information policy you may contact us at the above addresses or phone number.</p>\r\n', 1, NULL, 1, 0, 0, '/page/privacy-policy', NULL, 0, 11, 12, NULL, 'page', 1, '2012-07-19 11:33:34', '2012-07-19 11:33:34', ''),
(7, NULL, 0, 'How it works', 'how-it-works', 'Coming soon', '', 1, NULL, 1, 0, 0, '/page/how-it-works', NULL, 0, 13, 14, NULL, 'page', 1, '2012-07-19 11:34:25', '2012-07-19 11:34:25', ''),
(8, NULL, 0, 'Terms and conditions', 'term-and-conditions', '<h2 class=green-head>Web Site Terms and Conditions of Use</h2><h3>1. Terms</h3><p>By accessing this web site you are agreeing to be bound by these web site Terms and Conditions of Use all applicable laws and regulations and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trade mark law.</p><h3>2. Use License</h3><ol><li>Permission is granted to temporarily download one copy of the materials (information or software) on Teachnlearn''s web site for personal non-commercial transitory viewing only. This is the grant of a license not a transfer of title and under this license you may not:<ol><li>modify or copy the materials;</li><li>use the materials for any commercial purpose or for any public display (commercial or non-commercial);</li><li>attempt to decompile or reverse engineer any software contained on Teachnlearn''s web site;</li><li>remove any copyright or other proprietary notations from the materials; or</li><li>transfer the materials to another person or mirror the materials on any other server.</li></ol></li><li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by Teachnlearn at any time. Upon terminating your viewing of these materials or upon the termination of this license you must destroy any downloaded materials in your possession whether in electronic or printed format.</li></ol><h3>3. Disclaimer</h3><p>The materials on Teachnlearn''s web site are provided as is. Teachnlearn makes no warranties expressed or implied and hereby disclaims and negates all other warranties including without limitation implied warranties or conditions of merchantability fitness for a particular purpose or non-infringement of intellectual property or other violation of rights. Further Teachnlearn does not warrant or make any representations concerning the accuracy likely results or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.</p><h3>4. Limitations</h3><p>In no event shall Teachnlearn or its suppliers be liable for any damages (including without limitation damages for loss of data or profit or due to business interruption) arising out of the use or inability to use the materials on Teachnlearn''s Internet site even if Teachnlearn or a Teachnlearn authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties or limitations of liability for consequential or incidental damages these limitations may not apply to you.</p><h3>5. Revisions and Errata</h3><p>The materials appearing on Teachnlearn''s web site could include technical typographical or photographic errors. Teachnlearn does not warrant that any of the materials on its web site are accurate complete or current. Teachnlearn may make changes to the materials contained on its web site at any time without notice. Teachnlearn does not however make any commitment to update the materials.</p><h3>6. Links</h3><p>Teachnlearn has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Teachnlearn of the site. Use of any such linked web site is at the user''s own risk.</p><h3>7. Site Terms of Use Modifications</h3><p>Teachnlearn may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>\r\n', '<h2 class=green-head>Web Site Terms and Conditions of Use</h2><h3>1. Terms</h3><p>By accessing this web site you are agreeing to be bound by these web site Terms and Conditions of Use all applicable laws and regulations and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trade mark law.</p><h3>2. Use License</h3><ol><li>Permission is granted to temporarily download one copy of the materials (information or software) on Teachnlearn''s web site for personal non-commercial transitory viewing only. This is the grant of a license not a transfer of title and under this license you may not:<ol><li>modify or copy the materials;</li><li>use the materials for any commercial purpose or for any public display (commercial or non-commercial);</li><li>attempt to decompile or reverse engineer any software contained on Teachnlearn''s web site;</li><li>remove any copyright or other proprietary notations from the materials; or</li><li>transfer the materials to another person or mirror the materials on any other server.</li></ol></li><li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by Teachnlearn at any time. Upon terminating your viewing of these materials or upon the termination of this license you must destroy any downloaded materials in your possession whether in electronic or printed format.</li></ol><h3>3. Disclaimer</h3><p>The materials on Teachnlearn''s web site are provided as is. Teachnlearn makes no warranties expressed or implied and hereby disclaims and negates all other warranties including without limitation implied warranties or conditions of merchantability fitness for a particular purpose or non-infringement of intellectual property or other violation of rights. Further Teachnlearn does not warrant or make any representations concerning the accuracy likely results or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.</p><h3>4. Limitations</h3><p>In no event shall Teachnlearn or its suppliers be liable for any damages (including without limitation damages for loss of data or profit or due to business interruption) arising out of the use or inability to use the materials on Teachnlearn''s Internet site even if Teachnlearn or a Teachnlearn authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties or limitations of liability for consequential or incidental damages these limitations may not apply to you.</p><h3>5. Revisions and Errata</h3><p>The materials appearing on Teachnlearn''s web site could include technical typographical or photographic errors. Teachnlearn does not warrant that any of the materials on its web site are accurate complete or current. Teachnlearn may make changes to the materials contained on its web site at any time without notice. Teachnlearn does not however make any commitment to update the materials.</p><h3>6. Links</h3><p>Teachnlearn has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Teachnlearn of the site. Use of any such linked web site is at the user''s own risk.</p><h3>7. Site Terms of Use Modifications</h3><p>Teachnlearn may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>\r\n', 1, NULL, 1, 0, 0, '/page/term-and-conditions', NULL, 0, 15, 16, NULL, 'page', 1, '2012-11-24 03:26:26', '2012-07-19 11:35:00', ''),
(9, NULL, 0, 'About', 'about', '<p>Coming soon</p>', '', 1, NULL, 1, 0, 0, '/page/about', NULL, 0, 17, 18, NULL, 'page', 1, '2012-07-19 11:37:28', '2012-07-19 11:37:28', ''),
(10, NULL, 0, 'FAQ', 'faq', 'Coming soon', '', 1, NULL, 1, 0, 0, '/page/faq', NULL, 0, 19, 20, NULL, 'page', 1, '2012-07-19 11:38:14', '2012-07-19 11:38:14', ''),
(16, NULL, 0, 'home banner', 'home-banner', '<div class="well no-round"><div class="container"><div class="row pr"><div class="span17"> <img src="##BANNER_IMAGE_URL##" width="660" height="300" alt="[Image: banner]" title="Crowdfunding platform for creative projects" /> </div><div class="span13 pa banner-bg offset13"><div class="offset2 ver-space blackc"><h4 class="ver-space bot-mspace htruncate">Crowdfunding platform for creative projects</h4><p><a href="http://www.agriya.com/services/website-clones/kickstarter-clone" target="_blank">Agriya Crowdfunding</a> is the first complete crowdfunding software that helps you to run your own crowdfunding site. <a href="http://labs.agriya.com/sfplatform" target="_blank">Compared to Kickstarter</a>, Crowdfunding has lot of additional features and superior UI. Other crowdfunding sites that can directly be competed with Crowdfunding are: Kickstarter.com, indiegogo.com, rockethub.com, profounder.com, crowdbackers.com, fundageek.com, rockthepost.com, start.ac, kapipal.com, fundedbyme.com, gofundme.com.</p><p>This version has better plugin architecture and viral marketing ability.</p><div class="clearfix offset3 top-space"> <span class="pull-left ver-space"><a href="##BROWSE_URL##" title="Browse" class="js-tooltip">Browse</a></span> <span class="space textb pull-left text-16">OR</span> <a href="##ADD_URL##" title="Start Project" class="js-tooltip btn btn-large btn-primary pull-left">Start Project</a> </div></div></div></div></div></div>', '<div class="well no-round"><div class="container"><div class="row pr"><div class="span17"> <img src="##BANNER_IMAGE_URL##" width="660" height="300" alt="[Image: banner]" title="Crowdfunding platform for creative projects" /> </div><div class="span13 pa banner-bg offset13"><div class="offset2 ver-space blackc"><h4 class="ver-space bot-mspace htruncate">Crowdfunding platform for creative projects</h4><p><a href="http://www.agriya.com/services/website-clones/kickstarter-clone" target="_blank">Agriya Crowdfunding</a> is the first complete crowdfunding software that helps you to run your own crowdfunding site. <a href="http://labs.agriya.com/sfplatform" target="_blank">Compared to Kickstarter</a>, Crowdfunding has lot of additional features and superior UI. Other crowdfunding sites that can directly be competed with Crowdfunding are: Kickstarter.com, indiegogo.com, rockethub.com, profounder.com, crowdbackers.com, fundageek.com, rockthepost.com, start.ac, kapipal.com, fundedbyme.com, gofundme.com.</p><p>This version has better plugin architecture and viral marketing ability.</p><div class="clearfix offset3 top-space"> <span class="pull-left ver-space"><a href="##BROWSE_URL##" title="Browse" class="js-tooltip">Browse</a></span> <span class="space textb pull-left text-16">OR</span> <a href="##ADD_URL##" title="Start Project" class="js-tooltip btn btn-large btn-primary pull-left">Start Project</a> </div></div></div></div></div></div>', 1, NULL, 1, 0, 0, '', NULL, 0, NULL, NULL, NULL, 'page', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(17, NULL, 0, 'Donate FAQ', 'donate_info', '<h5>How do I make a donate?</h5> <p>Lorem ipsum lorem ipsum lorem  ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum .</p> <h5>When is amount  charged?</h5> <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem  ipsum</p>', NULL, 1, NULL, 1, 0, 0, '/page/donate_info', NULL, 0, 21, 22, NULL, 'page', 1, '2012-12-03 12:19:13', '2012-12-03 12:19:16', 'Donate'),
(18, NULL, 0, 'Lend FAQ', 'lend_info', '<h5>How do I make a lend?</h5> <p>Lorem ipsum lorem ipsum lorem  ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum .</p> <h5>When is amount  charged?</h5> <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem  ipsum</p>', NULL, 1, NULL, 1, 0, 0, '/page/lend_info', NULL, 0, 23, 24, NULL, 'page', 1, '2012-12-03 12:19:13', '2012-12-03 12:19:16', 'Lend'),
(19, NULL, 0, 'Equity FAQ', 'equity_info', '<h5>How do I make a equity?</h5> <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum .</p> <h5>When is amount charged?</h5> <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>', NULL, 1, NULL, 1, 0, 0, '/page/equity_info', NULL, 0, 25, 26, NULL, 'page', 1, '2012-12-03 12:19:13', '2012-12-03 12:19:16', 'Equity'),
(20, NULL, 0, 'Lend Terms', 'lend-terms', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, NULL, 1, 0, 0, '/page/lend_terms', NULL, 0, 5, 6, NULL, 'page', 1, '2013-04-04 16:51:47', '2013-04-04 16:51:50', 'Lend');

-- --------------------------------------------------------

--
-- Table structure for table `nodes_taxonomies`
--

DROP TABLE IF EXISTS `nodes_taxonomies`;
CREATE TABLE IF NOT EXISTS `nodes_taxonomies` (
  `id` int(20) NOT NULL auto_increment,
  `node_id` int(20) NOT NULL default '0',
  `taxonomy_id` int(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `node_id` (`node_id`),
  KEY `taxonomy_id` (`taxonomy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nodes_taxonomies`
--

INSERT INTO `nodes_taxonomies` (`id`, `node_id`, `taxonomy_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int(10) NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `display_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `gateway_fees` double(10,2) default NULL,
  `transaction_count` bigint(20) unsigned default '0',
  `payment_gateway_setting_count` bigint(20) unsigned default '0',
  `is_test_mode` tinyint(1) default '0',
  `is_active` tinyint(1) default '0',
  `is_mass_pay_enabled` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `created`, `modified`, `name`, `display_name`, `description`, `gateway_fees`, `transaction_count`, `payment_gateway_setting_count`, `is_test_mode`, `is_active`, `is_mass_pay_enabled`) VALUES
(2, NULL, '2012-05-21 02:48:51', 'Wallet', 'Wallet', 'Payment within the website using user''s account balance.', NULL, 0, 0, 1, 1, 0),
(3, '2013-06-04 17:27:49', '2013-06-04 17:27:49', 'SudoPay', 'SudoPay', 'Payment through SudoPay', 2.90, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_settings`
--

DROP TABLE IF EXISTS `payment_gateway_settings`;
CREATE TABLE IF NOT EXISTS `payment_gateway_settings` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `payment_gateway_id` bigint(20) unsigned NOT NULL,
  `name` varchar(256) collate utf8_unicode_ci default NULL,
  `type` varchar(8) collate utf8_unicode_ci default NULL,
  `options` text collate utf8_unicode_ci,
  `test_mode_value` text collate utf8_unicode_ci,
  `live_mode_value` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `payment_gateway_id` (`payment_gateway_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_gateway_settings`
--

INSERT INTO `payment_gateway_settings` (`id`, `created`, `modified`, `payment_gateway_id`, `name`, `type`, `options`, `test_mode_value`, `live_mode_value`, `description`) VALUES
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'is_enable_for_project', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for project listing'),
(18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'is_enable_for_pledge', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for pledge'),
(23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'is_enable_for_donate', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for donate'),
(26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'is_enable_for_lend', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for lend'),
(27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'is_enable_for_equity', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for equity'),
(28, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'sudopay_merchant_id', 'text', '', '', '', ''),
(29, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'sudopay_website_id', 'text', '', '', '', ''),
(30, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'sudopay_secret_string', 'text', '', '', '', ''),
(31, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'is_enable_for_add_to_wallet', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for wallet add.'),
(32, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'is_enable_for_project', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for project listing'),
(33, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'is_enable_for_pledge', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for pledge'),
(34, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'is_enable_for_donate', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for donate'),
(35, '2013-05-31 13:38:29', '2013-05-31 13:38:29', 3, 'is_enable_for_signup_fee', 'checkbox', NULL, '1', '1', 'Enable/Disable the current payment option for signup fee.'),
(38, '2013-07-22 17:09:03', '2013-07-22 17:09:05', 3, 'sudopay_api_key', 'text', NULL, NULL, NULL, ''),
(39, '2013-07-22 17:20:49', '2013-07-22 17:20:51', 3, 'is_payment_via_api', 'checkbox', '', NULL, '1', 'Enable/Disable the current payment option'),
(40, '2013-07-26 21:44:57', '2013-07-26 21:44:59', 3, 'sudopay_subscription_plan', 'text', NULL, 'Enterprise', 'Enterprise', 'Subscription plan name');

-- --------------------------------------------------------

--
-- Table structure for table `persistent_logins`
--

DROP TABLE IF EXISTS `persistent_logins`;
CREATE TABLE IF NOT EXISTS `persistent_logins` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `series` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expires` varchar(50) default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persistent_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `pledge_project_categories`
--

DROP TABLE IF EXISTS `pledge_project_categories`;
CREATE TABLE IF NOT EXISTS `pledge_project_categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(265) collate utf8_unicode_ci default NULL,
  `pledge_count` bigint(20) unsigned NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pledge_project_categories`
--

INSERT INTO `pledge_project_categories` (`id`, `created`, `modified`, `name`, `slug`, `pledge_count`, `is_approved`) VALUES
(1, '2010-09-16 20:44:19', '2012-05-08 06:16:47', 'Art', 'art', 0, 1),
(2, '2010-09-16 20:53:02', '2011-10-05 11:53:32', 'Comedy', 'comedy', 0, 1),
(3, '2010-09-16 20:53:15', '2010-09-16 20:53:17', 'Comics', 'comics', 0, 1),
(4, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Community', 'community', 0, 1),
(5, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Crafts', 'crafts', 0, 1),
(6, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Dance', 'dance', 0, 1),
(7, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Design', 'design', 0, 1),
(8, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Events', 'events', 0, 1),
(9, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Fashion', 'fashion', 0, 1),
(10, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Food', 'food', 0, 1),
(11, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Film/Video', 'film-video', 0, 1),
(12, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Gaming', 'gaming', 0, 1),
(13, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Journalism', 'journalism', 0, 1),
(14, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Music', 'music', 0, 1),
(15, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Photography', 'photography', 0, 1),
(16, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Technology', 'technology', 0, 1),
(17, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Theater', 'Theater', 0, 1),
(18, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Writing/Publishing', 'writing-publishing', 0, 1),
(19, '2010-09-16 20:44:19', '2010-09-16 20:44:22', 'Other', 'other', 0, 1),
(20, '2012-05-12 06:39:57', '2012-05-12 06:39:57', 'Plantation', 'plantation', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pledge_project_statuses`
--

DROP TABLE IF EXISTS `pledge_project_statuses`;
CREATE TABLE IF NOT EXISTS `pledge_project_statuses` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `pledge_count` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `message` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pledge_project_statuses`
--

INSERT INTO `pledge_project_statuses` (`id`, `created`, `modified`, `name`, `pledge_count`, `is_active`, `message`) VALUES
(1, '2010-10-14 13:42:28', '2010-10-14 13:42:31', 'Pending', 0, 1, 'New ##PROJECT## posted by ##PROJECT_OWNER_NAME##'),
(2, '2010-10-14 13:42:43', '2011-03-21 02:47:54', 'Open for funding', 0, 1, 'Open for pledging'),
(3, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Funding closed and paid to project owner', 0, 1, 'Funding closed'),
(4, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Refunded due to expired', 0, 1, 'Project expired'),
(5, '2010-10-14 13:42:45', '2010-10-14 13:42:45', 'Refunded due to cancelled', 0, 1, 'Project canceled'),
(6, '2011-02-22 17:47:42', '2011-02-22 17:47:44', 'Goal reached', 0, 1, 'Goal reached'),
(8, '0000-00-00 00:00:00', '2011-06-22 05:23:45', 'Open for voting', 0, 1, 'Open for voting');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(255) collate utf8_unicode_ci default NULL,
  `hash` varchar(255) collate utf8_unicode_ci NOT NULL,
  `short_description` text collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `parent_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `referred_by_user_id` bigint(20) default '0',
  `project_type_id` bigint(20) NOT NULL,
  `payment_method_id` int(5) NOT NULL,
  `city_id` bigint(20) NOT NULL default '0',
  `state_id` bigint(20) NOT NULL default '0',
  `country_id` bigint(20) NOT NULL default '0',
  `address` varchar(500) collate utf8_unicode_ci default NULL,
  `address1` varchar(500) collate utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `project_start_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `project_cancelled_date` datetime NOT NULL,
  `collected_amount` double(10,2) NOT NULL,
  `collected_percentage` double(10,2) NOT NULL,
  `needed_amount` double(10,2) default '0.00',
  `fee_amount` double(10,2) NOT NULL default '0.00',
  `commission_amount` double default '0',
  `admin_commission_amount` double(10,2) default '0.00',
  `affiliate_commission_amount` double(10,2) default '0.00',
  `sudopay_payment_id` int(11) default NULL,
  `sudopay_pay_key` varchar(255) collate utf8_unicode_ci default NULL,
  `feed_url` varchar(255) collate utf8_unicode_ci NOT NULL,
  `facebook_feed_url` varchar(255) collate utf8_unicode_ci default NULL,
  `twitter_feed_url` varchar(255) collate utf8_unicode_ci default NULL,
  `video_embed_url` varchar(255) collate utf8_unicode_ci default NULL,
  `total_ratings` double(5,2) default '0.00',
  `actual_rating` bigint(20) NOT NULL default '0',
  `mean_rating` bigint(20) NOT NULL default '0',
  `project_rating_count` int(10) NOT NULL,
  `project_view_count` bigint(20) NOT NULL,
  `project_feed_count` bigint(20) NOT NULL,
  `project_fund_count` int(10) NOT NULL,
  `project_flag_count` bigint(20) unsigned NOT NULL default '0',
  `project_comment_count` int(11) NOT NULL,
  `blog_count` bigint(20) NOT NULL,
  `project_follower_count` bigint(20) unsigned NOT NULL,
  `message_count` bigint(20) NOT NULL default '0',
  `embed_view_count` bigint(20) NOT NULL,
  `referred_purchase_count` bigint(20) NOT NULL,
  `facebook_share_count` bigint(20) NOT NULL,
  `twitter_share_count` bigint(20) NOT NULL,
  `gmail_share_count` bigint(20) NOT NULL,
  `linkedin_share_count` bigint(20) NOT NULL,
  `rewarded_count` bigint(20) NOT NULL,
  `reward_given_count` bigint(20) NOT NULL,
  `detected_suspicious_words` varchar(512) collate utf8_unicode_ci default NULL,
  `is_admin_suspended` tinyint(1) NOT NULL default '0',
  `is_system_flagged` tinyint(1) NOT NULL default '0',
  `is_user_flagged` tinyint(1) NOT NULL default '0',
  `is_draft` tinyint(1) NOT NULL default '0',
  `is_private` tinyint(1) NOT NULL default '0',
  `is_active` tinyint(1) NOT NULL default '0',
  `is_featured` tinyint(1) NOT NULL default '0',
  `is_paid` tinyint(1) NOT NULL default '0',
  `ip_id` bigint(20) default NULL,
  `is_successful` tinyint(1) NOT NULL default '0',
  `tracked_steps` text collate utf8_unicode_ci NOT NULL,
  `is_pending_action_to_admin` tinyint(1) NOT NULL default '0',
  `angelist_startup_id` bigint(20) default NULL,
  `project_reward_count` int(5) NOT NULL,
  `sudopay_gateway_id` bigint(20) default NULL,
  `sudopay_revised_amount` double(10,2) NOT NULL,
  `sudopay_token` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`),
  KEY `project_type_id` (`project_type_id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `angelist_startup_id` (`angelist_startup_id`),
  KEY `parent_id` (`parent_id`),
  KEY `referred_by_user_id` (`referred_by_user_id`),
  KEY `ip_id` (`ip_id`),
  KEY `payment_method_id` (`payment_method_id`),
  KEY `sudopay_payment_id` (`sudopay_payment_id`),
  KEY `sudopay_pay_key` (`sudopay_pay_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `projects`
--


-- --------------------------------------------------------

--
-- Table structure for table `projects_users`
--

DROP TABLE IF EXISTS `projects_users`;
CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_donate_fields`
--

DROP TABLE IF EXISTS `project_donate_fields`;
CREATE TABLE IF NOT EXISTS `project_donate_fields` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `donate_project_status_id` int(5) NOT NULL,
  `donate_project_category_id` bigint(20) NOT NULL,
  `pledge_type_id` bigint(20) default '1',
  `min_amount_to_fund` varchar(255) collate utf8_unicode_ci NOT NULL,
  `project_donate_goal_reached_date` datetime default NULL,
  `is_allow_over_donating` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `pledge_type_id` (`pledge_type_id`),
  KEY `user_id` (`user_id`),
  KEY `donate_project_status_id` (`donate_project_status_id`),
  KEY `donate_project_category_id` (`donate_project_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `project_donate_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_equity_fields`
--

DROP TABLE IF EXISTS `project_equity_fields`;
CREATE TABLE IF NOT EXISTS `project_equity_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `equity_project_status_id` bigint(20) unsigned NOT NULL,
  `equity_project_category_id` bigint(20) unsigned NOT NULL,
  `project_fund_goal_reached_date` datetime default NULL,
  `total_shares` bigint(20) NOT NULL,
  `shares_allocated` bigint(20) NOT NULL,
  `is_seis_or_eis` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `equity_project_status_id` (`equity_project_status_id`),
  KEY `equity_project_category_id` (`equity_project_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_equity_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_feeds`
--

DROP TABLE IF EXISTS `project_feeds`;
CREATE TABLE IF NOT EXISTS `project_feeds` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date` (`date`),
  KEY `project_type_id` (`project_type_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_feeds`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_flags`
--

DROP TABLE IF EXISTS `project_flags`;
CREATE TABLE IF NOT EXISTS `project_flags` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `project_flag_category_id` bigint(20) unsigned NOT NULL,
  `message` text collate utf8_unicode_ci,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_flag_category_id` (`project_flag_category_id`),
  KEY `project_id` (`project_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Project Flag Details';

--
-- Dumping data for table `project_flags`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_flag_categories`
--

DROP TABLE IF EXISTS `project_flag_categories`;
CREATE TABLE IF NOT EXISTS `project_flag_categories` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `name` varchar(250) collate utf8_unicode_ci default NULL,
  `project_flag_count` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Project Flag Category Details';

--
-- Dumping data for table `project_flag_categories`
--

INSERT INTO `project_flag_categories` (`id`, `created`, `modified`, `name`, `project_flag_count`, `is_active`) VALUES
(1, '2010-05-14', '2010-05-14', 'Sexual Content', 0, 1),
(2, '2010-05-14', '2010-05-14', 'Violent or Repulsive Content', 0, 1),
(3, '2010-05-14', '2010-05-14', 'Hatful or Abusive Content', 0, 1),
(4, '2010-05-14', '2010-05-14', 'Ham Dangerous Acts', 0, 1),
(5, '2010-05-14', '2010-05-14', 'Spam', 0, 1),
(6, '2010-05-14', '2010-05-14', 'Infrings My Rights', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_followers`
--

DROP TABLE IF EXISTS `project_followers`;
CREATE TABLE IF NOT EXISTS `project_followers` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `project_type_id` (`project_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_followers`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_funds`
--

DROP TABLE IF EXISTS `project_funds`;
CREATE TABLE IF NOT EXISTS `project_funds` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `owner_user_id` bigint(20) NOT NULL,
  `referred_by_user_id` bigint(20) NOT NULL,
  `payment_gateway_id` bigint(20) NOT NULL default '0',
  `project_id` bigint(20) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `lend_name_id` bigint(20) NOT NULL default '0',
  `amount` double(10,2) NOT NULL default '0.00',
  `site_fee` double(10,2) NOT NULL default '0.00',
  `is_anonymous` smallint(4) default '0',
  `project_fund_status_id` smallint(4) default '4',
  `is_canceled_from_gateway` tinyint(1) NOT NULL default '0',
  `auth_id` varchar(100) collate utf8_unicode_ci default NULL,
  `auth_amount` varchar(20) collate utf8_unicode_ci default NULL,
  `commission_amount` double NOT NULL default '0',
  `admin_commission_amount` double NOT NULL default '0',
  `affiliate_commission_amount` double NOT NULL default '0',
  `mc_currency` varchar(10) collate utf8_unicode_ci default NULL,
  `latitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) collate utf8_unicode_ci NOT NULL,
  `unique_coupon_code` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_given` tinyint(1) NOT NULL default '0',
  `reward_given_date` datetime default NULL,
  `project_reward_id` bigint(20) NOT NULL,
  `project_widget_id` bigint(20) NOT NULL,
  `canceled_by_user_id` int(11) default '0',
  `is_collection` tinyint(1) NOT NULL default '0',
  `sudopay_gateway_id` bigint(20) default NULL,
  `sudopay_payment_id` bigint(20) default NULL,
  `sudopay_pay_key` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `auth_id` (`auth_id`),
  KEY `owner_user_id` (`owner_user_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `canceled_by_user_id` (`canceled_by_user_id`),
  KEY `referred_by_user_id` (`referred_by_user_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `lend_name_id` (`lend_name_id`),
  KEY `project_fund_status_id` (`project_fund_status_id`),
  KEY `project_reward_id` (`project_reward_id`),
  KEY `project_widget_id` (`project_widget_id`),
  KEY `sudopay_gateway_id` (`sudopay_gateway_id`),
  KEY `sudopay_payment_id` (`sudopay_payment_id`),
  KEY `sudopay_pay_key` (`sudopay_pay_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `project_funds`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_fund_donate_fields`
--

DROP TABLE IF EXISTS `project_fund_donate_fields`;
CREATE TABLE IF NOT EXISTS `project_fund_donate_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_fund_id` bigint(20) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_fund_id` (`project_fund_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_fund_donate_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_fund_equity_fields`
--

DROP TABLE IF EXISTS `project_fund_equity_fields`;
CREATE TABLE IF NOT EXISTS `project_fund_equity_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_fund_id` bigint(20) unsigned NOT NULL,
  `shares_allocated` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_fund_id` (`project_fund_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_fund_equity_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_fund_lend_fields`
--

DROP TABLE IF EXISTS `project_fund_lend_fields`;
CREATE TABLE IF NOT EXISTS `project_fund_lend_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_fund_id` bigint(20) unsigned NOT NULL,
  `interest_rate` double(10,2) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_fund_id` (`project_fund_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_fund_lend_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_fund_pledge_fields`
--

DROP TABLE IF EXISTS `project_fund_pledge_fields`;
CREATE TABLE IF NOT EXISTS `project_fund_pledge_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_fund_id` bigint(20) unsigned NOT NULL,
  `project_reward_id` bigint(20) unsigned NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_address1` text NOT NULL,
  `city_id` bigint(20) default NULL,
  `state_id` bigint(20) default NULL,
  `country_id` bigint(20) default NULL,
  `zip_code` varchar(100) NOT NULL,
  `additional_info` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_fund_id` (`project_fund_id`),
  KEY `project_reward_id` (`project_reward_id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_fund_pledge_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_fund_repayments`
--

DROP TABLE IF EXISTS `project_fund_repayments`;
CREATE TABLE IF NOT EXISTS `project_fund_repayments` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `owner_user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `project_fund_id` bigint(20) NOT NULL,
  `project_repayment_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `interest` double(10,2) NOT NULL,
  `interest_rate` double(10,2) NOT NULL,
  `term` int(11) NOT NULL,
  `is_late` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `owner_user_id` (`owner_user_id`),
  KEY `project_id` (`project_id`),
  KEY `project_fund_id` (`project_fund_id`),
  KEY `project_repayment_id` (`project_repayment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_fund_repayments`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_lend_fields`
--

DROP TABLE IF EXISTS `project_lend_fields`;
CREATE TABLE IF NOT EXISTS `project_lend_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `lend_project_status_id` bigint(20) unsigned NOT NULL,
  `lend_project_category_id` bigint(20) unsigned NOT NULL,
  `credit_score_id` bigint(20) NOT NULL,
  `loan_term_id` bigint(20) NOT NULL default '0',
  `repayment_schedule_id` bigint(20) NOT NULL,
  `project_fund_goal_reached_date` datetime default NULL,
  `target_interest_rate` double(10,2) NOT NULL,
  `next_repayment_date` date NOT NULL,
  `next_repayment_amount` double(10,2) NOT NULL,
  `repayment_amount` double(10,2) NOT NULL,
  `repayment_percentage` double(10,2) NOT NULL,
  `repayment_interest_amount` double(10,2) NOT NULL,
  `is_repayment_notified` tinyint(1) NOT NULL default '0',
  `is_late_repayment_notified` tinyint(1) NOT NULL default '0',
  `is_collection` tinyint(1) NOT NULL default '0',
  `repayment_count` int(11) NOT NULL,
  `late_repayment_count` int(11) NOT NULL,
  `total_arrear_count` int(11) NOT NULL,
  `total_no_of_repayment` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `credit_score_id` (`credit_score_id`),
  KEY `loan_term_id` (`loan_term_id`),
  KEY `repayment_schedule_id` (`repayment_schedule_id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `lend_project_status_id` (`lend_project_status_id`),
  KEY `lend_project_category_id` (`lend_project_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_lend_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_pledge_fields`
--

DROP TABLE IF EXISTS `project_pledge_fields`;
CREATE TABLE IF NOT EXISTS `project_pledge_fields` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `pledge_project_status_id` int(5) NOT NULL,
  `pledge_project_category_id` bigint(20) NOT NULL,
  `pledge_type_id` bigint(20) default '1',
  `min_amount_to_fund` varchar(255) collate utf8_unicode_ci NOT NULL,
  `project_fund_goal_reached_date` datetime default NULL,
  `is_allow_over_funding` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `pledge_type_id` (`pledge_type_id`),
  KEY `user_id` (`user_id`),
  KEY `pledge_project_status_id` (`pledge_project_status_id`),
  KEY `pledge_project_category_id` (`pledge_project_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `project_pledge_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_ratings`
--

DROP TABLE IF EXISTS `project_ratings`;
CREATE TABLE IF NOT EXISTS `project_ratings` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `rating` double(5,2) NOT NULL default '0.00',
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `project_ratings`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_repayments`
--

DROP TABLE IF EXISTS `project_repayments`;
CREATE TABLE IF NOT EXISTS `project_repayments` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `late_fee` double(10,2) NOT NULL,
  `interest` double(10,2) NOT NULL,
  `term` int(11) NOT NULL,
  `is_late` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_repayments`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_rewards`
--

DROP TABLE IF EXISTS `project_rewards`;
CREATE TABLE IF NOT EXISTS `project_rewards` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `pledge_amount` double(10,2) NOT NULL,
  `reward` text collate utf8_unicode_ci,
  `estimated_delivery_date` date NULL,
  `pledge_max_user_limit` bigint(20) unsigned default '0',
  `project_fund_count` bigint(20) unsigned default NULL,
  `is_shipping` tinyint(1) NOT NULL default '0',
  `is_having_additional_info` tinyint(1) NOT NULL default '0',
  `additional_info_label` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_rewards`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

DROP TABLE IF EXISTS `project_types`;
CREATE TABLE IF NOT EXISTS `project_types` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(45) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `project_count` bigint(20) NOT NULL,
  `form_field_count` bigint(20) NOT NULL,
  `form_field_step_count` bigint(20) NOT NULL,
  `form_field_group_count` bigint(20) NOT NULL,
  `project_fund_count` bigint(20) NOT NULL,
  `project_fund_amount` double NOT NULL,
  `site_revenue` double NOT NULL,
  `commission_percentage` double(10,2) default NULL,
  `commission_percentage_not_reached_need_amount` double(10,2) default NULL,
  `listing_fee` double(10,2) default NULL,
  `listing_fee_type` int(11) default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `funder_slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `is_active` (`is_active`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`id`, `name`, `slug`, `description`, `project_count`, `form_field_count`, `form_field_step_count`, `form_field_group_count`, `project_fund_count`, `project_fund_amount`, `site_revenue`, `commission_percentage`, `commission_percentage_not_reached_need_amount`, `listing_fee`, `listing_fee_type`, `is_active`, `funder_slug`) VALUES
(1, 'Pledge', 'pledge', '', 0, 45, 7, 11, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'backer'),
(2, 'Donate', 'donate', '', 0, 34, 4, 10, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'donor'),
(3, 'Lend', 'lend', '', 0, 43, 5, 11, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'lender'),
(4, 'Equity', 'equity', '', 0, 34, 5, 10, 0, 0, 0, NULL, NULL, NULL, NULL, 1, 'investor');

-- --------------------------------------------------------

--
-- Table structure for table `project_views`
--

DROP TABLE IF EXISTS `project_views`;
CREATE TABLE IF NOT EXISTS `project_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `user_id` bigint(20) default NULL,
  `project_view_type_id` bigint(20) NOT NULL default '1',
  `project_widget_id` bigint(20) NOT NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `project_widget_id` (`project_widget_id`),
  KEY `ip_id` (`ip_id`),
  KEY `project_view_type_id` (`project_view_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Project View Details';

--
-- Dumping data for table `project_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_view_types`
--

DROP TABLE IF EXISTS `project_view_types`;
CREATE TABLE IF NOT EXISTS `project_view_types` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(250) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_view_types`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_widgets`
--

DROP TABLE IF EXISTS `project_widgets`;
CREATE TABLE IF NOT EXISTS `project_widgets` (
  `id` int(100) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_widgets`
--


-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `block_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `title`, `alias`, `description`, `block_count`) VALUES
(2, 'chart', 'chart', 'module wise project chart', 4),
(1, 'nodehome', 'nodehome', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

DROP TABLE IF EXISTS `relationships`;
CREATE TABLE IF NOT EXISTS `relationships` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `relationship` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `created`, `modified`, `relationship`, `is_active`) VALUES
(1, '2010-11-23 20:01:39', '2011-09-30 11:51:59', 'Single, not married', 1),
(2, '2010-11-23 20:01:54', '2010-11-23 20:01:57', 'Married', 1),
(3, '2010-11-23 20:02:07', '2010-11-23 20:02:09', 'Living with partner', 1),
(4, '2010-11-23 20:02:21', '2010-11-23 20:02:23', 'Separated', 1),
(5, '2010-11-23 20:02:41', '2010-11-23 20:02:44', 'Divorced', 1),
(6, '2010-11-23 20:02:53', '2010-11-23 20:02:55', 'Widowed', 1),
(7, '2010-11-23 20:03:10', '2010-11-23 20:03:12', 'Prefer not to share', 1),
(8, '2011-11-07 13:02:18', '2011-11-07 13:02:18', 'new', 0);

-- --------------------------------------------------------

--
-- Table structure for table `repayment_schedules`
--

DROP TABLE IF EXISTS `repayment_schedules`;
CREATE TABLE IF NOT EXISTS `repayment_schedules` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `day` int(11) NOT NULL,
  `is_particular_day_of_month` tinyint(1) NOT NULL default '0',
  `is_approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repayment_schedules`
--

INSERT INTO `repayment_schedules` (`id`, `created`, `modified`, `name`, `day`, `is_particular_day_of_month`, `is_approved`) VALUES
(1, '2013-03-27 18:05:16', '2013-03-27 18:05:16', 'Every 5th of month', 5, 1, 1),
(2, '2013-03-27 18:05:16', '2013-03-27 18:05:16', 'Every 10th of month', 10, 1, 1),
(3, '2013-03-27 18:05:16', '2013-03-27 18:05:16', 'Every 15th of month', 15, 1, 1),
(4, '2013-03-27 18:05:16', '2013-03-27 18:05:16', 'Every 10 days', 10, 0, 1),
(5, '2013-03-27 18:05:16', '2013-03-27 18:05:16', 'Every 15 days', 15, 0, 1),
(6, '2013-03-27 18:05:16', '2013-03-27 18:05:16', 'Every 28 days', 28, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(250) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Type Details';

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created`, `modified`, `name`) VALUES
(1, NULL, NULL, 'admin'),
(2, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `security_questions`
--

DROP TABLE IF EXISTS `security_questions`;
CREATE TABLE IF NOT EXISTS `security_questions` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_questions`
--

INSERT INTO `security_questions` (`id`, `created`, `modified`, `name`, `slug`, `is_active`) VALUES
(1, '2012-11-06 11:35:04', '2012-11-06 11:35:04', 'What was the last name of your first grade teacher?', 'what-was-the-last-name-of-your-first-grade-teacher', 0),
(2, '2012-11-06 11:35:17', '2012-11-06 11:35:17', 'In what city or town was your mother born?', 'in-what-city-or-town-was-your-mother-born', 1),
(3, '2012-11-06 11:35:33', '2012-11-06 11:35:33', 'What street did you live on when you were 8 years old?', 'what-street-did-you-live-on-when-you-were-8-years-old', 1),
(4, '2012-11-06 11:35:43', '2012-11-06 11:35:43', 'What was the last name of your third grade teacher?', 'what-was-the-last-name-of-your-third-grade-teacher', 1),
(5, '2012-11-06 11:36:53', '2012-11-06 11:36:53', 'What was your grandfather''s occupation?', 'what-was-your-grandfather-s-occupation', 1),
(6, '2012-11-06 11:39:35', '2012-11-09 06:06:46', 'What was your grandmother''s occupation?', 'what-was-your-grandmother-s-occupation', 0),
(7, '2012-11-09 06:04:13', '2012-11-23 08:05:37', 'What your first mobile number?', 'what-your-first-mobile-number', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seis_entries`
--

DROP TABLE IF EXISTS `seis_entries`;
CREATE TABLE IF NOT EXISTS `seis_entries` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `company_name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `number_of_employees` bigint(20) NOT NULL,
  `year_of_founding` datetime NOT NULL,
  `total_asset` double(10,2) NOT NULL,
  `is_seis_or_eis` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seis_entries`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `setting_category_id` int(11) NOT NULL,
  `setting_category_parent_id` bigint(20) default '0',
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `value` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci,
  `type` varchar(8) collate utf8_unicode_ci default NULL,
  `options` text collate utf8_unicode_ci,
  `label` varchar(255) collate utf8_unicode_ci default NULL,
  `order` int(11) NOT NULL,
  `plugin_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `setting_category_id` (`setting_category_id`),
  KEY `name` (`name`),
  KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Setting Details';

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_category_id`, `setting_category_parent_id`, `name`, `value`, `description`, `type`, `options`, `label`, `order`, `plugin_name`) VALUES
(1, 16, 1, 'site.name', 'Crowdfunding', 'This name will be used in all pages and emails.', 'text', NULL, 'Site Name', 1, ''),
(2, 1, 0, 'site.version', 'v2.0b2', 'It specifies the version of the site.', 'text', NULL, 'Site Version', 2, ''),
(3, 2, 34, 'meta.keywords', 'agriya, crowdfund, crowdfunding, kickstarter clone, fundbreak clone, thepoint clone, Sponsume clone, RocketHub clone', 'These are the keywords used for improving search engine results of your site. (Comma separated texts for multiple keywords.)', 'text', NULL, 'Keywords', 1, ''),
(4, 2, 34, 'meta.description', 'Crowdfunding helps you develop different clone in a crowdfunding fashion', 'These are the short descriptions for your site which will be used by the search engines on the search result pages to display preview snippets for a given page.', 'textarea', NULL, 'Description', 2, ''),
(5, 26, 1, 'EmailTemplate.admin_email', 'productdemo.admin+contact+crowdfunding@gmail.com', 'You can change this email address so that contact and other notification mails will come to this email.', 'text', NULL, 'Contact email address', 4, ''),
(9, 36, 3, 'user.using_to_login', 'username', 'You can select the option from the drop-downs to login into the site', 'select', 'username, email', 'Login Handle', 1, ''),
(10, 35, 34, 'site.tracking_script', '<script type="text/javascript"> var _gaq = _gaq || []; _gaq.push([''_setAccount'', ''UA-18572079-3'']); _gaq.push([''_setDomainName'', ''.dev.agriya.com'']); _gaq.push([''_setAllowAnchor'', true]); _gaq.push([''_trackPageview'']); _gaq.push(function() { href = window.location.search; href.replace(/(utm_source|utm_medium|utm_campaign|utm_term|utm_content)+=[^\\\\&]*/g, '''').replace(/\\\\&+/g, ''&'').replace(/\\\\?\\\\&/g, ''?'').replace(/(\\\\?|\\\\&)$/g, ''''); if (history.replaceState) history.replaceState(null, '''', location.pathname + href + location.hash);}); (function() { var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true; ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js''; var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s); })(); </script>', 'This is the site tracker script used for tracking and analyzing the data on how the people are getting into your website. e.g., Google Analytics. <a href="http://www.google.com/analytics" target="_blank">http://www.google.com/analytics</a>', 'textarea', NULL, 'Site Tracker Code', 3, ''),
(25, 7, 0, 'thumb_size.micro_thumb.width', '31', '', 'text', NULL, 'Micro thumb', 0, ''),
(26, 7, 0, 'thumb_size.micro_thumb.height', '31', '', 'text', NULL, '', 0, ''),
(29, 7, 0, 'thumb_size.medium_thumb.width', '50', '', 'text', NULL, 'Medium thumb', 0, ''),
(30, 7, 0, 'thumb_size.medium_thumb.height', '50', '', 'text', NULL, '', 0, ''),
(31, 7, 0, 'thumb_size.normal_thumb.width', '70', '', 'text', NULL, 'Normal thumb', 0, ''),
(32, 7, 0, 'thumb_size.normal_thumb.height', '70', '', 'text', NULL, '', 0, ''),
(33, 7, 0, 'thumb_size.big_thumb.width', '220', '', 'text', NULL, 'Big thumb', 0, ''),
(34, 7, 0, 'thumb_size.big_thumb.height', '165', '', 'text', NULL, '', 0, ''),
(37, 7, 0, 'thumb_size.medium_big_thumb.width', '235', '', 'text', NULL, 'Medium big thumb', 0, ''),
(38, 7, 0, 'thumb_size.medium_big_thumb.height', '173', '', 'text', NULL, '', 0, ''),
(39, 7, 0, 'thumb_size.very_big_thumb.width', '590', '', 'text', NULL, 'Very big thumb', 0, ''),
(40, 7, 0, 'thumb_size.very_big_thumb.height', '350', '', 'text', NULL, '', 0, ''),
(41, 37, 3, 'user.is_admin_activate_after_register', '1', 'On enabling this feature, the user will not be able to login until the Admin (that will be you) approves their registration.', 'checkbox', NULL, 'Enable Administrator Approval After Registration', 7, ''),
(42, 37, 3, 'user.is_email_verification_for_register', '0', 'On enabling this feature, the users are required to verify their email address which will be provided by them during registration. (Users cannot login until the email address is verified)', 'checkbox', NULL, 'Enable Email Verification After Registration', 8, ''),
(43, 37, 3, 'user.is_auto_login_after_register', '0', 'On enabling this feature, users will be automatically logged-in after registration. (Only when "Email Verification" & "Admin Approval" is disabled)', 'checkbox', NULL, 'Enable Auto Login After Registration', 9, ''),
(44, 37, 3, 'user.is_admin_mail_after_register', '1', 'On enabling this feature, notification mail will be sent to administrator on each registration.', 'checkbox', NULL, 'Enable Notify Administrator on Each Registration', 5, ''),
(45, 37, 3, 'user.is_welcome_mail_after_register', '1', 'On enabling this feature, users will receive a welcome mail after registration.', 'checkbox', NULL, 'Enable Sending Welcome Mail After Registration', 6, ''),
(47, 37, 3, 'user.is_logout_after_change_password', '0', 'By enabling this feature, When user changes the password, he will automatically log-out.', 'checkbox', NULL, 'Enable User to Logout after Password Change', 7, ''),
(53, 36, 3, 'openid.is_enabled_openid_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using OpenID.', 'checkbox', NULL, 'Enable OpenID', 2, ''),
(56, 33, 30, 'site.date.format', '%b %d, %Y', 'This is the date format which will be displayed in your site.', 'text', NULL, 'Date Format', 5, ''),
(57, 33, 30, 'site.datetime.format', '%b %d, %Y %I:%M %p', 'This is the date-time format which will be displayed in your site.', 'text', NULL, 'Date-Time Format', 7, ''),
(58, 33, 30, 'site.time.format', '%I:%M %p', 'This is the time format which will be displayed in your site.', 'text', NULL, 'Time Format', 6, ''),
(59, 33, 30, 'site.date.tooltip', '%b %d, %Y %I:%M %p', 'This is the date tooltip format which will be displayed in your site', 'text', NULL, 'Date Tooltip Format ', 8, ''),
(60, 33, 30, 'site.time.tooltip', '%B %d, %Y (%A) %Z', 'This is the time tooltip format which will be displayed in your site.', 'text', NULL, 'Time Tooltip Format', 9, ''),
(61, 33, 30, 'site.datetime.tooltip', '%B %d, %Y %I:%M:%S %p (%A) %Z', 'You can change your date time tooltip of your site using this value.', 'text', NULL, 'Date Time Tooltip', 10, ''),
(71, 29, 28, 'site.maintenance_mode', '0', 'By enabling this feature, only administrator can access the site (e.g., http://yourdomain.com/admin). Users will see a temporary page until you return to turn this off. (Turn this on, whenever you need to perform maintenance in the site.)', 'checkbox', NULL, 'Maintenance mode', 1, ''),
(72, 31, 30, 'site.language', 'en', 'The selected language will be used as default language all over the site.', 'select', NULL, 'Site language ', 1, 'Translation'),
(73, 35, 34, 'site.robots', '', 'Content for robots.txt; (search engine) robots specific instructions. Refer, <a href="http://www.robotstxt.org/">http://www.robotstxt.org/</a> for syntax and usage.', 'textarea', NULL, 'robots.txt', 4, ''),
(159, 33, 30, 'site.datetimehighlight.tooltip', '%B %d, %Y %I:%M:%S %p (%A) %Z', 'You can change your datetimehighlight tooltip of your site using this value.', 'text', NULL, 'Date Time Highlight Tooltip', 11, ''),
(174, 44, 11, 'Project.almost_funded_percentage', '50', 'This is the funded percentage for categorizing projects into almost funded projects. Project categorization is done in Browse page.', 'text', NULL, 'Funded Percentage for Almost Funded Classificaiton', 12, 'Projects'),
(268, 77, 19, 'Project.is_allow_user_to_set_overfunding', '1', 'On enabling this, project owner can set over funding for pledge and donate project.', 'checkbox', NULL, 'Enable to Allow Project Owner to Set Overfunding for pledge and donate Project', 27, ''),
(178, 65, 20, 'Project.is_show_backers_amount_for_guest_users', '1', 'On enabling this, guest user can see the project''s funders amount.', 'checkbox', NULL, 'Allow guest user to view the funders amount', 2, ''),
(179, 32, 30, 'site.currency', '$', 'Site Currency symbol of PayPal Currency Code. eg. $ for USD', 'text', NULL, 'Site Currency Symbol', 3, ''),
(180, 26, 1, 'EmailTemplate.from_email', 'productdemo.admin+noreply+crowdfunding@gmail.com', 'You can change this email address so that ''From'' email will be changed in all email communication.', 'text', NULL, 'From Email Address', 1, ''),
(183, 71, 11, 'messages.content_length', '50', 'This is the maximum number of content length has to display in the message list for user side.', 'text', NULL, 'Maximum Number of Content Length', 6, 'Projects'),
(186, 71, 11, 'messages.is_send_email_on_new_message', '1', 'On enabling this feature, user can receive external e-mail notification for new message.', 'checkbox', NULL, 'Enable Send External E-mail for New Message', 5, 'Projects'),
(189, 71, 11, 'messages.is_allow_send_messsage', '1', 'On enabling this feature, send message will be enabled.', 'checkbox', NULL, 'Enable Send Message', 3, 'Projects'),
(193, 50, 14, 'suspicious_detector.suspiciouswords', 'stupid\r\nfool\r\n\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*([,;]\\s*\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*)*\r\n(?:\\+?1)?[-\\/. ]?[2-9][0-8][0-9][-\\/. ]?[2-9][0-9]{2}[-\\/. ]?[0-9]{4}\r\n^((\\+\\d{1,3}(-| )?\\(?\\d\\)?(-| )?\\d{1,3})|(\\(?\\d{2,3}\\)?))(-| )?(\\d{3,4})(-| )?(\\d{4})(( x| ext)\\d{1,5}){0,1}$\r\n^(?:\\+\\d{1,3}|0\\d{1,3}|00\\d{1,2})?(?:\\s?\\(\\d+\\))?(?:[-\\/\\s.]|\\d)+', 'The suspicious words given will be matched with user given message and will be auto flagged if such words are found. (Note: Detection words should be newline separated.)', 'textarea', NULL, 'Suspicious words', 2, ''),
(194, 51, 14, 'Project.auto_suspend_update_on_system_flag', '1', 'By enabling this, updates posted with suspicious words will automatically be suspended.', 'checkbox', NULL, 'Enable Auto Suspend for Project''s Updates', 17, ''),
(195, 62, 19, 'Project.minimum_amount', '5', 'This is the minimum possible project goal amount.', 'text', NULL, 'Minimum Project Amount', 1, ''),
(196, 62, 19, 'Project.maximum_amount', '100000000000', 'This is the maximum possible project goal amount.', 'text', NULL, 'Maximum Project Amount', 2, ''),
(198, 58, 18, 'Project.listing_fee', '10', 'Listing fee for projects in the site and you can set by percentage / amount. It can be overridden per project type.', 'text', NULL, 'Project Listing Fee', 3, ''),
(250, 36, 3, 'twitter.is_enabled_twitter_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using Twitter.', 'checkbox', NULL, 'Enable Twitter', 4, ''),
(201, 15, 38, 'Project.post_project_on_twitter', '1', 'On enabling this feature, post all the newly added projects in site Twitter Account', 'checkbox', NULL, 'Auto post on Site Twitter', 16, ''),
(202, 9, 38, 'social_networking.post_project_on_user_facebook', '1', 'Automatically post newly added projects in users Facebook wall.', 'checkbox', NULL, 'Auto post on User Facebook', 8, ''),
(203, 15, 38, 'social_networking.post_project_on_user_twitter', '1', 'On enabling this feature, post all the newly added projects in user Twitter Account', 'checkbox', NULL, 'Auto post on User Twitter', 17, ''),
(207, 9, 38, 'Project.post_project_on_facebook', '1', 'Enable this to Post Newly Open Project in Site''s Facebook Wall', 'checkbox', NULL, 'Post New Project on Facebook Wall', 9, ''),
(208, 9, 38, 'facebook.fb_access_token', 'AAADQiJZBGmQABAMsIzUR2w4qLYlKnhR24N1dTHUhWd6oz59fKdmWD8h9XyZCIJ1ZBQ8e51JnzFLmFsMVs1BDX6hDFnI9R5Dl9N0j9ZBCAQZDZD', 'This will be automatically updated when "Update Facebook Credentials" link is clicked. (Required for posting in Facebook)', 'text', NULL, 'Access Token', 5, ''),
(209, 9, 38, 'facebook.fb_user_id', '100000235263789', 'This is to moderate facebook comments. Add multiple facebook user id (seperated by comma) to allow multiple moderators.', 'text', '', 'User ID', 6, ''),
(449, 43, 11, 'Project.is_enable_cancel_pledge_activities', '1', 'On enabling this feature, Cancel fund activities will be saved.', 'checkbox', NULL, 'Enable cancel fund activities', 2, 'Projects'),
(210, 9, 38, 'facebook.app_id', '229285210528000', 'This is the application ID used in Facebook plugins such as like box, login and post.', 'text', NULL, 'App ID', 1, ''),
(212, 9, 38, 'facebook.fb_secrect_key', '162fa11ced9c565e643574c9b9fc91dc', 'This is the Facebook secret key used for authentication and other Facebook related plugins support.', 'text', NULL, 'App Secret', 3, ''),
(214, 36, 3, 'facebook.is_enabled_facebook_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using Facebook.', 'checkbox', NULL, 'Enable Facebook', 3, ''),
(229, 15, 38, 'twitter.site_user_access_token', '75254727-MiPgVVHcAOJd0AX8IQj4Y5quvVUHxrBknq1M7fKQP', 'This will be automatically updated when "Update Twitter Credentials" link is clicked. (Required for posting in Twitter)', 'text', NULL, 'Access token', 13, ''),
(226, 15, 38, 'twitter.consumer_key', 'nEeOkK891kEHsKECR7eStg', 'This is the consumer key used for authentication and posting on Twitter.', 'text', NULL, 'Consumer key', 10, ''),
(227, 15, 38, 'twitter.consumer_secret', 'u8td2G1ofZZlrrjAyKqMQnwqUaxupN0xtNCuP1Nc', 'This is the consumer secret key used for authentication and posting on Twitter.', 'text', NULL, 'Consumer secret', 11, ''),
(228, 15, 38, 'twitter.site_user_access_key', 'wYKgYCZmAlIZk7lpSi1LXWY1FDYuyAXjlROxWxO9SA', 'This will be automatically updated when "Update Twitter Credentials" link is clicked. (Required for posting in Twitter)', 'text', NULL, 'Access Token Secret', 12, ''),
(224, 15, 38, 'twitter.username', 'agriyacrowdfund', 'This is the Twitter username of the account has been created.', 'text', NULL, 'Twitter Username', 14, ''),
(235, 75, 19, 'Project.is_allow_owner_project_cancel', '1', 'By enabling this, project owner can cancel his project, except donate project.', 'checkbox', NULL, 'Allow Project Owner to Cancel Project', 12, ''),
(443, 110, 28, 'pre_launch.bg_image', NULL, '(Preferred 950x552)', 'file', NULL, 'Upload Background Image', 6, 'LaunchModes'),
(444, 110, 28, 'pre_launch.bg_image_stretch_type ', 'Stretch', 'The selected option is used for handling background image.\r\nRepeat - Tiles the image. Stretch - Stretches the image to 100% using CSS. AutoResize - Keeps the image resized to 100% of window region using JavaScript.', 'select', 'Repeat, Stretch, AutoResize', 'Stretch Type ', 5, 'LaunchModes'),
(240, 65, 20, 'Project.minimum_days_before_fund_cancel', '0', 'Minimum number of days prior to the project end date before which funder can cancel the fund amount', 'text', NULL, 'Minimum no. of days before fund cancel', 5, 'Projects'),
(238, 65, 20, 'Project.is_allow_fund_cancel_by_funder', '1', 'On enabling this, funders can cancel their fund for project.', 'checkbox', NULL, 'Enable to allow fund cancel by funder', 4, 'Projects'),
(239, 65, 20, 'Project.is_allow_fund_cancel_by_owner', '1', 'On enabling this, project owner can cancel the funders fund for their project.', 'checkbox', NULL, ' Enable to allow fund cancel by project owner', 6, 'Projects'),
(244, 65, 20, 'Project.is_allow_owner_fund_own_project', '0', 'On enabling this, project owners can make the fund for own project.', 'checkbox', NULL, 'Enable to allow owners to fund their own projects', 7, ''),
(246, 65, 20, 'Project.is_allow_owners_to_fund_other_projects', '1', 'On enabling this, project owners can make the fund for other projects.', 'checkbox', NULL, 'Enable to allow owners to fund other projects', 8, ''),
(248, 50, 14, 'suspicious_detector.is_enabled', '1', 'By enabling this feature, suspicious word detector feature will apply for site.', 'checkbox', NULL, 'Enable Suspicious word detector', 1, ''),
(252, 32, 30, 'site.currency_code', 'USD', '', 'select', 'AUD,BRL,CAD,CZK,DKK,EUR,HKD,HUF,ILS,JPY,MXN,NOK,NZD,PHP,PLN,GBP,SGD,SEK,CHF,TWD,THB,TRY,USD', 'Currency', 5, ''),
(256, 72, 3, 'user.is_allow_user_to_switch_language', '1', 'On enabling this feature, users can change site language to their choice.', 'checkbox', '', 'Enable User to Switch Language', 2, 'Translation'),
(257, 0, 0, 'Project.is_allow_fund_capture_flagged_projects', '1', 'You can enable to auto fund capture for flagged projects ', 'checkbox', NULL, 'Enable Auto Fund Capture for Flagged Projects', 15, ''),
(265, 1, 0, 'site.embed_code', '<script type="text/javascript" language="JavaScript">var id=1011;</script><script type="text/javascript" language="JavaScript" src="http://www.funny-videos.co.uk/emb/embedvideo.js"></script>', 'Enter embed code to explain how site works', 'textarea', NULL, 'How it works video', 18, ''),
(266, 26, 1, 'EmailTemplate.reply_to_email', '', 'You can change this email address so that ''Reply To'' email will be changed in all email communication.', 'text', '', 'Reply To Email Address', 2, ''),
(267, 26, 1, 'EmailTemplate.no_reply_email', 'productdemo.admin+noreply+crowdfunding@gmail.com', 'You can change this email address so that ''No Reply'' email will be changed in all email communication.', 'text', NULL, 'No Reply Email Address', 3, ''),
(282, 57, 18, 'Project.fund_commission_percentage', '10', 'Commission to site from each fund. It can be overridden per project type.', 'text', '', 'Commission from each fund (%)', 1, ''),
(271, 6, 60, 'Project.is_project_reward_optional', '1', 'On enabling this, reward becomes optional while adding the projects.', 'checkbox', NULL, 'Enable reward as an optional field', 2, 'ProjectRewards'),
(273, 51, 14, 'Project.auto_suspend_project_on_system_flag', '1', 'By enabling this, project posted with suspicious words in description will automatically be suspended.', 'checkbox', NULL, 'Enable Auto Suspend for Projects', 14, ''),
(275, 51, 14, 'Project.auto_suspend_update_comment_on_system_flag', '1', 'On enabling this, comment posted for project update, with suspicious\r\nwords will automatically be suspended.', 'checkbox', NULL, 'Enable Auto Suspend for Project Update''s Comment', 18, ''),
(276, 51, 14, 'Project.auto_suspend_message_on_system_flag', '1', 'On enabling this, messages posted with suspicious words will automatically be suspended.', 'checkbox', NULL, 'Enable Auto suspend for Messages', 19, ''),
(277, 65, 20, 'Project.is_show_other_backers_amount_for_backers', '1', 'On enabling this, funders can see the other backers amount.', 'checkbox', NULL, 'Allow backer to view the other funders amount', 3, ''),
(279, 58, 18, 'Project.project_listing_fee_type', 'amount', 'Select the project listing fee type.', 'select', 'amount,percentage', '', 4, ''),
(283, 62, 19, 'Project.project_short_description_length', '250', 'This is the maximum character length for project''s short description.', 'text', '', 'Maximum Length for Project Short Description', 5, ''),
(454, 7, 0, 'site.last_invited_date', NULL, NULL, 'date', NULL, 'Last Invited Date', 0, ''),
(285, 76, 19, 'Project.is_pledge_default_type', 'Any', 'Any - Pledger can pledge any amount, \r\nMinimum - Pledger has to pledge at least minimum amount, \r\nFixed - Pledge amount is fixed,\r\nMultiple - Pledge amount can be multiples of specified amount,\r\nSuggested - Pledger can pledge from given set', 'select', 'Any, Minimum, Fixed, Multiple, Suggested', 'Default Pledge type', 17, 'Pledge'),
(286, 76, 19, 'Project.is_fixed_amount_pledge_enabled', '0', 'On enabling this, project pledge amount will be fixed.', 'checkbox', '', 'Enable Fixed Pledge Type', 18, 'Pledge'),
(287, 76, 19, 'Project.is_allow_user_to_set_fixed_amount_pledge', '1', 'On enabling this, project owner can set minimum pledge amount.', 'checkbox', '', 'Enable Project Owner to Set Fixed Amount', 19, 'Pledge'),
(288, 76, 19, 'Project.is_multiple_amount_pledge_enabled', '0', 'On enabling this, Project can be set multiple amount.', 'checkbox', '', 'Enable Project Pledge Multiple Amount Type', 20, 'Pledge'),
(289, 76, 19, 'Project.is_allow_user_to_set_multiple_amount_pledge', '1', 'On enabling this, project owner can set multiple amount for their project.', 'checkbox', '', 'Enable Project Owner to Set Multiple Amount', 21, 'Pledge'),
(290, 76, 19, 'Project.is_suggested_pledge_enabled', '0', 'On enabling this, project can be set as suggested pledge amount.', 'checkbox', '', 'Enable Suggested Pledge Amount Type', 22, 'Pledge'),
(291, 76, 19, 'Project.is_allow_user_to_set_suggested_pledge', '1', 'On enabling this, project owner can set suggested pledge amount.', 'checkbox', '', 'Enable Project Owner to Set Suggested Amount', 23, 'Pledge'),
(292, 76, 19, 'Project.is_pledge_minimum_amount_enabled', '0', 'On enabling this, project owner can set minimum pledge amount.', 'checkbox', '', 'Enable Project Minimum Pledge Amount Type', 24, 'Pledge'),
(293, 76, 19, 'Project.is_allow_user_to_set_minimum_amount_pledge', '1', 'On enabling this, project owner can set minimum pledge amount.', 'checkbox', '', 'Enable Project Owner to Set Minimum Pledge Amount', 25, 'Pledge'),
(294, 59, 18, 'User.signup_fee', '0', 'You can change the signup fee for user in your site.', 'text', NULL, 'User SignUp Fee', 6, ''),
(295, 59, 18, 'User.signup_fee_payeer', 'Site', '', 'radio', 'User,Site', 'Who will pay the gateway fee for signup?', 7, 'Sudopay'),
(296, 80, 11, 'Project.comment_code', '<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=##APPID##&amp;xfbml=1"></script><fb:comments href="##URL##" num_posts="10" width="500"></fb:comments>', 'Third Party Comment made through this code', 'textarea', NULL, 'Third Party Comment Code', 6, 'Projects'),
(297, 80, 11, 'Project.is_fb_project_comment_enabled', '0', 'On enabling this, user can make the comments for projects via third party comment code', 'checkbox', NULL, 'Enable Third Party Comment', 5, 'Projects'),
(298, 62, 19, 'Project.min_short_description_length', '50', 'This is the minimum character length for project''s short description.', 'text', '', 'Minimum Length for Project Short Description', 4, ''),
(300, 58, 18, 'Project.project_fee_payeer', 'Site', '', 'radio', 'Project Owner,Site', 'Who will pay the gateway fee for project listing?', 5, 'Sudopay'),
(301, 75, 19, 'Project.is_allow_project_owner_to_edit_project_in_open_status', '1', 'By enabling this, project owner can able to edit the project information in open status.', 'checkbox', '', 'Allow Project Owner to Edit the Project Information in Open Status', 7, ''),
(332, 22, 82, 'wallet.min_wallet_amount', '10', 'This is the minimum amount a user can add to his wallet.', 'text', NULL, 'Minimum wallet amount', 1, 'Wallet'),
(331, 22, 82, 'wallet.max_wallet_amount', '200000000', 'This is the maximum amount a user can add to his wallet. (If left empty, then, no maximum amount restrictions).', 'text', NULL, 'Maximum wallet amount', 2, 'Wallet'),
(305, 9, 38, 'facebook.page_id', '464629930229988', 'This is the Facebook page ID, if specified, any deal when gets opened will be posted in this page wall, instead of the configured account.', 'text', NULL, 'Page ID', 4, ''),
(318, 17, 60, 'barcode.is_barcode_enabled', '1', 'On enabling this, barcode will be shown in reward vouchers', 'checkbox', NULL, 'Enable barcode', 4, 'ProjectRewards'),
(319, 17, 60, 'barcode.width', '120', 'Width of the barcode in reward voucher', 'text', NULL, 'Width', 5, 'ProjectRewards'),
(320, 17, 60, 'barcode.height', '120', 'Height of the barcode in reward voucher', 'text', NULL, 'Height', 6, 'ProjectRewards'),
(351, 84, 18, 'wallet.wallet_fee_payer', 'User', '', 'radio', 'User,Site', 'Who will pay the gateway fee for wallet', 0, 'Sudopay'),
(324, 69, 21, 'affiliate.payment_threshold_for_threshold_limit_reach', '1', 'This is the minimum amount to be earned by an "Affiliate User" for placing a "withdrawal request".', 'text', NULL, 'Minimum Withdrawal Threshold Limit', 6, 'Affiliates'),
(325, 68, 21, 'affiliate.commission_holding_period', '0', 'This is the maximum period (in number of days) in which the commission amount will be in "holding" status. During this stage the user (An Affiliate) cannot place a request for the Withdrawal.', 'text', NULL, 'Maximum Commission Holding Period', 3, 'Affiliates'),
(326, 68, 21, 'affiliate.commission_on_every_pledge', '1', 'By enabling this feature, affiliate user will earn the commission amount on every pledge. (Turn this off, if you want affiliate users to be payed only for his first pledge)', 'checkbox', NULL, 'Enable Pay commission on every pledge', 4, 'Pledge'),
(327, 67, 21, 'affiliate.referral_cookie_expire_time', '1', 'This will be the maximum time limit within which the referral cookie has to be used (by the User), after this time gets elapsed the cookie will get expired or become unusable.', 'text', NULL, 'Referral Cookie Expire Time', 2, 'Affiliates'),
(328, 69, 21, 'affiliate.site_commission_amount', '1', 'This is the amount which will be deducted during the Affiliate cash withdrawal. (Leave blank space for "no fee" transaction)', 'text', NULL, 'Transaction Fee', 7, 'Affiliates'),
(329, 69, 21, 'affiliate.site_commission_type', 'amount', 'The selected option will be used as the default option for "fee type" during an "Affiliate cash withdrawal"', 'select', 'percentage,amount', '', 8, 'Affiliates'),
(330, 68, 21, 'affiliate.commission_on_every_project_listing', '1', 'By enabling this feature, affiliate user will earn commission amount on every project listing. (Turn this off, if you want affiliate users to be payed only for his first project listing)', 'checkbox', NULL, 'Enable Pay commission on every project listing', 5, 'Affiliates'),
(333, 53, 83, 'user.minimum_withdraw_amount', '2', 'This is the minimum amount a user can withdraw from their wallet.', 'text', NULL, 'Minimum Withdrawal Amount', 4, 'Withdrawals'),
(334, 53, 83, 'user.maximum_withdraw_amount', '100', 'This is the maximum amount a user can withdraw from their wallet.', 'text', NULL, 'Maximum Withdrawal Amount', 5, 'Withdrawals'),
(339, 24, 38, 'google.translation_api_key', '', 'This is the configured Google Translate API key.', 'text', NULL, 'API Key', 18, 'Translation'),
(340, 29, 28, 'site.is_ssl_enabled', '0', NULL, 'checkbox', NULL, 'Enable SSL', 20, ''),
(341, 139, 124, 'cdn.images', '', 'This is base URL (without trailing slash) for CDN images. (e.g., http://images.yourdomain.com)', 'text', NULL, 'CDN Image URL', 2, 'HighPerformance'),
(342, 139, 124, 'cdn.css', '', 'This is base URL (without trailing slash) for CDN CSS. (e.g., http://css.yourdomain.com)', 'text', NULL, 'CDN CSS URL', 3, 'HighPerformance'),
(343, 139, 124, 'cdn.js', '', 'This is base URL (without trailing slash) for CDN JavaScript. (e.g., http://js.yourdomain.com)', 'text', NULL, 'CDN JS URL', 4, 'HighPerformance'),
(344, 29, 28, 'site.look_up_url', 'http://whois.sc/', 'URL prefix for whois lookup service. Will be used in\r\nwhois links found in\r\n##USER_LOGIN## pages to resolve user''s IP  to where they are from&mdash;often down to the\r\ncity or neighborhood or country. This is a security feature.', 'text', 'text', 'Whois Lookup URL', 2, ''),
(349, 9, 38, 'facebook.site_facebook_url', 'https://www.facebook.com/pages/SFPlatform/464629930229988', 'This is the site Facebook URL used for displaying in the footer. (Replaced with city specific Facebook URL, if updated in cities)', 'text', NULL, 'Facebook Account URL', 7, ''),
(254, 57, 18, 'Project.payment_gateway_fee_id', 'Site and Project Owner', '', 'radio', 'Project Owner, Site, Site and Project Owner', 'Who will pay the gateway fee?', 3, 'Sudopay'),
(200, 0, 0, 'Hook.bootstraps', 'Projects,ProjectFlags,ProjectFollowers,ProjectUpdates,Wallet,Withdrawals,Translation,SecurityQuestions,LaunchModes,MobileApp', '', NULL, NULL, NULL, 0, ''),
(356, 75, 19, 'Project.project_fund_capture', 'Fixed Funding', 'If your project is set up as "Flexible Funding", you will be able to keep the funds you raise, even if you don''t meet your goal. If your campaign is set up as Fixed Funding, all contributions will be returned to your funders if you do not meet your goal.', 'select', 'Flexible Funding, Fixed Funding', 'Funding Method', 0, 'Projects'),
(358, 57, 18, 'Project.fund_commission_percentage_not_reached_needed_amount', '8', 'Commission collected if not reached the needed amount for "Flexible Funding" method. It can be overridden per project type.', 'text', NULL, 'Commission Percentage if Fund not Reached Needed Amount', 0, ''),
(360, 37, 3, 'user.is_enable_forgot_password_captcha', '1', 'Here you can enable captcha when user request for forgot password', 'checkbox', NULL, 'Enable Captcha when Forgot Password', 0, ''),
(453, 110, 28, 'site.duration_to_invite', 'Daily', 'Invitation will send within duration.', 'select', 'Daily,Weekly,Monthly', 'Invite Duration', 2, 'LaunchModes'),
(450, 7, 0, 'thumb_size.user_thumb.width', '83', '', 'text', NULL, 'User View Thumb', 0, ''),
(451, 7, 0, 'thumb_size.user_thumb.height', '83', '', 'text', NULL, '', 0, ''),
(452, 110, 28, 'site.no_of_users_to_invite', '50', 'If Private Beta mode is selected, users can invite friends within invite limit. Leave blank for unlimited.', 'text', NULL, 'Friends invite limit', 3, 'LaunchModes'),
(368, 75, 19, 'Project.is_project_owner_select_funding_method', '1', NULL, 'checkbox', NULL, 'Project owner can select funding method', 0, 'Projects'),
(369, 36, 3, 'google.is_enabled_google_connect', '1', 'By enabling this feature, users can authenticate their Crowdfund account using Google.', 'checkbox', NULL, 'Enable Google', 4, ''),
(370, 36, 3, 'yahoo.is_enabled_yahoo_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using Yahoo!.', 'checkbox', NULL, 'Enable Yahoo!', 5, ''),
(372, 36, 3, 'linkedin.is_enabled_linkedin_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using Linkedin.', 'checkbox', NULL, 'Enable Linkedin', 7, ''),
(373, 88, 38, 'google.consumer_key', '1061226080208.apps.googleusercontent.com', 'This is the Consumer ID used in Gmail share.', 'text', NULL, 'Consumer ID', 2, ''),
(374, 88, 38, 'google.consumer_secret', '5dUnvSsVNnLmodPW41Fjn3F5', 'This is the Secrete key used in Gmail share.', 'text', NULL, 'Client Secret', 2, ''),
(375, 89, 38, 'yahoo.consumer_key', 'dj0yJmk9OEtpZlVmNnBFd1ZNJmQ9WVdrOVpUbEliMXBQTTJVbWNHbzlNVFl5TkRRME1qWTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD0yYg--', 'This is the Consumer Key is used in Yahoo! share.', 'text', NULL, 'Consumer Key', 4, ''),
(376, 89, 38, 'yahoo.consumer_secret', '6e2a22e7d095bff7807dc2344eb5a309a301c0d3', 'This is the Consumer Secret Key is used in Yahoo! share.', 'text', NULL, 'Consumer Secret', 5, ''),
(377, 91, 38, 'linkedin.consumer_key', '9wb2yhmlvt9n', 'This is the Consumer Key used in LinkedIn share.', 'text', NULL, 'Consumer Key', 4, ''),
(378, 91, 38, 'linkedin.consumer_secret', 'T3jL7EI0qJ5bfoD6', 'This is the Secret Key used in LinkedIn share.', 'text', NULL, 'Consumer Secret', 4, ''),
(393, 95, 94, 'widget.footer_script', '<img src="http://placehold.it/728X90" alt ="728X90" width="728" height="90"/>', 'This is the footer page script, used for display banners on footer page', 'textarea', '', 'Code', 0, ''),
(394, 96, 94, 'widget.home_script', '', 'This is the browse page script, used for display banners on browse page', 'textarea', '', 'Code', 0, ''),
(414, 7, 0, 'thumb_size.iphone_small_thumb.width', '100', '', 'text', NULL, 'iPhone Small Thumb', 0, ''),
(395, 97, 94, 'widget.project_script', '', 'This is the project view page script, used for display banners on right side of project view page', 'textarea', '', 'Code', 0, ''),
(396, 98, 94, 'widget.user_script', '<img src="http://placehold.it/728X90" alt ="728X90" width="728" height="90"/>', 'This is the user page script, used for display banners on user page', 'textarea', '', 'Code', 0, ''),
(397, 99, 1, 'system.captcha_type', 'Solve Media', 'The selected type will be used for CAPTCHA display in sign up and contact us pages.', 'select', 'Normal,Solve Media', 'CAPTCHA Type', 0, ''),
(398, 100, 38, 'captcha.challenge_key', 'oR.X9IGEcuYNu3pk7m.ZN7BiD-M-vHFp', NULL, 'text', NULL, 'Challenge Key', 0, ''),
(399, 100, 38, 'captcha.verification_key', '00MsxSO3v0GQRB8TFPla0rY9dzeovpSd', NULL, 'text', NULL, 'Verification Key', 0, ''),
(400, 100, 38, 'captcha.hash_key', 'G9VT4C021Q1ExAKN8Wltf.cxMX-V9wfG', NULL, 'text', NULL, 'Authentication Hash Key', 0, ''),
(402, 92, 3, 'user.remember_me_maxlife', '5', 'The maximum number of days for which a remember me session is valid; afterwards, the user will need to log in again.  Enter 0 for no expiration.', 'text', NULL, 'Days to remember the user', 10, ''),
(403, 92, 3, 'user.remember_me_maxlogins', '5', 'The maximum number of Persistent Logins remembered per user.', 'select', '5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 60, 70, 80, 90, 100', 'Remembered logins per user', 0, ''),
(404, 92, 3, 'user.remember_me_cookie_prefix', 'sfp', 'A string used as prefix to build the persistent login cookie name. Characters allowed: ASCII letters ([A-Z], [a-z]), digits ([0-9]), hyphens ("-") or underscores ("_"). Previous cookies stored in user ', 'text', NULL, 'Cookie name prefix', 0, ''),
(405, 92, 3, 'user.remember_me_secure', 'Only the listed pages', NULL, 'select', 'Every page except the listed pages, Only the listed pages', 'Pages which require an explicit login', 0, ''),
(406, 92, 3, 'user.remember_me_pages', 'projects/add', 'Enter pages comma separated', 'textarea', NULL, 'Pages', 0, ''),
(660, 138, 124, 'is_page_speed_enabled', '1', '', 'text', NULL, '', 0, 'HighPerformance'),
(659, 136, 135, 'is_enable_to_show_blog_link', '1', 'By enabling this, link to blog will be enabled in footer.', 'checkbox', NULL, 'Enable blog link in footer', 0, 'Blog'),
(413, 110, 28, 'site.launch_mode', 'Launch', 'If Pre-launch mode is selected, users/visitors will only be able to subscribe to your site. Only Administrator (that will be you) can access the site (e.g., http://yourdomain.com/admin). (Turn this on, when you want site traffic before launching the site.). If Private Beta mode is selected, only Administrator and users/visitors those who are having the invite code can sign up to your site and access the site, other can only able to request for invite code.', 'select', 'Pre-launch, Private Beta, Launch', 'Launch Mode', 1, 'LaunchModes'),
(415, 7, 0, 'thumb_size.iphone_small_thumb.height', '60', '', 'text', NULL, '', 0, ''),
(416, 7, 0, 'thumb_size.iphone_big_thumb.width', '160', '', 'text', NULL, 'iPhone Big Thumb', 0, ''),
(417, 7, 0, 'thumb_size.iphone_big_thumb.height', '102', '', 'text', NULL, '', 0, ''),
(422, 109, 103, 'insights.is_enable_public_stats', '1', NULL, 'checkbox', NULL, 'Show stats to public', 0, ''),
(423, 105, 85, 'invite.facebook', 'Check out this website ##SITE_NAME## ##REFERRAL_URL##', '##SITE_NAME## ##REFERRAL_URL##', 'textarea', NULL, 'Invite Facebook Content', 0, 'SocialMarketing'),
(424, 105, 85, 'invite.twitter', 'Check out this website ##SITE_NAME## ##REFERRAL_URL##', '##SITE_NAME## ##REFERRAL_URL##', 'textarea', NULL, 'Invite Twitter Content', 0, 'SocialMarketing'),
(425, 106, 85, 'share.facebook', 'Check out this website ##SITE_NAME## ##SHARE_URL##', '##SITE_NAME## ##SHARE_URL##', 'textarea', NULL, 'Facebook Share content ', 0, 'SocialMarketing'),
(426, 106, 85, 'share.twitter', 'Check out this project ##PROJECT_NAME## ##SHARE_URL##', '##PROJECT_NAME## ##SHARE_URL##', 'textarea', NULL, 'Twitter Share content', 0, 'SocialMarketing'),
(441, 110, 28, 'site.private_beta_content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit nisi non nisl fermentum sit amet volutpat eros tincidunt. Sed tempor blandit gravida.', NULL, 'text', NULL, 'Site content for private beta mode', 5, 'LaunchModes'),
(442, 110, 28, 'site.pre_launch_content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin blandit nisi non nisl fermentum sit amet volutpat eros tincidunt. Sed tempor blandit gravida.', NULL, 'text', NULL, 'Site content for pre-launch mode', 4, 'LaunchModes'),
(468, 114, 38, 'google_analytics.access_token', '', 'This will be automatically updated when "Update Google Analytics Credentials" link is clicked. (Required for get data from Google Analytics)', 'text', NULL, 'Access Token', 5, 'IntegratedGoogleAnalytics'),
(469, 32, 30, 'site.currency_symbol_place', 'left', 'The selected position will be used as default currency symbol position all over the site (also for emails)', 'select', 'left,right', 'Currency Symbol Position', 4, ''),
(470, 71, 11, 'messages.thread_max_depth', '3', '0 for unlimited. Below this thread level "Reply" option will not be available. This is to avoid broken design due to thread level.', NULL, NULL, 'Thread Maximum Depth', 7, 'Projects'),
(472, 68, 21, 'affiliate.commission_on_every_donate', '1', 'By enabling this feature, affiliate user will earn the commission amount on every donate. (Turn this off, if you want affiliate users to be payed only for his first donate)', 'checkbox', NULL, 'Enable Pay commission on every donate', 4, 'Donate'),
(476, 7, 0, 'thumb_size.small_big_thumb.width', '150', '', 'text', NULL, 'Small Big Thumb', 0, ''),
(477, 7, 0, 'thumb_size.small_big_thumb.height', '150', '', 'text', NULL, '', 0, ''),
(478, 113, 112, 'site.iphone_app_key', NULL, 'This is the security key used for iPhone App', 'text', NULL, 'App key', 1, 'MobileApp'),
(480, 7, 0, 'thumb_size.very_small_big_thumb.width', '150', NULL, 'text', NULL, 'Very Small Big Thumb', 0, ''),
(481, 7, 0, 'thumb_size.very_small_big_thumb.height', '112', NULL, 'text', NULL, NULL, 0, ''),
(482, 110, 28, 'site.no_of_users_to_invite_per_time', '50', 'If Private Beta mode is selected, subscribed users will be invited via cron in selected duration with above given limit. Leave blank for unlimited.', 'text', NULL, 'Cron invite limit', 4, 'LaunchModes'),
(483, 114, 38, 'google_analytics.profile_id', '63232568', 'This is the Profile ID to fetch data from Google Analytics. Please refer this <a href="##ANALYTICS_IMAGE##" target="_blank">image</a>. Example: p''XXXX''.', 'text', NULL, 'Profile ID', 4, 'IntegratedGoogleAnalytics'),
(484, 68, 21, 'affiliate.commission_on_every_lend', '5', 'By enabling this feature, affiliate user will earn the commission amount on every lend. (Turn this off, if you want affiliate users to be payed only for his first lend)', 'checkbox', NULL, 'Enable pay commission on every lend', 5, 'Lend'),
(540, 36, 3, 'googleplus.is_enabled_googleplus_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using Google+.', 'checkbox', NULL, 'Enable Google+', 4, ''),
(541, 115, 38, 'googleplus.consumer_secret', '5dUnvSsVNnLmodPW41Fjn3F5', 'This is the Secrete key used in Google+ share.', 'text', NULL, 'Secret key', 2, ''),
(542, 115, 38, 'googleplus.consumer_key', '1061226080208.apps.googleusercontent.com', 'This is the Consumer ID used in Google+ share.', 'text', NULL, 'Consumer ID', 2, ''),
(543, 68, 21, 'affiliate.commission_on_every_equity', '5', 'By enabling this feature, affiliate user will earn the commission amount on every invest. (Turn this off, if you want affiliate users to be payed only for his first invest)', 'checkbox', NULL, 'Enable pay commission on every invest', 6, 'Equity'),
(544, 107, 11, 'project.alt_name_for_project_singular_small', 'project', '', 'text', NULL, 'Project - Lower case, Singular - project', 1, 'Projects'),
(545, 107, 11, 'project.alt_name_for_project_singular_caps', 'Project', '', 'text', '', 'Project - Title case, Singular - Project', 2, 'Projects'),
(546, 107, 11, 'project.alt_name_for_project_plural_small', 'projects', '', 'text', '', 'Project - Lower case, Plural - projects', 3, 'Projects'),
(547, 107, 11, 'project.alt_name_for_project_plural_caps', 'Projects', '', 'text', '', 'Project - Title case, Plural - Projects', 4, 'Projects'),
(548, 107, 11, 'project.alt_name_for_pledge_project_owner_singular_small', 'project owner', '', 'text', NULL, 'Project Owner - Lower case, Singular - project owner', 5, 'Pledge'),
(549, 107, 11, 'project.alt_name_for_pledge_project_owner_singular_caps', 'Project Owner', '', 'text', '', 'Project Owner - Title case, Singular - Project Owner', 6, 'Pledge'),
(550, 107, 11, 'project.alt_name_for_pledge_singular_small', 'pledge', '', 'text', NULL, 'Pledge - Lower case, Singular - pledge', 7, 'Pledge'),
(551, 107, 11, 'project.alt_name_for_pledge_singular_caps', 'Pledge', '', 'text', '', 'Pledge - Title case, Singular - Pledge', 8, 'Pledge'),
(552, 107, 11, 'project.alt_name_for_pledge_plural_small', 'pledges', '', 'text', '', 'Pledge - Lower case, Plural - pledges', 9, 'Pledge'),
(553, 107, 11, 'project.alt_name_for_pledge_plural_caps', 'Pledges', '', 'text', '', 'Pledge - Title case, Plural - Pledges', 10, 'Pledge'),
(554, 107, 11, 'project.alt_name_for_pledge_past_tense_small', 'pledged', NULL, 'text', NULL, 'Pledge - Lower case, Past tense - pledged', 11, 'Pledge'),
(555, 107, 11, 'project.alt_name_for_pledge_past_tense_caps', 'Pledged', NULL, 'text', NULL, 'Pledge - Title case, Past tense - pledged', 12, 'Pledge'),
(556, 107, 11, 'project.alt_name_for_pledge_present_continuous_small', 'pledging', NULL, 'text', NULL, 'Pledge - Lower case, Continuous tense - pledging', 13, 'Pledge'),
(557, 107, 11, 'project.alt_name_for_pledge_present_continuous_caps', 'Pledging', NULL, 'text', NULL, 'Pledge - Title case, Continuous tense - Pledging', 14, 'Pledge'),
(558, 107, 11, 'project.alt_name_for_backer_singular_small', 'backer', '', 'text', NULL, 'Backer - Lower case, Singular - backer', 15, 'Pledge'),
(559, 107, 11, 'project.alt_name_for_backer_singular_caps', 'Backer', '', 'text', '', 'Backer - Title case, Singular - Backer', 16, 'Pledge'),
(560, 107, 11, 'project.alt_name_for_backer_plural_small', 'backers', '', 'text', '', 'Backer - Lower case, Plural - backers', 17, 'Pledge'),
(561, 107, 11, 'project.alt_name_for_backer_plural_caps', 'Backers', '', 'text', '', 'Backer - Title case, Plural - Backers', 18, 'Pledge'),
(562, 107, 11, 'project.alt_name_for_backer_past_tense', 'backed', NULL, 'text', NULL, 'Backer - Lower case, Past tense - backed', 19, 'Pledge'),
(563, 107, 11, 'project.alt_name_for_backer_past_tense_caps', 'Backed', NULL, 'text', NULL, 'Backer - Title case, Past tense - backed', 20, 'Pledge'),
(564, 107, 11, 'project.alt_name_for_backer_present_continuous', 'backing', NULL, 'text', NULL, 'Backer - Lower case, Continuous tense - backing', 21, 'Pledge'),
(565, 107, 11, 'project.alt_name_for_reward_singular_small', 'reward', '', 'text', '', 'Reward - Lower case, Singular - reward', 22, 'ProjectRewards'),
(566, 107, 11, 'project.alt_name_for_reward_singular_caps', 'Reward', '', 'text', '', 'Reward - Title case, Singular - Reward', 23, 'ProjectRewards'),
(567, 107, 11, 'project.alt_name_for_reward_plural_small', 'rewards', '', 'text', '', 'Reward - Lower case, Plural - rewards', 24, 'ProjectRewards'),
(568, 107, 11, 'project.alt_name_for_reward_plural_caps', 'Rewards', '', 'text', '', 'Reward - Title case, Plural - Rewards', 25, 'ProjectRewards'),
(569, 107, 11, 'project.alt_name_for_donate_project_owner_singular_small', 'project owner', '', 'text', NULL, 'Project Owner - Lower case, Singular - project owner', 26, 'Donate'),
(570, 107, 11, 'project.alt_name_for_donate_project_owner_singular_caps', 'Project Owner', '', 'text', '', 'Project Owner - Title case, Singular - Project Owner', 27, 'Donate'),
(571, 107, 11, 'project.alt_name_for_donate_singular_small', 'donate', '', 'text', '', 'Donate - Lower case, Singular - donate', 28, 'Donate'),
(572, 107, 11, 'project.alt_name_for_donate_singular_caps', 'Donate', '', 'text', '', 'Donate - Title case, Singular - Donate', 29, 'Donate'),
(573, 107, 11, 'project.alt_name_for_donate_plural_small', 'donates', '', 'text', '', 'Donate - Lower case, Plural - donates', 30, 'Donate'),
(574, 107, 11, 'project.alt_name_for_donate_plural_caps', 'Donates', '', 'text', '', 'Donate - Title case, Plural - Donates', 31, 'Donate'),
(575, 107, 11, 'project.alt_name_for_donate_past_tense_small', 'donated', NULL, 'text', NULL, 'Donate - Lower case, Past tense - Donated', 32, 'Donate'),
(576, 107, 11, 'project.alt_name_for_donate_past_tense_caps', 'Donated', NULL, 'text', NULL, 'Donate - Title case, Past tense - Donated', 33, 'Donate'),
(577, 107, 11, 'project.alt_name_for_donate_present_continuous_plural_caps', 'Donations', NULL, 'text', NULL, 'Donate - Title case, Verb - Donations', 34, 'Donate'),
(578, 107, 11, 'project.alt_name_for_donate_present_continuous_small', 'donating', NULL, 'text', NULL, 'Donate - Lower case, Continuous tense - Donating', 35, 'Donate'),
(579, 107, 11, 'project.alt_name_for_donate_present_continuous_caps', 'Donating', NULL, 'text', NULL, 'Donate - Title case, Continuous tense - Donating', 36, 'Donate'),
(580, 107, 11, 'project.alt_name_for_donor_singular_small', 'donor', NULL, 'text', NULL, 'Donor - Lower case, Singular - donor', 37, 'Donate'),
(581, 107, 11, 'project.alt_name_for_donor_singular_caps', 'Donor', NULL, 'text', '', 'Donor - Title case, Singular - Donor', 38, 'Donate'),
(582, 107, 11, 'project.alt_name_for_donor_plural_small', 'donors', NULL, 'text', NULL, 'Donor - Lower case, Plural - donors', 39, 'Donate'),
(583, 107, 11, 'project.alt_name_for_donor_plural_caps', 'Donors', NULL, 'text', NULL, 'Donor - Title case, Plural - Donors', 40, 'Donate'),
(584, 107, 11, 'project.alt_name_for_donor_past_tense', 'donated', NULL, 'text', NULL, 'Donate - Lower case, Past tense - donated', 41, 'Donate'),
(585, 107, 11, 'project.alt_name_for_donor_past_tense_caps', 'Donated', NULL, 'text', NULL, 'Donate - Title case, Past tense - donated', 42, 'Donate'),
(586, 107, 11, 'project.alt_name_for_donor_present_continuous', 'donating', NULL, 'text', NULL, 'Donate - Lower case, Continuous tense - donating', 43, 'Donate'),
(587, 107, 11, 'project.alt_name_for_lend_project_owner_singular_small', 'borrower', '', 'text', NULL, 'Borrower - Lower case, Singular - borrower', 44, 'Lend'),
(588, 107, 11, 'project.alt_name_for_lend_project_owner_singular_caps', 'Borrower', '', 'text', '', 'Borrower - Title case, Singular - Borrower', 45, 'Lend'),
(589, 107, 11, 'project.alt_name_for_lend_singular_small', 'lend', '', 'text', NULL, 'Lend - Lower case, Singular - lend', 46, 'Lend'),
(590, 107, 11, 'project.alt_name_for_lend_singular_caps', 'Lend', '', 'text', '', 'Lend - Title case, Singular - Lend', 47, 'Lend'),
(591, 107, 11, 'project.alt_name_for_lend_plural_small', 'lends', '', 'text', '', 'Lend - Lower case, Plural - lends', 48, 'Lend'),
(592, 107, 11, 'project.alt_name_for_lend_plural_caps', 'Lends', '', 'text', '', 'Lend - Title case, Plural - Lents', 49, 'Lend'),
(593, 107, 11, 'project.alt_name_for_lend_past_tense_small', 'lent', NULL, 'text', NULL, 'Lend - Lower case, Past tense - lent', 50, 'Lend'),
(594, 107, 11, 'project.alt_name_for_lend_past_tense_caps', 'Lent', NULL, 'text', NULL, 'Lend - Title case, Past tense - lent', 51, 'Lend'),
(595, 107, 11, 'project.alt_name_for_lend_present_continuous_small', 'lending', NULL, 'text', NULL, 'Lend - Lower case, Continuous tense - lending', 52, 'Lend'),
(596, 107, 11, 'project.alt_name_for_lend_present_continuous_caps', 'Lending', NULL, 'text', NULL, 'Lend - Title case, Continuous tense - Lending', 53, 'Lend'),
(597, 107, 11, 'project.alt_name_for_lender_singular_small', 'lender', '', 'text', NULL, 'Lender  - Lower case, Singular - lender', 54, 'Lend'),
(598, 107, 11, 'project.alt_name_for_lender_singular_caps', 'Lender', '', 'text', '', 'Lender - Title case, Singular - Lender', 55, 'Lend'),
(599, 107, 11, 'project.alt_name_for_lender_plural_caps', 'Lenders', '', 'text', '', 'Lender - Title case, Plural - Lenders', 56, 'Lend'),
(600, 107, 11, 'project.alt_name_for_lender_plural_small', 'lenders', '', 'text', '', 'Lender - Lower case, Plural - lenders', 57, 'Lend'),
(601, 107, 11, 'project.alt_name_for_lender_past_tense', 'lent', NULL, 'text', NULL, 'Lender - Lower case, Past tense - lent', 58, 'Lend'),
(602, 107, 11, 'project.alt_name_for_lender_past_tense_caps', 'Lent', NULL, 'text', NULL, 'Lender - Lower case, Past tense - lent', 59, 'Lend'),
(603, 107, 11, 'project.alt_name_for_lender_present_continuous', 'lending', NULL, 'text', NULL, 'Lender - Lower case, Past tense - lent', 60, 'Lend'),
(604, 107, 11, 'project.alt_name_for_equity_project_owner_singular_small', 'entrepreneur', '', 'text', NULL, 'Project Owner - Lower case, Singular - project owner', 61, 'Equity'),
(605, 107, 11, 'project.alt_name_for_equity_project_owner_singular_caps', 'Entrepreneur', '', 'text', '', 'Project Owner - Title case, Singular - Project Owner', 62, 'Equity'),
(606, 107, 11, 'project.alt_name_for_equity_singular_small', 'equity', '', 'text', NULL, 'Equity - Lower case, Singular - equity', 63, 'Equity'),
(607, 107, 11, 'project.alt_name_for_equity_singular_caps', 'Equity', '', 'text', '', 'Equity - Title case, Singular - Equity', 64, 'Equity'),
(608, 107, 11, 'project.alt_name_for_equity_plural_small', 'equities', '', 'text', '', 'Equity - Lower case, Plural - equities', 65, 'Equity'),
(609, 107, 11, 'project.alt_name_for_equity_plural_caps', 'Equities', '', 'text', '', 'Equity - Title case, Plural - Equities', 66, 'Equity'),
(610, 107, 11, 'project.alt_name_for_equity_past_tense_small', 'invested', NULL, 'text', NULL, 'Invest - Lower case, Past tense - invested', 67, 'Equity'),
(611, 107, 11, 'project.alt_name_for_equity_past_tense_caps', 'Invested', NULL, 'text', NULL, 'Invest - Title case, Past tense - invested', 68, 'Equity'),
(612, 107, 11, 'project.alt_name_for_equity_present_continuous_small', 'investing', NULL, 'text', NULL, 'Invest - Lower case, Continuous tense - investing', 69, 'Equity'),
(613, 107, 11, 'project.alt_name_for_equity_present_continuous_caps', 'Investing', NULL, 'text', NULL, 'Invest - Title case, Past tense - Invested', 70, 'Equity');
INSERT INTO `settings` (`id`, `setting_category_id`, `setting_category_parent_id`, `name`, `value`, `description`, `type`, `options`, `label`, `order`, `plugin_name`) VALUES
(614, 107, 11, 'project.alt_name_for_investor_singular_small', 'investor', '', 'text', NULL, 'Investor - Lower case, Singular - investor', 71, 'Equity'),
(615, 107, 11, 'project.alt_name_for_investor_singular_caps', 'Investor', '', 'text', '', 'Investor - Title case, Singular - Investor', 72, 'Equity'),
(616, 107, 11, 'project.alt_name_for_investor_plural_caps', 'Investors', '', 'text', '', 'Investor - Title case, Plural - investors', 73, 'Equity'),
(617, 107, 11, 'project.alt_name_for_investor_plural_small', 'investors', '', 'text', '', 'Investor - Lower case, Plural - investors', 74, 'Equity'),
(618, 107, 11, 'project.alt_name_for_investor_past_tense', 'invested', NULL, 'text', NULL, 'Investor - Lower case, Past tense - invested', 75, 'Equity'),
(619, 107, 11, 'project.alt_name_for_investor_past_tense_caps', 'Invested', NULL, 'text', NULL, 'Investor - Title case, Past tense - invested', 76, 'Equity'),
(620, 107, 11, 'project.alt_name_for_investor_present_continuous', 'investing', NULL, 'text', NULL, 'Investor - Lower case, Continuous tense - investing', 77, 'Equity'),
(621, 122, 11, 'lend.default_terms', '12', 'This term will used to calculate monthly payment in check rate (in months).', 'text', NULL, 'Check rate terms', 1, 'Lend'),
(623, 122, 11, 'lend.late_fee', '10', 'Late fee if repayment date was exceeds the due date', 'text', NULL, 'Late Fee', 3, 'Lend'),
(624, 122, 11, 'lend.total_arrear_count_for_default', '4', 'If the repayment missed count is greater than given count means then the project will move to "Default" status.', 'text', NULL, 'Total missed repayment count to move "Default" status', 4, 'Lend'),
(625, 122, 11, 'lend.repayment_notification_send_before_days', '3', 'Number of days before the repayment notification send to borrower', 'text', NULL, 'Repayment notification to borrower', 5, 'Lend'),
(626, 123, 11, 'equity.amount_per_share', '20', NULL, 'text', NULL, 'Amount Per Share', 1, 'Equity'),
(627, 123, 11, 'equity.min_share_purchase_per_user', '1', NULL, 'text', '', 'Min share purchase per user', 2, 'Equity'),
(628, 123, 11, 'equity.max_share_purchase_per_user', '100', NULL, 'text', '', 'Max share purchase per user', 3, 'Equity'),
(629, 141, 124, 'RedisSession.is_redis_session_enabled', '0', NULL, 'checkbox', NULL, 'Enable Redis', 7, 'HighPerformance'),
(630, 141, 124, 'RedisSession.hostname', '', NULL, NULL, NULL, 'Redis Host Name', 8, 'HighPerformance'),
(631, 141, 124, 'RedisSession.port', '', NULL, NULL, NULL, 'Redis Port', 9, 'HighPerformance'),
(632, 142, 124, 'Memcached.is_memcached_enabled', '0', NULL, 'checkbox', NULL, 'Enable Memcached', 1, 'HighPerformance'),
(633, 142, 124, 'Memcached.servers', '', 'Add multiple server host name (seperated by comma)', 'text', NULL, 'Memcached Servers', 2, 'HighPerformance'),
(634, 139, 124, 'cdn.is_cdn_enabled', '0', NULL, 'checkbox', NULL, 'Enable Pull CDN', 1, 'HighPerformance'),
(635, 143, 124, 'HtmlCache.is_htmlcache_enabled', '0', NULL, 'checkbox', NULL, 'Enable Full-page Caching', 3, 'HighPerformance'),
(637, 144, 124, 's3.is_enabled', '0', 'Uncheck this to revert back to using your own web host for storage and delivery at anytime', 'checkbox', NULL, 'Enable storing of files to Amazon S3 and serving files from Amazon S3', 10, 'HighPerformance'),
(639, 144, 124, 's3.aws_access_key', '', '', 'text', NULL, 'Access Key', 12, 'HighPerformance'),
(640, 144, 124, 's3.aws_secret_key', '', '', 'text', NULL, 'Secret Key', 13, 'HighPerformance'),
(641, 144, 124, 's3.bucket_name', '', '##TEST_CONNECTION##', 'text', NULL, 'Bucket Name', 14, 'HighPerformance'),
(642, 144, 124, 's3.keep_copy_in_local', '0', NULL, 'checkbox', NULL, 'Keep copy in local', 15, 'HighPerformance'),
(643, 144, 124, 's3.is_cname_enabled', '0', 'For more details please refer <a title="For more info" target="_blank" href="http://docs.amazonwebservices.com/AmazonS3/2006-03-01/VirtualHosting.html">http://docs.amazonwebservices.com/AmazonS3/2006-03-01/VirtualHosting.html</a>', 'checkbox', NULL, 'Bucket is setup for virtual hosting', 16, 'HighPerformance'),
(644, 144, 124, 's3.upload_static_content_enabled', '0', 'Static content such as CSS, JavaScript, images files in <code>webroot</code> folder. Uncheck this to revert back to using own server for delivery at anytime.', 'checkbox', NULL, 'Enable to deliver all the static contents from Amazon S3', 17, 'HighPerformance'),
(645, 137, 124, 'cloudflare.token', '', '', 'text', NULL, 'CloudFlare Token', 3, 'HighPerformance'),
(646, 137, 124, 'cloudflare.email', '', '', 'Text', NULL, 'CloudFlare Email Id', 2, 'HighPerformance'),
(647, 132, 38, 'angellist.client_id', '6b67626cc2a420c9da1119286cc0fc52', 'This is client ID used in AngelList for login and import startups.', 'Text', NULL, 'Client ID', 1, ''),
(649, 132, 38, 'angellist.client_secret', 'e1695a0c9206efdae7be3243be40016b', 'This is client secret, AngelList will send mail to your email which is used to registered in AngelList and it is used for login and import startups.', 'text', NULL, 'Client Secret', 2, ''),
(650, 36, 3, 'angellist.is_enabled_angellist_connect', '1', 'By enabling this feature, users can authenticate their Crowdfunding account using AngelList.', 'checkbox', NULL, 'Enable AngelList', 5, ''),
(651, 140, 124, 'mail.is_smtp_enabled', '0', '', 'checkbox', NULL, 'Enable SMTP server', 1, 'HighPerformance'),
(652, 140, 124, 'mail.smtp_host', '', 'Add like ssl://smtp.gmail.com <http://smtp.gmail.com> host name', 'text', NULL, 'SMTP host', 2, 'HighPerformance'),
(653, 140, 124, 'mail.mail.smtp_port', '465', '', 'text', NULL, 'SMTP port', 3, 'HighPerformance'),
(654, 140, 124, 'mail.smtp_username', '', '', 'text', NULL, 'SMTP username', 4, 'HighPerformance'),
(655, 140, 124, 'mail.smtp_password', '', '', 'text', NULL, 'SMTP password', 5, 'HighPerformance'),
(656, 137, 124, 'cloudflare.is_cloudflare_enabled', '0', '', 'checkbox', NULL, 'Enable CloudFlare', 1, 'HighPerformance'),
(661, 43, 11, 'project.trending_project_count', '10', 'This is the count for trending project', 'Text', NULL, 'Count to show in trending projects', 3, ''),
(662, 43, 11, 'maximum_project_expiry_day', '365', NULL, 'text', NULL, 'Maximum project end date', 1, 'Projects'),
(663, 144, 124, 's3.end_point', '', NULL, 'text', NULL, 'End Point', 15, 'HighPerformance');

-- --------------------------------------------------------

--
-- Table structure for table `setting_categories`
--

DROP TABLE IF EXISTS `setting_categories`;
CREATE TABLE IF NOT EXISTS `setting_categories` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` bigint(20) default '0',
  `name` varchar(200) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `plugin_name` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `parent_id` (`parent_id`),
  KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Setting Category Details';

--
-- Dumping data for table `setting_categories`
--

INSERT INTO `setting_categories` (`id`, `created`, `modified`, `parent_id`, `name`, `description`, `plugin_name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'System', 'Manage site name, contact email, from email and reply to email.', ''),
(28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Developments', 'Manage Maintenance mode, Whois Lookup URL and other development related settings.', 'LaunchModes'),
(34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'SEO', 'Manage content, meta data and other information relevant to browsers or search engines.', ''),
(30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Regional, Currency &amp; Language ', 'Manage site default language, currency and date-time format.', ''),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Account', 'Manage different type of login option such as Facebook, Twitter and OpenID.', ''),
(11, '2010-05-03 17:28:44', '2010-05-03 17:28:44', 0, 'Project', 'Manage and configure settings such as project comments, message, alternate name etc.,', 'Projects'),
(19, '2011-03-14 11:24:43', '2011-03-14 11:24:43', 0, 'Project Owner', 'Manage & configure settings related to project amount, pledge types and overfunding.', ''),
(20, '2011-03-14 11:24:43', '2011-03-14 11:24:43', 0, 'Backer', 'Manage & configure settings related to backer and pledge amount.\r\n', ''),
(18, '2011-03-14 11:24:43', '2011-03-14 11:24:43', 0, 'Revenue', 'Here you can update the Revenue related settings.\r\n', ''),
(60, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Reward', 'Here you can update the fee and commission related settings.', 'ProjectRewards'),
(21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Affiliate', 'Manage affiliate information, commission and withdrawal amount details.', 'Affiliates'),
(82, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Wallet', 'Manage wallet related settings. Manage different types of payment gateway settings of the site. [Wallet, PayPal]. <a title="Update Payment Gateway Settings" class="paymentgateway-link" href="##PAYMENT_SETTINGS_URL##">Update Payment Gateway Settings</a>', ''),
(83, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Withdrawals', 'Manage withdrawal related settings. Manage different types of payment gateway settings of the site. [Wallet, PayPal Adaptive]. <a title="Update Payment Gateway Settings" class="paymentgateway-link" href="##PAYMENT_SETTINGS_URL##">Update Payment Gateway Settings</a>', 'Withdrawals'),
(14, '2010-10-07 19:04:29', '2010-10-07 19:04:30', 0, 'Suspicious Words Detector', 'Here you can place various words, which accepts regular expressions also, to match with your terms and policies.', ''),
(85, '2012-08-08 10:45:53', '2012-08-08 10:45:55', 0, 'Social Marketing', 'Manage & configure settings such as invite, share content etc.,', ''),
(38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Third Party API', 'Manage third party settings such as Facebook, Twitter, Google Map, Gmail, Yahoo!, MSN for authentication, importing contacts and posting.', ''),
(94, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Widget', 'Widgets for footer, project view page. Widgets can be in iframe and JavaScript embed code, etc (e.g., Twitter Widget, Facebook Like Box, Facebook Feeds Code, Google Ads).', ''),
(138, '2013-05-15 10:30:01', '2013-05-15 10:30:03', 124, 'Google PageSpeed', 'Google PageSpeed is also easy to setup through DNS change. This will optimize site''s HTML, JavaScript, Style Sheets and images on the fly. You may not usually need to turn this on as Agriya SFPlatform script is highly optimized already.', 'HighPerformance'),
(103, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Insights', 'Manage & configure settings related to extensive stats', ''),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Images', 'Here you can update the dimension (Width x Height) of the images.\r\n', ''),
(80, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Project Comments', 'Here you can manage project comments', 'Projects'),
(84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Wallet Fee', 'Here you can manage Wallet Fee', 'Sudopay'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 34, 'Metadata', 'Here you can set metadata settings such as meta keyword and description.', ''),
(72, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Privacy', NULL, 'Translation'),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 38, 'Facebook', 'Facebook is used for login and posting messages using its account details. For doing this, your site must be configured with an existing Facebook account. <a href="http://dev1products.dev.agriya.com/doku.php?id=facebook-setup" target="_blank">http://dev1products.dev.agriya.com/doku.php?id=facebook-setup.</a>', ''),
(26, '2010-12-06 15:44:48', '2010-12-06 15:44:51', 1, 'E-mails', 'Here you can modify email related settings such as contact email, from email, reply-to email.', ''),
(15, '2010-10-07 19:04:29', '2010-10-07 19:04:30', 38, 'Twitter', 'Twitter is used for login and posting messages using its account details. For doing this, your site must be configured with an existing Twitter account. <a href="http://dev1products.dev.agriya.com/doku.php?id=twitter-setup" target="_blank">http://dev1products.dev.agriya.com/doku.php?id=twitter-setup.</a>', ''),
(17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 60, 'Barcode', 'Here you can update the barcode settings', 'ProjectRewards'),
(53, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Cash Withdraw', 'Here you can modify cash withdraw settings for a user such as enabling withdrawal and setting withdraw limit.', 'Withdrawals'),
(24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 38, 'Google Translations', 'We use this service for quick translation to support new languages in ##TRANSLATIONADD##.Note that Google Translate API is now a <a href="http://code.google.com/apis/language/translate/v2/pricing.html" target="_blank">paid service</a>.Getting Api key, refer <a href="http://dev1products.dev.agriya.com/doku.php?id=google-translations-pricing" target="_blank">http://dev1products.dev.agriya.com/doku.php?id=google-translations-pricing</a>.', 'Translation'),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Site Information', 'Here you can modify site related settings such as site name.', ''),
(29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 28, 'Server', 'Here you can change server settings such as enabling maintenance mode settings.', ''),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 30, 'Regional', 'Here you can change regional setting such as site language.', 'Translation'),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 30, 'Currency Settings', 'Here you can modify site currency settings such as currency symbol, currency position and default currency.', ''),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 30, 'Date and Time', 'Here you can modify date time settings such as date time format.', ''),
(35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 34, 'SEO', 'Here you can set SEO settings such as inserting tracker code and robots.', ''),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Logins', 'Here you can modify user login settings such as enabling 3rd party logins and other login options. ', ''),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Account Settings', 'Here you can modify account settings such as admin approval, email verification, and other site account settings.', ''),
(71, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Messages', 'Here you modify message settings such as content length, thread depth level and other message related settings.', 'Projects'),
(42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 25, 'Configuration', NULL, ''),
(43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Configuration', 'Here you can modify cancel fund activities and trending projects count settings', 'Projects'),
(44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Display', 'Here you can modify Almost funded settings.', 'Projects'),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Project Followers', NULL, ''),
(46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Project Comments', NULL, 'Projects'),
(47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Project Update', NULL, ''),
(48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Project Update Comments', NULL, ''),
(49, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Project Flags', NULL, ''),
(50, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14, 'Configuration', '<p>Here you can update the Suspicious Words Detector related settings.</p> <p>Here you can place various words, which accepts regular expressions also, to match with your terms and policies. </p> <h4>Common Regular expressions</h4> <dl class="list clearfix"> <dt>Email</dt> <dd>\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*([,;]\\s*\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*)*</dd> <dt>Phone Number</dt> <dd>(?:+?1)?[-/. ]?[2-9][0-8][0-9][-/. ]?[2-9][0-9]{2}[-/. ]?[0-9]{4}</dd><dd>For reference: http://en.wikipedia.org/wiki/North_American_Numbering_Plan#List_of_NANPA_countries_and_territories</dd> </dl>', ''),
(51, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14, 'Auto Suspend Module', 'Here you can configure auto suspend of projects, comments and updates that posted with suspicious words.', ''),
(22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Wallet', 'Here you can modify wallet related setting such as allow negative balance, maximum and minimum funding limit settings.', 'Wallet'),
(57, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Project Fund', 'Here you can manage the commission for site from each fund', ''),
(58, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Project Listing Fee', 'Here you can manage the fee for site from project listings. These listing fee settings will be taken if the particular project has no fee settings. If you enable payment step for any project type, you have to set pricing details for the particular project. Otherwise it will take global listing fee', ''),
(59, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Signup Fee', 'Here you can manage the signup fee details', ''),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 60, 'Configuration', NULL, 'ProjectRewards'),
(62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19, 'Configuration', '', ''),
(76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19, 'Pledge', 'Manage & configure settings related to project pledge.', 'Pledge'),
(77, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19, 'Overfunding', 'Here you can manage overfunding settings for pledge and donate.', ''),
(65, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 20, 'Project Fund', 'Here you can manage fund related settings', ''),
(67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 21, 'Configuration', 'Here you can modify affiliate related settings such as enabling affiliate and referral expiry time.', 'Affiliates'),
(68, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 21, 'Commission', 'Here you can modify all the "Affiliate related commission settings" such as "commission holding" period and "commission pay type" settings.', ''),
(69, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 21, 'Withdrawal', 'Here you can modify affiliate withdrawal settings such as threshold limit, transaction fee settings.', 'Withdrawals'),
(73, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19, 'Moderation', NULL, ''),
(75, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19, 'Permission & Security', NULL, 'Projects'),
(78, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 55, 'Configuration', NULL, ''),
(107, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Alternate Name Configuration', 'Alternate name settings for modules which will be displayed throughout the site.', ''),
(110, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 28, 'Site State', 'Here you can change the site state as Prelaunch, Private Beta or Launch', 'LaunchModes'),
(88, '2012-08-22 17:43:00', '2012-08-22 17:43:03', 38, 'Google', 'Google is used for login and fetching contacts.', ''),
(89, '2012-08-22 17:43:52', '2012-08-22 17:43:54', 38, 'Yahoo!', 'Yahoo! is used for login and fetching contacts.', ''),
(90, '2012-08-22 17:44:40', '2012-08-22 17:44:42', 38, 'Open id', 'Open id is used for login and posting message using its account details.', ''),
(91, '2012-08-22 17:45:01', '2012-08-22 17:45:04', 38, 'LinkedIn', 'LinkedIn is used for login and fetching contacts.', ''),
(95, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 94, 'Widget #1', '', ''),
(96, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 94, 'Widget #2', '', ''),
(97, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 94, 'Widget #3', '', ''),
(98, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 94, 'Widget #4', '', ''),
(99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'CAPTCHA', 'Here you can select the CAPTCHA option. Solve Media offers revenue sharing by showing Ads in CAPTCHA display. If you choose Solve Media, enter the application key in ##APPLICATION_KEY##', ''),
(100, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 38, 'Solve Media', 'Solve Media offers revenue sharing by showing Ads in CAPTCHA display. You can enable it in ##CATPCHA_CONF## For getting API keys, refer ##DEMO_URL##', ''),
(92, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Remember me', NULL, ''),
(105, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 85, 'Invite', NULL, ''),
(106, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 85, 'Share', NULL, ''),
(108, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 55, 'Configuration', NULL, ''),
(109, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 103, 'Configuration', NULL, ''),
(112, '2012-12-19 19:38:11', '2012-12-19 19:38:14', 0, 'Mobile Apps', 'Manage iPhone App key', 'MobileApp'),
(113, '2012-12-19 19:56:26', '2012-12-19 19:56:30', 112, 'Mobile Apps', 'All mobile apps will send a secret key (hard coded in Mobile App) to fetch the data from the server. The app''s key should be matched with this value.<br/> Warning: changing this value may break your mobile apps. ', 'MobileApp'),
(114, '2013-02-19 19:39:52', '2013-02-19 19:39:55', 38, 'Google Analytics', NULL, ''),
(115, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 38, 'Google+', 'Google+ is used for login and fetching contacts.', ''),
(120, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Lend', '', 'Lend'),
(121, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 22, 'Equity', '', 'Equity'),
(122, '2013-04-09 15:39:45', '2013-04-09 15:39:47', 11, 'Lend Configuration', 'Here you can modify lend project settings.', 'Lend'),
(123, '2013-03-28 16:02:03', '2013-03-28 16:02:05', 11, 'Equity Configuration', 'Here you can modify equity module related settings', 'Equity'),
(124, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'High Performance', 'Manage high performance related settings', 'HighPerformance'),
(141, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 124, 'Redis', 'By enabling this, session data will be stored in Redis instead from the database or files. This will improve site performance when site''s user base is high.', 'HighPerformance'),
(142, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 124, 'Memcached', 'By enabling this, database queries'' results will be stored in Memcached. As this reducing direct database access to some extent, this will improve site performance.', 'HighPerformance'),
(143, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 124, 'Full-page Caching', 'By enabling this, most of the pages will be disk-cached. This will avoid PHP and database access. Caveat of this approach is that users will be presented with little outdated contents. Since, this Agriya SFPlatform script is highly optimized for this approach, this is highly recommended for good performance. ', 'HighPerformance'),
(144, '2013-04-29 12:12:09', '2013-04-29 12:12:12', 124, 'Amazon S3', 'By enabling this, uploaded contents and static (CSS, JavaScript, images, etc) will be stored in Amazon S3 and will be delivered from there. This will have 2 benefits: 1. You may reduce storage and bandwidth cost--based on your server plan, 2. As files will be delivered from Amazon S3 infrastructure, site''s loading speed may improve. ', 'HighPerformance'),
(139, '2012-02-27 12:03:49', '2012-02-27 12:03:55', 124, 'Pull CDN', 'By configuring Pull CDN services and entering the CDN domains below, we can make assets to be delivered through CDN easily.', 'HighPerformance'),
(137, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 124, 'CloudFlare', 'CloudFlare acts as a CDN and is capable of mitigating DDoS attacks.', 'HighPerformance'),
(132, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 38, 'AngelList', 'AngelList is used to login and import startups', ''),
(140, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 124, 'Email Delivery', 'Normally emails will be delivered through PHP. By enabling this option, email will be sent through this custom SMTP server. For performance, cloud email services like Amazon SES, Sendgrid, Mandrill, Gmail can be configured. ', 'HighPerformance'),
(135, '2013-05-15 12:01:13', '2013-05-15 12:01:15', 0, 'Blog', 'Manage blog related settings', 'Blog'),
(136, '2013-05-15 12:01:13', '2013-05-15 12:01:15', 135, 'Configuration', 'By enabling this, link to blog will be enabled in footer.', 'Blog');

-- --------------------------------------------------------

--
-- Table structure for table `site_categories`
--

DROP TABLE IF EXISTS `site_categories`;
CREATE TABLE IF NOT EXISTS `site_categories` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(265) collate utf8_unicode_ci default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `site_categories`
--

INSERT INTO `site_categories` (`id`, `created`, `modified`, `name`, `slug`, `is_active`) VALUES
(1, '2010-05-14 07:31:32', '2010-05-14 07:31:32', 'Technology', 'technology', 1),
(2, '2010-05-14 07:31:47', '2010-05-14 07:31:47', 'Programming', 'programming', 1),
(3, '2010-05-14 07:32:00', '2010-05-14 07:32:00', 'Music & Audio', 'music-audio', 1),
(4, '2010-05-14 07:32:13', '2010-05-14 07:32:13', 'Business', 'business', 1),
(5, '2010-05-14 07:32:28', '2010-05-14 07:32:28', 'Silly Stuff', 'silly-stuff', 1),
(6, '2010-05-14 07:32:42', '2010-05-14 07:32:42', 'Other', 'other', 1),
(7, '2010-05-14 07:32:55', '2010-05-14 07:32:55', 'Graphics', 'graphics', 1),
(8, '2010-05-14 07:33:17', '2010-05-14 07:33:17', 'Writing', 'writing', 1),
(9, '2010-05-14 07:33:30', '2010-06-04 09:03:58', 'Fun &  Bizarre', 'fun-bizarre', 0);

-- --------------------------------------------------------

--
-- Table structure for table `social_contacts`
--

DROP TABLE IF EXISTS `social_contacts`;
CREATE TABLE IF NOT EXISTS `social_contacts` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `social_source_id` int(11) NOT NULL,
  `social_contact_detail_id` int(11) NOT NULL,
  `social_user_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `social_source_id` (`social_source_id`),
  KEY `social_contact_detail_id` (`social_contact_detail_id`),
  KEY `social_user_id` (`social_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_contacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `social_contact_details`
--

DROP TABLE IF EXISTS `social_contact_details`;
CREATE TABLE IF NOT EXISTS `social_contact_details` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) default NULL,
  `facebook_user_id` varchar(150) NOT NULL,
  `twitter_user_id` varchar(150) NOT NULL,
  `googleplus_user_id` varchar(150) NOT NULL,
  `angellist_user_id` varchar(150) NOT NULL,
  `linkedin_user_id` varchar(150) NOT NULL,
  `social_contact_count` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `facebook_user_id` (`facebook_user_id`),
  KEY `twitter_user_id` (`twitter_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_contact_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) NOT NULL auto_increment,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(45) collate utf8_unicode_ci default NULL,
  `code` varchar(8) collate utf8_unicode_ci default NULL,
  `adm1code` varchar(4) collate utf8_unicode_ci default NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--


-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `project_type_id` int(10) unsigned NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `created` datetime default NULL,
  `ip` int(4) unsigned default NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `page` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `project_type_id` (`project_type_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `submission_fields`
--

DROP TABLE IF EXISTS `submission_fields`;
CREATE TABLE IF NOT EXISTS `submission_fields` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `submission_id` int(10) unsigned NOT NULL,
  `form_field_id` bigint(20) NOT NULL,
  `form_field` varchar(255) collate utf8_unicode_ci NOT NULL,
  `response` text collate utf8_unicode_ci,
  `type` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `submission_id` (`submission_id`),
  KEY `form_field_id` (`form_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submission_fields`
--


-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) default NULL,
  `email` varchar(100) NOT NULL,
  `is_subscribed` tinyint(1) NOT NULL default '1',
  `unsubscribed_on` date NOT NULL,
  `ip_id` bigint(20) default NULL,
  `invite_hash` varchar(255) default NULL,
  `site_state_id` int(11) default '0',
  `is_sent_private_beta_mail` tinyint(1) NOT NULL default '0',
  `is_social_like` tinyint(1) NOT NULL default '0',
  `is_invite` tinyint(1) default '0',
  `invite_user_id` bigint(20) default '0',
  `is_email_verified` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `email` (`email`),
  KEY `ip_id` (`ip_id`),
  KEY `site_state_id` (`site_state_id`),
  KEY `invite_user_id` (`invite_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--


-- --------------------------------------------------------

--
-- Table structure for table `sudopay_ipn_logs`
--

DROP TABLE IF EXISTS `sudopay_ipn_logs`;
CREATE TABLE IF NOT EXISTS `sudopay_ipn_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `ip` bigint(20) default NULL,
  `post_variable` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sudopay_ipn_logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `sudopay_payment_gateways`
--

DROP TABLE IF EXISTS `sudopay_payment_gateways`;
CREATE TABLE IF NOT EXISTS `sudopay_payment_gateways` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `sudopay_gateway_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `sudopay_gateway_id` bigint(20) default NULL,
  `sudopay_payment_group_id` bigint(20) NOT NULL,
  `sudopay_gateway_details` text collate utf8_unicode_ci NOT NULL,
  `is_marketplace_supported` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  KEY `sudopay_gateway_id` (`sudopay_gateway_id`),
  KEY `sudopay_payment_group_id` (`sudopay_payment_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sudopay_payment_gateways`
--


-- --------------------------------------------------------

--
-- Table structure for table `sudopay_payment_gateways_users`
--

DROP TABLE IF EXISTS `sudopay_payment_gateways_users`;
CREATE TABLE IF NOT EXISTS `sudopay_payment_gateways_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `sudopay_payment_gateway_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sudopay_payment_gateways_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `sudopay_payment_groups`
--

DROP TABLE IF EXISTS `sudopay_payment_groups`;
CREATE TABLE IF NOT EXISTS `sudopay_payment_groups` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `sudopay_group_id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `thumb_url` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sudopay_payment_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `sudopay_transaction_logs`
--

DROP TABLE IF EXISTS `sudopay_transaction_logs`;
CREATE TABLE IF NOT EXISTS `sudopay_transaction_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `amount` double(10,2) NOT NULL,
  `payment_id` bigint(20) default NULL,
  `class` varchar(50) collate utf8_unicode_ci NOT NULL,
  `foreign_id` bigint(20) default NULL,
  `sudopay_pay_key` varchar(255) collate utf8_unicode_ci default NULL,
  `merchant_id` bigint(20) default NULL,
  `gateway_id` int(11) default NULL,
  `gateway_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `status` varchar(50) collate utf8_unicode_ci NOT NULL,
  `payment_type` varchar(50) collate utf8_unicode_ci NOT NULL,
  `buyer_id` bigint(20) default NULL,
  `buyer_email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `buyer_address` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sudopay_transaction_logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

DROP TABLE IF EXISTS `taxonomies`;
CREATE TABLE IF NOT EXISTS `taxonomies` (
  `id` int(20) NOT NULL auto_increment,
  `parent_id` int(20) default NULL,
  `term_id` int(10) NOT NULL,
  `vocabulary_id` int(10) NOT NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `term_id` (`term_id`),
  KEY `vocabulary_id` (`vocabulary_id`),
  KEY `lft` (`lft`),
  KEY `rght` (`rght`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taxonomies`
--

INSERT INTO `taxonomies` (`id`, `parent_id`, `term_id`, `vocabulary_id`, `lft`, `rght`) VALUES
(1, NULL, 1, 1, 1, 2),
(2, NULL, 2, 1, 3, 4),
(3, NULL, 3, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
CREATE TABLE IF NOT EXISTS `terms` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `slug`, `description`, `updated`, `created`) VALUES
(1, 'Uncategorized', 'uncategorized', '', '2009-07-22 03:38:43', '2009-07-22 03:34:56'),
(2, 'Announcements', 'announcements', '', '2010-05-16 23:57:06', '2009-07-22 03:45:37'),
(3, 'mytag', 'mytag', '', '2009-08-26 14:42:43', '2009-08-26 14:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
CREATE TABLE IF NOT EXISTS `timezones` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `code` varchar(255) collate utf8_unicode_ci NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `gmt_offset` varchar(10) collate utf8_unicode_ci NOT NULL,
  `dst_offset` varchar(10) collate utf8_unicode_ci NOT NULL,
  `raw_offset` varchar(10) collate utf8_unicode_ci NOT NULL,
  `hasdst` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `created`, `modified`, `code`, `name`, `gmt_offset`, `dst_offset`, `raw_offset`, `hasdst`) VALUES
(1, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Apia', '(GMT-11:00) Apia', '-10.0', '-11.0', '-11.0', 1),
(2, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Midway', '(GMT-11:00) Midway', '-11.0', '-11.0', '-11.0', 0),
(3, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Niue', '(GMT-11:00) Niue', '-11.0', '-11.0', '-11.0', 0),
(4, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Pago_Pago', '(GMT-11:00) Pago Pago', '-11.0', '-11.0', '-11.0', 0),
(5, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Fakaofo', '(GMT-10:00) Fakaofo', '-10.0', '-10.0', '-10.0', 0),
(6, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Honolulu', '(GMT-10:00) Hawaii Time', '-10.0', '-10.0', '-10.0', 0),
(7, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Johnston', '(GMT-10:00) Johnston', '-10.0', '-10.0', '-10.0', 0),
(8, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Rarotonga', '(GMT-10:00) Rarotonga', '-10.0', '-10.0', '-10.0', 0),
(9, '2010-05-10 20:13:09', '2010-05-10 20:13:09', 'Pacific/Tahiti', '(GMT-10:00) Tahiti', '-10.0', '-10.0', '-10.0', 0),
(10, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'Pacific/Marquesas', '(GMT-09:30) Marquesas', '-9.5', '-9.5', '-9.5', 0),
(11, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Anchorage', '(GMT-09:00) Alaska Time', '-9.0', '-8.0', '-9.0', 1),
(12, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'Pacific/Gambier', '(GMT-09:00) Gambier', '-9.0', '-9.0', '-9.0', 0),
(13, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Los_Angeles', '(GMT-08:00) Pacific Time', '-8.0', '-7.0', '-8.0', 1),
(14, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Tijuana', '(GMT-08:00) Pacific Time - Tijuana', '-8.0', '-7.0', '-8.0', 1),
(15, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Vancouver', '(GMT-08:00) Pacific Time - Vancouver', '-8.0', '-7.0', '-8.0', 1),
(16, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Whitehorse', '(GMT-08:00) Pacific Time - Whitehorse', '-8.0', '-7.0', '-8.0', 1),
(17, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'Pacific/Pitcairn', '(GMT-08:00) Pitcairn', '-8.0', '-8.0', '-8.0', 0),
(18, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Dawson_Creek', '(GMT-07:00) Mountain Time - Dawson Creek', '-7.0', '-7.0', '-7.0', 0),
(19, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Denver', '(GMT-07:00) Mountain Time (America/Denver)', '-7.0', '-6.0', '-7.0', 1),
(20, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Edmonton', '(GMT-07:00) Mountain Time - Edmonton', '-7.0', '-6.0', '-7.0', 1),
(21, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Hermosillo', '(GMT-07:00) Mountain Time - Hermosillo', '-7.0', '-7.0', '-7.0', 0),
(22, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Mazatlan', '(GMT-07:00) Mountain Time - Chihuahua, Mazatlan', '-7.0', '-6.0', '-7.0', 1),
(23, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Phoenix', '(GMT-07:00) Mountain Time - Arizona', '-7.0', '-7.0', '-7.0', 0),
(24, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Yellowknife', '(GMT-07:00) Mountain Time - Yellowknife', '-7.0', '-6.0', '-7.0', 1),
(25, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Belize', '(GMT-06:00) Belize', '-6.0', '-6.0', '-6.0', 0),
(26, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Chicago', '(GMT-06:00) Central Time', '-6.0', '-5.0', '-6.0', 1),
(27, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Costa_Rica', '(GMT-06:00) Costa Rica', '-6.0', '-6.0', '-6.0', 0),
(28, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/El_Salvador', '(GMT-06:00) El Salvador', '-6.0', '-6.0', '-6.0', 0),
(29, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Guatemala', '(GMT-06:00) Guatemala', '-6.0', '-6.0', '-6.0', 0),
(30, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Managua', '(GMT-06:00) Managua', '-6.0', '-6.0', '-6.0', 0),
(31, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Mexico_City', '(GMT-06:00) Central Time - Mexico City', '-6.0', '-5.0', '-6.0', 1),
(32, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Regina', '(GMT-06:00) Central Time - Regina', '-6.0', '-6.0', '-6.0', 0),
(33, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Tegucigalpa', '(GMT-06:00) Central Time (America/Tegucigalpa)', '-6.0', '-6.0', '-6.0', 0),
(34, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Winnipeg', '(GMT-06:00) Central Time - Winnipeg', '-6.0', '-5.0', '-6.0', 1),
(35, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'Pacific/Easter', '(GMT-06:00) Easter Island', '-6.0', '-5.0', '-6.0', 1),
(36, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'Pacific/Galapagos', '(GMT-06:00) Galapagos', '-6.0', '-6.0', '-6.0', 0),
(37, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Bogota', '(GMT-05:00) Bogota', '-5.0', '-5.0', '-5.0', 0),
(38, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Cayman', '(GMT-05:00) Cayman', '-5.0', '-4.0', '-5.0', 1),
(39, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Grand_Turk', '(GMT-05:00) Grand Turk', '-5.0', '-4.0', '-5.0', 1),
(40, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Guayaquil', '(GMT-05:00) Guayaquil', '-5.0', '-5.0', '-5.0', 0),
(41, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Havana', '(GMT-05:00) Havana', '-5.0', '-4.0', '-5.0', 1),
(42, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Iqaluit', '(GMT-05:00) Eastern Time - Iqaluit', '-5.0', '-4.0', '-5.0', 1),
(43, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Jamaica', '(GMT-05:00) Jamaica', '-5.0', '-5.0', '-5.0', 0),
(44, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Lima', '(GMT-05:00) Lima', '-5.0', '-5.0', '-5.0', 0),
(45, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Montreal', '(GMT-05:00) Eastern Time - Montreal', '-5.0', '-4.0', '-5.0', 1),
(46, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Nassau', '(GMT-05:00) Nassau', '-5.0', '-4.0', '-5.0', 1),
(47, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/New_York', '(GMT-05:00) Eastern Time', '-5.0', '-4.0', '-5.0', 1),
(48, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Panama', '(GMT-05:00) Panama', '-5.0', '-5.0', '-5.0', 0),
(49, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Port-au-Prince', '(GMT-05:00) Port-au-Prince', '-5.0', '-5.0', '-5.0', 0),
(50, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Toronto', '(GMT-05:00) Eastern Time - Toronto', '-5.0', '-4.0', '-5.0', 1),
(51, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Caracas', '(GMT-04:30) Caracas', '-4.5', '-4.5', '-4.5', 0),
(52, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Anguilla', '(GMT-04:00) Anguilla', '-4.0', '-4.0', '-4.0', 0),
(53, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Antigua', '(GMT-04:00) Antigua', '-4.0', '-4.0', '-4.0', 0),
(54, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Aruba', '(GMT-04:00) Aruba', '-4.0', '-4.0', '-4.0', 0),
(55, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Asuncion', '(GMT-04:00) Asuncion', '-3.0', '-4.0', '-4.0', 1),
(56, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Barbados', '(GMT-04:00) Barbados', '-4.0', '-4.0', '-4.0', 0),
(57, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Boa_Vista', '(GMT-04:00) Boa Vista', '-4.0', '-4.0', '-4.0', 0),
(58, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Campo_Grande', '(GMT-04:00) Campo Grande', '-3.0', '-4.0', '-4.0', 0),
(59, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Cuiaba', '(GMT-04:00) Cuiaba', '-3.0', '-4.0', '-4.0', 1),
(60, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Curacao', '(GMT-04:00) Curacao', '-4.0', '-4.0', '-4.0', 0),
(61, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Dominica', '(GMT-04:00) Dominica', '-4.0', '-4.0', '-4.0', 0),
(62, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Grenada', '(GMT-04:00) Grenada', '-4.0', '-4.0', '-4.0', 0),
(63, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Guadeloupe', '(GMT-04:00) Guadeloupe', '-4.0', '0.0', '-4.0', 1),
(64, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Guyana', '(GMT-04:00) Guyana', '-4.0', '-4.0', '-4.0', 0),
(65, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Halifax', '(GMT-04:00) Atlantic Time - Halifax', '0.0', '1.0', '0.0', 1),
(66, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/La_Paz', '(GMT-04:00) La Paz', '-4.0', '-4.0', '-4.0', 0),
(67, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Manaus', '(GMT-04:00) Manaus', '-4.0', '-4.0', '-4.0', 0),
(68, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Martinique', '(GMT-04:00) Martinique', '-4.0', '-4.0', '-4.0', 0),
(69, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Montserrat', '(GMT-04:00) Montserrat', '-4.0', '-4.0', '-4.0', 0),
(70, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Port_of_Spain', '(GMT-04:00) Port of Spain', '-4.0', '-4.0', '-4.0', 0),
(71, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Porto_Velho', '(GMT-04:00) Porto Velho', '-4.0', '-4.0', '-4.0', 0),
(72, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Puerto_Rico', '(GMT-04:00) Puerto Rico', '-4.0', '-4.0', '-4.0', 0),
(73, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Rio_Branco', '(GMT-04:00) Rio Branco', '', '', '', 0),
(74, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Santiago', '(GMT-04:00) Santiago', '-3.0', '-4.0', '-4.0', 1),
(75, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/Santo_Domingo', '(GMT-04:00) Santo Domingo', '-4.0', '-4.0', '-4.0', 0),
(76, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/St_Kitts', '(GMT-04:00) St. Kitts', '-4.0', '-4.0', '-4.0', 0),
(77, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/St_Lucia', '(GMT-04:00) St. Lucia', '-4.0', '-4.0', '-4.0', 0),
(78, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/St_Thomas', '(GMT-04:00) St. Thomas', '-4.0', '-4.0', '-4.0', 0),
(79, '2010-05-10 20:13:10', '2010-05-10 20:13:10', 'America/St_Vincent', '(GMT-04:00) St. Vincent', '-4.0', '-4.0', '-4.0', 0),
(80, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Thule', '(GMT-04:00) Thule', '11.0', '10.0', '10.0', 1),
(81, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Tortola', '(GMT-04:00) Tortola', '-4.0', '-4.0', '-4.0', 0),
(82, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Antarctica/Palmer', '(GMT-04:00) Palmer', '1.0', '2.0', '1.0', 1),
(83, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Bermuda', '(GMT-04:00) Bermuda', '-4.0', '-3.0', '-4.0', 1),
(84, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Stanley', '(GMT-04:00) Stanley', '11.0', '10.0', '10.0', 1),
(85, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/St_Johns', '(GMT-03:30) Newfoundland Time - St. Johns', '-3.5', '-2.5', '-3.5', 1),
(86, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Araguaina', '(GMT-03:00) Araguaina', '-3.0', '-3.0', '-3.0', 0),
(87, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Argentina/Buenos_Aires', '(GMT-03:00) Buenos Aires', '-3.0', '-3.0', '-3.0', 0),
(88, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Bahia', '(GMT-03:00) Salvador', '-3.0', '-3.0', '-3.0', 0),
(89, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Belem', '(GMT-03:00) Belem', '-3.0', '-3.0', '-3.0', 0),
(90, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Cayenne', '(GMT-03:00) Cayenne', '-3.0', '-3.0', '-3.0', 0),
(91, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Fortaleza', '(GMT-03:00) Fortaleza', '-3.0', '-3.0', '-3.0', 0),
(92, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Godthab', '(GMT-03:00) Godthab', '-3.0', '-2.0', '-3.0', 1),
(93, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Maceio', '(GMT-03:00) Maceio', '-3.0', '-3.0', '-3.0', 0),
(94, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Miquelon', '(GMT-03:00) Miquelon', '-3.0', '-2.0', '-3.0', 1),
(95, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Montevideo', '(GMT-03:00) Montevideo', '-2.0', '-3.0', '-3.0', 1),
(96, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Paramaribo', '(GMT-03:00) Paramaribo', '-3.0', '-3.0', '-3.0', 0),
(97, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Recife', '(GMT-03:00) Recife', '-3.0', '-3.0', '-3.0', 0),
(98, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Sao_Paulo', '(GMT-03:00) Sao Paulo', '-2.0', '-3.0', '-3.0', 0),
(99, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Antarctica/Rothera', '(GMT-03:00) Rothera', '-3.0', '-3.0', '-3.0', 0),
(100, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Noronha', '(GMT-02:00) Noronha', '-2.0', '-3.0', '-3.0', 1),
(101, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/South_Georgia', '(GMT-02:00) South Georgia', '-2.0', '-2.0', '-2.0', 0),
(102, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Scoresbysund', '(GMT-01:00) Scoresbysund', '-1.0', '0.0', '-1.0', 1),
(103, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Azores', '(GMT-01:00) Azores', '-1.0', '0.0', '-1.0', 1),
(104, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Cape_Verde', '(GMT-01:00) Cape Verde', '-1.0', '-0.0', '-1.0', 0),
(105, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Abidjan', '(GMT+00:00) Abidjan', '0.0', '0.0', '0.0', 0),
(106, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Accra', '(GMT+00:00) Accra', '0.0', '0.0', '0.0', 0),
(107, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Bamako', '(GMT+00:00) Bamako', '0.0', '0.0', '0.0', 0),
(108, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Banjul', '(GMT+00:00) Banjul', '0.0', '0.0', '0.0', 0),
(109, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Bissau', '(GMT+00:00) Bissau', '0.0', '0.0', '0.0', 0),
(110, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Casablanca', '(GMT+00:00) Casablanca', '0.0', '0.0', '0.0', 0),
(111, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Conakry', '(GMT+00:00) Conakry', '0.0', '0.0', '0.0', 0),
(112, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Dakar', '(GMT+00:00) Dakar', '0.0', '0.0', '0.0', 0),
(113, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/El_Aaiun', '(GMT+00:00) El Aaiun', '0.0', '0.0', '0.0', 0),
(114, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Freetown', '(GMT+00:00) Freetown', '0.0', '0.0', '0.0', 0),
(115, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Lome', '(GMT+00:00) Lome', '0.0', '0.0', '0.0', 0),
(116, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Monrovia', '(GMT+00:00) Monrovia', '0.0', '0.0', '0.0', 0),
(117, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Nouakchott', '(GMT+00:00) Nouakchott', '0.0', '0.0', '0.0', 0),
(118, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Ouagadougou', '(GMT+00:00) Ouagadougou', '0.0', '0.0', '0.0', 0),
(119, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Sao_Tome', '(GMT+00:00) Sao Tome', '0.0', '0.0', '0.0', 0),
(120, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'America/Danmarkshavn', '(GMT+00:00) Danmarkshavn', '0.0', '0.0', '0.0', 0),
(121, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Canary', '(GMT+00:00) Canary Islands', '', '', '', 0),
(122, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Faroe', '(GMT+00:00) Faeroe', '1.0', '2.0', '1.0', 1),
(123, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/Reykjavik', '(GMT+00:00) Reykjavik', '0.0', '0.0', '0.0', 0),
(124, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Atlantic/St_Helena', '(GMT+00:00) St Helena', '-1.0', '0.0', '-1.0', 0),
(125, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Etc/GMT', '(GMT+00:00) GMT (no daylight saving)', '0.0', '0.0', '0.0', 0),
(126, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Dublin', '(GMT+00:00) Dublin', '0.0', '1.0', '0.0', 1),
(127, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Lisbon', '(GMT+00:00) Lisbon', '0.0', '1.0', '0.0', 1),
(128, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/London', '(GMT+00:00) London', '0.0', '1.0', '0.0', 1),
(129, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Algiers', '(GMT+01:00) Algiers', '1.0', '1.0', '1.0', 0),
(130, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Bangui', '(GMT+01:00) Bangui', '1.0', '1.0', '1.0', 0),
(131, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Brazzaville', '(GMT+01:00) Brazzaville', '1.0', '1.0', '1.0', 0),
(132, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Ceuta', '(GMT+01:00) Ceuta', '1.0', '2.0', '1.0', 1),
(133, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Douala', '(GMT+01:00) Douala', '1.0', '1.0', '1.0', 0),
(134, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Kinshasa', '(GMT+01:00) Kinshasa', '1.0', '1.0', '1.0', 0),
(135, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Lagos', '(GMT+01:00) Lagos', '1.0', '1.0', '1.0', 0),
(136, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Libreville', '(GMT+01:00) Libreville', '1.0', '1.0', '1.0', 0),
(137, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Luanda', '(GMT+01:00) Luanda', '1.0', '1.0', '1.0', 0),
(138, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Malabo', '(GMT+01:00) Malabo', '1.0', '1.0', '1.0', 0),
(139, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Ndjamena', '(GMT+01:00) Ndjamena', '1.0', '1.0', '1.0', 0),
(140, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Niamey', '(GMT+01:00) Niamey', '1.0', '1.0', '1.0', 0),
(141, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Porto-Novo', '(GMT+01:00) Porto-Novo', '1.0', '1.0', '1.0', 0),
(142, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Tunis', '(GMT+01:00) Tunis', '1.0', '2.0', '1.0', 1),
(143, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Windhoek', '(GMT+01:00) Windhoek', '2.0', '1.0', '1.0', 1),
(144, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Amsterdam', '(GMT+01:00) Amsterdam', '1.0', '2.0', '1.0', 1),
(145, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Andorra', '(GMT+01:00) Andorra', '1.0', '2.0', '1.0', 1),
(146, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Belgrade', '(GMT+01:00) Central European Time (Europe/Belgrade)', '1.0', '2.0', '1.0', 1),
(147, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Berlin', '(GMT+01:00) Berlin', '1.0', '2.0', '1.0', 1),
(148, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Brussels', '(GMT+01:00) Brussels', '1.0', '2.0', '1.0', 1),
(149, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Budapest', '(GMT+01:00) Budapest', '1.0', '2.0', '1.0', 1),
(150, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Copenhagen', '(GMT+01:00) Copenhagen', '1.0', '2.0', '1.0', 1),
(151, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Gibraltar', '(GMT+01:00) Gibraltar', '1.0', '2.0', '1.0', 1),
(152, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Luxembourg', '(GMT+01:00) Luxembourg', '1.0', '2.0', '1.0', 1),
(153, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Madrid', '(GMT+01:00) Madrid', '1.0', '2.0', '1.0', 1),
(154, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Malta', '(GMT+01:00) Malta', '1.0', '2.0', '1.0', 1),
(155, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Monaco', '(GMT+01:00) Monaco', '1.0', '2.0', '1.0', 1),
(156, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Oslo', '(GMT+01:00) Oslo', '1.0', '2.0', '1.0', 1),
(157, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Paris', '(GMT+01:00) Paris', '1.0', '2.0', '1.0', 1),
(158, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Prague', '(GMT+01:00) Central European Time (Europe/Prague)', '1.0', '2.0', '1.0', 1),
(159, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Rome', '(GMT+01:00) Rome', '1.0', '2.0', '1.0', 1),
(160, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Stockholm', '(GMT+01:00) Stockholm', '1.0', '2.0', '1.0', 1),
(161, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Tirane', '(GMT+01:00) Tirane', '1.0', '2.0', '1.0', 1),
(162, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Vaduz', '(GMT+01:00) Vaduz', '1.0', '2.0', '1.0', 1),
(163, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Vienna', '(GMT+01:00) Vienna', '1.0', '2.0', '1.0', 1),
(164, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Warsaw', '(GMT+01:00) Warsaw', '1.0', '2.0', '1.0', 1),
(165, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Zurich', '(GMT+01:00) Zurich', '1.0', '2.0', '1.0', 1),
(166, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Blantyre', '(GMT+02:00) Blantyre', '2.0', '2.0', '2.0', 0),
(167, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Bujumbura', '(GMT+02:00) Bujumbura', '2.0', '2.0', '2.0', 0),
(168, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Cairo', '(GMT+02:00) Cairo', '2.0', '3.0', '2.0', 1),
(169, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Gaborone', '(GMT+02:00) Gaborone', '2.0', '2.0', '2.0', 0),
(170, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Harare', '(GMT+02:00) Harare', '2.0', '2.0', '2.0', 0),
(171, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Johannesburg', '(GMT+02:00) Johannesburg', '2.0', '2.0', '2.0', 0),
(172, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Kigali', '(GMT+02:00) Kigali', '2.0', '2.0', '2.0', 0),
(173, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Lubumbashi', '(GMT+02:00) Lubumbashi', '2.0', '2.0', '2.0', 0),
(174, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Lusaka', '(GMT+02:00) Lusaka', '2.0', '2.0', '2.0', 0),
(175, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Maputo', '(GMT+02:00) Maputo', '2.0', '2.0', '2.0', 0),
(176, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Maseru', '(GMT+02:00) Maseru', '2.0', '2.0', '2.0', 0),
(177, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Mbabane', '(GMT+02:00) Mbabane', '2.0', '2.0', '2.0', 0),
(178, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Tripoli', '(GMT+02:00) Tripoli', '2.0', '2.0', '2.0', 0),
(179, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Amman', '(GMT+02:00) Amman', '2.0', '3.0', '2.0', 1),
(180, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Beirut', '(GMT+02:00) Beirut', '2.0', '3.0', '2.0', 1),
(181, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Damascus', '(GMT+02:00) Damascus', '2.0', '3.0', '2.0', 1),
(182, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Gaza', '(GMT+02:00) Gaza', '2.0', '3.0', '2.0', 1),
(183, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Jerusalem', '(GMT+02:00) Jerusalem', '2.0', '3.0', '2.0', 1),
(184, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Nicosia', '(GMT+02:00) Nicosia', '2.0', '3.0', '2.0', 1),
(185, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Athens', '(GMT+02:00) Athens', '2.0', '3.0', '2.0', 1),
(186, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Bucharest', '(GMT+02:00) Bucharest', '2.0', '3.0', '2.0', 1),
(187, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Chisinau', '(GMT+02:00) Chisinau', '2.0', '3.0', '2.0', 1),
(188, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Helsinki', '(GMT+02:00) Helsinki', '2.0', '3.0', '2.0', 1),
(189, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Istanbul', '(GMT+02:00) Istanbul', '2.0', '3.0', '2.0', 1),
(190, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Kaliningrad', '(GMT+02:00) Moscow-01 - Kaliningrad', '2.0', '3.0', '2.0', 1),
(191, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Kiev', '(GMT+02:00) Kiev', '2.0', '3.0', '2.0', 1),
(192, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Minsk', '(GMT+02:00) Minsk', '2.0', '3.0', '2.0', 1),
(193, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Riga', '(GMT+02:00) Riga', '2.0', '3.0', '2.0', 1),
(194, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Sofia', '(GMT+02:00) Sofia', '2.0', '3.0', '2.0', 1),
(195, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Tallinn', '(GMT+02:00) Tallinn', '2.0', '3.0', '2.0', 1),
(196, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Vilnius', '(GMT+02:00) Vilnius', '2.0', '3.0', '2.0', 1),
(197, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Addis_Ababa', '(GMT+03:00) Addis Ababa', '3.0', '3.0', '3.0', 0),
(198, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Asmara', '(GMT+03:00) Asmera', '3.0', '3.0', '3.0', 0),
(199, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Dar_es_Salaam', '(GMT+03:00) Dar es Salaam', '3.0', '3.0', '3.0', 0),
(200, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Djibouti', '(GMT+03:00) Djibouti', '3.0', '3.0', '3.0', 0),
(201, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Kampala', '(GMT+03:00) Kampala', '3.0', '3.0', '3.0', 0),
(202, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Khartoum', '(GMT+03:00) Khartoum', '3.0', '3.0', '3.0', 0),
(203, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Mogadishu', '(GMT+03:00) Mogadishu', '3.0', '3.0', '3.0', 0),
(204, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Africa/Nairobi', '(GMT+03:00) Nairobi', '3.0', '3.0', '3.0', 0),
(205, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Antarctica/Syowa', '(GMT+03:00) Syowa', '9.0', '9.0', '9.0', 0),
(206, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Aden', '(GMT+03:00) Aden', '2.0', '3.0', '2.0', 1),
(207, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Baghdad', '(GMT+03:00) Baghdad', '3.0', '3.0', '3.0', 0),
(208, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Bahrain', '(GMT+03:00) Bahrain', '3.0', '3.0', '3.0', 0),
(209, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Kuwait', '(GMT+03:00) Kuwait', '3.0', '3.0', '3.0', 0),
(210, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Qatar', '(GMT+03:00) Qatar', '3.0', '3.0', '3.0', 0),
(211, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Riyadh', '(GMT+03:00) Riyadh', '3.0', '3.0', '3.0', 0),
(212, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Europe/Moscow', '(GMT+03:00) Moscow+00', '3.0', '4.0', '3.0', 1),
(213, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Indian/Antananarivo', '(GMT+03:00) Antananarivo', '3.0', '3.0', '3.0', 0),
(214, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Indian/Comoro', '(GMT+03:00) Comoro', '3.0', '3.0', '3.0', 0),
(215, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Indian/Mayotte', '(GMT+03:00) Mayotte', '3.0', '3.0', '3.0', 0),
(216, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Tehran', '(GMT+03:30) Tehran', '3.5', '4.5', '3.5', 1),
(217, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Baku', '(GMT+04:00) Baku', '4.0', '5.0', '4.0', 1),
(218, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Dubai', '(GMT+04:00) Dubai', '4.0', '4.0', '4.0', 0),
(219, '2010-05-10 20:13:11', '2010-05-10 20:13:11', 'Asia/Muscat', '(GMT+04:00) Muscat', '4.0', '4.0', '4.0', 0),
(220, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Tbilisi', '(GMT+04:00) Tbilisi', '4.0', '4.0', '4.0', 0),
(221, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Yerevan', '(GMT+04:00) Yerevan', '4.0', '5.0', '4.0', 1),
(222, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Europe/Samara', '(GMT+04:00) Moscow+01 - Samara', '4.0', '5.0', '4.0', 1),
(223, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Mahe', '(GMT+04:00) Mahe', '4.0', '4.0', '4.0', 0),
(224, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Mauritius', '(GMT+04:00) Mauritius', '4.0', '4.0', '4.0', 0),
(225, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Reunion', '(GMT+04:00) Reunion', '4.0', '4.0', '4.0', 0),
(226, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Kabul', '(GMT+04:30) Kabul', '4.5', '4.5', '4.5', 0),
(227, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Aqtau', '(GMT+05:00) Aqtau', '5.0', '5.0', '5.0', 0),
(228, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Aqtobe', '(GMT+05:00) Aqtobe', '5.0', '5.0', '5.0', 0),
(229, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Ashgabat', '(GMT+05:00) Ashgabat', '5.0', '5.0', '5.0', 0),
(230, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Dushanbe', '(GMT+05:00) Dushanbe', '5.0', '5.0', '5.0', 0),
(231, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Karachi', '(GMT+05:00) Karachi', '5.0', '6.0', '5.0', 1),
(232, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Tashkent', '(GMT+05:00) Tashkent', '5.0', '5.0', '5.0', 0),
(233, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Yekaterinburg', '(GMT+05:00) Moscow+02 - Yekaterinburg', '5.0', '6.0', '5.0', 1),
(234, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Kerguelen', '(GMT+05:00) Kerguelen', '5.0', '5.0', '5.0', 0),
(235, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Maldives', '(GMT+05:00) Maldives', '5.0', '5.0', '5.0', 0),
(236, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Calcutta', '(GMT+05:30) India Standard Time', '5.5', '5.5', '5.5', 0),
(237, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Colombo', '(GMT+05:30) Colombo', '5.5', '5.5', '5.5', 0),
(238, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Katmandu', '(GMT+05:45) Katmandu', '5.75', '5.75', '5.75', 0),
(239, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Antarctica/Mawson', '(GMT+06:00) Mawson', '6.0', '6.0', '6.0', 0),
(240, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Antarctica/Vostok', '(GMT+06:00) Vostok', '6.0', '6.0', '6.0', 0),
(241, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Almaty', '(GMT+06:00) Almaty', '6.0', '6.0', '6.0', 0),
(242, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Bishkek', '(GMT+06:00) Bishkek', '6.0', '6.0', '6.0', 0),
(243, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Dhaka', '(GMT+06:00) Dhaka', '6.0', '7.0', '6.0', 1),
(244, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Omsk', '(GMT+06:00) Moscow+03 - Omsk, Novosibirsk', '6.0', '7.0', '6.0', 1),
(245, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Thimphu', '(GMT+06:00) Thimphu', '6.0', '6.0', '6.0', 0),
(246, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Chagos', '(GMT+06:00) Chagos', '6.0', '6.0', '6.0', 0),
(247, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Rangoon', '(GMT+06:30) Rangoon', '6.5', '6.5', '6.5', 0),
(248, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Cocos', '(GMT+06:30) Cocos', '6.5', '6.5', '6.5', 0),
(249, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Antarctica/Davis', '(GMT+07:00) Davis', '-8.0', '-7.0', '-8.0', 1),
(250, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Bangkok', '(GMT+07:00) Bangkok', '7.0', '7.0', '7.0', 0),
(251, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Hovd', '(GMT+07:00) Hovd', '7.0', '7.0', '7.0', 0),
(252, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Jakarta', '(GMT+07:00) Jakarta', '7.0', '7.0', '7.0', 0),
(253, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Krasnoyarsk', '(GMT+07:00) Moscow+04 - Krasnoyarsk', '7.0', '8.0', '7.0', 1),
(254, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Phnom_Penh', '(GMT+07:00) Phnom Penh', '7.0', '7.0', '7.0', 0),
(255, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Saigon', '(GMT+07:00) Hanoi', '7.0', '7.0', '7.0', 0),
(256, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Vientiane', '(GMT+07:00) Vientiane', '7.0', '7.0', '7.0', 0),
(257, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Indian/Christmas', '(GMT+07:00) Christmas', '-7.0', '-7.0', '-7.0', 0),
(258, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Antarctica/Casey', '(GMT+08:00) Casey', '8.0', '8.0', '8.0', 0),
(259, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Brunei', '(GMT+08:00) Brunei', '8.0', '8.0', '8.0', 0),
(260, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Choibalsan', '(GMT+08:00) Choibalsan', '8.0', '8.0', '8.0', 0),
(261, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Hong_Kong', '(GMT+08:00) Hong Kong', '8.0', '8.0', '8.0', 0),
(262, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Irkutsk', '(GMT+08:00) Moscow+05 - Irkutsk', '8.0', '9.0', '8.0', 1),
(263, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Kuala_Lumpur', '(GMT+08:00) Kuala Lumpur', '8.0', '8.0', '8.0', 0),
(264, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Macau', '(GMT+08:00) Macau', '8.0', '8.0', '8.0', 0),
(265, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Makassar', '(GMT+08:00) Makassar', '8.0', '8.0', '8.0', 0),
(266, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Manila', '(GMT+08:00) Manila', '8.0', '8.0', '8.0', 0),
(267, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Shanghai', '(GMT+08:00) China Time - Beijing', '8.0', '8.0', '8.0', 0),
(268, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Singapore', '(GMT+08:00) Singapore', '8.0', '8.0', '8.0', 0),
(269, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Taipei', '(GMT+08:00) Taipei', '8.0', '8.0', '8.0', 0),
(270, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Ulaanbaatar', '(GMT+08:00) Ulaanbaatar', '8.0', '8.0', '8.0', 0),
(271, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Australia/Perth', '(GMT+08:00) Western Time - Perth', '8.0', '8.0', '8.0', 0),
(272, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Dili', '(GMT+09:00) Dili', '8.0', '8.0', '8.0', 0),
(273, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Jayapura', '(GMT+09:00) Jayapura', '9.0', '9.0', '9.0', 0),
(274, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Pyongyang', '(GMT+09:00) Pyongyang', '9.0', '9.0', '9.0', 0),
(275, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Seoul', '(GMT+09:00) Seoul', '9.0', '9.0', '9.0', 0),
(276, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Tokyo', '(GMT+09:00) Tokyo', '9.0', '9.0', '9.0', 0),
(277, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Yakutsk', '(GMT+09:00) Moscow+06 - Yakutsk', '9.0', '10.0', '9.0', 1),
(278, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Palau', '(GMT+09:00) Palau', '9.0', '9.0', '9.0', 0),
(279, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Australia/Adelaide', '(GMT+09:30) Central Time - Adelaide', '10.5', '9.5', '9.5', 1),
(280, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Australia/Darwin', '(GMT+09:30) Central Time - Darwin', '9.5', '9.5', '9.5', 0),
(281, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Antarctica/DumontDUrville', '(GMT+10:00) Dumont D''Urville', '10.0', '10.0', '10.0', 0),
(282, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Vladivostok', '(GMT+10:00) Moscow+07 - Yuzhno-Sakhalinsk', '10.0', '11.0', '10.0', 1),
(283, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Australia/Brisbane', '(GMT+10:00) Eastern Time - Brisbane', '10.0', '10.0', '10.0', 0),
(284, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Australia/Hobart', '(GMT+10:00) Eastern Time - Hobart', '-6.0', '-5.0', '-6.0', 1),
(285, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Australia/Sydney', '(GMT+10:00) Eastern Time - Melbourne, Sydney', '11.0', '10.0', '10.0', 1),
(286, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Guam', '(GMT+10:00) Guam', '10.0', '10.0', '10.0', 0),
(287, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Port_Moresby', '(GMT+10:00) Port Moresby', '10.0', '10.0', '10.0', 0),
(288, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Saipan', '(GMT+10:00) Saipan', '10.0', '10.0', '10.0', 0),
(289, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Truk', '(GMT+10:00) Truk', '10.0', '10.0', '10.0', 0),
(290, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Magadan', '(GMT+11:00) Moscow+08 - Magadan', '11.0', '12.0', '11.0', 1),
(291, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Efate', '(GMT+11:00) Efate', '11.0', '11.0', '11.0', 0),
(292, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Guadalcanal', '(GMT+11:00) Guadalcanal', '11.0', '11.0', '11.0', 0),
(293, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Kosrae', '(GMT+11:00) Kosrae', '11.0', '11.0', '11.0', 0),
(294, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Noumea', '(GMT+11:00) Noumea', '11.0', '11.0', '11.0', 0),
(295, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Ponape', '(GMT+11:00) Ponape', '11.0', '11.0', '11.0', 0),
(296, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Norfolk', '(GMT+11:30) Norfolk', '11.5', '11.5', '11.5', 0),
(297, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Asia/Kamchatka', '(GMT+12:00) Moscow+09 - Petropavlovsk-Kamchatskiy', '12.0', '13.0', '12.0', 1),
(298, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Auckland', '(GMT+12:00) Auckland', '13.0', '12.0', '12.0', 1),
(299, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Fiji', '(GMT+12:00) Fiji', '12.0', '12.0', '12.0', 0),
(300, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Funafuti', '(GMT+12:00) Funafuti', '12.0', '12.0', '12.0', 0),
(301, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Kwajalein', '(GMT+12:00) Kwajalein', '12.0', '12.0', '12.0', 0),
(302, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Majuro', '(GMT+12:00) Majuro', '12.0', '12.0', '12.0', 0),
(303, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Nauru', '(GMT+12:00) Nauru', '12.0', '12.0', '12.0', 0),
(304, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Tarawa', '(GMT+12:00) Tarawa', '12.0', '12.0', '12.0', 0),
(305, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Wake', '(GMT+12:00) Wake', '12.0', '12.0', '12.0', 0),
(306, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Wallis', '(GMT+12:00) Wallis', '12.0', '12.0', '12.0', 0),
(307, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Enderbury', '(GMT+13:00) Enderbury', '13.0', '13.0', '13.0', 0),
(308, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Tongatapu', '(GMT+13:00) Tongatapu', '13.0', '13.0', '13.0', 0),
(309, '2010-05-10 20:13:12', '2010-05-10 20:13:12', 'Pacific/Kiritimati', '(GMT+14:00) Kiritimati', '14.0', '14.0', '14.0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `receiver_user_id` bigint(20) NOT NULL,
  `foreign_id` bigint(20) NOT NULL,
  `class` varchar(25) collate utf8_unicode_ci default NULL,
  `transaction_type_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `payment_gateway_id` bigint(20) default NULL,
  `project_type_id` int(11) default '0',
  `gateway_fees` double(10,2) NOT NULL,
  `remarks` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `foreign_id` (`foreign_id`),
  KEY `class` (`class`),
  KEY `receiver_user_id` (`receiver_user_id`),
  KEY `project_type_id` (`project_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `is_credit` tinyint(1) default '0',
  `is_credit_to_receiver` tinyint(1) NOT NULL default '0',
  `is_credit_to_admin` tinyint(1) NOT NULL default '0',
  `message` text collate utf8_unicode_ci NOT NULL,
  `message_for_admin` text collate utf8_unicode_ci NOT NULL,
  `message_for_receiver` text collate utf8_unicode_ci NOT NULL,
  `transaction_variables` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `created`, `modified`, `name`, `is_credit`, `is_credit_to_receiver`, `is_credit_to_admin`, `message`, `message_for_admin`, `message_for_receiver`, `transaction_variables`) VALUES
(1, '2010-04-08 15:53:48', '2012-05-14 07:10:04', 'Project Backed', 0, 1, 1, 'You ##FUNDED## for project ##PROJECT##', '##BACKER## ##FUNDED## for project ##PROJECT##', '##BACKER## ##FUNDED## for your project ##PROJECT##', '##PROJECT##, ##BACKER##, ##FUNDED##'),
(2, '2010-04-08 15:53:48', '2010-04-08 15:53:48', 'Project Fund Refunded', 0, 1, 0, '##BACKER## ##FUNDED## ##CANCELED## for your project ##PROJECT##', '##BACKER## ##FUNDED## ##CANCELED## for project ##PROJECT##', 'Your ##FUNDED## ##CANCELED## for project ##PROJECT##', '##PROJECT##, ##BACKER##, ##FUNDED##, ##CANCELED##'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Project Listing', 0, 0, 1, 'You have added a new project ##PROJECT##', '##PROJECT_OWNER## have added a new project ##PROJECT##', '', '##PROJECT_OWNER##, ##PROJECT##'),
(4, '2011-03-08 11:20:02', '2011-03-08 11:20:04', 'User Membership', 0, 0, 1, 'Membership fee paid', 'Membership fee paid by ##USER## ', '', '##USER##'),
(5, '2010-03-04 10:17:05', '2010-03-04 10:17:05', 'Amount added to wallet', 1, 0, 1, 'Amount added to wallet', 'Amount added to ##USER## wallet', '', '##USER##'),
(6, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Cash withdrawal request', 0, 0, 0, 'Cash withdrawal request made by you', 'Cash withdrawal request made by ##USER##', '', '##USER##'),
(7, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Cash withdrawal request approved', 0, 0, 0, 'Your cash withdrawal request approved by Administrator', 'You (Administrator) have approved ##USER## cash withdrawal request', '', '##USER##'),
(8, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Cash withdrawal request rejected', 1, 0, 1, 'Amount refunded for rejected cash withdrawal request', 'Amount refunded to ##USER## for rejected cash withdrawal request', '', '##USER##'),
(9, '2010-03-04 10:20:11', '2010-03-04 10:20:14', 'Cash withdrawal request paid', 0, 0, 0, 'Cash withdraw request amount paid to you', 'Cash withdraw request amount paid to ##USER##', '', '##USER##'),
(10, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Cash withdrawal request failed', 1, 0, 1, 'Amount refunded for failed cash withdrawal request', 'Amount refunded to ##USER## for failed cash withdrawal request', '', '##USER##'),
(11, '2010-09-17 11:12:37', '2010-09-17 11:12:42', 'Add fund to wallet', 1, 1, 1, 'Administrator added fund to your wallet', 'Added fund to ##USER## wallet', 'Administrator added fund to your wallet', '##USER##'),
(12, '2010-09-17 11:13:20', '2010-09-17 11:13:23', 'Deduct fund from wallet', 0, 0, 0, 'Administrator deducted fund from your wallet', 'Deducted fund from ##USER## wallet', 'Administrator deducted fund from your wallet', '##USER##'),
(13, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Affiliate cash withdrawal request', 0, 0, 0, 'Affiliate cash withdrawal request made by you', 'Affiliate cash withdrawal request made by ##AFFILIATE_USER##', '', '##AFFILIATE_USER##'),
(14, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Affiliate cash withdrawal request approved', 0, 0, 0, 'Your affiliate cash withdrawal request approved by Administrator', 'You (Administrator) have approved ##AFFILIATE_USER## cash withdrawal request', '', '##AFFILIATE_USER##'),
(15, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Affiliate cash withdrawal request rejected', 1, 0, 1, 'Amount refunded for rejected affiliate cash withdrawal request', 'Amount refunded to ##AFFILIATE_USER## for rejected affiliate cash withdrawal request', '', '##AFFILIATE_USER##'),
(16, '2010-03-04 10:20:11', '2010-03-04 10:20:14', 'Affiliate cash withdrawal request paid', 0, 0, 0, 'Affiliate cash withdraw request amount paid to you', 'Affiliate cash withdraw request amount paid to ##AFFILIATE_USER##', '', '##AFFILIATE_USER##'),
(17, '2010-08-17 14:31:48', '2010-08-17 14:31:48', 'Affiliate cash withdrawal request failed', 1, 0, 1, 'Amount refunded for failed affiliate cash withdrawal request', 'Amount refunded to ##AFFILIATE_USER## for failed affiliate cash withdrawal request', '', '##AFFILIATE_USER##'),
(18, '2013-05-27 12:42:21', '2013-05-27 12:42:24', 'Project Fund Repayment', 0, 1, 0, 'Repayment for your project ##PROJECT## sent.', 'Repayment for project ##PROJECT##', 'Your ##FUNDED## repayment for project ##PROJECT## has been credited.', '##PROJECT##, ##BACKER##, ##FUNDED##');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `name` text collate utf8_unicode_ci NOT NULL,
  `lang_text` text collate utf8_unicode_ci NOT NULL,
  `is_translated` tinyint(1) NOT NULL default '0',
  `is_google_translate` tinyint(1) NOT NULL default '0',
  `is_verified` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'and to analyze the site analytic status', 'and to analyze the site analytic status', 0, 0, 0),
(2, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'and manage prelaunch subscribed email list', 'and manage prelaunch subscribed email list', 0, 0, 0),
(3, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, ', affiliates and their requests etc', ', affiliates and their requests etc', 0, 0, 0),
(4, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Dashboard', 'Dashboard', 0, 0, 0),
(5, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'To see overall site activities and to notify the actions that admin need to taken', 'To see overall site activities and to notify the actions that admin need to taken', 0, 0, 0),
(6, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Snapshot', 'Snapshot', 0, 0, 0),
(7, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Users', 'Users', 0, 0, 0),
(8, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'To manage the site user list, to send bulk email to site users', 'To manage the site user list, to send bulk email to site users', 0, 0, 0),
(9, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Send Email to Users', 'Send Email to Users', 0, 0, 0),
(10, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Activities', 'Activities', 0, 0, 0),
(11, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'To manage the overall site activities like comments, messages, views etc.', 'To manage the overall site activities like comments, messages, views etc.', 0, 0, 0),
(12, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'User Logins', 'User Logins', 0, 0, 0),
(13, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'User Views', 'User Views', 0, 0, 0),
(14, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'User Messages', 'User Messages', 0, 0, 0),
(15, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Settings', 'Settings', 0, 0, 0),
(16, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'To manage overall settings of the site.', 'To manage overall settings of the site.', 0, 0, 0),
(17, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Payments', 'Payments', 0, 0, 0),
(18, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'To manage and monitor all the payment related things such as transactions, payment gateway management', 'To manage and monitor all the payment related things such as transactions, payment gateway management', 0, 0, 0),
(19, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Transactions', 'Transactions', 0, 0, 0),
(20, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Payment Gateways', 'Payment Gateways', 0, 0, 0),
(21, '2013-07-29 18:04:00', '2013-07-29 18:04:00', 42, 'Site Builder', 'Site Builder', 0, 0, 0),
(22, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'To customize and manage the project form and their pricing type, also manage the site themes, contents, menu etc.', 'To customize and manage the project form and their pricing type, also manage the site themes, contents, menu etc.', 0, 0, 0),
(23, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Masters', 'Masters', 0, 0, 0),
(24, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'To manage all the master. Master includes cities, countries, states, email template, project categories and project statuses etc.', 'To manage all the master. Master includes cities, countries, states, email template, project categories and project statuses etc.', 0, 0, 0),
(25, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Regional', 'Regional', 0, 0, 0),
(26, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Banned IPs', 'Banned IPs', 0, 0, 0),
(27, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Cities', 'Cities', 0, 0, 0),
(28, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Countries', 'Countries', 0, 0, 0),
(29, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'States', 'States', 0, 0, 0),
(30, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Email', 'Email', 0, 0, 0),
(31, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Email Templates', 'Email Templates', 0, 0, 0),
(32, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'CMS', 'CMS', 0, 0, 0),
(33, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Content Types', 'Content Types', 0, 0, 0),
(34, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Taxonomies', 'Taxonomies', 0, 0, 0),
(35, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Others', 'Others', 0, 0, 0),
(36, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'IPs', 'IPs', 0, 0, 0),
(37, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Transaction Types', 'Transaction Types', 0, 0, 0),
(38, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Cms Utilities', 'Cms Utilities', 0, 0, 0),
(39, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Sorry. We have disabled this action in demo mode', 'Sorry. We have disabled this action in demo mode', 0, 0, 0),
(40, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Invalid request', 'Invalid request', 0, 0, 0),
(41, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Maintenance Mode', 'Maintenance Mode', 0, 0, 0),
(42, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been inactivated', 'Checked records has been inactivated', 0, 0, 0),
(43, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked users has been inactivated', 'Checked users has been inactivated', 0, 0, 0),
(44, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been activated', 'Checked records has been activated', 0, 0, 0),
(45, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked users has been activated', 'Checked users has been activated', 0, 0, 0),
(46, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been deleted', 'Checked records has been deleted', 0, 0, 0),
(47, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked users has been deleted', 'Checked users has been deleted', 0, 0, 0),
(48, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been suspended', 'Checked records has been suspended', 0, 0, 0),
(49, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been unsuspended', 'Checked records has been unsuspended', 0, 0, 0),
(50, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been flagged', 'Checked records has been flagged', 0, 0, 0),
(51, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been unflagged', 'Checked records has been unflagged', 0, 0, 0),
(52, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been disapproved', 'Checked records has been disapproved', 0, 0, 0),
(53, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been approved', 'Checked records has been approved', 0, 0, 0),
(54, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been subscribed', 'Checked records has been subscribed', 0, 0, 0),
(55, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been unsubscribed', 'Checked records has been unsubscribed', 0, 0, 0),
(56, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been unpublished', 'Checked records has been unpublished', 0, 0, 0),
(57, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been published', 'Checked records has been published', 0, 0, 0),
(58, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been promoted', 'Checked records has been promoted', 0, 0, 0),
(59, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been depromoted', 'Checked records has been depromoted', 0, 0, 0),
(60, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Checked records has been exported', 'Checked records has been exported', 0, 0, 0),
(61, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been activated', 'Selected record has been activated', 0, 0, 0),
(62, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been unflagged', 'Selected record has been unflagged', 0, 0, 0),
(63, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been approved', 'Selected record has been approved', 0, 0, 0),
(64, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been inactivated', 'Selected record has been inactivated', 0, 0, 0),
(65, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been disapproved', 'Selected record has been disapproved', 0, 0, 0),
(66, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been flagged', 'Selected record has been flagged', 0, 0, 0),
(67, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been suspended', 'Selected record has been suspended', 0, 0, 0),
(68, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been unsuspended', 'Selected record has been unsuspended', 0, 0, 0),
(69, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been marked as featured', 'Selected record has been marked as featured', 0, 0, 0),
(70, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Selected record has been marked as not featured', 'Selected record has been marked as not featured', 0, 0, 0),
(71, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Attachments', 'Attachments', 0, 0, 0),
(72, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Add %s', 'Add %s', 0, 0, 0),
(73, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Attachment', 'Attachment', 0, 0, 0),
(74, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Upload failed. Please ensure size does not exceed the server limit.', 'Upload failed. Please ensure size does not exceed the server limit.', 0, 0, 0),
(75, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, '%s has been added', '%s has been added', 0, 0, 0),
(76, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, '%s could not be added. Please, try again.', '%s could not be added. Please, try again.', 0, 0, 0),
(77, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Edit %s', 'Edit %s', 0, 0, 0),
(78, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Invalid %s', 'Invalid %s', 0, 0, 0),
(79, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, '%s has been updated', '%s has been updated', 0, 0, 0),
(80, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, '%s could not be updated. Please, try again.', '%s could not be updated. Please, try again.', 0, 0, 0),
(81, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Invalid id for %s', 'Invalid id for %s', 0, 0, 0),
(82, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, '%s deleted', '%s deleted', 0, 0, 0),
(83, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Banned IP', 'Banned IP', 0, 0, 0),
(84, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Must be a valid URL, starting with http://', 'Must be a valid URL, starting with http://', 0, 0, 0),
(85, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'You cannot add your IP address. Please, try again', 'You cannot add your IP address. Please, try again', 0, 0, 0),
(86, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'You cannot add your own domain. Please, try again', 'You cannot add your own domain. Please, try again', 0, 0, 0),
(87, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Blocks', 'Blocks', 0, 0, 0),
(88, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Block', 'Block', 0, 0, 0),
(89, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Moved up successfully', 'Moved up successfully', 0, 0, 0),
(90, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Could not move up', 'Could not move up', 0, 0, 0),
(91, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Moved down successfully', 'Moved down successfully', 0, 0, 0),
(92, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Could not move down', 'Could not move down', 0, 0, 0),
(93, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'No items selected.', 'No items selected.', 0, 0, 0),
(94, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'An error occurred.', 'An error occurred.', 0, 0, 0),
(95, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Last 7 days', 'Last 7 days', 0, 0, 0),
(96, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Last 4 weeks', 'Last 4 weeks', 0, 0, 0),
(97, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Last 3 months', 'Last 3 months', 0, 0, 0),
(98, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Last 3 years', 'Last 3 years', 0, 0, 0),
(99, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'User Regsiteration', 'User Regsiteration', 0, 0, 0),
(100, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'User Login', 'User Login', 0, 0, 0),
(101, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'User Followers', 'User Followers', 0, 0, 0),
(102, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Projects', 'Projects', 0, 0, 0),
(103, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Funded', 'Project Funded', 0, 0, 0),
(104, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Comments', 'Project Comments', 0, 0, 0),
(105, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Updates', 'Project Updates', 0, 0, 0),
(106, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Update Comments', 'Project Update Comments', 0, 0, 0),
(107, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Ratings', 'Project Ratings', 0, 0, 0),
(108, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Followers', 'Project Followers', 0, 0, 0),
(109, '2013-07-29 18:04:01', '2013-07-29 18:04:01', 42, 'Project Flags', 'Project Flags', 0, 0, 0),
(110, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Transaction', 'Transaction', 0, 0, 0),
(111, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'ProjectFund', 'ProjectFund', 0, 0, 0),
(112, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Approved', 'Approved', 0, 0, 0),
(113, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Disapproved', 'Disapproved', 0, 0, 0),
(114, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' - Search - %s', ' - Search - %s', 0, 0, 0),
(115, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'City', 'City', 0, 0, 0),
(116, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Comments', 'Comments', 0, 0, 0),
(117, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Publish', 'Publish', 0, 0, 0),
(118, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Unpublish', 'Unpublish', 0, 0, 0),
(119, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Comment', 'Comment', 0, 0, 0),
(120, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Node', 'Node', 0, 0, 0),
(121, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Maximum level reached. You cannot reply to that comment.', 'Maximum level reached. You cannot reply to that comment.', 0, 0, 0),
(122, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Your comment has been added successfully.', 'Your comment has been added successfully.', 0, 0, 0),
(123, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Your comment will appear after moderation.', 'Your comment will appear after moderation.', 0, 0, 0),
(124, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Sorry, the comment appears to be spam.', 'Sorry, the comment appears to be spam.', 0, 0, 0),
(125, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Thank you, we received your message and will get back to you as soon as possible.', 'Thank you, we received your message and will get back to you as soon as possible.', 0, 0, 0),
(126, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Please enter valid captcha', 'Please enter valid captcha', 0, 0, 0),
(127, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Contact Us', 'Contact Us', 0, 0, 0),
(128, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Country', 'Country', 0, 0, 0),
(129, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Status updated successfully', 'Status updated successfully', 0, 0, 0),
(130, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Email Template', 'Email Template', 0, 0, 0),
(131, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'IP', 'IP', 0, 0, 0),
(132, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Languages', 'Languages', 0, 0, 0),
(133, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Active', 'Active', 0, 0, 0),
(134, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Inactive', 'Inactive', 0, 0, 0),
(135, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Language', 'Language', 0, 0, 0),
(136, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Language deleted', 'Language deleted', 0, 0, 0),
(137, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s: %s', '%s: %s', 0, 0, 0),
(138, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Links', 'Links', 0, 0, 0),
(139, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Link', 'Link', 0, 0, 0),
(140, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Menus', 'Menus', 0, 0, 0),
(141, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Menu', 'Menu', 0, 0, 0),
(142, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Content', 'Content', 0, 0, 0),
(143, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Page', 'Page', 0, 0, 0),
(144, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Create Content', 'Create Content', 0, 0, 0),
(145, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Content Type', 'Content Type', 0, 0, 0),
(146, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Edit Content - %s', 'Edit Content - %s', 0, 0, 0),
(147, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Paths updated.', 'Paths updated.', 0, 0, 0),
(148, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Term', 'Term', 0, 0, 0),
(149, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Nodes', 'Nodes', 0, 0, 0),
(150, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Search Results - %s', 'Search Results - %s', 0, 0, 0),
(151, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Tools', 'Tools', 0, 0, 0),
(152, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Home', 'Home', 0, 0, 0),
(153, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'How it Works', 'How it Works', 0, 0, 0),
(154, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Payment Gateway', 'Payment Gateway', 0, 0, 0),
(155, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Pay Sign Up Fee', 'Pay Sign Up Fee', 0, 0, 0),
(156, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Your payment is in pending.', 'Your payment is in pending.', 0, 0, 0),
(157, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have paid signup fee successfully', 'You have paid signup fee successfully', 0, 0, 0),
(158, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Your payment could not be completed.', 'Your payment could not be completed.', 0, 0, 0),
(159, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Payment could not be completed.', 'Payment could not be completed.', 0, 0, 0),
(160, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Regions', 'Regions', 0, 0, 0),
(161, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Region', 'Region', 0, 0, 0),
(162, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Transaction fee should be less than minimum withdrawal threshold limit.', 'Transaction fee should be less than minimum withdrawal threshold limit.', 0, 0, 0),
(163, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Sorry. You cannot update the settings in demo mode', 'Sorry. You cannot update the settings in demo mode', 0, 0, 0),
(164, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' Settings', ' Settings', 0, 0, 0),
(165, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s credentials has been updated', '%s credentials has been updated', 0, 0, 0),
(166, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.', 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.', 0, 0, 0),
(167, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User not connected to the provider.', 'User not connected to the provider.', 0, 0, 0),
(168, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Authentication failed. The user has canceled the authentication or the provider refused the connection', 'Authentication failed. The user has canceled the authentication or the provider refused the connection', 0, 0, 0),
(169, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'PNG images crushed successfully', 'PNG images crushed successfully', 0, 0, 0),
(170, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Pre launch', 'Pre launch', 0, 0, 0),
(171, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Launch Mode', 'Launch Mode', 0, 0, 0),
(172, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Private Beta', 'Private Beta', 0, 0, 0),
(173, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'State', 'State', 0, 0, 0),
(174, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Vocabulary', 'Vocabulary', 0, 0, 0),
(175, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Vocabulary - %s', 'Vocabulary - %s', 0, 0, 0),
(176, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s - Add Term', '%s - Add Term', 0, 0, 0),
(177, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Term with same slug already exists in the vocabulary.', 'Term with same slug already exists in the vocabulary.', 0, 0, 0),
(178, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s - Edit Term', '%s - Edit Term', 0, 0, 0),
(179, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s could not be added to the vocabulary. Please, try again.', '%s could not be added to the vocabulary. Please, try again.', 0, 0, 0),
(180, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s could not be deleted. Please, try again.', '%s could not be deleted. Please, try again.', 0, 0, 0),
(181, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Transaction Type', 'Transaction Type', 0, 0, 0),
(182, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'To date should greater than From date. Please, try again.', 'To date should greater than From date. Please, try again.', 0, 0, 0),
(183, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' - today', ' - today', 0, 0, 0),
(184, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' - in this week', ' - in this week', 0, 0, 0),
(185, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' - in this month', ' - in this month', 0, 0, 0),
(186, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'All', 'All', 0, 0, 0),
(187, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Today', 'Today', 0, 0, 0),
(188, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'This Week', 'This Week', 0, 0, 0),
(189, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'This Month', 'This Month', 0, 0, 0),
(190, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Custom', 'Custom', 0, 0, 0),
(191, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Type', 'Type', 0, 0, 0),
(192, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Login through OpenID', 'Login through OpenID', 0, 0, 0),
(193, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Login through Twitter', 'Login through Twitter', 0, 0, 0),
(194, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Login through Facebook', 'Login through Facebook', 0, 0, 0),
(195, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Login through Gmail', 'Login through Gmail', 0, 0, 0),
(196, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Login through Google+', 'Login through Google+', 0, 0, 0),
(197, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Login through Yahoo!', 'Login through Yahoo!', 0, 0, 0),
(198, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Normal Users', 'Normal Users', 0, 0, 0),
(199, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User Openids', 'User Openids', 0, 0, 0),
(200, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'OpenID', 'OpenID', 0, 0, 0),
(201, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Authenticated failed or you may not have profile in your OpenID account', 'Authenticated failed or you may not have profile in your OpenID account', 0, 0, 0),
(202, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Sorry, you registered through OpenID account. So you should have atleast one OpenID account for login', 'Sorry, you registered through OpenID account. So you should have atleast one OpenID account for login', 0, 0, 0),
(203, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Profile', 'Profile', 0, 0, 0),
(204, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User Website', 'User Website', 0, 0, 0),
(205, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User Profile', 'User Profile', 0, 0, 0),
(206, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'The file uploaded is too big, only files less than %s permitted', 'The file uploaded is too big, only files less than %s permitted', 0, 0, 0),
(207, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, '%s Image', '%s Image', 0, 0, 0),
(208, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Profile Image', 'Profile Image', 0, 0, 0),
(209, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User View', 'User View', 0, 0, 0),
(210, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'User', 'User', 0, 0, 0),
(211, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Register', 'Register', 0, 0, 0),
(212, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have submitted invitation code successfully, Welcome to %s', 'You have submitted invitation code successfully, Welcome to %s', 0, 0, 0),
(213, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' You have successfully registered with our site you can login after email verification and administrator approval, but you can able to access all features after paying sign up fee.', ' You have successfully registered with our site you can login after email verification and administrator approval, but you can able to access all features after paying sign up fee.', 0, 0, 0),
(214, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' You have successfully registered with our site. You can login in site after administrator approval, but you can able to access all features after paying sign up fee.', ' You have successfully registered with our site. You can login in site after administrator approval, but you can able to access all features after paying sign up fee.', 0, 0, 0),
(215, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' You have successfully registered with our site you can login after email verification, but you can able to access all features after paying sign up fee.', ' You have successfully registered with our site you can login after email verification, but you can able to access all features after paying sign up fee.', 0, 0, 0),
(216, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, ' You have successfully registered with our site you can login now, but you can able to access all features after paying sign up fee.', ' You have successfully registered with our site you can login now, but you can able to access all features after paying sign up fee.', 0, 0, 0),
(217, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully registered with our site. After administrator approval you can login to site.', 'You have successfully registered with our site. After administrator approval you can login to site.', 0, 0, 0),
(218, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully registered with our site.', 'You have successfully registered with our site.', 0, 0, 0),
(219, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully registered with our site and your activation mail has been sent to your mail inbox.', 'You have successfully registered with our site and your activation mail has been sent to your mail inbox.', 0, 0, 0),
(220, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'verification is completed successfully. But you have to fill the following required fields to complete our registration process.', 'verification is completed successfully. But you have to fill the following required fields to complete our registration process.', 0, 0, 0),
(221, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Your registration process is not completed. Please, try again.', 'Your registration process is not completed. Please, try again.', 0, 0, 0),
(222, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Activate your account', 'Activate your account', 0, 0, 0),
(223, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Invalid activation request, please register again', 'Invalid activation request, please register again', 0, 0, 0),
(224, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Invalid activation request', 'Invalid activation request', 0, 0, 0),
(225, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully activated your account. Now you can login with your %s.', 'You have successfully activated your account. Now you can login with your %s.', 0, 0, 0),
(226, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully activated your account. But you can login after pay the membership fee.', 'You have successfully activated your account. But you can login after pay the membership fee.', 0, 0, 0),
(227, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully activated your account. But you can login after admin activate your account.', 'You have successfully activated your account. But you can login after admin activate your account.', 0, 0, 0),
(228, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully activated your account. Now you can login.', 'You have successfully activated your account. Now you can login.', 0, 0, 0),
(229, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'You have successfully activated and logged in to your account.', 'You have successfully activated and logged in to your account.', 0, 0, 0),
(230, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Activation mail has been resent.', 'Activation mail has been resent.', 0, 0, 0),
(231, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'A Mail for activating your account has been sent.', 'A Mail for activating your account has been sent.', 0, 0, 0),
(232, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Try some time later as mail could not be dispatched due to some error in the server', 'Try some time later as mail could not be dispatched due to some error in the server', 0, 0, 0),
(233, '2013-07-29 18:04:02', '2013-07-29 18:04:02', 42, 'Invalid resend activation request, please register again', 'Invalid resend activation request, please register again', 0, 0, 0),
(234, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Login', 'Login', 0, 0, 0),
(235, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Sorry!!. Cannot register into the site in pre-launch mode', 'Sorry!!. Cannot register into the site in pre-launch mode', 0, 0, 0),
(236, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Sorry!!. Cannot register into the site without invitation', 'Sorry!!. Cannot register into the site without invitation', 0, 0, 0),
(237, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Sorry, login failed.  Your %s or password are incorrect', 'Sorry, login failed.  Your %s or password are incorrect', 0, 0, 0),
(238, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'You are now logged out of the site.', 'You are now logged out of the site.', 0, 0, 0),
(239, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Forgot Password', 'Forgot Password', 0, 0, 0),
(240, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Yahoo!', 'Yahoo!', 0, 0, 0),
(241, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Gmail', 'Gmail', 0, 0, 0),
(242, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'GooglePlus', 'GooglePlus', 0, 0, 0),
(243, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'AngelList', 'AngelList', 0, 0, 0),
(244, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Facebook', 'Facebook', 0, 0, 0),
(245, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Twitter', 'Twitter', 0, 0, 0),
(246, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Reset Password', 'Reset Password', 0, 0, 0),
(247, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Sorry incorrect answer. Please try again', 'Sorry incorrect answer. Please try again', 0, 0, 0),
(248, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Your password has been changed successfully, Please login now', 'Your password has been changed successfully, Please login now', 0, 0, 0),
(249, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Invalid change password request', 'Invalid change password request', 0, 0, 0),
(250, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'User cannot be found in server or admin deactivated your account, please register again', 'User cannot be found in server or admin deactivated your account, please register again', 0, 0, 0),
(251, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Change Password', 'Change Password', 0, 0, 0),
(252, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Your password has been changed successfully. Please login now', 'Your password has been changed successfully. Please login now', 0, 0, 0),
(253, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Password has been changed successfully', 'Password has been changed successfully', 0, 0, 0),
(254, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Your password has been changed successfully', 'Your password has been changed successfully', 0, 0, 0),
(255, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Password could not be changed', 'Password could not be changed', 0, 0, 0),
(256, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Admin', 'Admin', 0, 0, 0),
(257, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through OpenID', 'Registered through OpenID', 0, 0, 0),
(258, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through Gmail', 'Registered through Gmail', 0, 0, 0),
(259, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through GooglePlus', 'Registered through GooglePlus', 0, 0, 0),
(260, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through AngelList', 'Registered through AngelList', 0, 0, 0),
(261, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through Yahoo!', 'Registered through Yahoo!', 0, 0, 0),
(262, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Site', 'Site', 0, 0, 0),
(263, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through Twitter', 'Registered through Twitter', 0, 0, 0),
(264, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through Facebook', 'Registered through Facebook', 0, 0, 0),
(265, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Registered through LinkedIn', 'Registered through LinkedIn', 0, 0, 0),
(266, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Affiliate Users', 'Affiliate Users', 0, 0, 0),
(267, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Pre-launch Users', 'Pre-launch Users', 0, 0, 0),
(268, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Private Beta Users', 'Private Beta Users', 0, 0, 0),
(269, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'User/Admin', 'User/Admin', 0, 0, 0),
(270, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Email to users', 'Email to users', 0, 0, 0),
(271, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Email sent successfully', 'Email sent successfully', 0, 0, 0),
(272, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Email sent successfully. Some emails are not sent', 'Email sent successfully. Some emails are not sent', 0, 0, 0),
(273, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'No email send', 'No email send', 0, 0, 0),
(274, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Mail could not be sent. Please, try again', 'Mail could not be sent. Please, try again', 0, 0, 0),
(275, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Referrer username does not exist.', 'Referrer username does not exist.', 0, 0, 0),
(276, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Diagnostics', 'Diagnostics', 0, 0, 0),
(277, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Yes', 'Yes', 0, 0, 0),
(278, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'No', 'No', 0, 0, 0),
(279, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Count', '%s Count', 0, 0, 0),
(280, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Fund Count', '%s Fund Count', 0, 0, 0),
(281, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Available Balance', 'Available Balance', 0, 0, 0),
(282, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Vocabularies', 'Vocabularies', 0, 0, 0),
(283, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'EventHandler %s not found in plugin %s', 'EventHandler %s not found in plugin %s', 0, 0, 0),
(284, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Fund', 'Fund', 0, 0, 0),
(285, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s %s', '%s %s', 0, 0, 0),
(286, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'New Project Comment', 'New Project Comment', 0, 0, 0),
(287, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Commented on %s', 'Commented on %s', 0, 0, 0),
(288, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'New Project Update', 'New Project Update', 0, 0, 0),
(289, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Update for %s', 'Update for %s', 0, 0, 0),
(290, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'New Project Update Comment', 'New Project Update Comment', 0, 0, 0),
(291, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Commented for update on %s', 'Commented for update on %s', 0, 0, 0),
(292, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'New Project Follower', 'New Project Follower', 0, 0, 0),
(293, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Following %s', 'Following %s', 0, 0, 0),
(294, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'New Project Voting', 'New Project Voting', 0, 0, 0),
(295, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Voted on %s', 'Voted on %s', 0, 0, 0),
(296, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Activity', '%s Activity', 0, 0, 0),
(297, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Canceled', '%s Canceled', 0, 0, 0),
(298, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Canceled %s', '%s Canceled %s', 0, 0, 0),
(299, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Rejected by Admin', '%s Rejected by Admin', 0, 0, 0),
(300, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Anonymous', 'Anonymous', 0, 0, 0),
(301, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Repayment Notification', '%s Repayment Notification', 0, 0, 0),
(302, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Repayment Notification %s', '%s Repayment Notification %s', 0, 0, 0),
(303, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s Late Repayment Notification', '%s Late Repayment Notification', 0, 0, 0),
(304, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Amount repayment', 'Amount repayment', 0, 0, 0),
(305, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Amount repayment done', 'Amount repayment done', 0, 0, 0),
(306, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Required', 'Required', 0, 0, 0),
(307, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Enter number higher than 0', 'Enter number higher than 0', 0, 0, 0),
(308, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'You cannot add your own domain in redirect URL', 'You cannot add your own domain in redirect URL', 0, 0, 0),
(309, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Single IP or hostname', 'Single IP or hostname', 0, 0, 0),
(310, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'IP Range', 'IP Range', 0, 0, 0),
(311, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Referer block', 'Referer block', 0, 0, 0),
(312, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Permanent', 'Permanent', 0, 0, 0),
(313, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Day(s)', 'Day(s)', 0, 0, 0),
(314, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Week(s)', 'Week(s)', 0, 0, 0),
(315, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Delete', 'Delete', 0, 0, 0),
(316, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Already exists', 'Already exists', 0, 0, 0),
(317, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Unapproved', 'Unapproved', 0, 0, 0),
(318, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Disapprove', 'Disapprove', 0, 0, 0),
(319, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Approve', 'Approve', 0, 0, 0),
(320, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be a valid email', 'Must be a valid email', 0, 0, 0),
(321, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Give numeric format', 'Give numeric format', 0, 0, 0),
(322, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Slug already exists', 'Slug already exists', 0, 0, 0),
(323, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Test Mode', 'Test Mode', 0, 0, 0),
(324, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Live Mode', 'Live Mode', 0, 0, 0),
(325, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Auto Approved', 'Auto Approved', 0, 0, 0),
(326, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Non Auto Approved', 'Non Auto Approved', 0, 0, 0),
(327, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be between of 4 to 30 characters', 'Must be between of 4 to 30 characters', 0, 0, 0),
(328, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be at least 4 characters', 'Must be at least 4 characters', 0, 0, 0),
(329, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be a valid character', 'Must be a valid character', 0, 0, 0),
(330, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Username already exists', 'Username already exists', 0, 0, 0),
(331, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be start with an alphabets', 'Must be start with an alphabets', 0, 0, 0),
(332, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Email address already exists', 'Email address already exists', 0, 0, 0),
(333, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be at least 6 characters', 'Must be at least 6 characters', 0, 0, 0),
(334, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Your old password is incorrect, please try again', 'Your old password is incorrect, please try again', 0, 0, 0),
(335, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'New and confirm password field must match, please try again', 'New and confirm password field must match, please try again', 0, 0, 0),
(336, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'You must agree to the terms and conditions', 'You must agree to the terms and conditions', 0, 0, 0),
(337, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Export', 'Export', 0, 0, 0),
(338, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'All Users', 'All Users', 0, 0, 0),
(339, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Inactive Users', 'Inactive Users', 0, 0, 0),
(340, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Active Users', 'Active Users', 0, 0, 0),
(341, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Loggedin Users', 'Loggedin Users', 0, 0, 0),
(342, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Refferred Users', 'Refferred Users', 0, 0, 0),
(343, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Followed Users', 'Followed Users', 0, 0, 0),
(344, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Voted Users', 'Voted Users', 0, 0, 0),
(345, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Commented Users', 'Commented Users', 0, 0, 0),
(346, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Funded Amount Value', 'Funded Amount Value', 0, 0, 0),
(347, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Project Posted Amount Value', 'Project Posted Amount Value', 0, 0, 0),
(348, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Amount should be numeric', 'Amount should be numeric', 0, 0, 0),
(349, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Amount should be greater than minimum amount', 'Amount should be greater than minimum amount', 0, 0, 0),
(350, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Given amount should lies from  %s%s to %s%s', 'Given amount should lies from  %s%s to %s%s', 0, 0, 0),
(351, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'OpenID already exists', 'OpenID already exists', 0, 0, 0),
(352, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Enter valid OpenID', 'Enter valid OpenID', 0, 0, 0),
(353, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be a valid date', 'Must be a valid date', 0, 0, 0),
(354, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Must be numeric and greater than zero', 'Must be numeric and greater than zero', 0, 0, 0),
(355, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Please Select', 'Please Select', 0, 0, 0),
(356, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Male', 'Male', 0, 0, 0),
(357, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Female', 'Female', 0, 0, 0),
(358, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'ACL Actions', 'ACL Actions', 0, 0, 0),
(359, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'ACL Action', 'ACL Action', 0, 0, 0),
(360, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s already exists', '%s already exists', 0, 0, 0),
(361, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s generated successfully', '%s generated successfully', 0, 0, 0),
(362, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, '%s already generated.', '%s already generated.', 0, 0, 0),
(363, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Roles', 'Roles', 0, 0, 0),
(364, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Role', 'Role', 0, 0, 0),
(365, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Permission', 'Permission', 0, 0, 0),
(366, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Permission has been set successfully', 'Permission has been set successfully', 0, 0, 0),
(367, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.', 'Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.', 0, 0, 0),
(368, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'You are not authorized to view this page', 'You are not authorized to view this page', 0, 0, 0),
(369, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Authorization Required', 'Authorization Required', 0, 0, 0),
(370, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Role already exists', 'Role already exists', 0, 0, 0),
(371, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Add', 'Add', 0, 0, 0),
(372, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Update', 'Update', 0, 0, 0),
(373, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Add New Acl Link', 'Add New Acl Link', 0, 0, 0),
(374, '2013-07-29 18:04:03', '2013-07-29 18:04:03', 42, 'Generate Actions', 'Generate Actions', 0, 0, 0),
(375, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'It will generate actions from file structure', 'It will generate actions from file structure', 0, 0, 0),
(376, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Actions', 'Actions', 0, 0, 0),
(377, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Action', 'Action', 0, 0, 0),
(378, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Edit', 'Edit', 0, 0, 0),
(379, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'No %s available', 'No %s available', 0, 0, 0),
(380, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Acl Links', 'Acl Links', 0, 0, 0),
(381, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Delete %s', 'Delete %s', 0, 0, 0),
(382, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Move %s', 'Move %s', 0, 0, 0),
(383, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Cancel', 'Cancel', 0, 0, 0),
(384, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Add Role', 'Add Role', 0, 0, 0),
(385, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Alias', 'Alias', 0, 0, 0),
(386, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'None', 'None', 0, 0, 0),
(387, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Owner', 'Owner', 0, 0, 0),
(388, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Group', 'Group', 0, 0, 0),
(389, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliates', 'Affiliates', 0, 0, 0),
(390, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Requests', 'Requests', 0, 0, 0),
(391, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Common Settings', 'Common Settings', 0, 0, 0),
(392, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Commission Settings', 'Commission Settings', 0, 0, 0),
(393, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Withdraw Fund Requests', 'Withdraw Fund Requests', 0, 0, 0),
(394, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Fund Withdrawal Request', 'Affiliate Fund Withdrawal Request', 0, 0, 0),
(395, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Pending', 'Pending', 0, 0, 0),
(396, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Accepted', 'Accepted', 0, 0, 0),
(397, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Rejected', 'Rejected', 0, 0, 0),
(398, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Paid', 'Paid', 0, 0, 0),
(399, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Cash Withdrawal', 'Affiliate Cash Withdrawal', 0, 0, 0),
(400, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate cash withdrawal request', 'Affiliate cash withdrawal request', 0, 0, 0),
(401, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Withdraw Fund Requests - from Affiliates', 'Withdraw Fund Requests - from Affiliates', 0, 0, 0),
(402, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Under Process', 'Under Process', 0, 0, 0),
(403, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Success', 'Success', 0, 0, 0),
(404, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate cash withdrawal', 'Affiliate cash withdrawal', 0, 0, 0),
(405, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Checked requests have been moved to pending status', 'Checked requests have been moved to pending status', 0, 0, 0),
(406, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Checked requests have been moved to rejected status, Amount sent back tot the users.', 'Checked requests have been moved to rejected status, Amount sent back tot the users.', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(407, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Mark as paid/manual', 'Mark as paid/manual', 0, 0, 0),
(408, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Pay via ', 'Pay via ', 0, 0, 0),
(409, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'API', 'API', 0, 0, 0),
(410, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Withdraw Fund Requests - Approved', 'Withdraw Fund Requests - Approved', 0, 0, 0),
(411, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Manual payment process has been completed.', 'Manual payment process has been completed.', 0, 0, 0),
(412, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Mass payment request is submitted in %s. User will be paid once process completed.', 'Mass payment request is submitted in %s. User will be paid once process completed.', 0, 0, 0),
(413, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Withdrawal has been successfully moved to %s', 'Withdrawal has been successfully moved to %s', 0, 0, 0),
(414, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Request Affiliate', 'Request Affiliate', 0, 0, 0),
(415, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Request', 'Affiliate Request', 0, 0, 0),
(416, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Requests', 'Affiliate Requests', 0, 0, 0),
(417, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Waiting for Approval', 'Waiting for Approval', 0, 0, 0),
(418, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Types', 'Affiliate Types', 0, 0, 0),
(419, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Commission', 'Affiliate Commission', 0, 0, 0),
(420, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate', 'Affiliate', 0, 0, 0),
(421, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Pipeline', 'Pipeline', 0, 0, 0),
(422, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Completed', 'Completed', 0, 0, 0),
(423, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Stats', 'Stats', 0, 0, 0),
(424, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Total', 'Total', 0, 0, 0),
(425, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Affiliate Withdraw Requests', 'Affiliate Withdraw Requests', 0, 0, 0),
(426, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Reject', 'Reject', 0, 0, 0),
(427, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Canceled', 'Canceled', 0, 0, 0),
(428, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Waiting for Approved', 'Waiting for Approved', 0, 0, 0),
(429, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Should be numeric', 'Should be numeric', 0, 0, 0),
(430, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Given amount is greater than your commission amount', 'Given amount is greater than your commission amount', 0, 0, 0),
(431, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Given amount is less than withdraw limit', 'Given amount is less than withdraw limit', 0, 0, 0),
(432, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'one the selected withdrawal has not configured the money transfer account. Please try again', 'one the selected withdrawal has not configured the money transfer account. Please try again', 0, 0, 0),
(433, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'The requested amount will be deducted from your affiliate commission amount and the amount will be blocked until it get approved or rejected by the administrator. Once it''s approved, the requested amount will be sent to your PayPal account. In case of failure, the amount will be refunded to your affiliate commission amount.', 'The requested amount will be deducted from your affiliate commission amount and the amount will be blocked until it get approved or rejected by the administrator. Once it''s approved, the requested amount will be sent to your PayPal account. In case of failure, the amount will be refunded to your affiliate commission amount.', 0, 0, 0),
(434, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Site Transaction Fee', 'Site Transaction Fee', 0, 0, 0),
(435, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Amount', 'Amount', 0, 0, 0),
(436, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Minimum withdraw amount: %s <br/>  Total affiliate Commission amount earned: %s  %s', 'Minimum withdraw amount: %s <br/>  Total affiliate Commission amount earned: %s  %s', 0, 0, 0),
(437, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Request Withdraw', 'Request Withdraw', 0, 0, 0),
(438, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'List', 'List', 0, 0, 0),
(439, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Following withdrawal request has been submitted to payment geteway API, These are waiting for IPN from the payment geteway API. Eiether it will move to Success or Failed', 'Following withdrawal request has been submitted to payment geteway API, These are waiting for IPN from the payment geteway API. Eiether it will move to Success or Failed', 0, 0, 0),
(440, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Withdrawal fund frequest which were unable to process will be returned as failed. The amount requested will be automatically refunded to the user.', 'Withdrawal fund frequest which were unable to process will be returned as failed. The amount requested will be automatically refunded to the user.', 0, 0, 0),
(441, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Transfer Account: ', 'Transfer Account: ', 0, 0, 0),
(442, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Select', 'Select', 0, 0, 0),
(443, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Requested On', 'Requested On', 0, 0, 0),
(444, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Paid on', 'Paid on', 0, 0, 0),
(445, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Status', 'Status', 0, 0, 0),
(446, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Move to success', 'Move to success', 0, 0, 0),
(447, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, 'Move to failed', 'Move to failed', 0, 0, 0),
(448, '2013-07-29 18:04:04', '2013-07-29 18:04:04', 42, '[Image: %s]', '[Image: %s]', 0, 0, 0),
(449, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Affiliate Cash Withdrawals', 'Affiliate Cash Withdrawals', 0, 0, 0),
(450, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Select:', 'Select:', 0, 0, 0),
(451, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '-- More actions --', '-- More actions --', 0, 0, 0),
(452, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Manual Payment', 'Manual Payment', 0, 0, 0),
(453, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Id', 'Id', 0, 0, 0),
(454, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Description', 'Description', 0, 0, 0),
(455, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Pay', 'Pay', 0, 0, 0),
(456, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Gateway', 'Gateway', 0, 0, 0),
(457, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Paid Amount', 'Paid Amount', 0, 0, 0),
(458, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Proceed', 'Proceed', 0, 0, 0),
(459, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Your money transfer account is empty, so click here to update your money transfer account.', 'Your money transfer account is empty, so click here to update your money transfer account.', 0, 0, 0),
(460, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Money Transfer Account', 'Money Transfer Account', 0, 0, 0),
(461, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Requested Amount', 'Requested Amount', 0, 0, 0),
(462, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Your request will be confirmed after admin approval.', 'Your request will be confirmed after admin approval.', 0, 0, 0),
(463, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Sorry, admin declined your request. If you want submit once again please %s', 'Sorry, admin declined your request. If you want submit once again please %s', 0, 0, 0),
(464, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'click here', 'click here', 0, 0, 0),
(465, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'This request will be confirmed after admin approval.', 'This request will be confirmed after admin approval.', 0, 0, 0),
(466, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Site Category', 'Site Category', 0, 0, 0),
(467, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Site Name', 'Site Name', 0, 0, 0),
(468, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Site Description', 'Site Description', 0, 0, 0),
(469, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Site URL', 'Site URL', 0, 0, 0),
(470, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'URL must be started with \\"http://\\"', 'URL must be started with \\"http://\\"', 0, 0, 0),
(471, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Why Do You Want An Affiliate?', 'Why Do You Want An Affiliate?', 0, 0, 0),
(472, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Website Marketing?', 'Website Marketing?', 0, 0, 0),
(473, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Search Engine Marketing?', 'Search Engine Marketing?', 0, 0, 0),
(474, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Email Marketing?', 'Email Marketing?', 0, 0, 0),
(475, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Special Promotional Method', 'Special Promotional Method', 0, 0, 0),
(476, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Special Promotional Description', 'Special Promotional Description', 0, 0, 0),
(477, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Request', 'Request', 0, 0, 0),
(478, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Approved?', 'Approved?', 0, 0, 0),
(479, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Search', 'Search', 0, 0, 0),
(480, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Promotional Method', 'Promotional Method', 0, 0, 0),
(481, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'No Affiliate Requests available', 'No Affiliate Requests available', 0, 0, 0),
(482, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Name', 'Name', 0, 0, 0),
(483, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Commission', 'Commission', 0, 0, 0),
(484, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Commission Type', 'Commission Type', 0, 0, 0),
(485, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Active?', 'Active?', 0, 0, 0),
(486, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Affiliate  Requests', 'Affiliate  Requests', 0, 0, 0),
(487, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Affiliate Cash Withdrawal Requests', 'Affiliate Cash Withdrawal Requests', 0, 0, 0),
(488, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Commission History', 'Commission History', 0, 0, 0),
(489, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Created', 'Created', 0, 0, 0),
(490, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Affiliate User', 'Affiliate User', 0, 0, 0),
(491, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Since', 'Since', 0, 0, 0),
(492, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Click to View Details', 'Click to View Details', 0, 0, 0),
(493, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Share your below unique link for referral purposes', 'Share your below unique link for referral purposes', 0, 0, 0),
(494, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Share your below unique link by appending to end of site URL for referral', 'Share your below unique link by appending to end of site URL for referral', 0, 0, 0),
(495, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'User/%s', 'User/%s', 0, 0, 0),
(496, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'To monitor the summary, price point statistics of site and also to manage all projects posted in the site.', 'To monitor the summary, price point statistics of site and also to manage all projects posted in the site.', 0, 0, 0),
(497, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s %s Categories', '%s %s Categories', 0, 0, 0),
(498, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s %s Statuses', '%s %s Statuses', 0, 0, 0),
(499, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Projects Funded', 'Projects Funded', 0, 0, 0),
(500, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s', '%s', 0, 0, 0),
(501, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Open for Funding', 'Open for Funding', 0, 0, 0),
(502, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Open for Idea', 'Open for Idea', 0, 0, 0),
(503, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Funding Closed', 'Funding Closed', 0, 0, 0),
(504, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Funding Expired', 'Funding Expired', 0, 0, 0),
(505, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s %s Category', '%s %s Category', 0, 0, 0),
(506, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s %s Category deleted', '%s %s Category deleted', 0, 0, 0),
(507, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s %s Status', '%s %s Status', 0, 0, 0),
(508, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Cleared', 'Cleared', 0, 0, 0),
(509, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s - %s', '%s - %s', 0, 0, 0),
(510, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'My Donations', 'My Donations', 0, 0, 0),
(511, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Suspended', 'Suspended', 0, 0, 0),
(512, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'System Flagged', 'System Flagged', 0, 0, 0),
(513, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'User Flagged', 'User Flagged', 0, 0, 0),
(514, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Drafted', 'Drafted', 0, 0, 0),
(515, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Featured', 'Featured', 0, 0, 0),
(516, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Listing Fee Paid', 'Listing Fee Paid', 0, 0, 0),
(517, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Open for %s', 'Open for %s', 0, 0, 0),
(518, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Open for Voting', 'Open for Voting', 0, 0, 0),
(519, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Pending Action to Admin', 'Pending Action to Admin', 0, 0, 0),
(520, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s %s Funds', '%s %s Funds', 0, 0, 0),
(521, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Filter by Category', 'Filter by Category', 0, 0, 0),
(522, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s has been not allowed overfunding', '%s has been not allowed overfunding', 0, 0, 0),
(523, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'The amount should be less than needed amount.', 'The amount should be less than needed amount.', 0, 0, 0),
(524, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'The amount should not be less than ', 'The amount should not be less than ', 0, 0, 0),
(525, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'The amount should be equal to ', 'The amount should be equal to ', 0, 0, 0),
(526, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Idea has been opened for voting', 'Idea has been opened for voting', 0, 0, 0),
(527, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Idea has been already opened for voting', 'Idea has been already opened for voting', 0, 0, 0),
(528, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Project has been opened for %s', 'Project has been opened for %s', 0, 0, 0),
(529, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Project has been already opened for %s', 'Project has been already opened for %s', 0, 0, 0),
(530, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s Expired', '%s Expired', 0, 0, 0),
(531, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Open for voting', 'Open for voting', 0, 0, 0),
(532, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s amount', '%s amount', 0, 0, 0),
(533, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'The amount between %s to %s', 'The amount between %s to %s', 0, 0, 0),
(534, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Must be greater than zero', 'Must be greater than zero', 0, 0, 0),
(535, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s funding end date should be greater than to today', '%s funding end date should be greater than to today', 0, 0, 0),
(536, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Enter valid date', 'Enter valid date', 0, 0, 0),
(537, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s Funded', '%s Funded', 0, 0, 0),
(538, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Donate %s Categories', 'Donate %s Categories', 0, 0, 0),
(539, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Browse Categories', 'Browse Categories', 0, 0, 0),
(540, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Amount to %s', 'Amount to %s', 0, 0, 0),
(541, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Site Commission', 'Site Commission', 0, 0, 0),
(542, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s On', '%s On', 0, 0, 0),
(543, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'No %s Funds available', 'No %s Funds available', 0, 0, 0),
(544, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Expired', 'Expired', 0, 0, 0),
(545, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Closed', 'Closed', 0, 0, 0),
(546, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s Status', '%s Status', 0, 0, 0),
(547, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Successful', 'Successful', 0, 0, 0),
(548, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Failed', 'Failed', 0, 0, 0),
(549, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Private Info', 'Private Info', 0, 0, 0),
(550, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'This is private info. You can able to set Genuine/Not Genuine for Funding Closed %s', 'This is private info. You can able to set Genuine/Not Genuine for Funding Closed %s', 0, 0, 0),
(551, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Genuine', 'Genuine', 0, 0, 0),
(552, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Not Genuine', 'Not Genuine', 0, 0, 0),
(553, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Funding closed, but project owner did fraudulent', 'Funding closed, but project owner did fraudulent', 0, 0, 0),
(554, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Posted By', 'Posted By', 0, 0, 0),
(555, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Site Fee', 'Site Fee', 0, 0, 0),
(556, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s Date', '%s Date', 0, 0, 0),
(557, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Start', 'Start', 0, 0, 0),
(558, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'End', 'End', 0, 0, 0),
(559, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Votings', 'Votings', 0, 0, 0),
(560, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Analytic Count', 'Analytic Count', 0, 0, 0),
(561, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Counts showing here were shared the project on Facebook, Twitter, LinkedIn, Google.', 'Counts showing here were shared the project on Facebook, Twitter, LinkedIn, Google.', 0, 0, 0),
(562, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Needed', 'Needed', 0, 0, 0),
(563, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Collected', 'Collected', 0, 0, 0),
(564, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Listing Fee', 'Listing Fee', 0, 0, 0),
(565, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Total votings', 'Total votings', 0, 0, 0),
(566, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Voting count', 'Voting count', 0, 0, 0),
(567, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Average', 'Average', 0, 0, 0),
(568, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'F', 'F', 0, 0, 0),
(569, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'T', 'T', 0, 0, 0),
(570, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Google', 'Google', 0, 0, 0),
(571, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'G', 'G', 0, 0, 0),
(572, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'LinkedIn', 'LinkedIn', 0, 0, 0),
(573, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'L', 'L', 0, 0, 0),
(574, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Change status to %s', 'Change status to %s', 0, 0, 0),
(575, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'View Details', 'View Details', 0, 0, 0),
(576, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Clear System Flag', 'Clear System Flag', 0, 0, 0),
(577, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'System Flag', 'System Flag', 0, 0, 0),
(578, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Clear User Flag', 'Clear User Flag', 0, 0, 0),
(579, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Unsuspend', 'Unsuspend', 0, 0, 0),
(580, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Suspend', 'Suspend', 0, 0, 0),
(581, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, 'Not Featured', 'Not Featured', 0, 0, 0),
(582, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s Updates', '%s Updates', 0, 0, 0),
(583, '2013-07-29 18:04:05', '2013-07-29 18:04:05', 42, '%s Flags', '%s Flags', 0, 0, 0),
(584, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Normal view count', 'Normal view count', 0, 0, 0),
(585, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Embed view count', 'Embed view count', 0, 0, 0),
(586, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Followers', 'Followers', 0, 0, 0),
(587, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Image', 'Image', 0, 0, 0),
(588, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'n/a', 'n/a', 0, 0, 0),
(589, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Posted On', 'Posted On', 0, 0, 0),
(590, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'No Donation %s available', 'No Donation %s available', 0, 0, 0),
(591, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Flagged', 'Flagged', 0, 0, 0),
(592, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Close', 'Close', 0, 0, 0),
(593, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'This info is private. You can able to set Genuine/Not Genuine for Funding Closed %s', 'This info is private. You can able to set Genuine/Not Genuine for Funding Closed %s', 0, 0, 0),
(594, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Funding closed but project owner did fraudulently', 'Funding closed but project owner did fraudulently', 0, 0, 0),
(595, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Approve?', 'Approve?', 0, 0, 0),
(596, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Donate', 'Donate', 0, 0, 0),
(597, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'My %s', 'My %s', 0, 0, 0),
(598, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Needed Amount', 'Needed Amount', 0, 0, 0),
(599, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Contact %s', 'Contact %s', 0, 0, 0),
(600, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Admin Approved', 'Admin Approved', 0, 0, 0),
(601, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Admin Rejected', 'Admin Rejected', 0, 0, 0),
(602, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Collected Amount', 'Collected Amount', 0, 0, 0),
(603, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Received amount', 'Received amount', 0, 0, 0),
(604, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Updates', 'Updates', 0, 0, 0),
(605, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Goal Reached Date', 'Goal Reached Date', 0, 0, 0),
(606, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Share', 'Share', 0, 0, 0),
(607, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'No %s %s available', 'No %s %s available', 0, 0, 0),
(608, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Overview', 'Overview', 0, 0, 0),
(609, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Add Idea', 'Add Idea', 0, 0, 0),
(610, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Add Project', 'Add Project', 0, 0, 0),
(611, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Pending (%s)', 'Pending (%s)', 0, 0, 0),
(612, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Expired (%s)', 'Expired (%s)', 0, 0, 0),
(613, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Pending Action to Admin (%s)', 'Pending Action to Admin (%s)', 0, 0, 0),
(614, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Closed (%s)', 'Closed (%s)', 0, 0, 0),
(615, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Listing Fee Paid (%s)', 'Listing Fee Paid (%s)', 0, 0, 0),
(616, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'If listing fees added in settings, all %s can be added only when the %s pays the fees', 'If listing fees added in settings, all %s can be added only when the %s pays the fees', 0, 0, 0),
(617, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'If idea enabled, all projects considered as ideas. If not, considered as %s.', 'If idea enabled, all projects considered as ideas. If not, considered as %s.', 0, 0, 0),
(618, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'All %s will be approved by Admin.', 'All %s will be approved by Admin.', 0, 0, 0),
(619, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'All %s will be approved automatically.', 'All %s will be approved automatically.', 0, 0, 0),
(620, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'If idea is enabled, initially all the %s will be considered as an idea. Based on votes, it will be moved as a %s by administrator.', 'If idea is enabled, initially all the %s will be considered as an idea. Based on votes, it will be moved as a %s by administrator.', 0, 0, 0),
(621, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'If no %s available and the %s reached end date then %s automatically moved to expire', 'If no %s available and the %s reached end date then %s automatically moved to expire', 0, 0, 0),
(622, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s accepting %s from %s.', '%s accepting %s from %s.', 0, 0, 0),
(623, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'All fundings captured and needed amount moves to %s PayPal account and commission amount moves to site admin PayPal account.', 'All fundings captured and needed amount moves to %s PayPal account and commission amount moves to site admin PayPal account.', 0, 0, 0),
(624, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Flagged %s %s', 'Flagged %s %s', 0, 0, 0),
(625, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s - Pending For Approval', '%s - Pending For Approval', 0, 0, 0),
(626, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '[Image: Donate]', '[Image: Donate]', 0, 0, 0),
(627, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'In %s %s, amount is captured by end date and may offer %s.', 'In %s %s, amount is captured by end date and may offer %s.', 0, 0, 0),
(628, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'In %s %s, amount is immediately paid to the %s owner and %s gets no %s.', 'In %s %s, amount is immediately paid to the %s owner and %s gets no %s.', 0, 0, 0),
(629, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Browse All', 'Browse All', 0, 0, 0),
(630, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'A', 'A', 0, 0, 0),
(631, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s in ', '%s in ', 0, 0, 0),
(632, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, ' by ', ' by ', 0, 0, 0),
(633, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s Amount', '%s Amount', 0, 0, 0),
(634, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Personalize your Donation', 'Personalize your Donation', 0, 0, 0),
(635, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Select Payment Type', 'Select Payment Type', 0, 0, 0),
(636, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Browse', 'Browse', 0, 0, 0),
(637, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'OR', 'OR', 0, 0, 0),
(638, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Start %s', 'Start %s', 0, 0, 0),
(639, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, ', payment gateway fee approx 2.90% charged runtime by PayPal', ', payment gateway fee approx 2.90% charged runtime by PayPal', 0, 0, 0),
(640, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, ', payment gateway fee approx 2.90%(shared with admin) charged runtime by PayPal', ', payment gateway fee approx 2.90%(shared with admin) charged runtime by PayPal', 0, 0, 0),
(641, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Adds an %s', 'Adds an %s', 0, 0, 0),
(642, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Admin moves the %s for %s', 'Admin moves the %s for %s', 0, 0, 0),
(643, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Expired (No %s for %s) ', 'Expired (No %s for %s) ', 0, 0, 0),
(644, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Adds a %s', 'Adds a %s', 0, 0, 0),
(645, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s funds a %s', '%s funds a %s', 0, 0, 0),
(646, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Receiver %s, Marketplace Receiver site', 'Receiver %s, Marketplace Receiver site', 0, 0, 0),
(647, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Immediate Payment', 'Immediate Payment', 0, 0, 0),
(648, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'transfer amount to %s after deduct the site commission', 'transfer amount to %s after deduct the site commission', 0, 0, 0),
(649, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Amount Received = Fund Amount - Site Fee', 'Amount Received = Fund Amount - Site Fee', 0, 0, 0),
(650, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, ' - Payment Gateway Fee', ' - Payment Gateway Fee', 0, 0, 0),
(651, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Site fee ', 'Site fee ', 0, 0, 0),
(652, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s Closed', '%s Closed', 0, 0, 0),
(653, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Votes an %s', 'Votes an %s', 0, 0, 0),
(654, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Idea', 'Idea', 0, 0, 0),
(655, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Funds a %s', 'Funds a %s', 0, 0, 0),
(656, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Makes the payment through PayPal adaptive payment', 'Makes the payment through PayPal adaptive payment', 0, 0, 0),
(657, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'No site fee collected.', 'No site fee collected.', 0, 0, 0),
(658, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'transfer amount to %s', 'transfer amount to %s', 0, 0, 0),
(659, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Following', 'Following', 0, 0, 0),
(660, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Unfollow', 'Unfollow', 0, 0, 0),
(661, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Follow', 'Follow', 0, 0, 0),
(662, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '[Image: Loader]', '[Image: Loader]', 0, 0, 0),
(663, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Voting Stage', 'Voting Stage', 0, 0, 0),
(664, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Admin Suspended', 'Admin Suspended', 0, 0, 0),
(665, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Disabled. Reason: You can''t %s your own %s.', 'Disabled. Reason: You can''t %s your own %s.', 0, 0, 0),
(666, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Disabled. Reason: %s.', 'Disabled. Reason: %s.', 0, 0, 0),
(667, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, '%s of', '%s of', 0, 0, 0),
(668, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'goal', 'goal', 0, 0, 0),
(669, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Days to go', 'Days to go', 0, 0, 0),
(670, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Hours to go', 'Hours to go', 0, 0, 0),
(671, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Goal Reached, but it allows for over funding and this %s will be closed on', 'Goal Reached, but it allows for over funding and this %s will be closed on', 0, 0, 0),
(672, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'This %s will receive all of the %s by %s', 'This %s will receive all of the %s by %s', 0, 0, 0),
(673, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'This %s successfully raised its funding goal %s', 'This %s successfully raised its funding goal %s', 0, 0, 0),
(674, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Votes', 'Votes', 0, 0, 0),
(675, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Voters', 'Voters', 0, 0, 0),
(676, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Average votes', 'Average votes', 0, 0, 0),
(677, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'This idea will only be listed for funding only if at least enough voters support it. Admin will move top votes ideas to projects based on number of votes.', 'This idea will only be listed for funding only if at least enough voters support it. Admin will move top votes ideas to projects based on number of votes.', 0, 0, 0),
(678, '2013-07-29 18:04:06', '2013-07-29 18:04:06', 42, 'Draft', 'Draft', 0, 0, 0),
(679, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s by', '%s by', 0, 0, 0),
(680, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, ' Projects posted', ' Projects posted', 0, 0, 0),
(681, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, ' Projects funded', ' Projects funded', 0, 0, 0),
(682, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Following ', 'Following ', 0, 0, 0),
(683, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, ' project(s)', ' project(s)', 0, 0, 0),
(684, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Send message', 'Send message', 0, 0, 0),
(685, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'funded', 'funded', 0, 0, 0),
(686, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'ended on', 'ended on', 0, 0, 0),
(687, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'expired', 'expired', 0, 0, 0),
(688, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'days to go', 'days to go', 0, 0, 0),
(689, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'hours to go', 'hours to go', 0, 0, 0),
(690, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'People immediately pay to you. Can''t offer rewards.', 'People immediately pay to you. Can''t offer rewards.', 0, 0, 0),
(691, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'To monitor the summary, price point statistics of site and also to manage all the projects posted in the site.', 'To monitor the summary, price point statistics of site and also to manage all the projects posted in the site.', 0, 0, 0),
(692, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Lost', 'Lost', 0, 0, 0),
(693, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Flexible', 'Flexible', 0, 0, 0),
(694, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Fixed', 'Fixed', 0, 0, 0),
(695, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Open for Investing', 'Open for Investing', 0, 0, 0),
(696, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Please select atleast one startup to import and try again.', 'Please select atleast one startup to import and try again.', 0, 0, 0),
(697, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Project Closed', 'Project Closed', 0, 0, 0),
(698, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Project Expired', 'Project Expired', 0, 0, 0),
(699, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s Cancelled', '%s Cancelled', 0, 0, 0),
(700, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Invested', 'Invested', 0, 0, 0),
(701, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Refunded', 'Refunded', 0, 0, 0),
(702, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'You can''t invest, because given amount should be multiples of %s', 'You can''t invest, because given amount should be multiples of %s', 0, 0, 0),
(703, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'You can''t invest, because you should invest minimum %s share.', 'You can''t invest, because you should invest minimum %s share.', 0, 0, 0),
(704, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'You can''t invest, because you can invest maximum %s share only', 'You can''t invest, because you can invest maximum %s share only', 0, 0, 0),
(705, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'You can''t invest, because you can invest maximum %s share only. You already purchased %s share.', 'You can''t invest, because you can invest maximum %s share only. You already purchased %s share.', 0, 0, 0),
(706, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'You can''t invest, because you can invest %s share only.', 'You can''t invest, because you can invest %s share only.', 0, 0, 0),
(707, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s has been opened for %s', '%s has been opened for %s', 0, 0, 0),
(708, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s has been already opened for %s', '%s has been already opened for %s', 0, 0, 0),
(709, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Funding amount', 'Funding amount', 0, 0, 0),
(710, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '[Image: Equity]', '[Image: Equity]', 0, 0, 0),
(711, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'In %s %s, %s buy shares and %s amount is captured by end date/goal reached of the %s.', 'In %s %s, %s buy shares and %s amount is captured by end date/goal reached of the %s.', 0, 0, 0),
(712, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'We will capture the %s amount. If the %s didn''t reached the goal, we will refund this amount to your wallet.', 'We will capture the %s amount. If the %s didn''t reached the goal, we will refund this amount to your wallet.', 0, 0, 0),
(713, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Amount per share: %s%s, You can purchase %s more shares for this %s.', 'Amount per share: %s%s, You can purchase %s more shares for this %s.', 0, 0, 0),
(714, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Amount should be multiples of %s. For example: %s, %s etc.,', 'Amount should be multiples of %s. For example: %s, %s etc.,', 0, 0, 0),
(715, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Personalize your  %s', 'Personalize your  %s', 0, 0, 0),
(716, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'JOBS Act Implications', 'JOBS Act Implications', 0, 0, 0),
(717, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '1. Individuals with a net worth (excluding primary residence) or annual income less than $100,000 can equity up to $2,000 or 5% of their annual income or net worth (whichever is greater).', '1. Individuals with a net worth (excluding primary residence) or annual income less than $100,000 can equity up to $2,000 or 5% of their annual income or net worth (whichever is greater).', 0, 0, 0),
(718, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '2. Individuals with an annual income or net worth of more than $100,000 can equity up to 10% of their annual income or net worth, up to a maximum of $100,000. ', '2. Individuals with an annual income or net worth of more than $100,000 can equity up to 10% of their annual income or net worth, up to a maximum of $100,000. ', 0, 0, 0),
(719, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Equity', 'Equity', 0, 0, 0),
(720, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Have option to cancel %s in %s Posted', 'Have option to cancel %s in %s Posted', 0, 0, 0),
(721, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Expired (If %s is fixed funding and %s didn''t reach goal.) ', 'Expired (If %s is fixed funding and %s didn''t reach goal.) ', 0, 0, 0),
(722, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Have option to cancel %s in %s posted', 'Have option to cancel %s in %s posted', 0, 0, 0),
(723, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'After %s reaches the end date', 'After %s reaches the end date', 0, 0, 0),
(724, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'site transfer amount to %s after deduct the site commission', 'site transfer amount to %s after deduct the site commission', 0, 0, 0),
(725, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Expired %s', 'Expired %s', 0, 0, 0),
(726, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Makes the payment through Wallet payment', 'Makes the payment through Wallet payment', 0, 0, 0),
(727, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'site transfer amount to %s', 'site transfer amount to %s', 0, 0, 0),
(728, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '[Image:Loader]', '[Image:Loader]', 0, 0, 0),
(729, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'GoalReached, but it allows for over funding and this %s will be closed on', 'GoalReached, but it allows for over funding and this %s will be closed on', 0, 0, 0),
(730, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'This %s received all of its funded amount by %s', 'This %s received all of its funded amount by %s', 0, 0, 0),
(731, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'This %s will only be funded if at least %s is investd by %s', 'This %s will only be funded if at least %s is investd by %s', 0, 0, 0),
(732, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'This %s received all of its funded amount %s', 'This %s received all of its funded amount %s', 0, 0, 0),
(733, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'SEIS', 'SEIS', 0, 0, 0),
(734, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'EIS', 'EIS', 0, 0, 0),
(735, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Amount for per share is %s%s', 'Amount for per share is %s%s', 0, 0, 0),
(736, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Flexible Funding', 'Flexible Funding', 0, 0, 0),
(737, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s fund will be captured even if it does not reached the needed amount', '%s fund will be captured even if it does not reached the needed amount', 0, 0, 0),
(738, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, ' Send message', ' Send message', 0, 0, 0),
(739, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'send message', 'send message', 0, 0, 0),
(740, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'People initially equity. Amount is captured by end date/goal reached. Entrepreneur offer shares.', 'People initially equity. Amount is captured by end date/goal reached. Entrepreneur offer shares.', 0, 0, 0),
(741, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Cancel %s', 'Cancel %s', 0, 0, 0),
(742, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Fixed %s', 'Fixed %s', 0, 0, 0),
(743, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Fixed %s:  %s fund will be captured only if it reached the needed amount.When %s has been reached the ending date, then funds can start to be released.', 'Fixed %s:  %s fund will be captured only if it reached the needed amount.When %s has been reached the ending date, then funds can start to be released.', 0, 0, 0),
(744, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Flexible %s:  %s fund will be captured even if it does not reached the needed amount.', 'Flexible %s:  %s fund will be captured even if it does not reached the needed amount.', 0, 0, 0),
(745, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Funding GoalReached Date', 'Funding GoalReached Date', 0, 0, 0),
(746, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Funding closed, but project owner did fraudulently', 'Funding closed, but project owner did fraudulently', 0, 0, 0),
(747, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Completed Step', 'Completed Step', 0, 0, 0),
(748, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Step ', 'Step ', 0, 0, 0),
(749, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Start Project', 'Start Project', 0, 0, 0),
(750, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Please choose with care, you can''t import startup multiple times.', 'Please choose with care, you can''t import startup multiple times.', 0, 0, 0),
(751, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Imported', 'Imported', 0, 0, 0),
(752, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Back', 'Back', 0, 0, 0),
(753, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Import', 'Import', 0, 0, 0),
(754, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'No startups available', 'No startups available', 0, 0, 0),
(755, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Purchased Share', 'Purchased Share', 0, 0, 0),
(756, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Funded', 'Funded', 0, 0, 0),
(757, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Funding Closed and Paid to %s', 'Funding Closed and Paid to %s', 0, 0, 0),
(758, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Refunded ', 'Refunded ', 0, 0, 0),
(759, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Voided ', 'Voided ', 0, 0, 0),
(760, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Shares', 'Shares', 0, 0, 0),
(761, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'GoalReached Date', 'GoalReached Date', 0, 0, 0),
(762, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Manage %s', 'Manage %s', 0, 0, 0),
(763, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Open for investing', 'Open for investing', 0, 0, 0),
(764, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'If listing fee added in settings, all %s can be added only when %s pay the fee.', 'If listing fee added in settings, all %s can be added only when %s pay the fee.', 0, 0, 0),
(765, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Amount authorization will be canceled', 'Amount authorization will be canceled', 0, 0, 0),
(766, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s accepting equities from %s.', '%s accepting equities from %s.', 0, 0, 0),
(767, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'If needed amount not reached within the %s end date, %s moves to expire.', 'If needed amount not reached within the %s end date, %s moves to expire.', 0, 0, 0),
(768, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'All fundings moves to %s wallet and commission amount moves to site admin account.', 'All fundings moves to %s wallet and commission amount moves to site admin account.', 0, 0, 0),
(769, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugins', 'Plugins', 0, 0, 0),
(770, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'To manage all plugins and their settings.', 'To manage all plugins and their settings.', 0, 0, 0),
(771, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, '%s modules also available for this product, you can also purchase it in our customers area.', '%s modules also available for this product, you can also purchase it in our customers area.', 0, 0, 0),
(772, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Modules you have purchased in our customer area is listed here.', 'Modules you have purchased in our customer area is listed here.', 0, 0, 0),
(773, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugins that are specific to pledge module is listed here.', 'Plugins that are specific to pledge module is listed here.', 0, 0, 0),
(774, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugins that are specific to equity module is listed here.', 'Plugins that are specific to equity module is listed here.', 0, 0, 0),
(775, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugins used in all modules listed here.', 'Plugins used in all modules listed here.', 0, 0, 0),
(776, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Payment gateway used in all module listed here.', 'Payment gateway used in all module listed here.', 0, 0, 0),
(777, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugins for additional functionality used in all modules listed here.', 'Plugins for additional functionality used in all modules listed here.', 0, 0, 0),
(778, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Growth hacking is a set of tactics and best practices for dealing with problem of user growth.', 'Growth hacking is a set of tactics and best practices for dealing with problem of user growth.', 0, 0, 0),
(779, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'By default this site has responsive layout, although this site having separate mobile app features for devices like the iPhone, Android and touch mobile.', 'By default this site has responsive layout, although this site having separate mobile app features for devices like the iPhone, Android and touch mobile.', 0, 0, 0),
(780, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Upload Plugin', 'Upload Plugin', 0, 0, 0),
(781, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'plugin', 'plugin', 0, 0, 0),
(782, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'You cannot delete a plugin that is currently active.', 'You cannot delete a plugin that is currently active.', 0, 0, 0),
(783, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugin', 'Plugin', 0, 0, 0),
(784, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugin deactivated successfully.', 'Plugin deactivated successfully.', 0, 0, 0),
(785, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugin activated successfully.', 'Plugin activated successfully.', 0, 0, 0),
(786, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Plugin \\"%s\\" depends on \\"%s\\" plugin.', 'Plugin \\"%s\\" depends on \\"%s\\" plugin.', 0, 0, 0),
(787, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Themes', 'Themes', 0, 0, 0),
(788, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Theme activated.', 'Theme activated.', 0, 0, 0),
(789, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Theme activation failed.', 'Theme activation failed.', 0, 0, 0),
(790, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Upload Theme', 'Upload Theme', 0, 0, 0),
(791, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Theme uploaded successfully.', 'Theme uploaded successfully.', 0, 0, 0),
(792, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Theme Editor', 'Theme Editor', 0, 0, 0),
(793, '2013-07-29 18:04:07', '2013-07-29 18:04:07', 42, 'Invalid theme', 'Invalid theme', 0, 0, 0),
(794, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Default theme cannot be deleted.', 'Default theme cannot be deleted.', 0, 0, 0),
(795, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'You cannot delete a theme that is currently active.', 'You cannot delete a theme that is currently active.', 0, 0, 0),
(796, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Theme deleted successfully.', 'Theme deleted successfully.', 0, 0, 0),
(797, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Plugin \\"%s\\" is already active.', 'Plugin \\"%s\\" is already active.', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(798, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Plugin \\"%s\\" could not be activated. Please, try again.', 'Plugin \\"%s\\" could not be activated. Please, try again.', 0, 0, 0),
(799, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Plugin \\"%s\\" is not active.', 'Plugin \\"%s\\" is not active.', 0, 0, 0),
(800, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Plugin could not be deactivated. Please, try again.', 'Plugin could not be deactivated. Please, try again.', 0, 0, 0),
(801, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid plugin path', 'Invalid plugin path', 0, 0, 0),
(802, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid plugin', 'Invalid plugin', 0, 0, 0),
(803, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid zip archive', 'Invalid zip archive', 0, 0, 0),
(804, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid plugin file path', 'Invalid plugin file path', 0, 0, 0),
(805, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Plugin already exists', 'Plugin already exists', 0, 0, 0),
(806, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Failed to extract plugin', 'Failed to extract plugin', 0, 0, 0),
(807, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid theme path', 'Invalid theme path', 0, 0, 0),
(808, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid YML file', 'Invalid YML file', 0, 0, 0),
(809, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Invalid theme file path', 'Invalid theme file path', 0, 0, 0),
(810, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Theme already exists', 'Theme already exists', 0, 0, 0),
(811, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Failed to extract theme', 'Failed to extract theme', 0, 0, 0),
(812, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Enabled', 'Enabled', 0, 0, 0),
(813, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Disabled', 'Disabled', 0, 0, 0),
(814, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Disable', 'Disable', 0, 0, 0),
(815, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Enable', 'Enable', 0, 0, 0),
(816, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Upload', 'Upload', 0, 0, 0),
(817, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, ' Upload Plugin', ' Upload Plugin', 0, 0, 0),
(818, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Add Theme', 'Add Theme', 0, 0, 0),
(819, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Current Theme', 'Current Theme', 0, 0, 0),
(820, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'by', 'by', 0, 0, 0),
(821, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Regions supported: ', 'Regions supported: ', 0, 0, 0),
(822, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Available Themes', 'Available Themes', 0, 0, 0),
(823, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Activate', 'Activate', 0, 0, 0),
(824, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Bucket name and configuration is ok', 'Bucket name and configuration is ok', 0, 0, 0),
(825, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Problem with the configuration', 'Problem with the configuration', 0, 0, 0),
(826, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Static content successfully copied.', 'Static content successfully copied.', 0, 0, 0),
(827, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'To analyze the site analytic status detail and also it shows the graphical representation of overall bounce rate and traffic', 'To analyze the site analytic status detail and also it shows the graphical representation of overall bounce rate and traffic', 0, 0, 0),
(828, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Analytics', 'Analytics', 0, 0, 0),
(829, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'To analyze overall user registration rate, their demographics, user login rate and also the overall project posting/funding rate.', 'To analyze overall user registration rate, their demographics, user login rate and also the overall project posting/funding rate.', 0, 0, 0),
(830, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Insights', 'Insights', 0, 0, 0),
(831, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Demographics', 'Demographics', 0, 0, 0),
(832, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Educations', 'Educations', 0, 0, 0),
(833, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Employments', 'Employments', 0, 0, 0),
(834, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Income Ranges', 'Income Ranges', 0, 0, 0),
(835, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Relationships', 'Relationships', 0, 0, 0),
(836, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Education', 'Education', 0, 0, 0),
(837, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Employment', 'Employment', 0, 0, 0),
(838, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Income Range', 'Income Range', 0, 0, 0),
(839, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Revenue From Sign Up', 'Revenue From Sign Up', 0, 0, 0),
(840, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Revenue From %s', 'Revenue From %s', 0, 0, 0),
(841, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Funding', 'Funding', 0, 0, 0),
(842, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Revenue From Commission', 'Revenue From Commission', 0, 0, 0),
(843, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Deposited', 'Deposited', 0, 0, 0),
(844, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Withdrawn', 'Withdrawn', 0, 0, 0),
(845, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Withdraw Requests', 'Withdraw Requests', 0, 0, 0),
(846, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Backed', 'Backed', 0, 0, 0),
(847, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Normal', 'Normal', 0, 0, 0),
(848, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Linkedin', 'Linkedin', 0, 0, 0),
(849, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Not Mentioned', 'Not Mentioned', 0, 0, 0),
(850, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Yrs', 'Yrs', 0, 0, 0),
(851, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Google+', 'Google+', 0, 0, 0),
(852, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Amount Received', 'Amount Received', 0, 0, 0),
(853, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Deposited Amount', 'Deposited Amount', 0, 0, 0),
(854, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, '%s Stats', '%s Stats', 0, 0, 0),
(855, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Funds', 'Funds', 0, 0, 0),
(856, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, '%s Snapshot', '%s Snapshot', 0, 0, 0),
(857, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Relationship', 'Relationship', 0, 0, 0),
(858, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Employment Status', 'Employment Status', 0, 0, 0),
(859, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Income range (%s)', 'Income range (%s)', 0, 0, 0),
(860, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Relationship status', 'Relationship status', 0, 0, 0),
(861, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Add Education', 'Add Education', 0, 0, 0),
(862, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Edit Education', 'Edit Education', 0, 0, 0),
(863, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Income', 'Income', 0, 0, 0),
(864, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Gender', 'Gender', 0, 0, 0),
(865, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Age', 'Age', 0, 0, 0),
(866, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Add Employment', 'Add Employment', 0, 0, 0),
(867, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Edit Employment', 'Edit Employment', 0, 0, 0),
(868, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Add Income Range', 'Add Income Range', 0, 0, 0),
(869, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Edit Income Range', 'Edit Income Range', 0, 0, 0),
(870, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Price Point', 'Price Point', 0, 0, 0),
(871, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Revenue', 'Revenue', 0, 0, 0),
(872, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, '# %s Funds', '# %s Funds', 0, 0, 0),
(873, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, '%s Funds', '%s Funds', 0, 0, 0),
(874, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Total Revenue by Price Point', 'Total Revenue by Price Point', 0, 0, 0),
(875, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Total Revenue', 'Total Revenue', 0, 0, 0),
(876, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Total %s Funds by Price Point', 'Total %s Funds by Price Point', 0, 0, 0),
(877, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Total Funds', 'Total Funds', 0, 0, 0),
(878, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Avg Revenue per %s by Price Point', 'Avg Revenue per %s by Price Point', 0, 0, 0),
(879, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Avg Revenue per %s', 'Avg Revenue per %s', 0, 0, 0),
(880, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Avg Projects Funded per %s by Price Point', 'Avg Projects Funded per %s by Price Point', 0, 0, 0),
(881, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Avg %s Fund per %s', 'Avg %s Fund per %s', 0, 0, 0),
(882, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Min', 'Min', 0, 0, 0),
(883, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Max', 'Max', 0, 0, 0),
(884, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Offered', 'Offered', 0, 0, 0),
(885, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'User registration rate, Site revenue, Projects posted rate, Projects Fund rate in selected period. By default it shows only last 7 days details. To see the last 4 weeks, last 3 months, last 3 years details please select your desired period in the above setting icon. Also display the complete details of site revenue / project funded. By default it shows only last 7 days details. To see the last 7 days, last 4 weeks, last 3 months, last 3 years details please select the desired period in the above setting icon.', 'User registration rate, Site revenue, Projects posted rate, Projects Fund rate in selected period. By default it shows only last 7 days details. To see the last 4 weeks, last 3 months, last 3 years details please select your desired period in the above setting icon. Also display the complete details of site revenue / project funded. By default it shows only last 7 days details. To see the last 7 days, last 4 weeks, last 3 months, last 3 years details please select the desired period in the above setting icon.', 0, 0, 0),
(886, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Value', 'Value', 0, 0, 0),
(887, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'User Registration', 'User Registration', 0, 0, 0),
(888, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Registration', 'Registration', 0, 0, 0),
(889, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Summary Statistics', 'Summary Statistics', 0, 0, 0),
(890, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Price Point Statistics', 'Price Point Statistics', 0, 0, 0),
(891, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Period', 'Period', 0, 0, 0),
(892, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Project Updates Comments', 'Project Updates Comments', 0, 0, 0),
(893, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Project Rating', 'Project Rating', 0, 0, 0),
(894, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Funded Users', 'Funded Users', 0, 0, 0),
(895, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Select Range', 'Select Range', 0, 0, 0),
(896, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Total Orders', 'Total Orders', 0, 0, 0),
(897, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Orders', 'Orders', 0, 0, 0),
(898, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Fund Count', 'Fund Count', 0, 0, 0),
(899, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, '%s Fund', '%s Fund', 0, 0, 0),
(900, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Launched %s', 'Launched %s', 0, 0, 0),
(901, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Unsuccessful', 'Unsuccessful', 0, 0, 0),
(902, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Live', 'Live', 0, 0, 0),
(903, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Live %s', 'Live %s', 0, 0, 0),
(904, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Successfully Funded %s', 'Successfully Funded %s', 0, 0, 0),
(905, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Unsuccessfully Funded %s', 'Unsuccessfully Funded %s', 0, 0, 0),
(906, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Add Relationship', 'Add Relationship', 0, 0, 0),
(907, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Edit Relationship', 'Edit Relationship', 0, 0, 0),
(908, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: Welcome', 'Installation: Welcome', 0, 0, 0),
(909, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: Server Requirements', 'Installation: Server Requirements', 0, 0, 0),
(910, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: File Permissions', 'Installation: File Permissions', 0, 0, 0),
(911, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: License Configuration', 'Installation: License Configuration', 0, 0, 0),
(912, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Could not write config.php file.', 'Could not write config.php file.', 0, 0, 0),
(913, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Please enter your license key', 'Please enter your license key', 0, 0, 0),
(914, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: Database', 'Installation: Database', 0, 0, 0),
(915, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Could not connect to database: %s', 'Could not connect to database: %s', 0, 0, 0),
(916, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Could not connect to database.', 'Could not connect to database.', 0, 0, 0),
(917, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'MySQL Version Should be 5.x', 'MySQL Version Should be 5.x', 0, 0, 0),
(918, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Could not write database.php file.', 'Could not write database.php file.', 0, 0, 0),
(919, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: Build database', 'Installation: Build database', 0, 0, 0),
(920, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Could not create table: %s', 'Could not create table: %s', 0, 0, 0),
(921, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation: Settings Configuration', 'Installation: Settings Configuration', 0, 0, 0),
(922, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Installation is Complete!', 'Installation is Complete!', 0, 0, 0),
(923, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'System', 'System', 0, 0, 0),
(924, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'This name will be used in all pages, emails.', 'This name will be used in all pages, emails.', 0, 0, 0),
(925, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'From Email Address', 'From Email Address', 0, 0, 0),
(926, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'This is the email address that will appear in the \\"From\\" field of all emails sent from the site.', 'This is the email address that will appear in the \\"From\\" field of all emails sent from the site.', 0, 0, 0),
(927, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Contact Email Address', 'Contact Email Address', 0, 0, 0),
(928, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'This is the email address to which you will receive the mail from contact form.', 'This is the email address to which you will receive the mail from contact form.', 0, 0, 0),
(929, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Application ID', 'Application ID', 0, 0, 0),
(930, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'This is the application ID used in login and post.', 'This is the application ID used in login and post.', 0, 0, 0),
(931, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Secret Key', 'Secret Key', 0, 0, 0),
(932, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'This is the Facebook secret key used for authentication and other Facebook related plugins support', 'This is the Facebook secret key used for authentication and other Facebook related plugins support', 0, 0, 0),
(933, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Account URL', 'Account URL', 0, 0, 0),
(934, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'This is the site Facebook URL used displayed in the footer', 'This is the site Facebook URL used displayed in the footer', 0, 0, 0),
(935, '2013-07-29 18:04:08', '2013-07-29 18:04:08', 42, 'Consumer Key', 'Consumer Key', 0, 0, 0),
(936, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'This is the consumer key used for authentication and posting on Twitter.', 'This is the consumer key used for authentication and posting on Twitter.', 0, 0, 0),
(937, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Consumer Secret Key', 'Consumer Secret Key', 0, 0, 0),
(938, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'This is the consumer secret key used for authentication and posting on Twitter.', 'This is the consumer secret key used for authentication and posting on Twitter.', 0, 0, 0),
(939, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'This is the site Twitter URL used for displaying in the footer.', 'This is the site Twitter URL used for displaying in the footer.', 0, 0, 0),
(940, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Click here to build your database', 'Click here to build your database', 0, 0, 0),
(941, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Available plugins are ', 'Available plugins are ', 0, 0, 0),
(942, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Crowdfunding', 'Crowdfunding', 0, 0, 0),
(943, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Google Analytics', 'Google Analytics', 0, 0, 0),
(944, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Metrics', 'Metrics', 0, 0, 0),
(945, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Google Analytics credentials', 'Google Analytics credentials', 0, 0, 0),
(946, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'This is integrated with Google Analytics. Update settings %s.', 'This is integrated with Google Analytics. Update settings %s.', 0, 0, 0),
(947, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'here', 'here', 0, 0, 0),
(948, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Bounces', 'Bounces', 0, 0, 0),
(949, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Bounce Rate is the percentage of single-page visits (i.e. visits in which the person left your site from the entrance page without interacting with the page).', 'Bounce Rate is the percentage of single-page visits (i.e. visits in which the person left your site from the entrance page without interacting with the page).', 0, 0, 0),
(950, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Page Views', 'Page Views', 0, 0, 0),
(951, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Visitors', 'Visitors', 0, 0, 0),
(952, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Pageviews is the total number of pages viewed. Repeated views of a single page are counted.', 'Pageviews is the total number of pages viewed. Repeated views of a single page are counted.', 0, 0, 0),
(953, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'A page view is an instance of a page being loaded by a browser. The Page views metric is the total number of pages viewed; repeated views of a single page are also counted. Visitors is number of user visit the site. Bounces represents the percentage of visitors who enter the site and ''bounce'' (leave the site) rather than continue viewing other pages within the site. Also it shows the graphical representation of the already existing user''s visit and new user visit rate. Recent Activity shows the last 3 site activities. To see the list of all activities please click ''More'' button. User engagment shows current status site users. An overview of site activities such as registrations, logins, posts, funfs, revenue and performance comparison with previous period', 'A page view is an instance of a page being loaded by a browser. The Page views metric is the total number of pages viewed; repeated views of a single page are also counted. Visitors is number of user visit the site. Bounces represents the percentage of visitors who enter the site and ''bounce'' (leave the site) rather than continue viewing other pages within the site. Also it shows the graphical representation of the already existing user''s visit and new user visit rate. Recent Activity shows the last 3 site activities. To see the list of all activities please click ''More'' button. User engagment shows current status site users. An overview of site activities such as registerations, logins, posts, funfs, revenue and performance comparison with previous period', 0, 0, 0),
(954, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Visits & New Visits', 'Visits & New Visits', 0, 0, 0),
(955, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Recent activity', 'Recent activity', 0, 0, 0),
(956, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'More', 'More', 0, 0, 0),
(957, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Visits per Country', 'Visits per Country', 0, 0, 0),
(958, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, ' Ecommerce represents the total transactions made in the selected period and transaction revenue for the site. It shows the pie chart representation for revenue gather by which source and pie chart representation for revenue gather by which project type either pledge, donate, equity or lend.', ' Ecommerce represents the total transactions made in the selected period and transaction revenue for the site. It shows the pie chart representation for revenue gather by which source and pie chart representation for revenue gather by which project type either pledge, donate, equity or lend.', 0, 0, 0),
(959, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Ecommerce', 'Ecommerce', 0, 0, 0),
(960, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'E-Commerce Per Source', 'E-Commerce Per Source', 0, 0, 0),
(961, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'E-Commerce Per Category', 'E-Commerce Per Category', 0, 0, 0),
(962, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Transaction Revenue', 'Transaction Revenue', 0, 0, 0),
(963, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Transactions is the total number of completed purchases on your site. The total revenue from ecommerce transactions. Depending on your implementation, this can include tax and shipping.', 'Transactions is the total number of completed purchases on your site. The total revenue from ecommerce transactions. Depending on your implementation, this can include tax and shipping.', 0, 0, 0),
(964, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Bounces represents the percentage of visitors who enter the site and ''bounce'' (leave the site) rather than continue viewing other pages within the site. Bounce rates can be used to help determine the effectiveness or performance of an entry page. An entry page with a low bounce rate means that the page effectively causes visitors to view more pages and continue on deeper into the web site. A pageview is an instance of a page being loaded by a browser. The Pageviews metric is the total number of pages viewed; repeated views of a single page are also counted. Visitors is the number of user visit your site. Bounces represents the percentage of visitors who enter the site and ''bounce'' (leave the site) rather than continue viewing other pages within the site. The graph is use to trace step wise completion of user''s project post/fund so it helps admin to find in which step user interrupt without complete their posting/funding. This analysis helps admin to improve the clarity of project post steps thereby increase the project post/fund.', 'Bounces represents the percentage of visitors who enter the site and ''bounce'' (leave the site) rather than continue viewing other pages within the site. Bounce rates can be used to help determine the effectiveness or performance of an entry page. An entry page with a low bounce rate means that the page effectively causes visitors to view more pages and continue on deeper into the web site. A pageview is an instance of a page being loaded by a browser. The Pageviews metric is the total number of pages viewed; repeated views of a single page are also counted. Visitors is the number of user visit your site. Bounces represents the percentage of visitors who enter the site and ''bounce'' (leave the site) rather than continue viewing other pages within the site. The graph is use to trace step wise completion of user''s project post/fund so it helps admin to find in which step user interrupt without complete their posting/funding. This analysis helps admin to improve the clarity of project post steps thereby increase the project post/fund.', 0, 0, 0),
(965, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Project Fund Form Bounces', 'Project Fund Form Bounces', 0, 0, 0),
(966, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Traffic is use to measure how actively the visitors are engaging with site and content. Visits per source is use to analyze by which source most of user visit the website. Visit & new visits is use to analyze which user mostly visit the site either new only or already existing user. Geo graph is use to analyze in which region most of the visits from.', 'Traffic is use to measure how actively the visitors are engaging with site and content. Visits per source is use to analyze by which source most of user visit the website. Visit & new visits is use to analyze which user mostly visit the site either new only or already existing user. Geo graph is use to analyze in which region most of the visits from.', 0, 0, 0),
(967, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Traffic', 'Traffic', 0, 0, 0),
(968, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Visits Per Source', 'Visits Per Source', 0, 0, 0),
(969, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Visits Per Country', 'Visits Per Country', 0, 0, 0),
(970, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'JOBS Act - Questionaire', 'JOBS Act - Questionaire', 0, 0, 0),
(971, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You cant add %s, , because you have already reached the maximum raised amount', 'You cant add %s, , because you have already reached the maximum raised amount', 0, 0, 0),
(972, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You cant raised this much amount', 'You cant raised this much amount', 0, 0, 0),
(973, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You cant invest, because you reached your limit', 'You cant invest, because you reached your limit', 0, 0, 0),
(974, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'JOBS Act', 'JOBS Act', 0, 0, 0),
(975, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Number of Dependencies', 'Number of Dependencies', 0, 0, 0),
(976, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Jumpstart Our Business Startups (JOBS) Compliance', 'Jumpstart Our Business Startups (JOBS) Compliance', 0, 0, 0),
(977, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Before pledging project, check your compliance whether you are an accredited/non-accredited investor under US JOBS Act.', 'Before pledging project, check your compliance whether you are an accredited/non-accredited investor under US JOBS Act.', 0, 0, 0),
(978, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Please enter with care, you can''t update these details later. This is one-time-process.', 'Please enter with care, you can''t update these details later. This is one-time-process.', 0, 0, 0),
(979, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Annual income without including any income of the Investor`s spouse', 'Annual income without including any income of the Investor`s spouse', 0, 0, 0),
(980, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Annual income including income of the Investor`s spouse', 'Annual income including income of the Investor`s spouse', 0, 0, 0),
(981, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Total income from all people living in Investor`s household', 'Total income from all people living in Investor`s household', 0, 0, 0),
(982, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'As an invetment platform, we are required to verify your accredition status. Provide information and confirm your accredition status to help us stay within US regulations', 'As an invetment platform, we are required to verify your accredition status. Provide information and confirm your accredition status to help us stay within US regulations', 0, 0, 0),
(983, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Read more....', 'Read more....', 0, 0, 0),
(984, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Submit', 'Submit', 0, 0, 0),
(985, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Subscription', 'Subscription', 0, 0, 0),
(986, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You have already subscribed', 'You have already subscribed', 0, 0, 0),
(987, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Unable to subscribe. Please try again.', 'Unable to subscribe. Please try again.', 0, 0, 0),
(988, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Sorry. entered invitation code is expired or invalid.', 'Sorry. entered invitation code is expired or invalid.', 0, 0, 0),
(989, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invite Friends', 'Invite Friends', 0, 0, 0),
(990, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, '%s has been sent', '%s has been sent', 0, 0, 0),
(991, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invitation', 'Invitation', 0, 0, 0),
(992, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invalid Request', 'Invalid Request', 0, 0, 0),
(993, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Subscribed', 'Subscribed', 0, 0, 0),
(994, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Subscribed for Pre-launch', 'Subscribed for Pre-launch', 0, 0, 0),
(995, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Subscribed for Private Beta', 'Subscribed for Private Beta', 0, 0, 0),
(996, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invalid request, please subscribe again', 'Invalid request, please subscribe again', 0, 0, 0),
(997, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Email address already verified .', 'Email address already verified .', 0, 0, 0),
(998, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Email address already registered to the site', 'Email address already registered to the site', 0, 0, 0),
(999, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You may request for new invitation code below', 'You may request for new invitation code below', 0, 0, 0),
(1000, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Request Invite', 'Request Invite', 0, 0, 0),
(1001, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Enter your email', 'Enter your email', 0, 0, 0),
(1002, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Sorry, currently we''re out of invitation code. We send invitation code in periodic basis.', 'Sorry, currently we''re out of invitation code. We send invitation code in periodic basis.', 0, 0, 0),
(1003, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You will receive email when it''s ready for you.', 'You will receive email when it''s ready for you.', 0, 0, 0),
(1004, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Thanks for your interest.', 'Thanks for your interest.', 0, 0, 0),
(1005, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Want to be the first to know when site is ready?', 'Want to be the first to know when site is ready?', 0, 0, 0),
(1006, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Notify Me', 'Notify Me', 0, 0, 0),
(1007, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'By submitting this email, I am authorizing site to send me emails until I unsubscribe.', 'By submitting this email, I am authorizing site to send me emails until I unsubscribe.', 0, 0, 0),
(1008, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Privacy Policy', 'Privacy Policy', 0, 0, 0),
(1009, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Please confirm your email address by checking your inbox', 'Please confirm your email address by checking your inbox', 0, 0, 0),
(1010, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Email Verified successfully.', 'Email Verified successfully.', 0, 0, 0),
(1011, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Thanks for your interest. Our team will contact you soon.', 'Thanks for your interest. Our team will contact you soon.', 0, 0, 0),
(1012, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Site Users', 'Site Users', 0, 0, 0),
(1013, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'OpenID Users', 'OpenID Users', 0, 0, 0),
(1014, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Facebook Users', 'Facebook Users', 0, 0, 0),
(1015, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Twitter Users', 'Twitter Users', 0, 0, 0),
(1016, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Gmail Users', 'Gmail Users', 0, 0, 0),
(1017, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'LinkedIn Users', 'LinkedIn Users', 0, 0, 0),
(1018, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Yahoo! Users', 'Yahoo! Users', 0, 0, 0),
(1019, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Admin Users', 'Admin Users', 0, 0, 0),
(1020, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Total Users', 'Total Users', 0, 0, 0),
(1021, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'CSV', 'CSV', 0, 0, 0),
(1022, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invitation Sent', 'Invitation Sent', 0, 0, 0),
(1023, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Registered', 'Registered', 0, 0, 0),
(1024, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'From Friends Invite', 'From Friends Invite', 0, 0, 0),
(1025, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invitation to Friends', 'Invitation to Friends', 0, 0, 0),
(1026, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invited', 'Invited', 0, 0, 0),
(1027, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Allowed invitation', 'Allowed invitation', 0, 0, 0),
(1028, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Subscribed On', 'Subscribed On', 0, 0, 0),
(1029, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Email Verified', 'Email Verified', 0, 0, 0),
(1030, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Send Invitation Code', 'Send Invitation Code', 0, 0, 0),
(1031, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You have %s remaining invites', 'You have %s remaining invites', 0, 0, 0),
(1032, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Enter your friends email', 'Enter your friends email', 0, 0, 0),
(1033, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Enter friends email with comma seperated.', 'Enter friends email with comma seperated.', 0, 0, 0),
(1034, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'You have no remaining invites', 'You have no remaining invites', 0, 0, 0),
(1035, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Enter your invitation code', 'Enter your invitation code', 0, 0, 0),
(1036, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Sign Up', 'Sign Up', 0, 0, 0),
(1037, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invitation code from ', 'Invitation code from ', 0, 0, 0),
(1038, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, '%s is accepted', '%s is accepted', 0, 0, 0),
(1039, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Sign In using', 'Sign In using', 0, 0, 0),
(1040, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'If you don''t want to sign up with a social network,', 'If you don''t want to sign up with a social network,', 0, 0, 0),
(1041, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Click here', 'Click here', 0, 0, 0),
(1042, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Registration From Friends Invite', 'Registration From Friends Invite', 0, 0, 0),
(1043, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Invited Friends Count', 'Invited Friends Count', 0, 0, 0),
(1044, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Repayment Schedules', 'Repayment Schedules', 0, 0, 0),
(1045, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Credit Scores', 'Credit Scores', 0, 0, 0),
(1046, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Loan Terms', 'Loan Terms', 0, 0, 0),
(1047, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Credit Scores Summary', 'Credit Scores Summary', 0, 0, 0),
(1048, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Add Credit Score', 'Add Credit Score', 0, 0, 0),
(1049, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Credit Score', 'Credit Score', 0, 0, 0),
(1050, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Edit Credit Score', 'Edit Credit Score', 0, 0, 0),
(1051, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Open for Lending', 'Open for Lending', 0, 0, 0),
(1052, '2013-07-29 18:04:09', '2013-07-29 18:04:09', 42, 'Goal Reached', 'Goal Reached', 0, 0, 0),
(1053, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lent', 'Lent', 0, 0, 0),
(1054, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s Names', '%s Names', 0, 0, 0),
(1055, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Select atleast one project and lend project', 'Select atleast one project and lend project', 0, 0, 0),
(1056, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Visible', 'Visible', 0, 0, 0),
(1057, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Show your amount, but hide the name', 'Show your amount, but hide the name', 0, 0, 0),
(1058, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Show your name, but hide the amount', 'Show your name, but hide the amount', 0, 0, 0),
(1059, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Bulk Lending', 'Bulk Lending', 0, 0, 0),
(1060, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Your wallet has insufficient money', 'Your wallet has insufficient money', 0, 0, 0),
(1061, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'You have lent successfully', 'You have lent successfully', 0, 0, 0),
(1062, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Check Rate', 'Check Rate', 0, 0, 0),
(1063, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Pending Payment', 'Pending Payment', 0, 0, 0),
(1064, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Amount Repayment', 'Amount Repayment', 0, 0, 0),
(1065, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s %s Lends', '%s %s Lends', 0, 0, 0),
(1066, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s summary', '%s summary', 0, 0, 0),
(1067, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Add Loan Term', 'Add Loan Term', 0, 0, 0),
(1068, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Loan Term', 'Loan Term', 0, 0, 0),
(1069, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Edit Repayment Schedule', 'Edit Repayment Schedule', 0, 0, 0),
(1070, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Pay Repayment', 'Pay Repayment', 0, 0, 0),
(1071, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Repayment has been paid successfully', 'Repayment has been paid successfully', 0, 0, 0),
(1072, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Add Repayment Schedule', 'Add Repayment Schedule', 0, 0, 0),
(1073, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Repayment Schedule', 'Repayment Schedule', 0, 0, 0),
(1074, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lending amount', 'Lending amount', 0, 0, 0),
(1075, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'The interest rate should be a numeric value.', 'The interest rate should be a numeric value.', 0, 0, 0),
(1076, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'The suggested interest rate should be a numeric value.', 'The suggested interest rate should be a numeric value.', 0, 0, 0),
(1077, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s lending end date should be greater than to today', '%s lending end date should be greater than to today', 0, 0, 0),
(1078, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Your interest rate could not be less then %s', 'Your interest rate could not be less then %s', 0, 0, 0),
(1079, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'The months should be a numeric value.', 'The months should be a numeric value.', 0, 0, 0),
(1080, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Enter the valid particular day of month (within 28)', 'Enter the valid particular day of month (within 28)', 0, 0, 0),
(1081, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'The day should be a numeric value.', 'The day should be a numeric value.', 0, 0, 0),
(1082, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Latest Target Interest Rate', 'Latest Target Interest Rate', 0, 0, 0),
(1083, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Please refer the lastest target interest rate summary before enter your site suggested interest rate', 'Please refer the lastest target interest rate summary before enter your site suggested interest rate', 0, 0, 0),
(1084, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Interest Rate', 'Interest Rate', 0, 0, 0),
(1085, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Suggested Interest Rate', 'Suggested Interest Rate', 0, 0, 0),
(1086, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'credit scores', 'credit scores', 0, 0, 0),
(1087, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '[Image: Pledge]', '[Image: Pledge]', 0, 0, 0),
(1088, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'In %s %s, %s amount is captured by end date/goal reached\\r\\nof the %s and %s earns interest.', 'In %s %s, %s amount is captured by end date/goal reached\\r\\nof the %s and %s earns interest.', 0, 0, 0),
(1089, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'I have read and understand ', 'I have read and understand ', 0, 0, 0),
(1090, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'terms.', 'terms.', 0, 0, 0),
(1091, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lend', 'Lend', 0, 0, 0),
(1092, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'In %s %s, %s amount is captured by end date/goal reached of the %s and %s earns interest.', 'In %s %s, %s amount is captured by end date/goal reached of the %s and %s earns interest.', 0, 0, 0),
(1093, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lend Now', 'Lend Now', 0, 0, 0),
(1094, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Admin moves the %s for lending', 'Admin moves the %s for lending', 0, 0, 0),
(1095, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Expired (If %s is fixed lending and %s didn''t reach goal.) ', 'Expired (If %s is fixed lending and %s didn''t reach goal.) ', 0, 0, 0),
(1096, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s lends a %s', '%s lends a %s', 0, 0, 0),
(1097, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'After %s reaches the goal', 'After %s reaches the goal', 0, 0, 0),
(1098, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s Moved to Project Amount Repayment state.', '%s Moved to Project Amount Repayment state.', 0, 0, 0),
(1099, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'If repayment schedule date exceeded, have to pay with late payment fee.', 'If repayment schedule date exceeded, have to pay with late payment fee.', 0, 0, 0),
(1100, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Repay the amount to %s, by given repayment schedule.', 'Repay the amount to %s, by given repayment schedule.', 0, 0, 0),
(1101, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lends a %s', 'Lends a %s', 0, 0, 0),
(1102, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'site will transfer amount to %s', 'site will transfer amount to %s', 0, 0, 0),
(1103, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'If repayment schedule date exceeded, %s will pay with late payment fee.', 'If repayment schedule date exceeded, %s will pay with late payment fee.', 0, 0, 0),
(1104, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, '%s repay the amount, by given repayment schedule.', '%s repay the amount, by given repayment schedule.', 0, 0, 0),
(1105, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Goal Reached, this %s will be closed on', 'Goal Reached, this %s will be closed on', 0, 0, 0),
(1106, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This %s received all of its lent amount by %s', 'This %s received all of its lent amount by %s', 0, 0, 0),
(1107, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This %s will only be lent if at least %s is lendd by %s', 'This %s will only be lent if at least %s is lendd by %s', 0, 0, 0),
(1108, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This %s received all of its lent amount %s', 'This %s received all of its lent amount %s', 0, 0, 0),
(1109, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This %s successfully raised its lending goal %s', 'This %s successfully raised its lending goal %s', 0, 0, 0),
(1110, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lend interest rate %s', 'Lend interest rate %s', 0, 0, 0),
(1111, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This idea will only be listed for lending only if at least enough voters support it. Admin will move top votes ideas to projects based on number of votes.', 'This idea will only be listed for lending only if at least enough voters support it. Admin will move top votes ideas to projects based on number of votes.', 0, 0, 0),
(1112, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Flexible Lending', 'Flexible Lending', 0, 0, 0),
(1113, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'lent on', 'lent on', 0, 0, 0),
(1114, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'People initially lend. Amount is captured by end date/goal reached of the project. Borrower offer interest.', 'People initially lend. Amount is captured by end date/goal reached of the project. Borrower offer interest.', 0, 0, 0),
(1115, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'No. of Loans', 'No. of Loans', 0, 0, 0),
(1116, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Average Rate', 'Average Rate', 0, 0, 0),
(1117, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Total Capital Returned', 'Total Capital Returned', 0, 0, 0),
(1118, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Total Interest Returned', 'Total Interest Returned', 0, 0, 0),
(1119, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'No %s Lends available', 'No %s Lends available', 0, 0, 0),
(1120, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This is private info. You can able to set Genuine/Not Genuine for Project Closed %s', 'This is private info. You can able to set Genuine/Not Genuine for Project Closed %s', 0, 0, 0),
(1121, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Project closed, but project owner did fraudulent', 'Project closed, but project owner did fraudulent', 0, 0, 0),
(1122, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lending Goal Reached Date', 'Lending Goal Reached Date', 0, 0, 0),
(1123, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'This info is private. You can able to set Genuine/Not Genuine for Project Closed %s', 'This info is private. You can able to set Genuine/Not Genuine for Project Closed %s', 0, 0, 0),
(1124, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Project closed, but project owner did fraudulently', 'Project closed, but project owner did fraudulently', 0, 0, 0),
(1125, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Before starting project, check your eligble interest rate based on your credit score and category.', 'Before starting project, check your eligble interest rate based on your credit score and category.', 0, 0, 0),
(1126, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Purpose', 'Purpose', 0, 0, 0),
(1127, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Terms', 'Terms', 0, 0, 0),
(1128, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'months', 'months', 0, 0, 0),
(1129, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Monthly Repayment', 'Monthly Repayment', 0, 0, 0),
(1130, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Get Loan', 'Get Loan', 0, 0, 0),
(1131, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lend Amount', 'Lend Amount', 0, 0, 0),
(1132, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Open for Lending Projects', 'Open for Lending Projects', 0, 0, 0),
(1133, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Rate', 'Rate', 0, 0, 0),
(1134, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Difference in Rate', 'Difference in Rate', 0, 0, 0),
(1135, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Title', 'Title', 0, 0, 0),
(1136, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Days Left', 'Days Left', 0, 0, 0),
(1137, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'projects', 'projects', 0, 0, 0),
(1138, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, ' terms.', ' terms.', 0, 0, 0),
(1139, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Lending Name', 'Lending Name', 0, 0, 0),
(1140, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Amount %s ', 'Amount %s ', 0, 0, 0),
(1141, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Capital Returned', 'Capital Returned', 0, 0, 0),
(1142, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Interest Returned', 'Interest Returned', 0, 0, 0),
(1143, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Percentage Repaid', 'Percentage Repaid', 0, 0, 0),
(1144, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Repayment Date', 'Repayment Date', 0, 0, 0),
(1145, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Total Arrears', 'Total Arrears', 0, 0, 0),
(1146, '2013-07-29 18:04:10', '2013-07-29 18:04:10', 42, 'Project Amount Repayment', 'Project Amount Repayment', 0, 0, 0),
(1147, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Lending Date', 'Lending Date', 0, 0, 0),
(1148, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Repayment Amount', 'Repayment Amount', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1149, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Repayment', 'Repayment', 0, 0, 0),
(1150, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Late Fee: %s', 'Late Fee: %s', 0, 0, 0),
(1151, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Borrowing State', 'Borrowing State', 0, 0, 0),
(1152, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Total Lent', 'Total Lent', 0, 0, 0),
(1153, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Toal Captital Returned', 'Toal Captital Returned', 0, 0, 0),
(1154, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Toal Interest Returned', 'Toal Interest Returned', 0, 0, 0),
(1155, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Open for lending', 'Open for lending', 0, 0, 0),
(1156, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Amount Repayment (%s)', 'Amount Repayment (%s)', 0, 0, 0),
(1157, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s accepting lending from %s.', '%s accepting lending from %s.', 0, 0, 0),
(1158, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'If needed amount not reached within the %s end date, %s moves to expire and preapproved authorization will be canceled.', 'If needed amount not reached within the %s end date, %s moves to expire and preapproved authorization will be canceled.', 0, 0, 0),
(1159, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'All fundings move to %s wallet and commission amount moves to site admin account.', 'All fundings move to %s wallet and commission amount moves to site admin account.', 0, 0, 0),
(1160, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Number of Months', 'Number of Months', 0, 0, 0),
(1161, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Months', 'Months', 0, 0, 0),
(1162, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'loan terms', 'loan terms', 0, 0, 0),
(1163, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Principal Amount', 'Principal Amount', 0, 0, 0),
(1164, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Interest Amount', 'Interest Amount', 0, 0, 0),
(1165, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Late Fee', 'Late Fee', 0, 0, 0),
(1166, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Total Amount', 'Total Amount', 0, 0, 0),
(1167, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Particular Day of Month?', 'Particular Day of Month?', 0, 0, 0),
(1168, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Day', 'Day', 0, 0, 0),
(1169, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'repayment schedules', 'repayment schedules', 0, 0, 0),
(1170, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'A %s in by %s', 'A %s in by %s', 0, 0, 0),
(1171, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'No reward', 'No reward', 0, 0, 0),
(1172, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Private Message', 'Private Message', 0, 0, 0),
(1173, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Captured', 'Captured', 0, 0, 0),
(1174, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Authorized', 'Authorized', 0, 0, 0),
(1175, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Voided', 'Voided', 0, 0, 0),
(1176, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You cannot select this %s for the amount you entered.', 'You cannot select this %s for the amount you entered.', 0, 0, 0),
(1177, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'We will authorize the %s amount. This amount will be captured only when the %s reaches the goal and end date.', 'We will authorize the %s amount. This amount will be captured only when the %s reaches the goal and end date.', 0, 0, 0),
(1178, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'We will authorize the %s amount. This amount will be captured once %s reached end date.', 'We will authorize the %s amount. This amount will be captured once %s reached end date.', 0, 0, 0),
(1179, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Select your %s', 'Select your %s', 0, 0, 0),
(1180, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'No %s', 'No %s', 0, 0, 0),
(1181, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'No thanks, I just want to help the %s.', 'No thanks, I just want to help the %s.', 0, 0, 0),
(1182, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Sold out', 'Sold out', 0, 0, 0),
(1183, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Estimated delivery date', 'Estimated delivery date', 0, 0, 0),
(1184, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Additional Info', 'Additional Info', 0, 0, 0),
(1185, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Shipping Address', 'Shipping Address', 0, 0, 0),
(1186, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You must select address from autocomplete', 'You must select address from autocomplete', 0, 0, 0),
(1187, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Address', 'Address', 0, 0, 0),
(1188, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Point Your Location', 'Point Your Location', 0, 0, 0),
(1189, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Point the exact location in map by dragging marker', 'Point the exact location in map by dragging marker', 0, 0, 0),
(1190, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Pledge', 'Pledge', 0, 0, 0),
(1191, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Admin moves the %s for funding', 'Admin moves the %s for funding', 0, 0, 0),
(1192, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Before %s end date', 'Before %s end date', 0, 0, 0),
(1193, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s can still funds a %s if %s allows overfunding', '%s can still funds a %s if %s allows overfunding', 0, 0, 0),
(1194, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'After project end date', 'After project end date', 0, 0, 0),
(1195, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Gives %s to %s', 'Gives %s to %s', 0, 0, 0),
(1196, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'After %s end date', 'After %s end date', 0, 0, 0),
(1197, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Get the %s from %s', 'Get the %s from %s', 0, 0, 0),
(1198, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'This %s will only be funded if at least %s is pledged by %s', 'This %s will only be funded if at least %s is pledged by %s', 0, 0, 0),
(1199, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'or more', 'or more', 0, 0, 0),
(1200, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Limited', 'Limited', 0, 0, 0),
(1201, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Unlimited', 'Unlimited', 0, 0, 0),
(1202, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'funded on', 'funded on', 0, 0, 0),
(1203, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'People initially pledge. Amount is captured by end date. May offer rewards.', 'People initially pledge. Amount is captured by end date. May offer rewards.', 0, 0, 0),
(1204, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Reward', 'Reward', 0, 0, 0),
(1205, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Estimated Delivery Date: ', 'Estimated Delivery Date: ', 0, 0, 0),
(1206, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Not received', 'Not received', 0, 0, 0),
(1207, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Received', 'Received', 0, 0, 0),
(1208, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Funding Date', 'Funding Date', 0, 0, 0),
(1209, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Fixed Funding', 'Fixed Funding', 0, 0, 0),
(1210, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Fixed funding: %s fund will be captured only if it reached the needed amount. When the %s has been reached the ending date, then funds can start to be released.', 'Fixed funding: %s fund will be captured only if it reached the needed amount. When the %s has been reached the ending date, then funds can start to be released.', 0, 0, 0),
(1211, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Flexible funding: %s fund will be captured even if it does not reach the needed amount.', 'Flexible funding: %s fund will be captured even if it does not reach the needed amount.', 0, 0, 0),
(1212, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Change status to fund', 'Change status to fund', 0, 0, 0),
(1213, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Funding Goal Reached Date', 'Funding Goal Reached Date', 0, 0, 0),
(1214, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Print reward voucher option will be available in funded projects', 'Print reward voucher option will be available in funded projects', 0, 0, 0),
(1215, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Payment Status', 'Payment Status', 0, 0, 0),
(1216, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Print voucher', 'Print voucher', 0, 0, 0),
(1217, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'No %s selected', 'No %s selected', 0, 0, 0),
(1218, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Fixed funding:  %s fund will be captured only if it reached the needed amount.When %s has been reached the ending date, then funds can start to be released.', 'Fixed funding:  %s fund will be captured only if it reached the needed amount.When %s has been reached the ending date, then funds can start to be released.', 0, 0, 0),
(1219, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Flexible funding:  %s fund will be captured even if it does not reached the needed amount.', 'Flexible funding:  %s fund will be captured even if it does not reached the needed amount.', 0, 0, 0),
(1220, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Reward details', 'Reward details', 0, 0, 0),
(1221, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Open for funding', 'Open for funding', 0, 0, 0),
(1222, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Goal Reached (%s)', 'Goal Reached (%s)', 0, 0, 0),
(1223, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s accepting funding from %s.', '%s accepting funding from %s.', 0, 0, 0),
(1224, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'If over funding allowed, users can pledge more than needed amount.', 'If over funding allowed, users can pledge more than needed amount.', 0, 0, 0),
(1225, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Flag Categories', '%s Flag Categories', 0, 0, 0),
(1226, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Flag Category', '%s Flag Category', 0, 0, 0),
(1227, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Flag', '%s Flag', 0, 0, 0),
(1228, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Report', 'Report', 0, 0, 0),
(1229, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Flag Category', 'Flag Category', 0, 0, 0),
(1230, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Message', 'Message', 0, 0, 0),
(1231, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Followers', '%s Followers', 0, 0, 0),
(1232, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You are successfully following this %s', 'You are successfully following this %s', 0, 0, 0),
(1233, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s could not be added as follower. Please, try again', '%s could not be added as follower. Please, try again', 0, 0, 0),
(1234, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s could not be added as follower', '%s could not be added as follower', 0, 0, 0),
(1235, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You have already following this %s', 'You have already following this %s', 0, 0, 0),
(1236, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' You have unfollowed this %s', ' You have unfollowed this %s', 0, 0, 0),
(1237, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You have unfollowed this %s', 'You have unfollowed this %s', 0, 0, 0),
(1238, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' - User - %s', ' - User - %s', 0, 0, 0),
(1239, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' %s deleted', ' %s deleted', 0, 0, 0),
(1240, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Follower', '%s Follower', 0, 0, 0),
(1241, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Show all Followers', 'Show all Followers', 0, 0, 0),
(1242, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'X', 'X', 0, 0, 0),
(1243, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You', 'You', 0, 0, 0),
(1244, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Here', 'Here', 0, 0, 0),
(1245, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Votings', '%s Votings', 0, 0, 0),
(1246, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Voting', 'Voting', 0, 0, 0),
(1247, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Voting could not be added. Please, try again', 'Voting could not be added. Please, try again', 0, 0, 0),
(1248, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You have already voted this %s', 'You have already voted this %s', 0, 0, 0),
(1249, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'You cannot vote your own %s', 'You cannot vote your own %s', 0, 0, 0),
(1250, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Voting', '%s Voting', 0, 0, 0),
(1251, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' - %s - %s', ' - %s - %s', 0, 0, 0),
(1252, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Voted on', 'Voted on', 0, 0, 0),
(1253, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' Vote(s)', ' Vote(s)', 0, 0, 0),
(1254, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' Show all voters', ' Show all voters', 0, 0, 0),
(1255, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Show all voters', 'Show all voters', 0, 0, 0),
(1256, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Enter valid amount', 'Enter valid amount', 0, 0, 0),
(1257, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Must be less than needed amount', 'Must be less than needed amount', 0, 0, 0),
(1258, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Enter valid limit in numbers', 'Enter valid limit in numbers', 0, 0, 0),
(1259, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'This limit can not be entered  ', 'This limit can not be entered  ', 0, 0, 0),
(1260, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Must be greater than %s end date.', 'Must be greater than %s end date.', 0, 0, 0),
(1261, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Must be enter the additional information label', 'Must be enter the additional information label', 0, 0, 0),
(1262, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Amount should be equal to fixed amount', 'Amount should be equal to fixed amount', 0, 0, 0),
(1263, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Amount should not be less then minimum amount', 'Amount should not be less then minimum amount', 0, 0, 0),
(1264, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Amount should not be less then denomination amount', 'Amount should not be less then denomination amount', 0, 0, 0),
(1265, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Amount cannot be equally shared or else you should allow over funding.', 'Amount cannot be equally shared or else you should allow over funding.', 0, 0, 0),
(1266, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Update Comments', '%s Update Comments', 0, 0, 0),
(1267, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Update Comments', 'Update Comments', 0, 0, 0),
(1268, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Update Comment', 'Update Comment', 0, 0, 0),
(1269, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s update Comment has been suspended due to containing suspicious words.', '%s update Comment has been suspended due to containing suspicious words.', 0, 0, 0),
(1270, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Update Comment', '%s Update Comment', 0, 0, 0),
(1271, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' - %s Update - %s', ' - %s Update - %s', 0, 0, 0),
(1272, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Update Tags', 'Update Tags', 0, 0, 0),
(1273, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Update Views', 'Update Views', 0, 0, 0),
(1274, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' - Update - %s', ' - Update - %s', 0, 0, 0),
(1275, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Update View deleted', '%s Update View deleted', 0, 0, 0),
(1276, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'updates', 'updates', 0, 0, 0),
(1277, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Drafted Updates', 'Drafted Updates', 0, 0, 0),
(1278, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, ' - Tag - %s', ' - Tag - %s', 0, 0, 0),
(1279, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, '%s Update', '%s Update', 0, 0, 0),
(1280, '2013-07-29 18:04:11', '2013-07-29 18:04:11', 42, 'Update has been suspended due to containing suspicious words', 'Update has been suspended due to containing suspicious words', 0, 0, 0),
(1281, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s update has been published', '%s update has been published', 0, 0, 0),
(1282, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s update has been drafted', '%s update has been drafted', 0, 0, 0),
(1283, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Updates - %s', '%s Updates - %s', 0, 0, 0),
(1284, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Published', 'Published', 0, 0, 0),
(1285, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Flag', 'Flag', 0, 0, 0),
(1286, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Clear Flag', 'Clear Flag', 0, 0, 0),
(1287, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Must be in numeric', 'Must be in numeric', 0, 0, 0),
(1288, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Post Comment', 'Post Comment', 0, 0, 0),
(1289, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Blog', 'Blog', 0, 0, 0),
(1290, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Viewed On', 'Viewed On', 0, 0, 0),
(1291, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Guest', 'Guest', 0, 0, 0),
(1292, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Update Views', '%s Update Views', 0, 0, 0),
(1293, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Add %s Update', 'Add %s Update', 0, 0, 0),
(1294, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Tags', 'Tags', 0, 0, 0),
(1295, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Separate tags with commas', 'Separate tags with commas', 0, 0, 0),
(1296, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Author', 'Author', 0, 0, 0),
(1297, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Edit %s Update', 'Edit %s Update', 0, 0, 0),
(1298, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '''s updates', '''s updates', 0, 0, 0),
(1299, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Add Update', 'Add Update', 0, 0, 0),
(1300, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Subscribe to %s', 'Subscribe to %s', 0, 0, 0),
(1301, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Tags:', 'Tags:', 0, 0, 0),
(1302, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Please %s to post comment', 'Please %s to post comment', 0, 0, 0),
(1303, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'login', 'login', 0, 0, 0),
(1304, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Blog Comment', 'Blog Comment', 0, 0, 0),
(1305, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Feeds', '%s Feeds', 0, 0, 0),
(1306, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Site Activities', 'Site Activities', 0, 0, 0),
(1307, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Comments', '%s Comments', 0, 0, 0),
(1308, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Views', '%s Views', 0, 0, 0),
(1309, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form Field Groups', 'Form Field Groups', 0, 0, 0),
(1310, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form Field Group', 'Form Field Group', 0, 0, 0),
(1311, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form Field Steps', 'Form Field Steps', 0, 0, 0),
(1312, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form Field Step', 'Form Field Step', 0, 0, 0),
(1313, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form field added.', 'Form field added.', 0, 0, 0),
(1314, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form Field', 'Form Field', 0, 0, 0),
(1315, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'FormField deleted', 'FormField deleted', 0, 0, 0),
(1316, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages - Inbox', 'Messages - Inbox', 0, 0, 0),
(1317, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages - Sent Mail', 'Messages - Sent Mail', 0, 0, 0),
(1318, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages - Starred', 'Messages - Starred', 0, 0, 0),
(1319, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages - All', 'Messages - All', 0, 0, 0),
(1320, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Message Board', 'Message Board', 0, 0, 0),
(1321, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'All mails', 'All mails', 0, 0, 0),
(1322, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages - Compose', 'Messages - Compose', 0, 0, 0),
(1323, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'File format not supported', 'File format not supported', 0, 0, 0),
(1324, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Please select the file', 'Please select the file', 0, 0, 0),
(1325, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Message send is temporarily stopped. Please try again later.', 'Message send is temporarily stopped. Please try again later.', 0, 0, 0),
(1326, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s comment', '%s comment', 0, 0, 0),
(1327, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s has been suspended due to containing suspicious words', '%s has been suspended due to containing suspicious words', 0, 0, 0),
(1328, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Comment has been posted successfully', 'Comment has been posted successfully', 0, 0, 0),
(1329, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Message has been sent successfully', 'Message has been sent successfully', 0, 0, 0),
(1330, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Problem in sending message. You can send message only to your friends network', 'Problem in sending message. You can send message only to your friends network', 0, 0, 0),
(1331, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Please specify coreect recipient', 'Please specify coreect recipient', 0, 0, 0),
(1332, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Please specify atleast one recipient', 'Please specify atleast one recipient', 0, 0, 0),
(1333, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Problem in sending message.', 'Problem in sending message.', 0, 0, 0),
(1334, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages - Reply', 'Messages - Reply', 0, 0, 0),
(1335, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Re:', 'Re:', 0, 0, 0),
(1336, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Fwd:', 'Fwd:', 0, 0, 0),
(1337, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Public', 'Public', 0, 0, 0),
(1338, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Post to all', 'Post to all', 0, 0, 0),
(1339, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Private to %s', 'Private to %s', 0, 0, 0),
(1340, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Selecte a', 'Selecte a', 0, 0, 0),
(1341, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Messages', 'Messages', 0, 0, 0),
(1342, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Inbox', 'Inbox', 0, 0, 0),
(1343, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Notifications cleared successfully', 'Notifications cleared successfully', 0, 0, 0),
(1344, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'You cannot fund your own %s', 'You cannot fund your own %s', 0, 0, 0),
(1345, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'You cannot fund %s', 'You cannot fund %s', 0, 0, 0),
(1346, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s has been closed', '%s has been closed', 0, 0, 0),
(1347, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'You have %s successfully', 'You have %s successfully', 0, 0, 0),
(1348, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'You have successfully %s', 'You have successfully %s', 0, 0, 0),
(1349, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Problem in funding.', 'Problem in funding.', 0, 0, 0),
(1350, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Fund has been canceled', '%s Fund has been canceled', 0, 0, 0),
(1351, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Fund could not be canceled. Please, try again.', '%s Fund could not be canceled. Please, try again.', 0, 0, 0),
(1352, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Voucher', '%s Voucher', 0, 0, 0),
(1353, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Voucher', 'Voucher', 0, 0, 0),
(1354, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Invalid voucher code', 'Invalid voucher code', 0, 0, 0),
(1355, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'You don''t have rights to view this page', 'You don''t have rights to view this page', 0, 0, 0),
(1356, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s was given already', '%s was given already', 0, 0, 0),
(1357, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s was marked as given successfully', '%s was marked as given successfully', 0, 0, 0),
(1358, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Order', 'Order', 0, 0, 0),
(1359, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Your payment is successful.', 'Your payment is successful.', 0, 0, 0),
(1360, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Types', '%s Types', 0, 0, 0),
(1361, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Type', '%s Type', 0, 0, 0),
(1362, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Form Fields', 'Form Fields', 0, 0, 0),
(1363, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Type could not be saved. Please enter all option values needed.', '%s Type could not be saved. Please enter all option values needed.', 0, 0, 0),
(1364, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s Type could not be saved. Please enter exactly 2 options for slider control.', '%s Type could not be saved. Please enter exactly 2 options for slider control.', 0, 0, 0),
(1365, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s type pricing has been updated', '%s type pricing has been updated', 0, 0, 0),
(1366, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Pricing', 'Pricing', 0, 0, 0),
(1367, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Preview', 'Preview', 0, 0, 0),
(1368, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Embed', 'Embed', 0, 0, 0),
(1369, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, '%s View', '%s View', 0, 0, 0),
(1370, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, ' - Search - All', ' - Search - All', 0, 0, 0),
(1371, '2013-07-29 18:04:12', '2013-07-29 18:04:12', 42, 'Vote ideas for %s', 'Vote ideas for %s', 0, 0, 0),
(1372, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Almost %s', 'Almost %s', 0, 0, 0),
(1373, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Ending Soon', 'Ending Soon', 0, 0, 0),
(1374, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Category', 'Category', 0, 0, 0),
(1375, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Admin was suspended this %s.', 'Admin was suspended this %s.', 0, 0, 0),
(1376, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s has been added with drafted status.', '%s has been added with drafted status.', 0, 0, 0),
(1377, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s has been added. Admin will approve your %s', '%s has been added. Admin will approve your %s', 0, 0, 0),
(1378, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s has been updated with drafted status.', '%s has been updated with drafted status.', 0, 0, 0),
(1379, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s has been canceled successfully', '%s has been canceled successfully', 0, 0, 0),
(1380, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s could not be canceled', '%s could not be canceled', 0, 0, 0),
(1381, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Checked records has been opened', 'Checked records has been opened', 0, 0, 0),
(1382, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Checked records has been featured', 'Checked records has been featured', 0, 0, 0),
(1383, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Checked records has been marked as not featured', 'Checked records has been marked as not featured', 0, 0, 0),
(1384, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Checked records has been marked as genuine', 'Checked records has been marked as genuine', 0, 0, 0),
(1385, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Checked records has been marked as not genuine', 'Checked records has been marked as not genuine', 0, 0, 0),
(1386, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s - Guidelines', '%s - Guidelines', 0, 0, 0),
(1387, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Pay Listing Fee', 'Pay Listing Fee', 0, 0, 0),
(1388, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'You have paid listing fee successfully.', 'You have paid listing fee successfully.', 0, 0, 0),
(1389, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Projects Posted', 'Projects Posted', 0, 0, 0),
(1390, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s has been rejected', '%s has been rejected', 0, 0, 0),
(1391, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s has been approved', '%s has been approved', 0, 0, 0),
(1392, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Please enter a valid YouTube, Vimeo video URL, starting with http://', 'Please enter a valid YouTube, Vimeo video URL, starting with http://', 0, 0, 0),
(1393, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Amount should be multiples of %s', 'Amount should be multiples of %s', 0, 0, 0),
(1394, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Short description between %s to %s characters', 'Short description between %s to %s characters', 0, 0, 0),
(1395, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s funding end date should  be greater than today', '%s funding end date should  be greater than today', 0, 0, 0),
(1396, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Expected delivery date should be future date', 'Expected delivery date should be future date', 0, 0, 0),
(1397, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'You must agree to the terms and policies', 'You must agree to the terms and policies', 0, 0, 0),
(1398, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'The amount should be less than needed amount', 'The amount should be less than needed amount', 0, 0, 0),
(1399, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'posted a new %s', 'posted a new %s', 0, 0, 0),
(1400, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Enter only numeric value', 'Enter only numeric value', 0, 0, 0),
(1401, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'The %s you selected is sold out. Please select some other %s.', 'The %s you selected is sold out. Please select some other %s.', 0, 0, 0),
(1402, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'User Message', 'User Message', 0, 0, 0),
(1403, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Project Comment', 'Project Comment', 0, 0, 0),
(1404, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Admin Panel', 'Admin Panel', 0, 0, 0),
(1405, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s Funding', '%s Funding', 0, 0, 0),
(1406, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Move for voting', 'Move for voting', 0, 0, 0),
(1407, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Move for funding', 'Move for funding', 0, 0, 0),
(1408, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s Projects', '%s Projects', 0, 0, 0),
(1409, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Recommended', 'Recommended', 0, 0, 0),
(1410, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Popular', 'Popular', 0, 0, 0),
(1411, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Almost Funded', 'Almost Funded', 0, 0, 0),
(1412, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Small %s', 'Small %s', 0, 0, 0),
(1413, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Hall of Fame', 'Hall of Fame', 0, 0, 0),
(1414, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Comma separated. To include comma, escape it with \\\\ (e.g., Option with \\\\,)', 'Comma separated. To include comma, escape it with \\\\ (e.g., Option with \\\\,)', 0, 0, 0),
(1415, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Remove', 'Remove', 0, 0, 0),
(1416, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Core, cannot be deleted', 'Core, cannot be deleted', 0, 0, 0),
(1417, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Core', 'Core', 0, 0, 0),
(1418, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Depends On', 'Depends On', 0, 0, 0),
(1419, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Interest Rate (%)', 'Interest Rate (%)', 0, 0, 0),
(1420, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Project Steps', 'Project Steps', 0, 0, 0),
(1421, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'How It Works', 'How It Works', 0, 0, 0),
(1422, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Work flow', 'Work flow', 0, 0, 0),
(1423, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Top voted ideas will be chosen for %s by admin. In %s %s, %s.', 'Top voted ideas will be chosen for %s by admin. In %s %s, %s.', 0, 0, 0),
(1424, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Companies can raise upto $1 million per year via crowdfunding.', 'Companies can raise upto $1 million per year via crowdfunding.', 0, 0, 0),
(1425, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Target offering amount and deadline to reach that amount.', 'Target offering amount and deadline to reach that amount.', 0, 0, 0),
(1426, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Disclose shareholders with 20% or more of the company.', 'Disclose shareholders with 20% or more of the company.', 0, 0, 0),
(1427, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Increases the number of shareholders a company can have before having to register common stock with SEC and become a public company. Now, companies can have 500 unaccredited investors and 2,0000 shareholders', 'Increases the number of shareholders a company can have before having to register common stock with SEC and become a public company. Now, companies can have 500 unaccredited investors and 2,0000 shareholders', 0, 0, 0),
(1428, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Add New Group', 'Add New Group', 0, 0, 0),
(1429, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'User can edit this group in ''Open for Funding'' status?', 'User can edit this group in ''Open for Funding'' status?', 0, 0, 0),
(1430, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Edit Group', 'Edit Group', 0, 0, 0),
(1431, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s Form and Groups', '%s Form and Groups', 0, 0, 0),
(1432, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Form Field Groups List', 'Form Field Groups List', 0, 0, 0),
(1433, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Add New Step', 'Add New Step', 0, 0, 0),
(1434, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Is Confirmation', 'Is Confirmation', 0, 0, 0),
(1435, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Additional info', 'Additional info', 0, 0, 0),
(1436, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'If you enable payment step, you have to set pricing details. Otherwise it will take global listing fee.', 'If you enable payment step, you have to set pricing details. Otherwise it will take global listing fee.', 0, 0, 0),
(1437, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'User can edit this step in ''Open for Funding'' status?', 'User can edit this step in ''Open for Funding'' status?', 0, 0, 0),
(1438, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Edit Step', 'Edit Step', 0, 0, 0),
(1439, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s Form and Steps', '%s Form and Steps', 0, 0, 0),
(1440, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Form Field Steps List', 'Form Field Steps List', 0, 0, 0),
(1441, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Add New Field', 'Add New Field', 0, 0, 0),
(1442, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'User can edit this field in ''Open for Funding'' status?', 'User can edit this field in ''Open for Funding'' status?', 0, 0, 0),
(1443, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'If this field is only required based on the value of another field, enter the name of that field here, and the required value of that field below', 'If this field is only required based on the value of another field, enter the name of that field here, and the required value of that field below', 0, 0, 0),
(1444, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Depends Value', 'Depends Value', 0, 0, 0),
(1445, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Add More', 'Add More', 0, 0, 0),
(1446, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s description', '%s description', 0, 0, 0),
(1447, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s max user limit', '%s max user limit', 0, 0, 0),
(1448, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Maximum user allowed for this %s. Leave blank for no limit.', 'Maximum user allowed for this %s. Leave blank for no limit.', 0, 0, 0),
(1449, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Shipping', 'Shipping', 0, 0, 0),
(1450, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Additional Information', 'Additional Information', 0, 0, 0),
(1451, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'An input field will be generated in funding page to get information from the funders in the given name.', 'An input field will be generated in funding page to get information from the funders in the given name.', 0, 0, 0),
(1452, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Additional Information Label', 'Additional Information Label', 0, 0, 0),
(1453, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Minimum Amount: %s%s <br/> Maximum Amount: %s', 'Minimum Amount: %s%s <br/> Maximum Amount: %s', 0, 0, 0),
(1454, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Maximum allowed size ', 'Maximum allowed size ', 0, 0, 0),
(1455, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'You have', 'You have', 0, 0, 0),
(1456, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'characters left', 'characters left', 0, 0, 0),
(1457, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Needed amount', 'Needed amount', 0, 0, 0),
(1458, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Entered description will display in view page', 'Entered description will display in view page', 0, 0, 0),
(1459, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Opened for %s', 'Opened for %s', 0, 0, 0),
(1460, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Update Posted', 'Update Posted', 0, 0, 0),
(1461, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Commented on Update', 'Commented on Update', 0, 0, 0),
(1462, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Voted', 'Voted', 0, 0, 0),
(1463, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Commented on Project', 'Commented on Project', 0, 0, 0),
(1464, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Started Following', 'Started Following', 0, 0, 0),
(1465, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Unfollow User', 'Unfollow User', 0, 0, 0),
(1466, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Follow User', 'Follow User', 0, 0, 0),
(1467, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Unfollow Project', 'Unfollow Project', 0, 0, 0),
(1468, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Follow Project', 'Follow Project', 0, 0, 0),
(1469, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Vote(s)', 'Vote(s)', 0, 0, 0),
(1470, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'more..', 'more..', 0, 0, 0),
(1471, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'View update', 'View update', 0, 0, 0),
(1472, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'No activities available', 'No activities available', 0, 0, 0),
(1473, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Recent activity ', 'Recent activity ', 0, 0, 0),
(1474, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'update posted', 'update posted', 0, 0, 0),
(1475, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'commented on update', 'commented on update', 0, 0, 0),
(1476, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'voted', 'voted', 0, 0, 0),
(1477, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'commented on project', 'commented on project', 0, 0, 0),
(1478, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'started following', 'started following', 0, 0, 0),
(1479, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s canceled', '%s canceled', 0, 0, 0),
(1480, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, '%s rejected by Admin', '%s rejected by Admin', 0, 0, 0),
(1481, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'No activities found', 'No activities found', 0, 0, 0),
(1482, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'See all notifications', 'See all notifications', 0, 0, 0),
(1483, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Clear notification', 'Clear notification', 0, 0, 0),
(1484, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'following', 'following', 0, 0, 0),
(1485, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'Opened for voting', 'Opened for voting', 0, 0, 0),
(1486, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'To', 'To', 0, 0, 0),
(1487, '2013-07-29 18:04:13', '2013-07-29 18:04:13', 42, 'From', 'From', 0, 0, 0),
(1488, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Filter', 'Filter', 0, 0, 0),
(1489, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Subject', 'Subject', 0, 0, 0),
(1490, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Date', 'Date', 0, 0, 0),
(1491, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Unflagged', 'Unflagged', 0, 0, 0),
(1492, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Reply', 'Reply', 0, 0, 0),
(1493, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Private', 'Private', 0, 0, 0),
(1494, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Browse %s', 'Browse %s', 0, 0, 0),
(1495, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Your %s will appear here', 'Your %s will appear here', 0, 0, 0),
(1496, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'messages', 'messages', 0, 0, 0),
(1497, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Replied', 'Replied', 0, 0, 0),
(1498, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Sort:', 'Sort:', 0, 0, 0),
(1499, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Freshness', 'Freshness', 0, 0, 0),
(1500, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Descending', 'Descending', 0, 0, 0),
(1501, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Ascending', 'Ascending', 0, 0, 0),
(1502, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Compose', 'Compose', 0, 0, 0),
(1503, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Send', 'Send', 0, 0, 0),
(1504, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'No notifications available', 'No notifications available', 0, 0, 0),
(1505, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Star', 'Star', 0, 0, 0),
(1506, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Back to Starred', 'Back to Starred', 0, 0, 0),
(1507, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Archive', 'Archive', 0, 0, 0),
(1508, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Spam', 'Spam', 0, 0, 0),
(1509, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'star-select', 'star-select', 0, 0, 0),
(1510, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'me', 'me', 0, 0, 0),
(1511, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'show details', 'show details', 0, 0, 0),
(1512, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'date', 'date', 0, 0, 0),
(1513, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'at', 'at', 0, 0, 0),
(1514, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Me', 'Me', 0, 0, 0),
(1515, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Forward', 'Forward', 0, 0, 0),
(1516, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'attachments', 'attachments', 0, 0, 0),
(1517, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Download', 'Download', 0, 0, 0),
(1518, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Posted', 'Posted', 0, 0, 0),
(1519, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'private message for ', 'private message for ', 0, 0, 0),
(1520, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Login to view', 'Login to view', 0, 0, 0),
(1521, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Public message for all', 'Public message for all', 0, 0, 0),
(1522, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'View', 'View', 0, 0, 0),
(1523, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'view', 'view', 0, 0, 0),
(1524, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'More ', 'More ', 0, 0, 0),
(1525, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Show all %s', 'Show all %s', 0, 0, 0),
(1526, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'This voucher has been used', 'This voucher has been used', 0, 0, 0),
(1527, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, '%s name', '%s name', 0, 0, 0),
(1528, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Coupon code:', 'Coupon code:', 0, 0, 0),
(1529, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Recipient:', 'Recipient:', 0, 0, 0),
(1530, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Used on:', 'Used on:', 0, 0, 0),
(1531, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, '[Image: Project qr code]', '[Image: Project qr code]', 0, 0, 0),
(1532, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Mark as Given', 'Mark as Given', 0, 0, 0),
(1533, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Given', 'Given', 0, 0, 0),
(1534, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Not Given', 'Not Given', 0, 0, 0),
(1535, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'other %s.', 'other %s.', 0, 0, 0),
(1536, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'No %s chosen', 'No %s chosen', 0, 0, 0),
(1537, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Not given', 'Not given', 0, 0, 0),
(1538, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, '%s Now', '%s Now', 0, 0, 0),
(1539, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Funding ends', 'Funding ends', 0, 0, 0),
(1540, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Fund Amount', 'Fund Amount', 0, 0, 0),
(1541, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Selected %s', 'Selected %s', 0, 0, 0),
(1542, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, '[Image: Logo]', '[Image: Logo]', 0, 0, 0),
(1543, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Redeem At: ', 'Redeem At: ', 0, 0, 0),
(1544, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'On', 'On', 0, 0, 0),
(1545, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'How to use this:', 'How to use this:', 0, 0, 0),
(1546, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Present voucher upon arrival.', 'Present voucher upon arrival.', 0, 0, 0),
(1547, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Enjoy!', 'Enjoy!', 0, 0, 0),
(1548, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Map:', 'Map:', 0, 0, 0),
(1549, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Warning! please edit with caution. Changes in the form fields affect the existing %s also.', 'Warning! please edit with caution. Changes in the form fields affect the existing %s also.', 0, 0, 0),
(1550, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Label is the text that appears in the form for Project. Display Text is the text that appears in project view page. e.g., If Label is \\"Explain About Your Project\\", Display will be \\"About Project\\" or so.', 'Label is the text that appears in the form for Project. Display Text is the text that appears in project view page. e.g., If Label is \\"Explain About Your Project\\", Display will be \\"About Project\\" or so.', 0, 0, 0),
(1551, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Add Step', 'Add Step', 0, 0, 0),
(1552, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Expand/Collapse', 'Expand/Collapse', 0, 0, 0),
(1553, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Add Group', 'Add Group', 0, 0, 0),
(1554, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'No Groups Added.', 'No Groups Added.', 0, 0, 0),
(1555, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Label', 'Label', 0, 0, 0),
(1556, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Display Text', 'Display Text', 0, 0, 0),
(1557, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Info', 'Info', 0, 0, 0),
(1558, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Editable', 'Editable', 0, 0, 0),
(1559, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Fields', 'Fields', 0, 0, 0),
(1560, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, '[Image: Loading]', '[Image: Loading]', 0, 0, 0),
(1561, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Loading', 'Loading', 0, 0, 0),
(1562, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Loading...', 'Loading...', 0, 0, 0),
(1563, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Customize form fields and pricing for Modules/%s Types', 'Customize form fields and pricing for Modules/%s Types', 0, 0, 0),
(1564, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Pricing/Fee', 'Pricing/Fee', 0, 0, 0),
(1565, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, '%s Posted', '%s Posted', 0, 0, 0),
(1566, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Fund Commission %', 'Fund Commission %', 0, 0, 0),
(1567, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'If you select Fixed Funding %s fund will be captured only if it reached the needed amount. If you select Flexible Funding %s fund will be captured even if it does not reached the needed amount', 'If you select Fixed Funding %s fund will be captured only if it reached the needed amount. If you select Flexible Funding %s fund will be captured even if it does not reached the needed amount', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1568, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Next', 'Next', 0, 0, 0),
(1569, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Manage listing fee and funding commision details for this %s type. You can override the details here and this will be final.', 'Manage listing fee and funding commision details for this %s type. You can override the details here and this will be final.', 0, 0, 0),
(1570, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Global Settings', 'Global Settings', 0, 0, 0),
(1571, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Commission Percentage', 'Commission Percentage', 0, 0, 0),
(1572, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Commission collected if goal reached in both Flexible and Fixed Funding', 'Commission collected if goal reached in both Flexible and Fixed Funding', 0, 0, 0),
(1573, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Listing fee for projects in the site and you can set by percentage / amount. You have to create payment step in needed project type.', 'Listing fee for projects in the site and you can set by percentage / amount. You have to create payment step in needed project type.', 0, 0, 0),
(1574, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Listing Fee Type', 'Listing Fee Type', 0, 0, 0),
(1575, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Viewed By', 'Viewed By', 0, 0, 0),
(1576, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'View Type', 'View Type', 0, 0, 0),
(1577, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Have your company listed in AngelList?', 'Have your company listed in AngelList?', 0, 0, 0),
(1578, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Import from AngelList', 'Import from AngelList', 0, 0, 0),
(1579, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'delete', 'delete', 0, 0, 0),
(1580, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Admin actions', 'Admin actions', 0, 0, 0),
(1581, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Create', 'Create', 0, 0, 0),
(1582, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Project - ', 'Project - ', 0, 0, 0),
(1583, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'SEIS Detail', 'SEIS Detail', 0, 0, 0),
(1584, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Company Name', 'Company Name', 0, 0, 0),
(1585, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Number of Employee', 'Number of Employee', 0, 0, 0),
(1586, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Year of Founding', 'Year of Founding', 0, 0, 0),
(1587, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Submitted On: ', 'Submitted On: ', 0, 0, 0),
(1588, '2013-07-29 18:04:14', '2013-07-29 18:04:14', 42, 'Rejected On: ', 'Rejected On: ', 0, 0, 0),
(1589, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Updated On: ', 'Updated On: ', 0, 0, 0),
(1590, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Approved On: ', 'Approved On: ', 0, 0, 0),
(1591, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Done', 'Done', 0, 0, 0),
(1592, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'No Rewards added.', 'No Rewards added.', 0, 0, 0),
(1593, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Any', 'Any', 0, 0, 0),
(1594, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Minimum', 'Minimum', 0, 0, 0),
(1595, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Multiple', 'Multiple', 0, 0, 0),
(1596, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Minimum amount', 'Minimum amount', 0, 0, 0),
(1597, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Fixed amount', 'Fixed amount', 0, 0, 0),
(1598, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Denomination', 'Denomination', 0, 0, 0),
(1599, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Suggested amount', 'Suggested amount', 0, 0, 0),
(1600, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Information to User: ', 'Information to User: ', 0, 0, 0),
(1601, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Private Note: ', 'Private Note: ', 0, 0, 0),
(1602, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Trending Projects', 'Trending Projects', 0, 0, 0),
(1603, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, '''s project guidelines.', '''s project guidelines.', 0, 0, 0),
(1604, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Continue', 'Continue', 0, 0, 0),
(1605, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Vote for this?  ', 'Vote for this?  ', 0, 0, 0),
(1606, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'or', 'or', 0, 0, 0),
(1607, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Disabled. Reason: You can''t rate your own project.', 'Disabled. Reason: You can''t rate your own project.', 0, 0, 0),
(1608, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Disabled. Reason: You have already rated this project.', 'Disabled. Reason: You have already rated this project.', 0, 0, 0),
(1609, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Your %s Here', 'Your %s Here', 0, 0, 0),
(1610, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Sorry, no results for \\"%s\\"', 'Sorry, no results for \\"%s\\"', 0, 0, 0),
(1611, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'No projects available', 'No projects available', 0, 0, 0),
(1612, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'More %s %s', 'More %s %s', 0, 0, 0),
(1613, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Crowdfunding Options', 'Crowdfunding Options', 0, 0, 0),
(1614, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Payment Type', 'Payment Type', 0, 0, 0),
(1615, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Have idea? No money? Need someone to help? Start a project and use crowd power to raise funds.', 'Have idea? No money? Need someone to help? Start a project and use crowd power to raise funds.', 0, 0, 0),
(1616, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, '%s Owner Control Panel', '%s Owner Control Panel', 0, 0, 0),
(1617, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Stream', 'Stream', 0, 0, 0),
(1618, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'About the %s', 'About the %s', 0, 0, 0),
(1619, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Play', 'Play', 0, 0, 0),
(1620, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Share this %s with your friends', 'Share this %s with your friends', 0, 0, 0),
(1621, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Report %s', 'Report %s', 0, 0, 0),
(1622, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, ' Embed', ' Embed', 0, 0, 0),
(1623, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Embed Code', 'Embed Code', 0, 0, 0),
(1624, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, '[Image: Twitter]', '[Image: Twitter]', 0, 0, 0),
(1625, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'This %s in other websites', 'This %s in other websites', 0, 0, 0),
(1626, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'About %s', 'About %s', 0, 0, 0),
(1627, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Media and other files', 'Media and other files', 0, 0, 0),
(1628, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Other Details', 'Other Details', 0, 0, 0),
(1629, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'None specified', 'None specified', 0, 0, 0),
(1630, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'About this %s', 'About this %s', 0, 0, 0),
(1631, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, '%s location:', '%s location:', 0, 0, 0),
(1632, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Account', 'Account', 0, 0, 0),
(1633, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Security Questions', 'Security Questions', 0, 0, 0),
(1634, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Question', 'Question', 0, 0, 0),
(1635, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Security Question', 'Security Question', 0, 0, 0),
(1636, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'SEIS Scheme - Questionaire', 'SEIS Scheme - Questionaire', 0, 0, 0),
(1637, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'As per act you can''t add %s.', 'As per act you can''t add %s.', 0, 0, 0),
(1638, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Must be numeric', 'Must be numeric', 0, 0, 0),
(1639, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Seed Enterprise Investment Scheme (SEIS) Compliance', 'Seed Enterprise Investment Scheme (SEIS) Compliance', 0, 0, 0),
(1640, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Before starting project, check your compliance whether you are eligible or not under UK SEIS/EIS scheme.', 'Before starting project, check your compliance whether you are eligible or not under UK SEIS/EIS scheme.', 0, 0, 0),
(1641, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Number of Employees', 'Number of Employees', 0, 0, 0),
(1642, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Year Founded', 'Year Founded', 0, 0, 0),
(1643, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'The year your company was founded', 'The year your company was founded', 0, 0, 0),
(1644, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Total Asset ($)', 'Total Asset ($)', 0, 0, 0),
(1645, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'As per UK, Investor can avail tax relief for projects with SEIS compliance. This will attract more investors.', 'As per UK, Investor can avail tax relief for projects with SEIS compliance. This will attract more investors.', 0, 0, 0),
(1646, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'My Contacts', 'My Contacts', 0, 0, 0),
(1647, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'User Contact', 'User Contact', 0, 0, 0),
(1648, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Invite mail has been sent to selected contacts.', 'Invite mail has been sent to selected contacts.', 0, 0, 0),
(1649, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Please select atleast one contact to invite.', 'Please select atleast one contact to invite.', 0, 0, 0),
(1650, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Find Friends', 'Find Friends', 0, 0, 0),
(1651, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have connected %s successfully!', 'You have connected %s successfully!', 0, 0, 0),
(1652, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Your %s contact has been imported successfully!.', 'Your %s contact has been imported successfully!.', 0, 0, 0),
(1653, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'This social network account already connected by other user.', 'This social network account already connected by other user.', 0, 0, 0),
(1654, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'posted', 'posted', 0, 0, 0),
(1655, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'followed', 'followed', 0, 0, 0),
(1656, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Social', 'Social', 0, 0, 0),
(1657, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have disconnected from %s', 'You have disconnected from %s', 0, 0, 0),
(1658, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Checked users has been followed', 'Checked users has been followed', 0, 0, 0),
(1659, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Please select users to follow', 'Please select users to follow', 0, 0, 0),
(1660, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You are successfully following this user', 'You are successfully following this user', 0, 0, 0),
(1661, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'User could not be added as follower. Please, try again', 'User could not be added as follower. Please, try again', 0, 0, 0),
(1662, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'User could not be added as follower', 'User could not be added as follower', 0, 0, 0),
(1663, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You are already following this user', 'You are already following this user', 0, 0, 0),
(1664, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You can not follow yourself', 'You can not follow yourself', 0, 0, 0),
(1665, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have unfollowed this user', 'You have unfollowed this user', 0, 0, 0),
(1666, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'User Follower', 'User Follower', 0, 0, 0),
(1667, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Contact Name', 'Contact Name', 0, 0, 0),
(1668, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Contact E-mail', 'Contact E-mail', 0, 0, 0),
(1669, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'No contacts available', 'No contacts available', 0, 0, 0),
(1670, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, '[Image: Throbber]', '[Image: Throbber]', 0, 0, 0),
(1671, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Connecting %s. Please wait.', 'Connecting %s. Please wait.', 0, 0, 0),
(1672, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'If your browser doesn''t redirect you please %s to continue.', 'If your browser doesn''t redirect you please %s to continue.', 0, 0, 0),
(1673, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'We couldn''t find any of your friends from Facebook because you haven''t connected with Facebook. Click the button below to connect.', 'We couldn''t find any of your friends from Facebook because you haven''t connected with Facebook. Click the button below to connect.', 0, 0, 0),
(1674, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Find Friends From Facebook', 'Find Friends From Facebook', 0, 0, 0),
(1675, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'We couldn''t find any of your friends from Twitter because you haven''t connected with Twitter. Click the button below to connect.', 'We couldn''t find any of your friends from Twitter because you haven''t connected with Twitter. Click the button below to connect.', 0, 0, 0),
(1676, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Find Friends From Twitter', 'Find Friends From Twitter', 0, 0, 0),
(1677, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'We couldn''t find any of your friends from Gmail because you haven''t connected with Gmail. Click the button below to connect.', 'We couldn''t find any of your friends from Gmail because you haven''t connected with Gmail. Click the button below to connect.', 0, 0, 0),
(1678, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Find Friends From Gmail', 'Find Friends From Gmail', 0, 0, 0),
(1679, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'We couldn''t find any of your friends from Yahoo! because you haven''t connected with Yahoo. Click the button below to connect.', 'We couldn''t find any of your friends from Yahoo! because you haven''t connected with Yahoo. Click the button below to connect.', 0, 0, 0),
(1680, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Find Friends From Yahoo!', 'Find Friends From Yahoo!', 0, 0, 0),
(1681, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Find Friends From Yahoo', 'Find Friends From Yahoo', 0, 0, 0),
(1682, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Skip', 'Skip', 0, 0, 0),
(1683, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have already connected to Facebook.', 'You have already connected to Facebook.', 0, 0, 0),
(1684, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Disconnect from %s', 'Disconnect from %s', 0, 0, 0),
(1685, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Increase your reputation by showing Facebook friends count.', 'Increase your reputation by showing Facebook friends count.', 0, 0, 0),
(1686, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Connect with %s', 'Connect with %s', 0, 0, 0),
(1687, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have already connected to Twitter.', 'You have already connected to Twitter.', 0, 0, 0),
(1688, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Increase your reputation by showing Twitter followers count.', 'Increase your reputation by showing Twitter followers count.', 0, 0, 0),
(1689, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have already connected to Gmail.', 'You have already connected to Gmail.', 0, 0, 0),
(1690, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Increase your reputation by showing Google contacts count.', 'Increase your reputation by showing Google contacts count.', 0, 0, 0),
(1691, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have already connected to Google+.', 'You have already connected to Google+.', 0, 0, 0),
(1692, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Increase your reputation by showing Google+ contacts count.', 'Increase your reputation by showing Google+ contacts count.', 0, 0, 0),
(1693, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have already connected to Yahoo!.', 'You have already connected to Yahoo!.', 0, 0, 0),
(1694, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Yahoo', 'Yahoo', 0, 0, 0),
(1695, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Increase your reputation by showing Yahoo! contacts count.', 'Increase your reputation by showing Yahoo! contacts count.', 0, 0, 0),
(1696, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'You have already connected to LinkedIn.', 'You have already connected to LinkedIn.', 0, 0, 0),
(1697, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Increase your reputation by showing LinkedIn connections count.', 'Increase your reputation by showing LinkedIn connections count.', 0, 0, 0),
(1698, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Connect with Facebook', 'Connect with Facebook', 0, 0, 0),
(1699, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Please login to share in facebook', 'Please login to share in facebook', 0, 0, 0),
(1700, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Share about this %s on LinkedIn', 'Share about this %s on LinkedIn', 0, 0, 0),
(1701, '2013-07-29 18:04:15', '2013-07-29 18:04:15', 42, 'Share about this %s on ', 'Share about this %s on ', 0, 0, 0),
(1702, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Share about this %s on Pinterest', 'Share about this %s on Pinterest', 0, 0, 0),
(1703, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sudopay IPN Logs', 'Sudopay IPN Logs', 0, 0, 0),
(1704, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sudopay Transaction Logs', 'Sudopay Transaction Logs', 0, 0, 0),
(1705, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sudopay Transaction Log', 'Sudopay Transaction Log', 0, 0, 0),
(1706, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Amount added to wallet', 'Amount added to wallet', 0, 0, 0),
(1707, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Amount could not be added to wallet', 'Amount could not be added to wallet', 0, 0, 0),
(1708, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You have paid membership fee successfully. Once you verified your email and administrator approved your account will be activated.', 'You have paid membership fee successfully. Once you verified your email and administrator approved your account will be activated.', 0, 0, 0),
(1709, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You have paid membership fee successfully, will be activated once administrator approved', 'You have paid membership fee successfully, will be activated once administrator approved', 0, 0, 0),
(1710, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You have paid membership fee successfully. Now you can login with your %s after verified your email', 'You have paid membership fee successfully. Now you can login with your %s after verified your email', 0, 0, 0),
(1711, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You have paid membership fee successfully. Now you can login with your %s', 'You have paid membership fee successfully. Now you can login with your %s', 0, 0, 0),
(1712, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You have paid membership fee successfully.', 'You have paid membership fee successfully.', 0, 0, 0),
(1713, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment successfully completed', 'Payment successfully completed', 0, 0, 0),
(1714, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment Failed. Please, try again', 'Payment Failed. Please, try again', 0, 0, 0),
(1715, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, '%s have been synchronized', '%s have been synchronized', 0, 0, 0),
(1716, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'SudoPay Payment Gateways', 'SudoPay Payment Gateways', 0, 0, 0),
(1717, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Project Listing Fee', 'Project Listing Fee', 0, 0, 0),
(1718, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Signup Fee', 'Signup Fee', 0, 0, 0),
(1719, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Add to Wallet', 'Add to Wallet', 0, 0, 0),
(1720, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Added On', 'Added On', 0, 0, 0),
(1721, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Post Variable', 'Post Variable', 0, 0, 0),
(1722, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'SudoPay IPN Logs', 'SudoPay IPN Logs', 0, 0, 0),
(1723, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment', 'Payment', 0, 0, 0),
(1724, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Pay Key', 'Pay Key', 0, 0, 0),
(1725, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Merchant', 'Merchant', 0, 0, 0),
(1726, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Buyer Email', 'Buyer Email', 0, 0, 0),
(1727, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Buyer Address', 'Buyer Address', 0, 0, 0),
(1728, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'SudoPay Transaction Logs', 'SudoPay Transaction Logs', 0, 0, 0),
(1729, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Modified', 'Modified', 0, 0, 0),
(1730, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Class', 'Class', 0, 0, 0),
(1731, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment Id', 'Payment Id', 0, 0, 0),
(1732, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Merchant Id', 'Merchant Id', 0, 0, 0),
(1733, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Gateway Id', 'Gateway Id', 0, 0, 0),
(1734, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Gateway Name', 'Gateway Name', 0, 0, 0),
(1735, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment will have to be handled through transparent API calls. Your users will not see SudoPay branding.', 'Payment will have to be handled through transparent API calls. Your users will not see SudoPay branding.', 0, 0, 0),
(1736, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment will have to be handled through SudoPay payment button. Your users will visit sudopay.com and see SudoPay branding.', 'Payment will have to be handled through SudoPay payment button. Your users will visit sudopay.com and see SudoPay branding.', 0, 0, 0),
(1737, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Payment can either be handled through transparent API calls or SudoPay payment button. If using transparent API calls, your users will not see SudoPay branding.', 'Payment can either be handled through transparent API calls or SudoPay payment button. If using transparent API calls, your users will not see SudoPay branding.', 0, 0, 0),
(1738, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sync with SudoPay', 'Sync with SudoPay', 0, 0, 0),
(1739, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'This will fetch latest configurations (subscription plan & gateways) from sudopay.com.', 'This will fetch latest configurations (subscription plan & gateways) from sudopay.com.', 0, 0, 0),
(1740, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Subscription Plan', 'Subscription Plan', 0, 0, 0),
(1741, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Branding', 'Branding', 0, 0, 0),
(1742, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Enabled Gateways', 'Enabled Gateways', 0, 0, 0),
(1743, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Supported Actions', 'Supported Actions', 0, 0, 0),
(1744, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Supported Currencies', 'Supported Currencies', 0, 0, 0),
(1745, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'We have used \\"%s\\" in %s. So enable payment gateways with supporting \\"%s\\" actions in SudoPay.', 'We have used \\"%s\\" in %s. So enable payment gateways with supporting \\"%s\\" actions in SudoPay.', 0, 0, 0),
(1746, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Connected', 'Connected', 0, 0, 0),
(1747, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Connect', 'Connect', 0, 0, 0),
(1748, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Gateways', 'Gateways', 0, 0, 0),
(1749, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Donation Closed and Paid to %s', 'Donation Closed and Paid to %s', 0, 0, 0),
(1750, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'We will authorize the %s amount.  This amount will be captured only when the %s reaches the goal.', 'We will authorize the %s amount.  This amount will be captured only when the %s reaches the goal.', 0, 0, 0),
(1751, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Refunded due to Canceled', 'Refunded due to Canceled', 0, 0, 0),
(1752, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Voided due to Canceled', 'Voided due to Canceled', 0, 0, 0),
(1753, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Refunded due to Expired', 'Refunded due to Expired', 0, 0, 0),
(1754, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'All rights reserved', 'All rights reserved', 0, 0, 0),
(1755, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Switch to Standard View', 'Switch to Standard View', 0, 0, 0),
(1756, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Available for %s', 'Available for %s', 0, 0, 0),
(1757, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Vote for Ideas', 'Vote for Ideas', 0, 0, 0),
(1758, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'My Funds', 'My Funds', 0, 0, 0),
(1759, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'My Projects', 'My Projects', 0, 0, 0),
(1760, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Launching soon...', 'Launching soon...', 0, 0, 0),
(1761, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'We''re in private beta', 'We''re in private beta', 0, 0, 0),
(1762, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Subscribe', 'Subscribe', 0, 0, 0),
(1763, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Beta users ', 'Beta users ', 0, 0, 0),
(1764, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Continue Editing', 'Continue Editing', 0, 0, 0),
(1765, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sorry, no results for ', 'Sorry, no results for ', 0, 0, 0),
(1766, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Vote for ideas', 'Vote for ideas', 0, 0, 0),
(1767, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Logout', 'Logout', 0, 0, 0),
(1768, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You''re added to our list. You will receive email when site is ready.', 'You''re added to our list. You will receive email when site is ready.', 0, 0, 0),
(1769, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'to', 'to', 0, 0, 0),
(1770, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Redirecting you to authorize %s', 'Redirecting you to authorize %s', 0, 0, 0),
(1771, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Enter your Email, and we will send you instructions for resetting your password.', 'Enter your Email, and we will send you instructions for resetting your password.', 0, 0, 0),
(1772, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sign in with Facebook', 'Sign in with Facebook', 0, 0, 0),
(1773, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Password', 'Password', 0, 0, 0),
(1774, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Forgot your password?', 'Forgot your password?', 0, 0, 0),
(1775, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Must start with an alphabet. <br/> Must be minimum of 3 characters and <br/> Maximum of 20 characters <br/> No special characters and spaces allowed', 'Must start with an alphabet. <br/> Must be minimum of 3 characters and <br/> Maximum of 20 characters <br/> No special characters and spaces allowed', 0, 0, 0),
(1776, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Username', 'Username', 0, 0, 0),
(1777, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Password Confirmation', 'Password Confirmation', 0, 0, 0),
(1778, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, '[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]', '[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]', 0, 0, 0),
(1779, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'CAPTCHA image', 'CAPTCHA image', 0, 0, 0),
(1780, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Security Code', 'Security Code', 0, 0, 0),
(1781, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Terms & Conditions', 'Terms & Conditions', 0, 0, 0),
(1782, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'I have read, understood &amp; agree to the Terms & Conditions', 'I have read, understood &amp; agree to the Terms & Conditions', 0, 0, 0),
(1783, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Translations', 'Translations', 0, 0, 0),
(1784, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Are you sure you want to', 'Are you sure you want to', 0, 0, 0),
(1785, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Are you sure you want to do this action?', 'Are you sure you want to do this action?', 0, 0, 0),
(1786, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Invalid extension, Only csv, txt are allowed', 'Invalid extension, Only csv, txt are allowed', 0, 0, 0),
(1787, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'No Date Set', 'No Date Set', 0, 0, 0),
(1788, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Select date', 'Select date', 0, 0, 0),
(1789, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'No Time Set', 'No Time Set', 0, 0, 0),
(1790, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'You will be redirected to different site where you can buy this %s. Are you sure you want to move frome this site?', 'You will be redirected to different site where you can buy this %s. Are you sure you want to move frome this site?', 0, 0, 0),
(1791, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Are you sure you want to trigger cron to update %s status?', 'Are you sure you want to trigger cron to update %s status?', 0, 0, 0),
(1792, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Send message without a subject?', 'Send message without a subject?', 0, 0, 0),
(1793, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Are you sure you want to discard this message?', 'Are you sure you want to discard this message?', 0, 0, 0),
(1794, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Please select atleast one record!', 'Please select atleast one record!', 0, 0, 0),
(1795, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Suggested amount, amount should be in comma seperated', 'Suggested amount, amount should be in comma seperated', 0, 0, 0),
(1796, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Prev', 'Prev', 0, 0, 0),
(1797, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'January', 'January', 0, 0, 0),
(1798, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'February', 'February', 0, 0, 0),
(1799, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'March', 'March', 0, 0, 0),
(1800, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'April', 'April', 0, 0, 0),
(1801, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'May', 'May', 0, 0, 0),
(1802, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'June', 'June', 0, 0, 0),
(1803, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'July', 'July', 0, 0, 0),
(1804, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'August', 'August', 0, 0, 0),
(1805, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'September', 'September', 0, 0, 0),
(1806, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'October', 'October', 0, 0, 0),
(1807, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'November', 'November', 0, 0, 0),
(1808, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'December', 'December', 0, 0, 0),
(1809, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Jan', 'Jan', 0, 0, 0),
(1810, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Feb', 'Feb', 0, 0, 0),
(1811, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Mar', 'Mar', 0, 0, 0),
(1812, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Apr', 'Apr', 0, 0, 0),
(1813, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Jun', 'Jun', 0, 0, 0),
(1814, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Jul', 'Jul', 0, 0, 0),
(1815, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Aug', 'Aug', 0, 0, 0),
(1816, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sep', 'Sep', 0, 0, 0),
(1817, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Oct', 'Oct', 0, 0, 0),
(1818, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Nov', 'Nov', 0, 0, 0),
(1819, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Dec', 'Dec', 0, 0, 0),
(1820, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sunday', 'Sunday', 0, 0, 0),
(1821, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Monday', 'Monday', 0, 0, 0),
(1822, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Tuesday', 'Tuesday', 0, 0, 0),
(1823, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Wednesday', 'Wednesday', 0, 0, 0),
(1824, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Thursday', 'Thursday', 0, 0, 0),
(1825, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Friday', 'Friday', 0, 0, 0),
(1826, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Saturday', 'Saturday', 0, 0, 0),
(1827, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sun', 'Sun', 0, 0, 0),
(1828, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Mon', 'Mon', 0, 0, 0),
(1829, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Tue', 'Tue', 0, 0, 0),
(1830, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Wed', 'Wed', 0, 0, 0),
(1831, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Thu', 'Thu', 0, 0, 0),
(1832, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Fri', 'Fri', 0, 0, 0),
(1833, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Sat', 'Sat', 0, 0, 0),
(1834, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Su', 'Su', 0, 0, 0),
(1835, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Mo', 'Mo', 0, 0, 0),
(1836, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'Tu', 'Tu', 0, 0, 0),
(1837, '2013-07-29 18:04:16', '2013-07-29 18:04:16', 42, 'We', 'We', 0, 0, 0),
(1838, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Th', 'Th', 0, 0, 0),
(1839, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Fr', 'Fr', 0, 0, 0),
(1840, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'sa', 'sa', 0, 0, 0),
(1841, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Translation', 'Translation', 0, 0, 0),
(1842, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Language Variable', 'Language Variable', 0, 0, 0),
(1843, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Language variables', 'Language variables', 0, 0, 0),
(1844, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Add Translation', 'Add Translation', 0, 0, 0),
(1845, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Default English variable is missing', 'Default English variable is missing', 0, 0, 0),
(1846, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Translation could not be updated. Please check iso2 of this language and try again', 'Translation could not be updated. Please check iso2 of this language and try again', 0, 0, 0),
(1847, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Verified', 'Verified', 0, 0, 0),
(1848, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Unverified', 'Unverified', 0, 0, 0),
(1849, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'English', 'English', 0, 0, 0),
(1850, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'To Language', 'To Language', 0, 0, 0),
(1851, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'It will only populate site labels for selected new language. You need to manually enter all the equivalent translated labels.', 'It will only populate site labels for selected new language. You need to manually enter all the equivalent translated labels.', 0, 0, 0),
(1852, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'It will automatically translate site labels into selected language with Google. You may then edit necessary labels.', 'It will automatically translate site labels into selected language with Google. You may then edit necessary labels.', 0, 0, 0),
(1853, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Google Translate service is currently a paid service and you''d need API key to use it.', 'Google Translate service is currently a paid service and you''d need API key to use it.', 0, 0, 0),
(1854, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Please enter Google Translate API key in ', 'Please enter Google Translate API key in ', 0, 0, 0),
(1855, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, ' page', ' page', 0, 0, 0),
(1856, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Original', 'Original', 0, 0, 0),
(1857, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Sorry, in order to translate, default English strings should be extracted and available. Please contact support.', 'Sorry, in order to translate, default English strings should be extracted and available. Please contact support.', 0, 0, 0),
(1858, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, ' Make New Translation', ' Make New Translation', 0, 0, 0),
(1859, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, ' Add New Text', ' Add New Text', 0, 0, 0),
(1860, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Not Verified', 'Not Verified', 0, 0, 0),
(1861, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Delete Translation', 'Delete Translation', 0, 0, 0),
(1862, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.', 'If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.', 0, 0, 0),
(1863, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Translated', 'Translated', 0, 0, 0),
(1864, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Key', 'Key', 0, 0, 0),
(1865, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Lang Text', 'Lang Text', 0, 0, 0),
(1866, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Deduct Fund', 'Deduct Fund', 0, 0, 0),
(1867, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'User Add Wallet Amounts', 'User Add Wallet Amounts', 0, 0, 0),
(1868, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Deduct amount should be less than the available wallet amount', 'Deduct amount should be less than the available wallet amount', 0, 0, 0),
(1869, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Fund has been deducted', 'Fund has been deducted', 0, 0, 0),
(1870, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Fund could not be deducted. Please, try again.', 'Fund could not be deducted. Please, try again.', 0, 0, 0),
(1871, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Amount to Wallet', 'Amount to Wallet', 0, 0, 0),
(1872, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Please select payment type', 'Please select payment type', 0, 0, 0),
(1873, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Amount should be greater than Zero', 'Amount should be greater than Zero', 0, 0, 0),
(1874, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Available wallet amount: %s', 'Available wallet amount: %s', 0, 0, 0),
(1875, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Amount (%s)', 'Amount (%s)', 0, 0, 0),
(1876, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Add Fund', 'Add Fund', 0, 0, 0),
(1877, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '<i class=\\"icon-edit\\"></i><span class=\\"hide\\">Edit</span>', '<i class=\\"icon-edit\\"></i><span class=\\"hide\\">Edit</span>', 0, 0, 0),
(1878, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Your current available balance:', 'Your current available balance:', 0, 0, 0),
(1879, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Minimum Amount: %s <br/> Maximum Amount: %s', 'Minimum Amount: %s <br/> Maximum Amount: %s', 0, 0, 0),
(1880, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Withdraw Fund Request', 'Withdraw Fund Request', 0, 0, 0),
(1881, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'User Cash Withdrawals', 'User Cash Withdrawals', 0, 0, 0),
(1882, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Money Transfer Accounts', 'Money Transfer Accounts', 0, 0, 0),
(1883, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Primary money transfer account has been updated', 'Primary money transfer account has been updated', 0, 0, 0),
(1884, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Fund Withdraw', 'Fund Withdraw', 0, 0, 0),
(1885, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Checked requests have been moved to rejected status, Refunded  Money to Wallet', 'Checked requests have been moved to rejected status, Refunded  Money to Wallet', 0, 0, 0),
(1886, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Approve...', 'Approve...', 0, 0, 0),
(1887, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Given amount is greater than wallet amount', 'Given amount is greater than wallet amount', 0, 0, 0),
(1888, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'User Withdraw Requests', 'User Withdraw Requests', 0, 0, 0),
(1889, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Admin will send the amount to any one of the below account', 'Admin will send the amount to any one of the below account', 0, 0, 0),
(1890, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Enter any bank detail, paypal account detail etc.,', 'Enter any bank detail, paypal account detail etc.,', 0, 0, 0),
(1891, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Primary', 'Primary', 0, 0, 0),
(1892, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Make as primary', 'Make as primary', 0, 0, 0),
(1893, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'The requested amount will be deducted from your wallet and the amount will be blocked until it get approved or rejected by the administrator. Once its approved, the requested amount will be sent to your PayPal account. In case of failure, the amount will be refunded to your wallet.', 'The requested amount will be deducted from your wallet and the amount will be blocked until it get approved or rejected by the administrator. Once its approved, the requested amount will be sent to your PayPal account. In case of failure, the amount will be refunded to your wallet.', 0, 0, 0),
(1894, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Minimum withdraw amount: %s <br/> Maximum withdraw amount: %s', 'Minimum withdraw amount: %s <br/> Maximum withdraw amount: %s', 0, 0, 0),
(1895, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Following withdrawal request has been submitted to payment gateway API, These are waiting for IPN from the payment gateway API. Either it will move to Success or Failed', 'Following withdrawal request has been submitted to payment gateway API, These are waiting for IPN from the payment gateway API. Either it will move to Success or Failed', 0, 0, 0),
(1896, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Withdraw Requested Date', 'Withdraw Requested Date', 0, 0, 0),
(1897, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Primary Account:', 'Primary Account:', 0, 0, 0),
(1898, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Other Accounts:', 'Other Accounts:', 0, 0, 0),
(1899, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Withdrawal Status ', 'Withdrawal Status ', 0, 0, 0),
(1900, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Remark', 'Remark', 0, 0, 0),
(1901, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, ' Money Transfer Accounts', ' Money Transfer Accounts', 0, 0, 0),
(1902, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Your money transfer account is empty, so click here to update money transfer account.', 'Your money transfer account is empty, so click here to update money transfer account.', 0, 0, 0),
(1903, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Save', 'Save', 0, 0, 0),
(1904, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Add Attachment', 'Add Attachment', 0, 0, 0),
(1905, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'URL', 'URL', 0, 0, 0),
(1906, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Current User Information', 'Current User Information', 0, 0, 0),
(1907, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Your IP: ', 'Your IP: ', 0, 0, 0),
(1908, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Your Hostname: ', 'Your Hostname: ', 0, 0, 0),
(1909, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Ban Type', 'Ban Type', 0, 0, 0),
(1910, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Possibilities:', 'Possibilities:', 0, 0, 0),
(1911, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- Single IP/Hostname: Fill in either a hostname or IP address in the first field.', '- Single IP/Hostname: Fill in either a hostname or IP address in the first field.', 0, 0, 0),
(1912, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- IP Range: Put the starting IP address in the left and the ending IP address in the right field.', '- IP Range: Put the starting IP address in the left and the ending IP address in the right field.', 0, 0, 0),
(1913, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- Referer block: To block google.com put google.com in the first field. To block google altogether.', '- Referer block: To block google.com put google.com in the first field. To block google altogether.', 0, 0, 0),
(1914, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Select method', 'Select method', 0, 0, 0),
(1915, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Address/Range', 'Address/Range', 0, 0, 0),
(1916, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '(IP address, domain or hostname)', '(IP address, domain or hostname)', 0, 0, 0),
(1917, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Ban Details', 'Ban Details', 0, 0, 0),
(1918, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Reason', 'Reason', 0, 0, 0),
(1919, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '(optional, shown to victim)', '(optional, shown to victim)', 0, 0, 0),
(1920, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Redirect', 'Redirect', 0, 0, 0),
(1921, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '(optional)', '(optional)', 0, 0, 0),
(1922, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'How long', 'How long', 0, 0, 0),
(1923, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Leave field empty when using permanent. Fill in a number higher than 0 when using another option!', 'Leave field empty when using permanent. Fill in a number higher than 0 when using another option!', 0, 0, 0),
(1924, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Hints and tips:', 'Hints and tips:', 0, 0, 0),
(1925, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- Banning hosts in the 10.x.x.x / 169.254.x.x / 172.16.x.x or 192.168.x.x range probably won''t work.', '- Banning hosts in the 10.x.x.x / 169.254.x.x / 172.16.x.x or 192.168.x.x range probably won''t work.', 0, 0, 0),
(1926, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- Banning by internet hostname might work unexpectedly and resulting in banning multiple people from the same ISP!', '- Banning by internet hostname might work unexpectedly and resulting in banning multiple people from the same ISP!', 0, 0, 0),
(1927, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- Wildcards on IP addresses are allowed. Block 84.234.*.* to block the whole 84.234.x.x range!', '- Wildcards on IP addresses are allowed. Block 84.234.*.* to block the whole 84.234.x.x range!', 0, 0, 0),
(1928, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- Setting a ban on a range of IP addresses might work unexpected and can result in false positives!', '- Setting a ban on a range of IP addresses might work unexpected and can result in false positives!', 0, 0, 0),
(1929, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- An IP address always contains 4 parts with numbers no higher than 254 separated by a dot!', '- An IP address always contains 4 parts with numbers no higher than 254 separated by a dot!', 0, 0, 0),
(1930, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, '- If a ban does not seem to work try to find out if the person you''re trying to ban doesn''t use <a href=\\"http://en.wikipedia.org/wiki/DHCP\\" target=\\"_blank\\" title=\\"DHCP\\">DHCP.</a>', '- If a ban does not seem to work try to find out if the person you''re trying to ban doesn''t use <a href=\\"http://en.wikipedia.org/wiki/DHCP\\" target=\\"_blank\\" title=\\"DHCP\\">DHCP.</a>', 0, 0, 0),
(1931, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Victims', 'Victims', 0, 0, 0),
(1932, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Redirect to', 'Redirect to', 0, 0, 0),
(1933, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Date Set', 'Date Set', 0, 0, 0),
(1934, '2013-07-29 18:04:17', '2013-07-29 18:04:17', 42, 'Expiry Date', 'Expiry Date', 0, 0, 0),
(1935, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Never', 'Never', 0, 0, 0),
(1936, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'unique name for your block', 'unique name for your block', 0, 0, 0),
(1937, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'if you are not sure, choose ''none''', 'if you are not sure, choose ''none''', 0, 0, 0),
(1938, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Warning! Please edit with caution.', 'Warning! Please edit with caution.', 0, 0, 0),
(1939, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Users Engagement', 'Users Engagement', 0, 0, 0),
(1940, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Idle', 'Idle', 0, 0, 0),
(1941, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Funded ', 'Funded ', 0, 0, 0),
(1942, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Posted ', 'Posted ', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1943, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Engaged', 'Engaged', 0, 0, 0),
(1944, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Latitude', 'Latitude', 0, 0, 0),
(1945, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Longitude', 'Longitude', 0, 0, 0),
(1946, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Timezone', 'Timezone', 0, 0, 0),
(1947, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'County', 'County', 0, 0, 0),
(1948, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Code', 'Code', 0, 0, 0),
(1949, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'You can not change default city name.', 'You can not change default city name.', 0, 0, 0),
(1950, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'No cities available', 'No cities available', 0, 0, 0),
(1951, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Comment on', 'Comment on', 0, 0, 0),
(1952, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'First Name', 'First Name', 0, 0, 0),
(1953, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Last Name', 'Last Name', 0, 0, 0),
(1954, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Telephone', 'Telephone', 0, 0, 0),
(1955, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Reload CAPTCHA', 'Reload CAPTCHA', 0, 0, 0),
(1956, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Click to play', 'Click to play', 0, 0, 0),
(1957, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Currency', 'Currency', 0, 0, 0),
(1958, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Vote Now', 'Vote Now', 0, 0, 0),
(1959, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '+1 votes', '+1 votes', 0, 0, 0),
(1960, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '+2 votes', '+2 votes', 0, 0, 0),
(1961, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '+3 votes', '+3 votes', 0, 0, 0),
(1962, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '+4 votes', '+4 votes', 0, 0, 0),
(1963, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '+5 votes', '+5 votes', 0, 0, 0),
(1964, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'User Logins (%s)', 'User Logins (%s)', 0, 0, 0),
(1965, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Resend Activation', 'Resend Activation', 0, 0, 0),
(1966, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Change password', 'Change password', 0, 0, 0),
(1967, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '[Image: kickstarter.com, fundrazr.com, fundedbyme.com, indiegogo.com, gofundme.com, rockethub.com, microryza.com, fundly.com, fondomat.com, funding4learning.com, rockthepost.com, artistshare.com, sellaband.com, giveforward.com, en.headstart.co.il, offbeatr.com, petridish.org, youcaring.com, bountysource.com, rally.org, mobcaster.com, crowdcube.com, earlyshares.com, banktothefuture.com, bolstr.com]', '[Image: kickstarter.com, fundrazr.com, fundedbyme.com, indiegogo.com, gofundme.com, rockethub.com, microryza.com, fundly.com, fondomat.com, funding4learning.com, rockthepost.com, artistshare.com, sellaband.com, giveforward.com, en.headstart.co.il, offbeatr.com, petridish.org, youcaring.com, bountysource.com, rally.org, mobcaster.com, crowdcube.com, earlyshares.com, banktothefuture.com, bolstr.com]', 0, 0, 0),
(1968, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'kickstarter.com, fundrazr.com, fundedbyme.com, indiegogo.com, gofundme.com, rockethub.com, microryza.com, fundly.com, fondomat.com, funding4learning.com, rockthepost.com, artistshare.com, sellaband.com, giveforward.com, en.headstart.co.il, offbeatr.com, petridish.org, youcaring.com, bountysource.com, rally.org, mobcaster.com, crowdcube.com, earlyshares.com, banktothefuture.com, bolstr.com', 'kickstarter.com, fundrazr.com, fundedbyme.com, indiegogo.com, gofundme.com, rockethub.com, microryza.com, fundly.com, fondomat.com, funding4learning.com, rockthepost.com, artistshare.com, sellaband.com, giveforward.com, en.headstart.co.il, offbeatr.com, petridish.org, youcaring.com, bountysource.com, rally.org, mobcaster.com, crowdcube.com, earlyshares.com, banktothefuture.com, bolstr.com', 0, 0, 0),
(1969, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'said on %s', 'said on %s', 0, 0, 0),
(1970, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Add new comment', 'Add new comment', 0, 0, 0),
(1971, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Go back to original post', 'Go back to original post', 0, 0, 0),
(1972, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Website', 'Website', 0, 0, 0),
(1973, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Support', 'Support', 0, 0, 0),
(1974, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'on', 'on', 0, 0, 0),
(1975, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Posted in', 'Posted in', 0, 0, 0),
(1976, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Leave a comment', 'Leave a comment', 0, 0, 0),
(1977, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', 0, 0, 0),
(1978, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Joined:', 'Joined:', 0, 0, 0),
(1979, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Ideas Posted', 'Ideas Posted', 0, 0, 0),
(1980, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'View Site', 'View Site', 0, 0, 0),
(1981, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'For manually trigger the corn to update the project status, also to update daily status.', 'For manually trigger the corn to update the project status, also to update daily status.', 0, 0, 0),
(1982, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'My Account', 'My Account', 0, 0, 0),
(1983, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, ' plugin is currently enabled. You can disable it from ', ' plugin is currently enabled. You can disable it from ', 0, 0, 0),
(1984, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'plugins', 'plugins', 0, 0, 0),
(1985, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Commission percentage will be calculated from admin commission', 'Commission percentage will be calculated from admin commission', 0, 0, 0),
(1986, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Back to Settings', 'Back to Settings', 0, 0, 0),
(1987, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'To reflect changes, you need to %s.', 'To reflect changes, you need to %s.', 0, 0, 0),
(1988, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'clear cache', 'clear cache', 0, 0, 0),
(1989, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '(eg. \\"displayname &lt;email address>\\")', '(eg. \\"displayname &lt;email address>\\")', 0, 0, 0),
(1990, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Email HTML Content', 'Email HTML Content', 0, 0, 0),
(1991, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'No e-mail templates added yet.', 'No e-mail templates added yet.', 0, 0, 0),
(1992, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Page not found', 'Page not found', 0, 0, 0),
(1993, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Error', 'Error', 0, 0, 0),
(1994, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'The requested address was not found on this server.', 'The requested address was not found on this server.', 0, 0, 0),
(1995, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Security Error', 'Security Error', 0, 0, 0),
(1996, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Friend', 'Friend', 0, 0, 0),
(1997, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'refunded', 'refunded', 0, 0, 0),
(1998, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Stars', 'Stars', 0, 0, 0),
(1999, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '%s Type Builder', '%s Type Builder', 0, 0, 0),
(2000, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '%s Form and Pricing for Types', '%s Form and Pricing for Types', 0, 0, 0),
(2001, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Customize %s form and pricing for %s, Donate, Lending and Equity', 'Customize %s form and pricing for %s, Donate, Lending and Equity', 0, 0, 0),
(2002, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Theme Manager', 'Theme Manager', 0, 0, 0),
(2003, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Manage your site themes', 'Manage your site themes', 0, 0, 0),
(2004, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'CMS Builder', 'CMS Builder', 0, 0, 0),
(2005, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Contents', 'Contents', 0, 0, 0),
(2006, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Blocks are reusable chunks for contents', 'Blocks are reusable chunks for contents', 0, 0, 0),
(2007, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Menus for CMS contents', 'Menus for CMS contents', 0, 0, 0),
(2008, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Settings Overview', 'Settings Overview', 0, 0, 0),
(2009, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Auto detected', 'Auto detected', 0, 0, 0),
(2010, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'ISO2', 'ISO2', 0, 0, 0),
(2011, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'ISO3', 'ISO3', 0, 0, 0),
(2012, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Fund &amp; Support Creative %s.', 'Fund &amp; Support Creative %s.', 0, 0, 0),
(2013, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Need Fund? ', 'Need Fund? ', 0, 0, 0),
(2014, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'You are logged in as Admin', 'You are logged in as Admin', 0, 0, 0),
(2015, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Touch', 'Touch', 0, 0, 0),
(2016, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, '[Image:Touch]', '[Image:Touch]', 0, 0, 0),
(2017, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'RSS feed', 'RSS feed', 0, 0, 0),
(2018, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Like and follow us to get priority access', 'Like and follow us to get priority access', 0, 0, 0),
(2019, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Help us out. Spread the world!', 'Help us out. Spread the world!', 0, 0, 0),
(2020, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Misc.', 'Misc.', 0, 0, 0),
(2021, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Parent', 'Parent', 0, 0, 0),
(2022, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, ' Link to a Node', ' Link to a Node', 0, 0, 0),
(2023, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Link to a Node', 'Link to a Node', 0, 0, 0),
(2024, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Publish?', 'Publish?', 0, 0, 0),
(2025, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Tooltip', 'Tooltip', 0, 0, 0),
(2026, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Move Up', 'Move Up', 0, 0, 0),
(2027, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Move Down', 'Move Down', 0, 0, 0),
(2028, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Link Count', 'Link Count', 0, 0, 0),
(2029, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'View links', 'View links', 0, 0, 0),
(2030, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Create Content - ', 'Create Content - ', 0, 0, 0),
(2031, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'SEO', 'SEO', 0, 0, 0),
(2032, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Publishing', 'Publishing', 0, 0, 0),
(2033, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Body', 'Body', 0, 0, 0),
(2034, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Read only', 'Read only', 0, 0, 0),
(2035, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Read/Write', 'Read/Write', 0, 0, 0),
(2036, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Meta Keywords', 'Meta Keywords', 0, 0, 0),
(2037, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Meta Description', 'Meta Description', 0, 0, 0),
(2038, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Apply', 'Apply', 0, 0, 0),
(2039, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Edit Content', 'Edit Content', 0, 0, 0),
(2040, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Terminologies used in this CMS are synonymous with Drupal', 'Terminologies used in this CMS are synonymous with Drupal', 0, 0, 0),
(2041, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'When cron is not working, you may trigger it by clicking below link. For the processes that happen during a cron run, refer the ', 'When cron is not working, you may trigger it by clicking below link. For the processes that happen during a cron run, refer the ', 0, 0, 0),
(2042, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Manually trigger cron to update %s status', 'Manually trigger cron to update %s status', 0, 0, 0),
(2043, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'You can use this to update %s status. This will be used in the scenario where cron is not working.', 'You can use this to update %s status. This will be used in the scenario where cron is not working.', 0, 0, 0),
(2044, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Manually trigger cron to update daily status', 'Manually trigger cron to update daily status', 0, 0, 0),
(2045, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'You can use this to update, User''s Social connect status and sending subscription mail. This will be used in the scenario where cron is not working.', 'You can use this to update, User''s Social connect status and sending subscription mail. This will be used in the scenario where cron is not working.', 0, 0, 0),
(2046, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Translate in a new language', 'Translate in a new language', 0, 0, 0),
(2047, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Locale', 'Locale', 0, 0, 0),
(2048, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Are you sure?', 'Are you sure?', 0, 0, 0),
(2049, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'No translations available.', 'No translations available.', 0, 0, 0),
(2050, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Plenty of creative minds, many solutions, Graphic design, Industrial design and many more ...', 'Plenty of creative minds, many solutions, Graphic design, Industrial design and many more ...', 0, 0, 0),
(2051, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Step1', 'Step1', 0, 0, 0),
(2052, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Client creates a contest for particular design and submits brief.', 'Client creates a contest for particular design and submits brief.', 0, 0, 0),
(2053, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Tell me more', 'Tell me more', 0, 0, 0),
(2054, '2013-07-29 18:04:18', '2013-07-29 18:04:18', 42, 'Step2', 'Step2', 0, 0, 0),
(2055, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Designers submit the designs to particular contest. Client gives feedback and rates the designs', 'Designers submit the designs to particular contest. Client gives feedback and rates the designs', 0, 0, 0),
(2056, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Step3', 'Step3', 0, 0, 0),
(2057, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Submission closes. Client reviews highest rated designs. Designers can vote for one design per contest, other than their own design.', 'Submission closes. Client reviews highest rated designs. Designers can vote for one design per contest, other than their own design.', 0, 0, 0),
(2058, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Step4', 'Step4', 0, 0, 0),
(2059, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Client chooses winning entry. Designer gets awarded.', 'Client chooses winning entry. Designer gets awarded.', 0, 0, 0),
(2060, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'No items found.', 'No items found.', 0, 0, 0),
(2061, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Test Mode?', 'Test Mode?', 0, 0, 0),
(2062, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Enable for %s listing', 'Enable for %s listing', 0, 0, 0),
(2063, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Enable for %s', 'Enable for %s', 0, 0, 0),
(2064, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Enable for add to wallet', 'Enable for add to wallet', 0, 0, 0),
(2065, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Enable for sign up fee', 'Enable for sign up fee', 0, 0, 0),
(2066, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Payment Details', 'Payment Details', 0, 0, 0),
(2067, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, ' and PayPal suggests that we use Adaptive Payment API with primary receiver set to %s (not Site) for chargeback responsibility reasons. Violating these instructions may lead to account seizure from PayPal. So, we''ve used PayPal Adaptive preapproval and chained API. In this workflow, amount will be authorized (not captured) from %s once he %s. After the goal reached/tipping point, the %s amount will be charged/captured; site fee/commission will also be charged at this time from %s.', ' and PayPal suggests that we use Adaptive Payment API with primary receiver set to %s (not Site) for chargeback responsibility reasons. Violating these instructions may lead to account seizure from PayPal. So, we''ve used PayPal Adaptive preapproval and chained API. In this workflow, amount will be authorized (not captured) from %s once he %s. After the goal reached/tipping point, the %s amount will be charged/captured; site fee/commission will also be charged at this time from %s.', 0, 0, 0),
(2068, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'As per the information we received from PayPal, websites should never aggregate money from users (i.e., have wallet option)%s', 'As per the information we received from PayPal, websites should never aggregate money from users (i.e., have wallet option)%s', 0, 0, 0),
(2069, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Caveat of this workflow: %s has an option in his PayPal account to cancel preapproval payments. If he does so, this software detects it through PayPal IPN and cancels the %s with ''Voided'' status. But, this may give room for unstable %s. Also, if %s doesn''t have enough balance in the final settlement (when site tries to charge on tipping point), it may fail.', 'Caveat of this workflow: %s has an option in his PayPal account to cancel preapproval payments. If he does so, this software detects it through PayPal IPN and cancels the %s with ''Voided'' status. But, this may give room for unstable %s. Also, if %s doesn''t have enough balance in the final settlement (when site tries to charge on tipping point), it may fail.', 0, 0, 0),
(2070, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '<em>However</em>, we understand that some sites have Wallet option through special relationships with PayPal. But, we <em>seriously</em> warn you not to enable Wallet when using PayPal. In this software, Wallet option is provided as a provision to integrate other payment gateway solutions.', '<em>However</em>, we understand that some sites have Wallet option through special relationships with PayPal. But, we <em>seriously</em> warn you not to enable Wallet when using PayPal. In this software, Wallet option is provided as a provision to integrate other payment gateway solutions.', 0, 0, 0),
(2071, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '--Agriya', '--Agriya', 0, 0, 0),
(2072, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Site cannot work with \\"Wallet\\" option alone. This is added as a provision to integrate other payment gateway solutions.', 'Site cannot work with \\"Wallet\\" option alone. This is added as a provision to integrate other payment gateway solutions.', 0, 0, 0),
(2073, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Read the warning carefully and enable appropriate options for your website.', 'Read the warning carefully and enable appropriate options for your website.', 0, 0, 0),
(2074, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Display Name', 'Display Name', 0, 0, 0),
(2075, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Where to use?', 'Where to use?', 0, 0, 0),
(2076, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Sign Up Fee', 'Sign Up Fee', 0, 0, 0),
(2077, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'preapproval,', 'preapproval,', 0, 0, 0),
(2078, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'chained and ', 'chained and ', 0, 0, 0),
(2079, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here, %s %s simple API %s used. Refer the above warning for the caveats.', 'Here, %s %s simple API %s used. Refer the above warning for the caveats.', 0, 0, 0),
(2080, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Credit Card Expire', 'Credit Card Expire', 0, 0, 0),
(2081, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '%s with Wallet', '%s with Wallet', 0, 0, 0),
(2082, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Your available balance:', 'Your available balance:', 0, 0, 0),
(2083, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Pay with Wallet', 'Pay with Wallet', 0, 0, 0),
(2084, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Pay Now', 'Pay Now', 0, 0, 0),
(2085, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Add Region', 'Add Region', 0, 0, 0),
(2086, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Site mode is changing from %s to %s.  Please click \\"Ok\\" button to send invitation mail immediately to subscribed users or click \\"Cancel\\" button to send invitation mail through cron.', 'Site mode is changing from %s to %s.  Please click \\"Ok\\" button to send invitation mail immediately to subscribed users or click \\"Cancel\\" button to send invitation mail through cron.', 0, 0, 0),
(2087, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Ok', 'Ok', 0, 0, 0),
(2088, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Setting Category', 'Setting Category', 0, 0, 0),
(2089, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Plugin Name', 'Plugin Name', 0, 0, 0),
(2090, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Test Connection', 'Test Connection', 0, 0, 0),
(2091, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Delete?', 'Delete?', 0, 0, 0),
(2092, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Configuration steps:', 'Configuration steps:', 0, 0, 0),
(2093, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '1. To get your security credentials, login with amazon and go to <a target=\\"blank\\" href=\\"https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials\\">https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials</a><br>2. To create bucket name go to <a target=\\"blank\\" href=\\"https://console.aws.amazon.com/s3/home\\">https://console.aws.amazon.com/s3/home</a> and click s3 link.', '1. To get your security credentials, login with amazon and go to <a target=\\"blank\\" href=\\"https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials\\">https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials</a><br>2. To create bucket name go to <a target=\\"blank\\" href=\\"https://console.aws.amazon.com/s3/home\\">https://console.aws.amazon.com/s3/home</a> and click s3 link.', 0, 0, 0),
(2094, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '1. Create a CloudFlare account, configure the domain and change DNS.', '1. Create a CloudFlare account, configure the domain and change DNS.', 0, 0, 0),
(2095, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '2. To create token please refer ', '2. To create token please refer ', 0, 0, 0),
(2096, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '3. Create three page rules like /, /project/*, /user/* in this link', '3. Create three page rules like /, /project/*, /user/* in this link', 0, 0, 0),
(2097, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '. Note: Please select ''Cache Everything'' option for ''Custom Caching'' setting.', '. Note: Please select ''Cache Everything'' option for ''Custom Caching'' setting.', 0, 0, 0),
(2098, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '4. Update your CloudFlare Email and Token and enable CloudFlare option here.', '4. Update your CloudFlare Email and Token and enable CloudFlare option here.', 0, 0, 0),
(2099, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '5. Minimum cache timing for free users will be 30 minutes. Only enterprise users can reduce upto 30 seconds.', '5. Minimum cache timing for free users will be 30 minutes. Only enterprise users can reduce upto 30 seconds.', 0, 0, 0),
(2100, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'You can configure SMTP server by any one of the followings Amazon SES, Sendgrid, Mandrill, Gmail and your own host SMTP settings', 'You can configure SMTP server by any one of the followings Amazon SES, Sendgrid, Mandrill, Gmail and your own host SMTP settings', 0, 0, 0),
(2101, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '1. Amazon SES: To get your security credentials, login with amazon and go to <a target=\\"blank\\" href=\\"https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials\\">https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials</a> . To create your smtp username password go to <a target=\\"blank\\" href=\\"https://console.aws.amazon.com/ses/home#smtp-settings\\">https://console.aws.amazon.com/ses/home#smtp-settings</a>', '1. Amazon SES: To get your security credentials, login with amazon and go to <a target=\\"blank\\" href=\\"https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials\\">https://portal.aws.amazon.com/gp/aws/securityCredentials#access_credentials</a> . To create your smtp username password go to <a target=\\"blank\\" href=\\"https://console.aws.amazon.com/ses/home#smtp-settings\\">https://console.aws.amazon.com/ses/home#smtp-settings</a>', 0, 0, 0),
(2102, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '2. Sendgrid: To get your security credentials, refer <a target=\\"blank\\" href=\\"http://sendgrid.com/docs/Integrate/index.html\\">http://sendgrid.com/docs/Integrate/index.html</a>', '2. Sendgrid: To get your security credentials, refer <a target=\\"blank\\" href=\\"http://sendgrid.com/docs/Integrate/index.html\\">http://sendgrid.com/docs/Integrate/index.html</a>', 0, 0, 0),
(2103, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '3. Mandrill:  To get your security credentials, login with Mandrill and go to <a target=\\"blank\\" href=\\"https://mandrillapp.com/settings\\">https://mandrillapp.com/settings</a>', '3. Mandrill:  To get your security credentials, login with Mandrill and go to <a target=\\"blank\\" href=\\"https://mandrillapp.com/settings\\">https://mandrillapp.com/settings</a>', 0, 0, 0),
(2104, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '4. Gmail: To use gmail please refer <a target=\\"blank\\" href=\\"http://gmailsmtpsettings.com/gmail-smtp-settings\\">http://gmailsmtpsettings.com/gmail-smtp-settings</a>', '4. Gmail: To use gmail please refer <a target=\\"blank\\" href=\\"http://gmailsmtpsettings.com/gmail-smtp-settings\\">http://gmailsmtpsettings.com/gmail-smtp-settings</a>', 0, 0, 0),
(2105, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '1. Amazon CloudFront: To setup Amazon CloudFront CDN please follow the step mentioned in this <a target=\\"blank\\" href=\\"http://aws.amazon.com/console/#cf\\">http://aws.amazon.com/console/#cf</a> and watch this screencast <a href=\\"http://d36cz9buwru1tt.cloudfront.net/videos/console/cloudfront_console_4.html\\" target=\\"blank\\">http://d36cz9buwru1tt.cloudfront.net/videos/console/cloudfront_console_4.html</a>', '1. Amazon CloudFront: To setup Amazon CloudFront CDN please follow the step mentioned in this <a target=\\"blank\\" href=\\"http://aws.amazon.com/console/#cf\\">http://aws.amazon.com/console/#cf</a> and watch this screencast <a href=\\"http://d36cz9buwru1tt.cloudfront.net/videos/console/cloudfront_console_4.html\\" target=\\"blank\\">http://d36cz9buwru1tt.cloudfront.net/videos/console/cloudfront_console_4.html</a>', 0, 0, 0),
(2106, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '2. CloudFlare: To setup CloudFlare please follow the step mentioned in this link <a href=\\"https://support.cloudflare.com/entries/22054357-How-do-I-do-CNAME-setup-\\" target=\\"blank\\">https://support.cloudflare.com/entries/22054357-How-do-I-do-CNAME-setup-</a>', '2. CloudFlare: To setup CloudFlare please follow the step mentioned in this link <a href=\\"https://support.cloudflare.com/entries/22054357-How-do-I-do-CNAME-setup-\\" target=\\"blank\\">https://support.cloudflare.com/entries/22054357-How-do-I-do-CNAME-setup-</a>', 0, 0, 0),
(2107, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Instant Scaling', 'Instant Scaling', 0, 0, 0),
(2108, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'By enabling these easy options, site can achieve instant scaling.', 'By enabling these easy options, site can achieve instant scaling.', 0, 0, 0),
(2109, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update and modify affiliate types', 'Here you can update and modify affiliate types', 0, 0, 0),
(2110, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Translations add', 'Translations add', 0, 0, 0),
(2111, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Project', 'Project', 0, 0, 0),
(2112, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Project Owner', 'Project Owner', 0, 0, 0),
(2113, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Backer', 'Backer', 0, 0, 0),
(2114, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Donor', 'Donor', 0, 0, 0),
(2115, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Borrower', 'Borrower', 0, 0, 0),
(2116, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Lender', 'Lender', 0, 0, 0),
(2117, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Entrepreneur', 'Entrepreneur', 0, 0, 0),
(2118, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Investor', 'Investor', 0, 0, 0),
(2119, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Application Info', 'Application Info', 0, 0, 0),
(2120, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Credentials', 'Credentials', 0, 0, 0),
(2121, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Other Info', 'Other Info', 0, 0, 0),
(2122, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update Facebook credentials . Click ''Update Facebook Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Facebook credentials . Click ''Update Facebook Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(2123, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update Twitter credentials like Access key and Accss Token. Click ''Update Twitter Credentials'' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 'Here you can update Twitter credentials like Access key and Accss Token. Click ''Update Twitter Credentials'' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 0, 0, 0),
(2124, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update Google Analytics credentials . Click  ''Update Google Analytics Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Google Analytics credentials . Click  ''Update Google Analytics Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(2125, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '<span><i class=\\"icon-facebook-sign facebookc space text-16\\"></i>Update Facebook Credentials</span>', '<span><i class=\\"icon-facebook-sign facebookc space text-16\\"></i>Update Facebook Credentials</span>', 0, 0, 0),
(2126, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(2127, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '<span><i class=\\"icon-twitter-sign twitterc space text-16\\"></i>Update Twitter Credentials</span>', '<span><i class=\\"icon-twitter-sign twitterc space text-16\\"></i>Update Twitter Credentials</span>', 0, 0, 0),
(2128, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update Twitter credentials like Access key and Access Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and Consumer secret before you click this link.', 'Here you can update Twitter credentials like Access key and Access Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and Consumer secret before you click this link.', 0, 0, 0),
(2129, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '<span><i class=\\"icon-google-sign googlec space text-16\\"></i>Update Google Analytics Credentials</span>', '<span><i class=\\"icon-google-sign googlec space text-16\\"></i>Update Google Analytics Credentials</span>', 0, 0, 0),
(2130, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Here you can update Google Analytics credentials like Access Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and Consumer secret before you click this link.', 'Here you can update Google Analytics credentials like Access Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and Consumer secret before you click this link.', 0, 0, 0),
(2131, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '<span>Copy static contents to S3</span>', '<span>Copy static contents to S3</span>', 0, 0, 0),
(2132, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Clicking this button will copy static contents such as CSS, JavaScript, images files in <code>webroot</code> folder of this server to Amazon S3 and will enable them to be delivered from there.', 'Clicking this button will copy static contents such as CSS, JavaScript, images files in <code>webroot</code> folder of this server to Amazon S3 and will enable them to be delivered from there.', 0, 0, 0),
(2133, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'hrs', 'hrs', 0, 0, 0),
(2134, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Currencies', 'Currencies', 0, 0, 0),
(2135, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'registration', 'registration', 0, 0, 0),
(2136, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '1. Sign in using your google account in <a target=\\"blank\\" href=\\"https://developers.google.com/speed/pagespeed/service\\">https://developers.google.com/speed/pagespeed/service</a>.', '1. Sign in using your google account in <a target=\\"blank\\" href=\\"https://developers.google.com/speed/pagespeed/service\\">https://developers.google.com/speed/pagespeed/service</a>.', 0, 0, 0),
(2137, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '2. Click sign up now button and answer simple questions. Google will enable PageSpeed service within 2 hours.', '2. Click sign up now button and answer simple questions. Google will enable PageSpeed service within 2 hours.', 0, 0, 0),
(2138, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, '3. You have to configure this service in this link <a target=\\"blank\\" href=\\"https://code.google.com/apis/console\\">https://code.google.com/apis/console</a>, please follow the steps mentioned in this link <a target=\\"blank\\" href=\\"https://developers.google.com/speed/pagespeed/service/setup\\">https://developers.google.com/speed/pagespeed/service/setup</a>', '3. You have to configure this service in this link <a target=\\"blank\\" href=\\"https://code.google.com/apis/console\\">https://code.google.com/apis/console</a>, please follow the steps mentioned in this link <a target=\\"blank\\" href=\\"https://developers.google.com/speed/pagespeed/service/setup\\">https://developers.google.com/speed/pagespeed/service/setup</a>', 0, 0, 0),
(2139, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'This is the site tracker script used for tracking and analyzing the data on how the people are getting into your website. e.g., <a target=\\"blank\\" href=\\"http://www.google.com/analytics\\">Google Analytics</a>, <a target=\\"blank\\" href=\\"https://kissmetrics.com\\">KISSmetrics</a>, <a target=\\"blank\\" href=\\"https://mixpanel.com\\">Mixpanel</a>, <a target=\\"blank\\" href=\\"https://quantcast.com\\">Quantcast</a>', 'This is the site tracker script used for tracking and analyzing the data on how the people are getting into your website. e.g., <a target=\\"blank\\" href=\\"http://www.google.com/analytics\\">Google Analytics</a>, <a target=\\"blank\\" href=\\"https://kissmetrics.com\\">KISSmetrics</a>, <a target=\\"blank\\" href=\\"https://mixpanel.com\\">Mixpanel</a>, <a target=\\"blank\\" href=\\"https://quantcast.com\\">Quantcast</a>', 0, 0, 0),
(2140, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Not Allow Beyond Original', 'Not Allow Beyond Original', 0, 0, 0),
(2141, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Allow Handle Aspect', 'Allow Handle Aspect', 0, 0, 0),
(2142, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Slug', 'Slug', 0, 0, 0),
(2143, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Message for admin', 'Message for admin', 0, 0, 0),
(2144, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Message for receiver', 'Message for receiver', 0, 0, 0),
(2145, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Credit', 'Credit', 0, 0, 0),
(2146, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Debit', 'Debit', 0, 0, 0),
(2147, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Funded Amount', 'Funded Amount', 0, 0, 0),
(2148, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Canceled Amount', 'Canceled Amount', 0, 0, 0),
(2149, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Canceled by Admin', 'Canceled by Admin', 0, 0, 0),
(2150, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Canceled by %s Owner', 'Canceled by %s Owner', 0, 0, 0),
(2151, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Canceled by %s', 'Canceled by %s', 0, 0, 0),
(2152, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Account Summary', 'Account Summary', 0, 0, 0),
(2153, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Account Balance: ', 'Account Balance: ', 0, 0, 0),
(2154, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Withdraw Request: ', 'Withdraw Request: ', 0, 0, 0),
(2155, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Due to Expire', 'Due to Expire', 0, 0, 0),
(2156, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Types', 'Types', 0, 0, 0),
(2157, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Taxonomy', 'Taxonomy', 0, 0, 0),
(2158, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Login Time', 'Login Time', 0, 0, 0),
(2159, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Login IP', 'Login IP', 0, 0, 0),
(2160, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'User Agent', 'User Agent', 0, 0, 0),
(2161, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Add New OpenID', 'Add New OpenID', 0, 0, 0),
(2162, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'OpenIDs', 'OpenIDs', 0, 0, 0),
(2163, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Manage your OpenIDs', 'Manage your OpenIDs', 0, 0, 0),
(2164, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.', 'The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.', 0, 0, 0),
(2165, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Attach a new OpenID', 'Attach a new OpenID', 0, 0, 0),
(2166, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Edit Profile - %s', 'Edit Profile - %s', 0, 0, 0),
(2167, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Personal Info', 'Personal Info', 0, 0, 0),
(2168, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Change Image', 'Change Image', 0, 0, 0),
(2169, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Middle Name', 'Middle Name', 0, 0, 0),
(2170, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'DOB', 'DOB', 0, 0, 0),
(2171, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'About me', 'About me', 0, 0, 0),
(2172, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Zip Code', 'Zip Code', 0, 0, 0),
(2173, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Websites', 'Websites', 0, 0, 0),
(2174, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Other', 'Other', 0, 0, 0),
(2175, '2013-07-29 18:04:19', '2013-07-29 18:04:19', 42, 'Upload Photo', 'Upload Photo', 0, 0, 0),
(2176, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Email Confirmed', 'Email Confirmed', 0, 0, 0),
(2177, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Setting a security question helps us to identify you as the owner of your %s account.', 'Setting a security question helps us to identify you as the owner of your %s account.', 0, 0, 0),
(2178, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Please select questions', 'Please select questions', 0, 0, 0),
(2179, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Answer', 'Answer', 0, 0, 0),
(2180, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Profile Image - %s', 'Profile Image - %s', 0, 0, 0),
(2181, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connect with Twitter', 'Connect with Twitter', 0, 0, 0),
(2182, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connect with Linkedin', 'Connect with Linkedin', 0, 0, 0),
(2183, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Viewed Time', 'Viewed Time', 0, 0, 0),
(2184, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Viewed User', 'Viewed User', 0, 0, 0),
(2185, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'You have not yet activated your account. Please activate it. If you have not received the activation mail, %s to resend the activation mail.', 'You have not yet activated your account. Please activate it. If you have not received the activation mail, %s to resend the activation mail.', 0, 0, 0),
(2186, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Actions to Be Taken', 'Actions to Be Taken', 0, 0, 0),
(2187, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Pending Approval Users', 'Pending Approval Users', 0, 0, 0),
(2188, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Pending Payments', 'Pending Payments', 0, 0, 0),
(2189, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'System Flagged ', 'System Flagged ', 0, 0, 0),
(2190, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Diagnostics are for developer purpose only.', 'Diagnostics are for developer purpose only.', 0, 0, 0),
(2191, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'SudoPay Transaction Log', 'SudoPay Transaction Log', 0, 0, 0),
(2192, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'View the transaction logs done via SudoPay', 'View the transaction logs done via SudoPay', 0, 0, 0),
(2193, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'SudoPay IPN Log', 'SudoPay IPN Log', 0, 0, 0),
(2194, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'View the ipn logs done via SudoPay', 'View the ipn logs done via SudoPay', 0, 0, 0),
(2195, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Debug & Error Log', 'Debug & Error Log', 0, 0, 0),
(2196, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'View debug, error log, used cache memory and used log memory', 'View debug, error log, used cache memory and used log memory', 0, 0, 0),
(2197, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Google+ Users', 'Google+ Users', 0, 0, 0),
(2198, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'AngelList Users', 'AngelList Users', 0, 0, 0),
(2199, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'User Insights', 'User Insights', 0, 0, 0),
(2200, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Filter and identify your users based on valuable data.', 'Filter and identify your users based on valuable data.', 0, 0, 0),
(2201, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Engagement Metrics', 'Engagement Metrics', 0, 0, 0),
(2202, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Quick overview of how the users got engaged with the site.', 'Quick overview of how the users got engaged with the site.', 0, 0, 0),
(2203, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '[Image: Engagement Metrics]', '[Image: Engagement Metrics]', 0, 0, 0),
(2204, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '%s posted', '%s posted', 0, 0, 0),
(2205, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '%s funded', '%s funded', 0, 0, 0),
(2206, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Site Revenue', 'Site Revenue', 0, 0, 0),
(2207, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Referred User Count', 'Referred User Count', 0, 0, 0),
(2208, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Logins', 'Logins', 0, 0, 0),
(2209, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Registered On', 'Registered On', 0, 0, 0),
(2210, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Registered IP', 'Registered IP', 0, 0, 0),
(2211, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Count', 'Count', 0, 0, 0),
(2212, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Total Funded Amount', 'Total Funded Amount', 0, 0, 0),
(2213, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Time', 'Time', 0, 0, 0),
(2214, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '[Image: OpenID]', '[Image: OpenID]', 0, 0, 0),
(2215, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '[Image: AngeList]', '[Image: AngeList]', 0, 0, 0),
(2216, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Disk Usage', 'Disk Usage', 0, 0, 0),
(2217, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Clear Cache', 'Clear Cache', 0, 0, 0),
(2218, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Used Cache Memory', 'Used Cache Memory', 0, 0, 0),
(2219, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Used Log Memory  ', 'Used Log Memory  ', 0, 0, 0),
(2220, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Recent Errors & Logs', 'Recent Errors & Logs', 0, 0, 0),
(2221, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Clear Error Log', 'Clear Error Log', 0, 0, 0),
(2222, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Debug Log', 'Debug Log', 0, 0, 0),
(2223, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Clear Debug Log', 'Clear Debug Log', 0, 0, 0),
(2224, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Email Log', 'Email Log', 0, 0, 0),
(2225, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Clear Email Log', 'Clear Email Log', 0, 0, 0),
(2226, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Online Users', 'Online Users', 0, 0, 0),
(2227, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'No users online', 'No users online', 0, 0, 0),
(2228, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Recently Registered Users', 'Recently Registered Users', 0, 0, 0),
(2229, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Recently no users registered', 'Recently no users registered', 0, 0, 0),
(2230, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Bulk Mail Option', 'Bulk Mail Option', 0, 0, 0),
(2231, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Send To', 'Send To', 0, 0, 0),
(2232, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Timings', 'Timings', 0, 0, 0),
(2233, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Current time: ', 'Current time: ', 0, 0, 0),
(2234, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Last login: ', 'Last login: ', 0, 0, 0),
(2235, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'It list the actions that admin need to take. Action such as users/projects waiting for approval, cancel the project/ clear the project flag of flagged projects, withdraw request waiting for approval and also affiliate withdraw request.', 'It list the actions that admin need to take. Action such as users/projects waiting for approval, cancel the project/ clear the project flag of flagged projects, withdraw request waiting for approval and also affiliate withdraw request.', 0, 0, 0),
(2236, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Version', 'Version', 0, 0, 0),
(2237, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Profile Info', 'Profile Info', 0, 0, 0),
(2238, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'N/A', 'N/A', 0, 0, 0),
(2239, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Date of Birth', 'Date of Birth', 0, 0, 0),
(2240, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'JOBS Act Info', 'JOBS Act Info', 0, 0, 0),
(2241, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Project Info', 'Project Info', 0, 0, 0),
(2242, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Flags Count', 'Flags Count', 0, 0, 0),
(2243, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Followiners Count', 'Followiners Count', 0, 0, 0),
(2244, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Comments Count', 'Comments Count', 0, 0, 0),
(2245, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Ratings Count', 'Ratings Count', 0, 0, 0),
(2246, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Social Network Info', 'Social Network Info', 0, 0, 0),
(2247, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connected Facebook', 'Connected Facebook', 0, 0, 0),
(2248, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connected twitter', 'Connected twitter', 0, 0, 0),
(2249, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connected Google', 'Connected Google', 0, 0, 0),
(2250, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connected Yahoo', 'Connected Yahoo', 0, 0, 0),
(2251, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Connected Linkedin', 'Connected Linkedin', 0, 0, 0),
(2252, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Old password', 'Old password', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `name`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(2253, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Enter a new password', 'Enter a new password', 0, 0, 0),
(2254, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Confirm Password', 'Confirm Password', 0, 0, 0),
(2255, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '%s users have connected using Facebook', '%s users have connected using Facebook', 0, 0, 0),
(2256, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Follow Friends', 'Follow Friends', 0, 0, 0),
(2257, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with Facebook', 'Login with Facebook', 0, 0, 0),
(2258, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Or', 'Or', 0, 0, 0),
(2259, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with Twitter', 'Login with Twitter', 0, 0, 0),
(2260, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with LinkedIn', 'Login with LinkedIn', 0, 0, 0),
(2261, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with Yahoo!', 'Login with Yahoo!', 0, 0, 0),
(2262, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with Google', 'Login with Google', 0, 0, 0),
(2263, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with GooglePlus', 'Login with GooglePlus', 0, 0, 0),
(2264, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with OpenId', 'Login with OpenId', 0, 0, 0),
(2265, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login with AngelList', 'Login with AngelList', 0, 0, 0),
(2266, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Remember me on this computer.', 'Remember me on this computer.', 0, 0, 0),
(2267, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '%s has invited you to join %s', '%s has invited you to join %s', 0, 0, 0),
(2268, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'I have read, understood & agree to the %s', 'I have read, understood & agree to the %s', 0, 0, 0),
(2269, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Already have an account?', 'Already have an account?', 0, 0, 0),
(2270, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Quick Sign Up', 'Quick Sign Up', 0, 0, 0),
(2271, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Sign up with a social network to follow your friends ', 'Sign up with a social network to follow your friends ', 0, 0, 0),
(2272, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'By signing up you agree to the  ', 'By signing up you agree to the  ', 0, 0, 0),
(2273, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Notify me through Email', 'Notify me through Email', 0, 0, 0),
(2274, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Joined', 'Joined', 0, 0, 0),
(2275, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, '(Not connected)', '(Not connected)', 0, 0, 0),
(2276, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Contacts', 'Contacts', 0, 0, 0),
(2277, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Disabled. Reason: You can''t follow your own profile.', 'Disabled. Reason: You can''t follow your own profile.', 0, 0, 0),
(2278, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Send Message', 'Send Message', 0, 0, 0),
(2279, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Disabled. Reason: You can''t send message to you.', 'Disabled. Reason: You can''t send message to you.', 0, 0, 0),
(2280, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Login count', 'Login count', 0, 0, 0),
(2281, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Sign Up IP', 'Sign Up IP', 0, 0, 0),
(2282, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Created on', 'Created on', 0, 0, 0),
(2283, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Total Withdraw Amount', 'Total Withdraw Amount', 0, 0, 0),
(2284, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'View Terms', 'View Terms', 0, 0, 0),
(2285, '2013-07-29 18:04:20', '2013-07-29 18:04:20', 42, 'Debug setting does not allow access to this url.', 'Debug setting does not allow access to this url.', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `format_show_author` tinyint(1) NOT NULL default '1',
  `format_show_date` tinyint(1) NOT NULL default '1',
  `comment_status` tinyint(1) NOT NULL default '1',
  `comment_approve` tinyint(1) NOT NULL default '1',
  `comment_spam_protection` tinyint(1) NOT NULL default '0',
  `comment_captcha` tinyint(1) NOT NULL default '0',
  `params` text collate utf8_unicode_ci,
  `plugin` varchar(255) collate utf8_unicode_ci default NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `title`, `alias`, `description`, `format_show_author`, `format_show_date`, `comment_status`, `comment_approve`, `comment_spam_protection`, `comment_captcha`, `params`, `plugin`, `updated`, `created`) VALUES
(1, 'Page', 'page', 'A page is a simple method for creating and displaying information that rarely changes, such as an "About us" section of a website. By default, a page entry does not allow visitor comments.', 0, 0, 0, 1, 0, 0, '', '', '2009-09-09 00:23:24', '2009-09-02 18:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `types_vocabularies`
--

DROP TABLE IF EXISTS `types_vocabularies`;
CREATE TABLE IF NOT EXISTS `types_vocabularies` (
  `id` int(10) NOT NULL auto_increment,
  `type_id` int(10) NOT NULL,
  `vocabulary_id` int(10) NOT NULL,
  `weight` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `vocabulary_id` (`vocabulary_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types_vocabularies`
--

INSERT INTO `types_vocabularies` (`id`, `type_id`, `vocabulary_id`, `weight`) VALUES
(31, 2, 2, NULL),
(30, 2, 1, NULL),
(25, 4, 2, NULL),
(24, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `role_id` int(5) unsigned NOT NULL,
  `username` varchar(255) collate utf8_unicode_ci NOT NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `password` varchar(100) collate utf8_unicode_ci NOT NULL,
  `available_wallet_amount` double(10,2) NOT NULL,
  `blocked_amount` double(10,2) NOT NULL,
  `facebook_user_id` bigint(20) default NULL,
  `timezone_id` bigint(20) unsigned default NULL,
  `auto_detected_timezone_id` bigint(20) unsigned NOT NULL,
  `user_openid_count` bigint(20) unsigned NOT NULL,
  `user_login_count` bigint(20) unsigned NOT NULL,
  `user_view_count` bigint(20) unsigned NOT NULL,
  `project_fund_count` bigint(20) unsigned NOT NULL,
  `project_count` bigint(20) unsigned NOT NULL,
  `project_flag_count` bigint(20) unsigned NOT NULL default '0',
  `project_follower_count` int(11) NOT NULL,
  `project_comment_count` int(11) default '0',
  `project_rating_count` int(11) default '0',
  `blog_count` int(11) default '0',
  `blog_comment_count` int(11) default '0',
  `unique_project_fund_count` bigint(20) NOT NULL default '0',
  `cookie_hash` varchar(50) collate utf8_unicode_ci NOT NULL,
  `cookie_time_modified` datetime NOT NULL,
  `is_openid_register` tinyint(1) NOT NULL default '0',
  `is_agree_terms_conditions` tinyint(1) NOT NULL default '0',
  `is_active` tinyint(1) NOT NULL default '0',
  `is_email_confirmed` tinyint(1) NOT NULL default '0',
  `is_affiliate_user` tinyint(1) default '0',
  `total_commission_pending_amount` double(10,2) default '0.00',
  `total_commission_canceled_amount` double(10,2) default '0.00',
  `total_commission_completed_amount` double(10,2) default '0.00',
  `commission_line_amount` double(10,2) default '0.00',
  `commission_withdraw_request_amount` double(10,2) default '0.00',
  `commission_paid_amount` double(10,2) default '0.00',
  `total_amount_withdrawn` bigint(20) NOT NULL default '0',
  `referred_purchase_count` bigint(20) default '0',
  `referred_project_count` bigint(20) NOT NULL default '0',
  `affiliate_refer_purchase_count` bigint(20) default '0',
  `ip_id` bigint(20) default NULL,
  `last_login_ip_id` bigint(20) default NULL,
  `last_logged_in_time` datetime NOT NULL,
  `twitter_access_token` varchar(255) collate utf8_unicode_ci default NULL,
  `twitter_user_id` varchar(255) collate utf8_unicode_ci default NULL,
  `twitter_access_key` bigint(20) unsigned default NULL,
  `linkedin_user_id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `linkedin_access_token` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_linkedin_register` tinyint(1) NOT NULL default '0',
  `is_angellist_register` tinyint(1) NOT NULL default '0',
  `is_angellist_connected` tinyint(1) NOT NULL default '0',
  `angellist_user_id` bigint(20) default NULL,
  `angellist_access_token` varchar(255) collate utf8_unicode_ci default NULL,
  `angellist_avatar_url` varchar(255) collate utf8_unicode_ci default NULL,
  `openid_user_id` varchar(200) collate utf8_unicode_ci NOT NULL,
  `facebook_access_token` varchar(255) collate utf8_unicode_ci default NULL,
  `google_user_id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `google_access_token` varchar(255) collate utf8_unicode_ci NOT NULL,
  `yahoo_user_id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `yahoo_access_token` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_google_register` tinyint(1) NOT NULL default '0',
  `is_yahoo_register` tinyint(1) NOT NULL default '0',
  `is_facebook_register` tinyint(1) NOT NULL default '0',
  `is_twitter_register` tinyint(1) NOT NULL default '0',
  `is_facebook_connected` tinyint(1) NOT NULL default '0',
  `is_twitter_connected` tinyint(1) NOT NULL default '0',
  `is_google_connected` tinyint(1) NOT NULL default '0',
  `is_yahoo_connected` tinyint(1) NOT NULL default '0',
  `is_linkedin_connected` tinyint(1) NOT NULL default '0',
  `twitter_avatar_url` varchar(255) collate utf8_unicode_ci default NULL,
  `is_paid` tinyint(1) NOT NULL default '0',
  `site_state_id` int(11) default '0',
  `sudopay_pay_key` varchar(255) collate utf8_unicode_ci default NULL,
  `sudopay_payment_id` int(11) default NULL,
  `latitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) collate utf8_unicode_ci NOT NULL,
  `referred_by_user_id` bigint(20) default '0',
  `referred_by_user_count` bigint(20) NOT NULL default '0',
  `pwd_reset_token` varchar(255) collate utf8_unicode_ci NOT NULL,
  `pwd_reset_requested_date` datetime NOT NULL,
  `security_question_id` int(11) NOT NULL,
  `security_answer` varchar(255) collate utf8_unicode_ci NOT NULL,
  `total_withdraw_request_count` bigint(20) NOT NULL default '0',
  `is_accredited_investor` tinyint(1) default '0',
  `mobile_app_hash` varchar(255) collate utf8_unicode_ci default NULL,
  `mobile_app_time_modified` datetime default NULL,
  `fb_friends_count` bigint(20) NOT NULL default '0',
  `twitter_followers_count` bigint(20) NOT NULL default '0',
  `linkedin_contacts_count` bigint(20) NOT NULL default '0',
  `google_contacts_count` bigint(20) NOT NULL default '0',
  `yahoo_contacts_count` bigint(20) NOT NULL default '0',
  `is_skipped_fb` tinyint(1) NOT NULL default '0',
  `is_skipped_twitter` tinyint(1) NOT NULL default '0',
  `is_skipped_linkedin` tinyint(1) NOT NULL default '1',
  `is_skipped_google` tinyint(1) NOT NULL default '0',
  `is_skipped_yahoo` tinyint(1) NOT NULL default '0',
  `is_send_activities_mail` tinyint(1) NOT NULL default '1',
  `total_needed_amount` double(10,2) NOT NULL,
  `total_collected_amount` double(10,2) NOT NULL,
  `total_funded_amount` double(10,2) NOT NULL,
  `site_revenue` double(10,2) NOT NULL,
  `invite_count` int(11) default '0',
  `user_avatar_source_id` int(11) default '0',
  `googleplus_user_id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `is_googleplus_register` tinyint(1) NOT NULL default '0',
  `is_googleplus_connected` tinyint(1) NOT NULL default '0',
  `googleplus_contacts_count` bigint(20) NOT NULL,
  `googleplus_avatar_url` varchar(255) collate utf8_unicode_ci default NULL,
  `withdrawn_no_of_loans` int(11) NOT NULL default '0',
  `withdrawn_average_rate` double(10,2) NOT NULL default '0.00',
  `withdrawn_total_lent` double(10,2) NOT NULL default '0.00',
  `withdrawn_total_capital_returned` double(10,2) NOT NULL default '0.00',
  `withdrawn_total_interest_returned` double(10,2) NOT NULL default '0.00',
  `collection_no_of_loans` int(11) NOT NULL default '0',
  `collection_average_rate` double(10,2) NOT NULL default '0.00',
  `collection_total_lent` double(10,2) NOT NULL default '0.00',
  `collection_total_capital_returned` double(10,2) NOT NULL default '0.00',
  `collection_total_interest_returned` double(10,2) NOT NULL default '0.00',
  `closed_no_of_loans` int(11) NOT NULL default '0',
  `closed_average_rate` double(10,2) NOT NULL default '0.00',
  `closed_total_lent` double(10,2) NOT NULL default '0.00',
  `closed_total_capital_returned` double(10,2) NOT NULL default '0.00',
  `closed_total_interest_returned` double(10,2) NOT NULL default '0.00',
  `default_no_of_loans` int(11) NOT NULL default '0',
  `default_average_rate` double(10,2) NOT NULL default '0.00',
  `default_total_lent` double(10,2) NOT NULL default '0.00',
  `default_total_capital_returned` double(10,2) NOT NULL default '0.00',
  `default_total_interest_returned` double(10,2) NOT NULL default '0.00',
  `is_idle` tinyint(1) default '1',
  `is_funded` tinyint(1) default '0',
  `is_project_posted` tinyint(1) default '0',
  `is_engaged` tinyint(1) default '0',
  `google_avatar_url` varchar(255) collate utf8_unicode_ci default NULL,
  `linkedin_avatar_url` varchar(255) collate utf8_unicode_ci default NULL,
  `angellist_contacts_count` bigint(20) NOT NULL,
  `activity_message_id` bigint(20) NOT NULL default '0',
  `sudopay_gateway_id` bigint(20) default NULL,
  `sudopay_receiver_account_id` bigint(20) default NULL,
  `sudopay_revised_amount` double(10,2) NOT NULL,
  `sudopay_token` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `facebook_user_id` (`facebook_user_id`),
  KEY `timezone_id` (`timezone_id`),
  KEY `auto_detected_timezone_id` (`auto_detected_timezone_id`),
  KEY `ip_id` (`ip_id`),
  KEY `last_login_ip_id` (`last_login_ip_id`),
  KEY `twitter_user_id` (`twitter_user_id`),
  KEY `linkedin_user_id` (`linkedin_user_id`),
  KEY `angellist_user_id` (`angellist_user_id`),
  KEY `openid_user_id` (`openid_user_id`),
  KEY `google_user_id` (`google_user_id`),
  KEY `yahoo_user_id` (`yahoo_user_id`),
  KEY `site_state_id` (`site_state_id`),
  KEY `referred_by_user_id` (`referred_by_user_id`),
  KEY `security_question_id` (`security_question_id`),
  KEY `user_avatar_source_id` (`user_avatar_source_id`),
  KEY `googleplus_user_id` (`googleplus_user_id`),
  KEY `sudopay_gateway_id` (`sudopay_gateway_id`),
  KEY `sudopay_receiver_account_id` (`sudopay_receiver_account_id`),
  KEY `sudopay_pay_key` (`sudopay_pay_key`),
  KEY `sudopay_payment_id` (`sudopay_payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Details';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `modified`, `role_id`, `username`, `email`, `password`, `available_wallet_amount`, `blocked_amount`, `facebook_user_id`, `timezone_id`, `auto_detected_timezone_id`, `user_openid_count`, `user_login_count`, `user_view_count`, `project_fund_count`, `project_count`, `project_flag_count`, `project_follower_count`, `project_comment_count`, `project_rating_count`, `blog_count`, `blog_comment_count`, `unique_project_fund_count`, `cookie_hash`, `cookie_time_modified`, `is_openid_register`, `is_agree_terms_conditions`, `is_active`, `is_email_confirmed`, `is_affiliate_user`, `total_commission_pending_amount`, `total_commission_canceled_amount`, `total_commission_completed_amount`, `commission_line_amount`, `commission_withdraw_request_amount`, `commission_paid_amount`, `total_amount_withdrawn`, `referred_purchase_count`, `referred_project_count`, `affiliate_refer_purchase_count`, `ip_id`, `last_login_ip_id`, `last_logged_in_time`, `twitter_access_token`, `twitter_user_id`, `twitter_access_key`, `linkedin_user_id`, `linkedin_access_token`, `is_linkedin_register`, `is_angellist_register`, `is_angellist_connected`, `angellist_user_id`, `angellist_access_token`, `angellist_avatar_url`, `openid_user_id`, `facebook_access_token`, `google_user_id`, `google_access_token`, `yahoo_user_id`, `yahoo_access_token`, `is_google_register`, `is_yahoo_register`, `is_facebook_register`, `is_twitter_register`, `is_facebook_connected`, `is_twitter_connected`, `is_google_connected`, `is_yahoo_connected`, `is_linkedin_connected`, `twitter_avatar_url`, `is_paid`, `site_state_id`, `sudopay_pay_key`, `sudopay_payment_id`, `latitude`, `longitude`, `referred_by_user_id`, `referred_by_user_count`, `pwd_reset_token`, `pwd_reset_requested_date`, `security_question_id`, `security_answer`, `total_withdraw_request_count`, `is_accredited_investor`, `mobile_app_hash`, `mobile_app_time_modified`, `fb_friends_count`, `twitter_followers_count`, `linkedin_contacts_count`, `google_contacts_count`, `yahoo_contacts_count`, `is_skipped_fb`, `is_skipped_twitter`, `is_skipped_linkedin`, `is_skipped_google`, `is_skipped_yahoo`, `is_send_activities_mail`, `total_needed_amount`, `total_collected_amount`, `total_funded_amount`, `site_revenue`, `invite_count`, `user_avatar_source_id`, `googleplus_user_id`, `is_googleplus_register`, `is_googleplus_connected`, `googleplus_contacts_count`, `googleplus_avatar_url`, `withdrawn_no_of_loans`, `withdrawn_average_rate`, `withdrawn_total_lent`, `withdrawn_total_capital_returned`, `withdrawn_total_interest_returned`, `collection_no_of_loans`, `collection_average_rate`, `collection_total_lent`, `collection_total_capital_returned`, `collection_total_interest_returned`, `closed_no_of_loans`, `closed_average_rate`, `closed_total_lent`, `closed_total_capital_returned`, `closed_total_interest_returned`, `default_no_of_loans`, `default_average_rate`, `default_total_lent`, `default_total_capital_returned`, `default_total_interest_returned`, `is_idle`, `is_funded`, `is_project_posted`, `is_engaged`, `google_avatar_url`, `linkedin_avatar_url`, `angellist_contacts_count`, `activity_message_id`, `sudopay_gateway_id`, `sudopay_receiver_account_id`, `sudopay_revised_amount`, `sudopay_token`) VALUES
(1, '2011-08-05 04:23:11', '2012-11-03 11:14:48', 1, 'admin', 'productdemo.admin@gmail.com', '$1$Dm]T+`^g$DMOW6j7MoaFoFYxeTkBGi/', 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 3, '2012-12-19 12:51:58', '', '0', 0, '0', '', 0, 0, 0, 0, '', '', '0', '', '0', '', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, NULL, NULL, 0, '', '', 0, 0, '', '0000-00-00 00:00:00', 0, '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0.00, 0.00, 0.00, 0.00, 0, 1, '0', 0, 0, 0, '', 0, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, 0.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_add_wallet_amounts`
--

DROP TABLE IF EXISTS `user_add_wallet_amounts`;
CREATE TABLE IF NOT EXISTS `user_add_wallet_amounts` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `payment_gateway_id` bigint(20) NOT NULL,
  `is_success` tinyint(1) NOT NULL default '0',
  `description` text collate utf8_unicode_ci,
  `sudopay_gateway_id` bigint(20) default NULL,
  `sudopay_payment_id` bigint(20) default NULL,
  `sudopay_pay_key` varchar(255) collate utf8_unicode_ci default NULL,
  `sudopay_revised_amount` double(10,2) NOT NULL,
  `sudopay_token` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `sudopay_gateway_id` (`sudopay_gateway_id`),
  KEY `sudopay_payment_id` (`sudopay_payment_id`),
  KEY `sudopay_pay_key` (`sudopay_pay_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_add_wallet_amounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_cash_withdrawals`
--

DROP TABLE IF EXISTS `user_cash_withdrawals`;
CREATE TABLE IF NOT EXISTS `user_cash_withdrawals` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `withdrawal_status_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `remark` text collate utf8_unicode_ci,
  `payment_gateway_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `withdrawal_status_id` (`withdrawal_status_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `user_cash_withdrawals`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_followers`
--

DROP TABLE IF EXISTS `user_followers`;
CREATE TABLE IF NOT EXISTS `user_followers` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `followed_user_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `followed_user_id` (`followed_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_followers`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `persistent_login_id` bigint(20) default NULL,
  `ip_id` bigint(20) default NULL,
  `user_agent` varchar(500) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `persistent_login_id` (`persistent_login_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Login Details';

--
-- Dumping data for table `user_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_openids`
--

DROP TABLE IF EXISTS `user_openids`;
CREATE TABLE IF NOT EXISTS `user_openids` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `openid` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User OpenID Details';

--
-- Dumping data for table `user_openids`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `language_id` bigint(20) default NULL,
  `first_name` varchar(100) collate utf8_unicode_ci default NULL,
  `last_name` varchar(100) collate utf8_unicode_ci default NULL,
  `middle_name` varchar(100) collate utf8_unicode_ci default NULL,
  `gender_id` int(2) default NULL,
  `dob` date default NULL,
  `about_me` text collate utf8_unicode_ci,
  `address` varchar(500) collate utf8_unicode_ci default NULL,
  `address1` varchar(500) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` bigint(20) default '0',
  `zip_code` int(10) default NULL,
  `education_id` bigint(20) unsigned default NULL,
  `employment_id` bigint(20) unsigned default NULL,
  `income_range_id` bigint(20) unsigned default NULL,
  `relationship_id` bigint(20) unsigned default NULL,
  `message_page_size` int(3) unsigned NOT NULL default '0',
  `message_signature` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `gender_id` (`gender_id`),
  KEY `user_id` (`user_id`),
  KEY `education_id` (`education_id`),
  KEY `employment_id` (`employment_id`),
  KEY `income_range_id` (`income_range_id`),
  KEY `relationship_id` (`relationship_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Profile Details';

--
-- Dumping data for table `user_profiles`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_views`
--

DROP TABLE IF EXISTS `user_views`;
CREATE TABLE IF NOT EXISTS `user_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `viewing_user_id` bigint(20) default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `viewing_user_id` (`viewing_user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User View Details';

--
-- Dumping data for table `user_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_websites`
--

DROP TABLE IF EXISTS `user_websites`;
CREATE TABLE IF NOT EXISTS `user_websites` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `website` varchar(512) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_websites`
--


-- --------------------------------------------------------

--
-- Table structure for table `vocabularies`
--

DROP TABLE IF EXISTS `vocabularies`;
CREATE TABLE IF NOT EXISTS `vocabularies` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `alias` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `required` tinyint(1) NOT NULL default '0',
  `multiple` tinyint(1) NOT NULL default '0',
  `tags` tinyint(1) NOT NULL default '0',
  `plugin` varchar(255) collate utf8_unicode_ci default NULL,
  `weight` int(11) default NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vocabularies`
--


-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_statuses`
--

DROP TABLE IF EXISTS `withdrawal_statuses`;
CREATE TABLE IF NOT EXISTS `withdrawal_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_cash_withdrawal_count` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `withdrawal_statuses`
--

INSERT INTO `withdrawal_statuses` (`id`, `created`, `modified`, `name`, `user_cash_withdrawal_count`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pending', 0),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Approved', 0),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rejected', 0),
(5, '2010-04-15 14:20:17', '2010-04-15 14:20:17', 'Success', 0);
