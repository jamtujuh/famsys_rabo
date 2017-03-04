<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Disposal Write Off Report',true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->Session->read('DisposalDetail.asset_category_type_id') == null){
	$asset_category_type_id = 'All';
}else{
	$asset_category_type_id = $assetCategoryTypes[$this->Session->read('DisposalDetail.asset_category_type_id')];
}
if($this->Session->read('DisposalDetail.asset_category_id') == null){
	$asset_category_id = 'All';
}else{
	$asset_category_id = $assetCategories[$this->Session->read('DisposalDetail.asset_category_id')];
}
if($this->Session->read('DisposalDetail.department_id') == null){
	$department_id = 'All';
}else{
	$department_id = $departments[$this->Session->read('DisposalDetail.department_id')];
}
if($this->Session->read('DisposalDetail.is_inventory')==1)
	$is_inventory = 'Yes';
elseif($this->Session->read('DisposalDetail.is_inventory')==2)
	$is_inventory = 'No';
elseif($this->Session->read('DisposalDetail.is_inventory')==3)
	$is_inventory = 'All';
if($this->Session->read('Disposal.business_type_id') == null){
	$business_type_id = 'All';
}else{
	$business_type_id = $businessType[$this->Session->read('Disposal.business_type_id')];
}
if($this->Session->read('Disposal.cost_center_id') == null){
	$cost_center_id = 'All';
}else{
	$cost_center_id = $costCenters[$this->Session->read('Disposal.cost_center_id')].'-'.$cost_Centers[$this->Session->read('Disposal.cost_center_id')];
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Disposal Write Off Report', true  ) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category Type', true  ) ;?></td>
		<td colspan="2">: <?php echo $asset_category_type_id;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Below Minimum Value', true  ) ;?></td>
		<td colspan="2">: <?php echo $is_inventory;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true  ) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true  ) ;?></td>
		<td colspan="2">: <?php echo  $date_start['month']  ;?>-<?php echo  $date_start['day']  ;?>-<?php echo  $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true  ) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true  ) ;?></td>
		<td colspan="2">: <?php echo  $date_end['month']  ;?>-<?php echo  $date_end['day']  ;?>-<?php echo  $date_end['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Business Type', true  ) ;?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Cost Center', true  ) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Disposal',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inventaris',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Serial No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum Dep',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date OF Purchase',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	$total_price=0;
	$total_book_value=0;
	$total_accum_dep=0;

	foreach ($disposalDetails as $disposalDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td align="left"><?php echo $disposalDetail['Disposal']['no']; ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT,$disposalDetail['Disposal']['doc_date']); ?>&nbsp;</td>
		<td align="left"><?php echo $disposalDetail['Disposal']['Department']['name']; ?></td>
		<td align="left"><?php echo $disposalDetail['Disposal']['BusinessType']['name']; ?></td>
		<td align="left"><?php echo $disposalDetail['Disposal']['CostCenter']['cost_centers'].'-'.$disposalDetail['Disposal']['CostCenter']['name']; ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['code']; ?></td>
		<td align="left"><?php echo $myApp->showArrayValue($assetCategory,$disposalDetail['DisposalDetail']['asset_category_id']); ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['item_code']; ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['name']; ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['brand']; ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['type']; ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['color']; ?></td>
		<td align="left"><?php echo $disposalDetail['DisposalDetail']['serial_no']; ?></td>
		<td align="right"><?php echo $this->Number->precision($disposalDetail['DisposalDetail']['price'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($disposalDetail['DisposalDetail']['book_value'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($disposalDetail['DisposalDetail']['accum_dep'],0); ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $disposalDetail['DisposalDetail']['date_of_purchase']); ?></td>
	</tr>
	<?php
		$total_price				+=$this->Number->precision($disposalDetail['DisposalDetail']['price'],0);
		$total_book_value			+=$this->Number->precision($disposalDetail['DisposalDetail']['book_value'],0);
		$total_accum_dep			+=$this->Number->precision($disposalDetail['DisposalDetail']['accum_dep'],0);
	?>
<?php endforeach; ?>
	<tr>
		<td colspan="14"  align="right"><?php __('Total')?></td>
		<td align="right"><?php echo $this->Number->precision($total_price,0) ?></td>
		<td align="right"><?php echo $this->Number->precision($total_book_value,0) ?></td>
		<td align="right"><?php echo $this->Number->precision($total_accum_dep,0) ?></td>
		<td></td>
	</tr>

	</table>
