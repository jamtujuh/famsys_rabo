<div class="outlogDetails index">
	<h2><?php __('Outlog Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('outlog_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('posting');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($outlogDetails as $outlogDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $outlogDetail['OutlogDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($outlogDetail['Outlog']['id'], array('controller' => 'outlogs', 'action' => 'view', $outlogDetail['Outlog']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($outlogDetail['Item']['name'], array('controller' => 'items', 'action' => 'view', $outlogDetail['Item']['id'])); ?>
		</td>
		<td><?php echo $outlogDetail['OutlogDetail']['qty']; ?>&nbsp;</td>
		<td><?php echo $outlogDetail['OutlogDetail']['price']; ?>&nbsp;</td>
		<td><?php echo $outlogDetail['OutlogDetail']['amount']; ?>&nbsp;</td>
		<td><?php echo $outlogDetail['OutlogDetail']['posting']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $outlogDetail['OutlogDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $outlogDetail['OutlogDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $outlogDetail['OutlogDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $outlogDetail['OutlogDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Outlog Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>