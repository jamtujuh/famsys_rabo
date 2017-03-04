<div class="bankAccountTypes view">
<h2><?php  __('Bank Account Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccountType['BankAccountType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccountType['BankAccountType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bankAccountType['BankAccountType']['descr']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bank Account Type', true), array('action' => 'edit', $bankAccountType['BankAccountType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Bank Account Type', true), array('action' => 'delete', $bankAccountType['BankAccountType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bankAccountType['BankAccountType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bank Account Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bank Account Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Invoices');?></h3>
	<?php if (!empty($bankAccountType['Invoice'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Inv Date'); ?></th>
		<th><?php __('Supplier Id'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Currency Id'); ?></th>
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
		<th><?php __('After Disc'); ?></th>
		<th><?php __('Wht Total'); ?></th>
		<th><?php __('Vat Total'); ?></th>
		<th><?php __('Total'); ?></th>
		<th><?php __('Billing Address'); ?></th>
		<th><?php __('Shipping Address'); ?></th>
		<th><?php __('Status Invoice Id'); ?></th>
		<th><?php __('Rp Rate'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($bankAccountType['Invoice'] as $invoice):
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
			<td><?php echo $invoice['currency_id'];?></td>
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
			<td><?php echo $invoice['after_disc'];?></td>
			<td><?php echo $invoice['wht_total'];?></td>
			<td><?php echo $invoice['vat_total'];?></td>
			<td><?php echo $invoice['total'];?></td>
			<td><?php echo $invoice['billing_address'];?></td>
			<td><?php echo $invoice['shipping_address'];?></td>
			<td><?php echo $invoice['status_invoice_id'];?></td>
			<td><?php echo $invoice['rp_rate'];?></td>
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
