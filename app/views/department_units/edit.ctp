<div class="departmentUnits form">
<?php echo $this->Form->create('DepartmentUnit');?>
	<fieldset>
 		<legend><?php __('Edit Department Unit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('department_id');
		echo $this->Form->input('department_sub_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DepartmentUnit.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DepartmentUnit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Department Units', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Department Subs', true), array('controller' => 'department_subs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department Sub', true), array('controller' => 'department_subs', 'action' => 'add')); ?> </li>
	</ul>
</div>