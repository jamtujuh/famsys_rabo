<div class="inlogStatuses form">
<?php echo $this->Form->create('InlogStatus');?>
	<fieldset>
 		<legend><?php __('Edit Inlog Status'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('InlogStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('InlogStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Inlog Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('controller' => 'inlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add')); ?> </li>
	</ul>
</div>