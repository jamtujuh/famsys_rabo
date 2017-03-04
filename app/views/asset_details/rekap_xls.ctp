<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Fixed Asset Recap ', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$date_end = $this->Session->read('AssetDetail.date_end');
$is_under_value = $this->Session->read('AssetReport.is_under_value');
if ($this->Session->read('AssetReport.is_inventory') == 1) {
	$is_inventory =  'Yes';
} else if ($this->Session->read('AssetReport.is_inventory') == 2) {
	$is_inventory =  'No';
} else if ($this->Session->read('AssetReport.is_inventory') == 3) {
	$is_inventory =  'All';
}

if ($this->Session->read('AssetReport.department_id') == null) {
	$department_id = 'All';
}else {
	$department_id = $departments[$this->Session->read('AssetReport.department_id')];
}
if ($this->Session->read('AssetReport.business_type_id') == null) {
	$business_type_id = 'All';
}else {
	$business_type_id = $businessType[$this->Session->read('AssetReport.business_type_id')];
}
if ($this->Session->read('AssetReport.cost_center_id') == null) {
	$cost_center_id = 'All';
	$cost_center_ids = '';
}else {
	$cost_center_id = $costCenter[$this->Session->read('AssetReport.cost_center_id')];
	$cost_center_ids = $costCenters[$this->Session->read('AssetReport.cost_center_id')];
}

/* if ($this->Session->read('AssetReport.department_sub_id') == null) {
	$department_sub_id = 'All';
}else {
	$department_sub_id = $departmentSub[$this->Session->read('AssetReport.department_sub_id')];
}
if ($this->Session->read('AssetReport.department_unit_id') == null) {
	$department_unit_id = 'All';
}else {
	$department_unit_id = $departmentUnit[$this->Session->read('AssetReport.department_unit_id')];
}
 */

if ($this->Session->read('AssetReport.asset_category_id') == null) {
	$asset_category_id = 'All';
}else {
	$asset_category_id = $assetCategories[$this->Session->read('AssetReport.asset_category_id')];
}

if ($this->Session->read('AssetReport.asset_category_type_id') == null) {
	$asset_category_type_id = '';
}else {
	$asset_category_type_id = $assetCategoryTypes[$this->Session->read('AssetReport.asset_category_type_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fixed Asset Recap Report per '.$this->Session->read('AssetReport.periode'), true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Branch',true) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td><?php echo __('Below Minimum Value',true) ;?></td>
		<td colspan="2">: <?php echo $is_inventory;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Business Type',true) ;?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
		<td><?php echo __('Asset Category Type',true);?></td>
		<td colspan="2">: <?php echo $asset_category_type_id;?></td>
	</tr>	
	<tr>
		<td colspan="2"><?php echo __('Cost Center',true) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id;?>&nbsp;<?php echo $cost_center_ids ;?></td>
		<td><?php echo __('Asset Category',true) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id;?></td>
	</tr>	
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Acquisition',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Depr. Cost Straigh Line',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Depr. Cost Double Declining',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Difference',true) ;?></div></td>
	</tr>
	<?php
	$a = 0;
	$b = 0;
	$c = 0;
	$i = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo ($i ); ?></td>
		<td class="left"><?php echo $assetCategories[ $asset['AssetDetail']['asset_category_id'] ]; ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['price'],0 ); ?></td>		
		<td align="right"><?php echo $this->Number->precision( $asset['0']['depr'] ,0); ?></td>
		<td class="number"></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['depr'],0 ); ?></td>
	</tr>
	<?php $a += $this->Number->precision($asset['0']['price'],0);?>
	<?php $b += $this->Number->precision($asset['0']['depr'],0);?>
	<?php $c += $this->Number->precision($asset['0']['depr'],0);?>
	<?php endforeach; ?>
		<tr>
		<td colspan="2"></td>
		<td align="right"><?php echo $this->Number->precision($a,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($b,0); ?></td>
		<td></td>
		<td align="right"><?php echo $this->Number->precision($c,0); ?></td>
	</tr>
	</table>