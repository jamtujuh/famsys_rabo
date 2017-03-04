<div id="moduleName"><?php echo 'REPORTS > Stock > Stock Outlog Report'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $form->create('InventoryLedger', array('action' => 'out_recap_report'));?>
	<fieldset>
	<legend><?php __('Stock Outlog Report')?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Stock Outlog Filter') ?></legend>
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
		<li><?php echo $this->Html->link(__('Inventory Stock Report', true), array('controller' => 'inventory_ledgers', 'action' => 'stock_report')); ?> </li>
		<li><?php echo $this->Html->link(__('Inventory Inlog Report', true), array('controller' => 'inventory_ledgers', 'action' => 'in_recap_report')); ?> </li>
	</ul>
</div>
</div>

<div class="InventoryLedger related">
<?php if (!empty($rows)) : ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('No');?></th>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Beginning Stock');?></th>
			<th><?php echo __('Out');?></th>
			<th><?php echo __('End Stock');?></th>
	</tr>
	<?php
	$i = 0;
	$r = 0;
	$end_stock=0;
	$total=0;
	foreach ($rows as $item_id=>$row):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<?php
		if (!empty($row['begin_stock_amount']) && !empty($row['out_amount'])) {
			$end_stock=$row['begin_stock_amount']-$row['out_amount'];
		} elseif (!empty($row['begin_stock_amount']) && empty($row['out_amount'])) {
			$end_stock=$row['begin_stock_amount']-0;
		} elseif (empty($row['begin_stock_amount']) && !empty($row['out_amount'])) {
			$end_stock=0-$row['out_amount'];
		}
	?>
	<tr<?php echo $class;?>>
	<?php list($code) = explode ('|', $item_id)?>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($items[$item_id], array('controller' => 'items', 'action' => 'view', $item_id)); ?>&nbsp;</td>
		<td class="number">
			<?php
				if (!empty($row['begin_stock_amount'])) {
					echo $this->Number->format($row['begin_stock_amount']);
				} else {
					echo $r;
				}
			?>&nbsp;
		</td>
		<td class="number">
			<?php
				if (!empty($row['out_amount'])) {
					echo $this->Number->format($row['out_amount']);
				} else {
					echo $r;
				}
			?>&nbsp;
		</td>
		<td class="number"><?php echo $this->Number->format($end_stock); ?>&nbsp;</td>
	</tr>
	<?php $total	+=$end_stock; ?>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="3" class="number"><?php __("Sub Total") ?></td>
		<td style="border-top:1px solid black" class="number"><?php __("Rp") ?></td>
		<td style="border-top:1px solid black" class="number">
			<?php 
				echo $this->Number->format($total);
			?>
		</td>
	</tr>
	</table>
<? endif ?>

</div>