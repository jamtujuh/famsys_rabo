<div class="invoiceDetails index">
	<h2><?php __('Invoice Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('invoice_id');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($invoiceDetails as $invoiceDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $invoiceDetail['InvoiceDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($invoiceDetail['Invoice']['inv_date'], array('controller' => 'invoices', 'action' => 'view', $invoiceDetail['Invoice']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($invoiceDetail['AssetCategory']['name'], array('controller' => 'asset_categories', 'action' => 'view', $invoiceDetail['AssetCategory']['id'])); ?>
		</td>
		<td><?php echo $invoiceDetail['InvoiceDetail']['name']; ?>&nbsp;</td>
		<td><?php echo $invoiceDetail['InvoiceDetail']['color']; ?>&nbsp;</td>
		<td><?php echo $invoiceDetail['InvoiceDetail']['brand']; ?>&nbsp;</td>
		<td><?php echo $invoiceDetail['InvoiceDetail']['type']; ?>&nbsp;</td>
		<td><?php echo $invoiceDetail['InvoiceDetail']['qty']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $invoiceDetail['InvoiceDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $invoiceDetail['InvoiceDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $invoiceDetail['InvoiceDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoiceDetail['InvoiceDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Invoice Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>