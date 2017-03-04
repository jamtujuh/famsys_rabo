<div class="disposalTypes form">
<?php echo $this->Form->create('DisposalType');?>
	<fieldset>
 		<legend><?php __('Add Disposal Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Disposal Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Disposals', true), array('controller' => 'disposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal', true), array('controller' => 'disposals', 'action' => 'add')); ?> </li>
	</ul>
</div>