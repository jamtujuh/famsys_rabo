<div class="budgets form">
<?php echo $this->Form->create('Budget');?>
	<fieldset>
 		<legend><?php __('Edit Budget'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('budget');
		echo $this->Form->input('realization');
		echo $this->Form->input('year');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Budget.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Budget.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Budgets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>