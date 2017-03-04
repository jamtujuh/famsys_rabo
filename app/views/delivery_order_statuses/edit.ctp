<div class="deliveryOrderStatuses form">
<?php echo $this->Form->create('DeliveryOrderStatus');?>
	<fieldset>
 		<legend><?php __('Edit Delivery Order Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sorter');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DeliveryOrderStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DeliveryOrderStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Delivery Order Statuses', true), array('action' => 'index'));?></li>
	</ul>
</div>