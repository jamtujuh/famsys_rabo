<div id="moduleName"><?php echo 'Report > Transfer Intern'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('InvoicePayment', array('action'=>'transfer_intern')) ?>
	<fieldset><legend><?php __('Invoice Payment Transfer Intern')?></legend>

 	<!--fieldset class="subfilter" style="width:30%">
	<legend><?php __('Inlog Filters')?></legend>
	<?php echo $this->Form->input('inlog_status_id',array('empty'=>'all','value'=>$inlog_status_id)) ?>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$inlog_supplier_id)) ?>
	</fieldset-->
 	<fieldset class="subfilter" style="width:37%">
	<legend><?php __('Paid Date Filters')?></legend>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen' , 'pdf'=>'PDF' ,'xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

</div>

<div class="Invoice Payment">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_name');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_no');?></th>
			<th><?php echo $this->Paginator->sort('bank_name');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_type_id');?></th>
			<th><?php echo $this->Paginator->sort('Currency');?></th>
			<th><?php echo $this->Paginator->sort('Amount Cur');?></th>
			<th><?php echo $this->Paginator->sort('rate');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('Status');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($invoicePayments as $invoicePayment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		//debug($invoicePayment);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $supplier[$invoicePayment['Invoice']['supplier_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccount']['bank_account_name']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccount']['bank_account_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccount']['bank_name']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['BankAccountType']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $currency[$invoicePayment['Invoice']['currency_id']]; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_paid']/$invoicePayment['Invoice']['rp_rate'],2); ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format($invoicePayment['Invoice']['rp_rate'],2); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_paid']); ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['InvoicePaymentStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $invoicePayment['InvoicePayment']['description']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
	 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>