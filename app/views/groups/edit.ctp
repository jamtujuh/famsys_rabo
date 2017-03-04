<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
 		<legend><?php __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('auth_amount');
		echo $this->Form->checkbox('is_admin');
		echo 'Is Admin?';
		echo $this->Form->input('descr');
		echo $this->Form->input('Menu', array('multiple'=>'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>