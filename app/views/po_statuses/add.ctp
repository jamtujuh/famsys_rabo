<div class="poStatuses form">
<?php echo $this->Form->create('PoStatus');?>
	<fieldset>
 		<legend><?php __('Add Po Status'); ?></legend>
	<?php
		echo $this->Form->input('id',array('type'=>'text'));
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Po Statuses', true), array('action' => 'index'));?></li>
	</ul>
</div>