<div class="budgets index">
	<h2><?php __('Budgets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('budget');?></th>
			<th><?php echo $this->Paginator->sort('realization');?></th>
			<th><?php echo $this->Paginator->sort('balance');?></th>
			<th><?php echo $this->Paginator->sort('year');?></th>
			<th><?php echo $this->Paginator->sort('notes');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($budgets as $budget):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $budget['Budget']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($budget['Department']['name'], array('controller' => 'departments', 'action' => 'view', $budget['Department']['id'])); ?>
		</td>
		<td class="number"><?php echo $this->Number->format($budget['Budget']['budget']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($budget['Budget']['realization']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($budget['Budget']['budget'] - $budget['Budget']['realization']); ?>&nbsp;</td>
		<td><?php echo $budget['Budget']['year']; ?>&nbsp;</td>
		<td><?php echo $budget['Budget']['notes']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $budget['Budget']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $budget['Budget']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $budget['Budget']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $budget['Budget']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Budget', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>