<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Invoices', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$invoice_status_id = '';
$supplier_id = '';

if ($this->data['Invoice']['invoice_status_id'] == null) {
	$invoice_status_id = 'All';
}else  {
		$invoice_status_id = $invoiceStatuses[$this->data['Invoice']['invoice_status_id']];
}
if ($this->Session->read('Invoice.supplier_id') == null) {
	$supplier_id = 'All';
}else  {
		$supplier_id = $suppliers[$this->Session->read('Invoice.supplier_id')];
}
$no = $this->Session->read('Invoice.no');

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Invoices');?></h2></td>
	</tr><tr>
		<td WIDTH="75" colspan="2"><?php echo __('Invoice Status');?></td>
		<td>: <?php echo $invoice_status_id ;?></td>

		<td WIDTH="75"><?php echo __('Date Start');?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Supplier');?></td>
		<td>: <?php echo $supplier_id;?></td>
		
		<td WIDTH="75"><?php echo __('Date End');?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('No');?></td>
		<td>: <?php echo $no;?></td>
		
		<td WIDTH="75"></td>
		<td></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Inv');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Inv Date');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Total');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Paid Date');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Status Invoice');?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Term');?></div></td>
	</tr>
<?php
	$i = 0;
	$group_id			=$this->Session->read('Security.permissions');
	foreach ($invoices as $invoice):
		$status_invoice_id 	= $invoice['Invoice']['status_invoice_id'];	
		$class = null;
		$can_edit = ($group_id==gs_group_id && $status_invoice_id==status_invoice_new_id) ||
					  ($group_id==fincon_group_id && $status_invoice_id==status_invoice_unpaid_id) ;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td align="left"><?php echo $invoice['Invoice']['no']; ?></td>
		<td align="left"><?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?></td>
		<td>
			<?php echo $invoice['Supplier']['name']; ?>
		</td>
		<td align="right"><?php echo $this->Number->precision($invoice['Invoice']['total'],0); ?></td>
		<td align="left"><?php if(!empty($invoice['Invoice']['paid_date'])) :?>
		<?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['paid_date']); ?>
		<?php endif;?></td>
		<td><?php echo $invoice['InvoiceStatus']['name']; ?></td>
		<td class="left">
		<?php 
			if($invoice['InvoicePayment']):
			$k = 0;
				foreach($invoice['InvoicePayment'] as $pay):
						$k++;
						$pay = $k;
				endforeach;
			endif;
			echo $pay.' Term';
		?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>