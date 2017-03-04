<div class="poPayments index">
	<h2><?php __('Po Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('po_id');?></th>
			<th><?php echo $this->Paginator->sort('term');?></th>
			<th><?php echo $this->Paginator->sort('payment_date');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($poPayments as $poPayment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $poPayment['PoPayment']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($poPayment['Po']['no'], array('controller' => 'pos', 'action' => 'view', $poPayment['Po']['id'])); ?>
		</td>
		<td><?php echo $poPayment['PoPayment']['term']; ?>&nbsp;</td>
		<td><?php echo $poPayment['PoPayment']['payment_date']; ?>&nbsp;</td>
		<td><?php echo $poPayment['PoPayment']['amount']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $poPayment['PoPayment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $poPayment['PoPayment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $poPayment['PoPayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $poPayment['PoPayment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Po Payment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Po', true), array('controller' => 'pos', 'action' => 'add')); ?> </li>
	</ul>
</div>