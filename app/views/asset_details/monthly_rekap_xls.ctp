<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Fixed Asset Recap', true).'-'. gmdate("d M Y") . ".xls" );
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
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum. Depr. Cost Last Year',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value Last Year',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Book Value',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Accum. Depr. This Year',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Jan',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Feb',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Mar',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Apr',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('May',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Jun',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Jul',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Aug',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Sep',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Oct',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Nov',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Dec',true) ;?></div></td>
	</tr>
	<?php
	$a = 0;
	$b = 0;
	$c = 0;
	$d = 0;
	$f = 0;
	$g = 0;
	$h = 0;
	$z = 0;
	$x = 0;
	$j = 0;
	$k = 0;
	$l = 0;
	$m = 0;
	$n = 0;
	$o = 0;
	$p = 0;
	$q = 0;
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
		<td align="right"><?php echo $this->Number->precision( $asset['0']['depthnlalu'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['price'] - $asset['0']['depthnlalu'] ,0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['book_value'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['depthnini'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['jan'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['feb'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['mar'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['apr'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['may'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['jun'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['jul'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['aug'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['sep'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['oct'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['nov'],0 ); ?></td>
		<td align="right"><?php echo $this->Number->precision( $asset['0']['dec'],0); ?></td>
	</tr>
	<?php $a += $this->Number->precision($asset['0']['price'],0);?>
	<?php $b += $this->Number->precision($asset['0']['depthnlalu'],0);?>
	<?php $c += $this->Number->precision($asset['0']['price'] - $asset['0']['depthnlalu'],0);?>
	<?php $x += $this->Number->precision($asset['0']['book_value'],0);?>
	<?php $d += $this->Number->precision($asset['0']['depthnini'],0);?>
	<?php $f += $this->Number->precision($asset['0']['jan'],0);?>
	<?php $g += $this->Number->precision($asset['0']['feb'],0);?>
	<?php $h += $this->Number->precision($asset['0']['mar'],0);?>
	<?php $z += $this->Number->precision($asset['0']['apr'],0);?>
	<?php $j += $this->Number->precision($asset['0']['may'],0);?>
	<?php $k += $this->Number->precision($asset['0']['jun'],0);?>
	<?php $l += $this->Number->precision($asset['0']['jul'],0);?>
	<?php $m += $this->Number->precision($asset['0']['aug'],0);?>
	<?php $n += $this->Number->precision($asset['0']['sep'],0);?>
	<?php $o += $this->Number->precision($asset['0']['oct'],0);?>
	<?php $p += $this->Number->precision($asset['0']['nov'],0);?>
	<?php $q += $this->Number->precision($asset['0']['dec'],0);?>
	<?php endforeach; ?>
	<tr>
		<td colspan="2"></td>
		<td align="right"><?php echo $this->Number->precision($a,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($b,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($c,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($x,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($d,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($f,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($g,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($h,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($z,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($j,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($k,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($l,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($m,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($n,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($o,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($p,0); ?></td>
		<td align="right"><?php echo $this->Number->precision($q,0); ?></td>
	</tr>

	</table>