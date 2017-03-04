ALTER TABLE `assets` CHANGE `kd_luar_tanggal` `kd_luar_tanggal` DATE NULL DEFAULT '0000-00-00';
ALTER TABLE `asset_details` CHANGE `kd_luar_tanggal` `kd_luar_tanggal` DATE NULL DEFAULT '0000-00-00';
ALTER TABLE `asset_details` CHANGE `date_of_purchase` `date_of_purchase` DATE NULL DEFAULT '0000-00-00';
ALTER TABLE `delivery_orders` CHANGE `po_id` `po_id` INT(11) NULL, CHANGE `no` `no` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `do_date` `do_date` DATE NULL, CHANGE `delivery_date` `delivery_date` DATE NULL, CHANGE `supplier_id` `supplier_id` INT(11) NULL, CHANGE `delivery_order_status_id` `delivery_order_status_id` INT(11) NULL, CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `description` `description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `convert_invoice` `convert_invoice` INT(11) NULL DEFAULT '0', CHANGE `created` `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `approval_info` `approval_info` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `billing_address` `billing_address` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `shipping_address` `shipping_address` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `rp_rate` `rp_rate` DECIMAL(20,2) NULL, CHANGE `app[...];
ALTER TABLE `invoices` CHANGE `description` `description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `po_no` `po_no` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `paid_bank_name` `paid_bank_name` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `paid_bank_account_no` `paid_bank_account_no` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `paid_bank_account_name` `paid_bank_account_name` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `paid_bank_account_type_id` `paid_bank_account_type_id` INT(11) NULL, CHANGE `sub_total` `sub_total` DECIMAL(20,2) NULL, CHANGE `discount` `discount` DECIMAL(20,2) NULL, CHANGE `after_disc` `after_disc` DECIMAL(20,2) NULL, CHANGE `wht_total` `wht_total` DECIMAL(20,2) NULL, CHANGE `vat_total` `vat_total` DECIMAL(20,2) NULL, CHANGE `total` `total` DECIMAL(20,2) NULL, CHANGE `billing_address` `billing_address` TEXT CHARACTER SET latin1 COL[...];
ALTER TABLE `invoice_payments` CHANGE `no` `no` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `term_no` `term_no` INT( 11 ) NULL ,
CHANGE `term_percent` `term_percent` DECIMAL( 10, 2 ) NULL ,
CHANGE `date_due` `date_due` DATE NULL ,
CHANGE `date_paid` `date_paid` DATE NULL ,
CHANGE `amount_due` `amount_due` DECIMAL( 20, 2 ) NULL ,
CHANGE `amount_paid` `amount_paid` DECIMAL( 20, 2 ) NULL ,
CHANGE `amount_invoice` `amount_invoice` DECIMAL( 20, 2 ) NULL ;

