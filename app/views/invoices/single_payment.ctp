<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit=false;
?>
<div class="invoices view">
<h2><?php  __('Invoice');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inv Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($invoice['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $invoice['Supplier']['id'])); ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['total']); ?></div>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['InvoiceStatus']['name']; ?>
			&nbsp;
		</dd>		
	</dl>
	<?php
		echo $this->Form->create('Invoice');
		echo $this->Form->input('id', array('value'=>$invoice['Invoice']['id'])); 
	?>
		<fieldset>
			<legend><?php __('Invoice Payment')?></legend>
			<?php echo $this->Form->input('paid_date'); ?>
			<?php echo $this->Form->input('bank_account_id', array('options'=>$supplierBankAccounts) ); ?>
			<?php echo $this->Form->input('paid_bank_account_type_id', array('options'=>$bankAccountTypes,'value'=>$invoice['Supplier']['bank_account_type_id'])); ?>
			<?php echo $this->Form->input('status_invoice_id', array('value'=>status_invoice_paid_id,'type'=>'hidden')); ?>
			<?php echo $this->Form->end('Save Payment')?>
		</fieldset>

	<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'index')); ?> </li>
	</ul>
	</div>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
	</ul>
</div>
