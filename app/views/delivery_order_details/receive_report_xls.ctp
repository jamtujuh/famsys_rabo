<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Item Received List',true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->Session->read('DeliveryOrderDetail.asset_category_type_id') == null){
	$asset_category_type_id = 'All';
}else{
	$asset_category_type_id = $assetCategoryTypes[$this->Session->read('DeliveryOrderDetail.asset_category_type_id')];
}
if($this->Session->read('DeliveryOrderDetail.asset_category_id') == null){
	$asset_category_id = 'All';
}else{
	$asset_category_id = $assetCategories[$this->Session->read('DeliveryOrderDetail.asset_category_id')];
}
if($this->Session->read('DeliveryOrderDetail.department_id') == null){
	$department_id = 'All';
}else{
	$department_id = $departments[$this->Session->read('DeliveryOrderDetail.department_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Item Received List', true  ) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category Type', true  ) ;?></td>
		<td colspan="2">: <?php echo $asset_category_type_id;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true  ) ;?></td>
		<td colspan="2">: <?php echo  $date_start['month']  ;?>-<?php echo  $date_start['day']  ;?>-<?php echo  $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true  ) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true  ) ;?></td>
		<td colspan="2">: <?php echo  $date_end['month']  ;?>-<?php echo  $date_end['day']  ;?>-<?php echo  $date_end['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true  ) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Purchase Order',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No DO',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('DO Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price Cur',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Cur',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($deliveryOrderDetails as $deliveryOrderDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$places = $myApp->getPlaces($deliveryOrderDetail['Currency']['is_desimal']);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td align="left"><?php echo $deliveryOrderDetail['Po']['no']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['DeliveryOrder']['no']; ?>&nbsp;</td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $deliveryOrderDetail['DeliveryOrder']['do_date']); ?>&nbsp;</td>
		<td align="left"><?php echo $deliveryOrderDetail['Department']['name']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['AssetCategory']['name']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['item_code']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['name']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['brand']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['type']; ?></td>
		<td align="left"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['color']; ?></td>
		<td align="center"><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['qty']; ?></td>
		<td align="center"><?php echo $deliveryOrderDetail['Currency']['name']; ?></td>
		<td align="right"><?php echo $this->Number->format($deliveryOrderDetail['DeliveryOrderDetail']['price_cur'], $places); ?></td>
		<td align="right"><?php echo $this->Number->format($deliveryOrderDetail['DeliveryOrderDetail']['amount_cur'], $places); ?></td>

	</tr>
<?php endforeach; ?>
	</table>
