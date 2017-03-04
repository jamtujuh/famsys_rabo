<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Inventory Stock', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($asset_category == NULL) {
	$ac = 'All';
}else {
	$ac = $assetCategories[$asset_category];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Inventory Stock', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td>: <?php echo $ac ;?></td>
	</tr>	
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $this->params['data']['filter']['month']['month'] ;?>-<?php echo $this->params['data']['filter']['year']['year'] ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Code',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Unit',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price',true)  ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount',true)  ;?></div></td>
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
		<td><?php echo $i; ?></td>
		<td><?php echo $inventoryLedger['InventoryLedger']['date']; ?></td>
		<td><?php echo $inventoryLedger['Item']['code']; ?></td>
		<td><?php echo $items[$inventoryLedger['InventoryLedger']['item_id']];?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['qty'],0); ?></td>
		<td><?php echo $units[$inventoryLedger['Item']['unit_id']]; ?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['price'],2); ?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['amount'],2); ?></td>
	</tr>
	<?php $total	+=$this->Number->precision($inventoryLedger['InventoryLedger']['amount'],2) ?>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="6" align="right"><?php echo __('Saldo Stock',true)  ;?></td>
		<td style="border-top:1px solid black" align="right"><?php echo __('Rp',true)  ;?></td>
		<td style="border-top:1px solid black" align="right">
			<?php 
				echo $this->Number->precision($total,2);
			?>
		</td>
	</tr>
	</table>