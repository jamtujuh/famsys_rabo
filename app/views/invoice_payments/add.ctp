<div class="invoicePayments form">
<?php echo $this->Form->create('InvoicePayment');?>
	<fieldset>
 		<legend><?php __('Add Invoice Payment'); ?></legend>
	<?php
		echo $this->Form->input('invoice_id', array('type'=>'hidden', 'value'=>$invoice_id));
		echo $this->Form->input('invoice_no', array('readonly'=>true,  'value'=>$invoice_no));
		echo $this->Form->input('supplier_name', array('readonly'=>true,'style'=>'width:50%', 'value'=>$supplier_name));
		echo $this->Form->input('term_no', array('readonly'=>true, 'value'=>$term_no));
		echo $this->Form->input('date_due', array('type'=>'text','readonly'=>true, 'value'=>$date_due));
		echo $this->Form->input('amount_invoice', array('readonly'=>true, 'style'=>'text-align:right','value'=>$this->Number->format($amount_invoice,2)));
		echo $this->Form->input('no');
		echo $this->Form->input('amount_due', array(/*'readonly'=>true,*/ 'style'=>'text-align:right','value'=>$this->Number->format($amount_due, 2)));		
		echo $this->Form->input('description', array('style'=>'width:50%'));
		echo $this->Form->input('bank_account_id', array('options'=>$supplierBankAccounts) ); 
		echo $this->Form->input('bank_account_type_id', array('options'=>$bankAccountTypes,'value'=>$supplier_bank_account_type_id)); 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('View Invoice', true), array('controller' => 'invoices', 'action' => 'view', $invoice_id)); ?> </li>
		<li><?php echo $this->Html->link(__('View Supplier', true), array('controller' => 'suppliers', 'action' => 'view', $supplier_id)); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
	</ul>
</div>