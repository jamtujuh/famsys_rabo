<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Outlogs', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['Outlog']['department_id'] == null) {
		$department_id = 'All';
}else {
		$department_id = $departments[$this->data['Outlog']['department_id']];
}
if($this->data['Outlog']['outlog_status_id'] == null) {
		$outlog_status_id = 'All';
}else {
		$outlog_status_id = $outlogStatuses[$this->data['Outlog']['outlog_status_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Outlogs', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Outlog Status', true);?></td>
		<td colspan="2">: <?php echo $outlog_status_id;?></td>
		<td WIDTH="75"><?php echo __('Date Start', true);?></td>
		<td colspan="2">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true);?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td WIDTH="75"><?php echo __('Date End', true);?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No Outlog', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Outlog Status', true);?></div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($outlogs as $outlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $outlog['Outlog']['no']; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $outlog['Outlog']['date']); ?></td>
		<td><?php echo $outlog['Department']['name']; ?></td>
		<td><?php echo $outlog['OutlogStatus']['name']; ?></td>
		<td><?php echo $outlog['Outlog']['created_by']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>