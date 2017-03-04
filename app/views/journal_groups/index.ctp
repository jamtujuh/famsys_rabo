<div class="journalGroups index">
	<h2><?php __('Journal Groups');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journalGroups as $journalGroup):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $journalGroup['JournalGroup']['id']; ?>&nbsp;</td>
		<td><?php echo $journalGroup['JournalGroup']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $journalGroup['JournalGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $journalGroup['JournalGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $journalGroup['JournalGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalGroup['JournalGroup']['id'])); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Journal Group', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Templates', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template', true), array('controller' => 'journal_templates', 'action' => 'add')); ?> </li>
	</ul>
</div>