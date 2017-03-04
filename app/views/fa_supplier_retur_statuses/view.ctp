<div class="faSupplierReturStatuses view">
<h2><?php  __('Fa Supplier Retur Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturStatus['FaSupplierReturStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faSupplierReturStatus['FaSupplierReturStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fa Supplier Retur Status', true), array('action' => 'edit', $faSupplierReturStatus['FaSupplierReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fa Supplier Retur Status', true), array('action' => 'delete', $faSupplierReturStatus['FaSupplierReturStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faSupplierReturStatus['FaSupplierReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fa Supplier Retur Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Supplier Retur Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fa Supplier Returs', true), array('controller' => 'fa_supplier_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Supplier Retur', true), array('controller' => 'fa_supplier_returs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Fa Supplier Returs');?></h3>
	<?php if (!empty($faSupplierReturStatus['FaSupplierRetur'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Doc Date'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Business Type Id'); ?></th>
		<th><?php __('Cost Center Id'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th><?php __('Fa Supplier Retur Status Id'); ?></th>
		<th><?php __('Reject Notes'); ?></th>
		<th><?php __('Reject By'); ?></th>
		<th><?php __('Reject Date'); ?></th>
		<th><?php __('Cancel Notes'); ?></th>
		<th><?php __('Cancel By'); ?></th>
		<th><?php __('Cancel Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($faSupplierReturStatus['FaSupplierRetur'] as $faSupplierRetur):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $faSupplierRetur['id'];?></td>
			<td><?php echo $faSupplierRetur['doc_date'];?></td>
			<td><?php echo $faSupplierRetur['no'];?></td>
			<td><?php echo $faSupplierRetur['department_id'];?></td>
			<td><?php echo $faSupplierRetur['business_type_id'];?></td>
			<td><?php echo $faSupplierRetur['cost_center_id'];?></td>
			<td><?php echo $faSupplierRetur['created_by'];?></td>
			<td><?php echo $faSupplierRetur['notes'];?></td>
			<td><?php echo $faSupplierRetur['fa_retur_status_id'];?></td>
			<td><?php echo $faSupplierRetur['reject_notes'];?></td>
			<td><?php echo $faSupplierRetur['reject_by'];?></td>
			<td><?php echo $faSupplierRetur['reject_date'];?></td>
			<td><?php echo $faSupplierRetur['cancel_notes'];?></td>
			<td><?php echo $faSupplierRetur['cancel_by'];?></td>
			<td><?php echo $faSupplierRetur['cancel_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'fa_supplier_returs', 'action' => 'view', $faSupplierRetur['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'fa_supplier_returs', 'action' => 'edit', $faSupplierRetur['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'fa_supplier_returs', 'action' => 'delete', $faSupplierRetur['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faSupplierRetur['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fa Supplier Retur', true), array('controller' => 'fa_supplier_returs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
