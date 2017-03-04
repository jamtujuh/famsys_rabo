<div class="returs form">
<?php echo $this->Form->create('Retur');?>
	<fieldset>
 		<legend><?php __('Add Retur'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('date', array('value'=>date("Y-m-d"), 'type'=>'date'));

		echo $this->Form->input('department_id', array('value'=>$department_id,'type'=>'hidden')); 
		echo $this->Form->input('department_name', array('value'=>$departments[$department_id],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
		
		echo $this->Form->input('business_type_id', array('value'=>$business_type_id,'type'=>'hidden')); 
		echo $this->Form->input('business_type_name', array('value'=>$businessTypes[$business_type_id],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
		
		echo $this->Form->input('cost_center_id', array('value'=>$cost_center_id,'type'=>'hidden')); 
		echo $this->Form->input('cost_center_name', array('value'=>$costCenters[$cost_center_id],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 

		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"),'type'=>'hidden'));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Returs', true), array('action' => 'index'));?></li>
	</ul>
</div>