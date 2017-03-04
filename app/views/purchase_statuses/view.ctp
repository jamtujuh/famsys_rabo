<div class="purchaseStatuses view">
<h2><?php  __('Purchase Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchaseStatus['PurchaseStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchaseStatus['PurchaseStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $purchaseStatus['PurchaseStatus']['desc']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Purchase Status', true), array('action' => 'edit', $purchaseStatus['PurchaseStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Purchase Status', true), array('action' => 'delete', $purchaseStatus['PurchaseStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $purchaseStatus['PurchaseStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchase Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase', true), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Purchases');?></h3>
	<?php if (!empty($purchaseStatus['Purchase'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Doc No'); ?></th>
		<th><?php __('Warranty Id'); ?></th>
		<th><?php __('Warranty Name'); ?></th>
		<th><?php __('Warranty Year'); ?></th>
		<th><?php __('Requester Id'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Supplier Id'); ?></th>
		<th><?php __('Invoice No'); ?></th>
		<th><?php __('Po No'); ?></th>
		<th><?php __('Periode'); ?></th>
		<th><?php __('Serial No'); ?></th>
		<th><?php __('Voucher No'); ?></th>
		<th><?php __('Sup Tanggal'); ?></th>
		<th><?php __('Sup Vendor No'); ?></th>
		<th><?php __('Warranty Card'); ?></th>
		<th><?php __('Pos Ting'); ?></th>
		<th><?php __('Date Of Purchase'); ?></th>
		<th><?php __('Warranty Date'); ?></th>
		<th><?php __('Kd Luar Tanggal'); ?></th>
		<th><?php __('Delivery Order Id'); ?></th>
		<th><?php __('Currency Id'); ?></th>
		<th><?php __('Po Id'); ?></th>
		<th><?php __('Purchase Status Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($purchaseStatus['Purchase'] as $purchase):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $purchase['id'];?></td>
			<td><?php echo $purchase['no'];?></td>
			<td><?php echo $purchase['doc_no'];?></td>
			<td><?php echo $purchase['warranty_id'];?></td>
			<td><?php echo $purchase['warranty_name'];?></td>
			<td><?php echo $purchase['warranty_year'];?></td>
			<td><?php echo $purchase['requester_id'];?></td>
			<td><?php echo $purchase['department_id'];?></td>
			<td><?php echo $purchase['supplier_id'];?></td>
			<td><?php echo $purchase['invoice_no'];?></td>
			<td><?php echo $purchase['po_no'];?></td>
			<td><?php echo $purchase['periode'];?></td>
			<td><?php echo $purchase['serial_no'];?></td>
			<td><?php echo $purchase['voucher_no'];?></td>
			<td><?php echo $purchase['sup_tanggal'];?></td>
			<td><?php echo $purchase['sup_vendor_no'];?></td>
			<td><?php echo $purchase['warranty_card'];?></td>
			<td><?php echo $purchase['pos_ting'];?></td>
			<td><?php echo $purchase['date_of_purchase'];?></td>
			<td><?php echo $purchase['warranty_date'];?></td>
			<td><?php echo $purchase['kd_luar_tanggal'];?></td>
			<td><?php echo $purchase['delivery_order_id'];?></td>
			<td><?php echo $purchase['currency_id'];?></td>
			<td><?php echo $purchase['po_id'];?></td>
			<td><?php echo $purchase['purchase_status_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'purchases', 'action' => 'view', $purchase['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'purchases', 'action' => 'edit', $purchase['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'purchases', 'action' => 'delete', $purchase['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $purchase['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Purchase', true), array('controller' => 'purchases', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
