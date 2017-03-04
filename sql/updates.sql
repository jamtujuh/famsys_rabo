-- 03 may
alter table npb_details add column qty_filled int default 0;
update npb_details set qty_filled=qty where po_id is not null;

DROP TABLE IF EXISTS invoices_po_payments;
CREATE TABLE IF NOT EXISTS `invoices_po_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `po_payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`po_payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

update menus set url='/items/item_status', parent_id=79 where id='143';
update menus set title='Stock Ledger List' where id='140';

DELETE from `request_types`;
INSERT INTO `request_types` (`id`, `name`, `descr`) VALUES
(1, 'FA: IT Items', ''),
(2, 'FA: General Items', ''),
(3, 'Stock Inventory', '');
-- 04 may
update items set request_type_id=3 where id in(9,10,11,12);

alter table outlogs add column npb_id int ;
alter table outlogs add index npb_idx(npb_id) ;

alter table pos add column request_type_id int default 1;
alter table pos add index request_type_idx(request_type_id) ;

alter table po_details add column item_id int default NULL;
alter table po_details add index item_idx(item_id) ;

DROP TABLE IF EXISTS invoices_delivery_orders;
CREATE TABLE IF NOT EXISTS `invoices_delivery_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `delivery_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`delivery_order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

alter table invoices add column request_type_id int default 1;
alter table invoices add index request_type_idx(request_type_id) ;

alter table delivery_orders add column request_type_id int default 1;
alter table delivery_orders add index request_type_idx(request_type_id) ;

alter table inlogs add column invoice_id int;
alter table inlogs add index invoice_idx(invoice_id) ;

alter table invoice_details add column item_id int default NULL;
alter table invoice_details add index item_idx(item_id) ;

alter table delivery_order_details add column item_id int default NULL;
alter table delivery_order_details add index item_idx(item_id) ;

-- 05 may
alter table npb_details add column qty_unfilled int default 0;
update npb_details set qty_unfilled=qty-qty_filled;

-- 06 may
update menus set title=replace(title, 'NPB','MR') ;
update menus set title=replace(title, 'Department','Branch') ;
update menus set title=replace(title, 'Departement','Branch') ;
update menus set title=replace(title, 'Purchase','Register') ;
update menus set title=replace(title,'Movement', 'FA Transfer') where id not in(141,145) ;

--09 may
ALTER TABLE  `departments` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ;
INSERT INTO menus(parent_id, title, url, urutan) VALUES (78, 'Find Asset', '/assets/find', 13);
INSERT INTO groups_menus(menu_id, group_id) VALUES (155,7);
ALTER TABLE asset_details ADD ( check_physical varchar(11) default '0' null);
--10 may
update menus set url='/asset_details/reports/purchase' where id=116 ;
DELETE FROM `famsys`.`menus` WHERE `menus`.`id` = 50 ;
DELETE FROM `famsys`.`groups_menus` WHERE `groups_menus`.`menu_id` = 50 ;
ALTER TABLE  `asset_categories` CHANGE  `account_depr_accumulated_id`  `account_depr_accumulated_id` INT( 11 ) NULL;
ALTER TABLE  `asset_categories` CHANGE  `account_depr_cost_id`  `account_depr_cost_id` INT( 11 ) NULL;

DROP TABLE IF EXISTS `journal_templates`;

CREATE TABLE IF NOT EXISTS `journal_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `journal_group_id` int(10) unsigned NOT NULL,
  `asset_category_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_template_id` (`journal_group_id`,`asset_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=137 ;

INSERT INTO `journal_templates` (`id`, `journal_group_id`, `asset_category_id`, `name`) VALUES
(1, 1, 1, 'Penerimaan FA Tanah'),
(2, 1, 3, 'Penerimaan FA Gedung'),
(3, 1, 4, 'Penerimaan FA Instalasi'),
(4, 1, 5, 'Penerimaan FA Kendaraan'),
(5, 1, 6, 'Penerimaan FA Hardware Komputer'),
(6, 1, 7, 'Penerimaan FA Peripheral  Komputer'),
(7, 1, 8, 'Penerimaan FA Inventaris Gol I'),
(8, 1, 9, 'Penerimaan FA Inventaris Gol II'),
(9, 1, 10, 'Penerimaan FA Software Komputer'),
(10, 1, 11, 'Penerimaan FA Leasehold'),
(11, 5, 3, 'Penyusutan Gedung'),
(12, 5, 4, 'Penyusutan Instalasi'),
(13, 2, 1, 'Mutasi FA Tanah'),
(18, 4, 3, 'Pembayaran FA Gedung'),
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
(29, 2, 2, 'Mutasi Bangunan Dalam Penyelesaian'),
(30, 2, 3, 'Mutasi Gedung'),
(31, 2, 4, 'Mutasi Instalasi'),
(32, 2, 5, 'Mutasi Kendaraan'),
(33, 2, 6, 'Mutasi Hardware Komputer'),
(34, 2, 7, 'Mutasi Peripheral Komputer'),
(35, 2, 8, 'Inventaris Gol I'),
(36, 2, 9, 'Inventaris Gol II'),
(37, 2, 10, 'Mutasi Software Komputer'),
(38, 2, 11, 'Mutasi Leasehold'),
(39, 4, 10, 'Pembayaran Software'),
(40, 4, 7, 'Pembayaran Peripheral'),
(41, 3, 1, 'Write off Land'),
(42, 3, 2, 'Write off Building'),
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
(53, 4, 4, 'Pembayaran Instalasi'),
(54, 4, 8, 'Pembayaran Inv I'),
(55, 4, 9, 'Pembayaran Inv II'),
(56, 8, 1, 'Penjualan Tanah'),
(58, 8, 6, 'Penjualan Hardware'),
(59, 8, 7, 'Penjualan Peripheral'),
(60, 8, 8, 'Penjualan Inv I'),
(61, 8, 9, 'Penjualan Inv II'),
(62, 8, 10, 'Penjualan Software'),
(63, 8, 11, 'Penjualan Leasehold'),
(86, 1, 20, 'Penerimaan Stock Materai Skum'),
(65, 4, 16, 'Pembayaran Amortisasi'),
(77, 9, 12, 'Penerimaan Stock Barang Cetakan'),
(79, 1, 15, 'Penerimaan Stock ATK'),
(87, 1, 21, 'Penerimaan Stock Materai Kompuerisasi'),
(81, 1, 12, 'Penerimaan Stock Cetakan'),
(82, 1, 13, 'Penerimaan Stock Materai Tempel'),
(83, 1, 17, 'Penerimaan Stock Cek & Bilyet Giro'),
(84, 1, 18, 'Penerimaan Stock Souvenir'),
(85, 1, 19, 'Penerimaan Stock Materai Teraan'),
(76, 9, 15, 'Penerimaan Stock ATK'),
(78, 9, 13, 'Penerimaan Stock Materai'),
(80, 4, 15, 'Pembayaran Stock ATK'),
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
(136, 11, 10, 'Fixas Software Komputer');

