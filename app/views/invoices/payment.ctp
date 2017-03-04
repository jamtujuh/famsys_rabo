<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit=false;
?>
<div class="invoices view">
<h2><?php  __('Invoice');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inv Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($invoice['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $invoice['Supplier']['id'])); ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['total']); ?></div>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['InvoiceStatus']['name']; ?>
			&nbsp;
		</dd>		
	</dl>
	<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Payment', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'index')); ?> </li>
	</ul>
	</div>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
	</ul>
</div>


<div class="related">
	<h2><?php __('Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('term_no');?></th>
		<th><?php echo $this->Paginator->sort('term_percent');?></th>
		<th><?php echo $this->Paginator->sort('date_due');?></th>
		<th><?php echo $this->Paginator->sort('date_paid');?></th>
		<th><?php echo $this->Paginator->sort('amount_due');?></th>
		<th><?php echo $this->Paginator->sort('amount_paid');?></th>
		<th><?php echo $this->Paginator->sort('amount_invoice');?></th>
		<th><?php echo $this->Paginator->sort('amount_po');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$total=0;
	foreach ($invoicePayments as $invoicePayment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$total+=$invoicePayment['InvoicePayment']['amount_paid'];
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td><?php echo $invoicePayment['InvoicePayment']['no']; ?>&nbsp;</td>
		<td><?php echo $invoicePayment['InvoicePayment']['term_no']; ?>&nbsp;</td>
		<td><?php echo $invoicePayment['InvoicePayment']['term_percent']; ?>&nbsp;</td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_due']); ?>&nbsp;</td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $invoicePayment['InvoicePayment']['date_paid']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_due']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_paid']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_invoice']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($invoicePayment['InvoicePayment']['amount_po']); ?>&nbsp;</td>
		<td><?php echo $invoicePayment['InvoicePayment']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $invoicePayment['InvoicePayment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $invoicePayment['InvoicePayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoicePayment['InvoicePayment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $invoicePayment['InvoicePayment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?php __('Total Paid') ?></td>
		<td class="number"><?php echo $this->Number->format($total)?>&nbsp;</td>
		<td colspan="5">&nbsp;</td>		
	</tr>
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


