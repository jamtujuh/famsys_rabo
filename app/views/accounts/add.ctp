<div class="accounts form">
<?php echo $this->Form->create('Account');?>
	<fieldset>
 		<legend><?php __('Add Account'); ?></legend>
	<?php
		echo $this->Form->input('name', array('style'=>'width:50%'));
		echo $this->Form->input('gl');
		echo $this->Form->input('account_type_id');
		echo $this->Form->input('debit');
		echo $this->Form->input('credit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Accounts', true), array('action' => 'index'));?></li>
	</ul>
</div>