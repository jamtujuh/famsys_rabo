<div class="usages form">
<?php echo $this->Form->create('Usage');?>
	<fieldset>
 		<legend><?php __('Add Usage'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text', 'value'=>$newId));
		echo $this->Form->input('date', array('type'=>'date', 'value'=>date("Y-m-d")));
		echo $this->Form->input('department_id', array('value'=>$this->Session->read('Userinfo.department_id'),'type'=>'hidden')); 
		echo $this->Form->input('department_name', array('value'=>$departments[$this->Session->read('Userinfo.department_id')],'type'=>'text','readonly'=>true, 'style'=>'width:50%')); 

		echo $this->Form->input('created_at', array('value'=>date("Y-m-d H:i:s"),'type'=>'hidden'));
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Usages', true), array('action' => 'index'));?></li>
	</ul>
</div>