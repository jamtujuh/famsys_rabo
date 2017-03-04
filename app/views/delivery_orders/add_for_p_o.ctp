<?php
	$group_id = $this->Session->read('Security.permissions');
	echo $javascript->link('my_detail_add', false);
?>

<div class="pos view">
    <h2><?php __('PO Receive Item'); ?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('No'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class; ?>>
				<?php echo $this->Html->link($po_no, array('controller' => 'pos', 'action' => 'view', $po_id)); ?>
				&nbsp;
			</dd>
			
			<dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Branch'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class; ?>>
				<?php echo $department_name; ?>
				&nbsp;
			</dd>
			
			<dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Supplier'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class; ?>>
				<?php echo $supplier_name; ?>
				&nbsp;
			</dd>
		</dl>
</div>

<div class="doc_actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back to DO List', true), array('controller'=>'delivery_orders','action' => 'index', $po_id)); ?> </li>			
		<li><?php echo $this->Html->link(__('Back to PO List', true), array('controller'=>'pos','action' => 'index', status_po_sent_id)); ?> </li>			
	</ul>
</div>

<br>

<div class="related">
	<h2><?php __('MR Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php __('No'); ?></th>
			<th><?php __('MR No'); ?></th>
			<th><?php __('Code'); ?></th>
			<th><?php __('Name'); ?></th>
			<th><?php __('Qty'); ?></th>
			<th><?php __('DO No'); ?></th>
			<th><?php __('Qty Receive'); ?></th>
			<th><?php __('Actions'); ?></th>
		</tr>
		
		<?php 
			$i = 0;
			foreach($items as $item):
			$exist = false;
			$found = false;
			foreach($res as $data){
				if($found == false){
					if($data[0]['source_npb_detail_id'] == $item['NpbDetail']['id'] && $data[0]['po_id'] == $po_id && $data[0]['do_no']){
						$found = true;
					}
				}
			}
			if($found){
				echo $this->Form->create('DeliveryOrder', array('action' => 'ajax_update'));
			}else{
				echo $this->Form->create('DeliveryOrder', array('action' => 'ajax_add'));
			}
			
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
		?>
		
			<?php if ($this->Session->read('DeliveryOrder.can_view')) : ?>
				<tr<?php echo $class; ?>>
					<td><?php echo $i; ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link(__($item['Npb']['no'], true), array('controller'=>'npbs', 'action' => 'view', $item['Npb']['id'])); ?>
					</td>
					<td class="left"><?php echo $item['NpbDetail']['item_code'];?></td>
					<td class="left"><?php echo $item['NpbDetail']['item_name'];?></td>
					<td><?php echo $item['NpbDetail']['qty'];?></td>
					<td></td>
					<td></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View', true), array('controller' => 'delivery_orders', 'action' => 'view', $item['Npb']['id'])); ?>
						<?php echo $this->Html->link(__('Print To PDF', true), array('controller' => 'delivery_orders', 'action' => 'print_pdf', $item['Npb']['id'])); ?>
					</td>
				</tr>
			<?php endif; ?>
		
			<?php if ($this->Session->read('DeliveryOrder.can_add')) : ?>
				<tr<?php echo $class; ?> id="newRecord">
					<td><?php echo $i; ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link(__($item['Npb']['no'], true), array('controller'=>'npbs', 'action' => 'view', $item['Npb']['id'])); ?>
					</td>
					<td class="left"><?php echo $item['NpbDetail']['item_code'];?></td>
					<td class="left"><?php echo $item['NpbDetail']['item_name'];?></td>
					<td><?php echo $item['NpbDetail']['qty'];?></td>
					<td>
						<?php 							
							$found = false;
							$display = null;
							foreach($res as $data){
								if($found == false){
									if($data[0]['source_npb_detail_id'] == $item['NpbDetail']['id'] && $data[0]['po_id'] == $po_id && $data[0]['do_no']){
										$display = $this->Html->link(__($data[0]['do_no'], true), array('action' => 'view', $data[0]['do_id']), array('target' => 'blank'));
										echo $this->Form->input('do_no', array('value' => $data[0]['do_no'], 'type' => 'hidden'));
										echo $this->Form->input('do_id', array('value' => $data[0]['do_id'], 'type' => 'hidden'));
										$found = true;
									}
								}
							}
							if($found){
								echo $display;
							}else{
								echo $this->Form->input('do_no', array('label'=>'', 'maxlength'=>'15'));
							}
						?>
					</td>					
					<td>
						<?php 
							$found = false;
							$display = null;
							foreach($res as $data){
								if($found == false){
									if($data[0]['source_npb_detail_id'] == $item['NpbDetail']['id'] && $data[0]['po_id'] == $po_id && $data[0]['do_qty_received']){
										$display =  $this->Form->input('qty_receive', array('label'=>'', 'maxlength'=>'3', 'size'=>'3', 'value'=>$data[0]['do_qty_received']));
										$found = true;
									}
								}
							}
							if($found){
								echo $display;
							}else{
								echo $this->Form->input('qty_receive', array('label'=>'', 'maxlength'=>'3', 'size'=>'3'));
							}
						?>
					</td>
					<td class="actions">
						<?php echo $this->Form->input('qty', array('label'=>'', 'value'=>$item['NpbDetail']['qty'], 'type'=>'hidden')); ?>
						<?php echo $this->Form->input('item_code', array('value' => $item['NpbDetail']['item_code'], 'type' => 'hidden')); ?>
						<?php echo $this->Form->input('item_id', array('value' => $item['NpbDetail']['item_id'], 'type' => 'hidden')); ?>
						<?php echo $this->Form->input('npb_id', array('value' => $item['NpbDetail']['npb_id'], 'type' => 'hidden')); ?>
						<?php echo $this->Form->input('npb_detail_id', array('value' => $item['NpbDetail']['id'], 'type' => 'hidden')); ?>
						<?php echo $this->Form->input('po_id', array('value' => $po_id, 'type' => 'hidden')); ?>
						<?php
							$found = false;
							$display = null;
							foreach($res as $data){
								if($found == false){
									if($data[0]['source_npb_detail_id'] == $item['NpbDetail']['id'] && $data[0]['po_id'] == $po_id && $data[0]['do_qty_received'] && $data[0]['do_no']){
										$display = $this->Form->end(__('Update', true));
										$found = true;
									}
								}
							}
							if($found){
								echo $display;
							}else{
								echo $this->Form->end(__('Submit', true));
							}
						?>
					</td>
				</tr>
			<?php endif; ?>
		<?php endforeach;?>		
    </table>
	<!--?php echo $this->Form->end(__('Submit', true));?-->
	<?php echo $this->Form->end(); ?>
    <p>
	</p>
</div>
