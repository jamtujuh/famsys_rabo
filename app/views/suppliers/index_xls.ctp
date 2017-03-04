<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Supplier', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Supplier', true) ;?></h2></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Supplier',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Address',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Email',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Telp/HP',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Fax',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Contact Person',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Default Wht Rate',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($suppliers as $supplier):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	
	<tr<?php echo $class;?>>
	
		<td><?php echo $i; ?></td>
		<td><?php echo $supplier['Supplier']['no']; ?></td>
		<td><?php echo $supplier['Supplier']['name']; ?></td>
		<td><?php echo $supplier['Supplier']['address']; ?></td>
		<td><?php echo $supplier['Supplier']['email']; ?>&nbsp;</td>
		<td>
		Tel: <?php echo $supplier['Supplier']['telephone']; ?>&nbsp;<br>
		HP: <?php echo $supplier['Supplier']['hp']; ?>&nbsp;
		</td>
		<td>Fax: <?php echo $supplier['Supplier']['fax']; ?></td>
		<td><?php echo $supplier['Supplier']['contact_person']; ?></td>
		<td><?php echo $supplier['Supplier']['default_wht_rate']; ?></td>
	</tr>
	<?php endforeach; ?>
	</table>