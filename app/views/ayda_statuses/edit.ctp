<div class="aydaStatuses form">
<?php echo $this->Form->create('AydaStatus');?>
	<fieldset>
 		<legend><?php __('Edit Ayda Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nama');
		echo $this->Form->input('low');
		echo $this->Form->input('high');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('AydaStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('AydaStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ayda Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Aydas', true), array('controller' => 'aydas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda', true), array('controller' => 'aydas', 'action' => 'add')); ?> </li>
	</ul>
</div>