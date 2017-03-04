<div class="journalPositions view">
<h2><?php  __('Journal Position');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalPosition['JournalPosition']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalPosition['JournalPosition']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Journal Position', true), array('action' => 'edit', $journalPosition['JournalPosition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Journal Position', true), array('action' => 'delete', $journalPosition['JournalPosition']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalPosition['JournalPosition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Positions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Position', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Template Details', true), array('controller' => 'journal_template_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template Detail', true), array('controller' => 'journal_template_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Transactions', true), array('controller' => 'journal_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Transaction', true), array('controller' => 'journal_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Journal Template Details');?></h3>
	<?php if (!empty($journalPosition['JournalTemplateDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Journal Template Id'); ?></th>
		<th><?php __('Account Id'); ?></th>
		<th><?php __('Journal Position Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journalPosition['JournalTemplateDetail'] as $journalTemplateDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $journalTemplateDetail['id'];?></td>
			<td><?php echo $journalTemplateDetail['journal_template_id'];?></td>
			<td><?php echo $journalTemplateDetail['account_id'];?></td>
			<td><?php echo $journalTemplateDetail['journal_position_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'journal_template_details', 'action' => 'view', $journalTemplateDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'journal_template_details', 'action' => 'edit', $journalTemplateDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'journal_template_details', 'action' => 'delete', $journalTemplateDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTemplateDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Journal Template Detail', true), array('controller' => 'journal_template_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Journal Transactions');?></h3>
	<?php if (!empty($journalPosition['JournalTransaction'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Journal Template Detail Id'); ?></th>
		<th><?php __('Date Time'); ?></th>
		<th><?php __('Account Id'); ?></th>
		<th><?php __('Journal Position Id'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Posting'); ?></th>
		<th><?php __('Account Code'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journalPosition['JournalTransaction'] as $journalTransaction):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $journalTransaction['id'];?></td>
			<td><?php echo $journalTransaction['journal_template_detail_id'];?></td>
			<td><?php echo $journalTransaction['date_time'];?></td>
			<td><?php echo $journalTransaction['account_id'];?></td>
			<td><?php echo $journalTransaction['journal_position_id'];?></td>
			<td><?php echo $journalTransaction['department_id'];?></td>
			<td><?php echo $journalTransaction['amount'];?></td>
			<td><?php echo $journalTransaction['posting'];?></td>
			<td><?php echo $journalTransaction['account_code'];?></td>
			<td><?php echo $journalTransaction['notes'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'journal_transactions', 'action' => 'view', $journalTransaction['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'journal_transactions', 'action' => 'edit', $journalTransaction['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'journal_transactions', 'action' => 'delete', $journalTransaction['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTransaction['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Journal Transaction', true), array('controller' => 'journal_transactions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
