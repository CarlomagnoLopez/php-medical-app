-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2019 at 03:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Trackme`
--

-- --------------------------------------------------------

--
-- Table structure for table `gr_alerts`
--

CREATE TABLE `gr_alerts` (
  `id` int(255) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT '10',
  `v1` varchar(255) DEFAULT NULL,
  `v2` int(255) DEFAULT NULL,
  `v3` int(255) NOT NULL,
  `tms` datetime DEFAULT NULL,
  `seen` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gr_complaints`
--

CREATE TABLE `gr_complaints` (
  `id` int(255) NOT NULL,
  `gid` int(255) DEFAULT NULL,
  `uid` int(255) DEFAULT NULL,
  `msid` int(255) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT '1',
  `tms` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gr_customize`
--

CREATE TABLE `gr_customize` (
  `id` int(255) NOT NULL,
  `attr` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'style',
  `v1` text,
  `v2` varchar(255) DEFAULT NULL,
  `v3` varchar(255) DEFAULT NULL,
  `v4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gr_customize`
--

INSERT INTO `gr_customize` (`id`, `attr`, `type`, `v1`, `v2`, `v3`, `v4`) VALUES
(3, 'left_block_bg', 'style', '.swr-grupo .lside', 'background', '#FFFFFF', ''),
(4, 'left_block_header_bg', 'style', '.swr-grupo .lside > .head', 'background', '#FFFFFF', ''),
(5, 'left_block_header_icon', 'style', '.swr-grupo .lside > .head i', 'color', '#A9A9A9', ''),
(6, 'logo_text_color', 'style', '.swr-grupo .lside > .head > .logo', 'text-color', '#E91E63', '#9C27B0'),
(8, 'left_block_search_bg', 'style', '.swr-grupo .lside &gt; .search', 'background', '#F7F9FB', ''),
(9, 'left_block_search_icon', 'style', '.swr-grupo .lside &gt; .search &gt; i', 'color', '#000000', ''),
(10, 'left_block_search_input_bg', 'style', '.swr-grupo .lside &gt; .search &gt; input', 'background', '#FFFFFF', ''),
(11, 'left_block_search_input_border', 'style', '.swr-grupo .lside &gt; .search &gt; input', 'border-color', '#DFE7EF', ''),
(12, 'left_block_search_input_text', 'style', '.swr-grupo .lside &gt; .search &gt; input', 'color', '#676767', ''),
(13, 'left_block_search_border', 'style', '.swr-grupo .lside &gt; .search', 'border-color', '#DFE7EF', ''),
(14, 'left_block_tab_bg', 'style', '.swr-grupo .lside &gt; .tabs', 'background', '#FFFFFF', ''),
(15, 'left_block_tab_text', 'style', '.swr-grupo .lside &gt; .tabs &gt; ul &gt; li', 'color', '#808080', ''),
(16, 'left_block_tab_active', 'style', '.swr-grupo .lside &gt; .tabs &gt; ul &gt; li.active', 'color', 'rgb(0, 0, 0)', ''),
(17, 'left_block_tab_active_border', 'style', '.swr-grupo .lside &gt; .tabs &gt; ul &gt; li.active', 'border-color', '#E91E63', ''),
(19, 'left_block_list_text', 'style', '.swr-grupo .lside &gt; .content &gt; .list &gt; li', 'color', '#212529', ''),
(20, 'left_block_list_sub', 'style', '.swr-grupo .lside &gt; .content &gt; .list &gt; li &gt; div &gt; .center &gt; span', 'color', '#828588', ''),
(21, 'left_block_list_active', 'style', '.swr-grupo .lside &gt; .content &gt; .list &gt; li.active &gt; div &gt; .center', 'color', '#E91E63', ''),
(22, 'left_block_list_hover_bg', 'style', '.swr-grupo .lside &gt; .content &gt; .list &gt; li.active, .swr-grupo .lside &gt; .content &gt; .list &gt; li:hover', 'background', '#F7F9FB', ''),
(23, 'left_block_list_hover_border', 'style', '.swr-grupo .lside &gt; .content &gt; .list &gt; li.active, .swr-grupo .lside &gt; .content &gt; .list &gt; li:hover', 'border-color', '#DFE7EF', ''),
(24, 'left_block_list_options_bg', 'style', '.swr-grupo .lside .opt &gt; ul', 'background', 'rgb(255, 255, 255)', ''),
(25, 'left_block_list_options_border', 'style', '.swr-grupo .lside .opt &gt; ul', 'border-color', '#DFE7EF', ''),
(26, 'left_block_list_options_text', 'style', '.swr-grupo .lside .opt &gt; ul', 'color', '#A4A5A7', ''),
(27, 'left_block_list_options_hover', 'style', '.swr-grupo .lside .opt &gt; ul &gt; li:hover', 'background', '#E91E63', '#9C27B0'),
(28, 'left_block_list_options_hover_text', 'style', '.swr-grupo .lside .opt &gt; ul &gt; li:hover', 'color', 'rgb(255, 255, 255)', ''),
(29, 'right_block_bg', 'style', '.swr-grupo .rside', 'background', '#FFFFFF', NULL),
(30, 'right_block_header_bg', 'style', '.swr-grupo .rside > .top', 'background', '#FFFFFF', NULL),
(31, 'right_block_header_icon', 'style', '.swr-grupo .rside > .top > .right > i', 'color', '#A9A9A9', NULL),
(32, 'right_block_header_text', 'style', '.swr-grupo .rside > .top > .left > span > span', 'color', '#5A5A5A', ''),
(33, 'right_block_header_sub', 'style', '.swr-grupo .rside > .top > .left > span > span > span', 'color', '#8B8E90', NULL),
(34, 'right_block_search_bg', 'style', '.swr-grupo .rside &gt; .search', 'background', '#F7F9FB', NULL),
(35, 'right_block_search_icon', 'style', '.swr-grupo .rside &gt; .search &gt; i', 'color', '#000000', NULL),
(36, 'right_block_search_input_bg', 'style', '.swr-grupo .rside &gt; .search &gt; input', 'background', '#FFFFFF', NULL),
(37, 'right_block_search_input_border', 'style', '.swr-grupo .rside &gt; .search &gt; input', 'border-color', '#DFE7EF', NULL),
(38, 'right_block_search_input_color', 'style', '.swr-grupo .rside &gt; .search &gt; input', 'color', '#676767', NULL),
(39, 'right_block_search_border', 'style', '.swr-grupo .rside &gt; .search', 'border-color', '#DFE7EF', NULL),
(40, 'right_block_tab_bg', 'style', '.swr-grupo .rside &gt; .tabs', 'background', '#FFFFFF', NULL),
(41, 'right_block_tab_text', 'style', '.swr-grupo .rside &gt; .tabs &gt; ul &gt; li', 'color', '#808080', NULL),
(42, 'right_block_tab_active', 'style', '.swr-grupo .rside &gt; .tabs &gt; ul &gt; li.active', 'color', 'rgb(0, 0, 0)', NULL),
(43, 'right_block_tab_active_border', 'style', '.swr-grupo .rside &gt; .tabs &gt; ul &gt; li.active', 'border-color', '#E91E63', NULL),
(45, 'right_block_list_text', 'style', '.swr-grupo .rside &gt; .content &gt; .list &gt; li', 'color', '#212529', NULL),
(46, 'right_block_list_sub', 'style', '.swr-grupo .rside &gt; .content &gt; .list &gt; li &gt; div &gt; .center &gt; span', 'color', '#828588', NULL),
(47, 'right_block_list_active', 'style', '.swr-grupo .rside &gt; .content &gt; .list &gt; li.active &gt; div &gt; .center', 'color', '#E91E63', NULL),
(48, 'right_block_list_hover_bg', 'style', '.swr-grupo .rside &gt; .content &gt; .list &gt; li.active, .swr-grupo .rside &gt; .content &gt; .list &gt; li:hover', 'background', '#F7F9FB', NULL),
(49, 'right_block_list_hover_border', 'style', '.swr-grupo .rside &gt; .content &gt; .list &gt; li.active, .swr-grupo .rside &gt; .content &gt; .list &gt; li:hover', 'border-color', '#DFE7EF', NULL),
(50, 'right_block_list_options_bg', 'style', '.swr-grupo .rside .opt &gt; ul', 'background', 'rgb(255, 255, 255)', NULL),
(51, 'right_block_list_options_border', 'style', '.swr-grupo .rside .opt &gt; ul', 'border-color', '#DFE7EF', NULL),
(52, 'right_block_list_options_text', 'style', '.swr-grupo .rside .opt &gt; ul', 'color', '#A4A5A7', NULL),
(53, 'right_block_list_options_hover', 'style', '.swr-grupo .rside .opt &gt; ul &gt; li:hover', 'background', '#E91E63', '#9C27B0'),
(54, 'right_block_list_options_hover_text', 'style', '.swr-grupo .rside .opt &gt; ul &gt; li:hover', 'color', 'rgb(255, 255, 255)', NULL),
(55, 'center_block_bg', 'style', '.swr-grupo .panel', 'background', '#F7F9FB', ''),
(56, 'center_block_header_bg', 'style', '.swr-grupo .panel &gt; .head', 'background', '#FFFFFF', ''),
(57, 'center_block_header_text', 'style', '.swr-grupo .panel &gt; .head &gt; .left &gt; span &gt; span', 'color', '#E91E63', ''),
(58, 'center_block_header_sub', 'style', '.swr-grupo .panel &gt; .head &gt; .left &gt; span &gt; span &gt; span', 'color', '#8B8E90', ''),
(59, 'center_block_header_icon', 'style', '.swr-grupo .panel &gt; .head &gt; .right &gt; i', 'color', '#8B8E90', ''),
(60, 'sender_bg', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li.you &gt; div &gt; .msg &gt; i', 'background', '#E91E63', '#9C27B0'),
(61, 'sender_text', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li.you &gt; div &gt; .msg &gt; i', 'color', '#FFFFFF', ''),
(62, 'sender_btn_bg', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li.you &gt; div &gt; .msg &gt; i &gt; span.block &gt; i', 'background', '#FFFFFF', '#FFFFFF'),
(63, 'sender_btn_text', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li.you &gt; div &gt; .msg &gt; i &gt; span.block &gt; i', 'color', '#9C27B0', ''),
(64, 'reciever_bg', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li &gt; div &gt; .msg &gt; i', 'background', '#FFFFFF', '#FFFFFF'),
(65, 'reciever_text', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li &gt; div &gt; .msg &gt; i', 'color', '#333333', ''),
(66, 'reciever_btn_bg', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li &gt; div &gt; .msg &gt; i &gt; span.block &gt; i', 'background', '#F44336', '#9C27B0'),
(67, 'reciever_btn_text', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li &gt; div &gt; .msg &gt; i &gt; span.block &gt; i', 'color', '#FFFFFF', ''),
(68, 'msg_time', 'style', '.swr-grupo .panel &gt; .room &gt; .msgs &gt; li &gt; div &gt; .msg &gt; .time', 'color', '#676767', ''),
(69, 'msg_options_bg', 'style', '.swr-grupo .msgopt &gt; ul', 'background', '#F7F9FB', ''),
(70, 'msg_options_text', 'style', '.swr-grupo .msgopt &gt; ul &gt; li', 'color', '#676767', ''),
(71, 'msg_options_hover', 'style', '.swr-grupo .msgopt &gt; ul &gt; li:hover', 'background', '#F44336', '#9C27B0'),
(72, 'msg_options_hover_text', 'style', '.swr-grupo .msgopt &gt; ul &gt; li:hover', 'color', '#FFFFFF', ''),
(73, 'text_box', 'style', '.swr-grupo .panel &gt; .textbox', 'background', '#FFFFFF', ''),
(74, 'text_box_border', 'style', '.emojionearea, .emojionearea.form-control', 'border-color', '#CCCCCC', ''),
(75, 'text_box_icon', 'style', '.swr-grupo .panel &gt; .textbox &gt; .box &gt; .icon &gt; i', 'color', '#828588', ''),
(76, 'send_btn', 'style', '.swr-grupo .panel &gt; .textbox &gt; .box &gt; i', 'background', '#F44336', '#9C27B0'),
(77, 'text_box_input_bg', 'style', '.emojionearea &gt; .emojionearea-editor', 'background', '#F7F9FB', ''),
(78, 'mobile_header_bg', 'mstyle', '.swr-grupo .aside > .head, .swr-grupo .panel > .head, .swr-grupo .rside > .top', 'background', '#E91E63', '#9C27B0'),
(79, 'mobile_header_text', 'mstyle', '.swr-grupo .aside > .head i, .swr-grupo .panel > .head > .left > span > span, .swr-grupo .panel > .head > .left > span > span > span, .swr-grupo .panel > .head, .swr-grupo .rside > .top, .swr-grupo .rside > .top > .left > span > span, .swr-grupo .rside > .top > .right > i, .swr-grupo .rside > .top > .left > span > span > span,.swr-grupo .panel > .head > .right > i', 'color', '#FFFFFF', ''),
(80, 'mobile_search_bg', 'mstyle', '.swr-grupo .lside &gt; .search,.swr-grupo .rside > .search', 'background', 'rgb(0, 0, 0)', ''),
(81, 'mobile_search_text', 'mstyle', '.swr-grupo .lside > .search > i,.swr-grupo .lside > .search > input,.swr-grupo .rside > .search > i,.swr-grupo .rside > .search > input', 'color', '#FFFFFF', ''),
(82, 'mobile_logo_text', 'mstyle', '.swr-grupo .lside &gt; .head &gt; .logo', 'text-color', '#FFFFFF', '#FFFFFF'),
(83, 'mobile_search_input_bg', 'mstyle', '.swr-grupo .lside > .search > input,.swr-grupo .rside > .search > input', 'background', 'rgb(0, 0, 0)', NULL),
(84, 'custom_css', 'customcss', '', NULL, NULL, NULL),
(85, 'system_message_text', 'style', '.swr-grupo .panel > .room > .msgs > li.system > div > .msg > i, .swr-grupo .panel > .room > .msgs > li.system > div > .msg > .time', 'color', '#676767', NULL),
(86, 'reload_btn_bg', 'style', '.swr-grupo .panel &gt; .room &gt; .groupreload &gt; i', 'background', '#E91E63', '#9C27B0'),
(87, 'reload_btn_text', 'style', '.swr-grupo .panel &gt; .room &gt; .groupreload &gt; i', 'color', '#FFFFFF', ''),
(88, 'confirm_dialog_bg', 'style', '.ajxcnf &gt; div &gt; div', 'background', '#E91E63', '#9C27B0'),
(89, 'confirm_dialog_text', 'style', '.ajxcnf &gt; div &gt; div', 'color', 'rgb(255, 255, 255)', ''),
(90, 'confirm_dialog_btn_bg', 'style', '.ajxcnf &gt; div &gt; div &gt; span &gt; .yescnf', 'background', '#E91E63', '#9C27B0'),
(91, 'confirm_dialog_btn_text', 'style', '.ajxcnf &gt; div &gt; div &gt; span &gt; .yescnf', 'color', 'rgb(255, 255, 255)', ''),
(92, 'loader_color', 'style', '.ajx-ripple div', 'border-color', '#FFFFFF', ''),
(93, 'loader_primary_text', 'style', '.ajxprocess &gt; div &gt; span', 'color', '#FFFFFF', ''),
(94, 'loader_secondary_text', 'style', '.ajxprocess &gt; div &gt; span &gt; span', 'color', '#FFFFFF', ''),
(95, 'loader_bg', 'style', '.ajxprocess &gt; div', 'background', '#E91E63', '#9C27B0'),
(96, 'backup_file_bg', 'style', '.container-table100', 'background', '#673AB7', '#E03ADB'),
(97, 'backup_file_header_bg', 'style', '.container-table100 table thead tr', 'background', '#36304A', '#36304A'),
(98, 'backup_file_header_text', 'style', '.container-table100 .table100-head th', 'color', '#FFFFFF', ''),
(99, 'backup_file_table_bg', 'style', '.container-table100 table', 'background', '#FFFFFF', '#FFFFFF'),
(100, 'backup_file_table_text', 'style', '.container-table100 tbody tr', 'color', 'rgb(128, 128, 128)', ''),
(101, 'backup_file_table_hover_bg', 'style', '.container-table100 tbody tr:hover, tbody tr:nth-child(even)', 'background', '#F5F5F5', '#F5F5F5'),
(102, 'sign_in_box_bg', 'style', '.two &gt; section &gt; div &gt; div &gt; .box', 'background', '#232630', '#252D40'),
(103, 'sign_in_box_text', 'style', '.two &gt; section &gt; div &gt; div form label &gt; input,.two &gt; section &gt; div &gt; div form label &gt; i,.two > section', 'color', '#FFFFFF', ''),
(104, 'sign_in_remember_bg', 'style', '.sign &gt; section &gt; div &gt; div form &gt; .sub &gt; span &gt; i', 'background', '#FFFFFF', ''),
(105, 'sign_in_remember_active', 'style', '.sign &gt; section &gt; div &gt; div form &gt; .sub &gt; span &gt; i &gt; b.active', 'background', '#31302F', ''),
(106, 'sign_in_primary_btn_bg', 'style', '.two &gt; section &gt; div &gt; div form &gt; .submit', 'background', '#E91E63', '#003ADE'),
(107, 'sign_in_primary_btn_text', 'style', '.two &gt; section &gt; div &gt; div form &gt; .submit', 'color', '#FFFFFF', ''),
(108, 'sign_in_secondary_btn_bg', 'style', '.two &gt; section &gt; div &gt; div form &gt; .switch &gt; span', 'background', '#000000', ''),
(109, 'sign_in_secondary_btn_text', 'style', '.two &gt; section &gt; div &gt; div form &gt; .switch &gt; span', 'color', '#FFFFFF', ''),
(110, 'header', 'hf', '', '', '', ''),
(111, 'footer', 'hf', '', '', '', ''),
(112, 'cookie_consent_bg', 'style', '.gr-consent', 'background', '#1C2123', '#1C2123'),
(113, 'cookie_consent_text', 'style', '.gr-consent', 'color', '#FFFFFF', ''),
(114, 'cookie_consent_tos', 'style', '.gr-consent &gt; span &gt; span &gt;i,.sign > section > div > div .tos > h4 > span', 'color', '#FFC107', ''),
(115, 'cookie_consent_btn_bg', 'style', '.gr-consent &gt; span &gt; i', 'background', '#F44336', '#E91E63'),
(116, 'cookie_consent_btn_text', 'style', '.gr-consent &gt; span &gt; i', 'color', '#FFFFFF', ''),
(117, 'sign_in_input_border', 'style', '.two &gt; section &gt; div &gt; div form label', 'border-color', '#FFFFFF', ''),
(119, 'drop_down_menu_bg', 'style', '.swr-menu', 'background', '#E91E63', '#9C27B0'),
(120, 'drop_down_menu_text', 'style', '.swr-menu', 'color', '#FFFFFF', ''),
(121, 'drop_down_menu_hover', 'style', '.swr-menu &gt; ul &gt; li:hover, .swr-menu &gt; ul &gt; li.active', 'background', '#101010', '#101010'),
(122, 'drop_down_menu_hover_text', 'style', '.swr-menu &gt; ul &gt; li:hover, .swr-menu &gt; ul &gt; li.active', 'color', '#FFFFFF', ''),
(123, 'popup_form_head_bg', 'style', '.grupo-pop &gt; div &gt; form &gt; .head', 'background', '#E91E63', '#9C27B0'),
(124, 'popup_form_head_text', 'style', '.grupo-pop &gt; div &gt; form &gt; .head', 'color', '#FFFFFF', ''),
(125, 'popup_form_bg', 'style', '.grupo-pop &gt; div &gt; form', 'background', '#232630', '#252D40'),
(126, 'popup_form_label', 'style', '.grupo-pop &gt; div &gt; form &gt; div &gt; label', 'color', '#FFFFFF', ''),
(127, 'popup_form_input', 'style', '.grupo-pop &gt; div &gt; form &gt; .fields &gt; span,.grupo-pop &gt; div &gt; form &gt; div &gt; input, .grupo-pop &gt; div &gt; form &gt; div &gt; select, .grupo-pop &gt; div &gt; form &gt; div &gt; textarea', 'color', '#9FABB1', ''),
(128, 'popup_form_options_bg', 'style', '.grupo-pop &gt; div &gt; form &gt; div &gt; select &gt; option', 'background', '#232630', ''),
(129, 'popup_form_options_text', 'style', '.grupo-pop &gt; div &gt; form &gt; div &gt; select &gt; option', 'color', '#FFFFFF', ''),
(130, 'popup_form_submit_bg', 'style', '.grupo-pop &gt; div &gt; form &gt; input[type=&quot;submit&quot;]', 'background', '#E91E63', '#9C27B0'),
(131, 'popup_form_submit_text', 'style', '.grupo-pop &gt; div &gt; form &gt; input[type=&quot;submit&quot;]', 'color', '#FFFFFF', ''),
(132, 'popup_form_cancel_btn', 'style', '.grupo-pop &gt; div &gt; form &gt; span.cancel', 'color', '#C7C7C7', ''),
(133, 'tab_count_bg', 'style', '.swr-grupo .aside &gt; .tabs &gt; ul &gt; li &gt; i &gt; i,.swr-grupo .aside > .head > .icons > i.malert > i', 'background', '#E91E63', '#F44336'),
(134, 'tab_count_text', 'style', '.swr-grupo .aside &gt; .tabs &gt; ul &gt; li &gt; i &gt; i,.swr-grupo .aside > .head > .icons > i.malert > i', 'color', '#FFFFFF', ''),
(135, 'profile_cover_bg', 'style', '.swr-grupo .aside > .content .profile > .top', 'background', '#E91E63', '#9C27B0'),
(136, 'profile_cover_name', 'style', '.swr-grupo .aside > .content .profile > .top > span.name', 'color', '#fff', NULL),
(137, 'profile_cover_username', 'style', '.swr-grupo .aside > .content .profile > .top > span.role', 'color', '#ffffffad', NULL),
(138, 'profile_btn_bg', 'style', '.swr-grupo .aside > .content .profile > .middle > span.pm', 'background', '#fff', '#fff'),
(139, 'profile_btn_text', 'style', '.swr-grupo .aside > .content .profile > .middle > span.pm', 'color', '#E91E63', NULL),
(140, 'profile_stats_bg', 'style', '.swr-grupo .aside > .content .profile', 'background', '#fff', '#fff'),
(141, 'profile_stats_txt', 'style', '.swr-grupo .aside > .content .profile > .middle > span.stats > span > i', 'color', '#9a9a9a', NULL),
(142, 'profile_fields_bg', 'style', '.swr-grupo .aside > .content .profile > .bottom', 'background', '#F7F9FB', '#F7F9FB'),
(143, 'profile_field_title', 'style', '.swr-grupo .aside > .content .profile > .bottom > div > ul > li > b', 'color', '#212529', NULL),
(144, 'profile_field_content', 'style', '.swr-grupo .aside > .content .profile > .bottom > div > ul > li > span', 'color', '#212529', ''),
(145, 'profile_stats_count', 'style', '.swr-grupo .aside > .content .profile > .middle > span.stats > span', 'color', '#727273', NULL),
(146, 'mention_txt', 'style', '.swr-grupo .panel > .room > .msgs > li > div > .msg > i > i.vwp', 'color', '#FF9800', NULL),
(147, 'mention_txt_secondary', 'style', '.swr-grupo .panel > .room > .msgs > li.you > div > .msg > i > i.vwp', 'color', '#FFEB3B', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gr_mails`
--

CREATE TABLE `gr_mails` (
  `id` int(255) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `valz` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `tms` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gr_msgs`
--

CREATE TABLE `gr_msgs` (
  `id` int(255) NOT NULL,
  `gid` varchar(255) DEFAULT NULL,
  `uid` int(255) DEFAULT NULL,
  `msg` text,
  `type` varchar(10) NOT NULL DEFAULT 'msg',
  `rtxt` text NOT NULL,
  `rid` int(255) NOT NULL,
  `rmid` int(255) NOT NULL,
  `rtype` varchar(10) NOT NULL DEFAULT 'msg',
  `cat` varchar(10) NOT NULL DEFAULT 'group',
  `tms` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gr_options`
--

CREATE TABLE `gr_options` (
  `id` int(255) NOT NULL,
  `type` varchar(15) NOT NULL,
  `v1` varchar(255) DEFAULT '0',
  `v2` text,
  `v3` varchar(255) DEFAULT '0',
  `v4` varchar(255) NOT NULL DEFAULT '0',
  `v5` varchar(255) NOT NULL DEFAULT '0',
  `tms` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gr_options`
--

INSERT INTO `gr_options` (`id`, `type`, `v1`, `v2`, `v3`, `v4`, `v5`, `tms`) VALUES
(1, 'profile', 'name', 'Administrator', '28', '0', '0', '2019-12-09 23:38:15'),
(2, 'profile', 'status', 'online', '28', '0', '0', '2019-12-23 08:06:45'),
(3, 'default', 'sitename', 'Trackme', '0', '0', '0', NULL),
(4, 'default', 'sitedesc', 'Group chat makes users to share their feelings and other news easily to their friends easily. Trackme makes this chatting more beautiful, elegant, simple and comfortable.', '0', '0', '0', NULL),
(5, 'default', 'siteslogan', 'Group Chatrooms', '0', '0', '0', NULL),
(6, 'default', 'sysemail', 'Trackme@abc.com', '0', '0', '0', NULL),
(7, 'default', 'sendername', 'Trackme', '0', '0', '0', NULL),
(8, 'default', 'userreg', 'enable', '0', '0', '0', NULL),
(9, 'default', 'timezone', 'Asia/Kolkata', '0', '0', '0', '2019-04-06 18:10:19'),
(10, 'default', 'recaptcha', 'disable', '0', '0', '0', NULL),
(11, 'default', 'rsecretkey', '', '0', '0', '0', NULL),
(12, 'default', 'rsitekey', '', '0', '0', '0', NULL),
(13, 'default', 'language', '1', '0', '0', '0', NULL),
(14, 'default', 'delmsgexpiry', '15', '0', '0', '0', NULL),
(15, 'default', 'autogroupjoin', '0', '0', '0', '0', NULL),
(16, 'default', 'fileexpiry', '60', '0', '0', '0', NULL),
(17, 'profile', 'tmz', 'Asia/Kolkata', '28', '0', '0', '2019-12-09 23:38:16'),
(18, 'default', 'boxed', 'enable', '0', '0', '0', NULL),
(19, 'profile', 'language', '1', '28', '0', '0', '2019-12-09 23:14:28'),
(20, 'grsite', 'url', '0', 'http://localhost/Trackme/', '0', '0', NULL),
(21, 'blacklist', 'ip', '51.89.23.57\r\n183.80.183.88\r\n223.241.166.96\r\n51.79.62.116\r\n35.172.136.41\r\n137.169.63.241\r\n18.207.142.233\r\n3.227.233.55\r\n36.69.93.218\r\n125.118.73.41\r\n185.102.139.15\r\n216.244.66.250\r\n196.196.193.196\r\n195.154.123.46\r\n196.240.54.38\r\n35.171.146.16\r\n116.7.162.205\r\n54.36.148.250\r\n195.154.122.95\r\n61.154.64.45\r\n54.227.117.173\r\n39.88.21.134\r\n61.154.197.55\r\n2.176.205.209\r\n46.183.221.15\r\n82.102.21.52\r\n113.123.0.47\r\n27.31.102.142\r\n171.80.187.37\r\n58.54.221.49\r\n117.78.58.30\r\n185.106.94.133\r\n27.31.102.152\r\n117.78.58.25\r\n3.93.169.195\r\n117.78.58.24\r\n117.78.58.18\r\n114.95.205.13\r\n117.78.58.16\r\n119.62.208.204\r\n192.69.90.178\r\n117.78.58.17\r\n2.191.43.217\r\n103.115.41.90\r\n117.78.58.22\r\n117.78.58.28\r\n195.154.123.18\r\n117.78.58.27\r\n117.78.58.19\r\n117.78.58.14\r\n185.112.81.55\r\n100.25.38.220\r\n216.170.126.176\r\n195.154.104.5\r\n163.172.71.139\r\n195.154.104.4\r\n185.102.137.85\r\n111.202.100.123\r\n216.186.243.70\r\n212.115.122.89\r\n52.23.204.195\r\n84.75.207.109\r\n68.139.206.214\r\n163.172.71.6\r\n185.112.100.33\r\n52.90.162.255\r\n213.202.253.46\r\n163.172.71.84\r\n13.59.168.16\r\n195.154.104.170\r\n85.208.96.65\r\n144.168.163.119\r\n218.69.225.124\r\n34.76.178.121\r\n35.189.255.190\r\n54.209.162.70\r\n111.177.117.36\r\n185.112.81.140\r\n27.157.90.195\r\n34.234.54.252\r\n221.193.124.122\r\n46.183.222.15\r\n83.110.248.130\r\n2.61.214.145\r\n54.166.130.16\r\n185.106.94.128\r\n91.242.162.7\r\n36.90.89.64\r\n200.159.250.2\r\n61.132.225.40\r\n18.205.109.82\r\n34.226.234.20\r\n207.180.226.173\r\n91.242.162.10\r\n149.202.211.239\r\n54.36.150.108\r\n41.87.207.142\r\n123.14.219.83\r\n213.74.79.34\r\n166.62.84.121\r\n89.163.242.239\r\n77.168.164.74\r\n83.178.235.206\r\n35.172.100.232\r\n51.77.70.4\r\n129.56.117.163\r\n81.92.203.62\r\n3.93.75.30\r\n104.248.247.150\r\n195.154.123.57\r\n104.248.243.235\r\n185.167.160.83\r\n34.80.141.133\r\n162.216.115.103\r\n85.208.96.66\r\n123.14.63.250\r\n134.19.176.22\r\n185.248.12.162\r\n109.245.36.65\r\n91.79.52.84\r\n100.26.182.28\r\n216.244.66.195\r\n67.220.186.137\r\n91.242.162.57\r\n46.217.82.6\r\n3.86.206.185\r\n165.16.181.172\r\n5.62.34.46\r\n18.204.2.53\r\n192.3.136.27\r\n37.49.231.118\r\n3.226.243.130\r\n3.227.254.12\r\n193.124.191.215\r\n92.99.144.189\r\n54.36.148.217\r\n45.61.48.64\r\n34.204.176.189\r\n185.117.118.252\r\n182.110.22.115\r\n102.68.77.254\r\n218.70.200.139\r\n141.8.189.76\r\n62.210.80.82\r\n92.53.33.154\r\n91.242.162.22\r\n27.187.58.159\r\n34.237.76.91\r\n163.172.30.236\r\n79.143.28.100\r\n192.243.53.51\r\n106.38.241.116\r\n36.90.89.53\r\n190.152.180.58\r\n18.206.48.142\r\n103.45.100.168\r\n61.230.210.31\r\n117.78.58.23\r\n66.160.140.184\r\n182.253.245.114\r\n37.148.46.175\r\n185.24.233.187\r\n131.203.43.48\r\n23.18.139.79\r\n36.222.72.101\r\n112.25.188.171\r\n2.61.231.144\r\n85.208.96.68\r\n117.78.58.20\r\n160.120.4.171\r\n117.78.58.15\r\n111.206.221.86\r\n109.102.111.58\r\n111.226.236.217\r\n46.240.189.44\r\n37.140.159.2\r\n46.4.105.251\r\n69.167.38.186\r\n85.208.96.67\r\n207.241.226.107\r\n47.92.84.119\r\n111.172.66.52\r\n217.170.202.237\r\n122.11.135.159\r\n123.136.135.98\r\n218.77.57.10\r\n18.206.16.123\r\n173.63.217.134\r\n92.255.195.226\r\n3.87.134.248\r\n45.123.43.30\r\n89.163.146.110\r\n185.36.81.39\r\n196.50.5.97\r\n3.91.51.153\r\n60.184.109.226\r\n103.219.207.39\r\n104.131.75.86\r\n195.91.155.132\r\n69.30.226.234\r\n169.159.119.98\r\n45.137.17.167\r\n196.70.251.73\r\n199.96.83.9\r\n80.77.42.209\r\n145.239.2.240\r\n54.165.90.203\r\n197.210.44.208\r\n89.163.146.71\r\n194.110.84.100\r\n84.38.129.31\r\n129.56.78.30\r\n5.9.6.51\r\n17.122.128.175\r\n2.61.193.59\r\n125.121.51.147\r\n52.9.20.166\r\n125.121.49.168\r\n103.137.12.206\r\n203.186.170.66\r\n5.188.84.184\r\n36.27.111.3\r\n41.217.86.96\r\n218.70.201.123\r\n121.239.108.165\r\n183.25.179.204\r\n39.53.130.136\r\n103.195.238.158\r\n51.255.134.131\r\n185.248.13.186\r\n59.55.202.68\r\n73.171.83.254\r\n105.208.57.92\r\n109.252.20.243\r\n36.90.88.149\r\n78.46.174.55\r\n34.227.91.38\r\n95.168.191.169\r\n109.93.249.91\r\n60.176.78.81\r\n195.154.122.66\r\n178.149.88.114\r\n93.158.166.139\r\n167.86.73.202\r\n119.62.205.177\r\n66.160.140.183\r\n86.52.207.82\r\n106.120.173.156\r\n54.191.53.48\r\n39.188.104.180\r\n172.245.13.162\r\n69.77.176.154\r\n46.229.168.142\r\n195.154.123.127\r\n195.154.123.87\r\n94.130.10.89\r\n17.58.101.49\r\n223.80.227.88\r\n123.21.196.161\r\n59.55.241.38\r\n2.61.170.40\r\n37.140.159.0\r\n54.36.149.82\r\n199.168.140.151\r\n54.36.150.16\r\n54.36.150.93\r\n85.208.96.69\r\n188.68.226.106\r\n54.36.150.175\r\n185.5.251.207\r\n54.36.150.56\r\n54.36.150.2\r\n54.90.161.92\r\n54.36.150.65\r\n54.36.150.12\r\n54.36.148.68\r\n54.36.148.56\r\n54.36.150.183\r\n54.36.148.166\r\n188.68.226.102\r\n54.36.150.81\r\n54.36.149.29\r\n54.36.148.191\r\n54.36.150.22\r\n5.2.183.39\r\n54.36.150.50\r\n117.239.48.242\r\n116.206.137.146\r\n23.228.90.13\r\n54.36.150.97\r\n54.36.150.1\r\n81.166.130.184\r\n54.36.150.86\r\n54.36.150.156\r\n54.36.148.245\r\n106.9.137.118\r\n54.36.150.83\r\n54.36.148.33\r\n54.36.148.10\r\n35.239.58.193\r\n54.36.150.141\r\n54.36.150.188\r\n54.36.148.49\r\n54.36.148.147\r\n188.68.226.103\r\n54.36.149.30\r\n54.36.148.237\r\n185.38.251.59\r\n54.36.150.88\r\n182.253.14.20\r\n54.36.150.167\r\n54.36.150.101\r\n54.36.149.90\r\n54.36.148.96\r\n113.102.166.15\r\n5.188.84.138\r\n54.36.150.116\r\n54.36.149.65\r\n54.36.148.118\r\n123.126.113.125\r\n198.204.229.90\r\n45.76.20.179\r\n54.36.149.70\r\n54.36.150.47\r\n54.36.149.80\r\n54.36.148.111\r\n41.82.92.83\r\n54.36.150.51\r\n54.36.148.132\r\n46.4.100.132\r\n195.88.253.235\r\n54.36.149.5\r\n54.36.150.132\r\n129.18.156.246\r\n109.238.247.83\r\n54.36.150.62\r\n54.36.148.34\r\n54.36.150.29\r\n54.36.150.128\r\n54.36.150.136\r\n54.36.148.198\r\n218.70.200.192\r\n46.229.168.154\r\n23.226.130.76\r\n54.36.148.194\r\n183.156.22.199\r\n54.36.150.55\r\n85.208.96.4\r\n54.36.148.221\r\n54.36.149.63\r\n59.41.24.26\r\n111.224.13.119\r\n54.36.148.173\r\n54.36.150.130\r\n195.154.61.130\r\n205.134.171.79\r\n54.36.150.184\r\n188.68.226.105\r\n54.36.149.1\r\n54.36.148.226\r\n54.36.150.171\r\n170.130.205.87\r\n82.57.55.118\r\n54.36.149.42\r\n54.36.150.11\r\n188.68.226.108\r\n103.88.233.5\r\n54.36.150.76\r\n188.68.226.107\r\n121.40.224.143\r\n54.36.148.18\r\n114.103.64.50\r\n47.111.102.108\r\n112.73.24.219\r\n121.40.130.229\r\n103.133.104.170\r\n54.36.148.70\r\n121.40.225.125\r\n54.36.148.180\r\n54.36.150.75\r\n194.99.105.243\r\n47.111.65.9\r\n121.40.210.30\r\n54.36.150.160\r\n207.148.102.16\r\n188.68.226.101\r\n54.36.149.72\r\n54.36.150.15\r\n54.36.148.121\r\n23.254.202.98\r\n54.36.148.137\r\n54.36.150.102\r\n107.6.156.2\r\n47.111.136.117\r\n94.25.168.181\r\n54.36.148.46\r\n176.9.4.111\r\n62.210.111.58\r\n121.40.207.234\r\n3.230.119.16\r\n54.36.150.71\r\n121.40.244.177\r\n54.38.19.73\r\n190.156.243.166\r\n37.140.159.1\r\n157.55.201.215\r\n75.162.79.99\r\n54.36.150.161\r\n195.154.122.234\r\n124.41.228.15\r\n105.159.249.101\r\n46.229.168.132\r\n188.68.226.100\r\n54.36.150.91\r\n192.243.56.76\r\n103.212.33.223\r\n54.36.149.57\r\n121.40.103.29\r\n121.40.76.239\r\n54.36.150.143\r\n17.58.97.31\r\n103.7.79.79\r\n54.36.148.107\r\n54.36.150.23\r\n54.36.148.254\r\n118.71.107.73\r\n141.8.188.178\r\n47.111.111.174\r\n54.36.150.98\r\n105.112.32.58\r\n54.36.148.64\r\n192.3.8.36\r\n54.36.150.121\r\n93.180.64.137\r\n198.50.183.1\r\n54.36.148.105\r\n47.92.222.191\r\n203.133.169.184\r\n184.75.211.107\r\n47.111.156.198\r\n159.69.189.218\r\n46.229.168.139\r\n52.4.105.228\r\n46.229.168.161\r\n121.40.249.129\r\n46.229.168.137\r\n182.74.103.193\r\n81.106.8.37\r\n216.244.66.203\r\n46.229.161.131\r\n54.36.148.190\r\n95.216.172.180\r\n46.229.168.162\r\n178.159.37.125\r\n54.36.148.43\r\n46.229.168.129\r\n173.44.40.49\r\n54.36.150.35\r\n202.49.183.168\r\n121.40.129.130\r\n46.229.168.141\r\n121.40.142.193\r\n46.229.168.153\r\n116.31.102.8\r\n54.36.150.39\r\n39.100.157.106\r\n159.65.137.115\r\n164.68.96.84\r\n210.2.157.130\r\n88.248.23.216\r\n27.189.34.35\r\n46.229.168.140\r\n203.133.169.241\r\n141.8.188.201\r\n141.8.188.145\r\n54.36.149.37\r\n178.159.37.55\r\n141.8.143.170\r\n54.36.150.43\r\n141.8.188.196\r\n46.229.168.147\r\n54.36.148.171\r\n141.8.188.143\r\n121.40.101.160\r\n54.36.148.126\r\n85.208.96.7\r\n121.40.246.140\r\n54.36.150.61\r\n121.40.238.244\r\n46.4.60.249\r\n195.154.123.53\r\n93.158.166.10\r\n121.40.219.58\r\n42.113.50.23\r\n13.57.217.89\r\n46.229.168.136\r\n54.36.150.145\r\n54.36.150.90\r\n14.226.203.62\r\n121.40.113.77\r\n47.111.125.140\r\n212.7.208.140\r\n54.36.148.51\r\n46.229.168.149\r\n103.63.158.254\r\n121.40.228.36\r\n64.44.131.61\r\n93.158.166.146\r\n121.40.164.34\r\n46.229.168.163\r\n95.236.18.183\r\n112.34.110.149\r\n142.252.249.91\r\n121.40.225.4\r\n83.221.88.181\r\n213.174.147.83\r\n45.89.197.195\r\n23.100.232.233\r\n121.40.153.27\r\n223.241.79.240\r\n188.165.200.217\r\n41.103.204.206\r\n102.165.33.20\r\n46.229.168.143\r\n52.162.161.148\r\n107.173.222.196\r\n18.208.178.230\r\n46.140.101.194\r\n3.212.81.28\r\n62.210.80.58\r\n122.224.204.36\r\n216.244.66.228\r\n46.229.168.131\r\n46.229.168.146\r\n46.229.168.135\r\n111.206.198.44\r\n39.100.158.151\r\n46.229.168.130\r\n2.61.172.111\r\n110.86.19.26\r\n39.98.128.208\r\n39.98.129.207\r\n46.229.168.145\r\n39.100.147.54\r\n47.92.214.153\r\n46.229.168.152\r\n218.70.204.84\r\n85.208.96.1\r\n206.189.56.14\r\n46.229.168.138\r\n46.229.168.133\r\n13.66.139.0\r\n18.222.24.144\r\n84.25.85.171\r\n112.34.110.156\r\n46.229.168.151\r\n62.210.80.98\r\n113.66.252.206\r\n192.69.95.250\r\n121.40.144.114\r\n66.206.0.173\r\n173.249.18.133\r\n90.188.236.43\r\n62.210.80.25\r\n188.68.226.104\r\n60.169.115.55\r\n46.229.168.150\r\n121.40.111.18\r\n121.40.189.110\r\n121.40.118.135\r\n45.123.41.94\r\n195.206.104.237\r\n121.40.219.187\r\n206.81.31.194\r\n121.40.110.89\r\n47.111.133.130\r\n47.111.127.121\r\n111.206.221.29\r\n162.221.200.177\r\n93.182.109.32\r\n185.160.100.26\r\n112.34.110.29\r\n121.40.114.207\r\n112.34.110.28\r\n47.111.64.179\r\n188.2.211.28\r\n121.40.150.14\r\n46.229.168.144\r\n164.68.123.23\r\n157.55.199.147\r\n121.40.192.236\r\n46.229.168.134\r\n46.229.168.148\r\n47.111.89.120\r\n121.40.175.46\r\n47.99.196.186\r\n151.80.200.152\r\n193.56.28.150\r\n45.141.71.22\r\n2.61.224.130\r\n121.40.248.200\r\n121.40.106.86\r\n210.56.127.217\r\n190.90.140.55\r\n85.208.96.71\r\n1.179.180.98\r\n75.159.84.200\r\n94.21.118.140\r\n27.255.193.172\r\n2001:1c06:8c2:e300:6c36:11af:25e:a81f\r\n2001:1c06:8c2:e300:e5f2:b2b5:1c17:7afd\r\n2001:1c06:8c2:e300:f55f:559f:2f34:f2d0\r\n2401:4900:16bc:6f12:e4c5:b2dc:39eb:f244\r\n2001:e68:5422:28a1:a433:b10:645d:b9a1\r\n2607:fea8:91c0:40a:548:ae6b:ff7f:18f3\r\n2001:1c06:8c2:e300:e912:206b:b0d7:e7b4\r\n2001:e68:5422:28a1:2936:b9e4:7ca0:89e\r\n2001:e68:5420:2a0c:e08a:d855:1cef:92a5', '0', '0', '0', NULL),
(22, 'filterwords', 'words', 'ahole\r\nanus\r\nfuckoff\r\nash0le\r\nash0les\r\nasholes\r\nass\r\nAss Monkey\r\nAssface\r\nassh0le\r\nassh0lez\r\nasshole\r\nassholes\r\nassholz\r\nasswipe\r\nazzhole\r\nbassterds\r\nbastard\r\nbastards\r\nbastardz\r\nbasterds\r\nbasterdz\r\nBiatch\r\nbitch\r\nbitches\r\nBlow Job\r\nboffing\r\nbutthole\r\nbuttwipe\r\nc0ck\r\nc0cks\r\nc0k\r\nCarpet Muncher\r\ncawk\r\ncawks\r\nClit\r\ncnts\r\ncntz\r\ncock\r\ncockhead\r\ncock-head\r\ncocks\r\nCockSucker\r\ncock-sucker\r\ncrap\r\ncum\r\ncunt\r\ncunts\r\ncuntz\r\ndick\r\ndild0\r\ndild0s\r\ndildo\r\ndildos\r\ndilld0\r\ndilld0s\r\ndominatricks\r\ndominatrics\r\ndominatrix\r\ndyke\r\nenema\r\nf u c k\r\nf u c k e r\r\nfag\r\nfag1t\r\nfaget\r\nfagg1t\r\nfaggit\r\nfaggot\r\nfagg0t\r\nfagit\r\nfags\r\nfagz\r\nfaig\r\nfaigs\r\nfart\r\nflipping the bird\r\nfuck\r\nfucker\r\nfuckin\r\nfucking\r\nfucks\r\nFudge Packer\r\nfuk\r\nFukah\r\nFuken\r\nfuker\r\nFukin\r\nFukk\r\nFukkah\r\nFukken\r\nFukker\r\nFukkin\r\ng00k\r\nGod-damned\r\nh00r\r\nh0ar\r\nh0re\r\nhells\r\nhoar\r\nhoor\r\nhoore\r\njackoff\r\njap\r\njaps\r\njerk-off\r\njisim\r\njiss\r\njizm\r\njizz\r\nknob\r\nknobs\r\nknobz\r\nkunt\r\nkunts\r\nkuntz\r\nLezzian\r\nLipshits\r\nLipshitz\r\nmasochist\r\nmasokist\r\nmassterbait\r\nmasstrbait\r\nmasstrbate\r\nmasterbaiter\r\nmasterbate\r\nmasterbates\r\nMotha Fucker\r\nMotha Fuker\r\nMotha Fukkah\r\nMotha Fukker\r\nMother Fucker\r\nMother Fukah\r\nMother Fuker\r\nMother Fukkah\r\nMother Fukker\r\nmother-fucker\r\nMutha Fucker\r\nMutha Fukah\r\nMutha Fuker\r\nMutha Fukkah\r\nMutha Fukker\r\nn1gr\r\nnastt\r\nnigger;\r\nnigur;\r\nniiger;\r\nniigr;\r\norafis\r\norgasim;\r\norgasm\r\norgasum\r\noriface\r\norifice\r\norifiss\r\npacki\r\npackie\r\npacky\r\npaki\r\npakie\r\npaky\r\npecker\r\npeeenus\r\npeeenusss\r\npeenus\r\npeinus\r\npen1s\r\npenas\r\npenis\r\npenis-breath\r\npenus\r\npenuus\r\nPhuc\r\nPhuck\r\nPhuk\r\nPhuker\r\nPhukker\r\npolac\r\npolack\r\npolak\r\nPoonani\r\npr1c\r\npr1ck\r\npr1k\r\npusse\r\npussee\r\npussy\r\npuuke\r\npuuker\r\nqueer\r\nqueers\r\nqueerz\r\nqweers\r\nqweerz\r\nqweir\r\nrecktum\r\nrectum\r\nretard\r\nsadist\r\nscank\r\nschlong\r\nscrewing\r\nsemen\r\nsex\r\nsexy\r\nSh!t\r\nsh1t\r\nsh1ter\r\nsh1ts\r\nsh1tter\r\nsh1tz\r\nshit\r\nshits\r\nshitter\r\nShitty\r\nShity\r\nshitz\r\nShyt\r\nShyte\r\nShytty\r\nShyty\r\nskanck\r\nskank\r\nskankee\r\nskankey\r\nskanks\r\nSkanky\r\nslag\r\nslut\r\nsluts\r\nSlutty\r\nslutz\r\nson-of-a-bitch\r\ntit\r\nturd\r\nva1jina\r\nvag1na\r\nvagiina\r\nvagina\r\nvaj1na\r\nvajina\r\nvullva\r\nvulva\r\nw0p\r\nwh00r\r\nwh0re\r\nwhore\r\nxrated\r\nxxx\r\nb!+ch\r\nbitch\r\nblowjob\r\nclit\r\narschloch\r\nfuck\r\nshit\r\nass\r\nasshole\r\nb!tch\r\nb17ch\r\nb1tch\r\nbastard\r\nbi+ch\r\nboiolas\r\nbuceta\r\nc0ck\r\ncawk\r\nchink\r\ncipa\r\nclits\r\ncock\r\ncum\r\ncunt\r\ndildo\r\ndirsa\r\nejakulate\r\nfatass\r\nfcuk\r\nfuk\r\nfux0r\r\nhoer\r\nhore\r\njism\r\nkawk\r\nl3itch\r\nl3i+ch\r\nlesbian\r\nmasturbate\r\nmasterbat*\r\nmasterbat3\r\nmotherfucker\r\ns.o.b.\r\nmofo\r\nnazi\r\nnigga\r\nnigger\r\nnutsack\r\nphuck\r\npimpis\r\npusse\r\npussy\r\nscrotum\r\nsh!t\r\nshemale\r\nshi+\r\nsh!+\r\nslut\r\nsmut\r\nteets\r\ntits\r\nboobs\r\nb00bs\r\nteez\r\ntestical\r\ntesticle\r\ntitt\r\nw00se\r\njackoff\r\nwank\r\nwhoar\r\nwhore\r\n*damn\r\n*dyke\r\n*fuck*\r\n*shit*\r\n@$$\r\namcik\r\nandskota\r\narse*\r\nassrammer\r\nayir\r\nbi7ch\r\nbitch*\r\nbollock*\r\nbreasts\r\nbutt-pirate\r\ncabron\r\ncazzo\r\nchraa\r\nchuj\r\nCock*\r\ncunt*\r\nd4mn\r\ndaygo\r\ndego\r\ndick*\r\ndike*\r\ndupa\r\ndziwka\r\nejackulate\r\nEkrem*\r\nEkto\r\nenculer\r\nfaen\r\nfag*\r\nfanculo\r\nfanny\r\nfeces\r\nfeg\r\nFelcher\r\nficken\r\nfitt*\r\nFlikker\r\nforeskin\r\nFotze\r\nFu(*\r\nfuk*\r\nfutkretzn\r\ngook\r\nguiena\r\nh0r\r\nh4x0r\r\nhell\r\nhelvete\r\nhoer*\r\nhonkey\r\nHuevon\r\nhui\r\ninjun\r\njizz\r\nkanker*\r\nkike\r\nklootzak\r\nkraut\r\nknulle\r\nkuk\r\nkuksuger\r\nKurac\r\nkurwa\r\nkusi*\r\nkyrpa*\r\nlesbo\r\nmamhoon\r\nmasturbat*\r\nmerd*\r\nmibun\r\nmonkleigh\r\nmouliewop\r\nmuie\r\nmulkku\r\nmuschi\r\nnazis\r\nnepesaurio\r\nnigger*\r\norospu\r\npaska*\r\nperse\r\npicka\r\npierdol*\r\npillu*\r\npimmel\r\npiss*\r\npizda\r\npoontsee\r\npoop\r\nporn\r\np0rn\r\npr0n\r\npreteen\r\npula\r\npule\r\nputa\r\nputo\r\nqahbeh\r\nqueef*\r\nrautenberg\r\nschaffer\r\nscheiss*\r\nschlampe\r\nschmuck\r\nscrew\r\nsh!t*\r\nsharmuta\r\nsharmute\r\nshipal\r\nshiz\r\nskribz\r\nskurwysyn\r\nsphencter\r\nspic\r\nspierdalaj\r\nsplooge\r\nsuka\r\nb00b*\r\ntesticle*\r\ntitt*\r\ntwat\r\nvittu\r\nwank*\r\nwetback*\r\nwichser\r\nwop*\r\nyed\r\nzabourah', '0', '0', '0', NULL),
(23, 'default', 'guest_login', 'enable', '0', '0', '0', NULL),
(24, 'default', 'autodeletemsg', 'off', '0', '0', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gr_permissions`
--

CREATE TABLE `gr_permissions` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `groups` varchar(50) DEFAULT NULL,
  `files` varchar(50) DEFAULT NULL,
  `users` varchar(50) DEFAULT NULL,
  `languages` varchar(50) DEFAULT NULL,
  `sys` varchar(50) DEFAULT NULL,
  `roles` varchar(50) DEFAULT NULL,
  `fields` varchar(50) NOT NULL,
  `privatemsg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gr_permissions`
--

INSERT INTO `gr_permissions` (`id`, `name`, `groups`, `files`, `users`, `languages`, `sys`, `roles`, `fields`, `privatemsg`) VALUES
(1, 'Unverified', '', '', '', '', '', '', '', ''),
(2, 'Adminstrator', '1,2,3,4,5,6,8,9,10,7', '1,2,3,4,5', '1,2,3,4,7,5,6,8', '1,2,3,4', '1,2,3,4,5', '1,2,3', '1,2,3,4', '1,2,3'),
(3, 'Verified', '1,2,3,4,5,6,8,9,10', '1,2,3,4,5', '7,5', '', '', '', '', '1,2,3'),
(4, 'Banned', '', '', '', '', '', '', '', ''),
(5, 'Guest', '4,6,9', '2', '5', '', '', '', '', '1,2,3');

-- --------------------------------------------------------

--
-- Table structure for table `gr_phrases`
--

CREATE TABLE `gr_phrases` (
  `id` int(255) NOT NULL,
  `type` varchar(10) DEFAULT 'phrase',
  `short` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lid` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gr_phrases`
--

INSERT INTO `gr_phrases` (`id`, `type`, `short`, `full`, `lid`) VALUES
(1, 'lang', 'English', NULL, 0),
(2, 'phrase', 'edit_profile', 'Edit Profile', 1),
(3, 'phrase', 'users', 'Users', 1),
(4, 'phrase', 'roles', 'Roles', 1),
(5, 'phrase', 'languages', 'Languages', 1),
(6, 'phrase', 'appearance', 'Appearance', 1),
(7, 'phrase', 'header_footer', 'Header/Footer', 1),
(8, 'phrase', 'settings', 'Settings', 1),
(9, 'phrase', 'shortcodes', 'Shortcodes', 1),
(10, 'phrase', 'zero_users', 'Users Found', 1),
(11, 'phrase', 'zero_roles', 'Roles Found', 1),
(12, 'phrase', 'zero_languages', 'Languages Found', 1),
(13, 'phrase', 'zero_shortcodes', 'Shortcodes Found', 1),
(14, 'phrase', 'upload_file', 'Upload File', 1),
(15, 'phrase', 'create_group', 'Create Group', 1),
(16, 'phrase', 'create_user', 'Create User', 1),
(17, 'phrase', 'create_role', 'Create Role', 1),
(18, 'phrase', 'add_language', 'Add Language', 1),
(19, 'phrase', 'create', 'Create', 1),
(20, 'phrase', 'edit', 'Edit', 1),
(21, 'phrase', 'update', 'Update', 1),
(22, 'phrase', 'add', 'Add', 1),
(23, 'phrase', 'delete', 'Delete', 1),
(24, 'phrase', 'report', 'Report', 1),
(25, 'phrase', 'reply', 'Reply', 1),
(26, 'phrase', 'login', 'Login', 1),
(27, 'phrase', 'share', 'Share', 1),
(28, 'phrase', 'zip', 'Zip', 1),
(29, 'phrase', 'download', 'Download', 1),
(30, 'phrase', 'view', 'View', 1),
(31, 'phrase', 'search_here', 'Search here', 1),
(32, 'phrase', 'zero_groups', 'Groups Found', 1),
(33, 'phrase', 'zero_online', 'No one is online', 1),
(34, 'phrase', 'zero_files', 'Empty File manager', 1),
(35, 'phrase', 'edit_group', 'Edit Group', 1),
(36, 'phrase', 'export_chat', 'Export Chat', 1),
(37, 'phrase', 'leave_group', 'Leave Group', 1),
(38, 'phrase', 'invite', 'Invite', 1),
(39, 'phrase', 'delete_group', 'Delete Group', 1),
(40, 'phrase', 'no_group_selected', 'Empty Inbox', 1),
(42, 'phrase', 'logout', 'Logout', 1),
(43, 'phrase', 'go_offline', 'Go Offline', 1),
(44, 'phrase', 'go_online', 'Go Online', 1),
(45, 'phrase', 'online', 'Online', 1),
(46, 'phrase', 'offline', 'Offline', 1),
(47, 'phrase', 'idle', 'Idle', 1),
(48, 'phrase', 'search_messages', 'Search messages', 1),
(49, 'phrase', 'alerts', 'Alerts', 1),
(50, 'phrase', 'crew', 'Crew', 1),
(51, 'phrase', 'zero_crew', 'Members', 1),
(52, 'phrase', 'cancel', 'Cancel', 1),
(53, 'phrase', 'files', 'Files', 1),
(54, 'phrase', 'zero_alerts', 'Alerts', 1),
(55, 'phrase', 'groups', 'Groups', 1),
(56, 'phrase', 'deny_default_role', 'Permission Denied : Default Roles', 1),
(57, 'phrase', 'deleted', 'Deleted', 1),
(58, 'phrase', 'deny_system_msg', 'Permission Denied : System Message', 1),
(59, 'phrase', 'deny_file_deletion', 'Permission Denied : Allotted time Expired', 1),
(60, 'phrase', 'invalid_group_password', 'Invalid Group Password', 1),
(61, 'phrase', 'already_exists', 'Already Exists', 1),
(62, 'phrase', 'invalid_value', 'Invalid Input', 1),
(63, 'phrase', 'created', 'Created', 1),
(64, 'phrase', 'updated', 'Updated', 1),
(65, 'phrase', 'username_exists', 'Username Exists', 1),
(66, 'phrase', 'email_exists', 'Email Already Exists', 1),
(67, 'phrase', 'files_uploaded', 'Files Uploaded', 1),
(68, 'phrase', 'error_uploading', 'Error Uploading Files', 1),
(69, 'phrase', 'file_expired', 'File Expired', 1),
(70, 'phrase', 'select_group', 'Select a Group or Chat', 1),
(71, 'phrase', 'group_name', 'Group Name', 1),
(72, 'phrase', 'username', 'Username', 1),
(73, 'phrase', 'password', 'Password', 1),
(74, 'phrase', 'email_address', 'Email Address', 1),
(75, 'phrase', 'icon', 'Icon', 1),
(76, 'phrase', 'language', 'Language', 1),
(78, 'phrase', 'role_name', 'Role Name', 1),
(79, 'phrase', 'system_variables', 'System Variables', 1),
(80, 'phrase', 'confirm_delete', 'Are you sure you Want to Delete?', 1),
(81, 'phrase', 'full_name', 'Full Name', 1),
(82, 'phrase', 'mail_login_info', 'Mail Login Info', 1),
(83, 'phrase', 'confirm_join', 'Do You Want to Join?', 1),
(84, 'phrase', 'confirm_leave', 'Do You Want to Leave?', 1),
(85, 'phrase', 'role', 'Role', 1),
(86, 'phrase', 'confirm_export', 'Do You Want to Export?', 1),
-- (87, 'phrase', 'email_username', 'Email/Username', 1),
(87, 'phrase', 'email_username', 'Phone Number', 1),
(88, 'phrase', 'separate_commas', 'Separate with commas', 1),
(89, 'phrase', 'timezone', 'TimeZone', 1),
(90, 'phrase', 'custom_avatar', 'Custom Avatar', 1),
(91, 'phrase', 'custom_bg', 'Custom Bg', 1),
(92, 'phrase', 'options', 'options', 1),
(93, 'phrase', 'switch', 'Switch', 1),
(94, 'phrase', 'ban', 'Ban', 1),
(95, 'phrase', 'msgs', 'Msgs', 1),
(96, 'phrase', 'new', 'New', 1),
(97, 'phrase', 'members', 'Members', 1),
(98, 'phrase', 'join_group', 'Join Group', 1),
(99, 'phrase', 'join', 'Join', 1),
(100, 'phrase', 'member', 'Member', 1),
(101, 'phrase', 'admin', 'Admin', 1),
(102, 'phrase', 'moderator', 'Moderator', 1),
(103, 'phrase', 'blocked', 'Blocked', 1),
(104, 'phrase', 'confirm', 'Confirm', 1),
(105, 'phrase', 'edit_role', 'Edit Role', 1),
(106, 'phrase', 'device_blocked', 'Device Blocked. Reset Password to Unblock this device.', 1),
(107, 'phrase', 'invalid_login', 'Invalid Login Credentials', 1),
(108, 'phrase', 'denied', 'Permission Denied', 1),
(109, 'phrase', 'unknown', 'Unknown', 1),
(110, 'phrase', 'shared_file', 'Shared a File', 1),
(111, 'phrase', 'banned', 'Banned', 1),
(112, 'phrase', 'unban', 'Unban', 1),
(113, 'phrase', 'created_group', 'Created Group', 1),
(114, 'phrase', 'zero_complaints', 'Griefs', 1),
(115, 'phrase', 'complaints', 'Griefs', 1),
(116, 'phrase', 'report_message', 'Report Message', 1),
(117, 'phrase', 'reported', 'Reported', 1),
(118, 'phrase', 'spam', 'Spam', 1),
(119, 'phrase', 'abuse', 'Abuse', 1),
(120, 'phrase', 'inappropriate', 'Inappropriate', 1),
(121, 'phrase', 'other', 'Other', 1),
(123, 'phrase', 'under_investigation', 'Under Investigation', 1),
(124, 'phrase', 'rejected', 'Rejected', 1),
(125, 'phrase', 'action_taken', 'Action Taken', 1),
(127, 'phrase', 'view_complaint', 'View Grief', 1),
(128, 'phrase', 'proof', 'Proof', 1),
(129, 'phrase', 'timestamp', 'Timestamp', 1),
(130, 'phrase', 'report_group', 'Report Group', 1),
(131, 'phrase', 'invited', 'Invited', 1),
(132, 'phrase', 'alert_invitation', 'Invited you to Join', 1),
(133, 'phrase', 'alert_mentioned', 'Mentioned you', 1),
(134, 'phrase', 'open', 'Open', 1),
(135, 'phrase', 'view_message', 'View Message', 1),
(136, 'phrase', 'message', 'Message', 1),
(137, 'phrase', 'change_avatar', 'Change Avatar', 1),
(138, 'phrase', 'choose_avatar', 'Choose an Avatar', 1),
(139, 'phrase', 'left_group', 'Left the Group Chat', 1),
(140, 'phrase', 'joined_group', 'Joined the Group Chat', 1),
(141, 'phrase', 'alert_replied', 'Sent you a response', 1),
(144, 'phrase', 'date-time', 'Date &amp; Time', 1),
(145, 'phrase', 'sender', 'Sender', 1),
(146, 'phrase', 'you', 'You', 1),
(147, 'phrase', 'exporting', 'Exporting', 1),
(148, 'phrase', 'invalid_captcha', 'Invalid Captcha', 1),
(150, 'phrase', 'remember_me', 'Remember Me', 1),
(151, 'phrase', 'forgot_password', 'Forgot Password', 1),
(152, 'phrase', 'register', 'Register', 1),
(153, 'phrase', 'reset', 'Reset', 1),
(154, 'phrase', 'already_have_account', 'Already have an account?', 1),
(155, 'phrase', 'dont_have_account', 'Donot have an account?', 1),
(156, 'phrase', 'tos', 'Terms of Service', 1),
(157, 'phrase', 'cookie_constent', 'This website uses cookies to ensure you get the best experience on our website.', 1),
(158, 'phrase', 'got_it', 'Got It', 1),
(159, 'phrase', 'user_does_not_exist', 'User Does not Exist', 1),
(160, 'phrase', 'check_inbox', 'Please Check your Inbox', 1),
(161, 'phrase', 'email_reset_title', 'Trouble signing in?', 1),
(162, 'phrase', 'email_reset_desc', 'Resetting your password is easy. Just press the button below and once logged in, you can change your password from edit profile tab.', 1),
(163, 'phrase', 'email_reset_btn', 'Auto Login', 1),
(164, 'phrase', 'email_replied_title', 'Awaiting your reply', 1),
(165, 'phrase', 'email_replied_desc', 'You received this email because someone has replied to your message', 1),
(166, 'phrase', 'email_replied_btn', 'View Reply', 1),
(167, 'phrase', 'email_invitation_title', 'You got an Invitation', 1),
(168, 'phrase', 'email_invitation_desc', 'You received this email because someone has invited you to join a group', 1),
(169, 'phrase', 'email_invitation_btn', 'View Message', 1),
(170, 'phrase', 'email_mentioned_title', 'Someone Mentioned You', 1),
(171, 'phrase', 'email_mentioned_desc', 'You received this email because someone has mentioned you in a group chat', 1),
(172, 'phrase', 'email_mentioned_btn', 'View Message', 1),
(173, 'phrase', 'email_signup_title', 'Profile Registered', 1),
(174, 'phrase', 'email_signup_desc', 'Congratulations! Your account has been created. Just press the button below and once logged in, you can change your password from edit profile tab.', 1),
(175, 'phrase', 'email_signup_btn', 'Auto Login', 1),
(176, 'phrase', 'email_reset_sub', 'Forgot Your Password', 1),
(177, 'phrase', 'email_replied_sub', 'You got a Reply', 1),
(178, 'phrase', 'email_invitation_sub', 'Group Invitation', 1),
(179, 'phrase', 'email_mentioned_sub', 'Mentioned you', 1),
(180, 'phrase', 'email_signup_sub', 'Account Created', 1),
(181, 'phrase', 'email_verify_title', 'You&amp;#039;re almost there', 1),
(182, 'phrase', 'email_verify_desc', 'We have finished setting up your account. It is time to confirm your email address. Just click on the button below to get started', 1),
(183, 'phrase', 'email_verify_btn', 'Confirm Email', 1),
(184, 'phrase', 'email_footer', 'If you dont know why you got this email, please tell us straight away so we can fix this for you.', 1),
(185, 'phrase', 'email_complimentary_close', 'Best regards,', 1),
(186, 'phrase', 'email_verify_sub', 'Verify your email address', 1),
(187, 'phrase', 'email_copy_link', 'Or copy this link and paste in your web browser', 1),
(188, 'phrase', 'sitename', 'Site Name', 1),
(189, 'phrase', 'sitedesc', 'Description', 1),
(190, 'phrase', 'sysemail', 'Email Address', 1),
(191, 'phrase', 'sendername', 'Sender Name', 1),
(192, 'phrase', 'userreg', 'User Registration', 1),
(193, 'phrase', 'fileexpiry', 'Download Expires (Minutes)', 1),
(194, 'phrase', 'delmsgexpiry', 'Users can delete Messages Within (Minutes)', 1),
(195, 'phrase', 'recaptcha', 'Recaptcha', 1),
(196, 'phrase', 'rsecretkey', 'Recaptcha Secret Key', 1),
(197, 'phrase', 'rsitekey', 'Recaptcha Site Key', 1),
(198, 'phrase', 'autogroupjoin', 'Auto Group Join', 1),
(199, 'phrase', 'enable', 'Enable', 1),
(200, 'phrase', 'disable', 'Disable', 1),
(201, 'phrase', 'logo', 'Logo', 1),
(202, 'phrase', 'favicon', 'Favicon', 1),
(203, 'phrase', 'emaillogo', 'Logo (Email)', 1),
(204, 'phrase', 'defaultbg', 'Default Bg', 1),
(205, 'phrase', 'loginbg', 'Login Bg', 1),
(206, 'phrase', 'terms', '1. Terms\r\nBy accessing this website, you are agreeing to be bound by the Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this website. The content contained here are protected by applicable copyright and trade mark laws. Please take the time to review our privacy policy.\r\n\r\n2. Use License\r\nPermission is granted for the temporary use of the group chat, filemanager on web site for personal, non-commercial use only. This is the grant of the services, not a transfer of title, and under this license you may not: modify or copy the materials; use the materials for any commercial purpose, or for any public display (commercial or non-commercial); attempt to decompile or reverse engineer any software contained on the website; remove any copyright or other proprietary notations from the materials; or transfer the materials to another person or &amp;quot;mirror&amp;quot; the materials on any other website or server. This license shall automatically terminate if you violate any of these restrictions and may be terminated by the website at any time.\r\n\r\n3. Disclaimer\r\nThe content on the website are provided &amp;quot;as is&amp;quot;. We makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Furthermore, We does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the content on its website or otherwise relating to such content or on any sites linked to this site.\r\n\r\n4. Limitations\r\nIn no event shall we be liable for any damages (including, without limitation, damages for loss of data or profit, due to business interruption, or criminal charges filed against you) arising out of the use or inability to use the content on the website, even if we or a authorized representative has been notified orally or in writing of the possibility of such damage. This applies to the use of our chat rooms and filemanager. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.\r\n\r\n5. Revisions and Errata\r\nThe materials appearing on the website could include technical, typos, or image errors. We does not warrant that any of the content on its website are accurate, complete, or current. We may make changes to the content on its website at any time without any noticeWe does not, however, make any commitment to update the content.\r\n\r\n6. Links\r\nWe has not reviewed all of the sites linked from its website and is not responsible for the contents contained within. The inclusion of any link does not imply endorsement by us. Use of any such linked web site is at the user&amp;#039;s own risk.\r\n\r\n7. Age Limitations\r\nIn general, the age minimum for this webs site is 13. This website will not be held responsible for users who do not comply with the given age range as this information is not verifiable.\r\n\r\n8. Hateful Content\r\nWe does not tolerate any form of hateful or violent content in our chat rooms or on our forums. This includes threats, promotion of violence or direct attacks towards other users based upon ethnicity, race, religion, sexual orientation, religion affiliation, age, disability, serious diseases and gender. Users also are prohibited from using hateful images for their profile pictures/avatars. This includes usernames. All such comment will be removed when noticed or reported to our staff.\r\n\r\n9. Illegal Content\r\nWe does not tolerate any form of illegal content in our chat rooms or on our forums. Users also are prohibited from using or uploading illegal images including child pornography or other illegal content. This includes, but not limited to, profile pictures/avatars and any image transfers or uploads. This includes usernames. If you do so, you will be subject to being kicked, banned and, in some cases, reported to law enforcement. We will, to its highest ability, remove all illegal content when it is discovered or reported to us. We will not be held responsible for such content unless it is noticed and reported to our staff.\r\n\r\n10. Terms of Use Changes\r\nWe may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use. If you cannot agree to this, please do not use this website.', 1),
(207, 'phrase', '404_page_title', '404 - Page not found', 1),
(208, 'phrase', '404_page_oops', 'Oops!', 1),
(209, 'phrase', '404_page_heading', '404 - Page not found', 1),
(210, 'phrase', '404_page_desc', 'The page you are looking for might have been removed had its name changed or is temporarily unavailable.', 1),
(211, 'phrase', '404_page_go_to_btn', 'Go To Homepage', 1),
(212, 'phrase', 'reload', 'Reload', 1),
(213, 'phrase', 'reason', 'Reason', 1),
(214, 'phrase', 'comments', 'Comments', 1),
(215, 'phrase', 'category', 'Category', 1),
(216, 'phrase', 'group', 'Group', 1),
(217, 'phrase', 'view_all', 'View All', 1),
(218, 'phrase', 'admin_controls', 'Admin Controls', 1),
(219, 'phrase', 'upload', 'Upload', 1),
(220, 'phrase', 'attach', 'Share Files', 1),
(221, 'phrase', 'login_as_user', 'Login as User', 1),
(222, 'phrase', 'yes', 'Yes', 1),
(223, 'phrase', 'no', 'No', 1),
(224, 'phrase', 'remove_password', 'Remove Password', 1),
(226, 'phrase', 'edit_language', 'Edit Language', 1),
(227, 'phrase', 'siteslogan', 'Site Slogan', 1),
(228, 'phrase', 'boxed', 'Boxed', 1),
(229, 'phrase', 'ip_blocked', 'Your IP has been blocked', 1),
(230, 'phrase', 'act', 'Act', 1),
(231, 'phrase', 'take_action', 'Take Action', 1),
(232, 'phrase', 'select_option', 'Select Option from Dropdown', 1),
(233, 'phrase', 'banip', 'Ban IP', 1),
(234, 'phrase', 'unbanip', 'Unban IP', 1),
(235, 'phrase', 'choosefiletxt', 'Choose a file', 1),
(236, 'phrase', 'private_chat', 'Private Chat', 1),
(237, 'phrase', 'pm', 'PM', 1),
(238, 'phrase', 'zero_pm', 'Empty Inbox', 1),
(469, 'phrase', 'cf_about_me', 'About Me', 1),
(470, 'phrase', 'cf_birth_date', 'Birth Date', 1),
(471, 'phrase', 'cf_gender', 'Gender', 1),
(472, 'phrase', 'cf_phone', 'Phone', 1),
(474, 'phrase', 'cf_location', 'Location', 1),
(475, 'phrase', 'alert_newmsg', 'Started a chat', 1),
(478, 'phrase', 'refresh', 'Refresh', 1),
(479, 'phrase', 'hearts', 'Hearts', 1),
(480, 'phrase', 'shares', 'Shares', 1),
(481, 'phrase', 'last_login', 'Last Login', 1),
(483, 'phrase', 'empty_profile', 'Empty Profile', 1),
(484, 'phrase', 'delete_account', 'Delete Account', 1),
(485, 'phrase', 'remove_user', 'Remove User', 1),
(486, 'phrase', 'login_as_guest', 'Login as Guest', 1),
(487, 'phrase', 'guest_login', 'Guest Login', 1),
(488, 'phrase', 'filterwords', 'Filter Words', 1),
(489, 'phrase', 'fields', 'Fields', 1),
(490, 'phrase', 'stand_by', 'Stand By', 1),
(491, 'phrase', 'add_custom_field', 'Add Field', 1),
(492, 'phrase', 'banned_page_title', 'You Are Banned', 1),
(493, 'phrase', 'banned_page_ouch', 'ouch', 1),
(494, 'phrase', 'banned_page_heading', 'You are banned', 1),
(495, 'phrase', 'banned_page_desc', 'Access denied. Your IP address or Account is blacklisted. If you feel this is in error please contact website&amp;#039;s administrator.', 1),
(496, 'phrase', 'banned_page_go_to_btn', 'Reach Us', 1),
(497, 'phrase', 'conversation_with', 'Conversation With', 1),
(498, 'phrase', 'email_newmsg_title', 'New Message', 1),
(499, 'phrase', 'email_newmsg_btn', 'View Message', 1),
(500, 'phrase', 'email_newmsg_desc', 'You have a new message. Your have received a message from Someone.', 1),
(501, 'phrase', 'account_reactivated', 'Account Reactivated. Welcome Back', 1),
(1279, 'phrase', 'renamed_group', 'Changed the Group Name', 1),
(1280, 'phrase', 'changed_group_pass', 'Changed the Group Password', 1),
(1281, 'phrase', 'removed_group_pass', 'Removed the Group Password', 1),
(1282, 'phrase', 'changed_group_icon', 'Changed the Group Icon', 1),
(1283, 'phrase', 'blocked_group_user', 'Got Blocked', 1),
(1284, 'phrase', 'unblocked_group_user', 'Got Unblocked', 1),
(1285, 'phrase', 'removed_from_group', 'Got removed from Group', 1),
(1552, 'phrase', 'deactivate_account', 'Deactivate Account', 1),
(1553, 'phrase', 'longtext', 'Long Text', 1),
(1554, 'phrase', 'datefield', 'Date Field', 1),
(1555, 'phrase', 'shorttext', 'Short Text', 1),
(1556, 'phrase', 'numfield', 'Numbers', 1),
(1557, 'phrase', 'deactivated', 'Deactivated', 1),
(1558, 'phrase', 'converse', 'Converse', 1),
(1559, 'phrase', 'blacklist', 'Blacklisted', 1),
(1560, 'phrase', 'block_user', 'Block User', 1),
(1561, 'phrase', 'zero_fields', 'Fields', 1),
(1838, 'phrase', 'fieldname', 'Field Name', 1),
(1839, 'phrase', 'fieldtype', 'Field Type', 1),
(1840, 'phrase', 'ban_user', 'Ban Users', 1),
(1841, 'phrase', 'view_likes', 'View Likes', 1),
(1842, 'phrase', 'like_msgs', 'Like Messages', 1),
(1843, 'phrase', 'view_profile', 'View Profile', 1),
(2126, 'phrase', 'privatemsg', 'Private Message', 1),
(2127, 'phrase', 'autodeletemsg', 'Auto Delete Group Msgs (Minutes)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gr_profiles`
--

CREATE TABLE `gr_profiles` (
  `id` int(255) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `uid` int(255) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `cat` varchar(10) NOT NULL,
  `v1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gr_profiles`
--

INSERT INTO `gr_profiles` (`id`, `type`, `uid`, `name`, `cat`, `v1`) VALUES
(3, 'field', 0, 'cf_about_me', 'longtext', NULL),
(4, 'field', 0, 'cf_birth_date', 'datefield', NULL),
(5, 'field', 0, 'cf_gender', 'shorttext', NULL),
(6, 'field', 0, 'cf_phone', 'numfield', NULL),
(8, 'field', 0, 'cf_location', 'shorttext', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gr_session`
--

CREATE TABLE `gr_session` (
  `id` int(255) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `tms` datetime NOT NULL,
  `try` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gr_users`
--

CREATE TABLE `gr_users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mask` varchar(255) NOT NULL,
  `depict` int(5) NOT NULL DEFAULT '1',
  `role` int(10) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `altered` datetime NOT NULL,
  `extra` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gr_users`
--

INSERT INTO `gr_users` (`id`, `name`, `email`, `pass`, `mask`, `depict`, `role`, `created`, `altered`, `extra`) VALUES
(28, 'admin', 'hello@abc.com', '5ed9feac590fd465d415be9efe80a4f9e0a4394d', 'QBD1f5eusXup2', 9, 2, '2019-04-11 16:54:11', '2019-12-09 23:38:15', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gr_utrack`
--

CREATE TABLE `gr_utrack` (
  `id` int(255) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `dev` varchar(255) DEFAULT NULL,
  `uid` int(255) DEFAULT NULL,
  `status` int(10) DEFAULT '0',
  `tms` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gr_alerts`
--
ALTER TABLE `gr_alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_complaints`
--
ALTER TABLE `gr_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_customize`
--
ALTER TABLE `gr_customize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_mails`
--
ALTER TABLE `gr_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_msgs`
--
ALTER TABLE `gr_msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_options`
--
ALTER TABLE `gr_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_permissions`
--
ALTER TABLE `gr_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_phrases`
--
ALTER TABLE `gr_phrases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_profiles`
--
ALTER TABLE `gr_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_session`
--
ALTER TABLE `gr_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gr_users`
--
ALTER TABLE `gr_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `gr_utrack`
--
ALTER TABLE `gr_utrack`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gr_alerts`
--
ALTER TABLE `gr_alerts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gr_complaints`
--
ALTER TABLE `gr_complaints`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gr_customize`
--
ALTER TABLE `gr_customize`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `gr_mails`
--
ALTER TABLE `gr_mails`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `gr_msgs`
--
ALTER TABLE `gr_msgs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `gr_options`
--
ALTER TABLE `gr_options`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `gr_permissions`
--
ALTER TABLE `gr_permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gr_phrases`
--
ALTER TABLE `gr_phrases`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2128;

--
-- AUTO_INCREMENT for table `gr_profiles`
--
ALTER TABLE `gr_profiles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `gr_session`
--
ALTER TABLE `gr_session`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gr_users`
--
ALTER TABLE `gr_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `gr_utrack`
--
ALTER TABLE `gr_utrack`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
