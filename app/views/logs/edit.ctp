<div class="logs form">
<?php echo $this->Form->create('Log');?>
	<fieldset>
 		<legend><?php __('Edit Log'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('model');
		echo $this->Form->input('model_id');
		echo $this->Form->input('action');
		echo $this->Form->input('user_id');
		echo $this->Form->input('change');
		echo $this->Form->input('version_id');
		echo $this->Form->input('fields');
		echo $this->Form->input('order');
		echo $this->Form->input('conditions');
		echo $this->Form->input('events');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>