<div class="returDetails form">
<?php echo $this->Form->create('ReturDetail');?>
	<fieldset>
 		<legend><?php __('Edit Retur Detail'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type'=>'text', 'readonly'=>true));
		echo $this->Form->input('retur_id', array('type'=>'text', 'readonly'=>true));
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ReturDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ReturDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Retur Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Returs', true), array('controller' => 'returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php
	echo $javascript->link('prototype',false);
	echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);
	
	echo $javascript->event('ReturDetailQty','change','calcAmount(\'ReturDetail\')');
	echo $javascript->event('ReturDetailPrice','change','calcAmount(\'ReturDetail\')');
	echo $javascript->event('ReturDetailAmount','change','calcAmount(\'ReturDetail\')');
	
?>