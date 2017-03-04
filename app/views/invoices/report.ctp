<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('Invoice', array('action'=>'report/'.$type)) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Invoice Report ' . ucwords($type))?></legend>	
	<fieldset class="subfilter" style="width:50%">
	<legend><?php __('Invoice Info')?></legend>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>	
	</fieldset>	
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>	
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('action' => 'add')); ?></li>
	</ul>
</div>
</div>

<div class="related">
	<h2><?php __('Invoices');?></h2>
	
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('inv_date');?></th>
		<th><?php echo $this->Paginator->sort('request_type');?></th>
		<th><?php echo $this->Paginator->sort('supplier_id');?></th>
		<th><?php echo $this->Paginator->sort(__('Total (Rp)'),'total');?></th>
		<th><?php echo $this->Paginator->sort('paid_date');?></th>
		<th><?php echo $this->Paginator->sort('bank_account_no');?></th>
		<th><?php echo $this->Paginator->sort('bank_account_type_id');?></th>
		<th><?php echo $this->Paginator->sort('status_invoce_id');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$group_id	=$this->Session->read('Security.permissions');
	foreach ($invoices as $invoice):
		$status_invoice_id 	= $invoice['Invoice']['status_invoice_id'];	
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $invoice['RequestType']['name']; ?></td>
		<td class="left">
			<?php echo $this->Html->link($invoice['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $invoice['Supplier']['id'])); ?>
		</td>
		<!--td><?php echo $invoice['Invoice']['description']; ?>&nbsp;</td-->
		<td class="number"><?php echo $this->Number->format($invoice['Invoice']['total']); ?>&nbsp;</td>
		<td class="left"><?php echo $invoice['Invoice']['paid_date']?$this->Time->format(DATE_FORMAT, $invoice['Invoice']['paid_date']):''; ?>&nbsp;</td>
		<td class="left"><?php echo $invoice['Invoice']['bank_account_id']?$supplierBankAccounts[$invoice['Invoice']['bank_account_id']]:''; ?>&nbsp;</td>
		<td class="left"><?php echo empty($invoice['Invoice']['paid_bank_account_type_id'])?'':$bankAccountTypes[$invoice['Invoice']['paid_bank_account_type_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $invoice['InvoiceStatus']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $invoice['Invoice']['id'])); ?>
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
