<div class="bankAccountTypes form">
<?php echo $this->Form->create('BankAccountType');?>
	<fieldset>
 		<legend><?php __('Edit Bank Account Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('descr');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('BankAccountType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('BankAccountType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bank Account Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>