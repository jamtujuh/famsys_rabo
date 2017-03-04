
<div class="assets index">
	<h2><?php __('Fixed Assets Movement Report');?></h2>
<? echo $form->create('Asset', array('action' => 'depr_report'));?>
<fieldset>
	<? echo $form->input('year', array( 'label' => 'Acquisition Year', 'value'=>$this->Session->read('AssetReport.year'), 'style'=>'width:50px')); ?>
	<? echo $form->input('department_id', array( 'options'=>$departments , 'value'=>$this->Session->read('AssetReport.department_id'), 'empty'=>'all'  )); ?>
	<? echo $form->input('asset_category_id', array( 'options'=>$assetCategories, 'value'=>$this->Session->read('AssetReport.asset_category_id'),  'empty'=>'all'  )); ?>
	<? echo $form->end('Reload'); ?>
</fieldset>
</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Home', true), '/pages/home' ); ?> </li>
		<li><?php echo $this->Html->link(__('Calculate Depreciation', true), array('controller'=>'assets', 'action'=>'process_depr') ); ?> </li>
		<li><?php echo $this->Html->link(__('Asset Details Depr.', true), array('controller'=>'asset_details', 'action'=>'depr_report') ); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller'=>'purchases', 'action'=>'index') ); ?> </li>
	</ul>
</div>

<div class="related">
<? 
$headings=array('Cost', 'Accumulated Depreciation');
foreach ($headings as $h) :
?>
<h2><?=$h?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th rowspan="2"><?php echo $this->Html->link('ID','#');?></th>
		<th rowspan="2"><?php echo $this->Html->link('Category','name');?></th>
		<th rowspan="2"><?php echo $this->Html->link('Beginning Balance','amount');?></th>
		<th colspan="5" class="center"><?php echo $this->Html->link('Additions','umurek');?></th>
		<th rowspan="2" class="center"><?php echo $this->Html->link('Total Additions','umurek');?></th>
		<th colspan="5" class="center"><?php echo $this->Html->link('Deductions','umurek');?></th>
		<th rowspan="2" class="center"><?php echo $this->Html->link('Total Deductions','umurek');?></th>
	</tr>
	<tr>
		<th><?php echo $this->Html->link('Pembelian','#');?></th>
		<th><?php echo $this->Html->link('Mutasi Masuk','#');?></th>
		<th><?php echo $this->Html->link('Reklas dari Gol ke Gol','#');?></th>
		<th><?php echo $this->Html->link('Reklas','#');?></th>
		<th><?php echo $this->Html->link('Revaluasi FA','#');?></th>

		<th><?php echo $this->Html->link('Pembelian','#');?></th>
		<th><?php echo $this->Html->link('Mutasi Masuk','#');?></th>
		<th><?php echo $this->Html->link('Reklas dari Gol ke Gol','#');?></th>
		<th><?php echo $this->Html->link('Reklas','#');?></th>
		<th><?php echo $this->Html->link('Revaluasi FA','#');?></th>

	<tr>

	<?php
	$i = 0;
	foreach ($assetCategories as $id=>$name):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $id; ?>&nbsp;</td>
		<td><?php echo $name; ?>&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>
<?php endforeach; ?>


<h2>Book Value</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Html->link('ID','#');?></th>
		<th><?php echo $this->Html->link('Category','name');?></th>
		<th><?php echo $this->Html->link('Cost','amount');?></th>
		<th class="center"><?php echo $this->Html->link('Acc. Depreciation','umurek');?></th>
		<th class="center"><?php echo $this->Html->link('Book Value','umurek');?></th>
	</tr>

	<?php
	$i = 0;
	foreach ($assetCategories as $id=>$name):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $id; ?>&nbsp;</td>
		<td><?php echo $name; ?>&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
		<td class="number">0.00&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>

</div>

