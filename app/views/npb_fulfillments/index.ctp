<div class="npbFulfillments index">
	<h2><?php __('Npb Fulfillments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('descr');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($npbFulfillments as $npbFulfillment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $npbFulfillment['NpbFulfillment']['id']; ?>&nbsp;</td>
		<td><?php echo $npbFulfillment['NpbFulfillment']['name']; ?>&nbsp;</td>
		<td><?php echo $npbFulfillment['NpbFulfillment']['descr']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $npbFulfillment['NpbFulfillment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $npbFulfillment['NpbFulfillment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $npbFulfillment['NpbFulfillment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbFulfillment['NpbFulfillment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Npb Fulfillment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
	</ul>
</div>