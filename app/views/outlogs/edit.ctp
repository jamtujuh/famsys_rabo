<div class="outlogs form">
<?php echo $this->Form->create('Outlog');?>
	<fieldset>
 		<legend><?php __('Edit Delivery'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden', 'readonly'=>true));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('date', array('value'=>date("Y-m-d"), 'type'=>'date'));
		echo $this->Form->input('department_id', array('options'=>$departments, 'type'=>'hidden', 'readonly'=>true));
		echo $this->Form->input('department_name', array('value'=>$outlog['Department']['name'], 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('business_type_id', array('value'=>$business_type_id,'type'=>'hidden')); 
		echo $this->Form->input('business_type_name', array('value'=>$outlog['BusinessType']['name'],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
		echo $this->Form->input('cost_center_id', array('value'=>$cost_center_id,'type'=>'hidden')); 
		echo $this->Form->input('cost_center_name', array('value'=>$outlog['CostCenter']['name'],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 
		echo $this->Form->input('notes', array('style'=>'width:98%', 'maxlength'=>'255', 'value'=>$outlog['Outlog']['notes']));
		echo $this->Form->input('created_at', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Outlog.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Outlog.id'))); ?></li>
	</ul>
</div>