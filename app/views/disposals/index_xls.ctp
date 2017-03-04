<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Disposals '.$disposalTypes[$type].'', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>

<?php
if($this->data['Disposal']['disposal_status_id'] == null) {
	$disposal_status_id = 'All';
}else {
	$disposal_status_id = $disposal_statuses[$this->data['Disposal']['disposal_status_id']];
}
if($this->data['Disposal']['department_id'] == null) {
	$department_id = 'All';
}else {
	$department_id = $deparments[$this->data['Disposal']['department_id']];
}

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Disposals '.$disposalTypes[$type].'', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Disposal Status', true) ;?></td>
		<td colspan="2">: <?php echo $disposal_status_id;?></td>
		<td><?php echo __('Date Start', true) ;?></td>
		<td colspan="2">: <?php echo  $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Department', true) ;?></td>
		<td colspan="2">: <?php echo $department_id;?></td>
		<td><?php echo __('Date End', true) ;?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc Date',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Doc No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Disposal Status',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Disposal Type',true) ;?></div></td>
	</tr>
<?php
	$i = 0;
	foreach ($disposals as $disposal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $disposal['Disposal']['doc_date']); ?></td>
		<td><?php echo $disposal['Disposal']['no']; ?></td>
		<td><?php echo $disposal['Department']['name'] ; ?>	</td>
		<td><?php echo $disposal['Disposal']['created_by']; ?></td>
		<td><?php echo $disposal['DisposalStatus']['name']; ?></td>
		<td><?php echo $disposal['DisposalType']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
