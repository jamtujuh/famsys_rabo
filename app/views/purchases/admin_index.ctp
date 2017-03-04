<div class="purchases index">
	<h2><?php __('Purchases');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tanggal');?></th>
			<th><?php echo $this->Paginator->sort('warranty_id');?></th>
			<th><?php echo $this->Paginator->sort('id_requester');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('invoice_no');?></th>
			<th><?php echo $this->Paginator->sort('po_no');?></th>
			<th><?php echo $this->Paginator->sort('periode');?></th>
			<th><?php echo $this->Paginator->sort('serial_no');?></th>
			<th><?php echo $this->Paginator->sort('voucher_no');?></th>
			<th><?php echo $this->Paginator->sort('doc_total');?></th>
			<th><?php echo $this->Paginator->sort('doc_rup');?></th>
			<th><?php echo $this->Paginator->sort('sup_tanggal');?></th>
			<th><?php echo $this->Paginator->sort('sup_vendor_no');?></th>
			<th><?php echo $this->Paginator->sort('warranty_card');?></th>
			<th><?php echo $this->Paginator->sort('pos_ting');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('warranty_date');?></th>
			<th><?php echo $this->Paginator->sort('kd_luar_tanggal');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($purchases as $purchase):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $purchase['Purchase']['id']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['tanggal']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($purchase['Warranty']['name'], array('controller' => 'warranties', 'action' => 'view', $purchase['Warranty']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($purchase['Requester']['name'], array('controller' => 'requesters', 'action' => 'view', $purchase['Requester']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($purchase['Department']['name'], array('controller' => 'departments', 'action' => 'view', $purchase['Department']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($purchase['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchase['Supplier']['supplier_id'])); ?>
		</td>
		<td><?php echo $purchase['Purchase']['invoice_no']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['po_no']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['periode']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['serial_no']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['voucher_no']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['doc_total']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['doc_rup']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['sup_tanggal']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['sup_vendor_no']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['warranty_card']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['pos_ting']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['date_of_purchase']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['warranty_date']; ?>&nbsp;</td>
		<td><?php echo $purchase['Purchase']['kd_luar_tanggal']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $purchase['Purchase']['purchase_id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $purchase['Purchase']['purchase_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $purchase['Purchase']['purchase_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $purchase['Purchase']['purchase_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Purchase', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Warranties', true), array('controller' => 'warranties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warranty', true), array('controller' => 'warranties', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requesters', true), array('controller' => 'requesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requester', true), array('controller' => 'requesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>