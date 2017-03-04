<div class="departmentSubs form">
<?php echo $this->Form->create('DepartmentSub');?>
	<fieldset>
 		<legend><?php __('Add Department Sub'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Department Subs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Department Units', true), array('controller' => 'department_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department Unit', true), array('controller' => 'department_units', 'action' => 'add')); ?> </li>
	</ul>
</div>