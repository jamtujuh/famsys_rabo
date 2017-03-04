<div class="npbDetails form">
<?php echo $this->Form->create('NpbDetail');?>
	<fieldset>
 		<legend><?php __('Edit Npb Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('npb_id', array('readonly'=>true));
		echo $this->Form->input('item_id', array('options'=>$requestTypes));
		echo $this->Form->input('qty');
		echo $this->Form->input('currency_id', array(  'type'=>'hidden'));
		echo $this->Form->input('price', array(  'type'=>'hidden'));
		echo $this->Form->input('price_cur', array(  'type'=>'hidden'));
		echo $this->Form->input('amount', array(  'type'=>'hidden'));
		echo $this->Form->input('amount_cur', array(  'type'=>'hidden'));
		echo $this->Form->input('descr' , array('style'=>'width:98%') );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('NpbDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('NpbDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Npb Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>