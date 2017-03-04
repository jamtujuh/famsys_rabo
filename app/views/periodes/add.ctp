<div class="periode form">
<?php echo $this->Form->create('Periode');?>
	<fieldset>
 		<legend><?php __('Add Periode'); ?></legend>
	<?php echo $this->Form->input('name');?>
	<?php if(date('d') > 15){
		echo $this->Form->input('day_start',array('options'=>$dates, 'type'=>'select', 'value'=>$curday));
		echo $this->Form->input('day_end',array('options'=>$dates, 'type'=>'select'));
	}else{
		echo $this->Form->input('day_start',array('options'=>$dates, 'type'=>'select'));
		echo $this->Form->input('day_end',array('options'=>$dates, 'type'=>'select', 'value'=>$curday));
	}?>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>




