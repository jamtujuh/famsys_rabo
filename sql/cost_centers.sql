-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2011 at 05:35 PM
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
-- Table structure for table `cost_centers`
--

DROP TABLE IF EXISTS `cost_centers`;
CREATE TABLE IF NOT EXISTS `cost_centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_Id` varchar(255) NOT NULL,
  `business_type_id` varchar(11) NOT NULL,
  `division` varchar(11) NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `sub_division` varchar(11) NOT NULL,
  `sub_division_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(11) NOT NULL,
  `organization_level` varchar(255) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `cost_centers`
--

INSERT INTO `cost_centers` (`id`, `organization_Id`, `business_type_id`, `division`, `division_name`, `sub_division`, `sub_division_name`, `name`, `code`, `organization_level`, `desc`) VALUES
(1, 'CMCM', '1', 'CM', 'Compliance', 'CMCM', 'Compliance-Sub Div', 'Compliance - Sub Div', 'CM000000', 'Sub Division', NULL),
(2, 'CMCMA', '1', 'CM', 'Compliance', 'CMCM', 'Compliance - Sub Div', 'Advisory & Assurance', 'CM010000', 'Department', NULL),
(3, 'CMCMC', '1', 'CM', 'Compliance', 'CMCM', 'Compliance - Sub Div', 'Special Unit of CDD', 'CM020000', 'Department', NULL),
(4, 'CM', '1', 'CM', 'Compliance', '', '', 'Compliance', 'CM000000', 'Division', NULL),
(5, 'CR', '1', 'CR', 'Core Banking Project', '', '', 'Core Banking Project', 'CR000000', 'Division', NULL),
(6, 'CRCRB', '1', 'CR', 'Core Banking Project', '', '', 'Core Banking Project', 'CR000000', 'Department', NULL),
(7, 'CBCB', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Corporate Banking - Sub Div', 'CB000000', 'Sub Division', NULL),
(8, 'CBCBB', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Corporate Finance', 'CB010000', 'Department', NULL),
(9, 'CBCBC', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Financial Institution', 'CB020000', 'Department', NULL),
(10, 'CBCBD', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'MACA', 'CB030000', 'Department', NULL),
(11, 'CBCBE', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Relationship Management', 'CB040000', 'Department', NULL),
(12, 'CBCBF', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'STCF', 'CB050000', 'Department', NULL),
(13, 'CBCBG', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Transactional Service', 'CB060000', 'Department', NULL),
(14, 'CBCBH', '1', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Trade Finance Information', 'CB070000', 'Department', NULL),
(15, 'CB', '1', 'CB', 'Corporate Banking', '', '', 'Corporate Banking', 'CB000000', 'Division', NULL),
(16, 'CCCC', '1', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Corporate Communications - Sub Div', 'CC000000', 'Sub Division', NULL),
(17, 'CCCCA', '1', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Advertising & Promotions', 'CC010000', 'Department', NULL),
(18, 'CCCCB', '1', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Creative Advertising ', 'CC020000', 'Department', NULL),
(19, 'CCCCD', '1', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Internal Communications & E-Communications ', 'CC030000', 'Department', NULL),
(20, 'CCCCE', '1', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Public and Media Relations & CSR ', 'CC040000', 'Department', NULL),
(21, 'CC', '1', 'CC', 'Corporate Communications', '', '', 'Corporate Communications', 'CC000000', 'Division', NULL),
(22, 'FRFC', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Financial Control', 'FC000000', 'Sub Division', NULL),
(23, 'FRFCC', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'BI Reporting, Tax & Project', 'FC010000', 'Department', NULL),
(24, 'FRFCCB', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'BI Reporting', 'FC010100', 'Unit', NULL),
(25, 'FRFCCC', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Tax', 'FC010200', 'Unit', NULL),
(26, 'FRFCCD', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'IT Finance & Project', 'FC010300', 'Unit', NULL),
(27, 'FRFCD', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'MIS-HO Reporting & Accounting', 'FC020000', 'Department', NULL),
(28, 'FRFCDB', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'MIS & HO Reporting', 'FC020100', 'Unit', NULL),
(29, 'FRFCDC', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Accounting', 'FC020200', 'Unit', NULL),
(30, 'FRFCDD', '1', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Regional Office Accounting', 'FC020300', 'Unit', NULL),
(31, 'FRLG', '1', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal', 'LG000000', 'Sub Division', NULL),
(32, 'FRLGAA', '1', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal - Counsel, Retail', 'LG010000', 'Department', NULL),
(33, 'FRLGAB', '1', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal - Remedial Legal Team', 'LG020000', 'Department', NULL),
(34, 'FRLGAC', '1', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal - Counsel, Wholesale/Commercial', 'LG030000', 'Department', NULL),
(35, 'FRPM', '1', 'FR', 'Finance & Risk Management', 'FRPM', 'Project Management', 'Project Management', 'PM000000', 'Sub Division', NULL),
(36, 'FRRM', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Risk Management', 'RM000000', 'Sub Division', NULL),
(37, 'FRRMB', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Operational Risk', 'RM010000', 'Department', NULL),
(38, 'FRRMBA', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Operational Risk', 'RM010000', 'Unit', NULL),
(39, 'FRRMC', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk', 'RM020000', 'Department', NULL),
(40, 'FRRMCB', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk Wholesale', 'RM020100', 'Unit', NULL),
(41, 'FRRMCC', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk Commercial & SME', 'RM020200', 'Unit', NULL),
(42, 'FRRMCCA', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'SME Analyst', 'RM020201', 'Sub Unit', NULL),
(43, 'FRRMCCB', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Commercial Analyst', 'RM020202', 'Sub Unit', NULL),
(44, 'FRRMCCC', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Appraisal and Property Management', 'RM020203', 'Sub Unit', NULL),
(45, 'FRRMCG', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Secretary', 'RM020300', 'Unit', NULL),
(46, 'FRRMD', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Commodity Support Group', 'RM030000', 'Department', NULL),
(47, 'FRRME', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Special Assets Management', 'RM040000', 'Department', NULL),
(48, 'FRRMF', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk Admin', 'RM050000', 'Department', NULL),
(49, 'FRRMFB', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Support & Reporting', 'RM050100', 'Unit', NULL),
(50, 'FRRMFC', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'CRA Wholesale', 'RM050200', 'Unit', NULL),
(51, 'FRRMFD', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'CRA Retail', 'RM050300', 'Unit', NULL),
(52, 'FRRMG', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Market Risk', 'RM060000', 'Department', NULL),
(53, 'FRRMH', '1', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Portfolio Management', 'RM070000', 'Department', NULL),
(54, 'FR', '1', 'FR', 'Finance & Risk Management', '', '', 'Finance & Risk Management', 'RM000000', 'Division', NULL),
(55, 'HRHR', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Human Resources - Sub Div', 'HR000000', 'Sub Division', NULL),
(56, 'HRHRA', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Compensation and Benefit', 'HR010000', 'Department', NULL),
(57, 'HRHRAB', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HR Payroll', 'HR010100', 'Unit', NULL),
(58, 'HRHRAC', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HRIS', 'HR010200', 'Unit', NULL),
(59, 'HRHRB', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Employee Relations and Communications', 'HR020000', 'Department', NULL),
(60, 'HRHRBA', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Employee Relations and Communication', 'HR020000', 'Unit', NULL),
(61, 'HRHRBB', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Outsourcing', 'HR020000', 'Unit', NULL),
(62, 'HRHRBC', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HRRM', 'HR020000', 'Unit', NULL),
(63, 'HRHRD', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HR Services and Administration', 'HR030000', 'Department', NULL),
(64, 'HRHRE', '1', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Learning and Development', 'HR040000', 'Department', NULL),
(65, 'HR', '1', 'HR', 'Human Resources', '', '', 'Human Resources', 'HR000000', 'Division', NULL),
(66, 'IAIA', '1', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Internal Audit - Sub Div', 'IA000000', 'Sub Division', NULL),
(67, 'IAIAB', '1', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Ops & IT Audit', 'IA010000', 'Department', NULL),
(68, 'IAIAC', '1', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Retail and SME Audit', 'IA020000', 'Department', NULL),
(69, 'IAIAD', '1', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Wholesale Banking and HO Function Audit', 'IA030000', 'Department', NULL),
(70, 'IA', '1', 'IA', 'Internal Audit', '', '', 'Internal Audit', 'IA000000', 'Division', NULL),
(71, 'OIOI', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Operations & IT - Sub Div', 'OI000000', 'Sub Division', NULL),
(72, 'OIOIA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Security & BCM', 'OI010000', 'Department', NULL),
(73, 'OIOIAB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'BCM', 'OI010100', 'Unit', NULL),
(74, 'OIOIAC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Security Operations', 'OI010200', 'Unit', NULL),
(75, 'OIOIAD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Security Risk Management', 'OI010300', 'Unit', NULL),
(76, 'OIOIAE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Source Code Control', 'OI010400', 'Unit', NULL),
(77, 'OIOIB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Central Operations Asset', 'OI020000', 'Department', NULL),
(78, 'OIOIBB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Loan Operations', 'OI020100', 'Unit', NULL),
(79, 'OIOIBBC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Retail Loan Operations', 'OI020101', 'Sub Unit', NULL),
(80, 'OIOIBBD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Wholesale Loan Operations', 'OI020102', 'Sub Unit', NULL),
(81, 'OIOIBC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'International Trade Services', 'OI020200', 'Unit', NULL),
(82, 'OIOIBCB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Structure Trade Commodity Fin.', 'OI020201', 'Sub Unit', NULL),
(83, 'OIOIBCC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'International Trade & Services', 'OI020202', 'Sub Unit', NULL),
(84, 'OIOIBCD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Trade Loan', 'OI020203', 'Sub Unit', NULL),
(85, 'OIOIC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Central Operations Liabilities + FX', 'OI030000', 'Department', NULL),
(86, 'OIOICB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Cash Management', 'OI030100', 'Unit', NULL),
(87, 'OIOICC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Settlements', 'OI030200', 'Unit', NULL),
(88, 'OIOICCB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Bill Payment', 'OI030201', 'Sub Unit', NULL),
(89, 'OIOICCC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Local Clearing', 'OI030202', 'Sub Unit', NULL),
(90, 'OIOICCD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Cek & BG Printing', 'OI030203', 'Sub Unit', NULL),
(91, 'OIOICCE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'International Clearing', 'OI030204', 'Sub Unit', NULL),
(92, 'OIOICCF', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Central Processing', 'OI030205', 'Sub Unit', NULL),
(93, 'OIOICD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Treasury Operations', 'OI030300', 'Unit', NULL),
(94, 'OIOICE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Card and E-banking', 'OI030400', 'Unit', NULL),
(95, 'OIOID', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Delivery Channel', 'OI040000', 'Department', NULL),
(96, 'OIOIDB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Contact Center', 'OI040100', 'Unit', NULL),
(97, 'OIOIDC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations', 'OI040200', 'Unit', NULL),
(98, 'OIOIDDA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations', 'OI040201', 'Sub Unit', NULL),
(99, 'OIOIDFA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations - Office Support', 'OI040202', 'Sub Unit', NULL),
(100, 'OIOIDGA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations - Security', 'OI040203', 'Sub Unit', NULL),
(101, 'OIOIDI', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Wealth Management Operations', 'OI040300', 'Unit', NULL),
(102, 'OIOIE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'IT Infrastructure', 'OI050000', 'Department', NULL),
(103, 'OIOIEB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Business Support', 'OI050100', 'Unit', NULL),
(104, 'OIOIEC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Data Center', 'OI050200', 'Unit', NULL),
(105, 'OIOIEE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Client Support', 'OI050300', 'Unit', NULL),
(106, 'OIOIEF', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Network Support', 'OI050400', 'Unit', NULL),
(107, 'OIOIEG', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - System Support', 'OI050500', 'Unit', NULL),
(108, 'OIOIEH', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Help Desk', 'OI050600', 'Unit', NULL),
(109, 'OIOIF', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Project Management & Business Process Improvement', 'OI070000', 'Department', NULL),
(110, 'OIOIFA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Operations Management', 'OI000000', 'Unit', NULL),
(111, 'OIOIG', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Operations Development & Support', 'OI080000', 'Department', NULL),
(112, 'OIOIGB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations Support', 'OI080100', 'Unit', NULL),
(113, 'OIOIGC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'System and Procedures', 'OI080200', 'Unit', NULL),
(114, 'OIOIGD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'MIS', 'OI080300', 'Unit', NULL),
(115, 'OIOIGE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Reconciliation Operations & Quality Assurance', 'OI080400', 'Unit', NULL),
(116, 'OIOIGEB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Reconciliation Operations', 'OI080401', 'Sub Unit', NULL),
(117, 'OIOIGEC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Quality Assurance', 'OI080402', 'Sub Unit', NULL),
(118, 'OIOIH', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'IT System and Development', 'OI060000', 'Department', NULL),
(119, 'OIOIHA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Engineer', 'OI060100', 'Unit', NULL),
(120, 'OIOIHC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'System & Development', 'OI060200', 'Unit', NULL),
(121, 'OIOIHCB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Application Development', 'OI060201', 'Sub Unit', NULL),
(122, 'OIOIHCC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Application Support', 'OI060202', 'Sub Unit', NULL),
(123, 'OIOIHCD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Regional Support', 'OI060300', 'Unit', NULL),
(124, 'OIOIHCDA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Corporate IT', 'OI060301', 'Sub Unit', NULL),
(125, 'OIOIHCDB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Finance IT', 'OI060302', 'Sub Unit', NULL),
(126, 'OIOIHD', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Development Project', 'OI060400', 'Unit', NULL),
(127, 'OI', '1', 'OI', 'Operations & IT', '', '', 'Operations & IT', 'OI000000', 'Division', NULL),
(128, 'OIOIIA', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'General Services', 'OI090000', 'Department', NULL),
(129, 'OIOIIB', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'General Administration', 'OI090100', 'Unit', NULL),
(130, 'OIOIIC', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Property & Facility Management', 'OI090200', 'Unit', NULL),
(131, 'OIOIID', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Service and Maintenance', 'OI090300', 'Unit', NULL),
(132, 'OIOIIE', '1', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Procurement', 'OI090400', 'Unit', NULL),
(133, 'RSRS', '2', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME - Sub Div', 'RS000000', 'Sub Division', NULL),
(134, 'RSRSAA', '2', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME Management', 'RS000000', 'Unit', NULL),
(135, 'RSRSC', '2', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Commercial', 'RS010000', 'Department', NULL),
(136, 'RSRSD', '2', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Products & Strategy', 'RS020000', 'Department', NULL),
(137, 'RSRSDC', '2', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME Funding and Wealth', 'RS020100', 'Unit', NULL),
(138, 'RSRSDD', '2', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME Lending', 'RS020200', 'Unit', NULL),
(139, 'RS', '2', 'RS', 'Retail & SME', '', '', 'Retail & SME', 'RS000000', 'Division', NULL),
(140, 'RSRSB', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution - Sub Div', 'Sales & Distribution', 'SD000000', 'Division', NULL),
(141, 'RSRSBB', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales & Service Quality', 'SD010000', 'Department', NULL),
(142, 'RSRSBBA', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales & Service Quality', 'SD010000', 'Unit', NULL),
(143, 'RSRSBEA', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Special Project "YWC"', 'SD010000', 'Unit', NULL),
(144, 'RSRSBC', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales Support, MIS, SIS, Agency Management', 'SD020000', 'Department', NULL),
(145, 'RSRSBD', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Network Strategy & Branch Optimization', 'SD030000', 'Department', NULL),
(146, 'RSRSBF', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales and Acquisition', 'SD040000', 'Department', NULL),
(147, 'RSRSBG', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Regional', 'SD050000', 'Department', NULL),
(148, 'RSRSBHA', '2', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Branch Office', 'SD050100', 'Unit', NULL),
(149, 'TRTR', '2', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Treasury - Sub Div', 'TR000000', 'Sub Division', NULL),
(150, 'TRTRA', '2', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Money Market', 'TR010000', 'Department', NULL),
(151, 'TRTRB', '2', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Sales - Branch and Retail', 'TR020000', 'Department', NULL),
(152, 'TRTRC', '2', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Sales - Corporate & Structured Products', 'TR030000', 'Department', NULL),
(153, 'TRTRE', '2', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Fx Trading', 'TR040000', 'Department', NULL),
(154, 'TR', '1', 'TR', 'Treasury', '', '', 'Treasury', 'TR000000', 'Division', NULL),
(155, 'COMM', '1', '', '', '', '', 'COMMISIONER', 'MG000000', 'Commisioner', NULL),
(156, 'MG', '1', '', '', '', '', 'Management', 'MG000000', 'Management', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
