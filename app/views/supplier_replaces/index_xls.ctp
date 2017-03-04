<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('SupplierReplaces', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($supplier_replace_department_id == null) {
	$department_id = 'All';
}else {
	$department_id = $departments[$replace_department_id];
}
if ($supplier_replace_status_id == null) {
	$replacen = 'All';
}else {
	$replacen = $supplierReplaceStatuses[$supplier_replace_status_id];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('SupplierReplaces', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Branch', true) ;?></td>
		<td colspan="2">: <?php echo $department_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Supplier Replace Status', true) ;?></td>
		<td colspan="2">: <?php echo $replacen ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td colspan="2">: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td colspan="2">: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No SupplierReplace', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier Replace Status', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($supplier_replaces as $supplier_replace):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = $supplier_replace['SupplierReplace']['supplier_replace_status_id'] == status_supplier_replace_draft_id ? true: false;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $supplier_replace['SupplierReplace']['no']; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $supplier_replace['SupplierReplace']['date']); ?></td>
		<td><?php echo $supplier_replace['Department']['name']; ?></td>
		<td><?php echo $supplier_replace['SupplierReplaceStatus']['name']; ?></td>		
		<td><?php echo $supplier_replace['SupplierReplace']['created_by']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
