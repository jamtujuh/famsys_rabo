<div class="accountTypes view">
<h2><?php  __('Account Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountType['AccountType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountType['AccountType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountType['AccountType']['descr']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account Type', true), array('action' => 'edit', $accountType['AccountType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Account Type', true), array('action' => 'delete', $accountType['AccountType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $accountType['AccountType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Accounts');?></h3>
	<?php if (!empty($accountType['Account'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Gl'); ?></th>
		<th><?php __('Linked Gol'); ?></th>
		<th><?php __('Debit'); ?></th>
		<th><?php __('Credit'); ?></th>
		<th><?php __('Account Global Id'); ?></th>
		<th><?php __('Account Type Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($accountType['Account'] as $account):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $account['id'];?></td>
			<td><?php echo $account['name'];?></td>
			<td><?php echo $account['gl'];?></td>
			<td><?php echo $account['linked_gol'];?></td>
			<td><?php echo $account['debit'];?></td>
			<td><?php echo $account['credit'];?></td>
			<td><?php echo $account['account_global_id'];?></td>
			<td><?php echo $account['account_type_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'accounts', 'action' => 'view', $account['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'accounts', 'action' => 'edit', $account['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'accounts', 'action' => 'delete', $account['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $account['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
