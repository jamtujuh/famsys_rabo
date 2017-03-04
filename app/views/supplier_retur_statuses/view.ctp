<div class="supplierReturStatuses view">
<h2><?php  __('Supplier Retur Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplierReturStatus['SupplierReturStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplierReturStatus['SupplierReturStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Supplier Retur Status', true), array('action' => 'edit', $supplierReturStatus['SupplierReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Supplier Retur Status', true), array('action' => 'delete', $supplierReturStatus['SupplierReturStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplierReturStatus['SupplierReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Supplier Retur Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier Retur Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Supplier Returs', true), array('controller' => 'supplier_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier Retur', true), array('controller' => 'supplier_returs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Supplier Returs');?></h3>
	<?php if (!empty($supplierReturStatus['SupplierRetur'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Supplier Id'); ?></th>
		<th><?php __('Created At'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Is Process'); ?></th>
		<th><?php __('Is Printed'); ?></th>
		<th><?php __('Supplier Retur Status Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($supplierReturStatus['SupplierRetur'] as $supplierRetur):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $supplierRetur['id'];?></td>
			<td><?php echo $supplierRetur['no'];?></td>
			<td><?php echo $supplierRetur['date'];?></td>
			<td><?php echo $supplierRetur['department_id'];?></td>
			<td><?php echo $supplierRetur['supplier_id'];?></td>
			<td><?php echo $supplierRetur['created_at'];?></td>
			<td><?php echo $supplierRetur['created_by'];?></td>
			<td><?php echo $supplierRetur['is_process'];?></td>
			<td><?php echo $supplierRetur['is_printed'];?></td>
			<td><?php echo $supplierRetur['supplier_retur_status_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'supplier_returs', 'action' => 'view', $supplierRetur['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'supplier_returs', 'action' => 'edit', $supplierRetur['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'supplier_returs', 'action' => 'delete', $supplierRetur['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplierRetur['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Supplier Retur', true), array('controller' => 'supplier_returs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
