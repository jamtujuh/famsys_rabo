<div class="disposalDetails index">
	<h2><?php __('Disposal Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('disposal_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_detail_id');?></th>
			<th><?php echo $this->Paginator->sort('sales_amount');?></th>
			<th><?php echo $this->Paginator->sort('loss_profit_amount');?></th>
			<th><?php echo $this->Paginator->sort('notes');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($disposalDetails as $disposalDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $disposalDetail['DisposalDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($disposalDetail['Disposal']['no'], array('controller' => 'disposals', 'action' => 'view', $disposalDetail['Disposal']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($disposalDetail['AssetDetail']['name'], array('controller' => 'asset_details', 'action' => 'view', $disposalDetail['AssetDetail']['id'])); ?>
		</td>
		<td><?php echo $disposalDetail['DisposalDetail']['sales_amount']; ?>&nbsp;</td>
		<td><?php echo $disposalDetail['DisposalDetail']['loss_profit_amount']; ?>&nbsp;</td>
		<td><?php echo $disposalDetail['DisposalDetail']['notes']; ?>&nbsp;</td>
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
