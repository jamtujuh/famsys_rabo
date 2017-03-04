<div class="disposalTypes form">
<?php echo $this->Form->create('DisposalType');?>
	<fieldset>
 		<legend><?php __('Edit Disposal Type'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DisposalType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DisposalType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Disposal Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Disposals', true), array('controller' => 'disposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal', true), array('controller' => 'disposals', 'action' => 'add')); ?> </li>
	</ul>
</div>