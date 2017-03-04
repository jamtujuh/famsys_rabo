<div class="deliveryOrderStatuses form">
<?php echo $this->Form->create('DeliveryOrderStatus');?>
	<fieldset>
 		<legend><?php __('Add Delivery Order Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('sorter');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Delivery Order Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('New Delivery Order', true), array('controller' => 'delivery_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>