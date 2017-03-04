<div class="journalTemplateDetails index">
	<h2><?php __('Journal Template Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('journal_template_id');?></th>
			<th><?php echo $this->Paginator->sort('account_id');?></th>
			<th><?php echo $this->Paginator->sort('journal_position_id');?></th>
			<th><?php echo $this->Paginator->sort('for_destination_branch');?></th>
			<th><?php echo $this->Paginator->sort('for_profit_sales');?></th>
			<th><?php echo $this->Paginator->sort('contra_account');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($journalTemplateDetails as $journalTemplateDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $journalTemplateDetail['JournalTemplateDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($journalTemplateDetail['JournalTemplate']['name'], array('controller' => 'journal_templates', 'action' => 'view', $journalTemplateDetail['JournalTemplate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($journalTemplateDetail['Account']['name'], array('controller' => 'accounts', 'action' => 'view', $journalTemplateDetail['Account']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($journalTemplateDetail['JournalPosition']['name'], array('controller' => 'journal_positions', 'action' => 'view', $journalTemplateDetail['JournalPosition']['id'])); ?>
		</td>
		<td><?php echo $journalTemplateDetail['JournalTemplateDetail']['for_destination_branch']; ?>&nbsp;</td>
		<td><?php echo $journalTemplateDetail['JournalTemplateDetail']['for_profit_sales']; ?>&nbsp;</td>
		<td><?php echo $journalTemplateDetail['JournalTemplateDetail']['contra_account_id']; ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $journalTemplateDetail['JournalTemplateDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $journalTemplateDetail['JournalTemplateDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $journalTemplateDetail['JournalTemplateDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journalTemplateDetail['JournalTemplateDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Journal Templates', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template', true), array('controller' => 'journal_templates', 'action' => 'add')); ?> </li>
	</ul>
</div>