<div class="faReturs form">
<?php echo $this->Form->create('FaRetur');?>
	<fieldset>
 		<legend><?php __('Add Fa Retur'); ?></legend>
	<?php
		echo $this->Form->input('doc_date', array('readonly'=>true, 'type'=>'text', 'value'=>date('Y-m-d')));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId, 'style'=>'width:165px') );
		echo $this->Form->input('branch', array('style'=>'width:35%','type'=>'text','readonly'=>true, 'value'=>$departments[$Userinfo['department_id']]));
		echo $this->Form->input('department_id', array('type'=>'hidden', 'value'=>$Userinfo['department_id']));
		echo $this->Form->input('business_type_id', array('type'=>'hidden', 'value'=>$Userinfo['business_type_id']));
		echo $this->Form->input('cost_center_id', array('type'=>'hidden', 'value'=>$Userinfo['cost_center_id']));
		echo $this->Form->input('created_by', array('value'=>$Userinfo['username'], 'readonly'=>true) );
		echo $this->Form->input('status', array('type'=>'text','readonly'=>true, 'value'=>$faReturStatuses[status_fa_retur_draft_id]));
		echo $this->Form->input('fa_retur_status_id', array('type'=>'hidden', 'value'=>status_fa_retur_draft_id));
		echo $this->Form->input('notes', array('style'=>'width:98%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fa Returs', true), array('action' => 'index'));?></li>
	</ul>
</div>