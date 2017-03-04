<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Fixed Asset Movement', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
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
 */?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fixed Asset Movement Report per '.$this->Session->read('AssetReport.periode'), true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td colspan="2">: <?php echo  $date_end['month'];?> - <?php echo  $date_end['year'];?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Branch', true) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Business Type', true) ;?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Cost Center', true) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><div align="left"><h3><?php echo __('Cost', true) ;?></h3></div></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Saldo Awal Tahun Lalu',true) ;?></div></th>
		<th  colspan="5" bgcolor="#CCCCCC"><div align="center"><?php echo __('Penambahan Tahun Ini',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Total Penambahan',true) ;?></div></th>
		<th  colspan="6" bgcolor="#CCCCCC"><div align="center"><?php echo __('Pengurang Tahun Ini',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Total Pengurangan',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Ending Balance',true) ;?></div></th>
	</tr>
	<tr>	
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Pembelian',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Mutasi Masuk',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklas dari gol ke gold',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklas',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Revaluasi',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Mutasi Keluar',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Penjualan',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Scrapt',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Revaluasi',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Recalss',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklas gold ke gold',true) ;?></div></th>
	</tr>
	<?php
	$i = 0;
	foreach ($costs as $asset_category_id=>$cost):
		$class = null;
		if ($i++ % 2 == 0) {
			//$class = ' class="altrow"';
		}
	?>	
	<tr<?php echo $class;?>>
		<td><?php echo ($i); ?></td>
		<td class="left"><?php echo $assetCategories[ $asset_category_id ] ; ?></td>
		<td align="right"><?php echo $this->Number->precision($cost['begin_balance'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['add_purchase'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['add_mutasi'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['add_reclass_gol'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['add_reclass'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['add_revaluasi'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['add_total'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_mutasi'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_sales'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_scrapt'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_revaluasi'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_reclass'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_reclass_gol'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['deduct_total'],0)?></td>
		<td align="right"><?php echo $this->Number->precision($cost['ending_balance'],0)?></td>
	</tr>
	<?php endforeach; ?>

</table>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><div align="left"><h3><?php echo __('Accumulated Depreciation', true) ;?></h3></div></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Saldo Awal Tahun Lalu',true) ;?></div></th>
		<th  colspan="5" bgcolor="#CCCCCC"><div align="center"><?php echo __('Penambahan Tahun Ini',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Total Penambahan',true) ;?></div></th>
		<th  colspan="6" bgcolor="#CCCCCC"><div align="center"><?php echo __('Pengurang Tahun Ini',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Total Pengurangan',true) ;?></div></th>
		<th  rowspan="2" bgcolor="#CCCCCC"><div align="center"><?php echo __('Ending Balance',true) ;?></div></th>
	</tr>
	<tr>	
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Pembelian',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Mutasi Masuk',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklas dari gol ke gold',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklas',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Revaluasi',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Mutasi Keluar',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Penjualan',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Scrapt',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Revaluasi',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Recalss',true) ;?></div></th>
		<th  bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklas gold ke gold',true) ;?></div></th>
	</tr>
	<?php
	$i = 0;
	foreach ($deprs as $asset_category_id=>$depr):
		$class = null;
		if ($i++ % 2 == 0) {
			//$class = ' class="altrow"';
		}
	?>	
	<tr<?php echo $class;?>>
		<td><?php echo ($i); ?></td>
		<td class="left"><?php echo $assetCategories[ $asset_category_id ] ; ?></td>
		<td class="number"><?php echo $this->Number->precision($depr['begin_balance'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['add_purchase'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['add_mutasi'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['add_reclass_gol'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['add_reclass'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['add_revaluasi'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['add_total'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_mutasi'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_sales'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_scrapt'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_revaluasi'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_reclass'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_reclass_gol'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['deduct_total'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($depr['ending_balance'],0)?></td>
	</tr>
	<?php endforeach; ?>

</table>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><div align="left"><h3><?php echo __('Book Value', true) ;?></h3></div></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Acuum. Depreciation',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($books as $asset_category_id=>$book):
		$class = null;
		if ($i++ % 2 == 0) {
			//$class = ' class="altrow"';
		}
	?>	
	<tr<?php echo $class;?>>
		<td><?php echo ($i); ?></td>
		<td class="left"><?php echo $assetCategories[ $asset_category_id ] ; ?></td>
		<td class="number"><?php echo $this->Number->precision($book['cost'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($book['depr'],0)?></td>
		<td class="number"><?php echo $this->Number->precision($book['book'],0)?></td>
	</tr>
	<?php endforeach; ?>

</table>