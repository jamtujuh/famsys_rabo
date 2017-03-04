<div class="journalTemplateDetails form">
<?php echo $this->Form->create('JournalTemplateDetail');?>
	<fieldset>
 		<legend><?php __('Edit Journal Template Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('journal_template_id');
		echo $this->Form->input('account_id');
		echo $this->Form->input('journal_position_id');
		echo $this->Form->input('for_destination_branch');
		echo $this->Form->input('for_profit_sales');
		echo $this->Form->input('for_accum_dep');
		echo $this->Form->input('contra_account', array('options'=>$contraAccounts));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('JournalTemplateDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('JournalTemplateDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Journal Templates', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
	</ul>
</div>