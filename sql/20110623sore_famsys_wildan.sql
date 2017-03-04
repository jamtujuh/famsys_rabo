-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 24. Juni 2011 jam 19:39
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

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
-- Struktur dari tabel `accounts`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=155 ;

--
-- Dumping data untuk tabel `accounts`
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
(39, 'RAB Proses Umum', '0010999993', 0, 0, 0, 1, 5),
(55, 'KERUGIAN PENGHAPUSAN FA', 'FA00001', 0, 1, 1, NULL, 11),
(56, 'KEUNTUNGAN PENJUALAN FA', 'FA00002', 0, 1, 1, NULL, 3),
(57, 'KERUGIAN PENJUALAN FA', 'FA00003', 0, 1, 1, NULL, 4),
(58, 'KAS', 'FA00004', 0, 0, 0, 0, 0),
(59, 'Hutang Pada Supplier', '1234567', 0, 1, 1, 1, 10),
(98, 'Biaya Penyusutan Equipment', '5330-14 ', 0, 0, 1, 1, 6),
(97, 'Akumulasi Penyusutan Equipment', '1081-11', 0, 1, 0, 1, 1),
(96, 'Equipment', '1080-12 ', 0, 1, 0, 1, 2),
(95, 'Biaya Penyusutan Leasehold', '5329-14 ', 0, 0, 1, 1, 6),
(94, 'Akumulasi Penyusutan Leasehold', '1081-10 ', 0, 1, 0, 1, 1),
(99, 'Land ', '1080-01', 0, 1, 0, 5, 2),
(100, 'Akumulasi Penyusutan Land', '1081-08 ', 0, 1, 0, 16, 1),
(101, 'Biaya Penyusutan Land', '5327-14 ', 0, 0, 1, 16, 6),
(102, 'ACCOUNT CABANG ASAL', '00000', 0, 1, 1, NULL, 7),
(103, 'ACCOUNT CABANG TUJUAN ', '0000', 0, 0, 0, NULL, 8),
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
(154, 'Uang Muka', 'XXXXX', 0, 1, 1, 0, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_globals`
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
-- Dumping data untuk tabel `account_globals`
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
-- Struktur dari tabel `account_types`
--

DROP TABLE IF EXISTS `account_types`;
CREATE TABLE IF NOT EXISTS `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `descr` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `descr`) VALUES
(1, 'Akumulasi Penyusutan', ''),
(2, 'Harga Perolehan', ''),
(3, 'Laba Penjualan FA', ''),
(4, 'Rugi Penjualan FA', ''),
(5, 'RAB Proses Umum', ''),
(6, 'Biaya Penyusutan', ''),
(7, 'Cabang Asal', ''),
(8, 'Cabang Tujuan', ''),
(9, 'Biaya Non Operasional', ''),
(10, 'Hutang Supplier', ''),
(11, 'Rugi Penghapusan FA', ''),
(12, 'Laba Penghapusan FA', ''),
(13, 'Persediaan', ''),
(15, 'Uang Muka', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `assets`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `assets`
--

INSERT INTO `assets` (`id`, `code`, `condition_id`, `asset_category_id`, `purchase_id`, `location_id`, `currency_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `warranty_id`, `setatus`, `kd_gab`, `name`, `item_code`, `color`, `brand`, `type`, `ada`, `date_of_purchase`, `date_out`, `kelfa`, `umurek`, `maksi`, `price`, `price_cur`, `amount`, `amount_cur`, `qty`, `residu`, `akdasar`, `depbln`, `thnlalu`, `blnlalu`, `blnini`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`, `hrgjual`, `jthnlalu`, `jblnlalu`, `jblnini`, `hpthnlalu`, `hpblnlalumasuk`, `hpblninimasuk`, `hpblnlalukeluar`, `hpblninikeluar`, `hpthnini`, `depthnlalu`, `depblnlalumasuk`, `depblninimasuk`, `depblnlalukeluar`, `depblninikeluar`, `depthnini`, `book_value`, `sedang_diluar`, `service_tanggal`, `service_selesai_tanggal`, `date_start`, `date_end`, `no_urut_prefix`, `no_urut`, `serial_no`, `voucher_no`, `po_no`, `invoice_no`, `posting`, `kd_luar_tanggal`, `service_total`, `service_ket`, `year`, `notes`, `process`, `invoice_id`, `delivery_order_id`, `delivery_order_detail_id`, `po_id`) VALUES
(1, 'IN1-2011-016-1', 0, 8, 1, NULL, 1, 4, 0, 0, 2, 1, NULL, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '550000.00', '550000.00', 5, '0.00', '0.00', '9166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 1, 1, 1),
(2, 'IN1-2011-016-2', 0, 8, 1, NULL, 1, 4, 0, 0, 2, 1, NULL, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '550000.00', '550000.00', 5, '0.00', '0.00', '9166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 1, 2, 1),
(3, 'IN2-2011-016-1', 0, 9, 1, NULL, 1, 4, 0, 0, 2, 1, NULL, NULL, NULL, '7KRS002-KURSI HADAP', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1100000.00', '1100000.00', '5500000.00', '5500000.00', 5, '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 1, 3, 1),
(4, 'IN2-2011-016-2', 0, 9, 1, NULL, 1, 4, 0, 0, 2, 1, NULL, NULL, NULL, '7KRS003-KURSI TUNGGU', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '11000000.00', '11000000.00', 2, '0.00', '0.00', '183333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 1, 4, 1),
(5, 'IN2-2011-010-1', 0, 9, 1, NULL, 1, 1, 0, 0, 2, 1, NULL, NULL, NULL, 'LMR001-Lemari Besi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '27500000.00', '27500000.00', 5, '0.00', '0.00', '458333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 1, 5, 1),
(6, 'IN2-2011-010-2', 0, 9, 1, NULL, 1, 1, 0, 0, 2, 1, NULL, NULL, NULL, '7KRS001-KURSI KERJA', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '4125000.00', '4125000.00', 5, '0.00', '0.00', '68750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 2, 1, 6, 1),
(7, 'HRD-2011-016-1', 0, 6, 2, NULL, 2, 4, 0, 0, 2, 1, NULL, NULL, NULL, '6LCH003 -LCD HP ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '99000.00', '9.90', '297000.00', '29.70', 3, '0.00', '0.00', '4950.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 18, 4),
(8, 'HRD-2011-016-2', 0, 6, 2, NULL, 2, 4, 0, 0, 2, 1, NULL, NULL, NULL, '6MOU001-MOUSE USB', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '66000.00', '6.60', '132000.00', '13.20', 2, '0.00', '0.00', '2200.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 19, 4),
(9, 'HRD-2011-016-3', 0, 6, 2, NULL, 2, 4, 0, 0, 2, 1, NULL, NULL, NULL, '6PRI001-PROJECTOR INFOCUS', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '2200000.00', '220.00', '6600000.00', '660.00', 3, '0.00', '0.00', '110000.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 20, 4),
(10, 'HRD-2011-016-4', 0, 6, 2, NULL, 2, 4, 0, 0, 2, 1, NULL, NULL, NULL, '6MOU002-MOUSE SERIAL PS/2', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '66000.00', '6.60', '132000.00', '13.20', 2, '0.00', '0.00', '2200.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 21, 4),
(11, 'HRD-2011-010-1', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '4950000.00', '495.00', 1, '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 22, 4),
(12, 'HRD-2011-010-2', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '4950000.00', '495.00', 1, '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 23, 4),
(13, 'HRD-2011-010-3', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1870000.00', '187.00', '3740000.00', '374.00', 2, '0.00', '0.00', '62333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 24, 4),
(14, 'HRD-2011-010-4', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '4950000.00', '495.00', 1, '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 25, 4),
(15, 'HRD-2011-010-5', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1870000.00', '187.00', '3740000.00', '374.00', 2, '0.00', '0.00', '62333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 26, 4),
(16, 'HRD-2011-010-6', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6MSA001-ATEN ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '440000.00', '44.00', '880000.00', '88.00', 2, '0.00', '0.00', '14666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 27, 4),
(17, 'HRD-2011-010-7', 0, 6, 2, NULL, 2, 1, 0, 0, 2, 1, NULL, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '9900000.00', '990.00', 2, '0.00', '0.00', '165000.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 1, 4, 28, 4),
(18, 'HRD-2011-016-5', 0, 6, 3, NULL, 1, 4, 0, 0, 2, 1, NULL, NULL, NULL, 'Komputer Lengkap 2', 'K099999', 'hijau', 'panasonic', 'c-0888', 'Y', '2011-06-24', '0000-00-00', NULL, 5, 60, '1100.00', '1100.00', '1100.00', '1100.00', 1, '0.00', '0.00', '18.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 0, 5, 29, 9),
(19, 'HRD-2011-016-6', 0, 6, 3, NULL, 1, 4, 0, 0, 2, 1, NULL, NULL, NULL, 'Printer lengkap', 'K01999', 'merah', 'lg', 'c-890', 'Y', '2011-06-24', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '5500000.00', '5500000.00', 1, '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 0, 5, 30, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `asset_categories`
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
-- Dumping data untuk tabel `asset_categories`
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
-- Struktur dari tabel `asset_category_types`
--

DROP TABLE IF EXISTS `asset_category_types`;
CREATE TABLE IF NOT EXISTS `asset_category_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `asset_category_types`
--

INSERT INTO `asset_category_types` (`id`, `name`) VALUES
(1, 'FA'),
(2, 'Stock'),
(3, 'Bdd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asset_details`
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
  `check_physical` varchar(11) DEFAULT '0',
  `delivery_order_id` int(11) DEFAULT NULL,
  `delivery_order_detail_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `accept` tinyint(1) NOT NULL DEFAULT '0',
  `accepted_datetime` datetime NOT NULL,
  `accepted_by` varchar(25) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data untuk tabel `asset_details`
--

INSERT INTO `asset_details` (`id`, `code`, `condition_id`, `asset_id`, `asset_category_id`, `purchase_id`, `location_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `status`, `kd_gab`, `name`, `item_code`, `color`, `brand`, `type`, `ada`, `date_of_purchase`, `date_out`, `kelfa`, `umurek`, `maksi`, `price`, `price_cur`, `residu`, `akdasar`, `depbln`, `thnlalu`, `blnlalu`, `blnini`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dec`, `hrgjual`, `jthnlalu`, `jblnlalu`, `jblnini`, `hpthnlalu`, `hpblnlalumasuk`, `hpblninimasuk`, `hpblnlalukeluar`, `hpblninikeluar`, `hpthnini`, `depthnlalu`, `depblnlalumasuk`, `depblninimasuk`, `depblnlalukeluar`, `depblninikeluar`, `depthnini`, `book_value`, `sedang_diluar`, `service_tanggal`, `service_selesai_tanggal`, `date_start`, `date_end`, `no_urut_prefix`, `no_urut`, `serial_no`, `voucher_no`, `posting`, `kd_luar_tanggal`, `service_total`, `service_ket`, `year`, `notes`, `process`, `source`, `invoice_id`, `check_physical`, `delivery_order_id`, `delivery_order_detail_id`, `po_id`, `accept`, `accepted_datetime`, `accepted_by`) VALUES
(1, 'IN1-2011-016-1-001', 1, 1, 8, 1, 6, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', 'biru', 'FUTURA', '9999', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, 'ftr001', NULL, 0, '0000-00-00', '0', NULL, 2011, 'tes', 0, 'purchase', 2, '0', 1, 1, 1, 0, '0000-00-00 00:00:00', ''),
(2, 'IN1-2011-016-1-002', 1, 1, 8, 1, 1, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', 'MERAH', 'FUTURA', '0000', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, 'ftr001', NULL, 0, '0000-00-00', '0', NULL, 2011, 'tes2', 0, 'purchase', 2, '0', 1, 1, 1, 0, '0000-00-00 00:00:00', ''),
(3, 'IN1-2011-016-1-003', 1, 1, 8, 1, 2, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', 'kuning', 'citos', '1111', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, '123', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 1, 1, 0, '0000-00-00 00:00:00', ''),
(4, 'IN1-2011-016-1-004', 1, 1, 8, 1, 1, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', 'hijau', 'citos', '3333', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, '4444', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 1, 1, 0, '0000-00-00 00:00:00', ''),
(5, 'IN1-2011-016-1-005', 1, 1, 8, 1, 1, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', 'BIRU', 'FUTURA', '5555', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, '5555', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 1, 1, 0, '0000-00-00 00:00:00', ''),
(6, 'IN1-2011-016-2-001', 1, 2, 8, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 2, 1, 0, '0000-00-00 00:00:00', ''),
(7, 'IN1-2011-016-2-002', 1, 2, 8, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 2, 1, 0, '0000-00-00 00:00:00', ''),
(8, 'IN1-2011-016-2-003', 1, 2, 8, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 2, 1, 0, '0000-00-00 00:00:00', ''),
(9, 'IN1-2011-016-2-004', 1, 2, 8, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 2, 1, 0, '0000-00-00 00:00:00', ''),
(10, 'IN1-2011-016-2-005', 1, 2, 8, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'K010-Kursi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '110000.00', '110000.00', '0.00', '0.00', '1833.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 2, 1, 0, '0000-00-00 00:00:00', ''),
(11, 'IN2-2011-016-1-001', 1, 3, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS002-KURSI HADAP', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1100000.00', '1100000.00', '0.00', '0.00', '18333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 3, 1, 0, '0000-00-00 00:00:00', ''),
(12, 'IN2-2011-016-1-002', 1, 3, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS002-KURSI HADAP', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1100000.00', '1100000.00', '0.00', '0.00', '18333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 3, 1, 0, '0000-00-00 00:00:00', ''),
(13, 'IN2-2011-016-1-003', 1, 3, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS002-KURSI HADAP', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1100000.00', '1100000.00', '0.00', '0.00', '18333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 3, 1, 0, '0000-00-00 00:00:00', ''),
(14, 'IN2-2011-016-1-004', 1, 3, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS002-KURSI HADAP', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1100000.00', '1100000.00', '0.00', '0.00', '18333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 3, 1, 0, '0000-00-00 00:00:00', ''),
(15, 'IN2-2011-016-1-005', 1, 3, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS002-KURSI HADAP', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1100000.00', '1100000.00', '0.00', '0.00', '18333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 3, 1, 0, '0000-00-00 00:00:00', ''),
(16, 'IN2-2011-016-2-001', 1, 4, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS003-KURSI TUNGGU', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 4, 1, 0, '0000-00-00 00:00:00', ''),
(17, 'IN2-2011-016-2-002', 1, 4, 9, 1, NULL, 4, 0, 0, 2, 1, NULL, NULL, '7KRS003-KURSI TUNGGU', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 4, 1, 0, '0000-00-00 00:00:00', ''),
(18, 'IN2-2011-010-1-001', 1, 5, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, 'LMR001-Lemari Besi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 5, 1, 0, '0000-00-00 00:00:00', ''),
(19, 'IN2-2011-010-1-002', 1, 5, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, 'LMR001-Lemari Besi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 5, 1, 0, '0000-00-00 00:00:00', ''),
(20, 'IN2-2011-010-1-003', 1, 5, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, 'LMR001-Lemari Besi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 5, 1, 0, '0000-00-00 00:00:00', ''),
(21, 'IN2-2011-010-1-004', 1, 5, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, 'LMR001-Lemari Besi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 5, 1, 0, '0000-00-00 00:00:00', ''),
(22, 'IN2-2011-010-1-005', 1, 5, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, 'LMR001-Lemari Besi', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 5, 1, 0, '0000-00-00 00:00:00', ''),
(23, 'IN2-2011-010-2-001', 1, 6, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, '7KRS001-KURSI KERJA', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 6, 1, 0, '0000-00-00 00:00:00', ''),
(24, 'IN2-2011-010-2-002', 1, 6, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, '7KRS001-KURSI KERJA', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 6, 1, 0, '0000-00-00 00:00:00', ''),
(25, 'IN2-2011-010-2-003', 1, 6, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, '7KRS001-KURSI KERJA', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 6, 1, 0, '0000-00-00 00:00:00', ''),
(26, 'IN2-2011-010-2-004', 1, 6, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, '7KRS001-KURSI KERJA', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 6, 1, 0, '0000-00-00 00:00:00', ''),
(27, 'IN2-2011-010-2-005', 1, 6, 9, 1, NULL, 1, 0, 0, 2, 1, NULL, NULL, '7KRS001-KURSI KERJA', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '825000.00', '825000.00', '0.00', '0.00', '13750.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 2, '0', 1, 6, 1, 0, '0000-00-00 00:00:00', ''),
(28, 'HRD-2011-016-1-001', 1, 7, 6, 2, 2, 4, 0, 0, 2, 1, NULL, NULL, '6LCH003 -LCD HP ', '', 'hitam', 'hp', 'hp99', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '99000.00', '9.90', '0.00', '0.00', '1650.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, 'jjjj', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 18, 4, 0, '0000-00-00 00:00:00', ''),
(29, 'HRD-2011-016-1-002', 1, 7, 6, 2, 1, 4, 0, 0, 2, 1, NULL, NULL, '6LCH003 -LCD HP ', '', 'tt', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '99000.00', '9.90', '0.00', '0.00', '1650.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, '', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 18, 4, 0, '0000-00-00 00:00:00', ''),
(30, 'HRD-2011-016-1-003', 1, 7, 6, 2, 1, 4, 0, 0, 2, 1, NULL, NULL, '6LCH003 -LCD HP ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '99000.00', '9.90', '0.00', '0.00', '1650.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, '12345678991234567890', NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 18, 4, 0, '0000-00-00 00:00:00', ''),
(31, 'HRD-2011-016-2-001', 1, 8, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6MOU001-MOUSE USB', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '66000.00', '6.60', '0.00', '0.00', '1100.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 19, 4, 0, '0000-00-00 00:00:00', ''),
(32, 'HRD-2011-016-2-002', 1, 8, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6MOU001-MOUSE USB', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '66000.00', '6.60', '0.00', '0.00', '1100.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 19, 4, 0, '0000-00-00 00:00:00', ''),
(33, 'HRD-2011-016-3-001', 1, 9, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6PRI001-PROJECTOR INFOCUS', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '2200000.00', '220.00', '0.00', '0.00', '36666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 20, 4, 0, '0000-00-00 00:00:00', ''),
(34, 'HRD-2011-016-3-002', 1, 9, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6PRI001-PROJECTOR INFOCUS', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '2200000.00', '220.00', '0.00', '0.00', '36666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 20, 4, 0, '0000-00-00 00:00:00', ''),
(35, 'HRD-2011-016-3-003', 1, 9, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6PRI001-PROJECTOR INFOCUS', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '2200000.00', '220.00', '0.00', '0.00', '36666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 20, 4, 0, '0000-00-00 00:00:00', ''),
(36, 'HRD-2011-016-4-001', 1, 10, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6MOU002-MOUSE SERIAL PS/2', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '66000.00', '6.60', '0.00', '0.00', '1100.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 21, 4, 0, '0000-00-00 00:00:00', ''),
(37, 'HRD-2011-016-4-002', 1, 10, 6, 2, NULL, 4, 0, 0, 2, 1, NULL, NULL, '6MOU002-MOUSE SERIAL PS/2', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '66000.00', '6.60', '0.00', '0.00', '1100.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 21, 4, 0, '0000-00-00 00:00:00', ''),
(38, 'HRD-2011-010-1-001', 1, 11, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 22, 4, 0, '0000-00-00 00:00:00', ''),
(39, 'HRD-2011-010-2-001', 1, 12, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 23, 4, 0, '0000-00-00 00:00:00', ''),
(40, 'HRD-2011-010-3-001', 1, 13, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1870000.00', '187.00', '0.00', '0.00', '31166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 24, 4, 0, '0000-00-00 00:00:00', ''),
(41, 'HRD-2011-010-3-002', 1, 13, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1870000.00', '187.00', '0.00', '0.00', '31166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 24, 4, 0, '0000-00-00 00:00:00', ''),
(42, 'HRD-2011-010-4-001', 1, 14, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 25, 4, 0, '0000-00-00 00:00:00', ''),
(43, 'HRD-2011-010-5-001', 1, 15, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1870000.00', '187.00', '0.00', '0.00', '31166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 26, 4, 0, '0000-00-00 00:00:00', ''),
(44, 'HRD-2011-010-5-002', 1, 15, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '1870000.00', '187.00', '0.00', '0.00', '31166.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 26, 4, 0, '0000-00-00 00:00:00', ''),
(45, 'HRD-2011-010-6-001', 1, 16, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6MSA001-ATEN ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '440000.00', '44.00', '0.00', '0.00', '7333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 27, 4, 0, '0000-00-00 00:00:00', ''),
(46, 'HRD-2011-010-6-002', 1, 16, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6MSA001-ATEN ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '440000.00', '44.00', '0.00', '0.00', '7333.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 27, 4, 0, '0000-00-00 00:00:00', ''),
(47, 'HRD-2011-010-7-001', 1, 17, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 28, 4, 0, '0000-00-00 00:00:00', ''),
(48, 'HRD-2011-010-7-002', 1, 17, 6, 2, NULL, 1, 0, 0, 2, 1, NULL, NULL, '6PCT001-THIN CLIENT  ', '', '', '', '', 'Y', '2011-06-23', '0000-00-00', NULL, 5, 60, '4950000.00', '495.00', '0.00', '0.00', '82500.00', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, '2011-06-23', '2016-06-23', NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 1, '0', 4, 28, 4, 0, '0000-00-00 00:00:00', ''),
(49, 'HRD-2011-016-5-001', 1, 18, 6, 3, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'Komputer Lengkap 2', 'K099999', 'hijau', 'panasonic', 'c-0888', 'Y', '2011-06-24', '0000-00-00', NULL, 5, 60, '1100.00', '1100.00', '0.00', '0.00', '18.33', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 0, '0', 5, 29, 9, 0, '0000-00-00 00:00:00', ''),
(50, 'HRD-2011-016-6-001', 1, 19, 6, 3, NULL, 4, 0, 0, 2, 1, NULL, NULL, 'Printer lengkap', 'K01999', 'merah', 'lg', 'c-890', 'Y', '2011-06-24', '0000-00-00', NULL, 5, 60, '5500000.00', '5500000.00', '0.00', '0.00', '91666.67', 0, 0, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', '0', NULL, 2011, '', 0, 'purchase', 0, '0', 5, 30, 9, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asset_outs`
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
-- Dumping data untuk tabel `asset_outs`
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
-- Struktur dari tabel `attachments`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `attachments`
--

INSERT INTO `attachments` (`id`, `name`, `attachment_file_path`, `attachment_file_name`, `attachment_file_size`, `attachment_content_type`, `npb_id`) VALUES
(1, 'Contoh PO', 'files/', 'Print-PO-0002 (1).pdf', '46536', 'application/pdf', 2),
(2, 'contoh Quotation', 'files/', 'Print-PO-0003.pdf', '47597', 'application/pdf', 5),
(3, 'contoh Quotation', 'files/', 'Print-PO-0004 (1).pdf', '46781', 'application/pdf', 6),
(4, 'tets', 'files/', 'Print-MR-016-11-0006.pdf', '45580', 'application/pdf', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aydas`
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
-- Dumping data untuk tabel `aydas`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `ayda_ages`
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
-- Dumping data untuk tabel `ayda_ages`
--

INSERT INTO `ayda_ages` (`id`, `low`, `high`, `ppap_pct`, `id_ayda_status`) VALUES
(1, 0, 1, 15, 1),
(2, 1, 3, 15, 1),
(3, 3, 5, 50, 2),
(4, 5, 2000, 100, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayda_docs`
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
-- Dumping data untuk tabel `ayda_docs`
--

INSERT INTO `ayda_docs` (`id`, `nama`, `heading`, `kode`) VALUES
(1, 'SERTIFIKAT', 1, '01'),
(2, 'SHM', 0, '0101'),
(3, 'SHGB', 0, '0102'),
(4, 'SHRSS', 0, '0103'),
(5, 'BPKB', 0, '02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayda_insurances`
--

DROP TABLE IF EXISTS `ayda_insurances`;
CREATE TABLE IF NOT EXISTS `ayda_insurances` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `ayda_insurances`
--

INSERT INTO `ayda_insurances` (`id`, `nama`) VALUES
(1, 'Asuransi Jiwa'),
(2, 'Asuransi Kebakaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayda_statuses`
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
-- Dumping data untuk tabel `ayda_statuses`
--

INSERT INTO `ayda_statuses` (`id`, `nama`, `low`, `high`) VALUES
(1, 'Lancar', 0, 15),
(2, 'Kurang lancar', 15, 50),
(3, 'Macet', 50, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayda_types`
--

DROP TABLE IF EXISTS `ayda_types`;
CREATE TABLE IF NOT EXISTS `ayda_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `ayda_types`
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
-- Struktur dari tabel `bank_accounts`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `supplier_id`, `bank_name`, `bank_account_no`, `bank_account_name`, `bank_account_type_id`, `currency_id`) VALUES
(1, 1, 'BRI', '33333', 'nAO', 1, 1),
(2, 1, 'BNI', '56534', 'Gantar khan', 1, 1),
(3, 8, 'BRI', '4445', 'Ari', 1, 1),
(4, 16, 'dwad', '1231', 'dawd', 1, 1),
(5, 12, 'wdad', '1312', 'dawd', 1, 1),
(6, 4, 'rabobank', '12345678', 'mrz computer', 1, 1),
(7, 6, 'bca', '22222', 'dunia m', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_account_types`
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
-- Dumping data untuk tabel `bank_account_types`
--

INSERT INTO `bank_account_types` (`id`, `name`, `descr`) VALUES
(1, 'Transfer', ''),
(2, 'Overbooking', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `business_types`
--

DROP TABLE IF EXISTS `business_types`;
CREATE TABLE IF NOT EXISTS `business_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `business_types`
--

INSERT INTO `business_types` (`id`, `name`) VALUES
(1, 'Wholesale'),
(2, 'Retail'),
(3, 'GFM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
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
-- Dumping data untuk tabel `ci_sessions`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `conditions`
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
-- Dumping data untuk tabel `conditions`
--

INSERT INTO `conditions` (`id`, `code`, `name`) VALUES
(10, 'JUAL', 'Dijual'),
(3, 'HILANG', 'Hilang'),
(2, 'RUSAK', 'Rusak'),
(1, 'BAGUS', 'Bagus'),
(4, 'IC', 'Intercoy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE IF NOT EXISTS `configs` (
  `key` varchar(20) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `configs`
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
-- Struktur dari tabel `cost_centers`
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
-- Dumping data untuk tabel `cost_centers`
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
-- Struktur dari tabel `currencies`
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
-- Dumping data untuk tabel `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `rp_rate`, `last_update_tgl`, `description`, `rp_BI_rate`) VALUES
(1, 'Rp', '1.00', NULL, 'Rupiah', NULL),
(2, 'USD', '10000.00', '2005-10-24 14:18:00', 'Dolar', 10500),
(3, 'AUD', '4750.00', '2005-10-24 14:13:57', 'Dolar', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `currency_details`
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
-- Dumping data untuk tabel `currency_details`
--

INSERT INTO `currency_details` (`id`, `currency_id`, `tanggal`, `rp_rate`, `rp_BI_rate`) VALUES
(1, 3, '2005-10-24 14:13:57', 4750, 0),
(2, 2, '2005-10-24 14:18:58', 10000, 10500),
(3, 3, '2011-01-13 22:40:00', 455, 654),
(4, 1, '2011-04-16 12:59:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_orders`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `po_id`, `no`, `do_date`, `delivery_date`, `supplier_id`, `department_id`, `delivery_order_status_id`, `currency_id`, `description`, `convert_invoice`, `created`, `approval_info`, `wht_rate`, `vat_rate`, `vat_base`, `vat_base_cur`, `wht_base`, `wht_base_cur`, `sub_total`, `sub_total_cur`, `discount`, `discount_cur`, `after_disc`, `after_disc_cur`, `wht_total`, `wht_total_cur`, `vat_total`, `vat_total_cur`, `total`, `total_cur`, `billing_address`, `shipping_address`, `rp_rate`, `request_type_id`, `convert_asset`, `is_journal_generated`, `journal_generated_date`, `is_first`) VALUES
(1, 1, 'xx111', '2011-06-23', '0000-00-00', 6, 2, 2, 0, 'penerimaan 1', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '44750000.00', '0.00', '0.00', '0.00', '44750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '49225000.00', '', '', '0.00', 2, 1, 0, NULL, 1),
(2, 1, 'yyyyy2', '2011-06-23', '0000-00-00', 6, 2, 2, 0, 'penerimaan2', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '31500000.00', '0.00', '0.00', '0.00', '31500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '34650000.00', '', '', '0.00', 2, 0, 0, NULL, 0),
(3, 3, 'zzzz1', '2011-06-23', '0000-00-00', 16, 2, 1, 0, 'penerimaan', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1314000000.00', '0.00', '0.00', '0.00', '1314000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1445400000.00', '', '', '0.00', 2, 0, 0, NULL, 1),
(4, 4, 'www5', '2011-06-23', '0000-00-00', 4, 2, 1, 0, 'terima', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '3661.00', '0.00', '0.00', '0.00', '3661.00', '0.00', '0.00', '0.00', '0.00', '0.00', '4027.10', '', '', '0.00', 1, 1, 0, NULL, 1),
(5, 9, '0092', '2011-06-24', '0000-00-00', 1, 2, 2, 0, '', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5001000.00', '0.00', '0.00', '0.00', '5001000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5501100.00', '', '', '0.00', 1, 1, 0, NULL, 1),
(6, 9, '0093', '2011-06-24', '0000-00-00', 1, 2, 1, 0, '', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5000000.00', '0.00', '0.00', '0.00', '5000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5500000.00', '', '', '0.00', 1, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_order_details`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data untuk tabel `delivery_order_details`
--

INSERT INTO `delivery_order_details` (`id`, `delivery_order_id`, `po_id`, `po_detail_id`, `asset_category_id`, `item_code`, `name`, `color`, `brand`, `type`, `qty`, `qty_received`, `price`, `price_cur`, `amount`, `amount_cur`, `discount`, `discount_cur`, `amount_after_disc`, `amount_after_disc_cur`, `vat`, `vat_cur`, `amount_nett`, `amount_nett_cur`, `currency_id`, `rp_rate`, `npb_id`, `umurek`, `is_vat`, `is_wht`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `item_id`, `discount_unit_cur`) VALUES
(1, 1, 1, 1, '8', '', 'K010-Kursi', '', '', '', 5, 5, '0.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '550000.00', '550000.00', 1, '0.00', 1, 5, 1, 0, 4, 0, 0, 2, 1, 3, '0.00'),
(2, 1, 1, 2, '8', '', 'K010-Kursi', '', '', '', 10, 5, '0.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '550000.00', '550000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 3, '0.00'),
(3, 1, 1, 3, '9', '', '7KRS002-KURSI HADAP', '', '', '', 5, 5, '0.00', '1000000.00', '5000000.00', '5000000.00', '0.00', '0.00', '5000000.00', '5000000.00', '500000.00', '500000.00', '5500000.00', '5500000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 35, '0.00'),
(4, 1, 1, 4, '9', '', '7KRS003-KURSI TUNGGU', '', '', '', 7, 2, '0.00', '5000000.00', '10000000.00', '10000000.00', '0.00', '0.00', '10000000.00', '10000000.00', '1000000.00', '1000000.00', '11000000.00', '11000000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 39, '0.00'),
(5, 1, 1, 5, '9', '', 'LMR001-Lemari Besi', '', '', '', 5, 5, '0.00', '5000000.00', '25000000.00', '25000000.00', '0.00', '0.00', '25000000.00', '25000000.00', '2500000.00', '2500000.00', '27500000.00', '27500000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 6, '0.00'),
(6, 1, 1, 6, '9', '', '7KRS001-KURSI KERJA', '', '', '', 5, 5, '0.00', '750000.00', '3750000.00', '3750000.00', '0.00', '0.00', '3750000.00', '3750000.00', '375000.00', '375000.00', '4125000.00', '4125000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 34, '0.00'),
(7, 1, 1, 7, '9', '', '7KRS002-KURSI HADAP', '', '', '', 4, 0, '0.00', '1500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 35, '0.00'),
(8, 2, 1, 1, '8', '', 'K010-Kursi', '', '', '', 0, 0, '0.00', '100000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 1, 5, 1, 0, 4, 0, 0, 2, 1, 3, '0.00'),
(9, 2, 1, 2, '8', '', 'K010-Kursi', '', '', '', 5, 5, '0.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '550000.00', '550000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 3, '0.00'),
(10, 2, 1, 3, '9', '', '7KRS002-KURSI HADAP', '', '', '', 0, 0, '0.00', '1000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 35, '0.00'),
(11, 2, 1, 4, '9', '', '7KRS003-KURSI TUNGGU', '', '', '', 5, 5, '0.00', '5000000.00', '25000000.00', '25000000.00', '0.00', '0.00', '25000000.00', '25000000.00', '2500000.00', '2500000.00', '27500000.00', '27500000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 39, '0.00'),
(12, 2, 1, 5, '9', '', 'LMR001-Lemari Besi', '', '', '', 0, 0, '0.00', '5000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 6, '0.00'),
(13, 2, 1, 6, '9', '', '7KRS001-KURSI KERJA', '', '', '', 0, 0, '0.00', '750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 34, '0.00'),
(14, 2, 1, 7, '9', '', '7KRS002-KURSI HADAP', '', '', '', 4, 4, '0.00', '1500000.00', '6000000.00', '6000000.00', '0.00', '0.00', '6000000.00', '6000000.00', '600000.00', '600000.00', '6600000.00', '6600000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 35, '0.00'),
(15, 3, 3, 8, '5', '', 'K09966-mobil', '', '', '', 3, 3, '0.00', '146000000.00', '438000000.00', '438000000.00', '0.00', '0.00', '438000000.00', '438000000.00', '43800000.00', '43800000.00', '481800000.00', '481800000.00', 1, '0.00', 1, 5, 1, 0, 4, 0, 0, 2, 1, 8, '0.00'),
(16, 3, 3, 9, '5', '', 'K09966-mobil', '', '', '', 2, 2, '0.00', '146000000.00', '292000000.00', '292000000.00', '0.00', '0.00', '292000000.00', '292000000.00', '29200000.00', '29200000.00', '321200000.00', '321200000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 8, '0.00'),
(17, 3, 3, 10, '5', '', 'K09966-mobil', '', '', '', 4, 4, '0.00', '146000000.00', '584000000.00', '584000000.00', '0.00', '0.00', '584000000.00', '584000000.00', '58400000.00', '58400000.00', '642400000.00', '642400000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 8, '0.00'),
(18, 4, 4, 12, '6', '', '6LCH003 -LCD HP ', '', '', '', 3, 3, '0.00', '9.00', '27.00', '27.00', '0.00', '0.00', '27.00', '27.00', '2.70', '2.70', '29.70', '29.70', 2, '0.00', 5, 5, 1, 0, 4, 0, 0, 2, 1, 27, '0.00'),
(19, 4, 4, 13, '6', '', '6MOU001-MOUSE USB', '', '', '', 2, 2, '0.00', '6.00', '12.00', '12.00', '0.00', '0.00', '12.00', '12.00', '1.20', '1.20', '13.20', '13.20', 2, '0.00', 5, 5, 1, 0, 4, 0, 0, 2, 1, 355, '0.00'),
(20, 4, 4, 14, '6', '', '6PRI001-PROJECTOR INFOCUS', '', '', '', 3, 3, '0.00', '200.00', '600.00', '600.00', '0.00', '0.00', '600.00', '600.00', '60.00', '60.00', '660.00', '660.00', 2, '0.00', 6, 5, 1, 0, 4, 0, 0, 2, 1, 353, '0.00'),
(21, 4, 4, 15, '6', '', '6MOU002-MOUSE SERIAL PS/2', '', '', '', 2, 2, '0.00', '6.00', '12.00', '12.00', '0.00', '0.00', '12.00', '12.00', '1.20', '1.20', '13.20', '13.20', 2, '0.00', 6, 5, 1, 0, 4, 0, 0, 2, 1, 356, '0.00'),
(22, 4, 4, 16, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 1, 1, '0.00', '450.00', '450.00', '450.00', '0.00', '0.00', '450.00', '450.00', '45.00', '45.00', '495.00', '495.00', 2, '0.00', 7, 5, 1, 0, 1, 0, 0, 2, 1, 22, '0.00'),
(23, 4, 4, 17, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 1, 1, '0.00', '450.00', '450.00', '450.00', '0.00', '0.00', '450.00', '450.00', '45.00', '45.00', '495.00', '495.00', 2, '0.00', 7, 5, 1, 0, 1, 0, 0, 2, 1, 22, '0.00'),
(24, 4, 4, 18, '6', '', '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', 2, 2, '0.00', '170.00', '340.00', '340.00', '0.00', '0.00', '340.00', '340.00', '34.00', '34.00', '374.00', '374.00', 2, '0.00', 7, 5, 1, 0, 1, 0, 0, 2, 1, 24, '0.00'),
(25, 4, 4, 19, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 1, 1, '0.00', '450.00', '450.00', '450.00', '0.00', '0.00', '450.00', '450.00', '45.00', '45.00', '495.00', '495.00', 2, '0.00', 8, 5, 1, 0, 1, 0, 0, 2, 1, 22, '0.00'),
(26, 4, 4, 20, '6', '', '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', 2, 2, '0.00', '170.00', '340.00', '340.00', '0.00', '0.00', '340.00', '340.00', '34.00', '34.00', '374.00', '374.00', 2, '0.00', 8, 5, 1, 0, 1, 0, 0, 2, 1, 24, '0.00'),
(27, 4, 4, 21, '6', '', '6MSA001-ATEN ', '', '', '', 2, 2, '0.00', '40.00', '80.00', '80.00', '0.00', '0.00', '80.00', '80.00', '8.00', '8.00', '88.00', '88.00', 2, '0.00', 8, 5, 1, 0, 1, 0, 0, 2, 1, 338, '0.00'),
(28, 4, 4, 22, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 2, 2, '0.00', '450.00', '900.00', '900.00', '0.00', '0.00', '900.00', '900.00', '90.00', '90.00', '990.00', '990.00', 2, '0.00', 9, 5, 1, 0, 1, 0, 0, 2, 1, 22, '0.00'),
(29, 5, 9, 31, '6', 'K099999', 'Komputer Lengkap 2', 'hijau', 'panasonic', 'c-0888', 1, 1, '0.00', '1000.00', '1000.00', '1000.00', '0.00', '0.00', '1000.00', '1000.00', '100.00', '100.00', '1100.00', '1100.00', 1, '0.00', 14, 5, 1, 0, 4, 0, 0, 2, 1, 1, '0.00'),
(30, 5, 9, 32, '6', 'K01999', 'Printer lengkap', 'merah', 'lg', 'c-890', 2, 1, '0.00', '5000000.00', '5000000.00', '5000000.00', '0.00', '0.00', '5000000.00', '5000000.00', '500000.00', '500000.00', '5500000.00', '5500000.00', 1, '0.00', 14, 5, 1, 0, 4, 0, 0, 2, 1, 2, '0.00'),
(31, 6, 9, 31, '6', 'K099999', 'Komputer Lengkap 2', 'hijau', 'panasonic', 'c-0888', 0, 0, '0.00', '1000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '0.00', 14, 5, 1, 0, 4, 0, 0, 2, 1, 1, '0.00'),
(32, 6, 9, 32, '6', 'K01999', 'Printer lengkap', 'merah', 'lg', 'c-890', 1, 1, '0.00', '5000000.00', '5000000.00', '5000000.00', '0.00', '0.00', '5000000.00', '5000000.00', '500000.00', '500000.00', '5500000.00', '5500000.00', 1, '0.00', 14, 5, 1, 0, 4, 0, 0, 2, 1, 2, '0.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_order_statuses`
--

DROP TABLE IF EXISTS `delivery_order_statuses`;
CREATE TABLE IF NOT EXISTS `delivery_order_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sorter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `delivery_order_statuses`
--

INSERT INTO `delivery_order_statuses` (`id`, `name`, `sorter`) VALUES
(1, 'New', 0),
(2, 'Done', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
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
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `account_code`, `area`, `business_type_id`) VALUES
(1, '010', 'Abdul Muis', '010', '1', 2),
(2, '012', 'Raden Sales', '012', '1', 2),
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
-- Struktur dari tabel `department_subs`
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
-- Dumping data untuk tabel `department_subs`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `department_units`
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
-- Dumping data untuk tabel `department_units`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `disposals`
--

DROP TABLE IF EXISTS `disposals`;
CREATE TABLE IF NOT EXISTS `disposals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_date` date NOT NULL,
  `no` varchar(10) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
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
  KEY `department_id` (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `disposals`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `disposal_details`
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
-- Dumping data untuk tabel `disposal_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `disposal_statuses`
--

DROP TABLE IF EXISTS `disposal_statuses`;
CREATE TABLE IF NOT EXISTS `disposal_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data untuk tabel `disposal_statuses`
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
-- Struktur dari tabel `disposal_types`
--

DROP TABLE IF EXISTS `disposal_types`;
CREATE TABLE IF NOT EXISTS `disposal_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `disposal_types`
--

INSERT INTO `disposal_types` (`id`, `name`) VALUES
(1, 'Write Off'),
(2, 'Sales');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
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
-- Dumping data untuk tabel `groups`
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
(16, 'IT Supervisor', 'IT Supervisor', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups_menus`
--

DROP TABLE IF EXISTS `groups_menus`;
CREATE TABLE IF NOT EXISTS `groups_menus` (
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `groups_menus_FKIndex1` (`group_id`),
  KEY `groups_menus_FKIndex2` (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `groups_menus`
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
(375, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inlogs`
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
-- Dumping data untuk tabel `inlogs`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `inlog_details`
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
-- Dumping data untuk tabel `inlog_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `inlog_statuses`
--

DROP TABLE IF EXISTS `inlog_statuses`;
CREATE TABLE IF NOT EXISTS `inlog_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `inlog_statuses`
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
-- Struktur dari tabel `inventory_ledgers`
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
-- Dumping data untuk tabel `inventory_ledgers`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
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
-- Dumping data untuk tabel `invoices`
--

INSERT INTO `invoices` (`id`, `no`, `inv_date`, `supplier_id`, `department_id`, `currency_id`, `description`, `po_no`, `paid_date`, `paid_bank_name`, `paid_bank_account_no`, `paid_bank_account_name`, `paid_bank_account_type_id`, `convert_asset`, `created`, `wht_rate`, `vat_rate`, `sub_total`, `vat_base`, `wht_base`, `discount`, `after_disc`, `wht_total`, `vat_total`, `total`, `billing_address`, `shipping_address`, `status_invoice_id`, `rp_rate`, `bank_account_id`, `request_type_id`, `date_due`) VALUES
(1, '333', '2011-06-23', 4, NULL, 2, 'bayar sblm tgl 25062011', '', '2011-06-23', '', '', '', 0, 0, '2011-06-23 18:26:51', '2.00', '10.00', '36610000.00', '36610000.00', '0.00', '0.00', '36610000.00', '0.00', '3661000.00', '40271000.00', '', '', 6, '9000.00', 0, 1, NULL),
(2, '999', '2011-06-23', 6, NULL, 1, '', '', '2011-06-23', '', '', '', 0, 0, '2011-06-23 18:31:38', '2.00', '10.00', '76250000.00', '76250000.00', '0.00', '0.00', '76250000.00', '0.00', '7625000.00', '83875000.00', '', '', 6, '1.00', 0, 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices_delivery_orders`
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
-- Dumping data untuk tabel `invoices_delivery_orders`
--

INSERT INTO `invoices_delivery_orders` (`id`, `invoice_id`, `delivery_order_id`) VALUES
(2, 1, 4),
(6, 2, 2),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices_journal_transactions`
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
-- Dumping data untuk tabel `invoices_journal_transactions`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices_pos`
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
-- Dumping data untuk tabel `invoices_pos`
--

INSERT INTO `invoices_pos` (`id`, `invoice_id`, `po_id`) VALUES
(1, 1, 4),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices_po_payments`
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
-- Dumping data untuk tabel `invoices_po_payments`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices_purchases`
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
-- Dumping data untuk tabel `invoices_purchases`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_bank_account_types`
--

DROP TABLE IF EXISTS `invoice_bank_account_types`;
CREATE TABLE IF NOT EXISTS `invoice_bank_account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `invoice_bank_account_types`
--

INSERT INTO `invoice_bank_account_types` (`id`, `name`, `description`) VALUES
(1, 'Cash', 'Cash'),
(2, 'Cheque', 'Cheque'),
(3, 'Transfer', 'Bank Transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_details`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `asset_category_id`, `name`, `color`, `brand`, `type`, `qty`, `price`, `price_cur`, `amount`, `amount_cur`, `discount`, `discount_cur`, `amount_after_disc`, `amount_after_disc_cur`, `vat`, `vat_cur`, `wht`, `wht_cur`, `amount_nett`, `amount_nett_cur`, `currency_id`, `rp_rate`, `vat_rate`, `wht_rate`, `npb_id`, `po_id`, `umurek`, `is_vat`, `is_wht`, `department_id`, `item_id`) VALUES
(1, 1, 6, '6LCH003 -LCD HP ', '', '', '', 3, '90000.00', '9.00', '270000.00', '27.00', '0.00', '0.00', '270000.00', '27.00', '27000.00', '2.70', '0.00', '0.00', '297000.00', '29.70', 2, '10000.00', '10.00', '2.00', 5, 4, 5, 1, 0, 4, 27),
(2, 1, 6, '6MOU001-MOUSE USB', '', '', '', 2, '60000.00', '6.00', '120000.00', '12.00', '0.00', '0.00', '120000.00', '12.00', '12000.00', '1.20', '0.00', '0.00', '132000.00', '13.20', 2, '10000.00', '10.00', '2.00', 5, 4, 5, 1, 0, 4, 355),
(3, 1, 6, '6PRI001-PROJECTOR INFOCUS', '', '', '', 3, '2000000.00', '200.00', '6000000.00', '600.00', '0.00', '0.00', '6000000.00', '600.00', '600000.00', '60.00', '0.00', '0.00', '6600000.00', '660.00', 2, '10000.00', '10.00', '2.00', 6, 4, 5, 1, 0, 4, 353),
(4, 1, 6, '6MOU002-MOUSE SERIAL PS/2', '', '', '', 2, '60000.00', '6.00', '120000.00', '12.00', '0.00', '0.00', '120000.00', '12.00', '12000.00', '1.20', '0.00', '0.00', '132000.00', '13.20', 2, '10000.00', '10.00', '2.00', 6, 4, 5, 1, 0, 4, 356),
(5, 1, 6, '6PCT001-THIN CLIENT  ', '', '', '', 1, '4500000.00', '450.00', '4500000.00', '450.00', '0.00', '0.00', '4500000.00', '450.00', '450000.00', '45.00', '0.00', '0.00', '4950000.00', '495.00', 2, '10000.00', '10.00', '2.00', 7, 4, 5, 1, 0, 1, 22),
(6, 1, 6, '6PCT001-THIN CLIENT  ', '', '', '', 1, '4500000.00', '450.00', '4500000.00', '450.00', '0.00', '0.00', '4500000.00', '450.00', '450000.00', '45.00', '0.00', '0.00', '4950000.00', '495.00', 2, '10000.00', '10.00', '2.00', 7, 4, 5, 1, 0, 1, 22),
(7, 1, 6, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', 2, '1700000.00', '170.00', '3400000.00', '340.00', '0.00', '0.00', '3400000.00', '340.00', '340000.00', '34.00', '0.00', '0.00', '3740000.00', '374.00', 2, '10000.00', '10.00', '2.00', 7, 4, 5, 1, 0, 1, 24),
(8, 1, 6, '6PCT001-THIN CLIENT  ', '', '', '', 1, '4500000.00', '450.00', '4500000.00', '450.00', '0.00', '0.00', '4500000.00', '450.00', '450000.00', '45.00', '0.00', '0.00', '4950000.00', '495.00', 2, '10000.00', '10.00', '2.00', 8, 4, 5, 1, 0, 1, 22),
(9, 1, 6, '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', 2, '1700000.00', '170.00', '3400000.00', '340.00', '0.00', '0.00', '3400000.00', '340.00', '340000.00', '34.00', '0.00', '0.00', '3740000.00', '374.00', 2, '10000.00', '10.00', '2.00', 8, 4, 5, 1, 0, 1, 24),
(10, 1, 6, '6MSA001-ATEN ', '', '', '', 2, '400000.00', '40.00', '800000.00', '80.00', '0.00', '0.00', '800000.00', '80.00', '80000.00', '8.00', '0.00', '0.00', '880000.00', '88.00', 2, '10000.00', '10.00', '2.00', 8, 4, 5, 1, 0, 1, 338),
(11, 1, 6, '6PCT001-THIN CLIENT  ', '', '', '', 2, '4500000.00', '450.00', '9000000.00', '900.00', '0.00', '0.00', '9000000.00', '900.00', '900000.00', '90.00', '0.00', '0.00', '9900000.00', '990.00', 2, '10000.00', '10.00', '2.00', 9, 4, 5, 1, 0, 1, 22),
(12, 2, 8, 'K010-Kursi', '', '', '', 5, '100000.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '0.00', '0.00', '550000.00', '550000.00', 1, '1.00', '10.00', '2.00', 1, 1, 5, 1, 0, 4, 3),
(13, 2, 8, 'K010-Kursi', '', '', '', 5, '100000.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '0.00', '0.00', '550000.00', '550000.00', 1, '1.00', '10.00', '2.00', 2, 1, 5, 1, 0, 4, 3),
(14, 2, 9, '7KRS002-KURSI HADAP', '', '', '', 5, '1000000.00', '1000000.00', '5000000.00', '5000000.00', '0.00', '0.00', '5000000.00', '5000000.00', '500000.00', '500000.00', '0.00', '0.00', '5500000.00', '5500000.00', 1, '1.00', '10.00', '2.00', 2, 1, 5, 1, 0, 4, 35),
(15, 2, 9, '7KRS003-KURSI TUNGGU', '', '', '', 2, '5000000.00', '5000000.00', '10000000.00', '10000000.00', '0.00', '0.00', '10000000.00', '10000000.00', '1000000.00', '1000000.00', '0.00', '0.00', '11000000.00', '11000000.00', 1, '1.00', '10.00', '2.00', 2, 1, 5, 1, 0, 4, 39),
(16, 2, 9, 'LMR001-Lemari Besi', '', '', '', 5, '5000000.00', '5000000.00', '25000000.00', '25000000.00', '0.00', '0.00', '25000000.00', '25000000.00', '2500000.00', '2500000.00', '0.00', '0.00', '27500000.00', '27500000.00', 1, '1.00', '10.00', '2.00', 3, 1, 5, 1, 0, 1, 6),
(17, 2, 9, '7KRS001-KURSI KERJA', '', '', '', 5, '750000.00', '750000.00', '3750000.00', '3750000.00', '0.00', '0.00', '3750000.00', '3750000.00', '375000.00', '375000.00', '0.00', '0.00', '4125000.00', '4125000.00', 1, '1.00', '10.00', '2.00', 3, 1, 5, 1, 0, 1, 34),
(18, 2, 9, '7KRS002-KURSI HADAP', '', '', '', 0, '1500000.00', '1500000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '2.00', 3, 1, 5, 1, 0, 1, 35),
(19, 2, 8, 'K010-Kursi', '', '', '', 0, '100000.00', '100000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '2.00', 1, 1, 5, 1, 0, 4, 3),
(20, 2, 8, 'K010-Kursi', '', '', '', 5, '100000.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '0.00', '0.00', '550000.00', '550000.00', 1, '1.00', '10.00', '2.00', 2, 1, 5, 1, 0, 4, 3),
(21, 2, 9, '7KRS002-KURSI HADAP', '', '', '', 0, '1000000.00', '1000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '2.00', 2, 1, 5, 1, 0, 4, 35),
(22, 2, 9, '7KRS003-KURSI TUNGGU', '', '', '', 5, '5000000.00', '5000000.00', '25000000.00', '25000000.00', '0.00', '0.00', '25000000.00', '25000000.00', '2500000.00', '2500000.00', '0.00', '0.00', '27500000.00', '27500000.00', 1, '1.00', '10.00', '2.00', 2, 1, 5, 1, 0, 4, 39),
(23, 2, 9, 'LMR001-Lemari Besi', '', '', '', 0, '5000000.00', '5000000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '2.00', 3, 1, 5, 1, 0, 1, 6),
(24, 2, 9, '7KRS001-KURSI KERJA', '', '', '', 0, '750000.00', '750000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, '1.00', '10.00', '2.00', 3, 1, 5, 1, 0, 1, 34),
(25, 2, 9, '7KRS002-KURSI HADAP', '', '', '', 4, '1500000.00', '1500000.00', '6000000.00', '6000000.00', '0.00', '0.00', '6000000.00', '6000000.00', '600000.00', '600000.00', '0.00', '0.00', '6600000.00', '6600000.00', 1, '1.00', '10.00', '2.00', 3, 1, 5, 1, 0, 1, 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_payments`
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
  `bank_account_id` int(11) DEFAULT NULL,
  `bank_account_type_id` int(11) DEFAULT NULL,
  `is_posted` tinyint(1) DEFAULT '0',
  `posted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_payment_idx` (`invoice_id`,`po_id`,`term_no`,`bank_account_id`,`bank_account_type_id`),
  KEY `is_postedx` (`is_posted`),
  KEY `posted_datex` (`posted_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `no`, `term_no`, `term_percent`, `date_due`, `date_paid`, `amount_due`, `amount_paid`, `description`, `amount_invoice`, `amount_po`, `po_id`, `bank_account_id`, `bank_account_type_id`, `is_posted`, `posted_date`) VALUES
(1, 1, '999', 1, '100.00', '2011-07-23', '2011-06-23', '40271000.00', '40271000.00', 'pembyr', '40271000.00', NULL, NULL, 6, 1, 0, NULL),
(2, 2, '77777', 1, '35.77', '2011-07-23', '2011-06-23', '83875000.00', '30000000.00', '', '83875000.00', NULL, NULL, 7, 1, 0, NULL),
(3, 2, '66666', 2, '64.23', '2011-07-23', '2011-06-23', '53875000.00', '53875000.00', '', '83875000.00', NULL, NULL, 7, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_statuses`
--

DROP TABLE IF EXISTS `invoice_statuses`;
CREATE TABLE IF NOT EXISTS `invoice_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `invoice_statuses`
--

INSERT INTO `invoice_statuses` (`id`, `name`, `description`) VALUES
(1, 'New', ''),
(2, 'Unpaid', ''),
(3, 'Paid', ''),
(4, 'Registered to Asset', 'Registered to Asset'),
(5, 'Receive Journal Posted', ''),
(6, 'DONE - Payment Journal Posted', ''),
(7, 'Term Payment Journal Posted', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
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
-- Dumping data untuk tabel `items`
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
-- Struktur dari tabel `journal_groups`
--

DROP TABLE IF EXISTS `journal_groups`;
CREATE TABLE IF NOT EXISTS `journal_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `journal_groups`
--

INSERT INTO `journal_groups` (`id`, `name`) VALUES
(1, 'Penerimaan Barang'),
(2, 'Mutasi FA'),
(3, 'Write Off FA'),
(4, 'Pembayaran Supplier'),
(5, 'Penyusutan FA'),
(6, 'Distribusi dari Head Office ke Branch'),
(7, 'Distribusi dari Head Office ke Unit Kerja'),
(8, 'Penjualan FA'),
(9, 'Inlog'),
(10, 'Retur Cabang'),
(11, 'Retur Supplier'),
(12, 'Pemakaian Barang'),
(14, 'Pembelian FA dengan DP'),
(15, 'Pembelian FA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `journal_positions`
--

DROP TABLE IF EXISTS `journal_positions`;
CREATE TABLE IF NOT EXISTS `journal_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `journal_positions`
--

INSERT INTO `journal_positions` (`id`, `name`) VALUES
(1, 'Debit'),
(2, 'Credit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `journal_templates`
--

DROP TABLE IF EXISTS `journal_templates`;
CREATE TABLE IF NOT EXISTS `journal_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `journal_group_id` int(10) unsigned NOT NULL,
  `asset_category_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_template_id` (`journal_group_id`,`asset_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;

--
-- Dumping data untuk tabel `journal_templates`
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
(15, 8, 3, 'Penjualan FA Gedung'),
(16, 8, 4, 'Penjualan FA Instalasi'),
(17, 8, 5, 'Penjualan FA Kendaraan'),
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
(56, 8, 1, 'Penjualan Tanah'),
(58, 8, 6, 'Penjualan Hardware'),
(59, 8, 7, 'Penjualan Peripheral'),
(60, 8, 8, 'Penjualan Inv I'),
(61, 8, 9, 'Penjualan Inv II'),
(62, 8, 10, 'Penjualan Software'),
(63, 8, 11, 'Penjualan Leasehold'),
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
(212, 14, 0, 'Uang Muka Pembelian FA'),
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
(277, 15, 0, 'Pembelian FA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `journal_template_details`
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
  PRIMARY KEY (`id`),
  KEY `journal_template_id` (`journal_template_id`,`account_id`,`journal_position_id`),
  KEY `destination_branch` (`for_destination_branch`),
  KEY `for_profit_sales` (`for_profit_sales`),
  KEY `for_purchase_with_dp` (`for_purchase_with_dp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=485 ;

--
-- Dumping data untuk tabel `journal_template_details`
--

INSERT INTO `journal_template_details` (`id`, `journal_template_id`, `account_id`, `journal_position_id`, `for_destination_branch`, `for_profit_sales`, `for_purchase_with_dp`) VALUES
(6, 3, 122, 1, 0, 1, 0),
(4, 2, 1, 1, 0, 0, 0),
(5, 2, 59, 2, 0, 0, 0),
(7, 3, 59, 2, 0, 0, 0),
(8, 4, 7, 1, 0, 0, 0),
(9, 4, 59, 2, 0, 0, 0),
(13, 11, 2, 2, 0, 0, 0),
(12, 11, 3, 1, 0, 0, 0),
(14, 12, 6, 1, 0, 0, 0),
(15, 12, 5, 2, 0, 0, 0),
(16, 15, 2, 1, 0, 1, 0),
(17, 18, 59, 1, 0, 0, 0),
(18, 18, 39, 2, 0, 0, 0),
(19, 5, 4, 1, 0, 1, 0),
(20, 5, 59, 2, 0, 1, 0),
(23, 19, 39, 2, 0, 0, 0),
(22, 19, 59, 1, 0, 0, 0),
(25, 20, 39, 2, 0, 0, 0),
(26, 20, 59, 1, 0, 0, 0),
(27, 26, 101, 1, 0, 0, 0),
(28, 26, 100, 2, 0, 0, 0),
(29, 21, 9, 1, 0, 0, 0),
(30, 21, 8, 2, 0, 0, 0),
(31, 22, 6, 1, 0, 0, 0),
(32, 22, 5, 2, 0, 0, 0),
(33, 27, 92, 1, 0, 0, 0),
(34, 27, 21, 2, 0, 0, 0),
(35, 28, 95, 1, 0, 0, 0),
(36, 28, 94, 2, 0, 0, 0),
(37, 13, 100, 1, 0, 0, 0),
(38, 13, 99, 2, 0, 0, 0),
(39, 30, 1, 2, 0, 0, 0),
(40, 30, 103, 1, 0, 0, 0),
(41, 30, 2, 1, 0, 0, 0),
(42, 30, 1, 1, 1, 0, 0),
(43, 30, 102, 2, 1, 0, 0),
(44, 30, 2, 2, 1, 0, 0),
(45, 33, 5, 1, 0, 0, 0),
(46, 33, 103, 1, 0, 0, 0),
(47, 33, 4, 2, 0, 0, 0),
(48, 33, 4, 1, 1, 0, 0),
(49, 33, 102, 2, 1, 0, 0),
(50, 33, 5, 2, 1, 0, 0),
(51, 9, 20, 1, 0, 0, 0),
(52, 9, 59, 2, 0, 0, 0),
(53, 6, 96, 1, 0, 0, 0),
(54, 6, 59, 2, 0, 0, 0),
(55, 39, 59, 1, 0, 0, 0),
(56, 39, 39, 2, 0, 0, 0),
(57, 40, 59, 1, 0, 0, 0),
(58, 40, 39, 2, 0, 0, 0),
(59, 15, 39, 1, 0, 1, 0),
(60, 15, 56, 2, 0, 1, 0),
(61, 15, 1, 2, 0, 1, 0),
(62, 15, 57, 1, 0, 0, 0),
(63, 16, 5, 1, 0, 1, 0),
(64, 16, 39, 1, 0, 1, 0),
(65, 16, 56, 2, 0, 1, 0),
(66, 16, 4, 2, 0, 1, 0),
(67, 16, 5, 1, 0, 0, 0),
(68, 16, 39, 1, 0, 0, 0),
(69, 16, 57, 1, 0, 0, 0),
(70, 16, 4, 2, 0, 0, 0),
(71, 17, 8, 1, 0, 1, 0),
(72, 17, 39, 1, 0, 1, 0),
(73, 17, 56, 2, 0, 1, 0),
(74, 17, 7, 2, 0, 1, 0),
(75, 17, 8, 1, 0, 0, 0),
(76, 17, 39, 1, 0, 0, 0),
(77, 17, 57, 1, 0, 0, 0),
(78, 17, 7, 2, 0, 0, 0),
(79, 58, 5, 1, 0, 1, 0),
(80, 58, 39, 1, 0, 1, 0),
(81, 58, 56, 2, 0, 1, 0),
(82, 58, 4, 2, 0, 1, 0),
(83, 58, 5, 1, 0, 0, 0),
(84, 58, 39, 1, 0, 0, 0),
(85, 58, 57, 1, 0, 0, 0),
(86, 58, 4, 2, 0, 0, 0),
(87, 62, 21, 1, 0, 1, 0),
(88, 62, 39, 1, 0, 1, 0),
(89, 62, 56, 2, 0, 1, 0),
(90, 62, 20, 2, 0, 1, 0),
(91, 62, 21, 1, 0, 0, 0),
(92, 62, 39, 1, 0, 0, 0),
(93, 62, 57, 1, 0, 0, 0),
(94, 62, 20, 2, 0, 0, 0),
(95, 56, 100, 1, 0, 1, 0),
(96, 56, 39, 1, 0, 1, 0),
(97, 56, 56, 2, 0, 1, 0),
(98, 56, 99, 2, 0, 1, 0),
(99, 56, 100, 1, 0, 0, 0),
(100, 56, 39, 1, 0, 0, 0),
(101, 56, 57, 1, 0, 0, 0),
(102, 56, 99, 2, 0, 0, 0),
(103, 63, 94, 1, 0, 1, 0),
(104, 63, 39, 1, 0, 1, 0),
(105, 63, 56, 2, 0, 1, 0),
(106, 63, 93, 2, 0, 1, 0),
(107, 63, 94, 1, 0, 0, 0),
(108, 63, 39, 1, 0, 0, 0),
(109, 63, 57, 1, 0, 0, 0),
(110, 63, 93, 2, 0, 0, 0),
(111, 45, 5, 1, 0, 1, 0),
(112, 45, 104, 1, 0, 1, 0),
(113, 45, 4, 2, 0, 1, 0),
(114, 25, 6, 1, 0, 1, 0),
(115, 25, 5, 2, 0, 1, 0),
(116, 64, 105, 1, 0, 1, 0),
(117, 64, 59, 2, 0, 1, 0),
(118, 65, 59, 1, 0, 1, 0),
(119, 65, 39, 2, 0, 1, 0),
(120, 35, 103, 1, 0, 1, 0),
(121, 35, 5, 1, 0, 1, 0),
(122, 35, 4, 2, 0, 1, 0),
(123, 35, 4, 1, 1, 1, 0),
(124, 35, 5, 2, 1, 1, 0),
(125, 35, 102, 2, 1, 1, 0),
(126, 1, 119, 1, 0, 1, 0),
(127, 1, 59, 2, 0, 1, 0),
(128, 7, 125, 1, 0, 1, 0),
(129, 7, 59, 2, 0, 1, 0),
(130, 8, 126, 1, 0, 1, 0),
(131, 8, 59, 2, 0, 1, 0),
(132, 10, 93, 1, 0, 1, 0),
(133, 10, 59, 2, 0, 1, 0),
(134, 81, 109, 1, 0, 1, 0),
(135, 81, 59, 2, 0, 1, 0),
(136, 82, 111, 1, 0, 1, 0),
(137, 82, 59, 2, 0, 1, 0),
(138, 79, 108, 1, 0, 1, 0),
(139, 79, 59, 2, 0, 1, 0),
(140, 83, 110, 1, 0, 1, 0),
(141, 83, 59, 2, 0, 1, 0),
(142, 84, 112, 1, 0, 1, 0),
(143, 84, 59, 2, 0, 1, 0),
(144, 85, 113, 1, 0, 1, 0),
(145, 85, 59, 2, 0, 1, 0),
(146, 86, 114, 1, 0, 1, 0),
(147, 86, 59, 2, 0, 1, 0),
(148, 87, 115, 1, 0, 1, 0),
(149, 87, 59, 2, 0, 1, 0),
(150, 88, 116, 1, 0, 1, 0),
(151, 88, 59, 2, 0, 1, 0),
(152, 90, 117, 1, 0, 1, 0),
(153, 90, 59, 2, 0, 1, 0),
(154, 91, 118, 1, 0, 1, 0),
(155, 91, 59, 2, 0, 1, 0),
(156, 92, 120, 1, 0, 1, 0),
(157, 92, 59, 2, 0, 1, 0),
(158, 29, 120, 2, 0, 1, 0),
(159, 29, 152, 1, 0, 1, 0),
(160, 52, 59, 1, 0, 1, 0),
(161, 52, 39, 2, 0, 1, 0),
(162, 53, 59, 1, 0, 1, 0),
(163, 53, 39, 2, 0, 1, 0),
(164, 54, 59, 1, 0, 1, 0),
(165, 54, 39, 2, 0, 1, 0),
(166, 55, 59, 1, 0, 1, 0),
(167, 55, 39, 2, 0, 1, 0),
(168, 51, 59, 1, 0, 1, 0),
(169, 51, 39, 2, 0, 1, 0),
(170, 80, 59, 1, 0, 1, 0),
(171, 80, 39, 2, 0, 1, 0),
(172, 23, 143, 1, 0, 1, 0),
(173, 23, 144, 2, 0, 1, 0),
(174, 24, 145, 1, 0, 1, 0),
(175, 24, 146, 2, 0, 1, 0),
(176, 59, 147, 1, 0, 1, 0),
(177, 59, 39, 1, 0, 1, 0),
(178, 59, 153, 2, 0, 1, 0),
(179, 59, 129, 2, 0, 1, 0),
(180, 60, 144, 1, 0, 1, 0),
(181, 60, 39, 1, 0, 1, 0),
(182, 60, 149, 2, 0, 1, 0),
(183, 60, 125, 2, 0, 1, 0),
(184, 61, 146, 1, 0, 1, 0),
(185, 61, 39, 1, 0, 1, 0),
(186, 61, 153, 2, 0, 1, 0),
(187, 61, 126, 2, 0, 1, 0),
(188, 61, 146, 1, 0, 1, 0),
(189, 61, 39, 1, 0, 1, 0),
(190, 61, 149, 1, 0, 1, 0),
(191, 61, 126, 2, 0, 1, 0),
(192, 41, 2, 1, 0, 1, 0),
(193, 41, 150, 1, 0, 1, 0),
(194, 41, 1, 2, 0, 1, 0),
(195, 43, 5, 1, 0, 1, 0),
(196, 43, 149, 1, 0, 1, 0),
(197, 43, 122, 2, 0, 1, 0),
(198, 44, 8, 1, 0, 1, 0),
(199, 44, 150, 1, 0, 1, 0),
(200, 44, 7, 2, 0, 1, 0),
(201, 46, 147, 1, 0, 1, 0),
(202, 46, 150, 1, 0, 1, 0),
(203, 46, 129, 2, 0, 1, 0),
(204, 47, 144, 1, 0, 1, 0),
(205, 47, 150, 1, 0, 1, 0),
(206, 47, 125, 2, 0, 1, 0),
(207, 48, 146, 1, 0, 1, 0),
(208, 48, 150, 1, 0, 1, 0),
(209, 48, 126, 2, 0, 1, 0),
(210, 49, 21, 1, 0, 1, 0),
(211, 49, 150, 1, 0, 1, 0),
(212, 49, 128, 2, 0, 1, 0),
(213, 117, 119, 2, 0, 1, 0),
(214, 117, 142, 1, 0, 1, 0),
(215, 118, 142, 1, 0, 1, 0),
(216, 118, 120, 2, 0, 1, 0),
(217, 119, 142, 1, 0, 1, 0),
(218, 119, 121, 2, 0, 1, 0),
(219, 120, 142, 1, 0, 1, 0),
(220, 120, 122, 2, 0, 1, 0),
(221, 121, 142, 1, 0, 1, 0),
(222, 121, 7, 2, 0, 1, 0),
(223, 122, 142, 1, 0, 1, 0),
(224, 122, 124, 2, 0, 1, 0),
(225, 125, 142, 1, 0, 1, 0),
(226, 125, 129, 2, 0, 1, 0),
(227, 123, 142, 1, 0, 1, 0),
(228, 123, 125, 2, 0, 1, 0),
(229, 124, 142, 1, 0, 1, 0),
(230, 124, 126, 2, 0, 1, 0),
(231, 126, 142, 1, 0, 1, 0),
(232, 126, 128, 2, 0, 1, 0),
(233, 127, 142, 1, 0, 1, 0),
(234, 127, 129, 2, 0, 1, 0),
(235, 106, 142, 1, 0, 1, 0),
(236, 106, 109, 2, 0, 1, 0),
(237, 108, 142, 1, 0, 1, 0),
(238, 108, 111, 2, 0, 1, 0),
(239, 107, 142, 1, 0, 1, 0),
(240, 107, 110, 2, 0, 1, 0),
(241, 112, 142, 1, 0, 1, 0),
(242, 112, 112, 2, 0, 1, 0),
(243, 109, 142, 1, 0, 1, 0),
(244, 109, 113, 2, 0, 1, 0),
(245, 110, 142, 1, 0, 1, 0),
(246, 110, 114, 2, 0, 1, 0),
(247, 111, 142, 1, 0, 1, 0),
(248, 111, 115, 2, 0, 1, 0),
(249, 114, 142, 1, 0, 1, 0),
(250, 114, 116, 2, 0, 1, 0),
(251, 115, 142, 1, 0, 1, 0),
(252, 115, 117, 2, 0, 1, 0),
(253, 116, 142, 1, 0, 1, 0),
(254, 116, 118, 2, 0, 1, 0),
(255, 105, 141, 1, 0, 1, 0),
(256, 105, 108, 2, 0, 1, 0),
(257, 113, 142, 1, 0, 1, 0),
(258, 113, 137, 2, 0, 1, 0),
(259, 94, 132, 1, 0, 1, 0),
(260, 94, 109, 2, 0, 1, 0),
(261, 96, 134, 1, 0, 1, 0),
(262, 96, 111, 2, 0, 1, 0),
(263, 95, 133, 1, 0, 1, 0),
(264, 95, 110, 2, 0, 1, 0),
(265, 100, 135, 1, 0, 1, 0),
(266, 100, 112, 2, 0, 1, 0),
(267, 97, 134, 1, 0, 1, 0),
(268, 97, 113, 2, 0, 1, 0),
(269, 98, 134, 1, 0, 1, 0),
(270, 98, 114, 2, 0, 1, 0),
(271, 99, 134, 1, 0, 1, 0),
(272, 99, 115, 2, 0, 1, 0),
(273, 102, 138, 1, 0, 1, 0),
(274, 102, 116, 2, 0, 1, 0),
(275, 103, 139, 1, 0, 1, 0),
(276, 103, 117, 2, 0, 1, 0),
(277, 104, 140, 1, 0, 1, 0),
(278, 104, 118, 2, 0, 1, 0),
(279, 93, 131, 1, 0, 1, 0),
(280, 93, 108, 2, 0, 1, 0),
(281, 101, 136, 1, 0, 1, 0),
(282, 101, 137, 2, 0, 1, 0),
(283, 31, 5, 1, 0, 1, 0),
(284, 31, 103, 1, 0, 1, 0),
(285, 31, 122, 2, 0, 1, 0),
(286, 31, 122, 1, 1, 1, 0),
(287, 31, 102, 2, 1, 1, 0),
(288, 31, 5, 2, 1, 1, 0),
(289, 32, 8, 1, 0, 1, 0),
(290, 32, 103, 1, 0, 1, 0),
(291, 32, 7, 2, 0, 1, 0),
(292, 32, 7, 1, 1, 1, 0),
(293, 32, 102, 2, 1, 1, 0),
(294, 32, 8, 2, 1, 1, 0),
(295, 34, 147, 1, 0, 1, 0),
(296, 34, 103, 1, 0, 1, 0),
(297, 34, 127, 2, 0, 1, 0),
(298, 34, 129, 1, 1, 1, 0),
(299, 34, 102, 2, 1, 1, 0),
(300, 34, 147, 2, 1, 1, 0),
(301, 36, 146, 1, 0, 1, 0),
(302, 36, 103, 1, 0, 1, 0),
(303, 36, 126, 1, 1, 1, 0),
(304, 36, 126, 2, 0, 1, 0),
(305, 36, 102, 2, 1, 1, 0),
(306, 36, 146, 2, 1, 1, 0),
(307, 37, 21, 1, 0, 1, 0),
(308, 37, 103, 1, 0, 1, 0),
(309, 37, 128, 1, 1, 1, 0),
(310, 37, 128, 2, 0, 1, 0),
(311, 37, 102, 2, 1, 1, 0),
(312, 37, 21, 2, 1, 1, 0),
(313, 1, 154, 2, 0, 1, 0),
(314, 2, 154, 2, 0, 1, 0),
(315, 3, 154, 2, 0, 1, 0),
(316, 4, 154, 2, 0, 1, 0),
(317, 5, 154, 2, 0, 1, 0),
(318, 6, 154, 2, 0, 1, 0),
(319, 7, 154, 2, 0, 1, 0),
(320, 8, 154, 2, 0, 1, 0),
(321, 9, 154, 2, 0, 1, 0),
(322, 10, 154, 2, 0, 1, 0),
(323, 81, 154, 2, 0, 1, 0),
(324, 82, 154, 2, 0, 1, 0),
(325, 79, 154, 2, 0, 1, 0),
(326, 83, 154, 2, 0, 1, 0),
(327, 84, 154, 2, 0, 1, 0),
(328, 85, 154, 2, 0, 1, 0),
(329, 86, 154, 2, 0, 1, 0),
(330, 87, 154, 2, 0, 1, 0),
(331, 88, 154, 2, 0, 1, 0),
(332, 90, 154, 2, 0, 1, 0),
(333, 91, 154, 2, 0, 1, 0),
(334, 92, 154, 2, 0, 1, 0),
(342, 132, 59, 1, 0, 1, 0),
(343, 132, 125, 2, 0, 1, 0),
(344, 134, 59, 1, 0, 1, 0),
(345, 134, 126, 2, 0, 1, 0),
(346, 137, 59, 1, 0, 1, 0),
(347, 137, 109, 2, 0, 1, 0),
(348, 138, 59, 1, 0, 1, 0),
(349, 138, 111, 2, 0, 1, 0),
(350, 139, 59, 1, 0, 1, 0),
(351, 139, 108, 2, 0, 1, 0),
(352, 140, 59, 1, 0, 1, 0),
(353, 140, 110, 2, 0, 1, 0),
(354, 141, 112, 2, 0, 1, 0),
(355, 141, 59, 1, 0, 1, 0),
(356, 142, 113, 2, 0, 1, 0),
(357, 142, 59, 1, 0, 1, 0),
(358, 143, 114, 2, 0, 1, 0),
(359, 143, 59, 1, 0, 1, 0),
(360, 144, 115, 2, 0, 1, 0),
(361, 144, 59, 1, 0, 1, 0),
(362, 145, 59, 1, 0, 1, 0),
(363, 145, 116, 2, 0, 1, 0),
(364, 146, 117, 2, 0, 1, 0),
(365, 146, 59, 1, 0, 1, 0),
(366, 147, 118, 2, 0, 1, 0),
(367, 147, 59, 1, 0, 1, 0),
(368, 148, 59, 1, 0, 1, 0),
(369, 148, 137, 2, 0, 1, 0),
(370, 149, 109, 1, 0, 1, 0),
(371, 149, 141, 2, 0, 1, 0),
(372, 150, 111, 1, 0, 1, 0),
(373, 150, 141, 2, 0, 1, 0),
(374, 151, 108, 1, 0, 1, 0),
(375, 151, 141, 2, 0, 1, 0),
(376, 152, 110, 1, 0, 1, 0),
(377, 152, 141, 2, 0, 1, 0),
(378, 153, 141, 2, 0, 1, 0),
(379, 153, 112, 1, 0, 1, 0),
(380, 154, 141, 2, 0, 1, 0),
(381, 154, 113, 1, 0, 1, 0),
(382, 155, 114, 1, 0, 1, 0),
(383, 155, 141, 2, 0, 1, 0),
(384, 156, 115, 1, 0, 1, 0),
(385, 156, 141, 2, 0, 1, 0),
(386, 157, 116, 1, 0, 1, 0),
(387, 157, 141, 2, 0, 1, 0),
(388, 158, 117, 1, 0, 1, 0),
(389, 158, 141, 2, 0, 1, 0),
(390, 159, 118, 1, 0, 1, 0),
(391, 159, 141, 2, 0, 1, 0),
(392, 160, 137, 1, 0, 1, 0),
(393, 160, 141, 2, 0, 1, 0),
(394, 173, 132, 1, 0, 1, 0),
(395, 173, 141, 2, 0, 1, 0),
(396, 174, 141, 2, 0, 1, 0),
(397, 174, 134, 1, 0, 1, 0),
(398, 175, 131, 1, 0, 1, 0),
(399, 175, 141, 2, 0, 1, 0),
(400, 176, 133, 1, 0, 1, 0),
(401, 176, 141, 2, 0, 1, 0),
(402, 177, 135, 1, 0, 1, 0),
(403, 177, 141, 2, 0, 1, 0),
(404, 178, 134, 1, 0, 1, 0),
(405, 178, 141, 2, 0, 1, 0),
(406, 179, 141, 2, 0, 1, 0),
(407, 179, 134, 1, 0, 1, 0),
(408, 180, 141, 2, 0, 1, 0),
(409, 180, 134, 1, 0, 1, 0),
(410, 181, 138, 1, 0, 1, 0),
(411, 181, 141, 2, 0, 1, 0),
(412, 182, 141, 2, 0, 1, 0),
(413, 182, 6, 1, 0, 1, 0),
(414, 183, 104, 1, 0, 1, 0),
(415, 183, 141, 2, 0, 1, 0),
(416, 184, 136, 1, 0, 1, 0),
(417, 184, 141, 2, 0, 1, 0),
(418, 209, 154, 1, 0, 1, 0),
(419, 209, 39, 2, 0, 1, 0),
(420, 210, 39, 2, 0, 1, 0),
(421, 210, 154, 1, 0, 1, 0),
(422, 211, 154, 1, 0, 1, 0),
(423, 211, 39, 2, 0, 1, 0),
(424, 212, 154, 1, 0, 1, 0),
(425, 212, 39, 2, 0, 1, 0),
(426, 213, 154, 1, 0, 1, 0),
(427, 213, 39, 2, 0, 1, 0),
(428, 214, 154, 1, 0, 1, 0),
(429, 214, 39, 2, 0, 1, 0),
(430, 215, 39, 2, 0, 1, 0),
(431, 215, 154, 1, 0, 1, 0),
(432, 216, 39, 2, 0, 1, 0),
(433, 216, 154, 1, 0, 1, 0),
(434, 217, 39, 2, 0, 1, 0),
(435, 217, 154, 1, 0, 1, 0),
(436, 218, 154, 1, 0, 1, 0),
(437, 218, 39, 2, 0, 1, 0),
(438, 219, 39, 2, 0, 1, 0),
(439, 219, 154, 1, 0, 1, 0),
(440, 220, 39, 2, 0, 1, 0),
(441, 220, 154, 1, 0, 1, 0),
(442, 221, 154, 1, 0, 1, 0),
(443, 221, 39, 2, 0, 1, 0),
(444, 222, 154, 1, 0, 1, 0),
(445, 222, 39, 2, 0, 1, 0),
(446, 223, 154, 1, 0, 1, 0),
(447, 223, 39, 2, 0, 1, 0),
(448, 224, 154, 1, 0, 1, 0),
(449, 224, 39, 2, 0, 1, 0),
(450, 225, 154, 1, 0, 1, 0),
(451, 225, 39, 2, 0, 1, 0),
(452, 226, 154, 1, 0, 1, 0),
(453, 226, 39, 2, 0, 1, 0),
(454, 227, 39, 2, 0, 1, 0),
(455, 227, 154, 1, 0, 1, 0),
(456, 228, 39, 2, 0, 1, 0),
(457, 228, 154, 1, 0, 1, 0),
(458, 232, 154, 1, 0, 1, 0),
(459, 232, 39, 2, 0, 1, 0),
(460, 231, 154, 1, 0, 1, 0),
(461, 231, 39, 2, 0, 1, 0),
(462, 230, 154, 1, 0, 1, 0),
(463, 230, 39, 2, 0, 1, 0),
(464, 229, 154, 1, 0, 1, 0),
(465, 229, 39, 2, 0, 1, 0),
(469, 13, 103, 1, 0, 1, 0),
(468, 13, 102, 2, 1, 1, 0),
(470, 13, 100, 2, 1, 1, 0),
(471, 13, 99, 1, 1, 1, 0),
(484, 277, 154, 2, 0, 0, 1),
(482, 277, 7, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `journal_transactions`
--

DROP TABLE IF EXISTS `journal_transactions`;
CREATE TABLE IF NOT EXISTS `journal_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `journal_position_id` int(10) unsigned NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `amount_db` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount_cr` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(4) NOT NULL DEFAULT '0',
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
  KEY `journal_template_id` (`journal_template_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `journal_transactions`
--

INSERT INTO `journal_transactions` (`id`, `date`, `account_id`, `journal_position_id`, `department_id`, `amount_db`, `amount_cr`, `posting`, `account_code`, `notes`, `source`, `doc_id`, `journal_template_id`) VALUES
(1, '2011-06-23', 154, 1, 19, '30000000.00', '0.00', 0, '302.360.XXXXX', '', 'invoice', 2, 212),
(2, '2011-06-23', 39, 2, 19, '0.00', '30000000.00', 0, '302.360.0010999993', '', 'invoice', 2, 212),
(3, '2011-06-23', 154, 1, 19, '53875000.00', '0.00', 0, '302.360.XXXXX', '', 'invoice', 2, 212),
(4, '2011-06-23', 39, 2, 19, '0.00', '53875000.00', 0, '302.360.0010999993', '', 'invoice', 2, 212),
(5, '2011-06-23', 7, 1, 19, '83875000.00', '0.00', 0, '302.360.1080-05', '', 'invoice', 2, 277),
(6, '2011-06-23', 154, 2, 19, '0.00', '83875000.00', 0, '302.360.XXXXX', '', 'invoice', 2, 277),
(7, '2011-06-23', 7, 1, 19, '40271000.00', '0.00', 0, '302.360.1080-05', '', 'invoice', 1, 277),
(8, '2011-06-23', 154, 2, 19, '0.00', '40271000.00', 0, '302.360.XXXXX', '', 'invoice', 1, 277);

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
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
-- Dumping data untuk tabel `locations`
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
-- Struktur dari tabel `logs`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=591 ;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(1, 'Admin', '2011-06-23 15:13:24', 'User "Admin" (2) updated by User "Admin" (2).', 'User', 2, 'edit', 2, 'department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(2, 'ade', '2011-06-23 15:15:00', 'User "ade" (4) updated by User "Admin" (2).', 'User', 4, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(3, 'badu', '2011-06-23 15:15:49', 'User "badu" (5) updated by User "Admin" (2).', 'User', 5, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(4, 'gs', '2011-06-23 15:16:37', 'User "gs" (7) updated by User "Admin" (2).', 'User', 7, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(5, 'fincon', '2011-06-23 15:17:54', 'User "fincon" (9) updated by User "Admin" (2).', 'User', 9, 'edit', 2, 'department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(6, 'supervisor', '2011-06-23 15:18:18', 'User "supervisor" (10) deleted by User "Admin" (2).', 'User', 10, 'delete', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'security', '2011-06-23 15:18:32', 'User "security" (11) deleted by User "Admin" (2).', 'User', 11, 'delete', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'securityhd', '2011-06-23 15:18:44', 'User "securityhd" (12) deleted by User "Admin" (2).', 'User', 12, 'delete', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'gs_admin', '2011-06-23 15:19:20', 'User "gs_admin" (13) updated by User "Admin" (2).', 'User', 13, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(10, 'it_admin', '2011-06-23 15:20:02', 'User "it_admin" (14) updated by User "Admin" (2).', 'User', 14, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(11, 'fa_management', '2011-06-23 15:20:36', 'User "fa_management" (15) updated by User "Admin" (2).', 'User', 15, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(12, 'it_management', '2011-06-23 15:21:11', 'User "it_management" (16) updated by User "Admin" (2).', 'User', 16, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(13, 'stock_management', '2011-06-23 15:21:54', 'User "stock_management" (17) updated by User "Admin" (2).', 'User', 17, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(14, 'stock_supervisor', '2011-06-23 15:22:23', 'User "stock_supervisor" (18) updated by User "Admin" (2).', 'User', 18, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(15, 'fa_supervisor', '2011-06-23 15:22:46', 'User "fa_supervisor" (19) updated by User "Admin" (2).', 'User', 19, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(16, 'it_supervisor', '2011-06-23 15:23:12', 'User "it_supervisor" (20) updated by User "Admin" (2).', 'User', 20, 'edit', 2, 'username, department_id, business_type_id, cost_center_id', NULL, NULL, NULL, NULL, NULL),
(17, 'cabang2', '2011-06-23 15:24:22', 'User "cabang2" (21) updated by User "Admin" (2).', 'User', 21, 'edit', 2, 'business_type_id', NULL, NULL, NULL, NULL, NULL),
(18, 'cabang3', '2011-06-23 15:25:30', 'User "cabang3" (22) updated by User "Admin" (2).', 'User', 22, 'edit', 2, 'business_type_id', NULL, NULL, NULL, NULL, NULL),
(19, 'heri2', '2011-06-23 15:25:43', 'User "heri2" (23) updated by User "Admin" (2).', 'User', 23, 'edit', 2, 'business_type_id', NULL, NULL, NULL, NULL, NULL),
(20, 'heri3', '2011-06-23 15:25:54', 'User "heri3" (24) updated by User "Admin" (2).', 'User', 24, 'edit', 2, 'business_type_id', NULL, NULL, NULL, NULL, NULL),
(21, 'heri', '2011-06-23 15:26:26', 'User "heri" (3) updated by User "Admin" (2).', 'User', 3, 'edit', 2, 'username, business_type_id', NULL, NULL, NULL, NULL, NULL),
(22, 'cabang', '2011-06-23 15:26:42', 'User "cabang" (8) updated by User "Admin" (2).', 'User', 8, 'edit', 2, 'business_type_id', NULL, NULL, NULL, NULL, NULL),
(23, 'cabang', '2011-06-23 15:26:57', 'User "cabang" (8) updated by User "Admin" (2).', 'User', 8, 'edit', 2, 'username', NULL, NULL, NULL, NULL, NULL),
(24, 'NpbDetail (1)', '2011-06-23 15:33:36', 'NpbDetail (1) added by User "cabang" (8).', 'NpbDetail', 1, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(25, 'NpbDetail (2)', '2011-06-23 15:34:00', 'NpbDetail (2) added by User "cabang" (8).', 'NpbDetail', 2, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(26, 'NpbDetail (3)', '2011-06-23 15:34:25', 'NpbDetail (3) added by User "cabang" (8).', 'NpbDetail', 3, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(27, 'NpbDetail (4)', '2011-06-23 15:36:09', 'NpbDetail (4) added by User "cabang" (8).', 'NpbDetail', 4, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(28, 'Contoh PO', '2011-06-23 15:36:50', 'Attachment "Contoh PO" (1) added by User "cabang" (8).', 'Attachment', 1, 'add', 8, 'name, npb_id, attachment_file_path, attachment_file_name, attachment_file_size, attachment_content_type', NULL, NULL, NULL, NULL, NULL),
(29, 'NpbDetail (5)', '2011-06-23 15:37:25', 'NpbDetail (5) added by User "cabang" (8).', 'NpbDetail', 5, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(30, 'NpbDetail (6)', '2011-06-23 15:37:48', 'NpbDetail (6) added by User "cabang" (8).', 'NpbDetail', 6, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(31, 'NpbDetail (7)', '2011-06-23 15:38:13', 'NpbDetail (7) added by User "cabang" (8).', 'NpbDetail', 7, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(32, 'NpbDetail (8)', '2011-06-23 15:39:49', 'NpbDetail (8) added by User "cabang2" (21).', 'NpbDetail', 8, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(33, 'NpbDetail (9)', '2011-06-23 15:40:31', 'NpbDetail (9) added by User "cabang2" (21).', 'NpbDetail', 9, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(34, 'NpbDetail (10)', '2011-06-23 15:40:54', 'NpbDetail (10) added by User "cabang2" (21).', 'NpbDetail', 10, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(35, 'NpbDetail (11)', '2011-06-23 15:41:20', 'NpbDetail (11) added by User "cabang2" (21).', 'NpbDetail', 11, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(36, 'NpbDetail (12)', '2011-06-23 15:41:44', 'NpbDetail (12) added by User "cabang2" (21).', 'NpbDetail', 12, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(37, 'NpbDetail (13)', '2011-06-23 15:42:45', 'NpbDetail (13) added by User "cabang2" (21).', 'NpbDetail', 13, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(38, 'NpbDetail (14)', '2011-06-23 15:43:21', 'NpbDetail (14) added by User "cabang2" (21).', 'NpbDetail', 14, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(39, 'NpbDetail (15)', '2011-06-23 15:43:41', 'NpbDetail (15) added by User "cabang2" (21).', 'NpbDetail', 15, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(40, 'NpbDetail (16)', '2011-06-23 15:43:59', 'NpbDetail (16) added by User "cabang2" (21).', 'NpbDetail', 16, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(41, 'NpbDetail (17)', '2011-06-23 15:51:31', 'NpbDetail (17) added by User "cabang" (8).', 'NpbDetail', 17, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(42, 'NpbDetail (18)', '2011-06-23 15:51:48', 'NpbDetail (18) added by User "cabang" (8).', 'NpbDetail', 18, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(43, 'NpbDetail (19)', '2011-06-23 15:52:10', 'NpbDetail (19) added by User "cabang" (8).', 'NpbDetail', 19, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(44, 'NpbDetail (20)', '2011-06-23 15:53:25', 'NpbDetail (20) added by User "cabang" (8).', 'NpbDetail', 20, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(45, 'NpbDetail (21)', '2011-06-23 15:53:42', 'NpbDetail (21) added by User "cabang" (8).', 'NpbDetail', 21, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(46, 'NpbDetail (22)', '2011-06-23 15:55:01', 'NpbDetail (22) added by User "cabang2" (21).', 'NpbDetail', 22, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(47, 'NpbDetail (23)', '2011-06-23 15:55:53', 'NpbDetail (23) added by User "cabang2" (21).', 'NpbDetail', 23, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(48, 'NpbDetail (24)', '2011-06-23 15:56:18', 'NpbDetail (24) added by User "cabang2" (21).', 'NpbDetail', 24, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(49, 'NpbDetail (25)', '2011-06-23 16:00:09', 'NpbDetail (25) added by User "cabang2" (21).', 'NpbDetail', 25, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(50, 'NpbDetail (26)', '2011-06-23 16:00:36', 'NpbDetail (26) added by User "cabang2" (21).', 'NpbDetail', 26, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(51, 'NpbDetail (27)', '2011-06-23 16:00:49', 'NpbDetail (27) added by User "cabang2" (21).', 'NpbDetail', 27, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(52, 'NpbDetail (25)', '2011-06-23 16:03:51', 'NpbDetail (25) deleted by User "cabang2" (21).', 'NpbDetail', 25, 'delete', 21, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'NpbDetail (28)', '2011-06-23 16:04:11', 'NpbDetail (28) added by User "cabang2" (21).', 'NpbDetail', 28, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(54, 'NpbDetail (1)', '2011-06-23 16:07:06', 'NpbDetail (1) updated by User "gs_admin" (13).', 'NpbDetail', 1, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(55, 'NpbDetail (2)', '2011-06-23 16:07:08', 'NpbDetail (2) updated by User "gs_admin" (13).', 'NpbDetail', 2, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(56, 'NpbDetail (3)', '2011-06-23 16:07:10', 'NpbDetail (3) updated by User "gs_admin" (13).', 'NpbDetail', 3, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(57, 'NpbDetail (1)', '2011-06-23 16:07:37', 'NpbDetail (1) updated by User "gs_admin" (13).', 'NpbDetail', 1, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(58, 'NpbDetail (1)', '2011-06-23 16:07:39', 'NpbDetail (1) updated by User "gs_admin" (13).', 'NpbDetail', 1, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(59, 'NpbDetail (4)', '2011-06-23 16:09:03', 'NpbDetail (4) updated by User "gs_admin" (13).', 'NpbDetail', 4, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(60, 'NpbDetail (5)', '2011-06-23 16:09:03', 'NpbDetail (5) updated by User "gs_admin" (13).', 'NpbDetail', 5, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(61, 'NpbDetail (6)', '2011-06-23 16:09:05', 'NpbDetail (6) updated by User "gs_admin" (13).', 'NpbDetail', 6, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(62, 'NpbDetail (7)', '2011-06-23 16:09:06', 'NpbDetail (7) updated by User "gs_admin" (13).', 'NpbDetail', 7, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(63, 'NpbDetail (8)', '2011-06-23 16:10:12', 'NpbDetail (8) updated by User "gs_admin" (13).', 'NpbDetail', 8, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(64, 'NpbDetail (9)', '2011-06-23 16:10:14', 'NpbDetail (9) updated by User "gs_admin" (13).', 'NpbDetail', 9, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(65, 'NpbDetail (11)', '2011-06-23 16:10:16', 'NpbDetail (11) updated by User "gs_admin" (13).', 'NpbDetail', 11, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(66, 'NpbDetail (12)', '2011-06-23 16:10:19', 'NpbDetail (12) updated by User "gs_admin" (13).', 'NpbDetail', 12, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(67, 'NpbDetail (10)', '2011-06-23 16:10:20', 'NpbDetail (10) updated by User "gs_admin" (13).', 'NpbDetail', 10, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(68, 'NpbDetail (10)', '2011-06-23 16:10:44', 'NpbDetail (10) updated by User "gs_admin" (13).', 'NpbDetail', 10, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(69, 'NpbDetail (17)', '2011-06-23 16:13:35', 'NpbDetail (17) updated by User "it_admin" (14).', 'NpbDetail', 17, 'edit', 14, 'price_cur, amount_cur', NULL, NULL, NULL, NULL, NULL),
(70, 'NpbDetail (19)', '2011-06-23 16:13:37', 'NpbDetail (19) updated by User "it_admin" (14).', 'NpbDetail', 19, 'edit', 14, 'price_cur, amount_cur', NULL, NULL, NULL, NULL, NULL),
(71, 'NpbDetail (18)', '2011-06-23 16:13:40', 'NpbDetail (18) updated by User "it_admin" (14).', 'NpbDetail', 18, 'edit', 14, 'price_cur, amount_cur', NULL, NULL, NULL, NULL, NULL),
(72, 'NpbDetail (17)', '2011-06-23 16:13:54', 'NpbDetail (17) updated by User "it_admin" (14).', 'NpbDetail', 17, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(73, 'NpbDetail (19)', '2011-06-23 16:13:56', 'NpbDetail (19) updated by User "it_admin" (14).', 'NpbDetail', 19, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(74, 'NpbDetail (18)', '2011-06-23 16:13:57', 'NpbDetail (18) updated by User "it_admin" (14).', 'NpbDetail', 18, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(75, 'contoh Quotation', '2011-06-23 16:14:43', 'Attachment "contoh Quotation" (2) added by User "it_admin" (14).', 'Attachment', 2, 'add', 14, 'name, npb_id, attachment_file_path, attachment_file_name, attachment_file_size, attachment_content_type', NULL, NULL, NULL, NULL, NULL),
(76, 'NpbDetail (17)', '2011-06-23 16:15:05', 'NpbDetail (17) updated by User "it_admin" (14).', 'NpbDetail', 17, 'edit', 14, 'currency_id', NULL, NULL, NULL, NULL, NULL),
(77, 'NpbDetail (17)', '2011-06-23 16:15:15', 'NpbDetail (17) updated by User "it_admin" (14).', 'NpbDetail', 17, 'edit', 14, 'price_cur, amount_cur', NULL, NULL, NULL, NULL, NULL),
(78, 'NpbDetail (20)', '2011-06-23 16:19:04', 'NpbDetail (20) updated by User "it_admin" (14).', 'NpbDetail', 20, 'edit', 14, 'currency_id', NULL, NULL, NULL, NULL, NULL),
(79, 'NpbDetail (20)', '2011-06-23 16:19:14', 'NpbDetail (20) updated by User "it_admin" (14).', 'NpbDetail', 20, 'edit', 14, 'price_cur, amount_cur', NULL, NULL, NULL, NULL, NULL),
(80, 'NpbDetail (21)', '2011-06-23 16:19:21', 'NpbDetail (21) updated by User "it_admin" (14).', 'NpbDetail', 21, 'edit', 14, 'price_cur, amount_cur', NULL, NULL, NULL, NULL, NULL),
(81, 'NpbDetail (20)', '2011-06-23 16:19:27', 'NpbDetail (20) updated by User "it_admin" (14).', 'NpbDetail', 20, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(82, 'NpbDetail (21)', '2011-06-23 16:19:29', 'NpbDetail (21) updated by User "it_admin" (14).', 'NpbDetail', 21, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(83, 'contoh Quotation', '2011-06-23 16:19:55', 'Attachment "contoh Quotation" (3) added by User "it_admin" (14).', 'Attachment', 3, 'add', 14, 'name, npb_id, attachment_file_path, attachment_file_name, attachment_file_size, attachment_content_type', NULL, NULL, NULL, NULL, NULL),
(84, 'NpbDetail (29)', '2011-06-23 16:23:02', 'NpbDetail (29) added by User "cabang2" (21).', 'NpbDetail', 29, 'add', 21, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(85, 'NpbDetail (22)', '2011-06-23 16:24:45', 'NpbDetail (22) updated by User "it_admin" (14).', 'NpbDetail', 22, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(86, 'NpbDetail (24)', '2011-06-23 16:24:46', 'NpbDetail (24) updated by User "it_admin" (14).', 'NpbDetail', 24, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(87, 'NpbDetail (23)', '2011-06-23 16:24:47', 'NpbDetail (23) updated by User "it_admin" (14).', 'NpbDetail', 23, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(88, 'NpbDetail (27)', '2011-06-23 16:26:21', 'NpbDetail (27) updated by User "it_admin" (14).', 'NpbDetail', 27, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(89, 'NpbDetail (26)', '2011-06-23 16:26:23', 'NpbDetail (26) updated by User "it_admin" (14).', 'NpbDetail', 26, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(90, 'NpbDetail (28)', '2011-06-23 16:26:25', 'NpbDetail (28) updated by User "it_admin" (14).', 'NpbDetail', 28, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(91, 'NpbDetail (29)', '2011-06-23 16:28:50', 'NpbDetail (29) updated by User "it_admin" (14).', 'NpbDetail', 29, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(92, 'PO-0001', '2011-06-23 16:37:46', 'Po "PO-0001" (1) added by User "gs" (7).', 'Po', 1, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(93, '1', '2011-06-23 16:37:46', 'PoPayment "1" (1) added by User "gs" (7).', 'PoPayment', 1, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(94, '2', '2011-06-23 16:37:46', 'PoPayment "2" (2) added by User "gs" (7).', 'PoPayment', 2, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(95, '3', '2011-06-23 16:37:46', 'PoPayment "3" (3) added by User "gs" (7).', 'PoPayment', 3, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(96, 'K010-Kursi', '2011-06-23 16:37:46', 'PoDetail "K010-Kursi" (1) added by User "gs" (7).', 'PoDetail', 1, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(97, 'NpbDetail (1)', '2011-06-23 16:37:46', 'NpbDetail (1) updated by User "gs" (7).', 'NpbDetail', 1, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(98, 'K010-Kursi', '2011-06-23 16:37:46', 'PoDetail "K010-Kursi" (2) added by User "gs" (7).', 'PoDetail', 2, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(99, 'NpbDetail (4)', '2011-06-23 16:37:46', 'NpbDetail (4) updated by User "gs" (7).', 'NpbDetail', 4, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(100, '7KRS002-KURSI HADAP', '2011-06-23 16:37:46', 'PoDetail "7KRS002-KURSI HADAP" (3) added by User "gs" (7).', 'PoDetail', 3, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(101, 'NpbDetail (6)', '2011-06-23 16:37:46', 'NpbDetail (6) updated by User "gs" (7).', 'NpbDetail', 6, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(102, '7KRS003-KURSI TUNGGU', '2011-06-23 16:37:46', 'PoDetail "7KRS003-KURSI TUNGGU" (4) added by User "gs" (7).', 'PoDetail', 4, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(103, 'NpbDetail (7)', '2011-06-23 16:37:46', 'NpbDetail (7) updated by User "gs" (7).', 'NpbDetail', 7, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(104, 'LMR001-Lemari Besi', '2011-06-23 16:37:46', 'PoDetail "LMR001-Lemari Besi" (5) added by User "gs" (7).', 'PoDetail', 5, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(105, 'NpbDetail (8)', '2011-06-23 16:37:46', 'NpbDetail (8) updated by User "gs" (7).', 'NpbDetail', 8, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(106, '7KRS001-KURSI KERJA', '2011-06-23 16:37:46', 'PoDetail "7KRS001-KURSI KERJA" (6) added by User "gs" (7).', 'PoDetail', 6, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(107, 'NpbDetail (11)', '2011-06-23 16:37:46', 'NpbDetail (11) updated by User "gs" (7).', 'NpbDetail', 11, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(108, '7KRS002-KURSI HADAP', '2011-06-23 16:37:46', 'PoDetail "7KRS002-KURSI HADAP" (7) added by User "gs" (7).', 'PoDetail', 7, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(109, 'NpbDetail (12)', '2011-06-23 16:37:46', 'NpbDetail (12) updated by User "gs" (7).', 'NpbDetail', 12, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(110, 'PO-0001', '2011-06-23 16:37:46', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(111, 'PO-0002', '2011-06-23 16:38:04', 'Po "PO-0002" (2) added by User "gs" (7).', 'Po', 2, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(112, '1', '2011-06-23 16:38:04', 'PoPayment "1" (4) added by User "gs" (7).', 'PoPayment', 4, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(113, '1', '2011-06-23 16:39:08', 'PoPayment "1" (1) updated by User "gs" (7).', 'PoPayment', 1, 'edit', 7, 'term_percent', NULL, NULL, NULL, NULL, NULL),
(114, '2', '2011-06-23 16:39:13', 'PoPayment "2" (2) updated by User "gs" (7).', 'PoPayment', 2, 'edit', 7, 'term_percent', NULL, NULL, NULL, NULL, NULL),
(115, '3', '2011-06-23 16:39:18', 'PoPayment "3" (3) updated by User "gs" (7).', 'PoPayment', 3, 'edit', 7, 'term_percent', NULL, NULL, NULL, NULL, NULL),
(116, '7KRS002-KURSI HADAP', '2011-06-23 16:40:05', 'PoDetail "7KRS002-KURSI HADAP" (3) updated by User "gs" (7).', 'PoDetail', 3, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(117, 'PO-0001', '2011-06-23 16:40:05', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(118, 'PO-0001', '2011-06-23 16:40:44', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(119, 'PO-0002', '2011-06-23 16:42:06', 'Po "PO-0002" (2) deleted by User "gs" (7).', 'Po', 2, 'delete', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 'PO-0002', '2011-06-23 16:43:59', 'Po "PO-0002" (3) added by User "gs" (7).', 'Po', 3, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(121, '1', '2011-06-23 16:43:59', 'PoPayment "1" (5) added by User "gs" (7).', 'PoPayment', 5, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(122, 'K09966-mobil', '2011-06-23 16:43:59', 'PoDetail "K09966-mobil" (8) added by User "gs" (7).', 'PoDetail', 8, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(123, 'NpbDetail (2)', '2011-06-23 16:43:59', 'NpbDetail (2) updated by User "gs" (7).', 'NpbDetail', 2, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(124, 'K09966-mobil', '2011-06-23 16:43:59', 'PoDetail "K09966-mobil" (9) added by User "gs" (7).', 'PoDetail', 9, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(125, 'NpbDetail (5)', '2011-06-23 16:43:59', 'NpbDetail (5) updated by User "gs" (7).', 'NpbDetail', 5, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(126, 'K09966-mobil', '2011-06-23 16:43:59', 'PoDetail "K09966-mobil" (10) added by User "gs" (7).', 'PoDetail', 10, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(127, 'NpbDetail (9)', '2011-06-23 16:43:59', 'NpbDetail (9) updated by User "gs" (7).', 'NpbDetail', 9, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(128, 'PO-0002', '2011-06-23 16:44:00', 'Po "PO-0002" (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(129, 'K09966-mobil', '2011-06-23 16:44:22', 'PoDetail "K09966-mobil" (8) updated by User "gs" (7).', 'PoDetail', 8, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(130, 'PO-0002', '2011-06-23 16:44:22', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(131, 'K09966-mobil', '2011-06-23 16:45:46', 'PoDetail "K09966-mobil" (8) updated by User "gs" (7).', 'PoDetail', 8, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(132, 'PO-0002', '2011-06-23 16:45:46', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(133, 'K09966-mobil', '2011-06-23 16:45:54', 'PoDetail "K09966-mobil" (9) updated by User "gs" (7).', 'PoDetail', 9, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(134, 'PO-0002', '2011-06-23 16:45:54', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(135, 'K09966-mobil', '2011-06-23 16:46:03', 'PoDetail "K09966-mobil" (10) updated by User "gs" (7).', 'PoDetail', 10, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(136, 'PO-0002', '2011-06-23 16:46:03', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(137, 'PO-0002', '2011-06-23 16:46:29', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(138, 'PO-0003', '2011-06-23 16:48:09', 'Po "PO-0003" (4) added by User "gs" (7).', 'Po', 4, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(139, '1', '2011-06-23 16:48:09', 'PoPayment "1" (6) added by User "gs" (7).', 'PoPayment', 6, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(140, '6PRH001 -PRINTER HP  ', '2011-06-23 16:48:09', 'PoDetail "6PRH001 -PRINTER HP  " (11) added by User "gs" (7).', 'PoDetail', 11, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(141, 'NpbDetail (17)', '2011-06-23 16:48:09', 'NpbDetail (17) updated by User "gs" (7).', 'NpbDetail', 17, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(142, '6LCH003 -LCD HP ', '2011-06-23 16:48:09', 'PoDetail "6LCH003 -LCD HP " (12) added by User "gs" (7).', 'PoDetail', 12, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(143, 'NpbDetail (19)', '2011-06-23 16:48:09', 'NpbDetail (19) updated by User "gs" (7).', 'NpbDetail', 19, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(144, '6MOU001-MOUSE USB', '2011-06-23 16:48:09', 'PoDetail "6MOU001-MOUSE USB" (13) added by User "gs" (7).', 'PoDetail', 13, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(145, 'NpbDetail (18)', '2011-06-23 16:48:09', 'NpbDetail (18) updated by User "gs" (7).', 'NpbDetail', 18, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(146, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 16:48:09', 'PoDetail "6PRI001-PROJECTOR INFOCUS" (14) added by User "gs" (7).', 'PoDetail', 14, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(147, 'NpbDetail (20)', '2011-06-23 16:48:09', 'NpbDetail (20) updated by User "gs" (7).', 'NpbDetail', 20, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(148, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 16:48:09', 'PoDetail "6MOU002-MOUSE SERIAL PS/2" (15) added by User "gs" (7).', 'PoDetail', 15, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(149, 'NpbDetail (21)', '2011-06-23 16:48:09', 'NpbDetail (21) updated by User "gs" (7).', 'NpbDetail', 21, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(150, '6PCT001-THIN CLIENT  ', '2011-06-23 16:48:09', 'PoDetail "6PCT001-THIN CLIENT  " (16) added by User "gs" (7).', 'PoDetail', 16, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(151, 'NpbDetail (22)', '2011-06-23 16:48:09', 'NpbDetail (22) updated by User "gs" (7).', 'NpbDetail', 22, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(152, '6PCT001-THIN CLIENT  ', '2011-06-23 16:48:09', 'PoDetail "6PCT001-THIN CLIENT  " (17) added by User "gs" (7).', 'PoDetail', 17, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(153, 'NpbDetail (24)', '2011-06-23 16:48:09', 'NpbDetail (24) updated by User "gs" (7).', 'NpbDetail', 24, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(154, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 16:48:09', 'PoDetail "6PRE001 -PRINTER EPSON LQ 2180" (18) added by User "gs" (7).', 'PoDetail', 18, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(155, 'NpbDetail (23)', '2011-06-23 16:48:09', 'NpbDetail (23) updated by User "gs" (7).', 'NpbDetail', 23, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(156, '6PCT001-THIN CLIENT  ', '2011-06-23 16:48:09', 'PoDetail "6PCT001-THIN CLIENT  " (19) added by User "gs" (7).', 'PoDetail', 19, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(157, 'NpbDetail (27)', '2011-06-23 16:48:09', 'NpbDetail (27) updated by User "gs" (7).', 'NpbDetail', 27, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(158, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 16:48:09', 'PoDetail "6PRE001 -PRINTER EPSON LQ 2180" (20) added by User "gs" (7).', 'PoDetail', 20, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(159, 'NpbDetail (26)', '2011-06-23 16:48:09', 'NpbDetail (26) updated by User "gs" (7).', 'NpbDetail', 26, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(160, '6MSA001-ATEN ', '2011-06-23 16:48:09', 'PoDetail "6MSA001-ATEN " (21) added by User "gs" (7).', 'PoDetail', 21, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(161, 'NpbDetail (28)', '2011-06-23 16:48:09', 'NpbDetail (28) updated by User "gs" (7).', 'NpbDetail', 28, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(162, '6PCT001-THIN CLIENT  ', '2011-06-23 16:48:09', 'PoDetail "6PCT001-THIN CLIENT  " (22) added by User "gs" (7).', 'PoDetail', 22, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(163, 'NpbDetail (29)', '2011-06-23 16:48:10', 'NpbDetail (29) updated by User "gs" (7).', 'NpbDetail', 29, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(164, 'PO-0003', '2011-06-23 16:48:10', 'Po "PO-0003" (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(165, '6LCH003 -LCD HP ', '2011-06-23 16:48:34', 'PoDetail "6LCH003 -LCD HP " (12) updated by User "gs" (7).', 'PoDetail', 12, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(166, 'PO-0003', '2011-06-23 16:48:34', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(167, '6MOU001-MOUSE USB', '2011-06-23 16:48:40', 'PoDetail "6MOU001-MOUSE USB" (13) updated by User "gs" (7).', 'PoDetail', 13, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(168, 'PO-0003', '2011-06-23 16:48:40', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(169, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 16:48:47', 'PoDetail "6MOU002-MOUSE SERIAL PS/2" (15) updated by User "gs" (7).', 'PoDetail', 15, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(170, 'PO-0003', '2011-06-23 16:48:47', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(171, '6PCT001-THIN CLIENT  ', '2011-06-23 16:48:54', 'PoDetail "6PCT001-THIN CLIENT  " (16) updated by User "gs" (7).', 'PoDetail', 16, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(172, 'PO-0003', '2011-06-23 16:48:54', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(173, '6LCH003 -LCD HP ', '2011-06-23 16:49:00', 'PoDetail "6LCH003 -LCD HP " (12) updated by User "gs" (7).', 'PoDetail', 12, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(174, 'PO-0003', '2011-06-23 16:49:00', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(175, '6MOU001-MOUSE USB', '2011-06-23 16:49:05', 'PoDetail "6MOU001-MOUSE USB" (13) updated by User "gs" (7).', 'PoDetail', 13, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(176, 'PO-0003', '2011-06-23 16:49:05', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(177, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 16:49:11', 'PoDetail "6MOU002-MOUSE SERIAL PS/2" (15) updated by User "gs" (7).', 'PoDetail', 15, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(178, 'PO-0003', '2011-06-23 16:49:11', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(179, '6PCT001-THIN CLIENT  ', '2011-06-23 16:49:22', 'PoDetail "6PCT001-THIN CLIENT  " (17) updated by User "gs" (7).', 'PoDetail', 17, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(180, 'PO-0003', '2011-06-23 16:49:23', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(181, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 16:49:38', 'PoDetail "6PRE001 -PRINTER EPSON LQ 2180" (18) updated by User "gs" (7).', 'PoDetail', 18, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(182, 'PO-0003', '2011-06-23 16:49:39', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(183, '6PCT001-THIN CLIENT  ', '2011-06-23 16:49:45', 'PoDetail "6PCT001-THIN CLIENT  " (19) updated by User "gs" (7).', 'PoDetail', 19, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(184, 'PO-0003', '2011-06-23 16:49:45', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(185, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 16:49:52', 'PoDetail "6PRE001 -PRINTER EPSON LQ 2180" (20) updated by User "gs" (7).', 'PoDetail', 20, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(186, 'PO-0003', '2011-06-23 16:49:52', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(187, '6MSA001-ATEN ', '2011-06-23 16:49:59', 'PoDetail "6MSA001-ATEN " (21) updated by User "gs" (7).', 'PoDetail', 21, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(188, 'PO-0003', '2011-06-23 16:50:00', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(189, '6PCT001-THIN CLIENT  ', '2011-06-23 16:50:06', 'PoDetail "6PCT001-THIN CLIENT  " (22) updated by User "gs" (7).', 'PoDetail', 22, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(190, 'PO-0003', '2011-06-23 16:50:06', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(191, '6PRH001 -PRINTER HP  ', '2011-06-23 16:50:42', 'PoDetail "6PRH001 -PRINTER HP  " (11) deleted by User "gs" (7).', 'PoDetail', 11, 'delete', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 'PO-0003', '2011-06-23 16:50:42', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(193, 'PO-0003', '2011-06-23 16:50:59', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(194, 'PO-0004', '2011-06-23 16:54:34', 'Po "PO-0004" (5) added by User "gs" (7).', 'Po', 5, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, signer_1, signer_2, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(195, '1', '2011-06-23 16:54:34', 'PoPayment "1" (7) added by User "gs" (7).', 'PoPayment', 7, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(196, 'REN0555-Gedung Abdul Muis', '2011-06-23 16:54:34', 'PoDetail "REN0555-Gedung Abdul Muis" (23) added by User "gs" (7).', 'PoDetail', 23, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(197, 'NpbDetail (3)', '2011-06-23 16:54:34', 'NpbDetail (3) updated by User "gs" (7).', 'NpbDetail', 3, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(198, 'PO-0004', '2011-06-23 16:54:34', 'Po "PO-0004" (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(199, 'PO-0004', '2011-06-23 16:57:56', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(200, 'PO-0001', '2011-06-23 16:59:30', 'Po (1) updated by User "ade" (4).', 'Po', 1, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(201, 'PO-0001', '2011-06-23 17:00:04', 'Po (1) updated by User "ade" (4).', 'Po', 1, 'edit', 4, 'approval_info', NULL, NULL, NULL, NULL, NULL),
(202, 'PO-0002', '2011-06-23 17:00:30', 'Po (3) updated by User "ade" (4).', 'Po', 3, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(203, 'PO-0003', '2011-06-23 17:00:49', 'Po (4) updated by User "ade" (4).', 'Po', 4, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(204, 'PO-0004', '2011-06-23 17:01:37', 'Po "PO-0004" (5) updated by User "ade" (4).', 'Po', 5, 'edit', 4, 'po_status_id, cancel_notes, cancel_by, cancel_date', NULL, NULL, NULL, NULL, NULL),
(205, 'REN0555-Gedung Abdul Muis', '2011-06-23 17:02:31', 'PoDetail "REN0555-Gedung Abdul Muis" (23) updated by User "gs" (7).', 'PoDetail', 23, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(206, 'PO-0004', '2011-06-23 17:02:31', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(207, 'REN0555-Gedung Abdul Muis', '2011-06-23 17:02:39', 'PoDetail "REN0555-Gedung Abdul Muis" (23) updated by User "gs" (7).', 'PoDetail', 23, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(208, 'PO-0004', '2011-06-23 17:02:39', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(209, 'REN0555-Gedung Abdul Muis', '2011-06-23 17:02:55', 'PoDetail "REN0555-Gedung Abdul Muis" (23) updated by User "gs" (7).', 'PoDetail', 23, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(210, 'PO-0004', '2011-06-23 17:02:55', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(211, 'REN0555-Gedung Abdul Muis', '2011-06-23 17:03:04', 'PoDetail "REN0555-Gedung Abdul Muis" (23) updated by User "gs" (7).', 'PoDetail', 23, 'edit', 7, 'discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(212, 'PO-0004', '2011-06-23 17:03:04', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'discount_cur, after_disc_cur, vat_base_cur, vat_total_cur, discount, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(213, 'PO-0004', '2011-06-23 17:03:15', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(214, 'PO-0004', '2011-06-23 17:03:52', 'Po (5) updated by User "ade" (4).', 'Po', 5, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(215, 'PO-0001', '2011-06-23 17:04:22', 'Po (1) updated by User "badu" (5).', 'Po', 1, 'edit', 5, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(216, 'PO-0002', '2011-06-23 17:04:32', 'Po (3) updated by User "badu" (5).', 'Po', 3, 'edit', 5, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(217, 'PO-0003', '2011-06-23 17:04:47', 'Po (4) updated by User "badu" (5).', 'Po', 4, 'edit', 5, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(218, 'PO-0004', '2011-06-23 17:05:10', 'Po "PO-0004" (5) updated by User "badu" (5).', 'Po', 5, 'edit', 5, 'po_status_id, cancel_notes, cancel_by, cancel_date', NULL, NULL, NULL, NULL, NULL),
(219, 'REN0555-Gedung Abdul Muis', '2011-06-23 17:06:11', 'PoDetail "REN0555-Gedung Abdul Muis" (23) updated by User "gs" (7).', 'PoDetail', 23, 'edit', 7, 'discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(220, 'PO-0004', '2011-06-23 17:06:11', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'discount_cur, after_disc_cur, vat_base_cur, vat_total_cur, discount, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(221, 'PO-0004', '2011-06-23 17:06:18', 'Po (5) updated by User "gs" (7).', 'Po', 5, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(222, 'PO-0004', '2011-06-23 17:07:53', 'Po (5) updated by User "ade" (4).', 'Po', 5, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(223, 'PO-0004', '2011-06-23 17:08:32', 'Po "PO-0004" (5) updated by User "badu" (5).', 'Po', 5, 'edit', 5, 'po_status_id, reject_notes, reject_by, reject_date', NULL, NULL, NULL, NULL, NULL),
(224, 'PO-0001', '2011-06-23 17:10:10', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(225, 'PO-0001', '2011-06-23 17:11:52', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(226, 'PO-0001', '2011-06-23 17:14:44', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(227, 'PO-0001', '2011-06-23 17:14:53', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(228, 'PO-0001', '2011-06-23 17:17:01', 'Po (1) updated by User "fincon" (9).', 'Po', 1, 'edit', 9, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(229, 'PO-0001', '2011-06-23 17:17:54', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(230, 'PO-0001', '2011-06-23 17:20:45', 'Po (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(231, 'PO-0002', '2011-06-23 17:21:23', 'Po "PO-0002" (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(232, 'PO-0002', '2011-06-23 17:22:20', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(233, 'PO-0003', '2011-06-23 17:22:34', 'Po "PO-0003" (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(234, 'PO-0003', '2011-06-23 17:23:20', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(235, 'PO-0002', '2011-06-23 17:23:52', 'Po (3) updated by User "fincon" (9).', 'Po', 3, 'edit', 9, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(236, 'PO-0003', '2011-06-23 17:24:14', 'Po (4) updated by User "fincon" (9).', 'Po', 4, 'edit', 9, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(237, 'PO-0002', '2011-06-23 17:26:53', 'Po "PO-0002" (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(238, 'PO-0002', '2011-06-23 17:27:06', 'Po (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(239, 'PO-0003', '2011-06-23 17:27:19', 'Po (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(240, 'xx111', '2011-06-23 17:30:37', 'DeliveryOrder "xx111" (1) added by User "gs" (7).', 'DeliveryOrder', 1, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(241, 'K010-Kursi', '2011-06-23 17:30:37', 'DeliveryOrderDetail "K010-Kursi" (1) added by User "gs" (7).', 'DeliveryOrderDetail', 1, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(242, 'K010-Kursi', '2011-06-23 17:30:37', 'DeliveryOrderDetail "K010-Kursi" (2) added by User "gs" (7).', 'DeliveryOrderDetail', 2, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(243, '7KRS002-KURSI HADAP', '2011-06-23 17:30:37', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (3) added by User "gs" (7).', 'DeliveryOrderDetail', 3, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(244, '7KRS003-KURSI TUNGGU', '2011-06-23 17:30:37', 'DeliveryOrderDetail "7KRS003-KURSI TUNGGU" (4) added by User "gs" (7).', 'DeliveryOrderDetail', 4, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(245, 'LMR001-Lemari Besi', '2011-06-23 17:30:37', 'DeliveryOrderDetail "LMR001-Lemari Besi" (5) added by User "gs" (7).', 'DeliveryOrderDetail', 5, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(246, '7KRS001-KURSI KERJA', '2011-06-23 17:30:37', 'DeliveryOrderDetail "7KRS001-KURSI KERJA" (6) added by User "gs" (7).', 'DeliveryOrderDetail', 6, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(247, '7KRS002-KURSI HADAP', '2011-06-23 17:30:37', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (7) added by User "gs" (7).', 'DeliveryOrderDetail', 7, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(248, 'K010-Kursi', '2011-06-23 17:31:27', 'DeliveryOrderDetail "K010-Kursi" (1) updated by User "gs" (7).', 'DeliveryOrderDetail', 1, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(249, 'K010-Kursi', '2011-06-23 17:31:30', 'DeliveryOrderDetail "K010-Kursi" (2) updated by User "gs" (7).', 'DeliveryOrderDetail', 2, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(250, '7KRS002-KURSI HADAP', '2011-06-23 17:31:33', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (3) updated by User "gs" (7).', 'DeliveryOrderDetail', 3, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(251, '7KRS003-KURSI TUNGGU', '2011-06-23 17:31:35', 'DeliveryOrderDetail "7KRS003-KURSI TUNGGU" (4) updated by User "gs" (7).', 'DeliveryOrderDetail', 4, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(252, 'LMR001-Lemari Besi', '2011-06-23 17:31:38', 'DeliveryOrderDetail "LMR001-Lemari Besi" (5) updated by User "gs" (7).', 'DeliveryOrderDetail', 5, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(253, '7KRS001-KURSI KERJA', '2011-06-23 17:31:41', 'DeliveryOrderDetail "7KRS001-KURSI KERJA" (6) updated by User "gs" (7).', 'DeliveryOrderDetail', 6, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(254, '7KRS002-KURSI HADAP', '2011-06-23 17:31:44', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (7) updated by User "gs" (7).', 'DeliveryOrderDetail', 7, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(255, '7KRS002-KURSI HADAP', '2011-06-23 17:32:33', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (7) updated by User "gs" (7).', 'DeliveryOrderDetail', 7, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(256, 'yyyyy2', '2011-06-23 17:33:01', 'DeliveryOrder "yyyyy2" (2) added by User "gs" (7).', 'DeliveryOrder', 2, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(257, 'K010-Kursi', '2011-06-23 17:33:01', 'DeliveryOrderDetail "K010-Kursi" (8) added by User "gs" (7).', 'DeliveryOrderDetail', 8, 'add', 7, 'price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(258, 'K010-Kursi', '2011-06-23 17:33:01', 'DeliveryOrderDetail "K010-Kursi" (9) added by User "gs" (7).', 'DeliveryOrderDetail', 9, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(259, '7KRS002-KURSI HADAP', '2011-06-23 17:33:01', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (10) added by User "gs" (7).', 'DeliveryOrderDetail', 10, 'add', 7, 'price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(260, '7KRS003-KURSI TUNGGU', '2011-06-23 17:33:01', 'DeliveryOrderDetail "7KRS003-KURSI TUNGGU" (11) added by User "gs" (7).', 'DeliveryOrderDetail', 11, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(261, 'LMR001-Lemari Besi', '2011-06-23 17:33:01', 'DeliveryOrderDetail "LMR001-Lemari Besi" (12) added by User "gs" (7).', 'DeliveryOrderDetail', 12, 'add', 7, 'price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(262, '7KRS001-KURSI KERJA', '2011-06-23 17:33:01', 'DeliveryOrderDetail "7KRS001-KURSI KERJA" (13) added by User "gs" (7).', 'DeliveryOrderDetail', 13, 'add', 7, 'price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(263, '7KRS002-KURSI HADAP', '2011-06-23 17:33:01', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (14) added by User "gs" (7).', 'DeliveryOrderDetail', 14, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(264, '7KRS002-KURSI HADAP', '2011-06-23 17:34:09', 'DeliveryOrderDetail "7KRS002-KURSI HADAP" (14) updated by User "gs" (7).', 'DeliveryOrderDetail', 14, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(265, '7KRS003-KURSI TUNGGU', '2011-06-23 17:34:15', 'DeliveryOrderDetail "7KRS003-KURSI TUNGGU" (11) updated by User "gs" (7).', 'DeliveryOrderDetail', 11, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(266, 'K010-Kursi', '2011-06-23 17:34:18', 'DeliveryOrderDetail "K010-Kursi" (9) updated by User "gs" (7).', 'DeliveryOrderDetail', 9, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(267, 'PO-0001', '2011-06-23 17:34:18', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(268, 'zzzz1', '2011-06-23 17:37:09', 'DeliveryOrder "zzzz1" (3) added by User "gs" (7).', 'DeliveryOrder', 3, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(269, 'K09966-mobil', '2011-06-23 17:37:09', 'DeliveryOrderDetail "K09966-mobil" (15) added by User "gs" (7).', 'DeliveryOrderDetail', 15, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(270, 'K09966-mobil', '2011-06-23 17:37:09', 'DeliveryOrderDetail "K09966-mobil" (16) added by User "gs" (7).', 'DeliveryOrderDetail', 16, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(271, 'K09966-mobil', '2011-06-23 17:37:09', 'DeliveryOrderDetail "K09966-mobil" (17) added by User "gs" (7).', 'DeliveryOrderDetail', 17, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(272, 'K09966-mobil', '2011-06-23 17:37:26', 'DeliveryOrderDetail "K09966-mobil" (15) updated by User "gs" (7).', 'DeliveryOrderDetail', 15, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(273, 'K09966-mobil', '2011-06-23 17:37:27', 'DeliveryOrderDetail "K09966-mobil" (16) updated by User "gs" (7).', 'DeliveryOrderDetail', 16, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(274, 'K09966-mobil', '2011-06-23 17:37:29', 'DeliveryOrderDetail "K09966-mobil" (17) updated by User "gs" (7).', 'DeliveryOrderDetail', 17, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(275, 'PO-0002', '2011-06-23 17:37:29', 'Po "PO-0002" (3) updated by User "gs" (7).', 'Po', 3, 'edit', 7, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(276, 'www5', '2011-06-23 17:38:21', 'DeliveryOrder "www5" (4) added by User "gs" (7).', 'DeliveryOrder', 4, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id, description', NULL, NULL, NULL, NULL, NULL),
(277, '6LCH003 -LCD HP ', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6LCH003 -LCD HP " (18) added by User "gs" (7).', 'DeliveryOrderDetail', 18, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(278, '6MOU001-MOUSE USB', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6MOU001-MOUSE USB" (19) added by User "gs" (7).', 'DeliveryOrderDetail', 19, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(279, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PRI001-PROJECTOR INFOCUS" (20) added by User "gs" (7).', 'DeliveryOrderDetail', 20, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(280, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6MOU002-MOUSE SERIAL PS/2" (21) added by User "gs" (7).', 'DeliveryOrderDetail', 21, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(281, '6PCT001-THIN CLIENT  ', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (22) added by User "gs" (7).', 'DeliveryOrderDetail', 22, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(282, '6PCT001-THIN CLIENT  ', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (23) added by User "gs" (7).', 'DeliveryOrderDetail', 23, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(283, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PRE001 -PRINTER EPSON LQ 2180" (24) added by User "gs" (7).', 'DeliveryOrderDetail', 24, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(284, '6PCT001-THIN CLIENT  ', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (25) added by User "gs" (7).', 'DeliveryOrderDetail', 25, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(285, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PRE001 -PRINTER EPSON LQ 2180" (26) added by User "gs" (7).', 'DeliveryOrderDetail', 26, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(286, '6MSA001-ATEN ', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6MSA001-ATEN " (27) added by User "gs" (7).', 'DeliveryOrderDetail', 27, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(287, '6PCT001-THIN CLIENT  ', '2011-06-23 17:38:22', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (28) added by User "gs" (7).', 'DeliveryOrderDetail', 28, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, name, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(288, '6LCH003 -LCD HP ', '2011-06-23 17:38:46', 'DeliveryOrderDetail "6LCH003 -LCD HP " (18) updated by User "gs" (7).', 'DeliveryOrderDetail', 18, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(289, '6MOU001-MOUSE USB', '2011-06-23 17:38:50', 'DeliveryOrderDetail "6MOU001-MOUSE USB" (19) updated by User "gs" (7).', 'DeliveryOrderDetail', 19, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(290, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 17:38:53', 'DeliveryOrderDetail "6PRI001-PROJECTOR INFOCUS" (20) updated by User "gs" (7).', 'DeliveryOrderDetail', 20, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(291, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 17:38:56', 'DeliveryOrderDetail "6MOU002-MOUSE SERIAL PS/2" (21) updated by User "gs" (7).', 'DeliveryOrderDetail', 21, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(292, '6PCT001-THIN CLIENT  ', '2011-06-23 17:38:59', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (22) updated by User "gs" (7).', 'DeliveryOrderDetail', 22, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(293, '6PCT001-THIN CLIENT  ', '2011-06-23 17:39:01', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (23) updated by User "gs" (7).', 'DeliveryOrderDetail', 23, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(294, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 17:39:04', 'DeliveryOrderDetail "6PRE001 -PRINTER EPSON LQ 2180" (24) updated by User "gs" (7).', 'DeliveryOrderDetail', 24, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(295, '6PCT001-THIN CLIENT  ', '2011-06-23 17:39:06', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (25) updated by User "gs" (7).', 'DeliveryOrderDetail', 25, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(296, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 17:39:09', 'DeliveryOrderDetail "6PRE001 -PRINTER EPSON LQ 2180" (26) updated by User "gs" (7).', 'DeliveryOrderDetail', 26, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(297, '6MSA001-ATEN ', '2011-06-23 17:39:11', 'DeliveryOrderDetail "6MSA001-ATEN " (27) updated by User "gs" (7).', 'DeliveryOrderDetail', 27, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(298, '6PCT001-THIN CLIENT  ', '2011-06-23 17:39:14', 'DeliveryOrderDetail "6PCT001-THIN CLIENT  " (28) updated by User "gs" (7).', 'DeliveryOrderDetail', 28, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(299, 'PO-0003', '2011-06-23 17:39:14', 'Po "PO-0003" (4) updated by User "gs" (7).', 'Po', 4, 'edit', 7, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(300, 'yyyyy2', '2011-06-23 17:41:04', 'DeliveryOrder "yyyyy2" (2) updated by User "gs" (7).', 'DeliveryOrder', 2, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(301, 'yyyyy2', '2011-06-23 17:41:31', 'DeliveryOrder "yyyyy2" (2) updated by User "gs" (7).', 'DeliveryOrder', 2, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(302, 'K010-Kursi', '2011-06-23 17:42:45', 'DeliveryOrderDetail "K010-Kursi" (9) updated by User "gs" (7).', 'DeliveryOrderDetail', 9, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(303, 'K010-Kursi', '2011-06-23 17:43:00', 'DeliveryOrderDetail "K010-Kursi" (9) updated by User "gs" (7).', 'DeliveryOrderDetail', 9, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(304, 'PO-0001', '2011-06-23 17:43:00', 'Po "PO-0001" (1) updated by User "gs" (7).', 'Po', 1, 'edit', 7, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(305, 'yyyyy2', '2011-06-23 17:43:20', 'DeliveryOrder "yyyyy2" (2) updated by User "gs" (7).', 'DeliveryOrder', 2, 'edit', 7, 'delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(306, '', '2011-06-23 17:48:13', 'Purchase (1) added by User "gs" (7).', 'Purchase', 1, 'add', 7, 'sup_tanggal, pos_ting, date_of_purchase, warranty_date, kd_luar_tanggal, currency_id, no, delivery_order_id, po_no, po_id, supplier_id, warranty_id', NULL, NULL, NULL, NULL, NULL),
(307, 'K010-Kursi', '2011-06-23 17:48:13', 'Asset "K010-Kursi" (1) added by User "gs" (7).', 'Asset', 1, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(308, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (1) added by User "gs" (7).', 'AssetDetail', 1, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(309, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (2) added by User "gs" (7).', 'AssetDetail', 2, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(310, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (3) added by User "gs" (7).', 'AssetDetail', 3, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(311, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (4) added by User "gs" (7).', 'AssetDetail', 4, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(312, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (5) added by User "gs" (7).', 'AssetDetail', 5, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(313, 'K010-Kursi', '2011-06-23 17:48:13', 'Asset "K010-Kursi" (2) added by User "gs" (7).', 'Asset', 2, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(314, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (6) added by User "gs" (7).', 'AssetDetail', 6, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(315, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (7) added by User "gs" (7).', 'AssetDetail', 7, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(316, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (8) added by User "gs" (7).', 'AssetDetail', 8, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(317, 'K010-Kursi', '2011-06-23 17:48:13', 'AssetDetail "K010-Kursi" (9) added by User "gs" (7).', 'AssetDetail', 9, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(318, 'K010-Kursi', '2011-06-23 17:48:14', 'AssetDetail "K010-Kursi" (10) added by User "gs" (7).', 'AssetDetail', 10, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(319, '7KRS002-KURSI HADAP', '2011-06-23 17:48:14', 'Asset "7KRS002-KURSI HADAP" (3) added by User "gs" (7).', 'Asset', 3, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(320, '7KRS002-KURSI HADAP', '2011-06-23 17:48:14', 'AssetDetail "7KRS002-KURSI HADAP" (11) added by User "gs" (7).', 'AssetDetail', 11, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(321, '7KRS002-KURSI HADAP', '2011-06-23 17:48:14', 'AssetDetail "7KRS002-KURSI HADAP" (12) added by User "gs" (7).', 'AssetDetail', 12, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(322, '7KRS002-KURSI HADAP', '2011-06-23 17:48:14', 'AssetDetail "7KRS002-KURSI HADAP" (13) added by User "gs" (7).', 'AssetDetail', 13, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(323, '7KRS002-KURSI HADAP', '2011-06-23 17:48:14', 'AssetDetail "7KRS002-KURSI HADAP" (14) added by User "gs" (7).', 'AssetDetail', 14, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(324, '7KRS002-KURSI HADAP', '2011-06-23 17:48:14', 'AssetDetail "7KRS002-KURSI HADAP" (15) added by User "gs" (7).', 'AssetDetail', 15, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(325, '7KRS003-KURSI TUNGGU', '2011-06-23 17:48:14', 'Asset "7KRS003-KURSI TUNGGU" (4) added by User "gs" (7).', 'Asset', 4, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(326, '7KRS003-KURSI TUNGGU', '2011-06-23 17:48:14', 'AssetDetail "7KRS003-KURSI TUNGGU" (16) added by User "gs" (7).', 'AssetDetail', 16, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(327, '7KRS003-KURSI TUNGGU', '2011-06-23 17:48:14', 'AssetDetail "7KRS003-KURSI TUNGGU" (17) added by User "gs" (7).', 'AssetDetail', 17, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(328, 'LMR001-Lemari Besi', '2011-06-23 17:48:14', 'Asset "LMR001-Lemari Besi" (5) added by User "gs" (7).', 'Asset', 5, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(329, 'LMR001-Lemari Besi', '2011-06-23 17:48:14', 'AssetDetail "LMR001-Lemari Besi" (18) added by User "gs" (7).', 'AssetDetail', 18, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(330, 'LMR001-Lemari Besi', '2011-06-23 17:48:14', 'AssetDetail "LMR001-Lemari Besi" (19) added by User "gs" (7).', 'AssetDetail', 19, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(331, 'LMR001-Lemari Besi', '2011-06-23 17:48:14', 'AssetDetail "LMR001-Lemari Besi" (20) added by User "gs" (7).', 'AssetDetail', 20, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(332, 'LMR001-Lemari Besi', '2011-06-23 17:48:14', 'AssetDetail "LMR001-Lemari Besi" (21) added by User "gs" (7).', 'AssetDetail', 21, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(333, 'LMR001-Lemari Besi', '2011-06-23 17:48:14', 'AssetDetail "LMR001-Lemari Besi" (22) added by User "gs" (7).', 'AssetDetail', 22, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(334, '7KRS001-KURSI KERJA', '2011-06-23 17:48:14', 'Asset "7KRS001-KURSI KERJA" (6) added by User "gs" (7).', 'Asset', 6, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(335, '7KRS001-KURSI KERJA', '2011-06-23 17:48:14', 'AssetDetail "7KRS001-KURSI KERJA" (23) added by User "gs" (7).', 'AssetDetail', 23, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(336, '7KRS001-KURSI KERJA', '2011-06-23 17:48:14', 'AssetDetail "7KRS001-KURSI KERJA" (24) added by User "gs" (7).', 'AssetDetail', 24, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(337, '7KRS001-KURSI KERJA', '2011-06-23 17:48:14', 'AssetDetail "7KRS001-KURSI KERJA" (25) added by User "gs" (7).', 'AssetDetail', 25, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(338, '7KRS001-KURSI KERJA', '2011-06-23 17:48:14', 'AssetDetail "7KRS001-KURSI KERJA" (26) added by User "gs" (7).', 'AssetDetail', 26, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(339, '7KRS001-KURSI KERJA', '2011-06-23 17:48:14', 'AssetDetail "7KRS001-KURSI KERJA" (27) added by User "gs" (7).', 'AssetDetail', 27, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(340, 'xx111', '2011-06-23 17:48:14', 'DeliveryOrder "xx111" (1) updated by User "gs" (7).', 'DeliveryOrder', 1, 'edit', 7, 'convert_asset', NULL, NULL, NULL, NULL, NULL),
(341, 'K010-Kursi', '2011-06-23 17:54:40', 'AssetDetail "K010-Kursi" (1) updated by User "gs" (7).', 'AssetDetail', 1, 'edit', 7, 'color, location_id', NULL, NULL, NULL, NULL, NULL),
(342, 'K010-Kursi', '2011-06-23 17:55:56', 'AssetDetail "K010-Kursi" (1) updated by User "gs" (7).', 'AssetDetail', 1, 'edit', 7, 'brand, type, location_id, notes', NULL, NULL, NULL, NULL, NULL),
(343, 'K010-Kursi', '2011-06-23 17:56:45', 'AssetDetail "K010-Kursi" (1) updated by User "gs" (7).', 'AssetDetail', 1, 'edit', 7, 'serial_no', NULL, NULL, NULL, NULL, NULL),
(344, 'K010-Kursi', '2011-06-23 17:57:55', 'AssetDetail "K010-Kursi" (2) updated by User "gs" (7).', 'AssetDetail', 2, 'edit', 7, 'color, brand, type, serial_no, location_id, notes', NULL, NULL, NULL, NULL, NULL),
(345, 'K010-Kursi', '2011-06-23 17:58:51', 'AssetDetail "K010-Kursi" (3) updated by User "gs" (7).', 'AssetDetail', 3, 'edit', 7, 'color, location_id', NULL, NULL, NULL, NULL, NULL),
(346, 'K010-Kursi', '2011-06-23 17:59:23', 'AssetDetail "K010-Kursi" (3) updated by User "gs" (7).', 'AssetDetail', 3, 'edit', 7, 'brand, type, serial_no, location_id', NULL, NULL, NULL, NULL, NULL),
(347, 'K010-Kursi', '2011-06-23 18:04:47', 'AssetDetail "K010-Kursi" (4) updated by User "gs" (7).', 'AssetDetail', 4, 'edit', 7, 'color, brand, type, serial_no, location_id', NULL, NULL, NULL, NULL, NULL),
(348, 'K010-Kursi', '2011-06-23 18:05:26', 'AssetDetail "K010-Kursi" (5) updated by User "gs" (7).', 'AssetDetail', 5, 'edit', 7, 'color, brand, type, serial_no, location_id', NULL, NULL, NULL, NULL, NULL),
(349, '', '2011-06-23 18:06:39', 'Purchase (2) added by User "gs" (7).', 'Purchase', 2, 'add', 7, 'sup_tanggal, pos_ting, date_of_purchase, warranty_date, kd_luar_tanggal, currency_id, no, delivery_order_id, po_no, po_id, supplier_id, warranty_id', NULL, NULL, NULL, NULL, NULL),
(350, '6LCH003 -LCD HP ', '2011-06-23 18:06:40', 'Asset "6LCH003 -LCD HP " (7) added by User "gs" (7).', 'Asset', 7, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(351, '6LCH003 -LCD HP ', '2011-06-23 18:06:40', 'AssetDetail "6LCH003 -LCD HP " (28) added by User "gs" (7).', 'AssetDetail', 28, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(352, '6LCH003 -LCD HP ', '2011-06-23 18:06:40', 'AssetDetail "6LCH003 -LCD HP " (29) added by User "gs" (7).', 'AssetDetail', 29, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(353, '6LCH003 -LCD HP ', '2011-06-23 18:06:40', 'AssetDetail "6LCH003 -LCD HP " (30) added by User "gs" (7).', 'AssetDetail', 30, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(354, '6MOU001-MOUSE USB', '2011-06-23 18:06:40', 'Asset "6MOU001-MOUSE USB" (8) added by User "gs" (7).', 'Asset', 8, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(355, '6MOU001-MOUSE USB', '2011-06-23 18:06:40', 'AssetDetail "6MOU001-MOUSE USB" (31) added by User "gs" (7).', 'AssetDetail', 31, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(356, '6MOU001-MOUSE USB', '2011-06-23 18:06:40', 'AssetDetail "6MOU001-MOUSE USB" (32) added by User "gs" (7).', 'AssetDetail', 32, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(357, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 18:06:40', 'Asset "6PRI001-PROJECTOR INFOCUS" (9) added by User "gs" (7).', 'Asset', 9, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(358, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 18:06:40', 'AssetDetail "6PRI001-PROJECTOR INFOCUS" (33) added by User "gs" (7).', 'AssetDetail', 33, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(359, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 18:06:40', 'AssetDetail "6PRI001-PROJECTOR INFOCUS" (34) added by User "gs" (7).', 'AssetDetail', 34, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(360, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 18:06:40', 'AssetDetail "6PRI001-PROJECTOR INFOCUS" (35) added by User "gs" (7).', 'AssetDetail', 35, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(361, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 18:06:40', 'Asset "6MOU002-MOUSE SERIAL PS/2" (10) added by User "gs" (7).', 'Asset', 10, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(362, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 18:06:40', 'AssetDetail "6MOU002-MOUSE SERIAL PS/2" (36) added by User "gs" (7).', 'AssetDetail', 36, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(363, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 18:06:40', 'AssetDetail "6MOU002-MOUSE SERIAL PS/2" (37) added by User "gs" (7).', 'AssetDetail', 37, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(364, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:40', 'Asset "6PCT001-THIN CLIENT  " (11) added by User "gs" (7).', 'Asset', 11, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(365, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:40', 'AssetDetail "6PCT001-THIN CLIENT  " (38) added by User "gs" (7).', 'AssetDetail', 38, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(366, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'Asset "6PCT001-THIN CLIENT  " (12) added by User "gs" (7).', 'Asset', 12, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(367, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'AssetDetail "6PCT001-THIN CLIENT  " (39) added by User "gs" (7).', 'AssetDetail', 39, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(368, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:06:41', 'Asset "6PRE001 -PRINTER EPSON LQ 2180" (13) added by User "gs" (7).', 'Asset', 13, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(369, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:06:41', 'AssetDetail "6PRE001 -PRINTER EPSON LQ 2180" (40) added by User "gs" (7).', 'AssetDetail', 40, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(370, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:06:41', 'AssetDetail "6PRE001 -PRINTER EPSON LQ 2180" (41) added by User "gs" (7).', 'AssetDetail', 41, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(371, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'Asset "6PCT001-THIN CLIENT  " (14) added by User "gs" (7).', 'Asset', 14, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(372, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'AssetDetail "6PCT001-THIN CLIENT  " (42) added by User "gs" (7).', 'AssetDetail', 42, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(373, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:06:41', 'Asset "6PRE001 -PRINTER EPSON LQ 2180" (15) added by User "gs" (7).', 'Asset', 15, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(374, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:06:41', 'AssetDetail "6PRE001 -PRINTER EPSON LQ 2180" (43) added by User "gs" (7).', 'AssetDetail', 43, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(375, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:06:41', 'AssetDetail "6PRE001 -PRINTER EPSON LQ 2180" (44) added by User "gs" (7).', 'AssetDetail', 44, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(376, '6MSA001-ATEN ', '2011-06-23 18:06:41', 'Asset "6MSA001-ATEN " (16) added by User "gs" (7).', 'Asset', 16, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(377, '6MSA001-ATEN ', '2011-06-23 18:06:41', 'AssetDetail "6MSA001-ATEN " (45) added by User "gs" (7).', 'AssetDetail', 45, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(378, '6MSA001-ATEN ', '2011-06-23 18:06:41', 'AssetDetail "6MSA001-ATEN " (46) added by User "gs" (7).', 'AssetDetail', 46, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(379, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'Asset "6PCT001-THIN CLIENT  " (17) added by User "gs" (7).', 'Asset', 17, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, name, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(380, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'AssetDetail "6PCT001-THIN CLIENT  " (47) added by User "gs" (7).', 'AssetDetail', 47, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(381, '6PCT001-THIN CLIENT  ', '2011-06-23 18:06:41', 'AssetDetail "6PCT001-THIN CLIENT  " (48) added by User "gs" (7).', 'AssetDetail', 48, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, name, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(382, 'www5', '2011-06-23 18:06:41', 'DeliveryOrder "www5" (4) updated by User "gs" (7).', 'DeliveryOrder', 4, 'edit', 7, 'convert_asset', NULL, NULL, NULL, NULL, NULL),
(383, '6LCH003 -LCD HP ', '2011-06-23 18:09:27', 'AssetDetail "6LCH003 -LCD HP " (28) updated by User "gs" (7).', 'AssetDetail', 28, 'edit', 7, 'color, brand, type, serial_no, location_id', NULL, NULL, NULL, NULL, NULL),
(384, '6LCH003 -LCD HP ', '2011-06-23 18:09:54', 'AssetDetail "6LCH003 -LCD HP " (29) updated by User "gs" (7).', 'AssetDetail', 29, 'edit', 7, 'color, location_id', NULL, NULL, NULL, NULL, NULL),
(385, '6LCH003 -LCD HP ', '2011-06-23 18:10:45', 'AssetDetail "6LCH003 -LCD HP " (30) updated by User "gs" (7).', 'AssetDetail', 30, 'edit', 7, 'serial_no, location_id', NULL, NULL, NULL, NULL, NULL),
(386, '6LCH003 -LCD HP ', '2011-06-23 18:18:33', 'InvoiceDetail "6LCH003 -LCD HP " (1) added by System.', 'InvoiceDetail', 1, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(387, '6MOU001-MOUSE USB', '2011-06-23 18:18:33', 'InvoiceDetail "6MOU001-MOUSE USB" (2) added by System.', 'InvoiceDetail', 2, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(388, '6PRI001-PROJECTOR INFOCUS', '2011-06-23 18:18:33', 'InvoiceDetail "6PRI001-PROJECTOR INFOCUS" (3) added by System.', 'InvoiceDetail', 3, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(389, '6MOU002-MOUSE SERIAL PS/2', '2011-06-23 18:18:33', 'InvoiceDetail "6MOU002-MOUSE SERIAL PS/2" (4) added by System.', 'InvoiceDetail', 4, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(390, '6PCT001-THIN CLIENT  ', '2011-06-23 18:18:33', 'InvoiceDetail "6PCT001-THIN CLIENT  " (5) added by System.', 'InvoiceDetail', 5, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(391, '6PCT001-THIN CLIENT  ', '2011-06-23 18:18:33', 'InvoiceDetail "6PCT001-THIN CLIENT  " (6) added by System.', 'InvoiceDetail', 6, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(392, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:18:33', 'InvoiceDetail "6PRE001 -PRINTER EPSON LQ 2180" (7) added by System.', 'InvoiceDetail', 7, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(393, '6PCT001-THIN CLIENT  ', '2011-06-23 18:18:33', 'InvoiceDetail "6PCT001-THIN CLIENT  " (8) added by System.', 'InvoiceDetail', 8, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(394, '6PRE001 -PRINTER EPSON LQ 2180', '2011-06-23 18:18:33', 'InvoiceDetail "6PRE001 -PRINTER EPSON LQ 2180" (9) added by System.', 'InvoiceDetail', 9, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(395, '6MSA001-ATEN ', '2011-06-23 18:18:33', 'InvoiceDetail "6MSA001-ATEN " (10) added by System.', 'InvoiceDetail', 10, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(396, '6PCT001-THIN CLIENT  ', '2011-06-23 18:18:33', 'InvoiceDetail "6PCT001-THIN CLIENT  " (11) added by System.', 'InvoiceDetail', 11, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(397, 'K010-Kursi', '2011-06-23 18:21:29', 'InvoiceDetail "K010-Kursi" (12) added by System.', 'InvoiceDetail', 12, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(398, 'K010-Kursi', '2011-06-23 18:21:29', 'InvoiceDetail "K010-Kursi" (13) added by System.', 'InvoiceDetail', 13, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(399, '7KRS002-KURSI HADAP', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS002-KURSI HADAP" (14) added by System.', 'InvoiceDetail', 14, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(400, '7KRS003-KURSI TUNGGU', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS003-KURSI TUNGGU" (15) added by System.', 'InvoiceDetail', 15, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(401, 'LMR001-Lemari Besi', '2011-06-23 18:21:29', 'InvoiceDetail "LMR001-Lemari Besi" (16) added by System.', 'InvoiceDetail', 16, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(402, '7KRS001-KURSI KERJA', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS001-KURSI KERJA" (17) added by System.', 'InvoiceDetail', 17, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(403, '7KRS002-KURSI HADAP', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS002-KURSI HADAP" (18) added by System.', 'InvoiceDetail', 18, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `logs` (`id`, `title`, `created`, `description`, `model`, `model_id`, `action`, `user_id`, `change`, `version_id`, `fields`, `order`, `conditions`, `events`) VALUES
(404, 'K010-Kursi', '2011-06-23 18:21:29', 'InvoiceDetail "K010-Kursi" (19) added by System.', 'InvoiceDetail', 19, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(405, 'K010-Kursi', '2011-06-23 18:21:29', 'InvoiceDetail "K010-Kursi" (20) added by System.', 'InvoiceDetail', 20, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(406, '7KRS002-KURSI HADAP', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS002-KURSI HADAP" (21) added by System.', 'InvoiceDetail', 21, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(407, '7KRS003-KURSI TUNGGU', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS003-KURSI TUNGGU" (22) added by System.', 'InvoiceDetail', 22, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(408, 'LMR001-Lemari Besi', '2011-06-23 18:21:29', 'InvoiceDetail "LMR001-Lemari Besi" (23) added by System.', 'InvoiceDetail', 23, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(409, '7KRS001-KURSI KERJA', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS001-KURSI KERJA" (24) added by System.', 'InvoiceDetail', 24, 'add', NULL, 'qty, price, price_cur, discount_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(410, '7KRS002-KURSI HADAP', '2011-06-23 18:21:29', 'InvoiceDetail "7KRS002-KURSI HADAP" (25) added by System.', 'InvoiceDetail', 25, 'add', NULL, 'qty, price, price_cur, discount_cur, amount_nett, amount_nett_cur, rp_rate, npb_id, po_id, is_vat, is_wht, asset_category_id, name, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, currency_id, umurek, department_id, item_id, invoice_id, wht_rate, vat_rate', NULL, NULL, NULL, NULL, NULL),
(411, 'rabobank a/c:12345678 a/n:mrz computer Rp', '2011-06-23 18:26:25', 'BankAccount (6) added by User "fincon" (9).', 'BankAccount', 6, 'add', 9, 'bank_name, bank_account_no, bank_account_name, bank_account_type_id, currency_id, supplier_id', NULL, NULL, NULL, NULL, NULL),
(412, 'InvoicePayment (1)', '2011-06-23 18:27:15', 'InvoicePayment (1) added by User "fincon" (9).', 'InvoicePayment', 1, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, description, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(413, 'bca a/c:22222 a/n:dunia m Rp', '2011-06-23 18:29:50', 'BankAccount (7) added by User "fincon" (9).', 'BankAccount', 7, 'add', 9, 'bank_name, bank_account_no, bank_account_name, bank_account_type_id, currency_id, supplier_id', NULL, NULL, NULL, NULL, NULL),
(414, 'InvoicePayment (2)', '2011-06-23 18:30:50', 'InvoicePayment (2) added by User "fincon" (9).', 'InvoicePayment', 2, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(415, 'InvoicePayment (3)', '2011-06-23 18:32:02', 'InvoicePayment (3) added by User "fincon" (9).', 'InvoicePayment', 3, 'add', 9, 'is_posted, invoice_id, no, term_no, date_due, amount_invoice, amount_due, date_paid, term_percent, amount_paid, bank_account_id, bank_account_type_id', NULL, NULL, NULL, NULL, NULL),
(416, 'JournalTransaction (1)', '2011-06-23 18:33:23', 'JournalTransaction (1) added by User "fincon" (9).', 'JournalTransaction', 1, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(417, 'JournalTransaction (2)', '2011-06-23 18:33:23', 'JournalTransaction (2) added by User "fincon" (9).', 'JournalTransaction', 2, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(418, 'JournalTransaction (3)', '2011-06-23 18:33:23', 'JournalTransaction (3) added by User "fincon" (9).', 'JournalTransaction', 3, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(419, 'JournalTransaction (4)', '2011-06-23 18:33:23', 'JournalTransaction (4) added by User "fincon" (9).', 'JournalTransaction', 4, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(420, 'JournalTransaction (5)', '2011-06-23 18:33:23', 'JournalTransaction (5) added by User "fincon" (9).', 'JournalTransaction', 5, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(421, 'JournalTransaction (6)', '2011-06-23 18:33:23', 'JournalTransaction (6) added by User "fincon" (9).', 'JournalTransaction', 6, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(422, 'JournalTransaction (7)', '2011-06-23 18:34:43', 'JournalTransaction (7) added by User "fincon" (9).', 'JournalTransaction', 7, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(423, 'JournalTransaction (8)', '2011-06-23 18:34:43', 'JournalTransaction (8) added by User "fincon" (9).', 'JournalTransaction', 8, 'add', 9, 'amount_db, amount_cr, posting, date, account_code, account_id, journal_position_id, department_id, journal_template_id, source, doc_id', NULL, NULL, NULL, NULL, NULL),
(424, 'MR-016-11-0005', '2011-06-24 11:14:20', 'Npb "MR-016-11-0005" (10) added by User "cabang" (8).', 'Npb', 10, 'add', 8, 'supplier_id, created_date, is_purchase_request, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, created_by', NULL, NULL, NULL, NULL, NULL),
(425, 'NpbDetail (30)', '2011-06-24 11:14:34', 'NpbDetail (30) added by User "cabang" (8).', 'NpbDetail', 30, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, npb_id', NULL, NULL, NULL, NULL, NULL),
(426, 'MR-016-11-0005', '2011-06-24 11:14:48', 'Npb (10) updated by User "cabang" (8).', 'Npb', 10, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(427, 'MR-016-11-0005', '2011-06-24 11:14:48', 'Npb (10) updated by User "cabang" (8).', 'Npb', 10, 'edit', 8, '', NULL, NULL, NULL, NULL, NULL),
(428, 'MR-016-11-0005', '2011-06-24 11:14:48', 'Npb (10) updated by User "cabang" (8).', 'Npb', 10, 'edit', 8, '', NULL, NULL, NULL, NULL, NULL),
(429, 'MR-016-11-0005', '2011-06-24 11:15:11', 'Npb (10) updated by User "heri" (3).', 'Npb', 10, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(430, 'NpbDetail (30)', '2011-06-24 11:15:42', 'NpbDetail (30) updated by User "gs_admin" (13).', 'NpbDetail', 30, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(431, 'MR-016-11-0005', '2011-06-24 11:15:45', 'Npb (10) updated by User "gs_admin" (13).', 'Npb', 10, 'edit', 13, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(432, 'PO-0005', '2011-06-24 11:22:05', 'Po "PO-0005" (6) added by User "gs" (7).', 'Po', 6, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(433, '1', '2011-06-24 11:22:05', 'PoPayment "1" (8) added by User "gs" (7).', 'PoPayment', 8, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(434, 'K010-Kursi', '2011-06-24 11:22:05', 'PoDetail "K010-Kursi" (24) added by User "gs" (7).', 'PoDetail', 24, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, amount, amount_cur, currency_id, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(435, 'NpbDetail (30)', '2011-06-24 11:22:05', 'NpbDetail (30) updated by User "gs" (7).', 'NpbDetail', 30, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(436, 'MR-016-11-0005', '2011-06-24 11:22:05', 'Npb "MR-016-11-0005" (10) updated by User "gs" (7).', 'Npb', 10, 'edit', 7, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(437, 'PO-0005', '2011-06-24 11:22:05', 'Po "PO-0005" (6) updated by User "gs" (7).', 'Po', 6, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(438, 'MR-016-11-0006', '2011-06-24 14:20:22', 'Npb "MR-016-11-0006" (11) added by User "cabang" (8).', 'Npb', 11, 'add', 8, 'supplier_id, created_date, is_purchase_request, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(439, 'NpbDetail (31)', '2011-06-24 14:20:39', 'NpbDetail (31) added by User "cabang" (8).', 'NpbDetail', 31, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(440, 'NpbDetail (32)', '2011-06-24 14:20:47', 'NpbDetail (32) added by User "cabang" (8).', 'NpbDetail', 32, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, descr, npb_id', NULL, NULL, NULL, NULL, NULL),
(441, 'MR-016-11-0006', '2011-06-24 14:20:49', 'Npb (11) updated by User "cabang" (8).', 'Npb', 11, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(442, 'MR-016-11-0006', '2011-06-24 14:21:02', 'Npb (11) updated by User "heri" (3).', 'Npb', 11, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(443, 'MR-016-11-0006', '2011-06-24 14:46:39', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(444, 'MR-016-11-0006', '2011-06-24 14:47:23', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, '', NULL, NULL, NULL, NULL, NULL),
(445, 'tets', '2011-06-24 14:48:36', 'Attachment "tets" (4) added by User "it_admin" (14).', 'Attachment', 4, 'add', 14, 'name, npb_id, attachment_file_path, attachment_file_name, attachment_file_size, attachment_content_type', NULL, NULL, NULL, NULL, NULL),
(446, 'MR-016-11-0006', '2011-06-24 15:11:22', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(447, 'MR-016-11-0006', '2011-06-24 15:14:42', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(448, 'MR-016-11-0006', '2011-06-24 15:17:53', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(449, 'MR-016-11-0006', '2011-06-24 15:18:05', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(450, 'NpbDetail (32)', '2011-06-24 15:18:43', 'NpbDetail (32) updated by User "it_admin" (14).', 'NpbDetail', 32, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(451, 'NpbDetail (31)', '2011-06-24 15:18:44', 'NpbDetail (31) updated by User "it_admin" (14).', 'NpbDetail', 31, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(452, 'MR-016-11-0006', '2011-06-24 15:18:49', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(453, 'MR-016-11-0006', '2011-06-24 15:19:06', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(454, 'MR-016-11-0006', '2011-06-24 15:22:27', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(455, 'MR-016-11-0006', '2011-06-24 15:23:11', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(456, 'MR-016-11-0006', '2011-06-24 15:24:02', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(457, 'NpbDetail (32)', '2011-06-24 15:26:24', 'NpbDetail (32) updated by User "it_admin" (14).', 'NpbDetail', 32, 'edit', 14, '', NULL, NULL, NULL, NULL, NULL),
(458, 'NpbDetail (31)', '2011-06-24 15:26:25', 'NpbDetail (31) updated by User "it_admin" (14).', 'NpbDetail', 31, 'edit', 14, '', NULL, NULL, NULL, NULL, NULL),
(459, 'MR-016-11-0006', '2011-06-24 15:26:27', 'Npb (11) updated by User "it_admin" (14).', 'Npb', 11, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(460, 'MR-016-11-0007', '2011-06-24 15:36:08', 'Npb "MR-016-11-0007" (12) added by User "cabang" (8).', 'Npb', 12, 'add', 8, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(461, 'NpbDetail (33)', '2011-06-24 15:58:54', 'NpbDetail (33) added by User "cabang" (8).', 'NpbDetail', 33, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(462, 'NpbDetail (33)', '2011-06-24 16:00:42', 'NpbDetail (33) deleted by User "cabang" (8).', 'NpbDetail', 33, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(463, 'NpbDetail (34)', '2011-06-24 16:10:48', 'NpbDetail (34) added by User "cabang" (8).', 'NpbDetail', 34, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(464, 'NpbDetail (34)', '2011-06-24 16:11:50', 'NpbDetail (34) deleted by User "cabang" (8).', 'NpbDetail', 34, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(465, 'NpbDetail (35)', '2011-06-24 16:12:57', 'NpbDetail (35) added by User "cabang" (8).', 'NpbDetail', 35, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(466, 'NpbDetail (35)', '2011-06-24 16:16:08', 'NpbDetail (35) deleted by User "cabang" (8).', 'NpbDetail', 35, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(467, 'NpbDetail (36)', '2011-06-24 16:19:56', 'NpbDetail (36) added by User "cabang" (8).', 'NpbDetail', 36, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(468, 'NpbDetail (37)', '2011-06-24 16:20:24', 'NpbDetail (37) added by User "cabang" (8).', 'NpbDetail', 37, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(469, 'NpbDetail (36)', '2011-06-24 16:33:59', 'NpbDetail (36) deleted by User "cabang" (8).', 'NpbDetail', 36, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(470, 'NpbDetail (37)', '2011-06-24 16:34:03', 'NpbDetail (37) deleted by User "cabang" (8).', 'NpbDetail', 37, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(471, 'NpbDetail (38)', '2011-06-24 16:34:11', 'NpbDetail (38) added by User "cabang" (8).', 'NpbDetail', 38, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(472, 'NpbDetail (38)', '2011-06-24 16:36:02', 'NpbDetail (38) deleted by User "cabang" (8).', 'NpbDetail', 38, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(473, 'NpbDetail (39)', '2011-06-24 16:36:46', 'NpbDetail (39) added by User "cabang" (8).', 'NpbDetail', 39, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(474, 'NpbDetail (40)', '2011-06-24 16:37:35', 'NpbDetail (40) added by User "cabang" (8).', 'NpbDetail', 40, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(475, 'NpbDetail (40)', '2011-06-24 16:37:40', 'NpbDetail (40) deleted by User "cabang" (8).', 'NpbDetail', 40, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(476, 'NpbDetail (39)', '2011-06-24 16:37:43', 'NpbDetail (39) deleted by User "cabang" (8).', 'NpbDetail', 39, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(477, 'NpbDetail (41)', '2011-06-24 16:39:05', 'NpbDetail (41) added by User "cabang" (8).', 'NpbDetail', 41, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(478, 'NpbDetail (42)', '2011-06-24 16:39:12', 'NpbDetail (42) added by User "cabang" (8).', 'NpbDetail', 42, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(479, 'NpbDetail (43)', '2011-06-24 16:39:19', 'NpbDetail (43) added by User "cabang" (8).', 'NpbDetail', 43, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(480, 'NpbDetail (43)', '2011-06-24 16:39:21', 'NpbDetail (43) deleted by User "cabang" (8).', 'NpbDetail', 43, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(481, 'NpbDetail (41)', '2011-06-24 16:39:25', 'NpbDetail (41) deleted by User "cabang" (8).', 'NpbDetail', 41, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(482, 'NpbDetail (42)', '2011-06-24 16:39:28', 'NpbDetail (42) deleted by User "cabang" (8).', 'NpbDetail', 42, 'delete', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(483, 'NpbDetail (44)', '2011-06-24 16:42:56', 'NpbDetail (44) added by User "cabang" (8).', 'NpbDetail', 44, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(484, 'MR-016-11-0007', '2011-06-24 16:42:57', 'Npb (12) updated by User "cabang" (8).', 'Npb', 12, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(485, 'MR-016-11-0007', '2011-06-24 16:43:25', 'Npb (12) updated by User "heri" (3).', 'Npb', 12, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(486, 'NpbDetail (44)', '2011-06-24 16:43:49', 'NpbDetail (44) updated by User "it_admin" (14).', 'NpbDetail', 44, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(487, 'MR-016-11-0007', '2011-06-24 16:43:53', 'Npb (12) updated by User "it_admin" (14).', 'Npb', 12, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(488, 'MR-016-11-0007', '2011-06-24 16:43:59', 'Npb (12) updated by User "it_admin" (14).', 'Npb', 12, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(489, 'MR-016-11-0008', '2011-06-24 16:47:27', 'Npb "MR-016-11-0008" (13) added by User "cabang" (8).', 'Npb', 13, 'add', 8, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, created_by', NULL, NULL, NULL, NULL, NULL),
(490, 'NpbDetail (45)', '2011-06-24 16:47:38', 'NpbDetail (45) added by User "cabang" (8).', 'NpbDetail', 45, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(491, 'MR-016-11-0008', '2011-06-24 16:47:40', 'Npb (13) updated by User "cabang" (8).', 'Npb', 13, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(492, 'MR-016-11-0008', '2011-06-24 16:47:52', 'Npb (13) updated by User "heri" (3).', 'Npb', 13, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(493, 'NpbDetail (45)', '2011-06-24 16:48:14', 'NpbDetail (45) updated by User "gs_admin" (13).', 'NpbDetail', 45, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(494, 'NpbDetail (45)', '2011-06-24 16:48:15', 'NpbDetail (45) updated by User "gs_admin" (13).', 'NpbDetail', 45, 'edit', 13, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(495, 'MR-016-11-0008', '2011-06-24 16:48:16', 'Npb (13) updated by User "gs_admin" (13).', 'Npb', 13, 'edit', 13, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(496, 'PO-0006', '2011-06-24 17:30:29', 'Po "PO-0006" (7) added by User "gs" (7).', 'Po', 7, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(497, '1', '2011-06-24 17:30:29', 'PoPayment "1" (9) added by User "gs" (7).', 'PoPayment', 9, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(498, 'Komputer Lengkap 2', '2011-06-24 17:30:29', 'PoDetail "Komputer Lengkap 2" (25) added by User "gs" (7).', 'PoDetail', 25, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(499, 'NpbDetail (44)', '2011-06-24 17:30:29', 'NpbDetail (44) updated by User "gs" (7).', 'NpbDetail', 44, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(500, 'MR-016-11-0007', '2011-06-24 17:30:29', 'Npb "MR-016-11-0007" (12) updated by User "gs" (7).', 'Npb', 12, 'edit', 7, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(501, 'PO-0006', '2011-06-24 17:30:29', 'Po "PO-0006" (7) updated by User "gs" (7).', 'Po', 7, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(502, 'Komputer Lengkap 2', '2011-06-24 17:42:25', 'PoDetail "Komputer Lengkap 2" (25) updated by User "gs" (7).', 'PoDetail', 25, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(503, 'PO-0006', '2011-06-24 17:42:25', 'Po (7) updated by User "gs" (7).', 'Po', 7, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(504, 'Komputer Lengkap 2', '2011-06-24 17:42:32', 'PoDetail "Komputer Lengkap 2" (25) updated by User "gs" (7).', 'PoDetail', 25, 'edit', 7, 'price_cur, amount, amount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur', NULL, NULL, NULL, NULL, NULL),
(505, 'PO-0006', '2011-06-24 17:42:32', 'Po (7) updated by User "gs" (7).', 'Po', 7, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(506, 'PO-0007', '2011-06-24 17:46:15', 'Po "PO-0007" (8) added by User "gs" (7).', 'Po', 8, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(507, '1', '2011-06-24 17:46:15', 'PoPayment "1" (10) added by User "gs" (7).', 'PoPayment', 10, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(508, 'yyyy', '2011-06-24 17:50:45', 'PoDetail "yyyy" (26) added by User "gs" (7).', 'PoDetail', 26, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, department_id, asset_category_id, item_code, name, brand, type, color, po_id, umurek, amount, amount_cur, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(509, 'PO-0007', '2011-06-24 17:50:45', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(510, 'yyyy', '2011-06-24 17:52:27', 'PoDetail "yyyy" (26) deleted by User "gs" (7).', 'PoDetail', 26, 'delete', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(511, 'PO-0007', '2011-06-24 17:52:27', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(512, 'dddddddd', '2011-06-24 17:52:49', 'PoDetail "dddddddd" (27) added by User "gs" (7).', 'PoDetail', 27, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, department_id, asset_category_id, item_code, name, brand, type, color, po_id, umurek, amount, amount_cur, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(513, 'PO-0007', '2011-06-24 17:52:49', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(514, 'ewwwwwwwww', '2011-06-24 17:57:36', 'PoDetail "ewwwwwwwww" (28) added by User "gs" (7).', 'PoDetail', 28, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, department_id, asset_category_id, item_code, name, brand, type, color, po_id, umurek, amount, amount_cur, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(515, 'PO-0007', '2011-06-24 17:57:36', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(516, 'ewwwwwwwww', '2011-06-24 17:58:42', 'PoDetail "ewwwwwwwww" (28) deleted by User "gs" (7).', 'PoDetail', 28, 'delete', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(517, 'PO-0007', '2011-06-24 17:58:42', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(518, 'dddddddd', '2011-06-24 17:59:05', 'PoDetail "dddddddd" (29) added by User "gs" (7).', 'PoDetail', 29, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, department_id, asset_category_id, item_code, name, brand, type, color, po_id, umurek, amount, amount_cur, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(519, 'PO-0007', '2011-06-24 17:59:05', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(520, '444', '2011-06-24 18:00:05', 'PoDetail "444" (30) added by User "gs" (7).', 'PoDetail', 30, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, department_id, asset_category_id, item_code, name, brand, type, color, po_id, umurek, amount, amount_cur, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(521, 'PO-0007', '2011-06-24 18:00:05', 'Po (8) updated by User "gs" (7).', 'Po', 8, 'edit', 7, 'sub_total_cur, after_disc_cur, vat_base_cur, vat_total_cur, sub_total, after_disc, vat_base, vat_total, total_cur, total', NULL, NULL, NULL, NULL, NULL),
(522, 'MR-016-11-0009', '2011-06-24 18:08:45', 'Npb "MR-016-11-0009" (14) added by User "cabang" (8).', 'Npb', 14, 'add', 8, 'supplier_id, created_date, is_purchase_request, is_printed, no, npb_date, request_type_id, department_id, cost_center_id, business_type_id, req_date, npb_status_id, notes, created_by', NULL, NULL, NULL, NULL, NULL),
(523, 'NpbDetail (46)', '2011-06-24 18:09:09', 'NpbDetail (46) added by User "cabang" (8).', 'NpbDetail', 46, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(524, 'NpbDetail (47)', '2011-06-24 18:09:31', 'NpbDetail (47) added by User "cabang" (8).', 'NpbDetail', 47, 'add', 8, 'qty, price, price_cur, amount_cur, currency_id, discount, discount_cur, amount_net, amount_net_cur, qty_filled, qty_unfilled, unit_id, item_id, color, brand, type, npb_id', NULL, NULL, NULL, NULL, NULL),
(525, 'MR-016-11-0009', '2011-06-24 18:09:32', 'Npb (14) updated by User "cabang" (8).', 'Npb', 14, 'edit', 8, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(526, 'MR-016-11-0009', '2011-06-24 18:10:07', 'Npb (14) updated by User "heri" (3).', 'Npb', 14, 'edit', 3, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(527, 'NpbDetail (46)', '2011-06-24 18:10:52', 'NpbDetail (46) updated by User "it_admin" (14).', 'NpbDetail', 46, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(528, 'NpbDetail (47)', '2011-06-24 18:10:53', 'NpbDetail (47) updated by User "it_admin" (14).', 'NpbDetail', 47, 'edit', 14, 'process_type_id', NULL, NULL, NULL, NULL, NULL),
(529, 'MR-016-11-0009', '2011-06-24 18:10:55', 'Npb (14) updated by User "it_admin" (14).', 'Npb', 14, 'edit', 14, 'is_printed', NULL, NULL, NULL, NULL, NULL),
(530, 'MR-016-11-0009', '2011-06-24 18:11:00', 'Npb (14) updated by User "it_admin" (14).', 'Npb', 14, 'edit', 14, 'npb_status_id', NULL, NULL, NULL, NULL, NULL),
(531, 'PO-0008', '2011-06-24 18:11:37', 'Po "PO-0008" (9) added by User "gs" (7).', 'Po', 9, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(532, '1', '2011-06-24 18:11:37', 'PoPayment "1" (11) added by User "gs" (7).', 'PoPayment', 11, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(533, 'Komputer Lengkap 2', '2011-06-24 18:11:37', 'PoDetail "Komputer Lengkap 2" (31) added by User "gs" (7).', 'PoDetail', 31, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(534, 'NpbDetail (46)', '2011-06-24 18:11:37', 'NpbDetail (46) updated by User "gs" (7).', 'NpbDetail', 46, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(535, 'Printer lengkap', '2011-06-24 18:11:37', 'PoDetail "Printer lengkap" (32) added by User "gs" (7).', 'PoDetail', 32, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(536, 'NpbDetail (47)', '2011-06-24 18:11:37', 'NpbDetail (47) updated by User "gs" (7).', 'NpbDetail', 47, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(537, 'MR-016-11-0009', '2011-06-24 18:11:37', 'Npb "MR-016-11-0009" (14) updated by User "gs" (7).', 'Npb', 14, 'edit', 7, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(538, 'MR-016-11-0009', '2011-06-24 18:11:37', 'Npb "MR-016-11-0009" (14) updated by User "gs" (7).', 'Npb', 14, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(539, 'PO-0008', '2011-06-24 18:11:37', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(540, 'PO-0009', '2011-06-24 18:13:26', 'Po "PO-0009" (10) added by User "gs" (7).', 'Po', 10, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, wht_base, discount, wht_total, vat_total, total, payment_term, printed, request_type_id, down_payment, is_down_payment_journal_generated, no, po_date, delivery_date, supplier_id, description, shipping_address, billing_address, sub_total, currency_id, po_address, po_status_id', NULL, NULL, NULL, NULL, NULL),
(541, '1', '2011-06-24 18:13:26', 'PoPayment "1" (12) added by User "gs" (7).', 'PoPayment', 12, 'add', 7, 'po_id, term_no, date_due, date_paid, description', NULL, NULL, NULL, NULL, NULL),
(542, 'Kursi', '2011-06-24 18:13:26', 'PoDetail "Kursi" (33) added by User "gs" (7).', 'PoDetail', 33, 'add', 7, 'qty, qty_received, price, price_cur, discount, discount_cur, amount_nett, amount_nett_cur, rp_rate, is_vat, is_wht, npb_id, po_id, item_id, color, brand, type, amount, amount_cur, currency_id, item_code, asset_category_id, name, umurek, department_id, npb_detail_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, amount_after_disc_cur, amount_after_disc, vat_cur, vat', NULL, NULL, NULL, NULL, NULL),
(543, 'NpbDetail (45)', '2011-06-24 18:13:26', 'NpbDetail (45) updated by User "gs" (7).', 'NpbDetail', 45, 'edit', 7, 'po_id, qty_filled', NULL, NULL, NULL, NULL, NULL),
(544, 'MR-016-11-0008', '2011-06-24 18:13:26', 'Npb "MR-016-11-0008" (13) updated by User "gs" (7).', 'Npb', 13, 'edit', 7, 'npb_status_id, date_finish', NULL, NULL, NULL, NULL, NULL),
(545, 'PO-0009', '2011-06-24 18:13:26', 'Po "PO-0009" (10) updated by User "gs" (7).', 'Po', 10, 'edit', 7, 'vat_base_cur, sub_total_cur, after_disc_cur, vat_total_cur, total_cur', NULL, NULL, NULL, NULL, NULL),
(546, 'Kursi', '2011-06-24 18:13:33', 'PoDetail "Kursi" (33) updated by User "gs" (7).', 'PoDetail', 33, 'edit', 7, '', NULL, NULL, NULL, NULL, NULL),
(547, 'PO-0009', '2011-06-24 18:13:33', 'Po (10) updated by User "gs" (7).', 'Po', 10, 'edit', 7, 'sub_total, after_disc, vat_base, vat_total, total', NULL, NULL, NULL, NULL, NULL),
(548, 'PO-0008', '2011-06-24 18:16:33', 'Po (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(549, 'PO-0008', '2011-06-24 18:17:01', 'Po (9) updated by User "ade" (4).', 'Po', 9, 'edit', 4, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(550, 'PO-0008', '2011-06-24 18:17:17', 'Po (9) updated by User "badu" (5).', 'Po', 9, 'edit', 5, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(551, 'PO-0008', '2011-06-24 18:17:32', 'Po (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(552, 'PO-0008', '2011-06-24 18:17:47', 'Po (9) updated by User "fincon" (9).', 'Po', 9, 'edit', 9, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(553, 'PO-0008', '2011-06-24 18:19:38', 'Po (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'po_status_id, approval_info', NULL, NULL, NULL, NULL, NULL),
(554, '0092', '2011-06-24 18:25:03', 'DeliveryOrder "0092" (5) added by User "gs" (7).', 'DeliveryOrder', 5, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(555, 'Komputer Lengkap 2', '2011-06-24 18:25:03', 'DeliveryOrderDetail "Komputer Lengkap 2" (29) added by User "gs" (7).', 'DeliveryOrderDetail', 29, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(556, 'Printer lengkap', '2011-06-24 18:25:03', 'DeliveryOrderDetail "Printer lengkap" (30) added by User "gs" (7).', 'DeliveryOrderDetail', 30, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(557, 'Komputer Lengkap 2', '2011-06-24 18:27:30', 'DeliveryOrderDetail "Komputer Lengkap 2" (29) updated by User "gs" (7).', 'DeliveryOrderDetail', 29, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(558, 'Printer lengkap', '2011-06-24 18:27:33', 'DeliveryOrderDetail "Printer lengkap" (30) updated by User "gs" (7).', 'DeliveryOrderDetail', 30, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(559, '0093', '2011-06-24 18:28:01', 'DeliveryOrder "0093" (6) added by User "gs" (7).', 'DeliveryOrder', 6, 'add', 7, 'convert_invoice, created, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, request_type_id, convert_asset, is_journal_generated, is_first, po_id, no, do_date, supplier_id, department_id, delivery_order_status_id', NULL, NULL, NULL, NULL, NULL),
(560, 'Komputer Lengkap 2', '2011-06-24 18:28:01', 'DeliveryOrderDetail "Komputer Lengkap 2" (31) added by User "gs" (7).', 'DeliveryOrderDetail', 31, 'add', 7, 'price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(561, 'Printer lengkap', '2011-06-24 18:28:01', 'DeliveryOrderDetail "Printer lengkap" (32) added by User "gs" (7).', 'DeliveryOrderDetail', 32, 'add', 7, 'qty, price, price_cur, rp_rate, is_vat, is_wht, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, npb_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, po_detail_id, delivery_order_id', NULL, NULL, NULL, NULL, NULL),
(562, 'Printer lengkap', '2011-06-24 18:28:09', 'DeliveryOrderDetail "Printer lengkap" (32) updated by User "gs" (7).', 'DeliveryOrderDetail', 32, 'edit', 7, 'qty_received', NULL, NULL, NULL, NULL, NULL),
(563, 'PO-0008', '2011-06-24 18:28:09', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'date_finish', NULL, NULL, NULL, NULL, NULL),
(564, '', '2011-06-24 18:41:10', 'Purchase (3) added by User "gs" (7).', 'Purchase', 3, 'add', 7, 'sup_tanggal, pos_ting, date_of_purchase, warranty_date, kd_luar_tanggal, currency_id, no, delivery_order_id, po_no, po_id, supplier_id, warranty_id', NULL, NULL, NULL, NULL, NULL),
(565, 'Komputer Lengkap 2', '2011-06-24 18:41:10', 'Asset "Komputer Lengkap 2" (18) added by User "gs" (7).', 'Asset', 18, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(566, 'Komputer Lengkap 2', '2011-06-24 18:41:10', 'AssetDetail "Komputer Lengkap 2" (49) added by User "gs" (7).', 'AssetDetail', 49, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(567, 'Printer lengkap', '2011-06-24 18:41:10', 'Asset "Printer lengkap" (19) added by User "gs" (7).', 'Asset', 19, 'add', 7, 'date_of_purchase, date_out, price, price_cur, amount, amount_cur, qty, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, currency_id, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year', NULL, NULL, NULL, NULL, NULL),
(568, 'Printer lengkap', '2011-06-24 18:41:10', 'AssetDetail "Printer lengkap" (50) added by User "gs" (7).', 'AssetDetail', 50, 'add', 7, 'condition_id, date_of_purchase, date_out, price, price_cur, residu, akdasar, depbln, thnlalu, blnlalu, blnini, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec, hrgjual, jthnlalu, jblnlalu, jblnini, hpthnlalu, hpblnlalumasuk, hpblninimasuk, hpblnlalukeluar, hpblninikeluar, hpthnini, depthnlalu, depblnlalumasuk, depblninimasuk, depblnlalukeluar, depblninikeluar, depthnini, book_value, sedang_diluar, posting, kd_luar_tanggal, service_total, process, source, check_physical, delivery_order_id, po_id, asset_category_id, item_code, name, color, brand, type, umurek, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, purchase_id, delivery_order_detail_id, ada, maksi, code, year, asset_id', NULL, NULL, NULL, NULL, NULL),
(569, '0092', '2011-06-24 18:41:10', 'DeliveryOrder "0092" (5) updated by User "gs" (7).', 'DeliveryOrder', 5, 'edit', 7, 'convert_asset', NULL, NULL, NULL, NULL, NULL),
(570, 'PO-0008', '2011-06-24 18:59:20', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(571, 'PO-0008', '2011-06-24 19:01:00', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(572, 'PO-0008', '2011-06-24 19:01:52', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(573, 'PO-0008', '2011-06-24 19:01:57', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(574, 'PO-0008', '2011-06-24 19:03:04', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(575, 'PO-0008', '2011-06-24 19:03:31', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(576, 'PO-0008', '2011-06-24 19:06:07', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(577, 'PO-0008', '2011-06-24 19:07:40', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(578, 'PO-0008', '2011-06-24 19:08:07', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(579, 'PO-0008', '2011-06-24 19:08:37', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(580, 'PO-0008', '2011-06-24 19:09:31', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(581, 'PO-0008', '2011-06-24 19:09:59', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(582, 'PO-0008', '2011-06-24 19:10:49', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(583, 'PO-0008', '2011-06-24 19:11:07', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(584, 'PO-0008', '2011-06-24 19:11:22', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(585, 'PO-0008', '2011-06-24 19:11:38', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(586, 'PO-0008', '2011-06-24 19:11:51', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(587, 'PO-0008', '2011-06-24 19:12:07', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(588, 'PO-0008', '2011-06-24 19:14:00', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(589, 'PO-0008', '2011-06-24 19:14:51', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL),
(590, 'PO-0008', '2011-06-24 19:15:40', 'Po "PO-0008" (9) updated by User "gs" (7).', 'Po', 9, 'edit', 7, 'printed', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=377 ;

--
-- Dumping data untuk tabel `menus`
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
(115, 113, 'Transfer Report', '/movements/reports/fa', '', 90),
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
(375, 374, 'Profile', '/users/change_password', NULL, 805);

-- --------------------------------------------------------

--
-- Struktur dari tabel `movements`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `movements`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `movement_details`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `movement_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `movement_statuses`
--

DROP TABLE IF EXISTS `movement_statuses`;
CREATE TABLE IF NOT EXISTS `movement_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `movement_statuses`
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
-- Struktur dari tabel `mutations`
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
-- Dumping data untuk tabel `mutations`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
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
-- Dumping data untuk tabel `news`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `npbs`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `npbs`
--

INSERT INTO `npbs` (`id`, `no`, `npb_date`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `supplier_id`, `req_date`, `npb_status_id`, `request_type_id`, `notes`, `created_by`, `created_date`, `reject_notes`, `reject_by`, `reject_date`, `cancel_notes`, `cancel_by`, `cancel_date`, `is_purchase_request`, `date_finish`, `is_printed`) VALUES
(1, 'MR-016-11-0001', '2011-06-23', 4, 0, 0, 2, 1, 0, '2011-06-23', 100, 2, 'Test 230611', 'cabang1', '2011-06-23 16:06:52', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-23 16:54:34', 0),
(2, 'MR-016-11-0002', '2011-06-23', 4, 0, 0, 2, 1, 0, '2011-06-23', 100, 2, 'Test2 230611', 'cabang1', '2011-06-23 16:08:44', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-23 16:44:00', 0),
(3, 'MR-010-11-0001', '2011-06-23', 1, 0, 0, 2, 1, 0, '2011-06-23', 50, 2, 'test cabang ABM 230611', 'cabang2', '2011-06-23 16:10:11', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, NULL, 0),
(4, 'MR-010-11-0002', '2011-06-23', 1, 0, 0, 2, 1, 0, '2011-06-23', 8, 2, 'test2 cabang ABM', 'cabang2', '2011-06-23 15:49:23', 'di periksa lagi', 'heri2', '2011-06-23 15:48:06', '', '', '0000-00-00 00:00:00', 0, NULL, 0),
(5, 'MR-016-11-0003', '2011-06-23', 4, 0, 0, 2, 1, 0, '2011-06-23', 100, 1, 'uyeriuhkjbmshgfwgb\nsldkfhkjbfkbgibr\nljhkbvkjbbvwv', 'cabang1', '2011-06-23 16:17:45', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-23 16:48:10', 0),
(6, 'MR-016-11-0004', '2011-06-23', 4, 0, 0, 2, 1, 0, '2011-06-23', 100, 1, 'test2 IT Items 230611', 'cabang1', '2011-06-23 16:19:36', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-23 16:48:10', 0),
(7, 'MR-010-11-0003', '2011-06-23', 1, 0, 0, 2, 1, 0, '2011-06-23', 100, 1, 'TEST abm iIT Items', 'cabang2', '2011-06-23 16:24:33', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-23 16:48:10', 0),
(8, 'MR-010-11-0004', '2011-06-23', 1, 0, 0, 2, 1, 0, '2011-06-23', 100, 1, '', 'cabang2', '2011-06-23 16:25:53', '', '', '0000-00-00 00:00:00', 'periksa ulang', 'heri2', '2011-06-23 16:01:41', 0, '2011-06-23 16:48:10', 0),
(9, 'MR-010-11-0005', '2011-06-23', 1, 0, 0, 2, 1, 0, '2011-06-23', 100, 1, 'Test IT 2', 'cabang2', '2011-06-23 16:27:44', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-23 16:48:10', 0),
(10, 'MR-016-11-0005', '2011-06-24', 4, 0, 0, 2, 1, 0, '2011-06-24', 100, 2, '', 'cabang1', '2011-06-24 11:15:21', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-24 11:22:05', 0),
(11, 'MR-016-11-0006', '2011-06-24', 4, 0, 0, 2, 1, 0, '2011-06-24', 50, 1, 'tets it', 'cabang1', '2011-06-24 15:26:03', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, NULL, 1),
(12, 'MR-016-11-0007', '2011-06-24', 4, 0, 0, 2, 1, 0, '2011-06-24', 100, 1, 'test', 'cabang1', '2011-06-24 16:43:35', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-24 17:30:29', 1),
(13, 'MR-016-11-0008', '2011-06-24', 4, 0, 0, 2, 1, 0, '2011-06-24', 100, 2, '', 'cabang1', '2011-06-24 16:47:52', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-24 18:13:26', 0),
(14, 'MR-016-11-0009', '2011-06-24', 4, 0, 0, 2, 1, 0, '2011-06-24', 100, 1, 'xxx', 'cabang1', '2011-06-24 18:10:36', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '2011-06-24 18:11:37', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `npbs_pos`
--

DROP TABLE IF EXISTS `npbs_pos`;
CREATE TABLE IF NOT EXISTS `npbs_pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npb_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `npbs.id` (`npb_id`,`po_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `npbs_pos`
--

INSERT INTO `npbs_pos` (`id`, `npb_id`, `po_id`) VALUES
(6, 3, 3),
(3, 3, 1),
(2, 2, 1),
(1, 1, 1),
(5, 2, 3),
(4, 1, 3),
(11, 9, 4),
(10, 8, 4),
(9, 7, 4),
(8, 6, 4),
(7, 5, 4),
(12, 1, 5),
(13, 10, 6),
(14, 12, 7),
(15, 14, 9),
(16, 13, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `npb_details`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data untuk tabel `npb_details`
--

INSERT INTO `npb_details` (`id`, `npb_id`, `po_id`, `movement_id`, `item_id`, `color`, `brand`, `type`, `fulfillment_id`, `qty`, `price`, `price_cur`, `amount`, `amount_cur`, `currency_id`, `rp_rate`, `descr`, `discount`, `discount_cur`, `amount_net`, `amount_net_cur`, `date_finish`, `qty_filled`, `qty_unfilled`, `unit_id`, `outlog_id`, `process_type_id`) VALUES
(1, 1, 1, NULL, 3, NULL, NULL, NULL, 0, 5, '0.00', '100000', '0.00', '500000.00', 1, '0.00', 'Warna Merah', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 5, 0, 2, NULL, 2),
(2, 1, 3, NULL, 8, NULL, NULL, NULL, 0, 3, '0.00', '100000000', '0.00', '300000000.00', 1, '0.00', 'Avanza', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 3, 0, 2, NULL, 2),
(3, 1, 5, NULL, 19, NULL, NULL, NULL, 0, 1, '0.00', '2000000000', '0.00', '2000000000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 2, NULL, 2),
(4, 2, 1, NULL, 3, NULL, NULL, NULL, 0, 10, '0.00', '100000', '0.00', '1000000.00', 1, '0.00', 'Warna Biru', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 10, 0, 2, NULL, 2),
(5, 2, 3, NULL, 8, NULL, NULL, NULL, 0, 2, '0.00', '100000000', '0.00', '200000000.00', 1, '0.00', 'Avanza', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 2, NULL, 2),
(6, 2, 1, NULL, 35, NULL, NULL, NULL, 0, 5, '0.00', '1500000', '0.00', '7500000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 5, 0, 2, NULL, 2),
(7, 2, 1, NULL, 39, NULL, NULL, NULL, 0, 7, '0.00', '5000000', '0.00', '35000000.00', 1, '0.00', 'untuk nasabah', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 7, 0, 2, NULL, 2),
(8, 3, 1, NULL, 6, NULL, NULL, NULL, 0, 5, '0.00', '5000000', '0.00', '25000000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 5, 0, 4, NULL, 2),
(9, 3, 3, NULL, 8, NULL, NULL, NULL, 0, 4, '0.00', '100000000', '0.00', '400000000.00', 1, '0.00', 'Panther', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 4, 0, 2, NULL, 2),
(10, 3, NULL, NULL, 39, NULL, NULL, NULL, 0, 5, '0.00', '5000000', '0.00', '25000000.00', 1, '0.00', 'nasabah', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, 1),
(11, 3, NULL, NULL, 34, NULL, NULL, NULL, 0, 5, '0.00', '750000', '0.00', '3750000.00', 1, '0.00', 'new hire', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, 2),
(12, 3, 1, NULL, 35, NULL, NULL, NULL, 0, 4, '0.00', '1500000', '0.00', '6000000.00', 1, '0.00', 'untuk Head', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 4, 0, 2, NULL, 2),
(13, 4, NULL, NULL, 4, NULL, NULL, NULL, 0, 2, '0.00', '100000', '0.00', '200000.00', 1, '0.00', 'new hire', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 3, NULL, NULL),
(14, 4, NULL, NULL, 44, NULL, NULL, NULL, 0, 10, '0.00', '500000000', '0.00', '5000000000.00', 1, '0.00', 'untuk teller', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, NULL),
(15, 4, NULL, NULL, 40, NULL, NULL, NULL, 0, 5, '0.00', '7500000', '0.00', '37500000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, NULL),
(16, 4, NULL, NULL, 42, NULL, NULL, NULL, 0, 6, '0.00', '325000000', '0.00', '1950000000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 2, NULL, NULL),
(17, 5, 4, NULL, 25, NULL, NULL, NULL, 0, 1, '0.00', '150', '0.00', '150.00', 2, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 2, NULL, 2),
(18, 5, 4, NULL, 355, NULL, NULL, NULL, 0, 2, '0.00', '60000', '0.00', '120000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 3, NULL, 2),
(19, 5, 4, NULL, 27, NULL, NULL, NULL, 0, 3, '0.00', '900000', '0.00', '2700000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 3, 0, 2, NULL, 2),
(20, 6, 4, NULL, 353, NULL, NULL, NULL, 0, 3, '0.00', '200', '0.00', '600.00', 2, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 3, 0, 3, NULL, 2),
(21, 6, 4, NULL, 356, NULL, NULL, NULL, 0, 2, '0.00', '60000', '0.00', '120000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 3, NULL, 2),
(22, 7, 4, NULL, 22, NULL, NULL, NULL, 0, 1, '0.00', '4500000', '0.00', '4500000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 2, NULL, 2),
(23, 7, 4, NULL, 24, NULL, NULL, NULL, 0, 2, '0.00', '51000000', '0.00', '102000000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 2, NULL, 2),
(24, 7, 4, NULL, 22, NULL, NULL, NULL, 0, 1, '0.00', '4500000', '0.00', '4500000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 2, NULL, 2),
(28, 8, NULL, NULL, 338, NULL, NULL, NULL, 0, 2, '0.00', '800000', '0.00', '1600000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 3, NULL, 2),
(26, 8, NULL, NULL, 24, NULL, NULL, NULL, 0, 2, '0.00', '51000000', '0.00', '102000000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 2, NULL, 2),
(27, 8, 4, NULL, 22, NULL, NULL, NULL, 0, 1, '0.00', '4500000', '0.00', '4500000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 2, NULL, 2),
(29, 9, 4, NULL, 22, NULL, NULL, NULL, 0, 2, '0.00', '4500000', '0.00', '9000000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 2, NULL, 2),
(30, 10, 6, NULL, 3, NULL, NULL, NULL, 0, 2, '0.00', '100000', '0.00', '200000.00', 1, '0.00', '', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 2, NULL, 2),
(31, 11, NULL, NULL, 360, NULL, NULL, NULL, 0, 3, '0.00', '55000', '0.00', '165000.00', 1, '0.00', 'eee', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 3, NULL, 2),
(32, 11, NULL, NULL, 33, NULL, NULL, NULL, 0, 4, '0.00', '5000000', '0.00', '20000000.00', 1, '0.00', 'yyy', '0.00', '0.00', '0.00', '0.00', '0000-00-00', 0, 0, 4, NULL, 2),
(44, 12, 7, NULL, 1, 'Hitam', 'Panasonic', 'CSA-097', 0, 6, '0.00', '1000', '0.00', '6000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 6, 0, 3, NULL, 2),
(45, 13, 10, NULL, 3, 'hhh', 'kkk', 'nnn', 0, 5, '0.00', '100000', '0.00', '500000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 5, 0, 2, NULL, 2),
(46, 14, 9, NULL, 1, 'hijau', 'panasonic', 'c-0888', 0, 1, '0.00', '1000', '0.00', '1000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 1, 0, 3, NULL, 2),
(47, 14, 9, NULL, 2, 'merah', 'lg', 'c-890', 0, 2, '0.00', '5000000', '0.00', '10000000.00', 1, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0000-00-00', 2, 0, 4, NULL, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `npb_fulfillments`
--

DROP TABLE IF EXISTS `npb_fulfillments`;
CREATE TABLE IF NOT EXISTS `npb_fulfillments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `descr` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `npb_fulfillments`
--

INSERT INTO `npb_fulfillments` (`id`, `name`, `descr`) VALUES
(1, 'Procurement', '0'),
(2, 'Movement', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `npb_statuses`
--

DROP TABLE IF EXISTS `npb_statuses`;
CREATE TABLE IF NOT EXISTS `npb_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data untuk tabel `npb_statuses`
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
(100, 'Done');

-- --------------------------------------------------------

--
-- Struktur dari tabel `npb_suppliers`
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
-- Dumping data untuk tabel `npb_suppliers`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `outlogs`
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
-- Dumping data untuk tabel `outlogs`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `outlog_details`
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
-- Dumping data untuk tabel `outlog_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `outlog_statuses`
--

DROP TABLE IF EXISTS `outlog_statuses`;
CREATE TABLE IF NOT EXISTS `outlog_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `outlog_statuses`
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
-- Struktur dari tabel `pajak`
--

DROP TABLE IF EXISTS `pajak`;
CREATE TABLE IF NOT EXISTS `pajak` (
  `kelas` char(2) NOT NULL DEFAULT '',
  `tarif` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pajak`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `tgawal` date NOT NULL DEFAULT '0000-00-00',
  `tgakhir` date NOT NULL DEFAULT '0000-00-00',
  `bulan` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`tgawal`, `tgakhir`, `bulan`) VALUES
('2005-06-01', '0000-00-00', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `pos`
--

INSERT INTO `pos` (`id`, `no`, `po_date`, `delivery_date`, `supplier_id`, `department_id`, `po_status_id`, `currency_id`, `description`, `convert_invoice`, `created`, `approval_info`, `wht_rate`, `vat_rate`, `vat_base`, `vat_base_cur`, `wht_base`, `wht_base_cur`, `sub_total`, `sub_total_cur`, `discount`, `discount_cur`, `after_disc`, `after_disc_cur`, `wht_total`, `wht_total_cur`, `vat_total`, `vat_total_cur`, `total`, `total_cur`, `billing_address`, `shipping_address`, `reject_notes`, `reject_by`, `reject_date`, `cancel_notes`, `cancel_by`, `cancel_date`, `payment_term`, `rp_rate`, `date_finish`, `printed`, `request_type_id`, `signer_1`, `signer_2`, `po_address`, `down_payment`, `is_down_payment_journal_generated`, `down_payment_journal_generated_date`) VALUES
(1, 'PO-0001', '2011-06-23', '2011-06-23', 6, NULL, 7, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-06-23 17:20:45:Approved by:generalservice', '0.00', '10.00', '76250000.00', '76250000.00', '0.00', '0.00', '76250000.00', '76250000.00', '0.00', '0.00', '76250000.00', '76250000.00', '0.00', '0.00', '7625000.00', '7625000.00', '83875000.00', '83875000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 3, '0.00', '2011-06-23', 4, 2, 'Annemarie Straathof', 'Dewi Susana', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(3, 'PO-0002', '2011-06-23', '2011-06-23', 16, NULL, 7, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-06-23 17:27:06:Approved by:generalservice', '0.00', '10.00', '1314000000.00', '1314000000.00', '0.00', '0.00', '1314000000.00', '1314000000.00', '0.00', '0.00', '1314000000.00', '1314000000.00', '0.00', '0.00', '131400000.00', '131400000.00', '1445400000.00', '1445400000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '2011-06-23', 2, 2, 'Anne', 'Dewi', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(4, 'PO-0003', '2011-06-23', '2011-06-23', 4, NULL, 7, 2, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-06-23 17:27:19:Approved by:generalservice', '0.00', '10.00', '3661.00', '3661.00', '0.00', '0.00', '3661.00', '3661.00', '0.00', '0.00', '3661.00', '3661.00', '0.00', '0.00', '366.10', '366.10', '4027.10', '4027.10', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '2011-06-23', 1, 1, 'anne', 'dewi', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(5, 'PO-0004', '2011-06-23', '2011-06-23', 8, NULL, 8, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-06-23 17:07:53:Approved by:adeade', '0.00', '10.00', '185000000.00', '185000000.00', '0.00', '0.00', '200000000.00', '200000000.00', '15000000.00', '15000000.00', '185000000.00', '185000000.00', '0.00', '0.00', '18500000.00', '18500000.00', '203500000.00', '203500000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', 'cancel', 'badubadu', '2011-06-23 17:08:23', 'kurang murah', 'badubadu', '2011-06-23 17:04:57', 1, '0.00', '0000-00-00', 0, 2, 'anne', 'dewi', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(6, 'PO-0005', '2011-06-24', '2011-06-24', 2, NULL, 1, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '0.00', '200000.00', '0.00', '0.00', '0.00', '200000.00', '0.00', '0.00', '0.00', '200000.00', '0.00', '0.00', '0.00', '20000.00', '0.00', '220000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '0000-00-00', 0, 2, '', '', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(7, 'PO-0006', '2011-06-24', '2011-06-24', 1, NULL, 1, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '6000.00', '6000.00', '0.00', '0.00', '6000.00', '6000.00', '0.00', '0.00', '6000.00', '6000.00', '0.00', '0.00', '600.00', '600.00', '6600.00', '6600.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '0000-00-00', 0, 1, '', '', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(8, 'PO-0007', '2011-06-24', '2011-06-24', 1, NULL, 1, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '1800.00', '1800.00', '0.00', '0.00', '1800.00', '1800.00', '0.00', '0.00', '1800.00', '1800.00', '0.00', '0.00', '180.00', '180.00', '1980.00', '1980.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '0000-00-00', 0, 1, '', '', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(9, 'PO-0008', '2011-06-24', '2011-06-24', 1, NULL, 6, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '2011-06-24 18:19:38:Approved by:generalservice', '0.00', '10.00', '0.00', '10001000.00', '0.00', '0.00', '0.00', '10001000.00', '0.00', '0.00', '0.00', '10001000.00', '0.00', '0.00', '0.00', '1000100.00', '0.00', '11001100.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '2011-06-24', 21, 1, '', '', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL),
(10, 'PO-0009', '2011-06-24', '2011-06-24', 1, NULL, 1, 1, 'bla bla bla hfdsfhdskjhfskjfdshfj fh dsjfhksdhfkjdshdsfsF ', 0, '0000-00-00 00:00:00', '', '0.00', '10.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '0.00', '0.00', '50000.00', '50000.00', '550000.00', '550000.00', 'Rabobank,\r\nJl Rasuna Said', 'Rabobank, \r\nJl Rasuna Said', '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 1, '0.00', '0000-00-00', 0, 2, '', '', 'Jl. Abdul Muis No. 28\r\nJakarta Pusat 10160', '0.00', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_details`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data untuk tabel `po_details`
--

INSERT INTO `po_details` (`id`, `po_id`, `asset_category_id`, `item_code`, `name`, `color`, `brand`, `type`, `qty`, `qty_received`, `price`, `price_cur`, `amount`, `amount_cur`, `discount`, `discount_cur`, `amount_after_disc`, `amount_after_disc_cur`, `vat`, `vat_cur`, `amount_nett`, `amount_nett_cur`, `currency_id`, `rp_rate`, `npb_id`, `umurek`, `is_vat`, `is_wht`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `item_id`, `npb_detail_id`) VALUES
(1, 1, '8', '', 'K010-Kursi', '', '', '', 5, 5, '0.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '550000.00', '550000.00', 1, '0.00', 1, 5, 1, 0, 4, 0, 0, 2, 1, 3, 1),
(2, 1, '8', '', 'K010-Kursi', '', '', '', 10, 10, '0.00', '100000.00', '1000000.00', '1000000.00', '0.00', '0.00', '1000000.00', '1000000.00', '100000.00', '100000.00', '1100000.00', '1100000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 3, 4),
(3, 1, '9', '', '7KRS002-KURSI HADAP', '', '', '', 5, 5, '0.00', '1000000.00', '5000000.00', '5000000.00', '0.00', '0.00', '5000000.00', '5000000.00', '500000.00', '500000.00', '5500000.00', '5500000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 35, 6),
(4, 1, '9', '', '7KRS003-KURSI TUNGGU', '', '', '', 7, 7, '0.00', '5000000.00', '35000000.00', '35000000.00', '0.00', '0.00', '35000000.00', '35000000.00', '3500000.00', '3500000.00', '38500000.00', '38500000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 39, 7),
(5, 1, '9', '', 'LMR001-Lemari Besi', '', '', '', 5, 5, '0.00', '5000000.00', '25000000.00', '25000000.00', '0.00', '0.00', '25000000.00', '25000000.00', '2500000.00', '2500000.00', '27500000.00', '27500000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 6, 8),
(6, 1, '9', '', '7KRS001-KURSI KERJA', '', '', '', 5, 5, '0.00', '750000.00', '3750000.00', '3750000.00', '0.00', '0.00', '3750000.00', '3750000.00', '375000.00', '375000.00', '4125000.00', '4125000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 34, 11),
(7, 1, '9', '', '7KRS002-KURSI HADAP', '', '', '', 4, 4, '0.00', '1500000.00', '6000000.00', '6000000.00', '0.00', '0.00', '6000000.00', '6000000.00', '600000.00', '600000.00', '6600000.00', '6600000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 35, 12),
(8, 3, '5', '', 'K09966-mobil', '', '', '', 3, 3, '0.00', '146000000.00', '438000000.00', '438000000.00', '0.00', '0.00', '438000000.00', '438000000.00', '43800000.00', '43800000.00', '481800000.00', '481800000.00', 1, '0.00', 1, 5, 1, 0, 4, 0, 0, 2, 1, 8, 2),
(9, 3, '5', '', 'K09966-mobil', '', '', '', 2, 2, '0.00', '146000000.00', '292000000.00', '292000000.00', '0.00', '0.00', '292000000.00', '292000000.00', '29200000.00', '29200000.00', '321200000.00', '321200000.00', 1, '0.00', 2, 5, 1, 0, 4, 0, 0, 2, 1, 8, 5),
(10, 3, '5', '', 'K09966-mobil', '', '', '', 4, 4, '0.00', '146000000.00', '584000000.00', '584000000.00', '0.00', '0.00', '584000000.00', '584000000.00', '58400000.00', '58400000.00', '642400000.00', '642400000.00', 1, '0.00', 3, 5, 1, 0, 1, 0, 0, 2, 1, 8, 9),
(23, 5, '16', '', 'REN0555-Gedung Abdul Muis', '', '', '', 1, 0, '0.00', '200000000.00', '200000000.00', '200000000.00', '15000000.00', '15000000.00', '185000000.00', '185000000.00', '18500000.00', '18500000.00', '203500000.00', '203500000.00', 1, '0.00', 1, 5, 1, 0, 4, 0, 0, 2, 1, 19, 3),
(12, 4, '6', '', '6LCH003 -LCD HP ', '', '', '', 3, 3, '0.00', '9.00', '27.00', '27.00', '0.00', '0.00', '27.00', '27.00', '2.70', '2.70', '29.70', '29.70', 2, '0.00', 5, 5, 1, 0, 4, 0, 0, 2, 1, 27, 19),
(13, 4, '6', '', '6MOU001-MOUSE USB', '', '', '', 2, 2, '0.00', '6.00', '12.00', '12.00', '0.00', '0.00', '12.00', '12.00', '1.20', '1.20', '13.20', '13.20', 2, '0.00', 5, 5, 1, 0, 4, 0, 0, 2, 1, 355, 18),
(14, 4, '6', '', '6PRI001-PROJECTOR INFOCUS', '', '', '', 3, 3, '0.00', '200.00', '600.00', '600.00', '0.00', '0.00', '600.00', '600.00', '60.00', '60.00', '660.00', '660.00', 2, '0.00', 6, 5, 1, 0, 4, 0, 0, 2, 1, 353, 20),
(15, 4, '6', '', '6MOU002-MOUSE SERIAL PS/2', '', '', '', 2, 2, '0.00', '6.00', '12.00', '12.00', '0.00', '0.00', '12.00', '12.00', '1.20', '1.20', '13.20', '13.20', 2, '0.00', 6, 5, 1, 0, 4, 0, 0, 2, 1, 356, 21),
(16, 4, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 1, 1, '0.00', '450.00', '450.00', '450.00', '0.00', '0.00', '450.00', '450.00', '45.00', '45.00', '495.00', '495.00', 2, '0.00', 7, 5, 1, 0, 1, 0, 0, 2, 1, 22, 22),
(17, 4, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 1, 1, '0.00', '450.00', '450.00', '450.00', '0.00', '0.00', '450.00', '450.00', '45.00', '45.00', '495.00', '495.00', 2, '0.00', 7, 5, 1, 0, 1, 0, 0, 2, 1, 22, 24),
(18, 4, '6', '', '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', 2, 2, '0.00', '170.00', '340.00', '340.00', '0.00', '0.00', '340.00', '340.00', '34.00', '34.00', '374.00', '374.00', 2, '0.00', 7, 5, 1, 0, 1, 0, 0, 2, 1, 24, 23),
(19, 4, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 1, 1, '0.00', '450.00', '450.00', '450.00', '0.00', '0.00', '450.00', '450.00', '45.00', '45.00', '495.00', '495.00', 2, '0.00', 8, 5, 1, 0, 1, 0, 0, 2, 1, 22, 27),
(20, 4, '6', '', '6PRE001 -PRINTER EPSON LQ 2180', '', '', '', 2, 2, '0.00', '170.00', '340.00', '340.00', '0.00', '0.00', '340.00', '340.00', '34.00', '34.00', '374.00', '374.00', 2, '0.00', 8, 5, 1, 0, 1, 0, 0, 2, 1, 24, 26),
(21, 4, '6', '', '6MSA001-ATEN ', '', '', '', 2, 2, '0.00', '40.00', '80.00', '80.00', '0.00', '0.00', '80.00', '80.00', '8.00', '8.00', '88.00', '88.00', 2, '0.00', 8, 5, 1, 0, 1, 0, 0, 2, 1, 338, 28),
(22, 4, '6', '', '6PCT001-THIN CLIENT  ', '', '', '', 2, 2, '0.00', '450.00', '900.00', '900.00', '0.00', '0.00', '900.00', '900.00', '90.00', '90.00', '990.00', '990.00', 2, '0.00', 9, 5, 1, 0, 1, 0, 0, 2, 1, 22, 29),
(24, 6, '8', '', 'K010-Kursi', '', '', '', 2, 0, '0.00', '100000.00', '200000.00', '200000.00', '0.00', '0.00', '200000.00', '200000.00', '20000.00', '20000.00', '220000.00', '220000.00', 1, '0.00', 10, 5, 1, 0, 4, 0, 0, 2, 1, 3, 30),
(25, 7, '6', 'K099999', 'Komputer Lengkap 2', '0', '0', '0', 6, 0, '0.00', '1000.00', '6000.00', '6000.00', '0.00', '0.00', '6000.00', '6000.00', '600.00', '600.00', '6600.00', '6600.00', 1, '0.00', 12, 5, 1, 0, 4, 0, 0, 2, 1, 1, 44),
(27, 8, '4', '555', 'dddddddd', 'ffffffffffffff', 'wwwwwwwwww', 'dddddddddd', 3, 0, '0.00', '100.00', '300.00', '300.00', '0.00', '0.00', '300.00', '300.00', '30.00', '30.00', '330.00', '330.00', 0, '1.00', 0, 5, 1, 0, 17, 0, 0, NULL, NULL, NULL, NULL),
(29, 8, '3', '222', 'dddddddd', 'dd', 'ddd', 'sss', 3, 0, '0.00', '100.00', '300.00', '300.00', '0.00', '0.00', '300.00', '300.00', '30.00', '30.00', '330.00', '330.00', 0, '1.00', 0, 5, 1, 0, 1, 0, 0, NULL, NULL, NULL, NULL),
(30, 8, '4', '55553', '444', '5555', 'rrrrrr', '4444444', 4, 0, '0.00', '300.00', '1200.00', '1200.00', '0.00', '0.00', '1200.00', '1200.00', '120.00', '120.00', '1320.00', '1320.00', 0, '1.00', 0, 5, 1, 0, 17, 0, 0, NULL, NULL, NULL, NULL),
(31, 9, '6', 'K099999', 'Komputer Lengkap 2', 'hijau', 'panasonic', 'c-0888', 1, 1, '0.00', '1000.00', '1000.00', '1000.00', '0.00', '0.00', '1000.00', '1000.00', '100.00', '100.00', '1100.00', '1100.00', 1, '0.00', 14, 5, 1, 0, 4, 0, 0, 2, 1, 1, 46),
(32, 9, '6', 'K01999', 'Printer lengkap', 'merah', 'lg', 'c-890', 2, 2, '0.00', '5000000.00', '10000000.00', '10000000.00', '0.00', '0.00', '10000000.00', '10000000.00', '1000000.00', '1000000.00', '11000000.00', '11000000.00', 1, '0.00', 14, 5, 1, 0, 4, 0, 0, 2, 1, 2, 47),
(33, 10, '8', 'K010', 'Kursi', 'hhh', 'kkk', 'nnn', 5, 0, '0.00', '100000.00', '500000.00', '500000.00', '0.00', '0.00', '500000.00', '500000.00', '50000.00', '50000.00', '550000.00', '550000.00', 1, '0.00', 13, 5, 1, 0, 4, 0, 0, 2, 1, 3, 45);

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_payments`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `po_payments`
--

INSERT INTO `po_payments` (`id`, `po_id`, `term_no`, `term_percent`, `date_due`, `date_paid`, `amount_due`, `amount_paid`, `description`, `amount_po`) VALUES
(1, 1, 1, '10.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(2, 1, 2, '60.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 2', '0.00'),
(3, 1, 3, '30.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 3', '0.00'),
(4, 2, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(5, 3, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(6, 4, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(7, 5, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(8, 6, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(9, 7, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(10, 8, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(11, 9, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00'),
(12, 10, 1, '0.00', '0000-00-00', '0000-00-00', '0.00', '0.00', 'PO term 1', '0.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_statuses`
--

DROP TABLE IF EXISTS `po_statuses`;
CREATE TABLE IF NOT EXISTS `po_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sorter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `po_statuses`
--

INSERT INTO `po_statuses` (`id`, `name`, `sorter`) VALUES
(1, 'Draft', 0),
(3, 'Approved Level 1', 0),
(4, 'Approved Level 2', 0),
(5, 'Approved Level 3', 0),
(6, 'Finish', 0),
(2, 'Request for Approval', 0),
(7, 'Sent', 0),
(8, 'Reject', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `process_types`
--

DROP TABLE IF EXISTS `process_types`;
CREATE TABLE IF NOT EXISTS `process_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `process_types`
--

INSERT INTO `process_types` (`id`, `name`) VALUES
(1, 'Movement'),
(2, 'Procurement');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(15) NOT NULL DEFAULT '',
  `doc_no` varchar(10) NOT NULL,
  `warranty_id` int(11) DEFAULT NULL,
  `warranty_note` text NOT NULL,
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
-- Dumping data untuk tabel `purchases`
--

INSERT INTO `purchases` (`id`, `no`, `doc_no`, `warranty_id`, `warranty_note`, `warranty_year`, `requester_id`, `department_id`, `supplier_id`, `invoice_no`, `po_no`, `periode`, `serial_no`, `voucher_no`, `sup_tanggal`, `sup_vendor_no`, `warranty_card`, `pos_ting`, `date_of_purchase`, `warranty_date`, `kd_luar_tanggal`, `delivery_order_id`, `currency_id`, `po_id`) VALUES
(1, 'FA-0001', '', 2, '', 0, 0, NULL, 6, NULL, 'PO-0001', NULL, NULL, '', '0000-00-00', NULL, NULL, 'N', '2011-06-23', '0000-00-00', '0000-00-00', 1, 1, 1),
(2, 'FA-0002', '', 1, '', 0, 0, NULL, 4, NULL, 'PO-0003', NULL, NULL, '', '0000-00-00', NULL, NULL, 'N', '2011-06-23', '0000-00-00', '0000-00-00', 4, 2, 4),
(3, 'FA-0003', '', 2, '', 0, 0, NULL, 1, NULL, 'PO-0008', NULL, NULL, '', '0000-00-00', NULL, NULL, 'N', '2011-06-24', '0000-00-00', '0000-00-00', 5, 1, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `requesters`
--

DROP TABLE IF EXISTS `requesters`;
CREATE TABLE IF NOT EXISTS `requesters` (
  `id` int(10) unsigned NOT NULL,
  `code` char(6) NOT NULL,
  `name` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `requesters`
--

INSERT INTO `requesters` (`id`, `code`, `name`) VALUES
(1, 'R001', 'Ronny'),
(2, 'F001', 'Fendy'),
(3, 'H001', 'Hendro'),
(4, 'S051', 'Swastika I Wayan'),
(5, 'T001', 'Titin Safitri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_types`
--

DROP TABLE IF EXISTS `request_types`;
CREATE TABLE IF NOT EXISTS `request_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `descr` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `request_types`
--

INSERT INTO `request_types` (`id`, `name`, `descr`) VALUES
(1, 'FA: IT Items', ''),
(2, 'FA: General Items', ''),
(3, 'Stock Inventory', ''),
(4, 'Service', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `returs`
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
-- Dumping data untuk tabel `returs`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_details`
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
-- Dumping data untuk tabel `retur_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_statuses`
--

DROP TABLE IF EXISTS `retur_statuses`;
CREATE TABLE IF NOT EXISTS `retur_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `retur_statuses`
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
-- Struktur dari tabel `saldoawal`
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
-- Dumping data untuk tabel `saldoawal`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `kode` varchar(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `service`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `stocks`
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
-- Dumping data untuk tabel `stocks`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(4) NOT NULL DEFAULT '',
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
  UNIQUE KEY `no` (`no`),
  KEY `bank_name` (`bank_name`,`bank_account_no`,`bank_account_name`),
  KEY `bank_account_type_id` (`bank_account_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data untuk tabel `suppliers`
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
(27, 'F050', 'Fendy & Fio', 'Jakarta', 'Jakarta', '-', '-', '-', '-', NULL, 'Fendy', 'DKI', '-', '2.00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_returs`
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
-- Dumping data untuk tabel `supplier_returs`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_retur_details`
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
-- Dumping data untuk tabel `supplier_retur_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_retur_statuses`
--

DROP TABLE IF EXISTS `supplier_retur_statuses`;
CREATE TABLE IF NOT EXISTS `supplier_retur_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `supplier_retur_statuses`
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
-- Struktur dari tabel `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'rim'),
(2, 'pcs'),
(3, 'box'),
(4, 'dozen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usages`
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
-- Dumping data untuk tabel `usages`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `usage_details`
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
-- Dumping data untuk tabel `usage_details`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `usage_statuses`
--

DROP TABLE IF EXISTS `usage_statuses`;
CREATE TABLE IF NOT EXISTS `usage_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `usage_statuses`
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
-- Struktur dari tabel `users`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`, `department_sub_id`, `department_unit_id`, `business_type_id`, `cost_center_id`, `aktif`, `last_password_change`) VALUES
(2, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 1, 72, 36, 56, 2, 108, 1, '2011-06-23 10:26:15'),
(3, 'heri1', 'heri@admin.com', '6812af90c6a1bbec134e323d7e70587b', 'heri', 2, 4, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(4, 'adeade', 'ade@admin.com', 'a562cfa07c2b1213b3a5c99b756fc206', 'ade', 3, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(5, 'badubadu', 'badu@admin.com', '40a3de3b98856879b19943f7e93a0375', 'badu', 4, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(7, 'generalservice', 'admin@admin.com', '1d8d5e912302108b5e88c3e77fcad378', 'gs', 7, 72, 36, 56, 2, 128, 1, '2011-06-23 10:26:15'),
(8, 'cabang1', 'admin@admin.com', 'f74e4339be40ffd3b2a263873e653be4', 'cabang', 6, 4, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(9, 'fincon', 'fincon@admin.com', '766a69946883ddc09289ac08e256e4b0', 'fincon', 8, 72, 15, 18, 2, 22, 1, '2011-06-23 10:26:15'),
(13, 'gsadmin', 'gs_admin@admin.com', 'e4df745c3d6bbbe631d0409c9d737dbd', 'gs_admin', 10, 72, 36, 56, 2, 128, 1, '2011-06-23 10:26:15'),
(14, 'itadmin', 'it_admin@admin.com', '21b29b7b87a13d1da465760bf3ac34a9', 'it_admin', 12, 72, 36, 55, 2, 103, 1, '2011-06-23 10:26:15'),
(15, 'famanagement', 'admin@admin.com', '59246f163814db9c3b0021780301e0e5', 'fa_management', 11, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(16, 'itmanagement', 'it_management@admin.com', '9f41b19c2b1e98c6dbea484499e08244', 'it_management', 13, 72, 36, 55, 2, 107, 1, '2011-06-23 10:26:15'),
(17, 'stockmanagement', 'admin@admin.com', '748327434ced43a3bf0d3e69be6b6c34', 'stock_management', 14, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(18, 'stocksupervisor', 'stock_supervisor@admin.com', 'daa87e49a220e9a9548f76d9a4ae1737', 'stock_supervisor', 100, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(19, 'fasupervisor', 'fa_spv@admin.com', 'f1b20b87e5337262f517f9cf832e9764', 'fa_supervisor', 15, 72, 36, 55, 2, 128, 1, '2011-06-23 10:26:15'),
(20, 'itsupervisor', 'it_spv@admin.com', '8de5114af230bc138d2079fdef268041', 'it_supervisor', 16, 72, 43, 106, 2, 107, 1, '2011-06-23 10:26:15'),
(21, 'cabang2', 'cabang2@admin.com', '674f68d4674384c782fac706bde2c54b', 'cabang2', 6, 1, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(22, 'cabang3', 'cabang3@admin.com', '1ac5afe7639bf312e7e405a0d292a53f', 'cabang3', 6, 16, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(23, 'heri2', 'heri2@admin.com', '1801d4679e24db6df57061601422c839', 'heri2', 2, 1, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15'),
(24, 'heri3', 'heri3@admin.com', 'a7eda932a463b45de9271bea3e3e0984', 'heri3', 2, 16, NULL, NULL, 2, 1, 1, '2011-06-23 10:26:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
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
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 0, 1),
(2, 0, 1),
(3, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warranties`
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
-- Dumping data untuk tabel `warranties`
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
