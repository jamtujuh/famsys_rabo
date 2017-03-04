<div class="faReturStatuses form">
<?php echo $this->Form->create('ReklasStatus');?>
	<fieldset>
 		<legend><?php __('Edit Reklas Status'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ReklasStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ReklasStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reklas Statuses', true), array('action' => 'index'));?></li>
	</ul>
</div>