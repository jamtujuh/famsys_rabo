<div class="departmentUnits view">
<h2><?php  __('Department Unit');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departmentUnit['DepartmentUnit']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departmentUnit['DepartmentUnit']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($departmentUnit['Department']['name'], array('controller' => 'departments', 'action' => 'view', $departmentUnit['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department Sub'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($departmentUnit['DepartmentSub']['name'], array('controller' => 'department_subs', 'action' => 'view', $departmentUnit['DepartmentSub']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $departmentUnit['DepartmentUnit']['name']; ?>
			&nbsp;
		</dd>
		
		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Department Unit', true), array('action' => 'edit', $departmentUnit['DepartmentUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Department Unit', true), array('action' => 'delete', $departmentUnit['DepartmentUnit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $departmentUnit['DepartmentUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Department Units', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department Unit', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Department Subs', true), array('controller' => 'department_subs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department Sub', true), array('controller' => 'department_subs', 'action' => 'add')); ?> </li>
	</ul>
</div>
