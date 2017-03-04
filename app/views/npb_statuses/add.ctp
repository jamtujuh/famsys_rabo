<div class="npbStatuses form">
<?php echo $this->Form->create('NpbStatus');?>
	<fieldset>
 		<legend><?php __('Add Npb Status'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text'));
		echo $this->Form->input('name', array('style'=>'width:98%'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Npb Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
	</ul>
</div>