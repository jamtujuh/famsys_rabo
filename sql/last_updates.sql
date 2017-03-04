-- 17 juni
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`)
VALUES (NULL, '78', 'List Asset Detail', '/asset_details', NULL, '11');

INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('373', '7'), ('373', '8');


ALTER TABLE `asset_details` CHANGE `setatus` `status`
CHAR( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;


-- 20 juni
INSERT INTO `famsys`.`configs` (
`key` ,
`value`
)
VALUES (
'depreciation_warning', 'Depreciation is only done once a month that is in the middle of the month or the 15th. If you push the button it will start accounting for depreciation. So make sure first.'
);

UPDATE `famsys`.`menus` SET `url` = '/assets/process' WHERE `menus`.`id` =110;


INSERT INTO `famsys`.`menus` (`id` ,`parent_id` ,`title` ,`url` ,`help` ,`urutan`)
VALUES (
NULL , NULL , 'USER', '#', NULL , '300');


INSERT INTO `famsys`.`menus` (`id` ,`parent_id` ,`title` ,`url` ,`help` ,`urutan`)
VALUES (
NULL , '374', 'Profile', '/users/change_password', NULL , '305');

INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`)
VALUES 
('374', '1'),
('374', '2'),
('374', '3'),
('374', '4'),
('374', '5'),
('374', '6'),
('374', '7'),
('374', '8'),
('374', '9'),
('374', '10'),
('374', '11'),
('374', '12'),
('374', '13'),
('374', '14'),
('374', '15'),
('374', '16'),
('374', '100');

INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`)
VALUES 
('375', '1'),
('375', '2'),
('375', '3'),
('375', '4'),
('375', '5'),
('375', '6'),
('375', '7'),
('375', '8'),
('375', '9'),
('375', '10'),
('375', '11'),
('375', '12'),
('375', '13'),
('375', '14'),
('375', '15'),
('375', '16'),
('375', '100');

INSERT INTO `famsys`.`configs` (
`key` ,
`value`
)
VALUES (
'login_message', 'Only authorized, is entitled to enter into this application'
);


ALTER TABLE `users` ADD `aktif` TINYINT( 1 ) NULL DEFAULT '0';

UPDATE `famsys`.`menus` SET `urutan` = '800' WHERE `menus`.`id` =374;

UPDATE `famsys`.`menus` SET `urutan` = '805' WHERE `menus`.`id` =375;

update users set aktif=1;


---set pasword change for 3 monts
ALTER TABLE  `users` ADD  `last_password_change` DATETIME NULL;

--juni 24
ALTER TABLE `purchases` ADD `warranty_note` TEXT NOT NULL AFTER `warranty_id` ,
ADD `warranty_year` INT( 3 ) NOT NULL AFTER `warranty_note` ;

ALTER TABLE `purchases` CHANGE `warranty_id` `warranty_id` INT( 11 ) NULL ;

ALTER TABLE `asset_details` CHANGE `serial_no` `serial_no` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;

ALTER TABLE `asset_details` ADD `accept` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `accepted_datetime` DATETIME NOT NULL ,
ADD `accepted_by` VARCHAR( 25 ) NOT NULL ;

-- jun 25
ALTER TABLE `asset_details` CHANGE `check_physical` `check_physical` TINYINT( 1 ) NULL DEFAULT '0';
UPDATE  `famsys`.`departments` SET  `name` =  'Raden Saleh' WHERE  `departments`.`id` =2;


-- jun27
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('373',  '2'), ('373',  '6');

ALTER TABLE  `asset_details` CHANGE  `accept`  `accept` TINYINT( 1 ) NULL DEFAULT  '0',
CHANGE  `accepted_datetime`  `accepted_datetime` DATETIME NOT NULL ,
CHANGE  `accepted_by`  `accepted_by` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
--**menu disposal fa_management
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('2',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('102',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('101',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('100',  '11');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('103',  '11');

--**menu disposal fa_supervisor
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('2',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('102',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('101',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('100',  '15');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('103',  '15');

ALTER TABLE  `disposals` ADD  `business_type_id` INT( 11 ) NULL AFTER  `department_id` ,
ADD  `cost_center_id` INT( 11 ) NULL AFTER  `business_type_id` ,
ADD INDEX (  `business_type_id` ,  `cost_center_id` );






-- 27 jun

ALTER TABLE  `journal_transactions` ADD  `posting_date` DATETIME NOT NULL AFTER  `posting` ,
ADD INDEX (  `posting_date` ) ;


insert into po_statuses (id,name) values (9, 'Archived');


ALTER TABLE  `invoice_payments` ADD  `po_payment_id` INT NULL AFTER  `po_id` ,
ADD INDEX (  `po_payment_id` )


INSERT INTO  `famsys`.`delivery_order_statuses` ( `id` ,`name` , `sorter`) VALUES ('4',  'Sent to Supervisor',  '0');

-- menu laporan penerimaan barang
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`)
VALUES (400, '122', 'Item Receive Report', '/delivery_order_details/receive_report', NULL, '11');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('400', '7'), ('400', '8');

