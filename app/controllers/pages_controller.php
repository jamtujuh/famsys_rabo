<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/958/The-Pages-Controller
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Session');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array('Po','Npb','Invoice','Movement','Disposal','Outlog','Inlog','Retur','Usage', 
		'SupplierRetur','DeliveryOrder', 'FaImport', 'FaRetur', 'FaSupplierRetur', 'Purchase',
          'InvoicePayment', 'SupplierReplace', 'Reklass');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
		if($this->Session->read('ric.custom.password_is_expired')===true){
			$this->redirect("/users/change_password");
			exit();
		}

		$group_id=$this->Session->read('Security.permissions');
		$department_id = $this->Session->read('Userinfo.department_id');
		$username = $this->Session->read('Userinfo.username');		
		$group = $this->Session->read('Userinfo.group_id');		
		
		/****
		PO notifications
		*****/
		if($group_id == gs_group_id )
		{
			$po_notifications[status_po_draft_id] 										= $this->Po->count_by_status(status_po_draft_id);
			$po_notifications[status_po_approved_2_id] 									= $this->Po->count_by_status(status_po_approved_2_id);
			$po_notifications[status_po_finish_id] 										= $this->Po->count_by_status(status_po_finish_id);
			$po_notifications[status_po_reject_id] 										= $this->Po->count_by_status(status_po_reject_id);	
			$npb_notifications[status_npb_sent_to_gs_id] 								= $this->Npb->count_by_status(status_npb_sent_to_gs_id, $group_id, $department_id);
			$npb_notifications['count_item_for_procurement'] 							= $this->Npb->count_item_for_procurement();
			$npb_notifications['MR Compiled'] 											= $this->Npb->count_mr_point_reward_compiled(status_npb_processing_id, $group_id, $department_id);
			$invoice_notifications[status_invoice_new_id] 								= $this->Invoice->count_by_status(status_invoice_new_id);
			$invoice_notifications[status_invoice_reject_id] 							= $this->Invoice->count_by_status(status_invoice_reject_id);
			$fa_retur_notifications[status_fa_retur_branch_approved_id] 				= $this->FaRetur->count_by_status(status_fa_retur_branch_approved_id, $group_id, $department_id);
			$fa_retur_notifications[status_fa_retur_approval_by_gs_spv_id] 				= $this->FaRetur->count_by_status(status_fa_retur_approval_by_gs_spv_id, $group_id, $department_id);
			$fa_retur_notifications[status_fa_retur_processing_id] 						= $this->FaRetur->count_by_status(status_fa_retur_processing_id, $group_id, $department_id);
			$delivery_order_notifications[status_delivery_order_new_id] 				= $this->DeliveryOrder->count_by_status(status_delivery_order_new_id, $group_id);
			$delivery_order_notifications['count_status_need_invoice'] 					= $this->DeliveryOrder->count_status_need_invoice();
			$fa_supplier_retur_notifications[status_fa_supplier_retur_draft_id] 		= $this->FaSupplierRetur->count_by_status(status_fa_supplier_retur_draft_id, $group_id, $department_id);
			$fa_supplier_retur_notifications[status_fa_supplier_retur_cancel_id] 		= $this->FaSupplierRetur->count_by_status(status_fa_supplier_retur_cancel_id, $group_id, $department_id);
			$fa_supplier_retur_notifications[status_fa_supplier_retur_reject_id] 		= $this->FaSupplierRetur->count_by_status(status_fa_supplier_retur_reject_id, $group_id, $department_id);
			$fa_supplier_retur_notifications[status_fa_supplier_retur_processing_id] 	= $this->FaSupplierRetur->count_by_status(status_fa_supplier_retur_processing_id, $group_id, $department_id);
		}
		else if ($group_id == po_approval1_group_id)
		{
			$po_notifications[status_po_request_for_approval_id] 								= $this->Po->count_by_status(status_po_request_for_approval_id);
			$po_notifications[status_po_request_cancel_id] 										= $this->Po->count_by_status(status_po_request_cancel_id);
			$po_notifications[status_po_cancel_id] 												= $this->Po->count_by_status(status_po_cancel_id);
			$invoice_notifications[status_invoice_sent_to_supervisor_id] 						= $this->Invoice->count_by_status(status_invoice_sent_to_supervisor_id);
			$fa_retur_notifications[status_fa_retur_sent_to_gs_id] 								= $this->FaRetur->count_by_status(status_fa_retur_sent_to_gs_id, $group_id, $department_id);
			$delivery_order_notifications[status_delivery_order_sent_to_supervisor_id] 			= $this->DeliveryOrder->count_by_status(status_delivery_order_sent_to_supervisor_id, $group_id);
			$fa_supplier_retur_notifications[status_fa_supplier_retur_sent_to_supervisor_id] 	= $this->FaSupplierRetur->count_by_status(status_fa_supplier_retur_sent_to_supervisor_id, $group_id, $department_id);
		}
		else if ($group_id == po_approval2_group_id)
		{
			$po_notifications[status_po_approved_1_id] 										= $this->Po->count_by_status(status_po_approved_1_id);
			$po_notifications[status_po_cancel_level_1_id] 									= $this->Po->count_by_status(status_po_cancel_level_1_id);
		}
		else if ($group_id == po_approval3_group_id)
		{
			$po_notifications[status_po_approved_2_id] 										= $this->Po->count_by_status(status_po_approved_2_id);
			$po_notifications[status_po_cancel_level_2_id] 									= $this->Po->count_by_status(status_po_cancel_level_2_id);
		}
		else if ($group_id == fincon_group_id)
		{
			$po_notifications[status_po_approved_3_id] 										= $this->Po->count_by_status(status_po_approved_3_id);
			$invoice_notifications[status_invoice_sent_to_fincon_id] 						= $this->Invoice->count_by_status(status_invoice_sent_to_fincon_id);
			$invoice_notifications[status_invoice_unpaid_id] 								= $this->Invoice->count_by_status(status_invoice_unpaid_id);
			$invoice_notifications[status_invoice_paid_id] 									= $this->Invoice->count_by_status(status_invoice_paid_id);
			$movement_notifications[status_movement_processed_id] 							= $this->Movement->count_by_status(status_movement_processed_id, $group_id);
			$disposal_write_off_notifications[status_disposal_approved_by_supervisor_id] 	= $this->Disposal->count_by_status(status_disposal_approved_by_supervisor_id,type_disposal_write_off_id);
			$disposal_sales_notifications[status_disposal_approved_by_supervisor_id] 		= $this->Disposal->count_by_status(status_disposal_approved_by_supervisor_id,type_disposal_sales_id);
			$disposal_write_off_notifications[status_disposal_approved_by_fincon_id] 		= $this->Disposal->count_by_status(status_disposal_approved_by_fincon_id,type_disposal_write_off_id);
			$disposal_sales_notifications[status_disposal_approved_by_fincon_id] 			= $this->Disposal->count_by_status(status_disposal_approved_by_fincon_id,type_disposal_sales_id);
			$reklass_notifications[status_reklass_draft_id] 								= $this->Reklass->count_by_status(status_reklass_draft_id);
			$reklass_notifications[status_reklass_approve_id] 								=  $this->Reklass->count_by_status(status_reklass_approve_id);
			$outlog_notifications[status_outlog_processed_id] 								= $this->Outlog->count_by_status(status_outlog_processed_id);
			$inlog_notifications[status_inlog_processed_id] 								= $this->Inlog->count_by_status(status_inlog_processed_id);
			$fa_import_notifications[status_fa_import_approved_id] 							= $this->FaImport->count_by_status(status_fa_import_approved_id);
			$invoice_payment_notifications[status_invoice_payment_draft_id] 				= $this->InvoicePayment->count_by_status(status_invoice_payment_draft_id, $group_id);
			$invoice_payment_notifications[status_invoice_payment_journal_id] 				= $this->InvoicePayment->count_by_status(status_invoice_payment_journal_id, $group_id);
		}
		else if ($group_id == gs_spv_group_id)
		{
			$npb_notifications[status_npb_sent_to_gs_supervisor_id] = $this->Npb->count_by_status(status_npb_sent_to_gs_supervisor_id, $group_id, $department_id);		
		}
		else if ($group_id == gs_admin_group_id)
		{
			$npb_notifications[status_npb_branch_approved_id] 								= $this->Npb->count_by_status(status_npb_branch_approved_id, $group_id, $department_id);
			$npb_notifications['count_item_no_process_type'] 								= $this->Npb->count_item_no_process_type(request_type_fa_general_id);			
		}						
		else if ($group_id == it_admin_group_id)						
		{						
			$npb_notifications[status_npb_branch_approved_id] 								= $this->Npb->count_by_status(status_npb_branch_approved_id, $group_id, $department_id);
			$npb_notifications[status_npb_it_manager_approved_id] 							= $this->Npb->count_by_status(status_npb_it_manager_approved_id, $group_id, $department_id);
			$npb_notifications['count_item_no_process_type'] 								= $this->Npb->count_item_no_process_type(request_type_fa_it_id);			
		}						
		else if ($group_id == rac_group_id)						
		{						
			$npb_notifications[status_npb_sent_to_rac_id] 									= $this->Npb->count_by_status(status_npb_sent_to_rac_id, $group_id, $department_id);
			$npb_notifications[status_npb_rac_processed_id] 								= $this->Npb->count_by_status(status_npb_rac_processed_id, $group_id, $department_id);
			$npb_notifications[status_npb_processing_id] 									= $this->Npb->count_by_status(status_npb_processing_id, $group_id, $department_id);
		}
		else if ($group_id == rac_approval_group_id)
		{
			$npb_notifications['count_mr_point_reward_need_approval'] 						= $this->Npb->count_by_status(status_npb_sent_to_branch_head_id, $group_id, $department_id);
		}
		else if ($group_id == branch_head_group_id)
		{
			$npb_notifications[status_npb_sent_to_branch_head_id] 							= $this->Npb->count_by_status(status_npb_sent_to_branch_head_id, $group_id, $department_id);
			$fa_retur_notifications[status_fa_retur_sent_to_branch_head_id] 				= $this->FaRetur->count_by_status(status_fa_retur_sent_to_branch_head_id, $group_id, $department_id);
			$retur_notifications[status_retur_sent_to_branch_head_id] 						= $this->Retur->count_by_status(status_retur_sent_to_branch_head_id);
			$usage_notifications[status_usage_sent_to_branch_head_id] 						= $this->Usage->count_by_status(status_usage_sent_to_branch_head_id);
		}
		else if ($group_id == mr_aproval2_group_id)
		{
			$npb_notifications[status_npb_branch_approved_id] 								= $this->Npb->count_by_status(status_npb_branch_approved_id, $group_id, $department_id);
		}						
		else if ($group_id == mr_aproval3_group_id)						
		{						
			$npb_notifications[status_npb_approved2_id] 									= $this->Npb->count_by_status(status_npb_approved2_id, $group_id, $department_id);
		}						
		else if ($group_id == normal_user_group_id  )						
		{						
			$npb_notifications[status_npb_draft_id] 										= $this->Npb->count_by_status(status_npb_draft_id, $group_id, $department_id, $username);
			$npb_notifications[status_npb_reject_id] 										= $this->Npb->count_by_status(status_npb_reject_id, $group_id, $department_id, $username);
			$retur_notifications[status_retur_draft_id] 									= $this->Retur->count_by_status(status_retur_draft_id, $group_id, $username);
			$retur_notifications[status_retur_reject_id] 									= $this->Retur->count_by_status(status_retur_reject_id, $group_id, $username);
			$fa_retur_notifications[status_fa_retur_draft_id] 								= $this->FaRetur->count_by_status(status_fa_retur_draft_id, $group_id, $department_id, $username);
			$fa_retur_notifications[status_fa_retur_reject_id] 								= $this->FaRetur->count_by_status(status_fa_retur_reject_id, $group_id, $department_id, $username);
			$usage_notifications[status_usage_draft_id] 									= $this->Usage->count_by_status(status_usage_draft_id);
			$usage_notifications[status_usage_reject_id] 									= $this->Usage->count_by_status(status_usage_reject_id);
			$usage_notifications[status_usage_approved_id] 									= $this->Usage->count_by_status(status_usage_approved_id);
			$usage_notifications[status_usage_processed_id] 								= $this->Usage->count_by_status(status_usage_processed_id);
		}
		else if ($group_id == fa_management_group_id)
		{
			$npb_notifications[status_npb_sent_to_fa_management_id] 						= $this->Npb->count_by_status(status_npb_sent_to_fa_management_id, $group_id, $department_id);
			$npb_notifications['count_item_for_movement'] 									= $this->Npb->count_item_for_movement(request_type_fa_general_id);
			$movement_notifications[status_movement_new_id] 								= $this->Movement->count_by_status(status_movement_new_id, $group_id);
			$movement_notifications[status_movement_approved_by_supervisor_id] 				= $this->Movement->count_by_status(status_movement_approved_by_supervisor_id, $group_id);
			$movement_notifications[status_movement_reject_id] 								= $this->Movement->count_by_status(status_movement_reject_id, $group_id);
			$disposal_write_off_notifications[status_disposal_new_id] 						= $this->Disposal->count_by_status(status_disposal_new_id,type_disposal_write_off_id);
			$disposal_sales_notifications[status_disposal_new_id] 							= $this->Disposal->count_by_status(status_disposal_new_id,type_disposal_sales_id);
		
			$disposal_write_off_notifications[status_disposal_reject_id] 					= $this->Disposal->count_by_status(status_disposal_reject_id,type_disposal_write_off_id);
			$disposal_sales_notifications[status_disposal_reject_id] 						= $this->Disposal->count_by_status(status_disposal_reject_id,type_disposal_sales_id);
			$fa_import_notifications[status_fa_import_draft_id] 							= $this->FaImport->count_by_status(status_fa_import_draft_id);
			$fa_import_notifications[status_fa_import_reject_id] 							= $this->FaImport->count_by_status(status_fa_import_reject_id);
			$purchase_notifications['count_status_puchase_draft'] 							= $this->Purchase->count_status_puchase_draft(fa_management_group_id);
			$purchase_notifications[status_purchase_draft_id] 								= $this->Purchase->count_by_status(status_purchase_draft_id, $group_id);
			$purchase_notifications[status_purchase_reject_id] 								= $this->Purchase->count_by_status(status_purchase_reject_id, $group_id);
			$delivery_order_notifications[status_delivery_order_done_id] 					= $this->DeliveryOrder->count_by_status(status_delivery_order_done_id, $group_id);
			
		}
		else if ($group_id == stock_management_group_id)
		{
			$npb_notifications[status_npb_sent_to_stock_management_id] 						= $this->Npb->count_by_status(status_npb_sent_to_stock_management_id, $group_id, $department_id);
			$npb_notifications[status_npb_draft_id] 										= $this->Npb->count_by_status(status_npb_draft_id, $group_id, $department_id, $username);
			$npb_notifications[status_npb_reject_id] 										= $this->Npb->count_by_status(status_npb_reject_id, $group_id, $department_id, $username);	
			$npb_notifications['count_item_for_movement'] 									= $this->Npb->count_item_for_movement(request_type_stock_id);
			$npb_notifications['voucher_sent'] 												= $this->Npb->count_voucher_by_status(status_npb_processing_id, $group_id, $department_id);
			$npb_notifications['voucher_approved'] 											= $this->Npb->count_voucher_approved(status_npb_processing_id, $group_id, $department_id);
			$outlog_notifications[status_outlog_draft_id] 									= $this->Outlog->count_by_status(status_outlog_draft_id);
			$outlog_notifications[status_outlog_approved_id] 								= $this->Outlog->count_by_status(status_outlog_approved_id);
			$outlog_notifications[status_outlog_reject_id] 									= $this->Outlog->count_by_status(status_outlog_reject_id);
			$inlog_notifications[status_inlog_draft_id] 									= $this->Inlog->count_by_status(status_inlog_draft_id);
			$inlog_notifications[status_inlog_sent_to_stock_management_id] 					= $this->Inlog->count_by_status(status_inlog_sent_to_stock_management_id);
			$inlog_notifications[status_inlog_approved_id] 									= $this->Inlog->count_by_status(status_inlog_approved_id);
			$inlog_notifications[status_inlog_reject_id] 									= $this->Inlog->count_by_status(status_inlog_reject_id);
			$retur_notifications[status_retur_approved_by_branch_head_id] 					= $this->Retur->count_by_status(status_retur_approved_by_branch_head_id);
			$retur_notifications[status_retur_processed_id] 								= $this->Retur->count_by_status(status_retur_processed_id);
			$supplier_retur_notifications[status_supplier_retur_draft_id] 					= $this->SupplierRetur->count_by_status(status_supplier_retur_draft_id);
			$supplier_retur_notifications[status_supplier_retur_approved_id] 				= $this->SupplierRetur->count_by_status(status_supplier_retur_approved_id);
			$supplier_retur_notifications[status_supplier_retur_reject_id] 					= $this->SupplierRetur->count_by_status(status_supplier_retur_reject_id);
			$supplier_retur_notifications[status_supplier_retur_processed_id] 				= $this->SupplierRetur->count_by_status(status_supplier_retur_processed_id);
			$supplier_replace_notifications[status_supplier_replace_draft_id] 				= $this->SupplierReplace->count_by_status(status_supplier_replace_draft_id);
			$supplier_replace_notifications[status_supplier_replace_approved_id] 			= $this->SupplierReplace->count_by_status(status_supplier_replace_approved_id);
			$supplier_replace_notifications[status_supplier_replace_reject_id] 				= $this->SupplierReplace->count_by_status(status_supplier_replace_reject_id);
			$delivery_order_notifications[status_delivery_order_done_id] 					= $this->DeliveryOrder->count_by_status(status_delivery_order_done_id, $group_id);
			
		}
		else if ($group_id == stock_supervisor_group_id)
		{
			$npb_notifications[status_npb_sent_to_supervisor_id] 							= $this->Npb->count_by_status(status_npb_sent_to_supervisor_id, $group_id, $department_id);
			$npb_notifications['voucher_need_approval'] 									= $this->Npb->count_voucher_by_status(status_npb_sent_to_supervisor_id, $group_id, $department_id);
			$outlog_notifications[status_outlog_sent_to_supervisor_id] 						= $this->Outlog->count_by_status(status_outlog_sent_to_supervisor_id);
			$inlog_notifications[status_inlog_sent_to_supervisor_id] 						= $this->Inlog->count_by_status(status_inlog_sent_to_supervisor_id);
			$supplier_retur_notifications[status_supplier_retur_sent_to_supervisor_id] 		= $this->SupplierRetur->count_by_status(status_supplier_retur_sent_to_supervisor_id);
			$supplier_replace_notifications[status_supplier_replace_sent_to_supervisor_id] 	= $this->SupplierReplace->count_by_status(status_supplier_replace_sent_to_supervisor_id);
		}
		else if ($group_id == it_management_group_id)
		{
			$npb_notifications[status_npb_sent_to_it_management_id] 						= $this->Npb->count_by_status(status_npb_sent_to_it_management_id, $group_id, $department_id);
			$npb_notifications['count_item_for_movement'] 									= $this->Npb->count_item_for_movement(request_type_fa_it_id);			
			$movement_notifications[status_movement_new_id] 								= $this->Movement->count_by_status(status_movement_new_id, $group_id);
			$movement_notifications[status_movement_approved_by_supervisor_id] 				= $this->Movement->count_by_status(status_movement_approved_by_supervisor_id, $group_id);
			$movement_notifications[status_movement_reject_id] 								= $this->Movement->count_by_status(status_movement_reject_id, $group_id);
			$purchase_notifications[status_purchase_draft_id] 								= $this->Purchase->count_by_status(status_purchase_draft_id, $group_id);
			$purchase_notifications[status_purchase_reject_id] 								= $this->Purchase->count_by_status(status_purchase_reject_id, $group_id);
			$purchase_notifications['count_status_puchase_draft'] 							= $this->Purchase->count_status_puchase_draft(it_management_group_id);
			$delivery_order_notifications[status_delivery_order_done_id] 					= $this->DeliveryOrder->count_by_status(status_delivery_order_done_id, $group_id);
		}		
		else if ($group_id == fincon_supervisor_group_id)		
		{		
			$invoice_notifications[status_invoice_sent_to_fincon_supervisor_id] 			= $this->Invoice->count_by_status(status_invoice_sent_to_fincon_supervisor_id);
			$reklass_notifications[status_reklass_send_to_supervisor_id]					= $this->Reklass->count_by_status(status_reklass_send_to_supervisor_id);
			$invoice_payment_notifications[status_invoice_payment_sent_to_spv_id] 			= $this->InvoicePayment->count_by_status(status_invoice_payment_sent_to_spv_id, $group_id);
		}
		else if($group_id == fa_supervisor_group_id )
		{
			$movement_notifications[status_movement_request_for_approval_id] 				= $this->Movement->count_by_status(status_movement_request_for_approval_id, $group_id);
			$disposal_write_off_notifications[status_disposal_request_for_approval_id] 		= $this->Disposal->count_by_status(status_disposal_request_for_approval_id,type_disposal_write_off_id);
			$disposal_sales_notifications[status_disposal_request_for_approval_id] 			= $this->Disposal->count_by_status(status_disposal_request_for_approval_id,type_disposal_sales_id);
			$fa_import_notifications[status_fa_import_sent_to_supervisor_id] 				= $this->FaImport->count_by_status(status_fa_import_sent_to_supervisor_id);
			$purchase_notifications[status_purchase_sent_to_supervisor_id] 					=  $this->Purchase->count_by_status(status_purchase_sent_to_supervisor_id, $group_id);
			$purchase_notifications['count_status_puchase_sent_to_supervisor'] 				= $this->Purchase->count_status_puchase_sent_to_supervisor(fa_management_group_id);
		}
		else if ($group_id == it_supervisor_group_id)
		{
			$movement_notifications[status_movement_request_for_approval_id] 				= $this->Movement->count_by_status(status_movement_request_for_approval_id, $group_id);
			$purchase_notifications[status_purchase_sent_to_supervisor_id] 					= $this->Purchase->count_by_status(status_purchase_sent_to_supervisor_id, $group_id);
			$purchase_notifications['count_status_puchase_sent_to_supervisor'] 				= $this->Purchase->count_status_puchase_sent_to_supervisor(it_management_group_id);
		}

		/*******************************
		begin page controller
		********************************/		
		$path = func_get_args();
		//print_r($this->Session->read('Menu.main'));
		//exit();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;
		
		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout', 'po_notifications', 'npb_notifications', 'invoice_notifications', 'movement_notifications', 'disposal_write_off_notifications','disposal_sales_notifications',
			'fa_retur_notifications','outlog_notifications','inlog_notifications','retur_notifications','usage_notifications',
			'supplier_retur_notifications','delivery_order_notifications', 'reklass_notifications',
			'fa_import_notifications', 'fa_supplier_retur_notifications', 'purchase_notifications', 'supplier_replace_notifications',
                    'invoice_payment_notifications'));
			
		$this->set(compact('username', 'group_id', 'department_id'));
		
		$this->render(implode('/', $path));
		

		//temp
		/*$users = new User;
		
		$data = $users->find('list');
		
		print_r($data);*/
	}
}
