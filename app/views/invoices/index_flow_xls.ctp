<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Flow_Report', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td WIDTH="75"><?php echo __('Date Start');?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75"><?php echo __('Date End');?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No MR');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No PO');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No DO');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inv');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Inv Date');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Status');?></div></td>
	</tr>
<?php
	$i = 0;
	$group_id=$this->Session->read('Security.permissions');
	foreach ($invoices as $invoice):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?></td>
		<td class="left">
			<?php foreach($npbs as $npb){
				if($invoice['Po'] != null && $invoice['Po'][0]['id'] == $npb['po_id']){
					echo $npb['no'];
					echo "<br>Appr: ".$npb['approved_by']."<br>";
					}
				}							
			?>
		</td>
		<td class="left">
			<?php if($invoice['Po'] != null){
				echo $invoice['Po'][0]['no'];
				echo "<br>Appr: ".$invoice['Po'][0]['approved_by']."<br>";
			};
			?>
		</td>
		<td class="left">
			<?php foreach($invoice['DeliveryOrder'] as $deliveryOrder){
				echo $deliveryOrder['no'];
				echo "<br>Appr: ".$deliveryOrder['approved_by']."<br>";
				}			
			?>
		</td>
		<td class="left">
			<?php echo $invoice['Invoice']['no']; ?>
			<?php echo "<br>Appr: ".$invoice['Invoice']['approved_by']."<br>";?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>&nbsp;</td>
		<td>
			<?php 
			if($invoice['Po'] != null){
				echo "Po: ".$invoice['Po'][0]['status_name']."<br>";
			}	
			if($invoice['InvoiceStatus'] != null){
				echo "Inv: ".$invoice['InvoiceStatus']['name']."<br>";
			}		
		?>
		</td>		
	</tr>
<?php endforeach; ?>
</table>