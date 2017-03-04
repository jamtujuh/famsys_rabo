 <div class="assets index">
	<h2><?php __('Assets Purchase Report');?></h2>
	
	<? echo $form->create('Asset', array('action' => 'purchase_report'));?>
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
		<li><?php echo $this->Html->link(__('Assets Depr.', true), array('controller'=>'assets', 'action'=>'depr_report') ); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases', true), array('controller'=>'purchases', 'action'=>'index') ); ?> </li>
	</ul>
</div>

<div class="related">	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('Brand/Type','brand');?></th>
			<th><?php echo $this->Paginator->sort('Category','id_category');?></th>
			<th><?php echo $this->Paginator->sort('Date','date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('Department','department_id');?></th>
			<th><?php echo $this->Paginator->sort('Total Acquisition Cost','amount');?></th>
			<th><?php echo $this->Paginator->sort('Economic Age','umurek');?></th>
			<th><?php echo $this->Paginator->sort('Monthly Depreciation','depbln');?></th>			
			<th><?php echo $this->Paginator->sort('Book Value '. $this->Session->read('AssetReport.year'));?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr '. $this->Session->read('AssetReport.year'));?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="left"><?php echo $asset['Asset']['id']; ?>&nbsp;</td>
		<td><?php echo $asset['Asset']['name']; ?>&nbsp;</td>
		<td><?php echo $asset['Asset']['brand']; ?>&nbsp;<?php echo $asset['Asset']['type']; ?>&nbsp;</td>
		<td class="number"><?php echo $asset['AssetCategory']['name']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_of_purchase']); ?>&nbsp;</td>
		<td class="center"><?php echo $asset['Department']['name']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['amount'] ); ?>&nbsp;</td>
		<td class="center"><?php echo $this->Number->format( $asset['Asset']['maksi'] ) ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depbln'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['book_value'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depthnini'] ); ?>&nbsp;</td>

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
