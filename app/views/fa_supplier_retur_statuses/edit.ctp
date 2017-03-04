<div class="faSupplierReturStatuses form">
<?php echo $this->Form->create('FaSupplierReturStatus');?>
	<fieldset>
 		<legend><?php __('Edit Fa Supplier Retur Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FaSupplierReturStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FaSupplierReturStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fa Supplier Retur Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fa Supplier Returs', true), array('controller' => 'fa_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Supplier Retur', true), array('controller' => 'fa_returs', 'action' => 'add')); ?> </li>
	</ul>
</div>