-- menu laporan pemesanan barang
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`)
VALUES (410, '122', 'Item Order Report', '/po_details/order_report', NULL, '11');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('410', '7'), ('410', '8');

-- menu laporan penjualan fa
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES (420, 113, 'FA Sales Report', '/disposal_details/sales_report', NULL, '1100');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES (420, '7'), (420, '8');
-- menu laporan writeoff fa
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES (430, 113, 'FA Write Off Report', '/disposal_details/write_off_report', NULL, '1200');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES (430, '7'), (430, '8');

-- pindah menu transfer report
UPDATE  `famsys`.`menus` SET  `url` =  '/movement_details/reports/fa' WHERE  `menus`.`id` =115;



--1 july
INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`, `business_type_id`, `cost_center_id`, `aktif`) VALUES (NULL, 'gsspv', 'gs_spv@admin.com', MD5('gs_spv'), 'gs_spv', '9', '72', '2', '128', '1');

INSERT INTO  `famsys`.`npb_statuses` (`id` ,`name`) VALUES ('120',  'Sent to GS Supervisor');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('68',  '9');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('69',  '9');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('89',  '9');
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('90',  '9');

INSERT INTO `famsys`.`invoice_statuses` (`id`, `name`, `description`) VALUES ('10', 'Sent to Fincon', '');
INSERT INTO `famsys`.`invoice_statuses` (`id`, `name`, `description`) VALUES ('20', 'Sent to Fincon Supervisor', '');

INSERT INTO `famsys`.`groups` (`id`, `name`, `descr`, `auth_amount`) VALUES ('20', 'Fincon Supervisor', 'Fincon Supervisor', '0');

INSERT INTO `famsys`.`users` (`id`, `username`, `email`, `password`, `name`, `group_id`, `department_id`, `business_type_id`, `cost_center_id`, `aktif`) VALUES (NULL, 'finconspv', 'fincon_spv@admin.com', MD5('fincon_spv'), 'fincon_spv', '20', '72', '2', '128', '1');

INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('374', '20');
INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('375', '20');
INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('77', '20');
INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('75', '20');
INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('111', '20');
INSERT INTO `famsys`.`groups_menus` (`menu_id` ,`group_id`) VALUES ('112', '20');



--4juli
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('154', '3');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('154', '4');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('154', '5');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('154', '8');

ALTER TABLE  `purchases` CHANGE  `warranty_note`  `warranty_name` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE  `assets` ADD  `warranty_name` TEXT NOT NULL AFTER  `warranty_id` , ADD  `warranty_year` INT( 3 ) NOT NULL AFTER  `warranty_name`;

ALTER TABLE  `asset_details` ADD  `warranty_id` INT( 11 ) NULL AFTER  `cost_center_id` ,
ADD  `warranty_name` TEXT NOT NULL AFTER  `warranty_id` ,
ADD  `warranty_year` INT( 3 ) NOT NULL AFTER  `warranty_name`;

--  menu FA di famanagement
insert into groups_menus (menu_id, group_id)
select id,  11 from menus where id=78 or parent_id=78;
-- menu FA di fasupervisor
insert into groups_menus (menu_id, group_id)
select id,  15 from menus where id=78 or parent_id=78;

