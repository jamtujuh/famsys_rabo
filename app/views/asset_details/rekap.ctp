<?php
	//echo $javascript->link('prototype',false);
	//echo $javascript->link('scriptaculous',false); 
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<?php $date_end = $this->Session->read('Asset.date_end') ?>
<?php $is_inventory = $this->Session->read('AssetReport.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
	<? echo $form->create('AssetDetail', array('action' => 'reports/rekap'));?>
	<fieldset>
		<legend><?php __('Report Filters')?></legend>
		<fieldset class="subfilter" style="width:40%">
		<legend><?php __('Asset Info') ?></legend>
		<? //echo $form->input('date_end', array('type'=>'date','dateFormat'=>'MY', 'value'=>$date_end)); ?>
		<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
		<?php echo $this->Form->input('department_name',array('style'=>'width:100%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
		<?php else : ?>
		<? echo $form->input('department_id', array( 'options'=>$departments , 'value'=>$this->Session->read('AssetReport.department_id'), 'empty'=>'all'  )); ?>
		<?php endif ;?>
		<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$this->Session->read('AssetReport.business_type_id'))) ?>
		<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
		<div id="cost_center_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetDetailCostCenterValues});
			//]]>
		</script>
		</fieldset>
		<? //echo $form->input('department_sub_id', array( 'options'=>$departmentSub, 'value'=>$this->Session->read('AssetReport.department_sub_id'),'empty'=>''  )); ?>
		<?// echo $form->input('department_unit_id', array( 'options'=>$departmentUnit, 'value'=>$this->Session->read('AssetReport.department_unit_id'),'empty'=>''  )); ?>		
		<?	/* $options = array('url' => '/departments/getDepartmentSubId/AssetDetail', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentSubId');
			echo $ajax->observeField('AssetDetailDepartmentId', $options);
			
			$options = array('url' => '/department_subs/getDepartmentUnitId/AssetDetail', 
			'indicator'=>'LoadingDiv', 'update' => 'AssetDetailDepartmentUnitId');
			echo $ajax->observeField('AssetDetailDepartmentSubId', $options); */
		?>	
		<fieldset class="subfilter" style="width:40%">
		<legend><?php __('Asset Category') ?></legend>
		<?php echo $this->Form->input('is_inventory', array('label'=>'Below Minimum Value','value'=>$is_inventory,'options'=>array('1'=>'Yes','2'=>'No', '3'=>'All'))); ?>
		<? echo $form->input('asset_category_type_id', array( 'options'=>$assetCategoryTypes, 'empty'=>'','value'=>$this->Session->read('AssetReport.asset_category_type_id'))); ?>
		<? echo $form->input('asset_category_id', array( 'options'=>$assetCategories, 'value'=>$this->Session->read('AssetReport.asset_category_id'),  'empty'=>'all'  )); ?>
		<? echo $form->input('search_keyword', array('style'=>'width:40%',  'type'=>'hidden')); ?>
		</fieldset>
		<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen')) ?>
		<?php echo $this->Form->submit('Refresh') ?>
		<?php echo $this->Form->end() ?>
	</fieldset>
		<?php
		$options = array(
			'url' => array('controller'=>'asset_categories','action'=>'get_asset_categories', 'AssetDetail'), 
			'update' => 'AssetDetailAssetCategoryId',
			'indicator' 	=> 'LoadingDiv',
			);
		echo $ajax->observeField('AssetDetailAssetCategoryTypeId', $options);	
	?>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
	</ul>
</div>
</div>

<div class="related">
<? if (!empty($assets)) : ?>	
	<h2><?php __('Fixed Asset Recap Report per ' . $this->Session->read('AssetReport.periode'));?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('No');?></th>
		<th><?php __('Asset Category');?></th>
		<th><?php __('Acquisition Cost' );?></th>
		<th><?php __('Depr. Cost Straigh Line');?></th>
		<th><?php __('Depr. Cost Double Declining');?></th>
		<th><?php __('Difference');?></th>
	</tr>
	<?php
	$a = 0;
	$b = 0;
	$c = 0;
	$i = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo ($i ); ?>&nbsp;</td>
		<td class="left"><?php echo $assetCategories[ $asset['AssetDetail']['asset_category_id'] ]; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['price'] ); ?>&nbsp;</td>		
		<td class="number"><?php echo $this->Number->format( $asset['0']['depr'] ); ?>&nbsp;</td>
		<td class="number"><?php echo 0 ;//$this->Number->format( $asset['0']['depr'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['0']['depr'] ); ?>&nbsp;</td>
	</tr>
	<?php $a += round($asset['0']['price']);?>
	<?php $b += round($asset['0']['depr']);?>
	<?php $c += round($asset['0']['depr']);?>

	<?php endforeach; ?>
	<tr>
		<td colspan="2"><div align="right">Total General</div></td>
		<td class="number"><?php echo $this->Number->format($a); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($b); ?>&nbsp;</td>
		<td></td>
		<td class="number"><?php echo $this->Number->format($c); ?>&nbsp;</td>
	</tr>
	</table>
<? endif ?>
</div>

