<div class="pos index">
	<fieldset>
	<legend><?php __('PO Filters')?></legend>
	<?php echo $this->Form->create('Po', array('action'=>'index')) ?>
	<?php echo $this->Form->input('po_status_id',array('options'=>$po_statuses,'empty'=>'all', 'value'=>$po_status_id)) ?>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$po_department_id)) ?>
	<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	<?php echo $this->Form->end('Refresh') ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New PO', true), array('action' => 'po_type')); ?></li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List PO Details', true), array('controller' => 'po_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New PO Detail', true), array('controller' => 'po_details', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h2><?php __('POs');?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('No');?></th>
			<th><?php echo $this->Paginator->sort('No PO');?></th>
			<th><?php echo $this->Paginator->sort('PO');?></th>
			<th><?php echo $this->Paginator->sort('Delivery');?></th>
			<th><?php echo $this->Paginator->sort('Supplier');?></th>
			<th><?php echo $this->Paginator->sort('Nama Barang');?></th>
			<th><?php echo $this->Paginator->sort('Jumlah');?></th>
			
	</tr>
	<?php
	$i = 0;
	$id_group=$this->Session->read('Security.permissions');
	
	foreach ($pos as $po):
		$class = null;
		$can_edit 		= $po['Po']['po_status_id']==status_po_draft_id && $id_group==gs_group_id;
		$can_receive 	= $po['Po']['po_status_id']==status_po_sent_id && $id_group==gs_group_id;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	     <td><?php echo $i ?>&nbsp;</td>
		<td class="left"><?php echo $po['Po']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['po_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $po['Po']['delivery_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($po['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $po['Supplier']['id'])); ?>
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