-- tambah for_accum_dep utk RP umum yang menkontra Accum dep
ALTER TABLE  `journal_template_details` ADD  `for_accum_dep` TINYINT( 1 ) NOT NULL DEFAULT  '0',
ADD INDEX (  `for_accum_dep` );


-- tambah menu import
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`)
VALUES (440,	106,	'Import Assets',	'/asset_details/import', NULL, '11');



---7 juli    karena semua bentuk nya rupiah
ALTER TABLE  `journal_transactions` CHANGE  `amount_db`  `amount_db` DECIMAL( 20 ) NOT NULL DEFAULT  '0.00',
CHANGE  `amount_cr`  `amount_cr` DECIMAL( 20 ) NOT NULL DEFAULT  '0.00'


-- menu register FA di famanagement
insert into groups_menus (menu_id, group_id)
select id,  11 from menus where parent_id=106;

-- menu FA di fasupervisor
insert into groups_menus (menu_id, group_id)
select id,  15 from menus where parent_id=106;

-- update menu import
update `famsys`.`menus` set url='/fa_imports' where id=440;


ALTER TABLE  `locations` CHANGE  `parent_id`  `parent_id` INT( 11 ) NOT NULL DEFAULT  '0'


ALTER TABLE  `suppliers` CHANGE  `no`  `no` VARCHAR( 4 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT  '';


-- 9 juli 
UPDATE  `famsys`.`departments` SET  `code` =  'ABM' WHERE  `departments`.`id` =1;
UPDATE  `famsys`.`departments` SET  `code` =  'RDS' WHERE  `departments`.`id` =2;
UPDATE  `famsys`.`departments` SET  `code` =  'CPG' WHERE  `departments`.`id` =5;
UPDATE  `famsys`.`departments` SET  `code` =  'BIN' WHERE  `departments`.`id` =9;

UPDATE  `famsys`.`request_types` SET  `descr` =  'IT' WHERE  `request_types`.`id` =1;
UPDATE  `famsys`.`request_types` SET  `descr` =  'GS' WHERE  `request_types`.`id` =2;
UPDATE  `famsys`.`request_types` SET  `descr` =  'STK' WHERE  `request_types`.`id` =3;
UPDATE  `famsys`.`request_types` SET  `descr` =  'SVC' WHERE  `request_types`.`id` =4;

UPDATE  `famsys`.`menus` SET  `url` =  '/npbs/add/1' WHERE  `menus`.`id` =70;
UPDATE  `famsys`.`menus` SET  `title` =  'New MR IT Items' WHERE  `menus`.`id` =70;

INSERT INTO  `famsys`.`menus` (`id` ,`parent_id` ,`title` ,`url` ,`help` ,`urutan`)
VALUES ('450' ,  '68',  'New MR GS Items',  '/npbs/add/2', NULL ,  '0'), 
('451' ,  '68',  'New MR Stock Items',  '/npbs/add/3', NULL ,  '2'),
('452' ,  '68',  'New MR Service Items',  '/npbs/add/4', NULL ,  '3');

UPDATE  `famsys`.`menus` SET  `urutan` =  '1' WHERE  `menus`.`id` =70;

INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`)
VALUES ('450' , '6'),
('451' , '6'),
('452' , '6');

UPDATE  `famsys`.`groups_menus` SET  `menu_id` =  '451' WHERE  `groups_menus`.`menu_id` =3 AND  `groups_menus`.`group_id` =14 LIMIT 1 ;
UPDATE  `famsys`.`menus` SET  `urutan` =  '6' WHERE  `menus`.`id` =69;

