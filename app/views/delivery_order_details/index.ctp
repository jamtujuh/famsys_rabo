<div class="deliveryOrderDetails index">
	<h2><?php __('Delivery Order Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('delivery_order_id');?></th>
			<th><?php echo $this->Paginator->sort('po_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('qty_received');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('price_cur');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('amount_cur');?></th>
			<th><?php echo $this->Paginator->sort('discount');?></th>
			<th><?php echo $this->Paginator->sort('discount_cur');?></th>
			<th><?php echo $this->Paginator->sort('amount_after_disc');?></th>
			<th><?php echo $this->Paginator->sort('amount_after_disc_cur');?></th>
			<th><?php echo $this->Paginator->sort('vat');?></th>
			<th><?php echo $this->Paginator->sort('vat_cur');?></th>
			<th><?php echo $this->Paginator->sort('amount_nett');?></th>
			<th><?php echo $this->Paginator->sort('amount_nett_cur');?></th>
			<th><?php echo $this->Paginator->sort('currency_id');?></th>
			<th><?php echo $this->Paginator->sort('rp_rate');?></th>
			<th><?php echo $this->Paginator->sort('npb_id');?></th>
			<th><?php echo $this->Paginator->sort('umurek');?></th>
			<th><?php echo $this->Paginator->sort('is_vat');?></th>
			<th><?php echo $this->Paginator->sort('is_wht');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($deliveryOrderDetails as $deliveryOrderDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deliveryOrderDetail['DeliveryOrder']['no'], array('controller' => 'delivery_orders', 'action' => 'view', $deliveryOrderDetail['DeliveryOrder']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($deliveryOrderDetail['Po']['no'], array('controller' => 'pos', 'action' => 'view', $deliveryOrderDetail['Po']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($deliveryOrderDetail['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $deliveryOrderDetail['AssetCategory']['id'])); ?>
		</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['name']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['color']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['brand']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['type']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['qty']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['qty_received']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['price']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['price_cur']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['amount']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['amount_cur']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['discount']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['discount_cur']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['amount_after_disc']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['amount_after_disc_cur']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['vat']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['vat_cur']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['amount_nett']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['amount_nett_cur']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deliveryOrderDetail['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $deliveryOrderDetail['Currency']['id'])); ?>
		</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['rp_rate']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deliveryOrderDetail['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $deliveryOrderDetail['Npb']['id'])); ?>
		</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['umurek']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['is_vat']; ?>&nbsp;</td>
		<td><?php echo $deliveryOrderDetail['DeliveryOrderDetail']['is_wht']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deliveryOrderDetail['Department']['name'], array('controller' => 'departments', 'action' => 'view', $deliveryOrderDetail['Department']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $deliveryOrderDetail['DeliveryOrderDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $deliveryOrderDetail['DeliveryOrderDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $deliveryOrderDetail['DeliveryOrderDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $deliveryOrderDetail['DeliveryOrderDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Delivery Order Detail', true), array('action' => 'add')); ?></li>
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