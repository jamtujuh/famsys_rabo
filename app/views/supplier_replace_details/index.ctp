<div class="returDetails index">
	<h2><?php __('Retur Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('retur_id');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('posting');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($returDetails as $returDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $returDetail['ReturDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($returDetail['Retur']['id'], array('controller' => 'returs', 'action' => 'view', $returDetail['Retur']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($returDetail['Item']['name'], array('controller' => 'items', 'action' => 'view', $returDetail['Item']['id'])); ?>
		</td>
		<td><?php echo $returDetail['ReturDetail']['qty']; ?>&nbsp;</td>
		<td><?php echo $returDetail['ReturDetail']['price']; ?>&nbsp;</td>
		<td><?php echo $returDetail['ReturDetail']['amount']; ?>&nbsp;</td>
		<td><?php echo $returDetail['ReturDetail']['posting']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $returDetail['ReturDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $returDetail['ReturDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $returDetail['ReturDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $returDetail['ReturDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Retur Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Returs', true), array('controller' => 'returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>