ALTER TABLE `journal_transactions` CHANGE `date` `date` DATE NULL ,
CHANGE `account_id` `account_id` INT( 10 ) UNSIGNED NULL ,
CHANGE `journal_position_id` `journal_position_id` INT( 10 ) UNSIGNED NULL ,
CHANGE `department_id` `department_id` INT( 10 ) UNSIGNED NULL ,
CHANGE `posting_date` `posting_date` DATETIME NULL ,
CHANGE `account_code` `account_code` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `notes` `notes` VARCHAR( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `source` `source` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `doc_id` `doc_id` INT( 11 ) NULL ,
CHANGE `journal_template_id` `journal_template_id` INT( 11 ) NULL ;

ALTER TABLE `movements` CHANGE `doc_date` `doc_date` DATE NULL ,
CHANGE `no` `no` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `created_by` `created_by` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `notes` `notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `movement_status_id` `movement_status_id` VARCHAR( 40 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `posting` `posting` TINYINT( 1 ) NULL ,
CHANGE `reject_notes` `reject_notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `reject_by` `reject_by` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `reject_date` `reject_date` DATETIME NULL ,
CHANGE `cancel_notes` `cancel_notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `cancel_by` `cancel_by` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `cancel_date` `cancel_date` DATETIME NULL;

ALTER TABLE `npbs` CHANGE `no` `no` VARCHAR(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `npb_date` `npb_date` DATE NULL, CHANGE `department_id` `department_id` INT(11) NULL, CHANGE `department_sub_id` `department_sub_id` INT(11) NULL, CHANGE `department_unit_id` `department_unit_id` INT(11) NULL, CHANGE `req_date` `req_date` DATE NULL, CHANGE `npb_status_id` `npb_status_id` INT(11) NULL, CHANGE `request_type_id` `request_type_id` INT(11) NULL, CHANGE `notes` `notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `created_by` `created_by` VARCHAR(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `created_date` `created_date` DATETIME NULL, CHANGE `reject_notes` `reject_notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `reject_by` `reject_by` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `reject_date` `reject_date` DATETIME NULL, CHANGE `cancel_notes` `cancel_notes` TEXT CHARACTER SET lati[...] ;

ALTER TABLE `npb_details` CHANGE `item_id` `item_id` INT( 11 ) NULL ,
CHANGE `rp_rate` `rp_rate` DECIMAL( 20, 2 ) NULL ,
CHANGE `date_finish` `date_finish` DATE NULL ;

ALTER TABLE `periode` CHANGE `tgawal` `tgawal` DATE NULL DEFAULT '0000-00-00',
CHANGE `tgakhir` `tgakhir` DATE NULL DEFAULT '0000-00-00',
CHANGE `bulan` `bulan` INT( 10 ) UNSIGNED NULL DEFAULT '0';

ALTER TABLE `pos` CHANGE `po_status_id` `po_status_id` INT(11) NULL, CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `description` `description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `created` `created` DATETIME NULL, CHANGE `approval_info` `approval_info` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `vat_base_cur` `vat_base_cur` DECIMAL(20,2) NULL, CHANGE `wht_base_cur` `wht_base_cur` DECIMAL(20,2) NULL, CHANGE `sub_total` `sub_total` DECIMAL(20,2) NULL, CHANGE `sub_total_cur` `sub_total_cur` DECIMAL(20,2) NULL, CHANGE `discount_cur` `discount_cur` DECIMAL(20,2) NULL, CHANGE `after_disc` `after_disc` DECIMAL(20,2) NULL, CHANGE `after_disc_cur` `after_disc_cur` DECIMAL(20,2) NULL, CHANGE `wht_total_cur` `wht_total_cur` DECIMAL(20,2) NULL, CHANGE `vat_total_cur` `vat_total_cur` DECIMAL(20,2) NULL, CHANGE `total_cur` `total_cur` DECIMAL(20,2) NULL, CHANGE `billing_address` `billing_address` TEXT CHARACTER SET latin1 COLLATE latin1_sw[...];

ALTER TABLE `po_payments` CHANGE `date_due` `date_due` DATE NULL ,
CHANGE `date_paid` `date_paid` DATE NULL ,
CHANGE `description` `description` TINYTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `po_payments` CHANGE `term_no` `term_no` INT( 11 ) NOT NULL DEFAULT '0',
CHANGE `term_percent` `term_percent` DECIMAL( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `amount_due` `amount_due` DECIMAL( 20, 2 ) NOT NULL DEFAULT '0',
CHANGE `amount_paid` `amount_paid` DECIMAL( 20, 2 ) NOT NULL DEFAULT '0',
CHANGE `amount_po` `amount_po` DECIMAL( 20, 2 ) NOT NULL DEFAULT '0';

ALTER TABLE `purchases` CHANGE `doc_no` `doc_no` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `warranty_name` `warranty_name` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `warranty_year` `warranty_year` INT( 3 ) NULL ,
CHANGE `supplier_id` `supplier_id` INT( 11 ) NULL ,
CHANGE `voucher_no` `voucher_no` VARCHAR( 15 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
CHANGE `sup_tanggal` `sup_tanggal` DATE NULL DEFAULT '0000-00-00',
CHANGE `cancel_notes` `cancel_notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `cancel_by` `cancel_by` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `cancel_date` `cancel_date` DATETIME NULL ,
CHANGE `reject_notes` `reject_notes` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `reject_by` `reject_by` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `reject_date` `reject_date` DATETIME NULL ;

ALTER TABLE `purchases` CHANGE `pos_ting` `pos_ting` CHAR( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'N',
CHANGE `date_of_purchase` `date_of_purchase` DATE NULL DEFAULT '0000-00-00',
CHANGE `warranty_date` `warranty_date` DATE NULL DEFAULT '0000-00-00',
CHANGE `kd_luar_tanggal` `kd_luar_tanggal` DATE NULL DEFAULT '0000-00-00';

