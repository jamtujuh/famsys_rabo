<div class="faReturDetails index">
	<h2><?php __('Fa Retur Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fa_retur_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_detail_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('serial_no');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('notes');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($faReturDetails as $faReturDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $faReturDetail['FaReturDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($faReturDetail['FaRetur']['no'], array('controller' => 'fa_returs', 'action' => 'view', $faReturDetail['FaRetur']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($faReturDetail['AssetDetail']['name'], array('controller' => 'asset_details', 'action' => 'view', $faReturDetail['AssetDetail']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($faReturDetail['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $faReturDetail['AssetCategory']['id'])); ?>
		</td>
		<td><?php echo $faReturDetail['FaReturDetail']['brand']; ?>&nbsp;</td>
		<td><?php echo $faReturDetail['FaReturDetail']['type']; ?>&nbsp;</td>
		<td><?php echo $faReturDetail['FaReturDetail']['color']; ?>&nbsp;</td>
		<td><?php echo $faReturDetail['FaReturDetail']['serial_no']; ?>&nbsp;</td>
		<td><?php echo $faReturDetail['FaReturDetail']['date_of_purchase']; ?>&nbsp;</td>
		<td><?php echo $faReturDetail['FaReturDetail']['notes']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $faReturDetail['FaReturDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $faReturDetail['FaReturDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $faReturDetail['FaReturDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faReturDetail['FaReturDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fa Retur Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fa Returs', true), array('controller' => 'fa_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Retur', true), array('controller' => 'fa_returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller' => 'asset_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Detail', true), array('controller' => 'asset_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>