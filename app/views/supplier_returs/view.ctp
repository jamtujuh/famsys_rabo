<?php
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);

$can_process			= $this->Session->read('SupplierRetur.can_process');
$can_journal			= $this->Session->read('SupplierRetur.can_journal');
$can_approve			= $this->Session->read('SupplierRetur.can_approve');
$can_edit				= $this->Session->read('SupplierRetur.can_edit');
$can_request_approval	= $this->Session->read('SupplierRetur.can_request_approval' );
$can_print_retur_notes	= $this->Session->read('SupplierRetur.can_print_retur_notes' );
$can_reprint_retur_notes= $this->Session->read('SupplierRetur.can_reprint_retur_notes' );
$total=0;
?>
<div class="supplier_returs view">
	<h2><?php  __('Supplier Retur');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $supplier_retur['SupplierRetur']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['Supplier']['name']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($supplier_retur['Retur']['no'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Retur No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['Retur']['no']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['CostCenter']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Retur Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierReturStatus']['name']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Retur Notes Printed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($supplier_retur['SupplierRetur']['is_printed'].'.gif'); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['created_by']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($supplier_retur['SupplierRetur']['approved_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['approved_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($supplier_retur['SupplierRetur']['cancel_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($supplier_retur['SupplierRetur']['reject_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_retur['SupplierRetur']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>

	</dl>
	<div class="doc_actions">
		<ul>

			<?php if($can_request_approval) : ?>
			<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'supplier_returs','action'=>'update_status/'. $this->Session->read('SupplierRetur.id') . '/' . status_supplier_retur_sent_to_supervisor_id)); ?> </li>
			<?php endif; ?>

			<?php if($can_approve) : ?>
			<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'supplier_returs','action'=>'update_status/'. $this->Session->read('SupplierRetur.id') . '/' . status_supplier_retur_approved_id)); ?> </li>
			<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'supplier_returs','action'=>'update_status/'. $this->Session->read('SupplierRetur.id') . '/' . status_supplier_retur_draft_id)); ?> </li>
			<li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'supplier_returs','action'=>'update_status/'. $this->Session->read('SupplierRetur.id') . '/' . status_supplier_retur_reject_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_reject_id) : ?>
			<li><?php echo $this->Html->link(__('Archive', true), array('controller'=>'supplier_returs','action'=>'update_status/'. $this->Session->read('SupplierRetur.id') . '/' . status_supplier_retur_archive_id)); ?> </li>
			<?php endif; ?>
		
			<?php if($can_process) : ?>
			<li><?php echo $this->Html->link(__('Process Stock Ledger', true), array('controller'=>'inventory_ledgers','action'=>'process_inv', 'supplierRetur', $supplier_retur['SupplierRetur']['id'])); ?> </li>
			<?php endif; ?>
			
			<?php if($can_journal) : ?>
			<li><?php echo $this->Html->link(__('Journal Posting', true), array('controller'=>'journal_transactions','action'=>'prepare_posting','supplier_retur',journal_group_supplier_retur_id, $supplier_retur['SupplierRetur']['id'])); ?> </li>
			<?php endif; ?>		
			
			<?php if($can_print_retur_notes) : ?>
			<li><?php echo $this->Html->link(__('Print Supplier Retur Notes', true), array('controller'=>'supplier_returs','action'=>'supplier_retur_notes', $this->Session->read('SupplierRetur.id'))); ?> </li>
			<?php endif; ?>
			
			<?php if($can_reprint_retur_notes) : ?>
			<li><?php echo $this->Html->link(__('Re-Print Supplier Retur Notes', true), array('controller'=>'supplier_returs','action'=>'supplier_retur_notes', $this->Session->read('SupplierRetur.id'), 1)); ?> </li>
			<?php endif; ?>		
			
			<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'supplier_returs','action'=>'index')); ?> </li>
			
		</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('Delete Supplier Retur', true), array('action' => 'delete', $supplier_retur['SupplierRetur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier_retur['SupplierRetur']['id'])); ?> </li>
		<?php endif;?>
		<li><?php echo $this->Html->link(__('List Supplier Returs', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Supplier Retur Details');?></h3>
	<?php echo $this->Form->create('SupplierReturDetail', array('action'=>'ajax_add'));?>	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Category'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Descr'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th><?php __('Unit Price'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php if (!empty($supplier_retur['SupplierReturDetail'])):?>
	<?php
		$i = 0;

		foreach ($supplier_retur['SupplierReturDetail'] as $supplier_returDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>			
			<td><?php echo $i;?></td>
			<td><?php echo $supplier_returDetail['Item']['AssetCategory']['name'];?></td>
			<td>
			<?php echo $supplier_returDetail['Item']['code'];?> -
			<?php echo $supplier_returDetail['Item']['name'];?>
			</td>
			<td><?php echo $this->Number->format($supplier_returDetail['qty']);?></td>
			<td><?php echo $supplier_returDetail['descr'];?></td>
			<td><?php echo $supplier_returDetail['Item']['Unit']['name'];?></td>
			<td class="number"><?php echo $this->Number->format($supplier_returDetail['price'],2);?></td>
			<td class="number"><?php echo $this->Number->format($supplier_returDetail['amount'],2);?></td>
			<td class="actions">
			<?php if($can_edit && $retur == null) : ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'supplier_retur_details', 'action' => 'delete', $supplier_returDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier_returDetail['id'])); ?>
			<?php endif;?>
			</td>
		</tr>
		<?php $total	+=$supplier_returDetail['amount'] ?>
		<?php endforeach; ?>

	<?php endif;?>	

		
	<?php if($this->Session->read('SupplierRetur.can_edit') && $retur == null) :?>
	<tr id="newRecord">
		<td></td>
		<td></td>
		<td>
		<?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('Item.name'); ?>
		<div id="item_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo request_type_stock_id?>', {afterUpdateElement : setSupplierReturItemValues});
			//]]>
		</script>
		</td>
		<td><?php echo $this->Form->input('qty', array('style'=>'width:50px')); ?></td>
		<td><?php echo $this->Form->input('descr'); ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="actions">
			<?php echo $this->Form->input('supplier_retur_id', array('value'=>$this->Session->read('SupplierRetur.id'),'type'=>'hidden')); ?>
			<?php echo $this->Form->input('price', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $this->Form->input('price_cur', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $ajax->submit('Add', 
			array('url'=> array('controller'=>'supplier_retur_details', 'action'=>'ajax_add'), 
			'indicator'	=> 'LoadingDiv',
			'complete' => 'appendSupplierReturDetail(request)')); ?>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="7" class="number"><?php __("Total") ?></td>
		<td class="number" style="border-top:1px solid black">
			<?php 
				echo $this->Number->format($total,2);
			?>
		</td>
		<td style="border-top:1px solid black" colspan="1">&nbsp;</td>
	</tr>	
	<?php echo $this->Form->end(); ?>
	</table>
</div>
