<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Asset Details Labelling', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>

<?php
if ($this->Session->read('AssetDetail.department_id') == null) {
	$department_id = 'All';
}else {
	$department_id = $departments[$this->Session->read('AssetDetail.department_id')];
}
if ($this->Session->read('AssetDetail.business_type_id') == null) {
	$business_type_id = 'All';
}else {
	$business_type_id = $businessType[$this->Session->read('AssetDetail.business_type_id')];
}
if ($this->Session->read('AssetDetail.cost_center_id') == null) {
	$cost_center_id = 'All';
}else {
	$cost_center_id = $costCenter[$this->Session->read('AssetDetail.cost_center_id')];
}
if ($this->Session->read('AssetDetail.cost_center_id') == null) {
	$cost_center_ids = '';
}else {
	$cost_center_ids = $costCenters[$this->Session->read('AssetDetail.cost_center_id')];
}

/* if ($this->Session->read('AssetDetail.department_sub_id') == null) {
	$department_sub_id = 'All';
}else {
	$department_sub_id = $departmentSub[$this->Session->read('AssetDetail.department_sub_id')];
}
if ($this->Session->read('AssetDetail.department_unit_id') == null) {
	$department_unit_id = 'All';
}else {
	$department_unit_id = $departmentUnit[$this->Session->read('AssetDetail.department_unit_id')];
}
 */

if ($this->Session->read('AssetDetail.asset_category_id') == null) {
	$asset_category_id = 'All';
}else {
	$asset_category_id = $assetCategories[$this->Session->read('AssetDetail.asset_category_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Asset Details Labelling', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch',true) ;?></td>
		<td colspan="2">: <?php echo $department_id ;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category',true) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Business Type',true) ;?></td>
		<td colspan="2">: <?php echo $business_type_id ;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Search Keyword',true) ;?></td>
		<td colspan="2">: <?php echo $this->data['AssetDetail']['search_keyword'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Cost Center',true) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id ;?>&nbsp;<?php echo $cost_center_ids ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inventaris',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Condition',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Location',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Ada',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Purchase',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Serial No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Barcode',true) ;?></div></td>
	</tr>
<?php
	$i = 0;
	foreach ($assetDetails as $assetDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td class="left"><?php echo $assetDetail['Department']['name']; ?></td>
		<td class="left"><?php echo $assetDetail['BusinessType']['name']; ?></td>
		<td class="left"><?php echo $assetDetail['CostCenter']['cost_centers']; ?>&nbsp;-&nbsp;<?php echo $assetDetail['CostCenter']['name']; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['code'] ; ?></td>
		<td class="left"><?php echo $assetDetail['Condition']['name'] ; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['item_code']; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['name']; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['brand']; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['type']; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['color']; ?></td>
		<td class="left"><?php echo $assetDetail['Location']['name']; ?></td>
		<td align="center"><?php echo $assetDetail['AssetDetail']['ada']; ?></td>
		<td align="right"><?php echo $this->Number->precision($assetDetail['AssetDetail']['book_value'],0); ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $assetDetail['AssetDetail']['date_start']); ?></td>
		<td><?php echo $assetDetail['AssetDetail']['serial_no']; ?></td>
		<td><?php echo $assetDetail['AssetDetail']['code']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>