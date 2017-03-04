<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Inlogs', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['Inlog']['supplier_id'] == null) {
		$supplier_id = 'All';
}else {
		$supplier_id = $suppliers[$this->data['Inlog']['supplier_id']];
}

if($this->data['Inlog']['inlog_status_id'] == null) {
		$inlog_status_id = 'All';
}else {
		$inlog_status_id = $pos[$this->data['Inlog']['inlog_status_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Inlogs', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Supplier', true);?></td>
		<td>: <?php echo $supplier_id;?></td>
		<td><?php echo __('Date Start', true);?></td>
		<td>: <?php echo  $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Po', true);?></td>
		<td>: <?php echo $inlog_status_id;?></td>
		<td><?php echo __('Date End', true);?></td>
		<td>: <?php echo  $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td width="90" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inlog', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td width="140" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Po', true);?></div></td>
		<td width="90" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($inlogs as $inlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $inlog['Inlog']['no']; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $inlog['Inlog']['date']); ?></td>
		<td><?php echo $inlog['Supplier']['name'];?></td>
		<td><?php echo $inlog['Po']['no']; ?></td>
		<td><?php echo $inlog['Inlog']['created_by']; ?></td>
	</tr>
<?php endforeach; ?>
</table>