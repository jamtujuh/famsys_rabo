<div class="bankAccounts view">
<h2><?php  __('Bank Account');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccount['BankAccount']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bankAccount['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $bankAccount['Supplier']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccount['BankAccount']['bank_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccount['BankAccount']['bank_account_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccount['BankAccount']['bank_account_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bankAccount['BankAccountType']['name'], array('controller' => 'bank_account_types', 'action' => 'view', $bankAccount['BankAccountType']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bank Account', true), array('action' => 'edit', $bankAccount['BankAccount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Bank Account', true), array('action' => 'delete', $bankAccount['BankAccount']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bankAccount['BankAccount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bank Accounts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bank Account', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bank Account Types', true), array('controller' => 'bank_account_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bank Account Type', true), array('controller' => 'bank_account_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
