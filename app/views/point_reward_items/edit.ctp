<div class="outlogs form">
<?php echo $this->Form->create('PointRewardItem');?>
	<fieldset>
 		<legend><?php __('Edit Point Reward Item'); ?></legend>
	<?php
		echo $this->Form->input('id', array('value'=>$pointItem['PointRewardItem']['id'], 'type'=>'hidden') );
		echo $this->Form->input('item_id', array('options'=>$items, 'value'=>$this->Session->read('PointRewardItem.item_id'), 'disabled'=>'disabled') );
		echo $this->Form->input('item_prefix', array('type'=>'text', 'maxlength'=>'5', 'value'=>$pointItem['PointRewardItem']['item_prefix']));
		echo $this->Form->input('mark', array('options'=>$opts, 'value'=>$this->Session->read('PointRewardItem.mark')));
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
