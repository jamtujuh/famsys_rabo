<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false); 
$can_edit = false;
?>
<div class="invoices view">
<h2><?php  __('Invoice');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['id']; ?>
			&nbsp;
		</dd>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($invoice['Department']['name'], array('controller' => 'departments', 'action' => 'view', $invoice['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total (Rp)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<div id="InvoiceTotalDiv"><?php echo $this->Number->format($invoice['Invoice']['total']); ?></div>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['InvoiceStatus']['name']; ?>
			&nbsp;
		</dd>			
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paid Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $invoice['Invoice']['paid_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Bank Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['paid_bank_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Bank Account Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['paid_bank_account_type_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Bank Account No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $invoice['Invoice']['paid_bank_account_no']; ?>
			&nbsp;
		</dd>
	</dl>
	<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'index')); ?> </li>
	</ul>
	</div>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('Edit Invoice', true), array('action' => 'edit', $invoice['Invoice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Invoice', true), array('action' => 'delete', $invoice['Invoice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoice['Invoice']['id'])); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('List Invoices', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Asset Categories', true), array('controller' => 'asset_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset Category', true), array('controller' => 'asset_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('New Invoice Detail', true), array('controller' => 'invoice_details', 'action' => 'add')); ?> </li>
		<?php endif; ?>
	</ul>
</div>




<div class="related">
	<h3><?php __('Journal Details');?></h3>
	<?php if (!empty($journalLines)) : ?>
	
	<?php echo $this->Form->create('JournalTransaction', array('action'=>'posting_invoice')) ?> 
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Date'); ?></th>
		<th><?php __('Account'); ?></th>
		<th><?php __('Journal Position'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Amount Db'); ?></th>
		<th><?php __('Amount Cr'); ?></th>
		<th><?php __('Account Code'); ?></th>
		<th><?php __('Journal Template Id'); ?></th>
	</tr>
	<?php foreach ($journalLines as $i=>$journalLine) : 	
	?>
	<tr>
		<td class="left">
			<?php echo $this->Form->input('date',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][date]','value'=>$journalLine['date']))?>
			<?php echo $journalLine['date'];?>
		</td>
		<td>
			<?php echo $this->Form->input('account_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][account_id]','value'=>$journalLine['account_id'])) ?>
			<?php echo $journalLine['account_name'];?>
		</td>	
		<td>
			<?php echo $this->Form->input('journal_position_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][journal_position_id]','value'=>$journalLine['journal_position_id'])) ?>
			<?php echo $journalLine['journal_position_name'];?>
		</td>	
		<td>
			<?php echo $this->Form->input('department_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][department_id]','value'=>$journalLine['department_id'])) ?>
			<?php echo $invoice['Department']['name']?>
		</td>
		<td class="number">
			<?php echo $this->Form->input('amount_db',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][amount_db]','value'=>$journalLine['amount_db']?$journalLine['amount_db']:0)) ?>
			<?php echo $this->Number->format($journalLine['amount_db']) ?>
		</td>			
		<td class="number">
			<?php echo $this->Form->input('amount_cr',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][amount_cr]','value'=>$journalLine['amount_cr']?$journalLine['amount_cr']:0)) ?>
			<?php echo $this->Number->format($journalLine['amount_cr']) ?>
		</td>			
		<td>
			<?php echo $this->Form->input('account_code',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][account_code]','value'=>$journalLine['account_code'])) ?>
			<?php echo $journalLine['account_code'] ?>
		</td>			
		<td>
			<?php echo $this->Form->input('journal_template_detail_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][journal_template_id]','value'=>$journalLine['journal_template_detail_id'])) ?>
			<?php echo $this->Form->input('journal_template_id',array('type'=>'hidden','name'=>'data['.$i.'][JournalTransaction][journal_template_id]','value'=>$journalLine['journal_template_id'])) ?>
			<?php echo $journalTemplates[$journalLine['journal_template_id']] ?>
		</td>	
	</tr>
	<?php endforeach; ?>
	
	</table>
	
	<?php echo $this->Form->end('Confirm Journal Posting') ?>
	<?php else: ?>
	<p><?php __('Error: cannot file journal lines. Make sure you have configured Journal Template for every Asset Categories') ?></p>
	<?php endif; ?>
	
</div>







<div class="related">
	<h3><?php __('Invoice Item Details');?></h3>
	<?php if (!empty($invoice['InvoiceDetail'])):?>
	<?php if($can_edit) : ?>
	<?php
	echo $ajax->form(
		array('type' => 'post',
		'options' => array(
			'model'=>'Invoice',
			'loading'=>'Element.show(\'LoadingDiv\')',
			'complete'=>'setTotals(request,\'Invoice\');Element.hide(\'LoadingDiv\')',
			'url' => array(
				'controller' => 'invoices',
				'action' => 'update_ajax',
				$invoice['Invoice']['id']
			)
		)
	));	
	?>		
	<?php endif ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Id Asset Category'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Currency'); ?></th>
		<th><?php __('Price Cur'); ?></th>
		<th><?php __('Amount Cur'); ?></th>
		<th><?php __('Price (Rp)'); ?></th>
		<th><?php __('Amount (Rp)'); ?></th>
		<th><?php __('Is Vat'); ?></th>
		<th><?php __('Is Wht'); ?></th>
		<th><?php __('Ref. NPB'); ?></th>
		<th><?php __('Ref. PO'); ?></th>
		<?php if($can_edit) :?>
		<th class="actions"><?php __('Actions');?></th>
		<?php endif; ?>
	</tr>
	<?php
		$i = 0;
	
		foreach ($invoice['InvoiceDetail'] as $invoiceDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $invoiceDetail['id'];?></td>
			<td><?php echo $invoiceDetail['asset_category_id'];?></td>
			<td><?php echo $invoiceDetail['name'];?><br>
			<?php echo $invoiceDetail['color'];?><br>
			<?php echo $invoiceDetail['brand'];?><br>
			<?php echo $invoiceDetail['type'];?>
			</td>
			<td class="center"><?php echo $invoiceDetail['qty'];?></td>
			<td class="center"><?php echo $invoiceDetail['currency_name'];?></td>
			<td class="number"><?php echo $this->Number->format($invoiceDetail['price_cur']);?></td>
			<td class="number"><?php echo $this->Number->format($invoiceDetail['amount_cur']);?></td>
			<td class="number"><?php echo $this->Number->format($invoiceDetail['price']);?></td>
			<td class="number"><?php echo $this->Number->format($invoiceDetail['amount']);?></td>
			<td>
				<?php if($can_edit) :?>
					<?php echo $this->Html->image($invoiceDetail['is_vat'] . ".gif", 
						array(
							'url'=>array('controller' => 'invoice_details', 'action' => 'set_vat', $invoiceDetail['id'], $invoiceDetail['is_vat']==1?0:1)
					));?>
				<?php else :?>
					<?php echo $this->Html->image($invoiceDetail['is_vat'] . ".gif")?>
				<?php endif; ?>
			</td>
			<td>
				<?php if($can_edit) :?>
					<?php echo $this->Html->image($invoiceDetail['is_wht'] . ".gif", 
						array(
							'url'=>array('controller' => 'invoice_details', 'action' => 'set_wht', $invoiceDetail['id'], $invoiceDetail['is_wht']==1?0:1)
					));?>
				<?php else :?>
					<?php echo $this->Html->image($invoiceDetail['is_wht'] . ".gif")?>
				<?php endif; ?>
			</td>
			<td><?php echo $this->Html->link($invoiceDetail['npb_id'], array('controller' => 'npbs', 'action' => 'view',$invoiceDetail['npb_id']));?></td>
			<td><?php echo $this->Html->link($invoiceDetail['po_id'], array('controller' => 'pos', 'action' => 'view',$invoiceDetail['po_id']));?></td>
			<?php if($can_edit) :?>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'invoice_details', 'action' => 'view', $invoiceDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'invoice_details', 'action' => 'edit', $invoiceDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'invoice_details', 'action' => 'delete', $invoiceDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $invoiceDetail['id'])); ?>
			</td>
			<?php endif; ?>
		</tr>
	
	<?php endforeach; ?>

	<?php $span = 8 ?>

	<?php if($can_edit) :?>
	<?php $span_right = 5 ?>
	<?php else: ?>
	<?php $span_right = 4 ?>
	<?php endif; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="<?php echo $span?>" class="number"><?php __("Sub Total") ?></td>
		<td style="border-top:1px solid black" class="number">
		<?php if($can_edit) :?>
			<?php echo $this->Form->input('sub_total',
			array('readonly'=>true,
				'value'=>$this->Number->format($invoice['Invoice']['sub_total']),
				'class'=>'number',
				'label'=>false));?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['sub_total'])?>
		<?php endif;?>
		</td>
		<td style="border-top:1px solid black" colspan="<?php echo $span_right ?>">&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="<?php echo $span?>" class="number">(<?php __("Discount") ?>)</td>
		<td class="number">
		<?php if($can_edit) :?>
			<?php echo $this->Form->input('discount',
			array(
			'value'=>$this->Number->format($invoice['Invoice']['discount']),
			'class'=>'number',
			'label'=>false));?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['discount'])?>
		<?php endif;?>
		</td>
		<td colspan="<?php echo $span_right ?>">&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="<?php echo ($span-2)?>" class="number"><?php __("VAT") ?></td>
		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('vat_rate',
			array(
			'style'=>'width:60px','class'=>'number','label'=>false)
			);?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['vat_rate'])?>
		<?php endif;?>
		</td>

		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('vat_base',
			array('readonly'=>true,
			'value'=>$this->Number->format($invoice['Invoice']['vat_base']),
			'class'=>'number','label'=>false)
			);?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['vat_base'])?>
		<?php endif;?>
		</td>
		
		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('vat_total',
			array('readonly'=>true,'class'=>'number', 
			'value'=>$this->Number->format($invoice['Invoice']['vat_total'])));?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['vat_total'])?>
		<?php endif;?>
		</td>
		
		<td colspan="<?php echo $span_right ?>">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="<?php echo ($span-2)?>" class="number">(<?php __("WHT") ?>)</td>
		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('wht_rate',
			array('style'=>'width:60px',
			'class'=>'number','label'=>false)
			);?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['wht_rate'])?>
		<?php endif;?>
		</td>

		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('wht_base',
			array('readonly'=>true,
			'value'=>$this->Number->format($invoice['Invoice']['wht_base']),
			'class'=>'number','label'=>false)
			);?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['wht_base'])?>
		<?php endif;?>
		</td>
		
		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('wht_total',
			array('readonly'=>true,
			'value'=>$this->Number->format($invoice['Invoice']['wht_total']),
			'class'=>'number','label'=>false)
			);?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['wht_total'])?>
		<?php endif;?>		
		</td>
		<td colspan="<?php echo $span_right ?>">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="<?php echo $span?>" class="number"><?php __("Grand Total") ?></td>
		<td class="number">
		<?php if($can_edit) :?>		
			<?php echo $this->Form->input('total',
			array('readonly'=>true,
			'value'=>$this->Number->format($invoice['Invoice']['total']),
			'class'=>'number','label'=>false));?>
		<?php else :?>
			<?php echo $this->Number->format($invoice['Invoice']['total'])?>
		<?php endif;?>		
		</td>
		<td colspan="<?php echo $span_right ?>">&nbsp;</td>
	</tr>		
	</table>
	
	<?php if($can_edit) : ?>
	<?php echo $this->Form->end('Save Invoice')?>
	<div id="InvoiceUpdateDiv"></div>	
	<?php endif; ?>

