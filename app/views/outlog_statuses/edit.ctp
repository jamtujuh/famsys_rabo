<div class="outlogStatuses form">
<?php echo $this->Form->create('OutlogStatus');?>
	<fieldset>
 		<legend><?php __('Edit Outlog Status'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('OutlogStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('OutlogStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Outlog Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
	</ul>
</div>