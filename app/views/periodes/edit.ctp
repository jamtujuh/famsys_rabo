<div class="periode form">
<?php echo $this->Form->create('Periode');?>
	<fieldset>
 		<legend><?php __('Add Periode'); ?></legend>
	<?php echo $this->Form->input('name');?>
	<?php 
		echo $this->Form->input('day_start',array('options'=>$dates, 'type'=>'select', 'value'=>$day_start));
		echo $this->Form->input('day_end',array('options'=>$dates, 'type'=>'select', 'value'=>$day_end));
	?>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>




