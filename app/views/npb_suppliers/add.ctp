<div class="npbSuppliers form">
<?php echo $this->Form->create('NpbSupplier');?>
	<fieldset>
 		<legend><?php __('Add Npb Supplier'); ?></legend>
	<?php
		echo $this->Form->input('npb_id', array('value'=>$this->Session->read('Npb.id'), 'readonly'=>true));
		echo $this->Form->input('Npb.no', array('readonly'=>true,'value'=>$npb['Npb']['no']) );
		echo $this->Form->input('supplier_id', array('options'=>$suppliers));
		echo $this->Form->input('description', array('style'=>'width:98%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Npb Suppliers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>