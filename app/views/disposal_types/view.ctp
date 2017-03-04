<div class="disposalTypes view">
<h2><?php  __('Disposal Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalType['DisposalType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disposalType['DisposalType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Disposal Type', true), array('action' => 'edit', $disposalType['DisposalType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Disposal Type', true), array('action' => 'delete', $disposalType['DisposalType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $disposalType['DisposalType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Disposal Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Disposals', true), array('controller' => 'disposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disposal', true), array('controller' => 'disposals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Disposals');?></h3>
	<?php if (!empty($disposalType['Disposal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Doc Date'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Department Id'); ?></th>
		<th><?php __('Created By'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th><?php __('Disposal Status Id'); ?></th>
		<th><?php __('Disposal Type Id'); ?></th>
		<th><?php __('Reject Notes'); ?></th>
		<th><?php __('Reject By'); ?></th>
		<th><?php __('Reject Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($disposalType['Disposal'] as $disposal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $disposal['id'];?></td>
			<td><?php echo $disposal['doc_date'];?></td>
			<td><?php echo $disposal['no'];?></td>
			<td><?php echo $disposal['department_id'];?></td>
			<td><?php echo $disposal['created_by'];?></td>
			<td><?php echo $disposal['notes'];?></td>
			<td><?php echo $disposal['disposal_status_id'];?></td>
			<td><?php echo $disposal['disposal_type_id'];?></td>
			<td><?php echo $disposal['reject_notes'];?></td>
			<td><?php echo $disposal['reject_by'];?></td>
			<td><?php echo $disposal['reject_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'disposals', 'action' => 'view', $disposal['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'disposals', 'action' => 'edit', $disposal['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'disposals', 'action' => 'delete', $disposal['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $disposal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Disposal', true), array('controller' => 'disposals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
