<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Config', true).'-'. date('Y-m-d h:i A') . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><h2><?php echo __('Config', true) ;?></h2></td>
	</tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Key',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Value',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($configs as $config):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

	?>
	<tr<?php echo $class;?>>
		<td align="left"><?php echo $config['Config']['key']; ?></td>
		<td align="left"><?php echo $config['Config']['value']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
