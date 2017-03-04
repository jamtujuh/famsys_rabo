<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Supplier POs', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($this->Session->read('Po.supplier_id') == null) {
	$supplier_id = 'All';
}else  {
	$supplier_id =  $suppliers[$this->Session->read('Po.supplier_id')];
}
if ($this->Session->read('Po.currency_id') == null) {
	$currency_id = 'All';
}else  {
	$currency_id = $currencies[$this->Session->read('Po.currency_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Supplier POs', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Supplier', true) ;?></td>
		<td>: <?php echo $supplier_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Currency', true) ;?></td>
		<td>: <?php echo $currency_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td>: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Total', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	$id_group=$this->Session->read('Security.permissions');
	
	foreach ($pos as $po):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	$places = $myApp->getPlaces($currency[$po['Po']['currency_id']]);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td align="left"><?php echo $suppliers[$po['Po']['supplier_id']]; ?></td>
		<td align="left"><?php echo $currencies[$po['Po']['currency_id']]; ?></td>
		<td align="right"><?php echo $this->Number->format($po[0]['total'], $places); ?></td>
		</tr>
<?php endforeach; ?>
	</table>