-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2011 at 06:36 PM
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
-- Table structure for table `fa_supplier_returs`
--

CREATE TABLE IF NOT EXISTS `fa_supplier_returs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_date` date NOT NULL,
  `no` varchar(20) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `notes` text,
  `fa_supplier_retur_status_id` int(11) NOT NULL,
  `reject_notes` text,
  `reject_by` varchar(50) DEFAULT NULL,
  `reject_date` datetime DEFAULT NULL,
  `cancel_notes` text,
  `cancel_by` varchar(50) DEFAULT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `business_type_id` (`business_type_id`,`cost_center_id`),
  KEY `po_id` (`po_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fa_supplier_returs`
--

INSERT INTO `fa_supplier_returs` (`id`, `doc_date`, `no`, `department_id`, `business_type_id`, `cost_center_id`, `created_by`, `notes`, `fa_supplier_retur_status_id`, `reject_notes`, `reject_by`, `reject_date`, `cancel_notes`, `cancel_by`, `cancel_date`, `po_id`) VALUES
(3, '2011-07-11', 'SRET-01', 2, 2, 128, 'generalservice', '', 2, '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0),
(2, '2011-07-11', 'SUP-RET1', 1, 2, 128, 'generalservice', '', 3, '', '', '2031-01-01 00:00:00', '', '', '2031-01-01 00:00:00', 0),
(4, '2011-07-11', 'SRET-02', 1, 2, 128, 'generalservice', '', 4, '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0),
(5, '2011-07-11', 'SRET-03', 1, 2, 128, 'generalservice', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fa_supplier_retur_details`
--

CREATE TABLE IF NOT EXISTS `fa_supplier_retur_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_supplier_retur_id` int(11) NOT NULL,
  `asset_detail_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `color` varchar(64) DEFAULT NULL,
  `serial_no` varchar(64) DEFAULT NULL,
  `date_of_purchase` date NOT NULL,
  `notes` text NOT NULL,
  `code` varchar(40) NOT NULL,
  `item_code` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fa_retur_id` (`fa_supplier_retur_id`),
  KEY `asset_detail_id` (`asset_detail_id`),
  KEY `asset_category_id` (`asset_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fa_supplier_retur_details`
--

INSERT INTO `fa_supplier_retur_details` (`id`, `fa_supplier_retur_id`, `asset_detail_id`, `asset_category_id`, `brand`, `type`, `color`, `serial_no`, `date_of_purchase`, `notes`, `code`, `item_code`, `name`) VALUES
(1, 1, 15, 9, NULL, 'KR3', 'Cream', NULL, '1970-01-01', '', 'RDS.001.UID/02.011/0310', '7KRS001', 'KURSI KERJA'),
(2, 1, 16, 9, NULL, 'KR3', 'Abu-abu', NULL, '1970-01-01', '', 'RDS.001.UID/02.012/0310', '7KRS001', 'KURSI KERJA'),
(3, 2, 403, 6, 'ibm', 'ddd', 'aaa', NULL, '2011-07-11', '', 'ABM.HRD/012/0711', '', 'laptop'),
(4, 2, 404, 6, 'ibm', 'ddd', 'aaa', NULL, '2011-07-11', '', 'ABM.HRD/013/0711', '', 'laptop'),
(5, 3, 375, 6, 'ibm', '5656', 'black', NULL, '2011-07-11', '', 'RDS.HRD/001/1107', '', 'komputer'),
(6, 3, 376, 6, 'ibm', '5656', 'black', NULL, '2011-07-11', '', 'RDS.HRD/002/1107', '', 'komputer'),
(11, 4, 1, 9, NULL, 'BOX', 'Hijau', NULL, '1989-12-19', 'rodanya rusak', 'ABM.001.TLR/02.318/0809', '7BOX001', 'CASH BOX'),
(12, 4, 2, 8, NULL, 'MJ2', 'Coklat', NULL, '1991-04-10', 'rodanya rusak', 'ABM.001.BO/01.136/0809', '7MJA001', 'MEJA KERJA'),
(13, 5, 3, 9, NULL, 'KURS', '-', NULL, '1993-11-23', '', 'ABM.001.BKL/02.191/0809', '7PAN002', 'PAPAN KURS'),
(14, 5, 4, 9, NULL, 'TELL', '-', NULL, '1989-11-17', '', 'ABM.001.BO/02.176/0809', '7MSN002', 'MESIN TELLSTROKE');

-- --------------------------------------------------------

--
-- Table structure for table `fa_supplier_retur_statuses`
--

CREATE TABLE IF NOT EXISTS `fa_supplier_retur_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `fa_supplier_retur_statuses`
--

INSERT INTO `fa_supplier_retur_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Sent to GS Supervisor'),
(3, 'Processing'),
(4, 'Finish'),
(5, 'Cancel'),
(6, 'Reject'),
(7, 'Archive');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
