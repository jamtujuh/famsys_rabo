<div class="usages form">
<?php echo $this->Form->create('Usage');?>
	<fieldset>
 		<legend><?php __('Edit Usage'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('no', array('readonly'=>true, 'type'=>'text'));
		echo $this->Form->input('date', array('value'=>date("Y-m-d")));
		echo $this->Form->input('department_id', array('options'=>$departments));
		echo $this->Form->input('created_at');
		echo $this->Form->input('created_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Usage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Usage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Usages', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usage Details', true), array('controller' => 'usage_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usage Detail', true), array('controller' => 'usage_details', 'action' => 'add')); ?> </li>
	</ul>
</div>