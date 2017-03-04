<div class="inlogDetails form">
<?php echo $this->Form->create('InlogDetail');?>
	<fieldset>
 		<legend><?php __('Edit Inlog Detail'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('inlog_id', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('item_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('price');
		echo $this->Form->input('amount', array('readonly'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('InlogDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('InlogDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Inlog Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('controller' => 'inlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
	
	echo $javascript->event('InlogDetailQty','change','calcAmount(\'InlogDetail\')');
	echo $javascript->event('InlogDetailPrice','change','calcAmount(\'InlogDetail\')');
	echo $javascript->event('InlogDetailAmount','change','calcAmount(\'InlogDetail\')');
	
?>