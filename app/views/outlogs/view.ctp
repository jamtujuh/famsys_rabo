<?php
$can_process=$this->Session->read('Outlog.can_process');
$can_print_delivery_notes=$this->Session->read('Outlog.can_print_delivery_notes');
$can_reprint_delivery_notes=$this->Session->read('Outlog.can_reprint_delivery_notes');
$can_request_approval=$this->Session->read('Outlog.can_request_approval');
$can_approve=$this->Session->read('Outlog.can_approve');
$can_journal=$this->Session->read('Outlog.can_journal');
$can_edit=$this->Session->read('Outlog.can_edit');
$group_id = $this->Session->read('Security.permissions');
?>
<div class="outlogs view">
<h2><?php  __('Delivery');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Outlog']['no']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($outlog['Npb']['id'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Npb'); ?> No</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($outlog['Npb']['no'], array('controller' => 'npbs', 'action' => 'view', $outlog['Npb']['id'])); ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<?php if(!empty($outlog['Retur']['id'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Retur'); ?> No</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($outlog['Retur']['no'], array('controller' => 'retur', 'action' => 'view', $outlog['Retur']['id'])); ?>
			&nbsp;
		</dd>
		<?php endif;?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $outlog['Outlog']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Department']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Business Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['BusinessType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cost Center'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['CostCenter']['name']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Outlog Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['OutlogStatus']['name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Outlog']['notes']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Delivery Notes Printed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($outlog['Outlog']['is_printed'].'.gif'); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Outlog']['created_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $outlog['Outlog']['created_at']; ?>
			&nbsp;
		</dd>		
		
		<?php if(!empty($outlog['Outlog']['approved_by'])) :?>
		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['approved_by']; ?>
				&nbsp;
			</dd>		
			<?php endif; ?>
			<?php if(!empty($outlog['Outlog']['approved_date'])) :?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['approved_date']; ?>
				&nbsp;
			</dd>		
			
		<?php endif; ?>
		
		<?php if(!empty($outlog['Outlog']['cancel_by'])) :?>
		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['cancel_by']; ?>
				&nbsp;
			</dd>		

			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel note'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['cancel_notes']; ?>
				&nbsp;
			</dd>		
			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['cancel_date']; ?>
				&nbsp;
			</dd>		
		
		<?php endif; ?>
		
		<?php if(!empty($outlog['Outlog']['reject_by'])) :?>
		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['reject_by']; ?>
				&nbsp;
			</dd>		

			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject note'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['reject_notes']; ?>
				&nbsp;
			</dd>		
			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $outlog['Outlog']['reject_date']; ?>
				&nbsp;
			</dd>				
		<?php endif; ?>
	</dl>
	<div class="doc_actions">
	<ul><?php if($can_request_approval) : ?>
		<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'outlogs','action'=>'update_status/'. $outlog['Outlog']['id'] .'/'. status_outlog_sent_to_supervisor_id)); ?> </li>
		<?php endif; ?>
		
		<?php if($can_approve) { ?>
			<?php if($outlog['Outlog']['created_by'] != $this->Session->read('Userinfo.username')){?>
				<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'outlogs','action'=>'update_status/'. $outlog['Outlog']['id'] .'/'. status_outlog_approved_id)); ?> </li>
				<li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'outlogs','action'=>'reject', $outlog['Outlog']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'outlogs','action'=>'cancel', $outlog['Outlog']['id'])); ?> </li>			
			<?php };?>
		<?php }; ?>		
		
		<!--?php if($can_process) : ?-->
		<!--li><!--?php echo $this->Html->link(__('Process Stock Ledger', true), array('controller'=>'inventory_ledgers','action'=>'process_inv', 'outlog', $outlog['Outlog']['id'] )); ?--> </li-->
		<!--?php endif; ?-->

		<?php if($can_journal) : ?>
			<li><?php echo $this->Html->link(__('Journal Posting', true), array('controller'=>'journal_transactions','action'=>'prepare_posting','outlog',journal_group_distribute_hq_branch_id, $outlog['Outlog']['id'])); ?> </li>
		<?php endif; ?>	
		
		<?php if($this->Session->read('Outlog.can_archive')) :?>
			<li><?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $outlog['Outlog']['id'])); ?> </li>
		<?php endif;?>
		
		<?php if($can_print_delivery_notes) : ?>
			<li><?php echo $this->Html->link(__('Print Delivery Notes', true), 
			array('controller'=>'outlogs','action'=>'delivery_notes', $outlog['Outlog']['id'] , 0),
			array('target'=>'_blank','onclick'=>'setTimeout("location.reload(true)", 2000);')); ?> 
			</li>
		<?php endif; ?>

		<?php if($can_reprint_delivery_notes) : ?>
			<li><?php echo $this->Html->link(__('Re-Print Delivery Notes', true), 
				array('controller'=>'outlogs','action'=>'delivery_notes', $outlog['Outlog']['id'] , 1),
				array('target'=>'_blank','onclick'=>'setTimeout("location.reload(true)", 2000);')); ?> 
			</li>
		<?php endif; ?>
		
		<?php if($group_id == housekeeper_group_id){?>
			<?php if($this->Session->read('HKConf.table_name') == 'npbs'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_npbs');
				}else if($this->Session->read('HKConf.table_name') == 'pos'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_pos');
				}else if($this->Session->read('HKConf.table_name') == 'delivery_orders'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_delivery_orders');
				}else if($this->Session->read('HKConf.table_name') == 'inlogs'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_inlogs');
				}else if($this->Session->read('HKConf.table_name') == 'outlogs'){
					$options	= array('controller'=>'house_keepings','action'=>'get_view_outlogs');
				}
			?>
			<li><?php echo $this->Html->link(__('Back', true), $options); ?> </li>

		<?php }else{;?>
			<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'outlogs','action'=>'index')); ?> </li>
		<?php };?>
	</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($can_edit) : ?>	
			<li><?php echo $this->Html->link(__('Edit Outlog', true), array('action' => 'edit', $outlog['Outlog']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Outlog', true), array('action' => 'delete', $outlog['Outlog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $outlog['Outlog']['id'])); ?> </li>
		<?php endif; ?>		
		<li><?php echo $this->Html->link(__('List Outlogs', true), array('action' => 'index')); ?> </li>
		<?php if($this->Session->read('Security.permission')==stock_management_group_id) : ?>	
			<li><?php echo $this->Html->link(__('New Outlog', true), array('action' => 'add')); ?> </li>
		<?php endif; ?>		
		
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Delivery Details');?></h3>
	<?php if (!empty($outlog['OutlogDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Category'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Item'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Unit'); ?></th>
		<th><?php __('Unit Price'); ?></th>
		<th><?php __('Amount'); ?></th>
	</tr>
	<?php
		$i = 0;
		$total=0;
		foreach ($outlog['OutlogDetail'] as $outlogDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
			<?php list($asset_category_id, $code, $unit_id) = explode ('|', $outlogDetail['item_detail'])?>
		<tr<?php echo $class;?>>
			
			<td><?php echo $i;?></td>
			<td><?php echo $assetCategories[$asset_category_id];?></td>
			<td><?php echo $code;?></td>
			<td><?php echo $outlogDetail['item_name'];?></td>
			<td><?php echo $this->Number->format($outlogDetail['qty']);?></td>
			<td><?php echo $units[$unit_id];?></td>
			<td class="number"><?php echo $this->Number->format($outlogDetail['price'], 2);?></td>
			<td class="number"><?php echo $this->Number->format($outlogDetail['amount'], 2);?></td>
		</tr>
		<?php $total	+=$outlogDetail['amount'] ?>
	<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="7" class="number"><?php __("Total") ?></td>
		<td class="number" style="border-top:1px solid black">
			<?php 
				echo $this->Number->format($total, 2);
			?>
		</td>
		<td style="border-top:1px solid black" colspan="1">&nbsp;</td>
	</tr>
	</table>
<?php endif; ?>
	<?php if($can_process) : ?>	
	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Outlog Detail', true), array('controller' => 'outlog_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
	<?php endif; ?>
	
</div>
