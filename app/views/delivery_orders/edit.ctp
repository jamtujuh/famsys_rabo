<div class="deliveryOrders form">
<?php echo $this->Form->create('DeliveryOrder');?>
	<fieldset>
 		<legend><?php __('Edit Delivery Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('po_id', array('value'=>$this->data['Po']['no'], 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('no', array('value'=>$this->data['DeliveryOrder']['no'], 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('do_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('supplier_id', array('value'=>$this->data['Supplier']['name'], 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('department_id', array('value'=>$this->data['Department']['name'], 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('description', array('style'=>'width:98%', 'label'=>'Notes', 'value'=>$this->data['DeliveryOrder']['description']));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DeliveryOrder.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DeliveryOrder.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Delivery Orders', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Delivery Order Statuses', true), array('controller' => 'delivery_order_statuses', 'action' => 'index')); ?> </li>
	</ul>
</div>