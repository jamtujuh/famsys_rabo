<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Assets', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>


<?php
if($this->Session->read('Asset.department_id') == null){
	$department_id = 'All';
}else {
	$department_id = $departments[$this->Session->read('Asset.department_id')];
}
if($this->Session->read('Asset.business_type_id') == null){
	$business_type_id = 'All';
}else {
	$business_type_id = $businessType[$this->Session->read('Asset.business_type_id')];
}
if($this->Session->read('Asset.cost_center_id') == null){
	$cost_center_id = 'All';
}else {
	$cost_center_id = $costCenter[$this->Session->read('Asset.cost_center_id')];
}
if($this->Session->read('Asset.cost_center_id') == null){
	$cost_center_ids = '';
}else {
	$cost_center_ids = $costCenters[$this->Session->read('Asset.cost_center_id')];
}

/* if($this->Session->read('Asset.department_sub_id') == null){
	$department_sub_id = 'All';
}else {
	$department_sub_id = $departmentSub[$this->Session->read('Asset.department_sub_id')];
}
if($this->Session->read('Asset.department_unit_id') == null){
	$department_unit_id = 'All';
}else {
	$department_unit_id = $departmentUnit[$this->Session->read('Asset.department_unit_id')];
}
 */
if($this->Session->read('Asset.asset_category_id') == null){
	$asset_category_id = 'All';
}else {
	$asset_category_id = $assetCategories[$this->Session->read('Asset.asset_category_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Assets', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true) ;?></td>
		<td colspan="2">: <?php echo $department_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Business Type', true) ;?></td>
		<td colspan="2">: <?php echo $business_type_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Cost Center', true) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id ;?>&nbsp;<?php echo $cost_center_ids ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td colspan="2">: <?php echo $asset_category_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Search Keyword', true) ;?></td>
		<td colspan="2">: <?php echo $this->data['Asset']['search_keyword'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Code',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Location',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Unit Cost',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Total Acquisition Cost',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Economic Age',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Monthy Depreciation',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value 31/12/',true) .($this->Session->read('AssetReport.year')-1);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum. Depr 31/12/',true).($this->Session->read('AssetReport.year')-1);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value 31/12/',true).$this->Session->read('AssetReport.year');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum. Depr 31/12/',true).$this->Session->read('AssetReport.year');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('FA Register',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Of Purchase',true) ;?></div></td>
	</tr>
<?php
	$i = 0;
	$qty = 0;
	$price = 0;
	$amount = 0;
	$maksi = 0;
	$depbln = 0;
	$hpthnlalu = 0;
	$depthnlalu = 0;
	$book_value = 0;
	$depthnini = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$asset['Asset']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $businessType[$asset['Asset']['business_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $costCenter[$asset['Asset']['cost_center_id']]; ?><?php echo $asset['CostCenter']['name'] ;?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['type']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Location']['name']; ?>&nbsp;</td>
		<td align="right"><?php echo $asset['Asset']['qty']; ?>&nbsp;</td>
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['price'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['amount'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['maksi'] ,0) ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['depbln'] ,0); ?></td>
		
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['hpthnlalu'] ,0); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['depthnlalu'] ,0); ?></td>

		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['book_value'] ,0); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['Asset']['depthnini'] ); ?>&nbsp;</td>
		<td><?php echo $asset['Purchase']['no']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_of_purchase'] ); ?></td>

	</tr>
	<?php $qty += $this->Number->precision($asset['Asset']['qty'],0) ;?>
	<?php $price += $this->Number->precision($asset['Asset']['price'],0) ;?>
	<?php $amount += $this->Number->precision($asset['Asset']['amount'],0) ;?>
	<?php $maksi += $this->Number->precision($asset['Asset']['maksi'],0) ;?>
	<?php $depbln += $this->Number->precision($asset['Asset']['depbln'],0) ;?>
	<?php $hpthnlalu += $this->Number->precision($asset['Asset']['hpthnlalu'],0) ;?>
	<?php $depthnlalu += $this->Number->precision( $asset['Asset']['depthnlalu'],0) ;?>
	<?php $book_value += $this->Number->precision($asset['Asset']['book_value'],0) ;?>
	<?php $depthnini += $this->Number->precision($asset['Asset']['depthnini'] ,0);?>
<?php endforeach; ?>
	<tr>
		<td colspan="10"><div align="right">Total</div></td>
		<td align="center"><?php echo $this->Number->precision($qty,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($price,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($amount,0) ;?></td>
		<td align="right">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right"><?php echo $this->Number->precision($hpthnlalu,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($depthnlalu,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($book_value,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($depthnini,0) ;?></td>
	</tr>
	</table>