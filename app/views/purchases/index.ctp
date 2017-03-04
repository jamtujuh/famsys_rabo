<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
		<?php echo $this->Form->create('Purchase', array('action'=>'index')) ?>
		<fieldset>
			<legend><?php __('Purchase Filters')?></legend>
			<fieldset class="subfilter" style='width:30%'>
				<legend><?php __('Purchases Info')?></legend>
				<?php echo $this->Form->input('purchase_status_id',array('empty'=>'all','value'=>$this->Session->read('Purchase.purchase_status_id') )) ?>
				<?php echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
			</fieldset>
			<fieldset class="subfilter" style='width:37%'>
			<legend><?php __('Date Filters')?></legend>
				<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
				<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
			</fieldset>
			<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
			<?php echo $this->Form->submit('Refresh') ?>
		</fieldset>
		<?php echo $this->Form->end() ?>
	</div>
	<div class="actions" >
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('List Warranties', true), array('controller' => 'warranties', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h2><?php __('Purchases');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<?php
			$id_group = $this->Session->read('Security.permissions');
			if ($this->Session->read('Purchase.purchase_status_id') == 2 && $id_group == it_supervisor_group_id){
		?>	
			<th><?php echo 'Approve';?></th>
		<?php
			}else{
		?>
			<th><?php echo $this->Paginator->sort('No');?></th>
		<?php
			}
		?>
			<th><?php echo $this->Paginator->sort('No_FA');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('register_status');?></th>
			<th><?php echo $this->Paginator->sort('Warranty');?></th>
			<th><?php echo $this->Paginator->sort('Warranty Year','warranty_year');?></th>
			<th><?php echo $this->Paginator->sort('Supplier','supplier_id');?></th>
			<th><?php echo $this->Paginator->sort('no_po');?></th>
			<th><?php echo $this->Paginator->sort('doc_total');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php echo $this->Form->create('Purchase');?>
	<?php echo $this->Form->input('purchase_status_id', array('value'=>$this->Session->read('Purchase.purchase_status_id'), 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('status_id_update', array('value'=>6, 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('layout', array('value'=>'screen', 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('supplier_id', array('value'=>null, 'type'=>'hidden')); ?>
	
	<?php
	$i = 0;
	$total = 0;
	foreach ($purchases as $purchase):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="number">
		<?php
			if ($this->Session->read('Purchase.purchase_status_id') == 2 && $id_group == it_supervisor_group_id){
			echo $this->Form->input('select_detail', 
				array(
					'hiddenField'=>false,
					'label'=>'',
					'checked'=>false,
					'type'=>'checkbox', 
					'value'=>$purchase['Purchase']['id'],
					'name'=>'data[Purchase][purchase_id][]')) ;
			}else{
		?>
			<?php echo $i; ?>&nbsp;
		<?php
			}
		?>			
		</td>		
		<td class="number"><?php echo $purchase['Purchase']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $purchase['Purchase']['date_of_purchase']); ?>&nbsp;</td>
		<td class="left"><?php echo $purchase['PurchaseStatus']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $purchase['Purchase']['warranty_name']; ?></td>
		<td class="left"><?php echo $purchase['Purchase']['warranty_year']; ?> Year</td>
		<td class="left"><?php echo $purchase['Supplier']['name']; ?></td>
		<td class="left">
			<?php echo $this->Html->link(__($purchase['Purchase']['po_no'], true), array('controller'=>'pos', 'action' => 'view', $purchase['Purchase']['po_id'])); ?>
		&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($purchase['Purchase']['total']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $purchase['Purchase']['id'])); ?>
		</td>
	</tr>
	<?php if ($purchase['Purchase']['total']) $total += $purchase['Purchase']['total'];?>
<?php endforeach; ?>
	<tr>
		<td colspan="8"><div align="right">Total</div></td>
		<td class="number"><?php echo $this->Number->format($total) ;?>&nbsp;</td>
	</tr>
	<?php
		if ($this->Session->read('Purchase.purchase_status_id') == 2 && $id_group == it_supervisor_group_id){
	?>
		<tr>
			<td colspan="1"><?php echo $this->Form->end(__('Submit', true));?></td>
		</tr>
	<?php };?>
	
	<!--tr>
		<td colspan="8"><div align="right">General Total</div></td>
		<td class="number"><?php echo $this->Number->format($purchaseTotal['total']) ;?>&nbsp;</td>
	</tr-->
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
