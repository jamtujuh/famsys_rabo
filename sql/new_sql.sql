--from wildan
--20110722
--DO
UPDATE  `famsys`.`delivery_order_statuses` SET  `name` =  'Draft' WHERE  `delivery_order_statuses`.`id` =1;

--menu list po,mr,invoice
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES ('463', '122', 'List PO', '/pos/index', NULL, '974');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('463', '7');

INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES ('464', '123', 'List MR', '/npbs/index', NULL, '976');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('464', '7');

INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`) VALUES ('465', '124', 'List Invoice', '/invoices/index', NULL, '978');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('465', '7');

UPDATE  `famsys`.`menus` SET  `urutan` =  '1' WHERE  `menus`.`id` =465;
UPDATE  `famsys`.`menus` SET  `urutan` =  '1' WHERE  `menus`.`id` =464;
UPDATE  `famsys`.`menus` SET  `urutan` =  '1' WHERE  `menus`.`id` =463;

--20110724(di rumah)
--purchase_statuses
CREATE TABLE  `famsys`.`purchase_statuses` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 50 ) NOT NULL ,
`desc` TEXT NULL
) ENGINE = MYISAM ;


ALTER TABLE  `purchases` ADD  `purchase_status_id` INT( 11 ) NULL;

INSERT INTO `famsys`.`purchase_statuses` (`id`, `name`, `desc`) VALUES ('1', 'Draft', NULL);
INSERT INTO `famsys`.`purchase_statuses` (`id`, `name`, `desc`) VALUES ('2', 'Sent to Supervisor', NULL);
INSERT INTO `famsys`.`purchase_statuses` (`id`, `name`, `desc`) VALUES ('3', 'Finish', NULL);
INSERT INTO `famsys`.`purchase_statuses` (`id`, `name`, `desc`) VALUES ('4', 'Reject', NULL);
INSERT INTO `famsys`.`purchase_statuses` (`id`, `name`, `desc`) VALUES ('5', 'Archive', NULL);
INSERT INTO `famsys`.`purchase_statuses` (`id`, `name`, `desc`) VALUES ('6', 'Approved', NULL);

--20110725
ALTER TABLE  `npb_details` CHANGE  `qty`  `qty` INT( 11 ) UNSIGNED NOT NULL DEFAULT  '1';
ALTER TABLE  `npb_details` CHANGE  `brand`  `brand` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `npb_details` CHANGE  `type`  `type` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `npb_details` CHANGE  `color`  `color` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE  `purchases` ADD  `cancel_notes` TEXT NOT NULL ,
ADD  `cancel_by` VARCHAR( 50 ) NOT NULL ,
ADD  `cancel_date` DATETIME NOT NULL;

ALTER TABLE  `purchases` ADD  `reject_notes` TEXT NOT NULL ,
ADD  `reject_by` VARCHAR( 50 ) NOT NULL ,
ADD  `reject_date` DATETIME NOT NULL;

UPDATE  `famsys`.`movement_statuses` SET  `name` =  'Draft' WHERE  `movement_statuses`.`id` =1;

UPDATE  `famsys`.`disposal_statuses` SET  `name` =  'Draft' WHERE  `disposal_statuses`.`id` =1;




ALTER TABLE  `po_payments` CHANGE  `term_percent`  `term_percent` DECIMAL( 10, 2 ) UNSIGNED NOT NULL;

UPDATE  `famsys`.`invoice_statuses` SET  `name` =  'Draft' WHERE  `invoice_statuses`.`id` =1;

ALTER TABLE  `po_details` CHANGE  `brand`  `brand` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `po_details` CHANGE  `color`  `color` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `po_details` CHANGE  `type`  `type` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

INSERT INTO  `famsys`.`invoice_statuses` (`id` ,`name` ,`description`)
VALUES ('30',  'Sent to Supervisor',  ''),
('40',  'Cancel',  ''),
('50',  'Reject',  ''),
('60',  'Archive',  '');

ALTER TABLE  `invoices` ADD (
 `reject_notes` TEXT NOT NULL ,
 `reject_by` VARCHAR( 50 ) NOT NULL ,
 `reject_date` DATETIME NOT NULL ,
 `cancel_notes` TEXT NOT NULL ,
 `cancel_by` VARCHAR( 50 ) NOT NULL ,
 `cancel_date` DATETIME NOT NULL
);

ALTER TABLE  `asset_details` CHANGE  `color`  `color` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `asset_details` CHANGE  `brand`  `brand` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `asset_details` CHANGE  `type`  `type` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE  `fa_retur_details` CHANGE  `brand`  `brand` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `type`  `type` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `color`  `color` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;


-- menu report total po per supplier
INSERT INTO `famsys`.`menus` (`id`, `parent_id`, `title`, `url`, `help`, `urutan`)
VALUES (490, '122', 'Total PO per Supplier Report', '/pos/total_per_supplier_report', NULL, '11');
INSERT INTO `famsys`.`groups_menus` (`menu_id`, `group_id`) VALUES ('490', '7'), ('490', '8');


-- 25 juli
CREATE TABLE  `famsys`.`invoice_payment_statuses` (
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 64 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = MYISAM ;

INSERT INTO  `famsys`.`invoice_payment_statuses` (`id` ,`name`)
VALUES ('1',  'Draft'), 
('2',  'Send To Supervisor'),
('3',  'Finish');

ALTER TABLE  `invoice_payments` ADD  `invoice_payment_status_id` INT NOT NULL DEFAULT  '1';

----------------------------------------------------------------------------------------------------------------