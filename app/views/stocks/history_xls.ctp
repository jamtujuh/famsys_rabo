<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Stocks history', TRUE).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$departmentid = $departments[$this->data['Stock']['department_id']];
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Stocks History', TRUE) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Branch',true) ;?></td>
		<td colspan="2">: <?php echo $departmentid;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start',true) ;?></td>
		<td colspan="2">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End',true) ;?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Item',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Outlog',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Usage',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Retur',true) ;?></div></td>
	</tr>
<?php
	$i = 0;
	foreach ($stocks as $stock):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $stock['Stock']['date']; ?></td>
		<td><?php echo $stock['Item']['name']; ?></td>
		<td align="center"><?php echo $stock['Stock']['qty']; ?></td>
		<td align="right"><?php echo $this->Number->precision($stock['Stock']['price'],0); ?></td>
		<td align="right"><?php echo $this->Number->precision($stock['Stock']['amount'],0); ?></td>
		<td align="right"><?php echo $stock['Outlog']['no']; ?></td>
		<td align="right"><?php echo $stock['Usage']['no']; ?></td>
		<td align="right"><?php echo $stock['Retur']['no']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>