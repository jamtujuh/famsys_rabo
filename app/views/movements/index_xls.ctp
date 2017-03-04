<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('FA Transfer',true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>

<?php
if($this->data['Movement']['movement_status_id'] == null) {
	$movement_status_id = 'All';
}else {
	$movement_status_id = $movement_statuses[$this->data['Movement']['movement_status_id']];
}

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

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('FA Transfer',true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('FA Transfer Status',true);?></td>
		<td>: <?php echo $movement_status_id ;?></td>
		<td><?php echo __('Source Branch',true);?></td>
		<td>: <?php echo $source_department_id ;?></td>
		<td><?php echo __('Dest Branch',true);?></td>
		<td>: <?php echo $dest_department_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start',true) ;?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
		<td><?php echo __('Source Business Type',true);?></td>
		<td>: <?php echo $source_business_type_id ;?></td>
		<td><?php echo __('Dest Business Type',true);?></td>
		<td>: <?php echo $dest_business_type_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End',true);?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
		<td><?php echo __('Source Cost Center',true);?></td>
		<td>: <?php echo $source_cost_center_id ;?></td>
		<td><?php echo __('Dest Cost Center',true);?></td>
		<td>: <?php echo $dest_cost_center_id ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Origin Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Dest Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('FA Transfer Status',true) ;?></div></td>
	</tr>
<?php
	$i = 0;
	$group_id=$this->Session->read('Security.permissions');
	foreach ($movements as $movement):
		$class = null;
		$can_edit 		= $movement['Movement']['movement_status_id']==status_movement_new_id && $group_id==gs_group_id;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $movement['Movement']['doc_date']; ?></td>
		<td><?php echo $movement['Movement']['no']; ?></td>
		<td><?php echo $departments[$movement['Movement']['source_department_id']]; ?></td>
		<td><?php echo $departments[$movement['Movement']['dest_department_id']] ;?></td>
		<td><?php echo $movement['Movement']['created_by']; ?></td>
		<td><?php echo $movement['MovementStatus']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>