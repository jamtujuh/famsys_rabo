<div class="activitylogs form">
<?php echo $this->Form->create('ActivityLog');?>
	<fieldset>
 		<legend><?php __('Add Activity Log'); ?></legend>
	<?php
		echo $this->Form->input('username', array('style'=>'width:35%', 'maxlength'=>'25'));
		echo $this->Form->input('process', array('value'=>''));
		echo $this->Form->input('status');
		echo $this->Form->input('date');
		echo $this->Form->input('time');
		echo $this->Form->input('remark');
		//echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden'));
		
	?>	

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Activity', true), array('action' => 'index'));?></li>
	</ul>
</div>