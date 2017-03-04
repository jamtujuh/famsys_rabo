<div class="accounts index">
	<h2><?php __('Accounts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('gl');?></th>
			<th><?php echo $this->Paginator->sort('account_type_id');?></th>
			<th><?php echo $this->Paginator->sort('debit');?></th>
			<th><?php echo $this->Paginator->sort('credit');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($accounts as $account):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $account['Account']['name']; ?>&nbsp;</td>
		<td><?php echo $account['Account']['gl']; ?>&nbsp;</td>
		<td><?php echo $account['AccountType']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image($account['Account']['debit'].'.gif'); ?>&nbsp;</td>
		<td><?php echo $this->Html->image($account['Account']['credit'].'.gif'); ?>&nbsp;</td>
		<!--td>
			<?php echo $this->Html->link($account['AccountGlobal']['name'], array('controller' => 'account_globals', 'action' => 'view', $account['AccountGlobal']['id'])); ?>
		</td-->
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $account['Account']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $account['Account']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $account['Account']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $account['Account']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Account', true), array('action' => 'add')); ?></li>
	</ul>
</div>