DROP TABLE IF EXISTS `asset_categories` ;

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


INSERT INTO `asset_categories` (`id`, `code`, `name`, `descr`, `id_parent`, `depr_year_com`, `depr_rate_com`, `depr_year_fis`, `depr_rate_fis`, `account_id`, `account_depr_accumulated_id`, `account_depr_cost_id`, `is_asset`, `is_amort`, `asset_category_type_id`) VALUES
(1, 'TNH', 'Tanah', '', '0', 5, '20.00', 4, '25.00', 0, 0, 0, 1, 1, 1),
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=152 ;

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
(151, 'Akm Penyusutan Hardware Komputer', '108104', 0, 1, 0, 0, 1);


DROP TABLE IF EXISTS `account_types` ;

CREATE TABLE IF NOT EXISTS `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `descr` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;


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
(13, 'Persediaan', '');

update journal_groups set name='Penerimaan Barang' where name='Penerimaan FA';
update journal_groups set name='Distribusi dari Head Office ke Branch' where name='Distribusi FA dari Head Office ke Branch';
update journal_groups set name='Distribusi dari Head Office ke Unit Kerja' where name='Distribusi FA dari Head Office ke Unit Kerja';

alter table items add column qty_reorder int default 0;

--12 may
INSERT INTO  `famsys`.`groups` (`id` ,`name` ,`descr` ,`auth_amount`) VALUES (10,  'GS Admin',  'GS Admin',  '');
UPDATE  `famsys`.`groups` SET  `descr` =  'GS Procurement' WHERE  `groups`.`id` =7;
INSERT INTO  `famsys`.`groups` (`id` ,`name` ,`descr` ,`auth_amount`) VALUES (11 ,  'FA Management',  'FA Management',  '');
INSERT INTO  `famsys`.`groups` (`id` ,`name` ,`descr` ,`auth_amount`) VALUES (12 ,  'IT Admin',  'IT Admin',  '');
INSERT INTO  `famsys`.`groups` (`id` ,`name` ,`descr` ,`auth_amount`) VALUES (13 ,  'IT Management',  'IT Management',  '');
UPDATE  `famsys`.`groups` SET  `name` =  'GS Procurement' WHERE  `groups`.`id` =7;
ALTER TABLE  `npb_statuses` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT;
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES (5 ,  'Sent to FA Management');
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES (6 ,  'Sent to IT Management');
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES (7 ,  'Sent to GS');


-- 12 may

CREATE TABLE IF NOT EXISTS `invoices_delivery_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `delivery_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`delivery_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

alter table purchases add column delivery_order_id int default NULL;
alter table purchases add index delivery_order_idx(delivery_order_id) ;

alter table assets add column delivery_order_id int default NULL;
alter table assets add index delivery_order_idx(delivery_order_id) ;
alter table asset_details add column delivery_order_id int default NULL;
alter table asset_details add index delivery_order_idx(delivery_order_id) ;

alter table assets add column delivery_order_detail_id int default NULL;
alter table assets add index delivery_order_detail_idx(delivery_order_detail_id) ;
alter table asset_details add column delivery_order_detail_id int default NULL;
alter table asset_details add index delivery_order_detail_idx(delivery_order_detail_id) ;

alter table assets add column po_id int default NULL;
alter table assets add index po_idx(po_id) ;
alter table asset_details add column po_id int default NULL;
alter table asset_details add index po_idx(po_id) ;

alter table delivery_order_details add column discount_unit_cur decimal(20,2) default 0;
alter table delivery_orders add column convert_asset tinyint(1) default 0;
alter table delivery_orders add index  convert_assetx( convert_asset);

-- 13 may

