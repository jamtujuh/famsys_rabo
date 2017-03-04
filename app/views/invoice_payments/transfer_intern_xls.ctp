<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Transfer Intern', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
/* if($this->data['Inlog']['supplier_id'] == null) {
		$supplier_id = 'All';
}else {
		$supplier_id = $suppliers[$this->data['Inlog']['supplier_id']];
}

if($this->data['Inlog']['inlog_status_id'] == null) {
		$inlog_status_id = 'All';
}else {
		$inlog_status_id = $pos[$this->data['Inlog']['inlog_status_id']];
} */
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Transfer Intern', true);?></h2></td>
	</tr>
	<tr>
		<td><?php echo __('Date Start', true);?></td>
		<td>: <?php echo  $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
		<td><?php echo __('Date End', true);?></td>
		<td>: <?php echo  $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'No';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Supplier';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Bank Account Name';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Bank Account No';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Bank Name';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Bank Account Type';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Currency';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Amount Cur';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Rate';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Amount';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Status';?></th>
			<th align="center" valign="middle" bgcolor="#CCCCCC"><?php echo 'Description';?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($invoicePayments as $invoicePayment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $supplier[$invoicePayment['Invoice']['supplier_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccount']['bank_account_name']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccount']['bank_account_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccount']['bank_name']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccountType']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $currency[$invoicePayment['Invoice']['currency_id']]; ?>&nbsp;</td>
		<td class="right"><?php echo $this->Number->precision($invoicePayment['InvoicePayment']['amount_paid']/$invoicePayment['Invoice']['rp_rate'],0); ?></td>
		<td class="right"><?php echo $this->Number->precision($invoicePayment['Invoice']['rp_rate'],0); ?></td>
		<td class="right"><?php echo $this->Number->precision($invoicePayment['InvoicePayment']['amount_paid']); ?></td>
		<td class="left"><?php echo $invoicePayment['InvoicePaymentStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['InvoicePayment']['description']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
