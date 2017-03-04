<div class="deliveryOrderDetails form">
<?php echo $this->Form->create('DeliveryOrderDetail');?>
	<fieldset>
 		<legend><?php __('Add Delivery Order Detail'); ?></legend>
	<?php
		echo $this->Form->input('delivery_order_id');
		echo $this->Form->input('po_id');
		echo $this->Form->input('asset_category_id');
		echo $this->Form->input('name');
		echo $this->Form->input('color');
		echo $this->Form->input('brand');
		echo $this->Form->input('type');
		echo $this->Form->input('qty');
		echo $this->Form->input('qty_received');
		echo $this->Form->input('price');
		echo $this->Form->input('price_cur');
		echo $this->Form->input('amount');
		echo $this->Form->input('amount_cur');
		echo $this->Form->input('discount');
		echo $this->Form->input('discount_cur');
		echo $this->Form->input('amount_after_disc');
		echo $this->Form->input('amount_after_disc_cur');
		echo $this->Form->input('vat');
		echo $this->Form->input('vat_cur');
		echo $this->Form->input('amount_nett');
		echo $this->Form->input('amount_nett_cur');
		echo $this->Form->input('currency_id');
		echo $this->Form->input('rp_rate');
		echo $this->Form->input('npb_id');
		echo $this->Form->input('umurek');
		echo $this->Form->input('is_vat');
		echo $this->Form->input('is_wht');
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Delivery Order Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Delivery Orders', true), array('controller' => 'delivery_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Delivery Order', true), array('controller' => 'delivery_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>