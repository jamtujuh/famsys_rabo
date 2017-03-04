<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Fixed Asset Transfer Report', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['MovementDetail']['asset_category_id'] == null) {
	$asset_category_id = 'All';
}else {
	$asset_category_id = $assetCategories[$this->data['MovementDetail']['asset_category_id']];
}
if($this->data['MovementDetail']['source_department_id'] == null) {
	$source_department_id = 'All';
}else {
	$source_department_id = $departments[$this->data['MovementDetail']['source_department_id']];
}
if($this->data['MovementDetail']['source_business_type_id'] == null) {
	$source_business_type_id = 'All';
}else {
	$source_business_type_id = $businessType[$this->data['MovementDetail']['source_business_type_id']];
}
if($this->data['MovementDetail']['source_cost_center_id'] == null) {
	$source_cost_center_id = 'All';
}else {
	$source_cost_center_id = $costCenter[$this->data['MovementDetail']['source_cost_center_id']];
}
if($this->data['MovementDetail']['source_cost_center_id'] == null) {
	$source_cost_center_ids = '';
}else {
	$source_cost_center_ids = $costCenters[$this->data['MovementDetail']['source_cost_center_id']];
}


if($this->data['MovementDetail']['dest_department_id'] == null) {
	$dest_department_id = 'All';
}else {
	$dest_department_id = $departments[$this->data['MovementDetail']['dest_department_id']];
}
if($this->data['MovementDetail']['dest_business_type_id'] == null) {
	$dest_business_type_id = 'All';
}else {
	$dest_business_type_id = $businessType[$this->data['MovementDetail']['dest_business_type_id']];
}
if($this->data['MovementDetail']['dest_cost_center_id'] == null) {
	$dest_cost_center_id = 'All';
}else {
	$dest_cost_center_id = $costCenter[$this->data['MovementDetail']['dest_cost_center_id']];
}
if($this->data['MovementDetail']['dest_cost_center_id'] == null) {
	$dest_cost_center_ids = '';
}else {
	$dest_cost_center_ids = $costCenters[$this->data['MovementDetail']['dest_cost_center_id']];
}
if($this->Session->read('MovementDetail.is_inventory') == 1) {
	$is_inventory = 'Yes';
}else if($this->Session->read('MovementDetail.is_inventory') == 2) {
	$is_inventory = 'No';
}else if($this->Session->read('MovementDetail.is_inventory') == 3) {
	$is_inventory = 'All';
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fixed Asset Transfer Report', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Dest Department', true) ;?></td>
		<td colspan="3">: <?php echo $dest_department_id;?></td>
		<td colspan="2"><?php echo __('Source Department', true) ;?></td>
		<td colspan="3">: <?php echo $source_department_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Dest Business Type', true) ;?></td>
		<td colspan="3">: <?php echo $dest_business_type_id;?></td>
		<td colspan="2"><?php echo __('Source Business Type', true) ;?></td>
		<td colspan="3">: <?php echo $source_business_type_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Dest Cost Center', true) ;?></td>
		<td colspan="3">: <?php echo $dest_cost_center_id;?>&nbsp;<?php echo $dest_cost_center_ids ;?></td>
		<td colspan="2"><?php echo __('Source Cost Center', true) ;?></td>
		<td colspan="3">: <?php echo $source_cost_center_id;?>&nbsp;<? echo $source_cost_center_ids ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td colspan="3">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
		<td colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td colspan="3">: <?php echo $asset_category_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td colspan="3">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
		<td colspan="2"><?php echo __('Search Keyword', true) ;?></td>
		<td colspan="3">: <?php echo $this->Session->read('MovementDetail.name') ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Below Minimum Value', true) ;?></td>
		<td colspan="3">: <?php echo $is_inventory ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Mov',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Invetaris',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Serial No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Category',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Source Department',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Source Business Type',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Source Cost Center',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Dest Department',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Dest Business Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Dest Cost Center',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Purchase',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum Depr',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	$price = 0;
	$depthnini = 0;
	$book_value = 0;
	foreach ($movementDetails as $movementDetail) : 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}	
	?>
	
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['Movement']['no']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['code']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['item_code']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['name']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['brand']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['type']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['color']; ?>&nbsp;</td>
		<td align="left"><?php echo $movementDetail['AssetDetail']['serial_no']; ?>&nbsp;</td>
		<td align="left"><?php echo $assetCategories[$movementDetail['AssetDetail']['asset_category_id']]; ?>&nbsp;</td>
		<td align="left"><?php echo $departments[$movementDetail['Movement']['source_department_id']]; ?>&nbsp;</td>
		<td align="left"><?php echo $myApp->showArrayValue($businessType,$movementDetail['Movement']['source_business_type_id']); ?>&nbsp;</td>
		<td align="left" nowrap="nowrap"><?php echo $myApp->showArrayValue($costCenter,$movementDetail['Movement']['source_cost_center_id']); ?>-<?php echo $myApp->showArrayValue($costCenters,$movementDetail['Movement']['source_cost_center_id']); ?>&nbsp;</td>
		<td align="left"><?php echo $departments[$movementDetail['Movement']['dest_department_id']]; ?>&nbsp;</td>
		<td align="left"><?php echo $myApp->showArrayValue($businessType,$movementDetail['Movement']['dest_business_type_id']); ?>&nbsp;</td>
		<td align="left" nowrap="nowrap"><?php echo $myApp->showArrayValue($costCenter,$movementDetail['Movement']['dest_cost_center_id']); ?>-<?php echo $myApp->showArrayValue($costCenters,$movementDetail['Movement']['dest_cost_center_id']); ?>&nbsp;</td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $movementDetail['Movement']['doc_date']); ?>&nbsp;</td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $movementDetail['AssetDetail']['date_start']); ?>&nbsp;</td>
		<td align="right"><?php echo $this->Number->precision($movementDetail['AssetDetail']['price'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($movementDetail['AssetDetail']['depthnini'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($movementDetail['AssetDetail']['book_value'],0); ?></td>
	</tr>
	<?php $price += $this->Number->precision($movementDetail['AssetDetail']['price'],0);?>
	<?php $depthnini += $this->Number->precision($movementDetail['AssetDetail']['depthnini'],0);?>
	<?php $book_value += $this->Number->precision($movementDetail['AssetDetail']['book_value'],0);?>

	<?php endforeach; ?>
	<tr>
		<td colspan="18"><div align="right">Total</div></td>
		<td align="right"><?php echo $this->Number->precision($price,0);?></td>
		<td align="right"><?php echo $this->Number->precision($depthnini,0);?></td>
		<td align="right"><?php echo $this->Number->precision($book_value,0);?></td>
	</tr>
	</table>