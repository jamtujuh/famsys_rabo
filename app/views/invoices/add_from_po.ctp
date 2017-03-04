<div class="invoices form">
<?php echo $this->Form->create('Invoice');?>
	<fieldset>
 		<legend><?php __('Add Invoice From PO'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text'));
		echo $this->Form->input('invdate');
		echo $this->Form->input('supplier_id', array('options'=>$suppliers, 'value'=>$po['Po']['supplier_id']));
		echo $this->Form->input('department_id', array('options'=>$departments, 'value'=>$po['Po']['department_id']));
		echo $this->Form->input('description', array('style'=>'width:98%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoice Details', true), array('controller' => 'invoice_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice Detail', true), array('controller' => 'invoice_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
