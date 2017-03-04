<div class="journalTemplates index">

<?php echo $this->Form->create('JournalTemplate'); ?>
	<fieldset>
 		<legend><?php __('Filter Journal Template'); ?></legend>
		<?php echo $this->Form->input('journal_group_id', array('options'=>$journal_groups, 'value'=>$journal_group_id));?>
		<?php echo $this->Form->end('Refresh')?>
	</fieldset>
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
	<h2><?php __('Journal Templates');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('journal_group_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journalTemplates as $journalTemplate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($journalTemplate['JournalGroup']['name'], array('controller' => 'journal_groups', 'action' => 'view', $journalTemplate['JournalGroup']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($journalTemplate['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $journalTemplate['AssetCategory']['id'])); ?>
		</td>
		<td><?php echo $journalTemplate['JournalTemplate']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $journalTemplate['JournalTemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $journalTemplate['JournalTemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $journalTemplate['JournalTemplate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTemplate['JournalTemplate']['id'])); ?>
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
