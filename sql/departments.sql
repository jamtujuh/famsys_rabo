-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2011 at 04:49 PM
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
-- Table structure for table `departments`
--
DROP TABLE IF EXISTS `departments` ;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(3) NOT NULL,
  `name` char(40) DEFAULT NULL,
  `account_code` varchar(20) NOT NULL,
  `area` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_code` (`account_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `account_code`, `area`) VALUES
(1, '010', 'Abdul Muis', '010', '1'),
(2, '012', 'Raden Sales', '012', '1'),
(3, '130', 'Depok', '130', '1'),
(4, '016', 'Kramat Jati', '016', '1'),
(5, '021', 'Cipinang', '021', '1'),
(6, '026', 'Krekot', '026', '1'),
(7, '027', 'Iskandarsyah', '027', '1'),
(8, '031', 'Jatinegara', '031', '1'),
(9, '032', 'Bintaro', '032', '1'),
(10, '034', 'Harapan Indah Bekasi', '034', '1'),
(11, '036', 'Tebet', '036', '1'),
(12, '038', 'Kelapa Gading', '038', '1'),
(13, '062', 'Karawang - Resinda', '062', '1'),
(14, '091', 'Kebon Sirih', '091', '1'),
(15, '096', 'Sunter', '096', '1'),
(16, '099', 'Tanah Abang', '099', '1'),
(17, '175', 'Fatmawati', '175', '1'),
(18, '180', 'Slipi', '180', '1'),
(19, '302', 'Rasuna Said(Plaza 89)', '302', '1'),
(20, '400', 'Pontianak', '400', '1'),
(21, '642', 'Bogor', '642', '1'),
(22, '011', 'Perniagaan', '011', '2'),
(23, '015', 'Palmerah', '015', '2'),
(24, '017', 'Tanhung Duren', '017', '2'),
(25, '018', 'Pasar Pagi', '018', '2'),
(26, '024', 'Bumi Serpong Damai', '024', '2'),
(27, '025', 'Tangerang', '025', '2'),
(28, '028', 'Taman Alfa', '028', '2'),
(29, '030', 'Teluk Gong', '030', '2'),
(30, '033', 'Daan Mogot Baru', '033', '2'),
(31, '035', 'Green Garden', '035', '2'),
(32, '037', 'Bandengan', '037', '2'),
(33, '039', 'Gading Serpong', '039', '2'),
(34, '060', 'Bandung - Aceh', '060', '2'),
(35, '090', 'Mangga Dua Mall', '090', '2'),
(36, '092', 'Glodok Makmur', '092', '2'),
(37, '093', 'Muara Karang', '093', '2'),
(38, '094', 'Taman Palem', '094', '2'),
(39, '095', 'Meruya', '095', '2'),
(40, '660', 'Sukabumi', '660', '2'),
(41, '051', 'Lampung - Teluk Betung', '051', '3'),
(42, '052', 'Lampung - Metro', '052', '3'),
(43, '053', 'Palembang - Sayangan', '053', '3'),
(44, '055', 'Palembang - Ilir Barat Permai', '055', '3'),
(45, '303', 'Lampung - Kartini', '303', '3'),
(46, '570', 'Pekanbaru', '570', '3'),
(47, '576', 'Batam', '576', '3'),
(48, '711', 'Medan Asia', '711', '3'),
(49, '562', 'Medan Diponegoro', '562', '3'),
(50, '061', 'Cirebon', '061', '4'),
(51, '070', 'Semarang - Agus Salim', '070', '4'),
(52, '071', 'Kudus', '071', '4'),
(53, '072', 'Solo', '072', '4'),
(54, '073', 'Jogyakarta', '073', '4'),
(55, '074', 'Magelang', '074', '4'),
(56, '075', 'Magelang', '075', '4'),
(57, '076', 'Semarang - Ahmad Yani', '076', '4'),
(58, '077', 'Semarang - Puri Anjasmoro', '077', '4'),
(59, '078', 'Pati', '078', '4'),
(60, '722', 'Palur', '722', '4'),
(61, '742', 'Temanggung', '742', '4'),
(62, '790', 'Tegal', '790', '4'),
(63, '080', 'Surabaya - Tunjungan', '080', '5'),
(64, '081', 'Surabaya - Kembang Jepun', '081', '5'),
(65, '082', 'Surabaya - Ngagel', '082', '5'),
(66, '083', 'Surabaya - Pasar Turi', '083', '5'),
(67, '085', 'Jember', '085', '5'),
(68, '086', 'Denpasar', '086', '5'),
(69, '087', 'Malang - Pasar Besar', '087', '5'),
(70, '088', 'Surabaya - HR Muhammad', '088', '5'),
(71, '089', 'Kediri', '089', '5'),
(72, '899', 'KPNO', '899-RL', '0'),
(73, '899', 'KPNO', '899-WS', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
