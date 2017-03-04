<div class="supplier_replaces form">
<?php echo $this->Form->create('SupplierReplace');?>
	<fieldset>
 		<legend><?php __('Edit Supplier Replace'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('date', array('value'=>date("Y-m-d")));
		echo $this->Form->input('department_id', array('options'=>$departments));
		echo $this->Form->input('created_at');
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SupplierReplace.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SupplierReplace.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List SupplierReplaces', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List SupplierReplace Details', true), array('controller' => 'supplier_replace_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New SupplierReplace Detail', true), array('controller' => 'supplier_replace_details', 'action' => 'add')); ?> </li>
	</ul>
</div>