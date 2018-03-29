-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2018 at 09:31 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `richmondmediahosting`
--

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_config`
--

DROP TABLE IF EXISTS `quickbooks_config`;
CREATE TABLE `quickbooks_config` (
  `quickbooks_config_id` int(10) UNSIGNED NOT NULL,
  `qb_username` varchar(40) NOT NULL,
  `module` varchar(40) NOT NULL,
  `cfgkey` varchar(40) NOT NULL,
  `cfgval` varchar(40) NOT NULL,
  `cfgtype` varchar(40) NOT NULL,
  `cfgopts` text NOT NULL,
  `write_datetime` datetime NOT NULL,
  `mod_datetime` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_log`
--

DROP TABLE IF EXISTS `quickbooks_log`;
CREATE TABLE `quickbooks_log` (
  `quickbooks_log_id` int(10) UNSIGNED NOT NULL,
  `quickbooks_ticket_id` int(10) UNSIGNED DEFAULT NULL,
  `batch` int(10) UNSIGNED NOT NULL,
  `msg` text NOT NULL,
  `log_datetime` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_oauth`
--

DROP TABLE IF EXISTS `quickbooks_oauth`;
CREATE TABLE `quickbooks_oauth` (
  `quickbooks_oauth_id` int(10) UNSIGNED NOT NULL,
  `app_username` varchar(255) NOT NULL,
  `app_tenant` varchar(255) NOT NULL,
  `oauth_request_token` varchar(255) DEFAULT NULL,
  `oauth_request_token_secret` varchar(255) DEFAULT NULL,
  `oauth_access_token` varchar(255) DEFAULT NULL,
  `oauth_access_token_secret` varchar(255) DEFAULT NULL,
  `qb_realm` varchar(32) DEFAULT NULL,
  `qb_flavor` varchar(12) DEFAULT NULL,
  `qb_user` varchar(64) DEFAULT NULL,
  `request_datetime` datetime NOT NULL,
  `access_datetime` datetime DEFAULT NULL,
  `touch_datetime` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_queue`
--

DROP TABLE IF EXISTS `quickbooks_queue`;
CREATE TABLE `quickbooks_queue` (
  `quickbooks_queue_id` int(10) UNSIGNED NOT NULL,
  `quickbooks_ticket_id` int(10) UNSIGNED DEFAULT NULL,
  `qb_username` varchar(40) NOT NULL,
  `qb_action` varchar(32) NOT NULL,
  `ident` varchar(40) NOT NULL,
  `extra` text,
  `qbxml` text,
  `priority` int(10) UNSIGNED DEFAULT '0',
  `qb_status` char(1) NOT NULL,
  `msg` text,
  `enqueue_datetime` datetime NOT NULL,
  `dequeue_datetime` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_recur`
--

DROP TABLE IF EXISTS `quickbooks_recur`;
CREATE TABLE `quickbooks_recur` (
  `quickbooks_recur_id` int(10) UNSIGNED NOT NULL,
  `qb_username` varchar(40) NOT NULL,
  `qb_action` varchar(32) NOT NULL,
  `ident` varchar(40) NOT NULL,
  `extra` text,
  `qbxml` text,
  `priority` int(10) UNSIGNED DEFAULT '0',
  `run_every` int(10) UNSIGNED NOT NULL,
  `recur_lasttime` int(10) UNSIGNED NOT NULL,
  `enqueue_datetime` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_ticket`
--

DROP TABLE IF EXISTS `quickbooks_ticket`;
CREATE TABLE `quickbooks_ticket` (
  `quickbooks_ticket_id` int(10) UNSIGNED NOT NULL,
  `qb_username` varchar(40) NOT NULL,
  `ticket` char(36) NOT NULL,
  `processed` int(10) UNSIGNED DEFAULT '0',
  `lasterror_num` varchar(32) DEFAULT NULL,
  `lasterror_msg` varchar(255) DEFAULT NULL,
  `ipaddr` char(15) NOT NULL,
  `write_datetime` datetime NOT NULL,
  `touch_datetime` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `quickbooks_user`
--

DROP TABLE IF EXISTS `quickbooks_user`;
CREATE TABLE `quickbooks_user` (
  `qb_username` varchar(40) NOT NULL,
  `qb_password` varchar(255) NOT NULL,
  `qb_company_file` varchar(255) DEFAULT NULL,
  `qbwc_wait_before_next_update` int(10) UNSIGNED DEFAULT '0',
  `qbwc_min_run_every_n_seconds` int(10) UNSIGNED DEFAULT '0',
  `status` char(1) NOT NULL,
  `write_datetime` datetime NOT NULL,
  `touch_datetime` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2018-03-19 15:28:03', '2018-03-19 15:28:03', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_frm_fields`
--

DROP TABLE IF EXISTS `wp_frm_fields`;
CREATE TABLE `wp_frm_fields` (
  `id` bigint(20) NOT NULL,
  `field_key` varchar(100) DEFAULT NULL,
  `name` text,
  `description` longtext,
  `type` text,
  `default_value` longtext,
  `options` longtext,
  `field_order` int(11) DEFAULT '0',
  `required` int(1) DEFAULT NULL,
  `field_options` longtext,
  `form_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ;

--
-- Dumping data for table `wp_frm_fields`
--

INSERT INTO `wp_frm_fields` (`id`, `field_key`, `name`, `description`, `type`, `default_value`, `options`, `field_order`, `required`, `field_options`, `form_id`, `created_at`) VALUES
(1, 'qh4icy', 'Name', 'First', 'text', '', '', 1, 1, 'a:4:{s:5:\"blank\";s:0:\"\";s:14:\"separate_value\";i:0;s:7:\"classes\";s:18:\"frm_first frm_half\";s:10:\"in_section\";i:0;}', 1, '2018-03-19 15:36:15'),
(2, 'ocfup1', 'Last', 'Last', 'text', '', '', 2, 1, 'a:4:{s:5:\"label\";s:6:\"hidden\";s:5:\"blank\";s:0:\"\";s:7:\"classes\";s:8:\"frm_half\";s:10:\"in_section\";i:0;}', 1, '2018-03-19 15:36:15'),
(3, '29yf4d', 'Email', '', 'email', '', '', 3, 1, 'a:4:{s:5:\"blank\";s:0:\"\";s:7:\"invalid\";s:34:\"Please enter a valid email address\";s:7:\"classes\";s:8:\"frm_full\";s:10:\"in_section\";i:0;}', 1, '2018-03-19 15:36:15'),
(4, 'e6lis6', 'Subject', '', 'text', '', '', 5, 1, 'a:3:{s:5:\"blank\";s:0:\"\";s:7:\"classes\";s:8:\"frm_full\";s:10:\"in_section\";i:0;}', 1, '2018-03-19 15:36:15'),
(5, '9jv0r1', 'Message', '', 'textarea', '', '', 6, 1, 'a:4:{s:3:\"max\";s:1:\"5\";s:5:\"blank\";s:0:\"\";s:7:\"classes\";s:8:\"frm_full\";s:10:\"in_section\";i:0;}', 1, '2018-03-19 15:36:16'),
(6, 'qh4icy2', 'Name', 'First', 'text', '', '', 1, 1, 'a:4:{s:5:\"blank\";s:0:\"\";s:14:\"separate_value\";i:0;s:7:\"classes\";s:18:\"frm_first frm_half\";s:10:\"in_section\";i:0;}', 2, '2018-03-19 15:36:16'),
(7, 'ocfup12', 'Last', 'Last', 'text', '', '', 2, 1, 'a:4:{s:5:\"label\";s:6:\"hidden\";s:5:\"blank\";s:0:\"\";s:7:\"classes\";s:8:\"frm_half\";s:10:\"in_section\";i:0;}', 2, '2018-03-19 15:36:16'),
(8, '29yf4d2', 'Email', '', 'email', '', '', 3, 1, 'a:4:{s:5:\"blank\";s:0:\"\";s:7:\"invalid\";s:34:\"Please enter a valid email address\";s:7:\"classes\";s:8:\"frm_full\";s:10:\"in_section\";i:0;}', 2, '2018-03-19 15:36:16'),
(9, 'e6lis62', 'Subject', '', 'text', '', '', 5, 1, 'a:3:{s:5:\"blank\";s:0:\"\";s:7:\"classes\";s:8:\"frm_full\";s:10:\"in_section\";i:0;}', 2, '2018-03-19 15:36:16'),
(10, '9jv0r12', 'Message', '', 'textarea', '', '', 6, 1, 'a:4:{s:3:\"max\";s:1:\"5\";s:5:\"blank\";s:0:\"\";s:7:\"classes\";s:8:\"frm_full\";s:10:\"in_section\";i:0;}', 2, '2018-03-19 15:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `wp_frm_forms`
--

DROP TABLE IF EXISTS `wp_frm_forms`;
CREATE TABLE `wp_frm_forms` (
  `id` int(11) NOT NULL,
  `form_key` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `parent_form_id` int(11) DEFAULT '0',
  `logged_in` tinyint(1) DEFAULT NULL,
  `editable` tinyint(1) DEFAULT NULL,
  `is_template` tinyint(1) DEFAULT '0',
  `default_template` tinyint(1) DEFAULT '0',
  `status` varchar(255) DEFAULT NULL,
  `options` longtext,
  `created_at` datetime NOT NULL
) ;

--
-- Dumping data for table `wp_frm_forms`
--

INSERT INTO `wp_frm_forms` (`id`, `form_key`, `name`, `description`, `parent_form_id`, `logged_in`, `editable`, `is_template`, `default_template`, `status`, `options`, `created_at`) VALUES
(1, 'contact', 'Contact Us', 'We would like to hear from you. Please send us a message by filling out the form below and we will get back with you shortly.', 0, 0, 0, 1, 1, 'published', 'a:12:{s:12:\"custom_style\";i:1;s:12:\"submit_value\";s:6:\"Submit\";s:14:\"success_action\";s:7:\"message\";s:11:\"success_msg\";s:54:\"Your responses were successfully submitted. Thank you!\";s:9:\"show_form\";i:0;s:7:\"akismet\";s:0:\"\";s:7:\"no_save\";i:0;s:9:\"ajax_load\";i:0;s:10:\"form_class\";s:0:\"\";s:11:\"before_html\";s:217:\"<legend class=\"frm_hidden\">[form_name]</legend>\n[if form_name]<h3 class=\"frm_form_title\">[form_name]</h3>[/if form_name]\n[if form_description]<div class=\"frm_description\">[form_description]</div>[/if form_description]\";s:10:\"after_html\";s:0:\"\";s:11:\"submit_html\";s:381:\"<div class=\"frm_submit\">\n[if back_button]<button type=\"submit\" name=\"frm_prev_page\" formnovalidate=\"formnovalidate\" class=\"frm_prev_page\" [back_hook]>[back_label]</button>[/if back_button]\n<button class=\"frm_button_submit\" type=\"submit\"  [button_action]>[button_label]</button>\n[if save_draft]<a href=\"#\" class=\"frm_save_draft\" [draft_hook]>[draft_label]</a>[/if save_draft]\n</div>\";}', '2009-11-24 00:17:31'),
(2, 'contact-form', 'Contact Us', 'We would like to hear from you. Please send us a message by filling out the form below and we will get back with you shortly.', 0, 0, 0, 0, 0, 'published', 'a:12:{s:12:\"custom_style\";i:1;s:12:\"submit_value\";s:6:\"Submit\";s:14:\"success_action\";s:7:\"message\";s:11:\"success_msg\";s:54:\"Your responses were successfully submitted. Thank you!\";s:9:\"show_form\";i:0;s:7:\"akismet\";s:0:\"\";s:7:\"no_save\";i:0;s:9:\"ajax_load\";i:0;s:10:\"form_class\";s:0:\"\";s:11:\"before_html\";s:217:\"<legend class=\"frm_hidden\">[form_name]</legend>\n[if form_name]<h3 class=\"frm_form_title\">[form_name]</h3>[/if form_name]\n[if form_description]<div class=\"frm_description\">[form_description]</div>[/if form_description]\";s:10:\"after_html\";s:0:\"\";s:11:\"submit_html\";s:381:\"<div class=\"frm_submit\">\n[if back_button]<button type=\"submit\" name=\"frm_prev_page\" formnovalidate=\"formnovalidate\" class=\"frm_prev_page\" [back_hook]>[back_label]</button>[/if back_button]\n<button class=\"frm_button_submit\" type=\"submit\"  [button_action]>[button_label]</button>\n[if save_draft]<a href=\"#\" class=\"frm_save_draft\" [draft_hook]>[draft_label]</a>[/if save_draft]\n</div>\";}', '2018-03-19 15:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `wp_frm_items`
--

DROP TABLE IF EXISTS `wp_frm_items`;
CREATE TABLE `wp_frm_items` (
  `id` bigint(20) NOT NULL,
  `item_key` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `ip` text,
  `form_id` bigint(20) DEFAULT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `parent_item_id` bigint(20) DEFAULT '0',
  `is_draft` tinyint(1) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_frm_item_metas`
--

DROP TABLE IF EXISTS `wp_frm_item_metas`;
CREATE TABLE `wp_frm_item_metas` (
  `id` bigint(20) NOT NULL,
  `meta_value` longtext,
  `field_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mappress_maps`
--

DROP TABLE IF EXISTS `wp_mappress_maps`;
CREATE TABLE `wp_mappress_maps` (
  `mapid` int(11) NOT NULL,
  `obj` longtext
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mappress_posts`
--

DROP TABLE IF EXISTS `wp_mappress_posts`;
CREATE TABLE `wp_mappress_posts` (
  `postid` int(11) NOT NULL,
  `mapid` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_masterslider_options`
--

DROP TABLE IF EXISTS `wp_masterslider_options`;
CREATE TABLE `wp_masterslider_options` (
  `ID` smallint(5) UNSIGNED NOT NULL,
  `option_name` varchar(120) NOT NULL,
  `option_value` text NOT NULL
) ;

--
-- Dumping data for table `wp_masterslider_options`
--

INSERT INTO `wp_masterslider_options` (`ID`, `option_name`, `option_value`) VALUES
(1, 'masterslider_custom_css_ver', '1.1');

-- --------------------------------------------------------

--
-- Table structure for table `wp_masterslider_sliders`
--

DROP TABLE IF EXISTS `wp_masterslider_sliders`;
CREATE TABLE `wp_masterslider_sliders` (
  `ID` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(64) NOT NULL,
  `slides_num` smallint(5) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` mediumtext NOT NULL,
  `custom_styles` text NOT NULL,
  `custom_fonts` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'draft'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/richmondmediahosting', 'yes'),
(2, 'home', 'http://localhost/richmondmediahosting', 'yes'),
(3, 'blogname', 'richmondmediahosting', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'info@wordpress.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '0', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:213:{s:24:\"^wc-auth/v([1]{1})/(.*)?\";s:63:\"index.php?wc-auth-version=$matches[1]&wc-auth-route=$matches[2]\";s:22:\"^wc-api/v([1-3]{1})/?$\";s:51:\"index.php?wc-api-version=$matches[1]&wc-api-route=/\";s:24:\"^wc-api/v([1-3]{1})(.*)?\";s:61:\"index.php?wc-api-version=$matches[1]&wc-api-route=$matches[2]\";s:7:\"shop/?$\";s:27:\"index.php?post_type=product\";s:37:\"shop/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:32:\"shop/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:24:\"shop/page/([0-9]{1,})/?$\";s:45:\"index.php?post_type=product&paged=$matches[1]\";s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:32:\"category/(.+?)/wc-api(/(.*))?/?$\";s:54:\"index.php?category_name=$matches[1]&wc-api=$matches[3]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:29:\"tag/([^/]+)/wc-api(/(.*))?/?$\";s:44:\"index.php?tag=$matches[1]&wc-api=$matches[3]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:38:\"frm_styles/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:48:\"frm_styles/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:68:\"frm_styles/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:63:\"frm_styles/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:63:\"frm_styles/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:44:\"frm_styles/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:27:\"frm_styles/([^/]+)/embed/?$\";s:43:\"index.php?frm_styles=$matches[1]&embed=true\";s:31:\"frm_styles/([^/]+)/trackback/?$\";s:37:\"index.php?frm_styles=$matches[1]&tb=1\";s:39:\"frm_styles/([^/]+)/page/?([0-9]{1,})/?$\";s:50:\"index.php?frm_styles=$matches[1]&paged=$matches[2]\";s:46:\"frm_styles/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?frm_styles=$matches[1]&cpage=$matches[2]\";s:36:\"frm_styles/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?frm_styles=$matches[1]&wc-api=$matches[3]\";s:42:\"frm_styles/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:53:\"frm_styles/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:35:\"frm_styles/([^/]+)(?:/([0-9]+))?/?$\";s:49:\"index.php?frm_styles=$matches[1]&page=$matches[2]\";s:27:\"frm_styles/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"frm_styles/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"frm_styles/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"frm_styles/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"frm_styles/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"frm_styles/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:44:\"frm_form_actions/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:54:\"frm_form_actions/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:74:\"frm_form_actions/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:69:\"frm_form_actions/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:69:\"frm_form_actions/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:50:\"frm_form_actions/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:33:\"frm_form_actions/([^/]+)/embed/?$\";s:49:\"index.php?frm_form_actions=$matches[1]&embed=true\";s:37:\"frm_form_actions/([^/]+)/trackback/?$\";s:43:\"index.php?frm_form_actions=$matches[1]&tb=1\";s:45:\"frm_form_actions/([^/]+)/page/?([0-9]{1,})/?$\";s:56:\"index.php?frm_form_actions=$matches[1]&paged=$matches[2]\";s:52:\"frm_form_actions/([^/]+)/comment-page-([0-9]{1,})/?$\";s:56:\"index.php?frm_form_actions=$matches[1]&cpage=$matches[2]\";s:42:\"frm_form_actions/([^/]+)/wc-api(/(.*))?/?$\";s:57:\"index.php?frm_form_actions=$matches[1]&wc-api=$matches[3]\";s:48:\"frm_form_actions/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:59:\"frm_form_actions/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:41:\"frm_form_actions/([^/]+)(?:/([0-9]+))?/?$\";s:55:\"index.php?frm_form_actions=$matches[1]&page=$matches[2]\";s:33:\"frm_form_actions/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:43:\"frm_form_actions/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:63:\"frm_form_actions/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"frm_form_actions/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"frm_form_actions/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:39:\"frm_form_actions/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:55:\"product-category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:50:\"product-category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:31:\"product-category/(.+?)/embed/?$\";s:44:\"index.php?product_cat=$matches[1]&embed=true\";s:43:\"product-category/(.+?)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_cat=$matches[1]&paged=$matches[2]\";s:25:\"product-category/(.+?)/?$\";s:33:\"index.php?product_cat=$matches[1]\";s:52:\"product-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:47:\"product-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:28:\"product-tag/([^/]+)/embed/?$\";s:44:\"index.php?product_tag=$matches[1]&embed=true\";s:40:\"product-tag/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_tag=$matches[1]&paged=$matches[2]\";s:22:\"product-tag/([^/]+)/?$\";s:33:\"index.php?product_tag=$matches[1]\";s:35:\"product/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:45:\"product/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:65:\"product/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"product/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"product/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:41:\"product/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:24:\"product/([^/]+)/embed/?$\";s:40:\"index.php?product=$matches[1]&embed=true\";s:28:\"product/([^/]+)/trackback/?$\";s:34:\"index.php?product=$matches[1]&tb=1\";s:48:\"product/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:43:\"product/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:36:\"product/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&paged=$matches[2]\";s:43:\"product/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&cpage=$matches[2]\";s:33:\"product/([^/]+)/wc-api(/(.*))?/?$\";s:48:\"index.php?product=$matches[1]&wc-api=$matches[3]\";s:39:\"product/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:50:\"product/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:32:\"product/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?product=$matches[1]&page=$matches[2]\";s:24:\"product/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:34:\"product/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:54:\"product/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"product/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"product/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:30:\"product/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:42:\"turbo sidebars/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:52:\"turbo sidebars/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:72:\"turbo sidebars/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"turbo sidebars/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:67:\"turbo sidebars/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:48:\"turbo sidebars/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:31:\"turbo sidebars/([^/]+)/embed/?$\";s:50:\"index.php?turbo-sidebar-cpt=$matches[1]&embed=true\";s:35:\"turbo sidebars/([^/]+)/trackback/?$\";s:44:\"index.php?turbo-sidebar-cpt=$matches[1]&tb=1\";s:43:\"turbo sidebars/([^/]+)/page/?([0-9]{1,})/?$\";s:57:\"index.php?turbo-sidebar-cpt=$matches[1]&paged=$matches[2]\";s:50:\"turbo sidebars/([^/]+)/comment-page-([0-9]{1,})/?$\";s:57:\"index.php?turbo-sidebar-cpt=$matches[1]&cpage=$matches[2]\";s:40:\"turbo sidebars/([^/]+)/wc-api(/(.*))?/?$\";s:58:\"index.php?turbo-sidebar-cpt=$matches[1]&wc-api=$matches[3]\";s:46:\"turbo sidebars/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:57:\"turbo sidebars/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:39:\"turbo sidebars/([^/]+)(?:/([0-9]+))?/?$\";s:56:\"index.php?turbo-sidebar-cpt=$matches[1]&page=$matches[2]\";s:31:\"turbo sidebars/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:41:\"turbo sidebars/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:61:\"turbo sidebars/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"turbo sidebars/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\"turbo sidebars/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:37:\"turbo sidebars/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:17:\"wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:26:\"comments/wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:29:\"search/(.+)/wc-api(/(.*))?/?$\";s:42:\"index.php?s=$matches[1]&wc-api=$matches[3]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:32:\"author/([^/]+)/wc-api(/(.*))?/?$\";s:52:\"index.php?author_name=$matches[1]&wc-api=$matches[3]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:54:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:82:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&wc-api=$matches[5]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:41:\"([0-9]{4})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:66:\"index.php?year=$matches[1]&monthnum=$matches[2]&wc-api=$matches[4]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:28:\"([0-9]{4})/wc-api(/(.*))?/?$\";s:45:\"index.php?year=$matches[1]&wc-api=$matches[3]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:25:\"(.?.+?)/wc-api(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&wc-api=$matches[3]\";s:28:\"(.?.+?)/order-pay(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&order-pay=$matches[3]\";s:33:\"(.?.+?)/order-received(/(.*))?/?$\";s:57:\"index.php?pagename=$matches[1]&order-received=$matches[3]\";s:25:\"(.?.+?)/orders(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&orders=$matches[3]\";s:29:\"(.?.+?)/view-order(/(.*))?/?$\";s:53:\"index.php?pagename=$matches[1]&view-order=$matches[3]\";s:28:\"(.?.+?)/downloads(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&downloads=$matches[3]\";s:31:\"(.?.+?)/edit-account(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-account=$matches[3]\";s:31:\"(.?.+?)/edit-address(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-address=$matches[3]\";s:34:\"(.?.+?)/payment-methods(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&payment-methods=$matches[3]\";s:32:\"(.?.+?)/lost-password(/(.*))?/?$\";s:56:\"index.php?pagename=$matches[1]&lost-password=$matches[3]\";s:34:\"(.?.+?)/customer-logout(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&customer-logout=$matches[3]\";s:37:\"(.?.+?)/add-payment-method(/(.*))?/?$\";s:61:\"index.php?pagename=$matches[1]&add-payment-method=$matches[3]\";s:40:\"(.?.+?)/delete-payment-method(/(.*))?/?$\";s:64:\"index.php?pagename=$matches[1]&delete-payment-method=$matches[3]\";s:45:\"(.?.+?)/set-default-payment-method(/(.*))?/?$\";s:69:\"index.php?pagename=$matches[1]&set-default-payment-method=$matches[3]\";s:31:\".?.+?/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:42:\".?.+?/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:25:\"([^/]+)/wc-api(/(.*))?/?$\";s:45:\"index.php?name=$matches[1]&wc-api=$matches[3]\";s:31:\"[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:42:\"[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:24:{i:0;s:37:\"widgets-on-pages/widgets_on_pages.php\";i:1;s:30:\"advanced-custom-fields/acf.php\";i:2;s:31:\"code-snippets/code-snippets.php\";i:3;s:30:\"development/qt-development.php\";i:4;s:33:\"duplicate-post/duplicate-post.php\";i:5;s:28:\"embedit-pro/embed-it-pro.php\";i:6;s:28:\"essentials/qt-essentials.php\";i:7;s:25:\"formidable/formidable.php\";i:8;s:29:\"image-widget/image-widget.php\";i:9;s:67:\"import-users-from-csv-with-meta/import-users-from-csv-with-meta.php\";i:10;s:35:\"jquery-colorbox/jquery-colorbox.php\";i:11;s:47:\"mappress-google-maps-for-wordpress/mappress.php\";i:12;s:31:\"master-slider/master-slider.php\";i:13;s:16:\"misc/qt-misc.php\";i:14;s:61:\"no-right-click-images-plugin/no-right-click-images-plugin.php\";i:15;s:33:\"page-in-widget/page-in-widget.php\";i:16;s:53:\"page-management-dropdown/page-management-dropdown.php\";i:17;s:89:\"pricing-discounts-by-user-role-woocommerce/pricing-discounts-by-user-role-woocommerce.php\";i:19;s:24:\"security/qt-security.php\";i:20;s:18:\"speed/qt-speed.php\";i:21;s:41:\"woo-discount-rules/woo-discount-rules.php\";i:22;s:16:\"wooc/qt-wooc.php\";i:23;s:42:\"woocommerce-menu-bar-cart/wp-menu-cart.php\";i:24;s:27:\"woocommerce/woocommerce.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'pt1trans', 'yes'),
(41, 'stylesheet', 'pt1trans', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '0', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:0:{}', 'yes'),
(80, 'widget_rss', 'a:0:{}', 'yes'),
(81, 'uninstall_plugins', 'a:4:{s:72:\"C:/xampp/htdocs/richmondmediahosting/wp-content/themes/pt1/functions.php\";s:14:\"ccss_uninstall\";s:77:\"C:/xampp/htdocs/richmondmediahosting/wp-content/themes/pt1trans/functions.php\";s:14:\"ccss_uninstall\";s:35:\"jquery-colorbox/jquery-colorbox.php\";a:2:{i:0;s:14:\"JQueryColorbox\";i:1;s:23:\"uninstallJqueryColorbox\";}s:61:\"no-right-click-images-plugin/no-right-click-images-plugin.php\";s:23:\"kpg_no_rc_img_uninstall\";}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'initial_db_version', '38590', 'yes'),
(92, 'wp_user_roles', 'a:7:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:145:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:19:\"access_masterslider\";b:1;s:20:\"publish_masterslider\";b:1;s:19:\"delete_masterslider\";b:1;s:19:\"create_masterslider\";b:1;s:19:\"export_masterslider\";b:1;s:22:\"duplicate_masterslider\";b:1;s:15:\"manage_snippets\";b:1;s:14:\"frm_view_forms\";b:1;s:14:\"frm_edit_forms\";b:1;s:16:\"frm_delete_forms\";b:1;s:19:\"frm_change_settings\";b:1;s:16:\"frm_view_entries\";b:1;s:18:\"frm_delete_entries\";b:1;s:10:\"copy_posts\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;s:17:\"edit_shop_webhook\";b:1;s:17:\"read_shop_webhook\";b:1;s:19:\"delete_shop_webhook\";b:1;s:18:\"edit_shop_webhooks\";b:1;s:25:\"edit_others_shop_webhooks\";b:1;s:21:\"publish_shop_webhooks\";b:1;s:26:\"read_private_shop_webhooks\";b:1;s:20:\"delete_shop_webhooks\";b:1;s:28:\"delete_private_shop_webhooks\";b:1;s:30:\"delete_published_shop_webhooks\";b:1;s:27:\"delete_others_shop_webhooks\";b:1;s:26:\"edit_private_shop_webhooks\";b:1;s:28:\"edit_published_shop_webhooks\";b:1;s:25:\"manage_shop_webhook_terms\";b:1;s:23:\"edit_shop_webhook_terms\";b:1;s:25:\"delete_shop_webhook_terms\";b:1;s:25:\"assign_shop_webhook_terms\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:41:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:19:\"access_masterslider\";b:1;s:20:\"publish_masterslider\";b:1;s:19:\"delete_masterslider\";b:1;s:19:\"create_masterslider\";b:1;s:19:\"export_masterslider\";b:1;s:22:\"duplicate_masterslider\";b:1;s:10:\"copy_posts\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:8:\"customer\";a:2:{s:4:\"name\";s:8:\"Customer\";s:12:\"capabilities\";a:1:{s:4:\"read\";b:1;}}s:12:\"shop_manager\";a:2:{s:4:\"name\";s:12:\"Shop manager\";s:12:\"capabilities\";a:109:{s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:4:\"read\";b:1;s:18:\"read_private_pages\";b:1;s:18:\"read_private_posts\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_posts\";b:1;s:10:\"edit_pages\";b:1;s:20:\"edit_published_posts\";b:1;s:20:\"edit_published_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"edit_private_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:17:\"edit_others_pages\";b:1;s:13:\"publish_posts\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_posts\";b:1;s:12:\"delete_pages\";b:1;s:20:\"delete_private_pages\";b:1;s:20:\"delete_private_posts\";b:1;s:22:\"delete_published_pages\";b:1;s:22:\"delete_published_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:19:\"delete_others_pages\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:17:\"moderate_comments\";b:1;s:12:\"upload_files\";b:1;s:6:\"export\";b:1;s:6:\"import\";b:1;s:10:\"list_users\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;s:17:\"edit_shop_webhook\";b:1;s:17:\"read_shop_webhook\";b:1;s:19:\"delete_shop_webhook\";b:1;s:18:\"edit_shop_webhooks\";b:1;s:25:\"edit_others_shop_webhooks\";b:1;s:21:\"publish_shop_webhooks\";b:1;s:26:\"read_private_shop_webhooks\";b:1;s:20:\"delete_shop_webhooks\";b:1;s:28:\"delete_private_shop_webhooks\";b:1;s:30:\"delete_published_shop_webhooks\";b:1;s:27:\"delete_others_shop_webhooks\";b:1;s:26:\"edit_private_shop_webhooks\";b:1;s:28:\"edit_published_shop_webhooks\";b:1;s:25:\"manage_shop_webhook_terms\";b:1;s:23:\"edit_shop_webhook_terms\";b:1;s:25:\"delete_shop_webhook_terms\";b:1;s:25:\"assign_shop_webhook_terms\";b:1;}}}', 'yes'),
(93, 'fresh_site', '0', 'yes'),
(94, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(95, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(96, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(97, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'sidebars_widgets', 'a:14:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:18:\"header-widget-area\";a:0:{}s:16:\"logo-widget-area\";a:0:{}s:19:\"contact-widget-area\";a:0:{}s:18:\"slogan-widget-area\";a:0:{}s:21:\"first-nav-widget-area\";a:0:{}s:22:\"second-nav-widget-area\";a:0:{}s:26:\"first-page-top-widget-area\";a:0:{}s:29:\"first-content-top-widget-area\";a:0:{}s:32:\"first-content-bottom-widget-area\";a:0:{}s:29:\"first-page-bottom-widget-area\";a:0:{}s:24:\"first-footer-widget-area\";a:0:{}s:9:\"arbitrary\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(100, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'cron', 'a:10:{i:1522265203;a:1:{s:32:\"woocommerce_cancel_unpaid_orders\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:0:{}}}}i:1522281600;a:1:{s:27:\"woocommerce_scheduled_sales\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1522294085;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1522294678;a:1:{s:41:\"puc_cron_check_updates-woo-discount-rules\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1522294699;a:1:{s:28:\"woocommerce_cleanup_sessions\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1522337307;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1522337899;a:1:{s:30:\"woocommerce_tracker_send_event\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1522338483;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1522713600;a:1:{s:25:\"woocommerce_geoip_updater\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:7:\"monthly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:2635200;}}}s:7:\"version\";i:2;}', 'yes'),
(110, 'theme_mods_twentyfifteen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1521473313;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}', 'yes'),
(122, 'can_compress_scripts', '1', 'no'),
(136, 'current_theme', 'pt1trans', 'yes'),
(137, 'theme_mods_pt1', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1521473350;s:4:\"data\";a:13:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:18:\"header-widget-area\";a:0:{}s:16:\"logo-widget-area\";a:0:{}s:19:\"contact-widget-area\";a:0:{}s:18:\"slogan-widget-area\";a:0:{}s:21:\"first-nav-widget-area\";a:0:{}s:22:\"second-nav-widget-area\";a:0:{}s:26:\"first-page-top-widget-area\";a:0:{}s:29:\"first-content-top-widget-area\";a:0:{}s:32:\"first-content-bottom-widget-area\";a:0:{}s:29:\"first-page-bottom-widget-area\";a:0:{}s:24:\"first-footer-widget-area\";a:0:{}s:9:\"arbitrary\";a:0:{}}}}', 'yes'),
(138, 'theme_switched', '', 'yes'),
(139, 'widget_wptc_row', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(140, 'widget_wptc_col', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(141, 'widget_vmenu_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(142, 'widget_wptc_login_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(143, 'widget_excludecategory', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(153, 'theme_mods_pt1trans', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:1:{s:10:\"guest-menu\";i:16;}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(169, 'recently_activated', 'a:0:{}', 'yes'),
(170, 'frm_last_style_update', '3191536', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(171, 'frmpro_css', '/* WARNING: Any changes made to this file will be lost when your Formidable settings are updated */\n.frm_form_field .grecaptcha-badge,.frm_hidden,.with_frm_style .frm_button.frm_hidden{display:none;}form input.frm_verify{display:none !important;}.with_frm_style fieldset{min-width:0;}legend.frm_hidden{display:none !important;}.with_frm_style .frm_form_fields{opacity:1;transition: opacity 0.1s linear;}.with_frm_style .frm_doing_ajax{opacity:.5;}.frm_transparent{color:transparent;}.input[type=file].frm_transparent:focus, .with_frm_style input[type=file]{background-color:transparent;border:none;outline:none;box-shadow:none;}.with_frm_style input[type=file]{display:initial;}.frm_preview_page:before{content:normal !important;}.frm_preview_page{padding:25px;}.with_frm_style .form-field.frm_col_field{clear:none;float:left;margin-right:20px;}.with_frm_style label.frm_primary_label{max-width:100%;}.with_frm_style .frm_top_container label.frm_primary_label,.with_frm_style .frm_hidden_container label.frm_primary_label,.with_frm_style .frm_pos_top{display:block;float:none;width:auto;}.with_frm_style .frm_inline_container label.frm_primary_label{margin-right:10px;}.with_frm_style .frm_right_container label.frm_primary_label,.with_frm_style .frm_pos_right{display:inline;float:right;margin-left:10px;}.with_frm_style .frm_none_container label.frm_primary_label,.with_frm_style .frm_pos_none,.frm_none_container label.frm_primary_label{display:none;}.with_frm_style .frm_section_heading.frm_hide_section{margin-top:0 !important;}.with_frm_style .frm_hidden_container label.frm_primary_label,.with_frm_style .frm_pos_hidden,.frm_hidden_container label.frm_primary_label{visibility:hidden;}.with_frm_style .frm_inside_container label.frm_primary_label{opacity:0;transition: opacity 0.1s linear;}.with_frm_style .frm_inside_container label.frm_visible,.frm_visible{opacity:1;}.with_frm_style .frm_description{clear:both;}.with_frm_style .frm_scale{margin-right:10px;text-align:center;float:left;}.with_frm_style .frm_scale input{display:block;margin:0;}.with_frm_style input[type=number][readonly]{-moz-appearance: textfield;}.with_frm_style select[multiple=\"multiple\"]{height:auto;line-height:normal;}.with_frm_style select{white-space:pre-wrap;}.with_frm_style .frm_catlevel_2,.with_frm_style .frm_catlevel_3,.with_frm_style .frm_catlevel_4,.with_frm_style .frm_catlevel_5{margin-left:18px;}.with_frm_style .wp-editor-container{border:1px solid #e5e5e5;}.with_frm_style .quicktags-toolbar input{font-size:12px !important;}.with_frm_style .wp-editor-container textarea{border:none;}.with_frm_style textarea{height:auto;}.with_frm_style .auto_width #loginform input,.with_frm_style .auto_width input,.with_frm_style input.auto_width,.with_frm_style select.auto_width,.with_frm_style textarea.auto_width{width:auto;}.with_frm_style .frm_repeat_buttons{white-space:nowrap;}.with_frm_style .frm_button{text-decoration:none;border:1px solid #eee;padding:5px;display:inline;}.with_frm_style .frm_submit{clear:both;}.frm_inline_form .frm_form_field.form-field{margin-right:2.5%;display:inline-block;}.frm_inline_form .frm_submit{display:inline-block;}.with_frm_style.frm_center_submit .frm_submit{text-align:center;}.with_frm_style.frm_center_submit .frm_submit input[type=submit],.with_frm_style.frm_center_submit .frm_submit input[type=button],.with_frm_style.frm_center_submit .frm_submit button{margin-bottom:8px !important;}.with_frm_style .frm_submit input[type=submit],.with_frm_style .frm_submit input[type=button],.with_frm_style .frm_submit button{-webkit-appearance: none;cursor: pointer;}.with_frm_style.frm_center_submit .frm_submit .frm_ajax_loading{display: block;margin: 0 auto;}.with_frm_style .frm_loading_form .frm_ajax_loading{visibility:visible !important;}.with_frm_style .frm_loading_form .frm_button_submit {position: relative;opacity: .8;color: transparent !important;text-shadow: none !important;}.with_frm_style .frm_loading_form .frm_button_submit:hover,.with_frm_style .frm_loading_form .frm_button_submit:active,.with_frm_style .frm_loading_form .frm_button_submit:focus {cursor: not-allowed;color: transparent;outline: none !important;box-shadow: none;}.with_frm_style .frm_loading_form .frm_button_submit:before {content: \'\';display: inline-block;position: absolute;background: transparent;border: 1px solid #fff;border-top-color: transparent;border-left-color: transparent;border-radius: 50%;box-sizing: border-box;top: 50%;left: 50%;margin-top: -10px;margin-left: -10px;width: 20px;height: 20px;-webkit-animation: spin 2s linear infinite;-moz-animation:spin 2s linear infinite;-o-animation:  spin 2s linear infinite;animation: spin 2s linear infinite;}@keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg); }}.frm_forms.frm_style_formidable-style.with_frm_style{max-width:100%;direction:ltr;}.frm_style_formidable-style.with_frm_style,.frm_style_formidable-style.with_frm_style form,.frm_style_formidable-style.with_frm_style .frm-show-form div.frm_description p {text-align:left;}.frm_style_formidable-style.with_frm_style fieldset{border-width:0px;border-style:solid;border-color:#000000;margin:0;padding:0 0 15px 0;background-color:transparent;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;}.frm_style_formidable-style.with_frm_style legend + h3,.frm_style_formidable-style.with_frm_style h3.frm_form_title{font-size:20px;color:#444444;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;margin-top:10px;margin-bottom:10px;}.frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3{padding:15px 0 3px 0;margin:0;font-size:18px;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-weight:bold;color:#444444;border:none;border-top:2px solid #e8e8e8;background-color:transparent}.frm_style_formidable-style.with_frm_style h3 .frm_after_collapse{display:inline;}.frm_style_formidable-style.with_frm_style h3 .frm_before_collapse{display:none;}.menu-edit #post-body-content .frm_style_formidable-style.with_frm_style .frm_section_heading h3{margin:0;}.frm_style_formidable-style.with_frm_style .frm_section_heading{margin-top:15px;}.frm_style_formidable-style.with_frm_style  .frm-show-form .frm_section_heading .frm_section_spacing,.menu-edit #post-body-content .frm_style_formidable-style.with_frm_style  .frm-show-form .frm_section_heading .frm_section_spacing{margin-bottom:12px;}.frm_style_formidable-style.with_frm_style .frm_repeat_sec{margin-bottom:20px;margin-top:20px;}.frm_style_formidable-style.with_frm_style label.frm_primary_label,.frm_style_formidable-style.with_frm_style.frm_login_form label{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;color:#444444;font-weight:bold;text-align:left;margin:0;padding:0 0 3px 0;width:auto;display:block;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_container,.frm_style_formidable-style.with_frm_style .frm_form_field .frm_show_it{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;color:#666666;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_container{font-size:14px;}.frm_style_formidable-style.with_frm_style .frm_form_field .frm_show_it{font-size:14px;font-weight:normal;}.frm_style_formidable-style.with_frm_style .frm_icon_font{color:#444444;}.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_minus_icon:before{content:\"\\e600\";}.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_plus_icon:before{content:\"\\e602\";}.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_minus_icon:before,.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_plus_icon:before{color:#444444;}.frm_style_formidable-style.with_frm_style .frm_trigger.active .frm_icon_font.frm_arrow_icon:before{content:\"\\e62d\";color:#444444;}.frm_style_formidable-style.with_frm_style .frm_trigger .frm_icon_font.frm_arrow_icon:before{content:\"\\e62a\";color:#444444;}.frm_style_formidable-style.with_frm_style .form-field{margin-bottom:20px;}.frm_style_formidable-style.with_frm_style .frm_grid,.frm_style_formidable-style.with_frm_style .frm_grid_first,.frm_style_formidable-style.with_frm_style .frm_grid_odd {margin-bottom:0;}.frm_style_formidable-style.with_frm_style .form-field.frm_section_heading{margin-bottom:0;}.frm_style_formidable-style.with_frm_style p.description,.frm_style_formidable-style.with_frm_style div.description,.frm_style_formidable-style.with_frm_style div.frm_description,.frm_style_formidable-style.with_frm_style .frm-show-form > div.frm_description,.frm_style_formidable-style.with_frm_style .frm_error{margin:0;padding:0;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:12px;color:#666666;font-weight:normal;text-align:left;font-style:normal;max-width:100%;}.frm_style_formidable-style.with_frm_style .frm-show-form div.frm_description p{font-size:14px;color:#666666;margin-top:10px;margin-bottom:25px;}.frm_style_formidable-style.with_frm_style .frm_left_container label.frm_primary_label{float:left;display:inline;width:150px;max-width:33%;margin-right:10px;}.frm_style_formidable-style.with_frm_style .frm_right_container label.frm_primary_label{display:inline;width:150px;max-width:33%;margin-left:10px;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .chosen-container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .chosen-container{max-width:62%;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_combo_inputs_container .frm_form_field input,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_combo_inputs_container .frm_form_field select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_combo_inputs_container .frm_form_field input,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_combo_inputs_container .frm_form_field select{max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm-g-recaptcha{display:inline-block;}.frm_style_formidable-style.with_frm_style .frm_left_container > p.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.frm_description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > .frm_error::before,.frm_style_formidable-style.with_frm_style .frm_right_container > p.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.frm_description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > .frm_error::after{content:\'\';display:inline-block;width:150px;max-width:33%;margin-right:10px;}.frm_style_formidable-style.with_frm_style .frm_left_container.frm_inline label.frm_primary_label{max-width:90%;}.frm_style_formidable-style.with_frm_style .form-field.frm_col_field div.frm_description{width:100%;max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_inline_container label.frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_inline_container.frm_dynamic_select_container .frm_opt_container{display:inline;}.frm_style_formidable-style.with_frm_style .frm_inline_container label.frm_primary_label{margin-right:10px;}.frm_style_formidable-style.with_frm_style .frm_pos_right{display:inline;width:150px;}.frm_style_formidable-style.with_frm_style .frm_none_container label.frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_pos_none{display:none;}.frm_style_formidable-style.with_frm_style .frm_scale label{font-weight:normal;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:13px;color:#444444;}.frm_style_formidable-style.with_frm_style .frm_required{color:#B94A48;font-weight:bold;}.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=search],.frm_style_formidable-style.with_frm_style select,.frm_style_formidable-style.with_frm_style textarea,.frm_style_formidable-style.with_frm_style .chosen-container{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;margin-bottom:0;}.frm_style_formidable-style.with_frm_style textarea{vertical-align:top;}.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=phone],.frm_style_formidable-style.with_frm_style input[type=search],.frm_style_formidable-style.with_frm_style select,.frm_style_formidable-style.with_frm_style textarea,.frm_form_fields_style,.frm_style_formidable-style.with_frm_style .frm_scroll_box .frm_opt_container,.frm_form_fields_active_style,.frm_form_fields_error_style,.frm_style_formidable-style.with_frm_style .chosen-container-multi .chosen-choices,.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-single{color:#555555;background-color:#ffffff;border-color: #cccccc;border-width:1px;border-style:solid;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:100%;max-width:100%;font-size:14px;padding:6px 10px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;outline:none;font-weight:normal;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset;}.frm_style_formidable-style.with_frm_style input[type=file]::-webkit-file-upload-button{color:#555555;background-color:#ffffff;padding:6px 10px;border-radius:4px;border-color: #cccccc;border-width:1px;border-style:solid;}.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=file],.frm_style_formidable-style.with_frm_style input[type=search],.frm_style_formidable-style.with_frm_style select{height:32px;line-height:1.3;}.frm_style_formidable-style.with_frm_style select[multiple=\"multiple\"]{height:auto ;}.frm_style_formidable-style.with_frm_style input[type=file]{color: #555555;padding:0px;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;}.frm_style_formidable-style.with_frm_style input[type=file].frm_transparent{color:transparent;}.frm_style_formidable-style.with_frm_style select{width:100%;max-width:100%;}.frm_style_formidable-style.with_frm_style input.frm_other_input:not(.frm_other_full){width:auto ;margin-left:5px ;}.frm_style_formidable-style.with_frm_style .horizontal_radio input.frm_other_input:not(.frm_other_full):not(.frm_pos_none) {display:inline-block;}.frm_style_formidable-style.with_frm_style .frm_full input.frm_other_input:not(.frm_other_full){margin-left:0 ;margin-top:8px;}.frm_style_formidable-style.with_frm_style .frm_other_container select:not([multiple=\"multiple\"]){width:auto;}.frm_style_formidable-style.with_frm_style .wp-editor-wrap{width:100%;max-width:100%;}.frm_style_formidable-style.with_frm_style .wp-editor-container textarea{border:none;}.frm_style_formidable-style.with_frm_style .mceIframeContainer{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .auto_width input,.frm_style_formidable-style.with_frm_style input.auto_width,.frm_style_formidable-style.with_frm_style select.auto_width,.frm_style_formidable-style.with_frm_style textarea.auto_width{width:auto;}.frm_style_formidable-style.with_frm_style input[disabled],.frm_style_formidable-style.with_frm_style select[disabled],.frm_style_formidable-style.with_frm_style textarea[disabled],.frm_style_formidable-style.with_frm_style input[readonly],.frm_style_formidable-style.with_frm_style select[readonly],.frm_style_formidable-style.with_frm_style textarea[readonly]{background-color:ffffff;color: #A1A1A1;border-color:#E5E5E5;}.frm_style_formidable-style.with_frm_style input::placeholder,.frm_style_formidable-style.with_frm_style textarea::placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input::-webkit-input-placeholder,.frm_style_formidable-style.with_frm_style textarea::-webkit-input-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input::-moz-placeholder,.frm_style_formidable-style.with_frm_style textarea::-moz-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input:-ms-input-placeholder,frm_style_formidable-style.with_frm_style textarea:-ms-input-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input:-moz-placeholder,.frm_style_formidable-style.with_frm_style textarea:-moz-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style .frm_default,.frm_style_formidable-style.with_frm_style input.frm_default,.frm_style_formidable-style.with_frm_style textarea.frm_default,.frm_style_formidable-style.with_frm_style select.frm_default,.frm_style_formidable-style.with_frm_style .placeholder,.frm_style_formidable-style.with_frm_style .chosen-container-multi .chosen-choices li.search-field .default,.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-default{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style .form-field input:not([type=file]):focus,.frm_style_formidable-style.with_frm_style select:focus,.frm_style_formidable-style.with_frm_style textarea:focus,.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=text],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=password],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=email],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=number],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=url],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=tel],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=search],.frm_form_fields_active_style,.frm_style_formidable-style.with_frm_style .chosen-container-active .chosen-choices{background-color:ffffff;border-color:#66afe9;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102,175,233, 0.6);}.frm_style_formidable-style.with_frm_style .frm_submit.frm_inline_submit::before {content:\"before\";font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;color:#444444;font-weight:bold;margin:0;padding:0 0 3px 0;width:auto;display:block;visibility:hidden;}.frm_style_formidable-style.with_frm_style .frm_submit.frm_inline_submit input,.frm_style_formidable-style.with_frm_style .frm_submit.frm_inline_submit button {margin-top: 0 ;}.frm_style_formidable-style.with_frm_style .frm_compact .frm_dropzone.dz-clickable .dz-message,.frm_style_formidable-style.with_frm_style input[type=submit],.frm_style_formidable-style.with_frm_style .frm_submit input[type=button],.frm_style_formidable-style.with_frm_style .frm_submit button,.frm_form_submit_style,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]{width:auto;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;height:auto;line-height:normal;text-align:center;background:#ffffff;border-width:1px;border-color: #cccccc;border-style:solid;color:#444444;cursor:pointer;font-weight:normal;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;text-shadow:none;padding:6px 11px;-moz-box-sizing:border-box;box-sizing:border-box;-ms-box-sizing:border-box;-moz-box-shadow:0 1px 1px #eeeeee;-webkit-box-shadow:0 1px 1px #eeeeee;box-shadow:0 1px 1px #eeeeee;margin:10px;margin-left:0;margin-right:0;vertical-align:middle;}.frm_style_formidable-style.with_frm_style .frm_compact .frm_dropzone.dz-clickable .dz-message{margin:0;}.frm_style_formidable-style.with_frm_style input[type=submit]:hover,.frm_style_formidable-style.with_frm_style .frm_submit input[type=button]:hover,.frm_style_formidable-style.with_frm_style .frm_submit button:hover,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]:hover{background: #efefef;border-color: #cccccc;color: #444444;}.frm_style_formidable-style.with_frm_style.frm_center_submit .frm_submit .frm_ajax_loading{margin-bottom:10px;}.frm_style_formidable-style.with_frm_style input[type=submit]:focus,.frm_style_formidable-style.with_frm_style .frm_submit input[type=button]:focus,.frm_style_formidable-style.with_frm_style .frm_submit button:focus,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]:focus,.frm_style_formidable-style.with_frm_style input[type=submit]:active,.frm_style_formidable-style.with_frm_style .frm_submit input[type=button]:active,.frm_style_formidable-style.with_frm_style .frm_submit button:active,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]:active{background: #efefef;border-color: #cccccc;color: #444444;}.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit,.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:hover,.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:active,.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:focus{color: transparent ;background: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:before {border-bottom-color: #444444;border-right-color: #444444;max-height:auto;max-width:auto;}.frm_style_formidable-style.with_frm_style a.frm_save_draft{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;font-weight:normal;}.frm_style_formidable-style.with_frm_style #frm_field_cptch_number_container{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;color:#444444;font-weight:bold;clear:both;}.frm_style_formidable-style.with_frm_style .frm_radio{display:block;}.frm_style_formidable-style.with_frm_style .horizontal_radio .frm_radio{margin:0 5px 0 0;}.frm_style_formidable-style.with_frm_style .frm_checkbox{display:block;}.frm_style_formidable-style.with_frm_style .vertical_radio .frm_checkbox,.frm_style_formidable-style.with_frm_style .vertical_radio .frm_radio,.vertical_radio .frm_catlevel_1{display:block;}.frm_style_formidable-style.with_frm_style .horizontal_radio .frm_checkbox,.frm_style_formidable-style.with_frm_style .horizontal_radio .frm_radio,.horizontal_radio .frm_catlevel_1{display:inline-block;}.frm_style_formidable-style.with_frm_style .frm_radio label,.frm_style_formidable-style.with_frm_style .frm_checkbox label{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:13px;color:#444444;font-weight:normal;display:inline;white-space:normal;}.frm_style_formidable-style.with_frm_style .frm_radio input[type=radio],.frm_style_formidable-style.with_frm_style .frm_checkbox input[type=checkbox] {font-size: 13px;position: static;;}.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=text],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=password],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=url],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=tel],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=number],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=email],.frm_style_formidable-style.with_frm_style .frm_blank_field textarea,.frm_style_formidable-style.with_frm_style .frm_blank_field .mce-edit-area iframe,.frm_style_formidable-style.with_frm_style .frm_blank_field select,.frm_form_fields_error_style,.frm_style_formidable-style.with_frm_style .frm_blank_field .frm-g-recaptcha iframe,.frm_style_formidable-style.with_frm_style .frm_blank_field .g-recaptcha iframe,.frm_style_formidable-style.with_frm_style .frm_blank_field .chosen-container-multi .chosen-choices,.frm_style_formidable-style.with_frm_style .frm_form_field :invalid{color:#444444;background-color:ffffff;border-color:#B94A48;border-width:1px;border-style:solid;}.frm_style_formidable-style.with_frm_style .frm_blank_field .sigWrapper{border-color:#B94A48 !important;}.frm_style_formidable-style.with_frm_style .frm_error{font-weight:bold;}.frm_style_formidable-style.with_frm_style .frm_blank_field label,.frm_style_formidable-style.with_frm_style .frm_error{color:#B94A48;}.frm_style_formidable-style.with_frm_style .frm_error_style{background-color:#F2DEDE;border:1px solid #EBCCD1;border-radius:4px;color: #B94A48;font-size:14px;margin:0;margin-bottom:20px;}.frm_style_formidable-style.with_frm_style .frm_message,.frm_success_style{border:1px solid #D6E9C6;background-color:#DFF0D8;color:#468847;border-radius:4px;}.frm_style_formidable-style.with_frm_style .frm_message p{color:#468847;}.frm_style_formidable-style.with_frm_style .frm_message{margin:5px 0 15px;font-size:14px;}.frm_style_formidable-style.with_frm_style .frm-grid td,.frm-grid th{border-color:#cccccc;}.form_results.frm_style_formidable-style.with_frm_style{border:1px solid #cccccc;}.form_results.frm_style_formidable-style.with_frm_style tr td{color: #555555;border-top:1px solid #cccccc;}.form_results.frm_style_formidable-style.with_frm_style tr.frm_even,.frm-grid .frm_even{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style #frm_loading .progress-striped .progress-bar{background-image:linear-gradient(45deg, #cccccc 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, ##cccccc 50%, #cccccc 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));}.frm_style_formidable-style.with_frm_style #frm_loading .progress-bar{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .frm_grid,.frm_style_formidable-style.with_frm_style .frm_grid_first,.frm_style_formidable-style.with_frm_style .frm_grid_odd{border-color: #cccccc;}.frm_style_formidable-style.with_frm_style .frm_grid.frm_blank_field,.frm_style_formidable-style.with_frm_style .frm_grid_first.frm_blank_field,.frm_style_formidable-style.with_frm_style .frm_grid_odd.frm_blank_field{background-color:#F2DEDE;border-color:#EBCCD1;}.frm_style_formidable-style.with_frm_style .frm_grid_first,.frm_style_formidable-style.with_frm_style .frm_grid_odd{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .frm_grid{background-color:ffffff;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_scroll_box{background-color:#ffffff;border-color: #cccccc;border-width:1px;border-style:solid;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:100%;font-size:14px;padding:6px 10px;outline:none;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_total input,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_total textarea{color: #555555;background-color:transparent;border:none;display:inline;width:auto;padding:0;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_checkbox label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_radio label{padding-left:20px;display:block;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_checkbox input[type=checkbox],.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_radio input[type=radio]{margin-left:-20px;}.frm_style_formidable-style.with_frm_style .frm_button{padding:6px 11px;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;font-size:14px;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-weight:normal;color:#444444;background: #ffffff;border-width:1px;border-color: #cccccc;height:auto;}.frm_style_formidable-style.with_frm_style .frm_button .frm_icon_font:before{font-size:14px;}.frm_style_formidable-style.with_frm_style .frm_dropzone{border-color: #cccccc;border-radius:4px;color: #555555;background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .frm_dropzone .frm_upload_icon:before,.frm_style_formidable-style.with_frm_style .frm_dropzone .dz-remove{color: #555555;}.frm_style_formidable-style.with_frm_style .frm_blank_field .frm_dropzone{border-color:#B94A48;color:#444444;background-color:ffffff;}.frm_style_formidable-style.with_frm_style .chosen-container{font-size:14px;}.frm_style_formidable-style.with_frm_style .chosen-container .chosen-results li,.frm_style_formidable-style.with_frm_style .chosen-container .chosen-results li span{color:#555555;}.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-single{height:32px;line-height:1.3;}.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-single div{top:3px;}.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-search input[type=\"text\"]{height:32px;}.frm_style_formidable-style.with_frm_style .chosen-container-multi .chosen-choices li.search-field input[type=\"text\"]{height:15px;}.frm_style_formidable-style.with_frm_style .frm_page_bar input,.frm_style_formidable-style.with_frm_style .frm_page_bar input:disabled{color: #ffffff;background-color: #dddddd;border-color: #dfdfdf;border-width: 2px;}.frm_style_formidable-style.with_frm_style .frm_progress_line input.frm_page_back{background-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_page_bar .frm_current_page input[type=\"button\"]{background-color: #dddddd;border-color: #dfdfdf;opacity:1;}.frm_style_formidable-style.with_frm_style .frm_current_page .frm_rootline_title{color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_rootline_title,.frm_style_formidable-style.with_frm_style .frm_pages_complete,.frm_style_formidable-style.with_frm_style .frm_percent_complete{color: #666666;}.frm_style_formidable-style.with_frm_style .frm_progress_line input,.frm_style_formidable-style.with_frm_style .frm_progress_line input:disabled {border-color: #dfdfdf;}.frm_style_formidable-style.with_frm_style .frm_progress_line.frm_show_lines input {border-left-color: #ffffff;border-right-color: #ffffff;border-left-width: 1px ;border-right-width: 1px ;}.frm_style_formidable-style.with_frm_style .frm_progress_line li:first-of-type input {border-left-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_progress_line li:last-of-type input {border-right-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_progress_line li:last-of-type input.frm_page_skip {border-right-color: #dfdfdf;}.frm_style_formidable-style.with_frm_style .frm_progress_line .frm_current_page input[type=\"button\"] {border-left-color: #dfdfdf;}.frm_style_formidable-style.with_frm_style .frm_progress_line.frm_show_lines .frm_current_page input[type=\"button\"] {border-right-color: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_progress_line input.frm_page_back {border-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_progress_line.frm_show_lines input.frm_page_back{border-left-color: #008ec2;border-right-color: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_rootline.frm_show_lines:before {border-color: #dfdfdf;border-top-width: 2px;top: 15px;}.frm_style_formidable-style.with_frm_style .frm_rootline input,.frm_style_formidable-style.with_frm_style .frm_rootline input:hover {width: 30px;height: 30px;border-radius: 30px;padding: 0;}.frm_style_formidable-style.with_frm_style .frm_rootline input:focus {border-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_rootline .frm_current_page input[type=\"button\"] {border-color: #007aae;background-color: #008ec2;color: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_progress_line input,.frm_style_formidable-style.with_frm_style .frm_progress_line input:disabled,.frm_style_formidable-style.with_frm_style .frm_progress_line .frm_current_page input[type=\"button\"],.frm_style_formidable-style.with_frm_style .frm_rootline.frm_no_numbers input,.frm_style_formidable-style.with_frm_style .frm_rootline.frm_no_numbers .frm_current_page input[type=\"button\"] {color: transparent !important;}@media only screen and (max-width: 600px){.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container.frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container.g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .chosen-container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container.frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container.g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .chosen-container{max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .frm_primary_label{max-width:100%;margin-right:0;margin-left:0;padding-right:0;padding-left:0;width:100%;}.frm_style_formidable-style.with_frm_style .frm_repeat_inline,.frm_style_formidable-style.with_frm_style .frm_repeat_grid{margin: 20px 0;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_left_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_left_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_left_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .frm_error{margin-right:0;margin-left:0;padding-right:0;padding-left:0;}}@media only screen and (max-width: 500px) {.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .chosen-container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .chosen-container{max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_left_container > p.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.frm_description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > .frm_error::before,.frm_style_formidable-style.with_frm_style .frm_right_container > p.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.frm_description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > .frm_error::after{display:none;}.frm_style_formidable-style.with_frm_style .frm_left_container label.frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_right_container label.frm_primary_label{width:100%;max-width:100%;margin-right:0;margin-left:0;padding-right:0;padding-left:0;}}.frm_ajax_loading{visibility:hidden;width:auto;}.frm_form_submit_style{height:auto;}a.frm_save_draft{cursor:pointer;}.horizontal_radio .frm_radio{margin:0 5px 0 0;}.horizontal_radio .frm_checkbox{margin:0;margin-right:5px;}.vertical_radio .frm_checkbox,.vertical_radio .frm_radio,.vertical_radio .frm_catlevel_1{display:block;}.horizontal_radio .frm_checkbox,.horizontal_radio .frm_radio,.horizontal_radio .frm_catlevel_1{display:inline-block;}.frm_file_container .frm_file_link,.with_frm_style .frm_radio label .frm_file_container,.with_frm_style .frm_checkbox label .frm_file_container{display:inline-block;margin:5px;vertical-align:middle;}.with_frm_style .frm_radio input[type=radio]{border-radius:10px;-webkit-appearance:radio;}.with_frm_style .frm_checkbox input[type=checkbox]{border-radius:0;-webkit-appearance:checkbox;}.with_frm_style .frm_radio input[type=radio],.with_frm_style .frm_checkbox input[type=checkbox]{display:inline-block;margin-right:5px;width:auto;border:none;vertical-align:baseline;}.with_frm_style :invalid,.with_frm_style :-moz-submit-invalid,.with_frm_style :-moz-ui-invalid{box-shadow:none;}.with_frm_style .frm_error_style img{padding-right:10px;vertical-align:middle;border:none;}.with_frm_style .frm_trigger{cursor:pointer;}.with_frm_style .frm_error_style,.with_frm_style .frm_message,.frm_success_style{-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;padding:15px;}.with_frm_style .frm_message p{margin-bottom:5px;}.frm_form_fields_style,.frm_form_fields_active_style,.frm_form_fields_error_style,.frm_form_submit_style{width:auto;}.with_frm_style .frm_trigger span{float:left;}.with_frm_style table.frm-grid,#content .with_frm_style table.frm-grid{border-collapse:collapse;border:none;}.frm-grid td,.frm-grid th{padding:5px;border-width:1px;border-style:solid;border-color:#cccccc;border-top:none;border-left:none;border-right:none;}table.form_results.with_frm_style{border:1px solid #ccc;}table.form_results.with_frm_style tr td{text-align:left;color:#555555;padding:7px 9px;border-top:1px solid #cccccc;}table.form_results.with_frm_style tr.frm_even,.frm-grid .frm_even{background-color:#fff;}table.form_results.with_frm_style tr.frm_odd,.frm-grid .frm_odd{background-color:ffffff;}.frm_collapse .ui-icon{display:inline-block;}.frm_toggle_container{border:1px solid transparent;}.frm_toggle_container ul{margin:5px 0;padding-left:0;list-style-type:none;}.frm_toggle_container .frm_month_heading{text-indent:15px;}.frm_toggle_container .frm_month_listing{margin-left:40px;}#frm_loading{display:none;position:fixed;top:0;left:0;width:100%;height:100%;z-index:99999;}#frm_loading h3{font-weight:500;padding-bottom:15px;color:#fff;font-size:24px;}#frm_loading_content{position:fixed;top:20%;left:33%;width:33%;text-align:center;padding-top:30px;font-weight:bold;z-index:9999999;}#frm_loading img{max-width:100%;}#frm_loading .progress{border-radius:4px;box-shadow:0 1px 2px rgba(0, 0, 0, 0.1) inset;height:20px;margin-bottom:20px;overflow:hidden;}#frm_loading .progress.active .progress-bar{animation:2s linear 0s normal none infinite progress-bar-stripes;}#frm_loading .progress-striped .progress-bar{background-image:linear-gradient(45deg, #cccccc 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, #cccccc 50%, #cccccc 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));background-size:40px 40px;}#frm_loading .progress-bar{background-color:#ffffff;box-shadow:0 -1px 0 rgba(0, 0, 0, 0.15) inset;float:left;height:100%;line-height:20px;text-align:center;transition:width 0.6s ease 0s;width:100%;}.frm_image_from_url{height:50px;}.frm-loading-img{background:url(//localhost/richmondmediahosting/wp-content/plugins/formidable/images/ajax_loader.gif) no-repeat center center;padding:6px 12px;}select.frm_loading_lookup{background-image: url(//localhost/richmondmediahosting/wp-content/plugins/formidable/images/ajax_loader.gif) !important;background-position: 10px;background-repeat: no-repeat;color: transparent !important;}.with_frm_style .frm_form_field{clear:both;}.frm_form_field.frm_right_half,.frm_form_field.frm_right_third,.frm_form_field.frm_right_two_thirds,.frm_form_field.frm_right_fourth,.frm_form_field.frm_right_fifth,.frm_form_field.frm_right_inline,.frm_form_field.frm_last_half,.frm_form_field.frm_last_third,.frm_form_field.frm_last_two_thirds,.frm_form_field.frm_last_fourth,.frm_form_field.frm_last_fifth,.frm_form_field.frm_last_sixth,.frm_form_field.frm_last_seventh,.frm_form_field.frm_last_eighth,.frm_form_field.frm_last_inline,.frm_form_field.frm_last,.frm_form_field.frm_half,.frm_submit.frm_half,.frm_form_field.frm_third,.frm_submit.frm_third,.frm_form_field.frm_two_thirds,.frm_form_field.frm_fourth,.frm_submit.frm_fourth,.frm_form_field.frm_three_fourths,.frm_form_field.frm_fifth,.frm_submit.frm_fifth,.frm_form_field.frm_two_fifths,.frm_form_field.frm_three_fifths,.frm_form_field.frm_four_fifths,.frm_form_field.frm_sixth,.frm_submit.frm_sixth,.frm_form_field.frm_seventh,.frm_submit.frm_seventh,.frm_form_field.frm_eighth,.frm_submit.frm_eighth,.frm_form_field.frm_inline,.frm_submit.frm_inline{clear:none;float:left;margin-left:2.5%;}.frm_form_field.frm_left_half,.frm_form_field.frm_left_third,.frm_form_field.frm_left_two_thirds,.frm_form_field.frm_left_fourth,.frm_form_field.frm_left_fifth,.frm_form_field.frm_left_inline,.frm_form_field.frm_first_half,.frm_form_field.frm_first_third,.frm_form_field.frm_first_two_thirds,.frm_form_field.frm_first_fourth,.frm_form_field.frm_first_fifth,.frm_form_field.frm_first_sixth,.frm_form_field.frm_first_seventh,.frm_form_field.frm_first_eighth,.frm_form_field.frm_first_inline,.frm_form_field.frm_first{clear:left;float:left;margin-left:0;}.frm_form_field.frm_alignright{float:right !important;}.frm_form_field.frm_left_half,.frm_form_field.frm_right_half,.frm_form_field.frm_first_half,.frm_form_field.frm_last_half,.frm_form_field.frm_half,.frm_submit.frm_half{width:48.75%;}.frm_form_field.frm_left_third,.frm_form_field.frm_third,.frm_submit.frm_third,.frm_form_field.frm_right_third,.frm_form_field.frm_first_third,.frm_form_field.frm_last_third{width:31.66%;}.frm_form_field.frm_left_two_thirds,.frm_form_field.frm_right_two_thirds,.frm_form_field.frm_first_two_thirds,.frm_form_field.frm_last_two_thirds,.frm_form_field.frm_two_thirds{width:65.82%;}.frm_form_field.frm_left_fourth,.frm_form_field.frm_fourth,.frm_submit.frm_fourth,.frm_form_field.frm_right_fourth,.frm_form_field.frm_first_fourth,.frm_form_field.frm_last_fourth{width:23.12%;}.frm_form_field.frm_three_fourths{width:74.36%;}.frm_form_field.frm_left_fifth,.frm_form_field.frm_fifth,.frm_submit.frm_fifth,.frm_form_field.frm_right_fifth,.frm_form_field.frm_first_fifth,.frm_form_field.frm_last_fifth{width:18%;}.frm_form_field.frm_two_fifths {width:38.5%;}.frm_form_field.frm_three_fifths {width:59%;}.frm_form_field.frm_four_fifths {width:79.5%;}.frm_form_field.frm_sixth,.frm_submit.frm_sixth,.frm_form_field.frm_first_sixth,.frm_form_field.frm_last_sixth{width:14.58%;}.frm_form_field.frm_seventh,.frm_submit.frm_seventh,.frm_form_field.frm_first_seventh,.frm_form_field.frm_last_seventh{width:12.14%;}.frm_form_field.frm_eighth,.frm_submit.frm_eighth,.frm_form_field.frm_first_eighth,.frm_form_field.frm_last_eighth{width:10.31%;}.frm_form_field.frm_left_inline,.frm_form_field.frm_first_inline,.frm_form_field.frm_inline,.frm_submit.frm_inline,.frm_form_field.frm_right_inline,.frm_form_field.frm_last_inline{width:auto;}.frm_full,.frm_full .wp-editor-wrap,.frm_full input:not([type=\'checkbox\']):not([type=\'radio\']):not([type=\'button\']),.frm_full select,.frm_full textarea{width:100% !important;}.frm_full .wp-editor-wrap input{width:auto !important;}@media only screen and (max-width: 600px) {.frm_form_field.frm_half,.frm_submit.frm_half,.frm_form_field.frm_left_half,.frm_form_field.frm_right_half,.frm_form_field.frm_first_half,.frm_form_field.frm_last_half,.frm_form_field.frm_first_third,.frm_form_field.frm_third,.frm_submit.frm_third,.frm_form_field.frm_last_third,.frm_form_field.frm_first_two_thirds,.frm_form_field.frm_last_two_thirds,.frm_form_field.frm_two_thirds,.frm_form_field.frm_left_fourth,.frm_form_field.frm_fourth,.frm_submit.frm_fourth,.frm_form_field.frm_right_fourth,.frm_form_field.frm_first_fourth,.frm_form_field.frm_last_fourth,.frm_form_field.frm_three_fourths,.frm_form_field.frm_fifth,.frm_submit.frm_fifth,.frm_form_field.frm_two_fifths,.frm_form_field.frm_three_fifths,.frm_form_field.frm_four_fifths,.frm_form_field.frm_sixth,.frm_submit.frm_sixth,.frm_form_field.frm_seventh,.frm_submit.frm_seventh,.frm_form_field.frm_eighth,.frm_submit.frm_eighth,.frm_form_field.frm_first_inline,.frm_form_field.frm_inline,.frm_submit.frm_inline,.frm_form_field.frm_last_inline{width:100%;margin-left:0;margin-right:0;clear:both;float:none;}}.frm_form_field.frm_left_container label.frm_primary_label{float:left;display:inline;max-width:33%;margin-right:10px;}.with_frm_style .frm_conf_field.frm_left_container label.frm_primary_label{display:inline;visibility:hidden;}.frm_form_field.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_form_field.frm_left_container:not(.frm_dynamic_select_container) select,.frm_form_field.frm_left_container textarea,.frm_form_field.frm_left_container .wp-editor-wrap,.frm_form_field.frm_left_container .frm_opt_container,.frm_form_field.frm_left_container .frm_dropzone,.frm_form_field.frm_left_container .frm-g-recaptcha,.frm_form_field.frm_left_container .g-recaptcha,.frm_form_field.frm_left_container .chosen-container,.frm_form_field.frm_left_container .frm_combo_inputs_container,.frm_form_field.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_form_field.frm_right_container:not(.frm_dynamic_select_container) select,.frm_form_field.frm_right_container textarea,.frm_form_field.frm_right_container .wp-editor-wrap,.frm_form_field.frm_right_container .frm_opt_container,.frm_form_field.frm_right_container .frm_dropzone,.frm_form_field.frm_right_container .frm-g-recaptcha,.frm_form_field.frm_right_container .g-recaptcha,.frm_form_field.frm_right_container .chosen-container,.frm_form_field.frm_right_container .frm_combo_inputs_container{max-width:62%;}.frm_form_field.frm_left_container .frm_combo_inputs_container input,.frm_form_field.frm_left_container .frm_combo_inputs_container select,.frm_form_field.frm_right_container .frm_combo_inputs_container input,.frm_form_field.frm_right_container .frm_combo_inputs_container select{max-width:100%;}.frm_form_field.frm_left_container .frm_opt_container,.frm_form_field.frm_right_container .frm_opt_container,.frm_form_field.frm_inline_container .frm_opt_container,.frm_form_field.frm_left_container .frm_combo_inputs_container,.frm_form_field.frm_right_container .frm_combo_inputs_container,.frm_form_field.frm_inline_container .frm_combo_inputs_container,.frm_form_field.frm_left_container .wp-editor-wrap,.frm_form_field.frm_right_container .wp-editor-wrap,.frm_form_field.frm_inline_container .wp-editor-wrap,.frm_form_field.frm_left_container .frm_dropzone,.frm_form_field.frm_right_container .frm_dropzone,.frm_form_field.frm_inline_container .frm_dropzone,.frm_form_field.frm_left_container .frm-g-recaptcha,.frm_form_field.frm_right_container .frm-g-recaptcha,.frm_form_field.frm_inline_container .frm-g-recaptcha,.frm_form_field.frm_left_container .g-recaptcha,.frm_form_field.frm_right_container .g-recaptcha,.frm_form_field.frm_inline_container .g-recaptcha{display:inline-block;}.frm_form_field.frm_left_half.frm_left_container .frm_primary_label,.frm_form_field.frm_right_half.frm_left_container .frm_primary_label,.frm_form_field.frm_left_half.frm_right_container .frm_primary_label,.frm_form_field.frm_right_half.frm_right_container .frm_primary_label,.frm_form_field.frm_first_half.frm_left_container .frm_primary_label,.frm_form_field.frm_last_half.frm_left_container .frm_primary_label,.frm_form_field.frm_first_half.frm_right_container .frm_primary_label,.frm_form_field.frm_last_half.frm_right_container .frm_primary_label,.frm_form_field.frm_half.frm_right_container .frm_primary_label,.frm_form_field.frm_half.frm_left_container .frm_primary_label{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;max-width:33%;}.wp-editor-wrap *,.wp-editor-wrap *:after,.wp-editor-wrap *:before{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;}.with_frm_style .frm_grid,.with_frm_style .frm_grid_first,.with_frm_style .frm_grid_odd{clear:both;margin-bottom:0 !important;padding:5px;border-width:1px;border-style:solid;border-color:#cccccc;border-left:none;border-right:none;}.with_frm_style .frm_grid,.with_frm_style .frm_grid_odd{border-top:none;}.frm_grid .frm_error,.frm_grid_first .frm_error,.frm_grid_odd .frm_error{display:none;}.frm_grid:after,.frm_grid_first:after,.frm_grid_odd:after{visibility:hidden;display:block;font-size:0;content:\" \";clear:both;height:0;}.frm_grid_first{margin-top:20px;}.frm_grid_first,.frm_grid_odd{background-color:#ffffff;}.frm_grid{background-color:ffffff;}.frm_grid .frm_primary_label,.frm_grid_first .frm_primary_label,.frm_grid_odd .frm_primary_label,.frm_grid .frm_radio,.frm_grid_first .frm_radio,.frm_grid_odd .frm_radio,.frm_grid .frm_checkbox,.frm_grid_first .frm_checkbox,.frm_grid_odd .frm_checkbox{float:left !important;display:block;margin-top:0;margin-left:0 !important;}.frm_grid_first .frm_radio label,.frm_grid .frm_radio label,.frm_grid_odd .frm_radio label,.frm_grid_first .frm_checkbox label,.frm_grid .frm_checkbox label,.frm_grid_odd .frm_checkbox label{visibility:hidden;white-space:nowrap;text-align:left;}.frm_grid_first .frm_radio label input,.frm_grid .frm_radio label input,.frm_grid_odd .frm_radio label input,.frm_grid_first .frm_checkbox label input,.frm_grid .frm_checkbox label input,.frm_grid_odd .frm_checkbox label input{visibility:visible;margin:2px 0 0;float:right;}.frm_grid .frm_radio,.frm_grid_first .frm_radio,.frm_grid_odd .frm_radio,.frm_grid .frm_checkbox,.frm_grid_first .frm_checkbox,.frm_grid_odd .frm_checkbox{display:inline;}.frm_grid_2 .frm_radio,.frm_grid_2 .frm_checkbox,.frm_grid_2 label.frm_primary_label{width:48% !important;}.frm_grid_2 .frm_radio,.frm_grid_2 .frm_checkbox{margin-right:4%;}.frm_grid_3 .frm_radio,.frm_grid_3 .frm_checkbox,.frm_grid_3 label.frm_primary_label{width:30% !important;}.frm_grid_3 .frm_radio,.frm_grid_3 .frm_checkbox{margin-right:3%;}.frm_grid_4 .frm_radio,.frm_grid_4 .frm_checkbox{width:20% !important;}.frm_grid_4 label.frm_primary_label{width:28% !important;}.frm_grid_4 .frm_radio,.frm_grid_4 .frm_checkbox{margin-right:4%;}.frm_grid_5 label.frm_primary_label,.frm_grid_7 label.frm_primary_label{width:24% !important;}.frm_grid_5 .frm_radio,.frm_grid_5 .frm_checkbox{width:17% !important;margin-right:2%;}.frm_grid_6 label.frm_primary_label{width:25% !important;}.frm_grid_6 .frm_radio,.frm_grid_6 .frm_checkbox{width:14% !important;margin-right:1%;}.frm_grid_7 label.frm_primary_label{width:22% !important;}.frm_grid_7 .frm_radio,.frm_grid_7 .frm_checkbox{width:12% !important;margin-right:1%;}.frm_grid_8 label.frm_primary_label{width:23% !important;}.frm_grid_8 .frm_radio,.frm_grid_8 .frm_checkbox{width:10% !important;margin-right:1%;}.frm_grid_9 label.frm_primary_label{width:20% !important;}.frm_grid_9 .frm_radio,.frm_grid_9 .frm_checkbox{width:9% !important;margin-right:1%;}.frm_grid_10 label.frm_primary_label{width:19% !important;}.frm_grid_10 .frm_radio,.frm_grid_10 .frm_checkbox{width:8% !important;margin-right:1%;}.with_frm_style .frm_inline_container.frm_grid_first label.frm_primary_label,.with_frm_style .frm_inline_container.frm_grid label.frm_primary_label,.with_frm_style .frm_inline_container.frm_grid_odd label.frm_primary_label,.with_frm_style .frm_inline_container.frm_grid_first .frm_opt_container,.with_frm_style .frm_inline_container.frm_grid .frm_opt_container,.with_frm_style .frm_inline_container.frm_grid_odd .frm_opt_container{margin-right:0;}.with_frm_style .frm_inline_container.frm_scale_container label.frm_primary_label{float:left;}.with_frm_style .frm_other_input.frm_other_full{margin-top:10px;}.frm_form_field.frm_two_col .frm_radio,.frm_form_field.frm_three_col .frm_radio,.frm_form_field.frm_four_col .frm_radio,.frm_form_field.frm_two_col .frm_checkbox,.frm_form_field.frm_three_col .frm_checkbox,.frm_form_field.frm_four_col .frm_checkbox{float:left;}.frm_form_field.frm_two_col .frm_radio,.frm_form_field.frm_two_col .frm_checkbox{width:48%;margin-right:4%;}.frm_form_field .frm_checkbox,.frm_form_field .frm_checkbox + .frm_checkbox,.frm_form_field .frm_radio,.frm_form_field .frm_radio + .frm_radio{margin-top: 0;margin-bottom: 0;}.frm_form_field.frm_three_col .frm_radio,.frm_form_field.frm_three_col .frm_checkbox{width:30%;margin-right:5%;}.frm_form_field.frm_four_col .frm_radio,.frm_form_field.frm_four_col .frm_checkbox{width:22%;margin-right:4%;}.frm_form_field.frm_two_col .frm_radio:nth-child(2n+2),.frm_form_field.frm_two_col .frm_checkbox:nth-child(2n+2),.frm_form_field.frm_three_col .frm_radio:nth-child(3n+3),.frm_form_field.frm_three_col .frm_checkbox:nth-child(3n+3),.frm_form_field.frm_four_col .frm_radio:nth-child(4n+4),.frm_form_field.frm_four_col .frm_checkbox:nth-child(4n+4){margin-right:0;}.frm_form_field.frm_scroll_box .frm_opt_container{height:100px;overflow:auto;}.frm_form_field.frm_html_scroll_box{height:100px;overflow:auto;background-color:#ffffff;border-color:#cccccc;border-width:1px;border-style:solid;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:100%;max-width:100%;font-size:14px;padding:6px 10px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;outline:none;font-weight:normal;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset;}.frm_form_field.frm_two_col .frm_opt_container:after,.frm_form_field.frm_three_col .frm_opt_container:after,.frm_form_field.frm_four_col .frm_opt_container:after{content:\".\";display:block;clear:both;visibility:hidden;line-height:0;height:0;}.frm_form_field.frm_total input,.frm_form_field.frm_total textarea{opacity:1;background-color:transparent !important;border:none !important;font-weight:bold;-moz-box-shadow:none;-webkit-box-shadow:none;width:auto !important;box-shadow:none !important;display:inline;-moz-appearance:textfield;padding:0;}.frm_form_field.frm_total input::-webkit-outer-spin-button,.frm_form_field.frm_total input::-webkit-inner-spin-button {-webkit-appearance: none;}.frm_form_field.frm_total input:focus,.frm_form_field.frm_total textarea:focus{background-color:transparent;border:none;-moz-box-shadow:none;-webkit-box-shadow:none;box-shadow:none;}.frm_form_field.frm_label_justify label.frm_primary_label{text-align:justify !important;}.frm_form_field.frm_capitalize input,.frm_form_field.frm_capitalize select,.frm_form_field.frm_capitalize .frm_opt_container label{text-transform:capitalize;}.frm_clearfix:after{content:\".\";display:block;clear:both;visibility:hidden;line-height:0;height:0;}.frm_clearfix{display:block;}.with_frm_style.frm_login_form,.with_frm_style.frm_login_form form{clear:both;}.with_frm_style.frm_login_form.frm_inline_login .login-remember input{vertical-align:baseline;}.with_frm_style.frm_login_form.frm_inline_login .login-submit{float:left;}.with_frm_style.frm_login_form.frm_inline_login label{display:inline;}.with_frm_style.frm_login_form.frm_inline_login .login-username,.with_frm_style.frm_login_form.frm_inline_login .login-password,.with_frm_style.frm_login_form.frm_inline_login .login-remember{float:left;margin-right:5px;}.with_frm_style.frm_login_form.frm_inline_login form{position:relative;clear:none;}.with_frm_style.frm_login_form.frm_inline_login .login-remember{position:absolute;top:35px;}.with_frm_style.frm_login_form.frm_inline_login input[type=submit]{margin:0 !important;}.with_frm_style.frm_login_form.frm_no_labels .login-username label,.with_frm_style.frm_login_form.frm_no_labels .login-password label{display:none;}.with_frm_style .frm-open-login{float:left;margin-right:15px;}.with_frm_style .frm-open-login a{text-decoration:none;border:none;outline:none;}.with_frm_style.frm_slide.frm_login_form form{display:none;}@font-face {font-family:\'s11-fp\';src:url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.eot\');src:local(\'☺\'), url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.woff\') format(\'woff\'), url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.ttf\') format(\'truetype\'), url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.svg\') format(\'svg\');font-weight:normal;font-style:normal;}.frm_icon_font,.frm_dashicon_font{text-decoration:none;text-shadow: none;font-weight:normal;}i.frm_icon_font{font-style:normal;}.frm_icon_font:before,select.frm_icon_font{font-family: \'s11-fp\' !important;font-size:16px;speak: none;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;-moz-transition: all .1s ease-in-out;-webkit-transition: all .1s ease-in-out;transition: all .1s ease-in-out;}.frm_icon_font,a.frm_icon_font,.frm_icon_font:hover,a.frm_icon_font:hover{text-decoration:none !important;box-shadow:none;}.frm_icon_font:focus,.frm_dashicon_font:focus{box-shadow:none;-webkit-box-shadow:none;}.frm_duplicate_icon:active,.frm_move_icon:active,.frm_delete_icon:active{outline:none;}.frm_trigger .frm_icon_font{padding:0 5px;}.ab-icon.frm_dashicon_font:before{content: \"\\f324\";}.frm_logo_icon:before {content: \"\\e601\";}.frm_required_icon:before {content: \"\\e612\";}.frm_delete_icon:before {content: \"\\e610\" !important;}.frm_move_icon:before {content: \"\\e61a\";}.frm_clear_icon:before {content: \"\\e60a\";}.frm_noclear_icon:before {content: \"\\e60b\";}.frm_duplicate_icon:before {content: \"\\e61b\";}.frm_new_icon:before {content: \"\\e614\";}.frm_tooltip_icon:before {content: \"\\e611\";}.frm_forbid_icon:before {content: \"\\e636\";}.frm_check_icon:before {content: \"\\e605\";}.frm_check1_icon:before {content: \"\\e606\";}.frm_plus_icon:before {content: \"\\e62f\";}.frm_plus1_icon:before {content: \"\\e602\";}.frm_plus2_icon:before {content: \"\\e603\";}.frm_plus3_icon:before {content: \"\\e632\";}.frm_plus4_icon:before {content: \"\\e60f\";}.frm_minus_icon:before {content: \"\\e62e\";}.frm_minus1_icon:before {content: \"\\e600\";}.frm_minus2_icon:before {content: \"\\e604\";}.frm_minus3_icon:before {content: \"\\e633\";}.frm_minus4_icon:before {content: \"\\e613\";}.frm_cancel_icon:before {content: \"\\e607\";}.frm_cancel1_icon:before {content: \"\\e608\";}.frm_arrowup_icon:before {content: \"\\e60d\";}.frm_arrowup1_icon:before {content: \"\\e60e\";}.frm_arrowup2_icon:before {content: \"\\e630\";}.frm_arrowup3_icon:before {content: \"\\e62b\";}.frm_arrowup4_icon:before {content: \"\\e62c\";}.frm_arrowup5_icon:before {content: \"\\e635\";}.frm_arrowup6_icon:before {content: \"\\e62d\";}.frm_arrowdown_icon:before {content: \"\\e609\";}.frm_arrowdown1_icon:before {content: \"\\e60c\";}.frm_arrowdown2_icon:before {content: \"\\e631\";}.frm_arrowdown3_icon:before {content: \"\\e628\";}.frm_arrowdown4_icon:before {content: \"\\e629\";}.frm_arrowdown5_icon:before {content: \"\\e634\";}.frm_arrowdown6_icon:before {content: \"\\e62a\";}.frm_download_icon:before {content: \"\\e615\";}.frm_upload_icon:before {content: \"\\e616\";}.frm_menu_icon:before {content: \"\\e618\";}.frm_twitter_icon:before {content: \"\\e619\";}.frm_sms_icon:before {content: \"\\e61c\";}.frm_pencil_icon:before {content: \"\\e61d\";}.frm_pencil1_icon:before {content: \"\\e61e\";}.frm_paypal_icon:before {content: \"\\e61f\";}.frm_twilio_icon:before {content: \"\\e620\";}.frm_googleplus_icon:before {content: \"\\e621\";}.frm_mailchimp_icon:before {content: \"\\e622\";}.frm_pdf_icon:before {content: \"\\e623\";}.frm_highrise_icon:before {content: \"\\e617\";}.frm_feed_icon:before {content: \"\\e624\";}.frm_facebook_icon:before {content: \"\\e625\";}.frm_email_icon:before {content: \"\\e626\";}.frm_aweber_icon:before {content: \"\\e627\";}.frm_register_icon:before {content: \"\\e637\";}.frm_authorize_icon:before {content: \"\\e900\";}.frm_stripe_icon:before {content: \"\\e902\";}.frm_woocommerce_icon:before {content: \"\\e903\";}.frm_paste_icon:before {content: \"\\e901\";}@media only screen and (max-width: 900px) {.frm_form_field .frm_repeat_grid .frm_form_field.frm_sixth label.frm_primary_label,.frm_form_field .frm_repeat_grid .frm_form_field.frm_seventh label.frm_primary_label,.frm_form_field .frm_repeat_grid .frm_form_field.frm_eighth label.frm_primary_label{display: block !important;}.frm_form_field .frm_repeat_grid .frm_form_field.frm_repeat_buttons.frm_seventh label.frm_primary_label{display:none !important;}}@media only screen and (max-width: 600px) {.frm_form_field.frm_four_col .frm_radio,.frm_form_field.frm_four_col .frm_checkbox{width:48%;margin-right:4%;}.frm_form_field.frm_four_col .frm_radio:nth-child(2n+2),.frm_form_field.frm_four_col .frm_checkbox:nth-child(2n+2){margin-right:0;}.frm_form_field .frm_repeat_grid.frm_first_repeat .frm_form_field.frm_repeat_buttons:not(.frm_fourth):not(.frm_sixth):not(.frm_eighth) label.frm_primary_label{display:none !important;}.frm_form_field .frm_repeat_grid .frm_form_field.frm_fifth label.frm_primary_label{display:block !important;}.frm_form_field .frm_repeat_grid .frm_form_field.frm_repeat_buttons.frm_fifth label.frm_primary_label{display:none !important;}}@media only screen and (max-width: 500px) {.frm_form_field.frm_two_col .frm_radio,.frm_form_field.frm_two_col .frm_checkbox,.frm_form_field.frm_three_col .frm_radio,.frm_form_field.frm_three_col .frm_checkbox{width: auto;margin-right: 0;float: none;display:block;}.frm_form_field input[type=file] {max-width:220px;}.with_frm_style.frm_login_form.frm_inline_login p{clear:both;float:none;}.with_frm_style.frm_login_form.frm_inline_login form{position:static;}.with_frm_style.frm_login_form.frm_inline_login .login-remember{position:static;}.with_frm_style .frm-g-recaptcha > div > div,.with_frm_style .g-recaptcha > div > div{width:inherit !important;display:block;overflow:hidden;max-width:302px;border-right:1px solid #d3d3d3;border-radius:4px;box-shadow:2px 0px 4px -1px rgba(0,0,0,.08);-moz-box-shadow:2px 0px 4px -1px rgba(0,0,0,.08);}.with_frm_style .g-recaptcha iframe,.with_frm_style .frm-g-recaptcha iframe{width:100%;}}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(173, 'frm_db_version', '47', 'yes'),
(174, 'frm_options', 'O:11:\"FrmSettings\":26:{s:11:\"option_name\";s:11:\"frm_options\";s:4:\"menu\";N;s:7:\"mu_menu\";N;s:15:\"preview_page_id\";N;s:8:\"use_html\";N;s:10:\"jquery_css\";N;s:12:\"accordion_js\";N;s:9:\"fade_form\";N;s:11:\"success_msg\";N;s:9:\"blank_msg\";N;s:10:\"unique_msg\";N;s:11:\"invalid_msg\";N;s:10:\"failed_msg\";N;s:12:\"submit_value\";N;s:9:\"login_msg\";N;s:16:\"admin_permission\";N;s:8:\"email_to\";N;s:10:\"load_style\";N;s:12:\"custom_style\";N;s:6:\"pubkey\";N;s:7:\"privkey\";N;s:7:\"re_lang\";N;s:7:\"re_type\";N;s:6:\"re_msg\";N;s:8:\"re_multi\";N;s:6:\"no_ips\";N;}', 'yes'),
(175, '_transient_frm_options', 'O:11:\"FrmSettings\":26:{s:11:\"option_name\";s:11:\"frm_options\";s:4:\"menu\";N;s:7:\"mu_menu\";N;s:15:\"preview_page_id\";N;s:8:\"use_html\";N;s:10:\"jquery_css\";N;s:12:\"accordion_js\";N;s:9:\"fade_form\";N;s:11:\"success_msg\";N;s:9:\"blank_msg\";N;s:10:\"unique_msg\";N;s:11:\"invalid_msg\";N;s:10:\"failed_msg\";N;s:12:\"submit_value\";N;s:9:\"login_msg\";N;s:16:\"admin_permission\";N;s:8:\"email_to\";N;s:10:\"load_style\";N;s:12:\"custom_style\";N;s:6:\"pubkey\";N;s:7:\"privkey\";N;s:7:\"re_lang\";N;s:7:\"re_type\";N;s:6:\"re_msg\";N;s:8:\"re_multi\";N;s:6:\"no_ips\";N;}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(176, '_transient_frmpro_css', '/* WARNING: Any changes made to this file will be lost when your Formidable settings are updated */\n.frm_form_field .grecaptcha-badge,.frm_hidden,.with_frm_style .frm_button.frm_hidden{display:none;}form input.frm_verify{display:none !important;}.with_frm_style fieldset{min-width:0;}legend.frm_hidden{display:none !important;}.with_frm_style .frm_form_fields{opacity:1;transition: opacity 0.1s linear;}.with_frm_style .frm_doing_ajax{opacity:.5;}.frm_transparent{color:transparent;}.input[type=file].frm_transparent:focus, .with_frm_style input[type=file]{background-color:transparent;border:none;outline:none;box-shadow:none;}.with_frm_style input[type=file]{display:initial;}.frm_preview_page:before{content:normal !important;}.frm_preview_page{padding:25px;}.with_frm_style .form-field.frm_col_field{clear:none;float:left;margin-right:20px;}.with_frm_style label.frm_primary_label{max-width:100%;}.with_frm_style .frm_top_container label.frm_primary_label,.with_frm_style .frm_hidden_container label.frm_primary_label,.with_frm_style .frm_pos_top{display:block;float:none;width:auto;}.with_frm_style .frm_inline_container label.frm_primary_label{margin-right:10px;}.with_frm_style .frm_right_container label.frm_primary_label,.with_frm_style .frm_pos_right{display:inline;float:right;margin-left:10px;}.with_frm_style .frm_none_container label.frm_primary_label,.with_frm_style .frm_pos_none,.frm_none_container label.frm_primary_label{display:none;}.with_frm_style .frm_section_heading.frm_hide_section{margin-top:0 !important;}.with_frm_style .frm_hidden_container label.frm_primary_label,.with_frm_style .frm_pos_hidden,.frm_hidden_container label.frm_primary_label{visibility:hidden;}.with_frm_style .frm_inside_container label.frm_primary_label{opacity:0;transition: opacity 0.1s linear;}.with_frm_style .frm_inside_container label.frm_visible,.frm_visible{opacity:1;}.with_frm_style .frm_description{clear:both;}.with_frm_style .frm_scale{margin-right:10px;text-align:center;float:left;}.with_frm_style .frm_scale input{display:block;margin:0;}.with_frm_style input[type=number][readonly]{-moz-appearance: textfield;}.with_frm_style select[multiple=\"multiple\"]{height:auto;line-height:normal;}.with_frm_style select{white-space:pre-wrap;}.with_frm_style .frm_catlevel_2,.with_frm_style .frm_catlevel_3,.with_frm_style .frm_catlevel_4,.with_frm_style .frm_catlevel_5{margin-left:18px;}.with_frm_style .wp-editor-container{border:1px solid #e5e5e5;}.with_frm_style .quicktags-toolbar input{font-size:12px !important;}.with_frm_style .wp-editor-container textarea{border:none;}.with_frm_style textarea{height:auto;}.with_frm_style .auto_width #loginform input,.with_frm_style .auto_width input,.with_frm_style input.auto_width,.with_frm_style select.auto_width,.with_frm_style textarea.auto_width{width:auto;}.with_frm_style .frm_repeat_buttons{white-space:nowrap;}.with_frm_style .frm_button{text-decoration:none;border:1px solid #eee;padding:5px;display:inline;}.with_frm_style .frm_submit{clear:both;}.frm_inline_form .frm_form_field.form-field{margin-right:2.5%;display:inline-block;}.frm_inline_form .frm_submit{display:inline-block;}.with_frm_style.frm_center_submit .frm_submit{text-align:center;}.with_frm_style.frm_center_submit .frm_submit input[type=submit],.with_frm_style.frm_center_submit .frm_submit input[type=button],.with_frm_style.frm_center_submit .frm_submit button{margin-bottom:8px !important;}.with_frm_style .frm_submit input[type=submit],.with_frm_style .frm_submit input[type=button],.with_frm_style .frm_submit button{-webkit-appearance: none;cursor: pointer;}.with_frm_style.frm_center_submit .frm_submit .frm_ajax_loading{display: block;margin: 0 auto;}.with_frm_style .frm_loading_form .frm_ajax_loading{visibility:visible !important;}.with_frm_style .frm_loading_form .frm_button_submit {position: relative;opacity: .8;color: transparent !important;text-shadow: none !important;}.with_frm_style .frm_loading_form .frm_button_submit:hover,.with_frm_style .frm_loading_form .frm_button_submit:active,.with_frm_style .frm_loading_form .frm_button_submit:focus {cursor: not-allowed;color: transparent;outline: none !important;box-shadow: none;}.with_frm_style .frm_loading_form .frm_button_submit:before {content: \'\';display: inline-block;position: absolute;background: transparent;border: 1px solid #fff;border-top-color: transparent;border-left-color: transparent;border-radius: 50%;box-sizing: border-box;top: 50%;left: 50%;margin-top: -10px;margin-left: -10px;width: 20px;height: 20px;-webkit-animation: spin 2s linear infinite;-moz-animation:spin 2s linear infinite;-o-animation:  spin 2s linear infinite;animation: spin 2s linear infinite;}@keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg); }}.frm_forms.frm_style_formidable-style.with_frm_style{max-width:100%;direction:ltr;}.frm_style_formidable-style.with_frm_style,.frm_style_formidable-style.with_frm_style form,.frm_style_formidable-style.with_frm_style .frm-show-form div.frm_description p {text-align:left;}.frm_style_formidable-style.with_frm_style fieldset{border-width:0px;border-style:solid;border-color:#000000;margin:0;padding:0 0 15px 0;background-color:transparent;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;}.frm_style_formidable-style.with_frm_style legend + h3,.frm_style_formidable-style.with_frm_style h3.frm_form_title{font-size:20px;color:#444444;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;margin-top:10px;margin-bottom:10px;}.frm_style_formidable-style.with_frm_style .frm-show-form  .frm_section_heading h3{padding:15px 0 3px 0;margin:0;font-size:18px;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-weight:bold;color:#444444;border:none;border-top:2px solid #e8e8e8;background-color:transparent}.frm_style_formidable-style.with_frm_style h3 .frm_after_collapse{display:inline;}.frm_style_formidable-style.with_frm_style h3 .frm_before_collapse{display:none;}.menu-edit #post-body-content .frm_style_formidable-style.with_frm_style .frm_section_heading h3{margin:0;}.frm_style_formidable-style.with_frm_style .frm_section_heading{margin-top:15px;}.frm_style_formidable-style.with_frm_style  .frm-show-form .frm_section_heading .frm_section_spacing,.menu-edit #post-body-content .frm_style_formidable-style.with_frm_style  .frm-show-form .frm_section_heading .frm_section_spacing{margin-bottom:12px;}.frm_style_formidable-style.with_frm_style .frm_repeat_sec{margin-bottom:20px;margin-top:20px;}.frm_style_formidable-style.with_frm_style label.frm_primary_label,.frm_style_formidable-style.with_frm_style.frm_login_form label{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;color:#444444;font-weight:bold;text-align:left;margin:0;padding:0 0 3px 0;width:auto;display:block;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_container,.frm_style_formidable-style.with_frm_style .frm_form_field .frm_show_it{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;color:#666666;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_container{font-size:14px;}.frm_style_formidable-style.with_frm_style .frm_form_field .frm_show_it{font-size:14px;font-weight:normal;}.frm_style_formidable-style.with_frm_style .frm_icon_font{color:#444444;}.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_minus_icon:before{content:\"\\e600\";}.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_plus_icon:before{content:\"\\e602\";}.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_minus_icon:before,.frm_style_formidable-style.with_frm_style .frm_icon_font.frm_plus_icon:before{color:#444444;}.frm_style_formidable-style.with_frm_style .frm_trigger.active .frm_icon_font.frm_arrow_icon:before{content:\"\\e62d\";color:#444444;}.frm_style_formidable-style.with_frm_style .frm_trigger .frm_icon_font.frm_arrow_icon:before{content:\"\\e62a\";color:#444444;}.frm_style_formidable-style.with_frm_style .form-field{margin-bottom:20px;}.frm_style_formidable-style.with_frm_style .frm_grid,.frm_style_formidable-style.with_frm_style .frm_grid_first,.frm_style_formidable-style.with_frm_style .frm_grid_odd {margin-bottom:0;}.frm_style_formidable-style.with_frm_style .form-field.frm_section_heading{margin-bottom:0;}.frm_style_formidable-style.with_frm_style p.description,.frm_style_formidable-style.with_frm_style div.description,.frm_style_formidable-style.with_frm_style div.frm_description,.frm_style_formidable-style.with_frm_style .frm-show-form > div.frm_description,.frm_style_formidable-style.with_frm_style .frm_error{margin:0;padding:0;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:12px;color:#666666;font-weight:normal;text-align:left;font-style:normal;max-width:100%;}.frm_style_formidable-style.with_frm_style .frm-show-form div.frm_description p{font-size:14px;color:#666666;margin-top:10px;margin-bottom:25px;}.frm_style_formidable-style.with_frm_style .frm_left_container label.frm_primary_label{float:left;display:inline;width:150px;max-width:33%;margin-right:10px;}.frm_style_formidable-style.with_frm_style .frm_right_container label.frm_primary_label{display:inline;width:150px;max-width:33%;margin-left:10px;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .chosen-container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .chosen-container{max-width:62%;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_combo_inputs_container .frm_form_field input,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_combo_inputs_container .frm_form_field select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_combo_inputs_container .frm_form_field input,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_combo_inputs_container .frm_form_field select{max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm-g-recaptcha{display:inline-block;}.frm_style_formidable-style.with_frm_style .frm_left_container > p.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.frm_description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > .frm_error::before,.frm_style_formidable-style.with_frm_style .frm_right_container > p.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.frm_description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > .frm_error::after{content:\'\';display:inline-block;width:150px;max-width:33%;margin-right:10px;}.frm_style_formidable-style.with_frm_style .frm_left_container.frm_inline label.frm_primary_label{max-width:90%;}.frm_style_formidable-style.with_frm_style .form-field.frm_col_field div.frm_description{width:100%;max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_inline_container label.frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_inline_container.frm_dynamic_select_container .frm_opt_container{display:inline;}.frm_style_formidable-style.with_frm_style .frm_inline_container label.frm_primary_label{margin-right:10px;}.frm_style_formidable-style.with_frm_style .frm_pos_right{display:inline;width:150px;}.frm_style_formidable-style.with_frm_style .frm_none_container label.frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_pos_none{display:none;}.frm_style_formidable-style.with_frm_style .frm_scale label{font-weight:normal;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:13px;color:#444444;}.frm_style_formidable-style.with_frm_style .frm_required{color:#B94A48;font-weight:bold;}.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=search],.frm_style_formidable-style.with_frm_style select,.frm_style_formidable-style.with_frm_style textarea,.frm_style_formidable-style.with_frm_style .chosen-container{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;margin-bottom:0;}.frm_style_formidable-style.with_frm_style textarea{vertical-align:top;}.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=phone],.frm_style_formidable-style.with_frm_style input[type=search],.frm_style_formidable-style.with_frm_style select,.frm_style_formidable-style.with_frm_style textarea,.frm_form_fields_style,.frm_style_formidable-style.with_frm_style .frm_scroll_box .frm_opt_container,.frm_form_fields_active_style,.frm_form_fields_error_style,.frm_style_formidable-style.with_frm_style .chosen-container-multi .chosen-choices,.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-single{color:#555555;background-color:#ffffff;border-color: #cccccc;border-width:1px;border-style:solid;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:100%;max-width:100%;font-size:14px;padding:6px 10px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;outline:none;font-weight:normal;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset;}.frm_style_formidable-style.with_frm_style input[type=file]::-webkit-file-upload-button{color:#555555;background-color:#ffffff;padding:6px 10px;border-radius:4px;border-color: #cccccc;border-width:1px;border-style:solid;}.frm_style_formidable-style.with_frm_style input[type=text],.frm_style_formidable-style.with_frm_style input[type=password],.frm_style_formidable-style.with_frm_style input[type=email],.frm_style_formidable-style.with_frm_style input[type=number],.frm_style_formidable-style.with_frm_style input[type=url],.frm_style_formidable-style.with_frm_style input[type=tel],.frm_style_formidable-style.with_frm_style input[type=file],.frm_style_formidable-style.with_frm_style input[type=search],.frm_style_formidable-style.with_frm_style select{height:32px;line-height:1.3;}.frm_style_formidable-style.with_frm_style select[multiple=\"multiple\"]{height:auto ;}.frm_style_formidable-style.with_frm_style input[type=file]{color: #555555;padding:0px;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;}.frm_style_formidable-style.with_frm_style input[type=file].frm_transparent{color:transparent;}.frm_style_formidable-style.with_frm_style select{width:100%;max-width:100%;}.frm_style_formidable-style.with_frm_style input.frm_other_input:not(.frm_other_full){width:auto ;margin-left:5px ;}.frm_style_formidable-style.with_frm_style .horizontal_radio input.frm_other_input:not(.frm_other_full):not(.frm_pos_none) {display:inline-block;}.frm_style_formidable-style.with_frm_style .frm_full input.frm_other_input:not(.frm_other_full){margin-left:0 ;margin-top:8px;}.frm_style_formidable-style.with_frm_style .frm_other_container select:not([multiple=\"multiple\"]){width:auto;}.frm_style_formidable-style.with_frm_style .wp-editor-wrap{width:100%;max-width:100%;}.frm_style_formidable-style.with_frm_style .wp-editor-container textarea{border:none;}.frm_style_formidable-style.with_frm_style .mceIframeContainer{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .auto_width input,.frm_style_formidable-style.with_frm_style input.auto_width,.frm_style_formidable-style.with_frm_style select.auto_width,.frm_style_formidable-style.with_frm_style textarea.auto_width{width:auto;}.frm_style_formidable-style.with_frm_style input[disabled],.frm_style_formidable-style.with_frm_style select[disabled],.frm_style_formidable-style.with_frm_style textarea[disabled],.frm_style_formidable-style.with_frm_style input[readonly],.frm_style_formidable-style.with_frm_style select[readonly],.frm_style_formidable-style.with_frm_style textarea[readonly]{background-color:ffffff;color: #A1A1A1;border-color:#E5E5E5;}.frm_style_formidable-style.with_frm_style input::placeholder,.frm_style_formidable-style.with_frm_style textarea::placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input::-webkit-input-placeholder,.frm_style_formidable-style.with_frm_style textarea::-webkit-input-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input::-moz-placeholder,.frm_style_formidable-style.with_frm_style textarea::-moz-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input:-ms-input-placeholder,frm_style_formidable-style.with_frm_style textarea:-ms-input-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style input:-moz-placeholder,.frm_style_formidable-style.with_frm_style textarea:-moz-placeholder{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style .frm_default,.frm_style_formidable-style.with_frm_style input.frm_default,.frm_style_formidable-style.with_frm_style textarea.frm_default,.frm_style_formidable-style.with_frm_style select.frm_default,.frm_style_formidable-style.with_frm_style .placeholder,.frm_style_formidable-style.with_frm_style .chosen-container-multi .chosen-choices li.search-field .default,.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-default{color: #A1A1A1;}.frm_style_formidable-style.with_frm_style .form-field input:not([type=file]):focus,.frm_style_formidable-style.with_frm_style select:focus,.frm_style_formidable-style.with_frm_style textarea:focus,.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=text],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=password],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=email],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=number],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=url],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=tel],.frm_style_formidable-style.with_frm_style .frm_focus_field input[type=search],.frm_form_fields_active_style,.frm_style_formidable-style.with_frm_style .chosen-container-active .chosen-choices{background-color:ffffff;border-color:#66afe9;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102,175,233, 0.6);}.frm_style_formidable-style.with_frm_style .frm_submit.frm_inline_submit::before {content:\"before\";font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;color:#444444;font-weight:bold;margin:0;padding:0 0 3px 0;width:auto;display:block;visibility:hidden;}.frm_style_formidable-style.with_frm_style .frm_submit.frm_inline_submit input,.frm_style_formidable-style.with_frm_style .frm_submit.frm_inline_submit button {margin-top: 0 ;}.frm_style_formidable-style.with_frm_style .frm_compact .frm_dropzone.dz-clickable .dz-message,.frm_style_formidable-style.with_frm_style input[type=submit],.frm_style_formidable-style.with_frm_style .frm_submit input[type=button],.frm_style_formidable-style.with_frm_style .frm_submit button,.frm_form_submit_style,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]{width:auto;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;height:auto;line-height:normal;text-align:center;background:#ffffff;border-width:1px;border-color: #cccccc;border-style:solid;color:#444444;cursor:pointer;font-weight:normal;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;text-shadow:none;padding:6px 11px;-moz-box-sizing:border-box;box-sizing:border-box;-ms-box-sizing:border-box;-moz-box-shadow:0 1px 1px #eeeeee;-webkit-box-shadow:0 1px 1px #eeeeee;box-shadow:0 1px 1px #eeeeee;margin:10px;margin-left:0;margin-right:0;vertical-align:middle;}.frm_style_formidable-style.with_frm_style .frm_compact .frm_dropzone.dz-clickable .dz-message{margin:0;}.frm_style_formidable-style.with_frm_style input[type=submit]:hover,.frm_style_formidable-style.with_frm_style .frm_submit input[type=button]:hover,.frm_style_formidable-style.with_frm_style .frm_submit button:hover,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]:hover{background: #efefef;border-color: #cccccc;color: #444444;}.frm_style_formidable-style.with_frm_style.frm_center_submit .frm_submit .frm_ajax_loading{margin-bottom:10px;}.frm_style_formidable-style.with_frm_style input[type=submit]:focus,.frm_style_formidable-style.with_frm_style .frm_submit input[type=button]:focus,.frm_style_formidable-style.with_frm_style .frm_submit button:focus,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]:focus,.frm_style_formidable-style.with_frm_style input[type=submit]:active,.frm_style_formidable-style.with_frm_style .frm_submit input[type=button]:active,.frm_style_formidable-style.with_frm_style .frm_submit button:active,.frm_style_formidable-style.with_frm_style.frm_login_form input[type=submit]:active{background: #efefef;border-color: #cccccc;color: #444444;}.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit,.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:hover,.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:active,.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:focus{color: transparent ;background: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_loading_form .frm_button_submit:before {border-bottom-color: #444444;border-right-color: #444444;max-height:auto;max-width:auto;}.frm_style_formidable-style.with_frm_style a.frm_save_draft{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;font-weight:normal;}.frm_style_formidable-style.with_frm_style #frm_field_cptch_number_container{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:14px;color:#444444;font-weight:bold;clear:both;}.frm_style_formidable-style.with_frm_style .frm_radio{display:block;}.frm_style_formidable-style.with_frm_style .horizontal_radio .frm_radio{margin:0 5px 0 0;}.frm_style_formidable-style.with_frm_style .frm_checkbox{display:block;}.frm_style_formidable-style.with_frm_style .vertical_radio .frm_checkbox,.frm_style_formidable-style.with_frm_style .vertical_radio .frm_radio,.vertical_radio .frm_catlevel_1{display:block;}.frm_style_formidable-style.with_frm_style .horizontal_radio .frm_checkbox,.frm_style_formidable-style.with_frm_style .horizontal_radio .frm_radio,.horizontal_radio .frm_catlevel_1{display:inline-block;}.frm_style_formidable-style.with_frm_style .frm_radio label,.frm_style_formidable-style.with_frm_style .frm_checkbox label{font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-size:13px;color:#444444;font-weight:normal;display:inline;white-space:normal;}.frm_style_formidable-style.with_frm_style .frm_radio input[type=radio],.frm_style_formidable-style.with_frm_style .frm_checkbox input[type=checkbox] {font-size: 13px;position: static;;}.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=text],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=password],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=url],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=tel],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=number],.frm_style_formidable-style.with_frm_style .frm_blank_field input[type=email],.frm_style_formidable-style.with_frm_style .frm_blank_field textarea,.frm_style_formidable-style.with_frm_style .frm_blank_field .mce-edit-area iframe,.frm_style_formidable-style.with_frm_style .frm_blank_field select,.frm_form_fields_error_style,.frm_style_formidable-style.with_frm_style .frm_blank_field .frm-g-recaptcha iframe,.frm_style_formidable-style.with_frm_style .frm_blank_field .g-recaptcha iframe,.frm_style_formidable-style.with_frm_style .frm_blank_field .chosen-container-multi .chosen-choices,.frm_style_formidable-style.with_frm_style .frm_form_field :invalid{color:#444444;background-color:ffffff;border-color:#B94A48;border-width:1px;border-style:solid;}.frm_style_formidable-style.with_frm_style .frm_blank_field .sigWrapper{border-color:#B94A48 !important;}.frm_style_formidable-style.with_frm_style .frm_error{font-weight:bold;}.frm_style_formidable-style.with_frm_style .frm_blank_field label,.frm_style_formidable-style.with_frm_style .frm_error{color:#B94A48;}.frm_style_formidable-style.with_frm_style .frm_error_style{background-color:#F2DEDE;border:1px solid #EBCCD1;border-radius:4px;color: #B94A48;font-size:14px;margin:0;margin-bottom:20px;}.frm_style_formidable-style.with_frm_style .frm_message,.frm_success_style{border:1px solid #D6E9C6;background-color:#DFF0D8;color:#468847;border-radius:4px;}.frm_style_formidable-style.with_frm_style .frm_message p{color:#468847;}.frm_style_formidable-style.with_frm_style .frm_message{margin:5px 0 15px;font-size:14px;}.frm_style_formidable-style.with_frm_style .frm-grid td,.frm-grid th{border-color:#cccccc;}.form_results.frm_style_formidable-style.with_frm_style{border:1px solid #cccccc;}.form_results.frm_style_formidable-style.with_frm_style tr td{color: #555555;border-top:1px solid #cccccc;}.form_results.frm_style_formidable-style.with_frm_style tr.frm_even,.frm-grid .frm_even{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style #frm_loading .progress-striped .progress-bar{background-image:linear-gradient(45deg, #cccccc 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, ##cccccc 50%, #cccccc 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));}.frm_style_formidable-style.with_frm_style #frm_loading .progress-bar{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .frm_grid,.frm_style_formidable-style.with_frm_style .frm_grid_first,.frm_style_formidable-style.with_frm_style .frm_grid_odd{border-color: #cccccc;}.frm_style_formidable-style.with_frm_style .frm_grid.frm_blank_field,.frm_style_formidable-style.with_frm_style .frm_grid_first.frm_blank_field,.frm_style_formidable-style.with_frm_style .frm_grid_odd.frm_blank_field{background-color:#F2DEDE;border-color:#EBCCD1;}.frm_style_formidable-style.with_frm_style .frm_grid_first,.frm_style_formidable-style.with_frm_style .frm_grid_odd{background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .frm_grid{background-color:ffffff;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_html_scroll_box{background-color:#ffffff;border-color: #cccccc;border-width:1px;border-style:solid;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:100%;font-size:14px;padding:6px 10px;outline:none;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_total input,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_total textarea{color: #555555;background-color:transparent;border:none;display:inline;width:auto;padding:0;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_checkbox label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_radio label{padding-left:20px;display:block;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_checkbox input[type=checkbox],.frm_style_formidable-style.with_frm_style .frm_form_field.frm_text_block .frm_radio input[type=radio]{margin-left:-20px;}.frm_style_formidable-style.with_frm_style .frm_button{padding:6px 11px;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;font-size:14px;font-family:\"Lucida Grande\",\"Lucida Sans Unicode\",Tahoma,sans-serif;font-weight:normal;color:#444444;background: #ffffff;border-width:1px;border-color: #cccccc;height:auto;}.frm_style_formidable-style.with_frm_style .frm_button .frm_icon_font:before{font-size:14px;}.frm_style_formidable-style.with_frm_style .frm_dropzone{border-color: #cccccc;border-radius:4px;color: #555555;background-color:#ffffff;}.frm_style_formidable-style.with_frm_style .frm_dropzone .frm_upload_icon:before,.frm_style_formidable-style.with_frm_style .frm_dropzone .dz-remove{color: #555555;}.frm_style_formidable-style.with_frm_style .frm_blank_field .frm_dropzone{border-color:#B94A48;color:#444444;background-color:ffffff;}.frm_style_formidable-style.with_frm_style .chosen-container{font-size:14px;}.frm_style_formidable-style.with_frm_style .chosen-container .chosen-results li,.frm_style_formidable-style.with_frm_style .chosen-container .chosen-results li span{color:#555555;}.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-single{height:32px;line-height:1.3;}.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-single div{top:3px;}.frm_style_formidable-style.with_frm_style .chosen-container-single .chosen-search input[type=\"text\"]{height:32px;}.frm_style_formidable-style.with_frm_style .chosen-container-multi .chosen-choices li.search-field input[type=\"text\"]{height:15px;}.frm_style_formidable-style.with_frm_style .frm_page_bar input,.frm_style_formidable-style.with_frm_style .frm_page_bar input:disabled{color: #ffffff;background-color: #dddddd;border-color: #dfdfdf;border-width: 2px;}.frm_style_formidable-style.with_frm_style .frm_progress_line input.frm_page_back{background-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_page_bar .frm_current_page input[type=\"button\"]{background-color: #dddddd;border-color: #dfdfdf;opacity:1;}.frm_style_formidable-style.with_frm_style .frm_current_page .frm_rootline_title{color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_rootline_title,.frm_style_formidable-style.with_frm_style .frm_pages_complete,.frm_style_formidable-style.with_frm_style .frm_percent_complete{color: #666666;}.frm_style_formidable-style.with_frm_style .frm_progress_line input,.frm_style_formidable-style.with_frm_style .frm_progress_line input:disabled {border-color: #dfdfdf;}.frm_style_formidable-style.with_frm_style .frm_progress_line.frm_show_lines input {border-left-color: #ffffff;border-right-color: #ffffff;border-left-width: 1px ;border-right-width: 1px ;}.frm_style_formidable-style.with_frm_style .frm_progress_line li:first-of-type input {border-left-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_progress_line li:last-of-type input {border-right-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_progress_line li:last-of-type input.frm_page_skip {border-right-color: #dfdfdf;}.frm_style_formidable-style.with_frm_style .frm_progress_line .frm_current_page input[type=\"button\"] {border-left-color: #dfdfdf;}.frm_style_formidable-style.with_frm_style .frm_progress_line.frm_show_lines .frm_current_page input[type=\"button\"] {border-right-color: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_progress_line input.frm_page_back {border-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_progress_line.frm_show_lines input.frm_page_back{border-left-color: #008ec2;border-right-color: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_rootline.frm_show_lines:before {border-color: #dfdfdf;border-top-width: 2px;top: 15px;}.frm_style_formidable-style.with_frm_style .frm_rootline input,.frm_style_formidable-style.with_frm_style .frm_rootline input:hover {width: 30px;height: 30px;border-radius: 30px;padding: 0;}.frm_style_formidable-style.with_frm_style .frm_rootline input:focus {border-color: #008ec2;}.frm_style_formidable-style.with_frm_style .frm_rootline .frm_current_page input[type=\"button\"] {border-color: #007aae;background-color: #008ec2;color: #ffffff;}.frm_style_formidable-style.with_frm_style .frm_progress_line input,.frm_style_formidable-style.with_frm_style .frm_progress_line input:disabled,.frm_style_formidable-style.with_frm_style .frm_progress_line .frm_current_page input[type=\"button\"],.frm_style_formidable-style.with_frm_style .frm_rootline.frm_no_numbers input,.frm_style_formidable-style.with_frm_style .frm_rootline.frm_no_numbers .frm_current_page input[type=\"button\"] {color: transparent !important;}@media only screen and (max-width: 600px){.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container.frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container.g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .chosen-container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container.frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container.g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .chosen-container{max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_right_container .frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .frm_primary_label{max-width:100%;margin-right:0;margin-left:0;padding-right:0;padding-left:0;width:100%;}.frm_style_formidable-style.with_frm_style .frm_repeat_inline,.frm_style_formidable-style.with_frm_style .frm_repeat_grid{margin: 20px 0;}.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_right_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half.frm_left_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_first_half .frm_left_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_last_half.frm_left_container .frm_error,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container div.frm_description,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_half.frm_left_container .frm_error{margin-right:0;margin-left:0;padding-right:0;padding-left:0;}}@media only screen and (max-width: 500px) {.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_left_container .chosen-container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container:not(.frm_dynamic_select_container) select,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container textarea,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm_opt_container,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .frm-g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .g-recaptcha,.frm_style_formidable-style.with_frm_style .frm_form_field.frm_right_container .chosen-container{max-width:100%;}.frm_style_formidable-style.with_frm_style .frm_left_container > p.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > div.frm_description::before,.frm_style_formidable-style.with_frm_style .frm_left_container > .frm_error::before,.frm_style_formidable-style.with_frm_style .frm_right_container > p.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > div.frm_description::after,.frm_style_formidable-style.with_frm_style .frm_right_container > .frm_error::after{display:none;}.frm_style_formidable-style.with_frm_style .frm_left_container label.frm_primary_label,.frm_style_formidable-style.with_frm_style .frm_right_container label.frm_primary_label{width:100%;max-width:100%;margin-right:0;margin-left:0;padding-right:0;padding-left:0;}}.frm_ajax_loading{visibility:hidden;width:auto;}.frm_form_submit_style{height:auto;}a.frm_save_draft{cursor:pointer;}.horizontal_radio .frm_radio{margin:0 5px 0 0;}.horizontal_radio .frm_checkbox{margin:0;margin-right:5px;}.vertical_radio .frm_checkbox,.vertical_radio .frm_radio,.vertical_radio .frm_catlevel_1{display:block;}.horizontal_radio .frm_checkbox,.horizontal_radio .frm_radio,.horizontal_radio .frm_catlevel_1{display:inline-block;}.frm_file_container .frm_file_link,.with_frm_style .frm_radio label .frm_file_container,.with_frm_style .frm_checkbox label .frm_file_container{display:inline-block;margin:5px;vertical-align:middle;}.with_frm_style .frm_radio input[type=radio]{border-radius:10px;-webkit-appearance:radio;}.with_frm_style .frm_checkbox input[type=checkbox]{border-radius:0;-webkit-appearance:checkbox;}.with_frm_style .frm_radio input[type=radio],.with_frm_style .frm_checkbox input[type=checkbox]{display:inline-block;margin-right:5px;width:auto;border:none;vertical-align:baseline;}.with_frm_style :invalid,.with_frm_style :-moz-submit-invalid,.with_frm_style :-moz-ui-invalid{box-shadow:none;}.with_frm_style .frm_error_style img{padding-right:10px;vertical-align:middle;border:none;}.with_frm_style .frm_trigger{cursor:pointer;}.with_frm_style .frm_error_style,.with_frm_style .frm_message,.frm_success_style{-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;padding:15px;}.with_frm_style .frm_message p{margin-bottom:5px;}.frm_form_fields_style,.frm_form_fields_active_style,.frm_form_fields_error_style,.frm_form_submit_style{width:auto;}.with_frm_style .frm_trigger span{float:left;}.with_frm_style table.frm-grid,#content .with_frm_style table.frm-grid{border-collapse:collapse;border:none;}.frm-grid td,.frm-grid th{padding:5px;border-width:1px;border-style:solid;border-color:#cccccc;border-top:none;border-left:none;border-right:none;}table.form_results.with_frm_style{border:1px solid #ccc;}table.form_results.with_frm_style tr td{text-align:left;color:#555555;padding:7px 9px;border-top:1px solid #cccccc;}table.form_results.with_frm_style tr.frm_even,.frm-grid .frm_even{background-color:#fff;}table.form_results.with_frm_style tr.frm_odd,.frm-grid .frm_odd{background-color:ffffff;}.frm_collapse .ui-icon{display:inline-block;}.frm_toggle_container{border:1px solid transparent;}.frm_toggle_container ul{margin:5px 0;padding-left:0;list-style-type:none;}.frm_toggle_container .frm_month_heading{text-indent:15px;}.frm_toggle_container .frm_month_listing{margin-left:40px;}#frm_loading{display:none;position:fixed;top:0;left:0;width:100%;height:100%;z-index:99999;}#frm_loading h3{font-weight:500;padding-bottom:15px;color:#fff;font-size:24px;}#frm_loading_content{position:fixed;top:20%;left:33%;width:33%;text-align:center;padding-top:30px;font-weight:bold;z-index:9999999;}#frm_loading img{max-width:100%;}#frm_loading .progress{border-radius:4px;box-shadow:0 1px 2px rgba(0, 0, 0, 0.1) inset;height:20px;margin-bottom:20px;overflow:hidden;}#frm_loading .progress.active .progress-bar{animation:2s linear 0s normal none infinite progress-bar-stripes;}#frm_loading .progress-striped .progress-bar{background-image:linear-gradient(45deg, #cccccc 25%, rgba(0, 0, 0, 0) 25%, rgba(0, 0, 0, 0) 50%, #cccccc 50%, #cccccc 75%, rgba(0, 0, 0, 0) 75%, rgba(0, 0, 0, 0));background-size:40px 40px;}#frm_loading .progress-bar{background-color:#ffffff;box-shadow:0 -1px 0 rgba(0, 0, 0, 0.15) inset;float:left;height:100%;line-height:20px;text-align:center;transition:width 0.6s ease 0s;width:100%;}.frm_image_from_url{height:50px;}.frm-loading-img{background:url(//localhost/richmondmediahosting/wp-content/plugins/formidable/images/ajax_loader.gif) no-repeat center center;padding:6px 12px;}select.frm_loading_lookup{background-image: url(//localhost/richmondmediahosting/wp-content/plugins/formidable/images/ajax_loader.gif) !important;background-position: 10px;background-repeat: no-repeat;color: transparent !important;}.with_frm_style .frm_form_field{clear:both;}.frm_form_field.frm_right_half,.frm_form_field.frm_right_third,.frm_form_field.frm_right_two_thirds,.frm_form_field.frm_right_fourth,.frm_form_field.frm_right_fifth,.frm_form_field.frm_right_inline,.frm_form_field.frm_last_half,.frm_form_field.frm_last_third,.frm_form_field.frm_last_two_thirds,.frm_form_field.frm_last_fourth,.frm_form_field.frm_last_fifth,.frm_form_field.frm_last_sixth,.frm_form_field.frm_last_seventh,.frm_form_field.frm_last_eighth,.frm_form_field.frm_last_inline,.frm_form_field.frm_last,.frm_form_field.frm_half,.frm_submit.frm_half,.frm_form_field.frm_third,.frm_submit.frm_third,.frm_form_field.frm_two_thirds,.frm_form_field.frm_fourth,.frm_submit.frm_fourth,.frm_form_field.frm_three_fourths,.frm_form_field.frm_fifth,.frm_submit.frm_fifth,.frm_form_field.frm_two_fifths,.frm_form_field.frm_three_fifths,.frm_form_field.frm_four_fifths,.frm_form_field.frm_sixth,.frm_submit.frm_sixth,.frm_form_field.frm_seventh,.frm_submit.frm_seventh,.frm_form_field.frm_eighth,.frm_submit.frm_eighth,.frm_form_field.frm_inline,.frm_submit.frm_inline{clear:none;float:left;margin-left:2.5%;}.frm_form_field.frm_left_half,.frm_form_field.frm_left_third,.frm_form_field.frm_left_two_thirds,.frm_form_field.frm_left_fourth,.frm_form_field.frm_left_fifth,.frm_form_field.frm_left_inline,.frm_form_field.frm_first_half,.frm_form_field.frm_first_third,.frm_form_field.frm_first_two_thirds,.frm_form_field.frm_first_fourth,.frm_form_field.frm_first_fifth,.frm_form_field.frm_first_sixth,.frm_form_field.frm_first_seventh,.frm_form_field.frm_first_eighth,.frm_form_field.frm_first_inline,.frm_form_field.frm_first{clear:left;float:left;margin-left:0;}.frm_form_field.frm_alignright{float:right !important;}.frm_form_field.frm_left_half,.frm_form_field.frm_right_half,.frm_form_field.frm_first_half,.frm_form_field.frm_last_half,.frm_form_field.frm_half,.frm_submit.frm_half{width:48.75%;}.frm_form_field.frm_left_third,.frm_form_field.frm_third,.frm_submit.frm_third,.frm_form_field.frm_right_third,.frm_form_field.frm_first_third,.frm_form_field.frm_last_third{width:31.66%;}.frm_form_field.frm_left_two_thirds,.frm_form_field.frm_right_two_thirds,.frm_form_field.frm_first_two_thirds,.frm_form_field.frm_last_two_thirds,.frm_form_field.frm_two_thirds{width:65.82%;}.frm_form_field.frm_left_fourth,.frm_form_field.frm_fourth,.frm_submit.frm_fourth,.frm_form_field.frm_right_fourth,.frm_form_field.frm_first_fourth,.frm_form_field.frm_last_fourth{width:23.12%;}.frm_form_field.frm_three_fourths{width:74.36%;}.frm_form_field.frm_left_fifth,.frm_form_field.frm_fifth,.frm_submit.frm_fifth,.frm_form_field.frm_right_fifth,.frm_form_field.frm_first_fifth,.frm_form_field.frm_last_fifth{width:18%;}.frm_form_field.frm_two_fifths {width:38.5%;}.frm_form_field.frm_three_fifths {width:59%;}.frm_form_field.frm_four_fifths {width:79.5%;}.frm_form_field.frm_sixth,.frm_submit.frm_sixth,.frm_form_field.frm_first_sixth,.frm_form_field.frm_last_sixth{width:14.58%;}.frm_form_field.frm_seventh,.frm_submit.frm_seventh,.frm_form_field.frm_first_seventh,.frm_form_field.frm_last_seventh{width:12.14%;}.frm_form_field.frm_eighth,.frm_submit.frm_eighth,.frm_form_field.frm_first_eighth,.frm_form_field.frm_last_eighth{width:10.31%;}.frm_form_field.frm_left_inline,.frm_form_field.frm_first_inline,.frm_form_field.frm_inline,.frm_submit.frm_inline,.frm_form_field.frm_right_inline,.frm_form_field.frm_last_inline{width:auto;}.frm_full,.frm_full .wp-editor-wrap,.frm_full input:not([type=\'checkbox\']):not([type=\'radio\']):not([type=\'button\']),.frm_full select,.frm_full textarea{width:100% !important;}.frm_full .wp-editor-wrap input{width:auto !important;}@media only screen and (max-width: 600px) {.frm_form_field.frm_half,.frm_submit.frm_half,.frm_form_field.frm_left_half,.frm_form_field.frm_right_half,.frm_form_field.frm_first_half,.frm_form_field.frm_last_half,.frm_form_field.frm_first_third,.frm_form_field.frm_third,.frm_submit.frm_third,.frm_form_field.frm_last_third,.frm_form_field.frm_first_two_thirds,.frm_form_field.frm_last_two_thirds,.frm_form_field.frm_two_thirds,.frm_form_field.frm_left_fourth,.frm_form_field.frm_fourth,.frm_submit.frm_fourth,.frm_form_field.frm_right_fourth,.frm_form_field.frm_first_fourth,.frm_form_field.frm_last_fourth,.frm_form_field.frm_three_fourths,.frm_form_field.frm_fifth,.frm_submit.frm_fifth,.frm_form_field.frm_two_fifths,.frm_form_field.frm_three_fifths,.frm_form_field.frm_four_fifths,.frm_form_field.frm_sixth,.frm_submit.frm_sixth,.frm_form_field.frm_seventh,.frm_submit.frm_seventh,.frm_form_field.frm_eighth,.frm_submit.frm_eighth,.frm_form_field.frm_first_inline,.frm_form_field.frm_inline,.frm_submit.frm_inline,.frm_form_field.frm_last_inline{width:100%;margin-left:0;margin-right:0;clear:both;float:none;}}.frm_form_field.frm_left_container label.frm_primary_label{float:left;display:inline;max-width:33%;margin-right:10px;}.with_frm_style .frm_conf_field.frm_left_container label.frm_primary_label{display:inline;visibility:hidden;}.frm_form_field.frm_left_container input:not([type=radio]):not([type=checkbox]),.frm_form_field.frm_left_container:not(.frm_dynamic_select_container) select,.frm_form_field.frm_left_container textarea,.frm_form_field.frm_left_container .wp-editor-wrap,.frm_form_field.frm_left_container .frm_opt_container,.frm_form_field.frm_left_container .frm_dropzone,.frm_form_field.frm_left_container .frm-g-recaptcha,.frm_form_field.frm_left_container .g-recaptcha,.frm_form_field.frm_left_container .chosen-container,.frm_form_field.frm_left_container .frm_combo_inputs_container,.frm_form_field.frm_right_container input:not([type=radio]):not([type=checkbox]),.frm_form_field.frm_right_container:not(.frm_dynamic_select_container) select,.frm_form_field.frm_right_container textarea,.frm_form_field.frm_right_container .wp-editor-wrap,.frm_form_field.frm_right_container .frm_opt_container,.frm_form_field.frm_right_container .frm_dropzone,.frm_form_field.frm_right_container .frm-g-recaptcha,.frm_form_field.frm_right_container .g-recaptcha,.frm_form_field.frm_right_container .chosen-container,.frm_form_field.frm_right_container .frm_combo_inputs_container{max-width:62%;}.frm_form_field.frm_left_container .frm_combo_inputs_container input,.frm_form_field.frm_left_container .frm_combo_inputs_container select,.frm_form_field.frm_right_container .frm_combo_inputs_container input,.frm_form_field.frm_right_container .frm_combo_inputs_container select{max-width:100%;}.frm_form_field.frm_left_container .frm_opt_container,.frm_form_field.frm_right_container .frm_opt_container,.frm_form_field.frm_inline_container .frm_opt_container,.frm_form_field.frm_left_container .frm_combo_inputs_container,.frm_form_field.frm_right_container .frm_combo_inputs_container,.frm_form_field.frm_inline_container .frm_combo_inputs_container,.frm_form_field.frm_left_container .wp-editor-wrap,.frm_form_field.frm_right_container .wp-editor-wrap,.frm_form_field.frm_inline_container .wp-editor-wrap,.frm_form_field.frm_left_container .frm_dropzone,.frm_form_field.frm_right_container .frm_dropzone,.frm_form_field.frm_inline_container .frm_dropzone,.frm_form_field.frm_left_container .frm-g-recaptcha,.frm_form_field.frm_right_container .frm-g-recaptcha,.frm_form_field.frm_inline_container .frm-g-recaptcha,.frm_form_field.frm_left_container .g-recaptcha,.frm_form_field.frm_right_container .g-recaptcha,.frm_form_field.frm_inline_container .g-recaptcha{display:inline-block;}.frm_form_field.frm_left_half.frm_left_container .frm_primary_label,.frm_form_field.frm_right_half.frm_left_container .frm_primary_label,.frm_form_field.frm_left_half.frm_right_container .frm_primary_label,.frm_form_field.frm_right_half.frm_right_container .frm_primary_label,.frm_form_field.frm_first_half.frm_left_container .frm_primary_label,.frm_form_field.frm_last_half.frm_left_container .frm_primary_label,.frm_form_field.frm_first_half.frm_right_container .frm_primary_label,.frm_form_field.frm_last_half.frm_right_container .frm_primary_label,.frm_form_field.frm_half.frm_right_container .frm_primary_label,.frm_form_field.frm_half.frm_left_container .frm_primary_label{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;max-width:33%;}.wp-editor-wrap *,.wp-editor-wrap *:after,.wp-editor-wrap *:before{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;}.with_frm_style .frm_grid,.with_frm_style .frm_grid_first,.with_frm_style .frm_grid_odd{clear:both;margin-bottom:0 !important;padding:5px;border-width:1px;border-style:solid;border-color:#cccccc;border-left:none;border-right:none;}.with_frm_style .frm_grid,.with_frm_style .frm_grid_odd{border-top:none;}.frm_grid .frm_error,.frm_grid_first .frm_error,.frm_grid_odd .frm_error{display:none;}.frm_grid:after,.frm_grid_first:after,.frm_grid_odd:after{visibility:hidden;display:block;font-size:0;content:\" \";clear:both;height:0;}.frm_grid_first{margin-top:20px;}.frm_grid_first,.frm_grid_odd{background-color:#ffffff;}.frm_grid{background-color:ffffff;}.frm_grid .frm_primary_label,.frm_grid_first .frm_primary_label,.frm_grid_odd .frm_primary_label,.frm_grid .frm_radio,.frm_grid_first .frm_radio,.frm_grid_odd .frm_radio,.frm_grid .frm_checkbox,.frm_grid_first .frm_checkbox,.frm_grid_odd .frm_checkbox{float:left !important;display:block;margin-top:0;margin-left:0 !important;}.frm_grid_first .frm_radio label,.frm_grid .frm_radio label,.frm_grid_odd .frm_radio label,.frm_grid_first .frm_checkbox label,.frm_grid .frm_checkbox label,.frm_grid_odd .frm_checkbox label{visibility:hidden;white-space:nowrap;text-align:left;}.frm_grid_first .frm_radio label input,.frm_grid .frm_radio label input,.frm_grid_odd .frm_radio label input,.frm_grid_first .frm_checkbox label input,.frm_grid .frm_checkbox label input,.frm_grid_odd .frm_checkbox label input{visibility:visible;margin:2px 0 0;float:right;}.frm_grid .frm_radio,.frm_grid_first .frm_radio,.frm_grid_odd .frm_radio,.frm_grid .frm_checkbox,.frm_grid_first .frm_checkbox,.frm_grid_odd .frm_checkbox{display:inline;}.frm_grid_2 .frm_radio,.frm_grid_2 .frm_checkbox,.frm_grid_2 label.frm_primary_label{width:48% !important;}.frm_grid_2 .frm_radio,.frm_grid_2 .frm_checkbox{margin-right:4%;}.frm_grid_3 .frm_radio,.frm_grid_3 .frm_checkbox,.frm_grid_3 label.frm_primary_label{width:30% !important;}.frm_grid_3 .frm_radio,.frm_grid_3 .frm_checkbox{margin-right:3%;}.frm_grid_4 .frm_radio,.frm_grid_4 .frm_checkbox{width:20% !important;}.frm_grid_4 label.frm_primary_label{width:28% !important;}.frm_grid_4 .frm_radio,.frm_grid_4 .frm_checkbox{margin-right:4%;}.frm_grid_5 label.frm_primary_label,.frm_grid_7 label.frm_primary_label{width:24% !important;}.frm_grid_5 .frm_radio,.frm_grid_5 .frm_checkbox{width:17% !important;margin-right:2%;}.frm_grid_6 label.frm_primary_label{width:25% !important;}.frm_grid_6 .frm_radio,.frm_grid_6 .frm_checkbox{width:14% !important;margin-right:1%;}.frm_grid_7 label.frm_primary_label{width:22% !important;}.frm_grid_7 .frm_radio,.frm_grid_7 .frm_checkbox{width:12% !important;margin-right:1%;}.frm_grid_8 label.frm_primary_label{width:23% !important;}.frm_grid_8 .frm_radio,.frm_grid_8 .frm_checkbox{width:10% !important;margin-right:1%;}.frm_grid_9 label.frm_primary_label{width:20% !important;}.frm_grid_9 .frm_radio,.frm_grid_9 .frm_checkbox{width:9% !important;margin-right:1%;}.frm_grid_10 label.frm_primary_label{width:19% !important;}.frm_grid_10 .frm_radio,.frm_grid_10 .frm_checkbox{width:8% !important;margin-right:1%;}.with_frm_style .frm_inline_container.frm_grid_first label.frm_primary_label,.with_frm_style .frm_inline_container.frm_grid label.frm_primary_label,.with_frm_style .frm_inline_container.frm_grid_odd label.frm_primary_label,.with_frm_style .frm_inline_container.frm_grid_first .frm_opt_container,.with_frm_style .frm_inline_container.frm_grid .frm_opt_container,.with_frm_style .frm_inline_container.frm_grid_odd .frm_opt_container{margin-right:0;}.with_frm_style .frm_inline_container.frm_scale_container label.frm_primary_label{float:left;}.with_frm_style .frm_other_input.frm_other_full{margin-top:10px;}.frm_form_field.frm_two_col .frm_radio,.frm_form_field.frm_three_col .frm_radio,.frm_form_field.frm_four_col .frm_radio,.frm_form_field.frm_two_col .frm_checkbox,.frm_form_field.frm_three_col .frm_checkbox,.frm_form_field.frm_four_col .frm_checkbox{float:left;}.frm_form_field.frm_two_col .frm_radio,.frm_form_field.frm_two_col .frm_checkbox{width:48%;margin-right:4%;}.frm_form_field .frm_checkbox,.frm_form_field .frm_checkbox + .frm_checkbox,.frm_form_field .frm_radio,.frm_form_field .frm_radio + .frm_radio{margin-top: 0;margin-bottom: 0;}.frm_form_field.frm_three_col .frm_radio,.frm_form_field.frm_three_col .frm_checkbox{width:30%;margin-right:5%;}.frm_form_field.frm_four_col .frm_radio,.frm_form_field.frm_four_col .frm_checkbox{width:22%;margin-right:4%;}.frm_form_field.frm_two_col .frm_radio:nth-child(2n+2),.frm_form_field.frm_two_col .frm_checkbox:nth-child(2n+2),.frm_form_field.frm_three_col .frm_radio:nth-child(3n+3),.frm_form_field.frm_three_col .frm_checkbox:nth-child(3n+3),.frm_form_field.frm_four_col .frm_radio:nth-child(4n+4),.frm_form_field.frm_four_col .frm_checkbox:nth-child(4n+4){margin-right:0;}.frm_form_field.frm_scroll_box .frm_opt_container{height:100px;overflow:auto;}.frm_form_field.frm_html_scroll_box{height:100px;overflow:auto;background-color:#ffffff;border-color:#cccccc;border-width:1px;border-style:solid;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;width:100%;max-width:100%;font-size:14px;padding:6px 10px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;outline:none;font-weight:normal;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset;}.frm_form_field.frm_two_col .frm_opt_container:after,.frm_form_field.frm_three_col .frm_opt_container:after,.frm_form_field.frm_four_col .frm_opt_container:after{content:\".\";display:block;clear:both;visibility:hidden;line-height:0;height:0;}.frm_form_field.frm_total input,.frm_form_field.frm_total textarea{opacity:1;background-color:transparent !important;border:none !important;font-weight:bold;-moz-box-shadow:none;-webkit-box-shadow:none;width:auto !important;box-shadow:none !important;display:inline;-moz-appearance:textfield;padding:0;}.frm_form_field.frm_total input::-webkit-outer-spin-button,.frm_form_field.frm_total input::-webkit-inner-spin-button {-webkit-appearance: none;}.frm_form_field.frm_total input:focus,.frm_form_field.frm_total textarea:focus{background-color:transparent;border:none;-moz-box-shadow:none;-webkit-box-shadow:none;box-shadow:none;}.frm_form_field.frm_label_justify label.frm_primary_label{text-align:justify !important;}.frm_form_field.frm_capitalize input,.frm_form_field.frm_capitalize select,.frm_form_field.frm_capitalize .frm_opt_container label{text-transform:capitalize;}.frm_clearfix:after{content:\".\";display:block;clear:both;visibility:hidden;line-height:0;height:0;}.frm_clearfix{display:block;}.with_frm_style.frm_login_form,.with_frm_style.frm_login_form form{clear:both;}.with_frm_style.frm_login_form.frm_inline_login .login-remember input{vertical-align:baseline;}.with_frm_style.frm_login_form.frm_inline_login .login-submit{float:left;}.with_frm_style.frm_login_form.frm_inline_login label{display:inline;}.with_frm_style.frm_login_form.frm_inline_login .login-username,.with_frm_style.frm_login_form.frm_inline_login .login-password,.with_frm_style.frm_login_form.frm_inline_login .login-remember{float:left;margin-right:5px;}.with_frm_style.frm_login_form.frm_inline_login form{position:relative;clear:none;}.with_frm_style.frm_login_form.frm_inline_login .login-remember{position:absolute;top:35px;}.with_frm_style.frm_login_form.frm_inline_login input[type=submit]{margin:0 !important;}.with_frm_style.frm_login_form.frm_no_labels .login-username label,.with_frm_style.frm_login_form.frm_no_labels .login-password label{display:none;}.with_frm_style .frm-open-login{float:left;margin-right:15px;}.with_frm_style .frm-open-login a{text-decoration:none;border:none;outline:none;}.with_frm_style.frm_slide.frm_login_form form{display:none;}@font-face {font-family:\'s11-fp\';src:url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.eot\');src:local(\'☺\'), url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.woff\') format(\'woff\'), url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.ttf\') format(\'truetype\'), url(\'//localhost/richmondmediahosting/wp-content/plugins/formidable/fonts/s11-fp.svg\') format(\'svg\');font-weight:normal;font-style:normal;}.frm_icon_font,.frm_dashicon_font{text-decoration:none;text-shadow: none;font-weight:normal;}i.frm_icon_font{font-style:normal;}.frm_icon_font:before,select.frm_icon_font{font-family: \'s11-fp\' !important;font-size:16px;speak: none;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;-moz-transition: all .1s ease-in-out;-webkit-transition: all .1s ease-in-out;transition: all .1s ease-in-out;}.frm_icon_font,a.frm_icon_font,.frm_icon_font:hover,a.frm_icon_font:hover{text-decoration:none !important;box-shadow:none;}.frm_icon_font:focus,.frm_dashicon_font:focus{box-shadow:none;-webkit-box-shadow:none;}.frm_duplicate_icon:active,.frm_move_icon:active,.frm_delete_icon:active{outline:none;}.frm_trigger .frm_icon_font{padding:0 5px;}.ab-icon.frm_dashicon_font:before{content: \"\\f324\";}.frm_logo_icon:before {content: \"\\e601\";}.frm_required_icon:before {content: \"\\e612\";}.frm_delete_icon:before {content: \"\\e610\" !important;}.frm_move_icon:before {content: \"\\e61a\";}.frm_clear_icon:before {content: \"\\e60a\";}.frm_noclear_icon:before {content: \"\\e60b\";}.frm_duplicate_icon:before {content: \"\\e61b\";}.frm_new_icon:before {content: \"\\e614\";}.frm_tooltip_icon:before {content: \"\\e611\";}.frm_forbid_icon:before {content: \"\\e636\";}.frm_check_icon:before {content: \"\\e605\";}.frm_check1_icon:before {content: \"\\e606\";}.frm_plus_icon:before {content: \"\\e62f\";}.frm_plus1_icon:before {content: \"\\e602\";}.frm_plus2_icon:before {content: \"\\e603\";}.frm_plus3_icon:before {content: \"\\e632\";}.frm_plus4_icon:before {content: \"\\e60f\";}.frm_minus_icon:before {content: \"\\e62e\";}.frm_minus1_icon:before {content: \"\\e600\";}.frm_minus2_icon:before {content: \"\\e604\";}.frm_minus3_icon:before {content: \"\\e633\";}.frm_minus4_icon:before {content: \"\\e613\";}.frm_cancel_icon:before {content: \"\\e607\";}.frm_cancel1_icon:before {content: \"\\e608\";}.frm_arrowup_icon:before {content: \"\\e60d\";}.frm_arrowup1_icon:before {content: \"\\e60e\";}.frm_arrowup2_icon:before {content: \"\\e630\";}.frm_arrowup3_icon:before {content: \"\\e62b\";}.frm_arrowup4_icon:before {content: \"\\e62c\";}.frm_arrowup5_icon:before {content: \"\\e635\";}.frm_arrowup6_icon:before {content: \"\\e62d\";}.frm_arrowdown_icon:before {content: \"\\e609\";}.frm_arrowdown1_icon:before {content: \"\\e60c\";}.frm_arrowdown2_icon:before {content: \"\\e631\";}.frm_arrowdown3_icon:before {content: \"\\e628\";}.frm_arrowdown4_icon:before {content: \"\\e629\";}.frm_arrowdown5_icon:before {content: \"\\e634\";}.frm_arrowdown6_icon:before {content: \"\\e62a\";}.frm_download_icon:before {content: \"\\e615\";}.frm_upload_icon:before {content: \"\\e616\";}.frm_menu_icon:before {content: \"\\e618\";}.frm_twitter_icon:before {content: \"\\e619\";}.frm_sms_icon:before {content: \"\\e61c\";}.frm_pencil_icon:before {content: \"\\e61d\";}.frm_pencil1_icon:before {content: \"\\e61e\";}.frm_paypal_icon:before {content: \"\\e61f\";}.frm_twilio_icon:before {content: \"\\e620\";}.frm_googleplus_icon:before {content: \"\\e621\";}.frm_mailchimp_icon:before {content: \"\\e622\";}.frm_pdf_icon:before {content: \"\\e623\";}.frm_highrise_icon:before {content: \"\\e617\";}.frm_feed_icon:before {content: \"\\e624\";}.frm_facebook_icon:before {content: \"\\e625\";}.frm_email_icon:before {content: \"\\e626\";}.frm_aweber_icon:before {content: \"\\e627\";}.frm_register_icon:before {content: \"\\e637\";}.frm_authorize_icon:before {content: \"\\e900\";}.frm_stripe_icon:before {content: \"\\e902\";}.frm_woocommerce_icon:before {content: \"\\e903\";}.frm_paste_icon:before {content: \"\\e901\";}@media only screen and (max-width: 900px) {.frm_form_field .frm_repeat_grid .frm_form_field.frm_sixth label.frm_primary_label,.frm_form_field .frm_repeat_grid .frm_form_field.frm_seventh label.frm_primary_label,.frm_form_field .frm_repeat_grid .frm_form_field.frm_eighth label.frm_primary_label{display: block !important;}.frm_form_field .frm_repeat_grid .frm_form_field.frm_repeat_buttons.frm_seventh label.frm_primary_label{display:none !important;}}@media only screen and (max-width: 600px) {.frm_form_field.frm_four_col .frm_radio,.frm_form_field.frm_four_col .frm_checkbox{width:48%;margin-right:4%;}.frm_form_field.frm_four_col .frm_radio:nth-child(2n+2),.frm_form_field.frm_four_col .frm_checkbox:nth-child(2n+2){margin-right:0;}.frm_form_field .frm_repeat_grid.frm_first_repeat .frm_form_field.frm_repeat_buttons:not(.frm_fourth):not(.frm_sixth):not(.frm_eighth) label.frm_primary_label{display:none !important;}.frm_form_field .frm_repeat_grid .frm_form_field.frm_fifth label.frm_primary_label{display:block !important;}.frm_form_field .frm_repeat_grid .frm_form_field.frm_repeat_buttons.frm_fifth label.frm_primary_label{display:none !important;}}@media only screen and (max-width: 500px) {.frm_form_field.frm_two_col .frm_radio,.frm_form_field.frm_two_col .frm_checkbox,.frm_form_field.frm_three_col .frm_radio,.frm_form_field.frm_three_col .frm_checkbox{width: auto;margin-right: 0;float: none;display:block;}.frm_form_field input[type=file] {max-width:220px;}.with_frm_style.frm_login_form.frm_inline_login p{clear:both;float:none;}.with_frm_style.frm_login_form.frm_inline_login form{position:static;}.with_frm_style.frm_login_form.frm_inline_login .login-remember{position:static;}.with_frm_style .frm-g-recaptcha > div > div,.with_frm_style .g-recaptcha > div > div{width:inherit !important;display:block;overflow:hidden;max-width:302px;border-right:1px solid #d3d3d3;border-radius:4px;box-shadow:2px 0px 4px -1px rgba(0,0,0,.08);-moz-box-shadow:2px 0px 4px -1px rgba(0,0,0,.08);}.with_frm_style .g-recaptcha iframe,.with_frm_style .frm-g-recaptcha iframe{width:100%;}}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(177, 'acui_columns', '', 'yes'),
(178, 'acui_mail_subject', 'Welcome to richmondmediahosting', 'no'),
(179, 'acui_mail_body', 'Welcome,<br/>Your data to login in this site is:<br/><ul><li>URL to login: **loginurl**</li><li>Username= **username**</li><li>Password = **password**</li></ul>', 'no'),
(180, 'acui_cron_activated', '', 'yes'),
(181, 'acui_cron_send_mail', '', 'yes'),
(182, 'acui_cron_send_mail_updated', '', 'yes'),
(183, 'acui_cron_delete_users', '', 'yes'),
(184, 'acui_cron_path_to_file', '', 'yes'),
(185, 'acui_cron_path_to_move', '', 'yes'),
(186, 'acui_cron_path_to_move_auto_rename', '', 'yes'),
(187, 'acui_cron_period', '', 'yes'),
(188, 'acui_cron_role', '', 'yes'),
(189, 'acui_cron_log', '', 'yes'),
(190, 'acui_manually_send_mail', '', 'yes'),
(191, 'acui_manually_send_mail_updated', '', 'yes'),
(192, 'acui_automattic_wordpress_email', '', 'yes'),
(193, 'acui_show_profile_fields', '', 'yes'),
(194, 'acui_settings', 'wordpress', 'yes'),
(195, 'acui_mail_from', '', 'yes'),
(196, 'acui_mail_from_name', '', 'yes'),
(197, 'acui_mailer', 'smtp', 'yes'),
(198, 'acui_mail_set_return_path', 'false', 'yes'),
(199, 'acui_smtp_host', 'localhost', 'yes'),
(200, 'acui_smtp_port', '25', 'yes'),
(201, 'acui_smtp_ssl', 'none', 'yes'),
(202, 'acui_smtp_auth', '', 'yes'),
(203, 'acui_smtp_user', '', 'yes'),
(204, 'acui_smtp_pass', '', 'yes'),
(205, 'masterslider_db_version', '1.03', 'yes'),
(206, 'masterslider_capabilities_added', '1', 'yes'),
(207, 'master-slider_ab_pro_feature_panel_content_type', '1', 'yes'),
(208, 'master-slider_ab_pro_feature_setting_content_type', '1', 'yes'),
(209, 'code_snippets_version', '2.9.4', 'yes'),
(210, 'widget_st-query-widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(211, 'widget_frm_show_form', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(212, 'widget_widget_sp_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(213, 'widget_master-slider-main-widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(214, 'jquery-colorbox_settings', 'a:47:{s:21:\"jQueryColorboxVersion\";s:5:\"4.6.2\";s:13:\"colorboxTheme\";s:6:\"theme1\";s:8:\"maxWidth\";s:5:\"false\";s:13:\"maxWidthValue\";s:0:\"\";s:12:\"maxWidthUnit\";s:1:\"%\";s:9:\"maxHeight\";s:5:\"false\";s:14:\"maxHeightValue\";s:0:\"\";s:13:\"maxHeightUnit\";s:1:\"%\";s:6:\"height\";s:5:\"false\";s:11:\"heightValue\";s:0:\"\";s:10:\"heightUnit\";s:1:\"%\";s:5:\"width\";s:5:\"false\";s:10:\"widthValue\";s:0:\"\";s:9:\"widthUnit\";s:1:\"%\";s:10:\"linkHeight\";s:5:\"false\";s:15:\"linkHeightValue\";s:0:\"\";s:14:\"linkHeightUnit\";s:1:\"%\";s:9:\"linkWidth\";s:5:\"false\";s:14:\"linkWidthValue\";s:0:\"\";s:13:\"linkWidthUnit\";s:1:\"%\";s:12:\"initialWidth\";s:3:\"300\";s:13:\"initialHeight\";s:3:\"100\";s:12:\"autoColorbox\";b:0;s:21:\"autoColorboxGalleries\";b:0;s:9:\"slideshow\";b:0;s:13:\"slideshowAuto\";b:0;s:11:\"scalePhotos\";b:0;s:16:\"displayScrollbar\";b:0;s:9:\"draggable\";b:0;s:14:\"slideshowSpeed\";s:4:\"2500\";s:7:\"opacity\";s:4:\"0.85\";s:10:\"preloading\";b:0;s:10:\"transition\";s:7:\"elastic\";s:5:\"speed\";s:3:\"350\";s:12:\"overlayClose\";b:0;s:11:\"disableLoop\";b:0;s:11:\"disableKeys\";b:0;s:13:\"autoHideFlash\";b:0;s:18:\"colorboxWarningOff\";b:0;s:19:\"colorboxMetaLinkOff\";b:0;s:18:\"javascriptInFooter\";b:0;s:9:\"debugMode\";b:0;s:22:\"autoColorboxJavaScript\";b:0;s:23:\"colorboxAddClassToLinks\";b:0;s:14:\"addZoomOverlay\";b:0;s:15:\"useGoogleJQuery\";b:0;s:21:\"removeLinkFromMetaBox\";b:1;}', 'yes'),
(215, 'mappress_options', 'a:14:{s:6:\"apiKey\";s:39:\"AIzaSyCVOBohhFnCKx6kriQsZXpCNX8CzOJKJWg\";s:9:\"postTypes\";a:2:{i:0;s:4:\"post\";i:1;s:4:\"page\";}s:11:\"autodisplay\";s:3:\"top\";s:9:\"alignment\";s:0:\"\";s:10:\"directions\";s:6:\"google\";s:7:\"poiZoom\";s:2:\"15\";s:15:\"initialOpenInfo\";b:0;s:8:\"language\";s:0:\"\";s:7:\"country\";s:0:\"\";s:16:\"directionsServer\";s:23:\"https://maps.google.com\";s:5:\"sizes\";a:3:{i:0;a:2:{s:5:\"width\";i:300;s:6:\"height\";i:300;}i:1;a:2:{s:5:\"width\";i:425;s:6:\"height\";i:350;}i:2;a:2:{s:5:\"width\";i:640;s:6:\"height\";i:480;}}s:4:\"size\";s:1:\"1\";s:6:\"footer\";b:1;s:12:\"apiKeyServer\";s:0:\"\";}', 'yes'),
(216, 'mappress_version', '2.47.5', 'yes'),
(217, 'acf_version', '4.4.12', 'yes'),
(218, 'code_snippets_settings', 'a:3:{s:7:\"general\";a:5:{s:19:\"activate_by_default\";b:0;s:21:\"snippet_scope_enabled\";b:1;s:11:\"enable_tags\";b:1;s:18:\"enable_description\";b:1;s:13:\"disable_prism\";b:0;}s:18:\"description_editor\";a:3:{s:4:\"rows\";i:5;s:12:\"use_full_mce\";b:0;s:13:\"media_buttons\";b:0;}s:6:\"editor\";a:8:{s:5:\"theme\";s:7:\"default\";s:16:\"indent_with_tabs\";b:1;s:8:\"tab_size\";i:4;s:11:\"indent_unit\";i:2;s:10:\"wrap_lines\";b:1;s:12:\"line_numbers\";b:1;s:19:\"auto_close_brackets\";b:1;s:27:\"highlight_selection_matches\";b:1;}}', 'yes'),
(219, 'duplicate_post_copytitle', '1', 'yes'),
(220, 'duplicate_post_copydate', '0', 'yes'),
(221, 'duplicate_post_copystatus', '0', 'yes'),
(222, 'duplicate_post_copyslug', '1', 'yes'),
(223, 'duplicate_post_copyexcerpt', '1', 'yes'),
(224, 'duplicate_post_copycontent', '1', 'yes'),
(225, 'duplicate_post_copythumbnail', '1', 'yes'),
(226, 'duplicate_post_copytemplate', '1', 'yes'),
(227, 'duplicate_post_copyformat', '1', 'yes'),
(228, 'duplicate_post_copyauthor', '0', 'yes'),
(229, 'duplicate_post_copypassword', '0', 'yes'),
(230, 'duplicate_post_copyattachments', '0', 'yes'),
(231, 'duplicate_post_copychildren', '0', 'yes'),
(232, 'duplicate_post_copycomments', '0', 'yes'),
(233, 'duplicate_post_copymenuorder', '1', 'yes'),
(234, 'duplicate_post_taxonomies_blacklist', 'a:0:{}', 'yes'),
(235, 'duplicate_post_blacklist', '', 'yes'),
(236, 'duplicate_post_types_enabled', 'a:2:{i:0;s:4:\"post\";i:1;s:4:\"page\";}', 'yes'),
(237, 'duplicate_post_show_row', '1', 'yes'),
(238, 'duplicate_post_show_adminbar', '1', 'yes'),
(239, 'duplicate_post_show_submitbox', '1', 'yes'),
(240, 'duplicate_post_show_bulkactions', '1', 'yes'),
(241, 'duplicate_post_version', '3.2.1', 'yes'),
(242, 'duplicate_post_show_notice', '0', 'no'),
(243, 'msp_general_setting', '', 'yes'),
(244, 'msp_advanced', '', 'yes'),
(245, 'upgrade_to_pro', '', 'yes'),
(246, 'masterslider_lite_plugin_version', '3.4.1', 'yes'),
(247, '_image_widget_version_plugin', '4.4.7', 'no'),
(248, 'css_js_files_css_files', '1', 'yes'),
(249, 'css_js_files_css_rules', '', 'yes'),
(250, 'css_js_files_js_files', '1', 'yes'),
(251, 'css_js_files_js_rules', '', 'yes'),
(252, 'css_js_files_path', 'themes/pt1trans', 'yes'),
(253, 'fs_active_plugins', 'O:8:\"stdClass\":2:{s:7:\"plugins\";a:1:{s:25:\"widgets-on-pages/freemius\";O:8:\"stdClass\":3:{s:7:\"version\";s:9:\"1.2.1.6.1\";s:9:\"timestamp\";i:1521473874;s:11:\"plugin_path\";s:37:\"widgets-on-pages/widgets_on_pages.php\";}}s:6:\"newest\";O:8:\"stdClass\":5:{s:11:\"plugin_path\";s:37:\"widgets-on-pages/widgets_on_pages.php\";s:8:\"sdk_path\";s:25:\"widgets-on-pages/freemius\";s:7:\"version\";s:9:\"1.2.1.6.1\";s:13:\"in_activation\";b:0;s:9:\"timestamp\";i:1521473874;}}', 'yes'),
(254, 'fs_debug_mode', '', 'yes'),
(255, 'fs_accounts', 'a:5:{s:11:\"plugin_data\";a:1:{s:16:\"widgets-on-pages\";a:15:{s:16:\"plugin_main_file\";O:8:\"stdClass\":1:{s:4:\"path\";s:93:\"C:/xampp/htdocs/richmondmediahosting/wp-content/plugins/widgets-on-pages/widgets_on_pages.php\";}s:17:\"install_timestamp\";i:1521473874;s:16:\"sdk_last_version\";N;s:11:\"sdk_version\";s:9:\"1.2.1.6.1\";s:16:\"sdk_upgrade_mode\";b:1;s:18:\"sdk_downgrade_mode\";b:0;s:19:\"plugin_last_version\";N;s:14:\"plugin_version\";s:5:\"1.4.0\";s:19:\"plugin_upgrade_mode\";b:1;s:21:\"plugin_downgrade_mode\";b:0;s:21:\"is_plugin_new_install\";b:1;s:17:\"connectivity_test\";a:6:{s:12:\"is_connected\";b:1;s:4:\"host\";s:9:\"localhost\";s:9:\"server_ip\";s:3:\"::1\";s:9:\"is_active\";b:1;s:9:\"timestamp\";i:1521473874;s:7:\"version\";s:5:\"1.4.0\";}s:17:\"was_plugin_loaded\";b:1;s:15:\"prev_is_premium\";b:0;s:21:\"is_pending_activation\";b:1;}}s:13:\"file_slug_map\";a:1:{s:37:\"widgets-on-pages/widgets_on_pages.php\";s:16:\"widgets-on-pages\";}s:7:\"plugins\";a:1:{s:16:\"widgets-on-pages\";O:9:\"FS_Plugin\":16:{s:16:\"parent_plugin_id\";N;s:5:\"title\";s:16:\"Widgets On Pages\";s:4:\"slug\";s:16:\"widgets-on-pages\";s:4:\"type\";N;s:4:\"file\";s:37:\"widgets-on-pages/widgets_on_pages.php\";s:7:\"version\";s:5:\"1.4.0\";s:11:\"auto_update\";N;s:4:\"info\";N;s:10:\"is_premium\";b:0;s:7:\"is_live\";b:1;s:10:\"public_key\";s:32:\"pk_cc686be98cc9dc884d69bfce70cfc\";s:10:\"secret_key\";N;s:2:\"id\";s:4:\"1049\";s:7:\"updated\";N;s:7:\"created\";N;s:22:\"\0FS_Entity\0_is_updated\";b:0;}}s:9:\"unique_id\";s:32:\"f758089d2ad3faf5697980020996cfb6\";s:13:\"admin_notices\";a:1:{s:16:\"widgets-on-pages\";a:0:{}}}', 'yes'),
(256, 'fs_api_cache', 'a:0:{}', 'yes'),
(258, 'woo_discount_rules_updated_time', '0', 'yes'),
(259, 'woo_discount_rules_verified_key', '0', 'yes'),
(260, 'woo_discount_rules_num_runs', '0', 'yes'),
(261, 'woo-discount-rules-force-update-pro', '', 'yes'),
(264, 'woocommerce_store_address', 'Mirpur 10', 'yes'),
(265, 'woocommerce_store_address_2', '', 'yes'),
(266, 'woocommerce_store_city', 'Dhaka', 'yes'),
(267, 'woocommerce_default_country', 'BD:DHA', 'yes'),
(268, 'woocommerce_store_postcode', '1206', 'yes'),
(269, 'woocommerce_allowed_countries', 'all', 'yes'),
(270, 'woocommerce_all_except_countries', '', 'yes'),
(271, 'woocommerce_specific_allowed_countries', '', 'yes'),
(272, 'woocommerce_ship_to_countries', '', 'yes'),
(273, 'woocommerce_specific_ship_to_countries', '', 'yes'),
(274, 'woocommerce_default_customer_address', 'geolocation', 'yes'),
(275, 'woocommerce_calc_taxes', 'no', 'yes'),
(276, 'woocommerce_demo_store', 'no', 'yes'),
(277, 'woocommerce_demo_store_notice', 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'no'),
(278, 'woocommerce_currency', 'BDT', 'yes'),
(279, 'woocommerce_currency_pos', 'left', 'yes'),
(280, 'woocommerce_price_thousand_sep', ',', 'yes'),
(281, 'woocommerce_price_decimal_sep', '.', 'yes'),
(282, 'woocommerce_price_num_decimals', '2', 'yes'),
(283, 'woocommerce_weight_unit', 'kg', 'yes'),
(284, 'woocommerce_dimension_unit', 'in', 'yes'),
(285, 'woocommerce_enable_reviews', 'yes', 'yes'),
(286, 'woocommerce_review_rating_verification_label', 'yes', 'no'),
(287, 'woocommerce_review_rating_verification_required', 'no', 'no'),
(288, 'woocommerce_enable_review_rating', 'yes', 'yes'),
(289, 'woocommerce_review_rating_required', 'yes', 'no'),
(290, 'woocommerce_shop_page_id', '8', 'yes'),
(291, 'woocommerce_shop_page_display', '', 'yes'),
(292, 'woocommerce_category_archive_display', '', 'yes'),
(293, 'woocommerce_default_catalog_orderby', 'menu_order', 'yes'),
(294, 'woocommerce_cart_redirect_after_add', 'no', 'yes'),
(295, 'woocommerce_enable_ajax_add_to_cart', 'yes', 'yes'),
(296, 'shop_catalog_image_size', 'a:3:{s:5:\"width\";s:3:\"300\";s:6:\"height\";s:3:\"300\";s:4:\"crop\";i:1;}', 'yes'),
(297, 'shop_single_image_size', 'a:3:{s:5:\"width\";s:3:\"600\";s:6:\"height\";s:3:\"600\";s:4:\"crop\";i:1;}', 'yes'),
(298, 'shop_thumbnail_image_size', 'a:3:{s:5:\"width\";s:3:\"180\";s:6:\"height\";s:3:\"180\";s:4:\"crop\";i:1;}', 'yes'),
(299, 'woocommerce_manage_stock', 'yes', 'yes'),
(300, 'woocommerce_hold_stock_minutes', '60', 'no'),
(301, 'woocommerce_notify_low_stock', 'yes', 'no'),
(302, 'woocommerce_notify_no_stock', 'yes', 'no'),
(303, 'woocommerce_stock_email_recipient', 'info@wordpress.com', 'no'),
(304, 'woocommerce_notify_low_stock_amount', '2', 'no'),
(305, 'woocommerce_notify_no_stock_amount', '0', 'yes'),
(306, 'woocommerce_hide_out_of_stock_items', 'no', 'yes'),
(307, 'woocommerce_stock_format', '', 'yes'),
(308, 'woocommerce_file_download_method', 'force', 'no'),
(309, 'woocommerce_downloads_require_login', 'no', 'no'),
(310, 'woocommerce_downloads_grant_access_after_payment', 'yes', 'no'),
(311, 'woocommerce_prices_include_tax', 'no', 'yes'),
(312, 'woocommerce_tax_based_on', 'shipping', 'yes'),
(313, 'woocommerce_shipping_tax_class', 'inherit', 'yes'),
(314, 'woocommerce_tax_round_at_subtotal', 'no', 'yes'),
(315, 'woocommerce_tax_classes', 'Reduced rate\r\nZero rate', 'yes'),
(316, 'woocommerce_tax_display_shop', 'excl', 'yes'),
(317, 'woocommerce_tax_display_cart', 'excl', 'no'),
(318, 'woocommerce_price_display_suffix', '', 'yes'),
(319, 'woocommerce_tax_total_display', 'itemized', 'no'),
(320, 'woocommerce_enable_shipping_calc', 'yes', 'no'),
(321, 'woocommerce_shipping_cost_requires_address', 'no', 'no'),
(322, 'woocommerce_ship_to_destination', 'billing', 'no'),
(323, 'woocommerce_shipping_debug_mode', 'no', 'no'),
(324, 'woocommerce_enable_coupons', 'yes', 'yes'),
(325, 'woocommerce_calc_discounts_sequentially', 'no', 'no'),
(326, 'woocommerce_enable_guest_checkout', 'yes', 'no'),
(327, 'woocommerce_force_ssl_checkout', 'no', 'yes'),
(328, 'woocommerce_unforce_ssl_checkout', 'no', 'yes'),
(329, 'woocommerce_cart_page_id', '9', 'yes'),
(330, 'woocommerce_checkout_page_id', '10', 'yes'),
(331, 'woocommerce_terms_page_id', '', 'no'),
(332, 'woocommerce_checkout_pay_endpoint', 'order-pay', 'yes'),
(333, 'woocommerce_checkout_order_received_endpoint', 'order-received', 'yes'),
(334, 'woocommerce_myaccount_add_payment_method_endpoint', 'add-payment-method', 'yes'),
(335, 'woocommerce_myaccount_delete_payment_method_endpoint', 'delete-payment-method', 'yes'),
(336, 'woocommerce_myaccount_set_default_payment_method_endpoint', 'set-default-payment-method', 'yes'),
(337, 'woocommerce_myaccount_page_id', '11', 'yes'),
(338, 'woocommerce_enable_signup_and_login_from_checkout', 'yes', 'no'),
(339, 'woocommerce_enable_myaccount_registration', 'no', 'no'),
(340, 'woocommerce_enable_checkout_login_reminder', 'yes', 'no'),
(341, 'woocommerce_registration_generate_username', 'yes', 'no'),
(342, 'woocommerce_registration_generate_password', 'no', 'no'),
(343, 'woocommerce_myaccount_orders_endpoint', 'orders', 'yes'),
(344, 'woocommerce_myaccount_view_order_endpoint', 'view-order', 'yes'),
(345, 'woocommerce_myaccount_downloads_endpoint', 'downloads', 'yes'),
(346, 'woocommerce_myaccount_edit_account_endpoint', 'edit-account', 'yes'),
(347, 'woocommerce_myaccount_edit_address_endpoint', 'edit-address', 'yes'),
(348, 'woocommerce_myaccount_payment_methods_endpoint', 'payment-methods', 'yes'),
(349, 'woocommerce_myaccount_lost_password_endpoint', 'lost-password', 'yes'),
(350, 'woocommerce_logout_endpoint', 'customer-logout', 'yes'),
(351, 'woocommerce_email_from_name', 'richmondmediahosting', 'no'),
(352, 'woocommerce_email_from_address', 'info@wordpress.com', 'no'),
(353, 'woocommerce_email_header_image', '', 'no'),
(354, 'woocommerce_email_footer_text', 'richmondmediahosting', 'no'),
(355, 'woocommerce_email_base_color', '#96588a', 'no'),
(356, 'woocommerce_email_background_color', '#f7f7f7', 'no'),
(357, 'woocommerce_email_body_background_color', '#ffffff', 'no'),
(358, 'woocommerce_email_text_color', '#3c3c3c', 'no'),
(359, 'woocommerce_api_enabled', 'yes', 'yes'),
(360, '_transient_wc_attribute_taxonomies', 'a:0:{}', 'yes'),
(363, 'woocommerce_version', '3.2.6', 'yes'),
(364, 'woocommerce_db_version', '3.2.6', 'yes'),
(365, 'woocommerce_admin_notices', 'a:0:{}', 'yes'),
(366, 'wop_plugin_version', '1.4.0', 'yes'),
(367, '_transient_woocommerce_webhook_ids', 'a:0:{}', 'yes'),
(368, 'widget_page_in_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(369, 'widget_woocommerce_widget_cart', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(370, 'widget_woocommerce_layered_nav_filters', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(371, 'widget_woocommerce_layered_nav', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(372, 'widget_woocommerce_price_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(373, 'widget_woocommerce_product_categories', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(374, 'widget_woocommerce_product_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(375, 'widget_woocommerce_product_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(376, 'widget_woocommerce_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(377, 'widget_woocommerce_recently_viewed_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(378, 'widget_woocommerce_top_rated_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(379, 'widget_woocommerce_recent_reviews', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(380, 'widget_woocommerce_rating_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(381, 'widget_wptcwcminicart_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(383, 'external_updates-woo-discount-rules', 'O:8:\"stdClass\":5:{s:9:\"lastCheck\";i:1522258001;s:14:\"checkedVersion\";s:6:\"1.4.39\";s:6:\"update\";O:8:\"stdClass\":9:{s:4:\"slug\";s:18:\"woo-discount-rules\";s:7:\"version\";s:5:\"1.5.6\";s:12:\"download_url\";s:67:\"https://downloads.wordpress.org/plugin/woo-discount-rules.1.5.6.zip\";s:12:\"translations\";a:0:{}s:2:\"id\";i:0;s:8:\"homepage\";s:19:\"http://flycart.org/\";s:6:\"tested\";s:3:\"4.9\";s:14:\"upgrade_notice\";s:54:\"You have a latest update of Woo Discount Rules plugin \";s:8:\"filename\";s:41:\"woo-discount-rules/woo-discount-rules.php\";}s:11:\"updateClass\";s:20:\"Puc_v4_Plugin_Update\";s:15:\"updateBaseClass\";s:13:\"Plugin_Update\";}', 'no'),
(384, '_transient_wc_count_comments', 'O:8:\"stdClass\":7:{s:8:\"approved\";s:1:\"1\";s:14:\"total_comments\";i:1;s:3:\"all\";i:1;s:9:\"moderated\";i:0;s:4:\"spam\";i:0;s:5:\"trash\";i:0;s:12:\"post-trashed\";i:0;}', 'yes'),
(385, 'woocommerce_meta_box_errors', 'a:0:{}', 'yes'),
(386, 'wpmenucart', 'a:12:{s:10:\"menu_slugs\";a:1:{i:1;s:1:\"0\";}s:14:\"always_display\";s:0:\"\";s:12:\"icon_display\";s:1:\"1\";s:13:\"items_display\";s:1:\"3\";s:15:\"items_alignment\";s:8:\"standard\";s:12:\"custom_class\";s:0:\"\";s:14:\"flyout_display\";s:0:\"\";s:17:\"flyout_itemnumber\";s:1:\"5\";s:9:\"cart_icon\";s:1:\"0\";s:11:\"shop_plugin\";s:11:\"woocommerce\";s:12:\"builtin_ajax\";s:0:\"\";s:15:\"hide_theme_cart\";s:1:\"1\";}', 'yes'),
(387, 'woocommerce_product_type', 'both', 'yes'),
(388, 'woocommerce_allow_tracking', 'no', 'yes'),
(389, 'woocommerce_ppec_paypal_settings', 'a:1:{s:7:\"enabled\";s:2:\"no\";}', 'yes'),
(390, 'woocommerce_paypal_settings', 'a:2:{s:7:\"enabled\";s:2:\"no\";s:5:\"email\";b:0;}', 'yes'),
(391, '_transient_shipping-transient-version', '1521474373', 'yes'),
(392, 'woocommerce_flat_rate_1_settings', 'a:3:{s:5:\"title\";s:9:\"Flat rate\";s:10:\"tax_status\";s:7:\"taxable\";s:4:\"cost\";s:2:\"10\";}', 'yes'),
(393, 'woocommerce_flat_rate_2_settings', 'a:3:{s:5:\"title\";s:9:\"Flat rate\";s:10:\"tax_status\";s:7:\"taxable\";s:4:\"cost\";s:1:\"5\";}', 'yes'),
(408, '_transient_product_query-transient-version', '1521995910', 'yes'),
(417, '_site_transient_timeout_browser_f486628b8b3cd381d361bdc25237d08d', '1522575346', 'no'),
(418, '_site_transient_browser_f486628b8b3cd381d361bdc25237d08d', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"65.0.3325.181\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(442, '_transient_timeout_wc_shipping_method_count_1_1521474373', '1524585289', 'no'),
(443, '_transient_wc_shipping_method_count_1_1521474373', '2', 'no'),
(444, '_transient_product-transient-version', '1521995911', 'yes'),
(445, 'woocommerce_permalinks', 'a:4:{s:13:\"category_base\";s:0:\"\";s:8:\"tag_base\";s:0:\"\";s:14:\"attribute_base\";s:0:\"\";s:12:\"product_base\";s:0:\"\";}', 'yes'),
(466, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}', 'yes'),
(489, '_transient_timeout_external_ip_address_::1', '1522779090', 'no'),
(490, '_transient_external_ip_address_::1', '103.205.134.116', 'no'),
(502, '_transient_timeout_wc_report_sales_by_date', '1522346157', 'no'),
(503, '_transient_wc_report_sales_by_date', 'a:48:{s:32:\"f2ef30c633d6b08a46860ba398825d1e\";a:0:{}s:32:\"fe554c54d807f0e3f1b1c9c335add44f\";a:0:{}s:32:\"5f8f8bbe64074c716beec24f465e1bd4\";a:0:{}s:32:\"610ee9ce16431586d0047afc739e8d2a\";N;s:32:\"d32d21ce825f903c511de6fbf582aa38\";a:0:{}s:32:\"63bf1fc76d89ffe268fc363615604283\";a:0:{}s:32:\"753704ea53984ee991be2212c1a66875\";a:0:{}s:32:\"873960e1d0e6f175c4fa9fae6d240873\";a:0:{}s:32:\"e15990c0a2c2d79e0d40e872ed95bf22\";a:0:{}s:32:\"2353076d39d9e97ef0a229866db96ea2\";a:0:{}s:32:\"812a32b34451640f4ddc375ae6d61009\";a:0:{}s:32:\"58e7e7dde52ccbcb2c447f075d8fdffa\";N;s:32:\"0a8ae2c61bbee5d10365d1d0829ee229\";a:0:{}s:32:\"5b113cf87854c906ff2dcc497db53de7\";a:0:{}s:32:\"6e5644c9306fee3de12788e12fb11043\";a:0:{}s:32:\"8204139fc3f17135cfc585ea8c06b9e2\";a:0:{}s:32:\"e912fd58fa5fd774979ff24f33575b1b\";a:0:{}s:32:\"72b4f8b1982829020e28bd67a072ee76\";a:0:{}s:32:\"80c9635f783718613315eae91a86955b\";a:0:{}s:32:\"65ba4756131f3ea983453a98298ad2cd\";N;s:32:\"624f4da0293a403e76ce8ce7f02a3d13\";a:0:{}s:32:\"22567f865e7d7410bc4991981b5ba607\";a:0:{}s:32:\"ce87fd352c1d06ee91dc1aa6d9840fc1\";a:0:{}s:32:\"3651eb70041f66ce396afad67cef67fc\";a:0:{}s:32:\"70a13e1c62456ed8881476a3b237774b\";a:0:{}s:32:\"899de19eae5cff14e3e94e611adc4cdf\";a:0:{}s:32:\"d8a42084d7199c9291395fe61a4694fc\";a:0:{}s:32:\"819c54db533864a5c3fe2d5b44e90f0c\";N;s:32:\"2857fe2142bbfa42389ca6f3b884cc7a\";a:0:{}s:32:\"1ee8a50bdbb7ba76a08351b6dbd6dcc9\";a:0:{}s:32:\"5967296d05e71f2b6abe2683ac85fd4d\";a:0:{}s:32:\"5014e2b384b95735b90a952ad6350fb1\";a:0:{}s:32:\"d58e53d6059537e17c6e533e74c96472\";a:0:{}s:32:\"f51f30220d92564cd6e435f0720d5517\";a:0:{}s:32:\"5ca35c5e704cf2cf97462afe9b03301d\";a:0:{}s:32:\"03bb023bb907a3b5f3819ebf4be53e1a\";N;s:32:\"35a44dddab7f136f54b97fe8d730f882\";a:0:{}s:32:\"fbf7abc63fc9d3aebbefedb8ff525073\";a:0:{}s:32:\"44236bec36b755fce9987b00f45373a1\";a:0:{}s:32:\"cf02b1375ea7079665d304f2a251a2a4\";a:0:{}s:32:\"4ef180bed324096250315fbabc7380ea\";a:0:{}s:32:\"72f5fbf604d6e7e6c437360b17000bf9\";a:0:{}s:32:\"82186774c9aad8ac91f0498f56923666\";a:0:{}s:32:\"d871459225157246fce797340d7565d2\";N;s:32:\"caa4b4484256a9a32d03d8aa69da0150\";a:0:{}s:32:\"7892cecb913da5c674d40f2b9af96f63\";a:0:{}s:32:\"2d3b2ef3718c5f85f412d1e01300107f\";a:0:{}s:32:\"d7c106e887bbe6d36bc7f96622572761\";a:0:{}}', 'no'),
(504, '_transient_timeout_wc_admin_report', '1522261694', 'no'),
(505, '_transient_wc_admin_report', 'a:1:{s:32:\"d927111096590ee47a5bd9e60d96f659\";a:0:{}}', 'no'),
(506, '_transient_timeout_wc_low_stock_count', '1524767294', 'no'),
(507, '_transient_wc_low_stock_count', '0', 'no'),
(508, '_transient_timeout_wc_outofstock_count', '1524767294', 'no'),
(509, '_transient_wc_outofstock_count', '0', 'no'),
(515, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.9.4.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.9.4.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.9.4-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.9.4-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.9.4\";s:7:\"version\";s:5:\"4.9.4\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1522257989;s:15:\"version_checked\";s:5:\"4.9.4\";s:12:\"translations\";a:0:{}}', 'no'),
(521, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1522257994;s:7:\"checked\";a:2:{s:3:\"pt1\";s:0:\"\";s:8:\"pt1trans\";s:0:\"\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(522, '_transient_timeout_plugin_slugs', '1522266557', 'no'),
(523, '_transient_plugin_slugs', 'a:24:{i:0;s:30:\"advanced-custom-fields/acf.php\";i:1;s:31:\"code-snippets/code-snippets.php\";i:2;s:33:\"duplicate-post/duplicate-post.php\";i:3;s:28:\"embedit-pro/embed-it-pro.php\";i:4;s:25:\"formidable/formidable.php\";i:5;s:29:\"image-widget/image-widget.php\";i:6;s:67:\"import-users-from-csv-with-meta/import-users-from-csv-with-meta.php\";i:7;s:35:\"jquery-colorbox/jquery-colorbox.php\";i:8;s:47:\"mappress-google-maps-for-wordpress/mappress.php\";i:9;s:31:\"master-slider/master-slider.php\";i:10;s:61:\"no-right-click-images-plugin/no-right-click-images-plugin.php\";i:11;s:33:\"page-in-widget/page-in-widget.php\";i:12;s:53:\"page-management-dropdown/page-management-dropdown.php\";i:13;s:30:\"development/qt-development.php\";i:14;s:28:\"essentials/qt-essentials.php\";i:15;s:16:\"misc/qt-misc.php\";i:16;s:24:\"security/qt-security.php\";i:17;s:18:\"speed/qt-speed.php\";i:18;s:16:\"wooc/qt-wooc.php\";i:19;s:37:\"widgets-on-pages/widgets_on_pages.php\";i:20;s:27:\"woocommerce/woocommerce.php\";i:21;s:89:\"pricing-discounts-by-user-role-woocommerce/pricing-discounts-by-user-role-woocommerce.php\";i:22;s:42:\"woocommerce-menu-bar-cart/wp-menu-cart.php\";i:23;s:41:\"woo-discount-rules/woo-discount-rules.php\";}', 'no'),
(524, '_transient_timeout_wc_upgrade_notice_3.3.4', '1522266461', 'no'),
(525, '_transient_wc_upgrade_notice_3.3.4', '', 'no'),
(538, '_site_transient_timeout_theme_roots', '1522259793', 'no'),
(539, '_site_transient_theme_roots', 'a:2:{s:3:\"pt1\";s:7:\"/themes\";s:8:\"pt1trans\";s:7:\"/themes\";}', 'no'),
(540, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1522257998;s:7:\"checked\";a:24:{s:30:\"advanced-custom-fields/acf.php\";s:6:\"4.4.12\";s:31:\"code-snippets/code-snippets.php\";s:5:\"2.9.4\";s:33:\"duplicate-post/duplicate-post.php\";s:5:\"3.2.1\";s:28:\"embedit-pro/embed-it-pro.php\";s:4:\"1.11\";s:25:\"formidable/formidable.php\";s:7:\"2.05.08\";s:29:\"image-widget/image-widget.php\";s:5:\"4.4.7\";s:67:\"import-users-from-csv-with-meta/import-users-from-csv-with-meta.php\";s:6:\"1.10.9\";s:35:\"jquery-colorbox/jquery-colorbox.php\";s:5:\"4.6.2\";s:47:\"mappress-google-maps-for-wordpress/mappress.php\";s:6:\"2.47.5\";s:31:\"master-slider/master-slider.php\";s:5:\"3.4.1\";s:61:\"no-right-click-images-plugin/no-right-click-images-plugin.php\";s:3:\"2.5\";s:33:\"page-in-widget/page-in-widget.php\";s:3:\"1.3\";s:53:\"page-management-dropdown/page-management-dropdown.php\";s:3:\"2.7\";s:30:\"development/qt-development.php\";s:3:\"1.0\";s:28:\"essentials/qt-essentials.php\";s:3:\"1.0\";s:16:\"misc/qt-misc.php\";s:3:\"1.0\";s:24:\"security/qt-security.php\";s:3:\"1.0\";s:18:\"speed/qt-speed.php\";s:3:\"1.0\";s:16:\"wooc/qt-wooc.php\";s:3:\"1.0\";s:37:\"widgets-on-pages/widgets_on_pages.php\";s:5:\"1.4.0\";s:27:\"woocommerce/woocommerce.php\";s:5:\"3.2.6\";s:89:\"pricing-discounts-by-user-role-woocommerce/pricing-discounts-by-user-role-woocommerce.php\";s:5:\"2.3.1\";s:42:\"woocommerce-menu-bar-cart/wp-menu-cart.php\";s:5:\"2.6.1\";s:41:\"woo-discount-rules/woo-discount-rules.php\";s:6:\"1.4.39\";}s:8:\"response\";a:6:{s:31:\"code-snippets/code-snippets.php\";O:8:\"stdClass\":11:{s:2:\"id\";s:27:\"w.org/plugins/code-snippets\";s:4:\"slug\";s:13:\"code-snippets\";s:6:\"plugin\";s:31:\"code-snippets/code-snippets.php\";s:11:\"new_version\";s:8:\"2.10.1.1\";s:3:\"url\";s:44:\"https://wordpress.org/plugins/code-snippets/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/code-snippets.zip\";s:5:\"icons\";a:2:{s:3:\"svg\";s:57:\"https://ps.w.org/code-snippets/assets/icon.svg?rev=986370\";s:7:\"default\";s:57:\"https://ps.w.org/code-snippets/assets/icon.svg?rev=986370\";}s:7:\"banners\";a:2:{s:2:\"1x\";s:68:\"https://ps.w.org/code-snippets/assets/banner-772x250.png?rev=1490174\";s:7:\"default\";s:68:\"https://ps.w.org/code-snippets/assets/banner-772x250.png?rev=1490174\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.4\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:25:\"formidable/formidable.php\";O:8:\"stdClass\":11:{s:2:\"id\";s:24:\"w.org/plugins/formidable\";s:4:\"slug\";s:10:\"formidable\";s:6:\"plugin\";s:25:\"formidable/formidable.php\";s:11:\"new_version\";s:4:\"3.01\";s:3:\"url\";s:41:\"https://wordpress.org/plugins/formidable/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/formidable.3.01.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:63:\"https://ps.w.org/formidable/assets/icon-128x128.png?rev=1109774\";s:2:\"2x\";s:63:\"https://ps.w.org/formidable/assets/icon-256x256.png?rev=1109774\";s:7:\"default\";s:63:\"https://ps.w.org/formidable/assets/icon-256x256.png?rev=1109774\";}s:7:\"banners\";a:3:{s:2:\"2x\";s:66:\"https://ps.w.org/formidable/assets/banner-1544x500.png?rev=1109774\";s:2:\"1x\";s:65:\"https://ps.w.org/formidable/assets/banner-772x250.png?rev=1109774\";s:7:\"default\";s:66:\"https://ps.w.org/formidable/assets/banner-1544x500.png?rev=1109774\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.4\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:67:\"import-users-from-csv-with-meta/import-users-from-csv-with-meta.php\";O:8:\"stdClass\":11:{s:2:\"id\";s:45:\"w.org/plugins/import-users-from-csv-with-meta\";s:4:\"slug\";s:31:\"import-users-from-csv-with-meta\";s:6:\"plugin\";s:67:\"import-users-from-csv-with-meta/import-users-from-csv-with-meta.php\";s:11:\"new_version\";s:8:\"1.11.3.1\";s:3:\"url\";s:62:\"https://wordpress.org/plugins/import-users-from-csv-with-meta/\";s:7:\"package\";s:83:\"https://downloads.wordpress.org/plugin/import-users-from-csv-with-meta.1.11.3.1.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:84:\"https://ps.w.org/import-users-from-csv-with-meta/assets/icon-128x128.png?rev=1174343\";s:2:\"2x\";s:84:\"https://ps.w.org/import-users-from-csv-with-meta/assets/icon-256x256.png?rev=1174343\";s:7:\"default\";s:84:\"https://ps.w.org/import-users-from-csv-with-meta/assets/icon-256x256.png?rev=1174343\";}s:7:\"banners\";a:2:{s:2:\"1x\";s:86:\"https://ps.w.org/import-users-from-csv-with-meta/assets/banner-772x250.png?rev=1307543\";s:7:\"default\";s:86:\"https://ps.w.org/import-users-from-csv-with-meta/assets/banner-772x250.png?rev=1307543\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.4\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:47:\"mappress-google-maps-for-wordpress/mappress.php\";O:8:\"stdClass\":11:{s:2:\"id\";s:48:\"w.org/plugins/mappress-google-maps-for-wordpress\";s:4:\"slug\";s:34:\"mappress-google-maps-for-wordpress\";s:6:\"plugin\";s:47:\"mappress-google-maps-for-wordpress/mappress.php\";s:11:\"new_version\";s:6:\"2.48.4\";s:3:\"url\";s:65:\"https://wordpress.org/plugins/mappress-google-maps-for-wordpress/\";s:7:\"package\";s:84:\"https://downloads.wordpress.org/plugin/mappress-google-maps-for-wordpress.2.48.4.zip\";s:5:\"icons\";a:0:{}s:7:\"banners\";a:0:{}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.4\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:27:\"woocommerce/woocommerce.php\";O:8:\"stdClass\":11:{s:2:\"id\";s:25:\"w.org/plugins/woocommerce\";s:4:\"slug\";s:11:\"woocommerce\";s:6:\"plugin\";s:27:\"woocommerce/woocommerce.php\";s:11:\"new_version\";s:5:\"3.3.4\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/woocommerce/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/woocommerce.3.3.4.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:64:\"https://ps.w.org/woocommerce/assets/icon-128x128.png?rev=1440831\";s:2:\"2x\";s:64:\"https://ps.w.org/woocommerce/assets/icon-256x256.png?rev=1440831\";s:7:\"default\";s:64:\"https://ps.w.org/woocommerce/assets/icon-256x256.png?rev=1440831\";}s:7:\"banners\";a:3:{s:2:\"2x\";s:67:\"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=1629184\";s:2:\"1x\";s:66:\"https://ps.w.org/woocommerce/assets/banner-772x250.png?rev=1629184\";s:7:\"default\";s:67:\"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=1629184\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.4\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:41:\"woo-discount-rules/woo-discount-rules.php\";O:8:\"stdClass\":11:{s:2:\"id\";s:32:\"w.org/plugins/woo-discount-rules\";s:4:\"slug\";s:18:\"woo-discount-rules\";s:6:\"plugin\";s:41:\"woo-discount-rules/woo-discount-rules.php\";s:11:\"new_version\";s:5:\"1.5.6\";s:3:\"url\";s:49:\"https://wordpress.org/plugins/woo-discount-rules/\";s:7:\"package\";s:67:\"https://downloads.wordpress.org/plugin/woo-discount-rules.1.5.6.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:71:\"https://ps.w.org/woo-discount-rules/assets/icon-128x128.png?rev=1553402\";s:2:\"2x\";s:71:\"https://ps.w.org/woo-discount-rules/assets/icon-256x256.png?rev=1553402\";s:7:\"default\";s:71:\"https://ps.w.org/woo-discount-rules/assets/icon-256x256.png?rev=1553402\";}s:7:\"banners\";a:3:{s:2:\"2x\";s:74:\"https://ps.w.org/woo-discount-rules/assets/banner-1544x500.png?rev=1553351\";s:2:\"1x\";s:73:\"https://ps.w.org/woo-discount-rules/assets/banner-772x250.png?rev=1553351\";s:7:\"default\";s:74:\"https://ps.w.org/woo-discount-rules/assets/banner-1544x500.png?rev=1553351\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.4\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:11:{s:30:\"advanced-custom-fields/acf.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:36:\"w.org/plugins/advanced-custom-fields\";s:4:\"slug\";s:22:\"advanced-custom-fields\";s:6:\"plugin\";s:30:\"advanced-custom-fields/acf.php\";s:11:\"new_version\";s:6:\"4.4.12\";s:3:\"url\";s:53:\"https://wordpress.org/plugins/advanced-custom-fields/\";s:7:\"package\";s:72:\"https://downloads.wordpress.org/plugin/advanced-custom-fields.4.4.12.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-128x128.png?rev=1082746\";s:2:\"2x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png?rev=1082746\";s:7:\"default\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png?rev=1082746\";}s:7:\"banners\";a:3:{s:2:\"2x\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=1729099\";s:2:\"1x\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=1729102\";s:7:\"default\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=1729099\";}s:11:\"banners_rtl\";a:0:{}}s:33:\"duplicate-post/duplicate-post.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:28:\"w.org/plugins/duplicate-post\";s:4:\"slug\";s:14:\"duplicate-post\";s:6:\"plugin\";s:33:\"duplicate-post/duplicate-post.php\";s:11:\"new_version\";s:5:\"3.2.1\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/duplicate-post/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/duplicate-post.3.2.1.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:67:\"https://ps.w.org/duplicate-post/assets/icon-128x128.png?rev=1612753\";s:2:\"2x\";s:67:\"https://ps.w.org/duplicate-post/assets/icon-256x256.png?rev=1612753\";s:7:\"default\";s:67:\"https://ps.w.org/duplicate-post/assets/icon-256x256.png?rev=1612753\";}s:7:\"banners\";a:2:{s:2:\"1x\";s:69:\"https://ps.w.org/duplicate-post/assets/banner-772x250.png?rev=1612986\";s:7:\"default\";s:69:\"https://ps.w.org/duplicate-post/assets/banner-772x250.png?rev=1612986\";}s:11:\"banners_rtl\";a:0:{}}s:28:\"embedit-pro/embed-it-pro.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/embedit-pro\";s:4:\"slug\";s:11:\"embedit-pro\";s:6:\"plugin\";s:28:\"embedit-pro/embed-it-pro.php\";s:11:\"new_version\";s:4:\"1.11\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/embedit-pro/\";s:7:\"package\";s:59:\"https://downloads.wordpress.org/plugin/embedit-pro.1.11.zip\";s:5:\"icons\";a:0:{}s:7:\"banners\";a:2:{s:2:\"1x\";s:65:\"https://ps.w.org/embedit-pro/assets/banner-772x250.png?rev=503506\";s:7:\"default\";s:65:\"https://ps.w.org/embedit-pro/assets/banner-772x250.png?rev=503506\";}s:11:\"banners_rtl\";a:0:{}}s:29:\"image-widget/image-widget.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:26:\"w.org/plugins/image-widget\";s:4:\"slug\";s:12:\"image-widget\";s:6:\"plugin\";s:29:\"image-widget/image-widget.php\";s:11:\"new_version\";s:5:\"4.4.7\";s:3:\"url\";s:43:\"https://wordpress.org/plugins/image-widget/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/plugin/image-widget.4.4.7.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:64:\"https://ps.w.org/image-widget/assets/icon-128x128.jpg?rev=985707\";s:2:\"2x\";s:64:\"https://ps.w.org/image-widget/assets/icon-256x256.jpg?rev=985707\";s:7:\"default\";s:64:\"https://ps.w.org/image-widget/assets/icon-256x256.jpg?rev=985707\";}s:7:\"banners\";a:3:{s:2:\"2x\";s:67:\"https://ps.w.org/image-widget/assets/banner-1544x500.jpg?rev=593018\";s:2:\"1x\";s:66:\"https://ps.w.org/image-widget/assets/banner-772x250.png?rev=517739\";s:7:\"default\";s:67:\"https://ps.w.org/image-widget/assets/banner-1544x500.jpg?rev=593018\";}s:11:\"banners_rtl\";a:0:{}}s:35:\"jquery-colorbox/jquery-colorbox.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:29:\"w.org/plugins/jquery-colorbox\";s:4:\"slug\";s:15:\"jquery-colorbox\";s:6:\"plugin\";s:35:\"jquery-colorbox/jquery-colorbox.php\";s:11:\"new_version\";s:5:\"4.6.2\";s:3:\"url\";s:46:\"https://wordpress.org/plugins/jquery-colorbox/\";s:7:\"package\";s:64:\"https://downloads.wordpress.org/plugin/jquery-colorbox.4.6.2.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:68:\"https://ps.w.org/jquery-colorbox/assets/icon-128x128.jpg?rev=1534030\";s:2:\"2x\";s:68:\"https://ps.w.org/jquery-colorbox/assets/icon-256x256.jpg?rev=1534030\";s:7:\"default\";s:68:\"https://ps.w.org/jquery-colorbox/assets/icon-256x256.jpg?rev=1534030\";}s:7:\"banners\";a:2:{s:2:\"1x\";s:70:\"https://ps.w.org/jquery-colorbox/assets/banner-772x250.jpg?rev=1534030\";s:7:\"default\";s:70:\"https://ps.w.org/jquery-colorbox/assets/banner-772x250.jpg?rev=1534030\";}s:11:\"banners_rtl\";a:0:{}}s:31:\"master-slider/master-slider.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:27:\"w.org/plugins/master-slider\";s:4:\"slug\";s:13:\"master-slider\";s:6:\"plugin\";s:31:\"master-slider/master-slider.php\";s:11:\"new_version\";s:5:\"3.4.1\";s:3:\"url\";s:44:\"https://wordpress.org/plugins/master-slider/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/plugin/master-slider.3.4.1.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:66:\"https://ps.w.org/master-slider/assets/icon-128x128.png?rev=1638064\";s:2:\"2x\";s:66:\"https://ps.w.org/master-slider/assets/icon-256x256.png?rev=1638064\";s:7:\"default\";s:66:\"https://ps.w.org/master-slider/assets/icon-256x256.png?rev=1638064\";}s:7:\"banners\";a:3:{s:2:\"2x\";s:69:\"https://ps.w.org/master-slider/assets/banner-1544x500.png?rev=1638064\";s:2:\"1x\";s:68:\"https://ps.w.org/master-slider/assets/banner-772x250.png?rev=1638064\";s:7:\"default\";s:69:\"https://ps.w.org/master-slider/assets/banner-1544x500.png?rev=1638064\";}s:11:\"banners_rtl\";a:0:{}}s:61:\"no-right-click-images-plugin/no-right-click-images-plugin.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:42:\"w.org/plugins/no-right-click-images-plugin\";s:4:\"slug\";s:28:\"no-right-click-images-plugin\";s:6:\"plugin\";s:61:\"no-right-click-images-plugin/no-right-click-images-plugin.php\";s:11:\"new_version\";s:3:\"2.5\";s:3:\"url\";s:59:\"https://wordpress.org/plugins/no-right-click-images-plugin/\";s:7:\"package\";s:75:\"https://downloads.wordpress.org/plugin/no-right-click-images-plugin.2.5.zip\";s:5:\"icons\";a:0:{}s:7:\"banners\";a:2:{s:2:\"1x\";s:82:\"https://ps.w.org/no-right-click-images-plugin/assets/banner-772x250.jpg?rev=637048\";s:7:\"default\";s:82:\"https://ps.w.org/no-right-click-images-plugin/assets/banner-772x250.jpg?rev=637048\";}s:11:\"banners_rtl\";a:0:{}}s:33:\"page-in-widget/page-in-widget.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:28:\"w.org/plugins/page-in-widget\";s:4:\"slug\";s:14:\"page-in-widget\";s:6:\"plugin\";s:33:\"page-in-widget/page-in-widget.php\";s:11:\"new_version\";s:3:\"1.3\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/page-in-widget/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/plugin/page-in-widget.1.3.zip\";s:5:\"icons\";a:0:{}s:7:\"banners\";a:0:{}s:11:\"banners_rtl\";a:0:{}}s:53:\"page-management-dropdown/page-management-dropdown.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:38:\"w.org/plugins/page-management-dropdown\";s:4:\"slug\";s:24:\"page-management-dropdown\";s:6:\"plugin\";s:53:\"page-management-dropdown/page-management-dropdown.php\";s:11:\"new_version\";s:3:\"2.7\";s:3:\"url\";s:55:\"https://wordpress.org/plugins/page-management-dropdown/\";s:7:\"package\";s:71:\"https://downloads.wordpress.org/plugin/page-management-dropdown.2.7.zip\";s:5:\"icons\";a:0:{}s:7:\"banners\";a:0:{}s:11:\"banners_rtl\";a:0:{}}s:37:\"widgets-on-pages/widgets_on_pages.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:30:\"w.org/plugins/widgets-on-pages\";s:4:\"slug\";s:16:\"widgets-on-pages\";s:6:\"plugin\";s:37:\"widgets-on-pages/widgets_on_pages.php\";s:11:\"new_version\";s:5:\"1.4.0\";s:3:\"url\";s:47:\"https://wordpress.org/plugins/widgets-on-pages/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/widgets-on-pages.1.4.zip\";s:5:\"icons\";a:4:{s:2:\"1x\";s:69:\"https://ps.w.org/widgets-on-pages/assets/icon-128x128.png?rev=1397931\";s:2:\"2x\";s:69:\"https://ps.w.org/widgets-on-pages/assets/icon-256x256.png?rev=1397931\";s:3:\"svg\";s:61:\"https://ps.w.org/widgets-on-pages/assets/icon.svg?rev=1400727\";s:7:\"default\";s:61:\"https://ps.w.org/widgets-on-pages/assets/icon.svg?rev=1400727\";}s:7:\"banners\";a:2:{s:2:\"1x\";s:70:\"https://ps.w.org/widgets-on-pages/assets/banner-772x250.png?rev=478725\";s:7:\"default\";s:70:\"https://ps.w.org/widgets-on-pages/assets/banner-772x250.png?rev=478725\";}s:11:\"banners_rtl\";a:0:{}}s:42:\"woocommerce-menu-bar-cart/wp-menu-cart.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:39:\"w.org/plugins/woocommerce-menu-bar-cart\";s:4:\"slug\";s:25:\"woocommerce-menu-bar-cart\";s:6:\"plugin\";s:42:\"woocommerce-menu-bar-cart/wp-menu-cart.php\";s:11:\"new_version\";s:5:\"2.6.1\";s:3:\"url\";s:56:\"https://wordpress.org/plugins/woocommerce-menu-bar-cart/\";s:7:\"package\";s:74:\"https://downloads.wordpress.org/plugin/woocommerce-menu-bar-cart.2.6.1.zip\";s:5:\"icons\";a:3:{s:2:\"1x\";s:77:\"https://ps.w.org/woocommerce-menu-bar-cart/assets/icon-128x128.jpg?rev=987902\";s:2:\"2x\";s:77:\"https://ps.w.org/woocommerce-menu-bar-cart/assets/icon-256x256.jpg?rev=987902\";s:7:\"default\";s:77:\"https://ps.w.org/woocommerce-menu-bar-cart/assets/icon-256x256.jpg?rev=987902\";}s:7:\"banners\";a:2:{s:2:\"1x\";s:79:\"https://ps.w.org/woocommerce-menu-bar-cart/assets/banner-772x250.jpg?rev=687839\";s:7:\"default\";s:79:\"https://ps.w.org/woocommerce-menu-bar-cart/assets/banner-772x250.jpg?rev=687839\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no'),
(541, '_transient_timeout_feed_48712ca481250f05a7d55725ce055938', '1522302952', 'no');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(542, '_transient_feed_48712ca481250f05a7d55725ce055938', 'a:4:{s:5:\"child\";a:1:{s:0:\"\";a:1:{s:3:\"rss\";a:1:{i:0;a:6:{s:4:\"data\";s:3:\"\n\n\n\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:7:\"version\";s:3:\"2.0\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:0:\"\";a:1:{s:7:\"channel\";a:1:{i:0;a:6:{s:4:\"data\";s:55:\"\n	\n	\n	\n	\n	\n	\n	\n	\n	\n\n\n	\n	\n	\n		\n		\n		\n		\n		\n		\n		\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:3:{s:0:\"\";a:9:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:14:\"Quicker Themes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:35:\"https://quickerthemes.wordpress.com\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:24:\"Quicker, Easier, Better!\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:13:\"lastBuildDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Tue, 27 Feb 2018 22:29:51 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"language\";a:1:{i:0;a:5:{s:4:\"data\";s:2:\"en\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:9:\"generator\";a:1:{i:0;a:5:{s:4:\"data\";s:21:\"http://wordpress.com/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:5:\"cloud\";a:1:{i:0;a:5:{s:4:\"data\";s:0:\"\";s:7:\"attribs\";a:1:{s:0:\"\";a:5:{s:6:\"domain\";s:27:\"quickerthemes.wordpress.com\";s:4:\"port\";s:2:\"80\";s:4:\"path\";s:17:\"/?rsscloud=notify\";s:17:\"registerProcedure\";s:0:\"\";s:8:\"protocol\";s:9:\"http-post\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:5:\"image\";a:1:{i:0;a:6:{s:4:\"data\";s:11:\"\n		\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:0:\"\";a:3:{s:3:\"url\";a:1:{i:0;a:5:{s:4:\"data\";s:35:\"https://s2.wp.com/i/buttonw-com.png\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:14:\"Quicker Themes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:35:\"https://quickerthemes.wordpress.com\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}s:4:\"item\";a:10:{i:0;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:41:\"The QT Builder plugin is updated to 1.0.2\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:89:\"https://quickerthemes.wordpress.com/2017/08/13/the-qt-builder-plugin-is-updated-to-1-0-2/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Sun, 13 Aug 2017 18:28:17 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:41:\"http://quickerthemes.wordpress.com/?p=168\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:568:\"There is a new QT Builder update, which makes it 100% compatible with WordPress 4.8x. WordPress with this version updated the TinyMCE libraries, which made the earlier versions of the QT Page Builder plugin not fully compatible. The editor&#8217;s buttons were not working. This update fixes all that. To get the update, delete the QT &#8230; <a href=\"https://quickerthemes.wordpress.com/2017/08/13/the-qt-builder-plugin-is-updated-to-1-0-2/\" class=\"more-link\">Continue reading <span class=\"screen-reader-text\">The QT Builder plugin is updated to&#160;1.0.2</span></a>\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:1161:\"<p>There is a new QT Builder update, which makes it 100% compatible with WordPress 4.8x. WordPress with this version updated the TinyMCE libraries, which made the earlier versions of the QT Page Builder plugin not fully compatible. The editor&#8217;s buttons were not working. This update fixes all that.</p>\n<p>To get the update, delete the QT Builder V1.01 plugin, and get the update though TGM Plugin installer, it&#8217;s in the Essentials category.</p>\n<p>In the near future, all plugin updates served from the QuickerThemes.com, along with the TGM plugin list categories will be updated with the Tuxedo Software Updater, so you will get a notification in the backsite, and with one click you will be able to update the plugins even if they are not activated. I have not decided to make the updates automatic, so you would get them whether you like it or not, or simply get the notification and you decide. Any feedback about the automatic updates are welcomed.</p>\n<p>This update version of the QT Builder does not contain the code for the Tuxedo updates, but the next version will, along with all the others. When this happens, it will be announced.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:1;a:6:{s:4:\"data\";s:40:\"\n		\n		\n		\n		\n				\n		\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:45:\"The TGM Plugins list got updated… big time!\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:89:\"https://quickerthemes.wordpress.com/2017/06/19/the-tgm-plugins-list-got-updated-big-time/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Mon, 19 Jun 2017 21:30:06 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:2:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}i:1;a:5:{s:4:\"data\";s:3:\"tgm\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:41:\"http://quickerthemes.wordpress.com/?p=155\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:586:\"These are the TGM Plugin Categories and recommended plugins. The plugins in Bold are served from this server, all others from wordpress.org. This list is fluid, thus plugins will get added and deleted from time to time. Any changes to this list will be documented in this thread, and at http://quickerthemes.com/ . The RSS feeds of this site &#8230; <a href=\"https://quickerthemes.wordpress.com/2017/06/19/the-tgm-plugins-list-got-updated-big-time/\" class=\"more-link\">Continue reading <span class=\"screen-reader-text\">The TGM Plugins list got updated&#8230; big&#160;time!</span></a>\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:4560:\"<p>These are the TGM Plugin Categories and recommended plugins. The plugins in <strong>Bold</strong> are served from this server, all others from wordpress.org. This list is fluid, thus plugins will get added and deleted from time to time.</p>\n<p>Any changes to this list will be documented in this thread, and at <a href=\"http://quickerthemes.com/\" target=\"_blank\" rel=\"noopener\">http://quickerthemes.com/</a> . The RSS feeds of this site is shown in your WordPress installations Dashboard. The feed will contain only 3 feeds. The Dashboard RSS feeds can be disabled in the customizer, or they can be configured to display any feed of your choosing, a good way to feed your news, updates and promotions to your own customers.</p>\n<p>The list is extensive, and can be configured to push your plugins very easily, or disable the whole TGM business altogether, which some do, to my ashtonishment.</p>\n<p><em><b>Last Updated: February  27, 2017 &#8211; The plugins in bold are served by our own Quicker Themes server.</b></em></p>\n<p>The new plugins added are the following:</p>\n<p><strong>In Essentials:</strong> Classic Editor, and Gutenberg Manager</p>\n<p><strong>In Woocommerce:</strong> Non Purchasable Woocommerce Products</p>\n<p><b>In Security: </b>All In One Migration</p>\n<p><strong>Misc:</strong> Private Content, FluentForms, If Menu, Ninja Tables, Relevanssi</p>\n<p><strong>In Development:</strong> Customizer Snapshots</p>\n<p>Removed the plugin Nav Menu Roles from the Misc category, but we get the If Menu plugin as a better replacement for it.</p>\n<hr />\n<h2><strong>Below is the latest completed list:</strong></h2>\n<p>******************* Essentials:</p>\n<p><strong>QT-Builder</strong></p>\n<p><strong>QT-CSS</strong></p>\n<p>customizer export import</p>\n<p>Advanced Database Cleaner</p>\n<p>Sticky Menu or Anything on scroll</p>\n<p>Advanced Image Styles</p>\n<p>Shortcodes by Angie</p>\n<p>Max Mega Menu</p>\n<p>Easy Featured Images</p>\n<p>WP Editor Widget</p>\n<p>featured-image-generator</p>\n<p>Classic Editor</p>\n<p>Gutenberg Manager</p>\n<p>********************** Misc:</p>\n<p>bf image comparison</p>\n<p>add media from FTP</p>\n<p>admin menu editor</p>\n<p>amp</p>\n<p>fx-share</p>\n<p>visual form builder</p>\n<p>Event CLNDR</p>\n<p>Fonto</p>\n<p>WD Google Maps</p>\n<p>shortcoder</p>\n<p>TablePress</p>\n<p>WP Canvas Gallery</p>\n<p>Nav Menu Roles</p>\n<p>easy-google-fonts</p>\n<p>Page Scroll to ID</p>\n<p>Yoast SEO &#8211; WordPress SEO</p>\n<p>Hide Show Comment</p>\n<p>regenerate-thumbnails</p>\n<p>code-snippets</p>\n<p>highlight-search-terms</p>\n<p>Asgaros Forum</p>\n<p>Image Effect CK</p>\n<p>Responsive Text To Speech</p>\n<p>WP Show Posts</p>\n<p>WP Tables</p>\n<p>Private Content</p>\n<p>FluentForms</p>\n<p>If Menu</p>\n<p>Ninja Tables</p>\n<p>Relevanssi</p>\n<p>******************** Sliders:</p>\n<p><strong>Crelly Slider</strong></p>\n<p><strong>mb.YTPlayer for background videos</strong></p>\n<p>Advanced WordPress Backgrounds</p>\n<p>******************** Security:</p>\n<p>passwordless login</p>\n<p>temporary login without password</p>\n<p>wp-cerber</p>\n<p>user-id-changer</p>\n<p>ban-users</p>\n<p>fx-email-log</p>\n<p>bmt-no-right-click</p>\n<p>UpdraftPlus Backup and Restoration</p>\n<p>Duplicator</p>\n<p>Infinite WP</p>\n<p>plugin-inspector</p>\n<p>Block New Admin</p>\n<p>WP Blame</p>\n<p>Hide wp-login</p>\n<p>wp-prefix-changer</p>\n<p>All In One Migration</p>\n<p>******************** Speed:</p>\n<p>Simple Cache</p>\n<p>CometCache</p>\n<p>Plugin Organizer</p>\n<p>************************ Development:</p>\n<p>plugin cards</p>\n<p>wp staging</p>\n<p>download-plugins-dashboard</p>\n<p>user switching</p>\n<p>admin bar user switching</p>\n<p>Plugin Toggle</p>\n<p>Microthemer Lite</p>\n<p>rs-system-diagnostic</p>\n<p>shortcode-tester</p>\n<p>theme-inspector</p>\n<p>Query Monitor</p>\n<p>wp-database-admin</p>\n<p>advanced-wp-reset</p>\n<p>Widget Importer &amp; Exporter</p>\n<p>Customizer Snapshots</p>\n<p>*********************** Woocommerce:</p>\n<p>WooCommerce Shortcodes</p>\n<p>wc-external-product-new-tab</p>\n<p>wc-product-tabs-plus</p>\n<p>Woocommerce</p>\n<p>Woocommerce Menu Cart</p>\n<p>Woocommerce Role Based Price</p>\n<p>wc-vendors</p>\n<p><strong>Grant download permissions for past WooCommerce orders</strong></p>\n<p>Sale Counter</p>\n<p>WooCommerce Digital Goods Checkout</p>\n<p>WooCommerce Personal Discount</p>\n<p>Non Purchasable Woocommerce Products</p>\n<p>***********************  Page Builders:</p>\n<p>SiteOrigin Page builder</p>\n<p>SiteOrigin Widgets Bundle</p>\n<p>Livemesh SiteOrigin Widgets</p>\n<p>SiteOrigin Widgets by CodeLights</p>\n<p>SO Page Builder Animate</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:2;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:22:\"Brand New QTCSS Plugin\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:70:\"https://quickerthemes.wordpress.com/2017/01/16/brand-new-qtcss-plugin/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Mon, 16 Jan 2017 20:06:39 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:41:\"http://quickerthemes.wordpress.com/?p=119\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:523:\"A brand new QTCSS plugin has now replaced the old QTCSS plugin. When the plugin is installed and activated through the TGM plugin installer (found in the Misc. Category), it will replace the theme&#8217;s css preset  and css for posts/pages system. The theme&#8217;s system does not work on archive pages, and it does not have &#8230; <a href=\"https://quickerthemes.wordpress.com/2017/01/16/brand-new-qtcss-plugin/\" class=\"more-link\">Continue reading <span class=\"screen-reader-text\">Brand New QTCSS&#160;Plugin</span></a>\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:2205:\"<p>A brand new QTCSS plugin has now replaced the old QTCSS plugin. When the plugin is installed and activated through the TGM plugin installer (found in the Misc. Category), it will replace the theme&#8217;s css preset  and css for posts/pages system.</p>\n<ul>\n<li>The theme&#8217;s system does not work on archive pages, and it does not have the facilities to view or even edit the css files.</li>\n<li>The old QTCSS plugin was not compatible with Woocommerce (very important), or any other CPT.</li>\n</ul>\n<p>Both of these above limitations are now fixed thanks to the new QTCSS plugin.</p>\n<p>The brand new QTCSS plugin has the following features:</p>\n<ul>\n<li>Just like the old QTCSS plugin you can view the css/js files.</li>\n<li>Unlike the old QTCSS plugin, you can even edit the css/js files. You cannot however create new files. If you want to create new CSS or JS files, you need to first create them locally, and FTP them into the theme.</li>\n<li>Unlike the old QTCSS plugin, where you were able to use only files in a preset CSS and JS folders, be default, you now have access to all css and JS files present in the entire theme. However, from the settings menu, you can limit to any folder you like, thus making things easier to handle.</li>\n<li>Just like the old QTCSS plugin, you will be able to load multiple css/js files in any post/page/CPT. The method of doing so has changed. The old plugin was using checkboxes, while the new plugin uses AJAX.</li>\n<li>Finally, unlike anything we had before, we can now set CSS/JS files site wide, making plugins like CSSOR, or child themes where ONLY css was added (not php) unnecessary anymore. Furthermore, these site wide CSS/JS rules/files now work with archive pages, unlike the theme&#8217;s CSS system.</li>\n</ul>\n<p>If you only need a simple system to have CSS settings set for certain posts/pages, the theme&#8217;s CSS built-in system is adequate. However, if you want the same functionality that also requires the ability to influence the archive pages, plus the ability to add Javascript files, and be able to edit the preset CSS/JS files, this plugin is a must.</p>\n<p>The QTCSS plugin was based on James Low&#8217;s excellent code.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:3;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:39:\"The QT Builder is now Updated to V1.0.1\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:87:\"https://quickerthemes.wordpress.com/2017/01/10/the-qt-builder-is-now-updated-to-v1-0-1/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Wed, 11 Jan 2017 01:01:52 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:41:\"http://quickerthemes.wordpress.com/?p=115\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:140:\"The new version fixes some bugs, removes the preview button as it was causing issues, and now you no longer need an existing page to use it.\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:148:\"<p>The new version fixes some bugs, removes the preview button as it was causing issues, and now you no longer need an existing page to use it.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:4;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:77:\"Added the Image Effect CK plugin to the Misc category of the TGM plugins list\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:125:\"https://quickerthemes.wordpress.com/2016/12/12/added-the-image-effect-ck-plugin-to-the-misc-category-of-the-tgm-plugins-list/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Mon, 12 Dec 2016 17:07:13 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:40:\"http://quickerthemes.wordpress.com/?p=97\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:583:\"The Image Effect CK plugin was added to the Misc. category of the TGM plugins list. All you have to do is add one of the 24 effect classes to an image, making sure that the lightbox class is not present, set the Title and Description in the title tag of the image, separated by &#8230; <a href=\"https://quickerthemes.wordpress.com/2016/12/12/added-the-image-effect-ck-plugin-to-the-misc-category-of-the-tgm-plugins-list/\" class=\"more-link\">Continue reading <span class=\"screen-reader-text\">Added the Image Effect CK plugin to the Misc category of the TGM plugins&#160;list</span></a>\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:1312:\"<p>The Image Effect CK plugin was added to the Misc. category of the TGM plugins list.</p>\n<p>All you have to do is add one of the 24 effect classes to an image, making sure that the lightbox class is not present, set the Title and Description in the title tag of the image, separated by 2 colons &#8211; :: , and you are good to go. Better used with a page builders columns, we recommend the QT builder, or the themes columns.</p>\n<p>All the classes that can be used are:</p>\n<p>effectck-lily, effectck-oscar, effectck-sadie, effectck-honey, effectck-layla, effectck-zoe, effectck-marley, effectck-ruby, effectck-roxy, effectck-bubba, effectck-romeo, effectck-dexter, effectck-sarah, effectck-chico, effectck-milo, effectck-julia, effectck-goliath, effectck-selena, effectck-apollo, effectck-steve, effectck-moses, effectck-jazz, effectck-ming, effectck-duke</p>\n<p>Here is an example page using this plugin: <a href=\"http://quickerthemes.com/sandimas/image-effects/\" target=\"_blank\" rel=\"noopener\">http://quickerthemes.com/sandimas/image-effects/</a></p>\n<p>And here is a short Youtube video demonstration: <a href=\"https://www.youtube.com/watch?v=ASzXBR-vFjg&amp;feature=youtu.be\" target=\"_blank\" rel=\"noopener\">https://www.youtube.com/watch?v=ASzXBR-vFjg&amp;feature=youtu.be</a></p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:5;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:67:\"The wpmbytplayer plugin is moved to the TGM “Sliders” Category.\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:108:\"https://quickerthemes.wordpress.com/2016/12/07/the-wpmbytplayer-plugin-is-moved-to-the-tgm-sliders-category/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Wed, 07 Dec 2016 19:28:05 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:40:\"http://quickerthemes.wordpress.com/?p=76\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:612:\"The wpmbytplayer plugin is being moved to the TGM &#8220;Sliders&#8221; Category. Furthermore, because their were changes made to it by the developer, the plugin is now served by our servers and not from the WordPress plugin repository. The plugin was bumped to V3.x and it is now almost rendered useless, as you can now only set &#8230; <a href=\"https://quickerthemes.wordpress.com/2016/12/07/the-wpmbytplayer-plugin-is-moved-to-the-tgm-sliders-category/\" class=\"more-link\">Continue reading <span class=\"screen-reader-text\">The wpmbytplayer plugin is moved to the TGM &#8220;Sliders&#8221; Category.</span></a>\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:1604:\"<p>The wpmbytplayer plugin is being moved to the TGM &#8220;Sliders&#8221; Category.</p>\n<p>Furthermore, because their were changes made to it by the developer, the plugin is now served by our servers and not from the WordPress plugin repository.</p>\n<p>The plugin was bumped to V3.x and it is now almost rendered useless, as you can now only set a background  video on the homepage. There is noway to use the shortcodes now, to use it on any page/post you like, and more importantly, there is no way to insert the videos inline, which I prefer the way to use this plugin.</p>\n<p>To get the fully working version of this plugin V3 and up, the developer want 8Euros/site, roughly $10 US. The developer also has a developer license of 55Euros/theme, roughly $60 US. In both cases this makes it impossible to include any paid versions of the plugin. If you have 10 themes for distribution, this is going to cost you $600, which is way too steep of a price fora plugin that is not essential, and for what it actually does. That said, this plugin is the absolute best for what it does, especially including inline videos where you control the height of the videos, along with other parameters like volume, not found in any other plugin, free or premium. The only way to include the premium version of this plugin to the QT Plugin is to have an unlimited use Developer license, and not per site or per theme.</p>\n<p>I will adopt rebrand and maintain V2.x of this plugin which I absolutely love, and I will see to create a plugin or incorporate this version of the plugin in to the core of the QT themes.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:6;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:51:\"My MyStickyMenu is removed from the Essentials List\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:99:\"https://quickerthemes.wordpress.com/2016/12/07/my-mystickymenu-is-removed-from-the-essentials-list/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Wed, 07 Dec 2016 19:11:34 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:40:\"http://quickerthemes.wordpress.com/?p=69\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:309:\"With QT 1.34  the MyStickyMenu was embedded into the themes, therefore the plugin was removed from the TGM &#8220;Essentials&#8221; category. If you want to use another code/plugin for sticky menus/headers, the embedded Sticky Menu can be turned off from the WP Customizer screen. By default it is set to on.\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:324:\"<p>With QT 1.34  the MyStickyMenu was embedded into the themes, therefore the plugin was removed from the TGM &#8220;Essentials&#8221; category.</p>\n<p>If you want to use another code/plugin for sticky menus/headers, the embedded Sticky Menu can be turned off from the WP Customizer screen. By default it is set to on.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:7;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:34:\"The QT Builder plugin got updated.\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:81:\"https://quickerthemes.wordpress.com/2016/12/03/the-qt-builder-plugin-got-updated/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Sun, 04 Dec 2016 06:09:08 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:40:\"http://quickerthemes.wordpress.com/?p=66\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:278:\"The QT plugin got updated to V1.1. There are some php and CSS improvements. To update, delete the plugin from your site, and install a fresh copy through the TGM plugin installation. The QT Builder plugin is in the &#8220;Page Builders&#8221; category, 6th in the category list.\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:286:\"<p>The QT plugin got updated to V1.1. There are some php and CSS improvements. To update, delete the plugin from your site, and install a fresh copy through the TGM plugin installation. The QT Builder plugin is in the &#8220;Page Builders&#8221; category, 6th in the category list.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:8;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:47:\"Image Widget Removed and Wp-Editor-Widget added\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:104:\"https://quickerthemes.wordpress.com/2016/11/20/image-widget-removed-and-wp-editor-widget-added-10202016/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Mon, 21 Nov 2016 03:22:27 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:40:\"http://quickerthemes.wordpress.com/?p=54\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:274:\"From the &#8220;Essentials&#8221; plugin list the Image Widget was replaced by the WP Editor Widget. This replacement plugin is only 15kb in size, and gives you the full blown visual editor, so besides images, you can add anything you want very easily, including shortcodes.\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:282:\"<p>From the &#8220;Essentials&#8221; plugin list the Image Widget was replaced by the WP Editor Widget. This replacement plugin is only 15kb in size, and gives you the full blown visual editor, so besides images, you can add anything you want very easily, including shortcodes.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}i:9;a:6:{s:4:\"data\";s:37:\"\n		\n		\n		\n		\n				\n\n		\n		\n				\n		\n		\n	\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:4:{s:0:\"\";a:6:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:30:\"Regarding WP Canvas Shortcodes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"link\";a:1:{i:0;a:5:{s:4:\"data\";s:73:\"https://quickerthemes.wordpress.com/2016/11/12/wp-canvas-shortcodes-news/\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:7:\"pubDate\";a:1:{i:0;a:5:{s:4:\"data\";s:31:\"Sun, 13 Nov 2016 02:52:17 +0000\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:8:\"category\";a:1:{i:0;a:5:{s:4:\"data\";s:12:\"Plugins News\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:4:\"guid\";a:1:{i:0;a:5:{s:4:\"data\";s:40:\"http://quickerthemes.wordpress.com/?p=39\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:11:\"isPermaLink\";s:5:\"false\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:11:\"description\";a:1:{i:0;a:5:{s:4:\"data\";s:550:\"Update &#8211; 11/16/2016: It seems that the WP Canvas Shortcode plugin is back online. To insure it&#8217;s continued availability we will continue installing it from the Quicker Themes server, for a few weeks, and then change the TGM scripts to download the plugin directly from wordpress.org. It seems that for whatever reason the WP Canvas &#8230; <a href=\"https://quickerthemes.wordpress.com/2016/11/12/wp-canvas-shortcodes-news/\" class=\"more-link\">Continue reading <span class=\"screen-reader-text\">Regarding WP Canvas&#160;Shortcodes</span></a>\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:32:\"http://purl.org/dc/elements/1.1/\";a:1:{s:7:\"creator\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:40:\"http://purl.org/rss/1.0/modules/content/\";a:1:{s:7:\"encoded\";a:1:{i:0;a:5:{s:4:\"data\";s:650:\"<p><strong>Update &#8211; 11/16/2016:</strong></p>\n<p>It seems that the WP Canvas Shortcode plugin is back online. To insure it&#8217;s continued availability we will continue installing it from the Quicker Themes server, for a few weeks, and then change the TGM scripts to download the plugin directly from wordpress.org.</p>\n<hr />\n<p>It seems that for whatever reason the WP Canvas Shortcodes has been removed from the repositories. Because we really like this particular plugin, and heavily use and promote it as well, it will now be served and maintained by Quicker Themes through TGM. It will still be found under the Essentials category.</p>\n\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:7:\"content\";a:1:{i:0;a:6:{s:4:\"data\";s:7:\"\n			\n		\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"url\";s:82:\"http://2.gravatar.com/avatar/b638ead0566a9feb9e35b05c62904258?s=96&d=identicon&r=G\";s:6:\"medium\";s:5:\"image\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";s:5:\"child\";a:1:{s:29:\"http://search.yahoo.com/mrss/\";a:1:{s:5:\"title\";a:1:{i:0;a:5:{s:4:\"data\";s:13:\"quickerthemes\";s:7:\"attribs\";a:1:{s:0:\"\";a:1:{s:4:\"type\";s:4:\"html\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}}}s:27:\"http://www.w3.org/2005/Atom\";a:1:{s:4:\"link\";a:3:{i:0;a:5:{s:4:\"data\";s:0:\"\";s:7:\"attribs\";a:1:{s:0:\"\";a:3:{s:4:\"href\";s:41:\"https://quickerthemes.wordpress.com/feed/\";s:3:\"rel\";s:4:\"self\";s:4:\"type\";s:19:\"application/rss+xml\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}i:1;a:5:{s:4:\"data\";s:0:\"\";s:7:\"attribs\";a:1:{s:0:\"\";a:4:{s:3:\"rel\";s:6:\"search\";s:4:\"type\";s:37:\"application/opensearchdescription+xml\";s:4:\"href\";s:43:\"https://quickerthemes.wordpress.com/osd.xml\";s:5:\"title\";s:14:\"Quicker Themes\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}i:2;a:5:{s:4:\"data\";s:0:\"\";s:7:\"attribs\";a:1:{s:0:\"\";a:2:{s:3:\"rel\";s:3:\"hub\";s:4:\"href\";s:50:\"https://quickerthemes.wordpress.com/?pushpress=hub\";}}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}s:44:\"http://purl.org/rss/1.0/modules/syndication/\";a:2:{s:12:\"updatePeriod\";a:1:{i:0;a:5:{s:4:\"data\";s:6:\"hourly\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}s:15:\"updateFrequency\";a:1:{i:0;a:5:{s:4:\"data\";s:1:\"1\";s:7:\"attribs\";a:0:{}s:8:\"xml_base\";s:0:\"\";s:17:\"xml_base_explicit\";b:0;s:8:\"xml_lang\";s:0:\"\";}}}}}}}}}}}}s:4:\"type\";i:128;s:7:\"headers\";O:42:\"Requests_Utility_CaseInsensitiveDictionary\":1:{s:7:\"\0*\0data\";a:10:{s:6:\"server\";s:5:\"nginx\";s:4:\"date\";s:29:\"Wed, 28 Mar 2018 17:55:51 GMT\";s:12:\"content-type\";s:34:\"application/rss+xml; charset=UTF-8\";s:4:\"vary\";a:2:{i:0;s:15:\"Accept-Encoding\";i:1;s:15:\"Accept-Encoding\";}s:8:\"x-hacker\";s:108:\"If you\'re reading this, you should visit automattic.com/jobs and apply to join the fun, mention this header.\";s:13:\"last-modified\";s:29:\"Tue, 27 Feb 2018 22:29:51 GMT\";s:4:\"x-nc\";s:11:\"HIT bur 209\";s:16:\"content-encoding\";s:4:\"gzip\";s:4:\"x-ac\";s:10:\"1.sin _bur\";s:25:\"strict-transport-security\";s:16:\"max-age=15552000\";}}s:5:\"build\";s:14:\"20131109171826\";}', 'no'),
(543, '_transient_timeout_feed_mod_48712ca481250f05a7d55725ce055938', '1522302952', 'no'),
(544, '_transient_feed_mod_48712ca481250f05a7d55725ce055938', '1522259752', 'no'),
(546, '_transient_timeout_pt1trans-update-info', '1522266632', 'no'),
(547, '_transient_pt1trans-update-info', 'a:1:{s:11:\"new_version\";s:0:\"\";}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(8, 14, '_wc_review_count', '0'),
(9, 14, '_wc_rating_count', 'a:0:{}'),
(10, 14, '_wc_average_rating', '0'),
(11, 15, '_wc_review_count', '0'),
(12, 15, '_wc_rating_count', 'a:0:{}'),
(13, 15, '_wc_average_rating', '0'),
(14, 14, '_edit_last', '1'),
(15, 14, '_edit_lock', '1521995459:1'),
(16, 16, '_wp_attached_file', '2018/03/Chrysanthemum.jpg'),
(17, 16, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:25:\"2018/03/Chrysanthemum.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:25:\"Chrysanthemum-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:25:\"Chrysanthemum-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:25:\"Chrysanthemum-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:26:\"Chrysanthemum-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:25:\"Chrysanthemum-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:25:\"Chrysanthemum-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:25:\"Chrysanthemum-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:6:\"Corbis\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1205503166\";s:9:\"copyright\";s:32:\"© Corbis.  All Rights Reserved.\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(18, 17, '_wp_attached_file', '2018/03/Desert.jpg'),
(19, 17, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:18:\"2018/03/Desert.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"Desert-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"Desert-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"Desert-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:19:\"Desert-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:18:\"Desert-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:18:\"Desert-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:18:\"Desert-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:2:\"?*\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1205503166\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(20, 18, '_wp_attached_file', '2018/03/Hydrangeas.jpg'),
(21, 18, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:22:\"2018/03/Hydrangeas.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"Hydrangeas-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"Hydrangeas-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"Hydrangeas-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:23:\"Hydrangeas-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:22:\"Hydrangeas-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:22:\"Hydrangeas-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:22:\"Hydrangeas-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:11:\"Amish Patel\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1206376913\";s:9:\"copyright\";s:24:\"© Microsoft Corporation\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(22, 19, '_wp_attached_file', '2018/03/Jellyfish.jpg'),
(23, 19, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:21:\"2018/03/Jellyfish.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:21:\"Jellyfish-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:21:\"Jellyfish-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:21:\"Jellyfish-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"Jellyfish-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:21:\"Jellyfish-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:21:\"Jellyfish-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:21:\"Jellyfish-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:9:\"Hang Quan\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1202729544\";s:9:\"copyright\";s:24:\"© Microsoft Corporation\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(24, 20, '_wp_attached_file', '2018/03/Koala.jpg'),
(25, 20, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:17:\"2018/03/Koala.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:17:\"Koala-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:17:\"Koala-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:17:\"Koala-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:18:\"Koala-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:17:\"Koala-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:17:\"Koala-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:17:\"Koala-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:6:\"Corbis\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1202729563\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(26, 21, '_wp_attached_file', '2018/03/Lighthouse.jpg'),
(27, 21, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:22:\"2018/03/Lighthouse.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"Lighthouse-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"Lighthouse-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"Lighthouse-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:23:\"Lighthouse-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:22:\"Lighthouse-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:22:\"Lighthouse-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:22:\"Lighthouse-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:10:\"Tom Alphin\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1202729571\";s:9:\"copyright\";s:24:\"© Microsoft Corporation\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(28, 22, '_wp_attached_file', '2018/03/Penguins.jpg'),
(29, 22, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:20:\"2018/03/Penguins.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"Penguins-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"Penguins-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"Penguins-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:21:\"Penguins-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:20:\"Penguins-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:20:\"Penguins-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:20:\"Penguins-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:6:\"Corbis\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1203311251\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(30, 23, '_wp_attached_file', '2018/03/Tulips.jpg'),
(31, 23, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1024;s:6:\"height\";i:768;s:4:\"file\";s:18:\"2018/03/Tulips.jpg\";s:5:\"sizes\";a:7:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"Tulips-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"Tulips-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"Tulips-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:19:\"Tulips-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:18:\"Tulips-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:18:\"Tulips-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:18:\"Tulips-600x600.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:13:\"David Nadalin\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1202383991\";s:9:\"copyright\";s:24:\"© Microsoft Corporation\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(44, 14, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(45, 14, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(46, 14, 'product_adjustment_hide_price_unregistered', 'no'),
(47, 14, 'eh_pricing_adjustment_product_price_user_role', ''),
(48, 14, 'product_adjustment_product_visibility_unregistered', 'no'),
(49, 14, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(50, 14, 'product_based_price_adjustment', 'no'),
(51, 14, 'product_price_adjustment', ''),
(52, 14, 'product_role_based_price', ''),
(53, 14, '_sku', ''),
(54, 14, '_regular_price', '11'),
(55, 14, '_sale_price', '10'),
(56, 14, '_sale_price_dates_from', ''),
(57, 14, '_sale_price_dates_to', ''),
(58, 14, 'total_sales', '0'),
(59, 14, '_tax_status', 'taxable'),
(60, 14, '_tax_class', ''),
(61, 14, '_manage_stock', 'no'),
(62, 14, '_backorders', 'no'),
(63, 14, '_sold_individually', 'no'),
(64, 14, '_weight', ''),
(65, 14, '_length', ''),
(66, 14, '_width', ''),
(67, 14, '_height', ''),
(68, 14, '_upsell_ids', 'a:0:{}'),
(69, 14, '_crosssell_ids', 'a:0:{}'),
(70, 14, '_purchase_note', ''),
(71, 14, '_default_attributes', 'a:0:{}'),
(72, 14, '_virtual', 'no'),
(73, 14, '_downloadable', 'no'),
(74, 14, '_product_image_gallery', ''),
(75, 14, '_download_limit', '-1'),
(76, 14, '_download_expiry', '-1'),
(77, 14, '_stock', NULL),
(78, 14, '_stock_status', 'instock'),
(79, 14, '_product_version', '3.2.6'),
(80, 14, '_price', '10'),
(81, 14, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(82, 30, '_wp_attached_file', '2018/03/product-1-1.jpg'),
(83, 30, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:850;s:6:\"height\";i:566;s:4:\"file\";s:23:\"2018/03/product-1-1.jpg\";s:5:\"sizes\";a:6:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"product-1-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"product-1-1-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:23:\"product-1-1-768x511.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:511;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"product-1-1-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"product-1-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:23:\"product-1-1-600x566.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:566;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:58:\"Copyright (c) 2009 by Chad McDermott. All rights reserved.\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(84, 31, '_wp_attached_file', '2018/03/product-1-1.png'),
(85, 31, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:630;s:6:\"height\";i:491;s:4:\"file\";s:23:\"2018/03/product-1-1.png\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"product-1-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"product-1-1-300x234.png\";s:5:\"width\";i:300;s:6:\"height\";i:234;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"product-1-1-180x180.png\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"product-1-1-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:23:\"product-1-1-600x491.png\";s:5:\"width\";i:600;s:6:\"height\";i:491;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(86, 32, '_wp_attached_file', '2018/03/product-2-1.jpg'),
(87, 32, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:499;s:6:\"height\";i:346;s:4:\"file\";s:23:\"2018/03/product-2-1.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"product-2-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"product-2-1-300x208.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:208;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"product-2-1-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"product-2-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(88, 33, '_wp_attached_file', '2018/03/product-3-1.jpg'),
(89, 33, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:638;s:6:\"height\";i:479;s:4:\"file\";s:23:\"2018/03/product-3-1.jpg\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"product-3-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"product-3-1-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"product-3-1-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"product-3-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:23:\"product-3-1-600x479.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:479;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(90, 34, '_wp_attached_file', '2018/03/product-4-1.jpg'),
(91, 34, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:582;s:6:\"height\";i:403;s:4:\"file\";s:23:\"2018/03/product-4-1.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"product-4-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"product-4-1-300x208.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:208;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"product-4-1-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"product-4-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(92, 35, '_wp_attached_file', '2018/03/product-5-1.jpg'),
(93, 35, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:550;s:6:\"height\";i:317;s:4:\"file\";s:23:\"2018/03/product-5-1.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"product-5-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"product-5-1-300x173.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:173;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"product-5-1-180x180.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:180;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"product-5-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(94, 14, '_thumbnail_id', '34'),
(95, 36, '_sku', ''),
(96, 36, '_regular_price', '11'),
(97, 36, '_sale_price', '10'),
(98, 36, '_sale_price_dates_from', ''),
(99, 36, '_sale_price_dates_to', ''),
(100, 36, 'total_sales', '0'),
(101, 36, '_tax_status', 'taxable'),
(102, 36, '_tax_class', ''),
(103, 36, '_manage_stock', 'no'),
(104, 36, '_backorders', 'no'),
(105, 36, '_sold_individually', 'no'),
(106, 36, '_weight', ''),
(107, 36, '_length', ''),
(108, 36, '_width', ''),
(109, 36, '_height', ''),
(110, 36, '_upsell_ids', 'a:0:{}'),
(111, 36, '_crosssell_ids', 'a:0:{}'),
(112, 36, '_purchase_note', ''),
(113, 36, '_default_attributes', 'a:0:{}'),
(114, 36, '_virtual', 'no'),
(115, 36, '_downloadable', 'no'),
(116, 36, '_product_image_gallery', ''),
(117, 36, '_download_limit', '-1'),
(118, 36, '_download_expiry', '-1'),
(119, 36, '_thumbnail_id', '35'),
(120, 36, '_stock', NULL),
(121, 36, '_stock_status', 'instock'),
(122, 36, '_wc_average_rating', '0'),
(123, 36, '_wc_rating_count', 'a:0:{}'),
(124, 36, '_wc_review_count', '0'),
(125, 36, '_downloadable_files', 'a:0:{}'),
(126, 36, '_product_attributes', 'a:0:{}'),
(127, 36, '_product_version', '3.2.6'),
(128, 36, '_price', '10'),
(129, 36, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(130, 36, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(131, 36, 'product_adjustment_hide_price_unregistered', 'no'),
(132, 36, 'eh_pricing_adjustment_product_price_user_role', ''),
(133, 36, 'product_adjustment_product_visibility_unregistered', 'no'),
(134, 36, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(135, 36, 'product_based_price_adjustment', 'no'),
(136, 36, 'product_price_adjustment', ''),
(137, 36, 'product_role_based_price', ''),
(138, 36, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(139, 36, '_edit_lock', '1521995575:1'),
(140, 36, '_edit_last', '1'),
(141, 37, '_sku', ''),
(142, 37, '_regular_price', '11'),
(143, 37, '_sale_price', '10'),
(144, 37, '_sale_price_dates_from', ''),
(145, 37, '_sale_price_dates_to', ''),
(146, 37, 'total_sales', '0'),
(147, 37, '_tax_status', 'taxable'),
(148, 37, '_tax_class', ''),
(149, 37, '_manage_stock', 'no'),
(150, 37, '_backorders', 'no'),
(151, 37, '_sold_individually', 'no'),
(152, 37, '_weight', ''),
(153, 37, '_length', ''),
(154, 37, '_width', ''),
(155, 37, '_height', ''),
(156, 37, '_upsell_ids', 'a:0:{}'),
(157, 37, '_crosssell_ids', 'a:0:{}'),
(158, 37, '_purchase_note', ''),
(159, 37, '_default_attributes', 'a:0:{}'),
(160, 37, '_virtual', 'no'),
(161, 37, '_downloadable', 'no'),
(162, 37, '_product_image_gallery', ''),
(163, 37, '_download_limit', '-1'),
(164, 37, '_download_expiry', '-1'),
(165, 37, '_thumbnail_id', '34'),
(166, 37, '_stock', NULL),
(167, 37, '_stock_status', 'instock'),
(168, 37, '_wc_average_rating', '0'),
(169, 37, '_wc_rating_count', 'a:0:{}'),
(170, 37, '_wc_review_count', '0'),
(171, 37, '_downloadable_files', 'a:0:{}'),
(172, 37, '_product_attributes', 'a:0:{}'),
(173, 37, '_product_version', '3.2.6'),
(174, 37, '_price', '10'),
(175, 37, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(176, 37, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(177, 37, 'product_adjustment_hide_price_unregistered', 'no'),
(178, 37, 'eh_pricing_adjustment_product_price_user_role', ''),
(179, 37, 'product_adjustment_product_visibility_unregistered', 'no'),
(180, 37, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(181, 37, 'product_based_price_adjustment', 'no'),
(182, 37, 'product_price_adjustment', ''),
(183, 37, 'product_role_based_price', ''),
(184, 37, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(185, 37, '_edit_lock', '1521995613:1'),
(186, 37, '_edit_last', '1'),
(187, 38, '_sku', ''),
(188, 38, '_regular_price', '11'),
(189, 38, '_sale_price', '10'),
(190, 38, '_sale_price_dates_from', ''),
(191, 38, '_sale_price_dates_to', ''),
(192, 38, 'total_sales', '0'),
(193, 38, '_tax_status', 'taxable'),
(194, 38, '_tax_class', ''),
(195, 38, '_manage_stock', 'no'),
(196, 38, '_backorders', 'no'),
(197, 38, '_sold_individually', 'no'),
(198, 38, '_weight', ''),
(199, 38, '_length', ''),
(200, 38, '_width', ''),
(201, 38, '_height', ''),
(202, 38, '_upsell_ids', 'a:0:{}'),
(203, 38, '_crosssell_ids', 'a:0:{}'),
(204, 38, '_purchase_note', ''),
(205, 38, '_default_attributes', 'a:0:{}'),
(206, 38, '_virtual', 'no'),
(207, 38, '_downloadable', 'no'),
(208, 38, '_product_image_gallery', ''),
(209, 38, '_download_limit', '-1'),
(210, 38, '_download_expiry', '-1'),
(212, 38, '_stock', NULL),
(213, 38, '_stock_status', 'instock'),
(214, 38, '_wc_average_rating', '0'),
(215, 38, '_wc_rating_count', 'a:0:{}'),
(216, 38, '_wc_review_count', '0'),
(217, 38, '_downloadable_files', 'a:0:{}'),
(218, 38, '_product_attributes', 'a:0:{}'),
(219, 38, '_product_version', '3.2.6'),
(220, 38, '_price', '10'),
(221, 38, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(222, 38, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(223, 38, 'product_adjustment_hide_price_unregistered', 'no'),
(224, 38, 'eh_pricing_adjustment_product_price_user_role', ''),
(225, 38, 'product_adjustment_product_visibility_unregistered', 'no'),
(226, 38, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(227, 38, 'product_based_price_adjustment', 'no'),
(228, 38, 'product_price_adjustment', ''),
(229, 38, 'product_role_based_price', ''),
(230, 38, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(231, 38, '_edit_lock', '1521995762:1'),
(232, 38, '_edit_last', '1'),
(233, 38, '_thumbnail_id', '32'),
(234, 39, '_sku', ''),
(235, 39, '_regular_price', '11'),
(236, 39, '_sale_price', '10'),
(237, 39, '_sale_price_dates_from', ''),
(238, 39, '_sale_price_dates_to', ''),
(239, 39, 'total_sales', '0'),
(240, 39, '_tax_status', 'taxable'),
(241, 39, '_tax_class', ''),
(242, 39, '_manage_stock', 'no'),
(243, 39, '_backorders', 'no'),
(244, 39, '_sold_individually', 'no'),
(245, 39, '_weight', ''),
(246, 39, '_length', ''),
(247, 39, '_width', ''),
(248, 39, '_height', ''),
(249, 39, '_upsell_ids', 'a:0:{}'),
(250, 39, '_crosssell_ids', 'a:0:{}'),
(251, 39, '_purchase_note', ''),
(252, 39, '_default_attributes', 'a:0:{}'),
(253, 39, '_virtual', 'no'),
(254, 39, '_downloadable', 'no'),
(255, 39, '_product_image_gallery', ''),
(256, 39, '_download_limit', '-1'),
(257, 39, '_download_expiry', '-1'),
(258, 39, '_thumbnail_id', '31'),
(259, 39, '_stock', NULL),
(260, 39, '_stock_status', 'instock'),
(261, 39, '_wc_average_rating', '0'),
(262, 39, '_wc_rating_count', 'a:0:{}'),
(263, 39, '_wc_review_count', '0'),
(264, 39, '_downloadable_files', 'a:0:{}'),
(265, 39, '_product_attributes', 'a:0:{}'),
(266, 39, '_product_version', '3.2.6'),
(267, 39, '_price', '10'),
(268, 39, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(269, 39, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(270, 39, 'product_adjustment_hide_price_unregistered', 'no'),
(271, 39, 'eh_pricing_adjustment_product_price_user_role', ''),
(272, 39, 'product_adjustment_product_visibility_unregistered', 'no'),
(273, 39, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(274, 39, 'product_based_price_adjustment', 'no'),
(275, 39, 'product_price_adjustment', ''),
(276, 39, 'product_role_based_price', ''),
(277, 39, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(278, 39, '_edit_lock', '1521995844:1'),
(279, 40, '_sku', ''),
(280, 40, '_regular_price', '11'),
(281, 40, '_sale_price', '10'),
(282, 40, '_sale_price_dates_from', ''),
(283, 40, '_sale_price_dates_to', ''),
(284, 40, 'total_sales', '0'),
(285, 40, '_tax_status', 'taxable'),
(286, 40, '_tax_class', ''),
(287, 40, '_manage_stock', 'no'),
(288, 40, '_backorders', 'no'),
(289, 40, '_sold_individually', 'no'),
(290, 40, '_weight', ''),
(291, 40, '_length', ''),
(292, 40, '_width', ''),
(293, 40, '_height', ''),
(294, 40, '_upsell_ids', 'a:0:{}'),
(295, 40, '_crosssell_ids', 'a:0:{}'),
(296, 40, '_purchase_note', ''),
(297, 40, '_default_attributes', 'a:0:{}'),
(298, 40, '_virtual', 'no'),
(299, 40, '_downloadable', 'no'),
(300, 40, '_product_image_gallery', ''),
(301, 40, '_download_limit', '-1'),
(302, 40, '_download_expiry', '-1'),
(303, 40, '_thumbnail_id', '30'),
(304, 40, '_stock', NULL),
(305, 40, '_stock_status', 'instock'),
(306, 40, '_wc_average_rating', '0'),
(307, 40, '_wc_rating_count', 'a:0:{}'),
(308, 40, '_wc_review_count', '0'),
(309, 40, '_downloadable_files', 'a:0:{}'),
(310, 40, '_product_attributes', 'a:0:{}'),
(311, 40, '_product_version', '3.2.6'),
(312, 40, '_price', '10'),
(313, 40, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(314, 40, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(315, 40, 'product_adjustment_hide_price_unregistered', 'no'),
(316, 40, 'eh_pricing_adjustment_product_price_user_role', ''),
(317, 40, 'product_adjustment_product_visibility_unregistered', 'no'),
(318, 40, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(319, 40, 'product_based_price_adjustment', 'no'),
(320, 40, 'product_price_adjustment', ''),
(321, 40, 'product_role_based_price', ''),
(322, 40, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(323, 40, '_edit_lock', '1521995847:1'),
(324, 41, '_sku', ''),
(325, 41, '_regular_price', '11'),
(326, 41, '_sale_price', '10'),
(327, 41, '_sale_price_dates_from', ''),
(328, 41, '_sale_price_dates_to', ''),
(329, 41, 'total_sales', '0'),
(330, 41, '_tax_status', 'taxable'),
(331, 41, '_tax_class', ''),
(332, 41, '_manage_stock', 'no'),
(333, 41, '_backorders', 'no'),
(334, 41, '_sold_individually', 'no'),
(335, 41, '_weight', ''),
(336, 41, '_length', ''),
(337, 41, '_width', ''),
(338, 41, '_height', ''),
(339, 41, '_upsell_ids', 'a:0:{}'),
(340, 41, '_crosssell_ids', 'a:0:{}'),
(341, 41, '_purchase_note', ''),
(342, 41, '_default_attributes', 'a:0:{}'),
(343, 41, '_virtual', 'no'),
(344, 41, '_downloadable', 'no'),
(345, 41, '_product_image_gallery', ''),
(346, 41, '_download_limit', '-1'),
(347, 41, '_download_expiry', '-1'),
(348, 41, '_thumbnail_id', '23'),
(349, 41, '_stock', NULL),
(350, 41, '_stock_status', 'instock'),
(351, 41, '_wc_average_rating', '0'),
(352, 41, '_wc_rating_count', 'a:0:{}'),
(353, 41, '_wc_review_count', '0'),
(354, 41, '_downloadable_files', 'a:0:{}'),
(355, 41, '_product_attributes', 'a:0:{}'),
(356, 41, '_product_version', '3.2.6'),
(357, 41, '_price', '10'),
(358, 41, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(359, 41, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(360, 41, 'product_adjustment_hide_price_unregistered', 'no'),
(361, 41, 'eh_pricing_adjustment_product_price_user_role', ''),
(362, 41, 'product_adjustment_product_visibility_unregistered', 'no'),
(363, 41, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(364, 41, 'product_based_price_adjustment', 'no'),
(365, 41, 'product_price_adjustment', ''),
(366, 41, 'product_role_based_price', ''),
(367, 41, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(368, 41, '_edit_lock', '1521995892:1'),
(369, 42, '_sku', ''),
(370, 42, '_regular_price', '11'),
(371, 42, '_sale_price', '10'),
(372, 42, '_sale_price_dates_from', ''),
(373, 42, '_sale_price_dates_to', ''),
(374, 42, 'total_sales', '0'),
(375, 42, '_tax_status', 'taxable'),
(376, 42, '_tax_class', ''),
(377, 42, '_manage_stock', 'no'),
(378, 42, '_backorders', 'no'),
(379, 42, '_sold_individually', 'no'),
(380, 42, '_weight', ''),
(381, 42, '_length', ''),
(382, 42, '_width', ''),
(383, 42, '_height', ''),
(384, 42, '_upsell_ids', 'a:0:{}'),
(385, 42, '_crosssell_ids', 'a:0:{}'),
(386, 42, '_purchase_note', ''),
(387, 42, '_default_attributes', 'a:0:{}'),
(388, 42, '_virtual', 'no'),
(389, 42, '_downloadable', 'no'),
(390, 42, '_product_image_gallery', ''),
(391, 42, '_download_limit', '-1'),
(392, 42, '_download_expiry', '-1'),
(393, 42, '_thumbnail_id', '21'),
(394, 42, '_stock', NULL),
(395, 42, '_stock_status', 'instock'),
(396, 42, '_wc_average_rating', '0'),
(397, 42, '_wc_rating_count', 'a:0:{}'),
(398, 42, '_wc_review_count', '0'),
(399, 42, '_downloadable_files', 'a:0:{}'),
(400, 42, '_product_attributes', 'a:0:{}'),
(401, 42, '_product_version', '3.2.6'),
(402, 42, '_price', '10'),
(403, 42, 'product_adjustment_hide_addtocart_unregistered', 'no'),
(404, 42, 'eh_pricing_adjustment_product_addtocart_user_role', ''),
(405, 42, 'product_adjustment_hide_price_unregistered', 'no'),
(406, 42, 'eh_pricing_adjustment_product_price_user_role', ''),
(407, 42, 'product_adjustment_product_visibility_unregistered', 'no'),
(408, 42, 'eh_pricing_adjustment_product_visibility_user_role', ''),
(409, 42, 'product_based_price_adjustment', 'no'),
(410, 42, 'product_price_adjustment', ''),
(411, 42, 'product_role_based_price', ''),
(412, 42, '_wptc_theme_display_options', 'a:6:{s:16:\"wptc_menu_select\";s:2:\"-2\";s:19:\"wptc_title_checkbox\";s:3:\"off\";s:25:\"wptc_meta_header_checkbox\";s:3:\"off\";s:25:\"wptc_meta_footer_checkbox\";s:3:\"off\";s:29:\"wptc_disable_bullets_checkbox\";s:2:\"on\";s:26:\"wptc_header_image_override\";i:0;}'),
(413, 42, '_edit_lock', '1521996852:1'),
(414, 39, '_edit_last', '1'),
(415, 40, '_edit_last', '1'),
(416, 41, '_edit_last', '1'),
(417, 42, '_edit_last', '1'),
(418, 43, '_menu_item_type', 'custom'),
(419, 43, '_menu_item_menu_item_parent', '0'),
(420, 43, '_menu_item_object_id', '43'),
(421, 43, '_menu_item_object', 'custom'),
(422, 43, '_menu_item_target', ''),
(423, 43, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(424, 43, '_menu_item_xfn', ''),
(425, 43, '_menu_item_url', 'http://localhost/richmondmediahosting/'),
(427, 44, '_menu_item_type', 'post_type'),
(428, 44, '_menu_item_menu_item_parent', '0'),
(429, 44, '_menu_item_object_id', '9'),
(430, 44, '_menu_item_object', 'page'),
(431, 44, '_menu_item_target', ''),
(432, 44, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(433, 44, '_menu_item_xfn', ''),
(434, 44, '_menu_item_url', ''),
(436, 45, '_menu_item_type', 'post_type'),
(437, 45, '_menu_item_menu_item_parent', '0'),
(438, 45, '_menu_item_object_id', '10'),
(439, 45, '_menu_item_object', 'page'),
(440, 45, '_menu_item_target', ''),
(441, 45, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(442, 45, '_menu_item_xfn', ''),
(443, 45, '_menu_item_url', ''),
(445, 46, '_menu_item_type', 'post_type'),
(446, 46, '_menu_item_menu_item_parent', '0'),
(447, 46, '_menu_item_object_id', '11'),
(448, 46, '_menu_item_object', 'page'),
(449, 46, '_menu_item_target', ''),
(450, 46, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(451, 46, '_menu_item_xfn', ''),
(452, 46, '_menu_item_url', ''),
(454, 47, '_menu_item_type', 'post_type'),
(455, 47, '_menu_item_menu_item_parent', '0'),
(456, 47, '_menu_item_object_id', '2'),
(457, 47, '_menu_item_object', 'page'),
(458, 47, '_menu_item_target', ''),
(459, 47, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(460, 47, '_menu_item_xfn', ''),
(461, 47, '_menu_item_url', ''),
(463, 48, '_menu_item_type', 'post_type'),
(464, 48, '_menu_item_menu_item_parent', '0'),
(465, 48, '_menu_item_object_id', '8'),
(466, 48, '_menu_item_object', 'page'),
(467, 48, '_menu_item_target', ''),
(468, 48, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(469, 48, '_menu_item_xfn', ''),
(470, 48, '_menu_item_url', ''),
(472, 11, '_edit_lock', '1521996665:1'),
(473, 49, '_menu_item_type', 'post_type'),
(474, 49, '_menu_item_menu_item_parent', '0'),
(475, 49, '_menu_item_object_id', '9'),
(476, 49, '_menu_item_object', 'page'),
(477, 49, '_menu_item_target', ''),
(478, 49, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(479, 49, '_menu_item_xfn', ''),
(480, 49, '_menu_item_url', ''),
(482, 50, '_menu_item_type', 'post_type'),
(483, 50, '_menu_item_menu_item_parent', '0'),
(484, 50, '_menu_item_object_id', '8'),
(485, 50, '_menu_item_object', 'page'),
(486, 50, '_menu_item_target', ''),
(487, 50, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(488, 50, '_menu_item_xfn', ''),
(489, 50, '_menu_item_url', ''),
(491, 51, '_menu_item_type', 'post_type'),
(492, 51, '_menu_item_menu_item_parent', '0'),
(493, 51, '_menu_item_object_id', '2'),
(494, 51, '_menu_item_object', 'page'),
(495, 51, '_menu_item_target', ''),
(496, 51, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(497, 51, '_menu_item_xfn', ''),
(498, 51, '_menu_item_url', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2018-03-19 15:28:03', '2018-03-19 15:28:03', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2018-03-19 15:28:03', '2018-03-19 15:28:03', '', 0, 'http://localhost/richmondmediahosting/?p=1', 0, 'post', '', 1),
(2, 1, '2018-03-19 15:28:03', '2018-03-19 15:28:03', 'This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href=\"http://localhost/richmondmediahosting/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2018-03-19 15:28:03', '2018-03-19 15:28:03', '', 0, 'http://localhost/richmondmediahosting/?page_id=2', 0, 'page', '', 0),
(4, 1, '2018-03-19 15:36:14', '2018-03-19 15:36:14', '{\"theme_css\":\"ui-lightness\",\"theme_name\":\"UI Lightness\",\"center_form\":\"\",\"form_width\":\"100%\",\"form_align\":\"left\",\"direction\":\"ltr\",\"fieldset\":\"0px\",\"fieldset_color\":\"000000\",\"fieldset_padding\":\"0 0 15px 0\",\"fieldset_bg_color\":\"\",\"title_size\":\"20px\",\"title_color\":\"444444\",\"title_margin_top\":\"10px\",\"title_margin_bottom\":\"10px\",\"form_desc_size\":\"14px\",\"form_desc_color\":\"666666\",\"form_desc_margin_top\":\"10px\",\"form_desc_margin_bottom\":\"25px\",\"font\":\"\\\"Lucida Grande\\\",\\\"Lucida Sans Unicode\\\",Tahoma,sans-serif\",\"font_size\":\"14px\",\"label_color\":\"444444\",\"weight\":\"bold\",\"position\":\"none\",\"align\":\"left\",\"width\":\"150px\",\"required_color\":\"B94A48\",\"required_weight\":\"bold\",\"label_padding\":\"0 0 3px 0\",\"description_font_size\":\"12px\",\"description_color\":\"666666\",\"description_weight\":\"normal\",\"description_style\":\"normal\",\"description_align\":\"left\",\"description_margin\":\"0\",\"field_font_size\":\"14px\",\"field_height\":\"32px\",\"line_height\":\"normal\",\"field_width\":\"100%\",\"auto_width\":\"\",\"field_pad\":\"6px 10px\",\"field_margin\":\"20px\",\"field_weight\":\"normal\",\"text_color\":\"555555\",\"border_color\":\"cccccc\",\"field_border_width\":\"1px\",\"field_border_style\":\"solid\",\"bg_color\":\"ffffff\",\"remove_box_shadow\":\"\",\"bg_color_active\":\"ffffff\",\"border_color_active\":\"66afe9\",\"remove_box_shadow_active\":\"\",\"text_color_error\":\"444444\",\"bg_color_error\":\"ffffff\",\"border_color_error\":\"B94A48\",\"border_width_error\":\"1px\",\"border_style_error\":\"solid\",\"bg_color_disabled\":\"ffffff\",\"border_color_disabled\":\"E5E5E5\",\"text_color_disabled\":\"A1A1A1\",\"radio_align\":\"block\",\"check_align\":\"block\",\"check_font_size\":\"13px\",\"check_label_color\":\"444444\",\"check_weight\":\"normal\",\"section_font_size\":\"18px\",\"section_color\":\"444444\",\"section_weight\":\"bold\",\"section_pad\":\"15px 0 3px 0\",\"section_mar_top\":\"15px\",\"section_mar_bottom\":\"12px\",\"section_bg_color\":\"\",\"section_border_color\":\"e8e8e8\",\"section_border_width\":\"2px\",\"section_border_style\":\"solid\",\"section_border_loc\":\"-top\",\"collapse_icon\":\"6\",\"collapse_pos\":\"after\",\"repeat_icon\":\"1\",\"submit_style\":\"\",\"submit_font_size\":\"14px\",\"submit_width\":\"auto\",\"submit_height\":\"auto\",\"submit_bg_color\":\"ffffff\",\"submit_border_color\":\"cccccc\",\"submit_border_width\":\"1px\",\"submit_text_color\":\"444444\",\"submit_weight\":\"normal\",\"submit_border_radius\":\"4px\",\"submit_bg_img\":\"\",\"submit_margin\":\"10px\",\"submit_padding\":\"6px 11px\",\"submit_shadow_color\":\"eeeeee\",\"submit_hover_bg_color\":\"efefef\",\"submit_hover_color\":\"444444\",\"submit_hover_border_color\":\"cccccc\",\"submit_active_bg_color\":\"efefef\",\"submit_active_color\":\"444444\",\"submit_active_border_color\":\"cccccc\",\"border_radius\":\"4px\",\"error_bg\":\"F2DEDE\",\"error_border\":\"EBCCD1\",\"error_text\":\"B94A48\",\"error_font_size\":\"14px\",\"success_bg_color\":\"DFF0D8\",\"success_border_color\":\"D6E9C6\",\"success_text_color\":\"468847\",\"success_font_size\":\"14px\",\"important_style\":\"\",\"progress_bg_color\":\"dddddd\",\"progress_active_color\":\"ffffff\",\"progress_active_bg_color\":\"008ec2\",\"progress_color\":\"ffffff\",\"progress_border_color\":\"dfdfdf\",\"progress_border_size\":\"2px\",\"progress_size\":\"30px\",\"custom_css\":\"\"}', 'Formidable Style', '', 'publish', 'closed', 'closed', '', 'formidable-style', '', '', '2018-03-19 15:36:14', '2018-03-19 15:36:14', '', 0, 'http://localhost/richmondmediahosting/2018/03/19/formidable-style/', 1, 'frm_styles', '', 0),
(5, 1, '2015-04-06 17:18:12', '2015-04-06 17:18:12', '{\"email_to\":\"[admin_email]\",\"cc\":\"\",\"bcc\":\"\",\"reply_to\":\"\",\"from\":\"[sitename] <[admin_email]>\",\"email_subject\":\"\",\"email_message\":\"[default-message]\",\"event\":[\"create\"],\"conditions\":{\"send_stop\":\"send\",\"any_all\":\"any\"}}', 'Email Notification', 'email', 'publish', 'open', 'open', '', '1_email_1', '', '', '2015-04-06 17:18:12', '2015-04-06 17:18:12', '', 0, 'http://localhost/richmondmediahosting/2015/04/06/1_email_1/', 1, 'frm_form_actions', '', 0),
(6, 1, '2015-04-06 17:18:12', '2015-04-06 17:18:12', '{\"email_to\":\"[admin_email]\",\"cc\":\"\",\"bcc\":\"\",\"reply_to\":\"\",\"from\":\"[sitename] <[admin_email]>\",\"email_subject\":\"\",\"email_message\":\"[default-message]\",\"event\":[\"create\"],\"conditions\":{\"send_stop\":\"send\",\"any_all\":\"any\"},\"inc_user_info\":\"0\",\"plain_text\":\"0\"}', 'Email Notification', 'email', 'publish', 'open', 'open', '', '1_email_1-2', '', '', '2015-04-06 17:18:12', '2015-04-06 17:18:12', '', 0, 'http://localhost/richmondmediahosting/2015/04/06/1_email_1/', 2, 'frm_form_actions', '', 0),
(7, 1, '2018-03-19 15:37:58', '2018-03-19 15:37:58', '', '1', '1', 'publish', 'closed', 'closed', '', '1', '', '', '2018-03-19 15:37:58', '2018-03-19 15:37:58', '', 0, 'http://localhost/richmondmediahosting/2018/03/19/1/', 0, 'turbo-sidebar-cpt', '', 0),
(8, 1, '2018-03-19 15:45:25', '2018-03-19 15:45:25', '', 'Shop', '', 'publish', 'closed', 'closed', '', 'shop', '', '', '2018-03-19 15:45:25', '2018-03-19 15:45:25', '', 0, 'http://localhost/richmondmediahosting/shop/', 0, 'page', '', 0),
(9, 1, '2018-03-19 15:45:25', '2018-03-19 15:45:25', '[woocommerce_cart]', 'Cart', '', 'publish', 'closed', 'closed', '', 'cart', '', '', '2018-03-19 15:45:25', '2018-03-19 15:45:25', '', 0, 'http://localhost/richmondmediahosting/cart/', 0, 'page', '', 0),
(10, 1, '2018-03-19 15:45:25', '2018-03-19 15:45:25', '[woocommerce_checkout]', 'Checkout', '', 'publish', 'closed', 'closed', '', 'checkout', '', '', '2018-03-19 15:45:25', '2018-03-19 15:45:25', '', 0, 'http://localhost/richmondmediahosting/checkout/', 0, 'page', '', 0),
(11, 1, '2018-03-19 15:45:25', '2018-03-19 15:45:25', '[woocommerce_my_account]', 'My account', '', 'publish', 'closed', 'closed', '', 'my-account', '', '', '2018-03-19 15:45:25', '2018-03-19 15:45:25', '', 0, 'http://localhost/richmondmediahosting/my-account/', 0, 'page', '', 0),
(14, 1, '2018-03-25 16:05:25', '2018-03-25 16:05:25', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 1', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-1', '', '', '2018-03-25 16:30:55', '2018-03-25 16:30:55', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=14', 0, 'product', '', 0),
(15, 1, '2018-03-25 16:00:05', '0000-00-00 00:00:00', '', 'AUTO-DRAFT', '', 'auto-draft', 'open', 'closed', '', '', '', '', '2018-03-25 16:00:05', '0000-00-00 00:00:00', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&p=15', 0, 'product', '', 0),
(16, 1, '2018-03-25 16:01:53', '2018-03-25 16:01:53', '', 'Chrysanthemum', '', 'inherit', 'open', 'closed', '', 'chrysanthemum', '', '', '2018-03-25 16:01:53', '2018-03-25 16:01:53', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Chrysanthemum.jpg', 0, 'attachment', 'image/jpeg', 0),
(17, 1, '2018-03-25 16:01:56', '2018-03-25 16:01:56', '', 'Desert', '', 'inherit', 'open', 'closed', '', 'desert', '', '', '2018-03-25 16:01:56', '2018-03-25 16:01:56', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Desert.jpg', 0, 'attachment', 'image/jpeg', 0),
(18, 1, '2018-03-25 16:01:59', '2018-03-25 16:01:59', '', 'Hydrangeas', '', 'inherit', 'open', 'closed', '', 'hydrangeas', '', '', '2018-03-25 16:01:59', '2018-03-25 16:01:59', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Hydrangeas.jpg', 0, 'attachment', 'image/jpeg', 0),
(19, 1, '2018-03-25 16:02:02', '2018-03-25 16:02:02', '', 'Jellyfish', '', 'inherit', 'open', 'closed', '', 'jellyfish', '', '', '2018-03-25 16:02:02', '2018-03-25 16:02:02', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Jellyfish.jpg', 0, 'attachment', 'image/jpeg', 0),
(20, 1, '2018-03-25 16:02:05', '2018-03-25 16:02:05', '', 'Koala', '', 'inherit', 'open', 'closed', '', 'koala', '', '', '2018-03-25 16:02:05', '2018-03-25 16:02:05', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Koala.jpg', 0, 'attachment', 'image/jpeg', 0),
(21, 1, '2018-03-25 16:02:08', '2018-03-25 16:02:08', '', 'Lighthouse', '', 'inherit', 'open', 'closed', '', 'lighthouse', '', '', '2018-03-25 16:02:08', '2018-03-25 16:02:08', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Lighthouse.jpg', 0, 'attachment', 'image/jpeg', 0),
(22, 1, '2018-03-25 16:02:11', '2018-03-25 16:02:11', '', 'Penguins', '', 'inherit', 'open', 'closed', '', 'penguins', '', '', '2018-03-25 16:02:11', '2018-03-25 16:02:11', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Penguins.jpg', 0, 'attachment', 'image/jpeg', 0),
(23, 1, '2018-03-25 16:02:14', '2018-03-25 16:02:14', '', 'Tulips', '', 'inherit', 'open', 'closed', '', 'tulips', '', '', '2018-03-25 16:02:14', '2018-03-25 16:02:14', '', 14, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/Tulips.jpg', 0, 'attachment', 'image/jpeg', 0),
(30, 1, '2018-03-25 16:06:21', '2018-03-25 16:06:21', '', 'product (1)', '', 'inherit', 'open', 'closed', '', 'product-1-3', '', '', '2018-03-25 16:06:21', '2018-03-25 16:06:21', '', 0, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/product-1-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(31, 1, '2018-03-25 16:06:23', '2018-03-25 16:06:23', '', 'product (1)', '', 'inherit', 'open', 'closed', '', 'product-1-4', '', '', '2018-03-25 16:06:23', '2018-03-25 16:06:23', '', 0, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/product-1-1.png', 0, 'attachment', 'image/png', 0),
(32, 1, '2018-03-25 16:06:25', '2018-03-25 16:06:25', '', 'product (2)', '', 'inherit', 'open', 'closed', '', 'product-2-2', '', '', '2018-03-25 16:06:25', '2018-03-25 16:06:25', '', 0, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/product-2-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(33, 1, '2018-03-25 16:06:27', '2018-03-25 16:06:27', '', 'product (3)', '', 'inherit', 'open', 'closed', '', 'product-3-2', '', '', '2018-03-25 16:06:27', '2018-03-25 16:06:27', '', 0, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/product-3-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(34, 1, '2018-03-25 16:06:29', '2018-03-25 16:06:29', '', 'product (4)', '', 'inherit', 'open', 'closed', '', 'product-4-2', '', '', '2018-03-25 16:06:29', '2018-03-25 16:06:29', '', 0, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/product-4-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(35, 1, '2018-03-25 16:06:30', '2018-03-25 16:06:30', '', 'product (5)', '', 'inherit', 'open', 'closed', '', 'product-5-2', '', '', '2018-03-25 16:06:30', '2018-03-25 16:06:30', '', 0, 'http://localhost/richmondmediahosting/wp-content/uploads/2018/03/product-5-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(36, 1, '2018-03-25 16:32:04', '2018-03-25 16:32:04', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 2', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-2', '', '', '2018-03-25 16:32:50', '2018-03-25 16:32:50', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=36', 0, 'product', '', 0),
(37, 1, '2018-03-25 16:33:11', '2018-03-25 16:33:11', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 3', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-3', '', '', '2018-03-25 16:33:29', '2018-03-25 16:33:29', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=37', 0, 'product', '', 0),
(38, 1, '2018-03-25 16:34:39', '2018-03-25 16:34:39', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 4', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-4', '', '', '2018-03-25 16:35:58', '2018-03-25 16:35:58', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=38', 0, 'product', '', 0),
(39, 1, '2018-03-25 16:36:16', '2018-03-25 16:36:16', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 5', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-5', '', '', '2018-03-25 16:37:19', '2018-03-25 16:37:19', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=39', 0, 'product', '', 0),
(40, 1, '2018-03-25 16:36:20', '2018-03-25 16:36:20', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 6', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-6', '', '', '2018-03-25 16:37:22', '2018-03-25 16:37:22', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=40', 0, 'product', '', 0),
(41, 1, '2018-03-25 16:36:26', '2018-03-25 16:36:26', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 7', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-7', '', '', '2018-03-25 16:38:08', '2018-03-25 16:38:08', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=41', 0, 'product', '', 0),
(42, 1, '2018-03-25 16:36:34', '2018-03-25 16:36:34', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, Advanced WordPress Reset, Amp, Asgaros Forum, BAN Users, BMT - No Right Click, Broken Link Checker, Cerber Limit Login Attempts, Change DB Prefix, Comet Cache, Cssor, Download Plugins and Themes from Dashboard, Duplicator, Easy Featured Images, Easy Google Fonts, Event CLNDR, Featured Image Generator, Fonto - Web Fonts Manager, Hide Show Comment, Highlight Search Terms, Image Effect CK, InfiniteWP Client, Inline Related Posts, Max Mega Menu, Microthemer Lite, My Rules - The Front-End Access Manager, Nav Menu Roles, Nino Social Connect, Page scroll to id, Plugin Inspector, Plugin Organizer, Plugin Toggle, Price by User Role for WooCommerce, QT CSS, Query Monitor, RS System Diagnostic, Regenerate Thumbnails, ResponsiveVoice Text To Speech, Sale Counter, Shortcoder, Simple Cache, Sticky Menu or Anything on Scroll, TablePress, Theme Inspector, UpdraftPlus Backup and Restoration, User ID Changer, User Switching, Visual Form Builder, WC Product Tabs Plus, WC Vendors, WD Google Maps, WP Canvas - Gallery, WP Canvas - Shortcodes, WP Editor Widget, WP Media Categories, WP Simple Related Posts, WooCommerce Digital Goods Checkout, WooCommerce External Product New Tab, WooCommerce Personal Discount, WooCommerce Shortcodes, WordPress Database Administrator, Yoast SEO, fx Email Log, fx Share and grant-download-permissions-for-past-woocommerce-orders-master.', 'product 8', 'This theme recommends the following plugins: 5 QT Sliders, 6 QT Page Builders, A Shortcode Tester, Admin Bar User Switching, Advanced Database Cleaner, Advanced Image Styles, ', 'publish', 'open', 'closed', '', 'product-8', '', '', '2018-03-25 16:38:30', '2018-03-25 16:38:30', '', 0, 'http://localhost/richmondmediahosting/?post_type=product&#038;p=42', 0, 'product', '', 0),
(43, 1, '2018-03-25 16:49:10', '2018-03-25 16:49:10', '', 'Home', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2018-03-25 17:55:22', '2018-03-25 17:55:22', '', 0, 'http://localhost/richmondmediahosting/?p=43', 1, 'nav_menu_item', '', 0),
(44, 1, '2018-03-25 16:49:11', '2018-03-25 16:49:11', ' ', '', '', 'publish', 'closed', 'closed', '', '44', '', '', '2018-03-25 17:55:22', '2018-03-25 17:55:22', '', 0, 'http://localhost/richmondmediahosting/?p=44', 2, 'nav_menu_item', '', 0),
(45, 1, '2018-03-25 16:49:11', '2018-03-25 16:49:11', ' ', '', '', 'publish', 'closed', 'closed', '', '45', '', '', '2018-03-25 17:55:22', '2018-03-25 17:55:22', '', 0, 'http://localhost/richmondmediahosting/?p=45', 3, 'nav_menu_item', '', 0),
(46, 1, '2018-03-25 16:49:11', '2018-03-25 16:49:11', ' ', '', '', 'publish', 'closed', 'closed', '', '46', '', '', '2018-03-25 17:55:22', '2018-03-25 17:55:22', '', 0, 'http://localhost/richmondmediahosting/?p=46', 4, 'nav_menu_item', '', 0),
(47, 1, '2018-03-25 16:49:11', '2018-03-25 16:49:11', ' ', '', '', 'publish', 'closed', 'closed', '', '47', '', '', '2018-03-25 17:55:22', '2018-03-25 17:55:22', '', 0, 'http://localhost/richmondmediahosting/?p=47', 5, 'nav_menu_item', '', 0),
(48, 1, '2018-03-25 16:49:12', '2018-03-25 16:49:12', ' ', '', '', 'publish', 'closed', 'closed', '', '48', '', '', '2018-03-25 17:55:22', '2018-03-25 17:55:22', '', 0, 'http://localhost/richmondmediahosting/?p=48', 6, 'nav_menu_item', '', 0),
(49, 1, '2018-03-25 17:57:10', '2018-03-25 17:57:10', ' ', '', '', 'publish', 'closed', 'closed', '', '49', '', '', '2018-03-25 17:57:10', '2018-03-25 17:57:10', '', 0, 'http://localhost/richmondmediahosting/?p=49', 1, 'nav_menu_item', '', 0),
(50, 1, '2018-03-25 17:57:10', '2018-03-25 17:57:10', ' ', '', '', 'publish', 'closed', 'closed', '', '50', '', '', '2018-03-25 17:57:10', '2018-03-25 17:57:10', '', 0, 'http://localhost/richmondmediahosting/?p=50', 2, 'nav_menu_item', '', 0),
(51, 1, '2018-03-25 17:57:10', '2018-03-25 17:57:10', ' ', '', '', 'publish', 'closed', 'closed', '', '51', '', '', '2018-03-25 17:57:10', '2018-03-25 17:57:10', '', 0, 'http://localhost/richmondmediahosting/?p=51', 3, 'nav_menu_item', '', 0),
(52, 1, '2018-03-27 18:28:14', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2018-03-27 18:28:14', '0000-00-00 00:00:00', '', 0, 'http://localhost/richmondmediahosting/?p=52', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_snippets`
--

DROP TABLE IF EXISTS `wp_snippets`;
CREATE TABLE `wp_snippets` (
  `id` bigint(20) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `code` longtext NOT NULL,
  `tags` longtext NOT NULL,
  `scope` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'simple', 'simple', 0),
(3, 'grouped', 'grouped', 0),
(4, 'variable', 'variable', 0),
(5, 'external', 'external', 0),
(6, 'exclude-from-search', 'exclude-from-search', 0),
(7, 'exclude-from-catalog', 'exclude-from-catalog', 0),
(8, 'featured', 'featured', 0),
(9, 'outofstock', 'outofstock', 0),
(10, 'rated-1', 'rated-1', 0),
(11, 'rated-2', 'rated-2', 0),
(12, 'rated-3', 'rated-3', 0),
(13, 'rated-4', 'rated-4', 0),
(14, 'rated-5', 'rated-5', 0),
(15, 'Users Menu', 'users-menu', 0),
(16, 'Guest Menu', 'guest-menu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(14, 2, 0),
(36, 2, 0),
(37, 2, 0),
(38, 2, 0),
(39, 2, 0),
(40, 2, 0),
(41, 2, 0),
(42, 2, 0),
(43, 15, 0),
(44, 15, 0),
(45, 15, 0),
(46, 15, 0),
(47, 15, 0),
(48, 15, 0),
(49, 16, 0),
(50, 16, 0),
(51, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'product_type', '', 0, 8),
(3, 3, 'product_type', '', 0, 0),
(4, 4, 'product_type', '', 0, 0),
(5, 5, 'product_type', '', 0, 0),
(6, 6, 'product_visibility', '', 0, 0),
(7, 7, 'product_visibility', '', 0, 0),
(8, 8, 'product_visibility', '', 0, 0),
(9, 9, 'product_visibility', '', 0, 0),
(10, 10, 'product_visibility', '', 0, 0),
(11, 11, 'product_visibility', '', 0, 0),
(12, 12, 'product_visibility', '', 0, 0),
(13, 13, 'product_visibility', '', 0, 0),
(14, 14, 'product_visibility', '', 0, 0),
(15, 15, 'nav_menu', '', 0, 6),
(16, 16, 'nav_menu', '', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:7:{s:13:\"administrator\";b:1;s:14:\"frm_view_forms\";b:1;s:14:\"frm_edit_forms\";b:1;s:16:\"frm_delete_forms\";b:1;s:19:\"frm_change_settings\";b:1;s:16:\"frm_view_entries\";b:1;s:18:\"frm_delete_entries\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:5:{s:64:\"e5c4abf6cdb3e6865caabe94a08c92498443a20fb83cc2be58260864fc2e82e1\";a:4:{s:10:\"expiration\";i:1522682896;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36\";s:5:\"login\";i:1521473296;}s:64:\"b9b2960e7b1f4ba15d1c64be5e32cbdea33bf5ec9809b672dfe94f523a37501f\";a:4:{s:10:\"expiration\";i:1522432472;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36\";s:5:\"login\";i:1522259672;}s:64:\"d40c33ec7b02d0cfbc7e15bb7130e22faf0aeb1953f9fb2ffbc76a5a0205005c\";a:4:{s:10:\"expiration\";i:1522432478;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36\";s:5:\"login\";i:1522259678;}s:64:\"384fea4c0e18c62a3254eeeab3518a62d5a7896c58b4af88874f6ad8b98f7169\";a:4:{s:10:\"expiration\";i:1522432483;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36\";s:5:\"login\";i:1522259683;}s:64:\"135c73c2dcec6a9ac56e38d5c1c7e4c734fcbc4bab0e1f0c2418a9c796d78c81\";a:4:{s:10:\"expiration\";i:1522432696;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36\";s:5:\"login\";i:1522259896;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '52'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:2:\"::\";}'),
(19, 1, 'frm_ignore_tour', '1'),
(20, 1, '_woocommerce_persistent_cart_1', 'a:1:{s:4:\"cart\";a:0:{}}'),
(21, 1, 'wp_user-settings', 'editor=html&libraryContent=browse'),
(22, 1, 'wp_user-settings-time', '1521993926'),
(23, 1, 'tgmpa_dismissed_notice_tgmpa', '1'),
(24, 1, 'meta-box-order_product', 'a:4:{s:15:\"acf_after_title\";s:0:\"\";s:4:\"side\";s:127:\"map-posts-search,submitdiv,postimagediv,product_catdiv,tagsdiv-product_tag,wptc_woocommerce_meta_box,woocommerce-product-images\";s:6:\"normal\";s:66:\"custom-css,woocommerce-product-data,postcustom,slugdiv,postexcerpt\";s:8:\"advanced\";s:0:\"\";}'),
(25, 1, 'screen_layout_product', '2'),
(26, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),
(27, 1, 'metaboxhidden_nav-menus', 'a:4:{i:0;s:21:\"add-post-type-product\";i:1;s:12:\"add-post_tag\";i:2;s:15:\"add-product_cat\";i:3;s:15:\"add-product_tag\";}'),
(28, 1, 'nav_menu_recently_edited', '16'),
(29, 1, 'last_login', '2018-03-28 18:15:27'),
(30, 1, 'user-notes-note', ''),
(31, 1, 'billing_first_name', ''),
(32, 1, 'billing_last_name', ''),
(33, 1, 'billing_company', ''),
(34, 1, 'billing_address_1', ''),
(35, 1, 'billing_address_2', ''),
(36, 1, 'billing_city', ''),
(37, 1, 'billing_postcode', ''),
(38, 1, 'billing_country', ''),
(39, 1, 'billing_state', ''),
(40, 1, 'billing_phone', ''),
(41, 1, 'billing_email', 'info@wordpress.com'),
(42, 1, 'shipping_first_name', ''),
(43, 1, 'shipping_last_name', ''),
(44, 1, 'shipping_company', ''),
(45, 1, 'shipping_address_1', ''),
(46, 1, 'shipping_address_2', ''),
(47, 1, 'shipping_city', ''),
(48, 1, 'shipping_postcode', ''),
(49, 1, 'shipping_country', ''),
(50, 1, 'shipping_state', ''),
(51, 1, 'last_update', '1522259895');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BOfovv8ic3WOl8Ng7W55IlIV5VfWlI/', 'admin', 'info@wordpress.com', '', '2018-03-19 15:28:02', '', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_api_keys`
--

DROP TABLE IF EXISTS `wp_woocommerce_api_keys`;
CREATE TABLE `wp_woocommerce_api_keys` (
  `key_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `permissions` varchar(10) NOT NULL,
  `consumer_key` char(64) NOT NULL,
  `consumer_secret` char(43) NOT NULL,
  `nonces` longtext,
  `truncated_key` char(7) NOT NULL,
  `last_access` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_attribute_taxonomies`
--

DROP TABLE IF EXISTS `wp_woocommerce_attribute_taxonomies`;
CREATE TABLE `wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_label` varchar(200) DEFAULT NULL,
  `attribute_type` varchar(20) NOT NULL,
  `attribute_orderby` varchar(20) NOT NULL,
  `attribute_public` int(1) NOT NULL DEFAULT '1'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_downloadable_product_permissions`
--

DROP TABLE IF EXISTS `wp_woocommerce_downloadable_product_permissions`;
CREATE TABLE `wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `download_id` varchar(32) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `order_key` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `downloads_remaining` varchar(9) DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_log`
--

DROP TABLE IF EXISTS `wp_woocommerce_log`;
CREATE TABLE `wp_woocommerce_log` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  `context` longtext
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_order_itemmeta`
--

DROP TABLE IF EXISTS `wp_woocommerce_order_itemmeta`;
CREATE TABLE `wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_order_items`
--

DROP TABLE IF EXISTS `wp_woocommerce_order_items`;
CREATE TABLE `wp_woocommerce_order_items` (
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_name` text NOT NULL,
  `order_item_type` varchar(200) NOT NULL DEFAULT '',
  `order_id` bigint(20) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_payment_tokenmeta`
--

DROP TABLE IF EXISTS `wp_woocommerce_payment_tokenmeta`;
CREATE TABLE `wp_woocommerce_payment_tokenmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `payment_token_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_payment_tokens`
--

DROP TABLE IF EXISTS `wp_woocommerce_payment_tokens`;
CREATE TABLE `wp_woocommerce_payment_tokens` (
  `token_id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(200) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_sessions`
--

DROP TABLE IF EXISTS `wp_woocommerce_sessions`;
CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `session_key` char(32) NOT NULL,
  `session_value` longtext NOT NULL,
  `session_expiry` bigint(20) UNSIGNED NOT NULL
) ;

--
-- Dumping data for table `wp_woocommerce_sessions`
--

INSERT INTO `wp_woocommerce_sessions` (`session_id`, `session_key`, `session_value`, `session_expiry`) VALUES
(11, '1', 'a:7:{s:8:\"customer\";s:668:\"a:25:{s:2:\"id\";i:1;s:8:\"postcode\";s:0:\"\";s:4:\"city\";s:0:\"\";s:9:\"address_1\";s:0:\"\";s:7:\"address\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:5:\"state\";s:0:\"\";s:7:\"country\";s:2:\"BD\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:0:\"\";s:16:\"shipping_country\";s:2:\"BD\";s:13:\"is_vat_exempt\";b:0;s:19:\"calculated_shipping\";b:0;s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:0:\"\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:5:\"email\";s:18:\"info@wordpress.com\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";s:4:\"cart\";s:6:\"a:0:{}\";s:11:\"cart_totals\";s:367:\"a:15:{s:8:\"subtotal\";i:0;s:12:\"subtotal_tax\";i:0;s:14:\"shipping_total\";i:0;s:12:\"shipping_tax\";i:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";i:0;s:12:\"discount_tax\";i:0;s:19:\"cart_contents_total\";i:0;s:17:\"cart_contents_tax\";i:0;s:19:\"cart_contents_taxes\";a:0:{}s:9:\"fee_total\";i:0;s:7:\"fee_tax\";i:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";i:0;s:9:\"total_tax\";i:0;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";}', 1522433842);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zones`
--

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zones`;
CREATE TABLE `wp_woocommerce_shipping_zones` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `zone_name` varchar(200) NOT NULL,
  `zone_order` bigint(20) UNSIGNED NOT NULL
) ;

--
-- Dumping data for table `wp_woocommerce_shipping_zones`
--

INSERT INTO `wp_woocommerce_shipping_zones` (`zone_id`, `zone_name`, `zone_order`) VALUES
(1, 'Bangladesh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zone_locations`
--

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_locations`;
CREATE TABLE `wp_woocommerce_shipping_zone_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) NOT NULL,
  `location_type` varchar(40) NOT NULL
) ;

--
-- Dumping data for table `wp_woocommerce_shipping_zone_locations`
--

INSERT INTO `wp_woocommerce_shipping_zone_locations` (`location_id`, `zone_id`, `location_code`, `location_type`) VALUES
(1, 1, 'BD', 'country');

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zone_methods`
--

DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_methods`;
CREATE TABLE `wp_woocommerce_shipping_zone_methods` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `instance_id` bigint(20) UNSIGNED NOT NULL,
  `method_id` varchar(200) NOT NULL,
  `method_order` bigint(20) UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1'
) ;

--
-- Dumping data for table `wp_woocommerce_shipping_zone_methods`
--

INSERT INTO `wp_woocommerce_shipping_zone_methods` (`zone_id`, `instance_id`, `method_id`, `method_order`, `is_enabled`) VALUES
(1, 1, 'flat_rate', 1, 1),
(0, 2, 'flat_rate', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_tax_rates`
--

DROP TABLE IF EXISTS `wp_woocommerce_tax_rates`;
CREATE TABLE `wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_country` varchar(2) NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) NOT NULL DEFAULT '',
  `tax_rate` varchar(8) NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT '0',
  `tax_rate_shipping` int(1) NOT NULL DEFAULT '1',
  `tax_rate_order` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_class` varchar(200) NOT NULL DEFAULT ''
) ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_tax_rate_locations`
--

DROP TABLE IF EXISTS `wp_woocommerce_tax_rate_locations`;
CREATE TABLE `wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) NOT NULL,
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `location_type` varchar(40) NOT NULL
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quickbooks_config`
--
ALTER TABLE `quickbooks_config`
  ADD PRIMARY KEY (`quickbooks_config_id`);

--
-- Indexes for table `quickbooks_log`
--
ALTER TABLE `quickbooks_log`
  ADD PRIMARY KEY (`quickbooks_log_id`),
  ADD KEY `quickbooks_ticket_id` (`quickbooks_ticket_id`),
  ADD KEY `batch` (`batch`);

--
-- Indexes for table `quickbooks_oauth`
--
ALTER TABLE `quickbooks_oauth`
  ADD PRIMARY KEY (`quickbooks_oauth_id`);

--
-- Indexes for table `quickbooks_queue`
--
ALTER TABLE `quickbooks_queue`
  ADD PRIMARY KEY (`quickbooks_queue_id`),
  ADD KEY `quickbooks_ticket_id` (`quickbooks_ticket_id`),
  ADD KEY `priority` (`priority`),
  ADD KEY `qb_username` (`qb_username`,`qb_action`,`ident`,`qb_status`),
  ADD KEY `qb_status` (`qb_status`);

--
-- Indexes for table `quickbooks_recur`
--
ALTER TABLE `quickbooks_recur`
  ADD PRIMARY KEY (`quickbooks_recur_id`),
  ADD KEY `qb_username` (`qb_username`,`qb_action`,`ident`),
  ADD KEY `priority` (`priority`);

--
-- Indexes for table `quickbooks_ticket`
--
ALTER TABLE `quickbooks_ticket`
  ADD PRIMARY KEY (`quickbooks_ticket_id`),
  ADD KEY `ticket` (`ticket`);

--
-- Indexes for table `quickbooks_user`
--
ALTER TABLE `quickbooks_user`
  ADD PRIMARY KEY (`qb_username`);

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10)),
  ADD KEY `woo_idx_comment_type` (`comment_type`);

--
-- Indexes for table `wp_frm_fields`
--
ALTER TABLE `wp_frm_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `field_key` (`field_key`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `wp_frm_forms`
--
ALTER TABLE `wp_frm_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_key` (`form_key`);

--
-- Indexes for table `wp_frm_items`
--
ALTER TABLE `wp_frm_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_key` (`item_key`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_item_id` (`parent_item_id`);

--
-- Indexes for table `wp_frm_item_metas`
--
ALTER TABLE `wp_frm_item_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_id` (`field_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_mappress_maps`
--
ALTER TABLE `wp_mappress_maps`
  ADD PRIMARY KEY (`mapid`);

--
-- Indexes for table `wp_mappress_posts`
--
ALTER TABLE `wp_mappress_posts`
  ADD PRIMARY KEY (`postid`,`mapid`);

--
-- Indexes for table `wp_masterslider_options`
--
ALTER TABLE `wp_masterslider_options`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wp_masterslider_sliders`
--
ALTER TABLE `wp_masterslider_sliders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `date_created` (`date_created`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_snippets`
--
ALTER TABLE `wp_snippets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `wp_woocommerce_api_keys`
--
ALTER TABLE `wp_woocommerce_api_keys`
  ADD PRIMARY KEY (`key_id`),
  ADD KEY `consumer_key` (`consumer_key`),
  ADD KEY `consumer_secret` (`consumer_secret`);

--
-- Indexes for table `wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `wp_woocommerce_attribute_taxonomies`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `attribute_name` (`attribute_name`(20));

--
-- Indexes for table `wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `wp_woocommerce_downloadable_product_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`(16),`download_id`),
  ADD KEY `download_order_product` (`download_id`,`order_id`,`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `wp_woocommerce_log`
--
ALTER TABLE `wp_woocommerce_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `wp_woocommerce_order_itemmeta`
--
ALTER TABLE `wp_woocommerce_order_itemmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `meta_key` (`meta_key`(32));

--
-- Indexes for table `wp_woocommerce_order_items`
--
ALTER TABLE `wp_woocommerce_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `wp_woocommerce_payment_tokenmeta`
--
ALTER TABLE `wp_woocommerce_payment_tokenmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `payment_token_id` (`payment_token_id`),
  ADD KEY `meta_key` (`meta_key`(32));

--
-- Indexes for table `wp_woocommerce_payment_tokens`
--
ALTER TABLE `wp_woocommerce_payment_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_woocommerce_sessions`
--
ALTER TABLE `wp_woocommerce_sessions`
  ADD PRIMARY KEY (`session_key`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `wp_woocommerce_shipping_zones`
--
ALTER TABLE `wp_woocommerce_shipping_zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `wp_woocommerce_shipping_zone_locations`
--
ALTER TABLE `wp_woocommerce_shipping_zone_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `location_type_code` (`location_type`(10),`location_code`(20));

--
-- Indexes for table `wp_woocommerce_shipping_zone_methods`
--
ALTER TABLE `wp_woocommerce_shipping_zone_methods`
  ADD PRIMARY KEY (`instance_id`);

--
-- Indexes for table `wp_woocommerce_tax_rates`
--
ALTER TABLE `wp_woocommerce_tax_rates`
  ADD PRIMARY KEY (`tax_rate_id`),
  ADD KEY `tax_rate_country` (`tax_rate_country`),
  ADD KEY `tax_rate_state` (`tax_rate_state`(2)),
  ADD KEY `tax_rate_class` (`tax_rate_class`(10)),
  ADD KEY `tax_rate_priority` (`tax_rate_priority`);

--
-- Indexes for table `wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `wp_woocommerce_tax_rate_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tax_rate_id` (`tax_rate_id`),
  ADD KEY `location_type_code` (`location_type`(10),`location_code`(20));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quickbooks_config`
--
ALTER TABLE `quickbooks_config`
  MODIFY `quickbooks_config_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quickbooks_log`
--
ALTER TABLE `quickbooks_log`
  MODIFY `quickbooks_log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quickbooks_oauth`
--
ALTER TABLE `quickbooks_oauth`
  MODIFY `quickbooks_oauth_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quickbooks_queue`
--
ALTER TABLE `quickbooks_queue`
  MODIFY `quickbooks_queue_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quickbooks_recur`
--
ALTER TABLE `quickbooks_recur`
  MODIFY `quickbooks_recur_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quickbooks_ticket`
--
ALTER TABLE `quickbooks_ticket`
  MODIFY `quickbooks_ticket_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_frm_fields`
--
ALTER TABLE `wp_frm_fields`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_frm_forms`
--
ALTER TABLE `wp_frm_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_frm_items`
--
ALTER TABLE `wp_frm_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_frm_item_metas`
--
ALTER TABLE `wp_frm_item_metas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_mappress_maps`
--
ALTER TABLE `wp_mappress_maps`
  MODIFY `mapid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_masterslider_options`
--
ALTER TABLE `wp_masterslider_options`
  MODIFY `ID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_masterslider_sliders`
--
ALTER TABLE `wp_masterslider_sliders`
  MODIFY `ID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_snippets`
--
ALTER TABLE `wp_snippets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_api_keys`
--
ALTER TABLE `wp_woocommerce_api_keys`
  MODIFY `key_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `wp_woocommerce_attribute_taxonomies`
  MODIFY `attribute_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `wp_woocommerce_downloadable_product_permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_log`
--
ALTER TABLE `wp_woocommerce_log`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_order_itemmeta`
--
ALTER TABLE `wp_woocommerce_order_itemmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_order_items`
--
ALTER TABLE `wp_woocommerce_order_items`
  MODIFY `order_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_payment_tokenmeta`
--
ALTER TABLE `wp_woocommerce_payment_tokenmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_payment_tokens`
--
ALTER TABLE `wp_woocommerce_payment_tokens`
  MODIFY `token_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_sessions`
--
ALTER TABLE `wp_woocommerce_sessions`
  MODIFY `session_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zones`
--
ALTER TABLE `wp_woocommerce_shipping_zones`
  MODIFY `zone_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zone_locations`
--
ALTER TABLE `wp_woocommerce_shipping_zone_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zone_methods`
--
ALTER TABLE `wp_woocommerce_shipping_zone_methods`
  MODIFY `instance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_tax_rates`
--
ALTER TABLE `wp_woocommerce_tax_rates`
  MODIFY `tax_rate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `wp_woocommerce_tax_rate_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
