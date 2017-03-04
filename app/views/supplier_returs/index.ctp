<div id="moduleName"><?php echo 'STOCK > Supplier Retur > List Supplier Retur'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('SupplierRetur', array('action'=>'index')) ?>
<fieldset>
	<legend><?php __('Supplier Retur Filters')?></legend>
	<fieldset class="subfilter" style="width:50%">
	<legend><?php __('Supplier Retur Filter') ?></legend>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$supplier_retur_department_id)) ?>
	<?php echo $this->Form->input('supplier_retur_status_id',array('empty'=>'all','value'=>$supplier_retur_status_id)) ?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF', 'xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
	</ul>
</div>
</div>

<div class="SupplierRetur related">
	<h2><?php __('SupplierReturs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('no_supplier_retur');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('supplier_retur_status_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($supplier_returs as $supplier_retur):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = $supplier_retur['SupplierRetur']['supplier_retur_status_id'] == status_supplier_retur_draft_id ? true: false;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $supplier_retur['SupplierRetur']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $supplier_retur['SupplierRetur']['date']); ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($supplier_retur['Department']['name'], array('controller' => 'departments', 'action' => 'view', $supplier_retur['Department']['id'])); ?>
		</td>
		<td class="left"><?php echo $supplier_retur['SupplierReturStatus']['name']; ?>&nbsp;</td>		
		<td class="left"><?php echo $supplier_retur['SupplierRetur']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $supplier_retur['SupplierRetur']['id'])); ?>
			<?php if($can_edit && $this->Session->read('Security.permission')==stock_management_group_id) : ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $supplier_retur['SupplierRetur']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $supplier_retur['SupplierRetur']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier_retur['SupplierRetur']['id'])); ?>
			<?php endif ;?>
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