<div style="text-align:right">
<?php __('Current system time:')  ?> <?php echo date('d-M-Y H:i:s')?>
</div>
<div id="home" style="height:650px;background:url(<?php echo BASE_URL ?>/img/mainmenu.png) no-repeat;background-size: 490 px;">
<div class="notification">
<h3><?php __('Notifications') ?>
</h3>
<dl>
<!--PO Notification-->
	<?php if(!empty($po_notifications[status_po_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('PO Draft',true), 
		array('controller'=>'pos', 'action'=>'index', status_po_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_request_for_approval_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Need Approval',true), 
		array('controller'=>'pos','action'=>'index', status_po_request_for_approval_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_request_for_approval_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_approved_1_id])): ?>

	<dt><?php 
		echo $this->Html->link(__('PO Need Approval Level 2',true), 
		array('controller'=>'pos','action'=>'index', status_po_approved_1_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_approved_1_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_approved_2_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Need Approval Level 3',true), 
		array('controller'=>'pos','action'=>'index', status_po_approved_2_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_approved_2_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_approved_3_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Need to be Finished',true), 
		array('controller'=>'pos','action'=>'index', status_po_approved_3_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_approved_3_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_request_cancel_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Cancel Need Approval',true), 
		array('controller'=>'pos','action'=>'index', status_po_request_cancel_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_request_cancel_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_cancel_level_1_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Cancel Need Approval Level 2',true), 
		array('controller'=>'pos','action'=>'index', status_po_cancel_level_1_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_cancel_level_1_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_cancel_level_2_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Cancel Need Approval Level 3',true), 
		array('controller'=>'pos','action'=>'index', status_po_cancel_level_2_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_cancel_level_2_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_cancel_id])) : ?>
	<dt><?php 
		echo $this->Html->link(__('PO Cancelled',true), 
		array('controller'=>'pos','action'=>'index', status_po_cancel_id)
		); ?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_cancel_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_finish_id])) : ?>
	<dt>
		<?php echo $this->Html->link(__('PO Need to be Sent',true), 
		array('controller'=>'pos', 'action'=>'index', status_po_finish_id)); 
		?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_finish_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[down_payment_unjournaled])) : ?>
	<dt>
		<?php echo $this->Html->link(__('PO Down Payment Un-Journaled',true), 
		array('controller'=>'pos', 'action'=>'index', status_po_sent_id)); 
		?>
	</dt>
	<dd>
		<?php echo $po_notifications[down_payment_unjournaled]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($po_notifications[status_po_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('PO Reject',true), 
		array('controller'=>'pos', 'action'=>'index', status_po_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $po_notifications[status_po_reject_id]?>
	</dd>	
	<?php endif; ?>
	
<!--NPB Notification-->
	<?php if(!empty($npb_notifications['count_mr_point_reward_need_approval'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Point Reward Needs Approval',true), 
		array('controller'=>'npb_details', 'action'=>'voucher_index', 3)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['count_mr_point_reward_need_approval']?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications['voucher_approved'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Point Reward Approved',true), 
		array('controller'=>'npb_details', 'action'=>'voucher_index', 50, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['voucher_approved']?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications['voucher_need_approval'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Point Reward Needs Approval',true), 
		array('controller'=>'npb_details', 'action'=>'voucher_index', 20, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['voucher_need_approval']?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications[status_npb_sent_to_rac_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Point Reward Approved',true), 
		array('controller'=>'npb_details', 'action'=>'voucher_index', status_npb_sent_to_rac_id)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_rac_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications['MR Compiled'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Point Reward Compiled',true), 
		array('controller'=>'npb_details', 'action'=>'voucher_index', status_npb_processing_id)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['MR Compiled']?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications[status_npb_sent_to_gs_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent to GS',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_gs_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_gs_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_sent_to_gs_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent for Approval',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_gs_supervisor_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_gs_supervisor_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications[status_npb_branch_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Approved Level 1/Branch Head',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_branch_approved_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_branch_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_approved2_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Approved Level 2',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_approved2_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_approved2_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_it_manager_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR IT Manager Approved',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_it_manager_approved_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_it_manager_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_sent_to_branch_head_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent for Approval',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_branch_head_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_branch_head_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Reject',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_reject_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_sent_to_fa_management_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent to FA Management',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_fa_management_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_fa_management_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_sent_to_stock_management_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent to Stock Management',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_stock_management_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_stock_management_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Draft',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent for Approval',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_supervisor_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications[status_npb_sent_to_it_management_id])) : ?>
	<dt><?php echo $this->Html->link(__('MR Sent to IT Management',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_sent_to_it_management_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications[status_npb_sent_to_it_management_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications['count_item_for_procurement'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Items for Procurement',true), 
		array('controller'=>'npb_details', 'action'=>'index', status_npb_processing_id, procurement_process_type_id)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['count_item_for_procurement']?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($npb_notifications['count_item_for_movement'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Items for Movement',true), 
		array('controller'=>'npb_details', 'action'=>'index', status_npb_processing_id, movement_process_type_id)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['count_item_for_movement']?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($npb_notifications['count_item_no_process_type'])) : ?>
	<dt><?php echo $this->Html->link(__('MR Items Outstanding',true), 
		array('controller'=>'npbs', 'action'=>'index', status_npb_processing_id, 2)); 
		?>
	</dt>
	<dd>
		<?php echo $npb_notifications['count_item_no_process_type']?>
	</dd>
	<?php endif; ?>

<!--Invoice Notification-->
	<?php if(!empty($invoice_notifications[status_invoice_new_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Draft',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_new_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_new_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($invoice_notifications[status_invoice_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Sent for Approval',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_notifications[status_invoice_sent_to_fincon_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Sent to Fincon',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_sent_to_fincon_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_sent_to_fincon_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_notifications[status_invoice_paid_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Need Posting To Journal',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_paid_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_paid_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_notifications[status_invoice_sent_to_fincon_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Sent for Approval',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_sent_to_fincon_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_sent_to_fincon_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_notifications[status_invoice_unpaid_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Unpaid',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_unpaid_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_unpaid_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_notifications[status_invoice_posted_payment_journal_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Done',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_posted_payment_journal_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_posted_payment_journal_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_notifications[status_invoice_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Reject',true), 
		array('controller'=>'invoices', 'action'=>'index', status_invoice_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_notifications[status_invoice_reject_id]?>
	</dd>
	<?php endif; ?>

<!--Movement Notification-->
	<?php if(!empty($movement_notifications[status_movement_new_id])) : ?>
	<dt><?php echo $this->Html->link(__('Movement Draft',true), 
		array('controller'=>'movements', 'action'=>'index', status_movement_new_id)); 
		?>
	</dt>
	<dd>
		<?php echo $movement_notifications[status_movement_new_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($movement_notifications[status_movement_request_for_approval_id])) : ?>
	<dt><?php echo $this->Html->link(__('Movement Request for Approval',true), 
		array('controller'=>'movements', 'action'=>'index', status_movement_request_for_approval_id)); 
		?>
	</dt>
	<dd>
		<?php echo $movement_notifications[status_movement_request_for_approval_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($movement_notifications[status_movement_approved_by_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Movement Approved by Supervisor',true), 
		array('controller'=>'movements', 'action'=>'index', status_movement_approved_by_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $movement_notifications[status_movement_approved_by_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($movement_notifications[status_movement_processed_id])) : ?>
	<dt><?php echo $this->Html->link(__('Movement Processed',true), 
		array('controller'=>'movements', 'action'=>'index', status_movement_processed_id)); 
		?>
	</dt>
	<dd>
		<?php echo $movement_notifications[status_movement_processed_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($movement_notifications[status_movement_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Movement Reject',true), 
		array('controller'=>'movements', 'action'=>'index', status_movement_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $movement_notifications[status_movement_reject_id]?>
	</dd>
	<?php endif; ?>

<!--Disposal Notification-->
	<?php if(!empty($disposal_write_off_notifications[status_disposal_new_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Draft Write Off',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_write_off_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_write_off_notifications[status_disposal_new_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_sales_notifications[status_disposal_new_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Draft Sales',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_sales_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_sales_notifications[status_disposal_new_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($disposal_write_off_notifications[status_disposal_request_for_approval_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Request for Approval Write Off',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_write_off_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_write_off_notifications[status_disposal_request_for_approval_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_sales_notifications[status_disposal_request_for_approval_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Request for Approval Sales',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_sales_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_sales_notifications[status_disposal_request_for_approval_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_write_off_notifications[status_disposal_approved_by_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Approved Write Off',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_write_off_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_write_off_notifications[status_disposal_approved_by_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_sales_notifications[status_disposal_approved_by_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Approved Sales',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_sales_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_sales_notifications[status_disposal_approved_by_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_write_off_notifications[status_disposal_approved_by_fincon_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Approved by Fincon Write Off',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_write_off_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_write_off_notifications[status_disposal_approved_by_fincon_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_sales_notifications[status_disposal_approved_by_fincon_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Approved by Fincon Sales',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_sales_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_sales_notifications[status_disposal_approved_by_fincon_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_write_off_notifications[status_disposal_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Reject Write Off',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_write_off_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_write_off_notifications[status_disposal_reject_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($disposal_sales_notifications[status_disposal_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Disposal Reject Sales',true), 
		array('controller'=>'disposals', 'action'=>'index', type_disposal_sales_id)); 
		?>
	</dt>
	<dd>
		<?php echo $disposal_sales_notifications[status_disposal_reject_id]?>
	</dd>
	<?php endif; ?>
	
<!--FA Retur Notification-->
	<?php if(!empty($fa_retur_notifications[status_fa_retur_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Draft',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_retur_notifications[status_fa_retur_sent_to_branch_head_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Sent for Approval',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_sent_to_branch_head_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_sent_to_branch_head_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_retur_notifications[status_fa_retur_branch_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Approved',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_branch_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_branch_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_retur_notifications[status_fa_retur_sent_to_gs_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Sent for Approval',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_sent_to_gs_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_sent_to_gs_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_retur_notifications[status_fa_retur_approval_by_gs_spv_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Approved',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_approval_by_gs_spv_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_approval_by_gs_spv_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_retur_notifications[status_fa_retur_processing_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Prosessing',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_processing_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_processing_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_retur_notifications[status_fa_retur_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Retur Reject',true), 
		array('controller'=>'fa_returs', 'action'=>'index', status_fa_retur_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_retur_notifications[status_fa_retur_reject_id]?>
	</dd>
	<?php endif; ?>

<!--FA Supplier Notification-->
	<?php if(!empty($fa_supplier_retur_notifications[status_fa_supplier_retur_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Supplier Retur Draft',true), 
		array('controller'=>'fa_supplier_returs', 'action'=>'index', status_fa_supplier_retur_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_supplier_retur_notifications[status_fa_supplier_retur_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_supplier_retur_notifications[status_fa_supplier_retur_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Supplier Retur Sent for Approval',true), 
		array('controller'=>'fa_supplier_returs', 'action'=>'index', status_fa_supplier_retur_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_supplier_retur_notifications[status_fa_supplier_retur_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_supplier_retur_notifications[status_fa_supplier_retur_cancel_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Supplier Retur Cancelled',true), 
		array('controller'=>'fa_supplier_returs', 'action'=>'index', status_fa_supplier_retur_cancel_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_supplier_retur_notifications[status_fa_supplier_retur_cancel_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_supplier_retur_notifications[status_fa_supplier_retur_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Supplier Retur Rejected',true), 
		array('controller'=>'fa_supplier_returs', 'action'=>'index', status_fa_supplier_retur_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_supplier_retur_notifications[status_fa_supplier_retur_reject_id]?>
	</dd>
	<?php endif; ?>	
	
	<?php if(!empty($fa_supplier_retur_notifications[status_fa_supplier_retur_processing_id])) : ?>
	<dt><?php echo $this->Html->link(__('Fa Supplier Retur Processing',true), 
		array('controller'=>'fa_supplier_returs', 'action'=>'index', status_fa_supplier_retur_processing_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_supplier_retur_notifications[status_fa_supplier_retur_processing_id]?>
	</dd>
	<?php endif; ?>		

<!--Outlog Notification-->
	<?php if(!empty($outlog_notifications[status_outlog_draft_id])) : ?>

	<dt><?php echo $this->Html->link(__('Outlog Draft',true), 
		array('controller'=>'outlogs', 'action'=>'index', status_outlog_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $outlog_notifications[status_outlog_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($outlog_notifications[status_outlog_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Outlog Sent for Approval',true), 
		array('controller'=>'outlogs', 'action'=>'index', status_outlog_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $outlog_notifications[status_outlog_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($outlog_notifications[status_outlog_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('Outlog Approved',true), 
		array('controller'=>'outlogs', 'action'=>'index', status_outlog_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $outlog_notifications[status_outlog_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($outlog_notifications[status_outlog_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Outlog Rejected',true), 
		array('controller'=>'outlogs', 'action'=>'index', status_outlog_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $outlog_notifications[status_outlog_reject_id]?>
	</dd>
	<?php endif; ?>	
	
	<?php if(!empty($outlog_notifications[status_outlog_processed_id])) : ?>
	<dt><?php echo $this->Html->link(__('Outlog Processed',true), 
		array('controller'=>'outlogs', 'action'=>'index', status_outlog_processed_id)); 
		?>
	</dt>
	<dd>
		<?php echo $outlog_notifications[status_outlog_processed_id]?>
	</dd>
	<?php endif; ?>		
<!--Reklass Notification-->	
	<?php if(!empty($reklass_notifications[status_reklass_send_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Reklass Sent for Approval',true), 
		array('controller'=>'reklasses', 'action'=>'index', status_reklass_send_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $reklass_notifications[status_reklass_send_to_supervisor_id]?>
	</dd>
	<?php endif; ?>		
	
	<?php if(!empty($reklass_notifications[status_reklass_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Reklass Draft',true), 
		array('controller'=>'reklasses', 'action'=>'index', status_reklass_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $reklass_notifications[status_reklass_draft_id]?>
	</dd>
	<?php endif; ?>		
	
	<?php if(!empty($reklass_notifications[status_reklass_approve_id])) : ?>
	<dt><?php echo $this->Html->link(__('Reklass Approved',true), 
		array('controller'=>'reklasses', 'action'=>'index', status_reklass_approve_id)); 
		?>
	</dt>
	<dd>
		<?php echo $reklass_notifications[status_reklass_approve_id]?>
	</dd>
	<?php endif; ?>		

<!--Inlog Notification-->
	<?php if(!empty($inlog_notifications[status_inlog_draft_id])) : ?>

	<dt><?php echo $this->Html->link(__('Inlog Draft',true), 
		array('controller'=>'inlogs', 'action'=>'index', status_inlog_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $inlog_notifications[status_inlog_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($inlog_notifications[status_inlog_sent_to_stock_management_id])) : ?>
	<dt><?php echo $this->Html->link(__('Inlog Sent to Stock Management',true), 
		array('controller'=>'inlogs', 'action'=>'index', status_inlog_sent_to_stock_management_id)); 
		?>
	</dt>
	<dd>
		<?php echo $inlog_notifications[status_inlog_sent_to_stock_management_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($inlog_notifications[status_inlog_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Inlog Sent for Approval',true), 
		array('controller'=>'inlogs', 'action'=>'index', status_inlog_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $inlog_notifications[status_inlog_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>	
	
	<?php if(!empty($inlog_notifications[status_inlog_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('Inlog Approved',true), 
		array('controller'=>'inlogs', 'action'=>'index', status_inlog_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $inlog_notifications[status_inlog_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($inlog_notifications[status_inlog_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Inlog Rejected',true), 
		array('controller'=>'inlogs', 'action'=>'index', status_inlog_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $inlog_notifications[status_inlog_reject_id]?>
	</dd>
	<?php endif; ?>	
	
	<?php if(!empty($inlog_notifications[status_inlog_processed_id])) : ?>
	<dt><?php echo $this->Html->link(__('Inlog Rejected',true), 
		array('controller'=>'inlogs', 'action'=>'index', status_inlog_processed_id)); 
		?>
	</dt>
	<dd>
		<?php echo $inlog_notifications[status_inlog_processed_id]?>
	</dd>
	<?php endif; ?>		

<!--Retur Notification-->
	<?php if(!empty($retur_notifications[status_retur_draft_id])) : ?>

	<dt><?php echo $this->Html->link(__('Retur Draft',true), 
		array('controller'=>'returs', 'action'=>'index', status_retur_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $retur_notifications[status_retur_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($retur_notifications[status_retur_sent_to_branch_head_id])) : ?>
	<dt><?php echo $this->Html->link(__('Retur Sent for Approval',true), 
		array('controller'=>'returs', 'action'=>'index', status_retur_sent_to_branch_head_id)); 
		?>
	</dt>
	<dd>
		<?php echo $retur_notifications[status_retur_sent_to_branch_head_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($retur_notifications[status_retur_approved_by_branch_head_id])) : ?>
	<dt><?php echo $this->Html->link(__('Retur Approved',true), 
		array('controller'=>'returs', 'action'=>'index', status_retur_approved_by_branch_head_id)); 
		?>
	</dt>
	<dd>
		<?php echo $retur_notifications[status_retur_approved_by_branch_head_id]?>
	</dd>
	<?php endif; ?>	

	<?php if(!empty($retur_notifications[status_retur_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Retur Rejected',true), 
		array('controller'=>'returs', 'action'=>'index', status_retur_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $retur_notifications[status_retur_reject_id]?>
	</dd>
	<?php endif; ?>	
	
	<?php if(!empty($retur_notifications[status_retur_processed_id])) : ?>
	<dt><?php echo $this->Html->link(__('Retur Processed',true), 
		array('controller'=>'returs', 'action'=>'index', status_retur_processed_id)); 
		?>
	</dt>
	<dd>
		<?php echo $retur_notifications[status_retur_processed_id]?>
	</dd>
	<?php endif; ?>		
	
<!--Usage Notification-->
	<?php if(!empty($usage_notifications[status_usage_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Usage Draft',true), 
		array('controller'=>'usages', 'action'=>'index', status_usage_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $usage_notifications[status_usage_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($usage_notifications[status_usage_sent_to_branch_head_id])) : ?>
	<dt><?php echo $this->Html->link(__('Usage Sent for Approval',true), 
		array('controller'=>'usages', 'action'=>'index', status_usage_sent_to_branch_head_id)); 
		?>
	</dt>
	<dd>
		<?php echo $usage_notifications[status_usage_sent_to_branch_head_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($usage_notifications[status_usage_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('Usage Approved',true), 
		array('controller'=>'usages', 'action'=>'index', status_usage_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $usage_notifications[status_usage_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($usage_notifications[status_usage_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Usage Rejected',true), 
		array('controller'=>'usages', 'action'=>'index', status_usage_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $usage_notifications[status_usage_reject_id]?>
	</dd>
	<?php endif; ?>			
	
	<?php if(!empty($usage_notifications[status_usage_processed_id])) : ?>
	<dt><?php echo $this->Html->link(__('Usage Need Posting To Journal',true), 
		array('controller'=>'usages', 'action'=>'index', status_usage_processed_id)); 
		?>
	</dt>
	<dd>
		<?php echo $usage_notifications[status_usage_processed_id]?>
	</dd>
	<?php endif; ?>	

<!--Supplier Retur Notification-->
	<?php if(!empty($supplier_retur_notifications[status_supplier_retur_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Retur Draft',true), 
		array('controller'=>'supplier_returs', 'action'=>'index', status_supplier_retur_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_retur_notifications[status_supplier_retur_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($supplier_retur_notifications[status_supplier_retur_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Retur Sent for Approval',true), 
		array('controller'=>'supplier_returs', 'action'=>'index', status_supplier_retur_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_retur_notifications[status_supplier_retur_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($supplier_retur_notifications[status_supplier_retur_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Retur Approved',true), 
		array('controller'=>'supplier_returs', 'action'=>'index', status_supplier_retur_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_retur_notifications[status_supplier_retur_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($supplier_retur_notifications[status_supplier_retur_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Retur Rejected',true), 
		array('controller'=>'supplier_returs', 'action'=>'index', status_supplier_retur_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_retur_notifications[status_supplier_retur_reject_id]?>
	</dd>
	<?php endif; ?>	
	
	<?php if(!empty($supplier_retur_notifications[status_supplier_retur_processed_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Retur Processed',true), 
		array('controller'=>'supplier_returs', 'action'=>'index', status_supplier_retur_processed_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_retur_notifications[status_supplier_retur_processed_id]?>
	</dd>
	<?php endif; ?>		
<!--Supplier Replace Notification-->
	<?php if(!empty($supplier_replace_notifications[status_supplier_replace_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Replace Draft',true), 
		array('controller'=>'supplier_replaces', 'action'=>'index', status_supplier_replace_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_replace_notifications[status_supplier_replace_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($supplier_replace_notifications[status_supplier_replace_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Replace Sent for Approval',true), 
		array('controller'=>'supplier_replaces', 'action'=>'index', status_supplier_replace_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_replace_notifications[status_supplier_replace_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($supplier_replace_notifications[status_supplier_replace_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Replace Approved',true), 
		array('controller'=>'supplier_replaces', 'action'=>'index', status_supplier_replace_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_replace_notifications[status_supplier_replace_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($supplier_replace_notifications[status_supplier_replace_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Supplier Replace Rejected',true), 
		array('controller'=>'supplier_replaces', 'action'=>'index', status_supplier_replace_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $supplier_replace_notifications[status_supplier_replace_reject_id]?>
	</dd>
	<?php endif; ?>	
	
<!--DO Notification-->
	<?php if(!empty($delivery_order_notifications[status_delivery_order_new_id])) : ?>
	<dt><?php echo $this->Html->link(__('Delivery Order Draft',true), 
		array('controller'=>'delivery_orders', 'action'=>'list_delivery_order', status_delivery_order_new_id)); 
		?>
	</dt>
	<dd>
		<?php echo $delivery_order_notifications[status_delivery_order_new_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($delivery_order_notifications[status_delivery_order_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Delivery Order Need Approval',true), 
		array('controller'=>'delivery_orders', 'action'=>'list_delivery_order', status_delivery_order_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $delivery_order_notifications[status_delivery_order_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($delivery_order_notifications[status_delivery_order_done_id])) : ?>
	<dt><?php echo $this->Html->link(__('Delivery Order Need Register',true), 
		array('controller'=>'delivery_orders', 'action'=>'list_delivery_order', status_delivery_order_done_id, 0)); 
		?>
	</dt>
	<dd>
		<?php echo $delivery_order_notifications[status_delivery_order_done_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($delivery_order_notifications['count_status_need_invoice'])) : ?>
	<dt><?php echo $this->Html->link(__('Delivery Order Need Invoice',true), 
		array('controller'=>'delivery_orders', 'action'=>'list_delivery_order', status_delivery_order_done_id, 1)); 
		?>
	</dt>
	<dd>
		<?php echo $delivery_order_notifications['count_status_need_invoice']?>
	</dd>
	<?php endif; ?>
	
<!--FA Import Notification-->
	<?php if(!empty($fa_import_notifications[status_fa_import_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('FaImport Draft',true), 
		array('controller'=>'fa_imports', 'action'=>'index', status_fa_import_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_import_notifications[status_fa_import_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_import_notifications[status_fa_import_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('FaImport Sent for Approval',true), 
		array('controller'=>'fa_imports', 'action'=>'index', status_fa_import_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_import_notifications[status_fa_import_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>

	<?php if(!empty($fa_import_notifications[status_fa_import_approved_id])) : ?>
	<dt><?php echo $this->Html->link(__('FaImport Approved',true), 
		array('controller'=>'fa_imports', 'action'=>'index', status_fa_import_approved_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_import_notifications[status_fa_import_approved_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($fa_import_notifications[status_fa_import_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('FaImport Rejected',true), 
		array('controller'=>'fa_imports', 'action'=>'index', status_fa_import_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $fa_import_notifications[status_fa_import_reject_id]?>
	</dd>
	<?php endif; ?>
	
<!--Purchase Notification-->
	<?php if(!empty($purchase_notifications[status_purchase_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Register FA Draft',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications[status_purchase_draft_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($purchase_notifications['count_status_puchase_draft']) && $this->Session->read('Security.permissions')==fa_management_group_id) : ?>
	<dt><?php echo $this->Html->link(__('Register FA non DO Draft',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_draft_id, fa_management_group_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications['count_status_puchase_draft']?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($purchase_notifications['count_status_puchase_draft']) && $this->Session->read('Security.permissions')==it_management_group_id) : ?>
	<dt><?php echo $this->Html->link(__('Register FA non DO Draft',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_draft_id, it_management_group_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications['count_status_puchase_draft']?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($purchase_notifications[status_purchase_sent_to_supervisor_id])) : ?>
	<dt><?php echo $this->Html->link(__('Register FA Sent for Approval',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_sent_to_supervisor_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications[status_purchase_sent_to_supervisor_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($purchase_notifications['count_status_puchase_sent_to_supervisor']) && $this->Session->read('Security.permissions')==fa_supervisor_group_id) : ?>
	<dt><?php echo $this->Html->link(__('Register FA non DO Sent for Approval',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_sent_to_supervisor_id, fa_management_group_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications['count_status_puchase_sent_to_supervisor']?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($purchase_notifications['count_status_puchase_sent_to_supervisor']) && $this->Session->read('Security.permissions')==it_supervisor_group_id) : ?>
	<dt><?php echo $this->Html->link(__('Register FA non DO Sent for Approval',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_sent_to_supervisor_id, it_management_group_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications['count_status_puchase_sent_to_supervisor']?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($purchase_notifications[status_purchase_reject_id])) : ?>
	<dt><?php echo $this->Html->link(__('Register FA Reject',true), 
		array('controller'=>'purchases', 'action'=>'index', status_purchase_reject_id)); 
		?>
	</dt>
	<dd>
		<?php echo $purchase_notifications[status_purchase_reject_id]?>
	</dd>
	<?php endif; ?>
      
<!-- InvoicePayment Notification-->
	<?php if(!empty($invoice_payment_notifications[status_invoice_payment_draft_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Payment Draft',true), 
		array('controller'=>'invoice_payments', 'action'=>'list_invoice_payments', status_invoice_payment_draft_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_payment_notifications[status_invoice_payment_draft_id]?>
	</dd>
	<?php endif; ?>
	<?php if(!empty($invoice_payment_notifications[status_invoice_payment_journal_id])) : ?>
	
	<dt><?php echo $this->Html->link(__('Invoice Payment Need Posting to Journal',true), 
		array('controller'=>'invoice_payments', 'action'=>'list_invoice_payments', status_invoice_payment_journal_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_payment_notifications[status_invoice_payment_journal_id]?>
	</dd>
	<?php endif; ?>
	
	<?php if(!empty($invoice_payment_notifications[status_invoice_payment_sent_to_spv_id])) : ?>
	<dt><?php echo $this->Html->link(__('Invoice Payment Sent for Approval',true), 
		array('controller'=>'invoice_payments', 'action'=>'list_invoice_payments', status_invoice_payment_sent_to_spv_id)); 
		?>
	</dt>
	<dd>
		<?php echo $invoice_payment_notifications[status_invoice_payment_sent_to_spv_id]?>
	</dd>	
	<?php endif; ?>      
</dl>
</div>
</div>