<div class="stocks form">
<?php echo $this->Form->create('Stock');?>
	<fieldset>
 		<legend><?php __('Edit Stock'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date');
		echo $this->Form->input('item_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('in_out');
		echo $this->Form->input('price');
		echo $this->Form->input('amount');
		echo $this->Form->input('outlog_id');
		echo $this->Form->input('usage_id');
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Stock.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Stock.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stocks', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usages', true), array('controller' => 'usages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usage', true), array('controller' => 'usages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>