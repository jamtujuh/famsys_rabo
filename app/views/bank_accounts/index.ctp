<div class="bankAccounts index">
	<h2><?php __('Bank Accounts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('bank_name');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_no');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_name');?></th>
			<th><?php echo $this->Paginator->sort('bank_account_type_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($bankAccounts as $bankAccount):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $bankAccount['BankAccount']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bankAccount['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $bankAccount['Supplier']['id'])); ?>
		</td>
		<td><?php echo $bankAccount['BankAccount']['bank_name']; ?>&nbsp;</td>
		<td><?php echo $bankAccount['BankAccount']['bank_account_no']; ?>&nbsp;</td>
		<td><?php echo $bankAccount['BankAccount']['bank_account_name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bankAccount['BankAccountType']['name'], array('controller' => 'bank_account_types', 'action' => 'view', $bankAccount['BankAccountType']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $bankAccount['BankAccount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $bankAccount['BankAccount']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $bankAccount['BankAccount']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bankAccount['BankAccount']['id'])); ?>
		</td>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Bank Account', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bank Account Types', true), array('controller' => 'bank_account_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bank Account Type', true), array('controller' => 'bank_account_types', 'action' => 'add')); ?> </li>
	</ul>
</div>