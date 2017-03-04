<div class="processTypes view">
<h2><?php  __('Process Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $processType['ProcessType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $processType['ProcessType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Process Type', true), array('action' => 'edit', $processType['ProcessType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Process Type', true), array('action' => 'delete', $processType['ProcessType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $processType['ProcessType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Process Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Process Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Npb Details', true), array('controller' => 'npb_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb Detail', true), array('controller' => 'npb_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Npb Details');?></h3>
	<?php if (!empty($processType['NpbDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Npb Id'); ?></th>
		<th><?php __('Po Id'); ?></th>
		<th><?php __('Movement Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Fulfillment Id'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Qty Filled'); ?></th>
		<th><?php __('Price'); ?></th>
		<th><?php __('Price Cur'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Amount Cur'); ?></th>
		<th><?php __('Currency Id'); ?></th>
		<th><?php __('Rp Rate'); ?></th>
		<th><?php __('Descr'); ?></th>
		<th><?php __('Discount'); ?></th>
		<th><?php __('Discount Cur'); ?></th>
		<th><?php __('Amount Net'); ?></th>
		<th><?php __('Amount Net Cur'); ?></th>
		<th><?php __('Date Finish'); ?></th>
		<th><?php __('Qty Unfilled'); ?></th>
		<th><?php __('Unit Id'); ?></th>
		<th><?php __('Outlog Id'); ?></th>
		<th><?php __('Npb Detai Id'); ?></th>
		<th><?php __('Is Movement'); ?></th>
		<th><?php __('Process Type Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($processType['NpbDetail'] as $npbDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $npbDetail['id'];?></td>
			<td><?php echo $npbDetail['npb_id'];?></td>
			<td><?php echo $npbDetail['po_id'];?></td>
			<td><?php echo $npbDetail['movement_id'];?></td>
			<td><?php echo $npbDetail['item_id'];?></td>
			<td><?php echo $npbDetail['fulfillment_id'];?></td>
			<td><?php echo $npbDetail['qty'];?></td>
			<td><?php echo $npbDetail['qty_filled'];?></td>
			<td><?php echo $npbDetail['price'];?></td>
			<td><?php echo $npbDetail['price_cur'];?></td>
			<td><?php echo $npbDetail['amount'];?></td>
			<td><?php echo $npbDetail['amount_cur'];?></td>
			<td><?php echo $npbDetail['currency_id'];?></td>
			<td><?php echo $npbDetail['rp_rate'];?></td>
			<td><?php echo $npbDetail['descr'];?></td>
			<td><?php echo $npbDetail['discount'];?></td>
			<td><?php echo $npbDetail['discount_cur'];?></td>
			<td><?php echo $npbDetail['amount_net'];?></td>
			<td><?php echo $npbDetail['amount_net_cur'];?></td>
			<td><?php echo $npbDetail['date_finish'];?></td>
			<td><?php echo $npbDetail['qty_unfilled'];?></td>
			<td><?php echo $npbDetail['unit_id'];?></td>
			<td><?php echo $npbDetail['outlog_id'];?></td>
			<td><?php echo $npbDetail['npb_detai_id'];?></td>
			<td><?php echo $npbDetail['is_movement'];?></td>
			<td><?php echo $npbDetail['process_type_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'npb_details', 'action' => 'view', $npbDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'npb_details', 'action' => 'edit', $npbDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'npb_details', 'action' => 'delete', $npbDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Npb Detail', true), array('controller' => 'npb_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
