<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<fieldset>
	<?php echo $this->Form->create('Po', array('action'=>'index')) ?>
	<legend><?php __('PO Filters')?></legend>
	<fieldset class='subfilter' style='width:30%'>
		<legend><?php __('PO Info')?></legend>
		<?php echo $this->Form->input('is_done',array('options'=>array('0'=>'All','Yes','No'),'value'=>$this->Session->read('Po.is_done'))) ?>
		<?php echo $this->Form->input('po_status_id',array('options'=>$po_statuses,'empty'=>'all', 'value'=>$this->Session->read('Po.po_status_id'))) ?>
		<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$this->Session->read('Po.supplier_id'))) ?>
	</fieldset>
	
	<fieldset class='subfilter' style='width:37%'>
		<legend><?php __('PO Date')?></legend>
		<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
		<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
		<?php echo $this->Form->input('no', array('value'=>$this->Session->read('Po.no'))) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('PO Finish', true), array('controller' => 'pos', 'action' => 'po_report/finish')); ?></li>
		<li><?php echo $this->Html->link(__('PO Outstanding', true), array('controller' => 'pos', 'action' => 'po_report/outstanding')); ?></li>		
	</ul>
</div>
</div>

<div class="related">
	<h2><?php __('POs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('no_po');?></th>
			<th><?php echo $this->Paginator->sort('po_date');?></th>
			<th><?php echo $this->Paginator->sort('delivery_date');?></th>
			<th><?php echo $this->Paginator->sort('supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('po_status_id');?></th>
			<th><?php echo $this->Paginator->sort('request_type_id');?></th>
			<th><?php echo $this->Paginator->sort('v_is_done');?></th>
			<th><?php echo $this->Paginator->sort('currency_id');?></th>
			<th class="number"><?php echo $this->Paginator->sort('total_cur');?></th>
			<th class="number"><?php echo $this->Paginator->sort('down_payment');?></th>
			<th><?php echo $this->Paginator->sort('Invoce No');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$id_group=$this->Session->read('Security.permissions');
	foreach ($pos as $po):
		$class = null;
		$can_edit 		= $po['Po']['po_status_id']==status_po_draft_id && $id_group==gs_group_id;
		$can_receive 	= $po['Po']['po_status_id']==status_po_sent_id && $id_group==gs_group_id;
		$can_close		= $po['Po']['po_status_id']==status_po_finish_id && $id_group==gs_group_id;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		//var_dump($po['Invoice']);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $po['Po']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?>&nbsp;</td>
		<td class="left">
			<?php echo $po['Supplier']['name']; ?>
		</td>
		<td class="left">
			<?php echo $po['PoStatus']['name']; ?>
		</td>
		<td class="left"><?php echo $po['RequestType']['name']; ?></td>
		<td class="center"><?php echo $this->Html->image($po['Po']['v_is_done'] . ".gif"); ?></td>

		<td class="center"><?php echo $po['Currency']['name']; ?></td>
		<td class="number"><?php echo $this->Number->format($po['Po']['total_cur'], $po['Po']['currency_id']==1?-1:2); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($po['Po']['down_payment'], $po['Po']['currency_id']==1?-1:2); ?>&nbsp;</td>
		<td class="number">
			<?php if(!empty($po['Invoice'])): ?>
				<?php foreach($po['Invoice'] as $invoice):?>
					<?php echo $invoice['no'] ; ?>&nbsp;
				<?php endforeach; ?>
			<?php endif; ?>
		</td>	
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $po['Po']['id'])); ?>
			
			<!--?php if ($can_close) : ?-->
			<!--?php //echo $this->Html->link(__('Received', true), array('action' => 'view_received', $po['Po']['id'])); ?-->
			<!--?php echo $this->Html->link(__('Close', true), array('action' => 'close', $po['Po']['id'])); ?-->
			<!--?php endif ; ?-->
			<?php if(($can_edit) || $po['Po']['po_status_id'] == '11') {?>
				<?php if($id_group!=po_approval1_group_id && $id_group!=po_approval2_group_id){?>
					<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $po['Po']['id'])); ?>
					<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $po['Po']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $po['Po']['id'])); ?>
				<? } ?>
			<?php } ?>
			<?php if ($can_receive) : ?>
			<?php //echo $this->Html->link(__('Received', true), array('action' => 'view_received', $po['Po']['id'])); ?>
			<?php echo $this->Html->link(__('Received', true), array('controller'=>'delivery_orders','action' => 'index', $po['Po']['id'])); ?>
			<?php endif ; ?>
		</td>
	</tr>
	<?php endforeach; ?>

	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
