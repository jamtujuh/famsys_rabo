<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" . __('Fixed Asset Details Report per ', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$is_inventory = $this->Session->read('AssetReport.is_inventory');
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
}else {
	$cost_center_id = $costCenter[$this->Session->read('AssetReport.cost_center_id')];
}
if ($this->Session->read('AssetReport.cost_center_id') == null) {
	$cost_center_ids = '';
}else {
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
if($this->Session->read('AssetReport.source') == null){
	$source = 'All';
}else{
	$source = $this->Session->read('AssetReport.source');
}
if($this->Session->read('AssetReport.efektif') == null){
	$efektif = 'All';
}else{
	$efektif = $this->Session->read('AssetReport.efektif');
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fixed Asset Details Report per '.$date_end['month']  . '-' . $date_end['year'], true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td colspan="2">: <?php echo $date_end['month']  ;?>-<?php echo $date_end['year'];?></td>
		<td colspan="2"><?php echo __('Below Minimum Value', true) ;?></td>
		<td colspan="2">: <?php echo $is_inventory;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Branch', true) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td colspan="2"><?php echo __('Asset Category Type', true) ;?></td>
		<td colspan="2">: <?php echo $asset_category_type_id;?></td>
	</tr>	
	<tr>
		<td colspan="2"><?php echo __('Business Type', true) ;?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
		<td colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id;?></td>
	</tr>	
	<tr>
		<td colspan="2"><?php echo __('Cost Center', true) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id;?>&nbsp;<?php echo $cost_center_ids ;?></td>
		<td colspan="2"><?php echo __('Search Keyword', true) ;?></td>
		<td colspan="2">: <?php echo $this->Session->read('AssetReport.name');?></td>
	</tr>	
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Source', true  ) ;?></td>
		<td colspan="2">: <?php echo $source ;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date Of Purchase Start', true  ) ;?></td>
		<td colspan="2">: <?php echo $date_of_purchase_start['month'];?>-<?php echo $date_of_purchase_start['day'];?>-<?php echo $date_of_purchase_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Efektif', true  ) ;?></td>
		<td colspan="2">: <?php echo $efektif ;?></td>
		<td WIDTH="75" colspan="2"><?php echo __('Date Of Purchase End', true  ) ;?></td>
		<td colspan="2">: <?php echo $date_of_purchase_end['month'];?>-<?php echo $date_of_purchase_end['day'];?>-<?php echo $date_of_purchase_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inventaris',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Location',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Serial No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Start Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('End Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Monthly Depr',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Unit Cost',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum Depr Last Year',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value Last Year',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum Depr This Year',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value This Year',true) ;?></div></td>
	</tr>
	<?php
	$price = 0;
	$depthnlalu = 0;
	$book_value_thnlalu = 0;
	$depthnini = 0;
	$book_value = 0;
	$i = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td class="left"><?php echo $myApp->showArrayValue($departments,$asset['AssetDetail']['department_id'] ); ?></td>
		<td class="left"><?php echo $myApp->showArrayValue($businessType,$asset['AssetDetail']['business_type_id']) ; ?></td>
		<td class="left"><?php echo $myApp->showArrayValue($costCenter,$asset['AssetDetail']['cost_center_id'] ); ?>-<?php echo $myApp->showArrayValue($costCenters,$asset['AssetDetail']['cost_center_id']) ; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['code']; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['item_code']; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['name']; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['brand']; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['type']; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['color']; ?></td>
		<td class="left"><?php echo $asset['Location']['name']; ?></td>
		<td class="left"><?php echo $asset['AssetDetail']['serial_no']; ?></td>
		<td class="left"><?php  if(!empty($asset['AssetDetail']['date_start'])) :
				echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_start']); 
								endif; ?></td>
		<td class="left"><?php  if(!empty($asset['AssetDetail']['date_end'])) :
				echo $this->Time->format(DATE_FORMAT, $asset['AssetDetail']['date_end']); 
								endif; ?></td>

		<td align="right"><?php echo $this->Number->precision( $asset['AssetDetail']['depbln'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['AssetDetail']['price'],0 ); ?></td>		
		<td align="right"><?php echo $this->Number->precision( $asset['AssetDetail']['depthnlalu'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['AssetDetail']['book_value_thnlalu'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['AssetDetail']['depthnini'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['AssetDetail']['book_value'],0 ); ?></td>

	</tr>
	<?php $price += $this->Number->precision($asset['AssetDetail']['price'],0);?>
	<?php $depthnlalu += $this->Number->precision($asset['AssetDetail']['depthnlalu'],0);?>
	<?php $book_value_thnlalu += $this->Number->precision($asset['AssetDetail']['book_value_thnlalu'],0);?>
	<?php $depthnini += $this->Number->precision($asset['AssetDetail']['depthnini'],0);?>
	<?php $book_value += $this->Number->precision($asset['AssetDetail']['book_value'],0);?>
<?php endforeach; ?>
	<tr>
		<td colspan="15"><div align="right">Total</div></td>
		<td align="right"><?php echo $this->Number->precision($price,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($depthnlalu,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($book_value_thnlalu,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($depthnini,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($book_value,0); ?></td>
	</tr>
	</table>