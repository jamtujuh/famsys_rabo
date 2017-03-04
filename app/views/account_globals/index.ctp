<div class="accountGlobals index">
	<h2><?php __('Account Globals');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('level');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('detail');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($accountGlobals as $accountGlobal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $accountGlobal['AccountGlobal']['id']; ?>&nbsp;</td>
		<td><?php echo $accountGlobal['AccountGlobal']['code']; ?>&nbsp;</td>
		<td><?php echo $accountGlobal['AccountGlobal']['name']; ?>&nbsp;</td>
		<td><?php echo $accountGlobal['AccountGlobal']['level']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($accountGlobal['ParentAccountGlobal']['name'], array('controller' => 'account_globals', 'action' => 'view', $accountGlobal['ParentAccountGlobal']['id'])); ?>
		</td>
		<td><?php echo $accountGlobal['AccountGlobal']['detail']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $accountGlobal['AccountGlobal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $accountGlobal['AccountGlobal']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $accountGlobal['AccountGlobal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $accountGlobal['AccountGlobal']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Account Global', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Account Globals', true), array('controller' => 'account_globals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Account Global', true), array('controller' => 'account_globals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>