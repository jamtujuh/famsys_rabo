-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 07, 2011 at 05:59 PM
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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `gl` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `linked_gol` tinyint(1) DEFAULT '0',
  `debit` tinyint(1) DEFAULT '0',
  `credit` tinyint(1) DEFAULT '0',
  `account_global_id` int(11) DEFAULT '0',
  `account_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKIndex1` (`account_global_id`),
  KEY `account_type_id` (`account_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=158 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `gl`, `linked_gol`, `debit`, `credit`, `account_global_id`, `account_type_id`) VALUES
(1, 'Building', '1080-03', 1, 1, 0, 4, 2),
(2, 'Akumulasi Penyusutan Building', '1081-01', 0, 0, 1, 14, 1),
(3, 'Biaya Penyusutan Building', '5320-14', 0, 1, 0, 1, 6),
(4, 'Hardware dan Instalation ', '1080-06 ', 1, 1, 0, 6, 2),
(5, 'Akumulasi Penyusutan Hardware dan Instalasi', '1081-04', 0, 0, 1, 17, 1),
(6, 'Biaya Penyusutan Hardware dan Instalation ', '5323-14', 0, 1, 0, 1, 6),
(7, 'Vehicle', '1080-05', 1, 1, 0, 7, 2),
(8, 'Akumulasi Penyusutan Vehicle', '1081-03', 0, 0, 1, 7, 1),
(9, 'Biaya Penyusutan Vehicle', '5322-14', 0, 1, 0, 1, 6),
(92, 'Biaya Penyusutan Software', '5328-14', 0, 0, 1, 10, 6),
(20, 'Software', '1080-10', 0, 0, 1, 10, 2),
(21, 'Akumulasi Penyusutan Software', '1081-09', 0, 1, 0, 10, 1),
(24, 'PPN', '59000000', 0, 1, 1, 0, 0),
(38, 'PPH 23', '45108', 0, 1, 1, 0, 0),
(39, 'RAB Proses Umum', '230003', 0, 0, 0, 1, 5),
(55, 'KERUGIAN PENGHAPUSAN FA', 'FA00001', 0, 1, 1, NULL, 11),
(56, 'KEUNTUNGAN PENJUALAN FA', 'FA00002', 0, 1, 1, NULL, 3),
(57, 'KERUGIAN PENJUALAN FA', 'FA00003', 0, 1, 1, NULL, 4),
(58, 'KAS', '9500Y', 0, 0, 0, 0, 18),
(59, 'Hutang Pada Supplier', '1234567', 0, 1, 1, 1, 10),
(98, 'Biaya Penyusutan Equipment', '5330-14 ', 0, 0, 1, 1, 6),
(97, 'Akumulasi Penyusutan Equipment', '1081-11', 0, 1, 0, 1, 1),
(96, 'Equipment', '1080-12 ', 0, 1, 0, 1, 2),
(95, 'Biaya Penyusutan Leasehold', '5329-14 ', 0, 0, 1, 1, 6),
(94, 'Akumulasi Penyusutan Leasehold', '1081-10 ', 0, 1, 0, 1, 1),
(99, 'Land ', '1080-01', 0, 1, 0, 5, 2),
(100, 'Akumulasi Penyusutan Land', '1081-08 ', 0, 1, 0, 16, 1),
(101, 'Biaya Penyusutan Land', '5327-14 ', 0, 0, 1, 16, 6),
(102, 'RPKP Cabang Pengirim', '00000', 0, 1, 1, NULL, 7),
(103, 'RPKP Cabang Penerima', '0000', 0, 0, 0, NULL, 8),
(93, 'Leasehold', '1080-11', 0, 1, 0, 1, 2),
(104, 'Biaya Non Operasional Lainnya', '0000000', 0, 1, 1, NULL, 9),
(105, 'Amortisasi', '2222', 0, 0, 0, NULL, 2),
(106, 'Akumulasi Penyusutan Amortisasi', '3333', 0, 0, 0, NULL, 1),
(107, 'Biaya Penyusutan Amortisasi', '4444', 0, 0, 0, NULL, 1),
(108, 'Persediaan Alat Tulis kantor', '120401', 0, 1, 0, 0, 13),
(109, 'Persediaan Cetakan', '120402', 0, 1, 0, 0, 13),
(110, 'Persediaan Cek & Bilyet Giro', '120403', 0, 1, 0, 0, 13),
(111, 'Persediaan Materai Tempel', '120404', 0, 1, 0, 0, 13),
(112, 'Persediaan Souvenir', '120405', 0, 1, 0, 0, 13),
(113, 'Persediaan Bea Materai Teraan', '120406', 0, 1, 0, 0, 13),
(114, 'Persediaan Bea Materai Skum', '120407', 0, 1, 0, 0, 13),
(115, 'Pers Bea Materai Komputerisasi', '120408', 0, 1, 0, 0, 13),
(116, 'Persediaan Kartu ATM', '120409', 0, 1, 0, 0, 13),
(117, 'Persediaan Barang IT', '120410', 0, 1, 0, 0, 13),
(118, 'Persediaan Barang Lainnya', '120499', 0, 1, 0, 0, 13),
(119, 'Tanah', '108001', 0, 1, 0, 0, 2),
(120, 'Bangunan Dalam Penyelesaian', '108002', 0, 1, 0, 0, 2),
(121, 'Gedung', '108003', 0, 1, 0, 0, 2),
(122, 'Instalasi', '108004', 0, 1, 0, 0, 2),
(123, 'Kendaraan', '108005', 0, 1, 0, 0, 2),
(124, 'Hardware Komputer', '108006', 0, 1, 0, 0, 2),
(125, 'Inv. Ktr Gol 1', '108007', 0, 1, 0, 0, 2),
(126, 'Inv. Ktr Gol 2 ( besi )', '108008', 0, 1, 0, 0, 2),
(127, 'Periperal Komputer', '108009', 0, 1, 0, 0, 2),
(128, 'Sotfware Komputer', '108010', 0, 1, 0, 0, 2),
(129, 'Periperal Komputer', '108011', 0, 1, 0, 0, 2),
(131, 'Biaya Alat Tulis Kantor', '560114', 0, 1, 0, 0, 5),
(132, 'Biaya Cetakan', '560214', 0, 1, 0, 0, 5),
(133, 'Biaya Cek & Billyet Giro', '560314', 0, 1, 0, 0, 5),
(134, 'Biaya Materai', '542314', 0, 1, 0, 0, 5),
(135, 'Biaya Barang Souvenir', '570514', 0, 1, 0, 0, 5),
(136, 'Biaya Barang Promosi', '570314', 0, 1, 0, 0, 5),
(137, 'Persediaan Barang Promosi', '120409', 0, 1, 0, 0, 13),
(138, 'Biaya Cetak Kartu ATM', '562014', 0, 1, 0, 0, 5),
(139, 'Biaya Accecoris Komputer', '560414', 0, 1, 0, 0, 5),
(140, 'Biaya Sarana Kantor', '565514', 0, 1, 0, 0, 5),
(141, 'Cabang Pemohon', 'xxx', 0, 1, 0, 0, 8),
(142, 'Cabang Pemilik Asset', 'xxx', 0, 1, 0, 0, 8),
(143, 'Biaya Penyusutan Inv. Ktr Gol 1', '532414', 0, 1, 0, 0, 1),
(144, 'Akumulasi Penyusutan Inv. Ktr Gol 1', '1081105', 0, 0, 1, 0, 1),
(145, 'Biaya Penyusutan Inv. Ktr Gol 2', '532514', 0, 1, 0, 0, 1),
(146, 'Akumulasi Penyusutan Inv. Ktr Gol 2', '1081106', 0, 0, 1, 0, 1),
(147, 'Akm peny Periperal komputer', '108107', 0, 1, 0, 0, 1),
(148, 'By Non Operasional Gedung', '108101', 0, 1, 0, 0, 9),
(149, 'By Kerugian/ Penj Aktiva Tetap', '595514', 0, 1, 0, 0, 4),
(150, 'By Non Operasional Lainnya', '599914', 0, 1, 0, 0, 9),
(151, 'Akm Penyusutan Hardware Komputer', '108104', 0, 1, 0, 0, 1),
(152, 'Aku Peny Bangunan Dalam Penyelesaian', 'xxxx', 0, 1, 0, 0, 1),
(153, 'Laba Penjualan Aktifa Tetap', '492214', 0, 0, 1, 0, 3),
(154, 'Uang Muka Lainnya', '12099', 0, 1, 1, 0, 15),
(155, 'RP Umum', '230021', 0, 1, 1, 0, 16),
(156, 'Penghapusbukuan FA', '595714', 0, 1, 0, 0, 11),
(157, 'RAB Kas Umum', '230011', 0, 1, 1, 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `account_globals`
--

DROP TABLE IF EXISTS `account_globals`;
CREATE TABLE IF NOT EXISTS `account_globals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `name` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `detail` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FKIndex1` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `account_globals`
--

INSERT INTO `account_globals` (`id`, `code`, `name`, `level`, `parent_id`, `detail`) VALUES
(1, '01', 'Aktiva Tetap', 1, NULL, 0),
(2, '0101', 'Biaya Perolehan', 2, 1, 0),
(3, '010101', 'Pemilikan langsung', 3, 2, 0),
(4, '01010101', 'Gedung', 4, 3, 1),
(5, '01010102', 'Tanah', 4, 3, 1),
(6, '01010103', 'Instalasi dan Renovasi Bangunan', 4, 3, 1),
(7, '01010104', 'Kendaraan Bermotor', 4, 3, 1),
(8, '01010105', 'Perabotan Kantor', 4, 3, 1),
(9, '01010106', 'Peralatan Kantor', 4, 3, 1),
(10, '01010107', 'Piranti Lunak Komputer', 4, 3, 1),
(11, '01010108', 'Piranti Keras Komputer', 4, 3, 1),
(12, '010102', 'Aktiva Tetap Dalam Penyelesaian', 3, 2, 1),
(13, '0102', 'Akumulasi Penyusutan', 2, 1, 0),
(14, '010201', 'Pemilikan langsung', 3, 13, 0),
(15, '01020101', 'Gedung', 4, 14, 1),
(16, '01020102', 'Tanah', 4, 14, 1),
(17, '01020103', 'Instalasi dan Renovasi Bangunan', 4, 14, 1),
(18, '01020104', 'Kendaraan Bermotor', 4, 14, 1),
(19, '01020105', 'Perabotan Kantor', 4, 14, 1),
(20, '01020106', 'Peralatan Kantor', 4, 14, 1),
(21, '01020107', 'Piranti Lunak Komputer', 4, 14, 1),
(22, '01020108', 'Piranti Keras Komputer', 4, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

DROP TABLE IF EXISTS `account_types`;
CREATE TABLE IF NOT EXISTS `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `descr` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `descr`) VALUES
(1, 'Akumulasi Penyusutan', ''),
(2, 'Harga Perolehan', ''),
(3, 'Laba Penjualan FA', ''),
(4, 'Rugi Penjualan FA', ''),
(5, 'RAB Proses Umum', ''),
(6, 'Biaya Penyusutan', ''),
(7, 'RPKP Cabang Asal', ''),
(8, 'RPKP Cabang Tujuan', ''),
(9, 'Biaya Non Operasional', ''),
(10, 'Hutang Supplier', ''),
(11, 'Rugi Penghapusan FA', ''),
(12, 'Laba Penghapusan FA', ''),
(13, 'Persediaan', ''),
(15, 'Uang Muka', ''),
(16, 'RP Umum', 'RP Umum'),
(17, 'RAB Kas Umum', ''),
(18, 'Kas', '');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `condition_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `department_sub_id` int(11) DEFAULT NULL,
  `department_unit_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `warranty_id` int(11) DEFAULT NULL,
  `warranty_name` text NOT NULL,
  `warranty_year` int(3) NOT NULL,
  `setatus` char(1) DEFAULT NULL,
  `kd_gab` varchar(30) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `color` varchar(64) DEFAULT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `ada` char(1) DEFAULT NULL,
  `date_of_purchase` date NOT NULL DEFAULT '0000-00-00',
  `date_out` date DEFAULT '0000-00-00',
  `kelfa` char(1) DEFAULT NULL,
  `umurek` int(10) unsigned DEFAULT NULL,
  `maksi` int(11) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT '0.00',
  `price_cur` decimal(20,2) DEFAULT '0.00',
  `amount` decimal(20,2) DEFAULT '0.00',
  `amount_cur` decimal(20,2) DEFAULT '0.00',
  `qty` int(11) DEFAULT '0',
  `residu` decimal(20,2) DEFAULT '0.00',
  `akdasar` decimal(20,2) DEFAULT '0.00',
  `depbln` decimal(20,2) DEFAULT '0.00',
  `thnlalu` int(11) DEFAULT '0',
  `blnlalu` int(10) unsigned DEFAULT '0',
  `blnini` int(10) unsigned DEFAULT '0',
  `jan` decimal(10,2) DEFAULT '0.00',
  `feb` decimal(10,2) DEFAULT '0.00',
  `mar` decimal(10,2) DEFAULT '0.00',
  `apr` decimal(10,2) DEFAULT '0.00',
  `may` decimal(10,2) DEFAULT '0.00',
  `jun` decimal(10,2) DEFAULT '0.00',
  `jul` decimal(10,2) DEFAULT '0.00',
  `aug` decimal(10,2) DEFAULT '0.00',
  `sep` decimal(10,2) DEFAULT '0.00',
  `oct` decimal(10,2) DEFAULT '0.00',
  `nov` decimal(10,2) DEFAULT '0.00',
  `dec` decimal(20,2) DEFAULT '0.00',
  `hrgjual` decimal(10,2) DEFAULT '0.00',
  `jthnlalu` decimal(10,2) unsigned DEFAULT '0.00',
  `jblnlalu` decimal(10,2) unsigned DEFAULT '0.00',
  `jblnini` decimal(10,2) unsigned DEFAULT '0.00',
  `hpthnlalu` decimal(10,2) unsigned DEFAULT '0.00',
  `hpblnlalumasuk` decimal(10,2) unsigned DEFAULT '0.00',
  `hpblninimasuk` decimal(20,2) unsigned DEFAULT '0.00',
  `hpblnlalukeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `hpblninikeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `hpthnini` decimal(20,2) unsigned DEFAULT '0.00',
  `depthnlalu` decimal(20,2) unsigned DEFAULT '0.00',
  `depblnlalumasuk` decimal(20,2) unsigned DEFAULT '0.00',
  `depblninimasuk` decimal(20,2) unsigned DEFAULT '0.00',
  `depblnlalukeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `depblninikeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `depthnini` decimal(20,2) unsigned DEFAULT '0.00',
  `book_value` decimal(20,2) unsigned DEFAULT '0.00',
  `sedang_diluar` char(1) DEFAULT 'N',
  `service_tanggal` date DEFAULT NULL,
  `service_selesai_tanggal` date DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `no_urut_prefix` varchar(30) DEFAULT NULL,
  `no_urut` int(5) unsigned zerofill DEFAULT NULL,
  `serial_no` varchar(20) DEFAULT NULL,
  `voucher_no` varchar(15) DEFAULT NULL,
  `po_no` varchar(15) DEFAULT NULL,
  `invoice_no` varchar(15) DEFAULT NULL,
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  `kd_luar_tanggal` date NOT NULL DEFAULT '0000-00-00',
  `service_total` decimal(20,0) DEFAULT '0',
  `service_ket` varchar(50) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `notes` tinytext NOT NULL,
  `process` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_id` int(11) NOT NULL,
  `delivery_order_id` int(11) DEFAULT NULL,
  `delivery_order_detail_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id_purchase` (`purchase_id`),
  KEY `id_asset_category` (`asset_category_id`),
  KEY `id_department` (`department_id`),
  KEY `id_warranty` (`warranty_id`),
  KEY `id_currency` (`currency_id`),
  KEY `invoice_no` (`invoice_no`),
  KEY `po_no` (`po_no`),
  KEY `posting` (`posting`),
  KEY `process` (`process`),
  KEY `invoice_id` (`invoice_id`),
  KEY `price` (`price`,`price_cur`,`amount`,`amount_cur`,`qty`),
  KEY `delivery_order_idx` (`delivery_order_id`),
  KEY `delivery_order_detail_idx` (`delivery_order_detail_id`),
  KEY `po_idx` (`po_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `code`, `condition_id`, `asset_category_id`, `purchase_id`, `location_id`, `currency_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `warranty_id`, `warranty_name`, `warranty_year`, `setatus`, `kd_gab`, `name`, `item_code`, `color`, `brand`, `type`, `ada`, `date_of_purchase`, `date_out`, `kelfa`, `umurek`, `maksi`, `price`, `price_cur`, `amount`, `amount_cur`, `qty`, `residu`, `akdasar`, `depbln`, `thnlalu`, `blnlalu`, `blnini`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`, `hrgjual`, `jthnlalu`, `jblnlalu`, `jblnini`, `hpthnlalu`, `hpblnlalumasuk`, `hpblninimasuk`, `hpblnlalukeluar`, `hpblninikeluar`, `hpthnini`, `depthnlalu`, `depblnlalumasuk`, `depblninimasuk`, `depblnlalukeluar`, `depblninikeluar`, `depthnini`, `book_value`, `sedang_diluar`, `service_tanggal`, `service_selesai_tanggal`, `date_start`, `date_end`, `no_urut_prefix`, `no_urut`, `serial_no`, `voucher_no`, `po_no`, `invoice_no`, `posting`, `kd_luar_tanggal`, `service_total`, `service_ket`, `year`, `notes`, `process`, `invoice_id`, `delivery_order_id`, `delivery_order_detail_id`, `po_id`) VALUES
