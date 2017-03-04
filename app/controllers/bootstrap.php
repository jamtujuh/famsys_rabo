<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
define('client_name' 			, 'Rabobank International');

define('admin_group_id'			, 1);
define('branch_head_group_id' 	, 2);
define('po_approval1_group_id' 	, 3);
define('po_approval2_group_id' 	, 4);
define('po_approval3_group_id' 	, 5);
define('normal_user_group_id' 	, 6);
define('gs_group_id' 			, 7);
define('fincon_group_id' 		, 8);
define('gs_spv_group_id' 		, 9);

define('status_npb_draft_id' 				, 'draft');
define('status_npb_branch_approved_id' 		, 'branch_approved');
define('status_npb_sent_hq_id' 				, 'sent_hq');
define('status_npb_sent_to_branch_head_id' 	, 'sent_to_branch_head');
define('status_npb_reject_id' 				, 'reject');

define('status_po_draft_id'					, 1);
define('status_po_request_for_approval_id'	, 2);
define('status_po_approved_1_id'			, 3);
define('status_po_approved_2_id'			, 4);
define('status_po_approved_3_id'			, 5);
define('status_po_finish_id'				, 6);
define('status_po_sent_id'					, 7);
define('status_po_reject_id'				, 8);

define('status_invoice_new_id'				, 1);
define('status_invoice_unpaid_id'			, 2);
define('status_invoice_paid_id'				, 3);
define('status_invoice_registered_id'		, 4);
define('status_invoice_posted_receival_journal_id'	, 5);
define('status_invoice_posted_payment_journal_id'	, 6);

define('status_movement_new_id'						, 1);
define('status_movement_request_for_approval_id'	, 2);
define('status_movement_approved_by_supervisor_id'	, 3);
define('status_movement_approved_by_fincon_id'		, 4);
define('status_movement_reject_id'					, 5);
define('status_movement_finish_id'					, 6);
define('status_movement_journal_posted_id'			, 7);

define('status_disposal_new_id'						, 1);
define('status_disposal_request_for_approval_id'	, 2);
define('status_disposal_approved_by_supervisor_id'	, 3);
define('status_disposal_approved_by_fincon_id'		, 4);
define('status_disposal_reject_id'					, 5);
define('status_disposal_finish_id'					, 6);
define('status_disposal_posted_journal_id'			, 7);

define('type_disposal_write_off_id'					, 1);
define('type_disposal_sales_id'						, 2);

define('journal_group_receival_id' 			, 1);
define('journal_group_movement_id' 			, 2);
define('journal_group_write_off_id' 		, 3);
define('journal_group_payment_id' 			, 4);
define('journal_group_amortize_id' 			, 5);
define('journal_group_distribute_hq_branch_id' 	, 6);
define('journal_group_distribute_hq_unit_id' 	, 7);
define('journal_group_sales_id' 				, 8);

define('npb_fulfillment_po_id' 					, 1);
define('npb_fulfillment_movement_id' 			, 2);

define('account_type_accum_dep_id'				,1);
define('account_type_acquisition_price_id'		,2);
define('account_type_fa_sales_profit_id'		,3);
define('account_type_fa_sales_lost_id'			,4);
define('account_type_rab_id'					,5);
define('account_type_depreciation_cost_id'		,6);
define('account_type_source_dept_id'			,7);
define('account_type_dest_dept_id'				,8);
define('account_type_non_operational_cost_id'	,9);
define('account_type_supplier_payable_id'		,10);
define('account_type_fa_disposal_profit_id'		,11);
define('account_type_fa_disposal_lost_id'		,12);
