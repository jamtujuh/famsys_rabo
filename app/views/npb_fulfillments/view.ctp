<div class="npbFulfillments view">
<h2><?php  __('Npb Fulfillment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbFulfillment['NpbFulfillment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbFulfillment['NpbFulfillment']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npbFulfillment['NpbFulfillment']['descr']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Npb Fulfillment', true), array('action' => 'edit', $npbFulfillment['NpbFulfillment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Npb Fulfillment', true), array('action' => 'delete', $npbFulfillment['NpbFulfillment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbFulfillment['NpbFulfillment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Npb Fulfillments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb Fulfillment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Npbs');?></h3>
	<?php if (!empty($npbFulfillment['Npb'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Npb Date'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Supplier Id'); ?></th>
		<th><?php __('Req Date'); ?></th>
		<th><?php __('Status Id'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Created Date'); ?></th>
		<th><?php __('Fulfillment Id'); ?></th>
		<th><?php __('Reject Notes'); ?></th>
		<th><?php __('Reject By'); ?></th>
		<th><?php __('Reject Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($npbFulfillment['Npb'] as $npb):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $npb['id'];?></td>
			<td><?php echo $npb['no'];?></td>
			<td><?php echo $npb['npb_date'];?></td>
			<td><?php echo $npb['department_id'];?></td>
			<td><?php echo $npb['supplier_id'];?></td>
			<td><?php echo $this->Time->format(DATE_FORMAT, $npb['req_date']); ?></td>
			<td><?php echo $npb['status_id'];?></td>
			<td><?php echo $npb['notes'];?></td>
			<td><?php echo $npb['created_by'];?></td>
			<td><?php echo $npb['created_date'];?></td>
			<td><?php echo $npb['fulfillment_id'];?></td>
			<td><?php echo $npb['reject_notes'];?></td>
			<td><?php echo $npb['reject_by'];?></td>
			<td><?php echo $npb['reject_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'npbs', 'action' => 'view', $npb['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'npbs', 'action' => 'edit', $npb['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'npbs', 'action' => 'delete', $npb['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npb['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Npb', true), array('controller' => 'npbs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>