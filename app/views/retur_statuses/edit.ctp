<div class="returStatuses form">
<?php echo $this->Form->create('ReturStatus');?>
	<fieldset>
 		<legend><?php __('Edit Retur Status'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ReturStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ReturStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Retur Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Returs', true), array('controller' => 'returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add')); ?> </li>
	</ul>
</div>