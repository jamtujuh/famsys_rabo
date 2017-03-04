<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Item Pending', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['NpbDetail']['department_id'] == null) {
		$department_id = 'All';
}else {
		$department_id = $departments[$this->data['NpbDetail']['department_id']];
}
if($this->data['NpbDetail']['business_type_id'] == null) {
		$business_type_id = 'All';
}else {
		$business_type_id = $businessTypes[$this->data['NpbDetail']['business_type_id']];
}
if($this->data['NpbDetail']['cost_center_id'] == null) {
		$cost_center_id = 'All';
}else {
		$cost_center_id = $costCenters[$this->data['NpbDetail']['cost_center_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Item Pending', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch', true);?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Business Type', true);?></td>
		<td colspan="2">: <?php echo $business_type_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Cost Center', true);?></td>
		<td colspan="2">: <?php echo $cost_center_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Memo Request', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Busines Type', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center', true);?></div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Item', true);?></div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty', true);?></div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty Filled', true);?></div></td>
		<td width="130" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Process Type', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($npbDetails as $npbDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td align="left"><?php echo $npbDetail['Npb']['no']; ?></td>
		<td align="left"><?php echo $departments[$npbDetail['Npb']['department_id']]; ?>&nbsp;</td>
		<td align="left"><?php echo $businessTypes[$npbDetail['Npb']['business_type_id']]; ?>&nbsp;</td>
		<td align="left"><?php echo $costCenters[$npbDetail['Npb']['cost_center_id']]; ?>&nbsp;</td>
		<td align="left"><?php echo $npbDetail['Item']['name']; ?></td>
		<td align="center"><?php echo $npbDetail['NpbDetail']['qty']; ?>&nbsp;</td>
		<td align="center"><?php echo $npbDetail['NpbDetail']['qty_filled']; ?>&nbsp;</td>
		<td><?php echo $npbDetail['ProcessType']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>