<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Supplier History', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Supplier History', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Supplier', true) ;?></td>
		<td>: <?php echo $suppliers[$this->Session->read('Supplier.supplier_id')];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No PO',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Po Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Delivery Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Finish Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Selisih',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Is done',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($pos as $po):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	
	<tr<?php echo $class;?>>
	
		<td><?php echo $i; ?></td>
		<td><?php echo $po['Po']['no']; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['date_finish']); ?></td>
		<?php
		    $expiredate=strtotime($po['Po']['date_finish']);
			$cdate=strtotime($po['Po']['delivery_date']);
			$dateDiff = $expiredate - $cdate;
			$fullDays = floor($dateDiff/(60*60*24));
		if(	$fullDays <= 0) {
		$hari = 'Good';
		}else {
		 $fullDays > 0;
		 $hari = "$fullDays days";
		}
		?>
		<td><?php echo $hari ;?></td>
		<?php
		if($po['Po']['v_is_done'] = 1){
			$sup = 'Yes';
		}else{
			$sup = 'No';
		}
		?>
		<td><?php echo $sup ;?></td>
	</tr>
	<?php endforeach; ?>
	</table>
