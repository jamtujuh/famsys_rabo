<div class="npbFulfillments form">
<?php echo $this->Form->create('NpbFulfillment');?>
	<fieldset>
 		<legend><?php __('Edit Npb Fulfillment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('descr');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('NpbFulfillment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('NpbFulfillment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Npb Fulfillments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
	</ul>
</div>