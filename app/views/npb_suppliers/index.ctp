<div class="npbSuppliers index">
	<h2><?php __('Npb Suppliers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('npb_id');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('selected');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($npbSuppliers as $npbSupplier):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $npbSupplier['NpbSupplier']['id']; ?>&nbsp;</td>
		<td><?php echo $npbSupplier['NpbSupplier']['npb_id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($npbSupplier['Npb']['id'], array('controller' => 'npbs', 'action' => 'view', $npbSupplier['Npb']['id'])); ?>
		</td>
		<td><?php echo $npbSupplier['NpbSupplier']['selected']; ?>&nbsp;</td>
		<td><?php echo $npbSupplier['NpbSupplier']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $npbSupplier['NpbSupplier']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $npbSupplier['NpbSupplier']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $npbSupplier['NpbSupplier']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbSupplier['NpbSupplier']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Npb Supplier', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>