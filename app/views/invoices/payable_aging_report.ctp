<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
	<div id="filter">
		<div class="fieldfilter">
			<?php echo $this->Form->create('Invoice', array('action'=>'payable_aging_report')) ?>
			<fieldset>
				<legend><?php __('Invoice Filters')?></legend>
				<fieldset class="subfilter" style="width:30%">
					<legend><?php __('Invoice Info')?></legend>
					<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$this->Session->read('Invoice.supplier_id'))) ?>
					<?php echo $this->Form->input('currency_id',array('options'=>$currencies,'empty'=>'all','value'=>$this->Session->read('Invoice.currency_id'))) ?>
					<?php echo $this->Form->input('no', array('value'=>$this->Session->read('Invoice.no'))); ?>
				</fieldset>
				<fieldset class="subfilter" style="width:36%">
					<legend><?php __('Date Filter')?></legend>
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
				<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
			</ul>
		</div>
	</div>

	<div class="related">
		<h2><?php __('Invoices');?></h2>
		
		<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('no_inv');?></th>
			<th><?php echo $this->Paginator->sort('request_type');?></th>
			<th><?php echo $this->Paginator->sort('curr');?></th>
			<th><?php echo $this->Paginator->sort(__("Total (Rp)"),'total');?></th>
			<th><?php echo $this->Paginator->sort('due date');?></th>
			<th><?php echo $this->Paginator->sort('status_invoce_id');?></th>
			<th><?php echo $this->Paginator->sort('po');?></th>
			<th><?php echo $this->Paginator->sort('no_inlog');?></th>
			<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
			$i = 0;
			$group_id			=$this->Session->read('Security.permissions');
			foreach ($invoices as $invoice):
				$status_invoice_id 	= $invoice['Invoice']['status_invoice_id'];	
				$class = null;
				$can_edit = ($group_id==gs_group_id && $status_invoice_id==status_invoice_new_id) ;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $i; ?>&nbsp;</td>
			<td class="left">
				<?php echo $invoice['Supplier']['name']; ?>
			</td>
			<td class="left">
				<?php echo $this->Html->link(__($invoice['Invoice']['no'], true), array('controller' => 'invoices', 'action' => 'view', $invoice['Invoice']['id']));?>
			&nbsp;</td>
			<td class="left"><?php echo $invoice['RequestType']['name']; ?>&nbsp;</td>
			<td class="right"><?php echo $invoice['Currency']['name']; ?>&nbsp;</td>
			<td class="number"><?php echo $this->Number->format($invoice['Invoice']['total']); ?>&nbsp;</td>
			<td class="left">
			<?php if(!empty($invoice['InvoicePayment'][0]['date_due'])){
				echo $this->Time->format(DATE_FORMAT, $invoice['InvoicePayment'][0]['date_due']);
			}else{
				echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['paid_date']);
			}?>
			<td class="left"><?php echo $invoice['InvoiceStatus']['name']; ?>&nbsp;</td>
			<td class="left">
			<?php
				foreach($invoice['Po'] as $po):
					echo $this->Html->link(__($po['no'], true), array('controller' => 'pos', 'action' => 'view', $po['id']));
				endforeach;				
			?>
			</td>
			<td class="left">
				<?php 
					foreach($inlogs as $inl):
						if($invoice['Invoice']['id'] == $inl[0]['inl_id']){
							echo $this->Html->link(__($inl[0]['inl_no'], true), array('controller'=>'inlogs', 'action' => 'view', $inl[0]['inl_id']));
						}
					endforeach;
				?>
			&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', $invoice['Invoice']['id'])); ?>
				
				<?php if ($can_edit) : ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $invoice['Invoice']['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $invoice['Invoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoice['Invoice']['id'])); ?>
				<?php endif ?>
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
</div>
