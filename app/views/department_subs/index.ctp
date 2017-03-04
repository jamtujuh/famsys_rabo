<div class="departmentSubs index">
	<h2><?php __('Department Subs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($departmentSubs as $departmentSub):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $departmentSub['DepartmentSub']['code']; ?>&nbsp;</td>
		<td><?php echo $departmentSub['DepartmentSub']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($departmentSub['Department']['name'], array('controller' => 'departments', 'action' => 'view', $departmentSub['Department']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $departmentSub['DepartmentSub']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $departmentSub['DepartmentSub']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $departmentSub['DepartmentSub']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $departmentSub['DepartmentSub']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Department', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'department_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'department_units', 'action' => 'add')); ?> </li>
	</ul>
</div>