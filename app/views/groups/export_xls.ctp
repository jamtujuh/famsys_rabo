<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Group Menu', true).'-'. date('Y-m-d h:i A') . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><h2><?php echo __('Group Menu '.$groups['Group']['name'].'', true) ;?></h2></td>
	</tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Parent',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Title',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($groups['Menu'] as $group):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

	?>
	<tr<?php echo $class;?>>
		<td align="left"><?php echo $i; ?></td>
		<td align="left"><?php echo isset($group['parent_id'])?$menu[$group['parent_id']]:'';?></td>
		<td align="left"><?php echo $group['title']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
