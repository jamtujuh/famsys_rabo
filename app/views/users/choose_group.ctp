<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
	
	echo $javascript->link('validation', false);
	echo $validation->rules('User'); 
?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Choose Group & Branch'); ?></legend>
	<?php
		echo $this->Form->input('name', 			array('size'=>'40', 'readonly'=>true, 'value'=>$this->Session->read('Userinfo.name')));
		echo $this->Form->input('ad_user', 			array('size'=>'40', 'readonly'=>true,'value'=>$this->Session->read('Userinfo.ad_user'), 'label'=>'User Login'));
		echo $this->Form->input('email', 			array('size'=>'40', 'readonly'=>true,'value'=>$this->Session->read('Userinfo.email')));
		echo $this->Form->input('group_id', 		array('options'=>$groups, 'value'=>$this->Session->read('Userinfo.group_id')));
		echo $this->Form->input('department_id', 	array('options'=>$departments, 'value'=>$this->Session->read('Userinfo.department_id')));
	?>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>