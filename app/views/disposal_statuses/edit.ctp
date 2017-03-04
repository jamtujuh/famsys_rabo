<div class="disposalStatuses form">
<?php echo $this->Form->create('DisposalStatus');?>
	<fieldset>
 		<legend><?php __('Edit Disposal Status'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DisposalStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DisposalStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Disposal Statuses', true), array('action' => 'index'));?></li>
	</ul>
</div>