(1, 'IN2-2011-012-1', 0, 9, 1, NULL, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '8250000.00', '8250000.00', 10, '0.00', '0.00', '137500.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '137500.00', '137500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '8250000.00', '0.00', '0.00', '0.00', '8250000.00', '0.00', '275000.00', '137500.00', '0.00', '0.00', '275000.00', '7975000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 1, 1),
(2, 'IN2-2011-012-2', 0, 9, 1, NULL, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '14850000.00', '14850000.00', 9, '0.00', '0.00', '275000.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '275000.00', '275000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '14850000.00', '0.00', '0.00', '0.00', '14850000.00', '0.00', '550000.00', '275000.00', '0.00', '0.00', '550000.00', '14300000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 2, 1),
(3, 'IN1-2011-012-1', 0, 8, 1, NULL, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA NASABAH', '7MJA002', '-', 'LIGNA', 'MJ001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '10450000.00', '10450000.00', '31350000.00', '31350000.00', 3, '0.00', '0.00', '522500.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '522500.00', '522500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '31350000.00', '0.00', '0.00', '0.00', '31350000.00', '0.00', '1045000.00', '522500.00', '0.00', '0.00', '1045000.00', '30305000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 3, 1),
(4, 'IN2-2011-012-3', 0, 9, 1, NULL, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MESIN TIK', '7MSN001', '-', 'Brother', 'MS01', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1375000.00', '1375000.00', '2750000.00', '2750000.00', 2, '0.00', '0.00', '45833.33', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '45833.33', '45833.33', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2750000.00', '0.00', '0.00', '0.00', '2750000.00', '0.00', '91666.66', '45833.33', '0.00', '0.00', '91666.66', '2658333.34', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 4, 1),
(5, 'IN2-2011-021-1', 0, 9, 1, NULL, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'KR001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '4125000.00', '4125000.00', 5, '0.00', '0.00', '68750.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '68750.00', '68750.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4125000.00', '0.00', '0.00', '0.00', '4125000.00', '0.00', '137500.00', '68750.00', '0.00', '0.00', '137500.00', '3987500.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 5, 1),
(6, 'IN1-2011-021-1', 0, 8, 1, NULL, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA KERJA', '7MJA001', '-', 'LIGNA', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '6600000.00', '6600000.00', '0.00', '0.00', 0, '0.00', '0.00', '110000.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '110000.00', '110000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '6600000.00', '0.00', '0.00', '0.00', '6600000.00', '0.00', '220000.00', '110000.00', '0.00', '0.00', '220000.00', '6380000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 6, 1),
(7, 'IN2-2011-012-4', 0, 9, 2, NULL, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '8250000.00', '8250000.00', 10, '0.00', '0.00', '137500.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '137500.00', '137500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '8250000.00', '0.00', '0.00', '0.00', '8250000.00', '0.00', '275000.00', '137500.00', '0.00', '0.00', '275000.00', '7975000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 3, 10, 1),
(8, 'HRD-2011-012-1', 0, 6, 3, NULL, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'DEKSTOP DELL OPTIPLEX', '6PCD001', '-', 'Dell', 'GX280', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '3025000.00', '3025000.00', '9075000.00', '9075000.00', 3, '0.00', '0.00', '151250.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '151250.00', '151250.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '9075000.00', '0.00', '0.00', '0.00', '9075000.00', '0.00', '302500.00', '151250.00', '0.00', '0.00', '302500.00', '8772500.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 2, 7, 2),
(9, 'HRD-2011-012-2', 0, 6, 3, NULL, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'THIN CLIENT  ', '6PCT001', '-', 'ITONA', 'T3851', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '4950000.00', '4950000.00', '24750000.00', '24750000.00', 5, '0.00', '0.00', '412500.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '412500.00', '412500.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '24750000.00', '0.00', '0.00', '0.00', '24750000.00', '0.00', '825000.00', '412500.00', '0.00', '0.00', '825000.00', '23925000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 2, 8, 2),
(10, 'HRD-2011-021-1', 0, 6, 3, NULL, 1, 5, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'PRINTER EPSON LQ 2180', '6PRE001 ', '-', 'Epson', 'LQ2180', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '56100000.00', '56100000.00', '168300000.00', '168300000.00', 3, '0.00', '0.00', '2805000.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2805000.00', '2805000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '99999999.99', '0.00', '0.00', '0.00', '99999999.99', '0.00', '5610000.00', '2805000.00', '0.00', '0.00', '5610000.00', '94389999.99', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 2, 9, 2),
(11, 'IN1-2011-012-2', 0, 8, 1, NULL, 1, 2, 0, NULL, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA KERJA', '7MJA001', '-', 'LIGNA', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '6600000.00', '6600000.00', '6600000.00', '6600000.00', 1, '0.00', '0.00', '110000.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '110000.00', '110000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '6600000.00', '0.00', '0.00', '0.00', '6600000.00', '0.00', '220000.00', '110000.00', '0.00', '0.00', '220000.00', '6380000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 6, 1),
(12, 'IN2-2011-021-2', 0, 9, 1, NULL, 1, 5, 0, NULL, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '16500000.00', '16500000.00', 1, '0.00', '0.00', '275000.00', 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '275000.00', '275000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1650000.00', '0.00', '0.00', '0.00', '1650000.00', '0.00', '550000.00', '275000.00', '0.00', '0.00', '550000.00', '1100000.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `descr` tinytext NOT NULL,
  `id_parent` varchar(20) DEFAULT NULL,
  `depr_year_com` int(10) unsigned DEFAULT '0',
  `depr_rate_com` decimal(10,2) NOT NULL,
  `depr_year_fis` int(11) NOT NULL,
  `depr_rate_fis` decimal(10,2) NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_depr_accumulated_id` int(11) DEFAULT NULL,
  `account_depr_cost_id` int(11) DEFAULT NULL,
  `is_asset` tinyint(1) NOT NULL DEFAULT '1',
  `is_amort` tinyint(1) NOT NULL DEFAULT '1',
  `asset_category_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `golongan_FKIndex1` (`id_parent`),
  KEY `account_id` (`account_id`),
  KEY `account_depr_accumulated_id` (`account_depr_accumulated_id`,`account_depr_cost_id`),
  KEY `is_asset` (`is_asset`),
  KEY `is_amort` (`is_amort`),
  KEY `asset_category_type_id` (`asset_category_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`id`, `code`, `name`, `descr`, `id_parent`, `depr_year_com`, `depr_rate_com`, `depr_year_fis`, `depr_rate_fis`, `account_id`, `account_depr_accumulated_id`, `account_depr_cost_id`, `is_asset`, `is_amort`, `asset_category_type_id`) VALUES
(1, 'TNH', 'Tanah', '', '0', 5, '20.00', 4, '25.00', 0, NULL, NULL, 1, 1, 1),
(2, 'ADP', 'Bangunan Dalam Penyelesaian', '', '0', 5, '0.00', 4, '0.00', 4, 5, 0, 1, 1, 1),
(3, 'GDN', 'Gedung', '', '0', 5, '0.00', 4, '0.00', 1, 2, 3, 1, 1, 1),
(4, 'INS', 'Instalasi', '', '0', 5, '0.00', 0, '0.00', 4, 0, 0, 1, 1, 1),
(5, 'KND', 'Kendaraan', '', '0', 5, '0.00', 0, '0.00', 13, 14, 15, 1, 1, 1),
(6, 'HRD', 'Hardware Komputer', '', '0', 5, '0.00', 0, '0.00', 16, 17, 18, 1, 1, 1),
(7, 'PRP', 'Peripheral Komputer', '', '0', 5, '0.00', 0, '0.00', 0, 0, 0, 1, 1, 1),
(8, 'IN1', 'Inventaris Golongan I', '', '0', 5, '0.00', 0, '0.00', 0, 0, 0, 1, 1, 1),
(9, 'IN2', 'Inventaris Golongan II', '', '0', 5, '0.00', 0, '0.00', 0, 0, 0, 1, 1, 1),
(10, 'SWK', 'Software Komputer', '', '0', 5, '0.00', 0, '0.00', 0, 0, 0, 1, 1, 1),
(11, 'LSH', 'Leasehold', '', '0', 5, '0.00', 0, '0.00', 0, 0, 0, 1, 1, 1),
(12, 'CET', 'Barang Cetakan', '', '0', 0, '0.00', 0, '0.00', 109, 0, 0, 0, 1, 2),
(13, 'MAT', 'Materai Tempel', '', '0', 0, '0.00', 0, '0.00', 111, 0, 0, 0, 1, 2),
(15, 'ATK', 'Alat Tulis Kantor', '', '0', 0, '0.00', 0, '0.00', 108, 0, 0, 0, 1, 2),
(16, 'REN', 'Renovasi', '', '', 5, '20.00', 4, '20.00', 0, 0, 0, 1, 0, 3),
(17, 'CBG', 'Cek & Bilyet Giro', '', NULL, 0, '0.00', 0, '0.00', 110, NULL, NULL, 1, 1, 2),
(18, 'SVR', 'Souvenir', '', NULL, 0, '0.00', 0, '0.00', 112, NULL, NULL, 1, 1, 2),
(19, 'MTT', 'Materai Teraan', '', NULL, 0, '0.00', 0, '0.00', 113, NULL, NULL, 1, 1, 2),
(20, 'MTS', 'Materai Skum', '', NULL, 0, '0.00', 0, '0.00', 114, NULL, NULL, 1, 1, 2),
(21, 'MTK', 'Materai Komputerisasi', '', NULL, 0, '0.00', 0, '0.00', 115, NULL, NULL, 1, 1, 2),
(22, 'ATM', 'Kartu ATM', '', NULL, 0, '0.00', 0, '0.00', 116, NULL, NULL, 1, 1, 2),
(23, 'IT', 'IT', '', NULL, 0, '0.00', 0, '0.00', 117, NULL, NULL, 1, 1, 2),
(24, 'DLL', 'Barang Lainnnya', '', NULL, 0, '0.00', 0, '0.00', 118, NULL, NULL, 1, 1, 2),
(25, 'BGN', 'Bangunan', '', NULL, 0, '0.00', 0, '0.00', 130, NULL, NULL, 1, 1, 1),
(26, 'BATK', 'Alat Tulis Kantor', '', NULL, 0, '0.00', 0, '0.00', 131, NULL, NULL, 1, 1, 2),
(27, 'PRO', 'Promosi', '', NULL, 0, '0.00', 0, '0.00', 136, NULL, NULL, 1, 1, 1),
(28, 'PRO', 'Promosi', '', NULL, 0, '0.00', 0, '0.00', 136, NULL, NULL, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `asset_category_types`
--

DROP TABLE IF EXISTS `asset_category_types`;
CREATE TABLE IF NOT EXISTS `asset_category_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `asset_category_types`
--

INSERT INTO `asset_category_types` (`id`, `name`) VALUES
(1, 'FA'),
(2, 'Stock'),
(3, 'Bdd');

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

DROP TABLE IF EXISTS `asset_details`;
CREATE TABLE IF NOT EXISTS `asset_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `condition_id` int(11) NOT NULL DEFAULT '1',
  `asset_id` int(11) DEFAULT NULL,
  `asset_category_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `department_sub_id` int(11) DEFAULT NULL,
  `department_unit_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `warranty_id` int(11) DEFAULT NULL,
  `warranty_name` text NOT NULL,
  `warranty_year` int(3) NOT NULL,
  `status` char(1) DEFAULT NULL,
  `kd_gab` varchar(30) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `color` varchar(64) DEFAULT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `ada` char(1) DEFAULT NULL,
  `date_of_purchase` date NOT NULL DEFAULT '0000-00-00',
  `date_out` date DEFAULT '0000-00-00',
  `kelfa` char(1) DEFAULT NULL,
  `umurek` int(10) unsigned DEFAULT NULL,
  `maksi` int(11) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT '0.00',
  `price_cur` decimal(20,2) DEFAULT '0.00',
  `residu` decimal(20,2) DEFAULT '0.00',
  `akdasar` decimal(20,2) DEFAULT '0.00',
  `depbln` decimal(20,2) DEFAULT '0.00',
  `thnlalu` int(11) DEFAULT '0',
  `blnlalu` int(10) unsigned DEFAULT '0',
  `blnini` int(10) unsigned DEFAULT '0',
  `jan` decimal(10,2) DEFAULT '0.00',
  `feb` decimal(10,2) DEFAULT '0.00',
  `mar` decimal(10,2) DEFAULT '0.00',
  `apr` decimal(10,2) DEFAULT '0.00',
  `may` decimal(10,2) DEFAULT '0.00',
  `jun` decimal(10,2) DEFAULT '0.00',
  `jul` decimal(10,2) DEFAULT '0.00',
  `aug` decimal(10,2) DEFAULT '0.00',
  `sep` decimal(10,2) DEFAULT '0.00',
  `oct` decimal(10,2) DEFAULT '0.00',
  `nov` decimal(10,2) DEFAULT '0.00',
  `dec` decimal(20,2) DEFAULT '0.00',
  `hrgjual` decimal(10,2) DEFAULT '0.00',
  `jthnlalu` decimal(10,2) unsigned DEFAULT '0.00',
  `jblnlalu` decimal(10,2) unsigned DEFAULT '0.00',
  `jblnini` decimal(10,2) unsigned DEFAULT '0.00',
  `hpthnlalu` decimal(10,2) unsigned DEFAULT '0.00',
  `hpblnlalumasuk` decimal(10,2) unsigned DEFAULT '0.00',
  `hpblninimasuk` decimal(20,2) unsigned DEFAULT '0.00',
  `hpblnlalukeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `hpblninikeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `hpthnini` decimal(20,2) unsigned DEFAULT '0.00',
  `depthnlalu` decimal(20,2) unsigned DEFAULT '0.00',
  `depblnlalumasuk` decimal(20,2) unsigned DEFAULT '0.00',
  `depblninimasuk` decimal(20,2) unsigned DEFAULT '0.00',
  `depblnlalukeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `depblninikeluar` decimal(20,2) unsigned DEFAULT '0.00',
  `depthnini` decimal(20,2) unsigned DEFAULT '0.00',
  `book_value` decimal(20,2) unsigned DEFAULT '0.00',
  `sedang_diluar` char(1) DEFAULT 'N',
  `service_tanggal` date DEFAULT NULL,
  `service_selesai_tanggal` date DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `no_urut_prefix` varchar(30) DEFAULT NULL,
  `no_urut` int(5) unsigned zerofill DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `voucher_no` varchar(15) DEFAULT NULL,
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  `kd_luar_tanggal` date NOT NULL DEFAULT '0000-00-00',
  `service_total` decimal(20,0) DEFAULT '0',
  `service_ket` varchar(50) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `notes` text NOT NULL,
  `process` tinyint(1) NOT NULL DEFAULT '0',
  `source` varchar(20) NOT NULL DEFAULT 'purchase',
  `invoice_id` int(11) NOT NULL,
  `check_physical` tinyint(1) DEFAULT '0',
  `delivery_order_id` int(11) DEFAULT NULL,
  `delivery_order_detail_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `accept` tinyint(1) DEFAULT '0',
  `accepted_datetime` datetime NOT NULL,
  `accepted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `barang_detil_FKIndex1` (`asset_id`),
  KEY `barang_detil_FKIndex2` (`location_id`),
  KEY `barang_detil_FKIndex3` (`department_id`),
  KEY `barang_detil_FKIndex4` (`condition_id`),
  KEY `id_purchase` (`purchase_id`),
  KEY `posting` (`posting`),
  KEY `id_asset_category` (`asset_category_id`),
  KEY `process` (`process`),
  KEY `source` (`source`),
  KEY `invoice_id` (`invoice_id`),
  KEY `delivery_order_idx` (`delivery_order_id`),
  KEY `delivery_order_detail_idx` (`delivery_order_detail_id`),
  KEY `po_idx` (`po_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`id`, `code`, `condition_id`, `asset_id`, `asset_category_id`, `purchase_id`, `location_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `warranty_id`, `warranty_name`, `warranty_year`, `status`, `kd_gab`, `name`, `item_code`, `color`, `brand`, `type`, `ada`, `date_of_purchase`, `date_out`, `kelfa`, `umurek`, `maksi`, `price`, `price_cur`, `residu`, `akdasar`, `depbln`, `thnlalu`, `blnlalu`, `blnini`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`, `hrgjual`, `jthnlalu`, `jblnlalu`, `jblnini`, `hpthnlalu`, `hpblnlalumasuk`, `hpblninimasuk`, `hpblnlalukeluar`, `hpblninikeluar`, `hpthnini`, `depthnlalu`, `depblnlalumasuk`, `depblninimasuk`, `depblnlalukeluar`, `depblninikeluar`, `depthnini`, `book_value`, `sedang_diluar`, `service_tanggal`, `service_selesai_tanggal`, `date_start`, `date_end`, `no_urut_prefix`, `no_urut`, `serial_no`, `voucher_no`, `posting`, `kd_luar_tanggal`, `service_total`, `service_ket`, `year`, `notes`, `process`, `source`, `invoice_id`, `check_physical`, `delivery_order_id`, `delivery_order_detail_id`, `po_id`, `accept`, `accepted_datetime`, `accepted_by`) VALUES
(1, 'IN2-2011-012-1-001', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '710', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(2, 'IN2-2011-012-1-002', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '711', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(3, 'IN2-2011-012-1-003', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '712', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(4, 'IN2-2011-012-1-004', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '713', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(5, 'IN2-2011-012-1-005', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '714', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(6, 'IN2-2011-012-1-006', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '715', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(7, 'IN2-2011-012-1-007', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '716', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(8, 'IN2-2011-012-1-008', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '717', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(9, 'IN2-2011-012-1-009', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '718', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(10, 'IN2-2011-012-1-010', 1, 1, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '719', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL),
(12, 'IN2-2011-012-2-002', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '702', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(13, 'IN2-2011-012-2-003', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '703', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(14, 'IN2-2011-012-2-004', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '704', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(15, 'IN2-2011-012-2-005', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '705', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(16, 'IN2-2011-012-2-006', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '706', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(17, 'IN2-2011-012-2-007', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '707', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(18, 'IN2-2011-012-2-008', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '708', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(19, 'IN2-2011-012-2-009', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '709', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(20, 'IN2-2011-012-2-010', 1, 2, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '710', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(21, 'IN1-2011-012-1-001', 1, 3, 8, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA NASABAH', '7MJA002', '-', 'LIGNA', 'MJ001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '10450000.00', '10450000.00', '0.00', '0.00', '174166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '111', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 3, 1, 0, '0000-00-00 00:00:00', NULL),
(22, 'IN1-2011-012-1-002', 1, 3, 8, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA NASABAH', '7MJA002', '-', 'LIGNA', 'MJ001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '10450000.00', '10450000.00', '0.00', '0.00', '174166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '112', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 3, 1, 0, '0000-00-00 00:00:00', NULL),
(23, 'IN1-2011-012-1-003', 1, 3, 8, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA NASABAH', '7MJA002', '-', 'LIGNA', 'MJ001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '10450000.00', '10450000.00', '0.00', '0.00', '174166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '113', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 3, 1, 0, '0000-00-00 00:00:00', NULL),
(24, 'IN2-2011-012-3-001', 1, 4, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MESIN TIK', '7MSN001', '-', 'Brother', 'MS01', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1375000.00', '1375000.00', '0.00', '0.00', '22916.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '101', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 4, 1, 0, '0000-00-00 00:00:00', NULL),
(25, 'IN2-2011-012-3-002', 1, 4, 9, 1, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MESIN TIK', '7MSN001', '-', 'Brother', 'MS01', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1375000.00', '1375000.00', '0.00', '0.00', '22916.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '102', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 4, 1, 0, '0000-00-00 00:00:00', NULL),
(26, 'IN2-2011-021-1-001', 1, 5, 9, 1, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'KR001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '711', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 5, 1, 0, '0000-00-00 00:00:00', NULL),
(27, 'IN2-2011-021-1-002', 1, 5, 9, 1, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'KR001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '712', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 5, 1, 0, '0000-00-00 00:00:00', NULL),
(28, 'IN2-2011-021-1-003', 1, 5, 9, 1, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'KR001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '713', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 5, 1, 0, '0000-00-00 00:00:00', NULL),
(29, 'IN2-2011-021-1-004', 1, 5, 9, 1, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'KR001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '714', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 5, 1, 0, '0000-00-00 00:00:00', NULL),
(30, 'IN2-2011-021-1-005', 1, 5, 9, 1, 1, 5, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'KR001', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '715', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 1, 5, 1, 0, '0000-00-00 00:00:00', NULL),
(32, 'IN2-2011-012-4-001', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '720', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(33, 'IN2-2011-012-4-002', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '721', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(34, 'IN2-2011-012-4-003', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '722', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(35, 'IN2-2011-012-4-004', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '723', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(36, 'IN2-2011-012-4-005', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '724', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(37, 'IN2-2011-012-4-006', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '725', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(38, 'IN2-2011-012-4-007', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '726', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(39, 'IN2-2011-012-4-008', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '727', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(40, 'IN2-2011-012-4-009', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '728', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(41, 'IN2-2011-012-4-010', 1, 7, 9, 2, 1, 2, 0, 0, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI KERJA', '7KRS001', '-', 'BIF', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '729', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, 0, 3, 10, 1, 0, '0000-00-00 00:00:00', NULL),
(42, 'HRD-2011-012-1-001', 1, 8, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'DEKSTOP DELL OPTIPLEX', '6PCD001', '-', 'Dell', 'GX280', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '3025000.00', '3025000.00', '0.00', '0.00', '50416.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '111', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 7, 2, 0, '0000-00-00 00:00:00', NULL),
(43, 'HRD-2011-012-1-002', 1, 8, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'DEKSTOP DELL OPTIPLEX', '6PCD001', '-', 'Dell', 'GX280', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '3025000.00', '3025000.00', '0.00', '0.00', '50416.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '111', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 7, 2, 0, '0000-00-00 00:00:00', NULL),
(44, 'HRD-2011-012-1-003', 1, 8, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'DEKSTOP DELL OPTIPLEX', '6PCD001', '-', 'Dell', 'GX280', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '3025000.00', '3025000.00', '0.00', '0.00', '50416.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '111', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 7, 2, 0, '0000-00-00 00:00:00', NULL),
(45, 'HRD-2011-012-2-001', 1, 9, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'THIN CLIENT  ', '6PCT001', '-', 'ITONA', 'T3851', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '4950000.00', '4950000.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '555L', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 8, 2, 0, '0000-00-00 00:00:00', NULL),
(46, 'HRD-2011-012-2-002', 1, 9, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'THIN CLIENT  ', '6PCT001', '-', 'ITONA', 'T3851', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '4950000.00', '4950000.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '555L', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 8, 2, 0, '0000-00-00 00:00:00', NULL),
(47, 'HRD-2011-012-2-003', 1, 9, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'THIN CLIENT  ', '6PCT001', '-', 'ITONA', 'T3851', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '4950000.00', '4950000.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '555L', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 8, 2, 0, '0000-00-00 00:00:00', NULL),
(48, 'HRD-2011-012-2-004', 1, 9, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'THIN CLIENT  ', '6PCT001', '-', 'ITONA', 'T3851', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '4950000.00', '4950000.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '555L', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 8, 2, 0, '0000-00-00 00:00:00', NULL),
(49, 'HRD-2011-012-2-005', 1, 9, 6, 3, 1, 2, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'THIN CLIENT  ', '6PCT001', '-', 'ITONA', 'T3851', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '4950000.00', '4950000.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '555L', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 8, 2, 0, '0000-00-00 00:00:00', NULL),
(50, 'HRD-2011-021-1-001', 1, 10, 6, 3, 1, 5, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'PRINTER EPSON LQ 2180', '6PRE001 ', '-', 'Epson', 'LQ2180', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '56100000.00', '56100000.00', '0.00', '0.00', '935000.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '106', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 9, 2, 0, '0000-00-00 00:00:00', NULL),
(51, 'HRD-2011-021-1-002', 1, 10, 6, 3, 1, 5, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'PRINTER EPSON LQ 2180', '6PRE001 ', '-', 'Epson', 'LQ2180', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '56100000.00', '56100000.00', '0.00', '0.00', '935000.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '107', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 9, 2, 0, '0000-00-00 00:00:00', NULL),
(52, 'HRD-2011-021-1-003', 1, 10, 6, 3, 1, 5, 0, 0, 2, 1, NULL, 'trikarsa', 1, NULL, NULL, 'PRINTER EPSON LQ 2180', '6PRE001 ', '-', 'Epson', 'LQ2180', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '56100000.00', '56100000.00', '0.00', '0.00', '935000.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '108', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, 0, 2, 9, 2, 0, '0000-00-00 00:00:00', NULL),
(11, 'IN2-2011-021-2-001', 1, 12, 9, 1, 1, 5, NULL, NULL, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'KURSI HADAP', '7KRS002', '-', 'BIF', 'KR002', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '1650000.00', '1650000.00', '0.00', '0.00', '27500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '701', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'mutasi', 1, 0, 1, 2, 1, 0, '0000-00-00 00:00:00', NULL),
(31, 'IN1-2011-012-2-001', 1, 11, 8, 1, 1, 2, NULL, NULL, 2, 1, NULL, 'Borneo Inti Kreasi', 1, NULL, NULL, 'MEJA KERJA', '7MJA001', '-', 'LIGNA', 'MJ007', 'Y', '2011-07-07', '0000-00-00', NULL, 5, 60, '6600000.00', '6600000.00', '0.00', '0.00', '110000.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-07-07', '2016-07-07', NULL, NULL, '6586', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'mutasi', 1, 0, 1, 6, 1, 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_outs`
--

DROP TABLE IF EXISTS `asset_outs`;
CREATE TABLE IF NOT EXISTS `asset_outs` (
  `id` varchar(8) NOT NULL DEFAULT '',
  `tanggal` date DEFAULT NULL,
  `alasan` varchar(15) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `id_warranty` varchar(4) DEFAULT '0',
  `id_asset_detail` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_asset_detailx` (`id_asset_detail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_outs`
--

INSERT INTO `asset_outs` (`id`, `tanggal`, `alasan`, `description`, `id_warranty`, `id_asset_detail`) VALUES
('00001', '2005-04-28', 'SERVICE', '', '0', 'E-CE-CPU-27/01/2005-1-001/001'),
('00002', '2005-04-28', 'SERVICE', 'Rusak', 'Q000', 'E-CE-CPU-27/01/2005-1-001/001'),
('00003', '2005-07-26', 'DIPINJAMKA', 'baik', '0', 'E-AV-CD-26/07/2005-1-001'),
('00004', '2005-07-26', 'SERVICE', 'baik', 'D004', 'E-AV-CD-26/07/2005-1-001'),
('00005', '2005-07-26', 'SERVICE', 'Rusak', 'D004', 'E-AV-DVD-27/01/2005-1-004'),
('S-00001', '2005-07-29', 'SERVICE', 'rusak', 'D012', 'E-AV-DVD-27/01/2005-1-003'),
('S-00002', '2005-07-29', 'SERVICE', 'yrtyt', 'D012', 'E-AV-DVD-27/01/2005-1-004'),
('S-00003', '2005-07-29', 'SERVICE', 'serter', 'Q000', 'E-AV-DVD-27/07/2005-1-001'),
('S-00004', '2005-08-12', 'SERVICE', 'rusak', 'G001', 'E-CE-MONITOR-08/08/2005-1-001'),
('S-00005', '2005-08-12', 'SERVICE', 'rusak', '0', 'E-CO-HP-12/08/2005-1-001'),
('S-00006', '2005-08-15', 'SERVICE', 'rusak', 'BST', 'E-CO-HP-12/08/2005-1-001'),
('S-00007', '2005-08-15', 'SERVICE', 'perubahan ke dua', 'Q000', 'E-CE-PRINTER-15/08/2005-1-001'),
('S-00008', '2005-08-15', 'DIPINJAMKA', 'pinjam sebentar', 'G001', 'E-CE-SCANNER-28/06/2005-1-001'),
('S-00009', '2005-08-23', 'SERVICE', 'Rusak', 'D004', 'E-CE-CPU-07/07/2005-1-001'),
('S-00010', '2008-05-21', 'DIPINJAMKAN', 'pinjam ke acabang', 'D004', 'E-BE-GENSET-21/05/2008-1-002');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `attachment_file_path` varchar(255) NOT NULL,
  `attachment_file_name` varchar(255) NOT NULL,
  `attachment_file_size` varchar(255) NOT NULL,
  `attachment_content_type` varchar(155) NOT NULL,
  `npb_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `npb_id` (`npb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `aydas`
--

DROP TABLE IF EXISTS `aydas`;
CREATE TABLE IF NOT EXISTS `aydas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `debitor_nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `debitor_alamat` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `lokasi` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `sertifikat_nomor` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sertifikat_tanggal` date DEFAULT NULL,
  `sertifikat_jtempo` date DEFAULT NULL,
  `asuransi_nomor` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `asuransi_jtempo` date DEFAULT NULL,
  `nilai_buku` decimal(20,0) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `ppap_pct` decimal(11,0) DEFAULT NULL,
  `ppap_jumlah` decimal(20,0) DEFAULT NULL,
  `appraisal_tanggal` date DEFAULT NULL,
  `appraisal_jtempo` date DEFAULT NULL,
  `appraisal_nilai_pasar` decimal(20,0) DEFAULT NULL,
  `appraisal_nilai_likuidasi` decimal(20,0) DEFAULT NULL,
  `pbb_stts` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `pbb_tahun` int(11) DEFAULT NULL,
  `listrik_status` int(11) DEFAULT '0',
  `listrik_daya` int(11) DEFAULT NULL,
  `telephone_status` int(11) DEFAULT '0',
  `telephone_jumlah_line` int(11) DEFAULT NULL,
  `pam_status` int(11) DEFAULT '0',
  `pemegang_kunci` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sold` int(11) DEFAULT '0',
  `ayda_status_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `ayda_type_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ayda_insurance_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ayda_doc_id` int(11) unsigned NOT NULL DEFAULT '0',
  `nilai_jual` decimal(20,0) DEFAULT NULL,
  `ltlb` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`),
  KEY `FKIndex2` (`ayda_type_id`),
  KEY `FKIndex3` (`ayda_insurance_id`),
  KEY `FKIndex4` (`ayda_doc_id`),
  KEY `FKIndex5` (`ayda_status_id`),
  KEY `FKIndex1` (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `aydas`
--


-- --------------------------------------------------------

--
-- Table structure for table `ayda_ages`
--

DROP TABLE IF EXISTS `ayda_ages`;
CREATE TABLE IF NOT EXISTS `ayda_ages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `low` int(11) DEFAULT NULL,
  `high` int(11) DEFAULT NULL,
  `ppap_pct` int(11) DEFAULT NULL,
  `id_ayda_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKIndex1` (`id_ayda_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ayda_ages`
--

INSERT INTO `ayda_ages` (`id`, `low`, `high`, `ppap_pct`, `id_ayda_status`) VALUES
(1, 0, 1, 15, 1),
(2, 1, 3, 15, 1),
(3, 3, 5, 50, 2),
(4, 5, 2000, 100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ayda_docs`
--

DROP TABLE IF EXISTS `ayda_docs`;
CREATE TABLE IF NOT EXISTS `ayda_docs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `heading` int(11) DEFAULT '0',
  `kode` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ayda_docs`
--

INSERT INTO `ayda_docs` (`id`, `nama`, `heading`, `kode`) VALUES
(1, 'SERTIFIKAT', 1, '01'),
(2, 'SHM', 0, '0101'),
(3, 'SHGB', 0, '0102'),
(4, 'SHRSS', 0, '0103'),
(5, 'BPKB', 0, '02');

-- --------------------------------------------------------

--
-- Table structure for table `ayda_insurances`
--

DROP TABLE IF EXISTS `ayda_insurances`;
CREATE TABLE IF NOT EXISTS `ayda_insurances` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ayda_insurances`
--

INSERT INTO `ayda_insurances` (`id`, `nama`) VALUES
(1, 'Asuransi Jiwa'),
(2, 'Asuransi Kebakaran');

-- --------------------------------------------------------

--
-- Table structure for table `ayda_statuses`
--

DROP TABLE IF EXISTS `ayda_statuses`;
CREATE TABLE IF NOT EXISTS `ayda_statuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `low` int(11) DEFAULT NULL,
  `high` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ayda_statuses`
--

INSERT INTO `ayda_statuses` (`id`, `nama`, `low`, `high`) VALUES
(1, 'Lancar', 0, 15),
(2, 'Kurang lancar', 15, 50),
(3, 'Macet', 50, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ayda_types`
--

DROP TABLE IF EXISTS `ayda_types`;
CREATE TABLE IF NOT EXISTS `ayda_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ayda_types`
--

INSERT INTO `ayda_types` (`id`, `nama`) VALUES
(1, 'Tanah'),
(3, 'Apartemen'),
(2, 'Rumah'),
(4, 'Villa'),
(5, 'Pabrik'),
(6, 'Motorcycle'),
(7, 'Mesin'),
(8, 'Ruko'),
(9, 'Gedung'),
(10, 'Workshop '),
(11, 'Infrastruktur'),
(12, 'Kantor'),
(13, 'Kios'),
(14, 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_account_no` varchar(50) NOT NULL,
  `bank_account_name` varchar(200) NOT NULL,
  `bank_account_type_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`,`bank_account_type_id`),
  KEY `currency_id` (`currency_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `supplier_id`, `bank_name`, `bank_account_no`, `bank_account_name`, `bank_account_type_id`, `currency_id`) VALUES
(1, 28, 'BCA', '123456', 'Ujang', 1, 1),
(2, 29, 'Rabobank', '76492023', 'Asep Gugur', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_types`
--

DROP TABLE IF EXISTS `bank_account_types`;
CREATE TABLE IF NOT EXISTS `bank_account_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `descr` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bank_account_types`
--

INSERT INTO `bank_account_types` (`id`, `name`, `descr`) VALUES
(1, 'Transfer', ''),
(2, 'Overbooking', '');

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

DROP TABLE IF EXISTS `business_types`;
CREATE TABLE IF NOT EXISTS `business_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `business_types`
--

INSERT INTO `business_types` (`id`, `name`) VALUES
(1, 'Wholesale'),
(2, 'Retail'),
(3, 'GFM');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ci_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

DROP TABLE IF EXISTS `conditions`;
CREATE TABLE IF NOT EXISTS `conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `code`, `name`) VALUES
(10, 'JUAL', 'Dijual'),
(3, 'HILANG', 'Hilang'),
(2, 'RUSAK', 'Rusak'),
(1, 'BAGUS', 'Bagus'),
(4, 'IC', 'Intercoy');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE IF NOT EXISTS `configs` (
  `key` varchar(20) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`key`, `value`) VALUES
('depr_cut_date', '15'),
('po_notes', 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF '),
('npb_notes', 'blan bpafhdsdfs dshfkjdskjfdskjfjds fhkdsjfjkdshf sfj dskfhs'),
('po_shipping_address', 'Rabobank, \r\nJl Rasuna Said'),
('po_billing_address', 'Rabobank,\r\nJl Rasuna Said'),
('default_wht_rate', '2.5'),
('default_vat_rate', '10'),
('min_asset_value', '5000000'),
('po_address', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160'),
('po_rabobank', 'PT. Rabobank International Indonesia'),
('copyright_id', 'Copyright Â© %d Rabobank. All rights reserved.'),
('depreciation_warning', 'Depreciation is only done once a month that is in the middle of the month or the 15th. If you push the button it will start accounting for depreciation. So make sure first.'),
('login_message', 'Only authorized, is entitled to enter into this application');

-- --------------------------------------------------------

--
-- Table structure for table `cost_centers`
--

DROP TABLE IF EXISTS `cost_centers`;
CREATE TABLE IF NOT EXISTS `cost_centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_Id` varchar(255) NOT NULL,
  `division` varchar(11) NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `sub_division` varchar(11) NOT NULL,
  `sub_division_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost_centers` varchar(11) NOT NULL,
  `organization_level` varchar(255) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `cost_centers`
--

INSERT INTO `cost_centers` (`id`, `organization_Id`, `division`, `division_name`, `sub_division`, `sub_division_name`, `name`, `cost_centers`, `organization_level`, `desc`) VALUES
(1, 'CMCM', 'CM', 'Compliance', 'CMCM', 'Compliance-Sub Div', 'Compliance - Sub Div', 'CM000000', 'Sub Division', NULL),
(2, 'CMCMA', 'CM', 'Compliance', 'CMCM', 'Compliance - Sub Div', 'Advisory & Assurance', 'CM010000', 'Department', NULL),
(3, 'CMCMC', 'CM', 'Compliance', 'CMCM', 'Compliance - Sub Div', 'Special Unit of CDD', 'CM020000', 'Department', NULL),
(4, 'CM', 'CM', 'Compliance', '', '', 'Compliance', 'CM000000', 'Division', NULL),
(5, 'CR', 'CR', 'Core Banking Project', '', '', 'Core Banking Project', 'CR000000', 'Division', NULL),
(6, 'CRCRB', 'CR', 'Core Banking Project', '', '', 'Core Banking Project', 'CR000000', 'Department', NULL),
(7, 'CBCB', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Corporate Banking - Sub Div', 'CB000000', 'Sub Division', NULL),
(8, 'CBCBB', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Corporate Finance', 'CB010000', 'Department', NULL),
(9, 'CBCBC', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Financial Institution', 'CB020000', 'Department', NULL),
(10, 'CBCBD', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'MACA', 'CB030000', 'Department', NULL),
(11, 'CBCBE', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Relationship Management', 'CB040000', 'Department', NULL),
(12, 'CBCBF', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'STCF', 'CB050000', 'Department', NULL),
(13, 'CBCBG', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Transactional Service', 'CB060000', 'Department', NULL),
(14, 'CBCBH', 'CB', 'Corporate Banking', 'CBCB', 'Corporate Banking - Sub Div', 'Trade Finance Information', 'CB070000', 'Department', NULL),
(15, 'CB', 'CB', 'Corporate Banking', '', '', 'Corporate Banking', 'CB000000', 'Division', NULL),
(16, 'CCCC', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Corporate Communications - Sub Div', 'CC000000', 'Sub Division', NULL),
(17, 'CCCCA', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Advertising & Promotions', 'CC010000', 'Department', NULL),
(18, 'CCCCB', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Creative Advertising ', 'CC020000', 'Department', NULL),
(19, 'CCCCD', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Internal Communications & E-Communications ', 'CC030000', 'Department', NULL),
(20, 'CCCCE', 'CC', 'Corporate Communications', 'CCCC', 'Corporate Communications - Sub Div', 'Public and Media Relations & CSR ', 'CC040000', 'Department', NULL),
(21, 'CC', 'CC', 'Corporate Communications', '', '', 'Corporate Communications', 'CC000000', 'Division', NULL),
(22, 'FRFC', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Financial Control', 'FC000000', 'Sub Division', NULL),
(23, 'FRFCC', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'BI Reporting, Tax & Project', 'FC010000', 'Department', NULL),
(24, 'FRFCCB', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'BI Reporting', 'FC010100', 'Unit', NULL),
(25, 'FRFCCC', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Tax', 'FC010200', 'Unit', NULL),
(26, 'FRFCCD', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'IT Finance & Project', 'FC010300', 'Unit', NULL),
(27, 'FRFCD', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'MIS-HO Reporting & Accounting', 'FC020000', 'Department', NULL),
(28, 'FRFCDB', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'MIS & HO Reporting', 'FC020100', 'Unit', NULL),
(29, 'FRFCDC', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Accounting', 'FC020200', 'Unit', NULL),
(30, 'FRFCDD', 'FR', 'Finance & Risk Management', 'FRFC', 'Financial Control', 'Regional Office Accounting', 'FC020300', 'Unit', NULL),
(31, 'FRLG', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal', 'LG000000', 'Sub Division', NULL),
(32, 'FRLGAA', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal - Counsel, Retail', 'LG010000', 'Department', NULL),
(33, 'FRLGAB', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal - Remedial Legal Team', 'LG020000', 'Department', NULL),
(34, 'FRLGAC', 'FR', 'Finance & Risk Management', 'FRLG', 'Legal', 'Legal - Counsel, Wholesale/Commercial', 'LG030000', 'Department', NULL),
(35, 'FRPM', 'FR', 'Finance & Risk Management', 'FRPM', 'Project Management', 'Project Management', 'PM000000', 'Sub Division', NULL),
(36, 'FRRM', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Risk Management', 'RM000000', 'Sub Division', NULL),
(37, 'FRRMB', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Operational Risk', 'RM010000', 'Department', NULL),
(38, 'FRRMBA', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Operational Risk', 'RM010000', 'Unit', NULL),
(39, 'FRRMC', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk', 'RM020000', 'Department', NULL),
(40, 'FRRMCB', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk Wholesale', 'RM020100', 'Unit', NULL),
(41, 'FRRMCC', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk Commercial & SME', 'RM020200', 'Unit', NULL),
(42, 'FRRMCCA', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'SME Analyst', 'RM020201', 'Sub Unit', NULL),
(43, 'FRRMCCB', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Commercial Analyst', 'RM020202', 'Sub Unit', NULL),
(44, 'FRRMCCC', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Appraisal and Property Management', 'RM020203', 'Sub Unit', NULL),
(45, 'FRRMCG', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Secretary', 'RM020300', 'Unit', NULL),
(46, 'FRRMD', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Commodity Support Group', 'RM030000', 'Department', NULL),
(47, 'FRRME', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Special Assets Management', 'RM040000', 'Department', NULL),
(48, 'FRRMF', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Risk Admin', 'RM050000', 'Department', NULL),
(49, 'FRRMFB', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Credit Support & Reporting', 'RM050100', 'Unit', NULL),
(50, 'FRRMFC', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'CRA Wholesale', 'RM050200', 'Unit', NULL),
(51, 'FRRMFD', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'CRA Retail', 'RM050300', 'Unit', NULL),
(52, 'FRRMG', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Market Risk', 'RM060000', 'Department', NULL),
(53, 'FRRMH', 'FR', 'Finance & Risk Management', 'FRRM', 'Risk Management', 'Portfolio Management', 'RM070000', 'Department', NULL),
(54, 'FR', 'FR', 'Finance & Risk Management', '', '', 'Finance & Risk Management', 'RM000000', 'Division', NULL),
(55, 'HRHR', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Human Resources - Sub Div', 'HR000000', 'Sub Division', NULL),
(56, 'HRHRA', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Compensation and Benefit', 'HR010000', 'Department', NULL),
(57, 'HRHRAB', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HR Payroll', 'HR010100', 'Unit', NULL),
(58, 'HRHRAC', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HRIS', 'HR010200', 'Unit', NULL),
(59, 'HRHRB', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Employee Relations and Communications', 'HR020000', 'Department', NULL),
(60, 'HRHRBA', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Employee Relations and Communication', 'HR020000', 'Unit', NULL),
(61, 'HRHRBB', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Outsourcing', 'HR020000', 'Unit', NULL),
(62, 'HRHRBC', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HRRM', 'HR020000', 'Unit', NULL),
(63, 'HRHRD', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'HR Services and Administration', 'HR030000', 'Department', NULL),
(64, 'HRHRE', 'HR', 'Human Resources', 'HRHR', 'Human Resources - Sub Div', 'Learning and Development', 'HR040000', 'Department', NULL),
(65, 'HR', 'HR', 'Human Resources', '', '', 'Human Resources', 'HR000000', 'Division', NULL),
(66, 'IAIA', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Internal Audit - Sub Div', 'IA000000', 'Sub Division', NULL),
(67, 'IAIAB', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Ops & IT Audit', 'IA010000', 'Department', NULL),
(68, 'IAIAC', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Retail and SME Audit', 'IA020000', 'Department', NULL),
(69, 'IAIAD', 'IA', 'Internal Audit', 'IAIA', 'Internal Audit - Sub Div', 'Wholesale Banking and HO Function Audit', 'IA030000', 'Department', NULL),
(70, 'IA', 'IA', 'Internal Audit', '', '', 'Internal Audit', 'IA000000', 'Division', NULL),
(71, 'OIOI', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Operations & IT - Sub Div', 'OI000000', 'Sub Division', NULL),
(72, 'OIOIA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Security & BCM', 'OI010000', 'Department', NULL),
(73, 'OIOIAB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'BCM', 'OI010100', 'Unit', NULL),
(74, 'OIOIAC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Security Operations', 'OI010200', 'Unit', NULL),
(75, 'OIOIAD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Security Risk Management', 'OI010300', 'Unit', NULL),
(76, 'OIOIAE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Source Code Control', 'OI010400', 'Unit', NULL),
(77, 'OIOIB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Central Operations Asset', 'OI020000', 'Department', NULL),
(78, 'OIOIBB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Loan Operations', 'OI020100', 'Unit', NULL),
(79, 'OIOIBBC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Retail Loan Operations', 'OI020101', 'Sub Unit', NULL),
(80, 'OIOIBBD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Wholesale Loan Operations', 'OI020102', 'Sub Unit', NULL),
(81, 'OIOIBC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'International Trade Services', 'OI020200', 'Unit', NULL),
(82, 'OIOIBCB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Structure Trade Commodity Fin.', 'OI020201', 'Sub Unit', NULL),
(83, 'OIOIBCC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'International Trade & Services', 'OI020202', 'Sub Unit', NULL),
(84, 'OIOIBCD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Trade Loan', 'OI020203', 'Sub Unit', NULL),
(85, 'OIOIC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Central Operations Liabilities + FX', 'OI030000', 'Department', NULL),
(86, 'OIOICB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Cash Management', 'OI030100', 'Unit', NULL),
(87, 'OIOICC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Settlements', 'OI030200', 'Unit', NULL),
(88, 'OIOICCB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Bill Payment', 'OI030201', 'Sub Unit', NULL),
(89, 'OIOICCC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Local Clearing', 'OI030202', 'Sub Unit', NULL),
(90, 'OIOICCD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Cek & BG Printing', 'OI030203', 'Sub Unit', NULL),
(91, 'OIOICCE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'International Clearing', 'OI030204', 'Sub Unit', NULL),
(92, 'OIOICCF', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Central Processing', 'OI030205', 'Sub Unit', NULL),
(93, 'OIOICD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Treasury Operations', 'OI030300', 'Unit', NULL),
(94, 'OIOICE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Card and E-banking', 'OI030400', 'Unit', NULL),
(95, 'OIOID', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Delivery Channel', 'OI040000', 'Department', NULL),
(96, 'OIOIDB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Contact Center', 'OI040100', 'Unit', NULL),
(97, 'OIOIDC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations', 'OI040200', 'Unit', NULL),
(98, 'OIOIDDA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations', 'OI040201', 'Sub Unit', NULL),
(99, 'OIOIDFA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations - Office Support', 'OI040202', 'Sub Unit', NULL),
(100, 'OIOIDGA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations - Security', 'OI040203', 'Sub Unit', NULL),
(101, 'OIOIDI', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Wealth Management Operations', 'OI040300', 'Unit', NULL),
(102, 'OIOIE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'IT Infrastructure', 'OI050000', 'Department', NULL),
(103, 'OIOIEB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Business Support', 'OI050100', 'Unit', NULL),
(104, 'OIOIEC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Data Center', 'OI050200', 'Unit', NULL),
(105, 'OIOIEE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Client Support', 'OI050300', 'Unit', NULL),
(106, 'OIOIEF', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Network Support', 'OI050400', 'Unit', NULL),
(107, 'OIOIEG', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - System Support', 'OI050500', 'Unit', NULL),
(108, 'OIOIEH', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'ITI - Help Desk', 'OI050600', 'Unit', NULL),
(109, 'OIOIF', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Project Management & Business Process Improvement', 'OI070000', 'Department', NULL),
(110, 'OIOIFA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Operations Management', 'OI000000', 'Unit', NULL),
(111, 'OIOIG', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Operations Development & Support', 'OI080000', 'Department', NULL),
(112, 'OIOIGB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Branch Operations Support', 'OI080100', 'Unit', NULL),
(113, 'OIOIGC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'System and Procedures', 'OI080200', 'Unit', NULL),
(114, 'OIOIGD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'MIS', 'OI080300', 'Unit', NULL),
(115, 'OIOIGE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Reconciliation Operations & Quality Assurance', 'OI080400', 'Unit', NULL),
(116, 'OIOIGEB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Reconciliation Operations', 'OI080401', 'Sub Unit', NULL),
(117, 'OIOIGEC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Quality Assurance', 'OI080402', 'Sub Unit', NULL),
(118, 'OIOIH', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'IT System and Development', 'OI060000', 'Department', NULL),
(119, 'OIOIHA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Engineer', 'OI060100', 'Unit', NULL),
(120, 'OIOIHC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'System & Development', 'OI060200', 'Unit', NULL),
(121, 'OIOIHCB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Application Development', 'OI060201', 'Sub Unit', NULL),
(122, 'OIOIHCC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Application Support', 'OI060202', 'Sub Unit', NULL),
(123, 'OIOIHCD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Regional Support', 'OI060300', 'Unit', NULL),
(124, 'OIOIHCDA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Corporate IT', 'OI060301', 'Sub Unit', NULL),
(125, 'OIOIHCDB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Finance IT', 'OI060302', 'Sub Unit', NULL),
(126, 'OIOIHD', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Development Project', 'OI060400', 'Unit', NULL),
(127, 'OI', 'OI', 'Operations & IT', '', '', 'Operations & IT', 'OI000000', 'Division', NULL),
(128, 'OIOIIA', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'General Services', 'OI090000', 'Department', NULL),
(129, 'OIOIIB', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'General Administration', 'OI090100', 'Unit', NULL),
(130, 'OIOIIC', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Property & Facility Management', 'OI090200', 'Unit', NULL),
(131, 'OIOIID', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Service and Maintenance', 'OI090300', 'Unit', NULL),
(132, 'OIOIIE', 'OI', 'Operations & IT', 'OIOI', 'Operations & IT - Sub Div', 'Procurement', 'OI090400', 'Unit', NULL),
(133, 'RSRS', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME - Sub Div', 'RS000000', 'Sub Division', NULL),
(134, 'RSRSAA', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME Management', 'RS000000', 'Unit', NULL),
(135, 'RSRSC', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Commercial', 'RS010000', 'Department', NULL),
(136, 'RSRSD', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Products & Strategy', 'RS020000', 'Department', NULL),
(137, 'RSRSDC', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME Funding and Wealth', 'RS020100', 'Unit', NULL),
(138, 'RSRSDD', 'RS', 'Retail & SME', 'RSRS', 'Retail & SME - Sub Div', 'Retail & SME Lending', 'RS020200', 'Unit', NULL),
(139, 'RS', 'RS', 'Retail & SME', '', '', 'Retail & SME', 'RS000000', 'Division', NULL),
(140, 'RSRSB', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution - Sub Div', 'Sales & Distribution', 'SD000000', 'Division', NULL),
(141, 'RSRSBB', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales & Service Quality', 'SD010000', 'Department', NULL),
(142, 'RSRSBBA', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales & Service Quality', 'SD010000', 'Unit', NULL),
(143, 'RSRSBEA', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Special Project "YWC"', 'SD010000', 'Unit', NULL),
(144, 'RSRSBC', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales Support, MIS, SIS, Agency Management', 'SD020000', 'Department', NULL),
(145, 'RSRSBD', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Network Strategy & Branch Optimization', 'SD030000', 'Department', NULL),
(146, 'RSRSBF', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Sales and Acquisition', 'SD040000', 'Department', NULL),
(147, 'RSRSBG', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Regional', 'SD050000', 'Department', NULL),
(148, 'RSRSBHA', 'RS', 'Sales & Distribution', 'SDSD', 'Sales & Distribution', 'Branch Office', 'SD050100', 'Unit', NULL),
(149, 'TRTR', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Treasury - Sub Div', 'TR000000', 'Sub Division', NULL),
(150, 'TRTRA', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Money Market', 'TR010000', 'Department', NULL),
(151, 'TRTRB', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Sales - Branch and Retail', 'TR020000', 'Department', NULL),
(152, 'TRTRC', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Sales - Corporate & Structured Products', 'TR030000', 'Department', NULL),
(153, 'TRTRE', 'TR', 'Treasury', 'TRTR', 'Treasury - Sub Div', 'Fx Trading', 'TR040000', 'Department', NULL),
(154, 'TR', 'TR', 'Treasury', '', '', 'Treasury', 'TR000000', 'Division', NULL),
(155, 'COMM', '', '', '', '', 'COMMISIONER', 'MG000000', 'Commisioner', NULL),
(156, 'MG', '', '', '', '', 'Management', 'MG000000', 'Management', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(4) DEFAULT NULL,
  `rp_rate` decimal(10,2) DEFAULT NULL,
  `last_update_tgl` datetime DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `rp_BI_rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `rp_rate`, `last_update_tgl`, `description`, `rp_BI_rate`) VALUES
(1, 'Rp', '1.00', NULL, 'Rupiah', NULL),
(2, 'USD', '10000.00', '2005-10-24 14:18:00', 'Dolar', 10500),
(3, 'AUD', '4750.00', '2005-10-24 14:13:57', 'Dolar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency_details`
--

DROP TABLE IF EXISTS `currency_details`;
CREATE TABLE IF NOT EXISTS `currency_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `currency_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tanggal` datetime DEFAULT NULL,
  `rp_rate` float DEFAULT NULL,
  `rp_BI_rate` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `currency_details`
--

INSERT INTO `currency_details` (`id`, `currency_id`, `tanggal`, `rp_rate`, `rp_BI_rate`) VALUES
(1, 3, '2005-10-24 14:13:57', 4750, 0),
(2, 2, '2005-10-24 14:18:58', 10000, 10500),
(3, 3, '2011-01-13 22:40:00', 455, 654),
(4, 1, '2011-04-16 12:59:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

DROP TABLE IF EXISTS `delivery_orders`;
CREATE TABLE IF NOT EXISTS `delivery_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `no` varchar(10) NOT NULL,
  `do_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `delivery_order_status_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `convert_invoice` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval_info` text NOT NULL,
  `wht_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_rate` decimal(10,2) NOT NULL DEFAULT '10.00',
  `vat_base` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat_base_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_base` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_base_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sub_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sub_total_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `after_disc` decimal(20,2) NOT NULL DEFAULT '0.00',
  `after_disc_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_total_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat_total_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `billing_address` text NOT NULL,
  `shipping_address` text NOT NULL,
  `rp_rate` decimal(20,2) NOT NULL,
  `request_type_id` int(11) DEFAULT '1',
  `convert_asset` tinyint(1) DEFAULT '0',
  `is_journal_generated` tinyint(1) DEFAULT '0',
  `journal_generated_date` datetime DEFAULT NULL,
  `is_first` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `id_supplier` (`supplier_id`),
  KEY `created` (`created`),
  KEY `id_department` (`department_id`),
  KEY `po_status_id` (`delivery_order_status_id`),
  KEY `delivery_date` (`delivery_date`),
  KEY `po_date` (`do_date`),
  KEY `currency_id` (`currency_id`),
  KEY `po_id` (`po_id`),
  KEY `request_type_idx` (`request_type_id`),
  KEY `convert_assetx` (`convert_asset`),
  KEY `is_journal_generatedx` (`is_journal_generated`),
  KEY `is_firstx` (`is_first`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `po_id`, `no`, `do_date`, `delivery_date`, `supplier_id`, `department_id`, `delivery_order_status_id`, `currency_id`, `description`, `convert_invoice`, `created`, `approval_info`, `wht_rate`, `vat_rate`, `vat_base`, `vat_base_cur`, `wht_base`, `wht_base_cur`, `sub_total`, `sub_total_cur`, `discount`, `discount_cur`, `after_disc`, `after_disc_cur`, `wht_total`, `wht_total_cur`, `vat_total`, `vat_total_cur`, `total`, `total_cur`, `billing_address`, `shipping_address`, `rp_rate`, `request_type_id`, `convert_asset`, `is_journal_generated`, `journal_generated_date`, `is_first`) VALUES
(1, 1, 'BIF/001', '2011-07-07', '0000-00-00', 28, 2, 2, 0, 'receive DO', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '63250000.00', '0.00', '0.00', '0.00', '63250000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '69575000.00', '', '', '0.00', 2, 1, 0, NULL, 1),
(2, 2, 'TR.001', '2011-07-07', '0000-00-00', 29, 2, 2, 0, 'terima dari trikarya', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '183750000.00', '0.00', '0.00', '0.00', '183750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '202125000.00', '', '', '0.00', 1, 1, 0, NULL, 1),
(3, 1, 'BIF/002', '2011-07-07', '0000-00-00', 28, 2, 2, 0, 'barang ke 2', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '7500000.00', '0.00', '0.00', '0.00', '7500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '8250000.00', '', '', '0.00', 2, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order_details`
--

DROP TABLE IF EXISTS `delivery_order_details`;
CREATE TABLE IF NOT EXISTS `delivery_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_order_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_detail_id` int(11) NOT NULL,
  `asset_category_id` varchar(29) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `color` varchar(64) NOT NULL,
  `brand` varchar(64) NOT NULL,
  `type` varchar(64) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `qty_received` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `price_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_after_disc` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_after_disc_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_nett` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_nett_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `currency_id` int(11) NOT NULL,
  `rp_rate` decimal(20,2) NOT NULL DEFAULT '1.00',
  `npb_id` int(11) NOT NULL,
  `umurek` int(11) NOT NULL,
  `is_vat` tinyint(1) NOT NULL DEFAULT '1',
  `is_wht` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` int(11) DEFAULT NULL,
  `department_sub_id` int(11) DEFAULT NULL,
  `department_unit_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `discount_unit_cur` decimal(20,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_asset_category` (`asset_category_id`),
  KEY `id_invoice` (`po_id`),
  KEY `id_npb` (`npb_id`),
  KEY `is_ppn` (`is_vat`,`is_wht`),
  KEY `department_id` (`department_id`),
  KEY `do_id` (`delivery_order_id`),
  KEY `po_detail_id` (`po_detail_id`),
  KEY `item_idx` (`item_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `delivery_order_details`
--

INSERT INTO `delivery_order_details` (`id`, `delivery_order_id`, `po_id`, `po_detail_id`, `asset_category_id`, `item_code`, `name`, `color`, `brand`, `type`, `qty`, `qty_received`, `price`, `price_cur`, `amount`, `amount_cur`, `discount`, `discount_cur`, `amount_after_disc`, `amount_after_disc_cur`, `vat`, `vat_cur`, `amount_nett`, `amount_nett_cur`, `currency_id`, `rp_rate`, `npb_id`, `umurek`, `is_vat`, `is_wht`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `item_id`, `discount_unit_cur`) VALUES
(1, 1, 1, 1, '9', '7KRS001', 'KURSI KERJA', '-', 'BIF', 'MJ007', 20, 10, '0.00', '750000.00', '7500000.00', '7500000.00', '0.00', '0.00', '7500000.00', '7500000.00', '750000.00', '750000.00', '8250000.00', '8250000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 34, '0.00'),
(2, 1, 1, 2, '9', '7KRS002', 'KURSI HADAP', '-', 'BIF', 'KR002', 10, 10, '0.00', '1500000.00', '15000000.00', '15000000.00', '0.00', '0.00', '15000000.00', '15000000.00', '1500000.00', '1500000.00', '16500000.00', '16500000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 35, '0.00'),
(3, 1, 1, 3, '8', '7MJA002', 'MEJA NASABAH', '-', 'LIGNA', 'MJ001', 3, 3, '0.00', '9500000.00', '28500000.00', '28500000.00', '0.00', '0.00', '28500000.00', '28500000.00', '2850000.00', '2850000.00', '31350000.00', '31350000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 37, '0.00'),
(4, 1, 1, 4, '9', '7MSN001', 'MESIN TIK', '-', 'Brother', 'MS01', 2, 2, '0.00', '1250000.00', '2500000.00', '2500000.00', '0.00', '0.00', '2500000.00', '2500000.00', '250000.00', '250000.00', '2750000.00', '2750000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 38, '0.00'),
(5, 1, 1, 5, '9', '7KRS001', 'KURSI KERJA', '-', 'BIF', 'KR001', 5, 5, '0.00', '750000.00', '3750000.00', '3750000.00', '0.00', '0.00', '3750000.00', '3750000.00', '375000.00', '375000.00', '4125000.00', '4125000.00', 1, '0.00', 3, 5, 1, 0, 5, 0, 0, 2, 1, 34, '0.00'),
(6, 1, 1, 6, '8', '7MJA001', 'MEJA KERJA', '-', 'LIGNA', 'MJ007', 1, 1, '0.00', '6000000.00', '6000000.00', '6000000.00', '0.00', '0.00', '6000000.00', '6000000.00', '600000.00', '600000.00', '6600000.00', '6600000.00', 1, '0.00', 3, 5, 1, 0, 5, 0, 0, 2, 1, 36, '0.00'),
(7, 2, 2, 7, '6', '6PCD001', 'DEKSTOP DELL OPTIPLEX', '-', 'Dell', 'GX280', 3, 3, '0.00', '2750000.00', '8250000.00', '8250000.00', '0.00', '0.00', '8250000.00', '8250000.00', '825000.00', '825000.00', '9075000.00', '9075000.00', 1, '0.00', 2, 5, 1, 0, 2, 0, 0, 2, 1, 20, '0.00'),
(8, 2, 2, 8, '6', '6PCT001', 'THIN CLIENT  ', '-', 'ITONA', 'T3851', 5, 5, '0.00', '4500000.00', '22500000.00', '22500000.00', '0.00', '0.00', '22500000.00', '22500000.00', '2250000.00', '2250000.00', '24750000.00', '24750000.00', 1, '0.00', 2, 5, 1, 0, 2, 0, 0, 2, 1, 22, '0.00'),
(9, 2, 2, 9, '6', '6PRE001 ', 'PRINTER EPSON LQ 2180', '-', 'Epson', 'LQ2180', 3, 3, '0.00', '51000000.00', '153000000.00', '153000000.00', '0.00', '0.00', '153000000.00', '153000000.00', '15300000.00', '15300000.00', '168300000.00', '168300000.00', 1, '0.00', 4, 5, 1, 0, 5, 0, 0, 2, 1, 24, '0.00'),
(10, 3, 1, 1, '9', '7KRS001', 'KURSI KERJA', '-', 'BIF', 'MJ007', 20, 10, '0.00', '750000.00', '7500000.00', '7500000.00', '0.00', '0.00', '7500000.00', '7500000.00', '750000.00', '750000.00', '8250000.00', '8250000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 34, '0.00'),
(11, 3, 1, 2, '9', '7KRS002', 'KURSI HADAP', '-', 'BIF', 'KR002', 10, 0, '0.00', '1500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 35, '0.00'),
(12, 3, 1, 3, '8', '7MJA002', 'MEJA NASABAH', '-', 'LIGNA', 'MJ001', 3, 0, '0.00', '9500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 37, '0.00'),
(13, 3, 1, 4, '9', '7MSN001', 'MESIN TIK', '-', 'Brother', 'MS01', 2, 0, '0.00', '1250000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 38, '0.00'),
(14, 3, 1, 5, '9', '7KRS001', 'KURSI KERJA', '-', 'BIF', 'KR001', 5, 0, '0.00', '750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3, 5, 1, 0, 5, 0, 0, 2, 1, 34, '0.00'),
(15, 3, 1, 6, '8', '7MJA001', 'MEJA KERJA', '-', 'LIGNA', 'MJ007', 1, 0, '0.00', '6000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3, 5, 1, 0, 5, 0, 0, 2, 1, 36, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order_statuses`
--

DROP TABLE IF EXISTS `delivery_order_statuses`;
CREATE TABLE IF NOT EXISTS `delivery_order_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sorter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `delivery_order_statuses`
--

INSERT INTO `delivery_order_statuses` (`id`, `name`, `sorter`) VALUES
(1, 'New', 0),
(2, 'Done', 0),
(4, 'Sent to Supervisor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(3) NOT NULL,
  `name` char(40) DEFAULT NULL,
  `account_code` varchar(20) NOT NULL,
  `area` varchar(11) NOT NULL,
  `business_type_id` int(10) DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `account_code` (`account_code`),
  KEY `business_type_idx` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1015 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `account_code`, `area`, `business_type_id`) VALUES
(1, '010', 'Abdul Muis', '010', '1', 2),
(2, '012', 'Raden Saleh', '012', '1', 2),
(3, '130', 'Depok', '130', '1', 2),
(4, '016', 'Kramat Jati', '016', '1', 2),
(5, '021', 'Cipinang', '021', '1', 2),
(6, '026', 'Krekot', '026', '1', 2),
(7, '027', 'Iskandarsyah', '027', '1', 2),
(8, '031', 'Jatinegara', '031', '1', 2),
(9, '032', 'Bintaro', '032', '1', 2),
(10, '034', 'Harapan Indah Bekasi', '034', '1', 2),
(11, '036', 'Tebet', '036', '1', 2),
(12, '038', 'Kelapa Gading', '038', '1', 2),
(13, '062', 'Karawang - Resinda', '062', '1', 2),
(14, '091', 'Kebon Sirih', '091', '1', 2),
(15, '096', 'Sunter', '096', '1', 2),
(16, '099', 'Tanah Abang', '099', '1', 2),
(17, '175', 'Fatmawati', '175', '1', 2),
(18, '180', 'Slipi', '180', '1', 2),
(19, '302', 'Rasuna Said(Plaza 89)', '302', '1', 2),
(20, '400', 'Pontianak', '400', '1', 2),
(21, '642', 'Bogor', '642', '1', 2),
(22, '011', 'Perniagaan', '011', '2', 2),
(23, '015', 'Palmerah', '015', '2', 2),
(24, '017', 'Tanhung Duren', '017', '2', 2),
(25, '018', 'Pasar Pagi', '018', '2', 2),
(26, '024', 'Bumi Serpong Damai', '024', '2', 2),
(27, '025', 'Tangerang', '025', '2', 2),
(28, '028', 'Taman Alfa', '028', '2', 2),
(29, '030', 'Teluk Gong', '030', '2', 2),
(30, '033', 'Daan Mogot Baru', '033', '2', 2),
(31, '035', 'Green Garden', '035', '2', 2),
(32, '037', 'Bandengan', '037', '2', 2),
(33, '039', 'Gading Serpong', '039', '2', 2),
(34, '060', 'Bandung - Aceh', '060', '2', 2),
(35, '090', 'Mangga Dua Mall', '090', '2', 2),
(36, '092', 'Glodok Makmur', '092', '2', 2),
(37, '093', 'Muara Karang', '093', '2', 2),
(38, '094', 'Taman Palem', '094', '2', 2),
(39, '095', 'Meruya', '095', '2', 2),
(40, '660', 'Sukabumi', '660', '2', 2),
(41, '051', 'Lampung - Teluk Betung', '051', '3', 2),
(42, '052', 'Lampung - Metro', '052', '3', 2),
(43, '053', 'Palembang - Sayangan', '053', '3', 2),
(44, '055', 'Palembang - Ilir Barat Permai', '055', '3', 2),
(45, '303', 'Lampung - Kartini', '303', '3', 2),
(46, '570', 'Pekanbaru', '570', '3', 2),
(47, '576', 'Batam', '576', '3', 2),
(48, '711', 'Medan Asia', '711', '3', 2),
(49, '562', 'Medan Diponegoro', '562', '3', 2),
(50, '061', 'Cirebon', '061', '4', 2),
(51, '070', 'Semarang - Agus Salim', '070', '4', 2),
(52, '071', 'Kudus', '071', '4', 2),
(53, '072', 'Solo', '072', '4', 2),
(54, '073', 'Jogyakarta', '073', '4', 2),
(55, '074', 'Magelang', '074', '4', 2),
(56, '075', 'Magelang', '075', '4', 2),
(57, '076', 'Semarang - Ahmad Yani', '076', '4', 2),
(58, '077', 'Semarang - Puri Anjasmoro', '077', '4', 2),
(59, '078', 'Pati', '078', '4', 2),
(60, '722', 'Palur', '722', '4', 2),
(61, '742', 'Temanggung', '742', '4', 2),
(62, '790', 'Tegal', '790', '4', 2),
(63, '080', 'Surabaya - Tunjungan', '080', '5', 2),
(64, '081', 'Surabaya - Kembang Jepun', '081', '5', 2),
(65, '082', 'Surabaya - Ngagel', '082', '5', 2),
(66, '083', 'Surabaya - Pasar Turi', '083', '5', 2),
(67, '085', 'Jember', '085', '5', 2),
(68, '086', 'Denpasar', '086', '5', 2),
(69, '087', 'Malang - Pasar Besar', '087', '5', 2),
(70, '088', 'Surabaya - HR Muhammad', '088', '5', 2),
(71, '089', 'Kediri', '089', '5', 2),
(72, '899', 'KPNO', '899-RL', '0', 2),
(73, '899', 'KPNO', '899-WS', '0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department_subs`
--

DROP TABLE IF EXISTS `department_subs`;
CREATE TABLE IF NOT EXISTS `department_subs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(3) DEFAULT NULL,
  `name` char(40) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `department_subs`
--


-- --------------------------------------------------------

--
-- Table structure for table `department_units`
--

DROP TABLE IF EXISTS `department_units`;
CREATE TABLE IF NOT EXISTS `department_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(3) DEFAULT NULL,
  `name` char(40) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `department_sub_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `department_units`
--


-- --------------------------------------------------------

--
-- Table structure for table `disposals`
--

DROP TABLE IF EXISTS `disposals`;
CREATE TABLE IF NOT EXISTS `disposals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_date` date NOT NULL,
  `no` varchar(10) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `disposal_status_id` varchar(50) NOT NULL,
  `disposal_type_id` varchar(50) NOT NULL,
  `reject_notes` text NOT NULL,
  `reject_by` varchar(50) NOT NULL,
  `reject_date` datetime NOT NULL,
  `cancel_notes` text NOT NULL,
  `cancel_by` varchar(50) NOT NULL,
  `cancel_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `business_type_id` (`business_type_id`,`cost_center_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `disposals`
--


-- --------------------------------------------------------

--
-- Table structure for table `disposal_details`
--

DROP TABLE IF EXISTS `disposal_details`;
CREATE TABLE IF NOT EXISTS `disposal_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disposal_id` varchar(50) NOT NULL,
  `asset_detail_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `sales_amount` decimal(20,2) unsigned DEFAULT '0.00',
  `loss_profit_amount` decimal(20,2) DEFAULT '0.00',
  `price` decimal(20,2) unsigned DEFAULT '0.00',
  `book_value` decimal(20,2) unsigned DEFAULT '0.00',
  `accum_dep` decimal(20,2) unsigned DEFAULT '0.00',
  `date_of_purchase` date NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `disposal_id` (`disposal_id`),
  KEY `asset_id` (`asset_detail_id`),
  KEY `asset_category_id` (`asset_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `disposal_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `disposal_statuses`
--

DROP TABLE IF EXISTS `disposal_statuses`;
CREATE TABLE IF NOT EXISTS `disposal_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `disposal_statuses`
--

INSERT INTO `disposal_statuses` (`id`, `name`) VALUES
(1, 'New'),
(2, 'Request For Approval'),
(3, 'Approved by Supervisor'),
(4, 'Approved by Fincon'),
(5, 'Reject'),
(6, 'Finish'),
(7, 'Journal Posted');

-- --------------------------------------------------------

--
-- Table structure for table `disposal_types`
--

DROP TABLE IF EXISTS `disposal_types`;
CREATE TABLE IF NOT EXISTS `disposal_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `disposal_types`
--

INSERT INTO `disposal_types` (`id`, `name`) VALUES
(1, 'Write Off'),
(2, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `descr` varchar(20) DEFAULT NULL,
  `auth_amount` decimal(20,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `descr`, `auth_amount`) VALUES
(1, 'admin', 'Administrators', '0'),
(2, 'Pimpinan Cabang', '', '0'),
(3, 'PO Approval 1', '', '5000000'),
(4, 'PO Approval 2', '', '10000000'),
(5, 'PO Approval 3', '', '50000000'),
(6, 'Normal', '', '0'),
(7, 'GS Procurement', 'GS Procurement', '0'),
(8, 'Fincon Users', '', '0'),
(9, 'GS Supervisor', 'SPV GS', '0'),
(10, 'GS Admin', 'GS Admin', '0'),
(11, 'FA Management', 'FA Management', '0'),
(12, 'IT Admin', 'IT Admin', '0'),
(13, 'IT Management', 'IT Management', '0'),
(14, 'Stock Management', 'Stock Management', '0'),
(100, 'Stock Supervisor', 'Stock Supervisor Gro', '0'),
(15, 'FA Supervisor', 'FA Supervisor', '0'),
(16, 'IT Supervisor', 'IT Supervisor', '0'),
(20, 'Fincon Supervisor', 'Fincon Supervisor', '0');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menus`
--

DROP TABLE IF EXISTS `groups_menus`;
CREATE TABLE IF NOT EXISTS `groups_menus` (
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `groups_menus_FKIndex1` (`group_id`),
  KEY `groups_menus_FKIndex2` (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_menus`
--

INSERT INTO `groups_menus` (`menu_id`, `group_id`) VALUES
(30, 1),
(29, 1),
(64, 1),
(63, 1),
(62, 1),
(98, 1),
(28, 1),
(148, 1),
(148, 7),
(67, 7),
(147, 1),
(146, 1),
(97, 1),
(96, 1),
(24, 1),
(93, 1),
(3, 1),
(105, 3),
(104, 3),
(73, 3),
(72, 3),
(94, 7),
(24, 7),
(10, 7),
(93, 7),
(9, 7),
(8, 7),
(7, 7),
(92, 7),
(3, 7),
(151, 7),
(150, 7),
(149, 7),
(145, 7),
(144, 7),
(90, 14),
(49, 7),
(58, 7),
(141, 7),
(142, 7),
(117, 7),
(115, 7),
(116, 7),
(114, 7),
(39, 7),
(13, 7),
(110, 7),
(113, 7),
(130, 7),
(129, 7),
(124, 7),
(126, 7),
(125, 7),
(122, 7),
(128, 7),
(127, 7),
(123, 7),
(4, 7),
(143, 7),
(140, 7),
(139, 7),
(138, 7),
(137, 7),
(136, 7),
(132, 7),
(134, 7),
(133, 7),
(131, 7),
(79, 7),
(66, 7),
(38, 7),
(103, 7),
(102, 7),
(101, 7),
(100, 7),
(2, 7),
(81, 7),
(82, 7),
(80, 7),
(109, 7),
(108, 7),
(107, 7),
(106, 7),
(78, 7),
(112, 7),
(111, 7),
(77, 7),
(76, 7),
(75, 7),
(154, 7),
(152, 7),
(105, 7),
(104, 7),
(73, 7),
(74, 7),
(72, 7),
(90, 7),
(89, 7),
(69, 7),
(68, 7),
(90, 10),
(49, 2),
(58, 2),
(141, 2),
(66, 6),
(38, 6),
(109, 6),
(78, 6),
(90, 6),
(105, 5),
(104, 5),
(73, 5),
(74, 5),
(72, 5),
(72, 4),
(74, 4),
(73, 4),
(104, 4),
(105, 4),
(72, 8),
(74, 8),
(73, 8),
(104, 8),
(105, 8),
(75, 8),
(76, 8),
(77, 8),
(111, 8),
(112, 8),
(85, 8),
(86, 8),
(78, 8),
(109, 8),
(80, 8),
(82, 8),
(2, 8),
(100, 8),
(101, 8),
(4, 8),
(123, 8),
(127, 8),
(128, 8),
(122, 8),
(125, 8),
(126, 8),
(124, 8),
(129, 8),
(130, 8),
(113, 8),
(110, 8),
(13, 8),
(39, 8),
(114, 8),
(116, 8),
(115, 8),
(117, 8),
(142, 8),
(141, 8),
(58, 8),
(49, 8),
(89, 10),
(144, 8),
(145, 8),
(149, 8),
(150, 8),
(151, 8),
(3, 8),
(87, 8),
(88, 8),
(99, 8),
(91, 8),
(89, 6),
(69, 6),
(70, 6),
(68, 6),
(142, 2),
(117, 2),
(4, 6),
(123, 6),
(127, 6),
(128, 6),
(113, 6),
(13, 6),
(39, 6),
(114, 6),
(115, 6),
(117, 6),
(142, 6),
(141, 6),
(58, 6),
(115, 2),
(114, 2),
(39, 2),
(13, 2),
(113, 2),
(128, 2),
(127, 2),
(123, 2),
(4, 2),
(109, 2),
(78, 2),
(90, 2),
(89, 2),
(69, 2),
(68, 2),
(155, 7),
(69, 10),
(68, 10),
(89, 14),
(90, 12),
(89, 12),
(69, 12),
(68, 12),
(140, 14),
(90, 13),
(89, 13),
(69, 13),
(68, 13),
(138, 14),
(137, 14),
(151, 14),
(139, 14),
(136, 14),
(69, 14),
(68, 14),
(132, 14),
(150, 14),
(149, 14),
(145, 14),
(144, 14),
(4, 14),
(79, 14),
(143, 14),
(131, 14),
(133, 14),
(134, 14),
(70, 14),
(81, 11),
(80, 11),
(78, 11),
(90, 11),
(79, 6),
(200, 6),
(210, 6),
(220, 6),
(250, 6),
(260, 6),
(360, 14),
(370, 14),
(200, 100),
(79, 100),
(143, 100),
(131, 100),
(132, 100),
(138, 100),
(89, 11),
(220, 100),
(200, 14),
(260, 100),
(250, 14),
(370, 100),
(260, 14),
(134, 100),
(220, 14),
(137, 100),
(139, 100),
(140, 100),
(69, 11),
(68, 11),
(82, 11),
(82, 16),
(80, 15),
(81, 16),
(78, 13),
(80, 13),
(81, 13),
(82, 13),
(80, 16),
(78, 15),
(78, 16),
(81, 15),
(82, 15),
(69, 100),
(371, 1),
(68, 100),
(89, 100),
(90, 100),
(373, 7),
(373, 8),
(374, 1),
(374, 2),
(374, 3),
(374, 4),
(374, 5),
(374, 6),
(374, 7),
(374, 8),
(374, 9),
(374, 10),
(374, 11),
(374, 12),
(374, 13),
(374, 14),
(374, 15),
(374, 16),
(374, 100),
(375, 1),
(375, 2),
(375, 3),
(375, 4),
(375, 5),
(375, 6),
(375, 7),
(375, 8),
(375, 9),
(375, 10),
(375, 11),
(375, 12),
(375, 13),
(375, 14),
(375, 15),
(375, 16),
(375, 100),
(373, 2),
(373, 6),
(2, 11),
(102, 11),
(101, 11),
(100, 11),
(103, 11),
(2, 15),
(102, 15),
(101, 15),
(100, 15),
(103, 15),
(400, 7),
(400, 8),
(410, 7),
(410, 8),
(420, 7),
(420, 8),
(430, 7),
(430, 8),
(68, 9),
(69, 9),
(89, 9),
(90, 9),
(374, 20),
(375, 20),
(77, 20),
(75, 20),
(111, 20),
(112, 20),
(2, 11),
(78, 11),
(38, 11),
(80, 11),
(66, 11),
(106, 11),
(109, 11),
(155, 11),
(373, 11),
(2, 15),
(78, 15),
(38, 15),
(80, 15),
(66, 15),
(106, 15),
(109, 15),
(155, 15),
(373, 15),
(2, 15),
(78, 15),
(38, 15),
(80, 15),
(66, 15),
(106, 15),
(109, 15),
(155, 15),
(373, 15);

-- --------------------------------------------------------

--
-- Table structure for table `inlogs`
--

DROP TABLE IF EXISTS `inlogs`;
CREATE TABLE IF NOT EXISTS `inlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `delivery_order_id` tinyint(1) DEFAULT '0',
  `inlog_status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `supplier_id` (`supplier_id`,`po_id`),
  KEY `invoice_idx` (`invoice_id`),
  KEY `delivery_order_idx` (`delivery_order_id`),
  KEY `inlog_status_idx` (`inlog_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inlogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `inlog_details`
--

DROP TABLE IF EXISTS `inlog_details`;
CREATE TABLE IF NOT EXISTS `inlog_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inlog_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `inlog_id` (`inlog_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inlog_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `inlog_statuses`
--

DROP TABLE IF EXISTS `inlog_statuses`;
CREATE TABLE IF NOT EXISTS `inlog_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `inlog_statuses`
--

INSERT INTO `inlog_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Sent to Stock Management'),
(3, 'Sent to Supervisor'),
(4, 'Approved'),
(5, 'Reject'),
(6, 'Archive'),
(7, 'Finish'),
(8, 'Processed');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_ledgers`
--

DROP TABLE IF EXISTS `inventory_ledgers`;
CREATE TABLE IF NOT EXISTS `inventory_ledgers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '0',
  `in_out` varchar(50) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `doc_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `inlog_id` int(11) DEFAULT NULL,
  `outlog_id` int(11) DEFAULT NULL,
  `retur_id` int(11) DEFAULT NULL,
  `supplier_retur_id` int(11) DEFAULT NULL,
  `supplier_retur_detail_id` int(11) DEFAULT NULL,
  `retur_detail_id` int(11) DEFAULT NULL,
  `inlog_detail_id` int(11) DEFAULT NULL,
  `outlog_detail_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`,`in_out`,`doc_id`,`po_id`),
  KEY `date` (`date`),
  KEY `inlog_idx` (`inlog_id`),
  KEY `outlog_idx` (`outlog_id`),
  KEY `retur_idx` (`retur_id`),
  KEY `supplier_retur_idx` (`retur_id`),
  KEY `supplier_retur_detail_idx` (`supplier_retur_detail_id`),
  KEY `retur_detail_idx` (`retur_detail_id`),
  KEY `inlog_detail_idx` (`inlog_detail_id`),
  KEY `outlog_detail_idx` (`outlog_detail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inventory_ledgers`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(10) NOT NULL,
  `inv_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `po_no` varchar(10) NOT NULL,
  `paid_date` date DEFAULT NULL,
  `paid_bank_name` varchar(200) NOT NULL,
  `paid_bank_account_no` varchar(100) NOT NULL,
  `paid_bank_account_name` varchar(200) NOT NULL,
  `paid_bank_account_type_id` int(11) NOT NULL,
  `convert_asset` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wht_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_rate` decimal(10,2) NOT NULL DEFAULT '10.00',
  `sub_total` decimal(20,2) NOT NULL,
  `vat_base` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_base` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(20,2) NOT NULL,
  `after_disc` decimal(20,2) NOT NULL,
  `wht_total` decimal(20,2) NOT NULL,
  `vat_total` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `billing_address` text NOT NULL,
  `shipping_address` text NOT NULL,
  `status_invoice_id` int(11) NOT NULL DEFAULT '1',
  `rp_rate` decimal(20,2) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `request_type_id` int(11) DEFAULT '1',
  `date_due` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `id_supplier` (`supplier_id`),
  KEY `created` (`created`),
  KEY `id_department` (`department_id`),
  KEY `inv_date` (`inv_date`),
  KEY `status_invoice_id` (`status_invoice_id`),
  KEY `paid_bank_name` (`paid_bank_name`,`paid_bank_account_no`),
  KEY `paid_bank_account_type_id` (`paid_bank_account_type_id`),
  KEY `currency_id` (`currency_id`),
  KEY `paid_bank_account_name` (`paid_bank_account_name`),
  KEY `bank_account_id` (`bank_account_id`),
  KEY `request_type_idx` (`request_type_id`),
  KEY `date_duex` (`date_due`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `no`, `inv_date`, `supplier_id`, `department_id`, `currency_id`, `description`, `po_no`, `paid_date`, `paid_bank_name`, `paid_bank_account_no`, `paid_bank_account_name`, `paid_bank_account_type_id`, `convert_asset`, `created`, `wht_rate`, `vat_rate`, `sub_total`, `vat_base`, `wht_base`, `discount`, `after_disc`, `wht_total`, `vat_total`, `total`, `billing_address`, `shipping_address`, `status_invoice_id`, `rp_rate`, `bank_account_id`, `request_type_id`, `date_due`) VALUES
(1, 'Inv001', '2011-07-07', 28, NULL, 1, '', '', '2011-07-07', '', '', '', 0, 0, '2011-07-07 17:17:05', '1.00', '10.00', '70750000.00', '70750000.00', '0.00', '0.00', '70750000.00', '0.00', '7075000.00', '77825000.00', '', '', 3, '1.00', 0, 2, NULL),
(2, 'INV 002', '2011-07-07', 29, NULL, 1, '', '', '2011-07-07', '', '', '', 0, 0, '2011-07-07 17:19:22', '2.00', '10.00', '183750000.00', '183750000.00', '0.00', '0.00', '183750000.00', '0.00', '18375000.00', '202125000.00', '', '', 6, '1.00', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_delivery_orders`
--

DROP TABLE IF EXISTS `invoices_delivery_orders`;
CREATE TABLE IF NOT EXISTS `invoices_delivery_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `delivery_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`delivery_order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `invoices_delivery_orders`
--

INSERT INTO `invoices_delivery_orders` (`id`, `invoice_id`, `delivery_order_id`) VALUES
(3, 1, 1),
(4, 1, 3),
(6, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_journal_transactions`
--

DROP TABLE IF EXISTS `invoices_journal_transactions`;
CREATE TABLE IF NOT EXISTS `invoices_journal_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `journal_transaction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`journal_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoices_journal_transactions`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoices_pos`
--

DROP TABLE IF EXISTS `invoices_pos`;
CREATE TABLE IF NOT EXISTS `invoices_pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`po_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `invoices_pos`
--

INSERT INTO `invoices_pos` (`id`, `invoice_id`, `po_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_po_payments`
--

DROP TABLE IF EXISTS `invoices_po_payments`;
CREATE TABLE IF NOT EXISTS `invoices_po_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `po_payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`po_payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `invoices_po_payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoices_purchases`
--

DROP TABLE IF EXISTS `invoices_purchases`;
CREATE TABLE IF NOT EXISTS `invoices_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`purchase_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoices_purchases`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoice_bank_account_types`
--

DROP TABLE IF EXISTS `invoice_bank_account_types`;
CREATE TABLE IF NOT EXISTS `invoice_bank_account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `invoice_bank_account_types`
--

INSERT INTO `invoice_bank_account_types` (`id`, `name`, `description`) VALUES
(1, 'Cash', 'Cash'),
(2, 'Cheque', 'Cheque'),
(3, 'Transfer', 'Bank Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `color` varchar(10) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `price_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL,
  `amount_cur` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_after_disc` decimal(20,2) NOT NULL,
  `amount_after_disc_cur` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `vat_cur` decimal(20,2) NOT NULL,
  `wht` decimal(20,2) NOT NULL,
  `wht_cur` decimal(20,2) NOT NULL,
  `amount_nett` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_nett_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `currency_id` int(11) NOT NULL,
  `rp_rate` decimal(20,2) NOT NULL DEFAULT '1.00',
  `vat_rate` decimal(20,2) NOT NULL,
  `wht_rate` decimal(20,2) NOT NULL,
  `npb_id` int(11) NOT NULL DEFAULT '0',
  `po_id` int(11) NOT NULL DEFAULT '0',
  `umurek` int(11) NOT NULL,
  `is_vat` tinyint(1) NOT NULL DEFAULT '1',
  `is_wht` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asset_category` (`asset_category_id`),
  KEY `id_invoice` (`invoice_id`),
  KEY `id_npb` (`npb_id`),
  KEY `id_po` (`po_id`),
  KEY `department_id` (`department_id`),
  KEY `item_idx` (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `asset_category_id`, `name`, `color`, `brand`, `type`, `qty`, `price`, `price_cur`, `amount`, `amount_cur`, `discount`, `discount_cur`, `amount_after_disc`, `amount_after_disc_cur`, `vat`, `vat_cur`, `wht`, `wht_cur`, `amount_nett`, `amount_nett_cur`, `currency_id`, `rp_rate`, `vat_rate`, `wht_rate`, `npb_id`, `po_id`, `umurek`, `is_vat`, `is_wht`, `department_id`, `item_id`) VALUES
(1, 1, 9, 'KURSI KERJA', '-', 'BIF', 'MJ007', 10, '750000.00', '750000.00', '7500000.00', '7500000.00', '0.00', '0.00', '7500000.00', '7500000.00', '750000.00', '750000.00', '0.00', '0.00', '8250000.00', '8250000.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 34),
(2, 1, 9, 'KURSI HADAP', '-', 'BIF', 'KR002', 10, '1500000.00', '1500000.00', '15000000.00', '15000000.00', '0.00', '0.00', '15000000.00', '15000000.00', '1500000.00', '1500000.00', '0.00', '0.00', '16500000.00', '16500000.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 35),
(3, 1, 8, 'MEJA NASABAH', '-', 'LIGNA', 'MJ001', 3, '9500000.00', '9500000.00', '28500000.00', '28500000.00', '0.00', '0.00', '28500000.00', '28500000.00', '2850000.00', '2850000.00', '0.00', '0.00', '31350000.00', '31350000.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 37),
(4, 1, 9, 'MESIN TIK', '-', 'Brother', 'MS01', 2, '1250000.00', '1250000.00', '2500000.00', '2500000.00', '0.00', '0.00', '2500000.00', '2500000.00', '250000.00', '250000.00', '0.00', '0.00', '2750000.00', '2750000.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 38),
(5, 1, 9, 'KURSI KERJA', '-', 'BIF', 'KR001', 5, '750000.00', '750000.00', '3750000.00', '3750000.00', '0.00', '0.00', '3750000.00', '3750000.00', '375000.00', '375000.00', '0.00', '0.00', '4125000.00', '4125000.00', 1, '1.00', '10.00', '1.00', 3, 1, 5, 1, 0, 5, 34),
(6, 1, 8, 'MEJA KERJA', '-', 'LIGNA', 'MJ007', 1, '6000000.00', '6000000.00', '6000000.00', '6000000.00', '0.00', '0.00', '6000000.00', '6000000.00', '600000.00', '600000.00', '0.00', '0.00', '6600000.00', '6600000.00', 1, '1.00', '10.00', '1.00', 3, 1, 5, 1, 0, 5, 36),
(7, 1, 9, 'KURSI KERJA', '-', 'BIF', 'MJ007', 10, '750000.00', '750000.00', '7500000.00', '7500000.00', '0.00', '0.00', '7500000.00', '7500000.00', '750000.00', '750000.00', '0.00', '0.00', '8250000.00', '8250000.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 34),
(8, 1, 9, 'KURSI HADAP', '-', 'BIF', 'KR002', 0, '1500000.00', '1500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 35),
(9, 1, 8, 'MEJA NASABAH', '-', 'LIGNA', 'MJ001', 0, '9500000.00', '9500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 37),
(10, 1, 9, 'MESIN TIK', '-', 'Brother', 'MS01', 0, '1250000.00', '1250000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '1.00', 1, 1, 5, 1, 0, 2, 38),
(11, 1, 9, 'KURSI KERJA', '-', 'BIF', 'KR001', 0, '750000.00', '750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '1.00', 3, 1, 5, 1, 0, 5, 34),
(12, 1, 8, 'MEJA KERJA', '-', 'LIGNA', 'MJ007', 0, '6000000.00', '6000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '1.00', 3, 1, 5, 1, 0, 5, 36),
(13, 2, 6, 'DEKSTOP DELL OPTIPLEX', '-', 'Dell', 'GX280', 3, '2750000.00', '2750000.00', '8250000.00', '8250000.00', '0.00', '0.00', '8250000.00', '8250000.00', '825000.00', '825000.00', '0.00', '0.00', '9075000.00', '9075000.00', 1, '1.00', '10.00', '2.00', 2, 2, 5, 1, 0, 2, 20),
(14, 2, 6, 'THIN CLIENT  ', '-', 'ITONA', 'T3851', 5, '4500000.00', '4500000.00', '22500000.00', '22500000.00', '0.00', '0.00', '22500000.00', '22500000.00', '2250000.00', '2250000.00', '0.00', '0.00', '24750000.00', '24750000.00', 1, '1.00', '10.00', '2.00', 2, 2, 5, 1, 0, 2, 22),
(15, 2, 6, 'PRINTER EPSON LQ 2180', '-', 'Epson', 'LQ2180', 3, '51000000.00', '51000000.00', '153000000.00', '153000000.00', '0.00', '0.00', '153000000.00', '153000000.00', '15300000.00', '15300000.00', '0.00', '0.00', '168300000.00', '168300000.00', 1, '1.00', '10.00', '2.00', 4, 2, 5, 1, 0, 5, 24);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

DROP TABLE IF EXISTS `invoice_payments`;
CREATE TABLE IF NOT EXISTS `invoice_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `no` varchar(50) NOT NULL,
  `term_no` int(11) NOT NULL,
  `term_percent` decimal(10,2) NOT NULL,
  `date_due` date NOT NULL,
  `date_paid` date NOT NULL,
  `amount_due` decimal(20,2) NOT NULL,
  `amount_paid` decimal(20,2) NOT NULL,
  `description` tinytext,
  `amount_invoice` decimal(20,2) NOT NULL,
  `amount_po` decimal(20,2) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `po_payment_id` int(11) DEFAULT NULL,
  `bank_account_id` int(11) DEFAULT NULL,
  `bank_account_type_id` int(11) DEFAULT NULL,
  `is_posted` tinyint(1) DEFAULT '0',
  `posted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_payment_idx` (`invoice_id`,`po_id`,`term_no`,`bank_account_id`,`bank_account_type_id`),
  KEY `is_postedx` (`is_posted`),
  KEY `posted_datex` (`posted_date`),
  KEY `po_payment_id` (`po_payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `no`, `term_no`, `term_percent`, `date_due`, `date_paid`, `amount_due`, `amount_paid`, `description`, `amount_invoice`, `amount_po`, `po_id`, `po_payment_id`, `bank_account_id`, `bank_account_type_id`, `is_posted`, `posted_date`) VALUES
(5, 1, 'PY001', 1, '100.00', '2011-08-06', '2011-07-07', '77825000.00', '77825000.00', '', '77825000.00', NULL, NULL, NULL, 1, 1, 0, NULL),
(2, 2, 'PAY-1', 1, '100.00', '0000-00-00', '0000-00-00', '202125000.00', '0.00', 'PO term 1', '202125000.00', NULL, 2, 3, NULL, NULL, 0, NULL),
(6, 2, 'PY002', 2, '100.00', '2011-08-06', '2011-07-07', '202125000.00', '202125000.00', '', '202125000.00', NULL, NULL, NULL, 2, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_statuses`
--

DROP TABLE IF EXISTS `invoice_statuses`;
CREATE TABLE IF NOT EXISTS `invoice_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `invoice_statuses`
--

INSERT INTO `invoice_statuses` (`id`, `name`, `description`) VALUES
(1, 'New', ''),
(2, 'Unpaid', ''),
(3, 'Paid', ''),
(4, 'Registered to Asset', 'Registered to Asset'),
(5, 'Receive Journal Posted', ''),
(6, 'DONE - Payment Journal Posted', ''),
(7, 'Term Payment Journal Posted', ''),
(10, 'Sent to Fincon', ''),
(20, 'Sent to Fincon Supervisor', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `avg_price` decimal(20,2) NOT NULL,
  `descr` tinytext NOT NULL,
  `request_type_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL DEFAULT '1',
  `unit_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty_reorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id_asset_category` (`asset_category_id`),
  KEY `id_currency` (`currency_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=364 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `name`, `price`, `avg_price`, `descr`, `request_type_id`, `asset_category_id`, `currency_id`, `unit_id`, `created`, `qty_reorder`) VALUES
(1, 'K099999', 'Komputer Lengkap 2', '1000.00', '0.00', '', 1, 6, 1, 3, '2011-05-25 14:27:21', 0),
(2, 'K01999', 'Printer lengkap', '5000000.00', '0.00', '', 1, 6, 1, 4, '2011-05-25 14:27:04', 0),
(3, 'K010', 'Kursi', '100000.00', '0.00', '', 2, 8, 1, 2, '2011-05-25 15:40:55', 0),
(4, 'K-019', 'Meja Kerja', '100000.00', '0.00', '', 2, 8, 1, 3, '2011-04-26 14:27:51', 0),
(5, 'LAP001', 'Laptop', '15000000.00', '0.00', '', 1, 6, 1, 2, '2011-04-26 14:27:58', 0),
(6, 'LMR001', 'Lemari Besi', '5000000.00', '0.00', '', 2, 9, 1, 4, '2011-04-26 14:28:07', 0),
(8, 'K09966', 'mobil', '100000000.00', '0.00', '', 2, 5, 1, 2, '2011-05-23 15:36:37', 0),
(9, 'MD023', 'Speaker', '30.00', '33.00', '', 3, 12, 1, 2, '2011-05-25 15:41:04', 0),
(10, 'MD009', 'Touch Pad', '100000.00', '110000.00', 'Test', 3, 13, 1, 2, '2011-05-25 15:41:09', 0),
(11, 'INV099', 'kertas', '50000.00', '55000.00', 'aaa', 3, 15, 1, 1, '2011-05-10 22:05:45', 0),
(12, 'MOS012', 'Mouse', '1000000.00', '0.00', '', 3, 12, 1, 3, '2011-05-25 15:41:15', 0),
(13, 'GD6546', 'Gediung', '32354.00', '0.00', '', 2, 3, 1, 1, '2011-04-26 14:22:10', 0),
(14, 'WIL077', 'NOTEBOOK', '532.23', '0.00', '', 2, 1, 1, 2, '2011-05-25 15:41:24', NULL),
(43, '7MSN003', 'MESIN HTUNG UANG', '3500000.00', '0.00', '', 2, 9, 1, 2, '0000-00-00 00:00:00', NULL),
(20, '6PCD001', 'DEKSTOP DELL OPTIPLEX', '2750000.00', '0.00', '', 1, 6, 1, 2, '2011-05-25 15:45:18', NULL),
(19, 'REN0555', 'Gedung Abdul Muis', '2000000000.00', '0.00', '', 2, 16, 1, 2, '2011-05-25 15:41:30', NULL),
(21, '6PCD002', 'DEKSTOP DELL OPTIPLEX', '7000000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(22, '6PCT001', 'THIN CLIENT  ', '4500000.00', '0.00', '', 1, 6, 1, 2, '2011-06-09 17:06:11', NULL),
(23, '6PCS001 ', 'STAND ALONE ', '8000000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(24, '6PRE001 ', 'PRINTER EPSON LQ 2180', '51000000.00', '0.00', '', 1, 6, 1, 2, '2011-05-25 15:48:40', NULL),
(25, '6PRH001 ', 'PRINTER HP  ', '7655555.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(26, '6LCL001 ', 'LCD LG  ', '30000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(27, '6LCH003 ', 'LCD HP ', '39900000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(28, '6MSG001 ', 'MONITOR SAMSUNG SVGA ', '790000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(29, '6HUB001 ', 'CISCO CATALYST  ', '59904444.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(30, '6SCH002 ', 'SCANNER HP  ', '700044.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(31, '6USB001 ', 'KINGSTON ', '500000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(32, 'K099', 'Komputer Lengkap 2', '1000.00', '0.00', '', 1, 6, 2, 3, '2011-04-26 14:27:03', 0),
(33, 'K0199', 'Printer lengkap', '5000000.00', '0.00', '', 1, 6, 1, 4, '2011-04-26 14:27:31', 0),
(34, '7KRS001', 'KURSI KERJA', '750000.00', '0.00', '', 2, 9, 1, 2, '2011-05-13 12:31:26', NULL),
(35, '7KRS002', 'KURSI HADAP', '1500000.00', '0.00', '', 2, 9, 1, 2, '2011-05-13 12:31:26', NULL),
(36, '7MJA001', 'MEJA KERJA', '6750000.00', '0.00', '', 2, 8, 1, 2, '2011-05-13 12:31:26', NULL),
(37, '7MJA002', 'MEJA NASABAH', '9500000.00', '0.00', '', 2, 8, 1, 2, '2011-05-13 12:31:26', NULL),
(38, '7MSN001', 'MESIN TIK', '1250000.00', '0.00', '', 2, 9, 1, 2, '2011-05-13 12:31:26', NULL),
(39, '7KRS003', 'KURSI TUNGGU', '5000000.00', '0.00', '', 2, 9, 1, 2, '0000-00-00 00:00:00', NULL),
(40, '7MSN002', 'MESIN TELLSTROKE', '7500000.00', '0.00', '', 2, 9, 1, 2, '2011-05-25 15:47:35', NULL),
(41, '7KEN002', 'TOYOTA ALPHARD', '485000000.00', '0.00', '', 2, 5, 1, 2, '2011-05-25 15:49:04', NULL),
(42, '7KEN003', 'TOYOTA CAMRY', '325000000.00', '0.00', '', 2, 5, 1, 2, '2011-05-25 15:49:25', NULL),
(44, '7MJA003', 'MEJA COUNTER', '500000000.00', '0.00', '', 2, 9, 1, 2, '0000-00-00 00:00:00', NULL),
(45, '6RTC001', 'CISCO CATALYST 2800', '5500000.00', '0.00', '', 2, 9, 1, 2, '2011-05-25 15:47:12', NULL),
(46, '6PCT003', 'THIN CLIENT  T3851', '17500000.00', '0.00', '', 1, 6, 1, 2, '0000-00-00 00:00:00', NULL),
(218, '6PCR001', 'STAND ALONE', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(217, '6PCS002', 'STAND ALONE', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(215, '6PCT007', 'THIN CLIENT ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(214, '6PCT006', 'THIN CLIENT ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(213, '6PCT005', 'THIN CLIENT ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(212, '6PCT004', 'THIN CLIENT ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(210, '6PCT002', 'THIN CLIENT ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(208, '6PCD009', 'DEKSTOP DELL OPTIPLEX', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(207, '6PCD008', 'DEKSTOP DELL OPTIPLEX', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(206, '6PCD007', 'DEKSTOP DELL OPTIPLEX', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(205, '6PCD006', 'DEKSTOP DELL OPTIPLEX', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(204, '6PCD005', 'DEKSTOP DELL OPTIPLEX', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(202, '6PCD003', 'DEKSTOP DELL OPTIPLEX', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(203, '6PCD004', 'DEKSTOP DELL OPTIPLEX', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(244, '6LCL002', 'LCD LG ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(242, '6PPX003', 'PRINTER PRINTONIX', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(241, '6PPX002', 'PRINTER PRINTONIX', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(240, '6PPX001', 'PRINTER PRINTONIX', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(239, '6PRZ001', 'PRINTER ZEBRA', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(238, '6PRL004', 'PRINTER HP ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(237, '6PRL003', 'PRINTER HP ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(236, '6PRL002', 'PRINTER HP ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(235, '6PRL001', 'PRINTER HP ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(234, '6PRH008', 'PRINTER HP ', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(233, '6PRH007', 'PRINTER HP ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(232, '6PRH006', 'PRINTER HP ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(231, '6PRH005', 'PRINTER HP ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(230, '6PRH004', 'PRINTER HP ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(229, '6PRH003', 'PRINTER HP ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(228, '6PRH002', 'PRINTER HP ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(226, '6PRE007', 'PRINTER EPSON', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(225, '6PRE006', 'PRINTER EPSON', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(224, '6PRE005', 'PRINTER EPSON', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(223, '6PRE004', 'PRINTER EPSON', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(220, '6PRE002', 'PRINTER EPSON', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(221, '6PRE003', 'PRINTER EPSON', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(276, '6HUB007', 'CISCO CATALYST ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(275, '6HUB006', 'CISCO CATALYST ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(274, '6HUB005', 'CISCO CATALYST ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(273, '6HUB004', 'CISCO CATALYST ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(272, '6HUB003', 'CISCO CATALYST ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(271, '6HUB002', 'CISCO CATALYST ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(269, '6RTC007', 'CISCO CATALYST ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(268, '6RTC006', 'CISCO CATALYST ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(267, '6RTC005', 'CISCO CATALYST ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(266, '6RTC004', 'CISCO CATALYST ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(265, '6RTC003', 'CISCO CATALYST ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(264, '6RTC002', 'CISCO CATALYST ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(262, '6MGT001', 'MONITOR GTC', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(261, '6MSG002', 'MONITOR IBM', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(259, '6MLG001', 'MONITOR LG ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(258, '6LCD004', 'LCD', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(257, '6LCD003', 'LCD DELL ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(256, '6LCD002', 'LCD DELL ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(255, '6LCD001', 'LCD DELL ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(254, '6LCP003', 'LCD PHILIPS ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(253, '6LCP002', 'LCD PHILIPS ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(252, '6LCP001', 'LCD PHILIPS ', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(251, '6LCH004', 'LCD HP', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(249, '6LCH002', 'LCD HP', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(248, '6LCH001', 'LCD HP', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(245, '6LCL003', 'LCD LG ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(246, '6LCL004', 'LCD LG ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(247, '6LCL005', 'LCD LG ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(300, '6UPL003', 'LAPLACE ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(299, '6UPL002', 'LAPLACE ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(298, '6UPL001', 'LAPLACE ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(297, '6MDR001', 'RAD ASM', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(296, '6MDZ001', 'ZYXEL ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(295, '6CHR001', 'MAGTEK', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(294, '6KEP001', 'POSIFFLEX ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(293, '6CRR001', 'POSIFFLEX ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(292, '6SCH006', 'SCANNER HP ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(291, '6SCH005', 'SCANNER HP ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(290, '6SCH004', 'SCANNER HP ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(289, '6SCH003', 'SCANNER HP ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(287, '6SCH001', 'SCANNER HP ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(286, '6SCE001', 'SCANNER EPSON', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(285, '6AFC001', 'CISCO CATALYST ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(284, '6HUD001', 'D-Link', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(283, '6HUB014', 'CISCO CATALYST ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(282, '6HUB013', 'CISCO CATALYST ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(281, '6HUB012', 'CISCO CATALYST ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(277, '6HUB008', 'CISCO CATALYST ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(278, '6HUB009', 'CISCO CATALYST ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(279, '6HUB010', 'CISCO CATALYST ', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(280, '6HUB011', 'CISCO CATALYST ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(326, '6SVH005', 'PROLIANT HP ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(325, '6SVH004', 'PROLIANT HP ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(324, '6SVH003', 'PROLIANT HP ', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(323, '6SVH002', 'PROLIANT HP ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(322, '6SVH001', 'PROLIANT HP ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(321, '6RSH001', 'SERVER', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(320, '6RSC001', 'SERVER', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(319, '6RSP001', 'SERVER', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(318, '6UPP001', 'POWER PLUS', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(317, '6UPV002', 'VEKTOR ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(316, '6UPV001', 'VEKTOR ', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(315, '6UPW001', 'GE WANPRO Series', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(314, '6UPI001', 'ICA', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(313, '6UPA002', 'APC MATRIX', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(312, '6UPA001', 'APC MATRIX', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(311, '6UPE006', 'ENERPLUS', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(310, '6UPE005', 'ENERPLUS', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(309, '6UPE004', 'ENERPLUS', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(301, '6UPL004', 'LAPLACE ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(302, '6UPL005', 'LAPLACE ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(303, '6UPL006', 'LAPLACE ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(304, '6UPL007', 'LAPLACE ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(305, '6UPL008', 'LAPLACE ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(306, '6UPE001', 'ENERPLUS', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(307, '6UPE002', 'ENERPLUS', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(308, '6UPE003', 'ENERPLUS', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(327, '6SVH006', 'PROLIANT HP ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(328, '6SVH007', 'PROLIANT HP ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(329, '6NBD001', 'DELL LATITUDE', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(330, '6NBD002', 'DELL LATITUDE', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(331, '6NBD003', 'DELL LATITUDE', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(332, '6NBD004', 'DELL LATITUDE', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(333, '6NBD005', 'DELL LATITUDE', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(334, '6NBD006', 'DELL LATITUDE', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(335, '6NBN001', 'NEC', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(336, '6NBA001', 'ACER', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(337, '6NBT001', 'TOSHIBA', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(338, '6MSA001', 'ATEN ', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(339, '6MSA002', 'ATEN ', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(340, '6MSA003', 'ATEN ', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(341, '6MSA004', 'ATEN ', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(342, '6PSD001', 'D-LINK', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(343, '6PSD002', 'D-LINK', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(344, '6FPH001', 'HIT ', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(345, '6FPH002', 'HIT ', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(346, '6FPH003', 'HIT ', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(347, '6PRT001', 'PROJECTOR TOSHIBA', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(348, '6PRT002', 'PROJECTOR TOSHIBA', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(349, '6PRT003', 'PROJECTOR TOSHIBA', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(350, '6PRT004', 'PROJECTOR TOSHIBA', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(351, '6PRT005', 'PROJECTOR TOSHIBA', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(352, '6PRT006', 'PROJECTOR TOSHIBA', '5556000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(353, '6PRI001', 'PROJECTOR INFOCUS', '500000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(354, '6PRI002', 'PROJECTOR INFOCUS', '400000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(355, '6MOU001', 'MOUSE USB', '600000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(356, '6MOU002', 'MOUSE SERIAL PS/2', '800000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(357, '6KEY001', 'KEYBOARD USB', '777500.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(358, '6KEY002', 'KEYBOARD PS/2', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(359, '6KEY003', 'KEYBOARD DELL', '550000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(360, '6KEY004', 'KEYBOARD HP', '55000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(362, '6USB002', 'MCAFEE', '668000.00', '0.00', '', 1, 6, 1, 3, '2011-06-03 15:22:34', 0),
(363, 'MSTR01', 'Mistar', '200000.00', '220000.00', '', 3, 15, 1, 2, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journal_groups`
--

DROP TABLE IF EXISTS `journal_groups`;
CREATE TABLE IF NOT EXISTS `journal_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `journal_groups`
--

INSERT INTO `journal_groups` (`id`, `name`) VALUES
(1, 'Penerimaan Barang'),
(2, 'Mutasi FA'),
(3, 'Write Off FA'),
(4, 'Pembayaran Supplier'),
(5, 'Penyusutan FA'),
(6, 'Distribusi dari Head Office ke Branch'),
(7, 'Distribusi dari Head Office ke Unit Kerja'),
(8, 'Penjualan FA Untung'),
(9, 'Inlog'),
(10, 'Retur Cabang'),
(11, 'Retur Supplier'),
(12, 'Pemakaian Barang'),
(14, 'Pembelian FA dengan DP'),
(15, 'Pembelian FA'),
(16, 'Penjualan FA Rugi'),
(17, 'Penjualan FA Sama Dengan Nilai Buku');

-- --------------------------------------------------------

--
-- Table structure for table `journal_positions`
--

DROP TABLE IF EXISTS `journal_positions`;
CREATE TABLE IF NOT EXISTS `journal_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `journal_positions`
--

INSERT INTO `journal_positions` (`id`, `name`) VALUES
(1, 'Debit'),
(2, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `journal_templates`
--

DROP TABLE IF EXISTS `journal_templates`;
CREATE TABLE IF NOT EXISTS `journal_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `journal_group_id` int(10) unsigned NOT NULL,
  `asset_category_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_template_id` (`journal_group_id`,`asset_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=334 ;

--
-- Dumping data for table `journal_templates`
--

INSERT INTO `journal_templates` (`id`, `journal_group_id`, `asset_category_id`, `name`) VALUES
(1, 1, 1, 'Penerimaan FA Tanah'),
(4, 1, 5, 'Penerimaan FA Kendaraan'),
(5, 1, 6, 'Penerimaan FA Hardware Komputer'),
(7, 1, 8, 'Penerimaan FA Inventaris Gol I'),
(9, 1, 10, 'Penerimaan FA Software Komputer'),
(10, 1, 11, 'Penerimaan FA Leasehold'),
(11, 5, 3, 'Penyusutan Gedung'),
(12, 5, 4, 'Penyusutan Instalasi'),
(13, 2, 1, 'Mutasi FA Tanah'),
(18, 4, 25, 'Pembayaran FA Gedung'),
(15, 8, 3, 'Penjualan Untung FA Gedung'),
(16, 8, 4, 'Penjualan Untung FA Instalasi'),
(17, 8, 5, 'Penjualan Untung FA Kendaraan'),
(19, 4, 6, 'Pembayaran FA Hardware Komputer'),
(20, 4, 5, 'Pembayaran FA Kendaraan'),
(21, 5, 5, 'Penyusutan FA Kendaraan'),
(22, 5, 6, 'Penyusutan FA Hardware'),
(23, 5, 8, 'Penyusutan FA Inventaris Ktr Gol I'),
(24, 5, 9, 'Penyusutan FA Inventaris Ktr Gol II'),
(25, 5, 7, 'Penyusutan FA Peripheral Komputer'),
(26, 5, 1, 'Penyusutan FA Tanah'),
(27, 5, 10, 'Penyusutan FA Software'),
(28, 5, 11, 'Penyusutan FA Leasehold'),
(30, 2, 25, 'Mutasi Gedung'),
(32, 2, 5, 'Mutasi Kendaraan'),
(33, 2, 6, 'Mutasi Hardware Komputer'),
(35, 2, 8, 'Inventaris Gol I'),
(37, 2, 10, 'Mutasi Software Komputer'),
(38, 2, 11, 'Mutasi Leasehold'),
(39, 4, 10, 'Pembayaran Software'),
(41, 3, 3, 'Write off Building'),
(42, 3, 1, 'Write off land'),
(43, 3, 4, 'Write off Installation'),
(44, 3, 5, 'Write off Vehicle'),
(45, 3, 6, 'Write off Hardware'),
(46, 3, 7, 'Write off Peripheral'),
(47, 3, 8, 'Write off Inv I'),
(48, 3, 9, 'Write off Inv II'),
(49, 3, 10, 'Write off Software'),
(50, 3, 11, 'Write off Leasehold'),
(51, 4, 11, 'Pembayaran Leasehold'),
(52, 4, 1, 'Pembayaran Tanah'),
(54, 4, 8, 'Pembayaran Inv I'),
(56, 8, 1, 'Penjualan Untung Tanah'),
(58, 8, 6, 'Penjualan Untung Hardware'),
(59, 8, 7, 'Penjualan Untung Peripheral'),
(60, 8, 8, 'Penjualan Untung Inv I'),
(61, 8, 9, 'Penjualan Untung Inv II'),
(62, 8, 10, 'Penjualan Untung Software'),
(63, 8, 11, 'Penjualan Untung Leasehold'),
(86, 1, 20, 'Penerimaan Stock Materai Skum'),
(77, 9, 12, 'Penerimaan Stock Barang Cetakan'),
(87, 1, 21, 'Penerimaan Stock Materai Kompuerisasi'),
(81, 1, 12, 'Penerimaan Stock Cetakan'),
(82, 1, 13, 'Penerimaan Stock Materai Tempel'),
(83, 1, 17, 'Penerimaan Stock Cek & Bilyet Giro'),
(84, 1, 18, 'Penerimaan Stock Souvenir'),
(85, 1, 19, 'Penerimaan Stock Materai Teraan'),
(78, 9, 13, 'Penerimaan Stock Materai'),
(88, 1, 22, 'Penerimaan Stock Kartu ATM'),
(90, 1, 23, 'Penerimaan Stock Barang IT'),
(91, 1, 24, 'Penerimaan Stock Barang Lainnnya'),
(92, 1, 25, 'Penerimaan FA Bangunan'),
(93, 7, 26, 'Biaya Alat Tulis Kantor'),
(94, 7, 12, 'Biaya Cetakan'),
(95, 7, 17, 'Biaya Cek & Bilyet Giro'),
(96, 7, 13, 'Biaya Materai'),
(97, 7, 19, 'Biaya Materai'),
(98, 7, 20, 'Biaya Materai'),
(99, 7, 21, 'Biaya Materai'),
(100, 7, 18, 'Biaya Barang Souvenir'),
(101, 7, 28, 'Biaya Barang Promosi'),
(102, 7, 22, 'Biaya Cetak Kartu ATM'),
(103, 7, 23, 'Biaya Accecoris Komputer'),
(104, 7, 24, 'Biaya Sarana Kantor'),
(105, 6, 26, 'Pendistribusian ATK'),
(106, 6, 12, 'Pendistribusian Barang Cetakan'),
(107, 6, 17, 'Pendistribusian Cek & Bilyet Giro'),
(108, 6, 13, 'Pendistribusian materai Tempel'),
(109, 6, 19, 'Pendistribusian Materai Teraan'),
(110, 6, 20, 'Pendistribusian Materai Skum'),
(111, 6, 21, 'Pendistribusian Materai Komputerisasi'),
(112, 6, 18, 'Pendistribusian Souvenir'),
(113, 6, 28, 'Pendistribusian Barang Promosi'),
(114, 6, 22, 'Pendistribusian Kartu ATM'),
(115, 6, 23, 'Pendistribusian Barang IT'),
(116, 6, 24, 'Pendistribusian Barang Lainnya '),
(117, 6, 1, 'FA tanah'),
(118, 6, 2, 'FA Bangunan'),
(119, 6, 3, 'FA Gedung'),
(120, 6, 4, 'FA Instalasi'),
(121, 6, 5, 'FA Kendaraan'),
(122, 6, 6, 'FA Hardware Komputer'),
(123, 6, 8, 'FA Inv Ktr Gol 1 (Kayu)'),
(124, 6, 9, 'FA Inv Ktr Gol 2 (Besi)'),
(125, 6, 7, 'FA Periperal Komputer'),
(126, 6, 10, 'FA Sotfware Komputer'),
(127, 6, 11, 'FA Leasehold'),
(128, 11, 3, 'Fixas Gedung'),
(129, 11, 4, 'Fixas Instalasi'),
(130, 11, 5, 'Fixas Kendaraan'),
(131, 11, 6, 'Fixas Hardware Komputer'),
(132, 11, 8, 'Fixas Inv. Ktr Gol 1'),
(134, 11, 9, 'Fixas Inv. Ktr Gol 2'),
(135, 11, 7, 'Fixas Periperal Komputer'),
(136, 11, 10, 'Fixas Software Komputer'),
(137, 11, 12, 'Retur Supplier Barang Cetakan'),
(138, 11, 13, 'Retur Supplier Materai Tempel'),
(140, 11, 17, 'Retur Supplier Cek & Bilyet Giro'),
(141, 11, 18, 'Retur Supplier Souvenir'),
(142, 11, 19, 'Retur Supplier Materai Teraan'),
(143, 11, 20, 'Retur Supplier Materai Skum'),
(144, 11, 21, 'Retur Supplier Materai Komputerisasi'),
(145, 11, 22, 'Retur Supplier Kartu ATM'),
(146, 11, 23, 'Retur Supplier Barang IT'),
(147, 11, 24, 'Retur Supplier Barang Lainnya'),
(148, 11, 28, 'Retur Supplier Promosi'),
(149, 10, 12, 'Retur Cabang Barang Cetakan'),
(150, 10, 13, 'Retur Cabang Materai Tempel'),
(152, 10, 17, 'Retur Cabang Cek & Bilyet Giro'),
(153, 10, 18, 'Retur Cabang Souvenir'),
(154, 10, 19, 'Retur Cabang Materai Teraan'),
(155, 10, 20, 'Retur Cabang Materai Skum'),
(156, 10, 21, 'Retur Cabang Materai Komputerisasi'),
(157, 10, 22, 'Retur Cabang Kartu ATM'),
(158, 10, 23, 'Retur Cabang Barang IT'),
(159, 10, 24, 'Retur Cabang Barang Lainnya'),
(160, 10, 28, 'Retur Cabang Promosi'),
(161, 9, 12, 'Inlog Barang Cetakan'),
(162, 9, 13, 'Inlog Materai Tempel'),
(164, 9, 17, 'Inlog Cek & Bilyet Giro'),
(165, 9, 18, 'Inlog Souvenir'),
(166, 9, 19, 'Inlog Materai Teraan'),
(167, 9, 20, 'Inlog Materai Skum'),
(168, 9, 21, 'Inlog Materai Komputerisasi'),
(169, 9, 22, 'Inlog Kartu ATM'),
(170, 9, 23, 'Inlog Barang IT'),
(171, 9, 24, 'Inlog Barang Lainnya'),
(172, 9, 28, 'Inlog Promosi'),
(233, 4, 12, 'Pembayaran Barang Cetakan'),
(234, 4, 13, 'Pembayaran Materai Tempel'),
(236, 4, 17, 'Pembayaran Cek & Bilyet Giro'),
(237, 4, 18, 'Pembayaran Souvenir'),
(238, 4, 19, 'Pembayaran Materai Teraan'),
(239, 4, 20, 'Pembayaran Materai Skum'),
(240, 4, 21, 'Pembayaran Materai Komputerisasi'),
(241, 4, 22, 'Pembayaran Kartu ATM'),
(242, 4, 23, 'Pembayaran IT'),
(243, 4, 24, 'Pembayaran Barang Lainnnya'),
(245, 4, 27, 'Pembayaran Promosi'),
(315, 16, 3, 'Penjualan Rugi FA Gedung'),
(299, 15, 1, 'Pembelian FA Tanah'),
(287, 14, 2, 'Pembelian FA Bangunan Dalam Penyelesaian dengan DP'),
(286, 14, 1, 'Pembelian FA Tanah dengan DP'),
(288, 14, 3, 'Pembelian FA Gedung dengan DP'),
(289, 14, 4, 'Pembelian FA Instalasi dengan DP'),
(290, 14, 5, 'Pembelian FA Kendaraan dengan DP'),
(291, 14, 6, 'Pembelian FA Hardware Komputer dengan DP'),
(292, 14, 7, 'Pembelian FA Peripheral Komputer dengan DP'),
(293, 14, 8, 'Pembelian FA Inventaris Golongan I dengan DP'),
(294, 14, 9, 'Pembelian FA Inventaris Golongan II dengan DP'),
(295, 14, 10, 'Pembelian FA Software Komputer dengan DP'),
(296, 14, 11, 'Pembelian FA Leasehold dengan DP'),
(297, 14, 25, 'Pembelian FA Bangunan dengan DP'),
(301, 15, 3, 'Pembelian FA Gedung'),
(314, 16, 1, 'Penjualan Rugi Tanah'),
(303, 15, 5, 'Pembelian FA Kendaraan'),
(304, 15, 6, 'Pembelian FA Hardware Komputer'),
(305, 15, 7, 'Pembelian FA Peripheral Komputer'),
(306, 15, 8, 'Pembelian FA Inventaris Golongan I'),
(307, 15, 9, 'Pembelian FA Inventaris Golongan II'),
(308, 15, 10, 'Pembelian FA Software Komputer'),
(309, 15, 11, 'Pembelian FA Leasehold'),
(312, 2, 9, 'Mutasi FA Gol II'),
(313, 2, 7, 'Mutasi FA Peripheral'),
(316, 16, 4, 'Penjualan Rugi FA Instalasi'),
(317, 16, 5, 'Penjualan Rugi FA Kendaraan'),
(318, 16, 6, 'Penjualan Rugi Hardware'),
(319, 16, 7, 'Penjualan Rugi Peripheral'),
(320, 16, 8, 'Penjualan Rugi Inv I'),
(321, 16, 9, 'Penjualan Rugi Inv II'),
(322, 16, 10, 'Penjualan Rugi Software'),
(323, 16, 11, 'Penjualan Rugi Leasehold'),
(324, 17, 1, 'Penjualan Sama Dengan Nilai Buku Tanah'),
(325, 17, 3, 'Penjualan Sama Dengan Nilai Buku FA Gedung'),
(326, 17, 4, 'Penjualan Sama Dengan Nilai Buku FA Instalasi'),
(327, 17, 5, 'Penjualan Sama Dengan Nilai Buku FA Kendaraan'),
(328, 17, 6, 'Penjualan Sama Dengan Nilai Buku Hardware'),
(329, 17, 7, 'Penjualan Sama Dengan Nilai Buku Peripheral'),
(330, 17, 8, 'Penjualan Sama Dengan Nilai Buku Inv I'),
(331, 17, 9, 'Penjualan Sama Dengan Nilai Buku Inv II'),
(332, 17, 10, 'Penjualan Sama Dengan Nilai Buku Software'),
(333, 17, 11, 'Penjualan Sama Dengan Nilai Buku Leasehold');

-- --------------------------------------------------------

--
-- Table structure for table `journal_template_details`
--

DROP TABLE IF EXISTS `journal_template_details`;
CREATE TABLE IF NOT EXISTS `journal_template_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `journal_template_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `journal_position_id` tinyint(3) unsigned NOT NULL,
  `for_destination_branch` tinyint(1) NOT NULL DEFAULT '0',
  `for_profit_sales` tinyint(1) NOT NULL DEFAULT '1',
  `for_purchase_with_dp` tinyint(1) NOT NULL DEFAULT '0',
  `for_accum_dep` tinyint(1) NOT NULL DEFAULT '0',
  `contra_account` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_template_id` (`journal_template_id`,`account_id`,`journal_position_id`),
  KEY `destination_branch` (`for_destination_branch`),
  KEY `for_profit_sales` (`for_profit_sales`),
  KEY `for_purchase_with_dp` (`for_purchase_with_dp`),
  KEY `for_accum_dep` (`for_accum_dep`),
  KEY `contra_account` (`contra_account`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1123 ;

--
-- Dumping data for table `journal_template_details`
--

INSERT INTO `journal_template_details` (`id`, `journal_template_id`, `account_id`, `journal_position_id`, `for_destination_branch`, `for_profit_sales`, `for_purchase_with_dp`, `for_accum_dep`, `contra_account`) VALUES
(120, 35, 155, 1, 0, 0, 0, 0, '0'),
(542, 35, 155, 2, 0, 0, 0, 1, '0'),
(122, 35, 125, 2, 0, 0, 0, 0, '0'),
(541, 35, 144, 1, 0, 0, 0, 1, '0'),
(540, 35, 155, 2, 0, 0, 0, 0, '0'),
(539, 35, 103, 1, 0, 0, 0, 0, '0'),
(902, 63, 56, 2, 0, 1, 0, 0, '0'),
(901, 63, 155, 1, 0, 1, 0, 0, 'profit'),
(900, 63, 93, 2, 0, 1, 0, 0, '0'),
(899, 63, 155, 1, 0, 1, 0, 0, 'fa'),
(898, 63, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(897, 63, 94, 1, 0, 1, 0, 1, '0'),
(896, 63, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(895, 63, 157, 1, 0, 1, 0, 0, '0'),
(894, 63, 157, 2, 0, 1, 0, 0, '0'),
(893, 63, 58, 1, 0, 1, 0, 0, '0'),
(892, 62, 56, 2, 0, 1, 0, 0, '0'),
(891, 62, 155, 1, 0, 1, 0, 0, 'profit'),
(890, 62, 20, 2, 0, 1, 0, 0, '0'),
(889, 62, 155, 1, 0, 1, 0, 0, 'fa'),
(888, 62, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(887, 62, 21, 1, 0, 1, 0, 1, '0'),
(886, 62, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(885, 62, 157, 1, 0, 1, 0, 0, '0'),
(884, 62, 157, 2, 0, 1, 0, 0, '0'),
(883, 62, 58, 1, 0, 1, 0, 0, '0'),
(882, 61, 56, 2, 0, 1, 0, 0, '0'),
(881, 61, 155, 1, 0, 1, 0, 0, 'profit'),
(880, 61, 126, 2, 0, 1, 0, 0, '0'),
(879, 61, 155, 1, 0, 1, 0, 0, 'fa'),
(878, 61, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(877, 61, 146, 1, 0, 1, 0, 1, '0'),
(876, 61, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(875, 61, 157, 1, 0, 1, 0, 0, '0'),
(874, 61, 157, 2, 0, 1, 0, 0, '0'),
(873, 61, 58, 1, 0, 1, 0, 0, '0'),
(872, 60, 56, 2, 0, 1, 0, 0, '0'),
(871, 60, 155, 1, 0, 1, 0, 0, 'profit'),
(870, 60, 125, 2, 0, 1, 0, 0, '0'),
(869, 60, 155, 1, 0, 1, 0, 0, 'fa'),
(868, 60, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(867, 60, 144, 1, 0, 1, 0, 1, '0'),
(866, 60, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(865, 60, 157, 1, 0, 1, 0, 0, '0'),
(864, 60, 157, 2, 0, 1, 0, 0, '0'),
(863, 60, 58, 1, 0, 1, 0, 0, '0'),
(862, 59, 56, 2, 0, 1, 0, 0, '0'),
(861, 59, 155, 1, 0, 1, 0, 0, 'profit'),
(860, 59, 129, 2, 0, 1, 0, 0, '0'),
(859, 59, 155, 1, 0, 1, 0, 0, 'fa'),
(858, 59, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(857, 59, 147, 1, 0, 1, 0, 1, '0'),
(856, 59, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(855, 59, 157, 1, 0, 1, 0, 0, '0'),
(854, 59, 157, 2, 0, 1, 0, 0, '0'),
(853, 59, 58, 1, 0, 1, 0, 0, '0'),
(852, 58, 56, 2, 0, 1, 0, 0, '0'),
(851, 58, 155, 1, 0, 1, 0, 0, 'profit'),
(850, 58, 4, 2, 0, 1, 0, 0, '0'),
(849, 58, 155, 1, 0, 1, 0, 0, 'fa'),
(848, 58, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(847, 58, 5, 1, 0, 1, 0, 1, '0'),
(846, 58, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(845, 58, 157, 1, 0, 1, 0, 0, '0'),
(844, 58, 157, 2, 0, 1, 0, 0, '0'),
(843, 58, 58, 1, 0, 1, 0, 0, '0'),
(842, 17, 56, 2, 0, 1, 0, 0, '0'),
(841, 17, 155, 1, 0, 1, 0, 0, 'profit'),
(840, 17, 7, 2, 0, 1, 0, 0, '0'),
(839, 17, 155, 1, 0, 1, 0, 0, 'fa'),
(838, 17, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(837, 17, 8, 1, 0, 1, 0, 1, '0'),
(836, 17, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(835, 17, 157, 1, 0, 1, 0, 0, '0'),
(834, 17, 157, 2, 0, 1, 0, 0, '0'),
(833, 17, 58, 1, 0, 1, 0, 0, '0'),
(832, 16, 56, 2, 0, 1, 0, 0, '0'),
(831, 16, 155, 1, 0, 1, 0, 0, 'profit'),
(830, 16, 4, 2, 0, 1, 0, 0, '0'),
(829, 16, 155, 1, 0, 1, 0, 0, 'fa'),
(828, 16, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(827, 16, 5, 1, 0, 1, 0, 1, '0'),
(826, 16, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(825, 16, 157, 1, 0, 1, 0, 0, '0'),
(824, 16, 157, 2, 0, 1, 0, 0, '0'),
(823, 16, 58, 1, 0, 1, 0, 0, '0'),
(822, 56, 56, 2, 0, 1, 0, 0, '0'),
(821, 56, 155, 1, 0, 1, 0, 0, 'profit'),
(820, 56, 99, 2, 0, 1, 0, 0, '0'),
(819, 56, 155, 1, 0, 1, 0, 0, 'fa'),
(818, 56, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(817, 56, 100, 1, 0, 1, 0, 1, '0'),
(816, 56, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(815, 56, 157, 1, 0, 1, 0, 0, '0'),
(814, 56, 157, 2, 0, 1, 0, 0, '0'),
(813, 56, 58, 1, 0, 1, 0, 0, '0'),
(812, 15, 56, 2, 0, 1, 0, 0, '0'),
(811, 15, 155, 1, 0, 1, 0, 0, 'profit'),
(810, 15, 1, 2, 0, 1, 0, 0, '0'),
(809, 15, 155, 1, 0, 1, 0, 0, 'fa'),
(808, 15, 155, 2, 0, 1, 0, 1, 'accum_dep'),
(807, 15, 2, 1, 0, 1, 0, 1, '0'),
(806, 15, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(805, 15, 157, 1, 0, 1, 0, 0, '0'),
(804, 15, 157, 2, 0, 1, 0, 0, '0'),
(803, 15, 58, 1, 0, 1, 0, 0, '0'),
(802, 50, 155, 2, 0, 1, 0, 1, '0'),
(801, 50, 94, 1, 0, 1, 0, 1, '0'),
(800, 50, 155, 2, 0, 1, 0, 0, '0'),
(799, 50, 156, 1, 0, 1, 0, 0, '0'),
(798, 50, 93, 2, 0, 1, 0, 0, '0'),
(797, 50, 155, 1, 0, 1, 0, 0, '0'),
(796, 49, 155, 2, 0, 1, 0, 1, '0'),
(795, 49, 21, 1, 0, 1, 0, 1, '0'),
(794, 49, 155, 2, 0, 1, 0, 0, '0'),
(793, 49, 156, 1, 0, 1, 0, 0, '0'),
(792, 49, 20, 2, 0, 1, 0, 0, '0'),
(791, 49, 155, 1, 0, 1, 0, 0, '0'),
(790, 48, 155, 2, 0, 1, 0, 1, '0'),
(789, 48, 146, 1, 0, 1, 0, 1, '0'),
(788, 48, 155, 2, 0, 1, 0, 0, '0'),
(787, 48, 156, 1, 0, 1, 0, 0, '0'),
(786, 48, 126, 2, 0, 1, 0, 0, '0'),
(785, 48, 155, 1, 0, 1, 0, 0, '0'),
(784, 46, 155, 2, 0, 1, 0, 1, '0'),
(783, 46, 147, 1, 0, 1, 0, 1, '0'),
(782, 46, 155, 2, 0, 1, 0, 0, '0'),
(781, 46, 156, 1, 0, 1, 0, 0, '0'),
(780, 46, 127, 2, 0, 1, 0, 0, '0'),
(779, 46, 155, 1, 0, 1, 0, 0, '0'),
(778, 45, 155, 2, 0, 1, 0, 1, '0'),
(777, 45, 151, 1, 0, 1, 0, 1, '0'),
(776, 45, 155, 2, 0, 1, 0, 0, '0'),
(775, 45, 156, 1, 0, 1, 0, 0, '0'),
(774, 45, 124, 2, 0, 1, 0, 0, '0'),
(773, 45, 155, 1, 0, 1, 0, 0, '0'),
(772, 44, 155, 2, 0, 1, 0, 1, '0'),
(771, 44, 8, 1, 0, 1, 0, 1, '0'),
(770, 44, 155, 2, 0, 1, 0, 0, '0'),
(769, 44, 156, 1, 0, 1, 0, 0, '0'),
(768, 44, 7, 2, 0, 1, 0, 0, '0'),
(767, 44, 155, 1, 0, 1, 0, 0, '0'),
(766, 43, 155, 2, 0, 1, 0, 1, '0'),
(765, 43, 5, 1, 0, 1, 0, 1, '0'),
(764, 43, 155, 2, 0, 1, 0, 0, '0'),
(763, 43, 156, 1, 0, 1, 0, 0, '0'),
(762, 43, 122, 2, 0, 1, 0, 0, '0'),
(761, 43, 155, 1, 0, 1, 0, 0, '0'),
(760, 41, 155, 2, 0, 1, 0, 1, '0'),
(759, 41, 2, 1, 0, 1, 0, 1, '0'),
(758, 41, 155, 2, 0, 1, 0, 0, '0'),
(757, 41, 156, 1, 0, 1, 0, 0, '0'),
(756, 41, 1, 2, 0, 1, 0, 0, '0'),
(755, 41, 155, 1, 0, 1, 0, 0, '0'),
(751, 42, 156, 1, 0, 1, 0, 0, '0'),
(749, 42, 155, 1, 0, 1, 0, 0, '0'),
(750, 42, 99, 2, 0, 1, 0, 0, '0'),
(752, 42, 155, 2, 0, 1, 0, 0, '0'),
(753, 42, 100, 1, 0, 1, 0, 1, '0'),
(754, 42, 155, 2, 0, 1, 0, 1, '0'),
(742, 47, 155, 2, 0, 0, 0, 1, '0'),
(741, 47, 144, 1, 0, 0, 0, 1, '0'),
(740, 47, 155, 2, 0, 0, 0, 0, '0'),
(739, 47, 156, 1, 0, 0, 0, 0, '0'),
(738, 47, 125, 2, 0, 0, 0, 0, '0'),
(737, 47, 155, 1, 0, 0, 0, 0, '0'),
(736, 297, 39, 2, 0, 1, 0, 0, '0'),
(735, 297, 154, 1, 0, 1, 0, 0, '0'),
(734, 296, 39, 2, 0, 1, 0, 0, '0'),
(733, 296, 154, 1, 0, 1, 0, 0, '0'),
(732, 295, 39, 2, 0, 1, 0, 0, '0'),
(731, 295, 154, 1, 0, 1, 0, 0, '0'),
(730, 294, 39, 2, 0, 1, 0, 0, '0'),
(729, 294, 154, 1, 0, 1, 0, 0, '0'),
(728, 293, 39, 2, 0, 1, 0, 0, '0'),
(727, 293, 154, 1, 0, 1, 0, 0, '0'),
(726, 292, 39, 2, 0, 1, 0, 0, '0'),
(725, 292, 154, 1, 0, 1, 0, 0, '0'),
(724, 291, 39, 2, 0, 1, 0, 0, '0'),
(723, 291, 154, 1, 0, 1, 0, 0, '0'),
(722, 290, 39, 2, 0, 1, 0, 0, '0'),
(721, 290, 154, 1, 0, 1, 0, 0, '0'),
(720, 289, 39, 2, 0, 1, 0, 0, '0'),
(719, 289, 154, 1, 0, 1, 0, 0, '0'),
(718, 288, 39, 2, 0, 1, 0, 0, '0'),
(717, 288, 154, 1, 0, 1, 0, 0, '0'),
(716, 287, 39, 2, 0, 1, 0, 0, '0'),
(715, 287, 154, 1, 0, 1, 0, 0, '0'),
(714, 286, 39, 2, 0, 1, 0, 0, '0'),
(713, 286, 154, 1, 0, 1, 0, 0, '0'),
(712, 308, 39, 2, 0, 1, 0, 0, '0'),
(711, 308, 128, 1, 0, 1, 0, 0, '0'),
(710, 305, 39, 2, 0, 1, 0, 0, '0'),
(709, 305, 127, 1, 0, 1, 0, 0, '0'),
(708, 309, 39, 2, 0, 1, 0, 0, '0'),
(707, 309, 93, 1, 0, 1, 0, 0, '0'),
(706, 307, 39, 2, 0, 1, 0, 0, '0'),
(705, 307, 126, 1, 0, 1, 0, 0, '0'),
(704, 306, 39, 2, 0, 1, 0, 0, '0'),
(703, 306, 125, 1, 0, 1, 0, 0, '0'),
(702, 304, 39, 2, 0, 1, 0, 0, '0'),
(701, 304, 4, 1, 0, 1, 0, 0, '0'),
(700, 303, 39, 2, 0, 1, 0, 0, '0'),
(699, 303, 7, 1, 0, 1, 0, 0, '0'),
(698, 301, 39, 2, 0, 1, 0, 0, '0'),
(697, 301, 1, 1, 0, 1, 0, 0, '0'),
(696, 299, 39, 2, 0, 1, 0, 0, '0'),
(695, 299, 99, 1, 0, 1, 0, 0, '0'),
(694, 304, 39, 2, 0, 0, 0, 0, '0'),
(693, 304, 124, 1, 0, 0, 0, 0, '0'),
(692, 313, 147, 2, 1, 0, 0, 1, '0'),
(691, 313, 155, 1, 1, 0, 0, 1, '0'),
(690, 313, 102, 2, 1, 0, 0, 0, '0'),
(689, 313, 155, 1, 1, 0, 0, 0, '0'),
(688, 313, 155, 2, 1, 0, 0, 0, '0'),
(687, 313, 129, 1, 1, 0, 0, 0, '0'),
(686, 313, 155, 2, 0, 0, 0, 1, '0'),
(685, 313, 147, 1, 0, 0, 0, 1, '0'),
(684, 313, 155, 2, 0, 0, 0, 0, '0'),
(683, 313, 103, 1, 0, 0, 0, 0, '0'),
(682, 313, 129, 2, 0, 0, 0, 0, '0'),
(681, 313, 155, 1, 0, 0, 0, 0, '0'),
(680, 312, 146, 2, 1, 0, 0, 1, '0'),
(679, 312, 155, 1, 1, 0, 0, 1, '0'),
(678, 312, 102, 2, 1, 0, 0, 0, '0'),
(677, 312, 155, 1, 1, 0, 0, 0, '0'),
(676, 312, 155, 2, 1, 0, 0, 0, '0'),
(675, 312, 126, 1, 1, 0, 0, 0, '0'),
(674, 312, 155, 2, 0, 0, 0, 1, '0'),
(673, 312, 146, 1, 0, 0, 0, 1, '0'),
(672, 312, 155, 2, 0, 0, 0, 0, '0'),
(671, 312, 103, 1, 0, 0, 0, 0, '0'),
(670, 312, 126, 2, 0, 0, 0, 0, '0'),
(669, 312, 155, 1, 0, 0, 0, 0, '0'),
(668, 30, 2, 2, 1, 0, 0, 1, '0'),
(667, 30, 155, 1, 1, 0, 0, 1, '0'),
(666, 30, 102, 2, 1, 0, 0, 0, '0'),
(665, 30, 155, 1, 1, 0, 0, 0, '0'),
(664, 30, 155, 2, 1, 0, 0, 0, '0'),
(663, 30, 1, 1, 1, 0, 0, 0, '0'),
(662, 30, 155, 2, 0, 0, 0, 1, '0'),
(661, 30, 2, 1, 0, 0, 0, 1, '0'),
(660, 30, 155, 2, 0, 0, 0, 0, '0'),
(659, 30, 103, 1, 0, 0, 0, 0, '0'),
(658, 30, 1, 2, 0, 0, 0, 0, '0'),
(657, 30, 155, 1, 0, 0, 0, 0, '0'),
(656, 38, 94, 2, 1, 0, 0, 1, '0'),
(655, 38, 155, 1, 1, 0, 0, 1, '0'),
(654, 38, 102, 2, 1, 0, 0, 0, '0'),
(653, 38, 155, 1, 1, 0, 0, 0, '0'),
(652, 38, 155, 2, 1, 0, 0, 0, '0'),
(651, 38, 93, 1, 1, 0, 0, 0, '0'),
(650, 38, 155, 2, 0, 0, 0, 1, '0'),
(649, 38, 94, 1, 0, 0, 0, 1, '0'),
(648, 38, 155, 2, 0, 0, 0, 0, '0'),
(647, 38, 103, 1, 0, 0, 0, 0, '0'),
(646, 38, 93, 2, 0, 0, 0, 0, '0'),
(645, 38, 155, 1, 0, 0, 0, 0, '0'),
(644, 33, 5, 2, 1, 0, 0, 1, '0'),
(643, 33, 155, 1, 1, 0, 0, 1, '0'),
(642, 33, 102, 2, 1, 0, 0, 0, '0'),
(641, 33, 155, 1, 1, 0, 0, 0, '0'),
(640, 33, 155, 2, 1, 0, 0, 0, '0'),
(639, 33, 4, 1, 1, 0, 0, 0, '0'),
(638, 33, 155, 2, 0, 0, 0, 1, '0'),
(637, 33, 5, 1, 0, 0, 0, 1, '0'),
(636, 33, 155, 2, 0, 0, 0, 0, '0'),
(635, 33, 103, 1, 0, 0, 0, 0, '0'),
(634, 33, 4, 2, 0, 0, 0, 0, '0'),
(633, 33, 155, 1, 0, 0, 0, 0, '0'),
(632, 32, 8, 2, 1, 0, 0, 1, '0'),
(631, 32, 155, 1, 1, 0, 0, 1, '0'),
(630, 32, 102, 2, 1, 0, 0, 0, '0'),
(629, 32, 155, 1, 1, 0, 0, 0, '0'),
(628, 32, 155, 2, 1, 0, 0, 0, '0'),
(627, 32, 7, 1, 1, 0, 0, 0, '0'),
(626, 32, 155, 2, 0, 0, 0, 1, '0'),
(625, 32, 8, 1, 0, 0, 0, 1, '0'),
(624, 32, 155, 2, 0, 0, 0, 0, '0'),
(623, 32, 103, 1, 0, 0, 0, 0, '0'),
(622, 32, 7, 2, 0, 0, 0, 0, '0'),
(621, 32, 155, 1, 0, 0, 0, 0, '0'),
(543, 35, 125, 1, 1, 0, 0, 0, '0'),
(544, 35, 155, 2, 1, 0, 0, 0, '0'),
(545, 35, 155, 1, 1, 0, 0, 0, '0'),
(546, 35, 102, 2, 1, 0, 0, 0, '0'),
(547, 35, 155, 1, 1, 0, 0, 1, '0'),
(548, 35, 144, 2, 1, 0, 0, 1, '0'),
(620, 37, 21, 2, 1, 0, 0, 1, '0'),
(619, 37, 155, 1, 1, 0, 0, 1, '0'),
(618, 37, 102, 2, 1, 0, 0, 0, '0'),
(617, 37, 155, 1, 1, 0, 0, 0, '0'),
(616, 37, 155, 2, 1, 0, 0, 0, '0'),
(615, 37, 20, 1, 1, 0, 0, 0, '0'),
(614, 37, 155, 2, 0, 0, 0, 1, '0'),
(613, 37, 21, 1, 0, 0, 0, 1, '0'),
(612, 37, 155, 2, 0, 0, 0, 0, '0'),
(611, 37, 103, 1, 0, 0, 0, 0, '0'),
(610, 37, 128, 2, 0, 0, 0, 0, '0'),
(609, 37, 155, 1, 0, 0, 0, 0, '0'),
(608, 13, 100, 2, 1, 0, 0, 1, '0'),
(607, 13, 155, 1, 1, 0, 0, 1, '0'),
(606, 13, 102, 2, 1, 0, 0, 0, '0'),
(605, 13, 155, 1, 1, 0, 0, 0, '0'),
(604, 13, 155, 2, 1, 0, 0, 0, '0'),
(603, 13, 99, 1, 1, 0, 0, 0, '0'),
(602, 13, 155, 2, 0, 0, 0, 1, '0'),
(601, 13, 100, 1, 0, 0, 0, 1, '0'),
(600, 13, 155, 2, 0, 0, 0, 0, '0'),
(599, 13, 103, 1, 0, 0, 0, 0, '0'),
(598, 13, 119, 2, 0, 0, 0, 0, '0'),
(597, 13, 155, 1, 0, 0, 0, 0, '0'),
(903, 314, 58, 1, 0, 0, 0, 0, ''),
(904, 314, 157, 2, 0, 0, 0, 0, ''),
(905, 314, 155, 1, 0, 0, 0, 0, 'fa'),
(906, 314, 99, 2, 0, 0, 0, 0, ''),
(907, 314, 157, 1, 0, 0, 0, 0, ''),
(908, 314, 155, 2, 0, 0, 0, 0, 'rab_kas'),
(909, 314, 57, 1, 0, 0, 0, 0, ''),
(910, 314, 155, 2, 0, 0, 0, 0, 'loss'),
(911, 314, 100, 1, 0, 0, 0, 0, ''),
(912, 314, 155, 2, 0, 0, 0, 0, 'accum_dep'),
(913, 316, 58, 1, 0, 1, 0, 0, ''),
(914, 316, 157, 2, 0, 1, 0, 0, ''),
(915, 316, 155, 1, 0, 1, 0, 0, 'fa'),
(916, 316, 122, 2, 0, 1, 0, 0, ''),
(917, 316, 157, 1, 0, 1, 0, 0, ''),
(918, 316, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(919, 316, 57, 1, 0, 1, 0, 0, ''),
(920, 316, 155, 2, 0, 1, 0, 0, 'loss'),
(921, 316, 5, 1, 0, 1, 0, 0, ''),
(922, 316, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(923, 317, 58, 1, 0, 1, 0, 0, ''),
(924, 317, 157, 2, 0, 1, 0, 0, ''),
(925, 317, 155, 1, 0, 1, 0, 0, 'fa'),
(926, 317, 7, 2, 0, 1, 0, 0, ''),
(927, 317, 157, 1, 0, 1, 0, 0, ''),
(928, 317, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(929, 317, 57, 1, 0, 1, 0, 0, ''),
(930, 317, 155, 2, 0, 1, 0, 0, 'loss'),
(931, 317, 8, 1, 0, 1, 0, 0, ''),
(932, 317, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(933, 318, 58, 1, 0, 1, 0, 0, ''),
(934, 318, 157, 2, 0, 1, 0, 0, ''),
(935, 318, 155, 1, 0, 1, 0, 0, 'fa'),
(936, 318, 4, 2, 0, 1, 0, 0, ''),
(937, 318, 157, 1, 0, 1, 0, 0, ''),
(938, 318, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(939, 318, 57, 1, 0, 1, 0, 0, ''),
(940, 318, 155, 2, 0, 1, 0, 0, 'loss'),
(941, 318, 5, 1, 0, 1, 0, 0, ''),
(942, 318, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(943, 319, 58, 1, 0, 1, 0, 0, ''),
(944, 319, 157, 2, 0, 1, 0, 0, ''),
(945, 319, 155, 1, 0, 1, 0, 0, 'fa'),
(946, 319, 129, 2, 0, 1, 0, 0, ''),
(947, 319, 157, 1, 0, 1, 0, 0, ''),
(948, 319, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(949, 319, 57, 1, 0, 1, 0, 0, ''),
(950, 319, 155, 2, 0, 1, 0, 0, 'loss'),
(951, 319, 147, 1, 0, 1, 0, 0, ''),
(952, 319, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(953, 320, 58, 1, 0, 1, 0, 0, ''),
(954, 320, 157, 2, 0, 1, 0, 0, ''),
(955, 320, 155, 1, 0, 1, 0, 0, 'fa'),
(956, 320, 125, 2, 0, 1, 0, 0, ''),
(957, 320, 157, 1, 0, 1, 0, 0, ''),
(958, 320, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(959, 320, 57, 1, 0, 1, 0, 0, ''),
(960, 320, 155, 2, 0, 1, 0, 0, 'loss'),
(961, 320, 144, 1, 0, 1, 0, 0, ''),
(962, 320, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(963, 321, 58, 1, 0, 1, 0, 0, ''),
(964, 321, 157, 2, 0, 1, 0, 0, ''),
(965, 321, 155, 1, 0, 1, 0, 0, 'fa'),
(966, 321, 126, 2, 0, 1, 0, 0, ''),
(967, 321, 157, 1, 0, 1, 0, 0, ''),
(968, 321, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(969, 321, 57, 1, 0, 1, 0, 0, ''),
(970, 321, 155, 2, 0, 1, 0, 0, 'loss'),
(971, 321, 146, 1, 0, 1, 0, 0, ''),
(972, 321, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(973, 322, 58, 1, 0, 1, 0, 0, ''),
(974, 322, 157, 2, 0, 1, 0, 0, ''),
(975, 322, 155, 1, 0, 1, 0, 0, 'fa'),
(976, 322, 20, 2, 0, 1, 0, 0, ''),
(977, 322, 157, 1, 0, 1, 0, 0, ''),
(978, 322, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(979, 322, 57, 1, 0, 1, 0, 0, ''),
(980, 322, 155, 2, 0, 1, 0, 0, 'loss'),
(981, 322, 21, 1, 0, 1, 0, 0, ''),
(982, 322, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(983, 323, 58, 1, 0, 1, 0, 0, ''),
(984, 323, 157, 2, 0, 1, 0, 0, ''),
(985, 323, 155, 1, 0, 1, 0, 0, 'fa'),
(986, 323, 93, 2, 0, 1, 0, 0, ''),
(987, 323, 157, 1, 0, 1, 0, 0, ''),
(988, 323, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(989, 323, 57, 1, 0, 1, 0, 0, ''),
(990, 323, 155, 2, 0, 1, 0, 0, 'loss'),
(991, 323, 94, 1, 0, 1, 0, 0, ''),
(992, 323, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(993, 315, 58, 1, 0, 1, 0, 0, ''),
(994, 315, 157, 2, 0, 1, 0, 0, ''),
(995, 315, 155, 1, 0, 1, 0, 0, 'fa'),
(996, 315, 1, 2, 0, 1, 0, 0, ''),
(997, 315, 157, 1, 0, 1, 0, 0, ''),
(998, 315, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(999, 315, 57, 1, 0, 1, 0, 0, ''),
(1000, 315, 155, 2, 0, 1, 0, 0, 'loss'),
(1001, 315, 2, 1, 0, 1, 0, 0, ''),
(1002, 315, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1003, 324, 58, 1, 0, 1, 0, 0, ''),
(1004, 324, 157, 2, 0, 1, 0, 0, ''),
(1005, 324, 155, 1, 0, 1, 0, 0, 'fa'),
(1006, 324, 1, 2, 0, 1, 0, 0, ''),
(1007, 324, 157, 1, 0, 1, 0, 0, ''),
(1008, 324, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1011, 324, 2, 1, 0, 1, 0, 0, ''),
(1012, 324, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1023, 325, 58, 1, 0, 1, 0, 0, ''),
(1024, 325, 157, 2, 0, 1, 0, 0, ''),
(1025, 325, 155, 1, 0, 1, 0, 0, 'fa'),
(1026, 325, 1, 2, 0, 1, 0, 0, ''),
(1027, 325, 157, 1, 0, 1, 0, 0, ''),
(1028, 325, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1031, 325, 2, 1, 0, 1, 0, 0, ''),
(1032, 325, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1033, 326, 58, 1, 0, 1, 0, 0, ''),
(1034, 326, 157, 2, 0, 1, 0, 0, ''),
(1035, 326, 155, 1, 0, 1, 0, 0, 'fa'),
(1036, 326, 122, 2, 0, 1, 0, 0, ''),
(1037, 326, 157, 1, 0, 1, 0, 0, ''),
(1038, 326, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1041, 326, 5, 1, 0, 1, 0, 0, ''),
(1042, 326, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1043, 327, 58, 1, 0, 1, 0, 0, ''),
(1044, 327, 157, 2, 0, 1, 0, 0, ''),
(1045, 327, 155, 1, 0, 1, 0, 0, 'fa'),
(1046, 327, 7, 2, 0, 1, 0, 0, ''),
(1047, 327, 157, 1, 0, 1, 0, 0, ''),
(1048, 327, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1051, 327, 8, 1, 0, 1, 0, 0, ''),
(1052, 327, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1053, 328, 58, 1, 0, 1, 0, 0, ''),
(1054, 328, 157, 2, 0, 1, 0, 0, ''),
(1055, 328, 155, 1, 0, 1, 0, 0, 'fa'),
(1056, 328, 4, 2, 0, 1, 0, 0, ''),
(1057, 328, 157, 1, 0, 1, 0, 0, ''),
(1058, 328, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1061, 328, 5, 1, 0, 1, 0, 0, ''),
(1062, 328, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1063, 329, 58, 1, 0, 1, 0, 0, ''),
(1064, 329, 157, 2, 0, 1, 0, 0, ''),
(1065, 329, 155, 1, 0, 1, 0, 0, 'fa'),
(1066, 329, 129, 2, 0, 1, 0, 0, ''),
(1067, 329, 157, 1, 0, 1, 0, 0, ''),
(1068, 329, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1071, 329, 147, 1, 0, 1, 0, 0, ''),
(1072, 329, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1073, 330, 58, 1, 0, 1, 0, 0, ''),
(1074, 330, 157, 2, 0, 1, 0, 0, ''),
(1075, 330, 155, 1, 0, 1, 0, 0, 'fa'),
(1076, 330, 125, 2, 0, 1, 0, 0, ''),
(1077, 330, 157, 1, 0, 1, 0, 0, ''),
(1078, 330, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1081, 330, 144, 1, 0, 1, 0, 0, ''),
(1082, 330, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1093, 332, 58, 1, 0, 1, 0, 0, ''),
(1094, 332, 157, 2, 0, 1, 0, 0, ''),
(1095, 332, 155, 1, 0, 1, 0, 0, 'fa'),
(1096, 332, 20, 2, 0, 1, 0, 0, ''),
(1097, 332, 157, 1, 0, 1, 0, 0, ''),
(1098, 332, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1101, 332, 21, 1, 0, 1, 0, 0, ''),
(1102, 332, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1103, 333, 58, 1, 0, 1, 0, 0, ''),
(1104, 333, 157, 2, 0, 1, 0, 0, ''),
(1105, 333, 155, 1, 0, 1, 0, 0, 'fa'),
(1106, 333, 93, 2, 0, 1, 0, 0, ''),
(1107, 333, 157, 1, 0, 1, 0, 0, ''),
(1108, 333, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1111, 333, 94, 1, 0, 1, 0, 0, ''),
(1112, 333, 155, 2, 0, 1, 0, 0, 'accum_dep'),
(1113, 331, 58, 1, 0, 1, 0, 0, ''),
(1114, 331, 157, 2, 0, 1, 0, 0, ''),
(1115, 331, 155, 1, 0, 1, 0, 0, 'fa'),
(1116, 331, 126, 2, 0, 1, 0, 0, ''),
(1117, 331, 157, 1, 0, 1, 0, 0, ''),
(1118, 331, 155, 2, 0, 1, 0, 0, 'rab_kas'),
(1121, 331, 146, 1, 0, 1, 0, 0, ''),
(1122, 331, 155, 2, 0, 1, 0, 0, 'accum_dep');

-- --------------------------------------------------------

--
-- Table structure for table `journal_transactions`
--

DROP TABLE IF EXISTS `journal_transactions`;
CREATE TABLE IF NOT EXISTS `journal_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `journal_position_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `amount_db` decimal(20,0) NOT NULL DEFAULT '0',
  `amount_cr` decimal(20,0) NOT NULL DEFAULT '0',
  `posting` tinyint(4) NOT NULL DEFAULT '0',
  `posting_date` datetime NOT NULL,
  `account_code` varchar(50) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `source` varchar(50) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `journal_template_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_template_detail_id` (`date`,`account_id`,`journal_position_id`,`department_id`,`amount_db`,`posting`,`account_code`),
  KEY `source` (`source`),
  KEY `invoice_id` (`doc_id`),
  KEY `amount_db` (`amount_db`),
  KEY `amount_cr` (`amount_cr`),
  KEY `journal_template_id` (`journal_template_id`),
  KEY `posting_date` (`posting_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `journal_transactions`
--

INSERT INTO `journal_transactions` (`id`, `date`, `account_id`, `journal_position_id`, `department_id`, `amount_db`, `amount_cr`, `posting`, `posting_date`, `account_code`, `notes`, `source`, `doc_id`, `journal_template_id`) VALUES
(1, '2011-07-07', 154, 1, 2, '9075000', '0', 0, '0000-00-00 00:00:00', '012.360.12099', '', 'invoice', 2, 291),
(2, '2011-07-07', 39, 2, 2, '0', '9075000', 0, '0000-00-00 00:00:00', '012.360.230003', '', 'invoice', 2, 291),
(3, '2011-07-07', 154, 1, 2, '24750000', '0', 0, '0000-00-00 00:00:00', '012.360.12099', '', 'invoice', 2, 291),
(4, '2011-07-07', 39, 2, 2, '0', '24750000', 0, '0000-00-00 00:00:00', '012.360.230003', '', 'invoice', 2, 291),
(5, '2011-07-07', 154, 1, 5, '168300000', '0', 0, '0000-00-00 00:00:00', '021.360.12099', '', 'invoice', 2, 291),
(6, '2011-07-07', 39, 2, 5, '0', '168300000', 0, '0000-00-00 00:00:00', '021.360.230003', '', 'invoice', 2, 291),
(7, '2011-07-07', 4, 1, 2, '9075000', '0', 0, '0000-00-00 00:00:00', '012.360.1080-06 ', '', 'invoice', 2, 304),
(8, '2011-07-07', 39, 2, 2, '0', '9075000', 0, '0000-00-00 00:00:00', '012.360.230003', '', 'invoice', 2, 304),
(9, '2011-07-07', 124, 1, 2, '9075000', '0', 0, '0000-00-00 00:00:00', '012.360.108006', '', 'invoice', 2, 304),
(10, '2011-07-07', 39, 2, 2, '0', '9075000', 0, '0000-00-00 00:00:00', '012.360.230003', '', 'invoice', 2, 304),
(11, '2011-07-07', 4, 1, 2, '24750000', '0', 0, '0000-00-00 00:00:00', '012.360.1080-06 ', '', 'invoice', 2, 304),
(12, '2011-07-07', 39, 2, 2, '0', '24750000', 0, '0000-00-00 00:00:00', '012.360.230003', '', 'invoice', 2, 304),
(13, '2011-07-07', 124, 1, 2, '24750000', '0', 0, '0000-00-00 00:00:00', '012.360.108006', '', 'invoice', 2, 304),
(14, '2011-07-07', 39, 2, 2, '0', '24750000', 0, '0000-00-00 00:00:00', '012.360.230003', '', 'invoice', 2, 304),
(15, '2011-07-07', 4, 1, 5, '168300000', '0', 0, '0000-00-00 00:00:00', '021.360.1080-06 ', '', 'invoice', 2, 304),
(16, '2011-07-07', 39, 2, 5, '0', '168300000', 0, '0000-00-00 00:00:00', '021.360.230003', '', 'invoice', 2, 304),
(17, '2011-07-07', 124, 1, 5, '168300000', '0', 0, '0000-00-00 00:00:00', '021.360.108006', '', 'invoice', 2, 304),
(18, '2011-07-07', 39, 2, 5, '0', '168300000', 0, '0000-00-00 00:00:00', '021.360.230003', '', 'invoice', 2, 304);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(3) NOT NULL,
  `name` char(40) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`,`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `code`, `name`, `department_id`, `parent_id`) VALUES
(1, 'SEL', 'RUANG SELS', 1, 0),
(2, 'R1', 'CLASSROOM 1', 5, 0),
(3, 'MNG', 'RUANG MANAGER', 0, 0),
(4, 'GUD', 'GUDANG UTAMA', 0, 0),
(5, 'RC', 'Resources Centre', 0, 0),
(6, '', 'KASIR', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `title` text,
  `created` datetime DEFAULT NULL,
  `description` text,
  `model` text,
  `model_id` int(200) DEFAULT NULL,
  `action` text,
  `user_id` int(200) DEFAULT NULL,
  `change` text,
  `version_id` int(200) DEFAULT NULL,
  `fields` text,
  `order` text,
  `conditions` text,
  `events` text,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`,`user_id`,`version_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=340 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(1, 'cabang4', '2011-07-07 13:59:48', 'User "cabang4" (40) added by User "Admin" (2).', 'User', 40, 'add', 2, 'aktif, username, email, password, name, group_id, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(2, 'cabang4', '2011-07-07 14:01:56', 'User "cabang4" (40) deleted by User "Admin" (2).', 'User', 40, 'delete', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'cabang', '2011-07-07 14:02:22', 'User "cabang" (8) updated by User "Admin" (2).', 'User', 8, 'edit', 2, 'department_id', NULL, NULL, NULL, NULL, NULL),
(4, 'heri', '2011-07-07 14:02:41', 'User "heri" (3) updated by User "Admin" (2).', 'User', 3, 'edit', 2, 'department_id', NULL, NULL, NULL, NULL, NULL),
(5, 'cabang2', '2011-07-07 14:03:02', 'User "cabang2" (21) updated by User "Admin" (2).', 'User', 21, 'edit', 2, 'department_id', NULL, NULL, NULL, NULL, NULL),
(6, 'heri2', '2011-07-07 14:03:16', 'User "heri2" (23) updated by User "Admin" (2).', 'User', 23, 'edit', 2, 'department_id', NULL, NULL, NULL, NULL, NULL),
(7, 'cabang3', '2011-07-07 14:03:39', 'User "cabang3" (22) updated by User "Admin" (2).', 'User', 22, 'edit', 2, 'department_id', NULL, NULL, NULL, NULL, NULL),
(8, 'heri3', '2011-07-07 14:03:48', 'User "heri3" (24) updated by User "Admin" (2).', 'User', 24, 'edit', 2, 'department_id', NULL, NULL, NULL, NULL, NULL),
(9, 'MR-012-11-0001', '2011-07-07 14:05:26', 'Npb "MR-012-11-0001" (1) added by User "cabang" (8).', 'Npb', 1, 'add', 8, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(10, 'NpbDetail (1)', '2011-07-07 14:13:30', 'NpbDetail (1) added by User "cabang" (8).', 'NpbDetail', 1, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(11, 'NpbDetail (2)', '2011-07-07 14:14:09', 'NpbDetail (2) added by User "cabang" (8).', 'NpbDetail', 2, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(12, 'NpbDetail (3)', '2011-07-07 14:14:55', 'NpbDetail (3) added by User "cabang" (8).', 'NpbDetail', 3, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(13, 'NpbDetail (4)', '2011-07-07 14:15:23', 'NpbDetail (4) added by User "cabang" (8).', 'NpbDetail', 4, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(14, 'NpbDetail (5)', '2011-07-07 14:16:09', 'NpbDetail (5) added by User "cabang" (8).', 'NpbDetail', 5, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(15, 'MR-012-11-0001', '2011-07-07 14:17:18', 'Npb (1) updated by User "cabang" (8).', 'Npb', 1, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(16, 'MR-012-11-0002', '2011-07-07 14:17:41', 'Npb "MR-012-11-0002" (2) added by User "cabang" (8).', 'Npb', 2, 'add', 8, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(17, 'NpbDetail (6)', '2011-07-07 14:18:27', 'NpbDetail (6) added by User "cabang" (8).', 'NpbDetail', 6, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(18, 'NpbDetail (7)', '2011-07-07 14:19:19', 'NpbDetail (7) added by User "cabang" (8).', 'NpbDetail', 7, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(19, 'MR-012-11-0002', '2011-07-07 14:19:30', 'Npb (2) updated by User "cabang" (8).', 'Npb', 2, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(20, 'MR-021-11-0001', '2011-07-07 14:20:17', 'Npb "MR-021-11-0001" (3) added by User "cabang2" (21).', 'Npb', 3, 'add', 21, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(21, 'NpbDetail (8)', '2011-07-07 14:20:54', 'NpbDetail (8) added by User "cabang2" (21).', 'NpbDetail', 8, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(22, 'NpbDetail (9)', '2011-07-07 14:21:13', 'NpbDetail (9) added by User "cabang2" (21).', 'NpbDetail', 9, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(23, 'NpbDetail (10)', '2011-07-07 14:21:44', 'NpbDetail (10) added by User "cabang2" (21).', 'NpbDetail', 10, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(24, 'MR-021-11-0001', '2011-07-07 14:21:59', 'Npb (3) updated by User "cabang2" (21).', 'Npb', 3, 'edit', 21, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(25, 'MR-021-11-0002', '2011-07-07 14:22:17', 'Npb "MR-021-11-0002" (4) added by User "cabang2" (21).', 'Npb', 4, 'add', 21, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(26, 'NpbDetail (11)', '2011-07-07 14:22:59', 'NpbDetail (11) added by User "cabang2" (21).', 'NpbDetail', 11, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(27, 'MR-021-11-0002', '2011-07-07 14:23:11', 'Npb (4) updated by User "cabang2" (21).', 'Npb', 4, 'edit', 21, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(28, 'MR-010-11-0001', '2011-07-07 14:23:57', 'Npb "MR-010-11-0001" (5) added by User "cabang3" (22).', 'Npb', 5, 'add', 22, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(29, 'NpbDetail (12)', '2011-07-07 14:24:56', 'NpbDetail (12) added by User "cabang3" (22).', 'NpbDetail', 12, 'add', 22, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, npb_id', NULL, NULL, NULL, NULL, NULL),
(30, 'NpbDetail (13)', '2011-07-07 14:25:52', 'NpbDetail (13) added by User "cabang3" (22).', 'NpbDetail', 13, 'add', 22, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, npb_id', NULL, NULL, NULL, NULL, NULL),
(31, 'MR-010-11-0001', '2011-07-07 14:26:09', 'Npb (5) updated by User "cabang3" (22).', 'Npb', 5, 'edit', 22, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(32, 'MR-010-11-0002', '2011-07-07 14:26:31', 'Npb "MR-010-11-0002" (6) added by User "cabang3" (22).', 'Npb', 6, 'add', 22, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(33, 'NpbDetail (14)', '2011-07-07 14:27:36', 'NpbDetail (14) added by User "cabang3" (22).', 'NpbDetail', 14, 'add', 22, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(34, 'NpbDetail (15)', '2011-07-07 14:27:59', 'NpbDetail (15) added by User "cabang3" (22).', 'NpbDetail', 15, 'add', 22, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(35, 'MR-010-11-0002', '2011-07-07 14:28:35', 'Npb (6) updated by User "cabang3" (22).', 'Npb', 6, 'edit', 22, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(36, 'MR-010-11-0003', '2011-07-07 14:28:57', 'Npb "MR-010-11-0003" (7) added by User "cabang3" (22).', 'Npb', 7, 'add', 22, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(37, 'MR-010-11-0003', '2011-07-07 14:28:57', 'Npb "MR-010-11-0003" (8) added by User "cabang3" (22).', 'Npb', 8, 'add', 22, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(38, 'NpbDetail (16)', '2011-07-07 14:29:27', 'NpbDetail (16) added by User "cabang3" (22).', 'NpbDetail', 16, 'add', 22, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, npb_id', NULL, NULL, NULL, NULL, NULL),
(39, 'NpbDetail (17)', '2011-07-07 14:30:02', 'NpbDetail (17) added by User "cabang3" (22).', 'NpbDetail', 17, 'add', 22, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, npb_id', NULL, NULL, NULL, NULL, NULL),
(40, 'MR-010-11-0003', '2011-07-07 14:30:14', 'Npb (8) updated by User "cabang3" (22).', 'Npb', 8, 'edit', 22, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(41, 'MR-012-11-0001', '2011-07-07 14:32:26', 'Npb "MR-012-11-0001" (1) updated by User "heri" (3).', 'Npb', 1, 'edit', 3, 'cancel_notes, cancel_by, cancel_date, npb_status_id', NULL, NULL, NULL, NULL, NULL),
(42, 'NpbDetail (1)', '2011-07-07 14:33:38', 'NpbDetail (1) deleted by User "cabang" (8).', 'NpbDetail', 1, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'NpbDetail (18)', '2011-07-07 14:34:10', 'NpbDetail (18) added by User "cabang" (8).', 'NpbDetail', 18, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(44, 'MR-012-11-0001', '2011-07-07 14:34:12', 'Npb (1) updated by User "cabang" (8).', 'Npb', 1, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(45, 'MR-012-11-0001', '2011-07-07 14:35:36', 'Npb (1) updated by User "heri" (3).', 'Npb', 1, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(46, 'MR-012-11-0002', '2011-07-07 14:36:48', 'Npb "MR-012-11-0002" (2) updated by User "heri" (3).', 'Npb', 2, 'edit', 3, 'cancel_notes, cancel_by, cancel_date, npb_status_id', NULL, NULL, NULL, NULL, NULL),
(47, 'NpbDetail (19)', '2011-07-07 14:37:46', 'NpbDetail (19) added by User "cabang" (8).', 'NpbDetail', 19, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(48, 'NpbDetail (6)', '2011-07-07 14:37:49', 'NpbDetail (6) deleted by User "cabang" (8).', 'NpbDetail', 6, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'MR-012-11-0002', '2011-07-07 14:38:12', 'Npb (2) updated by User "cabang" (8).', 'Npb', 2, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(50, 'MR-012-11-0002', '2011-07-07 14:38:33', 'Npb (2) updated by User "heri" (3).', 'Npb', 2, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(51, 'MR-021-11-0001', '2011-07-07 14:39:12', 'Npb (3) updated by User "heri2" (23).', 'Npb', 3, 'edit', 23, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(52, 'MR-021-11-0002', '2011-07-07 14:40:21', 'Npb (4) updated by User "heri2" (23).', 'Npb', 4, 'edit', 23, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(53, 'MR-010-11-0001', '2011-07-07 14:41:44', 'Npb "MR-010-11-0001" (5) updated by User "heri3" (24).', 'Npb', 5, 'edit', 24, 'cancel_notes, cancel_by, cancel_date, npb_status_id', NULL, NULL, NULL, NULL, NULL),
(54, 'MR-010-11-0002', '2011-07-07 14:43:34', 'Npb "MR-010-11-0002" (6) updated by User "heri3" (24).', 'Npb', 6, 'edit', 24, 'cancel_notes, cancel_by, cancel_date, npb_status_id', NULL, NULL, NULL, NULL, NULL),
(55, 'MR-010-11-0001', '2011-07-07 14:46:13', 'Npb (5) updated by User "cabang3" (22).', 'Npb', 5, 'edit', 22, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(56, 'MR-010-11-0002', '2011-07-07 14:46:44', 'Npb (6) updated by User "cabang3" (22).', 'Npb', 6, 'edit', 22, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(57, 'MR-010-11-0003', '2011-07-07 14:47:26', 'Npb "MR-010-11-0003" (8) updated by User "heri3" (24).', 'Npb', 8, 'edit', 24, 'npb_status_id, reject_notes, reject_by, reject_date', NULL, NULL, NULL, NULL, NULL),
(58, 'MR-010-11-0003', '2011-07-07 14:48:11', 'Npb (8) updated by User "cabang3" (22).', 'Npb', 8, 'edit', 22, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(59, 'MR-010-11-0003', '2011-07-07 14:48:26', 'Npb "MR-010-11-0003" (7) deleted by User "cabang3" (22).', 'Npb', 7, 'delete', 22, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'MR-010-11-0001', '2011-07-07 14:49:01', 'Npb (5) updated by User "heri3" (24).', 'Npb', 5, 'edit', 24, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(61, 'MR-010-11-0002', '2011-07-07 14:49:19', 'Npb (6) updated by User "heri3" (24).', 'Npb', 6, 'edit', 24, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(62, 'NpbDetail (3)', '2011-07-07 14:50:24', 'NpbDetail (3) updated by User "gs_admin" (13).', 'NpbDetail', 3, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(63, 'NpbDetail (18)', '2011-07-07 14:50:26', 'NpbDetail (18) updated by User "gs_admin" (13).', 'NpbDetail', 18, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(64, 'NpbDetail (2)', '2011-07-07 14:50:27', 'NpbDetail (2) updated by User "gs_admin" (13).', 'NpbDetail', 2, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(65, 'NpbDetail (4)', '2011-07-07 14:50:28', 'NpbDetail (4) updated by User "gs_admin" (13).', 'NpbDetail', 4, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(66, 'NpbDetail (5)', '2011-07-07 14:50:29', 'NpbDetail (5) updated by User "gs_admin" (13).', 'NpbDetail', 5, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(67, 'MR-012-11-0001', '2011-07-07 14:50:54', 'Npb (1) updated by User "gs_admin" (13).', 'Npb', 1, 'edit', 13, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(68, 'NpbDetail (9)', '2011-07-07 14:51:32', 'NpbDetail (9) updated by User "gs_admin" (13).', 'NpbDetail', 9, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(69, 'NpbDetail (8)', '2011-07-07 14:51:33', 'NpbDetail (8) updated by User "gs_admin" (13).', 'NpbDetail', 8, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(70, 'NpbDetail (10)', '2011-07-07 14:51:33', 'NpbDetail (10) updated by User "gs_admin" (13).', 'NpbDetail', 10, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(71, 'MR-021-11-0001', '2011-07-07 14:51:36', 'Npb (3) updated by User "gs_admin" (13).', 'Npb', 3, 'edit', 13, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(72, 'NpbDetail (12)', '2011-07-07 14:51:57', 'NpbDetail (12) updated by User "gs_admin" (13).', 'NpbDetail', 12, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(73, 'NpbDetail (13)', '2011-07-07 14:51:58', 'NpbDetail (13) updated by User "gs_admin" (13).', 'NpbDetail', 13, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(74, 'MR-010-11-0001', '2011-07-07 14:52:01', 'Npb (5) updated by User "gs_admin" (13).', 'Npb', 5, 'edit', 13, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(75, 'NpbDetail (19)', '2011-07-07 14:52:46', 'NpbDetail (19) updated by User "it_admin" (14).', 'NpbDetail', 19, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(76, 'NpbDetail (7)', '2011-07-07 14:52:47', 'NpbDetail (7) updated by User "it_admin" (14).', 'NpbDetail', 7, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(77, 'MR-012-11-0002', '2011-07-07 14:52:48', 'Npb (2) updated by User "it_admin" (14).', 'Npb', 2, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(78, 'MR-012-11-0002', '2011-07-07 14:53:14', 'Npb (2) updated by User "it_admin" (14).', 'Npb', 2, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(79, 'NpbDetail (11)', '2011-07-07 14:53:37', 'NpbDetail (11) updated by User "it_admin" (14).', 'NpbDetail', 11, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(80, 'MR-021-11-0002', '2011-07-07 14:53:41', 'Npb (4) updated by User "it_admin" (14).', 'Npb', 4, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(81, 'MR-021-11-0002', '2011-07-07 14:54:10', 'Npb (4) updated by User "it_admin" (14).', 'Npb', 4, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(82, 'NpbDetail (15)', '2011-07-07 14:54:36', 'NpbDetail (15) updated by User "it_admin" (14).', 'NpbDetail', 15, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(83, 'NpbDetail (14)', '2011-07-07 14:54:38', 'NpbDetail (14) updated by User "it_admin" (14).', 'NpbDetail', 14, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(84, 'MR-010-11-0002', '2011-07-07 14:54:41', 'Npb (6) updated by User "it_admin" (14).', 'Npb', 6, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(85, 'MR-010-11-0002', '2011-07-07 14:54:54', 'Npb (6) updated by User "it_admin" (14).', 'Npb', 6, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(86, 'MR-012-11-0001', '2011-07-07 14:55:14', 'Npb (1) updated by User "gs_spv" (38).', 'Npb', 1, 'edit', 38, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(87, 'MR-021-11-0001', '2011-07-07 14:55:40', 'Npb (3) updated by User "gs_spv" (38).', 'Npb', 3, 'edit', 38, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(88, 'MR-010-11-0001', '2011-07-07 14:55:59', 'Npb (5) updated by User "gs_spv" (38).', 'Npb', 5, 'edit', 38, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(89, 'Borneo Inti Kreasi', '2011-07-07 15:02:17', 'Supplier "Borneo Inti Kreasi" (28) added by User "gs" (7).', 'Supplier', 28, 'add', 7, 'default_wht_rate, name, address, city, province, telephone, fax, contact_person, hp, email, website', NULL, NULL, NULL, NULL, NULL),
(90, 'PO-0001', '2011-07-07 15:04:25', 'Po "PO-0001" (1) added by User "gs" (7).', 'Po', 1, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(91, '1', '2011-07-07 15:04:25', 'PoPayment "1" (1) added by User "gs" (7).', 'PoPayment', 1, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(92, 'KURSI KERJA', '2011-07-07 15:04:25', 'PoDetail "KURSI KERJA" (1) added by User "gs" (7).', 'PoDetail', 1, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(93, 'NpbDetail (18)', '2011-07-07 15:04:25', 'NpbDetail (18) updated by User "gs" (7).', 'NpbDetail', 18, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(94, 'KURSI HADAP', '2011-07-07 15:04:25', 'PoDetail "KURSI HADAP" (2) added by User "gs" (7).', 'PoDetail', 2, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(95, 'NpbDetail (2)', '2011-07-07 15:04:25', 'NpbDetail (2) updated by User "gs" (7).', 'NpbDetail', 2, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(96, 'MEJA NASABAH', '2011-07-07 15:04:25', 'PoDetail "MEJA NASABAH" (3) added by User "gs" (7).', 'PoDetail', 3, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(97, 'NpbDetail (4)', '2011-07-07 15:04:25', 'NpbDetail (4) updated by User "gs" (7).', 'NpbDetail', 4, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(98, 'MESIN TIK', '2011-07-07 15:04:25', 'PoDetail "MESIN TIK" (4) added by User "gs" (7).', 'PoDetail', 4, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(99, 'NpbDetail (5)', '2011-07-07 15:04:26', 'NpbDetail (5) updated by User "gs" (7).', 'NpbDetail', 5, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(100, 'KURSI KERJA', '2011-07-07 15:04:26', 'PoDetail "KURSI KERJA" (5) added by User "gs" (7).', 'PoDetail', 5, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(101, 'NpbDetail (8)', '2011-07-07 15:04:26', 'NpbDetail (8) updated by User "gs" (7).', 'NpbDetail', 8, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(102, 'MEJA KERJA', '2011-07-07 15:04:26', 'PoDetail "MEJA KERJA" (6) added by User "gs" (7).', 'PoDetail', 6, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(103, 'NpbDetail (10)', '2011-07-07 15:04:26', 'NpbDetail (10) updated by User "gs" (7).', 'NpbDetail', 10, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(104, 'PO-0001', '2011-07-07 15:04:26', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(105, 'PO-0001', '2011-07-07 15:05:29', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'sub_total, down_payment', NULL, NULL, NULL, NULL, NULL),
(106, '1', '2011-07-07 15:05:29', 'PoPayment "1" (2) added by User "gs" (7).', 'PoPayment', 2, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(107, '1', '2011-07-07 15:05:52', 'PoPayment "1" (2) updated by User "gs" (7).', 'PoPayment', 2, 'edit', 7, 'term_percent, amount_due', NULL, NULL, NULL, NULL, NULL),
(108, 'PO-0001', '2011-07-07 15:06:22', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(109, 'trikarsa', '2011-07-07 15:12:57', 'Supplier "trikarsa" (29) added by User "gs" (7).', 'Supplier', 29, 'add', 7, 'default_wht_rate, name, address, city, province, telephone, fax, contact_person, hp, email, website, business_type', NULL, NULL, NULL, NULL, NULL),
(110, 'PO-0002', '2011-07-07 15:16:11', 'Po "PO-0002" (2) added by User "gs" (7).', 'Po', 2, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(111, '1', '2011-07-07 15:16:11', 'PoPayment "1" (3) added by User "gs" (7).', 'PoPayment', 3, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(112, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:16:12', 'PoDetail "DEKSTOP DELL OPTIPLEX" (7) added by User "gs" (7).', 'PoDetail', 7, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(113, 'NpbDetail (19)', '2011-07-07 15:16:12', 'NpbDetail (19) updated by User "gs" (7).', 'NpbDetail', 19, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(114, 'THIN CLIENT  ', '2011-07-07 15:16:12', 'PoDetail "THIN CLIENT  " (8) added by User "gs" (7).', 'PoDetail', 8, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(115, 'NpbDetail (7)', '2011-07-07 15:16:12', 'NpbDetail (7) updated by User "gs" (7).', 'NpbDetail', 7, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(116, 'PRINTER EPSON LQ 2180', '2011-07-07 15:16:12', 'PoDetail "PRINTER EPSON LQ 2180" (9) added by User "gs" (7).', 'PoDetail', 9, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(117, 'NpbDetail (11)', '2011-07-07 15:16:12', 'NpbDetail (11) updated by User "gs" (7).', 'NpbDetail', 11, 'edit', 7, 'po_id, date_finish, qty_filled', NULL, NULL, NULL, NULL, NULL),
(118, 'MR-012-11-0002', '2011-07-07 15:16:12', 'Npb "MR-012-11-0002" (2) updated by User "gs" (7).', 'Npb', 2, 'edit', 7, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(119, 'MR-012-11-0002', '2011-07-07 15:16:12', 'Npb "MR-012-11-0002" (2) updated by User "gs" (7).', 'Npb', 2, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(120, 'MR-021-11-0002', '2011-07-07 15:16:12', 'Npb "MR-021-11-0002" (4) updated by User "gs" (7).', 'Npb', 4, 'edit', 7, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(121, 'PO-0002', '2011-07-07 15:16:12', 'Po "PO-0002" (2) updated by User "gs" (7).', 'Po', 2, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(122, '1', '2011-07-07 15:16:21', 'PoPayment "1" (3) updated by User "gs" (7).', 'PoPayment', 3, 'edit', 7, 'term_percent, amount_due', NULL, NULL, NULL, NULL, NULL),
(123, 'PO-0002', '2011-07-07 15:16:27', 'Po (2) updated by User "gs" (7).', 'Po', 2, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(124, 'PO-0001', '2011-07-07 15:17:30', 'Po "PO-0001" (1) updated by User "ade" (4).', 'Po', 1, 'edit', 4, 'po_status_id, cancel_notes, cancel_by, cancel_date', NULL, NULL, NULL, NULL, NULL),
(125, 'PO-0002', '2011-07-07 15:17:51', 'Po (2) updated by User "ade" (4).', 'Po', 2, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(126, 'MEJA KERJA', '2011-07-07 15:18:22', 'PoDetail "MEJA KERJA" (6) updated by User "gs" (7).', 'PoDetail', 6, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(127, 'PO-0001', '2011-07-07 15:18:22', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(128, 'PO-0001', '2011-07-07 15:18:35', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(129, 'PO-0001', '2011-07-07 15:19:03', 'Po (1) updated by User "ade" (4).', 'Po', 1, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(130, 'PO-0001', '2011-07-07 15:19:28', 'Po (1) updated by User "badu" (5).', 'Po', 1, 'edit', 5, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(131, 'PO-0002', '2011-07-07 15:19:34', 'Po (2) updated by User "badu" (5).', 'Po', 2, 'edit', 5, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(132, 'PO-0001', '2011-07-07 15:19:52', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(133, 'PO-0002', '2011-07-07 15:19:57', 'Po (2) updated by User "gs" (7).', 'Po', 2, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(134, 'PO-0001', '2011-07-07 15:20:27', 'Po (1) updated by User "fincon" (9).', 'Po', 1, 'edit', 9, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(135, 'PO-0002', '2011-07-07 15:20:36', 'Po (2) updated by User "fincon" (9).', 'Po', 2, 'edit', 9, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(136, 'PO-0001', '2011-07-07 15:21:05', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(137, 'PO-0001', '2011-07-07 15:21:33', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(138, 'PO-0002', '2011-07-07 15:21:45', 'Po "PO-0002" (2) updated by User "gs" (7).', 'Po', 2, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(139, 'PO-0002', '2011-07-07 15:22:01', 'Po (2) updated by User "gs" (7).', 'Po', 2, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(140, 'BIF/001', '2011-07-07 15:23:07', 'DeliveryOrder "BIF/001" (1) added by User "gs" (7).', 'DeliveryOrder', 1, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(141, 'KURSI KERJA', '2011-07-07 15:23:07', 'DeliveryOrderDetail "KURSI KERJA" (1) added by User "gs" (7).', 'DeliveryOrderDetail', 1, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(142, 'KURSI HADAP', '2011-07-07 15:23:07', 'DeliveryOrderDetail "KURSI HADAP" (2) added by User "gs" (7).', 'DeliveryOrderDetail', 2, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(143, 'MEJA NASABAH', '2011-07-07 15:23:07', 'DeliveryOrderDetail "MEJA NASABAH" (3) added by User "gs" (7).', 'DeliveryOrderDetail', 3, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(144, 'MESIN TIK', '2011-07-07 15:23:07', 'DeliveryOrderDetail "MESIN TIK" (4) added by User "gs" (7).', 'DeliveryOrderDetail', 4, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(145, 'KURSI KERJA', '2011-07-07 15:23:07', 'DeliveryOrderDetail "KURSI KERJA" (5) added by User "gs" (7).', 'DeliveryOrderDetail', 5, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(146, 'MEJA KERJA', '2011-07-07 15:23:07', 'DeliveryOrderDetail "MEJA KERJA" (6) added by User "gs" (7).', 'DeliveryOrderDetail', 6, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(147, 'MEJA KERJA', '2011-07-07 15:23:26', 'DeliveryOrderDetail "MEJA KERJA" (6) updated by User "gs" (7).', 'DeliveryOrderDetail', 6, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(148, 'KURSI KERJA', '2011-07-07 15:23:27', 'DeliveryOrderDetail "KURSI KERJA" (5) updated by User "gs" (7).', 'DeliveryOrderDetail', 5, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(149, 'MEJA NASABAH', '2011-07-07 15:23:28', 'DeliveryOrderDetail "MEJA NASABAH" (3) updated by User "gs" (7).', 'DeliveryOrderDetail', 3, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(150, 'MESIN TIK', '2011-07-07 15:23:28', 'DeliveryOrderDetail "MESIN TIK" (4) updated by User "gs" (7).', 'DeliveryOrderDetail', 4, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(151, 'KURSI KERJA', '2011-07-07 15:23:29', 'DeliveryOrderDetail "KURSI KERJA" (1) updated by User "gs" (7).', 'DeliveryOrderDetail', 1, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(152, 'KURSI HADAP', '2011-07-07 15:23:29', 'DeliveryOrderDetail "KURSI HADAP" (2) updated by User "gs" (7).', 'DeliveryOrderDetail', 2, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(153, 'BIF/001', '2011-07-07 15:23:42', 'DeliveryOrder (1) updated by User "gs" (7).', 'DeliveryOrder', 1, 'edit', 7, 'delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(154, 'TR.001', '2011-07-07 15:24:23', 'DeliveryOrder "TR.001" (2) added by User "gs" (7).', 'DeliveryOrder', 2, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(155, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:24:23', 'DeliveryOrderDetail "DEKSTOP DELL OPTIPLEX" (7) added by User "gs" (7).', 'DeliveryOrderDetail', 7, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(156, 'THIN CLIENT  ', '2011-07-07 15:24:23', 'DeliveryOrderDetail "THIN CLIENT  " (8) added by User "gs" (7).', 'DeliveryOrderDetail', 8, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(157, 'PRINTER EPSON LQ 2180', '2011-07-07 15:24:23', 'DeliveryOrderDetail "PRINTER EPSON LQ 2180" (9) added by User "gs" (7).', 'DeliveryOrderDetail', 9, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(158, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:24:30', 'DeliveryOrderDetail "DEKSTOP DELL OPTIPLEX" (7) updated by User "gs" (7).', 'DeliveryOrderDetail', 7, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(159, 'THIN CLIENT  ', '2011-07-07 15:24:31', 'DeliveryOrderDetail "THIN CLIENT  " (8) updated by User "gs" (7).', 'DeliveryOrderDetail', 8, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(160, 'PRINTER EPSON LQ 2180', '2011-07-07 15:24:32', 'DeliveryOrderDetail "PRINTER EPSON LQ 2180" (9) updated by User "gs" (7).', 'DeliveryOrderDetail', 9, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(161, 'TR.001', '2011-07-07 15:24:34', 'DeliveryOrder (2) updated by User "gs" (7).', 'DeliveryOrder', 2, 'edit', 7, 'delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(162, 'BIF/002', '2011-07-07 15:25:07', 'DeliveryOrder "BIF/002" (3) added by User "gs" (7).', 'DeliveryOrder', 3, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(163, 'KURSI KERJA', '2011-07-07 15:25:07', 'DeliveryOrderDetail "KURSI KERJA" (10) added by User "gs" (7).', 'DeliveryOrderDetail', 10, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(164, 'KURSI HADAP', '2011-07-07 15:25:07', 'DeliveryOrderDetail "KURSI HADAP" (11) added by User "gs" (7).', 'DeliveryOrderDetail', 11, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(165, 'MEJA NASABAH', '2011-07-07 15:25:07', 'DeliveryOrderDetail "MEJA NASABAH" (12) added by User "gs" (7).', 'DeliveryOrderDetail', 12, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(166, 'MESIN TIK', '2011-07-07 15:25:07', 'DeliveryOrderDetail "MESIN TIK" (13) added by User "gs" (7).', 'DeliveryOrderDetail', 13, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(167, 'KURSI KERJA', '2011-07-07 15:25:07', 'DeliveryOrderDetail "KURSI KERJA" (14) added by User "gs" (7).', 'DeliveryOrderDetail', 14, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(168, 'MEJA KERJA', '2011-07-07 15:25:07', 'DeliveryOrderDetail "MEJA KERJA" (15) added by User "gs" (7).', 'DeliveryOrderDetail', 15, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(169, 'KURSI HADAP', '2011-07-07 15:25:19', 'DeliveryOrderDetail "KURSI HADAP" (11) updated by User "gs" (7).', 'DeliveryOrderDetail', 11, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(170, 'KURSI KERJA', '2011-07-07 15:25:25', 'DeliveryOrderDetail "KURSI KERJA" (10) updated by User "gs" (7).', 'DeliveryOrderDetail', 10, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(171, 'KURSI HADAP', '2011-07-07 15:26:08', 'DeliveryOrderDetail "KURSI HADAP" (11) updated by User "gs" (7).', 'DeliveryOrderDetail', 11, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(172, 'KURSI KERJA', '2011-07-07 15:26:08', 'DeliveryOrderDetail "KURSI KERJA" (10) updated by User "gs" (7).', 'DeliveryOrderDetail', 10, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(173, 'BIF/002', '2011-07-07 15:26:14', 'DeliveryOrder (3) updated by User "gs" (7).', 'DeliveryOrder', 3, 'edit', 7, 'delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(174, 'TR.001', '2011-07-07 15:26:45', 'DeliveryOrder "TR.001" (2) updated by User "ade" (4).', 'DeliveryOrder', 2, 'edit', 4, 'delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(175, 'PO-0002', '2011-07-07 15:26:45', 'Po "PO-0002" (2) updated by User "ade" (4).', 'Po', 2, 'edit', 4, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(176, 'BIF/002', '2011-07-07 15:27:00', 'DeliveryOrder "BIF/002" (3) updated by User "ade" (4).', 'DeliveryOrder', 3, 'edit', 4, 'delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(177, 'PO-0001', '2011-07-07 15:27:01', 'Po "PO-0001" (1) updated by User "ade" (4).', 'Po', 1, 'edit', 4, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(178, '', '2011-07-07 15:28:31', 'Purchase (1) added by User "gs" (7).', 'Purchase', 1, 'add', 7, 'sup_tanggal, pos_ting, date_of_purchase, warranty_date, kd_luar_tanggal, currency_id, no, delivery_order_id, po_no, po_id, supplier_id, warranty_name, warranty_year', NULL, NULL, NULL, NULL, NULL),
(179, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (1) added by User "gs" (7).', 'AssetDetail', 1, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(180, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (2) added by User "gs" (7).', 'AssetDetail', 2, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(181, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (3) added by User "gs" (7).', 'AssetDetail', 3, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(182, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (4) added by User "gs" (7).', 'AssetDetail', 4, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(183, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (5) added by User "gs" (7).', 'AssetDetail', 5, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(184, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (6) added by User "gs" (7).', 'AssetDetail', 6, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(185, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (7) added by User "gs" (7).', 'AssetDetail', 7, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(186, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (8) added by User "gs" (7).', 'AssetDetail', 8, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(187, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (9) added by User "gs" (7).', 'AssetDetail', 9, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(188, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (10) added by User "gs" (7).', 'AssetDetail', 10, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(189, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (11) added by User "gs" (7).', 'AssetDetail', 11, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(190, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (12) added by User "gs" (7).', 'AssetDetail', 12, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(191, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (13) added by User "gs" (7).', 'AssetDetail', 13, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(192, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (14) added by User "gs" (7).', 'AssetDetail', 14, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(193, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (15) added by User "gs" (7).', 'AssetDetail', 15, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(194, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (16) added by User "gs" (7).', 'AssetDetail', 16, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(195, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (17) added by User "gs" (7).', 'AssetDetail', 17, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(196, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (18) added by User "gs" (7).', 'AssetDetail', 18, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(197, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (19) added by User "gs" (7).', 'AssetDetail', 19, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(198, 'KURSI HADAP', '2011-07-07 15:28:32', 'AssetDetail "KURSI HADAP" (20) added by User "gs" (7).', 'AssetDetail', 20, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(199, 'MEJA NASABAH', '2011-07-07 15:28:32', 'AssetDetail "MEJA NASABAH" (21) added by User "gs" (7).', 'AssetDetail', 21, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(200, 'MEJA NASABAH', '2011-07-07 15:28:32', 'AssetDetail "MEJA NASABAH" (22) added by User "gs" (7).', 'AssetDetail', 22, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(201, 'MEJA NASABAH', '2011-07-07 15:28:32', 'AssetDetail "MEJA NASABAH" (23) added by User "gs" (7).', 'AssetDetail', 23, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(202, 'MESIN TIK', '2011-07-07 15:28:32', 'AssetDetail "MESIN TIK" (24) added by User "gs" (7).', 'AssetDetail', 24, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(203, 'MESIN TIK', '2011-07-07 15:28:32', 'AssetDetail "MESIN TIK" (25) added by User "gs" (7).', 'AssetDetail', 25, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(204, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (26) added by User "gs" (7).', 'AssetDetail', 26, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(205, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (27) added by User "gs" (7).', 'AssetDetail', 27, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(206, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (28) added by User "gs" (7).', 'AssetDetail', 28, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(207, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (29) added by User "gs" (7).', 'AssetDetail', 29, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(208, 'KURSI KERJA', '2011-07-07 15:28:32', 'AssetDetail "KURSI KERJA" (30) added by User "gs" (7).', 'AssetDetail', 30, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(209, 'MEJA KERJA', '2011-07-07 15:28:32', 'AssetDetail "MEJA KERJA" (31) added by User "gs" (7).', 'AssetDetail', 31, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(210, 'BIF/001', '2011-07-07 15:28:32', 'DeliveryOrder "BIF/001" (1) updated by User "gs" (7).', 'DeliveryOrder', 1, 'edit', 7, 'convert_asset', NULL, NULL, NULL, NULL, NULL),
(211, '', '2011-07-07 15:29:16', 'Purchase (2) added by User "gs" (7).', 'Purchase', 2, 'add', 7, 'sup_tanggal, pos_ting, date_of_purchase, warranty_date, kd_luar_tanggal, currency_id, no, delivery_order_id, po_no, po_id, supplier_id, warranty_name, warranty_year', NULL, NULL, NULL, NULL, NULL),
(212, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (32) added by User "gs" (7).', 'AssetDetail', 32, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(213, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (33) added by User "gs" (7).', 'AssetDetail', 33, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(214, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (34) added by User "gs" (7).', 'AssetDetail', 34, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(215, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (35) added by User "gs" (7).', 'AssetDetail', 35, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(216, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (36) added by User "gs" (7).', 'AssetDetail', 36, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(217, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (37) added by User "gs" (7).', 'AssetDetail', 37, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(218, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (38) added by User "gs" (7).', 'AssetDetail', 38, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(219, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (39) added by User "gs" (7).', 'AssetDetail', 39, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(220, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (40) added by User "gs" (7).', 'AssetDetail', 40, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(221, 'KURSI KERJA', '2011-07-07 15:29:16', 'AssetDetail "KURSI KERJA" (41) added by User "gs" (7).', 'AssetDetail', 41, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(222, 'BIF/002', '2011-07-07 15:29:16', 'DeliveryOrder "BIF/002" (3) updated by User "gs" (7).', 'DeliveryOrder', 3, 'edit', 7, 'convert_asset', NULL, NULL, NULL, NULL, NULL),
(223, '', '2011-07-07 15:29:44', 'Purchase (3) added by User "gs" (7).', 'Purchase', 3, 'add', 7, 'sup_tanggal, pos_ting, date_of_purchase, warranty_date, kd_luar_tanggal, currency_id, no, delivery_order_id, po_no, po_id, supplier_id, warranty_name, warranty_year', NULL, NULL, NULL, NULL, NULL),
(224, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:29:44', 'AssetDetail "DEKSTOP DELL OPTIPLEX" (42) added by User "gs" (7).', 'AssetDetail', 42, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(225, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:29:44', 'AssetDetail "DEKSTOP DELL OPTIPLEX" (43) added by User "gs" (7).', 'AssetDetail', 43, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(226, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:29:44', 'AssetDetail "DEKSTOP DELL OPTIPLEX" (44) added by User "gs" (7).', 'AssetDetail', 44, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(227, 'THIN CLIENT  ', '2011-07-07 15:29:44', 'AssetDetail "THIN CLIENT  " (45) added by User "gs" (7).', 'AssetDetail', 45, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(228, 'THIN CLIENT  ', '2011-07-07 15:29:44', 'AssetDetail "THIN CLIENT  " (46) added by User "gs" (7).', 'AssetDetail', 46, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(229, 'THIN CLIENT  ', '2011-07-07 15:29:44', 'AssetDetail "THIN CLIENT  " (47) added by User "gs" (7).', 'AssetDetail', 47, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(230, 'THIN CLIENT  ', '2011-07-07 15:29:44', 'AssetDetail "THIN CLIENT  " (48) added by User "gs" (7).', 'AssetDetail', 48, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(231, 'THIN CLIENT  ', '2011-07-07 15:29:44', 'AssetDetail "THIN CLIENT  " (49) added by User "gs" (7).', 'AssetDetail', 49, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(232, 'PRINTER EPSON LQ 2180', '2011-07-07 15:29:44', 'AssetDetail "PRINTER EPSON LQ 2180" (50) added by User "gs" (7).', 'AssetDetail', 50, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(233, 'PRINTER EPSON LQ 2180', '2011-07-07 15:29:44', 'AssetDetail "PRINTER EPSON LQ 2180" (51) added by User "gs" (7).', 'AssetDetail', 51, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(234, 'PRINTER EPSON LQ 2180', '2011-07-07 15:29:44', 'AssetDetail "PRINTER EPSON LQ 2180" (52) added by User "gs" (7).', 'AssetDetail', 52, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, warranty_name, warranty_year, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(235, 'TR.001', '2011-07-07 15:29:44', 'DeliveryOrder "TR.001" (2) updated by User "gs" (7).', 'DeliveryOrder', 2, 'edit', 7, 'convert_asset', NULL, NULL, NULL, NULL, NULL),
(236, 'KURSI KERJA', '2011-07-07 15:31:17', 'AssetDetail "KURSI KERJA" (1) updated by User "gs" (7).', 'AssetDetail', 1, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(237, 'KURSI KERJA', '2011-07-07 15:31:25', 'AssetDetail "KURSI KERJA" (2) updated by User "gs" (7).', 'AssetDetail', 2, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(238, 'KURSI KERJA', '2011-07-07 15:31:36', 'AssetDetail "KURSI KERJA" (3) updated by User "gs" (7).', 'AssetDetail', 3, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(239, 'KURSI KERJA', '2011-07-07 15:31:48', 'AssetDetail "KURSI KERJA" (4) updated by User "gs" (7).', 'AssetDetail', 4, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(240, 'KURSI KERJA', '2011-07-07 15:32:06', 'AssetDetail "KURSI KERJA" (5) updated by User "gs" (7).', 'AssetDetail', 5, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(241, 'KURSI KERJA', '2011-07-07 15:32:14', 'AssetDetail "KURSI KERJA" (6) updated by User "gs" (7).', 'AssetDetail', 6, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(242, 'KURSI KERJA', '2011-07-07 15:32:23', 'AssetDetail "KURSI KERJA" (7) updated by User "gs" (7).', 'AssetDetail', 7, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(243, 'KURSI KERJA', '2011-07-07 15:32:32', 'AssetDetail "KURSI KERJA" (8) updated by User "gs" (7).', 'AssetDetail', 8, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(244, 'KURSI KERJA', '2011-07-07 15:32:41', 'AssetDetail "KURSI KERJA" (9) updated by User "gs" (7).', 'AssetDetail', 9, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(245, 'KURSI KERJA', '2011-07-07 15:32:51', 'AssetDetail "KURSI KERJA" (10) updated by User "gs" (7).', 'AssetDetail', 10, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(246, 'KURSI KERJA', '2011-07-07 15:33:41', 'AssetDetail "KURSI KERJA" (32) updated by User "gs" (7).', 'AssetDetail', 32, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(247, 'KURSI KERJA', '2011-07-07 15:33:48', 'AssetDetail "KURSI KERJA" (33) updated by User "gs" (7).', 'AssetDetail', 33, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(248, 'KURSI KERJA', '2011-07-07 15:33:57', 'AssetDetail "KURSI KERJA" (34) updated by User "gs" (7).', 'AssetDetail', 34, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(249, 'KURSI KERJA', '2011-07-07 15:34:05', 'AssetDetail "KURSI KERJA" (35) updated by User "gs" (7).', 'AssetDetail', 35, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(250, 'KURSI KERJA', '2011-07-07 15:34:13', 'AssetDetail "KURSI KERJA" (36) updated by User "gs" (7).', 'AssetDetail', 36, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(251, 'KURSI KERJA', '2011-07-07 15:34:22', 'AssetDetail "KURSI KERJA" (37) updated by User "gs" (7).', 'AssetDetail', 37, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(252, 'KURSI KERJA', '2011-07-07 15:34:31', 'AssetDetail "KURSI KERJA" (38) updated by User "gs" (7).', 'AssetDetail', 38, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(253, 'KURSI KERJA', '2011-07-07 15:34:43', 'AssetDetail "KURSI KERJA" (39) updated by User "gs" (7).', 'AssetDetail', 39, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(254, 'KURSI KERJA', '2011-07-07 15:34:55', 'AssetDetail "KURSI KERJA" (40) updated by User "gs" (7).', 'AssetDetail', 40, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(255, 'KURSI KERJA', '2011-07-07 15:35:03', 'AssetDetail "KURSI KERJA" (40) updated by User "gs" (7).', 'AssetDetail', 40, 'edit', 7, 'serial_no', NULL, NULL, NULL, NULL, NULL),
(256, 'KURSI KERJA', '2011-07-07 15:35:13', 'AssetDetail "KURSI KERJA" (41) updated by User "gs" (7).', 'AssetDetail', 41, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(257, 'KURSI HADAP', '2011-07-07 15:36:05', 'AssetDetail "KURSI HADAP" (11) updated by User "gs" (7).', 'AssetDetail', 11, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(258, 'KURSI HADAP', '2011-07-07 15:36:12', 'AssetDetail "KURSI HADAP" (12) updated by User "gs" (7).', 'AssetDetail', 12, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(259, 'KURSI HADAP', '2011-07-07 15:36:19', 'AssetDetail "KURSI HADAP" (13) updated by User "gs" (7).', 'AssetDetail', 13, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(260, 'KURSI HADAP', '2011-07-07 15:36:28', 'AssetDetail "KURSI HADAP" (14) updated by User "gs" (7).', 'AssetDetail', 14, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(261, 'KURSI HADAP', '2011-07-07 15:36:37', 'AssetDetail "KURSI HADAP" (15) updated by User "gs" (7).', 'AssetDetail', 15, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(262, 'KURSI HADAP', '2011-07-07 15:36:45', 'AssetDetail "KURSI HADAP" (16) updated by User "gs" (7).', 'AssetDetail', 16, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(263, 'KURSI HADAP', '2011-07-07 15:36:53', 'AssetDetail "KURSI HADAP" (17) updated by User "gs" (7).', 'AssetDetail', 17, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(264, 'KURSI HADAP', '2011-07-07 15:37:01', 'AssetDetail "KURSI HADAP" (18) updated by User "gs" (7).', 'AssetDetail', 18, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(265, 'KURSI HADAP', '2011-07-07 15:37:10', 'AssetDetail "KURSI HADAP" (19) updated by User "gs" (7).', 'AssetDetail', 19, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(266, 'KURSI HADAP', '2011-07-07 15:37:18', 'AssetDetail "KURSI HADAP" (20) updated by User "gs" (7).', 'AssetDetail', 20, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(267, 'MEJA NASABAH', '2011-07-07 15:42:04', 'AssetDetail "MEJA NASABAH" (21) updated by User "gs" (7).', 'AssetDetail', 21, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(268, 'MEJA NASABAH', '2011-07-07 15:42:10', 'AssetDetail "MEJA NASABAH" (22) updated by User "gs" (7).', 'AssetDetail', 22, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(269, 'MEJA NASABAH', '2011-07-07 15:42:17', 'AssetDetail "MEJA NASABAH" (22) updated by User "gs" (7).', 'AssetDetail', 22, 'edit', 7, 'serial_no', NULL, NULL, NULL, NULL, NULL),
(270, 'MEJA NASABAH', '2011-07-07 15:42:23', 'AssetDetail "MEJA NASABAH" (23) updated by User "gs" (7).', 'AssetDetail', 23, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(271, 'MESIN TIK', '2011-07-07 15:42:52', 'AssetDetail "MESIN TIK" (24) updated by User "gs" (7).', 'AssetDetail', 24, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(272, 'MESIN TIK', '2011-07-07 15:42:58', 'AssetDetail "MESIN TIK" (25) updated by User "gs" (7).', 'AssetDetail', 25, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(273, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:44:08', 'AssetDetail "DEKSTOP DELL OPTIPLEX" (42) updated by User "gs" (7).', 'AssetDetail', 42, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(274, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:44:14', 'AssetDetail "DEKSTOP DELL OPTIPLEX" (43) updated by User "gs" (7).', 'AssetDetail', 43, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(275, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 15:44:21', 'AssetDetail "DEKSTOP DELL OPTIPLEX" (44) updated by User "gs" (7).', 'AssetDetail', 44, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(276, 'THIN CLIENT  ', '2011-07-07 15:45:02', 'AssetDetail "THIN CLIENT  " (45) updated by User "gs" (7).', 'AssetDetail', 45, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(277, 'THIN CLIENT  ', '2011-07-07 15:45:08', 'AssetDetail "THIN CLIENT  " (46) updated by User "gs" (7).', 'AssetDetail', 46, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(278, 'THIN CLIENT  ', '2011-07-07 15:45:14', 'AssetDetail "THIN CLIENT  " (47) updated by User "gs" (7).', 'AssetDetail', 47, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(279, 'THIN CLIENT  ', '2011-07-07 15:45:19', 'AssetDetail "THIN CLIENT  " (48) updated by User "gs" (7).', 'AssetDetail', 48, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(280, 'THIN CLIENT  ', '2011-07-07 15:45:27', 'AssetDetail "THIN CLIENT  " (49) updated by User "gs" (7).', 'AssetDetail', 49, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(281, 'KURSI KERJA', '2011-07-07 15:46:09', 'AssetDetail "KURSI KERJA" (26) updated by User "gs" (7).', 'AssetDetail', 26, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(282, 'KURSI KERJA', '2011-07-07 15:46:16', 'AssetDetail "KURSI KERJA" (27) updated by User "gs" (7).', 'AssetDetail', 27, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(283, 'KURSI KERJA', '2011-07-07 15:46:24', 'AssetDetail "KURSI KERJA" (28) updated by User "gs" (7).', 'AssetDetail', 28, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(284, 'KURSI KERJA', '2011-07-07 15:46:30', 'AssetDetail "KURSI KERJA" (29) updated by User "gs" (7).', 'AssetDetail', 29, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(285, 'KURSI KERJA', '2011-07-07 15:46:37', 'AssetDetail "KURSI KERJA" (30) updated by User "gs" (7).', 'AssetDetail', 30, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(286, 'MEJA KERJA', '2011-07-07 15:47:18', 'AssetDetail "MEJA KERJA" (31) updated by User "gs" (7).', 'AssetDetail', 31, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(287, 'PRINTER EPSON LQ 2180', '2011-07-07 15:47:36', 'AssetDetail "PRINTER EPSON LQ 2180" (50) updated by User "gs" (7).', 'AssetDetail', 50, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(288, 'PRINTER EPSON LQ 2180', '2011-07-07 15:47:43', 'AssetDetail "PRINTER EPSON LQ 2180" (51) updated by User "gs" (7).', 'AssetDetail', 51, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(289, 'PRINTER EPSON LQ 2180', '2011-07-07 15:47:51', 'AssetDetail "PRINTER EPSON LQ 2180" (52) updated by User "gs" (7).', 'AssetDetail', 52, 'edit', 7, 'location_id, serial_no', NULL, NULL, NULL, NULL, NULL),
(290, 'PRINTER EPSON LQ 2180', '2011-07-07 15:47:51', 'AssetDetail "PRINTER EPSON LQ 2180" (52) updated by User "gs" (7).', 'AssetDetail', 52, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(291, 'MovementDetail (1)', '2011-07-07 16:00:37', 'MovementDetail (1) added by User "fa_management" (15).', 'MovementDetail', 1, 'add', 15, 'movement_id, npb_detail_id, asset_detail_id, asset_category_id, price, book_value, accum_dep, code, name, date_of_purchase', NULL, NULL, NULL, NULL, NULL),
(292, 'MovementDetail (2)', '2011-07-07 16:02:27', 'MovementDetail (2) added by User "fa_management" (15).', 'MovementDetail', 2, 'add', 15, 'movement_id, npb_detail_id, asset_detail_id, asset_category_id, price, book_value, accum_dep, code, name, date_of_purchase', NULL, NULL, NULL, NULL, NULL),
(293, 'MR-021-11-0001', '2011-07-07 16:02:27', 'Npb "MR-021-11-0001" (3) updated by User "fa_management" (15).', 'Npb', 3, 'edit', 15, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(294, 'MEJA KERJA', '2011-07-07 16:10:47', 'AssetDetail "MEJA KERJA" (31) added by System.', 'AssetDetail', 31, 'add', NULL, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, code, asset_id, asset_category_id, purchase_id, location_id, department_id, business_type_id, cost_center_id, warranty_name, warranty_year, name, item_code, color, brand, type, ada, umurek, maksi, date_start, serial_no, year, invoice_id, delivery_order_id, delivery_order_detail_id, po_id, accepted_datetime', NULL, NULL, NULL, NULL, NULL),
(295, 'KURSI HADAP', '2011-07-07 16:10:58', 'AssetDetail "KURSI HADAP" (11) added by System.', 'AssetDetail', 11, 'add', NULL, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, accept, code, asset_id, asset_category_id, purchase_id, location_id, department_id, business_type_id, cost_center_id, warranty_name, warranty_year, name, item_code, color, brand, type, ada, umurek, maksi, date_start, serial_no, year, invoice_id, delivery_order_id, delivery_order_detail_id, po_id, accepted_datetime', NULL, NULL, NULL, NULL, NULL),
(296, 'KURSI KERJA', '2011-07-07 16:13:35', 'InvoiceDetail "KURSI KERJA" (1) added by System.', 'InvoiceDetail', 1, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(297, 'KURSI HADAP', '2011-07-07 16:13:35', 'InvoiceDetail "KURSI HADAP" (2) added by System.', 'InvoiceDetail', 2, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(298, 'MEJA NASABAH', '2011-07-07 16:13:35', 'InvoiceDetail "MEJA NASABAH" (3) added by System.', 'InvoiceDetail', 3, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(299, 'MESIN TIK', '2011-07-07 16:13:35', 'InvoiceDetail "MESIN TIK" (4) added by System.', 'InvoiceDetail', 4, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(300, 'KURSI KERJA', '2011-07-07 16:13:35', 'InvoiceDetail "KURSI KERJA" (5) added by System.', 'InvoiceDetail', 5, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(301, 'MEJA KERJA', '2011-07-07 16:13:35', 'InvoiceDetail "MEJA KERJA" (6) added by System.', 'InvoiceDetail', 6, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(302, 'KURSI KERJA', '2011-07-07 16:13:35', 'InvoiceDetail "KURSI KERJA" (7) added by System.', 'InvoiceDetail', 7, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(303, 'KURSI HADAP', '2011-07-07 16:13:35', 'InvoiceDetail "KURSI HADAP" (8) added by System.', 'InvoiceDetail', 8, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(304, 'MEJA NASABAH', '2011-07-07 16:13:35', 'InvoiceDetail "MEJA NASABAH" (9) added by System.', 'InvoiceDetail', 9, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(305, 'MESIN TIK', '2011-07-07 16:13:35', 'InvoiceDetail "MESIN TIK" (10) added by System.', 'InvoiceDetail', 10, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(306, 'KURSI KERJA', '2011-07-07 16:13:35', 'InvoiceDetail "KURSI KERJA" (11) added by System.', 'InvoiceDetail', 11, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(307, 'MEJA KERJA', '2011-07-07 16:13:35', 'InvoiceDetail "MEJA KERJA" (12) added by System.', 'InvoiceDetail', 12, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(308, 'InvoicePayment (1)', '2011-07-07 16:13:35', 'InvoicePayment (1) added by System.', 'InvoicePayment', 1, 'add', NULL, 'is_posted, no, term_no, term_percent, date_due, amount_due, amount_invoice, amount_paid, description, po_id, invoice_id, po_payment_id', NULL, NULL, NULL, NULL, NULL),
(309, 'DEKSTOP DELL OPTIPLEX', '2011-07-07 17:05:51', 'InvoiceDetail "DEKSTOP DELL OPTIPLEX" (13) added by System.', 'InvoiceDetail', 13, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(310, 'THIN CLIENT  ', '2011-07-07 17:05:51', 'InvoiceDetail "THIN CLIENT  " (14) added by System.', 'InvoiceDetail', 14, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(311, 'PRINTER EPSON LQ 2180', '2011-07-07 17:05:51', 'InvoiceDetail "PRINTER EPSON LQ 2180" (15) added by System.', 'InvoiceDetail', 15, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, color, brand, type, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(312, 'InvoicePayment (2)', '2011-07-07 17:05:52', 'InvoicePayment (2) added by System.', 'InvoicePayment', 2, 'add', NULL, 'is_posted, no, term_no, term_percent, date_due, amount_due, amount_invoice, amount_paid, description, po_id, invoice_id, po_payment_id', NULL, NULL, NULL, NULL, NULL),
(313, 'BCA a/c:123456 a/n:Ujang Rp', '2011-07-07 17:08:33', 'BankAccount (1) added by User "fincon" (9).', 'BankAccount', 1, 'add', 9, 'bank_name, bank_account_no, bank_account_name, bank_account_type_id, currency_id, supplier_id', NULL, NULL, NULL, NULL, NULL),
(314, 'InvoicePayment (3)', '2011-07-07 17:08:56', 'InvoicePayment (3) added by User "fincon" (9).', 'InvoicePayment', 3, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(315, 'InvoicePayment (3)', '2011-07-07 17:09:08', 'InvoicePayment (3) deleted by User "fincon" (9).', 'InvoicePayment', 3, 'delete', 9, NULL, NULL, NULL, NULL, NULL, NULL),
(316, 'InvoicePayment (4)', '2011-07-07 17:09:47', 'InvoicePayment (4) added by User "fincon" (9).', 'InvoicePayment', 4, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(317, 'InvoicePayment (4)', '2011-07-07 17:17:11', 'InvoicePayment (4) deleted by User "fincon" (9).', 'InvoicePayment', 4, 'delete', 9, NULL, NULL, NULL, NULL, NULL, NULL),
(318, 'InvoicePayment (1)', '2011-07-07 17:17:17', 'InvoicePayment (1) deleted by User "fincon" (9).', 'InvoicePayment', 1, 'delete', 9, NULL, NULL, NULL, NULL, NULL, NULL),
(319, 'InvoicePayment (5)', '2011-07-07 17:17:29', 'InvoicePayment (5) added by User "fincon" (9).', 'InvoicePayment', 5, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(320, 'Rabobank a/c:76492023 a/n:Asep Gugur Rp', '2011-07-07 17:19:35', 'BankAccount (2) added by User "fincon" (9).', 'BankAccount', 2, 'add', 9, 'bank_name, bank_account_no, bank_account_name, bank_account_type_id, currency_id, supplier_id', NULL, NULL, NULL, NULL, NULL),
(321, 'InvoicePayment (6)', '2011-07-07 17:19:46', 'InvoicePayment (6) added by User "fincon" (9).', 'InvoicePayment', 6, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(322, 'JournalTransaction (1)', '2011-07-07 17:22:56', 'JournalTransaction (1) added by User "fincon" (9).', 'JournalTransaction', 1, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(323, 'JournalTransaction (2)', '2011-07-07 17:22:56', 'JournalTransaction (2) added by User "fincon" (9).', 'JournalTransaction', 2, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(324, 'JournalTransaction (3)', '2011-07-07 17:22:56', 'JournalTransaction (3) added by User "fincon" (9).', 'JournalTransaction', 3, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(325, 'JournalTransaction (4)', '2011-07-07 17:22:56', 'JournalTransaction (4) added by User "fincon" (9).', 'JournalTransaction', 4, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(326, 'JournalTransaction (5)', '2011-07-07 17:22:56', 'JournalTransaction (5) added by User "fincon" (9).', 'JournalTransaction', 5, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(327, 'JournalTransaction (6)', '2011-07-07 17:22:56', 'JournalTransaction (6) added by User "fincon" (9).', 'JournalTransaction', 6, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(328, 'JournalTransaction (7)', '2011-07-07 17:22:56', 'JournalTransaction (7) added by User "fincon" (9).', 'JournalTransaction', 7, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(329, 'JournalTransaction (8)', '2011-07-07 17:22:56', 'JournalTransaction (8) added by User "fincon" (9).', 'JournalTransaction', 8, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(330, 'JournalTransaction (9)', '2011-07-07 17:22:56', 'JournalTransaction (9) added by User "fincon" (9).', 'JournalTransaction', 9, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(331, 'JournalTransaction (10)', '2011-07-07 17:22:56', 'JournalTransaction (10) added by User "fincon" (9).', 'JournalTransaction', 10, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(332, 'JournalTransaction (11)', '2011-07-07 17:22:56', 'JournalTransaction (11) added by User "fincon" (9).', 'JournalTransaction', 11, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(333, 'JournalTransaction (12)', '2011-07-07 17:22:56', 'JournalTransaction (12) added by User "fincon" (9).', 'JournalTransaction', 12, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(334, 'JournalTransaction (13)', '2011-07-07 17:22:56', 'JournalTransaction (13) added by User "fincon" (9).', 'JournalTransaction', 13, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(335, 'JournalTransaction (14)', '2011-07-07 17:22:56', 'JournalTransaction (14) added by User "fincon" (9).', 'JournalTransaction', 14, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(336, 'JournalTransaction (15)', '2011-07-07 17:22:56', 'JournalTransaction (15) added by User "fincon" (9).', 'JournalTransaction', 15, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(337, 'JournalTransaction (16)', '2011-07-07 17:22:56', 'JournalTransaction (16) added by User "fincon" (9).', 'JournalTransaction', 16, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(338, 'JournalTransaction (17)', '2011-07-07 17:22:56', 'JournalTransaction (17) added by User "fincon" (9).', 'JournalTransaction', 17, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(339, 'JournalTransaction (18)', '2011-07-07 17:22:56', 'JournalTransaction (18) added by User "fincon" (9).', 'JournalTransaction', 18, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `help` varchar(50) DEFAULT NULL,
  `urutan` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `urutan` (`urutan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=441 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES
(75, NULL, 'Invoice', '#', '', 20),
(2, 78, 'Disposal', '', '', 20),
(3, NULL, 'Master Data', '#', '', 200),
(4, NULL, 'Reports', '#', '', 100),
(24, 3, 'Asset Item Category', '/asset_categories', '', 110),
(7, 3, 'Warranty', '/warranties', '', 70),
(8, 3, 'Branch', '/departments', '', 80),
(9, 3, 'Requesters', '/requesters', '', 90),
(10, 3, 'Locations', '/locations', '', 100),
(117, 113, 'Depreciation Recap', '/asset_details/reports/rekap', '', 110),
(13, 113, 'Monthly Depreciation Report', '/assets/reports/depr', '', 10),
(78, NULL, 'Fixed Assets', '#', '', 40),
(74, 72, 'New PO', '/pos/po_type', '', NULL),
(81, 80, 'New FA Transfer', '/movements/add', '', 30),
(28, NULL, 'Sys Admin', '#', '', 500),
(29, 28, 'Backup Database', '/admins/backup', '', 60),
(30, 28, 'Restote Database', '/admins/restore', '', 70),
(77, 75, 'List Invoice', '/invoices/index', '', 20),
(103, 2, 'New Disposal Sales', '/disposals/add/2', '', 94),
(69, 68, 'List MR', '/npbs/index', '', 1),
(70, 68, 'Add New MR', '/npbs/add', '', 0),
(72, NULL, 'PO', '#', '', 10),
(73, 72, 'List PO', '/pos/index', '', NULL),
(68, NULL, 'MR', '#', '', 0),
(38, 78, 'Labelling', '/asset_details/label', '', 185),
(39, 113, 'Monthly Detail Depreciation Report', '/asset_details/reports/depr', '', 20),
(115, 113, 'Transfer Report', '/movement_details/reports/fa', '', 90),
(102, 2, 'New Disposal Write Off', '/disposals/add/1', '', 84),
(145, 144, 'Stock Movement Report', '/inventory_ledgers/movement_report', '', 235),
(80, 78, 'FA Transfer', '#', '', 10),
(49, 4, 'Supplier History', '/suppliers/history', '', 200),
(200, 79, 'Stock List', '/stocks/index', NULL, 130),
(82, 80, 'List FA Transfers', '/movements/index', '', 25),
(79, NULL, 'Stock', '#', '', 60),
(111, 75, 'Outstanding Report', '/invoices/report/outstanding', '', 30),
(112, 75, 'Finish Report', '/invoices/report/finish', '', 40),
(113, 4, 'Fixed Assets', '#', '', 40),
(114, 113, 'Detail Report', '/asset_details/reports/detail_fa', '', 50),
(58, 4, 'Find Asset', '/assets/find', '', 197),
(76, 75, 'New Invoice', '/invoices/add', '', 10),
(62, 28, 'User Management', '/users', '', 52),
(63, 28, 'Menus Management', '/menus', '', 53),
(64, 28, 'Group & Permission Management', '/groups', '', 54),
(66, 78, 'Physical Check', '/asset_details/check', '', 186),
(67, 3, 'Currency Rate', 'finance-currency.php', NULL, 112),
(85, NULL, 'Journal', '#', '', 30),
(86, 85, 'List Journal Transaction', '/journal_transactions', '', NULL),
(87, 3, 'GL Journal', '', '', 10),
(88, 87, 'Templates', '/journal_templates/index', '', 10),
(89, 68, 'Outstanding Report', '/npbs/npb_report/outstanding', '', 50),
(90, 68, 'Finish Report', '/npbs/npb_report/finish', '', 60),
(101, 2, 'List Disposal Sales', '/disposals/index/2', '', 79),
(100, 2, 'List Disposal Write Off', '/disposals/index/1', '', 67),
(91, 3, 'GL Accounts', '/accounts', '', 20),
(92, 3, 'Supplier', '/suppliers', '', 30),
(93, 3, 'Currency', '/currencies', '', 100),
(94, 3, 'Items', '/items', '', 110),
(96, 3, 'MR Status', '/npb_statuses', '', 130),
(97, 3, 'PO Status', '/po_statuses', '', 140),
(98, 28, 'System Configuration', '/configs', '', 10),
(99, 87, 'Journal Group', '/journal_groups', '', 20),
(116, 113, ' Register Report', '/asset_details/reports/purchase', '', 70),
(104, 72, 'Outstanding Report', '/pos/po_report/outstanding', '', 30),
(105, 72, 'Finish Report', '/pos/po_report/finish', '', 40),
(106, 78, 'Register', '#', '', 0),
(107, 106, 'New FA Register', '/purchases/add', '', 10),
(108, 106, 'List FA Register', '/purchases', '', 20),
(109, 78, 'List Assets', '/assets/', '', 10),
(110, 113, 'Process Depreciation', '/assets/process', '', 0),
(144, 4, 'Stock', '#', '', 230),
(143, 79, 'Stock Status', '/items/item_status', '', 393),
(142, 113, 'Montly Depreciation Recap', '/asset_details/reports/monthly_rekap', '', 120),
(141, 113, 'Movement Report', '/asset_details/reports/movement', '', 200),
(122, 4, 'PO', '#', '', 20),
(123, 4, 'MR', '#', '', 10),
(124, 4, 'Invoice', '#', '', 30),
(125, 122, 'Outstanding Report', '/pos/po_report/outstanding', '', 10),
(126, 122, 'Finish Report', '/pos/po_report/finish', '', 20),
(127, 123, 'Outstanding Report', '/npbs/npb_report/outstanding', '', 10),
(128, 123, 'Finish Report', '/npbs/npb_report/finish', '', 20),
(129, 124, 'Outstanding Report', '/invoices/report/outstanding', '', 10),
(130, 124, 'Finish Report', '/invoices/report/finish', '', 20),
(131, 79, 'Stock Inlog', '#', '', 447),
(132, 79, 'Stock Outlog', '#', '', 451),
(133, 131, 'New Stock Inlog', '/inlogs/add', '', 353),
(134, 131, 'List Stock Inlog', '/inlogs/index', '', 359),
(136, 132, 'New Stock Outlog', '/outlogs/add', '', 366),
(137, 132, 'List Stock Outlog', '/outlogs/index', '', 373),
(138, 79, 'Stock Ledger', '#', '', 456),
(139, 138, 'Procces Stock Ledger', '/inventory_ledgers/process_inv', '', 384),
(140, 138, 'Stock Ledger List', '/inventory_ledgers/index', '', 389),
(152, 3, 'Category Type', '/asset_category_types', '', 177),
(146, 3, 'FA Transfer Status', '/movement_statuses', '', 150),
(147, 3, 'Disposal Status', '/disposal_statuses', '', 160),
(148, 3, 'Unit Item', '/units', '', 170),
(149, 144, 'Stock Report', '/inventory_ledgers/stock_report', '', 241),
(150, 144, 'Stock Inlog Report', '/inventory_ledgers/in_recap_report', '', 242),
(151, 144, 'Stock Outlog Report', '/inventory_ledgers/out_recap_report', '', 243),
(154, 72, 'List DO', '/delivery_orders/list_delivery_order', '', 100),
(155, 78, 'Find Asset', '/assets/find', NULL, 13),
(210, 79, 'New Stock Retur', '/returs/add', NULL, 150),
(220, 79, 'List Stock Retur', '/returs/index', NULL, 160),
(250, 79, 'New Stock Usage', '/usages/add', NULL, 200),
(260, 79, 'List Stock Usage', '/usages/index', NULL, 210),
(360, 79, 'New Supplier Retur', '/supplier_returs/add', NULL, 150),
(370, 79, 'List Supplier Retur', '/supplier_returs/index', NULL, 160),
(371, 28, 'Logs', '/logs', NULL, 525),
(373, 78, 'List Asset Detail', '/asset_details', NULL, 11),
(374, NULL, 'USER', '#', NULL, 800),
(375, 374, 'Profile', '/users/change_password', NULL, 805),
(400, 122, 'Item Receive Report', '/delivery_order_details/receive_report', NULL, 13),
(410, 122, 'Item Order Report', '/po_details/order_report', NULL, 11),
(420, 113, 'FA Sales Report', '/disposal_details/sales_report', NULL, 1100),
(430, 113, 'FA Write Off Report', '/disposal_details/write_off_report', NULL, 1200),
(440, 106, 'Import Assets', '/asset_details/import', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
CREATE TABLE IF NOT EXISTS `movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_date` date NOT NULL,
  `no` varchar(10) NOT NULL,
  `source_department_id` char(11) DEFAULT NULL,
  `source_department_sub_id` char(11) DEFAULT NULL,
  `source_department_unit_id` char(11) DEFAULT NULL,
  `source_business_type_id` int(11) DEFAULT NULL,
  `source_cost_center_id` int(11) DEFAULT NULL,
  `dest_department_id` char(11) DEFAULT NULL,
  `dest_department_sub_id` char(11) DEFAULT NULL,
  `dest_department_unit_id` char(11) DEFAULT NULL,
  `dest_business_type_id` int(11) DEFAULT NULL,
  `dest_cost_center_id` int(11) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `movement_status_id` varchar(40) NOT NULL,
  `request_type_id` int(11) DEFAULT NULL,
  `npb_id` int(11) DEFAULT NULL,
  `posting` tinyint(1) NOT NULL,
  `reject_notes` text NOT NULL,
  `reject_by` varchar(50) NOT NULL,
  `reject_date` datetime NOT NULL,
  `cancel_notes` text NOT NULL,
  `cancel_by` varchar(50) NOT NULL,
  `cancel_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `doc_date` (`doc_date`,`created_by`,`movement_status_id`),
  KEY `posting` (`posting`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `movements`
--

INSERT INTO `movements` (`id`, `doc_date`, `no`, `source_department_id`, `source_department_sub_id`, `source_department_unit_id`, `source_business_type_id`, `source_cost_center_id`, `dest_department_id`, `dest_department_sub_id`, `dest_department_unit_id`, `dest_business_type_id`, `dest_cost_center_id`, `created_by`, `notes`, `movement_status_id`, `request_type_id`, `npb_id`, `posting`, `reject_notes`, `reject_by`, `reject_date`, `cancel_notes`, `cancel_by`, `cancel_date`) VALUES
(1, '2011-07-07', 'MOV-0001', '5', NULL, NULL, 2, 1, '2', NULL, NULL, 2, 1, 'famanagement', '', '8', 2, 1, 0, '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00'),
(2, '2011-07-07', 'MOV-0002', '2', NULL, NULL, 2, 1, '5', NULL, NULL, 2, 1, 'famanagement', '', '8', 2, 3, 0, '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `movement_details`
--

DROP TABLE IF EXISTS `movement_details`;
CREATE TABLE IF NOT EXISTS `movement_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movement_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `asset_detail_id` int(11) NOT NULL,
  `npb_detail_id` int(11) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date_of_purchase` date NOT NULL,
  `notes` text NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `book_value` decimal(20,2) NOT NULL,
  `accum_dep` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movement_id` (`movement_id`,`asset_detail_id`),
  KEY `asset_category_id` (`asset_category_id`),
  KEY `date_of_purchase` (`date_of_purchase`),
  KEY `npb_detail_id` (`npb_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `movement_details`
--

INSERT INTO `movement_details` (`id`, `movement_id`, `asset_category_id`, `asset_detail_id`, `npb_detail_id`, `code`, `name`, `date_of_purchase`, `notes`, `price`, `book_value`, `accum_dep`) VALUES
(1, 1, 8, 31, 3, 'IN1-2011-021-1-001', 'MEJA KERJA', '2011-07-07', '', '6600000.00', '0.00', '0.00'),
(2, 2, 9, 11, 9, 'IN2-2011-012-2-001', 'KURSI HADAP', '2011-07-07', '', '1650000.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `movement_statuses`
--

DROP TABLE IF EXISTS `movement_statuses`;
CREATE TABLE IF NOT EXISTS `movement_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `movement_statuses`
--

INSERT INTO `movement_statuses` (`id`, `name`) VALUES
(1, 'New'),
(2, 'Request For Approval'),
(3, 'Approved by Supervisor'),
(4, 'Approved by Fincon'),
(5, 'Reject'),
(6, 'Finish'),
(7, 'Journal Posted'),
(8, 'Processed');

-- --------------------------------------------------------

--
-- Table structure for table `mutations`
--

DROP TABLE IF EXISTS `mutations`;
CREATE TABLE IF NOT EXISTS `mutations` (
  `id` varchar(8) NOT NULL DEFAULT '',
  `id_asset_detail` varchar(40) DEFAULT NULL,
  `id_location` char(3) DEFAULT NULL,
  `id_department` char(3) DEFAULT NULL,
  `id_location_baru` char(3) DEFAULT NULL,
  `id_department_baru` char(3) DEFAULT NULL,
  `doc_date` date DEFAULT NULL,
  `alasan` text,
  `serial_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mutations_FKIndex1` (`id_asset_detail`),
  KEY `mutations_FKIndex2` (`id_department`),
  KEY `mutations_FKIndex3` (`id_location`),
  KEY `mutations_FKIndex4` (`id_location_baru`),
  KEY `mutations_FKIndex5` (`id_department_baru`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutations`
--


-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `isi` text,
  `submit_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_FKIndex1` (`submit_by`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `npbs`
--

DROP TABLE IF EXISTS `npbs`;
CREATE TABLE IF NOT EXISTS `npbs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(20) NOT NULL,
  `npb_date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_sub_id` int(11) NOT NULL,
  `department_unit_id` int(11) NOT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `req_date` date NOT NULL,
  `npb_status_id` int(11) NOT NULL,
  `request_type_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reject_notes` text NOT NULL,
  `reject_by` varchar(50) NOT NULL,
  `reject_date` datetime NOT NULL,
  `cancel_notes` text NOT NULL,
  `cancel_by` varchar(50) NOT NULL,
  `cancel_date` datetime NOT NULL,
  `is_purchase_request` tinyint(1) NOT NULL DEFAULT '0',
  `date_finish` datetime DEFAULT NULL,
  `is_printed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_department` (`department_id`,`req_date`,`npb_status_id`,`created_by`,`created_date`),
  KEY `id_supplier` (`supplier_id`),
  KEY `reject_by` (`reject_by`,`reject_date`),
  KEY `npb_type_id` (`request_type_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `npbs`
--

INSERT INTO `npbs` (`id`, `no`, `npb_date`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `supplier_id`, `req_date`, `npb_status_id`, `request_type_id`, `notes`, `created_by`, `created_date`, `reject_notes`, `reject_by`, `reject_date`, `cancel_notes`, `cancel_by`, `cancel_date`, `is_purchase_request`, `date_finish`, `is_printed`) VALUES
(1, 'MR-012-11-0001', '2011-07-07', 2, 0, 0, 2, 1, 0, '2011-07-07', 50, 2, 'cabang raden saleh', 'cabang1', '2011-07-07 14:54:50', '', '', '0000-00-00 00:00:00', 'pemesana kursi kerja 25 bh di setujui 20 bh', 'heri1', '2011-07-07 14:31:42', 0, NULL, 0),
(2, 'MR-012-11-0002', '2011-07-07', 2, 0, 0, 2, 1, 0, '2011-07-07', 100, 1, 'cabang raden saleh test IT', 'cabang1', '2011-07-07 14:52:50', '', '', '0000-00-00 00:00:00', 'THIN CLIENT  5 bh yang di setujui 3bh mohon di edit kembali', 'heri1', '2011-07-07 14:35:59', 0, '2011-07-07 15:16:12', 1),
(3, 'MR-021-11-0001', '2011-07-07', 5, 0, 0, 2, 1, 0, '2011-07-07', 100, 2, 'cabang Cipinang test Gerenal Item', 'cabang2', '2011-07-07 14:55:16', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-07-07 16:02:27', 0),
(4, 'MR-021-11-0002', '2011-07-07', 5, 0, 0, 2, 1, 0, '2011-07-07', 100, 1, 'cabang cipinang test IT', 'cabang2', '2011-07-07 14:53:46', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-07-07 15:16:12', 1),
(5, 'MR-010-11-0001', '2011-07-07', 1, 0, 0, 2, 1, 0, '2011-07-07', 50, 2, 'cabang Abdul Muis test barang general', 'cabang3', '2011-07-07 14:55:35', '', '', '0000-00-00 00:00:00', 'mohon di check kembali', 'heri3', '2011-07-07 14:41:35', 0, NULL, 0),
(6, 'MR-010-11-0002', '2011-07-07', 1, 0, 0, 2, 1, 0, '2011-07-07', 50, 1, 'cabang abdul muis test barang IT', 'cabang3', '2011-07-07 14:54:30', '', '', '0000-00-00 00:00:00', 'check lagi', 'heri3', '2011-07-07 14:43:28', 0, NULL, 1),
(8, 'MR-010-11-0003', '2011-07-07', 1, 0, 0, 2, 1, 0, '2011-07-07', 8, 2, 'cabang abdul muis test barang general 2', 'cabang3', '2011-07-07 14:47:47', 'maaf tidak di setujui', 'heri3', '2011-07-07 14:47:15', '', '', '0000-00-00 00:00:00', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `npbs_pos`
--

DROP TABLE IF EXISTS `npbs_pos`;
CREATE TABLE IF NOT EXISTS `npbs_pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npb_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `npbs.id` (`npb_id`,`po_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `npbs_pos`
--

INSERT INTO `npbs_pos` (`id`, `npb_id`, `po_id`) VALUES
(2, 3, 1),
(1, 1, 1),
(3, 2, 2),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `npb_details`
--

DROP TABLE IF EXISTS `npb_details`;
CREATE TABLE IF NOT EXISTS `npb_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npb_id` int(11) NOT NULL,
  `po_id` int(11) DEFAULT NULL,
  `movement_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `color` varchar(64) DEFAULT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `fulfillment_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `price_cur` decimal(20,0) NOT NULL DEFAULT '0',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `currency_id` int(11) NOT NULL DEFAULT '1',
  `rp_rate` decimal(20,2) NOT NULL,
  `descr` varchar(200) DEFAULT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_net` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_net_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `date_finish` date NOT NULL,
  `qty_filled` int(11) DEFAULT '0',
  `qty_unfilled` int(11) DEFAULT '0',
  `unit_id` int(11) DEFAULT '0',
  `outlog_id` int(11) DEFAULT NULL,
  `process_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_npb` (`npb_id`,`item_id`,`currency_id`),
  KEY `id_po` (`po_id`),
  KEY `fulfillment_id` (`fulfillment_id`),
  KEY `movement_id` (`movement_id`),
  KEY `date_finish` (`date_finish`),
  KEY `outlog_idx` (`outlog_id`),
  KEY `process_type_id` (`process_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `npb_details`
--

INSERT INTO `npb_details` (`id`, `npb_id`, `po_id`, `movement_id`, `item_id`, `color`, `brand`, `type`, `fulfillment_id`, `qty`, `price`, `price_cur`, `amount`, `amount_cur`, `currency_id`, `rp_rate`, `descr`, `discount`, `discount_cur`, `amount_net`, `amount_net_cur`, `date_finish`, `qty_filled`, `qty_unfilled`, `unit_id`, `outlog_id`, `process_type_id`) VALUES
(18, 1, 1, NULL, 34, '', 'BIF', 'MJ007', 0, 20, '0.00', '750000', '0.00', '15000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 20, 0, 2, NULL, 2),
(2, 1, 1, NULL, 35, '', 'BIF', 'KR002', 0, 10, '0.00', '1500000', '0.00', '15000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 10, 0, 2, NULL, 2),
(3, 1, NULL, 1, 36, '', 'LIGNA', 'MJ007', 0, 2, '0.00', '6750000', '0.00', '13500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 1, 2, NULL, 1),
(4, 1, 1, NULL, 37, '', 'LIGNA', 'MJ001', 0, 3, '0.00', '9500000', '0.00', '28500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 3, 0, 2, NULL, 2),
(5, 1, 1, NULL, 38, '', 'Brother', 'MS01', 0, 2, '0.00', '1250000', '0.00', '2500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 2, 0, 2, NULL, 2),
(7, 2, 2, NULL, 22, '', 'ITONA', 'T3851', 0, 5, '0.00', '4500000', '0.00', '22500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 5, 0, 2, NULL, 2),
(8, 3, 1, NULL, 34, '', 'BIF', 'KR001', 0, 5, '0.00', '750000', '0.00', '3750000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 5, 0, 2, NULL, 2),
(9, 3, NULL, 2, 35, '', 'BIF', 'KR002', 0, 1, '0.00', '1500000', '0.00', '1500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 2, NULL, 1),
(10, 3, 1, NULL, 36, '', 'LIGNA', 'MJ007', 0, 1, '0.00', '6750000', '0.00', '6750000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 1, 0, 2, NULL, 2),
(11, 4, 2, NULL, 24, '', 'Epson', 'LQ2180', 0, 3, '0.00', '51000000', '0.00', '153000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 3, 0, 2, NULL, 2),
(12, 5, NULL, NULL, 43, 'Putih', '', '', 0, 1, '0.00', '3500000', '0.00', '3500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, 2),
(13, 5, NULL, NULL, 44, 'hitam', '', '', 0, 1, '0.00', '500000000', '0.00', '500000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, 2),
(14, 6, NULL, NULL, 264, '', '', '', 0, 5, '0.00', '400000', '0.00', '2000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 3, NULL, 2),
(15, 6, NULL, NULL, 358, '', '', '', 0, 2, '0.00', '668000', '0.00', '1336000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 3, NULL, 2),
(16, 8, NULL, NULL, 43, 'putih', '', '', 0, 1, '0.00', '3500000', '0.00', '3500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, NULL),
(17, 8, NULL, NULL, 44, 'hitam', '', '', 0, 1, '0.00', '500000000', '0.00', '500000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, NULL),
(19, 2, 2, NULL, 20, '', 'Dell', 'GX280', 0, 3, '0.00', '2750000', '0.00', '8250000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '2011-07-07', 3, 0, 2, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `npb_fulfillments`
--

DROP TABLE IF EXISTS `npb_fulfillments`;
CREATE TABLE IF NOT EXISTS `npb_fulfillments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `descr` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `npb_fulfillments`
--

INSERT INTO `npb_fulfillments` (`id`, `name`, `descr`) VALUES
(1, 'Procurement', '0'),
(2, 'Movement', '0');

-- --------------------------------------------------------

--
-- Table structure for table `npb_statuses`
--

DROP TABLE IF EXISTS `npb_statuses`;
CREATE TABLE IF NOT EXISTS `npb_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `npb_statuses`
--

INSERT INTO `npb_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Approved by Branch Head'),
(3, 'Sent to Branch Head'),
(4, 'Reject'),
(5, 'Sent to FA Management'),
(6, 'Sent to IT Management'),
(7, 'Sent to GS'),
(8, 'Archive'),
(9, 'Sent to Stock Management'),
(10, 'Approved by IT Manager'),
(11, 'Processed by Stock Manager '),
(20, 'Sent to Stock Supervisor'),
(30, 'Approved by Stock Supervisor'),
(40, 'Movement'),
(50, 'Processing'),
(100, 'Done'),
(120, 'Sent to GS Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `npb_suppliers`
--

DROP TABLE IF EXISTS `npb_suppliers`;
CREATE TABLE IF NOT EXISTS `npb_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npb_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_npb` (`npb_id`,`supplier_id`),
  KEY `selected` (`selected`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `npb_suppliers`
--


-- --------------------------------------------------------

--
-- Table structure for table `outlogs`
--

DROP TABLE IF EXISTS `outlogs`;
CREATE TABLE IF NOT EXISTS `outlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `npb_id` int(11) DEFAULT NULL,
  `is_process` tinyint(1) DEFAULT '0',
  `is_printed` tinyint(1) DEFAULT '0',
  `outlog_status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `npb_idx` (`npb_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`),
  KEY `outlog_status_idx` (`outlog_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `outlogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `outlog_details`
--

DROP TABLE IF EXISTS `outlog_details`;
CREATE TABLE IF NOT EXISTS `outlog_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outlog_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `outlog_id` (`outlog_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outlog_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `outlog_statuses`
--

DROP TABLE IF EXISTS `outlog_statuses`;
CREATE TABLE IF NOT EXISTS `outlog_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `outlog_statuses`
--

INSERT INTO `outlog_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Sent to Supervisor'),
(3, 'Approved'),
(4, 'Reject'),
(5, 'Archive'),
(6, 'Finish'),
(7, 'Processed');

-- --------------------------------------------------------

--
-- Table structure for table `pajak`
--

DROP TABLE IF EXISTS `pajak`;
CREATE TABLE IF NOT EXISTS `pajak` (
  `kelas` char(2) NOT NULL DEFAULT '',
  `tarif` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pajak`
--


-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `tgawal` date NOT NULL DEFAULT '0000-00-00',
  `tgakhir` date NOT NULL DEFAULT '0000-00-00',
  `bulan` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`tgawal`, `tgakhir`, `bulan`) VALUES
('2005-06-01', '0000-00-00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

DROP TABLE IF EXISTS `pos`;
CREATE TABLE IF NOT EXISTS `pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(10) NOT NULL,
  `po_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `po_status_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `convert_invoice` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval_info` text NOT NULL,
  `wht_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_rate` decimal(10,2) NOT NULL DEFAULT '10.00',
  `vat_base` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat_base_cur` decimal(20,2) NOT NULL,
  `wht_base` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_base_cur` decimal(20,2) NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `sub_total_cur` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_cur` decimal(20,2) NOT NULL,
  `after_disc` decimal(20,2) NOT NULL,
  `after_disc_cur` decimal(20,2) NOT NULL,
  `wht_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wht_total_cur` decimal(20,2) NOT NULL,
  `vat_total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `vat_total_cur` decimal(20,2) NOT NULL,
  `total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_cur` decimal(20,2) NOT NULL,
  `billing_address` text NOT NULL,
  `shipping_address` text NOT NULL,
  `reject_notes` text NOT NULL,
  `reject_by` varchar(50) NOT NULL,
  `reject_date` datetime NOT NULL,
  `cancel_notes` text NOT NULL,
  `cancel_by` varchar(50) NOT NULL,
  `cancel_date` datetime NOT NULL,
  `payment_term` int(11) NOT NULL DEFAULT '0',
  `rp_rate` decimal(20,2) NOT NULL,
  `date_finish` date NOT NULL,
  `printed` int(11) DEFAULT '0',
  `request_type_id` int(11) DEFAULT '1',
  `signer_1` text,
  `signer_2` text,
  `po_address` text NOT NULL,
  `down_payment` decimal(20,2) DEFAULT '0.00',
  `is_down_payment_journal_generated` tinyint(1) DEFAULT '0',
  `down_payment_journal_generated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `id_supplier` (`supplier_id`),
  KEY `created` (`created`),
  KEY `id_department` (`department_id`),
  KEY `po_status_id` (`po_status_id`),
  KEY `delivery_date` (`delivery_date`),
  KEY `po_date` (`po_date`),
  KEY `reject_by` (`reject_by`),
  KEY `currency_id` (`currency_id`),
  KEY `request_type_idx` (`request_type_id`),
  KEY `is_down_payment_journal_generatedx` (`is_down_payment_journal_generated`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `no`, `po_date`, `delivery_date`, `supplier_id`, `department_id`, `po_status_id`, `currency_id`, `description`, `convert_invoice`, `created`, `approval_info`, `wht_rate`, `vat_rate`, `vat_base`, `vat_base_cur`, `wht_base`, `wht_base_cur`, `sub_total`, `sub_total_cur`, `discount`, `discount_cur`, `after_disc`, `after_disc_cur`, `wht_total`, `wht_total_cur`, `vat_total`, `vat_total_cur`, `total`, `total_cur`, `billing_address`, `shipping_address`, `reject_notes`, `reject_by`, `reject_date`, `cancel_notes`, `cancel_by`, `cancel_date`, `payment_term`, `rp_rate`, `date_finish`, `printed`, `request_type_id`, `signer_1`, `signer_2`, `po_address`, `down_payment`, `is_down_payment_journal_generated`, `down_payment_journal_generated_date`) VALUES
(1, 'PO-0001', '2011-07-07', '2011-07-07', 28, NULL, 7, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-07-07 15:21:33:Approved by:generalservice', '0.00', '10.00', '70750000.00', '70750000.00', '0.00', '0.00', '70750000.00', '70750000.00', '0.00', '0.00', '70750000.00', '70750000.00', '0.00', '0.00', '7075000.00', '7075000.00', '77825000.00', '77825000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', 'hitung kembali', 'adeade', '2011-07-07 15:17:22', 1, '0.00', '2011-07-07', 1, 2, 'test 1', 'test 2', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '15780000.00', 0, NULL),
(2, 'PO-0002', '2011-07-07', '2011-07-07', 29, NULL, 7, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-07-07 15:22:00:Approved by:generalservice', '0.00', '10.00', '0.00', '183750000.00', '0.00', '0.00', '0.00', '183750000.00', '0.00', '0.00', '0.00', '183750000.00', '0.00', '0.00', '0.00', '18375000.00', '0.00', '202125000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '2011-07-07', 1, 1, 'Dewi', 'Heri', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `po_details`
--

DROP TABLE IF EXISTS `po_details`;
CREATE TABLE IF NOT EXISTS `po_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `asset_category_id` varchar(29) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `color` varchar(64) DEFAULT NULL,
  `brand` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `qty_received` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `price_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL,
  `amount_cur` decimal(20,2) NOT NULL,
  `discount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `discount_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_after_disc` decimal(20,2) NOT NULL,
  `amount_after_disc_cur` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `vat_cur` decimal(20,2) NOT NULL,
  `amount_nett` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_nett_cur` decimal(20,2) NOT NULL DEFAULT '0.00',
  `currency_id` int(11) NOT NULL,
  `rp_rate` decimal(20,2) NOT NULL DEFAULT '1.00',
  `npb_id` int(11) NOT NULL,
  `umurek` int(11) NOT NULL,
  `is_vat` tinyint(1) NOT NULL DEFAULT '1',
  `is_wht` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL,
  `department_sub_id` int(11) NOT NULL,
  `department_unit_id` int(11) NOT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `npb_detail_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asset_category` (`asset_category_id`),
  KEY `id_invoice` (`po_id`),
  KEY `id_npb` (`npb_id`),
  KEY `is_ppn` (`is_vat`,`is_wht`),
  KEY `department_id` (`department_id`),
  KEY `item_idx` (`item_id`),
  KEY `npb_detail_idx` (`npb_detail_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `po_details`
--

INSERT INTO `po_details` (`id`, `po_id`, `asset_category_id`, `item_code`, `name`, `color`, `brand`, `type`, `qty`, `qty_received`, `price`, `price_cur`, `amount`, `amount_cur`, `discount`, `discount_cur`, `amount_after_disc`, `amount_after_disc_cur`, `vat`, `vat_cur`, `amount_nett`, `amount_nett_cur`, `currency_id`, `rp_rate`, `npb_id`, `umurek`, `is_vat`, `is_wht`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `item_id`, `npb_detail_id`) VALUES
(1, 1, '9', '7KRS001', 'KURSI KERJA', '-', 'BIF', 'MJ007', 20, 20, '0.00', '750000.00', '15000000.00', '15000000.00', '0.00', '0.00', '15000000.00', '15000000.00', '1500000.00', '1500000.00', '16500000.00', '16500000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 34, 18),
(2, 1, '9', '7KRS002', 'KURSI HADAP', '-', 'BIF', 'KR002', 10, 10, '0.00', '1500000.00', '15000000.00', '15000000.00', '0.00', '0.00', '15000000.00', '15000000.00', '1500000.00', '1500000.00', '16500000.00', '16500000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 35, 2),
(3, 1, '8', '7MJA002', 'MEJA NASABAH', '-', 'LIGNA', 'MJ001', 3, 3, '0.00', '9500000.00', '28500000.00', '28500000.00', '0.00', '0.00', '28500000.00', '28500000.00', '2850000.00', '2850000.00', '31350000.00', '31350000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 37, 4),
(4, 1, '9', '7MSN001', 'MESIN TIK', '-', 'Brother', 'MS01', 2, 2, '0.00', '1250000.00', '2500000.00', '2500000.00', '0.00', '0.00', '2500000.00', '2500000.00', '250000.00', '250000.00', '2750000.00', '2750000.00', 1, '0.00', 1, 5, 1, 0, 2, 0, 0, 2, 1, 38, 5),
(5, 1, '9', '7KRS001', 'KURSI KERJA', '-', 'BIF', 'KR001', 5, 5, '0.00', '750000.00', '3750000.00', '3750000.00', '0.00', '0.00', '3750000.00', '3750000.00', '375000.00', '375000.00', '4125000.00', '4125000.00', 1, '0.00', 3, 5, 1, 0, 5, 0, 0, 2, 1, 34, 8),
(6, 1, '8', '7MJA001', 'MEJA KERJA', '-', 'LIGNA', 'MJ007', 1, 1, '0.00', '6000000.00', '6000000.00', '6000000.00', '0.00', '0.00', '6000000.00', '6000000.00', '600000.00', '600000.00', '6600000.00', '6600000.00', 1, '0.00', 3, 5, 1, 0, 5, 0, 0, 2, 1, 36, 10),
(7, 2, '6', '6PCD001', 'DEKSTOP DELL OPTIPLEX', '-', 'Dell', 'GX280', 3, 3, '0.00', '2750000.00', '8250000.00', '8250000.00', '0.00', '0.00', '8250000.00', '8250000.00', '825000.00', '825000.00', '9075000.00', '9075000.00', 1, '0.00', 2, 5, 1, 0, 2, 0, 0, 2, 1, 20, 19),
(8, 2, '6', '6PCT001', 'THIN CLIENT  ', '-', 'ITONA', 'T3851', 5, 5, '0.00', '4500000.00', '22500000.00', '22500000.00', '0.00', '0.00', '22500000.00', '22500000.00', '2250000.00', '2250000.00', '24750000.00', '24750000.00', 1, '0.00', 2, 5, 1, 0, 2, 0, 0, 2, 1, 22, 7),
(9, 2, '6', '6PRE001 ', 'PRINTER EPSON LQ 2180', '-', 'Epson', 'LQ2180', 3, 3, '0.00', '51000000.00', '153000000.00', '153000000.00', '0.00', '0.00', '153000000.00', '153000000.00', '15300000.00', '15300000.00', '168300000.00', '168300000.00', 1, '0.00', 4, 5, 1, 0, 5, 0, 0, 2, 1, 24, 11);

-- --------------------------------------------------------

--
-- Table structure for table `po_payments`
--

DROP TABLE IF EXISTS `po_payments`;
CREATE TABLE IF NOT EXISTS `po_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `term_no` int(11) NOT NULL,
  `term_percent` decimal(10,2) NOT NULL,
  `date_due` date NOT NULL,
  `date_paid` date NOT NULL,
  `amount_due` decimal(20,2) NOT NULL,
  `amount_paid` decimal(20,2) NOT NULL,
  `description` tinytext NOT NULL,
  `amount_po` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `po_id` (`po_id`,`term_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `po_payments`
--

INSERT INTO `po_payments` (`id`, `po_id`, `term_no`, `term_percent`, `date_due`, `date_paid`, `amount_due`, `amount_paid`, `description`, `amount_po`) VALUES
(2, 1, 1, '80.00', '0000-00-00', '0000-00-00', '62920000.00', '0.00', 'PO term 1', '0.00'),
(3, 2, 1, '100.00', '0000-00-00', '0000-00-00', '202125000.00', '0.00', 'PO term 1', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `po_statuses`
--

DROP TABLE IF EXISTS `po_statuses`;
CREATE TABLE IF NOT EXISTS `po_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sorter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `po_statuses`
--

INSERT INTO `po_statuses` (`id`, `name`, `sorter`) VALUES
(1, 'Draft', 0),
(3, 'Approved Level 1', 0),
(4, 'Approved Level 2', 0),
(5, 'Approved Level 3', 0),
(6, 'Finish', 0),
(2, 'Request for Approval', 0),
(7, 'Sent', 0),
(8, 'Reject', 0),
(9, 'Archived', 0);

-- --------------------------------------------------------

--
-- Table structure for table `process_types`
--

DROP TABLE IF EXISTS `process_types`;
CREATE TABLE IF NOT EXISTS `process_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `process_types`
--

INSERT INTO `process_types` (`id`, `name`) VALUES
(1, 'Movement'),
(2, 'Procurement');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(15) NOT NULL DEFAULT '',
  `doc_no` varchar(10) NOT NULL,
  `warranty_id` int(11) DEFAULT NULL,
  `warranty_name` text NOT NULL,
  `warranty_year` int(3) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice_no` varchar(15) DEFAULT NULL,
  `po_no` varchar(15) DEFAULT NULL,
  `periode` date DEFAULT NULL,
  `serial_no` varchar(20) DEFAULT NULL,
  `voucher_no` varchar(15) NOT NULL DEFAULT '',
  `sup_tanggal` date NOT NULL DEFAULT '0000-00-00',
  `sup_vendor_no` varchar(15) DEFAULT NULL,
  `warranty_card` varchar(20) DEFAULT NULL,
  `pos_ting` char(1) NOT NULL DEFAULT 'N',
  `date_of_purchase` date NOT NULL DEFAULT '0000-00-00',
  `warranty_date` date NOT NULL DEFAULT '0000-00-00',
  `kd_luar_tanggal` date NOT NULL DEFAULT '0000-00-00',
  `delivery_order_id` int(11) DEFAULT NULL,
  `currency_id` int(1) DEFAULT '0',
  `po_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `beli_FKIndex4` (`warranty_id`),
  KEY `beli_FKIndex6` (`requester_id`),
  KEY `beli_FKIndex7` (`supplier_id`),
  KEY `beli_FKIndex1` (`department_id`),
  KEY `doc_no` (`doc_no`),
  KEY `delivery_order_idx` (`delivery_order_id`),
  KEY `currency_idx` (`currency_id`),
  KEY `po_idx` (`po_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `no`, `doc_no`, `warranty_id`, `warranty_name`, `warranty_year`, `requester_id`, `department_id`, `supplier_id`, `invoice_no`, `po_no`, `periode`, `serial_no`, `voucher_no`, `sup_tanggal`, `sup_vendor_no`, `warranty_card`, `pos_ting`, `date_of_purchase`, `warranty_date`, `kd_luar_tanggal`, `delivery_order_id`, `currency_id`, `po_id`) VALUES
(1, 'FA-0001', '', NULL, 'Borneo Inti Kreasi', 1, 0, NULL, 28, NULL, 'PO-0001', NULL, NULL, '', '0000-00-00', NULL, NULL, 'N', '2011-07-07', '0000-00-00', '0000-00-00', 1, 1, 1),
(2, 'FA-0002', '', NULL, 'Borneo Inti Kreasi', 1, 0, NULL, 28, NULL, 'PO-0001', NULL, NULL, '', '0000-00-00', NULL, NULL, 'N', '2011-07-07', '0000-00-00', '0000-00-00', 3, 1, 1),
(3, 'FA-0003', '', NULL, 'trikarsa', 1, 0, NULL, 29, NULL, 'PO-0002', NULL, NULL, '', '0000-00-00', NULL, NULL, 'N', '2011-07-07', '0000-00-00', '0000-00-00', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `requesters`
--

DROP TABLE IF EXISTS `requesters`;
CREATE TABLE IF NOT EXISTS `requesters` (
  `id` int(10) unsigned NOT NULL,
  `code` char(6) NOT NULL,
  `name` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requesters`
--

INSERT INTO `requesters` (`id`, `code`, `name`) VALUES
(1, 'R001', 'Ronny'),
(2, 'F001', 'Fendy'),
(3, 'H001', 'Hendro'),
(4, 'S051', 'Swastika I Wayan'),
(5, 'T001', 'Titin Safitri');

-- --------------------------------------------------------

--
-- Table structure for table `request_types`
--

DROP TABLE IF EXISTS `request_types`;
CREATE TABLE IF NOT EXISTS `request_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `descr` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `request_types`
--

INSERT INTO `request_types` (`id`, `name`, `descr`) VALUES
(1, 'FA: IT Items', ''),
(2, 'FA: General Items', ''),
(3, 'Stock Inventory', ''),
(4, 'Service', '');

-- --------------------------------------------------------

--
-- Table structure for table `returs`
--

DROP TABLE IF EXISTS `returs`;
CREATE TABLE IF NOT EXISTS `returs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `is_process` tinyint(1) DEFAULT '0',
  `is_printed` tinyint(1) DEFAULT '0',
  `retur_status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`),
  KEY `retur_status_idx` (`retur_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `returs`
--


-- --------------------------------------------------------

--
-- Table structure for table `retur_details`
--

DROP TABLE IF EXISTS `retur_details`;
CREATE TABLE IF NOT EXISTS `retur_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retur_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  `descr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `retur_id` (`retur_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `retur_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `retur_statuses`
--

DROP TABLE IF EXISTS `retur_statuses`;
CREATE TABLE IF NOT EXISTS `retur_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `retur_statuses`
--

INSERT INTO `retur_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Sent to Branch Head'),
(3, 'Approved by Branch Head'),
(4, 'Reject'),
(5, 'Archive'),
(6, 'Finish'),
(7, 'Processed');

-- --------------------------------------------------------

--
-- Table structure for table `saldoawal`
--

DROP TABLE IF EXISTS `saldoawal`;
CREATE TABLE IF NOT EXISTS `saldoawal` (
  `doc_no` varchar(10) NOT NULL DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `periode` date DEFAULT NULL,
  `tutup` char(1) DEFAULT NULL,
  `invoice_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`doc_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldoawal`
--


-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `kode` varchar(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--


-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `in_out` varchar(10) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `outlog_id` int(11) DEFAULT NULL,
  `usage_id` int(11) DEFAULT NULL,
  `retur_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `supplier_retur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`item_id`,`outlog_id`,`usage_id`,`retur_id`,`department_id`),
  KEY `supplier_retur_idx` (`supplier_retur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `stocks`
--


-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(4) DEFAULT '',
  `name` varchar(40) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `business_type` varchar(20) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `default_wht_rate` decimal(10,2) NOT NULL DEFAULT '2.50',
  `bank_name` varchar(50) NOT NULL,
  `bank_account_no` varchar(50) NOT NULL,
  `bank_account_name` varchar(200) NOT NULL,
  `bank_account_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_name` (`bank_name`,`bank_account_no`,`bank_account_name`),
  KEY `bank_account_type_id` (`bank_account_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `no`, `name`, `address`, `city`, `telephone`, `email`, `fax`, `hp`, `business_type`, `contact_person`, `province`, `website`, `default_wht_rate`, `bank_name`, `bank_account_no`, `bank_account_name`, `bank_account_type_id`) VALUES
(1, 'P001', 'PD Multi Kencana', 'Jl. Pinangsia Raya 81B', 'Jakarta - citi', '022 - 6911606', 'test@yahoo.com', '022 - 4534231', '+625 876 545 654', '', '-', 'Jakarta', 'www.test.com', '2.00', 'BCA', '47875834', 'Ujang Sanusi', 1),
(2, 'S001', 'Shure Electronik', 'Glodok Baru Blok D 11/8', 'Jakarta Barat', '-', 'test@yahoo.com', '', '+625 876 545 654', '', 'ooo', 'Jakarta', '', '2.00', 'BNI', '432758909', 'Shure Electronis', 1),
(3, 'A001', 'Audio Graha Electronindo', 'Glodok Plaza Blok H No.6 Jl.Pinangsia N', 'Jakarta', '6280232', 'Audio@Graha Electronindo.com', '021-6280232', '0812203654', '', '123456', 'Jakarta', 'www.Graha Electronindo', '2.00', '', '', '', 0),
(4, 'M001', 'MRZ Computer', 'Komplek Ruko Bahan Bangunan Blok F 2', 'Jakarta', '6296800', 'test@yahoo.com', '', '+625 876 545 654', '', 'llll', 'Jakarta', '', '2.00', 'Rabobank', '47328782', 'MRZ Computer PT', 3),
(5, 'Z001', 'No Name (Glodok)', 'Glodok', 'Jakarta', '021-236548', 'aaa@aaa.com', '021236548', '082222222', NULL, 'aaa', 'Jakarta', 'www.Glodok.ectronindo', '2.00', '', '', '', 0),
(6, 'D001', 'Dunia Meubel', 'Jl. KH Hasyim Ashari No.99 B', 'Jakarta', '6313880', '-', '-', NULL, NULL, 'Dewi', NULL, NULL, '2.00', '', '', '', 0),
(7, 'R001', 'Rizky Jaya', 'Jl. K.H Hasyim Ashari no. 62', 'Jakarta Pusat', '6331564', '-', '6331564', NULL, NULL, '-', NULL, NULL, '2.00', '', '', '', 0),
(8, 'P002', 'PD Donati Inti Karya', 'Jl. Cideng Barat No. 10A', 'Jakarta', '450000000', 'daniel@gpsTrackingIndonesia.com', '-', '0849385', '', '-', 'dki', '', '2.00', '', '', '', 0),
(9, 'G001', 'Geoff Forrester Indonesia, PT', 'NHB Building, level 2 Jl. Melawai Raya', 'Jakarta 12160', '7206335/4080', 'www.gfcom.biz', '7244303', NULL, NULL, 'Inggriyani Wahyuni', NULL, NULL, '2.00', '', '', '', 0),
(10, 'L001', 'Lambda Guna Tehnik', 'Jl. Harapan Jaya Raya No.3 Cempaka Baru', 'Jakarta Pusat 10640', '4247444', '-', '4223393', NULL, NULL, 'Robindra', NULL, NULL, '2.00', '', '', '', 0),
(11, 'B001', 'Bali Surya Tech', 'Jl.Nakula no.99 Seminyak', 'Kuta - Bali', '0361-7424081', '-', '0361-7424081', NULL, NULL, 'Agus', NULL, NULL, '2.00', '', '', '', 0),
(12, 'S002', 'Surya Indah Dewata,CV', 'Kompleks Sudirman Agung Blok F 14-15', 'Denpasar', '0361-241144,241145', '-', '0361-241148', NULL, NULL, 'Drs.EC.Simon Dutjiadi', NULL, NULL, '2.00', '', '', '', 0),
(13, 'D002', 'Desain Eko', 'JL.Bima 17 Pengosekan PO BOX 46', 'Ubud,Bali', '0361-974670', 'designeko@indo.net.id', '0361-974670', NULL, NULL, 'Eko Prabowo', NULL, NULL, '2.00', '', '', '', 0),
(14, 'R003', 'Radja Gorden', 'JL.Merpati VI/52 Monang Maning JL.Raya', 'Denpasar, Tuban- Bali', '0361-481417', '-', '-', NULL, NULL, 'H Sulaeman', NULL, NULL, '2.00', '', '', '', 0),
(15, 'B002', 'Bali PasifikStar Redjeki', 'JL.Dr Sutomo no 105 Denpasar JL.manyar', 'Bali, Surabaya', '0361-420247,031-5950', 'pasired@yahoo.com', '0361-420247,031-5946', NULL, NULL, 'Yanti,Arif Rohman', NULL, NULL, '2.00', '', '', '', 0),
(16, 'M002', 'Muda Jaya', 'JL.Gajah Mada no 56 Denpasar', 'Bali', '0361-222887,223528,7', '-', '0361-224297', NULL, NULL, 'Ceny Sungkono', NULL, NULL, '2.00', '', '', '', 0),
(17, 'G002', 'Gelora Perkasa', 'JL.Teuku Umar no 32 Denpasar', 'Bali', '0361-239777', '-', '0361-239780', NULL, NULL, 'Hans Wira Prayogo', NULL, NULL, '2.00', '', '', '', 0),
(18, 'A002', 'Audio Multi', 'JL. Kiara Asri 98', 'Bandung', '022-2546598', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.00', '', '', '', 0),
(19, 'G005', 'General Utama', 'jl Gudang utara 908', 'Bandung', '022-4201546', '-', '022-4201546', '-', NULL, 'ada', 'Jawa Barat', '-', '2.00', '', '', '', 0),
(20, 'Y001', 'Yayasan Bina Sehat', 'Jl. Kuningan 787', 'Bandung', '022-250252', 'Yayasan@BinaSehat.org', '022-250252', '081252555', '', 'agus', 'Jawa Barat', 'www.ayasan Bina Sehat.com', '2.00', '', '', '', 0),
(21, 'Y002', 'Noname', '-', 'Bandung', '-', '-', '-', '-', NULL, '-', '-', '-', '2.00', '', '', '', 0),
(22, 'Y003', 'Yuasa', 'Jl Yuasa', '-', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.00', '', '', '', 0),
(23, 'S005', 'JAKARTA', 'JAKARTA', 'JAKARTA', '021-2505573', 'jkt@jkt.com', '021-2505573', '0812254645', NULL, 'ktj', 'JAKARTA', 'www.JAKARTA.co.id', '2.00', '', '', '', 0),
(24, 'S006', 'g', 'g', 'g', 'g', 'g', 'g', 'g', NULL, 'g', 'g', 'g', '2.00', '', '', '', 0),
(25, 'S008', 'BDG', 'BDG', 'BDG', 'BDG', 'BDG', 'BDG', 'BDG', NULL, 'BDG', 'BDG', 'BDG', '2.00', '', '', '', 0),
(26, 'S007', 'MAS', 'jalan Mas', 'MAS', '022054', 'dasd', '5', '455', NULL, 'dd', 'MAS', 'da', '2.00', '', '', '', 0),
(27, 'F050', 'Fendy & Fio', 'Jakarta', 'Jakarta', '-', '-', '-', '-', NULL, 'Fendy', 'DKI', '-', '2.00', '', '', '', 0),
(28, '123', 'Borneo Inti Kreasi', 'abdul musi', 'jakarta', '021-90876584', 'borneo@YAHOO.COM', '021-90876584', '0875352211', '', 'deden', 'west java', 'www.borneo.com', '1.00', '', '', '', 0),
(29, '', 'trikarsa', 'tanah abang 45', 'jakarta', '021-46483343', 'trikarsa@gmail.com', '021-4648334', '0867423544', '123', 'asep', 'west java', 'www.trikarsa.com', '2.00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_returs`
--

DROP TABLE IF EXISTS `supplier_returs`;
CREATE TABLE IF NOT EXISTS `supplier_returs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `is_process` tinyint(1) DEFAULT '0',
  `is_printed` tinyint(1) DEFAULT '0',
  `supplier_retur_status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`),
  KEY `supplier_retur_status_idx` (`supplier_retur_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `supplier_returs`
--


-- --------------------------------------------------------

--
-- Table structure for table `supplier_retur_details`
--

DROP TABLE IF EXISTS `supplier_retur_details`;
CREATE TABLE IF NOT EXISTS `supplier_retur_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_retur_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  `doc_id` int(11) NOT NULL DEFAULT '0',
  `descr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_retur_id` (`supplier_retur_id`,`item_id`,`doc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `supplier_retur_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `supplier_retur_statuses`
--

DROP TABLE IF EXISTS `supplier_retur_statuses`;
CREATE TABLE IF NOT EXISTS `supplier_retur_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `supplier_retur_statuses`
--

INSERT INTO `supplier_retur_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Sent to Supervisor'),
(3, 'Approved'),
(4, 'Reject'),
(5, 'Archive'),
(6, 'Finish'),
(7, 'Processed');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'rim'),
(2, 'pcs'),
(3, 'box'),
(4, 'dozen');

-- --------------------------------------------------------

--
-- Table structure for table `usages`
--

DROP TABLE IF EXISTS `usages`;
CREATE TABLE IF NOT EXISTS `usages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_process` tinyint(1) DEFAULT '0',
  `is_printed` tinyint(1) DEFAULT '0',
  `usage_status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`),
  KEY `usage_status_idx` (`usage_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usages`
--


-- --------------------------------------------------------

--
-- Table structure for table `usage_details`
--

DROP TABLE IF EXISTS `usage_details`;
CREATE TABLE IF NOT EXISTS `usage_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usage_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  `descr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usage_id` (`usage_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usage_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `usage_statuses`
--

DROP TABLE IF EXISTS `usage_statuses`;
CREATE TABLE IF NOT EXISTS `usage_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `usage_statuses`
--

INSERT INTO `usage_statuses` (`id`, `name`) VALUES
(1, 'Draft'),
(2, 'Sent to Branch Head'),
(3, 'Approved'),
(4, 'Reject'),
(5, 'Archive'),
(6, 'Processed'),
(7, 'Finish');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `aktif`, `last_password_change`) VALUES
(2, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 1, 72, 36, 56, 2, 108, 1, '2011-06-23 10:26:15'),
(3, 'heri1', 'heri@admin.com', '6812af90c6a1bbec134e323d7e70587b', 'heri', 2, 2, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(4, 'adeade', 'ade@admin.com', 'a562cfa07c2b1213b3a5c99b756fc206', 'ade', 3, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(5, 'badubadu', 'badu@admin.com', '40a3de3b98856879b19943f7e93a0375', 'badu', 4, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(7, 'generalservice', 'admin@admin.com', '1d8d5e912302108b5e88c3e77fcad378', 'gs', 7, 72, 36, 56, 2, 128, 1, '2011-06-23 10:26:15'),
(8, 'cabang1', 'admin@admin.com', 'f74e4339be40ffd3b2a263873e653be4', 'cabang', 6, 2, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(9, 'fincon', 'fincon@admin.com', '766a69946883ddc09289ac08e256e4b0', 'fincon', 8, 72, 15, 18, 2, 22, 1, '2011-06-23 10:26:15'),
(13, 'gsadmin', 'gs_admin@admin.com', 'e4df745c3d6bbbe631d0409c9d737dbd', 'gs_admin', 10, 72, 36, 56, 2, 128, 1, '2011-06-23 10:26:15'),
(14, 'itadmin', 'it_admin@admin.com', '21b29b7b87a13d1da465760bf3ac34a9', 'it_admin', 12, 72, 36, 55, 2, 103, 1, '2011-06-23 10:26:15'),
(15, 'famanagement', 'admin@admin.com', '59246f163814db9c3b0021780301e0e5', 'fa_management', 11, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(16, 'itmanagement', 'it_management@admin.com', '9f41b19c2b1e98c6dbea484499e08244', 'it_management', 13, 72, 36, 55, 2, 107, 1, '2011-06-23 10:26:15'),
(17, 'stockmanagement', 'admin@admin.com', '748327434ced43a3bf0d3e69be6b6c34', 'stock_management', 14, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(18, 'stocksupervisor', 'stock_supervisor@admin.com', 'daa87e49a220e9a9548f76d9a4ae1737', 'stock_supervisor', 100, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(19, 'fasupervisor', 'fa_spv@admin.com', 'f1b20b87e5337262f517f9cf832e9764', 'fa_supervisor', 15, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(20, 'itsupervisor', 'it_spv@admin.com', '8de5114af230bc138d2079fdef268041', 'it_supervisor', 16, 72, 43, 106, 2, 107, 1, '2011-06-23 10:26:15'),
(21, 'cabang2', 'cabang2@admin.com', '674f68d4674384c782fac706bde2c54b', 'cabang2', 6, 5, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(22, 'cabang3', 'cabang3@admin.com', '1ac5afe7639bf312e7e405a0d292a53f', 'cabang3', 6, 1, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(23, 'heri2', 'heri2@admin.com', '1801d4679e24db6df57061601422c839', 'heri2', 2, 5, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(24, 'heri3', 'heri3@admin.com', 'a7eda932a463b45de9271bea3e3e0984', 'heri3', 2, 1, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(38, 'gsspv', 'gs_spv@admin.com', '93b811593a49a7068e7ff4087feec750', 'gs_spv', 9, 72, NULL, NULL, 2, 128, 1, NULL),
(39, 'finconspv', 'fincon_spv@admin.com', 'a3e16eeab7512982db1f729d11af40c0', 'fincon_spv', 20, 72, NULL, NULL, 2, 128, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `users_groups_FKIndex1` (`user_id`),
  KEY `users_groups_FKIndex2` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 0, 1),
(2, 0, 1),
(3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warranties`
--

DROP TABLE IF EXISTS `warranties`;
CREATE TABLE IF NOT EXISTS `warranties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `business_type` varchar(20) DEFAULT NULL,
  `contact_person` varchar(40) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `warranties`
--

INSERT INTO `warranties` (`id`, `code`, `name`, `address`, `city`, `telephone`, `email`, `fax`, `hp`, `business_type`, `contact_person`, `province`, `website`, `tanggal`) VALUES
(1, 'Z002', 'spart', 'kjh', 'jakarta', '021-236548', 'spart@spart.com', '021-236548', '0812154655', '', 'ttt', 'jakarta', 'www.spart.id', '2011-01-13'),
(2, 'Z001', 'No Warranty', 'tdk jelas', 'Bandung', '021-2564896', 'aaa@aaa.com', '021236548', '0812203654', NULL, 'qwqw', 'Bandung', 'www.No Warranty', NULL),
(3, 'Q000', 'Quantum', 'ruko segitiga mas', 'Bandung', '022-241569', 'Q@yh.nok', '022-241569', '08226565656', NULL, 'queri', 'Bandung', 'www.Quantum.id', NULL),
(4, 'BST', 'Bali Surya Tech', 'Jl. Nakula 99 Seminyak - Kuta', 'Kuta', '0361-7424081', 'BST@Bali Surya Tech.com', '0361-7424081', '085824516', NULL, 'i gd', 'Bali', 'www.Bali Surya Tech', NULL),
(5, 'D012', 'MINOLTA', 'JL. Panglima Besar Sudirman', 'Denpasar,Bali', '0361-241144,241145', '-', '0361-241148', NULL, NULL, 'Drs.EC.Simon Dutjiadi', NULL, NULL, NULL),
(6, 'D004', 'Yusaku', 'Jl. Komp, Kuning', 'Bandung', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'G001', 'Gagak', 'jl gagak 89', 'Bandung', '022-2506548', 'aaa@aaa.com', '022-2506548', '081565498', '', 'gagan', 'Jawabarat', '-', '2011-01-20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
