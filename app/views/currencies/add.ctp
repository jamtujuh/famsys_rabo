<div class="currencies form">
<?php echo $this->Form->create('Currency');?>
	<fieldset>
 		<legend><?php __('Add Currency'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('rp_rate');
		echo $this->Form->input('last_update_tgl', array('value'=>date("Y-m-d"), 'type'=>'hidden'));
		echo $this->Form->input('description');
		echo $this->Form->checkbox('is_desimal');
		echo 'Is Decimal';
		echo $this->Form->input('language_id', array('options'=>array(1=>'Indonesia', 2=>'English'), 'default'=> 2, 'type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Currencies', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
	</ul>
</div>