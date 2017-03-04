<?php
echo $javascript->link('my_detail_add',false);
?>
<div class="suppliers view">
<h2><?php  __('Supplier');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['city']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Province'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['province']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Telephone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['telephone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['fax']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact Person'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['contact_person']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['hp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Website'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['website']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['business_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Default Wht Rate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier['Supplier']['default_wht_rate']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Supplier', true), array('action' => 'edit', $supplier['Supplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Supplier', true), array('action' => 'delete', $supplier['Supplier']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier['Supplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('action' => 'add')); ?> </li>
	</ul>
</div>

<br>
<div class="related">
	<h3><?php __('Bank Accounts');?></h3>
	
	<?php echo $this->Form->create('BankAccount') ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Bank Name'); ?></th>
		<th><?php __('Bank Account No'); ?></th>
		<th><?php __('Bank Account Name'); ?></th>
		<th><?php __('Bank Account Type'); ?></th>
		<th><?php __('Currency'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php if (!empty($supplier['BankAccount'])):?>
	<?php
		$i = 0;
		foreach ($supplier['BankAccount'] as $bankAccount):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td class="left"><?php echo $i ;?></td>
			<td class="left"><?php echo $bankAccount['bank_name'] ;?></td>
			<td class="left"><?php echo $bankAccount['bank_account_no'] ;?></td>
			<td class="left"><?php echo $bankAccount['bank_account_name'] ;?></td>
			<td class="left"><?php echo $bankAccountTypes[$bankAccount['bank_account_type_id']] ;?></td>
			<td class="left"><?php echo $currencies[$bankAccount['currency_id']] ;?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'bank_accounts', 'action' => 'delete', $bankAccount['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bankAccount['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>

	<tr id="newRecord">
		<td class="newField"></td>
		<td class="newField"><?php echo $this->Form->input('bank_name') ;?></td>
		<td class="newField"><?php echo $this->Form->input('bank_account_no') ;?></td>
		<td class="newField"><?php echo $this->Form->input('bank_account_name') ;?></td>
		<td class="newField"><?php echo $this->Form->input('bank_account_type_id') ;?></td>
		<td class="newField"><?php echo $this->Form->input('currency_id') ;?></td>
		<td class="actions">
			<?php echo $this->Form->input('supplier_id', array('type'=>'hidden', 'value'=>$supplier['Supplier']['id'])) ?>
			<?php echo $ajax->submit('Add', 
				array(
					'url'=> array('controller'=>'bank_accounts', 'action'=>'ajax_add'), 
					'indicator'	=> 'LoadingDiv',
					'complete' => 'appendBankAccount(request)'));
			?>					
		</td>
	</tr>	

	</table>
	<?php echo $this->Form->end() ?>

</div>