<div class="departmentUnits index">
	<h2><?php __('Department Units');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('department_sub_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($departmentUnits as $departmentUnit):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $departmentUnit['DepartmentUnit']['code']; ?>&nbsp;</td>
		<td><?php echo $departmentUnit['DepartmentUnit']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($departmentUnit['Department']['name'], array('controller' => 'departments', 'action' => 'view', $departmentUnit['Department']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($departmentUnit['DepartmentSub']['name'], array('controller' => 'department_subs', 'action' => 'view', $departmentUnit['DepartmentSub']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $departmentUnit['DepartmentUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $departmentUnit['DepartmentUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $departmentUnit['DepartmentUnit']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $departmentUnit['DepartmentUnit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Unit', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Department', true), array('controller' => 'department_subs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'department_subs', 'action' => 'add')); ?> </li>
	</ul>
</div>