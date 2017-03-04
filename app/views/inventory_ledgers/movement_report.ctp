<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
?>
<div id="moduleName"><?php echo 'REPORTS > Stock > Stock Movement Report'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $form->create('InventoryLedger', array('action' => 'movement_report'));?>
<fieldset>
	<legend><?php __('Inventory Movement Report')?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Movement Report Filter') ?></legend>
		<?php echo $form->input('asset_category_id', array('value'=>$this->Session->read('MovementReport.asset_category_id'), 'options'=>$assetCategories, 'empty'=>'select a category')); ?>
		<?php
			$options = array('url' => 'getitems', 'update' => 'InventoryLedgerItemId',
				'loading' 	=> 'Element.show(\'LoadingDiv\')',
				'complete'	=> 'Element.hide(\'LoadingDiv\')');
			echo $ajax->observeField('InventoryLedgerAssetCategoryId', $options);
		?>
		<?php echo $form->input('item_id', array('value'=>$this->Session->read('MovementReport.item_id'))); ?>
		<?php echo $form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
		<?php echo $form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
		
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF', 'xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Inventory Stock Report', true), array('controller' => 'inventory_ledgers', 'action' => 'stock_report')); ?> </li>
		<li><?php echo $this->Html->link(__('Inventory Inlog Report', true), array('controller' => 'inventory_ledgers', 'action' => 'in_recap_report')); ?> </li>
		<li><?php echo $this->Html->link(__('Inventory Outlog Report', true), array('controller' => 'inventory_ledgers', 'action' => 'report_out_recap')); ?> </li>
	</ul>
</div>
</div>

<div class="InventoryLedger related">
<? if (!empty($rows)) : ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('No');;?></th>
			<th><?php echo __('Date');;?></th>
			<th><?php echo __('In');;?></th>
			<th><?php echo __('Out');;?></th>
			<th><?php echo __('Saldo');;?></th>
	</tr>
	<tr>
		<td colspan="4" class="number"><?php __("Beginning Balance") ?></td>
		<td  class="center">
			<?php 
				echo $this->Number->format($beginning_balance);
			?>
		</td>
	</tr>
	<?php
	$i = 0;
	$r = 0;
	$balance=$beginning_balance;
	foreach ($rows as $date=>$row):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<?php
		if(!empty($row['in']) && empty($row['out'])) {
			$balance=$balance+$row['in'];
		} elseif(empty($row['in']) && !empty($row['out'])) {
			$balance=$balance-$row['out'];
		} elseif(!empty($row['in']) && !empty($row['out'])) {
			$balance=$balance+$row['in']-$row['out'];
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $date); ?>&nbsp;</td>
		<td class="right">
			<?php
				if (!empty($row['in'])) {
					echo $this->Number->format($row['in']);
				} else {
					echo $r;
				}
			?>&nbsp;
		</td>
		<td class="right">
			<?php
				if (!empty($row['out'])) {
					echo $this->Number->format($row['out']);
				} else {
					echo $r;
				}
			?>&nbsp;
		</td>
		<td  class="right"><?php echo $this->Number->format($balance); ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="4" class="number"><?php __("Ending Balance") ?></td>
		<td style="border-top:1px solid black"  class="center">
			<?php 
				echo $this->Number->format($balance);
			?>
		</td>
	</tr>
	</table>
<? endif ?>

</div>