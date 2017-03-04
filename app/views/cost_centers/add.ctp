<div class="costCenters form">
<?php echo $this->Form->create('CostCenter');?>
	<fieldset>
 		<legend><?php __('Add Cost Center'); ?></legend>
	<?php
		echo $this->Form->input('organization_Id');
		echo $this->Form->input('division');
		echo $this->Form->input('division_name');
		echo $this->Form->input('sub_division');
		echo $this->Form->input('sub_division_name');
		echo $this->Form->input('cost_centers');
		echo $this->Form->input('name');
		echo $this->Form->input('organization_level');
		echo $this->Form->input('desc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cost Centers', true), array('action' => 'index'));?></li>
	</ul>
</div>