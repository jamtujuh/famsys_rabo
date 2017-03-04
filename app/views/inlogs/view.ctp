<?php
$group_id = $this->Session->read('Security.permissions');
?>

<?php $can_edit = $this->Session->read('Inlog.can_edit') ?>
<div class="inlogs view">
<h2><?php  __('Inlog');?></h2>
	  
		<?php if($this->Session->read('Inlog.can_process') && $inlog['Inlog']['ledger'] != 0) :?>
		<div class="error-message">
		<?php echo 'WARNING : Cant do ledger waiting for payment' ;?>            
		</div>
		<?php endif;?>
	  
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $inlog['Inlog']['date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inlog['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $inlog['Supplier']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($inlog['Po']['no'], array('controller' => 'pos', 'action' => 'view', $inlog['Po']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inlog Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['InlogStatus']['name']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created At'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['created_at']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['created_by']; ?>
			&nbsp;
		</dd>
		<?php if(!empty($inlog['Inlog']['approved_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['approved_by']; ?>
			&nbsp;
		</dd>
		<?php endif ;?>
		<?php if(!empty($inlog['Inlog']['approved_date'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['approved_date']; ?>
			&nbsp;
		</dd>
		<?php endif ;?>
		<?php if(!empty($inlog['Inlog']['cancel_by'])) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['cancel_by']; ?>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Note'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['cancel_notes']; ?>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $inlog['Inlog']['cancel_date']; ?>
			&nbsp;
		<?php endif ;?>
		</dd>
	</dl>
	<div class="doc_actions">
	<ul>
		
		
		<?php if($this->Session->read('Inlog.can_send_to_stock_management')==true) :?>
			<li><?php echo $this->Html->link(__('Send to Stock Management', true), array('controller'=>'inlogs','action'=>'update_status/'.$inlog['Inlog']['id'].'/'.status_inlog_sent_to_stock_management_id)); ?> </li>
		<?php endif;?>
		
		<?php if($this->Session->read('Inlog.can_request_approval')==true) :?>
			<li><?php echo $this->Html->link(__('Send for Approval', true), array('controller'=>'inlogs','action'=>'update_status/'.$inlog['Inlog']['id'].'/'.status_inlog_sent_to_supervisor_id)); ?> </li>
		<?php endif;?>		
		
		<?php if($this->Session->read('Inlog.can_approve')==true) {?>
			<?php if($inlog['Inlog']['created_by'] != $this->Session->read('Userinfo.username')){?>
				<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'inlogs','action'=>'update_status/'.$inlog['Inlog']['id'].'/'.status_inlog_approved_id)); ?> </li>
			<?php };?>			
			<!--li><?php echo $this->Html->link(__('Cancel', true), array('controller'=>'inlogs','action'=>'cancel', $inlog['Inlog']['id'])); ?> </li-->
			<!--li><?php echo $this->Html->link(__('Reject', true), array('controller'=>'inlogs','action'=>'update_status/'.$inlog['Inlog']['id'].'/'.status_inlog_reject_id)); ?> </li-->
		<?php };?>
		
		<?php if($this->Session->read('Inlog.can_process') && $inlog['Inlog']['ledger'] == 0) :?>
			<!--li><!--?php echo $this->Html->link(__('Process Stock Ledger', true), array('controller'=>'inventory_ledgers','action'=>'process_inv', 'inlog', $inlog['Inlog']['id'])); ?--> </li-->
		<?php endif;?>
		
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
		<?php }else{?>
			<li><?php echo $this->Html->link(__('Back', true), array('controller'=>'inlogs','action'=>'index')); ?> </li>
		<?php };?>		
	
	</ul>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Inlogs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Inlog Details');?></h3>
	<?php if (!empty($inlog['InlogDetail'])):?>
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
		<?php if($can_edit) :?>
		<th class="actions"><?php __('Actions');?></th>
		<?php endif ; ?>
	</tr>
	<?php
		$i = 0;
		$total=0;
		foreach ($inlog['InlogDetail'] as $inlogDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<?php list($asset_category_id, $code, $unit_id) = explode ('|', $inlogDetail['item_detail'])?>
		
			<td><?php echo $i;?></td>
			<td><?php echo $assetCategories[$asset_category_id];?></td>
			<td><?php echo $code;?></td>
			<td><?php echo $items[$inlogDetail['item_id']];?></td>
			<td class="center"><?php echo $this->Number->format($inlogDetail['qty']);?></td>
			<td><?php echo $units[$unit_id];?></td>
			<td class="number"><?php echo $this->Number->format($inlogDetail['price'], 2);?></td>
			<td class="number"><?php echo $this->Number->format($inlogDetail['amount'], 2);?></td>
				<?php if($can_edit) :?>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'inlog_details', 'action' => 'edit', $inlogDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'inlog_details', 'action' => 'delete', $inlogDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $inlogDetail['id'])); ?>
			</td>
				<?php endif ; ?>
		</tr>
		<?php $total	+=$inlogDetail['amount'] ?>
	<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="7" class="number"><?php __("Total") ?></td>
		<td class="number" style="border-top:1px solid black">
			<?php echo $this->Number->format($total, 2);?>
		</td>
		<td style="border-top:1px solid black" colspan="1">&nbsp;</td>
	</tr>
	</table>
<?php endif; ?>

	<!--div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inlog Detail', true), array('controller' => 'inlog_details', 'action' => 'add'));?> </li>
		</ul>
	</div-->
</div>
