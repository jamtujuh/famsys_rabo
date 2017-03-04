<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
$request_type_id =  $npb['Npb']['request_type_id'];

//validates item balance
$balance_warning=null;
if (!empty($npb['NpbDetail'])){
	foreach ($npb['NpbDetail'] as $npbDetail){
		$id 		= $npbDetail['id'];
		$qty 		= $npbDetail['qty'];
		$qty_unfilled = $npbDetail['qty_unfilled'];
		$balance 	= isset($itemBalances[$npbDetail['item_id']])?$itemBalances[$npbDetail['item_id']]:0;
		if($qty_unfilled>$balance)
		{
			$balance_warning .= $npbDetail['item_name'] . ' ' ;
		}
	}
	if($balance_warning) 
		$balance_warning = __('Stock balance is not available for item: ',true) . $balance_warning;
		
	$recalcFunction = $ajax->remoteFunction( 
		array(
			'url' => array( 'controller' => 'npbs', 'action' => 'ajax_view', $npb['Npb']['id']),
			'indicator'=>'LoadingDiv'//,'complete'=>'recalcDeliveryOrder(request)'
		) 
	);
}
?>
<div class="npbs view">
<h2><?php  __('Npb') ;?>: <?php __('Check Available Stock')?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['Npb']['no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['Department']['name']; ?>
			&nbsp;
		</dd>
	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Req Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['req_date']); ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['NpbStatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Request Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['RequestTypes']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Done ?'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($npb['Npb']['v_is_done'].".gif"); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['Npb']['created_by']; ?>
			&nbsp;
		</dd>
		
		<?php if($this->Session->read('Npb.can_reject_notes')) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reject Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['Npb']['reject_notes']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		<?php if($this->Session->read('Npb.can_cancel_notes')) :?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cancel Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $npb['Npb']['cancel_notes']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
	</dl>
	
	<div class="doc_actions">
	<ul>		
		<?php if ($request_type_id == request_type_stock_id || $request_type_id == 5) : ?>
			<li><?php echo $this->Html->link(__('Confirm Stock', true), 
				array('controller'=>'outlogs','action' => 'add', $npb['Npb']['id']),
				array('onclick'=>'return check_balance()')
				); 
				?> 
			</li>
		<?php endif;?>
				
		<li><?php echo $this->Html->link(__('Back', true), array('action' => 'view', $this->Session->read('Npb.id'))); ?> </li>
				
	</ul>
	</div>
	
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
	<?php if($this->Session->read('Npb.can_edit')) :?>
		<li><?php echo $this->Html->link(__('Edit Npb', true), array('action' => 'edit', $npb['Npb']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Npb', true), array('action' => 'delete', $npb['Npb']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npb['Npb']['id'])); ?> </li>
	<?php endif; ?>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Npb', true), array('action' => 'add', 3)); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php __('NPB Item Details');?></h3>
	<?php if (!empty($npb['NpbDetail'])):?>
	<p style="text-align:right;width:98%">
		<?php 
			echo $this->Html->link(__('Re-Calculate', true), 
				array('controller'=>'npbs','action' => 'check_stock', $npb['Npb']['id'])				
			); 		
		?> 
	</p>
	<?php endif; ?>
	
	<?php echo $this->Form->create('NpbDetail', array('action'=>'ajax_add'));?>
	
	<table id="npb_details" cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('No'); ?></th>
			<th><?php __('Item'); ?></th>
			<th><?php __('Stock Available'); ?></th>
			<th><?php __('Qty Requested'); ?></th>
			<th><?php __('Qty Already Filled'); ?></th>
			<th><?php __('Qty to be Filled'); ?></th>
		</tr>
		<?php if (!empty($npb['NpbDetail'])):?>
			<?php
				$i = 0;
				foreach ($npb['NpbDetail'] as $npbDetail):
					
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
					$id 		= $npbDetail['id'];
					$qty 		= $npbDetail['qty'];
					$balance 	= isset($itemBalances[$npbDetail['item_id']])?$itemBalances[$npbDetail['item_id']]:0;
					if($npbDetail['process_type_id'] == 1){
			?>
						<tr id="item" <?php echo $class;?>>
							<td><?php echo $i;?></td>
							<td><?php echo $npbDetail['item_code'];?> - <?php echo $npbDetail['item_name'];?></td>
							<td class="center"><div id="balance.<?php echo $id?>">
								<?php if($balance > 0){?>
									<font color="green"><?php echo $balance;?></font>
								<?php ;}else{?>
									<font color="red"><?php echo $balance;?></font>
								<?php ;};?>					
							</div></td>
							<td class="center"><?php echo $qty;?></td>
							<td class="center"><?php echo $npbDetail['qty_filled'];?></td>
							<td class="center">
									<div id="qty_unfilled.<?php echo $id?>"><?php echo $npbDetail['qty_unfilled'];?></div>
									<?php echo $ajax->editor('qty_unfilled.'.$id,
										array('controller'=>'npb_details', 'action'=>'ajax_edit', $id ),
										array('complete'=>'location.reload()')
										) 
									?>
							</td>				
						</tr>
				<?php };?>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
	<?php echo $this->Form->end(); ?>
</div>

<script>
function test() {
alert ("test");
}

function check_balance()
{
	var data=new Array();
	var ret = true;
	$$('#npb_details tr').collect(function(element, rowIndex){
		element.descendants().each(function(item, colIndex){
			var content=item.innerHTML;
			data[colIndex]=content;
			//alert(colIndex + '=' + content);
		});
		if(rowIndex>0){
			if(parseInt(data[4]) < parseInt(data[8]) ){
				var msg='Stock unavailable for ' + data[1] + '. Stock Balance: '+ data[4];
				msg = msg + '\n\nThis item will not be processed.'; 
				msg = msg + '\n\nDo you want to continue?';
				ret=confirm(msg);
			}
		}
	});
	
	return ret;
}
</script>
