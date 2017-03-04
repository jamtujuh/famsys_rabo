<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('IT Log', true).'-'. date('Y-m-d h:i A') . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><h2><?php echo __('IT Log', true) ;?></h2></td>
	</tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Username',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Process',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Status',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Remark',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($activitylogs as $activitylog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td align="left"><?php echo $i; ?></td>
		<td align="left"><?php echo $activitylog['ActivityLog']['username']; ?></td>
		<td align="left"><?php echo $activitylog['ActivityLog']['process']; ?></td>
		<td align="left"><?php echo $activitylog['ActivityLog']['status']; ?></td>
		<td align="left"><?php echo strftime("%H:%M:%S %d-%m-%Y" , strtotime($activitylog['ActivityLog']['created'])); ?></td>
		<td align="left"><?php echo $activitylog['ActivityLog']['remark']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
