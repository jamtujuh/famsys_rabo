<div class="inlogDetails index">
	<h2><?php __('Inlog Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('inlog_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('posting');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($inlogDetails as $inlogDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $inlogDetail['InlogDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inlogDetail['Inlog']['id'], array('controller' => 'inlogs', 'action' => 'view', $inlogDetail['Inlog']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($inlogDetail['Item']['name'], array('controller' => 'items', 'action' => 'view', $inlogDetail['Item']['id'])); ?>
		</td>
		<td><?php echo $inlogDetail['InlogDetail']['qty']; ?>&nbsp;</td>
		<td><?php echo $inlogDetail['InlogDetail']['price']; ?>&nbsp;</td>
		<td><?php echo $inlogDetail['InlogDetail']['amount']; ?>&nbsp;</td>
		<td><?php echo $inlogDetail['InlogDetail']['posting']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $inlogDetail['InlogDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $inlogDetail['InlogDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $inlogDetail['InlogDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inlogDetail['InlogDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Inlog Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('controller' => 'inlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>