<div class="npbStatuses form">
<?php echo $this->Form->create('NpbStatus');?>
	<fieldset>
 		<legend><?php __('Edit Npb Status'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text'));
		echo $this->Form->input('name', array('style'=>'width:98%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('NpbStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('NpbStatus.id'))); ?></li>
	</ul>
</div>