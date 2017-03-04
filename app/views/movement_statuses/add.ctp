<div class="movementStatuses form">
<?php echo $this->Form->create('MovementStatus');?>
	<fieldset>
 		<legend><?php __('Add Movement Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Movement Statuses', true), array('action' => 'index'));?></li>
	</ul>
</div>