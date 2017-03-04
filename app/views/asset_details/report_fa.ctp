<div class="purchases index">
	<fieldset>
	<legend><?php __('Purchase Report Filters')?></legend>
	<?php echo $this->Form->create('Purchase', array('action'=>'index')) ?>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$department_id)) ?>
	<?php //echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
	<?php //echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php //echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	<?php echo $this->Form->end('Refresh') ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Purchase', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Warranties', true), array('controller' => 'warranties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warranty', true), array('controller' => 'warranties', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requesters', true), array('controller' => 'requesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requester', true), array('controller' => 'requesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers', true), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier', true), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h2><?php __('Fixed Asset Purchase Report');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('Doc No');?></th>
			<th><?php echo $this->Paginator->sort('Code');?></th>
			<th><?php echo $this->Paginator->sort('Name');?></th>
			<th><?php echo $this->Paginator->sort('Category');?></th>
			<th><?php echo $this->Paginator->sort('Date of Purchase');?></th>
			<th><?php echo $this->Paginator->sort('Department');?></th>
			<th><?php echo $this->Paginator->sort('Acquisition Cost');?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr.');?></th>
			<th><?php echo $this->Paginator->sort('Notes');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($purchases as $purchase):
		foreach ($purchase['Asset'] as $asset):
			foreach ($asset['AssetDetail'] as $assetDetail):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
	?>
	<tr<?php echo $class;?>>
		<td class="number"><?php echo $i; ?>&nbsp;</td>
		<td class="number"><?php echo $purchase['Purchase']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['code']; ?>&nbsp;</td>
		<td><?php echo $assetDetail['name']; ?>&nbsp;</td>
		<td><?php echo $assetDetail['asset_category_id']; ?>&nbsp;</td>
		<td class="left"><?php  if(!empty($assetDetail['date_start'])) :
				echo $this->Time->format(DATE_FORMAT, $assetDetail['date_start']); 
								endif; ?>&nbsp;</td>
		<td><?php echo $assetDetail['department_id']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetDetail['price']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetDetail['depthnini']); ?>&nbsp;</td>
		<td><?php echo $purchase['notes']; ?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
	<?php endforeach; ?>
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
