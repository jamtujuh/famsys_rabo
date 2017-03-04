<div class="currencies form">
<?php echo $this->Form->create('Currency');?>
	<fieldset>
 		<legend><?php __('Edit Currency'); ?></legend>
	<?php
		echo $this->Form->input('id');
	if($currency['Currency']['name'] == 'Rp' || $currency['Currency']['id'] == 1){
		echo $this->Form->input('name', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('rp_rate', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('last_update_tgl', array('value'=>date("Y-m-d"), 'type'=>'hidden'));
		echo $this->Form->input('description');
		echo $this->Form->input('rp_BI_rate');
	}else{
		echo $this->Form->input('name');
		echo $this->Form->input('rp_rate');
		echo $this->Form->input('last_update_tgl', array('value'=>date("Y-m-d"), 'type'=>'hidden'));
		echo $this->Form->input('description');
		echo $this->Form->input('rp_BI_rate');
		echo $this->Form->checkbox('is_desimal');
		echo 'Is Decimal';
		echo $this->Form->input('language_id', array('options'=>array(1=>'Indonesia', 2=>'English'), 'default'=> 2, 'type'=>'hidden'));
	}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
			<?php if($currency['Currency']['name'] != 'Rp' || $currency['Currency']['id'] != 1):?>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Currency.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Currency.id'))); ?></li>
			<?php endif;?>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currency Details', true), array('controller' => 'currency_details', 'action' => 'index')); ?> </li>
	</ul>
</div>