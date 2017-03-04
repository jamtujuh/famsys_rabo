<div class="invoicePayments form">
<?php echo $this->Form->create('InvoicePayment');?>
	<fieldset>
 		<legend><?php __('Input Invoice Payment'); ?></legend>
	<?php
		echo $this->Form->input('id', 			array('type'=>'hidden'));
		echo $this->Form->input('invoice_id', 	array('type'=>'hidden'));
		echo $this->Form->input('po_id', 		array('type'=>'hidden'));
		echo $this->Form->input('po_payment_id', array('type'=>'hidden'));
		
		echo $this->Form->input('invoice_no', array('readonly'=>true,  'value'=>$invoice_no));
		echo $this->Form->input('invoice_payment_status_id', array('type'=>'hidden',  'value'=>status_invoice_payment_draft_id));
		echo $this->Form->input('supplier_name', array('readonly'=>true,'style'=>'width:50%', 'value'=>$supplier_name));
		echo $this->Form->input('term_no',  array('type'=>'text','readonly'=>true));
		echo $this->Form->input('date_due', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('amount_invoice', array('readonly'=>true,  'style'=>'text-align:right','value'=>$this->Number->format($this->data['InvoicePayment']['amount_invoice'])));
		echo $this->Form->input('no', array('readonly'=>true) );
		echo $this->Form->input('amount_due', array( 'readonly'=>true,  'style'=>'text-align:right','value'=>$this->Number->format($this->data['InvoicePayment']['amount_due'])));		
		echo $this->Form->input('date_paid', array('value'=>date("Y-m-d"), 'type'=>'date'));
		echo $this->Form->input('amount_paid', array('style'=>'text-align:right','value'=>$this->Number->format($this->data['InvoicePayment']['amount_due'])));
		echo $this->Form->input('description', array('style'=>'width:50%'));
		echo $this->Form->input('bank_account_id', array('options'=>$supplierBankAccounts)); 
		echo $this->Form->input('bank_account_type_id', array('options'=>$bankAccountTypes)); 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('InvoicePayment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('InvoicePayment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Invoice Payments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
	</ul>
</div>