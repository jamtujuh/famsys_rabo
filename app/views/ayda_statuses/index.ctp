<div class="aydaStatuses index">
	<h2><?php __('Ayda Statuses');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nama');?></th>
			<th><?php echo $this->Paginator->sort('low');?></th>
			<th><?php echo $this->Paginator->sort('high');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($aydaStatuses as $aydaStatus):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $aydaStatus['AydaStatus']['id']; ?>&nbsp;</td>
		<td><?php echo $aydaStatus['AydaStatus']['nama']; ?>&nbsp;</td>
		<td><?php echo $aydaStatus['AydaStatus']['low']; ?>&nbsp;</td>
		<td><?php echo $aydaStatus['AydaStatus']['high']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $aydaStatus['AydaStatus']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $aydaStatus['AydaStatus']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $aydaStatus['AydaStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $aydaStatus['AydaStatus']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ayda Status', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Aydas', true), array('controller' => 'aydas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ayda', true), array('controller' => 'aydas', 'action' => 'add')); ?> </li>
	</ul>
</div>