ALTER TABLE  `pos` CHANGE  `no`  `no` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE  `npbs` CHANGE  `no`  `no` VARCHAR( 25 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

UPDATE  `famsys`.`menus` SET  `urutan` =  '0' WHERE  `menus`.`id` =74;
UPDATE  `famsys`.`menus` SET  `urutan` =  '1' WHERE  `menus`.`id` =73;

UPDATE  `famsys`.`menus` SET  `urutan` =  '10' WHERE  `menus`.`id` =109;
UPDATE  `famsys`.`menus` SET  `urutan` =  '11' WHERE  `menus`.`id` =373;
UPDATE  `famsys`.`menus` SET  `urutan` =  '12' WHERE  `menus`.`id` =80;


-- 10 juli
DROP TABLE IF EXISTS`fa_returs`;
CREATE TABLE IF NOT EXISTS `fa_returs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_date` date NOT NULL,
  `no` varchar(10) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `fa_retur_status_id` varchar(50) NOT NULL,
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

DROP TABLE IF EXISTS `fa_retur_details`;
CREATE TABLE IF NOT EXISTS `fa_retur_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_retur_id` varchar(50) NOT NULL,
  `asset_detail_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `brand` varchar(64) NULL,
  `type` varchar(64) NULL,
  `color` varchar(64) NULL,
  `serial_no` varchar(64) NULL,
  `date_of_purchase` date NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fa_retur_id` (`fa_retur_id`),
  KEY `asset_detail_id` (`asset_detail_id`),
  KEY `asset_category_id` (`asset_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `fa_retur_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO  `famsys`.`fa_retur_statuses` (`id` ,`name`)
VALUES ('1',  'Draft'),('2' ,  'Sent to Branch Head'),('3' ,  'Approval by Branch Head'),
	('4',  'Sent to GS Supervisor'),('5',  'Approved by Supervisor'),('6',  'Processing'),
	('7',  'Finish'),('8',  'Cancel'),('9',  'Reject'),('10',  'Archive');
	
	
INSERT INTO  `famsys`.`menus` (`id` ,`parent_id` ,`title` ,`url` ,`help` ,`urutan`)
VALUES ('453' ,  '78',  'New FA Retur',  '/fa_returs/add', NULL ,  '2'), 
('454' ,  '78',  'List FA Retur',  '/fa_returs', NULL ,  '3');


INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)
VALUES ('453',  '6'), ('454',  '6');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)
VALUES ('454',  '2'), ('454',  '3'), ('454',  '7');

INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('78', '3');


ALTER TABLE  `fa_retur_details` ADD  `code` VARCHAR( 40 ) NOT NULL ,
ADD  `item_code` VARCHAR( 40 ) NOT NULL ,
ADD  `name` VARCHAR( 40 ) NOT NULL;

