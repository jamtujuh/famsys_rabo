<div class="journalPositions index">
	<h2><?php __('Journal Positions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journalPositions as $journalPosition):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $journalPosition['JournalPosition']['id']; ?>&nbsp;</td>
		<td><?php echo $journalPosition['JournalPosition']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $journalPosition['JournalPosition']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $journalPosition['JournalPosition']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $journalPosition['JournalPosition']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalPosition['JournalPosition']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Journal Position', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Template Details', true), array('controller' => 'journal_template_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template Detail', true), array('controller' => 'journal_template_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Transactions', true), array('controller' => 'journal_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Transaction', true), array('controller' => 'journal_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>