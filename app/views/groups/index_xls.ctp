<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Group', true).'-'. date('Y-m-d h:i A') . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="2"><h2><?php echo __('Groups', true) ;?></h2></td>
	</tr>
</table>

<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Auth Amount',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Is Admin',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Descr',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($groups as $group):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

	?>
	<tr<?php echo $class;?>>
		<td align="left"><?php echo $i; ?></td>
		<td align="left"><?php echo $group['Group']['name']; ?></td>
		<td align="left"><?php echo $this->Number->precision($group['Group']['auth_amount']); ?></td>
		<td align="left"><?php echo $group['Group']['is_admin']==1?'Yes':'No'; ?></td>
		<td align="left"><?php echo $group['Group']['descr']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
