<div class="transactionCodes view">
<h2><?php  __('Transaction Code');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transactionCode['TransactionCode']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transactionCode['TransactionCode']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $transactionCode['TransactionCode']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transaction Code', true), array('action' => 'edit', $transactionCode['TransactionCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Transaction Code', true), array('action' => 'delete', $transactionCode['TransactionCode']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $transactionCode['TransactionCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Codes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Code', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Groups', true), array('controller' => 'journal_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Group', true), array('controller' => 'journal_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Journal Groups');?></h3>
	<?php if (!empty($transactionCode['JournalGroup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Transaction Code Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($transactionCode['JournalGroup'] as $journalGroup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $journalGroup['id'];?></td>
			<td><?php echo $journalGroup['name'];?></td>
			<td><?php echo $journalGroup['transaction_code_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'journal_groups', 'action' => 'view', $journalGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'journal_groups', 'action' => 'edit', $journalGroup['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'journal_groups', 'action' => 'delete', $journalGroup['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Journal Group', true), array('controller' => 'journal_groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
