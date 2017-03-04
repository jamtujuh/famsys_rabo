<div class="processTypes form">
<?php echo $this->Form->create('ProcessType');?>
	<fieldset>
 		<legend><?php __('Edit Process Type'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ProcessType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ProcessType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Process Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npb Details', true), array('controller' => 'npb_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb Detail', true), array('controller' => 'npb_details', 'action' => 'add')); ?> </li>
	</ul>
</div>