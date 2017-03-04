<div class="budgets form">
<?php echo $this->Form->create('Budget');?>
	<fieldset>
 		<legend><?php __('Add Budget'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Budgets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>