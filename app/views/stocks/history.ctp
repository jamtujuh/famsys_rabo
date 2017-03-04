<div class="stocks index">
</div>
<div class="related">
	<h2><?php __('Stocks');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('item_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('outlog_id');?></th>
			<th><?php echo $this->Paginator->sort('usage_id');?></th>
			<th><?php echo $this->Paginator->sort('retur_id');?></th>
	</tr>
	<?php
	$i = 0;
	$balance = 0;
	foreach ($stocks as $stock):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $stock['Stock']['date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($stock['Item']['name'], array('controller' => 'items', 'action' => 'view', $stock['Item']['id'])); ?>
		</td>
		<td class="center"><?php echo $stock['Stock']['qty']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($stock['Stock']['price']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($stock['Stock']['amount']); ?>&nbsp;</td>
		<td class="center"><?php echo $stock['Outlog']['no']; ?>&nbsp;</td>
		<td class="center"><?php echo $stock['Usage']['no']; ?>&nbsp;</td>
		<td class="center"><?php echo $stock['Retur']['no']; ?>&nbsp;</td>
		<?php $balance += $stock['Stock']['qty']; ?>
	</tr>
<?php endforeach; ?>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="right">Balance :</td>
		<td class="center"><?php echo $balance ;?>&nbsp;</td>
	</tr>
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
