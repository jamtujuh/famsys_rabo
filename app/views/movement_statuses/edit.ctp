<div class="movementStatuses form">
<?php echo $this->Form->create('MovementStatus');?>
	<fieldset>
 		<legend><?php __('Edit Movement Status'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MovementStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MovementStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Movement Statuses', true), array('action' => 'index'));?></li>
	</ul>
</div>