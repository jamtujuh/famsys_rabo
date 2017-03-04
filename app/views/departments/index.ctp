<div id="moduleName"><?php echo $moduleName?></div>
 <div class="departments index">
	<h2><?php __('Departments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('account_code');?></th>
			<th><?php echo $this->Paginator->sort('area');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($departments as $branch):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $branch['BusinessType']['name']; ?>&nbsp;</td>
		<td><?php echo $branch['Department']['name']; ?>&nbsp;</td>
		<td><?php echo $branch['Department']['account_code']; ?>&nbsp;</td>
		<td><?php echo $branch['Department']['area']; ?>&nbsp;</td>
		<td><?php echo $branch['Department']['code']; ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $branch['Department']['id'])); ?>
		<?php if($this->Session->read('Security.permissions') == admin_group_id):?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $branch['Department']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $branch['Department']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $branch['Department']['id'])); ?>
		<?php endif;?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Locations', true), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<?php if($this->Session->read('Security.permissions') == admin_group_id):?>
		<li><?php echo $this->Html->link(__('New Department', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('New Location', true), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cost Center', true), array('controller' => 'cost_centers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cost Center', true), array('controller' => 'cost_centers', 'action' => 'index')); ?> </li>
		<?php endif;?>
	</ul>
</div>