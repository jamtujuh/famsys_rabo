
<div class="assets index">
	<h2><?php __('Assets Depreciation Recapitulation Report');?></h2>
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
<? if (!empty($assetCategories)) : ?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Html->link('id','#');?></th>
			<th><?php echo $this->Html->link('Category','name');?></th>
			<th><?php echo $this->Html->link('Acquisition Cost','amount');?></th>
			<th><?php echo $this->Html->link('Depr. Cost Acc.(Straight Line)','umurek');?></th>
			<th><?php echo $this->Html->link('Depr. Cost Fiscal(Double Declining)','umurek');?></th>
			<th><?php echo $this->Html->link('Delta','depbln');?></th>
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
		<td class="number">&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number">&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</table>

<? endif ?>
</div>

