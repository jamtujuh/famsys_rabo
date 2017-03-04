<div class="npbDetails form">
<?php echo $this->Form->create('NpbDetail');?>
	<fieldset>
 		<legend><?php __('Recap MRs'); ?></legend>
	<?php		
		echo $this->Form->input('per', array('label'=>'Periode', 'options'=>$periode, 'type'=>'select', 'empty'=>'Select Periode') );
		echo date('M-Y');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Npb Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Point Reward', true), array('action' => 'voucher_index')); ?> </li>
	</ul>
</div>
