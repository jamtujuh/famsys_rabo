<div id="moduleName"><?php echo $moduleName?></div>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Reset User Password'); ?></legend>
		<!--h3>
			Password should at least contains 1 Symbol, 1 Number, 1 Upper Letter Case, and at least 6 character lengths minimum.
		</h3-->
	<?php
		echo $this->Form->input('email',array('readonly'=>true, 'type'=>'text', 'value'=>$email));
		echo $this->Form->input('ad_user',array('type'=>'text', 'label'=>'Window\'s Username'));
		echo $this->Form->input('password', array('value'=>'','type'=>'password', 'label'=>'New Password'));
		echo $this->Form->input('password2', array('value'=>'','type'=>'password', 'label'=>'Re-type'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Change', true));?>
</div>
