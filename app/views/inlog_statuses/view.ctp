<div class="inlogStatuses view">
<h2><?php  __('Inlog Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogStatus['InlogStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlogStatus['InlogStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inlog Status', true), array('action' => 'edit', $inlogStatus['InlogStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Inlog Status', true), array('action' => 'delete', $inlogStatus['InlogStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inlogStatus['InlogStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inlog Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('controller' => 'inlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Inlogs');?></h3>
	<?php if (!empty($inlogStatus['Inlog'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Supplier Id'); ?></th>
		<th><?php __('Po Id'); ?></th>
		<th><?php __('Created At'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Invoice Id'); ?></th>
		<th><?php __('Delivery Order Id'); ?></th>
		<th><?php __('Inlog Status Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($inlogStatus['Inlog'] as $inlog):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $inlog['id'];?></td>
			<td><?php echo $inlog['no'];?></td>
			<td><?php echo $inlog['date'];?></td>
			<td><?php echo $inlog['supplier_id'];?></td>
			<td><?php echo $inlog['po_id'];?></td>
			<td><?php echo $inlog['created_at'];?></td>
			<td><?php echo $inlog['created_by'];?></td>
			<td><?php echo $inlog['invoice_id'];?></td>
			<td><?php echo $inlog['delivery_order_id'];?></td>
			<td><?php echo $inlog['inlog_status_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'inlogs', 'action' => 'view', $inlog['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'inlogs', 'action' => 'edit', $inlog['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'inlogs', 'action' => 'delete', $inlog['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inlog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inlog', true), array('controller' => 'inlogs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
