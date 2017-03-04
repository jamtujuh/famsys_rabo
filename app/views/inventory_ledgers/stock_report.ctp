<div id="moduleName"><?php echo 'REPORTS > Stock > Stock Report'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $form->create('InventoryLedger', array('action' => 'stock_report'));?>
<fieldset>
	<legend><?php __('Stock Report')?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Stock Filter') ?></legend>
		<?php echo $form->input('asset_category_id', array('value'=>$asset_category, 'options'=>$assetCategories, 'empty'=>'all')); ?>
		<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form->month ("filter.month", $this->params ["pass"]["filter.month"], array (), false); ?> 
		&nbsp;<?php echo $form->year ("filter.year", 1991, 2031, $this->params ["pass"]["filter.year"], array (), false); ?>
	</fieldset>	
		<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
		<?php echo $this->Form->submit('Refresh') ?>
		<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Inventory Movement Report', true), array('controller' => 'inventory_ledgers', 'action' => 'movement_report')); ?> </li>
		<li><?php echo $this->Html->link(__('Inventory Inlog Report', true), array('controller' => 'inventory_ledgers', 'action' => 'in_recap_report')); ?> </li>
		<li><?php echo $this->Html->link(__('Inventory Outlog Report', true), array('controller' => 'inventory_ledgers', 'action' => 'out_recap_report')); ?> </li>
	</ul>
</div>
</div>

<div class="InventoryLedger related">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('unit');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
	</tr>
	<?php
	$i = 0;
	$total=0;
	foreach ($inventoryLedgers as $inventoryLedger):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $inventoryLedger['InventoryLedger']['date']; ?>&nbsp;</td>
		<td class="left"><?php echo $inventoryLedger['Item']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($items[$inventoryLedger['InventoryLedger']['item_id']], array('controller' => 'items', 'action' => 'view', $inventoryLedger['Item']['id'])); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Number->format($inventoryLedger['InventoryLedger']['qty']); ?>&nbsp;</td>
		<td class="left"><?php echo $units[$inventoryLedger['Item']['unit_id']]; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($inventoryLedger['InventoryLedger']['price'], 2); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($inventoryLedger['InventoryLedger']['amount'], 2); ?>&nbsp;</td>
	</tr>
	<?php $total	+=$inventoryLedger['InventoryLedger']['amount'] ?>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="6" class="number"><?php __("Saldo Stock"); ?></td>
		<td style="border-top:1px solid black" class="number"><?php __("Rp") ?></td>
		<td style="border-top:1px solid black" class="number">
			<?php 
				echo $this->Number->format($total, 2);
			?>
		</td>
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