-- alter table asset_details
ALTER TABLE  `asset_details` CHANGE  `purchase_id`  `purchase_id` INT( 11 ) NULL ,
CHANGE  `warranty_name`  `warranty_name` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `warranty_year`  `warranty_year` INT( 3 ) NULL ,
CHANGE  `year`  `year` INT( 11 ) NULL ,
CHANGE  `notes`  `notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `invoice_id`  `invoice_id` INT( 11 ) NULL ,
CHANGE  `accepted_datetime`  `accepted_datetime` DATETIME NULL;

-- alter table assets
ALTER TABLE  `assets` CHANGE  `condition_id`  `condition_id` INT( 11 ) NULL ,
CHANGE  `purchase_id`  `purchase_id` INT( 11 ) NULL ,
CHANGE  `warranty_id`  `warranty_id` INT( 11 ) NULL DEFAULT NULL ,
CHANGE  `warranty_name`  `warranty_name` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `warranty_year`  `warranty_year` INT( 3 ) NULL ,
CHANGE  `year`  `year` INT( 11 ) NULL ,
CHANGE  `notes`  `notes` TINYTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `invoice_id`  `invoice_id` INT( 11 ) NULL;


--tinggal ini wil
ALTER TABLE  `fa_returs` CHANGE  `no`  `no` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

--server rabobank
UPDATE  `famsys`.`groups_menus` SET  `menu_id` =  '451' WHERE  `groups_menus`.`menu_id` =70 AND  `groups_menus`.`group_id` =14 LIMIT 1 ;

INSERT INTO `items` (`id`, `code`, `name`, `price`, `avg_price`, `descr`, `request_type_id`, `asset_category_id`, `currency_id`, `unit_id`, `created`, `qty_reorder`) VALUES
(364, '2ACC001', 'Bukti Potong PPH Bunga Dep/Tab', '10000.00', '11000.00', '', 3, 12, 1, 6, '0000-00-00 00:00:00', NULL),
(365, '2ACC002', 'Daftar Potong PPH PS.4 Ayat 2', '5000.00', '5500.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(366, '2ACC003', 'Faktur Pajak Sederhana', '2000.00', '2200.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(367, '2ACC004', 'Faktur Pajak Standar (Baru)', '8000.00', '8800.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(368, '2ACC005', 'SPT Masa PPH PS 21/26', '1500.00', '1650.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(369, '2ACC006', 'Bukti Potong PPH PS 21', '5500.00', '0.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(370, '2ACC007', 'Bukti Potong PPH Atas Tanah', '8900.00', '0.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(371, '2ACC008', 'Bukti Potong PPH PS 23', '900.00', '0.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(372, '2ACC009', 'SPT Masa PPH 23 & 26', '700.00', '0.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(373, '2ACC010', 'Daftar Potong PPH PS 21 & 26', '8700.00', '0.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(374, '2BOF002', 'Bukti Earmark', '6700.00', '0.00', '', 3, 12, 1, 5, '0000-00-00 00:00:00', NULL),
(375, '1AMP001', 'Amplop Putih Polos', '2100.00', '2310.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(376, '1AMP002', 'Amplop Coklat Map', '8500.00', '9350.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(377, '1AMP003', 'Amplop Coklat Kabinet Lipat', '7600.00', '8360.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(378, '1AMP004', 'Amplop Coklat Kabinet', '3500.00', '3850.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(379, '1AMP006', 'Amplop Coklat Kwarto', '1200.00', '0.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(380, '1AMP007', 'Amplop Coklat Folio', '3800.00', '0.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(381, '1AMP008', 'Amplop Otomatis Kliring', '9000.00', '0.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(382, '1AMP011', 'Amplop Coklat 1/2 Folio', '7080.00', '0.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL),
(383, '1ATK001', 'Cutter', '1700.00', '0.00', '', 3, 15, 1, 7, '0000-00-00 00:00:00', NULL),
(384, '1AMP005', 'Amplop Coklat Super Kabinet', '7400.00', '8140.00', '', 3, 15, 1, 6, '0000-00-00 00:00:00', NULL);

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'rim'),
(2, 'pcs'),
(3, 'box'),
(4, 'dozen'),
(5, 'buku'),
(6, 'pak/100'),
(7, 'buah');

INSERT INTO `suppliers` (`id`, `no`, `name`, `address`, `city`, `telephone`, `email`, `fax`, `hp`, `business_type`, `contact_person`, `province`, `website`, `default_wht_rate`, `bank_name`, `bank_account_no`, `bank_account_name`, `bank_account_type_id`) VALUES
(30, '', 'Penta Print', 'Ged.Ranuza Lantai 3 Jl. timor No. 10 Menteng', 'jakarta', '021-31935263', 'trikarsa@yahoo.com', '021-31935226', '0867423544', '', 'Melsari', 'west java', 'www.trikarsa.com', '2.00', '', '', '', 0),
(31, '', 'Kusuma Jaya', 'Ged.Ranssuza Lantai 4 Jl. timssor No. 17 Mentsseng', 'jakaddrta', '021-319cd5263', 'trikarddsa@yahoo.com', '021-31935226', '0867423544', '', 'Melsari', 'west java', 'www.trikarsa.com', '2.00', '', '', '', 0);


-- tambah menu FA supplier retur 

INSERT INTO  `famsys`.`menus` (`id` ,`parent_id` ,`title` ,`url` ,`help` ,`urutan`)
VALUES ('455' ,  '78',  'New FA Supplier Retur',  '/fa_supplier_returs/add', NULL ,  '200'), 
('456' ,  '78',  'List FA Supplier Retur',  '/fa_supplier_returs', NULL ,  '210');
-- new fa supplier retur
INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)
VALUES ('455',  '7'), ('456',  '7'), ('456',  '3');

-- 12 jul index item_code
ALTER TABLE  `asset_details` ADD INDEX (  `item_code` );

-- 13 jul menu MR stock di stock mangement
UPDATE  `famsys`.`groups_menus` SET  `menu_id` =  '451' WHERE  `groups_menus`.`menu_id` =70 AND  `groups_menus`.`group_id` =14 LIMIT 1 ;


-- 13 jul update menu stock retur

INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES (457, '79', 'Supplier Retur', '#', NULL, NULL);
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES (458, '457', 'New Supplier Replacement', '/supplier_replaces/add', NULL, 500);
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES (459, '457', 'List Supplier Replacement', '/supplier_replaces', NULL, 510);
UPDATE  `famsys`.`menus` SET  `parent_id` =  '457' WHERE  `menus`.`id` =360;
UPDATE  `famsys`.`menus` SET  `parent_id` =  '457' WHERE  `menus`.`id` =370;
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('457', '14'), ('457', '100');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('458', '14'), ('458', '100');

DROP table  IF EXISTS `supplier_replaces`;
CREATE TABLE  `famsys`.`supplier_replaces` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
 `no` VARCHAR( 50 ) NOT NULL ,
 `date` DATE NOT NULL ,
 `department_id` INT( 11 ) NOT NULL ,
 `supplier_id` INT( 11 ) NOT NULL ,
 `created_at` DATETIME NOT NULL ,
 `created_by` VARCHAR( 50 ) NOT NULL ,
 `is_process` TINYINT( 1 ) DEFAULT  '0',
 `is_printed` TINYINT( 1 ) DEFAULT  '0',
 `supplier_retur_status_id` INT( 11 ) DEFAULT  '1',
PRIMARY KEY (  `id` ) ,
UNIQUE KEY  `no` (  `no` ) ,
KEY  `department_id` (  `department_id` ) ,
KEY  `supplier_id` (  `supplier_id` ) ,
KEY  `is_processx` (  `is_process` ) ,
KEY  `is_printedx` (  `is_printed` ) ,
KEY  `supplier_retur_status_idx` (  `supplier_retur_status_id` )
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

DROP table  IF EXISTS `supplier_replace_details`;
CREATE TABLE  `famsys`.`supplier_replace_details` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
 `supplier_retur_id` INT( 11 ) NOT NULL ,
 `item_id` INT( 11 ) NOT NULL ,
 `qty` INT( 10 ) NOT NULL DEFAULT  '1',
 `price` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
 `amount` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0.00',
 `posting` TINYINT( 1 ) NOT NULL DEFAULT  '0',
 `doc_id` INT( 11 ) NOT NULL DEFAULT  '0',
 `descr` VARCHAR( 255 ) DEFAULT NULL ,
PRIMARY KEY (  `id` ) ,
KEY  `supplier_retur_id` (  `supplier_retur_id` ,  `item_id` ,  `doc_id` )
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

DROP table  IF EXISTS `supplier_replace_statuses`;
CREATE TABLE  `famsys`.`supplier_replace_statuses` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
 `name` VARCHAR( 50 ) DEFAULT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = MYISAM DEFAULT CHARSET = latin1;

INSERT INTO  `famsys`.`supplier_replace_statuses` 
SELECT * FROM  `famsys`.`supplier_retur_statuses` ;

ALTER TABLE  `supplier_replaces` CHANGE  `supplier_retur_status_id`  `supplier_replace_status_id` INT( 11 ) NULL DEFAULT  '1';
ALTER TABLE  `supplier_replace_details` CHANGE  `supplier_retur_id`  `supplier_replace_id` INT( 11 ) NOT NULL;

ALTER TABLE  `stocks` ADD  `supplier_replace_id` INT NULL;

-- 14 jul: parameter jam MR max
INSERT INTO `famsys`.`configs` (`key`, `value`) VALUES ('mr_max_time', '12');

--copy to rabobank server database
-- approved by
ALTER TABLE  `npbs` ADD  `approved_by` VARCHAR( 50 ) NULL ,
ADD  `approved_date` DATETIME NULL ,
ADD INDEX (  `approved_by` ,  `approved_date` );

-- 15 juli
ALTER TABLE  `invoices` CHANGE  `no`  `no` VARCHAR( 15 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;


ALTER TABLE  `pos` ADD  `approved_by` VARCHAR( 50 ) NULL ,
ADD  `approved_date` DATETIME NULL;

ALTER TABLE  `delivery_orders` CHANGE  `no`  `no` VARCHAR( 15 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE  `delivery_orders` ADD  `approved_by` VARCHAR( 50 ) NOT NULL ,
ADD  `approved_date` DATETIME NOT NULL;

ALTER TABLE  `fa_returs` ADD  `approved_by` VARCHAR( 50 ) NULL ,
ADD  `approved_date` DATETIME NULL;

ALTER TABLE `invoices` ADD `approved_by` VARCHAR (50) NULL,
ADD `approved_date` DATETIME NULL;

ALTER TABLE `movements` ADD `approved_by` VARCHAR (50) null,
ADD `approved_date` DATETIME null;

ALTER TABLE `inlogs` ADD `approved_by` VARCHAR (50) null,
ADD `approved_date` DATETIME null;

ALTER TABLE `outlogs` ADD `approved_by` VARCHAR (50) null,
ADD `approved_date` DATETIME null;

ALTER TABLE `fa_supplier_returs` ADD `approved_by` VARCHAR (50) null,
ADD `approved_date` DATETIME null;

ALTER TABLE `disposals` ADD `approved_by` VARCHAR (50) null,
ADD `approved_date` DATETIME null;

INSERT INTO  `famsys`.`menus` (`id` ,`parent_id` ,`title` ,`url` ,`help` ,`urutan`)
VALUES ('460',  '144',  'Stock Reports',  '/items/item_status', NULL ,  '239');

INSERT INTO  `famsys`.`groups_menus` (`menu_id` ,`group_id`)
VALUES ('14',  '460');

-- 19 jul invoice other cost
ALTER TABLE  `invoices` ADD  `other_cost_total` DECIMAL( 20, 2 ) NOT NULL default 0;
ALTER TABLE  `invoices` ADD  `other_cost_notes` TEXT NULL;

-- 18 jul
ALTER TABLE  `npbs` CHANGE  `created_date`  `created_date` DATETIME NOT NULL;

ALTER TABLE  `pos` CHANGE  `created`  `created` DATETIME NOT NULL;


ALTER TABLE  `outlogs` ADD (
 `reject_notes` TEXT NOT NULL ,
 `reject_by` VARCHAR( 50 ) NOT NULL ,
 `reject_date` DATETIME NOT NULL ,
 `cancel_notes` TEXT NOT NULL ,
 `cancel_by` VARCHAR( 50 ) NOT NULL ,
 `cancel_date` DATETIME NOT NULL
);

ALTER TABLE  `inlogs` ADD (
 `cancel_notes` TEXT NOT NULL ,
 `cancel_by` VARCHAR( 50 ) NOT NULL ,
 `cancel_date` DATETIME NOT NULL
);

ALTER TABLE `usages` ADD `approved_by` VARCHAR (50) null,
ADD `approved_date` DATETIME null;

ALTER TABLE  `usages` ADD (
 `reject_notes` TEXT NOT NULL ,
 `reject_by` VARCHAR( 50 ) NOT NULL ,
 `reject_date` DATETIME NOT NULL ,
 `cancel_notes` TEXT NOT NULL ,
 `cancel_by` VARCHAR( 50 ) NOT NULL ,
 `cancel_date` DATETIME NOT NULL
);

-- 19 jul
ALTER TABLE  `outlog_details` ADD  `npb_id` INT NULL ,
ADD INDEX (  `npb_id` );


--19 jul status movement dan disposal
INSERT INTO `famsys`.`movement_statuses` (`id`, `name`) VALUES ('9', 'Archive');
INSERT INTO `famsys`.`disposal_statuses` (`id`, `name`) VALUES ('8', 'Archive');



-- 20 jul
ALTER TABLE  `npb_details` CHANGE  `price_cur`  `price_cur` DECIMAL( 20, 2 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `delivery_order_details` CHANGE  `vat_cur`  `vat_cur` DECIMAL( 20, 4 ) NOT NULL DEFAULT  '0.0000';



-- panjang field code move detail
ALTER TABLE  `movement_details` CHANGE  `code`  `code` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE  `import_asset_details` ADD  `year` INT NOT NULL AFTER  `date_of_purchase`;
ALTER TABLE  `import_assets` ADD  `year` INT NOT NULL AFTER  `date_of_purchase`;

-- daily penalty di pos
ALTER TABLE  `pos` ADD  `daily_penalty` DECIMAL( 20, 5 ) NOT NULL DEFAULT  '0';