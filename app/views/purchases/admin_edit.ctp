<div class="purchases form">
<?php echo $this->Form->create('Purchase');?>
	<fieldset>
 		<legend><?php __('Admin Edit Purchase'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tanggal');
		echo $this->Form->input('warranty_id');
		echo $this->Form->input('id_requester');
		echo $this->Form->input('department_id');
		echo $this->Form->input('supplier_id');
		echo $this->Form->input('invoice_no');
		echo $this->Form->input('po_no');
		echo $this->Form->input('periode');
		echo $this->Form->input('serial_no');
		echo $this->Form->input('voucher_no');
		echo $this->Form->input('doc_total');
		echo $this->Form->input('doc_rup');
		echo $this->Form->input('sup_tanggal');
		echo $this->Form->input('sup_vendor_no');
		echo $this->Form->input('warranty_card');
		echo $this->Form->input('pos_ting');
		echo $this->Form->input('date_of_purchase');
		echo $this->Form->input('warranty_date');
		echo $this->Form->input('kd_luar_tanggal');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Purchase.purchase_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Purchase.purchase_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Warranties', true), array('controller' => 'warranties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warranty', true), array('controller' => 'warranties', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requesters', true), array('controller' => 'requesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requester', true), array('controller' => 'requesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>