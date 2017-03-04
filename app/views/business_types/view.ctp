<div class="businessTypes view">
<h2><?php  __('Business Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessType['BusinessType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business Type', true), array('action' => 'edit', $businessType['BusinessType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Business Type', true), array('action' => 'delete', $businessType['BusinessType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $businessType['BusinessType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Type', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Departments');?></h3>
	<?php if (!empty($businessType['Department'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Account Code'); ?></th>
		<th><?php __('Area'); ?></th>
		<th><?php __('Business Type Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($businessType['Department'] as $department):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $department['id'];?></td>
			<td><?php echo $department['code'];?></td>
			<td><?php echo $department['name'];?></td>
			<td><?php echo $department['account_code'];?></td>
			<td><?php echo $department['area'];?></td>
			<td><?php echo $department['business_type_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'departments', 'action' => 'view', $department['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'departments', 'action' => 'edit', $department['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'departments', 'action' => 'delete', $department['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $department['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
