<div class="purchases index">
	<fieldset>
	<legend><?php __('Asset Purchase Report Filters')?></legend>
	<?php echo $this->Form->create('Purchase', array('action'=>'reports/fa')) ?>
	<?php echo $this->Form->input('department_id',array('options'=>$departments,'empty'=>'all','value'=>$this->Session->read('AssetReport.department_id'))) ?>
	<?php //echo $this->Form->input('supplier_id',array('options'=>$suppliers,'empty'=>'all','value'=>$supplier_id)) ?>
	<?php //echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php //echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
	</ul>
</div>

<div class="related">
<? if (!empty($purchases)) : ?>	
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
	$total=0;
	$i = 0;
	foreach ($purchases as $purchase):
		foreach ($purchase['Asset'] as $asset):
			foreach ($asset['AssetDetail'] as $assetDetail):
				//if($department_id && $assetDetail['department_id']!=$department_id) break;
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
		<td><?php echo $assetCategories[ $assetDetail['asset_category_id']]; ?>&nbsp;</td>
		<td><?php if(!empty($assetDetail['date_start'])):
					echo $this->Time->format(DATE_FORMAT, $assetDetail['date_start']);
					endif; ?>&nbsp;</td>
		<td><?php echo $departments[ $assetDetail['department_id'] ]; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetDetail['price']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetDetail['depthnini']); ?>&nbsp;</td>
		<td><?php //echo $purchase['notes']; ?>&nbsp;</td>
	</tr>
	<?php $total += $assetDetail['price'];?>
	<?php endforeach; ?>
	<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<td colspan="7">&nbsp;</td>
		<td><div align="right"><?php echo $this->Number->format($total);?></div></td>
		<td colspan="2">&nbsp;</td>
	</tr>
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
<?php endif; ?>
</div>
