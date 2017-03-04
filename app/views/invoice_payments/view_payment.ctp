<div class="invoicePayments view">
<h2><?php  __('Invoice Payment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($invoice_no, array('controller' => 'invoices', 'action' => 'view', $invoicePayment['Invoice']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_name; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoicePayment['InvoicePayment']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Invoice Payment Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myApp->showArrayValue($invoicePaymentStatus, $invoicePayment['InvoicePayment']['invoice_payment_status_id'] ); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Term No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoicePayment['InvoicePayment']['term_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Term Percent'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoicePayment['InvoicePayment']['term_percent']; ?>%
			&nbsp;
		</dd>            
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Due'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_due']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Invoice'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_invoice'], 2); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Due'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_due'], 2); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Paid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoicePayment['InvoicePayment']['date_paid']?$this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_paid']):''; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Paid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_paid']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Journal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoicePayment['Invoice']['convert_asset']=="0"?"Biaya":"Asset"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoicePayment['InvoicePayment']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myApp->showArrayValue($bankAccountTypes,$invoicePayment['InvoicePayment']['bank_account_id']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myApp->showArrayValue($supplierBankAccounts,$invoicePayment['InvoicePayment']['bank_account_type_id']); ?>
			&nbsp;
		</dd>
    <div class="doc_actions">
        <ul>
            <?php if ($can_send_to_spv) : ?>
                <li><?php echo $this->Html->link(__('Send to Supervisor', true), array('action' => 'sentToFinconSpv', $invoicePayment['InvoicePayment']['id'])); ?> </li>
            <?php endif ?>	
            <?php if ($can_approve) : ?>
                <li><?php echo $this->Html->link(__('Approve', true), array('action' => 'approve', $invoicePayment['InvoicePayment']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'cancel', $invoicePayment['InvoicePayment']['id'])); ?> </li>
            <?php endif ?>	
			<?php if ($can_journal) : ?>
				<li><?php echo $this->Html->link(__('Posting to Journal', true), array('controller'=>'journal_transactions', 'action' => 'prepare_posting', 'invoice_payment', journal_group_invoice_payment_id, $invoicePayment['InvoicePayment']['id'], 'hold')); ?> </li>			 
			<?php endif;?>
               <li><?php echo $this->Html->link(__('Back', true), array('action' => 'index', $invoicePayment['InvoicePayment']['invoice_id'])); ?> </li>
	   </ul>
    </div>
		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Invoice Payments', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
