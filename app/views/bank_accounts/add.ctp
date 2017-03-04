<div class="bankAccounts form">
<?php echo $this->Form->create('BankAccount');?>
	<fieldset>
 		<legend><?php __('Add Bank Account'); ?></legend>
	<?php
		echo $this->Form->input('supplier_id', array('type'=>'hidden', 'value'=>$this->Session->read('Supplier.id')));
		echo $this->Form->input('Movement.no', array('value'=>$supplier_name, 'readonly'=>true));
		echo $this->Form->input('bank_name');
		echo $this->Form->input('bank_account_no');
		echo $this->Form->input('bank_account_name');
		echo $this->Form->input('bank_account_type_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Bank Accounts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bank Account Types', true), array('controller' => 'bank_account_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bank Account Type', true), array('controller' => 'bank_account_types', 'action' => 'add')); ?> </li>
	</ul>
</div>