<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('Supplier', array('action'=>'history')) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Supplier History')?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Supplier Info')?></legend>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'value'=>$this->Session->read('Supplier.supplier_id'))) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
	</div>
</div>
<div class="suppliers history">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php __('No'); ?></th>
			<th><?php __('No Po');?></th>
			<th><?php __('Po Date');?></th>
			<th><?php __('Delivery Date');?></th>
			<th><?php __('Finish Date');?></th>
			<th><?php __('Selisih');?></th>
			<th><?php __('Is Done');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pos as $po):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	
	<tr<?php echo $class;?>>
	
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($po['Po']['no'], array('controller'=>'pos', 'action'=>'view', $po['Po']['id'])); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['date_finish']); ?>&nbsp;</td>
		<?php
		    $expiredate=strtotime($po['Po']['date_finish']);
			$cdate=strtotime($po['Po']['delivery_date']);
			$dateDiff = $expiredate - $cdate;
			$fullDays = floor($dateDiff/(60*60*24));
		if(	$fullDays <= 0) {
			$hari = "<font color='green'>Good</font>";;
		} else {
			$fullDays > 0;
			$hari = "<font color='red'>$fullDays days</font>";
		}
		?>
		<td class="left"><?php echo $hari; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->image($po['Po']['v_is_done'] . ".gif"); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View DO', true), array('controller'=>'delivery_orders', 'action' => 'index', $po['Po']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
</div>
