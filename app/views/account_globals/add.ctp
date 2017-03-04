<div class="accountGlobals form">
<?php echo $this->Form->create('AccountGlobal');?>
	<fieldset>
 		<legend><?php __('Add Account Global'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('level');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('detail');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Account Globals', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Account Globals', true), array('controller' => 'account_globals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Account Global', true), array('controller' => 'account_globals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>