<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Purchase', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($this->data['Purchase']['supplier_id'] == null) {
	$supplier_id = 'All';
}else  {
		$supplier_id =$suppliers[$this->data['Purchase']['supplier_id']];
} 
if ($this->data['Purchase']['purchase_status_id'] == null) {
	$purchase_status_id = 'All';
}else  {
		$purchase_status_id =$purchaseStatuses[$this->data['Purchase']['purchase_status_id']];
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Purchase', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Purchase Status', true);?></td>
		<td>: <?php echo $purchase_status_id ;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true);?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Supplier', true);?></td>
		<td>: <?php echo $supplier_id ;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No FA', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Purchase', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Register Status', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Warranty Name', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Warranty Year', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Po No', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc Total', true) ;?></div></td>
	</tr>
	
	<?php
	$i = 0;
	$total = 0;
	foreach ($purchases as $purchase):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td align="left"><?php echo $i; ?></td>
		<td align="left"><?php echo $purchase['Purchase']['no']; ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $purchase['Purchase']['date_of_purchase']); ?></td>
		<td align="left"><?php echo $purchase['PurchaseStatus']['name']; ?></td>
		<td align="left"><?php echo $purchase['Purchase']['warranty_name']; ?></td>
		<td align="left"><?php echo $purchase['Purchase']['warranty_year']; ?> Year</td>
		<td align="left"><?php echo $purchase['Supplier']['name']; ?></td>
		<td align="left"><?php echo $purchase['Purchase']['po_no']; ?></td>
		<td align="right"><?php echo $this->Number->precision($purchase['Purchase']['total'],0); ?></td>
		</td>
	</tr>
	<?php $total += $this->Number->precision($purchase['Purchase']['total'],0);?>
<?php endforeach; ?>
	<tr>
		<td colspan="8"><div align="right">Total</div></td>
		<td align="right"><?php echo $this->Number->precision($total,0) ;?></td>
	</tr>
	</table>