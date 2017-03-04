<div class="currencyDetails index">
	<h2><?php __('Currency Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('currency_id');?></th>
			<th><?php echo $this->Paginator->sort('tanggal');?></th>
			<th><?php echo $this->Paginator->sort('rp_rate');?></th>
			<th><?php echo $this->Paginator->sort('rp_BI_rate');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($currencyDetails as $currencyDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $currencyDetail['CurrencyDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($currencyDetail['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $currencyDetail['Currency']['id'])); ?>
		</td>
		<td><?php echo $currencyDetail['CurrencyDetail']['tanggal']; ?>&nbsp;</td>
		<td><?php echo $currencyDetail['CurrencyDetail']['rp_rate']; ?>&nbsp;</td>
		<td><?php echo $currencyDetail['CurrencyDetail']['rp_BI_rate']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $currencyDetail['CurrencyDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $currencyDetail['CurrencyDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $currencyDetail['CurrencyDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $currencyDetail['CurrencyDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Currency Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Currencies', true), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency', true), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>