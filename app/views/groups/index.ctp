<div class="groups index">
	<h2><?php __('Groups');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('auth_amount');?></th>
			<th><?php echo $this->Paginator->sort('is_admin');?></th>
			<th><?php echo $this->Paginator->sort('descr');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($groups as $group):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $group['Group']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Number->format($group['Group']['auth_amount']); ?>&nbsp;</td>
		<td><?php echo $group['Group']['is_admin']==1?'Yes':'No'; ?>&nbsp;</td>
		<td><?php echo $group['Group']['descr']; ?>&nbsp;</td>
		<td class="actions">
		<?php if($Userinfo['group_is_admin'] == 1):?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $group['Group']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $group['Group']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id'])); ?>
			<?php echo $this->Html->link(__('Print Menu xls', true), array('action' => 'export_xls', $group['Group']['id'])); ?>
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
		<?php if($Userinfo['group_is_admin'] == 1):?>
		<li><?php echo $this->Html->link(__('New Group', true), array('action' => 'add')); ?></li>
		<?php endif;?>
	</ul>
</div>
<div class="doc_actions">
	<ul>
		<?php if($Userinfo['group_is_admin'] == 1):?>
		<li><?php echo $this->Html->link(__('Print PDF', true), array('action' => 'index',  'pdf')); ?> </li>
		<li><?php echo $this->Html->link(__('Print XLS', true), array('action' => 'index',  'xls')); ?> </li>
		<?php endif;?>
	</ul>
</div>
