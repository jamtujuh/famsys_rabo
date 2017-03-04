<div class="purchaseStatuses form">
<?php echo $this->Form->create('PurchaseStatus');?>
	<fieldset>
 		<legend><?php __('Add Purchase Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('desc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Purchase Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase', true), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
	</ul>
</div>