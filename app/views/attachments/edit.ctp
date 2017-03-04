<div class="attachments form">
<?php echo $this->Form->create('Attachment');?>
	<fieldset>
 		<legend><?php __('Edit Attachment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('attachment_file_path');
		echo $this->Form->input('attachment_file_name');
		echo $this->Form->input('attachment_file_size');
		echo $this->Form->input('attachment_content_type');
		echo $this->Form->input('npb_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Attachment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Attachment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
	</ul>
</div>