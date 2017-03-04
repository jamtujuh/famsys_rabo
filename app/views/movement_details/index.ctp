<div class="movementDetails index">
	<h2><?php __('Movement Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('movement_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($movementDetails as $movementDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($movementDetail['Movement']['no'], array('controller' => 'movements', 'action' => 'view', $movementDetail['Movement']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($movementDetail['AssetDetail']['name'], array('controller' => 'assets', 'action' => 'view', $movementDetail['AssetDetail']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $movementDetail['MovementDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $movementDetail['MovementDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $movementDetail['MovementDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $movementDetail['MovementDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Movement Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Movements', true), array('controller' => 'movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movement', true), array('controller' => 'movements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset', true), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>