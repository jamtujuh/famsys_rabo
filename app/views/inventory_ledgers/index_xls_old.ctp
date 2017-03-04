<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Inventory Ledgers', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
	<td colspan="4"><h2><?php echo __('Inventory Ledgers', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Item', true);?></td>
		<td>:
			<?php if ($inv_item_id)	echo $items[$inv_item_id];
				else echo 'Empty';
			?>
		</td>
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
<?php if ($inv_item_id){?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Transaction', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Unit', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('In Out', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc', true);?></div></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><?php echo __('Beginning Balance', true);?></td>
		<td><div align="right"><?php echo $this->Number->precision($beginning_balance,0);?></div></td>
	</tr>
		<?php
		$i = 0;
		foreach ($inventoryLedgers as $inventoryLedger):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $inventoryLedger['InventoryLedger']['date']); ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $inventoryLedger['InventoryLedger']['date_of_transaction']); ?></td>
		<td align="right"><?php if($inventoryLedger['InventoryLedger']['in_out']=='outlog' || $inventoryLedger['InventoryLedger']['in_out']=='supplierRetur'):?>
		<?php echo '-';?>
		<?php endif;?>
		<?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['qty'],0); ?></td>
		<td><?php echo $units[$inventoryLedger['Item']['unit_id']]; ?></td>
		<td><?php echo $inventoryLedger['InventoryLedger']['in_out']; ?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['price'],2); ?></td>
		<td align="right"><?php echo $this->Number->precision($inventoryLedger['InventoryLedger']['amount'],2); ?></td>
		<td>			
			<?php echo $inventoryLedger['Inlog']['no']; ?>
			<?php echo $inventoryLedger['Outlog']['no']; ?>
			<?php echo $inventoryLedger['SupplierRetur']['no']; ?>
			<?php echo $inventoryLedger['Retur']['no']; ?>
			<?php echo $inventoryLedger['SupplierReplace']['no']; ?>
		</td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td colspan="3" align="right"><?php echo __("Ending Balance", true) ;?></td>
		<td align="right"><?php echo $this->Number->precision($ending_balance,0);?></td>
	</tr>
	</table>
<?php }?>