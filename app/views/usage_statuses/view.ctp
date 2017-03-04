<div class="importStatuses view">
<h2><?php  __('Import Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $importStatus['UsageStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $importStatus['UsageStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Import Status', true), array('action' => 'edit', $importStatus['UsageStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Import Status', true), array('action' => 'delete', $importStatus['UsageStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $importStatus['UsageStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Import Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Import Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usages', true), array('controller' => 'imports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Import', true), array('controller' => 'imports', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Usages');?></h3>
	<?php if (!empty($importStatus['Import'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Created At'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Is Process'); ?></th>
		<th><?php __('Is Printed'); ?></th>
		<th><?php __('Import Status Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($importStatus['Import'] as $import):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $import['id'];?></td>
			<td><?php echo $import['no'];?></td>
			<td><?php echo $import['date'];?></td>
			<td><?php echo $import['department_id'];?></td>
			<td><?php echo $import['created_at'];?></td>
			<td><?php echo $import['created_by'];?></td>
			<td><?php echo $import['description'];?></td>
			<td><?php echo $import['is_process'];?></td>
			<td><?php echo $import['is_printed'];?></td>
			<td><?php echo $import['import_status_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'imports', 'action' => 'view', $import['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'imports', 'action' => 'edit', $import['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'imports', 'action' => 'delete', $import['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $import['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Import', true), array('controller' => 'imports', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
