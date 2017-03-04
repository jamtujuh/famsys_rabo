<div class="inventoryLedgers form">
<?php echo $this->Form->create('InventoryLedger');?>
	<fieldset>
 		<legend><?php __('Add Inventory Ledger'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('item_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('in_out');
		echo $this->Form->input('price');
		echo $this->Form->input('amount');
		echo $this->Form->input('doc_id');
		echo $this->Form->input('po_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Inventory Ledgers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
	</ul>
</div>