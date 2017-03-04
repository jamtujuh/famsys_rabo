<div class="outlogStatuses view">
<h2><?php  __('Outlog Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogStatus['OutlogStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlogStatus['OutlogStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Outlog Status', true), array('action' => 'edit', $outlogStatus['OutlogStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Outlog Status', true), array('action' => 'delete', $outlogStatus['OutlogStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $outlogStatus['OutlogStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlog Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('controller' => 'outlogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Outlogs');?></h3>
	<?php if (!empty($outlogStatus['Outlog'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Created At'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Npb Id'); ?></th>
		<th><?php __('Is Process'); ?></th>
		<th><?php __('Is Printed'); ?></th>
		<th><?php __('Outlog Status Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($outlogStatus['Outlog'] as $outlog):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $outlog['id'];?></td>
			<td><?php echo $outlog['no'];?></td>
			<td><?php echo $outlog['date'];?></td>
			<td><?php echo $outlog['department_id'];?></td>
			<td><?php echo $outlog['created_at'];?></td>
			<td><?php echo $outlog['created_by'];?></td>
			<td><?php echo $outlog['npb_id'];?></td>
			<td><?php echo $outlog['is_process'];?></td>
			<td><?php echo $outlog['is_printed'];?></td>
			<td><?php echo $outlog['outlog_status_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'outlogs', 'action' => 'view', $outlog['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'outlogs', 'action' => 'edit', $outlog['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'outlogs', 'action' => 'delete', $outlog['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $outlog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Outlog', true), array('controller' => 'outlogs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
