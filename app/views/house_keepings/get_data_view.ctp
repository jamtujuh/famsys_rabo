<div id="moduleName"><?php echo $moduleName?></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List House Keepings', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Reset Data Filter', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="houseKeeping view">
	<h2><?php __('Choose Data To Be Deleted');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Table Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($tn == 'npbs'){
					echo 'MR';
				}else if($tn == 'pos'){
					echo 'PO';
				}else if($tn == 'delivery_orders'){
					echo 'Delivery Order';
				}else if($tn == 'inlogs'){
					echo 'Inlog';
				}else if($tn == 'outlogs'){
					echo 'Outlog';
				}else if($tn == 'all'){
					echo 'ALL';
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Start'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $date_start; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date End'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $date_end; ?>
			&nbsp;
		</dd>
	</dl>
	
	<br>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>&nbsp;</th>
		<th>No</th>		
		<th><?php echo __('MR No')	;?></th>
		<th><?php echo __('PO No')	;?></th>
		<th><?php echo __('DO No')	;?></th>
		<th><?php echo __('INV No')	;?></th>
		<th><?php echo __('INV Paid Dt')	;?></th>		
		
	</tr>
	
	<?php
		echo $this->Form->create('HouseKeeping', array('action'=>'process'));
		$i = 0;
		$group_id = $this->Session->read('Security.permissions');
		foreach ($data as $d):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			if($d['npb_outstanding'] == 1){
	?>
		<tr<?php echo $class;?>>
			<td>
				<?php
				echo $this->Form->input('select_detail', 
				array(
					'hiddenField'=>false,
					'label'=>'',
					'checked'=>false,
					'type'=>'checkbox', 
					'value'=>$i,
					'name'=>'data[HouseKeeping][no][]')) ;
				?>
			</td>
		
			<td><?php echo $i; ?>&nbsp;</td>
			<td class="left">
				<?php if($d['npb_id'] != null){
					echo $this->Html->link($d['npb_no'], array('controller' => 'npbs', 'action' => 'view', $d['npb_id']));
					echo "<br>MR: ".$d['npb_status_name'];
				};
				?>
			</td>
			<td class="left">
				<?php if($d['po_id'] != null){
					echo $this->Html->link($d['po_no'], array('controller' => 'pos', 'action' => 'view', $d['po_id']));
					echo "<br>PO: ".$d['po_status_name'];
				};
				?>
			</td>
			<td class="left">
				<?php if($d['do_id'] != null){
					echo $this->Html->link($d['do_no'], array('controller' => 'delivery_orders', 'action' => 'view', $d['do_id']));
					echo "<br>DO: ".$d['do_status_name'];
				};
				?>
			</td>
			<td class="left">
				<?php echo $this->Html->link($d['inv_no'], array('controller' => 'invoices', 'action' => 'view', $d['inv_id'])); ?>
				<?php echo "<br>Inv: ".$d['inv_status_name'];?>
			</td>
			<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $d['inv_paid_date']); ?>&nbsp;</td>
			
		</tr>
	<?php };endforeach; ?>
		<tr>
			<td colspan="7"><?php echo $this->Form->end(__('Submit', true));?></td>
		</tr>
	</table>
	<p>
</div>
