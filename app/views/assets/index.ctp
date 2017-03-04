<?php
	echo $javascript->link('my_script',false);	
	echo $javascript->link('my_detail_add',false);
?>
<?php $date_end = $this->Session->read('Asset.date_end') ?>
<?php $date_of_purchase = $this->Session->read('Asset.date_of_purchase') ?>
<?php $is_inventory = $this->Session->read('AssetReport.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
		<?php echo $this->Form->create('Asset') ?>
		<fieldset>
			<legend><?php __('Asset Filters') ?></legend>
			<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Asset Info')?></legend>
			<?php echo $this->Form->input('date_end', array('type'=>'date', 'dateFormat'=>'MY', 'value'=>$date_end)); ?> 
			<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
				<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
				<?php echo $this->Form->input('department_name',array('style'=>'width:100%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
			<?php else : ?>
				<?php echo $this->Form->input('department_id', array('options'=>$departments, 'value'=>$department_id, 'empty'=>'all')) ?>
			<?php endif; ?>
				<?php echo $this->Form->input('business_type_id',array('options'=>$businessType,'empty'=>'all','value'=>$business_type_id)) ?>
				<?php echo $this->Form->input('cost_center_id', array('empty'=>'select cost center', 'type'=>'hidden')); ?>
				<?php echo $this->Form->input('CostCenter.name', array('label'=>'Cost Center', 'style'=>'width:100%')); ?>
				<div id="cost_center_choices" class="auto_complete"></div> 
				<script type="text/javascript"> 
					//<![CDATA[
					new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setAssetCostCenterValues});
					//]]>
				</script>
			<? //echo $form->input('department_sub_id', array('options'=>$departmentSub, 'value'=>$this->Session->read('Asset.department_sub_id'), 'empty'=>'')); ?>
			<? //echo $form->input('department_unit_id', array('options'=>$departmentUnit, 'value'=>$this->Session->read('Asset.department_unit_id'), 'empty'=>'')); ?>
				<?	/* $options = array('url' => '/departments/getdepartmentsubid/Asset', 
					'indicator'=>'LoadingDiv', 'update' => 'AssetDepartmentSubId');
					echo $ajax->observeField('AssetDepartmentId', $options);
					
					$options = array('url' => '/department_subs/getdepartmentunitid/Asset', 
					'indicator'=>'LoadingDiv', 'update' => 'AssetDepartmentUnitId');
					echo $ajax->observeField('AssetDepartmentSubId', $options); */
				?>
			<?php $source_option = array( 'purchase' => 'Purchase/Register', 'mutasi' => 'Mutasi', 'import' => 'Import' ) ?>
			<?php echo $this->Form->input('source',array('options'=>$source_option,'empty'=>'all','value'=>$source)) ?>
			<?php $is_efektif = array( 'yes' => 'yes', 'no' => 'no' ) ?>
			<?php echo $this->Form->input('efektif',array('options'=>$is_efektif,'empty'=>'all','value'=>$this->Session->read('AssetReport.efektif')) )?>
			</fieldset>
			<fieldset class="subfilter" style="width:40%">
			<legend><?php __('Asset Category')?></legend>
			<?php echo $this->Form->input('is_inventory', array('label'=>'Below Minimum Value','value'=>$is_inventory,'options'=>array('1'=>'Yes','2'=>'No', '3'=>'All'))); ?>	
			<?php echo $this->Form->input('asset_category_type_id', array( 'options'=>$assetCategoryTypes, 'empty'=>'','value'=>$this->Session->read('AssetReport.asset_category_type_id'))); ?>
			<?php echo $this->Form->input('asset_category_id', array('options'=>$assetCategories, 'empty'=>'all','value'=>$this->Session->read('Asset.asset_category_id'))) ?>
			<?php
				$options = array(
					'url' => array('controller'=>'asset_categories','action'=>'get_asset_categories', 'Asset'), 
					'update' => 'AssetAssetCategoryId',
					'indicator' 	=> 'LoadingDiv',
					);
				echo $ajax->observeField('AssetAssetCategoryTypeId', $options);	
			?>
			<?php echo $this->Form->input('search_keyword', array('style'=>'width:100%', 'value'=>$this->Session->read('AssetReport.name')));?>
			<?php echo $this->Form->input('date_of_purchase_start', array('type'=>'date', 'value'=>$date_of_purchase_start)) ?>
			<?php echo $this->Form->input('date_of_purchase_end', array('type'=>'date', 'value'=>$date_of_purchase_end)) ?>
			</fieldset>
			<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF','xls'=>'XLS'),array('default'=>'Screen', 'class'=>'subfilter')) ?>
			<?php echo $this->Form->submit('Refresh') ?>
		</fieldset>
		<?php echo $this->Form->end() ?>
	</div>
	
	<div class="actions">
	  <h3><?php __('Actions'); ?></h3>
	  <ul>
		<li><?php echo $this->Html->link(__('List Asset Details', true), array('controller'=>'asset_details','action' => 'index')); ?> </li>
	  </ul>
	</div>
</div>

<div class="related">
	<h2><?php __('Assets List');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('Branch', 'department_id');?></th>
			<th><?php echo $this->Paginator->sort('Business Type','business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('Cost Center','cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('No Inventaris', 'code');?></th>
			<th><?php echo $this->Paginator->sort('Code','item_code');?></th>
			<th><?php echo $this->Paginator->sort('Name','name');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('Location','location_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('Unit Cost','price');?></th>
			<th><?php echo $this->Paginator->sort('Total Acquisition Cost','amount');?></th>
			<th><?php echo $this->Paginator->sort('Economic Age','umurek');?></th>
			<th><?php echo $this->Paginator->sort('Monthly Depreciation','depbln');?></th>
			
			<th><?php echo $this->Paginator->sort('Accum. Depr 31/12/'. ($year-1));?></th>
			<th><?php echo $this->Paginator->sort('Book Value 31/12/' . ($year-1));?></th>
			<th><?php echo $this->Paginator->sort('Accum. Depr 31/12/'. $year);?></th>
			<th><?php echo $this->Paginator->sort('Book Value 31/12/'. $year);?></th>
			
			<th><?php echo $this->Paginator->sort('purchase_id');?></th>
			<th><?php echo $this->Paginator->sort('date_start');?></th>
			<th><?php echo $this->Paginator->sort('date_end');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>

			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	$qty = 0;
	$price = 0;
	$amount = 0;
	$maksi = 0;
	$depbln = 0;
	$book_value_thnlalu = 0;
	$depthnlalu = 0;
	$book_value = 0;
	$depthnini = 0;
	foreach ($assets as $asset):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $departments[$asset['Asset']['department_id']]; ?>&nbsp;</td>
		<td class="left"><?php echo $myApp->showArrayValue($businessType,$asset['Asset']['business_type_id']); ?>&nbsp;</td>
		<td class="left">
			<?php if($myApp->showArrayValue($costCenter,$asset['Asset']['cost_center_id']) == ''){?>
				<?php echo $costCenterToDao[$asset['Asset']['cost_center_id']];?>
			<?php }else{?>
				<?php echo $myApp->showArrayValue($costCenter,$asset['Asset']['cost_center_id']) ;?>-<?php echo $myApp->showArrayValue($costCenters,$asset['Asset']['cost_center_id']);?>
			<?php }?>			
		&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['code']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['item_code']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['name']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['brand']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['type']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Asset']['color']; ?>&nbsp;</td>
		<td class="left"><?php echo $asset['Location']['name']; ?>&nbsp;</td>
		<td class="center"><?php echo $asset['Asset']['qty']; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['price'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['amount'] ); ?>&nbsp;</td>
		<td class="center"><?php echo  $asset['Asset']['umur'] ; ?> / <?php echo  $asset['Asset']['maksi'] ; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depbln'] ); ?>&nbsp;</td>
		
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depthnlalu'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['book_value_thnlalu'] ); ?>&nbsp;</td>

		<td class="number"><?php echo $this->Number->format( $asset['Asset']['depthnini'] ); ?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format( $asset['Asset']['book_value'] ); ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($asset['Purchase']['no'], array('controller'=>'purchases', 'action'=>'view', $asset['Asset']['purchase_id']) ); ?>&nbsp;</td>
                              <td class="number"><?php if($asset['Asset']['date_start'] != null) : 
								echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_start']); 
								endif; ?>&nbsp;</td>
                              <td class="number"><?php if(!empty($asset['Asset']['date_end'])) : 
								echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_end']); 
								endif; ?>&nbsp;</td>
		<td class="number"><?php echo $this->Time->format(DATE_FORMAT, $asset['Asset']['date_of_purchase']) ; ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $asset['Asset']['id'])); ?>
			<?php echo $this->Html->link(__('Edit EA', true), array('action' => 'editEconomicAge', $asset['Asset']['id'])); ?>
		</td>
	</tr>
	<?php $qty += round($asset['Asset']['qty']) ;?>
	<?php $price += round($asset['Asset']['price']) ;?>
	<?php $amount += round($asset['Asset']['amount']) ;?>
	<?php $maksi += round($asset['Asset']['maksi']) ;?>
	<?php $depbln += round($asset['Asset']['depbln']) ;?>
	<?php $book_value_thnlalu += round($asset['Asset']['book_value_thnlalu']) ;?>
	<?php $depthnlalu += round($asset['Asset']['depthnlalu']) ;?>
	<?php $book_value += round($asset['Asset']['book_value']) ;?>
	<?php $depthnini += round($asset['Asset']['depthnini']) ;?>
<?php endforeach; ?>
	<tr>
		<td colspan="11"><div align="right">Total</div></td>
		<td class="center"><?php echo $this->Number->format($qty) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($price) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($amount) ;?>&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number">&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($depthnlalu) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($book_value_thnlalu) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($depthnini) ;?>&nbsp;</td>
		<td class="number"><?php echo $this->Number->format($book_value) ;?>&nbsp;</td>
	</tr>
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
