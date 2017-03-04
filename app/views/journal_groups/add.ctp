<div class="journalGroups form">
<?php echo $this->Form->create('JournalGroup');?>
	<fieldset>
 		<legend><?php __('Add Journal Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Journal Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Journal Templates', true), array('controller' => 'journal_templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal Template', true), array('controller' => 'journal_templates', 'action' => 'add')); ?> </li>
	</ul>
</div>