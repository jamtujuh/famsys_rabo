<div id="moduleName"><?php echo 'STOCK > Supplier Retur > List Supplier Replace'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<?php echo $this->Form->create('SupplierReplace', array('action'=>'index')) ?>
<fieldset>
	<legend><?php __('Supplier Replace Filters')?></legend>
	<fieldset class="subfilter" style="width:50%">
	<legend><?php __('Supplier Replace Filter') ?></legend>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$supplier_replace_department_id)) ?>
	<?php echo $this->Form->input('supplier_replace_status_id',array('empty'=>'all','value'=>$supplier_replace_status_id)) ?>
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

<div class="SupplierReplace related">
	<h2><?php __('SupplierReplaces');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('no_supplier_replace');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('supplier_replace_status_id');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($supplier_replaces as $supplier_replace):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$can_edit = $supplier_replace['SupplierReplace']['supplier_replace_status_id'] == status_supplier_replace_draft_id  && $this->Session->read('Security.permissions')==stock_management_group_id ;
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $supplier_replace['SupplierReplace']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $supplier_replace['SupplierReplace']['date']); ?>&nbsp;</td>
		<td class="left">
			<?php echo $this->Html->link($supplier_replace['Department']['name'], array('controller' => 'departments', 'action' => 'view', $supplier_replace['Department']['id'])); ?>
		</td>
		<td class="left"><?php echo $supplier_replace['SupplierReplaceStatus']['name']; ?>&nbsp;</td>		
		<td class="left"><?php echo $supplier_replace['SupplierReplace']['created_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $supplier_replace['SupplierReplace']['id'])); ?>
			<?php if($can_edit) : ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $supplier_replace['SupplierReplace']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $supplier_replace['SupplierReplace']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $supplier_replace['SupplierReplace']['id'])); ?>
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