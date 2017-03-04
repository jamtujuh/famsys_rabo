<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('User', true).'-'. date('Y-m-d h:i A') . ".xls" );
//header ("Content-Description: Generated Report" );
?>

<?php 
if($this->Session->read('User.department_id') == null) {
		$department_id = 'All';
}else {
		$department_id = $departments[$this->Session->read('User.department_id')];
}
if($this->Session->read('User.business_type_id') == null) {
		$business_type_id = 'All';
}else {
		$business_type_id = $businessType[$this->Session->read('User.business_type_id')];
}
if($this->Session->read('User.cost_center_id') == null) {
		$cost_center_id = 'All';
}else {
		$cost_center_id = $costCenters[$this->Session->read('User.cost_center_id')];
}
if($this->Session->read('User.name') == null) {
		$name = 'All';
}else {
		$name = $this->Session->read('User.name');
}
if($this->Session->read('User.aktif') == null) {
		$aktif = 'All';
}
elseif($this->Session->read('User.aktif') == 1) {
		$aktif = 'ENABLED';
}
elseif($this->Session->read('User.aktif') == 2) {
		$aktif = 'DISABLED';
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('User', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true);?></td>
		<td colspan="2">: <?php echo $department_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Business Type', true);?></td>
		<td colspan="2">: <?php echo $business_type_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Cost Center', true);?></td>
		<td colspan="2">: <?php echo $cost_center_id ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Aktif', true);?></td>
		<td colspan="2">: <?php echo $aktif ;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Search Name Or Username', true);?></td>
		<td colspan="2">: <?php echo $name ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Username',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Email', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Group', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Last Password Change', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('AD Username', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('AD Password', true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Aktif', true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$status = ($user['User']['aktif']==1)?'ENABLED':'DISABLED';
		
		if($status == 'ENABLED') {
			$class = ' style="color:green;font-weight:bold"';
		}
		else if ($status == 'DISABLED') {
			$class = ' style="color:red;font-weight:bold"';
		}

	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $user['User']['username']; ?></td>
		<td><?php echo $user['User']['email']; ?></td>
		<td><?php echo $user['User']['name']; ?></td>
		<td><?php echo $user['Group']['name']; ?></td>
		<td><?php echo $user['Department']['name']; ?></td>
		<?php //echo $user['DepartmentSub']['name']; ?>
		<?php //echo $user['DepartmentUnit']['name']; ?>
		<td><?php echo $user['BusinessType']['name']; ?></td>
		<td><?php echo $user['CostCenter']['cost_centers']; ?> - <?php echo $user['CostCenter']['name']; ?></td>
		<td><?php echo $user['User']['last_password_change']; ?></td>
		<td><?php echo $user['User']['ad_user']; ?></td>
		<td><?php echo $user['User']['ad_pass']; ?></td>
		<td><?php echo $status; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
