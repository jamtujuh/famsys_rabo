<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>

<div id="filter">
	<div class="fieldfilter">
		<fieldset>
			<?php echo $this->Form->create('Npb_detail', array('action'=>'voucher_index')) ?>
			<legend><?php __('NPB Filters')?></legend>	
			<fieldset class="subfilter">
				<legend><?php __('MR Status Info')?></legend>
				<?php echo $this->Form->input('department_id', array('options'=>$departments, 'empty'=>'all', 'value'=>$this->Session->read('Npb_detail.department_id'))) ?>
				<?php echo $this->Form->input('status', array('options'=>$npbStatuses, 'value'=>$this->Session->read('Npb_detail.status'), 'readonly'=>'true', 'disabled'=>'disabled')) ?>
			</fieldset>
			<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Branch Filter') ?></legend>				
				<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?>
				<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
			</fieldset>			
			<?php echo $this->Form->submit('Refresh') ?>
			<?php echo $this->Form->end() ?>
		</fieldset>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Npbs', true), array('controller' => 'npbs', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="npbDetails index">
	<h2><?php __('Npb Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo 'No';?></th>
		<th><?php echo 'Branch';?></th>
		<th><?php echo 'No MR';?></th>
		<th><?php echo 'Vouchers';?></th>
		<th><?php echo 'Items';?></th>	
		<th><?php echo 'Remarks';?></th>	
		<th><?php echo 'Status';?></th>		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	
	$i = 0;
	if($npbData){
		foreach ($npbData as $data):
			$qty_count = 0;
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			if($data['main']['totalVoucher'] > 0 || $data['main']['totalLock'] > 0){
	?>
		<tr<?php echo $class;?>>
			<td><?php echo $i; ?>&nbsp;</td>
			<td class="left"><?php echo $data['main']['department_name']; ?></td>
			<td class="left">
				<?php echo $this->Html->link($data['main']['npb_no'], array('controller' => 'npbs', 'action' => 'view', $data['main']['npb_id'])); ?>
			</td>
			<td class="center">
				<?php echo $data['main']['totalVoucher']; ?>
			</td>
			<td class="center">
				<?php echo $data['main']['totalLock']; ?>
			</td>
			<td class="left">
				<?php 
					foreach($data['detail'] as $detail){
						echo $detail['item_qty'] ."-". $detail['item_name'] ."<br>";
					}					
				?>
			</td>
			<td class="left"><?php echo $data['main']['status_name']; ?></td>	
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'npbs', 'action' => 'view', $data['main']['npb_id'])); ?>
			</td>
		</tr>
<?php }; endforeach; }; ?>
	</table>
	<p>
	
</div>