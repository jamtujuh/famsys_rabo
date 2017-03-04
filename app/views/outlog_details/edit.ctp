<div class="outlogDetails form">
<?php echo $this->Form->create('OutlogDetail');?>
	<fieldset>
 		<legend><?php __('Edit Outlog Detail'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('outlog_id', array('type'=>'text', 'readonly'=>true));
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('OutlogDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('OutlogDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Outlog Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
	
	echo $javascript->event('OutlogDetailQty','change','calcAmount(\'OutlogDetail\')');
	echo $javascript->event('OutlogDetailPrice','change','calcAmount(\'OutlogDetail\')');
	echo $javascript->event('OutlogDetailAmount','change','calcAmount(\'OutlogDetail\')');
	
?>