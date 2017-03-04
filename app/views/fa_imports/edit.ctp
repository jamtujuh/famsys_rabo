<div class="usages form">
<?php echo $this->Form->create('FaImport');?>
	<fieldset>
 		<legend><?php __('Edit FaImport'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'hidden', 'readonly'=>true));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('department_id', array('options'=>$departments));
		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>