<?php endif; ?>

	<div class="actions">
		<ul>
			<?php if($can_edit) : ?>
			<li><?php echo $this->Html->link(__('New Invoice Detail', true), array('controller' => 'invoice_details', 'action' => 'add'));?> </li>
			<?php endif; ?>
		</ul>
	</div>
</div>


<div class="related">
	<h3><?php __('Related POs');?></h3>
	<?php if (!empty($invoice['Po'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('No'); ?></th>
		<th><?php __('Po Date'); ?></th>
		<th><?php __('Delivery Date'); ?></th>
		<th><?php __('Supplier'); ?></th>
		<th><?php __('Department'); ?></th>
		<th><?php __('Total (Rp)'); ?></th>
		<th><?php __('PO Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>	
	<?php
		foreach ($invoice['Po'] as $po):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr>
		<td><?php echo $po['id'] ?></td>
		<td><?php echo $po['no'] ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $po['po_date']); ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $po['delivery_date']); ?></td>
		<td><?php echo $po['supplier_name'] ?></td>
		<td><?php echo $po['department_name'] ?></td>
		<td class="number"><?php echo $this->Number->format($po['total']) ?></td>
		<td><?php echo $po['status_name'] ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller' => 'pos', 'action' => 'view', $po['id'])); ?>
		</td>
	</tr>
	
	<?php endforeach;?>
	</table>
	<?php endif; ?>
</div>
