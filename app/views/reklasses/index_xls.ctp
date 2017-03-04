<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Reklass', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->data['Reklass']['reklas_status_id'] == null) {
		$reklas_status_id = 'All';
}else {
		$reklas_status_id = $reklasStatus[$this->data['Reklass']['reklas_status_id']];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Reklass', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75"><?php echo __('Reklass Status', true);?></td>
		<td colspan="2">: <?php echo $reklas_status_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75"><?php echo __('Date Start', true);?></td>
		<td colspan="2">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75"><?php echo __('Date End', true);?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td width="20" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td width="100" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc No', true);?></div></td>
		<td width="70" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td width="200" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Amortisasi', true);?></div></td>
		<td width="160" align="center" valign="middle" bgcolor="#CCCCCC"><div align="center"><?php echo __('Reklass Status', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($reklasses as $reklas):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td align="left"><?php echo $reklas['Reklass']['doc_no']; ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $reklas['Reklass']['date']); ?></td>
		<td align="left" nowrap="nowrap"><?php echo $reklas['Asset']['code']; ?> - <?php echo $reklas['Asset']['name']; ?></td>
		<td align="left"><?php echo $reklas['AssetCategory']['name']; ?></td>
		<td align="right"><?php echo $this->Number->precision($reklas['Reklass']['amount'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($reklas['Reklass']['depthnini'],0); ?></td>
		<td align="left"><?php echo $reklas['ReklasStatus']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>