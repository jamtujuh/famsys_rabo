<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
	
	//echo $javascript->link(array('jquery', 'validation'), false);
	echo $javascript->link('validation', false);
	echo $validation->rules('User'); 
?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('style'=>'width:35%', 'maxlength'=>'25'));
		echo $this->Form->input('ad_user', array('value'=>'','label'=>'Active Directory Username'));
		echo $this->Form->input('email', array('value'=>''));
		echo $this->Form->input('password', array('value'=>'F@msys123', 'type'=>'hidden'));
		echo $this->Form->input('password2', array('value'=>'F@msys123', 'type'=>'hidden', 'label'=>'Re-type Password'));
		echo $this->Form->input('name');
		echo $this->Form->input('group_id', array('options'=>$groups));
		echo $this->Form->input('department_id', array('options'=>$departments));
		echo $this->Form->input('business_type_id', array('options'=>$businessType));
		//echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden'));
		//echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:40%')); 
		/* echo $this->Form->input('department_sub_id');
		echo $this->Form->input('department_unit_id');
		
		
		
		$options = array('url' => '/departments/getDepartmentSubId/User', 'indicator'=>'LoadingDiv', 'update' => 'UserDepartmentSubId');
		echo $ajax->observeField('UserDepartmentId', $options);
		
		$options = array('url' => '/department_subs/getDepartmentUnitId/User', 'indicator'=>'LoadingDiv', 'update' => 'UserDepartmentUnitId');
		echo $ajax->observeField('UserDepartmentSubId', $options); */
		echo '<br>';
		echo $this->Form->checkbox('aktif');
		echo 'aktif';
?>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>