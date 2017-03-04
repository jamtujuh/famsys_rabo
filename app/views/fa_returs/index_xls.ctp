<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Fa Retur List',true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($this->data['FaRetur']['department_id'] == null) {
	$department_id = 'All';
}else {
	$department_id = $departments[$this->data['FaRetur']['department_id']];
}
if ($this->data['FaRetur']['business_type_id'] == null) {
	$business_type_id = 'All';
}else {
	$business_type_id = $businessTypes[$this->data['FaRetur']['business_type_id']];
}
if ($this->data['FaRetur']['cost_center_id'] == null) {
	$cost_center_id = 'All';
}else {
	$cost_center_id = $costCenter[$this->data['FaRetur']['cost_center_id']];
}
if ($this->data['FaRetur']['cost_center_id'] == null) {
	$cost_center_ids = '';
}else {
	$cost_center_ids = $costCenters[$this->data['FaRetur']['cost_center_id']];
}
if ($this->data['FaRetur']['fa_retur_status_id'] == null) {
	$fa_retur_status_id = 'All';
}else {
	$fa_retur_status_id = $faReturStatuses[$this->data['FaRetur']['fa_retur_status_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Fa Retur List', true  ) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true  ) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td WIDTH="75"><?php echo __('Fa Retur Status', true  ) ;?></td>
		<td>: <?php echo $fa_retur_status_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Business Type', true  ) ;?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
		<td><?php echo __('Date Start', true);?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Cost Center', true  ) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id ;?>&nbsp;<?php echo $cost_center_ids ;?></td>
		<td><?php echo __('Date End', true);?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Retur',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Fa Retur Status',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($faReturs as $faRetur):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td align="left"><?php echo $i; ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $faRetur['FaRetur']['doc_date']); ?></td>
		<td align="left"><?php echo $faRetur['FaRetur']['no']; ?></td>
		<td align="left"><?php echo $faRetur['Department']['name']; ?></td>
		<td align="left"><?php echo $faRetur['BusinessType']['name']; ?></td>
		<td align="left"><?php echo $faRetur['CostCenter']['cost_centers']; ?>-<?php echo $faRetur['CostCenter']['name']; ?></td>
		<td align="left"><?php echo $faRetur['FaRetur']['created_by']; ?></td>
		<td align="left"><?php echo $faRetur['FaReturStatus']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
