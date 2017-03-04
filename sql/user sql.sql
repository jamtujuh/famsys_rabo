-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2011 at 09:34 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `famsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `department_id` int(3) NOT NULL,
  `department_sub_id` int(11) DEFAULT NULL,
  `department_unit_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT '0',
  `last_password_change` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `department_id` (`department_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `aktif`, `last_password_change`) VALUES
(2, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 1, 72, 36, 56, 2, 108, 1, '2011-06-23 10:26:15'),
(3, 'zefan', 'heri@admin.com', 'ed819b79e217387601219bc23d8d1f1f', 'heri', 2, 2, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(4, 'approval1', 'ade@admin.com', 'a364f50058f6ee7b61e4ac41d4539d76', 'ade', 3, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(5, 'approval2', 'badu@admin.com', '4ec3587292f5141d0a8b2a59bc347254', 'badu', 4, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(7, 'procurement', 'admin@admin.com', '93aa88d53279ccb3e40713d4396e198f', 'gs', 7, 72, 36, 56, 2, 128, 1, '2011-06-23 10:26:15'),
(8, 'retno', 'admin@admin.com', 'edd39370424d54db23ccec123f0ce66b', 'cabang', 6, 2, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(9, 'fincon', 'fincon@admin.com', '766a69946883ddc09289ac08e256e4b0', 'fincon', 8, 72, 15, 18, 2, 22, 1, '2011-06-23 10:26:15'),
(13, 'gsadmin', 'gs_admin@admin.com', '63bb701534249b5e2b237a51c6ccc5fe', 'gs_admin', 10, 72, 36, 56, 2, 128, 1, '2011-06-23 10:26:15'),
(14, 'itadmin', 'it_admin@admin.com', '0ef35d4cd2027a1e54dac7c588f62792', 'it_admin', 12, 72, 36, 55, 2, 103, 1, '2011-06-23 10:26:15'),
(15, 'famanagement', 'admin@admin.com', '09ef74f6311cf3b59beb965126221047', 'fa_management', 11, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(16, 'itmanagement', 'it_management@admin.com', '7b55409a9cf7a808add36980e0a97858', 'it_management', 13, 72, 36, 55, 2, 107, 1, '2011-06-23 10:26:15'),
(17, 'stockmanagement', 'admin@admin.com', '00fdea5b40a423937df95fc997af589c', 'stock_management', 14, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(18, 'stockspv', 'stock_supervisor@admin.com', 'fb48d0800fe63081ab54ae3dc55f871a', 'stock_supervisor', 100, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(19, 'faspv', 'fa_spv@admin.com', '2baa33d2bb39229a3d6b4bec3b84076b', 'fa_supervisor', 15, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(20, 'itspv', 'it_spv@admin.com', '03fa13cbcb12b14707457c882d16db59', 'it_supervisor', 16, 72, 43, 106, 2, 107, 1, '2011-06-23 10:26:15'),
(21, 'afong', 'cabang2@admin.com', 'c39137ab6890c63dd1e816ae63448358', 'cabang2', 6, 5, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(22, 'rahma', 'cabang3@admin.com', 'b007b7d6520a7b3dcccd2a1ec2891009', 'cabang3', 6, 1, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(23, 'jonny', 'heri2@admin.com', '17f1df9f24dcdbbad02ae0f620e4ca53', 'heri2', 2, 5, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(24, 'ninis', 'heri3@admin.com', 'd821115b3e668dd473a89cad3e2816cc', 'heri3', 2, 1, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(38, 'gsspv', 'gs_spv@admin.com', 'b0aafbb1367f355faa23ff5363612d28', 'gs_spv', 9, 72, NULL, NULL, 2, 128, 1, NULL),
(39, 'finconspv', 'fincon_spv@admin.com', 'd2bfa4ec9ed73a45b47696cfc8329f2f', 'fincon_spv', 20, 72, NULL, NULL, 2, 128, 1, NULL),
(43, 'yuyun', 'cabang4@yahoo.com', '525650a65f97e3d7c95e6a0ffc01e685', 'cabang4', 6, 9, NULL, NULL, 2, 1, 1, NULL),
(42, 'wanti', 'heri4@yahoo.com', '432def2681d1635fa158ef97246be732', 'heri4', 2, 9, NULL, NULL, 2, 1, 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
