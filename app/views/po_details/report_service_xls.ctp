<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Service Ordered List',true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['PoDetail']['department_id'] == null){
	$department_id = 'All';
}else{
	$department_id = $departments[$this->data['PoDetail']['department_id']];
}
if($this->data['PoDetail']['asset_category_id'] == null){
	$asset_category_id = 'All';
}else{
	$asset_category_id = $assetCategories[$this->data['PoDetail']['asset_category_id']];
}
if($this->data['PoDetail']['item_id'] == null){
	$item_id = 'All';
}else{
	$item_id = $items[$this->data['PoDetail']['item_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Service Ordered List', true  ) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="100" colspan="2"><?php echo __('Branch', true  ) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
	</tr>
	<tr>
		<td WIDTH="100" colspan="2"><?php echo __('Asset Category', true  ) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id;?></td>
	</tr>
	<tr>
		<td WIDTH="100" colspan="2"><?php echo __('Item', true  ) ;?></td>
		<td colspan="2">: <?php echo $item_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty Received',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price Cur',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Cur',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Discount',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('After Disc',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Ref. MR',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($poDetails as $poDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$places = $myApp->getPlaces($poDetail['Currency']['is_desimal']);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i;?></td>
		<td align="left"><?php echo $departments[$poDetail['PoDetail']['department_id']];?></td>
		<td align="left"><?php echo $assetCategories[$poDetail['PoDetail']['asset_category_id']];?></td>
		<td align="left"><?php echo $poDetail['PoDetail']['item_code'];?></td>
		<td align="left"><?php echo $poDetail['PoDetail']['name'];?></td>
		<td align="left"><?php echo $poDetail['PoDetail']['brand'];?></td>
		<td align="left"><?php echo $poDetail['PoDetail']['type'];?></td>
		<td align="left"><?php echo $poDetail['PoDetail']['color'];?></td>
		<td align="center"><?php echo $poDetail['PoDetail']['qty'];?></td>
		<td align="center"><?php echo $poDetail['PoDetail']['qty_received'];?></td>
		<td align="center"><?php echo $poDetail['Currency']['name'];?></td>
		<td align="right"><?php echo $this->Number->format($poDetail['PoDetail']['price_cur'], $places);?></td>
		<td align="right"><?php echo $this->Number->format($poDetail['PoDetail']['amount_cur'], $places);?></td>
		<td align="right"><?php echo $this->Number->format($poDetail['PoDetail']['discount_cur'], $places);?></td>
		<td align="right"><?php echo $this->Number->format($poDetail['PoDetail']['amount_after_disc_cur'], $places);?></td>
		<td align="left"><?php echo $poDetail['PoDetail']['npb_id']?$npbs[$poDetail['PoDetail']['npb_id']]:"";?></td>

	</tr>
<?php endforeach; ?>
	</table>
