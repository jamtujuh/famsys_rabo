<div class="journalTemplates view">
<h2><?php  __('Journal Template');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Journal Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTemplate['JournalGroup']['name'], array('controller' => 'journal_groups', 'action' => 'view', $journalTemplate['JournalGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asset Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journalTemplate['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $journalTemplate['AssetCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalTemplate['JournalTemplate']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Journal Template', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Groups', true), array('controller' => 'journal_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Group', true), array('controller' => 'journal_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Journal Template Details');?></h3>
	<?php if (!empty($journalTemplate['JournalTemplateDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Journal Position'); ?></th>
		<th><?php __('Account Code'); ?></th>
		<th><?php __('Account'); ?></th>
		<th><?php __('For Destination Department'); ?></th>
		<th><?php __('For Profit Sales'); ?></th>
		<th><?php __('For Accum. Depr.'); ?></th>
		<th><?php __('Contra Account'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journalTemplate['JournalTemplateDetail'] as $journalTemplateDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $journal_positions[$journalTemplateDetail['journal_position_id']];?></td>
			<td class="left"><?php echo $accountCodes[$journalTemplateDetail['account_id']];?></td>
			<td class="left"><?php echo $accounts[$journalTemplateDetail['account_id']];?></td>
			<td><?php echo $journalTemplateDetail['for_destination_branch'];?></td>
			<td><?php echo $journalTemplateDetail['for_profit_sales'];?></td>
			<td><?php echo $journalTemplateDetail['for_accum_dep'];?></td>
			<td><?php echo $journalTemplateDetail['contra_account'];?></td>
			<td class="actions">
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
