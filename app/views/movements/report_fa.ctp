<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);	
?>
<div class="movement index">
	<fieldset>
	<legend><?php __('Fixed Asset Transfer Report Filters')?></legend>
	<?php echo $this->Form->create('Movement', array('action'=>'reports/fa')) ?>
	<?php echo $this->Form->input('asset_category_id',array('options'=>$assetCategories,'empty'=>'all','value'=>$asset_category_id)) ?>
	<fieldset>
	<legend><?php __('Source Branch')?></legend>
	<?php echo $this->Form->input('source_department_id',array('options'=>$departments,'empty'=>'all','value'=>$source_department_id)) ?>
	<?php echo $this->Form->input('source_business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$source_business_type_id)) ?>
	<?php echo $this->Form->input('source_cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('SourceCostCenter.name', array('label'=>'Source Cost Center', 'style'=>'width:40%')); ?>
	<div id="source_cost_center_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('SourceCostCenterName', 'source_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_source', {afterUpdateElement : setSourceCostCenterValues});
		//]]>
	</script>
	</fieldset>
	<fieldset>
	<legend><?php __('Destination Branch')?></legend>
	<?php echo $this->Form->input('dest_department_id',array('label'=>'Dest Branch', 'options'=>$departments,'empty'=>'all','value'=>$dest_department_id)) ?>
	<?php echo $this->Form->input('dest_business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$dest_business_type_id)) ?>
	<?php echo $this->Form->input('dest_cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
	<?php echo $this->Form->input('DestCostCenter.name', array('label'=>'Dest Cost Center', 'style'=>'width:40%')); ?>
	<div id="dest_cost_center_choices" class="auto_complete"></div> 
	<script type="text/javascript"> 
		//<![CDATA[
		new Ajax.Autocompleter('DestCostCenterName', 'dest_cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete_destination', {afterUpdateElement : setDestCostCenterValues});
		//]]>
	</script>
	</fieldset>
	<?php //echo $form->input('source_department_sub_id', array('options'=>$departmentSub, 'empty'=>''  )); ?>
	<?php //echo $form->input('source_department_unit_id', array( 'options'=>$departmentUnit, 'empty'=>''  )); ?>
		<?php
		/* $options = array('url' => 'getSourceDepartmentSubId', 
		'indicator'=>'LoadingDiv', 'update' => 'MovementSourceDepartmentSubId');
		echo $ajax->observeField('MovementSourceDepartmentId', $options);
		
		$options = array('url' => 'getSourceDepartmentUnitId', 
		'indicator'=>'LoadingDiv', 'update' => 'MovementSourceDepartmentUnitId');
		echo $ajax->observeField('MovementSourceDepartmentSubId', $options); */
		?>
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?>
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
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

<div class="movement related">
	<h2><?php __('Fixed Asset Transfer Report');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('no');?></th>
		<th><?php echo $this->Paginator->sort('no_mov');?></th>
		<th><?php echo $this->Paginator->sort('No Inventaris');?></th>
		<th><?php echo $this->Paginator->sort('item_code');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('brand');?></th>
		<th><?php echo $this->Paginator->sort('type');?></th>
		<th><?php echo $this->Paginator->sort('color');?></th>
		<th><?php echo $this->Paginator->sort('serial_no');?></th>
		<th><?php echo $this->Paginator->sort('category');?></th>
		<th><?php echo $this->Paginator->sort('source_department_id');?></th>
		<th><?php echo $this->Paginator->sort('Source Business Type');?></th>
		<th><?php echo $this->Paginator->sort('source_cost_center_id');?></th>
		<th><?php echo $this->Paginator->sort('dest_department_id');?></th>
		<th><?php echo $this->Paginator->sort('Dest Business Type');?></th>
		<th><?php echo $this->Paginator->sort('dest_cost_center_id');?></th>
		<th><?php echo $this->Paginator->sort('doc_date');?></th>
		<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
		<th><?php echo $this->Paginator->sort('price');?></th>
		<th><?php echo $this->Paginator->sort('Accum. Depr');?></th>
		<th><?php echo $this->Paginator->sort('Book Value');?></th>
		<th><?php echo $this->Paginator->sort('Notes');?></th>
	</tr>
	<?php
	$i = 0;
	$price= 0;
	$depthnini= 0;
	$book_value= 0;
	foreach ($movements as $movement):
	?>
	<?php foreach ($movement['MovementDetail'] as $md ) : 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}	
	?>
	
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $movement['Movement']['no']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['type']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['serial_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategories[$md['AssetDetail']['asset_category_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$movement['Movement']['source_department_id']]; ?></td>
		<td class="left"><?php echo $movement['BusinessType']['name']; ?></td>
		<td class="left"><?php echo $costCenter[$movement['Movement']['source_cost_center_id']]; ?>-<?php echo $movement['CostCenter']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$movement['Movement']['dest_department_id']]; ?></td>
		<td class="left"><?php echo $movement['BusinessType']['name']; ?></td>
		<td class="left"><?php echo $costCenter[$movement['Movement']['dest_cost_center_id']]; ?>-<?php echo $movement['CostCenter']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $movement['Movement']['doc_date']; ?>&nbsp;</td>
		<td class="left"><?php echo $md['AssetDetail']['date_start']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($md['AssetDetail']['price']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($md['AssetDetail']['depthnini']); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($md['AssetDetail']['book_value']); ?>&nbsp;</td>
		<td class="left"><?php echo $movement['Movement']['notes']; ?>&nbsp;</td>
	</tr>
	<?php $price += $md['AssetDetail']['price'];?>
	<?php $depthnini += $md['AssetDetail']['depthnini'];?>
	<?php $book_value += $md['AssetDetail']['book_value'];?>

	<?php endforeach; ?>
	<?php endforeach; ?>
	<tr>
		<td colspan="18"><div align="right">Total</div></td>
		<td class="number"><?php echo $this->Number->format($price);?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($depthnini);?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($book_value);?>&nbsp;</td>
		<td>&nbsp;</td>
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
</div>
