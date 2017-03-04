<div class="processTypes form">
<?php echo $this->Form->create('ProcessType');?>
	<fieldset>
 		<legend><?php __('Add Process Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Process Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npb Details', true), array('controller' => 'npb_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb Detail', true), array('controller' => 'npb_details', 'action' => 'add')); ?> </li>
	</ul>
</div>