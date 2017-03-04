<div class="returStatuses view">
<h2><?php  __('Retur Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returStatus['ReturStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $returStatus['ReturStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Retur Status', true), array('action' => 'edit', $returStatus['ReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Retur Status', true), array('action' => 'delete', $returStatus['ReturStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $returStatus['ReturStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Retur Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Returs', true), array('controller' => 'returs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Returs');?></h3>
	<?php if (!empty($returStatus['Retur'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Created At'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Is Process'); ?></th>
		<th><?php __('Is Printed'); ?></th>
		<th><?php __('Retur Status Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($returStatus['Retur'] as $retur):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $retur['id'];?></td>
			<td><?php echo $retur['no'];?></td>
			<td><?php echo $retur['date'];?></td>
			<td><?php echo $retur['department_id'];?></td>
			<td><?php echo $retur['created_at'];?></td>
			<td><?php echo $retur['created_by'];?></td>
			<td><?php echo $retur['is_process'];?></td>
			<td><?php echo $retur['is_printed'];?></td>
			<td><?php echo $retur['retur_status_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'returs', 'action' => 'view', $retur['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'returs', 'action' => 'edit', $retur['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'returs', 'action' => 'delete', $retur['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $retur['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Retur', true), array('controller' => 'returs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
