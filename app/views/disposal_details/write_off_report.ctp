<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
?>
<?php $is_inventory = $this->Session->read('DisposalDetail.is_inventory') ?>
<div id="moduleName"><?php echo $moduleName?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<?php echo $this->Form->create('DisposalDetail' ) ?>
	<div class="fieldfilter">
	<fieldset>
	<legend><?php __('FA Write Off Filters')?></legend>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Disposal Info')?></legend>
	<?php echo $form->input('asset_category_type_id', array( 'options'=>$assetCategoryTypes, 'empty'=>'','value'=>$this->Session->read('DisposalDetail.asset_category_type_id'))); ?>
	<?php echo $form->input('asset_category_id', array('empty'=>'all','options'=>$assetCategories, 'value'=>$this->Session->read('DisposalDetail.asset_category_id'))); ?>
	<?php if($this->Session->read('Security.permissions')==normal_user_group_id || $this->Session->read('Security.permissions')==branch_head_group_id) :?>
		<?php echo $this->Form->input('department_id',array('options'=>$departments,'type'=>'hidden','value'=>$Userinfo['department_id'])) ?>
		<?php echo $this->Form->input('department_name',array('style'=>'width:100%','type'=>'text','readonly'=>true,'value'=>$Userinfo['department_name'])) ?>
	<?php else :?>
		<?php echo $this->Form->input('department_id', array('empty'=>'all','value'=>$this->Session->read('DisposalDetail.department_id'))) ?> 
	<?php endif ;?>
	<?php echo $this->Form->input('business_type_id', array('options' => $businessType, 'empty' => 'all', 'value' => $this->Session->read('Disposal.business_type_id'))) ?>
	<?php echo $this->Form->input('cost_center_id', array('empty' => 'select cost center', 'type' => 'hidden')); ?>
	<?php echo $this->Form->input('CostCenter.name', array('label' => 'Cost Center', 'style' => 'width:100%')); ?>
	<div id="cost_center_choices" class="auto_complete"></div> 
	  <script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('CostCenterName', 'cost_center_choices', '<?php echo BASE_URL ?>/cost_centers/auto_complete', {afterUpdateElement : setDisposalDetailCostCenterValues});
			//]]>
	  </script>
	</fieldset>
	<fieldset class="subfilter" style="width:40%">
	<legend><?php __('Date Filter') ?></legend>
	<?php echo $this->Form->input('is_inventory', array('label'=>'Below Minimum Value','value'=>$is_inventory,'options'=>array('1'=>'Yes','2'=>'No', '3'=>'All'))); ?>	
	<?php echo $this->Form->input('date_start', array('type'=>'date', 'value'=>$date_start)) ?> 
	<?php echo $this->Form->input('date_end', array('type'=>'date', 'value'=>$date_end)) ?>
	</fieldset>
	<?php echo $this->Form->radio('layout',array('Screen'=>'Screen', 'pdf'=>'PDF', 'xls'=>'XLS'),array('default'=>'Screen')) ?>
	<?php echo $this->Form->submit('Refresh') ?>
	<?php echo $this->Form->end() ?>
	</fieldset>
	<?php
		$options = array(
			'url' => array('controller'=>'asset_categories','action'=>'get_asset_categories', 'DisposalDetail'), 
			'update' => 'DisposalDetailAssetCategoryId',
			'indicator' 	=> 'LoadingDiv',
			);
		echo $ajax->observeField('DisposalDetailAssetCategoryTypeId', $options);	
	?>	
</div>
	<div class="actions">
	  <h3><?php __('Actions'); ?></h3>
	  <ul>
			<?php echo $myMenu->asset_reports_menu($this->Session->read('Menu.main')) ?>
	  </ul>
	 </div>
</div>

<?php if(!empty($disposalDetails)):?>
<div class="related">
	<h2><?php __('FA Write Off Report');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('no');?></th>
			<th><?php echo $this->Paginator->sort('disposal_id');?></th>
			<th><?php echo $this->Paginator->sort('doc_date');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('business_type_id');?></th>
			<th><?php echo $this->Paginator->sort('cost_center_id');?></th>
			<th><?php echo $this->Paginator->sort('No Inventaris');?></th>
			<th><?php echo $this->Paginator->sort('asset_category_id');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('serial_no');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('book_value');?></th>
			<th><?php echo $this->Paginator->sort('accum_dep');?></th>
			<th><?php echo $this->Paginator->sort('date_of_purchase');?></th>
	</tr>
	<?php
	$i = 0;
	$total_sales_amount=0;
	$total_loss_profit_amount=0;
	$total_price=0;
	$total_book_value=0;
	$total_accum_dep=0;
	foreach ($disposalDetails as $disposalDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$total_price				+=$disposalDetail['DisposalDetail']['price'];
		$total_book_value			+=$disposalDetail['DisposalDetail']['book_value'];
		$total_accum_dep			+=$disposalDetail['DisposalDetail']['accum_dep'];
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?>&nbsp;</td>
		<td class="left"><?php echo $this->Html->link($disposalDetail['Disposal']['no'], array('controller' => 'disposals', 'action' => 'view', $disposalDetail['Disposal']['id'])); ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $disposalDetail['Disposal']['doc_date']); ?>&nbsp;</td>
		<td class="left"><?php echo $disposalDetail['Disposal']['Department']['name']; ?></td>
		<td class="left"><?php echo $disposalDetail['Disposal']['BusinessType']['name']; ?></td>
		<td class="left"><?php echo $disposalDetail['Disposal']['CostCenter']['cost_centers'].'-'.$disposalDetail['Disposal']['CostCenter']['name']; ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['code']; ?></td>
		<td class="left"><?php echo $myApp->showArrayValue($assetCategory,$disposalDetail['DisposalDetail']['asset_category_id']); ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['item_code']; ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['name']; ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['brand']; ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['type']; ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['color']; ?></td>
		<td class="left"><?php echo $disposalDetail['DisposalDetail']['serial_no']; ?></td>
		<td class="number"><?php echo $this->Number->format($disposalDetail['DisposalDetail']['price']); ?></td>
		<td class="number"><?php echo $this->Number->format($disposalDetail['DisposalDetail']['book_value']); ?></td>
		<td class="number"><?php echo $this->Number->format($disposalDetail['DisposalDetail']['accum_dep']); ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT,$disposalDetail['DisposalDetail']['date_of_purchase']); ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td colspan="14"  class="number"><?php __('Total')?></td>
		<td class="number"><?php echo $this->Number->format($total_price) ?></td>
		<td class="number"><?php echo $this->Number->format($total_book_value) ?></td>
		<td class="number"><?php echo $this->Number->format($total_accum_dep) ?></td>
		<td></td>
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
<?php endif;?>
