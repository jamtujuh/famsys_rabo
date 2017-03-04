<div class="journalPositions form">
<?php echo $this->Form->create('JournalPosition');?>
	<fieldset>
 		<legend><?php __('Edit Journal Position'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('JournalPosition.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('JournalPosition.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Positions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Journal Template Details', true), array('controller' => 'journal_template_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template Detail', true), array('controller' => 'journal_template_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Transactions', true), array('controller' => 'journal_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Transaction', true), array('controller' => 'journal_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>