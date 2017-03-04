<?php
$group_id=$this->Session->read('Security.permissions');
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div class="npbs form">
<?php echo $this->Form->create('Npb');?>
	<fieldset>
 		<legend><?php __('Add Npb'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden') );
		echo $this->Form->input('no', array('type'=>'text', 'value'=>$newId, 'style'=>'width:165px', 'readonly'=>true));
		echo $this->Form->input('npb_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('request_type_id', array('value'=>$request_type_id, 'readonly'=>true, 'type'=>'hidden'));
		echo $this->Form->input('request_type_name', array('value'=>$requestTypes[$request_type_id], 'readonly'=>true, 'type'=>'text'));
		if ($group_id == stock_management_group_id) {
			echo $this->Form->input('is_purchase_request', array(
				//'type' => 'radio',
				'options' => array(0 => 'stock request',1 => 'stock purchase request'),
				'default' => 1, 
				'readonly' => true,
				'type' => 'hidden'
				));
		}
		
		echo $this->Form->input('branch', array('style'=>'width:35%','type'=>'text','readonly'=>true, 'value'=>$departments[$Userinfo['department_id']]));
		/* if(!empty($Userinfo['department_sub_id'])) {
			echo $this->Form->input('department sub', array('style'=>'width:98%','type'=>'text','readonly'=>true, 'value'=>$departmentsub[$Userinfo['department_sub_id']]));
			echo $this->Form->input('department_sub_id', array('type'=>'hidden', 'value'=>$Userinfo['department_sub_id'])); 
		}*/
		/* if(!empty($Userinfo['department_unit_id'])) {
			echo $this->Form->input('department unit', array('style'=>'width:98%','type'=>'text','readonly'=>true, 'value'=>$departmentunit[$Userinfo['department_unit_id']]));
			echo $this->Form->input('department_unit_id', array('type'=>'hidden', 'value'=>$Userinfo['department_unit_id']));
		} */
		echo $this->Form->input('department_id', array('type'=>'hidden', 'value'=>$Userinfo['department_id']));
		//echo $this->Form->input('cost_center_id', array('type'=>'hidden', 'value'=>$Userinfo['cost_center_id']));
		echo $this->Form->input('cost_center_id', array('empty'=>'- SELECT COST CENTER -','options'=>$costCenters));
		
		echo $this->Form->input('business_type_id', array('type'=>'hidden', 'value'=>$Userinfo['business_type_id']));
		echo $this->Form->input('req_date', array('type'=>'date'));
		echo $this->Form->input('status', array('type'=>'text','readonly'=>true, 'value'=>$npbStatuses[status_npb_draft_id]));
		echo $this->Form->input('npb_status_id', array('type'=>'hidden', 'value'=>status_npb_draft_id));
		echo $this->Form->input('notes', array('style'=>'width:98%', 'maxlength'=>'255'));
		echo $this->Form->input('created_by', array('value'=>$Userinfo['username'], 'readonly'=>true) );
		echo $this->Form->input('created_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'hidden') );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Npbs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npb Suppliers', true), array('controller' => 'npb_suppliers', 'action' => 'index')); ?> </li>
	</ul>
</div>
