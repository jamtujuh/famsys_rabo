<div class="faReturStatuses view">
<h2><?php  __('Fa Retur Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faReturStatus['FaReturStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $faReturStatus['FaReturStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fa Retur Status', true), array('action' => 'edit', $faReturStatus['FaReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fa Retur Status', true), array('action' => 'delete', $faReturStatus['FaReturStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faReturStatus['FaReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fa Retur Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Retur Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fa Returs', true), array('controller' => 'fa_returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fa Retur', true), array('controller' => 'fa_returs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Fa Returs');?></h3>
	<?php if (!empty($faReturStatus['FaRetur'])):?>
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
		<th><?php __('Fa Retur Status Id'); ?></th>
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
		foreach ($faReturStatus['FaRetur'] as $faRetur):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $faRetur['id'];?></td>
			<td><?php echo $faRetur['doc_date'];?></td>
			<td><?php echo $faRetur['no'];?></td>
			<td><?php echo $faRetur['department_id'];?></td>
			<td><?php echo $faRetur['business_type_id'];?></td>
			<td><?php echo $faRetur['cost_center_id'];?></td>
			<td><?php echo $faRetur['created_by'];?></td>
			<td><?php echo $faRetur['notes'];?></td>
			<td><?php echo $faRetur['fa_retur_status_id'];?></td>
			<td><?php echo $faRetur['reject_notes'];?></td>
			<td><?php echo $faRetur['reject_by'];?></td>
			<td><?php echo $faRetur['reject_date'];?></td>
			<td><?php echo $faRetur['cancel_notes'];?></td>
			<td><?php echo $faRetur['cancel_by'];?></td>
			<td><?php echo $faRetur['cancel_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'fa_returs', 'action' => 'view', $faRetur['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'fa_returs', 'action' => 'edit', $faRetur['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'fa_returs', 'action' => 'delete', $faRetur['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $faRetur['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fa Retur', true), array('controller' => 'fa_returs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
