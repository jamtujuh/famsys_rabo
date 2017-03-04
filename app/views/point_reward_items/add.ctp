<div class="outlogs form">
<?php echo $this->Form->create('PointRewardItem');?>
	<fieldset>
 		<legend><?php __('Add Point Reward Item'); ?></legend>
	<?php
		echo $this->Form->input('item_id', array('options'=>$items, 'empty'=>'-select item-') );
		echo $this->Form->input('item_prefix', array('type'=>'text', 'maxlength'=>'5'));
		echo $this->Form->input('mark', array('options'=>$opts, 'empty'=>'-select type-'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller'=>'items','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Point Reward Items', true), array('action' => 'index'));?></li>		
	</ul>
</div>
