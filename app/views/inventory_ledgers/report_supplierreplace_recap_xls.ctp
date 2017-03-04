<?php    
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel"); 
header ("Content-Disposition: attachment; filename=\"" .__('Report Supplier Replace Recap', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['InventoryLedger']['item_id'] == null){
	$item_id = 'All';
}else{
	$item_id = $items[$this->data['InventoryLedger']['item_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
	<td colspan="4"><h2><?php echo __('Report Supplier Replace Recap', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Item', true);?></td>
		<td>: <?php echo $item_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true);?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier Retur No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Transaction', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Code', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Name', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Unit', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount', true);?></div></td>
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
		<td><?php echo $i; ?></td>
		<td class="left"><?php echo $inventoryLedger['SupplierReplace']['no']; ?></td>
		<td class="left"><?php echo $inventoryLedger['SupplierRetur']['no']; ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $inventoryLedger['InventoryLedger']['date']); ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $inventoryLedger['InventoryLedger']['date_of_transaction']); ?></td>
		<td align="left"><?php echo $inventoryLedger['Item']['code']; ?></td>
		<td align="left"><?php echo $inventoryLedger['Item']['name']; ?></td>
		<td align="left"><?php echo $units[$inventoryLedger['Item']['unit_id']]; ?></td>
		<td align="center"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['qty'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['price'],2); ?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['amount'],2); ?></td>
	</tr>
	<?php
	$qty += $this->Number->precision($inventoryLedger['InventoryLedger']['qty'],0);
	$amount += $this->Number->precision($inventoryLedger['InventoryLedger']['amount'],2);
	?>
<?php endforeach; ?>
	<tr>
		<td colspan="8" align="right">Total</td>
		<td align="center"><?php echo $this->Number->precision($qty,0);?></td>
		<td></td>
		<td align="right"><?php echo $this->Number->precision($amount,2) ;?></td>
	</tr>
	</table>
	</table>