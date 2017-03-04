<div class="journalTransactions view">
<h2><?php  __('Journal Transaction');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['id']; ?>
			&nbsp;
		</dd>

		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTransaction['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $journalTransaction['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Journal Position'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTransaction['JournalPosition']['name'], array('controller' => 'journal_positions', 'action' => 'view', $journalTransaction['JournalPosition']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTransaction['Department']['name'], array('controller' => 'departments', 'action' => 'view', $journalTransaction['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Db'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['amount_db']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Cr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['amount_cr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posting'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['posting']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['account_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTransaction['JournalTransaction']['notes']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Journal Transaction', true), array('action' => 'edit', $journalTransaction['JournalTransaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Journal Transaction', true), array('action' => 'delete', $journalTransaction['JournalTransaction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTransaction['JournalTransaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Transactions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Transaction', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Template Details', true), array('controller' => 'journal_template_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template Detail', true), array('controller' => 'journal_template_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Positions', true), array('controller' => 'journal_positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Position', true), array('controller' => 'journal_positions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Invoices');?></h3>
	<?php if (!empty($journalTransaction['Invoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Inv Date'); ?></th>
		<th><?php __('Id Supplier'); ?></th>
		<th><?php __('Id Department'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Po No'); ?></th>
		<th><?php __('Paid Date'); ?></th>
		<th><?php __('Paid Bank Name'); ?></th>
		<th><?php __('Paid Bank Account No'); ?></th>
		<th><?php __('Paid Bank Account Type Id'); ?></th>
		<th><?php __('Convert Asset'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Wht Rate'); ?></th>
		<th><?php __('Vat Rate'); ?></th>
		<th><?php __('Sub Total'); ?></th>
		<th><?php __('Vat Base'); ?></th>
		<th><?php __('Wht Base'); ?></th>
		<th><?php __('Discount'); ?></th>
		<th><?php __('Wht Total'); ?></th>
		<th><?php __('Vat Total'); ?></th>
		<th><?php __('Total'); ?></th>
		<th><?php __('Billing Address'); ?></th>
		<th><?php __('Shipping Address'); ?></th>
		<th><?php __('Status Invoice Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journalTransaction['Invoice'] as $invoice):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $invoice['id'];?></td>
			<td><?php echo $invoice['no'];?></td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $invoice['inv_date']); ?></td>
			<td><?php echo $invoice['supplier_id'];?></td>
			<td><?php echo $invoice['department_id'];?></td>
			<td><?php echo $invoice['description'];?></td>
			<td><?php echo $invoice['po_no'];?></td>
			<td><?php echo $invoice['paid_date'];?></td>
			<td><?php echo $invoice['paid_bank_name'];?></td>
			<td><?php echo $invoice['paid_bank_account_no'];?></td>
			<td><?php echo $invoice['paid_bank_account_type_id'];?></td>
			<td><?php echo $invoice['convert_asset'];?></td>
			<td><?php echo $invoice['created'];?></td>
			<td><?php echo $invoice['wht_rate'];?></td>
			<td><?php echo $invoice['vat_rate'];?></td>
			<td><?php echo $invoice['sub_total'];?></td>
			<td><?php echo $invoice['vat_base'];?></td>
			<td><?php echo $invoice['wht_base'];?></td>
			<td><?php echo $invoice['discount'];?></td>
			<td><?php echo $invoice['wht_total'];?></td>
			<td><?php echo $invoice['vat_total'];?></td>
			<td><?php echo $invoice['total'];?></td>
			<td><?php echo $invoice['billing_address'];?></td>
			<td><?php echo $invoice['shipping_address'];?></td>
			<td><?php echo $invoice['status_invoice_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'invoices', 'action' => 'view', $invoice['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'invoices', 'action' => 'edit', $invoice['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'invoices', 'action' => 'delete', $invoice['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
