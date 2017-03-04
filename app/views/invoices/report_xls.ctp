<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Invoices ', true) .$type.'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>

<?php
$supplier_id = 'All';

if ($this->Session->read('Invoice.supplier_id') == null) {
	$supplier_id = 'All';
}else  {
		$supplier_id = $suppliers[$this->Session->read('Invoice.supplier_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Invoices', true);?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Supplier', true);?></td>
		<td colspan="2">: <?php echo $supplier_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true);?></td>
		<td colspan="2">: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true);?></td>
		<td colspan="2">: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Invoice Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Request Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Total (Rp)', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Paid Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Paid Bank Account No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Paid Bank Account Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Status Invoice', true);?></div></td>
	</tr>
	
		<?php
	$i = 0;
	$group_id	=$this->Session->read('Security.permissions');
	foreach ($invoices as $invoice):
		$status_invoice_id 	= $invoice['Invoice']['status_invoice_id'];	
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?></td>
		<td><?php echo $invoice['RequestType']['name']; ?>	</td>
		<td><?php echo $invoice['Supplier']['name']; ?>	</td>
		<!--td><?php echo $invoice['Invoice']['description']; ?></td-->
		<td align="right"><?php echo $this->Number->precision($invoice['Invoice']['total'],0); ?></td>
		<td class="left"><?php echo $invoice['Invoice']['paid_date']?$this->Time->format(DATE_FORMAT, $invoice['Invoice']['paid_date']):''; ?></td>
		<td class="left"><?php echo $invoice['Invoice']['bank_account_id']?$supplierBankAccounts[$invoice['Invoice']['bank_account_id']]:''; ?></td>
		<td class="left"><?php echo empty($invoice['Invoice']['paid_bank_account_type_id'])?'':$bankAccountTypes[$invoice['Invoice']['paid_bank_account_type_id']]; ?></td>
		<td><?php echo $invoice['InvoiceStatus']['name']; ?></td>
		</td>
	</tr>
<?php endforeach; ?>
	</table>