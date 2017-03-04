<div class="supplierReturStatuses form">
<?php echo $this->Form->create('SupplierReturStatus');?>
	<fieldset>
 		<legend><?php __('Add Supplier Retur Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Supplier Retur Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Supplier Returs', true), array('controller' => 'supplier_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier Retur', true), array('controller' => 'supplier_returs', 'action' => 'add')); ?> </li>
	</ul>
</div>