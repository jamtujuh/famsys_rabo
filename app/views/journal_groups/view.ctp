<div class="journalGroups view">
<h2><?php  __('Journal Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalGroup['JournalGroup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journalGroup['JournalGroup']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Journal Group', true), array('action' => 'edit', $journalGroup['JournalGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Journal Group', true), array('action' => 'delete', $journalGroup['JournalGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalGroup['JournalGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Templates', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template', true), array('controller' => 'journal_templates', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Journal Templates');?></h3>
	<?php if (!empty($journalGroup['JournalTemplate'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Journal Group Id'); ?></th>
		<th><?php __('Asset Category Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journalGroup['JournalTemplate'] as $journalTemplate):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i;?></td>
			<td><?php echo $journalGroup['JournalGroup']['name'];?></td>
			<td><?php echo $journalTemplate['asset_category_id']?$assetCategories[$journalTemplate['asset_category_id']]:'';?></td>
			<td><?php echo $journalTemplate['name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'journal_templates', 'action' => 'view', $journalTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'journal_templates', 'action' => 'edit', $journalTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'journal_templates', 'action' => 'delete', $journalTemplate['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTemplate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Journal Template', true), array('controller' => 'journal_templates', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
