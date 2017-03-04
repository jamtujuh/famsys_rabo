<div class="assets form">
<?php echo $this->Form->create('AssetDetail');?>
	<fieldset>
 		<legend><?php __('Accept'); ?></legend>
	<?php
		echo $this->Form->input('accepted_datetime');
		echo $this->Form->input('accepted_by', array('value'=>$Userinfo['department_name'], 'readonly'=>true, 'type'=>'text' ));
		echo $this->Form->input('accept');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