INSERT INTO  `famsys`.`groups` (`id` ,`name` ,`descr` ,`auth_amount`) VALUES (14 ,  'Stock Management',  'Stock Management',  '');
ALTER TABLE  `users` CHANGE  `username`  `username` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('90',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('89',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('69',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('68',  '14');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('90',  '10');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('89',  '10');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('69',  '10');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('68',  '10');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('90',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('89',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('69',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('68',  '11');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('90',  '12');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('89',  '12');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('69',  '12');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('68',  '12');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('90',  '13');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('89',  '13');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('69',  '13');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('68',  '13');

INSERT INTO  `famsys`.`request_types` (`id` ,`name` ,`descr`) VALUES (4 ,  'Service',  '');
INSERT INTO `famsys`.`npb_statuses` (`id`, `name`) VALUES (8, 'Archive');

-- 14 may
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES (NULL, 'gs_admin', 'admin@admin.com', MD5('gs_admin'), 'gs_admin', '10', '4');
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES (NULL, 'it_admin', 'admin@admin.com', MD5('it_admin'), 'it_admin', '12', '4');
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES (NULL, 'fa_management', 'admin@admin.com', MD5('fa_management'), 'fa_management', '11', '4');
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES (NULL, 'it_management', 'admin@admin.com', MD5('it_management'), 'it_management', '13', '4');
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES (NULL, 'stock_management', 'admin@admin.com', MD5('stock_management'), 'stock_management', '14', '4');

INSERT INTO `famsys`.`npb_statuses` (`id`, `name`) VALUES (9, 'Sent to Stock Management');
ALTER TABLE  `npbs` ADD  `is_purchase_request` TINYINT( 1 ) NOT NULL DEFAULT  '0';

CREATE TABLE  `famsys`.`attachments` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`attachment_file_path` VARCHAR( 255 ) NOT NULL ,
`attachment_file_name` VARCHAR( 255 ) NOT NULL ,
`attachment_file_size` VARCHAR( 255 ) NOT NULL ,
`attachment_content_type` VARCHAR( 155 ) NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE  `attachments` ADD  `npb_id` INT( 11 ) NULL , ADD INDEX (  `npb_id` );
ALTER TABLE  `attachments` ADD  `name` VARCHAR( 255 ) NOT NULL AFTER  `id`;

--14 may
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('70',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('134',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('133',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('131',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('143',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('79',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('4',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('144',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('145',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('149',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('150',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('132',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('136',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('139',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('151',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('137',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('138',  '14');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)VALUES ('140',  '14');

INSERT INTO `famsys`.`npb_statuses` (`id`, `name`) VALUES (10, 'Approved by IT Manager');

--15 May
ALTER TABLE  `npbs` CHANGE  `created_by`  `created_by` VARCHAR( 25 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;



-- 15 may
alter table outlogs add column is_process tinyint(1) default 0;
alter table outlogs add index is_processx(is_process);
DROP TABLE IF EXISTS `stocks` ;
CREATE TABLE IF NOT EXISTS `stocks` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
	`date` date,
	`item_id` int(11),
	`qty` int(11),
	`in_out` varchar(10),
	`price` decimal(20,2),
	`amount` decimal(20,2),
	`outlog_id` int(11) default NULL,
	`usage_id` int(11) default NULL,
	`retur_id` int(11) default NULL,
	`department_id` int(11),
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`item_id`,`outlog_id`,`usage_id`,`retur_id`,`department_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 
alter table outlogs add column is_printed tinyint(1) default 0;
alter table outlogs add index is_printedx(is_printed);

-- 16 may

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

DROP TABLE IF EXISTS `retur_details`;
CREATE TABLE IF NOT EXISTS `retur_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retur_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
   `descr` varchar(255), 
  PRIMARY KEY (`id`),
  KEY `retur_id` (`retur_id`,`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;


DROP TABLE IF EXISTS `usages`;
CREATE TABLE IF NOT EXISTS `usages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `description` varchar(255),
  `is_process` tinyint(1) DEFAULT '0',
  `is_printed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `usage_details`;
CREATE TABLE IF NOT EXISTS `usage_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usage_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  `descr` varchar(255),
  PRIMARY KEY (`id`),
  KEY `usage_id` (`usage_id`,`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- add stock root menu to cabang
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('79',  '6');
INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (200,'79', 'Stock List', '/stocks/index', 130);
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('200',  '6');
INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (210,'79', 'New Stock Retur', '/returs/add', 150);
INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (220,'79', 'List Stock Retur', '/returs/index', 160);
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('210',  '6');
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('220',  '6');
INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (250,'79', 'New Stock Usage', '/usages/add', 200);
INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (260,'79', 'List Stock Usage', '/usages/index', 210);
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('250',  '6');
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('260',  '6');

alter table inlogs add column delivery_order_id tinyint(1) default 0;
alter table inlogs add index delivery_order_idx(delivery_order_id);

-- 17 may
alter table purchases add column currency_id int(1) default 0;
alter table purchases add index currency_idx(currency_id);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `no` (`no`),
  KEY `department_id` (`department_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `is_processx` (`is_process`),
  KEY `is_printedx` (`is_printed`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

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
   `descr` varchar(255), 
  PRIMARY KEY (`id`),
  KEY `supplier_retur_id` (`supplier_retur_id`,`item_id`,`doc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (360,'79', 'New Supplier Retur', '/supplier_returs/add', 150);
INSERT INTO menus(id,parent_id, title, url, urutan)VALUES (370,'79', 'List Supplier Retur', '/supplier_returs/index', 160);
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('360',  '14');
insert into groups_menus (`menu_id` ,`group_id`)VALUES ('370',  '14');

-- 19 may
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES ('11',  'Processed by Stock Manager');

ALTER TABLE  `items` CHANGE  `currency_id`  `currency_id` INT( 11 ) NOT NULL DEFAULT  '1';

UPDATE  `famsys`.`menus` SET  `url` =  '/pos/po_type' WHERE  `menus`.`id` =74;

-- 23 may
DELETE FROM `famsys`.`bank_account_types` WHERE `bank_account_types`.`id` = 3;
UPDATE `famsys`.`bank_account_types` SET `name` = 'Overbooking' WHERE `bank_account_types`.`id` =2;

-- 24 may
ALTER TABLE  `pos` ADD  `signer_1` TEXT NULL , ADD  `signer_2` TEXT NULL;
ALTER TABLE  `pos` ADD  `po_address` TEXT NOT NULL;
INSERT INTO  `famsys`.`configs` (`key` , `value`) VALUES ('po_address',  'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd');

ALTER TABLE `departments` ADD `area` INT NOT NULL 


------------------------23 may
INSERT INTO  `famsys`.`groups` (`id` ,`name` ,`descr` ,`auth_amount`) VALUES (100,  'Stock Supervisor',  'Stock Supervisor Group',  '');
-- stock parent menus
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) select id,  100 from menus where id=79 or parent_id=79;
-- inlogs outlog ledgers
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) select id,  100 from menus where parent_id in(131,132,138);
-- delete 'add new' menus
DELETE from `famsys`.`groups_menus` where menu_id in(250,360,210,136,133) and group_id=100;
-- add new user
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES (NULL, 'stock_supervisor', 'stock_supervisor@admin.com', MD5('stock_supervisor'), 'stock_supervisor', '100', '4');
-- update stock retur menu to new stock retur
UPDATE menus set title='New Stock Retur' where title='Stock Retur';
-- add column status outlog
alter table outlogs add column outlog_status_id int default 1;
alter table outlogs add index outlog_status_idx(outlog_status_id) ;
create table outlog_statuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into outlog_statuses (id,name) values (1,'Draft');
insert into outlog_statuses (id,name) values (2,'Sent to Supervisor');
insert into outlog_statuses (id,name) values (3,'Approved');
insert into outlog_statuses (id,name) values (4,'Reject');
insert into outlog_statuses (id,name) values (5,'Archive');
insert into outlog_statuses (id,name) values (6,'Finish');
update outlogs set outlog_status_id=1;
-- add column status inlog
alter table inlogs add column inlog_status_id int default 1;
alter table inlogs add index inlog_status_idx(inlog_status_id) ;
drop table if exists inlog_statuses;
create table inlog_statuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into inlog_statuses (id,name) values (1,'Draft');
insert into inlog_statuses (id,name) values (2,'Sent to Stock Management');
insert into inlog_statuses (id,name) values (3,'Sent to Supervisor');
insert into inlog_statuses (id,name) values (4,'Approved');
insert into inlog_statuses (id,name) values (5,'Reject');
insert into inlog_statuses (id,name) values (6,'Archive');
insert into inlog_statuses (id,name) values (7,'Finish');
update inlogs set inlog_status_id=1;
-- add inlog and outlog id in legers
alter table inventory_ledgers add column inlog_id int ;
alter table inventory_ledgers add column outlog_id int ;
alter table inventory_ledgers add index inlog_idx(inlog_id) ;
alter table inventory_ledgers add index outlog_idx(outlog_id) ;
-- add new status to npb
insert into npb_statuses (id,name) values (20,'Sent to Stock Supervisor');
insert into npb_statuses (id,name) values (30,'Approved by Stock Supervisor');

--26 may
ALTER TABLE  `npb_details` ADD  `unit_id` INT( 11 ) NULL;
ALTER TABLE  `npb_details` CHANGE  `unit_id`  `unit_id` INT( 11 ) NULL DEFAULT  '0';
-- 25 mey, return status
-- add column status inlog
alter table returs add column retur_status_id int default 1;
alter table returs add index retur_status_idx(retur_status_id) ;
drop table if exists retur_statuses;
create table retur_statuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into retur_statuses (id,name) values (1,'Draft');
insert into retur_statuses (id,name) values (2,'Sent to Branch Head');
insert into retur_statuses (id,name) values (3,'Approved by Branch Head');
insert into retur_statuses (id,name) values (4,'Reject');
insert into retur_statuses (id,name) values (5,'Archive');
insert into retur_statuses (id,name) values (6,'Finish');
update returs set retur_status_id=1;






















--- 26 may
---- add retur id 
alter table inventory_ledgers add column retur_id int ;
alter table inventory_ledgers add index retur_idx(retur_id) ;
--- menu stock di group stock management
INSERT INTO groups_menus(menu_id, group_id) VALUES (220,14);
INSERT INTO groups_menus(menu_id, group_id) VALUES (260,14);
INSERT INTO groups_menus(menu_id, group_id) VALUES (250,14);
INSERT INTO groups_menus(menu_id, group_id) VALUES (200,14);

-- add column status usage
alter table usages add column usage_status_id int default 1;
alter table usages add index usage_status_idx(usage_status_id) ;
drop table if exists usage_statuses;
create table usage_statuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into usage_statuses (id,name) values (1,'Draft');
insert into usage_statuses (id,name) values (2,'Sent to Branch Head');
insert into usage_statuses (id,name) values (3,'Reject');
insert into usage_statuses (id,name) values (4,'Archive');
insert into usage_statuses (id,name) values (5,'Finish');
update usages set usage_status_id=1;









-- 27 mey add column status supplier_retur
alter table supplier_returs add column supplier_retur_status_id int default 1;
alter table supplier_returs add index supplier_retur_status_idx(supplier_retur_status_id) ;
create table supplier_retur_statuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into supplier_retur_statuses (id,name) values (1,'Draft');
insert into supplier_retur_statuses (id,name) values (2,'Sent to Supervisor');
insert into supplier_retur_statuses (id,name) values (3,'Approved');
insert into supplier_retur_statuses (id,name) values (4,'Reject');
insert into supplier_retur_statuses (id,name) values (5,'Archive');
insert into supplier_retur_statuses (id,name) values (6,'Finish');
update supplier_returs set supplier_retur_status_id=1;

alter table stocks add column supplier_retur_id int default NULL;
alter table stocks add index supplier_retur_idx(supplier_retur_id) ;

alter table inventory_ledgers add column supplier_retur_id int default NULL;
alter table inventory_ledgers add index supplier_retur_idx(supplier_retur_id) ;





--- 30 may
alter table items add columen avg_price decimal (20,2);
alter table inventory_ledgers drop column doc_id;

alter table inventory_ledgers add column supplier_retur_detail_id int default NULL;
alter table inventory_ledgers add index supplier_retur_detail_idx(supplier_retur_detail_id) ;

alter table inventory_ledgers add column retur_detail_id int default NULL;
alter table inventory_ledgers add index retur_detail_idx(retur_detail_id) ;

alter table inventory_ledgers add column inlog_detail_id int default NULL;
alter table inventory_ledgers add index inlog_detail_idx(inlog_detail_id) ;

alter table inventory_ledgers add column outlog_detail_id int default NULL;
alter table inventory_ledgers add index outlog_detail_idx(outlog_detail_id) ;

alter table supplier_retur_detail drop column doc_id;
alter table inventory_ledgers add index supplier_retur_idx(retur_id) ;
<<<<<<< .mine


--30 may
INSERT INTO `famsys`.`groups` (`id`, `name`, `descr`, `auth_amount`) VALUES ('15', 'FA Supervisor', 'FA Supervisor', '0'), ('16', 'IT Supervisor', 'IT Supervisor', '0');
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`) VALUES ('19', 'fa_supervisor', 'fa_spv@admin.com', MD5('fa_supervisor'), 'fa_supervisor', '15', '4'), ('20', 'it_supervisor', 'it_spv@admin.com', MD5('it_supervisor'), 'it_supervisor', '16', '4');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('78',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('80',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('81',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('82',  '11');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('78',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('80',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('81',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('82',  '15');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('78',  '13');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('80',  '13');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('81',  '13');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('82',  '13');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('78',  '16');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('80',  '16');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('81',  '16');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` , `group_id`) VALUES ('82',  '16');




CREATE TABLE `famsys`.`department_subs` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`code` CHAR( 3 ) NOT NULL ,
`name` CHAR( 40 ) NULL ,
`department_id` INT( 11 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `famsys`.`department_units` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`code` CHAR( 3 ) NOT NULL ,
`name` CHAR( 40 ) NULL ,
`department_id` INT( 11 ) NOT NULL ,
`department_sub_id` INT( 11 ) NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE `assets` ADD `department_sub_id` INT( 11 ) NOT NULL AFTER `department_id` ,
ADD `department_unit_id` INT( 11 ) NOT NULL AFTER `department_sub_id` ;

ALTER TABLE `asset_details` ADD `department_sub_id` INT( 11 ) NOT NULL AFTER `department_id` ,
ADD `department_unit_id` INT( 11 ) NOT NULL AFTER `department_sub_id` ;

ALTER TABLE `npbs` ADD `department_sub_id` INT( 11 ) NOT NULL AFTER `department_id` ,
ADD `department_unit_id` INT( 11 ) NOT NULL AFTER `department_sub_id` ;

ALTER TABLE `po_details` ADD `department_sub_id` INT( 11 ) NOT NULL AFTER `department_id` ,
ADD `department_unit_id` INT( 11 ) NOT NULL AFTER `department_sub_id` ;

ALTER TABLE `delivery_order_details` ADD `department_sub_id` INT( 11 ) NOT NULL AFTER `department_id` ,
ADD `department_unit_id` INT( 11 ) NOT NULL AFTER `department_sub_id` ;

ALTER TABLE `users` ADD `department_sub_id` INT( 11 ) NOT NULL AFTER `department_id` ,
ADD `department_unit_id` INT( 11 ) NOT NULL AFTER `department_sub_id` ;



--31 may
ALTER TABLE  `movements` ADD  `request_type_id` INT( 11 ) NOT NULL AFTER  `movement_status_id`;

INSERT INTO `famsys`.`movement_statuses` (`id`, `name`) VALUES ('8', 'Processed');

INSERT INTO `famsys`.`npb_statuses` (`id`, `name`) VALUES ('40', 'Movement');

ALTER TABLE  `movements` ADD  `source_department_sub_id` CHAR( 40 ) NOT NULL AFTER  `source_department_id` ,
ADD  `source_department_unit_id` CHAR( 40 ) NOT NULL AFTER  `source_department_sub_id`;

ALTER TABLE  `movements` ADD  `dest_department_sub_id` CHAR( 40 ) NOT NULL AFTER  `dest_department_id` ,
ADD  `dest_department_unit_id` CHAR( 40 ) NOT NULL AFTER  `dest_department_sub_id`;


--1 jun
ALTER TABLE  `npb_details` CHANGE  `movement_id`  `movement_id` INT( 11 ) NULL;









































































-- 31 may , add outlog_id and movement_id at npb_details
alter table npb_details add column outlog_id int default null;
alter table npb_details add index outlog_idx(outlog_id) ;

-- MR menus to stok supervisor
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) select id,  100 from menus where id=68 or parent_id=68;
delete from  `famsys`.`groups_menus` where group_id=100 and menu_id=70;

--- add processed status to returs supplier_returs outlogs
insert into supplier_retur_statuses (id,name) values (7,'Processed');
insert into retur_statuses (id,name) values (7,'Processed');
insert into outlog_statuses (id,name) values (7,'Processed');
insert into inlog_statuses (id,name) values (8,'Processed');
insert into usage_statuses (id,name) values (6,'Processed');

-- add journal grups
insert into journal_groups (id,name) values (9, 'Inlog');
insert into journal_groups (id,name) values (10, 'Retur Cabang');
insert into journal_groups (id,name) values (11, 'Retur Supplier');
insert into journal_groups (id,name) values (12, 'Pemakaian Barang');

-- journal groups stock
INSERT INTO `journal_templates` (`journal_group_id`, `asset_category_id`, `name`) VALUES
(11, 12, 'Retur Supplier Barang Cetakan'),
(11, 13, 'Retur Supplier Materai Tempel'),
(11, 15, 'Retur Supplier Alat Tulis Kantor'),
(11, 17, 'Retur Supplier Cek & Bilyet Giro'),
(11, 18, 'Retur Supplier Souvenir'),
(11, 19, 'Retur Supplier Materai Teraan'),
(11, 20, 'Retur Supplier Materai Skum'),
(11, 21, 'Retur Supplier Materai Komputerisasi'),
(11, 22, 'Retur Supplier Kartu ATM'),
(11, 23, 'Retur Supplier Barang IT'),
(11, 24, 'Retur Supplier Barang Lainnya'),
(11, 28, 'Retur Supplier Promosi'),
(10, 12, 'Retur Cabang Barang Cetakan'),
(10, 13, 'Retur Cabang Materai Tempel'),
(10, 15, 'Retur Cabang Alat Tulis Kantor'),
(10, 17, 'Retur Cabang Cek & Bilyet Giro'),
(10, 18, 'Retur Cabang Souvenir'),
(10, 19, 'Retur Cabang Materai Teraan'),
(10, 20, 'Retur Cabang Materai Skum'),
(10, 21, 'Retur Cabang Materai Komputerisasi'),
(10, 22, 'Retur Cabang Kartu ATM'),
(10, 23, 'Retur Cabang Barang IT'),
(10, 24, 'Retur Cabang Barang Lainnya'),
(10, 28, 'Retur Cabang Promosi'),
(9, 12, 'Inlog Barang Cetakan'),
(9, 13, 'Inlog Materai Tempel'),
(9, 15, 'Inlog Alat Tulis Kantor'),
(9, 17, 'Inlog Cek & Bilyet Giro'),
(9, 18, 'Inlog Souvenir'),
(9, 19, 'Inlog Materai Teraan'),
(9, 20, 'Inlog Materai Skum'),
(9, 21, 'Inlog Materai Komputerisasi'),
(9, 22, 'Inlog Kartu ATM'),
(9, 23, 'Inlog Barang IT'),
(9, 24, 'Inlog Barang Lainnya'),
(9, 28, 'Inlog Promosi'),
(12, 12, 'Pemakaian Barang Cetakan'),
(12, 13, 'Pemakaian Barang Materai Tempel'),
(12, 15, 'Pemakaian Barang Alat Tulis Kantor'),
(12, 17, 'Pemakaian Barang Cek & Bilyet Giro'),
(12, 18, 'Pemakaian Barang Souvenir'),
(12, 19, 'Pemakaian Barang Materai Teraan'),
(12, 20, 'Pemakaian Barang Materai Skum'),
(12, 21, 'Pemakaian Barang Materai Komputerisasi'),
(12, 22, 'Pemakaian Barang Kartu ATM'),
(12, 23, 'Pemakaian Barang IT'),
(12, 24, 'Pemakaian Barang Lainnya'),
(12, 28, 'Pemakaian Barang Promosi');

alter table po_details add column npb_detail_id int(11) default null;
alter table po_details add index npb_detail_idx(npb_detail_id) ;

alter table purchases add column po_id int(11) default null;
alter table purchases add index po_idx(po_id) ;

--- invoice payment
DROP TABLE IF EXISTS `invoice_payments` ;
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
  `description` tinytext NULL,
  `amount_invoice` decimal(20,2) NOT NULL,
  `amount_po` decimal(20,2) default NULL,
  `po_id` int(11) default NULL,
  `bank_account_id` int(11)	,
  `bank_account_type_id` int(11)	,
  PRIMARY KEY (`id`),
  KEY `invoice_payment_idx` (`invoice_id`,`po_id`,`term_no`, `bank_account_id`,`bank_account_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

alter table invoices add column date_due date;
alter table invoices add index date_duex(date_due) ;

--2 jun
ALTER TABLE  `movements` ADD  `npb_id` INT( 11 ) NULL AFTER  `request_type_id`;

ALTER TABLE  `movements` CHANGE  `source_department_id`  `source_department_id` CHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `source_department_sub_id`  `source_department_sub_id` CHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `source_department_unit_id`  `source_department_unit_id` CHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `dest_department_id`  `dest_department_id` CHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `dest_department_sub_id`  `dest_department_sub_id` CHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `dest_department_unit_id`  `dest_department_unit_id` CHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE  `movement_details` ADD  `npb_detail_id` INT( 11 ) NOT NULL AFTER  `asset_detail_id` ,
ADD INDEX (  `npb_detail_id` );


--3 jun
INSERT INTO  `famsys`.`configs` (`key` ,`value`) VALUES ('po_rabobank',  'PT. Rabobank International Indonesia');


INSERT INTO `famsys`.`configs` (`key` ,`value`)
VALUES ('copyright_id', 'Copyright © %d Rabobank. All rights reserved.');

--- 3 jun : pembayaran termin ke spplier
insert into journal_groups (id,name) values (13, 'Pembayaran Termin Supplier');
-- journal groups stock
INSERT INTO `journal_templates` (`journal_group_id`, `asset_category_id`, `name`) VALUES
(13,1,'Pembayaran Termin FA Tanah'),
(13,2,'Pembayaran Termin FA Bangunan Dalam Penyelesaian'),
(13,3,'Pembayaran Termin FA Gedung'),
(13,4,'Pembayaran Termin FA Instalasi'),
(13,5,'Pembayaran Termin FA Kendaraan'),
(13,6,'Pembayaran Termin FA Hardware Komputer'),
(13,7,'Pembayaran Termin FA Peripheral Komputer'),
(13,8,'Pembayaran Termin FA Inventaris Golongan I'),
(13,9,'Pembayaran Termin FA Inventaris Golongan II'),
(13,10,'Pembayaran Termin FA Software Komputer'),
(13,11,'Pembayaran Termin FA Leasehold'),
(13,12,'Pembayaran Termin Barang Cetakan'),
(13,13,'Pembayaran Termin Materai Tempel'),
(13,15,'Pembayaran Termin Alat Tulis Kantor'),
(13,16,'Pembayaran Termin FA Renovasi'),
(13,17,'Pembayaran Termin Barang Cek & Bilyet Giro'),
(13,18,'Pembayaran Termin Barang Souvenir'),
(13,19,'Pembayaran Termin Materai Teraan'),
(13,20,'Pembayaran Termin Materai Skum'),
(13,21,'Pembayaran Termin Materai Komputerisasi'),
(13,22,'Pembayaran Termin Kartu ATM'),
(13,23,'Pembayaran Termin Barang IT'),
(13,24,'Pembayaran Termin Barang Lainnnya'),
(13,28,'Pembayaran Termin Promosi');

insert into account_types (id,name) values (15,'Uang Muka');
insert into accounts (id,name,gl,debit,credit,account_type_id) values (154,'Uang Muka','XXXXX', 1,1,15);

alter table invoice_payments add column is_posted tinyint(1) default 0;
alter table invoice_payments add index is_postedx(is_posted) ;
alter table invoice_payments add column posted_date datetime default NULL;
alter table invoice_payments add index posted_datex(posted_date) ;

insert into invoice_statuses (id,name) values (7,'Term Payment Journal Posted');


















--- 05 jun
alter table pos add column down_payment decimal(20,2) default 0;
alter table pos add column is_down_payment_journal_generated tinyint(1) default 0;
alter table pos add column down_payment_journal_generated_date datetime default NULL;
alter table pos add index is_down_payment_journal_generatedx(is_down_payment_journal_generated);

--wildan 04 jun
ALTER TABLE  `assets` CHANGE  `department_sub_id`  `department_sub_id` INT( 11 ) NULL;
ALTER TABLE  `assets` CHANGE  `department_unit_id`  `department_unit_id` INT( 11 ) NULL;

ALTER TABLE  `asset_details` CHANGE  `department_sub_id`  `department_sub_id` INT( 11 ) NULL ,
CHANGE  `department_unit_id`  `department_unit_id` INT( 11 ) NULL;

ALTER TABLE  `assets` CHANGE  `warranty_id`  `warranty_id` INT( 11 ) NULL;

ALTER TABLE  `movements` CHANGE  `source_department_id`  `source_department_id` CHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `source_department_sub_id`  `source_department_sub_id` CHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `source_department_unit_id`  `source_department_unit_id` CHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `dest_department_id`  `dest_department_id` CHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `dest_department_sub_id`  `dest_department_sub_id` CHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `dest_department_unit_id`  `dest_department_unit_id` CHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE  `movements` CHANGE  `request_type_id`  `request_type_id` INT( 11 ) NULL;

ALTER TABLE  `movement_details` CHANGE  `npb_detail_id`  `npb_detail_id` INT( 11 ) NULL;

--wildan 06 jun
ALTER TABLE  `users` CHANGE  `department_sub_id`  `department_sub_id` INT( 11 ) NULL ,
CHANGE  `department_unit_id`  `department_unit_id` INT( 11 ) NULL;


--- delivery orders
alter table delivery_orders add column is_journal_generated tinyint(1) default 0;
alter table delivery_orders add column journal_generated_date datetime default NULL;
alter table delivery_orders add index is_journal_generatedx(is_journal_generated);

alter table delivery_orders add column is_first tinyint(1) default 0;
alter table delivery_orders add index is_firstx(is_first);

--- 05 jun : pembayaran uang muka pembelian
insert into journal_groups (id,name) values (14, 'Uang Muka Pembelian');
-- journal groups stock
INSERT INTO `journal_templates` (`journal_group_id`, `asset_category_id`, `name`) VALUES
(14,1,'Uang Muka Pembelian FA Tanah'),
(14,2,'Uang Muka Pembelian FA Bangunan Dalam Penyelesaian'),
(14,3,'Uang Muka Pembelian FA Gedung'),
(14,4,'Uang Muka Pembelian FA Instalasi'),
(14,5,'Uang Muka Pembelian FA Kendaraan'),
(14,6,'Uang Muka Pembelian FA Hardware Komputer'),
(14,7,'Uang Muka Pembelian FA Peripheral Komputer'),
(14,8,'Uang Muka Pembelian FA Inventaris Golongan I'),
(14,9,'Uang Muka Pembelian FA Inventaris Golongan II'),
(14,10,'Uang Muka Pembelian FA Software Komputer'),
(14,11,'Uang Muka Pembelian FA Leasehold'),
(14,12,'Uang Muka Pembelian Barang Cetakan'),
(14,13,'Uang Muka Pembelian Materai Tempel'),
(14,15,'Uang Muka Pembelian Alat Tulis Kantor'),
(14,16,'Uang Muka Pembelian FA Renovasi'),
(14,17,'Uang Muka Pembelian Barang Cek & Bilyet Giro'),
(14,18,'Uang Muka Pembelian Barang Souvenir'),
(14,19,'Uang Muka Pembelian Materai Teraan'),
(14,20,'Uang Muka Pembelian Materai Skum'),
(14,21,'Uang Muka Pembelian Materai Komputerisasi'),
(14,22,'Uang Muka Pembelian Kartu ATM'),
(14,23,'Uang Muka Pembelian Barang IT'),
(14,24,'Uang Muka Pembelian Barang Lainnnya'),
(14,28,'Uang Muka Pembelian Promosi');











--- 06 jun update data department add wholesale dan retails
alter table departments add business_type_id int(10) default 2;
alter table departments add index business_type_idx(business_type_id);

drop table if exists business_types ;
create table  business_types (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into business_types (id,name) values (1,'Wholesale');
insert into business_types (id,name) values (2,'Retail');

update departments set business_type_id=2 where id<1000;
update departments set business_type_id=1 where id>=1000;


-- update usage statuses
drop table if exists usage_statuses;
create table usage_statuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into usage_statuses (id,name) values (1,'Draft');
insert into usage_statuses (id,name) values (2,'Sent to Branch Head');
insert into usage_statuses (id,name) values (3,'Approved');
insert into usage_statuses (id,name) values (4,'Reject');
insert into usage_statuses (id,name) values (5,'Archive');
insert into usage_statuses (id,name) values (6,'Processed');
insert into usage_statuses (id,name) values (7,'Finish');
update usages set usage_status_id=1;

-- delete journal distribusi utk barang FA
delete from journal_templates where asset_category_id in (select id from asset_categories where asset_category_type_id in (1,3)); 
delete from journal_templates where id=105;
insert into journal_templates (id,name,asset_category_id, journal_group_id) values (null, 'Pendistribusian Barang ATK', 15, 6);

-- add pembayaran stock 
INSERT INTO `journal_templates` (`id`, `journal_group_id`, `asset_category_id`, `name`) select null, 4, id, concat('Pembayaran ', name) from asset_categories where asset_category_type_id=2;

--disposal
ALTER TABLE  `disposals` CHANGE  `department_id`  `department_id` INT( 11 ) NULL;

--8 jun cost center
drop table if exists cost_centers;
CREATE TABLE  `famsys`.`cost_centers` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`code` VARCHAR( 11 ) NOT NULL ,
`name` VARCHAR( 255 ) NOT NULL,
`desc` TEXT NULL ,
INDEX (  `code` )
) ENGINE = MYISAM ;


ALTER TABLE  `assets` ADD  `cost_center_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `cost_center_id` );

ALTER TABLE  `asset_details` ADD  `cost_center_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `cost_center_id` );

ALTER TABLE  `users` ADD  `cost_center_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `cost_center_id` );

ALTER TABLE  `npbs` ADD  `cost_center_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `cost_center_id` );

ALTER TABLE  `po_details` ADD  `cost_center_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `cost_center_id` );

ALTER TABLE  `delivery_order_details` ADD  `cost_center_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `cost_center_id` );

TRUNCATE TABLE `department_units`;
TRUNCATE TABLE `department_subs`;
DELETE FROM `famsys`.`departments` WHERE `departments`.`id` >= 1000;

-- 9 juni tabel logs
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES (NULL, '28', 'Log', 'logs/', NULL, '525');

UPDATE `famsys`.`menus` SET `url` = '/logs' WHERE `menus`.`id` =371;

INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('371', '1');


--10 jun
UPDATE  `famsys`.`menus` SET  `title` =  'Logs' WHERE  `menus`.`id` =371;

--13 jun
INSERT INTO `famsys`.`business_types` (
`id` ,
`name`
)
VALUES (
NULL , 'GFM'
);

--12 jun
-- table DO
ALTER TABLE  `delivery_orders` CHANGE  `vat_base_cur`  `vat_base_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `wht_base_cur`  `wht_base_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `sub_total`  `sub_total` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `sub_total_cur`  `sub_total_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `discount_cur`  `discount_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `after_disc`  `after_disc` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `after_disc_cur`  `after_disc_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `wht_total_cur`  `wht_total_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `vat_total_cur`  `vat_total_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `total_cur`  `total_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00';

-- table DO_Detail
ALTER TABLE  `delivery_order_details` CHANGE  `amount`  `amount` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `amount_cur`  `amount_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `amount_after_disc`  `amount_after_disc` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `amount_after_disc_cur`  `amount_after_disc_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `vat`  `vat` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `vat_cur`  `vat_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
CHANGE  `department_id`  `department_id` INT( 11 ) NULL ,
CHANGE  `department_sub_id`  `department_sub_id` INT( 11 ) NULL ,
CHANGE  `department_unit_id`  `department_unit_id` INT( 11 ) NULL;

ALTER TABLE `cost_centers` DROP `business_type_id`;

ALTER TABLE `cost_centers` CHANGE `code` `cost_centers` VARCHAR( 11 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;


ALTER TABLE  `assets` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `business_type_id` );

ALTER TABLE  `asset_details` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `business_type_id` );

ALTER TABLE  `users` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `business_type_id` );

ALTER TABLE  `npbs` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `business_type_id` );

ALTER TABLE  `po_details` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `business_type_id` );

ALTER TABLE  `delivery_order_details` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_unit_id` ,
ADD INDEX (  `business_type_id` );

-- 08 jun

ALTER TABLE  `npb_details` ADD  `process_type_id` INT( 11 ) NULL , ADD INDEX (  `process_type_id` );
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES ('50',  'Processing');
DROP TABLE IF  EXISTS process_types;
CREATE TABLE IF NOT EXISTS process_types (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50),
  PRIMARY KEY (`id`)
);
insert into process_types (id,name) values (1, 'Movement');
insert into process_types (id,name) values (2, 'Procurement');


-- 14 jun
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES ('100',  'Done');
--14 juni
--update movement
ALTER TABLE  `movements` ADD  `source_business_type_id` INT( 11 ) NULL AFTER  `source_department_unit_id`;
ALTER TABLE  `movements` ADD  `source_cost_center_id` INT( 11 ) NULL AFTER  `source_business_type_id`;
ALTER TABLE  `movements` ADD  `dest_business_type_id` INT( 11 ) NULL AFTER  `dest_department_unit_id`;
ALTER TABLE  `movements` ADD  `dest_cost_center_id` INT( 11 ) NULL AFTER  `dest_business_type_id`;


ALTER TABLE  `npb_details` CHANGE  `currency_id`  `currency_id` INT( 11 ) NOT NULL DEFAULT  '1';






























































-- 14 jun
INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES ('100',  'Done');
ALTER TABLE  `npbs` ADD  `date_finish` DATETIME NULL;


-- 16 jun
insert into journal_groups (id,name) values (15, 'Pembelian FA');

-- journal groups pembelian FA
DELETE FROM journal_templates where journal_group_id=15;
INSERT INTO `journal_templates` (`journal_group_id`, `asset_category_id`, `name`) 
SELECT 15, id, CONCAT('Pembelian FA ', name) from asset_categories where asset_category_type_id=1;

-- journal_template_details
ALTER TABLE  `journal_template_details` ADD  `for_purchase_with_dp` TINYINT( 1 ) NOT NULL DEFAULT  '0',
ADD INDEX (  `for_purchase_with_dp` )