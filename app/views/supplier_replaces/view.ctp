<?php
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);

$can_process			= $this->Session->read('SupplierReplace.can_process');
$can_journal			= $this->Session->read('SupplierReplace.can_journal');
$can_approve			= $this->Session->read('SupplierReplace.can_approve');
$can_edit				= $this->Session->read('SupplierReplace.can_edit');
$can_request_approval	= $this->Session->read('SupplierReplace.can_request_approval' );
$can_print_replace_notes	= $this->Session->read('SupplierReplace.can_print_replace_notes' );
$can_reprint_replace_notes= $this->Session->read('SupplierReplace.can_reprint_replace_notes' );
$total=0;
?>
<div class="supplier_replaces view">
	<h2><?php  __('Supplier Replace');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $supplier_replace['SupplierReplace']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['Supplier']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Retur No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierRetur']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['CostCenter']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Replace Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplaceStatus']['name']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier Replace Notes Printed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($supplier_replace['SupplierReplace']['is_printed'].'.gif'); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['created_by']; ?>
			&nbsp;
		</dd>
				<?php if(!empty($supplier_replace['SupplierReplace']['approved_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['approved_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($supplier_replace['SupplierReplace']['cancel_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['cancel_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['cancel_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($supplier_replace['SupplierReplace']['reject_by'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['reject_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $supplier_replace['SupplierReplace']['reject_date']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
	</dl>
	<div class="doc_actions">
		<ul>

			<?php if($can_request_approval) : ?>
			<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'supplier_replaces','action'=>'update_status/'. $this->Session->read('SupplierReplace.id') . '/' . status_supplier_replace_sent_to_supervisor_id)); ?> </li>
			<?php endif; ?>

			<?php if($can_approve) : ?>
			<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'supplier_replaces','action'=>'update_status/'. $this->Session->read('SupplierReplace.id') . '/' . status_supplier_replace_approved_id)); ?> </li>
			<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'supplier_replaces','action'=>'update_status/'. $this->Session->read('SupplierReplace.id') . '/' . status_supplier_replace_draft_id)); ?> </li>
			<li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'supplier_replaces','action'=>'update_status/'. $this->Session->read('SupplierReplace.id') . '/' . status_supplier_replace_reject_id)); ?> </li>
			<?php endif; ?>
			
			<?php if($supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_reject_id) : ?>
			<li><?php echo $this->Html->link(__('Archive', true), array('controller'=>'supplier_replaces','action'=>'update_status/'. $this->Session->read('SupplierReplace.id') . '/' . status_supplier_replace_archive_id)); ?> </li>
			<?php endif; ?>
		
			<?php if($can_process) : ?>
			<li><?php //echo $this->Html->link(__('Process Stock Ledger', true), array('controller'=>'inventory_ledgers','action'=>'process_inv', 'supplierReplace', $supplier_replace['SupplierReplace']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Process Sent to Branch', true), array('controller'=>'inventory_ledgers','action'=>'process_inv', 'supplierReplace', $supplier_replace['SupplierReplace']['id'])); ?> </li>
			<?php endif; ?>
			
			<?php if($can_journal) : ?>
			<li><?php //echo $this->Html->link(__('Journal Posting', true), array('controller'=>'journal_transactions','action'=>'prepare_posting','supplier_replace',journal_group_supplier_replace_id, $supplier_replace['SupplierReplace']['id'])); ?> </li>
			<?php endif; ?>		
			
			<?php if($can_process) : ?>
			<li><?php echo $this->Html->link(__('Print Supplier Replace Notes', true), array('controller'=>'supplier_replaces','action'=>'supplier_replace_notes', $supplier_replace['SupplierReplace']['id'])); ?> </li>
			<?php endif; ?>
			
			<?php if($can_reprint_replace_notes) : ?>
			<li><?php echo $this->Html->link(__('Re-Print Supplier Replace Notes', true), array('controller'=>'supplier_replaces','action'=>'supplier_replace_notes', $this->Session->read('SupplierReplace.id'), 1)); ?> </li>
			<?php endif; ?>		
			
			<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'supplier_replaces','action'=>'index')); ?> </li>
			
		</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>
		<li><?php echo $this->Html->link(__('Edit Supplier Replace', true), array('action' => 'edit', $supplier_replace['SupplierReplace']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Supplier Replace', true), array('action' => 'delete', $supplier_replace['SupplierReplace']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier_replace['SupplierReplace']['id'])); ?> </li>
		<?php endif;?>
		<li><?php echo $this->Html->link(__('List Supplier Replaces', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Supplier Replace Details');?></h3>
	<?php echo $this->Form->create('SupplierReplaceDetail', array('action'=>'ajax_add'));?>	
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
			<?php if($can_edit) : ?>
		<th class="actions"><?php __('Actions');?></th>
			<?php endif;?>
	</tr>
	<?php if (!empty($supplier_replace['SupplierReplaceDetail'])):?>
	<?php
		$i = 0;

		foreach ($supplier_replace['SupplierReplaceDetail'] as $supplierReturDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>			
			<td><?php echo $i;?></td>
			<td><?php echo $supplierReturDetail['Item']['AssetCategory']['name'];?></td>
			<td>
			<?php echo $supplierReturDetail['Item']['code'];?> -
			<?php echo $supplierReturDetail['Item']['name'];?>
			</td>
			<td><?php echo $this->Number->format($supplierReturDetail['qty']);?></td>
			<td><?php echo $supplierReturDetail['descr'];?></td>
			<td><?php echo $supplierReturDetail['Item']['Unit']['name'];?></td>
			<td class="number"><?php echo $this->Number->format($supplierReturDetail['price'],2);?></td>
			<td class="number"><?php echo $this->Number->format($supplierReturDetail['amount'],2);?></td>
			<td class="actions">
			<?php //if($can_edit) : ?>
				<?php //echo $this->Html->link(__('Delete', true), array('controller' => 'supplier_replace_details', 'action' => 'delete', $supplierReturDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplierReturDetail['id'])); ?>
			<?php //endif;?>
			</td>
		</tr>
		<?php $total	+=$supplierReturDetail['amount'] ?>
		<?php endforeach; ?>

	<?php endif;?>	

		
	<?php if($this->Session->read('SupplierReplace.can_edit')) :?>
	<!--tr id="newRecord">
		<td></td>
		<td></td>
		<td>
		<?php echo $this->Form->input('item_id', array('type'=>'hidden') ); ?>
		<?php echo $this->Form->input('Item.name'); ?>
		<div id="item_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo request_type_stock_id?>', {afterUpdateElement : setSupplierReplaceItemValues});
			//]]>
		</script>
		</td>
		<td><?php echo $this->Form->input('qty', array('style'=>'width:50px')); ?></td>
		<td><?php echo $this->Form->input('descr'); ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="actions">
			<?php echo $this->Form->input('supplier_replace_id', array('value'=>$this->Session->read('SupplierReplace.id'),'type'=>'hidden')); ?>
			<?php echo $this->Form->input('price', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $this->Form->input('price_cur', array('type'=>'hidden', 'value'=>0)); ?>
			<?php echo $ajax->submit('Add', 
			array('url'=> array('controller'=>'supplier_replace_details', 'action'=>'ajax_add'), 
			'indicator'	=> 'LoadingDiv',
			'complete' => 'appendSupplierReplaceDetail(request)')); ?>
		</td>
	</tr-->
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
	</table>
	<?php echo $this->Form->end(); ?>
</div>
