<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Delivery Orders', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['DeliveryOrder']['po_id'] == null) {
		$po_no = 'All';
}else {
		$po_no = $pos[$this->data['DeliveryOrder']['po_id']];
}

if($this->data['DeliveryOrder']['delivery_order_status_id'] == null) {
		$delivery_order_status_id = 'All';
}else {
		$delivery_order_status_id = $deliveryOrderStatuses[$this->data['DeliveryOrder']['delivery_order_status_id']];
}
$no = $this->Session->read('DeliveryOrder.DoNo');

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Delivery Orders', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Po No', true);?></td>
		<td>: <?php echo $po_no;?></td>
		
		<td colspan="2"><?php echo __('Date Start', true);?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Delivery Order Status', true);?></td>
		<td>: <?php echo $delivery_order_status_id;?></td>
		
		<td colspan="2"><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('No', true);?></td>
		<td>: <?php echo $no;?></td>
		
		<td colspan="2"></td>
		<td></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Purchase Order', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Total', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Req Delivery Date', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No Do', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Do Date', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Day Diff', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Total Penalty', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Delivery Order Status', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Convert Asset', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($deliveryOrders as $deliveryOrder):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	$day_diff =  strtotime($deliveryOrder['Po']['delivery_date']) - strtotime($deliveryOrder['DeliveryOrder']['do_date']) ;
	$day_diff /= 60*60*24;
	
	$places = $myApp->getPlaces($currency[$deliveryOrder['Po']['currency_id']]);

	?>
	<tr<?php echo $class;?>>
	  <td><?php echo $i; ?></td>
	  <td align="left"><?php echo $deliveryOrder['Po']['no']; ?> </td>
	  <td align="left"><?php echo $currencies[$deliveryOrder['Po']['currency_id']]; ?></td>
	  <td align="right"><?php echo $this->Number->format($deliveryOrder['Po']['total'], $places); ?></td>
	  <td align="left"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrder['Po']['delivery_date']); ?></td>
	  <td align="left"><?php echo $deliveryOrder['DeliveryOrder']['no']; ?></td>
	  <td align="left"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrder['DeliveryOrder']['do_date']); ?></td>
	  <td align="right"><?php echo $day_diff  ; ?></td>
	  <td align="right"><?php echo $deliveryOrder['Po']['daily_penalty']>0?$this->Number->format($day_diff * $deliveryOrder['Po']['total_cur'] * $deliveryOrder['Po']['daily_penalty'], $places) : '0'; ?></td>
	  <td align="left"><?php echo $deliveryOrder['Supplier']['name']; ?> </td>
	  <td align="left"><?php echo $deliveryOrder['DeliveryOrderStatus']['name']; ?></td>
	  <?php if($deliveryOrder['DeliveryOrder']['convert_asset'] == 1){
				$convert = 'Yes';
	  }else{
				$convert = 'No';
	  }
	  ?>
	  <td align="center"><?php echo $convert ;?></td>
	</tr>
<?php endforeach; ?>
	</table>