<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Retur', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($retur_department_id == null) {
	$department_id = 'All';
}else {
	$department_id = $departments[$retur_department_id];
}
if ($retur_status_id == null) {
	$return = 'All';
}else {
	$return = $returStatuses[$retur_status_id];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Retur', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Branch', true) ;?></td>
		<td colspan="2">: <?php echo $department_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Retur Status', true) ;?></td>
		<td colspan="2">: <?php echo $return ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td colspan="2">: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td colspan="2">: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Retur', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Retur Status', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($returs as $retur):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = $retur['Retur']['retur_status_id']==status_retur_draft_id&&$retur['Retur']['created_by']==$Userinfo['username'];
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $retur['Retur']['no']; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $retur['Retur']['date']); ?></td>
		<td>
			<?php echo $retur['Department']['name']; ?>
		</td>
		<td><?php echo $retur['ReturStatus']['name']; ?></td>
		<td><?php echo $retur['Retur']['created_by']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>