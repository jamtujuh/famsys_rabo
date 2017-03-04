<div class="accountGlobals view">
<h2><?php  __('Account Global');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountGlobal['AccountGlobal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountGlobal['AccountGlobal']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountGlobal['AccountGlobal']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Level'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountGlobal['AccountGlobal']['level']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Account Global'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($accountGlobal['ParentAccountGlobal']['name'], array('controller' => 'account_globals', 'action' => 'view', $accountGlobal['ParentAccountGlobal']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $accountGlobal['AccountGlobal']['detail']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account Global', true), array('action' => 'edit', $accountGlobal['AccountGlobal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Account Global', true), array('action' => 'delete', $accountGlobal['AccountGlobal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $accountGlobal['AccountGlobal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Globals', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Global', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Globals', true), array('controller' => 'account_globals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Account Global', true), array('controller' => 'account_globals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Account Globals');?></h3>
	<?php if (!empty($accountGlobal['ChildAccountGlobal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Level'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Detail'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($accountGlobal['ChildAccountGlobal'] as $childAccountGlobal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childAccountGlobal['id'];?></td>
			<td><?php echo $childAccountGlobal['code'];?></td>
			<td><?php echo $childAccountGlobal['name'];?></td>
			<td><?php echo $childAccountGlobal['level'];?></td>
			<td><?php echo $childAccountGlobal['parent_id'];?></td>
			<td><?php echo $childAccountGlobal['detail'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'account_globals', 'action' => 'view', $childAccountGlobal['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'account_globals', 'action' => 'edit', $childAccountGlobal['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'account_globals', 'action' => 'delete', $childAccountGlobal['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childAccountGlobal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Account Global', true), array('controller' => 'account_globals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Accounts');?></h3>
	<?php if (!empty($accountGlobal['Account'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Gl'); ?></th>
		<th><?php __('Linked Gol'); ?></th>
		<th><?php __('Debit'); ?></th>
		<th><?php __('Credit'); ?></th>
		<th><?php __('Account Global Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($accountGlobal['Account'] as $account):
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
