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
if($this->data['Movement']['source_department_id'] == null) {
	$source_department_id = 'All';
}else {
	$source_department_id = $departments[$this->data['Movement']['source_department_id']];
}
if($this->data['Movement']['source_business_type_id'] == null) {
	$source_business_type_id = 'All';
}else {
	$source_business_type_id = $businessType[$this->data['Movement']['source_business_type_id']];
}
if($this->data['Movement']['source_cost_center_id'] == null) {
	$source_cost_center_id = 'All';
}else {
	$source_cost_center_id = $costCenter[$this->data['Movement']['source_cost_center_id']];
}
if($this->data['Movement']['source_cost_center_id'] == null) {
	$source_cost_center_ids = '';
}else {
	$source_cost_center_ids = $costCenters[$this->data['Movement']['source_cost_center_id']];
}


if($this->data['Movement']['dest_department_id'] == null) {
	$dest_department_id = 'All';
}else {
	$dest_department_id = $departments[$this->data['Movement']['dest_department_id']];
}
if($this->data['Movement']['dest_business_type_id'] == null) {
	$dest_business_type_id = 'All';
}else {
	$dest_business_type_id = $businessType[$this->data['Movement']['dest_business_type_id']];
}
if($this->data['Movement']['dest_cost_center_id'] == null) {
	$dest_cost_center_id = 'All';
}else {
	$dest_cost_center_id = $costCenter[$this->data['Movement']['dest_cost_center_id']];
}
if($this->data['Movement']['dest_cost_center_id'] == null) {
	$dest_cost_center_ids = '';
}else {
	$dest_cost_center_ids = $costCenters[$this->data['Movement']['dest_cost_center_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fixed Asset Transfer Report', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Source Department', true) ;?></td>
		<td colspan="3">: <?php echo $source_department_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Source Business Type', true) ;?></td>
		<td colspan="3">: <?php echo $source_business_type_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Source Cost Center', true) ;?></td>
		<td colspan="3">: <?php echo $source_cost_center_id;?>&nbsp;<?php echo $source_cost_center_ids;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Dest Department', true) ;?></td>
		<td colspan="3">: <?php echo $dest_department_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Dest Business Type', true) ;?></td>
		<td colspan="3">: <?php echo $dest_business_type_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Dest Cost Center', true) ;?></td>
		<td colspan="3">: <?php echo $dest_cost_center_id;?>&nbsp;<?php echo $dest_cost_center_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Mov',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inventaris',true) ;?></div></td>
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
	foreach ($movements as $movement):
	?>
	<?php foreach ($movement['MovementDetail'] as $md ) : 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}	
	?>
	
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td align="left"><?php echo $movement['Movement']['no']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['code']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['item_code']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['name']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['brand']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['type']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['color']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['serial_no']; ?></td>
		<td align="left"><?php echo $assetCategories[$md['AssetDetail']['asset_category_id']]; ?></td>
		<td align="left"><?php echo $departments[$movement['Movement']['source_department_id']]; ?></td>
		<td align="left"><?php echo $movement['BusinessType']['name']; ?></td>
		<td align="left" nowrap><?php echo $costCenters[$movement['Movement']['source_cost_center_id']]; ?>-<?php echo $movement['CostCenter']['name'] ;?></td>
		<td align="left"><?php echo $departments[$movement['Movement']['dest_department_id']]; ?></td>
		<td align="left"><?php echo $movement['BusinessType']['name']; ?></td>
		<td align="left" nowrap><?php echo $costCenters[$movement['Movement']['dest_cost_center_id']]; ?>-<?php echo $movement['CostCenter']['name'] ;?></td>
		<td align="left"><?php echo $movement['Movement']['doc_date']; ?></td>
		<td align="left"><?php echo $md['AssetDetail']['date_start']; ?></td>
		<td align="right"><?php echo $this->Number->precision($md['AssetDetail']['price'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($md['AssetDetail']['depthnini'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($md['AssetDetail']['book_value'],0); ?></td>
	</tr>
	<?php $price += $this->Number->precision($md['AssetDetail']['price'],0) ;?>
	<?php $depthnini += $this->Number->precision($md['AssetDetail']['depthnini'],0) ;?>
	<?php $book_value += $this->Number->precision($md['AssetDetail']['book_value'],0) ;?>
	<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<td align="right" colspan="18">Total</td>
		<td align="right"><?php echo $this->Number->precision($price,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($depthnini,0) ;?></td>
		<td align="right"><?php echo $this->Number->precision($book_value,0) ;?></td>
	</tr>
	</table>