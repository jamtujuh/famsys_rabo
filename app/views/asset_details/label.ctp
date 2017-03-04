<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('AssetDetail') ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('Filters') ?></legend>
	<fieldset class="subfilter">
	<legend><?php __('Asset Info') ?></legend>
		<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
			<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
			<?php echo $this->Form->input('department_name',array('style'=>'width:50%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
		<?php else : ?>
			<?php echo $this->Form->input('department_id', array('options'=>$departments , 'value'=>$department_id, 'empty'=>'all')); ?>
		<?php endif; ?>
			<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$this->Session->read('AssetReport.business_type_id'))) ?>
			<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
			<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
			<div id="cost_center_choices" class="auto_complete"></div> 
			<script type="text/javascript"> 
				//<![CDATA[
				new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetDetailCostCenterValues});
				//]]>
			</script>
	<? //echo $form->input('department_sub_id', array('options'=>$departmentSub, 'empty'=>'','value'=>$this->Session->read('AssetDetail.department_sub_id'))); ?>
	<? //echo $form->input('department_unit_id', array( 'options'=>$departmentUnit, 'empty'=>'','value'=>$this->Session->read('AssetDetail.department_unit_id'))); ?>
	<?	/* $options = array('url' => '/departments/getdepartmentsubid/AssetDetail', 
		'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentSubId');
		echo $ajax->observeField('AssetDetailDepartmentId', $options);
		
		$options = array('url' => '/department_subs/getdepartmentunitid/AssetDetail', 
		'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentUnitId');
		echo $ajax->observeField('AssetDetailDepartmentSubId', $options); */
	?>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Asset Category') ?></legend>
	<?php echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'all','value'=>$this->Session->read('AssetDetail.asset_category_id'))); ?>
	<?php echo $this->Form->input('search_keyword', array('style'=>'width:100%', 'value'=>$this->Session->read('AssetDetail.name'))); ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS','view_barcode'=>'View Barcode'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	</fieldset>
</div>
</div>
<div class="related">
	<h2><?php __('Asset Details Labelling');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('No Inventaris');?></th>
			<th><?php echo $this->Paginator->sort('condition_id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('location_id');?></th>
			<th><?php echo $this->Paginator->sort('ada');?></th>
			<th><?php echo $this->Paginator->sort('book_value');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
			<th><?php echo $this->Paginator->sort('serial_no');?></th>
			<th><?php echo $this->Paginator->sort('barcode');?></th>
			<th><?php echo $this->Paginator->sort('checked');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($assetDetails as $assetDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['Department']['name']; ?></td>
		<td class="left"><?php echo $assetDetail['BusinessType']['name']; ?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['cost_center_id']? $costCenter[$assetDetail['AssetDetail']['cost_center_id']] . '-'. $costCenters[$assetDetail['AssetDetail']['cost_center_id']]:'' ;?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['Condition']['name'] ;?></td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['type']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['Location']['name'] ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['ada']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($assetDetail['AssetDetail']['book_value']); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $assetDetail['AssetDetail']['date_of_purchase']); ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['serial_no']; ?>&nbsp;</td>
		<td class="left"><?php echo $assetDetail['AssetDetail']['code']; ?>&nbsp;</td>
		<td>
		<?php echo $this->Form->checkbox('id', 
					array(
						'label'=>'',
						'hiddenField'=>false,
						'type'=>'checkbox', 
						'value'=>$assetDetail['AssetDetail']['id'],
						'name'=>'data[AssetDetail][id][]'
						) )
		?>	
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $assetDetail['AssetDetail']['id'])); ?>
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
		<?php echo $this->Paginator->first('|< ' . __('first', true), array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >|', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
