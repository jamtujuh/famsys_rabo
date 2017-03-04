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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Do Date'); ?></dt>
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

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $deliveryOrder['DeliveryOrder']['description']; ?>
			&nbsp;
		</dd>
		
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
		<?php endif;?>

	</dl>
	<div>
		<?php echo $this->Form->create('DeliveryOrder');?>
			<?php
				echo $this->Form->input('id', array('type'=>'hidden'));
				echo $this->Form->input('no', array('type'=>'hidden'));
				echo $this->Form->input('cancel_note', array('style'=>'width:70%'));
				echo $this->Form->input('cancel_by', array('value'=>$this->Session->read('Userinfo.username'), 'readonly'=>true, 'style'=>'width:25%'));
				echo $this->Form->input('cancel_date', array('value'=>date("Y-m-d H:i:s"), 'type'=>'text', 'readonly'=>true));
			?>
		<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	
	<div class="doc_button">
        <ul>
			<li><?php echo $this->Html->link('Back', array('action'=>'view', $deliveryOrder['DeliveryOrder']['id'])) ;?></li>
		</ul>
		
	</div>

</div>
<div class="related">
	<h3><?php __('Received Item Detail'); ?></h3>
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
			$qty_balance=$deliveryOrderDetail['qty']-$deliveryOrderDetail['qty_received'];
			$id=$deliveryOrderDetail['id'];
		?>
		
			<td><?php echo $i;?></td>
			<td><?php echo $assetCategories[ $deliveryOrderDetail['asset_category_id'] ];?></td>
			<td class="left"><?php echo $deliveryOrderDetail['item_code'];?></td>
			<td class="left"><?php echo $deliveryOrderDetail['name'];?></td>
			<td><?php echo $poDetail[$deliveryOrderDetail['po_detail_id']];?></td>
			<td><?php echo $deliveryOrderDetail['qty'];?></td>
			<td>
				<div id="qty_received.<?php echo $id?>"><?php echo $deliveryOrderDetail['qty_received'];?></div>
			</td>
			<td>
				<div id="qty_balance.<?php echo $id?>"><?php echo $qty_balance;?></div>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>	
</div>