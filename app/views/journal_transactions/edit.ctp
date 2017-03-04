<div class="journalTransactions form">
<?php echo $this->Form->create('JournalTransaction');?>
	<fieldset>
 		<legend><?php __('Edit Journal Transaction'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('journal_template_detail_id');
		echo $this->Form->input('date');
		echo $this->Form->input('account_id');
		echo $this->Form->input('journal_position_id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('amount_db');
		echo $this->Form->input('amount_cr');
		echo $this->Form->input('posting');
		echo $this->Form->input('account_code');
		echo $this->Form->input('notes');
		echo $this->Form->input('Invoice');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('JournalTransaction.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('JournalTransaction.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Transactions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Journal Template Details', true), array('controller' => 'journal_template_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template Detail', true), array('controller' => 'journal_template_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Journal Positions', true), array('controller' => 'journal_positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Position', true), array('controller' => 'journal_positions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>