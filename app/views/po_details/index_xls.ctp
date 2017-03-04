<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('List PO Detail', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if ($this->Session->read('PoDetail.asset_category_type_id',$this->data['PoDetail']['asset_category_type_id']) == null) {
	$asset_category_type_id = 'All';
}else  {
	$asset_category_type_id =  $assetCategoryTypes[$this->Session->read('PoDetail.asset_category_type_id')];
}

if ($this->Session->read('PoDetail.asset_category_id',$this->data['PoDetail']['asset_category_id']) == null) {
	$asset_category_id = 'All';
}else  {
	$asset_category_id =  $assetCategories[$this->Session->read('PoDetail.asset_category_id')];
}

if ($this->Session->read('PoDetail.department_id',$this->data['PoDetail']['department_id']) == null) {
	$department_id = 'All';
}else  {
	$department_id =  $departments[$this->Session->read('PoDetail.department_id')];
}

if ($this->Session->read('PoDetail.currency_id',$this->data['PoDetail']['currency_id']) == null) {
	$currency_id = 'All';
}else  {
	$currency_id =  $currencies[$this->Session->read('PoDetail.currency_id')];
}

if ($this->Session->read('PoDetail.po_status_id',$this->data['PoDetail']['po_status_id']) == null) {
	$po_status_id = 'All';
}else  {
	$po_status_id =  $poStatuses[$this->Session->read('PoDetail.po_status_id')];
}

if ($this->Session->read('PoDetail.supplier_id',$this->data['PoDetail']['supplier_id']) == null) {
	$supplier_id = 'All';
}else  {
	$supplier_id =  $suppliers[$this->Session->read('PoDetail.supplier_id')];
}

	$report_type =  $this->Session->read('PoDetail.report_type');

?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('List PO Detail', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Asset Category Type', true) ;?></td>
		<td>: <?php echo $asset_category_type_id ;?></td>
		<td colspan="2"><?php echo __('Supplier', true) ;?></td>
		<td>: <?php echo $supplier_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td>: <?php echo $asset_category_id ;?></td>
		<td colspan="2"><?php echo __('Po Status', true) ;?></td>
		<td>: <?php echo $po_status_id ;?></td>
	</tr>
	<tr>	
		<td colspan="2"><?php echo __('Branch/Department', true) ;?></td>
		<td>: <?php echo $department_id ;?></td>
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td>: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Currency', true) ;?></td>
		<td>: <?php echo $currency_id ;?></td>	
		<td colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>	
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Report Type', true) ;?></td>
		<td>: <?php echo $report_type ;?></td>	
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('MR', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('MR Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Department', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Business Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cost Center', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Request Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Reject By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Reject Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cancel By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cancel Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Finish', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Approved By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Approved Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('PO No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('PO Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Delivery Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Supplier', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Po Status', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Daily Penalty', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Approval Info', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Currency', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Asset Category', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Code', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Color', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Brand', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Qty Received', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Price Cur', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount Cur', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Discount Cur', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Amount After Disc Cur', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Vat', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Vat Cur', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Payment Term', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Description', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Billing Address', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Shipping Address', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Reject By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Reject Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cancel By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Cancel Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Rp Rate', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date Finish', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Signer 1', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Signer 2', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('PO Address', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Down Payment', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Approved By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Is PPN', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Invoice', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	$amount_after_disc_cur = 0;
	$amount_cur = 0;
	$discount_cur = 0;
	foreach ($poDetails as $poDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$places = $myApp->getPlaces($poDetail['Currency']['is_desimal']);
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $npbs[$poDetail['PoDetail']['npb_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$poDetail['Npb']['npb_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$poDetail['Npb']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $businessType[$poDetail['Npb']['business_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['CostCenter']['name'] .'-'. $poDetail['CostCenter']['cost_centers']; ?>&nbsp;</td>
		<td class="left"><?php echo $requestType[$poDetail['Npb']['request_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['created_by']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$poDetail['Npb']['created_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['reject_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['reject_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['reject_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['cancel_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['cancel_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['cancel_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['date_finish'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['date_finish']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Npb']['approved_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Npb']['approved_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Npb']['approved_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($poDetail['Po']['no'], array('controller' => 'pos', 'action' => 'view', $poDetail['Po']['id'])); ?>		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $poDetail['Po']['po_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $poDetail['Po']['delivery_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $suppliers[$poDetail['Po']['supplier_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poStatuses[$poDetail['Po']['po_status_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['daily_penalty']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['approval_info']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Currency']['name']; ?></td>
		<td class="left"><?php echo $poDetail['AssetCategory']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['type']; ?>&nbsp;</td>
		<td class="center"><?php echo $poDetail['PoDetail']['qty']; ?>&nbsp;</td>
		<td class="center"><?php echo $poDetail['PoDetail']['qty_received']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['price_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['amount_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['discount_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['amount_after_disc_cur'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['vat'], $places); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($poDetail['PoDetail']['vat_cur'], $places); ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['payment_term']. ' Term'; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['description']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['billing_address']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['shipping_address']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['reject_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Po']['reject_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Po']['reject_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['cancel_by']; ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Po']['cancel_date'])?$this->Time->format(DATE_FORMAT,$poDetail['Po']['cancel_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Number->format($poDetail['Po']['rp_rate']); ?>&nbsp;</td>
		<td class="left"><?php echo isset($poDetail['Po']['date_finish'])?$this->Time->format(DATE_FORMAT,$poDetail['Po']['date_finish']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['signer_1']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['signer_2']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['po_address']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Number->format($poDetail['Po']['down_payment']); ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['Po']['approved_by']; ?>&nbsp;</td>
		<td class="left"><?php echo $poDetail['PoDetail']['is_vat']==1?'Yes':'No'; ?>&nbsp;</td>
		<td class="left">
			<?php if(!empty($poDetail['Po']['Invoice'])): ?>
				<?php foreach($poDetail['Po']['Invoice'] as $invoice):?>
					<?php echo $invoice['no'] ; ?>&nbsp;
				<?php endforeach; ?>
			<?php endif; ?>		
		</td>
	</tr>
<?php endforeach; ?>
	</table>