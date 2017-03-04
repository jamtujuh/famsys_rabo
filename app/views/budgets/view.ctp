<div class="budgets view">
<h2><?php  __('Budget');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $budget['Budget']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($budget['Department']['name'], array('controller' => 'departments', 'action' => 'view', $budget['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Budget'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($budget['Budget']['budget']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Realization'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php  echo $this->Number->format($budget['Budget']['realization']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Realization'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php  echo $this->Number->format( $budget['Budget']['budget'] - $budget['Budget']['realization']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $budget['Budget']['year']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $budget['Budget']['notes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Budget', true), array('action' => 'edit', $budget['Budget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Budget', true), array('action' => 'delete', $budget['Budget']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $budget['Budget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Budgets', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Budget', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>
