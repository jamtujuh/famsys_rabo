<?php
// echo $javascript->link('prototype',false);
// echo $javascript->link('scriptaculous',false); 
//echo $javascript->link('my_script',false); 
$group_id = $this->Session->read('Security.permissions');
echo $javascript->link('my_detail_add',false);
$can_edit		= $this->Session->read('DeliveryOrder.can_edit');
$can_approve	= $this->Session->read('DeliveryOrder.can_approve');
$can_register_fa	= $this->Session->read('DeliveryOrder.can_register_fa');
$can_register_stock	= $this->Session->read('DeliveryOrder.can_register_stock');
$recalcFunction = $ajax->remoteFunction( 
    array(
        'url' => array( 'controller' => 'delivery_orders', 'action' => 'ajax_view', $deliveryOrder['DeliveryOrder']['id'] ),
		'indicator'=>'LoadingDiv',
		'complete'=>'recalcDeliveryOrder(request)'
    ) 
);
?>
<div class="deliveryOrders view">
<h2><?php  __('Delivery Order');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Po'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($deliveryOrder['Po']['no'], array('controller' => 'pos', 'action' => 'view', $deliveryOrder['Po']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrder['DeliveryOrder']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('DO Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $deliveryOrder['DeliveryOrder']['do_date']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Request Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrder['RequestType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supplier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrder['Supplier']['name']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Delivery Order Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrder['DeliveryOrderStatus']['name']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrder['DeliveryOrder']['description']; ?>
			&nbsp;
		</dd>
		
		<?php if($deliveryOrder['DeliveryOrder']['approved_by']) :?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $deliveryOrder['DeliveryOrder']['approved_by']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $deliveryOrder['DeliveryOrder']['approved_date']; ?>
				&nbsp;
			</dd>
		<?php endif;?>
		
		<?php if($deliveryOrder['DeliveryOrder']['cancel_by']) :?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel By'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $deliveryOrder['DeliveryOrder']['cancel_by']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Date'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $deliveryOrder['DeliveryOrder']['cancel_date']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Note'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<pre><?php echo $deliveryOrder['DeliveryOrder']['cancel_note']; ?></pre>
				&nbsp;
			</dd>
		<?php endif;?>

	</dl>

	<div class="doc_actions">
		<ul>
		
			<?php if($can_edit): ?>
				<li><?php echo $this->Html->link(__('Request Approval', true), array('controller'=>'delivery_orders','action' => 'update_status', $deliveryOrder['DeliveryOrder']['id'], status_delivery_order_sent_to_supervisor_id)); ?> </li>
			<?php endif;?>
			
			<?php if($can_approve): ?>
				<li><?php echo $this->Html->link(__('Approve', true), array('controller'=>'delivery_orders','action' => 'approved', $deliveryOrder['DeliveryOrder']['id'], status_delivery_order_sent_to_supervisor_id)); ?> </li>
				<li><?php echo $this->Html->link(__('Cancel', true),  array('controller'=>'delivery_orders','action' => 'cancel', $deliveryOrder['DeliveryOrder']['id'])); ?> </li>
			<?php endif;?>		
			
			
			<?php if($can_register_stock): ?>
				<li><?php echo $this->Html->link(__('Register Stock', true), array('controller'=>'inlogs','action' => 'add/delivery_order_id:'.$deliveryOrder['DeliveryOrder']['id'])); ?></li>
			<?php endif;?>
			<?php if($can_register_fa): ?>
				<li><?php echo $this->Html->link(__('Register FA', true), array('controller'=>'purchases','action' => 'add/delivery_order_id:'.$deliveryOrder['DeliveryOrder']['id'])); ?></li>
				<li><?php echo $this->Html->link(__('Cancel', true),  array('controller'=>'delivery_orders','action' => 'cancel', $deliveryOrder['DeliveryOrder']['id'])); ?> </li>
			<?php endif;?>
			
				<li>
					<?php 
						if($deliveryOrder['DeliveryOrder']['request_type_id'] == 5){
							echo $this->Html->link(__('Print To PDF', true), array('controller' => 'delivery_orders', 'action' => 'print_pdf_detailed', $deliveryOrder['DeliveryOrder']['id']));
						}else{
							echo $this->Html->link(__('Print To PDF', true), array('controller' => 'delivery_orders', 'action' => 'print_pdf', $deliveryOrder['DeliveryOrder']['id']));
						}
					?>
				</li>
			
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
				<li><?php echo $this->Html->link(__('Back to DO List', true), array('controller'=>'delivery_orders','action' => 'index', $deliveryOrder['DeliveryOrder']['po_id'])); ?> </li>			
			<?php };?>
			
		</ul>
	</div>	

</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Delivery Orders', true), array('action' => 'list_delivery_order')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pos', true), array('controller' => 'pos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<?php if($can_edit) :?>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $deliveryOrder['DeliveryOrder']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $deliveryOrder['DeliveryOrder']['id'])); ?> </li>
		<?php endif;?>
		</ul>
</div>
<div class="related">
	<h3><?php __('Received Item Detail'); ?></h3>
	<p style="text-align:right;width:98%">
		<?php 
			if($can_edit):
			echo $ajax->link(__('Re-Calculate', true), 
			array('controller'=>'delivery_orders', 'action'=>'ajax_view', $deliveryOrder['DeliveryOrder']['id']),
			array(
				'indicator'=>'LoadingDiv',
				'complete'=>'recalcDeliveryOrder(request)'
			)); 
			endif;
		?> 
	</p>	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('No'); ?></th>
		<th><?php __('Asset Category'); ?></th>
		<th><?php __('Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Qty PO'); ?></th>
		<th><?php __('Qty Outstanding'); ?></th>
		<th><?php __('Qty Received'); ?></th>
		<th><?php __('Qty Balance'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($deliveryOrder['DeliveryOrderDetail'] as $deliveryOrderDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
		
		<?php 
		
			$qty_balance=$poDetail[$deliveryOrderDetail['po_detail_id']]-$deliveryOrderDetail['qty_received'];;//$deliveryOrderDetail['qty']-$deliveryOrderDetail['qty_received'];
			$id=$deliveryOrderDetail['id'];
		?>
		
			<td><?php echo $i;?></td>
			<td><?php echo $deliveryOrderDetail['asset_category_name'];?></td>
			<td class="left"><?php echo $deliveryOrderDetail['item_code'];?></td>
			<td class="left"><?php echo $deliveryOrderDetail['name'];?></td>
			<td>
				<?php 
					if($deliveryOrder['DeliveryOrder']['request_type_id'] == 5){
						echo $deliveryOrderDetail['qty'];
					}else{
						echo $poDetail[$deliveryOrderDetail['po_detail_id']];
					}
				?>
			</td>
			<td>
				<?php
					if(is_null($deliveryOrderDetail['qty_outstanding'])){
						echo $deliveryOrderDetail['qty'];
					}else{
						echo $deliveryOrderDetail['qty_outstanding'];
					}
				?>
			</td>
			<td>
				<div id="qty_received.<?php echo $id?>"><?php echo $deliveryOrderDetail['qty_received'];?></div>
				<?php
				if($can_edit):
					echo $ajax->editor('qty_received.'.$id,
						array('controller'=>'delivery_order_details', 'action'=>'ajax_edit', $id ),
						array('loaded'=>$recalcFunction)						
					); 
				endif;
				?>				
			</td>
			<td>
				<div id="qty_balance.<?php echo $id?>"><?php echo $qty_balance;?></div>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>	
</div>
