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
			<?php if($this->Session->read('HKConf.table_name') == 'npbs'){
					echo 'MR';
				}else if($this->Session->read('HKConf.table_name') == 'pos'){
					echo 'PO';
				}else if($this->Session->read('HKConf.table_name') == 'delivery_orders'){
					echo 'Delivery Order';
				}else if($this->Session->read('HKConf.table_name') == 'inlogs'){
					echo 'Inlog';
				}else if($this->Session->read('HKConf.table_name') == 'outlogs'){
					echo 'Outlog';
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
		<th><?php echo __('MR No')			;?></th>
		<th><?php echo __('Outstanding')	;?></th>		
		<th><?php echo __('PO No')			;?></th>
		<th><?php echo __('DO No')			;?></th>
		<th><?php echo __('Inlog No')		;?></th>
		<th><?php echo __('Inlog Detail')	;?></th>
	</tr>
	
	<?php
		echo $this->Form->create('HouseKeeping', array('action'=>'process_inlogs'));
		$i = 0;
		$n = 0;
		$group_id = $this->Session->read('Security.permissions');
		foreach ($data as $d):
			
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			//if($d['npb_outstanding'] == 1){
				if($d['npb_status_name'] != 'RAC Approved'){
					if(strpos($d['npb_no'],"MR-RAC-C") === false){
			$n++;
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
		
			<td><?php echo $n; ?>&nbsp;</td>
			<td class="left">
				<?php if($d['npb_id'] != null){ ?>
					<?php echo $this->Html->link($d['npb_no'], array('controller' => 'npbs', 'action' => 'view', $d['npb_id']));?><br>
					Status: <b><?php echo $d['npb_status_name'];?></b>
				<?php }; ?>
			</td>
			<td class="center">
				<?php if($d['npb_id'] != null){?>
					<?php echo $this->Html->image($d['npb_outstanding'] . ".gif"); ?>&nbsp;
				<?php };?>
			</td>
			<td class="left">
				<?php if($d['po_id'] != null){?>
					<?php echo $this->Html->link($d['po_no'], array('controller' => 'pos', 'action' => 'view', $d['po_id']));?><br>
					Status: <b><?php echo $d['po_status_name'];?></b>
				<?php }; ?>
			</td>
			<td class="left">
				<?php if($d['do_id'] != null){ ?>
					<?php echo $this->Html->link($d['do_no'], array('controller' => 'delivery_orders', 'action' => 'view', $d['do_id']));?><br>
					Status: <b><?php echo $d['do_status_name'];?></b>
				<?php }; ?>
			</td>
			<td class="left">
				<?php if($d['id'] != null){ ?>
					<?php echo $this->Html->link($d['no'], array('controller' => 'inlogs', 'action' => 'view', $d['id']));?>
				<?php }; ?>
			</td>
			<td class="left">
				<?php if($d['id'] != null){?>
					Status: <b><?php echo $d['inlog_status_name'];?></b><br>
					Created: <?php echo $this->Time->format(DATE_FORMAT, $d['date']); ?><br>
					<?php if ($d['approved_date'] != null) {?>
						Approved: <?php echo $this->Time->format(DATE_FORMAT, $d['approved_date']); ?><br>				
					<?php };?>
				<?php }; ?>
			</td>
		</tr>
	<?php /* };};};endforeach; */ ?>
	<?php };};endforeach; ?>
		<tr>
			<td colspan="7"><?php echo $this->Form->end(__('Submit', true));?></td>
		</tr>
	</table>
	<p>
</div>
