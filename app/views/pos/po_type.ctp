<div id="moduleName"><?php echo $moduleName?></div>
<div class="pos form">
<?php echo $this->Form->create('Po');?>
	<fieldset>
 	<legend><?php __('Select Purchase Order Type'); ?></legend>
	<?php
		if ($this->Session->read('Npb.id') !=0) { 
			echo $this->Form->input('request_type_id', array('options'=>$requestTypes, 'type'=>'hidden', 'value'=>$this->Session->read('Npb.request_type_id')));
			echo $this->Form->input('request_type', array('options'=>$requestTypes,'type'=>'text', 'readonly'=>true, 'value'=>$requestTypes[$this->Session->read('Npb.request_type_id')]));
		} else if ($this->Session->read('Npb.id') ==0) {
			echo $this->Form->input('request_type_id', array('options'=>$requestTypes));
		}
	?>
	<?php echo $this->Form->input('currency_id', array('options'=>$currencies)); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pos', true), array('action' => 'index'));?></li>
	</ul>
</div>