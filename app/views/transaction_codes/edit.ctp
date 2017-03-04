<div class="transactionCodes form">
<?php echo $this->Form->create('TransactionCode');?>
	<fieldset>
 		<legend><?php __('Edit Transaction Code'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TransactionCode.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TransactionCode.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Transaction Codes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Journal Groups', true), array('controller' => 'journal_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Group', true), array('controller' => 'journal_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>