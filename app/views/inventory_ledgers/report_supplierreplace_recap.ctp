<?php 
echo $javascript->link('my_script',false); 
echo $javascript->link('my_detail_add',false);
$request_type_id = 3;
?>
<div id="moduleName"><?php echo 'REPORTS > Stock > Stock SupplierReplace Reports'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('InventoryLedger', array('action'=>'report_supplierreplace_recap')) ?>
<fieldset>
 	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Filter Item')?></legend>
	<?php echo $this->Form->input('item_id', array( 'type'=>'hidden', 'options'=>$items) ); ?>
	<?php echo $this->Form->input('Item.name', array('label'=>'Select Code - Name', 'style'=>'width:100%') ); ?>
	<div id="item_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo $request_type_id?>', {afterUpdateElement : setInventoryLedgerItemValues});
		//]]>
	</script>			
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
	</ul>
</div>
</div>
<div class="InventoryLedger related">
	<h2><?php __('Report SupplierRetur Recap');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('docn no');?></th>
			<th><?php echo $this->Paginator->sort('supplier retur no');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('date of transaction');?></th>
			<th><?php echo $this->Paginator->sort('Item code');?></th>
			<th><?php echo $this->Paginator->sort('Item name');?></th>
			<th><?php echo $this->Paginator->sort('unit');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
	</tr>
	<?php
	$i = 0;
	$qty = 0;
	$amount = 0;
	foreach ($inventoryLedgers as $inventoryLedger):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($inventoryLedger['SupplierReplace']['no'], array('controller' => 'supplier_replaces', 'action' => 'view', $inventoryLedger['SupplierReplace']['id'])); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($inventoryLedger['SupplierRetur']['no'], array('controller' => 'supplier_returs', 'action' => 'view', $inventoryLedger['SupplierRetur']['id'])); ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $inventoryLedger['InventoryLedger']['date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $inventoryLedger['InventoryLedger']['date_of_transaction']); ?>&nbsp;</td>
		<td class="left"><?php echo $inventoryLedger['Item']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $inventoryLedger['Item']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $units[$inventoryLedger['Item']['unit_id']]; ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format($inventoryLedger['InventoryLedger']['qty']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($inventoryLedger['InventoryLedger']['price'], 2); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($inventoryLedger['InventoryLedger']['amount'], 2); ?>&nbsp;</td>
	</tr>
	<?php
		$qty += $inventoryLedger['InventoryLedger']['qty'];
		$amount += $inventoryLedger['InventoryLedger']['amount'];
	?>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="17" class="number"></td>
	</tr>
	<tr>
		<td colspan="8" class="number">Total</td>
		<td class="center"><?php echo $qty ;?>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($amount, 2) ;?>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</div>	
	<div class="paging">
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
