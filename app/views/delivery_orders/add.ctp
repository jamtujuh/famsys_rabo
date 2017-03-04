<div class="deliveryOrders form">
<?php echo $this->Form->create('DeliveryOrder');?>
	<fieldset>
 		<legend><?php __('Add Delivery Order'); ?></legend>
	<?php
		echo $this->Form->input('po_id', array('type'=>'hidden','value'=>$po_id));
		echo $this->Form->input('is_first', array('type'=>'hidden','value'=>$is_first));
		echo $this->Form->input('po_no', array('readonly'=>'true', 'value'=>$po_no) );
		echo $this->Form->input('no');
		echo $this->Form->input('do_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));
		echo $this->Form->input('supplier_name', array('readonly'=>'true', 'value'=>$supplier_name,'style'=>'width:60%') );
		echo $this->Form->input('department_name', array('type'=>'hidden', 'value'=>$department_name,'style'=>'width:60%') );
		
		echo $this->Form->input('supplier_id', array('type'=>'hidden', 'value'=>$supplier_id) );
		echo $this->Form->input('currency_id', array('type'=>'hidden', 'value'=>$currency_id) );
		echo $this->Form->input('request_type_id', array('type'=>'hidden', 'value'=>$request_type_id) );
		echo $this->Form->input('department_id', array('type'=>'hidden'));
		echo $this->Form->input('delivery_order_status',array('readonly'=>true, 'type'=>'text', 'value'=>$deliveryOrderStatuses[status_delivery_order_new_id]));
		echo $this->Form->input('delivery_order_status_id',array('type'=>'hidden', 'value'=>status_delivery_order_new_id));
		echo $this->Form->input('description', array('style'=>'width:98%', 'label'=>'Notes'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Delivery Orders', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
	</ul>
</div>