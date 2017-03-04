<div class="deliveryOrderStatuses view">
<h2><?php  __('Delivery Order Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrderStatus['DeliveryOrderStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sorter'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrderStatus['DeliveryOrderStatus']['sorter']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Delivery Order Status', true), array('action' => 'edit', $deliveryOrderStatus['DeliveryOrderStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Delivery Order Status', true), array('action' => 'delete', $deliveryOrderStatus['DeliveryOrderStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $deliveryOrderStatus['DeliveryOrderStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Delivery Order Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Delivery Order Status', true), array('action' => 'add')); ?> </li>
	</ul>
</div>